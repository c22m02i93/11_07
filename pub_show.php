<?
if (isset($_REQUEST[session_name()])) session_start ();
$auth=$_SESSION['auth'];
$name_user=$_SESSION['name_user'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<?
  $data= $_GET['data'];
    $enter= $_GET['enter'];
$msg = $_GET['msg'];
$name = $_GET['name'];
$data = preg_replace("/%20/", " ", $data);

mysql_connect("localhost", "host1409556", "0f7cd928"); 
mysql_query("SET NAMES 'cp1251'");
$news_all_wer = mysql_query("SELECT * FROM host1409556_barysh.publikacii WHERE data = '$data'");
$news_wer = mysql_fetch_array($news_all_wer); 

if ($enter || $auth == 1) {
$views = $news_wer[views];
}
else {
$views = $news_wer[views]+1;
mysql_query("UPDATE host1409556_barysh.publikacii SET views = '$views' WHERE data = '$data'");
}

?>
<title><? echo $news_wer[tema];?> - Публикации</title>

<?
include 'head.php';
?>

</head>
<body>

<div style="box-shadow: 0 0 20px rgba(0,0,0,0.5);">
<?
include 'golova.php';

include 'menu.php';

include 'content.php';

?>
<div id="osnovnoe">

<h1>Публикации</h1>

 <?   

$dtn = $news_wer[data]; 
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


  	$patterns = array ('/(?:\/{3})(.+)(?:\/{3})/U', '/(?:\|{3})(.+)(?:\|{3})/U', '/(?:\{{3})(http[s]*:\/\/[^\s\[<\(\)\|]+)(?:\}{3})-(?:\{{3})([^}]+)(?:\}{3})/i', '/(?:\{{3})(http[s]*:\/\/[^\s\[<\(\)\|]+)(?:\}{3})/i', '/(?:\{{3})([_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z]{2,3}))(?:\}{3})/', '/\n/', '/@R(\d+)[-]?([^@]*)@/', '/@L(\d+)[-]?([^@]*)@/', '/(?:\[{3})(([0-9]*[^\]{3}]*)*)(?:\]{3})/');
	$replace = array ('<i>${1}</i>', '<b>${1}</b>', '<a href="${1}" target=_blank>${2}</a>', '<a href="${1}" target=_blank>${1}</a>', '<a href="mailto:${1}">${1}</a>', '</p><p>', '<span class="photos"><a href="FOTO/${1}.jpg" rel="example_group" alt="${2}" title="${2}"><img style="border: 1px solid #C3D7D4; margin: 5px 10px 5px 10px;display: block;float: right;box-shadow: 2px 2px 5px rgba(0,0,0,0.3); padding: 10px" src="FOTO_MINI/${1}.jpg" /></a></span>', '<span class="photos"><a href="FOTO/${1}.jpg" rel="example_group" alt="${2}" title="${2}"><img style="border: 1px solid #C3D7D4; margin: 5px 10px 5px 10px;display: block;float: left;box-shadow: 2px 2px 5px rgba(0,0,0,0.3); padding: 10px" src="FOTO_MINI/${1}.jpg" /></a></span>', '<div style="text-align: center; font-weight: bolder;Width:100%; color:#743C00">${1}</div>');
	$text = preg_replace($patterns, $replace, $news_wer[text]);
#################################### 
if ($auth == 1) echo '<a style="float: right; margin: 10px;" href="edit.php?table=publikacii&data='.$data.'"><img src="IMG/edit.png" title="Редактировать" /></a> ';
######################################

	echo '<div class="block_title"><span class="title">'.$news_wer[tema].'</span><br />'.$ddttn.'</div><br />';

if ($news_wer[oblozka]) echo '<span class="photos"><a href="FOTO/'.$news_wer[oblozka].'.jpg" rel="example_group" alt= "'.$news_wer[tema].'" title="'.$news_wer[tema].'"><img style="box-shadow: 2px 2px 5px rgba(0,0,0,0.3); display: inline;float: left;border: 1px solid #C3D7D4; margin: 0 10px 5px 10px; padding: 10px" src="FOTO_MINI/'.$news_wer[oblozka].'.jpg"/></a></span>';


echo '<p>'.$text.'</p>';

if ($news_wer[albom]) {
echo '<hr /><div style="margin-left: 15px;">';
$albom_mas = preg_split("/\s/", $news_wer[albom]);
for ($j=0; $j<count($albom_mas); $j++)
{
echo '<span class="photos"><a href="FOTO/'.$albom_mas[$j].'.jpg" rel="example_group"><img style="border: 1px solid #BEC7BE; box-shadow: 2px 2px 5px rgba(0,0,0,0.3);margin: 5px; padding: 10px" src="FOTO_MINI/'.$albom_mas[$j].'.jpg" /></a></span>';

}
echo '</div>';

}

?>
<br />
<p style="color:#444; font-style:italic ">При копировании гиперссылка на <a style="color:#444; text-decoration:underline;" href="http://barysh-eparhia.ru/">сайт Барышской епархии</a> обязательна</p>

<hr />
<script type="text/javascript" src="//yandex.st/share/share.js" charset="utf-8"></script>
<div class="yashare-auto-init" data-yashareL10n="ru" data-yashareType="button" data-yashareQuickServices="yaru,vkontakte,facebook,twitter,odnoklassniki,moimir,lj"></div> 

<?
echo '<span class="views" style="margin: 0 0 0 20px">Просмотров: '.$views.'.</span>';

?>

</div>

<?
include 'footer.php';
?>

 </div>
</body>
</html>