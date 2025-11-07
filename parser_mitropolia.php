<?php
/**
 * Парсер mitropolia-simbirsk.ru -> host1409556_barysh.news_mitropolia
 * Полностью обновлённая версия с правильной логикой выбора обложки:
 *
 * ? PRIORITY:
 *   1) og:image (главная обложка записи)
 *   2) media:content
 *   3) media:thumbnail
 *   4) enclosure
 *   5) первая картинка в HTML страницы (если og:image нет)
 *   6) первая картинка в RSS-контенте (самый крайний случай)
 *
 * ? barysh_tag — ВСЕГДА берёт картинку только из открытой HTML-страницы (оглавление)
 *    а не из RSS.
 */

error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors', 1);
header('Content-Type: text/plain; charset=utf-8');

/* ==== БД ==== */
$db_host = "localhost";
$db_user = "host1409556";
$db_pass = "0f7cd928";
$db_name = "host1409556_barysh";
$table   = "news_mitropolia";

/* ==== Файлы ==== */
$upload_dir = __DIR__ . "/uploads/mitropolia";
$upload_url = "/uploads/mitropolia";

/* ==== RSS-источники ==== */
$feeds = array(
    "barysh_tag" => "https://mitropolia-simbirsk.ru/tag/baryshskaya-eparhiya/feed/",
    "arhipastry" => "https://mitropolia-simbirsk.ru/category/mitropoliya/arhipastyrskoe-sluzhenie/feed/",
    "slovo"      => "https://mitropolia-simbirsk.ru/category/mitropolit/slovo-arhipastyrya/feed/",
);

/* ==== Функции ==== */
function http_get($url){
    if(function_exists('curl_init')){
        $ch=curl_init($url);
        curl_setopt_array($ch, array(
            CURLOPT_RETURNTRANSFER=>true,
            CURLOPT_FOLLOWLOCATION=>true,
            CURLOPT_CONNECTTIMEOUT=>15,
            CURLOPT_TIMEOUT=>30,
            CURLOPT_SSL_VERIFYPEER=>false,
            CURLOPT_USERAGENT=>"BaryshParser/1.2"
        ));
        $data=curl_exec($ch);
        curl_close($ch);
        return $data;
    }
    return @file_get_contents($url);
}

function ensure_dir($p){ if(!is_dir($p)) @mkdir($p,0755,true); }

function absolute_url($src){
    if(!$src) return '';
    $src = trim(html_entity_decode($src, ENT_QUOTES, 'UTF-8'));
    if(strpos($src,'//') === 0) return 'https:' . $src;
    if(strpos($src,'http://')===0 || strpos($src,'https://')===0) return $src;
    if($src[0]=='/') return 'https://mitropolia-simbirsk.ru'.$src;
    return 'https://mitropolia-simbirsk.ru/'.$src;
}

function pick_from_srcset($srcset){
    if(!$srcset) return '';
    $parts = preg_split('/\s*,\s*/', $srcset);
    if(!$parts) return '';
    $url = preg_split('/\s+/', trim($parts[0]));
    return $url ? $url[0] : '';
}

function extract_first_img_src($html){
    if(!$html) return '';

    if(preg_match('/<img[^>]+(?:data-lazy-src|data-src)=["\']([^"\']+)/i',$html,$m))
        return $m[1];

    if(preg_match('/<img[^>]+srcset=["\']([^"\']+)/i',$html,$m)){
        $x = pick_from_srcset($m[1]);
        if($x) return $x;
    }

    if(preg_match('/<img[^>]+src=["\']([^"\']+)/i',$html,$m))
        return $m[1];

    return '';
}

function fetch_og_image($url){
    $html = http_get($url);
    if(!$html) return '';

    if(preg_match('/<meta[^>]+property=["\']og:image["\'][^>]+content=["\']([^"\']+)/i',$html,$m))
        return $m[1];

    if(preg_match('/<meta[^>]+name=["\']twitter:image["\'][^>]+content=["\']([^"\']+)/i',$html,$m))
        return $m[1];

    $from_html = extract_first_img_src($html);
    return $from_html ? $from_html : '';
}

function save_image_local($img_url, $upload_dir, $prefix='img'){
    $img_url = absolute_url($img_url);
    if(!$img_url) return '';

    $path = parse_url($img_url, PHP_URL_PATH);
    $ext  = pathinfo($path, PATHINFO_EXTENSION);
    if(!$ext) $ext = 'jpg';

    $name = $prefix.'-'.date('Ymd-His').'-'.substr(md5($img_url),0,8).'.'.$ext;
    ensure_dir($upload_dir);

    $bin = http_get($img_url);
    if(!$bin || strlen($bin)<256) return '';

    @file_put_contents(rtrim($upload_dir,'/').'/'.$name, $bin);
    return $name;
}

function str_truncate($text, $limit){
    $text = trim($text);
    if(function_exists('mb_strlen')){
        if(mb_strlen($text,'UTF-8') <= $limit) return $text;
        return mb_substr($text,0,$limit,'UTF-8').'…';
    }
    if(strlen($text) <= $limit) return $text;
    return substr($text,0,$limit).'…';
}

/* ==== БД ==== */
mysql_connect($db_host,$db_user,$db_pass) or die("DB connect error");
mysql_select_db($db_name) or die("DB select error");
mysql_query("SET NAMES 'utf8'");

/* ==== Таблица ==== */
mysql_query("CREATE TABLE IF NOT EXISTS `$table` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `tema` VARCHAR(255) NOT NULL,
  `kratko` TEXT,
  `data` DATETIME NOT NULL,
  `oblozka` VARCHAR(500) DEFAULT NULL,
  `link` VARCHAR(500) NOT NULL,
  `section` VARCHAR(32) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `u_link` (`link`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8");

/* ==== Кэш ==== */
$cache_dir = __DIR__.'/cache_mitropolia';
$cache_ttl = 300;
ensure_dir($cache_dir);

$total_new = 0;
$total_upd = 0;

/* фильтр по дате */
$cutoff_ts = strtotime("2025-11-01 00:00:00");

/* ======= ОСНОВНОЙ ЦИКЛ ======= */
foreach($feeds as $section=>$rss_url){

    if($section==='slovo'){
        $cf = $cache_dir.'/'.md5($rss_url).'.xml';
        if(file_exists($cf)) @unlink($cf);
    }

    $cache_file = $cache_dir.'/'.md5($rss_url).'.xml';
    if(file_exists($cache_file) && time()-filemtime($cache_file) < $cache_ttl){
        $xml_str = @file_get_contents($cache_file);
    } else {
        $xml_str = http_get($rss_url);
        if($xml_str) @file_put_contents($cache_file,$xml_str);
    }
    if(!$xml_str){ echo "[WARN] no RSS: $rss_url\n"; continue; }

    $rss = @simplexml_load_string($xml_str);
    if(!$rss){ echo "[WARN] bad XML: $rss_url\n"; continue; }

    $ns = $rss->getNamespaces(true);
    $items = array();

    if($rss->channel && $rss->channel->item){
        foreach($rss->channel->item as $it) $items[]=$it;
    } elseif($rss->entry){
        foreach($rss->entry as $it) $items[]=$it;
    }

    foreach($items as $item){

        $title = trim((string)$item->title);

        $link = trim((string)$item->link);
        if(!$link && $item->link && $item->link['href'])
            $link = trim((string)$item->link['href']);

        $pub = (string)$item->pubDate;
        if(!$pub && $item->updated) $pub=(string)$item->updated;
        if(!$pub && $item->date)    $pub=(string)$item->date;

        $ts = $pub ? strtotime($pub) : time();
        if($ts < $cutoff_ts) continue;

        $date = date("Y-m-d H:i:s",$ts);

        $desc = (string)$item->description;
        $full = '';
        if(!empty($ns['content'])){
            $c = $item->children($ns['content']);
            if($c && $c->encoded) $full=(string)$c->encoded;
        }

        /* === КАРТИНКА === */
        $img = '';

        /* ————————————————
         * barysh_tag: фото ТОЛЬКО со страницы
         * ———————————————— */
        if($section === 'barysh_tag' && $link){
            $img = fetch_og_image($link);
            if(!$img){
                $html_page = http_get($link);
                if($html_page){
                    $img = extract_first_img_src($html_page);
                }
            }
        }

        /* ————————————————
         * Общая логика (если не barysh_tag)
         * ———————————————— */
        if(!$img){

            // 1) og:image
            if($link){
                $img = fetch_og_image($link);
            }

            // 2) media:content
            if(!$img && !empty($ns['media'])){
                $m = $item->children($ns['media']);
                if($m && $m->content && $m->content->attributes()){
                    $attr = $m->content->attributes();
                    if($attr['url']) $img = (string)$attr['url'];
                }
            }

            // 3) media:thumbnail
            if(!$img && !empty($ns['media'])){
                if($m && $m->thumbnail && $m->thumbnail->attributes()){
                    $attr = $m->thumbnail->attributes();
                    if($attr['url']) $img = (string)$attr['url'];
                }
            }

            // 4) enclosure
            if(!$img && $item->enclosure && $item->enclosure['url']){
                $img = (string)$item->enclosure['url'];
            }

            // 5) первая картинка из полного HTML
            if(!$img){
                $html_page = http_get($link);
                if($html_page){
                    $img = extract_first_img_src($html_page);
                }
            }

            // 6) крайний случай — контент RSS
            if(!$img){
                $img = extract_first_img_src($full);
                if(!$img) $img = extract_first_img_src($desc);
            }
        }

        $img = absolute_url($img);

        /* Краткое описание */
        $plain = trim(strip_tags($desc ? $desc : $full));
        $plain = preg_replace('/\s+/u', ' ', $plain);
        $plain = str_truncate($plain, 600);

        $e_link = mysql_real_escape_string($link);
        $e_date = mysql_real_escape_string($date);
        $e_tema = mysql_real_escape_string($title);
        $e_krat = mysql_real_escape_string($plain);
        $e_sec  = mysql_real_escape_string($section);

        $q = mysql_query("SELECT id, oblozka, kratko FROM `$table` WHERE link='$e_link' LIMIT 1");
        $row = $q ? mysql_fetch_assoc($q) : null;

        $oblozka_local = '';
        if($img){
            $fname = save_image_local($img, $upload_dir, $section);
            if($fname) $oblozka_local = $upload_url.'/'.$fname;
        }

        /* ——— UPDATE / INSERT ——— */
        if($row){
            $set = array("`data`='$e_date'", "`tema`='$e_tema'", "`section`='$e_sec'");

            if($oblozka_local && empty($row['oblozka']))
                $set[] = "`oblozka`='".mysql_real_escape_string($oblozka_local)."'";

            if($plain && (empty($row['kratko']) || strlen($row['kratko'])<50))
                $set[]="`kratko`='$e_krat'";

            if(count($set)>0){
                $sql = "UPDATE `$table` SET ".implode(',', $set)." WHERE id=".(int)$row['id']." LIMIT 1";
                mysql_query($sql);
                if(mysql_affected_rows()>0){ $total_upd++; echo "[UPD] $title ($section)\n"; }
            }

        } else {
            $e_img = mysql_real_escape_string($oblozka_local);
            $sql = "INSERT INTO `$table` (`tema`,`kratko`,`data`,`oblozka`,`link`,`section`)
                    VALUES ('$e_tema','$e_krat','$e_date','$e_img','$e_link','$e_sec')";
            $ok = mysql_query($sql);
            if($ok){ $total_new++; echo "[NEW] $title ($section)\n"; }
            else    { echo "[ERR] ".mysql_error()."\n"; }
        }
    }
}

echo "Done. New: $total_new, Updated: $total_upd\n";
?>
