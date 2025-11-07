<?
if (isset($_REQUEST[session_name()])) session_start ();
$auth=$_SESSION['auth'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?
include 'head.php';
?>
<title>Календарь епархии</title>
<style>
a {
    text-decoration:none;
	color: #222; /* цвет текста для нективной ссылки */
}
a:hover {
    text-decoration:underline;
	color: #888; /* цвет текста для нективной ссылки */
}
</style>

</head>
<body>

<div style="box-shadow: 0 0 20px rgba(0,0,0,0.5);">
<?
include 'golova.php';

include 'menu.php';

include 'content.php';
include 'function.php';

if ($_POST['submit']) {
 $month = $_POST['month'];
 $year = $_POST['year'];
}
if ($_GET['month']) {
 $month = $_GET['month'];
 $year = Date("Y");
}
?>
<div id="osnovnoe">

<h1>Календарь епархии</h1>

	<div style="text-align:center;" >
	<TABLE CELLSPACING=3 CELLPADDING=2 width='80%' align='center' border=0>
        <FORM ACTION='<? echo 'kalendar.php'; ?>' method='post'>
		<TR><TD>
						<select name='month' size=1 style="text-align:center; font-size:20px; height: 30px;">
		<option value='01' <? if (($month && $month == '01') || (empty($month) && Date("m") == '01')) echo 'selected';?>>январь</option>
		<option value='02' <? if (($month && $month == '02') || (empty($month) && Date("m") == '02')) echo 'selected';?>>февраль</option>
		<option value='03' <? if (($month && $month == '03') || (empty($month) && Date("m") == '03')) echo 'selected';?>>март</option>
		<option value='04' <? if (($month && $month == '04') || (empty($month) && Date("m") == '04')) echo 'selected';?>>апрель</option>
		<option value='05' <? if (($month && $month == '05') || (empty($month) && Date("m") == '05')) echo 'selected';?>>май</option>
		<option value='06' <? if (($month && $month == '06') || (empty($month) && Date("m") == '06')) echo 'selected';?>>июнь</option>
		<option value='07' <? if (($month && $month == '07') || (empty($month) && Date("m") == '07')) echo 'selected';?>>июль</option>
		<option value='08' <? if (($month && $month == '08') || (empty($month) && Date("m") == '08')) echo 'selected';?>>август</option>
		<option value='09' <? if (($month && $month == '09') || (empty($month) && Date("m") == '09')) echo 'selected';?>>сентябрь</option>
		<option value='10' <? if (($month && $month == '10') || (empty($month) && Date("m") == '10')) echo 'selected';?>>октябрь</option>
		<option value='11' <? if (($month && $month == '11') || (empty($month) && Date("m") == '11')) echo 'selected';?>>ноябрь</option>
		<option value='12' <? if (($month && $month == '12') || (empty($month) && Date("m") == '12')) echo 'selected';?>>декабрь</option>
		</select>
		<INPUT required pattern="\d{4}" maxlength="4" TYPE="number" value="<? if ($year) echo $year; else echo Date("Y");?>" NAME="year" style="text-align:center; font-size:20px; height: 24px;"  min="<?php echo Date("Y");?>" max="<?php echo Date("Y")+1;?>" step="1"/>

	<INPUT TYPE='submit' name='submit' value='Показать' style="text-align:center; font-size:20px; height: 30px;" />
    </TD></TR>
 </FORM>  
	</TABLE>	
	<hr /><br />
	</div>
<?php
if ($_POST['submit'] || $_GET['month']) {
 if ($month == '01') {$mon2 = 'января'; $day_all = '31';}
 if ($month == '02') {$mon2 = 'февраля'; $day_all = '29';}
 if ($month == '03') {$mon2 = 'марта'; $day_all = '31';}
 if ($month == '04') {$mon2 = 'апреля'; $day_all = '30';}
 if ($month == '05') {$mon2 = 'мая'; $day_all = '31';}
 if ($month == '06') {$mon2 = 'июня'; $day_all = '30';}
 if ($month == '07') {$mon2 = 'июля'; $day_all = '31';}
 if ($month == '08') {$mon2 = 'августа'; $day_all = '31';}
 if ($month == '09') {$mon2 = 'сентября'; $day_all = '30';}
 if ($month == '10') {$mon2 = 'октября'; $day_all = '31';}
 if ($month == '11') {$mon2 = 'ноября'; $day_all = '30';}
 if ($month == '12') {$mon2 = 'декабря'; $day_all = '31';}

	for ($d=1; $d<=$day_all; $d++)
	{
	if (strlen($d) == '1') $dd = '0'.$d; else $dd = $d;
	//АРХИЕРЕЙ
	$arhi_rozd = '12.06';
	$arhi_hiro = '10.28';
	$arhi_postrig = '11.30';
	$arhi_angel = '12.02';
	$arhi_text = '<div style="margin-bottom: 5px"><a href="/arhierei.php" target="_blank">Епископ Барышский и Инзенский Филарет</a> - ';
	
if ($month.'.'.$dd == $arhi_rozd) {
	$yy = '1963';
	$res = $year - $yy;
	$text_arhi = 'день рождения <b>'.$res.' '.yearRus($res, 'год', 'года', 'лет').'</b></div>';
	}
if ($month.'.'.$dd == $arhi_hiro) {
	$yy = '2012';
	$res = $year - $yy;
	$text_arhi = 'архиерейская хиротония <b>'.$res.' '.yearRus($res, 'год', 'года', 'лет').'</b></div>';
	}
if ($month.'.'.$dd == $arhi_postrig) {
	$yy = '1996';
	$res = $year - $yy;
	$text_arhi = 'монашеский постриг <b>'.$res.' '.yearRus($res, 'год', 'года', 'лет').'</b></div>';
	}
if ($month.'.'.$dd == $arhi_angel) {
	$text_arhi .= 'день ангела</div>';
	}
//ДНИ РОЖДЕНИЯ
	$klirik_all = mysql_query("SELECT id, name, san, rozd FROM host1409556_barysh.klir WHERE rozd LIKE '%$month.$dd' AND status LIKE 'штатный' ORDER by name ASC");
while($klirik = mysql_fetch_array($klirik_all))
{
	$yy = substr($klirik['rozd'],0,4); // Год
	$res = $year - $yy;
	$text_cal .= '<div style="margin-bottom: 5px"><a href="/klirik.php?id='.$klirik['id'].'" target="_blank">'.$klirik['san'].' '.$klirik['name'].'</a> - день рождения <b>'.$res.' '.yearRus($res, 'год', 'года', 'лет').'</b></div>';
}
	//ДИАКОНСКАЯ ХИРОТОНИЯ
	$klirik_all = mysql_query("SELECT id, name, san, diak FROM host1409556_barysh.klir WHERE diak LIKE '%$month.$dd' AND status LIKE 'штатный' ORDER by name ASC");
while($klirik = mysql_fetch_array($klirik_all))
{
	$yy = substr($klirik['diak'],0,4); // Год
	$res = $year - $yy;
	$text_cal .= '<div style="margin-bottom: 5px"><a href="/klirik.php?id='.$klirik['id'].'" target="_blank">'.$klirik['san'].' '.$klirik['name'].'</a> - диаконская хиротония <b>'.$res.' '.yearRus($res, 'год', 'года', 'лет').'</b></div>';
}
	//ИЕРЕЙСКАЯ ХИРОТОНИЯ
	$klirik_all = mysql_query("SELECT id, name, san, presv FROM host1409556_barysh.klir WHERE presv LIKE '%$month.$dd' AND status LIKE 'штатный' ORDER by name ASC");
while($klirik = mysql_fetch_array($klirik_all))
{
	$yy = substr($klirik['presv'],0,4); // Год
	$res = $year - $yy;
	$text_cal .= '<div style="margin-bottom: 5px"><a href="/klirik.php?id='.$klirik['id'].'" target="_blank">'.$klirik['san'].' '.$klirik['name'].'</a> - иерейская хиротония <b>'.$res.' '.yearRus($res, 'год', 'года', 'лет').'</b></div>';
}
	//МОНАШЕСКИЙ ПОСТРИГ
	$klirik_all = mysql_query("SELECT id, name, san, monah FROM host1409556_barysh.klir WHERE monah LIKE '%$month.$dd' AND status LIKE 'штатный' ORDER by name ASC");
while($klirik = mysql_fetch_array($klirik_all))
{
	$yy = substr($klirik['monah'],0,4); // Год
	$res = $year - $yy;
	$text_cal .= '<div style="margin-bottom: 5px"><a href="/klirik.php?id='.$klirik['id'].'" target="_blank">'.$klirik['san'].' '.$klirik['name'].'</a> - монашеский постриг <b>'.$res.' '.yearRus($res, 'год', 'года', 'лет').'</b></div>';
}	
	//ДНИ АНГЕЛА
	$klirik_all = mysql_query("SELECT id, name, san FROM host1409556_barysh.klir WHERE angel LIKE '%$dd.$month%' AND status LIKE 'штатный' ORDER by name ASC");
while($klirik = mysql_fetch_array($klirik_all))
{
	$text_cal .= '<div style="margin-bottom: 5px"><a href="/klirik.php?id='.$klirik['id'].'" target="_blank">'.$klirik['san'].' '.$klirik['name'].'</a> - день ангела</div>';
}
	//ПРЕСТОЛЫ
	$prihod_all = mysql_query("SELECT id, name FROM host1409556_barysh.prihods WHERE angel LIKE '%$dd.$month%' ORDER by name ASC");
while($prihod = mysql_fetch_array($prihod_all))
{
	$text_cal_prest .= '<div style="margin-bottom: 5px"><a href="/prihod.php?id='.$prihod['id'].'" target="_blank">'.$prihod['name'].'</a></div>';
}
	if ($text_cal || $text_cal_prest || $text_arhi) {
	echo '<div style="background: #fff; width: 95%; border: 1px solid #D7D7D7;box-shadow:2px 3px 5px #aaa; padding: 5px 10px">';
	echo '<div style="color:#005698;font-size: 130%;text-align: center; ">'.$d.' '.$mon2.'</div>'; 	
	if ($text_arhi) {echo '<br /><div id="calendar"><h2 style="padding-left: 5px; margin-bottom: 5px">Архиерей</h2>'.$arhi_text.$text_arhi.'</div>'; unset($text_arhi);}
	if ($text_cal) {echo '<br /><div id="calendar"><h2 style="padding-left: 5px; margin-bottom: 5px">Духовенство</h2>'.$text_cal.'</div>'; unset($text_cal);}
	if ($text_cal_prest) {echo '<br /><div id="calendar"><h2 style="padding-left: 5px; margin-bottom: 5px">Престольный праздник</h2>'.$text_cal_prest.'</div>'; unset($text_cal_prest);}
	echo '</div><br />';
	}
	}
	}
?>

</div>

<?
include 'footer.php';
?>

 </div>
</body>
</html>