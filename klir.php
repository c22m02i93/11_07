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
$blag_get = $_GET['blag_get'];
$alfa = $_GET['alfa'];
if ($blag_get == 'mon')  $blag_txt = '| Монастырь';
elseif ($blag_get) $blag_txt = '| '.$blag_get.' благочиние';
?>
<title>Духовенство Барышской епархии<?php if ($blag_get) echo ' '.$blag_txt; ?></title></head>
<body>

<div style="box-shadow: 0 0 20px rgba(0,0,0,0.5);">
<?
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
function sklonen($a, $string, $one, $two, $many) {

	if (substr($a, -1) == 0 || substr($a, -1) == 5 || substr($a, -1) == 6 || substr($a, -1) == 7 || substr($a, -1) == 8 || substr($a, -1) == 9) $itog = $string.$many;
if (substr($a, -1) == 1 && substr($a, -2,2) != 11) $itog = $string.$one;
if (substr($a, -2,2) == 11) $itog = $string.$many;
if (substr($a, -1) == 2 && substr($a, -2,2) != 12) $itog = $string.$two;
if (substr($a, -2,2) == 12) $itog = $string.$many;
if (substr($a, -1) == 3 && substr($a, -2,2) != 13) $itog = $string.$two;
if (substr($a, -2,2) == 13) $itog = $string.$many;
if (substr($a, -1) == 4 && substr($a, -2,2) != 14) $itog = $string.$two;
if (substr($a, -2,2) == 14) $itog = $string.$many;
return '<b>'.$a. '</b> ' . $itog;

}
include 'golova.php';
$klir = 'yes';

include 'menu.php';
mysql_connect("localhost", "host1409556", "0f7cd928"); 
mysql_query("SET NAMES 'cp1251'");
?>
<div id="content_right"> 
<div class="box"><h3>Статистика</h3>
<?php
$stat_all = mysql_query("SELECT * FROM host1409556_barysh.klir WHERE status LIKE 'штатный'");
echo 'Всего клириков: <b>'.mysql_num_rows($stat_all).'</b>';
$stat_all_stat_presv = mysql_query("SELECT * FROM host1409556_barysh.klir WHERE status LIKE 'штатный' AND presv NOT LIKE ''");
echo ' (священников: <b>'.mysql_num_rows($stat_all_stat_presv).'</b>';
$stat_all_stat_diak = mysql_query("SELECT * FROM host1409556_barysh.klir WHERE status LIKE 'штатный' AND presv LIKE ''");
echo ', диаконов: <b>'.mysql_num_rows($stat_all_stat_diak). '</b>)<br />';
$stat_all_bel = mysql_query("SELECT * FROM host1409556_barysh.klir WHERE status LIKE 'штатный' AND monah LIKE ''");
echo '<br /><hr /><br />Белое духовенство: <b>'.mysql_num_rows($stat_all_bel).'</b>';
$stat_all_bel_presv = mysql_query("SELECT * FROM host1409556_barysh.klir WHERE status LIKE 'штатный' AND presv NOT LIKE '' AND monah LIKE ''");
echo ' (свщ.: <b>'.mysql_num_rows($stat_all_bel_presv).'</b>';
$stat_all_bel_diak = mysql_query("SELECT * FROM host1409556_barysh.klir WHERE status LIKE 'штатный' AND presv LIKE '' AND monah LIKE ''");
echo ', диак.: <b>'.mysql_num_rows($stat_all_bel_diak). '</b>)<br />';
$stat_all_mon = mysql_query("SELECT * FROM host1409556_barysh.klir WHERE status LIKE 'штатный' AND monah NOT LIKE ''");
echo '<br />Монашествующие: <b>'.mysql_num_rows($stat_all_mon).'</b>';
$stat_all_mon_presv = mysql_query("SELECT * FROM host1409556_barysh.klir WHERE status LIKE 'штатный' AND presv NOT LIKE '' AND monah NOT LIKE ''");
echo ' (свщ.: <b>'.mysql_num_rows($stat_all_mon_presv).'</b>';
$stat_all_mon_diak = mysql_query("SELECT * FROM host1409556_barysh.klir WHERE status LIKE 'штатный' AND presv LIKE '' AND monah NOT LIKE ''");
echo ', диак.: <b>'.mysql_num_rows($stat_all_mon_diak). '</b>)<br />';
$stat_all_mon1 = mysql_query("SELECT * FROM host1409556_barysh.klir WHERE status LIKE 'штатный' AND monah NOT LIKE '' AND blag NOT LIKE 'mon'");
echo '&emsp; - на приходах: <b>'.mysql_num_rows($stat_all_mon1).'</b>';
$stat_all_mon_presv1 = mysql_query("SELECT * FROM host1409556_barysh.klir WHERE status LIKE 'штатный' AND presv NOT LIKE '' AND monah NOT LIKE '' AND blag NOT LIKE 'mon'");
echo ' (свщ.: <b>'.mysql_num_rows($stat_all_mon_presv1).'</b>';
$stat_all_mon_diak1 = mysql_query("SELECT * FROM host1409556_barysh.klir WHERE status LIKE 'штатный' AND presv LIKE '' AND monah NOT LIKE '' AND blag NOT LIKE 'mon'");
echo ', диак.: <b>'.mysql_num_rows($stat_all_mon_diak1). '</b>)<br />';
$stat_all_mon2 = mysql_query("SELECT * FROM host1409556_barysh.klir WHERE status LIKE 'штатный' AND monah NOT LIKE '' AND blag LIKE 'mon'");
echo '&emsp; - в монастыре: <b>'.mysql_num_rows($stat_all_mon2).'</b>';
$stat_all_mon_presv2 = mysql_query("SELECT * FROM host1409556_barysh.klir WHERE status LIKE 'штатный' AND presv NOT LIKE '' AND monah NOT LIKE '' AND blag LIKE 'mon'");
echo ' (свщ.: <b>'.mysql_num_rows($stat_all_mon_presv2).'</b>';
$stat_all_mon_diak2 = mysql_query("SELECT * FROM host1409556_barysh.klir WHERE status LIKE 'штатный' AND presv LIKE '' AND monah NOT LIKE '' AND blag LIKE 'mon'");
echo ', диак.: <b>'.mysql_num_rows($stat_all_mon_diak2). '</b>)<br />';
$stat_all_bl1 = mysql_query("SELECT * FROM host1409556_barysh.klir WHERE status LIKE 'штатный' AND blag LIKE '1'");
echo '<br /><hr /><br />1 благочиние: <b>'.mysql_num_rows($stat_all_bl1).'</b>';
$stat_all_bl1_presv = mysql_query("SELECT * FROM host1409556_barysh.klir WHERE status LIKE 'штатный' AND presv NOT LIKE '' AND blag LIKE '1'");
echo ' (свщ.: <b>'.mysql_num_rows($stat_all_bl1_presv).'</b>';
$stat_all_bl1_diak = mysql_query("SELECT * FROM host1409556_barysh.klir WHERE status LIKE 'штатный' AND presv LIKE '' AND blag LIKE '1'");
echo ', диак.: <b>'.mysql_num_rows($stat_all_bl1_diak). '</b>)<br />';
$stat_all_bl2 = mysql_query("SELECT * FROM host1409556_barysh.klir WHERE status LIKE 'штатный' AND blag LIKE '2'");
echo '2 благочиние: <b>'.mysql_num_rows($stat_all_bl2).'</b>';
$stat_all_bl2_presv = mysql_query("SELECT * FROM host1409556_barysh.klir WHERE status LIKE 'штатный' AND presv NOT LIKE '' AND blag LIKE '2'");
echo ' (свщ.: <b>'.mysql_num_rows($stat_all_bl2_presv).'</b>';
$stat_all_bl2_diak = mysql_query("SELECT * FROM host1409556_barysh.klir WHERE status LIKE 'штатный' AND presv LIKE '' AND blag LIKE '2'");
echo ', диак.: <b>'.mysql_num_rows($stat_all_bl2_diak). '</b>)<br />';
$stat_all_bl3 = mysql_query("SELECT * FROM host1409556_barysh.klir WHERE status LIKE 'штатный' AND blag LIKE '3'");
echo '3 благочиние: <b>'.mysql_num_rows($stat_all_bl3).'</b>';
$stat_all_bl3_presv = mysql_query("SELECT * FROM host1409556_barysh.klir WHERE status LIKE 'штатный' AND presv NOT LIKE '' AND blag LIKE '3'");
echo ' (свщ.: <b>'.mysql_num_rows($stat_all_bl3_presv).'</b>';
$stat_all_bl3_diak = mysql_query("SELECT * FROM host1409556_barysh.klir WHERE status LIKE 'штатный' AND presv LIKE '' AND blag LIKE '3'");
echo ', диак.: <b>'.mysql_num_rows($stat_all_bl3_diak). '</b>)<br />';
$stat_all_bl4 = mysql_query("SELECT * FROM host1409556_barysh.klir WHERE status LIKE 'штатный' AND blag LIKE '4'");
echo '4 благочиние: <b>'.mysql_num_rows($stat_all_bl4).'</b>';
$stat_all_bl4_presv = mysql_query("SELECT * FROM host1409556_barysh.klir WHERE status LIKE 'штатный' AND presv NOT LIKE '' AND blag LIKE '4'");
echo ' (свщ.: <b>'.mysql_num_rows($stat_all_bl4_presv).'</b>';
$stat_all_bl4_diak = mysql_query("SELECT * FROM host1409556_barysh.klir WHERE status LIKE 'штатный' AND presv LIKE '' AND blag LIKE '4'");
echo ', диак.: <b>'.mysql_num_rows($stat_all_bl4_diak). '</b>)<br />';
$stat_all_bl5 = mysql_query("SELECT * FROM host1409556_barysh.klir WHERE status LIKE 'штатный' AND blag LIKE '5'");
echo '5 благочиние: <b>'.mysql_num_rows($stat_all_bl5).'</b>';
$stat_all_bl5_presv = mysql_query("SELECT * FROM host1409556_barysh.klir WHERE status LIKE 'штатный' AND presv NOT LIKE '' AND blag LIKE '5'");
echo ' (свщ.: <b>'.mysql_num_rows($stat_all_bl5_presv).'</b>';
$stat_all_bl5_diak = mysql_query("SELECT * FROM host1409556_barysh.klir WHERE status LIKE 'штатный' AND presv LIKE '' AND blag LIKE '5'");
echo ', диак.: <b>'.mysql_num_rows($stat_all_bl5_diak). '</b>)<br />';
$stat_all_blmon = mysql_query("SELECT * FROM host1409556_barysh.klir WHERE status LIKE 'штатный' AND blag LIKE 'mon'");
echo 'Монастырь: <b>'.mysql_num_rows($stat_all_blmon).'</b>';
$stat_all_blmon_presv = mysql_query("SELECT * FROM host1409556_barysh.klir WHERE status LIKE 'штатный' AND presv NOT LIKE '' AND blag LIKE 'mon'");
echo ' (свщ.: <b>'.mysql_num_rows($stat_all_blmon_presv).'</b>';
$stat_all_blmon_diak = mysql_query("SELECT * FROM host1409556_barysh.klir WHERE status LIKE 'штатный' AND presv LIKE '' AND blag LIKE 'mon'");
echo ', диак.: <b>'.mysql_num_rows($stat_all_blmon_diak). '</b>)<br />';
?>
<br /></div>
</div>

<div id="osnovnoe">

<h1>Духовенство</h1>
<table width="100%" border="0" style = "margin-left: 20px">
<?
$href = 'klir';
include 'menu_klir.php';

if ($blag_get) {
		$klirik_all = mysql_query("SELECT * FROM host1409556_barysh.klir WHERE blag LIKE '$blag_get' AND status LIKE 'штатный' ORDER by name ASC");

}
elseif ($alfa) {
		$klirik_all = mysql_query("SELECT * FROM host1409556_barysh.klir WHERE status LIKE 'штатный' ORDER by name ASC");

}
else {
		$klirik_all = mysql_query("SELECT * FROM host1409556_barysh.klir WHERE status LIKE 'штатный' ORDER BY FIELD(blag, '1', '2', '3', '4', '5', 'mon'), name ASC");

}
//FIELD(san, 'Архимандрит', 'Игумен', 'Протоиерей', 'Иерей', 'Иеромонах', 'Архидиакон', 'Протодиакон', 'Иеродиакон', 'Диакон'), 
echo '<p>Показано ' . sklonen( mysql_num_rows($klirik_all), 'священнослужител', 'ь', 'я', 'ей'). '. </p>';
while($klirik = mysql_fetch_array($klirik_all)) {
echo '<tr><td>';
if (empty($alfa)) {
	if (empty($blag) || ($blag != $klirik['blag'])) {
$blag = $klirik['blag'];
echo '<br /><h3>';
if ($blag != 'mon') echo $blag.' благочиние';
elseif ($blag == 'mon') echo 'Монастырь';
echo '</h3>';
$blag_all = mysql_query("SELECT * FROM host1409556_barysh.blagochiniya WHERE blag LIKE '$blag' LIMIT 1");
$blag_text = mysql_fetch_array($blag_all);
echo $blag_text['text']. '<hr /><br />';

}
}
else echo '<br />';

if ($klirik['foto']) echo '<span class="photos"><a href="FOTO/'.$klirik['foto'].'.jpg" rel="example_group" alt= "'.$klirik[san].' '.$klirik[name].'" title="'.$klirik[san].' '.$klirik[name].'"><img style="box-shadow: 2px 2px 5px rgba(0,0,0,0.3); display: inline;float: left;border: 1px solid #C3D7D4; margin: 0 10px 5px 10px; padding: 10px" src="FOTO_MINI/'.$klirik['foto'].'.jpg" alt= "'.$klirik['san'].' '.$klirik['name'].'" title="'.$klirik['san'].' '.$klirik['name'].'"/></a></span>';
else echo '<span class="photos"><img style="width: 135px; box-shadow: 2px 2px 5px rgba(0,0,0,0.3); display: inline;float: left;border: 1px solid #C3D7D4; margin: 0 10px 5px 10px; padding: 10px" src="IMG/no_foto.jpg" alt= "'.$klirik['san'].' '.$klirik['name'].'" title="'.$klirik['san'].' '.$klirik['name'].'"/></span>';
echo '<span class="title"><a href="klirik.php?id='.$klirik['id'].'"><b>'.$klirik['name'].'</b></a><span style="color:#666"> '.$klirik['san'].'</span></span><br /><br />';
echo '<b>Дата рождения:</b> '.rus2translit($klirik['rozd']).'<br /><b>Диаконская хиротония:</b> '.rus2translit($klirik['diak']).'<br />';
if ($klirik['presv']) echo '<b>Иерейская хиротония:</b> '.rus2translit($klirik['presv']).'<br />';
//if ($klirik['monah']) echo '<b>Дата пострига:</b> '.rus2translit($klirik['monah']).'<br />';
echo '<br /><br /><br /></td></tr>';
}
?>
</table>

</div>
<?
include 'footer.php';
?>

 </div>
</body>
</html>