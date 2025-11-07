<?
if (isset($_REQUEST[session_name()])) session_start ();
$auth=$_SESSION['auth'];
$name_user=$_SESSION['name_user'];
if ($auth!=1) {Header ("Location: my_auth.php");}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?
include 'head.php';
mysql_connect("localhost", "host1409556", "0f7cd928"); 
mysql_query("SET NAMES 'cp1251'");
  $id= $_GET['id'];

$klirik_all = mysql_query("SELECT * FROM host1409556_barysh.klir WHERE id = '$id' LIMIT 1");
$klirik = mysql_fetch_array($klirik_all); 


echo '<title>'.$klirik[san].' '.$klirik[name].'</title>';
?>
</head>
<body>

<div style="box-shadow: 0 0 20px rgba(0,0,0,0.5);">
<?

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

function rus2translit($string) {

$yyn = substr($string,0,4); // Год
$mmn = substr($string,5,2); // Месяц
$ddn = substr($string,8,2); // День

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
$itog= $ddn.' '.$mm1n.' '.$yyn.' г.';

return $itog;

}

include 'golova.php';

include 'menu.php';

include 'content.php';

?>

<div id="osnovnoe" style = "margin-left: 20px">

<h1>Духовенство</h1>
<br />
<?
if ($klirik[foto]) echo '<span class="photos"><a href="FOTO/'.$klirik[foto].'.jpg" rel="example_group" alt= "'.$klirik[san].' '.$klirik[name].'" title="'.$klirik[san].' '.$klirik[name].'"><img style="box-shadow: 2px 2px 5px rgba(0,0,0,0.3); display: inline;float: left;border: 1px solid #C3D7D4; margin: 0 10px 5px 10px; padding: 10px" src="FOTO_MINI/'.$klirik[foto].'.jpg" alt= "'.$klirik[san].' '.$klirik[name].'" title="'.$klirik[san].' '.$klirik[name].'"/></a></span>';
else echo '<span class="photos"><img style="box-shadow: 2px 2px 5px rgba(0,0,0,0.3); display: inline;float: left;border: 1px solid #C3D7D4; margin: 0 10px 5px 10px; padding: 10px" src="IMG/no_foto.jpg" alt= "'.$klirik[san].' '.$klirik[name].'" title="'.$klirik[san].' '.$klirik[name].'"/></span>';
echo '<span class="title"><b>'.$klirik[san].' '.$klirik[name].'</b></span> &emsp;';
echo '<span style="color: ';
if ($klirik[status] == 'штатный') echo 'green';
if ($klirik[status] == 'заштатный' || $klirik[status] == 'на покое' || $klirik[status] == 'архивный') echo 'orange';
if ($klirik[status] == 'запрещенный') echo 'red';
echo '">('.$klirik[status].')</span>';
if ($auth == 1) {echo ' &nbsp; <a href = "/edit_klirik.php?id='.$id.'" style="color: #666">Редактировать</a>';}

echo '<br /><br />';
echo '<table><tr><td style="padding: 10px 20px 10px 10px; border: none; width: 65%;"><b>Дата рождения:</b> '.rus2translit($klirik[rozd]).'<br /><b>Диаконская хиротония:</b> '.rus2translit($klirik[diak]).'<br />';
if ($klirik[presv]) echo '<b>Иерейская хиротония:</b> '.rus2translit($klirik[presv]).'<br />';
if ($klirik[monah]) echo '<b>Дата пострига:</b> '.rus2translit($klirik[monah]).'<br />';
if ($klirik[angel]) echo '<b>День ангела:</b> '.angel_data($klirik[angel]).'<br />';
if ($klirik[obrazovanie]) {
	$patterns = array ('/\n/');
	$replace = array ('<br />');
	$klirik[obrazovanie] = preg_replace($patterns, $replace, $klirik[obrazovanie]);
echo '<b>Образование:</b><br />'.$klirik[obrazovanie].'<br />';
}
if ($klirik[poslush]) {
	$patterns = array ('/\n/');
	$replace = array ('<br />');
	$klirik[poslush] = preg_replace($patterns, $replace, $klirik[poslush]);
echo '<b>Епархиальные послушания:</b><br />'.$klirik[poslush].'<br />';
}
echo '</td><td style="vertical-align: top; width: 35%; padding: 10px; border: 1px solid #ccc">';
if ($klirik[orar]) echo '<b>Двойной орарь:</b> '.$klirik[orar].'<br />';
if ($klirik[protodiak]) {if ($klirik[monah]) echo '<b>Архидиакон:</b> ';  else echo '<b>Протодиакон:</b> '; echo $klirik[protodiak].'<br />';}
if ($klirik[nabedr]) echo '<b>Набедренник:</b> '.$klirik[nabedr].'<br />';
if ($klirik[kamilavk]) echo '<b>Камилавка:</b> '.$klirik[kamilavk].'<br />';
if ($klirik[krest]) echo '<b>Наперсный крест:</b> '.$klirik[krest].'<br />';
if ($klirik[protoier]) {if ($klirik[monah]) echo '<b>Игумен:</b> ';  else echo '<b>Протоиерей:</b> '; echo $klirik[protoier].'<br />';}
if ($klirik[palica]) echo '<b>Палица:</b> '.$klirik[palica].'<br />';
if ($klirik[krestprekras]) echo '<b>Крест с украшениями:</b> '.$klirik[krestprekras].'<br />';
if ($klirik[mitra]) {if ($klirik[monah]) echo '<b>Архимандрит:</b> ';  else echo '<b>Митра:</b> '; echo $klirik[mitra].'<br />';}
if ($klirik['1otverstie']) echo '<b>Отверстые врата до "Херувимской":</b> '.$klirik['1otverstie'].'<br />';
if ($klirik['2otverstie']) echo '<b>Отверстые врата до "Отче наш":</b> '.$klirik['2otverstie'].'<br />';
if (!$klirik[orar] && !$klirik[protodiak] && !$klirik[nabedr] ) echo '<b>Награды отсутствуют</b><br />';
echo '</td></tr></table><br /><br />';

echo '<table style="width: 100%"><tr><td><h2 style="padding-left: 15px">Служит в храмах:</h2>';

$family = $klirik[name];
$hram_all = mysql_query("SELECT * FROM host1409556_barysh.prihods WHERE nastojatel LIKE '$id' OR klir LIKE '$id-%' OR klir LIKE '%|$id-%' ORDER by name");
echo '<ol>';
if ($klirik['blag'] == 'mon') echo '<li><a href="/mon.php">Свято-Богородице-Казанский Жадовский мужской монастырь</a></li>';
	for ($tr=0; $tr<mysql_num_rows($hram_all); $tr++)
{
$pr = mysql_fetch_array($hram_all);
echo '<li><a href="prihod.php?id='.$pr[id].'">'.$pr[name].'</a></li>';
}
echo '</ol>';
echo '</td></tr>';
if ($klirik[kontakt]) {
	$patterns = array ('/\n/');
	$replace = array ('<br />');
	$text = preg_replace($patterns, $replace, $klirik[kontakt]);
echo '<tr><td><h2 style="padding-left: 15px">Контакты:</h2><br />'.$text.'<br /><br /></td></tr>';
}

#################################################
$url='/klirik.php?id='.$id.'}';
$hron = mysql_query("SELECT data, tema FROM host1409556_barysh.news_eparhia WHERE text LIKE '%$url%' ORDER BY data DESC");
$hron1 = mysql_query("SELECT data, tema FROM host1409556_barysh.publikacii WHERE text LIKE '%$url%' ORDER BY data DESC");

if (mysql_num_rows($hron) || mysql_num_rows($hron1)) {
	echo '<tr><td>';
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

echo '<br /><div><h2 style="padding-left: 15px">Участие в жизни Епархии</h2><br />';
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
	echo '</div><br /><td></tr>';
	}
#################################################


echo '</table>';

?>


</div>
<?
include 'footer.php';
?>

 </div>
</body>
</html>