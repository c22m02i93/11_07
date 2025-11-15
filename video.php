<?php
declare(strict_types=1);

use App\Service\NewsService;
use App\Service\VideoService;

if (isset($_REQUEST[session_name()])) {
    session_start();
}
$auth = $_SESSION['auth'];
$name_user = $_SESSION['name_user'];

require_once __DIR__ . '/vendor/autoload.php';

$videoService = new VideoService();
$newsService = new NewsService();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
include 'head.php';
?>
<title>Видео</title>

</head>
<body>

<div style="box-shadow: 0 0 20px rgba(0,0,0,0.5);">
<?php
include 'golova.php';
$video = yes;
include 'menu.php';
include 'function.php';

include 'content.php';
?>
<div id="osnovnoe">

<h1>Видео</h1>

<?php
if (!isset($_GET['page'])) {
    $p = 1;
} else {
    $p = addslashes(strip_tags(trim($_GET['page'])));
    if ($p < 1) {
        $p = 1;
    }
}
$num_elements = 10;
$total = $videoService->count();
$num_pages = $total > 0 ? ceil($total / $num_elements) : 1;
if ($p > $num_pages) {
    $p = $num_pages;
}
$start = ($p - 1) * $num_elements;


echo GetNav($p, $num_pages, "video").'<hr style="width: 100%" />';
$videos = $videoService->getPaginated($num_elements, $start);
if (!empty($videos)) {
    foreach ($videos as $res) {
        $dtn = $res['data'];
        $yyn = substr($dtn,0,4);
        $mmn = substr($dtn,5,2);
        $ddn = substr($dtn,8,2);

        if ($mmn == "01") $mm1n="января";
        if ($mmn == "02") $mm1n="февраля";
        if ($mmn == "03") $mm1n="марта";
        if ($mmn == "04") $mm1n="апреля";
        if ($mmn == "05") $mm1n="мая";
        if ($mmn == "06") $mm1n="июня";
        if ($mmn == "07") $mm1n="июля";
        if ($mmn == "08") $mm1n="августа";
        if ($mmn == "09") $mm1n="сентября";
        if ($mmn == "10") $mm1n="октября";
        if ($mmn == "11") $mm1n="ноября";
        if ($mmn == "12") $mm1n="декабря";

        if ($ddn == "01") $ddn="1";
        if ($ddn == "02") $ddn="2";
        if ($ddn == "03") $ddn="3";
        if ($ddn == "04") $ddn="4";
        if ($ddn == "05") $ddn="5";
        if ($ddn == "06") $ddn="6";
        if ($ddn == "07") $ddn="7";
        if ($ddn == "08") $ddn="8";
        if ($ddn == "09") $ddn="9";

        $hours = substr($dtn,11,5);

        $ddttn = '<span class="date">'.$ddn.' '.$mm1n.' '.$yyn.' г. '.$hours.'</span>';

        echo '<div style="float: left; margin-bottom: 10px; border-bottom: 1px #D7D7D7 solid"><div class="block_title"><span class="title">'.$res['tema'].'</span>';
        if ($auth == 1) echo '<a href="delete_video.php?id='.$res['id'].'"><img style="display: block;float: right;border: 0; margin: 0 5px 0 0; " src="IMG/delete.png"/></a>';
        echo '<br />'.$ddttn.'</div>';
        $patterns = array ('/width="46%"/');
        $replace = array ('width="95%"');
        $kod = preg_replace($patterns, $replace, $res['kod']);

        echo '</a><p style=" display: inline;float: left; margin: 0 10px 5px 10px;">'.$kod.'</p>';
        $news_wer = $newsService->findByVideoEmbed($res['kod']);

        if ($news_wer) {
            echo '<p class="vid_ss" ><a href="news_show.php?data='.$news_wer['data'].'">'.$news_wer['kratko'].'</a></p>';
        }
        echo '</div>';
    }
}
echo '<br /><table width="100%"><tr><td>';

echo GetNav($p, $num_pages, "video").'<hr style="width: 100%" /></td></tr></table>';

?>

</div>

<?php
include 'footer.php';
?>

 </div>
</body>
</html>
