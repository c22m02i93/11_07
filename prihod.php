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
<title>Действующие приходы</title>

</head>
<body>

<div style="box-shadow: 0 0 20px rgba(0,0,0,0.5);">
<?
include 'golova.php';

include 'menu.php';

include 'content.php';

function angel_data($string) {
if (!preg_match_all('/[а-яА-Яa-zA-Z]+/', $string, $mass)) {
$string= preg_replace('/\s/', '', $string);
$arra = preg_split('/,/', $string);
foreach ($arra as $value) {

$ddn = substr($value,0,2); // День
$mmn = substr($value,3,2); // Месяц

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
$itog .= ', '.$ddn.' '.$mm1n;
}
$itog= preg_replace('/^,\s/', '', $itog);
return $itog;
}
else return $string;

}

?>

<div id="osnovnoe">

<h1>Действующие приходы</h1>
 <?  
 $id= $_GET['id'];
  mysql_connect("localhost", "host1409556", "0f7cd928"); 
  mysql_query("SET NAMES 'cp1251'");
	$news_all = mysql_query("SELECT * FROM host1409556_barysh.prihods WHERE id='$id'");
	$pr = mysql_fetch_array($news_all);
		$patterns = array ('/\n/', '/([_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z]{2,3}))/', '/(?:\[{3})(([0-9]*[^\]{3}]*)*)(?:\]{3})/');
	$replace = array ('</p><p>', '<a href="mailto:${1}">${1}</a>', '<span style="font-weight: bolder;Width:100%; color:#743C00">${1}</span>');
	$pr[histor] = preg_replace($patterns, $replace, $pr[histor]);
	$pr[other] = preg_replace($patterns, $replace, $pr[other]);
	$pr[klir] = preg_replace($patterns, $replace, $pr[klir]);
	$pr[kontakt] = preg_replace($patterns, $replace, $pr[kontakt]);

#################################### 
if ($auth == 1) echo '<a style="float: right; margin: 10px;" href="edit_prihod.php?id='.$id.'"><img src="IMG/edit.png" title="Редактировать" /></a> ';
######################################
echo '
<p><span class="title"><b>'.$pr[name].' ('.$pr[blag].' благочиние)</b></span></p>';
if ($pr[foto]) echo '<span class="photos"><a href="FOTO/'.$pr[foto].'.jpg" rel="example_group" alt= "'.$pr[name].'" title="'.$pr[name].'"><img style="box-shadow: 2px 2px 5px rgba(0,0,0,0.3); display: inline;float: left;border: 1px solid #C3D7D4; margin: 0 10px 5px 10px; padding: 10px" src="FOTO_MINI/'.$pr[foto].'.jpg"/></a></span>';
if ($pr[angel]) echo '<p><b>Престольный праздник:</b> '.angel_data($pr[angel]).'</p>';
if ($pr[histor]) echo '<p><b>История храма:</b></p><p>'.$pr[histor].'</p>';	
echo '<br /><table style="width: 100%"><tr><td colspan="2">';

if ($pr[nastojatel]) {
	echo '<h2 style="padding-left: 15px">Духовенство</h2><br /></td></tr>';

if ($pr[nastojatel] == 'filaret') {
	echo '<tr><td>';
echo '<span class="photos"><a href="IMG/filaret.jpg" rel="example_group" alt= "Филарет, епископ Барышский и Инзенский" title="Филарет, епископ Барышский и Инзенский"><img style="box-shadow: 2px 2px 5px rgba(0,0,0,0.3); display: inline;float: left;border: 1px solid #C3D7D4; margin: 0 10px 5px 10px; padding: 10px" src="IMG/filaret_mini.jpg" alt= "Филарет, епископ Барышский и Инзенский" title="Филарет, епископ Барышский и Инзенский"/></a></span>';
echo '</td><td><p><a href="/arhierei.php">Епископ Филарет (Коньков)</a></p><p style="color:#666">Настоятель</p><br />';
}
else {
	$nastojatel = mysql_query("SELECT id, foto, name, san FROM host1409556_barysh.klir WHERE id = $pr[nastojatel] LIMIT 1");
	$pr_nast = mysql_fetch_array($nastojatel);
	echo '<tr><td>';
if ($pr_nast[foto]) echo '<span class="photos"><a href="FOTO/'.$pr_nast[foto].'.jpg" rel="example_group" alt= "'.$pr_nast[san].' '.$pr_nast[name].'" title="'.$pr_nast[san].' '.$pr_nast[name].'"><img style="box-shadow: 2px 2px 5px rgba(0,0,0,0.3); display: inline;float: left;border: 1px solid #C3D7D4; margin: 0 10px 5px 10px; padding: 10px" src="FOTO_MINI/'.$pr_nast[foto].'.jpg" alt= "'.$pr_nast[san].' '.$pr_nast[name].'" title="'.$pr_nast[san].' '.$pr_nast[name].'"/></a></span>';
echo '</td><td><p><a href="/klirik.php?id='.$pr_nast[id].'">'.$pr_nast[san].' '.$pr_nast[name].'</a></p><p style="color:#666">Настоятель</p><br />';
}
echo '</td></tr>';
}
if ($pr[klir]) {
	$stih_all=preg_split ('/\|/', $pr[klir]);
for ($ii=0; $ii < sizeof($stih_all); $ii++) {
	$stih=preg_split ('/\-/', $stih_all[$ii]);
		$klirik = mysql_query("SELECT id, foto, name, san FROM host1409556_barysh.klir WHERE id = $stih[0] LIMIT 1");
	$pr_klirik = mysql_fetch_array($klirik);
echo '<tr><td>';
if ($pr_klirik[foto]) echo '<span class="photos"><a href="FOTO/'.$pr_klirik[foto].'.jpg" rel="example_group" alt= "'.$pr_klirik[san].' '.$pr_klirik[name].'" title="'.$pr_klirik[san].' '.$pr_klirik[name].'"><img style="box-shadow: 2px 2px 5px rgba(0,0,0,0.3); display: inline;float: left;border: 1px solid #C3D7D4; margin: 0 10px 5px 10px; padding: 10px" src="FOTO_MINI/'.$pr_klirik[foto].'.jpg" alt= "'.$pr_klirik[san].' '.$pr_klirik[name].'" title="'.$pr_klirik[san].' '.$pr_klirik[name].'"/></a></span>';
echo '</td><td><p><a href="/klirik.php?id='.$pr_klirik[id].'">'.$pr_klirik[san].' '.$pr_klirik[name].'</a></p>';
if ($stih[1]) echo '<p style="color:#666">'.$stih[1].'</p>';
echo '<br /></td></tr>';
}
}
	echo '</table>';	

echo '<br /><h2 style="padding-left: 15px">Контакты</h2><br />';
echo '<p><b>Адрес:</b> '.$pr[adres].'</p>';
if ($pr[kontakt]) echo '<p><b>Контактная информация:</b></p><p>'.$pr[kontakt].'</p>';	
if ($pr[web]) echo '<p><b>Сайт:</b> <a href="http://'.$pr[web].'" target="_blank">'.$pr[web].'</a></p>';	
if ($pr[other]) echo '<p><b>Дополнительная информация:</b></p><p>'.$pr[other].'</p>';	
if ($pr[albom]) {
echo '<br /><h2 style="padding-left: 15px">Фотоальбом</h2><br />';
echo '<div style="margin-left: 15px;">';
$albom_mas = preg_split("/\s/", $pr[albom]);
for ($j=0; $j<count($albom_mas); $j++)
{
echo '<span class="photos"><a href="FOTO/'.$albom_mas[$j].'.jpg" rel="example_group"  id="lightbox1"><img style="border: 1px solid #BEC7BE; box-shadow: 2px 2px 5px rgba(0,0,0,0.3);margin: 5px; padding: 10px" src="FOTO_MINI/'.$albom_mas[$j].'.jpg" /></a></span>';

}
echo '</div>';

}

#################################################
$url='/prihod.php?id='.$id.'}';
$hron = mysql_query("SELECT data, tema FROM host1409556_barysh.news_eparhia WHERE text LIKE '%$url%' ORDER BY data DESC");
$hron1 = mysql_query("SELECT data, tema FROM host1409556_barysh.publikacii WHERE text LIKE '%$url%' ORDER BY data DESC");

if (mysql_num_rows($hron) || mysql_num_rows($hron1)) {
	
	function rus_data ($dtn) {
$yyn = substr($dtn,0,4); // Год
$mmn = substr($dtn,5,2); // Месяц
$ddn = substr($dtn,8,2); // День
// Переназначаем переменные
if ($mmn == "01") $mm1n="янв.";
if ($mmn == "02") $mm1n="фев.";
if ($mmn == "03") $mm1n="мар.";
if ($mmn == "04") $mm1n="апр.";
if ($mmn == "05") $mm1n="мая";
if ($mmn == "06") $mm1n="июн.";
if ($mmn == "07") $mm1n="июл.";
if ($mmn == "08") $mm1n="авг.";
if ($mmn == "09") $mm1n="сент.";
if ($mmn == "10") $mm1n="окт.";
if ($mmn == "11") $mm1n="нояб.";
if ($mmn == "12") $mm1n="дек.";
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
return $ddttn;
}

echo '<br /><div><h2 style="padding-left: 15px">Приход в жизни Епархии</h2><br />';
	for ($tr=0; $tr<mysql_num_rows($hron); $tr++)
{
 $news = mysql_fetch_array($hron);
$arr_n[] = '<div id="'.$news[data].'" class="block_title">'.rus_data($news[data]).' - <span class="title"><a href="news_show.php?data='.$news[data].'">'.$news[tema].'</a></span> <span style="color:#666">| Новости епархии</span></div>';
	}
	for ($tr=0; $tr<mysql_num_rows($hron1); $tr++)
{
 $pub = mysql_fetch_array($hron1);
$arr_p[] = '<div id="'.$pub[data].'" class="block_title">'.rus_data($pub[data]).' - <span class="title"><a href="pub_show.php?data='.$pub[data].'">'.$pub[tema].'</a></span> <span style="color:#666">| Публикации</span></div>';
	}
if ($arr_n && $arr_p) $result = array_merge ($arr_n, $arr_p);
elseif ($arr_n) $result = $arr_n;
else $result =  $arr_p;
rsort ($result);
	for ($tr=0; $tr<sizeof($result); $tr++)
{echo $result[$tr];
}
	echo '</div><br />';
	}
#################################################


?>

</div>
<?
include 'footer.php';
?>

 </div>
</body>
</html>