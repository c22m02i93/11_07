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
<title>Барышская епархия</title>

</head>
<body>

<div style="box-shadow: 0 0 20px rgba(0,0,0,0.5);">
<?php
include 'golova.php';
include 'menu.php';
include 'function.php';
?>

<div id="content_right" style="margin-top: 10px"> 
<div style="text-align:center"><a href="//www.yandex.ru/?add=178939&from=promocode">Наш новостной виджет на <span style="color:red">Я</span><span style="color:#000">ндекс</span></a></div><br />
<?
 mysql_connect("localhost", "host1409556", "0f7cd928"); 
mysql_query("SET NAMES 'cp1251'");

	$news_day = mysql_query("SELECT * FROM host1409556_barysh.news_day");

	$new_day = mysql_fetch_array($news_day); 
$dtn_day = $new_day['data']; 

	####################################### Крестный ход сейчас
	$data_today = Date("Y.m.d");
	$chas_today = Date("H:i");
	$god_today = Date("Y");

	$hod_all = mysql_query("SELECT * FROM host1409556_barysh.krest_hod_$god_today where data = '$data_today' ORDER BY pribyv ASC");
	
	$hod_all = 0; // fixme
	
	if (mysql_num_rows($hod_all) > 0) {
		
		echo '<div style="background: #fff; width: 90%; border: 1px solid #D7D7D7;box-shadow:2px 3px 5px #aaa; padding: 5px 10px">';
		echo '<div class="title" style="text-align: center"><b>Где сейчас крестный ход</b></div><hr />';
			for ($t=0; $t<mysql_num_rows($hod_all); $t++)
			{
			$hod = mysql_fetch_array($hod_all); 
			
			if ($hod['pribyv'] == '00:00' && $hod['otbyv'] == '24:00') 
				$pribyv_otbyv = 'Весь день ';
/* 			elseif ($hod['pribyv'] == '00:00') 
				$pribyv_otbyv = 'До '.$hod['otbyv'].' &#8195;  &#8195; ';
			elseif ($hod['otbyv'] == '24:00') 
				$pribyv_otbyv = 'С '.$hod['pribyv'].' &#8195;  &#8195; ';
 */			
			else
				$pribyv_otbyv = $hod['pribyv'].' - '.$hod['otbyv'].' ';


			if ($chas_today > $hod['otbyv']) echo '<span style="color: #aaa"><b>'.$pribyv_otbyv.'</b> '.$hod['nas_punkt'].'</span><br />'; 
			elseif ($chas_today < $hod['pribyv']) echo '<b>'.$pribyv_otbyv.'</b> '.$hod['nas_punkt'].'<br />';
			else echo '<div style="width:100%; background:#F8FCBE"><b>'.$pribyv_otbyv.'</b> '.$hod['nas_punkt'].'</div>';
			}
		echo '<hr /><div style="text-align: center"><a href="hod.php?year='.$god_today.'#'.$data_today.'">Полное расписание и фотоотчеты</a></div><br /></div><br /><br />';

	}
#######################################

####################################### Календарь епархии
	$day_today = Date("d");	
	$month_today = Date("m");
	
 if ($month_today == '01') {$mon2 = 'января';}
 if ($month_today == '02') {$mon2 = 'февраля';}
 if ($month_today == '03') {$mon2 = 'марта';}
 if ($month_today == '04') {$mon2 = 'апреля';}
 if ($month_today == '05') {$mon2 = 'мая';}
 if ($month_today == '06') {$mon2 = 'июня';}
 if ($month_today == '07') {$mon2 = 'июля';}
 if ($month_today == '08') {$mon2 = 'августа';}
 if ($month_today == '09') {$mon2 = 'сентября';}
 if ($month_today == '10') {$mon2 = 'октября';}
 if ($month_today == '11') {$mon2 = 'ноября';}
 if ($month_today == '12') {$mon2 = 'декабря';}

$dd_today = $day_today;
if ($day_today == "01") $dd_today="1";
if ($day_today == "02") $dd_today="2";
if ($day_today == "03") $dd_today="3";
if ($day_today == "04") $dd_today="4";
if ($day_today == "05") $dd_today="5";
if ($day_today == "06") $dd_today="6";
if ($day_today == "07") $dd_today="7";
if ($day_today == "08") $dd_today="8";
if ($day_today == "09") $dd_today="9";
	//АРХИЕРЕЙ
	$arhi_rozd = '12.06';
	$arhi_hiro = '10.28';
	$arhi_postrig = '11.30';
	$arhi_angel = '12.02';
	$arhi_text = '<div style="margin-bottom: 5px"><a href="/arhierei.php" target="_blank">Епископ Барышский и Инзенский Филарет</a> - ';
	
if ($month_today.'.'.$day_today == $arhi_rozd) {
	$yy = '1963';
	$res = $god_today - $yy;
	$text_arhi = 'день рождения <b>'.$res.' '.yearRus($res, 'год', 'года', 'лет').'</b></div>';
	}
if ($month_today.'.'.$day_today == $arhi_hiro) {
	$yy = '2012';
	$res = $god_today - $yy;
	$text_arhi = 'архиерейская хиротония <b>'.$res.' '.yearRus($res, 'год', 'года', 'лет').'</b></div>';
	}
if ($month_today.'.'.$day_today == $arhi_postrig) {
	$yy = '1996';
	$res = $god_today - $yy;
	$text_arhi = 'монашеский постриг <b>'.$res.' '.yearRus($res, 'год', 'года', 'лет').'</b></div>';
	}
if ($month_today.'.'.$day_today == $arhi_angel) {
	$text_arhi .= 'день ангела</div>';
	}
	//ДНИ РОЖДЕНИЯ
	$klirik_all = mysql_query("SELECT id, name, san, rozd FROM host1409556_barysh.klir WHERE rozd LIKE '%$month_today.$day_today' AND status LIKE 'штатный' ORDER by name ASC");
while($klirik = mysql_fetch_array($klirik_all))
{
	$yy = substr($klirik['rozd'],0,4); // Год
	$res = $god_today - $yy;
	$text_cal .= '<div style="margin-bottom: 5px"><a href="/klirik.php?id='.$klirik['id'].'" target="_blank">'.$klirik['san'].' '.$klirik['name'].'</a> - день рождения <b>'.$res.' '.yearRus($res, 'год', 'года', 'лет').'</b></div>';
}
	//ДИАКОНСКАЯ ХИРОТОНИЯ
	$klirik_all = mysql_query("SELECT id, name, san, diak FROM host1409556_barysh.klir WHERE diak LIKE '%$month_today.$day_today' AND status LIKE 'штатный' ORDER by name ASC");
while($klirik = mysql_fetch_array($klirik_all))
{
	$yy = substr($klirik['diak'],0,4); // Год
	$res = $god_today - $yy;
	$text_cal .= '<div style="margin-bottom: 5px"><a href="/klirik.php?id='.$klirik['id'].'" target="_blank">'.$klirik['san'].' '.$klirik['name'].'</a> - диаконская хиротония <b>'.$res.' '.yearRus($res, 'год', 'года', 'лет').'</b></div>';
}
	//ИЕРЕЙСКАЯ ХИРОТОНИЯ
	$klirik_all = mysql_query("SELECT id, name, san, presv FROM host1409556_barysh.klir WHERE presv LIKE '%$month_today.$day_today' AND status LIKE 'штатный' ORDER by name ASC");
while($klirik = mysql_fetch_array($klirik_all))
{
	$yy = substr($klirik['presv'],0,4); // Год
	$res = $god_today - $yy;
	$text_cal .= '<div style="margin-bottom: 5px"><a href="/klirik.php?id='.$klirik['id'].'" target="_blank">'.$klirik['san'].' '.$klirik['name'].'</a> - иерейская хиротония <b>'.$res.' '.yearRus($res, 'год', 'года', 'лет').'</b></div>';
}
	//МОНАШЕСКИЙ ПОСТРИГ
	$klirik_all = mysql_query("SELECT id, name, san, monah FROM host1409556_barysh.klir WHERE monah LIKE '%$month_today.$day_today' AND status LIKE 'штатный' ORDER by name ASC");
while($klirik = mysql_fetch_array($klirik_all))
{
	$yy = substr($klirik['monah'],0,4); // Год
	$res = $god_today - $yy;
	$text_cal .= '<div style="margin-bottom: 5px"><a href="/klirik.php?id='.$klirik['id'].'" target="_blank">'.$klirik['san'].' '.$klirik['name'].'</a> - монашеский постриг <b>'.$res.' '.yearRus($res, 'год', 'года', 'лет').'</b></div>';
}	
	//ДНИ АНГЕЛА
	$klirik_all = mysql_query("SELECT id, name, san FROM host1409556_barysh.klir WHERE angel LIKE '%$day_today.$month_today%' AND status LIKE 'штатный' ORDER by name ASC");
while($klirik = mysql_fetch_array($klirik_all))
{
	$text_cal .= '<div style="margin-bottom: 5px"><a href="/klirik.php?id='.$klirik['id'].'" target="_blank">'.$klirik['san'].' '.$klirik['name'].'</a> - день ангела</div>';
}
		//ПРЕСТОЛЫ
	$prihod_all = mysql_query("SELECT id, name FROM host1409556_barysh.prihods WHERE angel LIKE '%$day_today.$month_today%' ORDER by name ASC");
while($prihod = mysql_fetch_array($prihod_all))
{
	$text_cal_prest .= '<div style="margin-bottom: 5px"><a href="/prihod.php?id='.$prihod['id'].'" target="_blank">'.$prihod['name'].'</a></div>';
}
	
	echo '<div style="background: #fff; width: 90%; border: 1px solid #D7D7D7;box-shadow:2px 3px 5px #aaa; padding: 5px 10px">';
	echo '<div class="title" style="text-align: center"><b>Календарь епархии</b></div><hr />';
	echo '<div style="color:red;font-size: 110%; text-align: center; ">'.$dd_today.' '.$mon2.'</div><br />'; 	
	if ($text_arhi) echo '<div id="calendar"><h2 style="padding-left: 5px; margin-bottom: 5px">Архиерей</h2>'.$arhi_text.$text_arhi.'</div>';
	if ($text_cal) echo '<div id="calendar"><h2 style="padding-left: 5px; margin-bottom: 5px">Духовенство</h2>'.$text_cal.'</div>';
	if ($text_cal_prest) echo '<div id="calendar"><h2 style="padding-left: 5px; margin-bottom: 5px">Престольный праздник</h2>'.$text_cal_prest.'</div>';
	if (empty($text_cal) && empty($text_cal_prest) && empty($text_arhi)) {
		echo '<p>Сегодня событий нет</p><br />';
}
	echo '<hr /><div style="text-align: center"><a style="color: #666" href="/kalendar.php?month='.$month_today.'">Весь календарь</a></div><br /></div><br /><br />';
#######################################
?>
<!--<div style="text-align: center"><a href="pyatino.php" ><img style="width: 80%; margin: 0 auto" src="/IMG/pyatino.png" border="0" /></a><br /><br />
</div>
-->
<div style="text-align: center"><a href="/prihod.php?id=21" ><img style="width: 80%; margin: 0 auto" src="/IMG/glotovka.png" border="0" /></a><br /><br />
</div>
<div style="text-align: center"><a href="/saints.php" ><img style="width: 80%; margin: 0 auto" src="/IMG/saints.png" border="0" /></a><br /><br />
</div>
<!--<div style="text-align: center"><a href="telemakov.php" ><img style="width: 80%; margin: 0 auto" src="/IMG/telemakov.png" border="0" /></a><br /><br />
</div>
-->
<div style="text-align: center"><a href="hod.php" ><img style="width: 80%; margin: 0 auto" src="/IMG/hod.png" border="0" /></a><br /><br />
</div>

<?	$news_all_r = mysql_query("SELECT * FROM host1409556_barysh.raspisanie where data between '$data_today' and '9999.12.31' ORDER BY data ASC LIMIT 1");

$news_r = mysql_fetch_array($news_all_r); 
if ($news_r[text]) echo '<h2 style="border-bottom: 5px solid #E6E0C6;"><a style="color: #7A6D42;border-bottom: 5px solid #E6E0C6;" href="raspisanie.php">Архиерейское служение</a></h2><br />';


		$news_all = mysql_query("SELECT * FROM host1409556_barysh.raspisanie where data between '$data_today' and '9999.12.31' ORDER BY data ASC, (text+0) ASC LIMIT 3");
for ($t=0; $t<mysql_num_rows($news_all); $t++)
{
$news = mysql_fetch_array($news_all); 
echo '<div class="box_arhi">

<h3>'.$news[data_text].' - '.$news[nedel].'</h3>';
	$patterns = array ('/\n/', '/(\d{1,2}:\d{2})/');
	$replace = array ('</p><p>', '<b>${1}</b>');
	$text = preg_replace($patterns, $replace, $news[text]);

echo '<p>'.$text.'</p><br />
 </div>
  <br />
';
}

if ($news_r[text]) echo '<br />';

?>

<h2 style=" border-bottom: 5px solid #F0D0C8;"><a style="color: #A35241;border-bottom: 5px solid #F0D0C8;" href="anons.php">Анонсы и объявления</a></h2>
<br />

 <?   mysql_connect("localhost", "host1409556", "0f7cd928"); 
	$news_all = mysql_query("SELECT * FROM host1409556_barysh.anons WHERE data != '$dtn_day' ORDER BY data DESC LIMIT 2");
	for ($t=0; $t<mysql_num_rows($news_all); $t++)
{
$news = mysql_fetch_array($news_all); 

$dtn = $news[data]; 
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
if ($mmn == "09") $mm1n="сен.";
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

	$patterns = array ('/\n/');
	$replace = array ('</p><p>');
	$text = preg_replace($patterns, $replace, $news[kratko]);

echo '<div class="box"><h3>'.$news[when].'</h3>';
echo '<div style="margin-left: 10px"><span class="title"><a href="anons_show.php?data='.$news[data].'">'.$news[tema].'</a></span><br />'.$ddttn.'<span style="color: #777"> <img src="IMG/views.png" /> '.$news['views'].'</span></div><br />';

echo '<p>'.$text.'</p></div><br />';
}
?>

<br />
<h2> <a href="slovo_padre.php">Слово архипастыря</a></h2>
<br />
 <?   mysql_connect("localhost", "host1409556", "0f7cd928"); 
 	$news_all = mysql_query("SELECT * FROM host1409556_barysh.padre WHERE data != '$dtn_day' ORDER BY data DESC LIMIT 2");
	for ($t=0; $t<mysql_num_rows($news_all); $t++)
{
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
	$patterns = array ('/(?:\{{3})(http:\/\/[^\s\[<\(\)\|]+)(?:\}{3})-(?:\{{3})([^}]+)(?:\}{3})/i', '/\n/', '/(?:\/{3})/', '/(?:\|{3})/', '/@[^@]+@/', '/(?:\{{3})/', '/(?:\}{3})/', '/\[/', '/\]/');
	$replace = array ('${2}', '</p><p>', '', '', '', '', '', '', '');

	$news[text] = preg_replace($patterns, $replace, $news[text]);
	 if (preg_match_all ("/[^\t]{250}/", $news[text], $massiv_news)) {
	   $text = $massiv_news[0][0].'... <a href="slovo_padre_show.php?data='.$news[data].'">(читать далее)</a>';}
	   else $text = $news[text];


echo '<div style="margin-left: 5px; margin-right: 10px"><span class="title"><a href="slovo_padre_show.php?data='.$news[data].'">'.$news[tema].'</a></span><br />'.$ddttn.'<span style="color: #777"> <img src="IMG/views.png" /> '.$news['views'].'</span></div><br />';
if ($t == '1') echo '<div style="float: left; margin-bottom: 5px; margin-right: 10px">';
else echo '<div style="float: left; margin-bottom: 5px; margin-right: 10px; border-bottom: 1px #D7D7D7 solid">';

if ($news[img]) echo '<a href="slovo_padre_show.php?data='.$news[data].'"><img style="box-shadow: 2px 2px 5px rgba(0,0,0,0.3); display: inline;float: left;border: 1px solid #C3D7D4; margin: 0 10px 5px 10px; padding: 10px " src="IMG/'.$news[img].'.jpg" /></a>';

echo '<p>'.$text.'<br /><br /></p></div>';

}
?>


<br />
<!--<h2>Карта приходов</h2>
<br />
<a href="http://www.barysh-eparhia.ru/map.php"><CENTER><img style="border: #BEC7BE 1px solid; width: 75%; margin: 0 auto" src="IMG/map.png" /></CENTER></a><br />
-->
<div style="text-align: center">
<a href="http://ekzeget.ru/" target="_blank" ><img style="width: 75%; margin: 0 auto" src="/IMG/ekzeget.png" border="0" /></a><br />
</div>
<br />
</div>

<div id="osnovnoe" style="margin-top:10px">

<div id="new_day">

 <?   
  ############################ НОВОСТЬ ДНЯ 
 

$yyn = substr($dtn_day,0,4); // Год
$mmn = substr($dtn_day,5,2); // Месяц
$ddn = substr($dtn_day,8,2); // День

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

$hours = substr($dtn_day,11,5); // Время 

$ddttn = '<span class="date">'.$ddn.' '.$mm1n.' '.$yyn.' г. '.$hours.'</span>'; // Конечный вид строки

	$patterns = array ('/(?:\{{3})(http:\/\/[^\s\[<\(\)\|]+)(?:\}{3})-(?:\{{3})([^}]+)(?:\}{3})/i', '/\n/', '/(?:\/{3})/', '/(?:\|{3})/', '/@[^@]+@/', '/(?:\{{3})/', '/(?:\}{3})/', '/\[/', '/\]/');
	$replace = array ('${2}', '</p><p>', '', '', '', '', '', '', '');

	$text = preg_replace($patterns, $replace, $new_day[text]);
	   

if ($new_day[oblozka]) echo '<div style="box-shadow: 2px 2px 5px rgba(0,0,0,0.3); display: inline;float: left;border: 1px solid #C3D7D4; margin: 0 10px 5px 10px; padding: 10px" ><a href="'.$new_day[page].'_show.php?data='.$new_day[data].'"><img src="DAY/'.$new_day[oblozka].'.jpg" /></a></div>';
echo '<div class="block_title"><span class="title"><a href="'.$new_day[page].'_show.php?data='.$new_day[data].'">'.$new_day[tema].'</a></span><br />'.$ddttn;
 echo '<span style="color: #777">';
 if ($new_day['page'] == 'news') {	$newvid = mysql_query("SELECT * FROM host1409556_barysh.news_eparhia WHERE data = '$dtn_day'");
 $newvid = mysql_fetch_array($newvid); 
 if ($newvid['video']) echo ' (+ Видео)';
  echo ' <img src="IMG/views.png" /> '.$newvid['views'].'</span>';
}
if ($new_day['page'] == 'anons') {	$newvid = mysql_query("SELECT * FROM host1409556_barysh.anons WHERE data = '$dtn_day'");
 $newvid = mysql_fetch_array($newvid); 
  echo ' <img src="IMG/views.png" /> '.$newvid['views'].'</span>';
}
if ($new_day['page'] == 'pub') {	$newvid = mysql_query("SELECT * FROM host1409556_barysh.publikacii WHERE data = '$dtn_day'");
 $newvid = mysql_fetch_array($newvid); 
  echo ' <img src="IMG/views.png" /> '.$newvid['views'].'</span>';
}
if ($new_day['page'] == 'slovo_padre') {	$newvid = mysql_query("SELECT * FROM host1409556_barysh.padre WHERE data = '$dtn_day'");
 $newvid = mysql_fetch_array($newvid); 
  echo ' <img src="IMG/views.png" /> '.$newvid['views'].'</span>';
}

echo '</div><br /><p>'.$text.'</p>';

$page_news_day = $new_day[page]; 
?>
</div>
<!----------------------------------------------------------

<div style="text-align:center; margin: 24px 0;"><a href="http://sobor.patriarchia.ru/"><img src="http://www.patriarchia.ru/images/sobor/Arch_sobor2017_580.gif" alt="Архиерейский Собор Русской Православной Церкви 2017 г." title="Архиерейский Собор Русской Православной Церкви 2017 г." style="padding-right: 5%;"></a></div>
------------------------------------------------------------->

<br />

<div class="index_block">
<h2><a href="news.php">Новости епархии</a></h2>
<br />

 <?   mysql_connect("localhost", "host1409556", "0f7cd928"); 
 	$news_all = mysql_query("SELECT * FROM host1409556_barysh.news_eparhia WHERE data != '$dtn_day' ORDER BY data DESC LIMIT 3");
	for ($t=0; $t<mysql_num_rows($news_all); $t++)
{
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
	$patterns = array ('/(?:\{{3})(http:\/\/[^\s\[<\(\)\|]+)(?:\}{3})-(?:\{{3})([^}]+)(?:\}{3})/i', '/\n/', '/(?:\/{3})/', '/(?:\|{3})/', '/@[^@]+@/', '/(?:\{{3})/', '/(?:\}{3})/');
	$replace = array ('${2}', '</p><p>', '', '', '', '', '');

	$text = preg_replace($patterns, $replace, $news[kratko]);

echo '<div style="margin-left: 5px;"><span class="title"><a href="news_show.php?data='.$news[data].'">'.$news[tema].'</a></span><br />'.$ddttn;
 echo '<span style="color: #777">';
 if ($news['video']) echo ' (+ Видео)';
 echo ' <img src="IMG/views.png" /> '.$news['views'].'</span>';

echo '</div><br /><div style="float: left; border-bottom: 1px #D7D7D7 solid; margin-bottom: 5px">';

if ($news[oblozka]) echo '<a href="news_show.php?data='.$news[data].'"><img style="box-shadow: 2px 2px 5px rgba(0,0,0,0.3); display: inline;float: left;border: 1px solid #C3D7D4; margin: 0 10px 5px 10px; padding: 10px " src="FOTO_MINI/'.$news[oblozka].'.jpg" /></a>';

echo '<p>'.$text.'<br /><br /></p></div>';
}
?>

</div>	

<div class="index_block">
<h2><a href="pub.php">Публикации</a></h2>
<br />

 <?   mysql_connect("localhost", "host1409556", "0f7cd928"); 
 	$pub_all = mysql_query("SELECT * FROM host1409556_barysh.publikacii WHERE data != '$dtn_day' ORDER BY data DESC LIMIT 3");
	for ($t=0; $t<mysql_num_rows($pub_all); $t++)
{
$pub = mysql_fetch_array($pub_all); 

$dtn = $pub[data]; 
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
	$patterns = array ('/(?:\{{3})(http:\/\/[^\s\[<\(\)\|]+)(?:\}{3})-(?:\{{3})([^}]+)(?:\}{3})/i', '/\n/', '/(?:\/{3})/', '/(?:\|{3})/', '/@[^@]+@/', '/(?:\{{3})/', '/(?:\}{3})/');
	$replace = array ('${2}', '</p><p>', '', '', '', '', '');

	$text = preg_replace($patterns, $replace, $pub[kratko]);

echo '<div style="margin-left: 5px;"><span class="title"><a href="pub_show.php?data='.$pub[data].'">'.$pub[tema].'</a></span><br />'.$ddttn.'<span style="color: #777"> <img src="IMG/views.png" /> '.$pub['views'].'</span></div><br /><div style="float: left; border-bottom: 1px #D7D7D7 solid; margin-bottom: 5px">';

if ($pub[oblozka]) echo '<a href="pub_show.php?data='.$pub[data].'"><img style="box-shadow: 2px 2px 5px rgba(0,0,0,0.3); display: inline;float: left;border: 1px solid #C3D7D4; margin: 0 10px 5px 10px; padding: 10px " src="FOTO_MINI/'.$pub[oblozka].'.jpg" /></a>';

echo '<p>'.$text.'<br /><br /></p></div>';
}
?>


</div>	
<!-- <div class="index_block_padre">
<h2><a href="doks.php">Документы</a></h2>
<br />

 <?   
 $news_all = mysql_query("SELECT * FROM host1409556_barysh.doks ORDER BY date DESC LIMIT 4");
 for ($t=0; $t<mysql_num_rows($news_all); $t++)
{
$news = mysql_fetch_array($news_all); 

$dtn = $news[date]; 
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

$ddttn = $ddn.' '.$mm1n.' '.$yyn.' г.'; // Конечный вид строки
	$patterns = array ('/(?:\{{3})(http:\/\/[^\s\[<\(\)\|]+)(?:\}{3})-(?:\{{3})([^}]+)(?:\}{3})/i', '/\n/', '/\{/', '/\}/');
	$replace = array ('${2}', '</p><p>', '', '');

	$text = preg_replace($patterns, $replace, $news[text]);
echo '<div style="margin-left: 5px;"><span class="title">';
if ($news[tematika] == 'ukaz') echo 'Указ';
if ($news[tematika] == 'raspor') echo 'Распоряжение';
if ($news[tematika] == 'cirk') echo 'Циркуляр';
if ($news[tematika] == 'udostoverenie') echo 'Удостоверение о рукоположении в сан '.$news[name];
echo ' № '.$news[nomer].' от '.$ddttn.'</span><br />';
if ($news[tematika] != 'udostoverenie') echo '<div style="padding-left: 25%; float:right; text-align: right; margin-top: 5px; margin-bottom: 5px"><i>'.$news[name].'</i></div><br /><br />';
echo '</div><div style="border-bottom: 1px #D7D7D7 solid; margin-top: 5px; margin-bottom: 5px">';

if (preg_match_all ("/^[^\t]{350}/", $news[text], $massiv_news)) {
	 	$patterns = array ('/(?:\{{3})(http:\/\/[^\s\[<\(\)\|]+)(?:\}{3})-(?:\{{3})([^}]+)(?:\}{3})/i', '/\{/', '/\}/');
	$replace = array ('${2}', '', '');

	$text = preg_replace($patterns, $replace, $massiv_news[0][0]);
  $text = $text.'... <a href="doks_show.php?tip='.$news[tematika].'&data='.$news[date].'">(читать далее)</a>';
  	$text = preg_replace('/\n/', '</p><p>', $text);

  }

echo '<p>'.$text.'<br /><br /></p></div>';

}
?>

</div>	 -->
<div class="index_block_padre">

<h2><a href="video.php">Видео</a></h2>
<br />

<div style="text-align: center">
<?
 	$vid_all = mysql_query("SELECT * FROM host1409556_barysh.video ORDER by id DESC LIMIT 2");
		for ($t=0; $t<mysql_num_rows($vid_all); $t++)
{
$vid = mysql_fetch_array($vid_all); 
$dtn = $vid[data]; 
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
$news_all_wer = mysql_query("SELECT * FROM host1409556_barysh.news_eparhia WHERE video = '$vid[kod]'");
$news_wer = mysql_fetch_array($news_all_wer); 
	$patterns = array ('/width="46\%"/');
	$replace = array ('width="100%"');
	$vid['kod'] = preg_replace($patterns, $replace, $vid['kod']);

if ($news_wer[data]) echo '<div class="index_block" style="text-align: left"><div style="margin-left: 5px;"><span class="title"><a href="news_show.php?data='.$news_wer[data].'">'.$vid[tema].'</a></span>';
else echo '<div class="index_block" style="text-align: left"><div style="margin-left: 5px;"><span class="title">'.$vid[tema].'</span>';
echo '<br />'.$ddttn.'<br /><br />'.$vid['kod'].'</div></div>';

}
?>

</div>

<br />
</div>	
<div class="index_block_padre">
<div style="text-align: center">
<br />
<SCRIPT language=JavaScript src="http://www.eparhia.ru/sinfo.asp?i=3"></SCRIPT>
</div>	
</div>	
<br />

</div>	
<br />

<?
include 'footer.php';
?>
</div>

</body>
</html>