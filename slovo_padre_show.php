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

  $data= $_GET['data'];
  $enter= $_GET['enter'];
$msg = $_GET['msg'];
$name = $_GET['name'];
$data = preg_replace("/%20/", " ", $data);

mysql_connect("localhost", "host1409556", "0f7cd928"); 
mysql_query("SET NAMES 'cp1251'");
$news_all = mysql_query("SELECT * FROM host1409556_barysh.padre WHERE data = '$data'");
$news = mysql_fetch_array($news_all); 

if ($enter || $auth == 1) {
$views = $news[views];
}
else {
$views = $news[views]+1;
mysql_query("UPDATE host1409556_barysh.padre SET views = '$views' WHERE data = '$data'");
};
?>
<title><? echo $news[tema];?> - Слово архипастыря</title>

</head>
<body>

<div style="box-shadow: 0 0 20px rgba(0,0,0,0.5);">
<?
include 'golova.php';

include 'menu.php';

include 'content.php';

?>

<div id="osnovnoe">

<h1>Слово архипастыря</h1>
 <?   
$news_all = mysql_query("SELECT * FROM host1409556_barysh.padre WHERE data = '$data'");
$news = mysql_fetch_array($news_all); 

$dtn = $news[data]; 
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


   
  	$patterns = array ('/(^\/)\/(^\/)/', '/(?:\/{3})(.+)(?:\/{3})/U', '/(?:\|{3})(.+)(?:\|{3})/U', '/(?:\{{3})(http[s]*:\/\/[^\s\[<\(\)\|]+)(?:\}{3})-(?:\{{3})([^}]+)(?:\}{3})/i', '/(?:\{{3})(http[s]*:\/\/[^\s\[<\(\)\|]+)(?:\}{3})/i', '/(?:\{{3})([_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z]{2,3}))(?:\}{3})/', '/\n/', '/@R(\d+)[-]?([^@]*)@/', '/@L(\d+)[-]?([^@]*)@/', '/(?:\[{3})(([0-9]*[^\]{3}]*)*)(?:\]{3})/');
	$replace = array ('${1}&#047;${2}', '<i>${1}</i>', '<b>${1}</b>', '<a href="${1}" target=_blank>${2}</a>', '<a href="${1}" target=_blank>${1}</a>', '<a href="mailto:${1}">${1}</a>', '</p><p>', '<span class="photos"><a href="FOTO/${1}.jpg" rel="example_group" alt="${2}" title="${2}"><img style="border: 1px solid #C3D7D4; margin: 5px 10px 5px 10px;display: block;float: right;box-shadow: 2px 2px 5px rgba(0,0,0,0.3); padding: 10px" src="FOTO_MINI/${1}.jpg" /></a></span>', '<span class="photos"><a href="FOTO/${1}.jpg" rel="example_group" alt="${2}" title="${2}"><img style="border: 1px solid #C3D7D4; margin: 5px 10px 5px 10px;display: block;float: left;box-shadow: 2px 2px 5px rgba(0,0,0,0.3); padding: 10px" src="FOTO_MINI/${1}.jpg" /></a></span>', '<div style="text-align: center; font-weight: bolder;Width:100%; color:#743C00">${1}</div>');
	$text = preg_replace($patterns, $replace, $news['text']);
 
 	echo '<div class="block_title"><span class="title">'.$news[tema].'</span><br />'.$ddttn.'</div><br />';

if ($news[img]) echo '<span class="photos"><img style="box-shadow: 2px 2px 5px rgba(0,0,0,0.3); display: inline;float: left;border: 1px solid #C3D7D4; margin: 0 10px 5px 10px; padding: 10px" src="IMG/'.$news[img].'.jpg" /></span>';

echo '<p>'.$text.'</p>';

?>
<hr />
<script type="text/javascript" src="//yandex.st/share/share.js" charset="utf-8"></script>
<div class="yashare-auto-init" data-yashareL10n="ru" data-yashareType="button" data-yashareQuickServices="yaru,vkontakte,facebook,twitter,odnoklassniki,moimir,lj"></div> 

<?
echo '<span class="views">Просмотров: '.$views.'.</span>';
?>


</div>
<?
include 'footer.php';
?>

 </div>
</body>
</html>