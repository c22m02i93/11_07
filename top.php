<?
if (isset($_REQUEST[session_name()])) session_start ();
$auth=$_SESSION['auth'];
$name_user=$_SESSION['name_user'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?
include 'head.php';
?>
<title>Самое читаемое</title>

</head>
<body>

<div style="box-shadow: 0 0 20px rgba(0,0,0,0.5);">
<?
include 'golova.php';
$top = yes;

include 'menu.php';

include 'content.php';

?>

<div id="osnovnoe">

<h1>Самое читаемое</h1>
<p style="color:#666">Топ 15 самых популярных записей</p>
<?
	   	mysql_connect("localhost", "host1409556", "0f7cd928");
$stih1 = mysql_query("SELECT * FROM host1409556_barysh.padre  ORDER BY views + 0 DESC LIMIT 15");

	for ($t=0; $t<15; $t++)
{
$stih = mysql_fetch_array($stih1); 
$massiv[$t]['tema'] = $stih['tema'];
$massiv[$t]['views'] = $stih['views'];
$massiv[$t]['data'] = $stih['data'];
$massiv[$t]['oblozka'] = 'IMG/'.$stih['img'];
 if (preg_match_all ("/[^\t]{350}/", $stih['text'], $massiv_news)) {
	   $massiv[$t]['kratko']= $massiv_news[0][0].'... <a href="slovo_padre_show.php?data='.$stih['data'].'">(читать далее)</a>';}
	   else $massiv[$t]['kratko'] = $stih['text'];

$massiv[$t]['page'] = 'slovo_padre_show';
}
$stih2 = mysql_query("SELECT * FROM host1409556_barysh.news_eparhia  ORDER BY views + 0 DESC LIMIT 15");
	for ($t=15; $t<30; $t++)
{
$stih = mysql_fetch_array($stih2); 
$massiv[$t]['tema'] = $stih['tema'];
$massiv[$t]['views'] = $stih['views'];
$massiv[$t]['data'] = $stih['data'];
$massiv[$t]['oblozka'] = 'FOTO_MINI/'.$stih['oblozka'];
$massiv[$t]['kratko'] = $stih['kratko'];
$massiv[$t]['video'] = $stih['video'];
$massiv[$t]['page'] = 'news_show';
}
$stih3 = mysql_query("SELECT * FROM host1409556_barysh.publikacii  ORDER BY views + 0 DESC LIMIT 15");

	for ($t=30; $t<45; $t++)
{
$stih = mysql_fetch_array($stih3); 
$massiv[$t]['tema'] = $stih['tema'];
$massiv[$t]['views'] = $stih['views'];
$massiv[$t]['data'] = $stih['data'];
$massiv[$t]['oblozka'] = 'FOTO_MINI/'.$stih['oblozka'];
$massiv[$t]['kratko'] = $stih['kratko'];
$massiv[$t]['page'] = 'pub_show';
}

function cmp($a, $b)
{
    if ($a["views"] == $b["views"]) {
        return 0;
    }
    return ($a["views"] > $b["views"]) ? -1 : 1;

}
usort($massiv, "cmp");

	for ($r=0; $r<15; $r++)
{

$dtn = $massiv[$r][data]; 
$yyn = substr($dtn,0,4); // Год
$mmn = substr($dtn,5,2); // Месяц
$ddn = substr($dtn,8,2); // День

// Переназначаем переменные
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

$hours = substr($dtn,11,5); // Время 

$ddttn = '<span class="date">'.$ddn.' '.$mm1n.' '.$yyn.' г. '.$hours.'</span>'; // Конечный вид строки

  	$patterns = array ('/(?:\/{3})/', '/(?:\|{3})/', '/\n/', '/(?:\{{3})/', '/(?:\}{3})/', '/\[/', '/\]/');
	$replace = array ('', '', '</p><p>', '', '', '', '');
	$text = preg_replace($patterns, $replace, $massiv[$r][kratko]);

echo '<div style="float: left; margin-bottom: 10px; border-bottom: 1px #D7D7D7 solid"><div class="block_title"><span class="title"><a href="'.$massiv[$r][page].'.php?data='.$massiv[$r][data].'">'.$massiv[$r][tema].'</a></span><br />'.$ddttn;
 if ($massiv[$r]['video']) echo '<span style="color: #777"> (+ Видео)</span>';

echo '</div><div>';

if ($massiv[$r][oblozka]) echo '<div><img style="box-shadow: 2px 2px 5px rgba(0,0,0,0.3); display: inline;float: left;border: 1px solid #C3D7D4; margin: 0 10px 5px 10px; padding: 10px" src="'.$massiv[$r][oblozka].'.jpg" /></div>';

echo '<div style="margin-right: 5px"><p>'.$text.'</p><div class="zakladka" style="margin: 0 0 0 20px"><span class="views">Просмотров: '.$massiv[$r][views].'.<br /><br /></span></div></div></div></div>';
}
?>
<br />
<br />
<br />
</div>
<?
include 'footer.php';
?>

 </div>
</body>
</html>