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
?>
<title>Расписание крестного хода</title>

</head>
<body>

<div style="box-shadow: 0 0 20px rgba(0,0,0,0.5);">
<?
include 'golova.php';

include 'menu.php';

include 'content.php';

?>

<div id="osnovnoe">
<h1>Расписание крестного хода</h1>

<?php
 $submit = $_POST['submit'];
if ($submit) {
 $nas_punkt = $_POST['nas_punkt'];
 $rayon = $_POST['rayon'];
 $pribyv = $_POST['pribyv'];
 $otbyv = $_POST['otbyv'];
 $day = $_POST['day'];
 $month = $_POST['month'];
 $year = $_POST['year'];
 if (strlen($day) == '1') $day = '0'.$day;
	$p_msg = array ('/\s+/', '/^\s+/', '/\s$/');
	$r_msg = array (' ', '', '');
	$nas_punkt = preg_replace('/\./', '. ', $nas_punkt);
	$nas_punkt = preg_replace($p_msg, $r_msg, $nas_punkt);
	$pribyv = preg_replace($p_msg, $r_msg, $pribyv);
	$otbyv = preg_replace($p_msg, $r_msg, $otbyv);
	$day = preg_replace($p_msg, $r_msg, $day);
	
	if ($otbyv == '23:59') $otbyv = '24:00';

if ($rayon != '') $nas_punkt = $nas_punkt.', '.$rayon.' р-н';
$data = $year.'.'.$month.'.'.$day;
if (!preg_match_all ('/:/', $pribyv, $array_vr)) {
	$pribyv = preg_replace('/(.)(\d\d)$/', '${1}:${2}', $pribyv);
}
if (!preg_match_all ('/:/', $otbyv, $array_vr)) {
	$otbyv = preg_replace('/(.)(\d\d)$/', '${1}:${2}', $otbyv);
}
 if (strlen($pribyv) == '4') $pribyv = '0'.$pribyv;
 if (strlen($otbyv) == '4') $otbyv = '0'.$otbyv;
    mysql_connect("localhost", "host1409556", "0f7cd928"); 
	mysql_query("SET NAMES 'cp1251'");
mysql_query("INSERT INTO host1409556_barysh.krest_hod_$year VALUES ('', '$data', '$nas_punkt', '$pribyv', '$otbyv', '')");
	//echo    $data. ' '.$nas_punkt.' '.$pribyv.' '.$otbyv;
echo '<p style="color:#135B00; text-align: center"><b>Пункт добавлен</b></p><br />';
}
if ($otbyv == '24:00') $day = $day + 1 ;
?>

	<TABLE CELLSPACING=3 CELLPADDING=2 width='400' align='center' border=0>
        <FORM ACTION='my_hod.php' method='post'>
<TR><TD VALIGN=top><b>Дата:</B></TD><TD></TD></TR>
		<TR><TD colspan=2>
						
		
<INPUT TYPE="TEXT" NAME="day" SIZE=1 value="<?php echo $day; ?>" required />

				<select name='month' size=1>
		<option value="01" <? if ($month == '01') echo 'selected';?>>января</option>
		<option value="02" <? if ($month == '02') echo 'selected';?>>февраля</option>
		<option value="03" <? if ($month == '03') echo 'selected';?>>марта</option>
		<option value="04" <? if ($month == '04') echo 'selected';?>>апреля</option>
		<option value="05" <? if ($month == '05') echo 'selected';?>>мая</option>
		<option value="06" <? if ($month == '06') echo 'selected';?>>июня</option>
		<option value="07" <? if ($month == '07') echo 'selected';?>>июля</option>
		<option value="08" <? if ($month == '08') echo 'selected';?>>августа</option>
		<option value="09" <? if ($month == '09') echo 'selected';?>>сентября</option>
		<option value="10" <? if ($month == '10') echo 'selected';?>>октября</option>
		<option value="11" <? if ($month == '11') echo 'selected';?>>ноября</option>
		<option value="12" <? if ($month == '12') echo 'selected';?>>декабря</option>
		</select>
		<INPUT TYPE="TEXT" value="<? echo Date("Y");?>" NAME="year" SIZE=2/>
		</TD></TR>
		
		<TR><TD colspan=2><B>Населенный пункт:</B></TD></TR>
		<TR><TD><INPUT TYPE="TEXT" NAME="nas_punkt" SIZE=40 required /></TD><TD>
		<select name='rayon' size=1>
		<?php
		$array_rayon = array('', 'Базарносызганский', 'Барышский', 'Вешкаймский', 'Инзенский', 'Карсунский', 'Кузоватовский', 'Майнский', 'Мелекесский', 'Николаевский', 'Новомалыклинский', 'Новоспасский', 'Павловский', 'Радищевский', 'Сенгилеевский', 'Старокулаткинский', 'Старомайнский', 'Сурский', 'Тереньгульский', 'Ульяновский', 'Цильнинский', 'Чердаклинский');
		foreach ($array_rayon as $value) {
			echo '<option value="'.$value.'"'; 
			if ($rayon == $value) echo ' selected';
			echo '>'.$value.'</option>';
		}
		?>
		</select>
		</TD></TR>
    	<TR><TD VALIGN=top><B>Прибытие:</B></TD><TD VALIGN=top><B>Отправление:</B></TD></TR>
		<TR><TD><INPUT TYPE="time" NAME="pribyv" required /></TD><TD><INPUT TYPE="time" NAME="otbyv" required /></TD></TR>


	<TR><TD colspan=2>
	<INPUT TYPE='submit' name='submit' value='Добавить' />
        <INPUT TYPE='reset' value='Очистить'></TD></TR>
 </FORM>  

	</TABLE>	









</div>

<?
include 'footer.php';
?>

 </div>
</body>
</html>