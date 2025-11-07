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
<title>Добавление выпуска газеты</title>

</head>
<body>

<div style="box-shadow: 0 0 20px rgba(0,0,0,0.5);">
<?
include 'golova.php';

include 'menu.php';

include 'content.php';

?>
<div id="osnovnoe">

<h1>Добавление выпуска газеты</h1>

<?php
 $submit = $_POST['submit'];
if ($submit) {
 $month = $_POST['month'];
 $text = $_POST['text'];
  $new_day_add = $_POST['new_day_add'];
 $data = Date("Y.m.d H:i");
 $year = Date("Y");

    mysql_connect("localhost", "host1409556", "0f7cd928"); 
    mysql_query("SET NAMES 'cp1251'");
	$zz = mysql_query("SELECT * FROM host1409556_barysh.gazeta");
$b = mysql_num_rows($zz);
$b= $b+1;

$xx = mysql_query("SELECT * FROM host1409556_barysh.gazeta WHERE year=$year");
$a = mysql_num_rows($xx);
$a= $a+1;
$no = "$a ($b)";
$tema = '"Моя епархия" № '.$no.' '.$month;
	   mysql_query("INSERT INTO host1409556_barysh.gazeta VALUES ('', '$data', '$year', '$month', '$no', '$text')");
	   	   if ($new_day_add == 'yes') {
		   $url = 'gazeta_show'; 
		   $kratko = 'Добавлен очередной номер газеты "Моя епархия".';
	   	   mysql_query("INSERT INTO host1409556_barysh.news VALUES ('$data', '$url', '$tema', '$kratko')");
}
echo '<p style="color:#135B00; text-align: center"><b>Газета успешно добавлена!</b></p><br />';
}
?>
	<TABLE CELLSPACING=3 CELLPADDING=2 width='400' align='center' border=0>
        <FORM ACTION='<? echo 'my_gazeta.php'; ?>' method='post'>
		<TR><TD VALIGN=top><b>Месяц:</B></TD><TD></TD></TR>
		<TR><TD colspan=2>
				<select name='month' size=1>
		<option value=январь <? if (Date("m") == '01') echo 'selected';?> >январь</option>
		<option value=февраль <? if (Date("m") == '02') echo 'selected';?>>февраль</option>
		<option value=март <? if (Date("m") == '03') echo 'selected';?>>март</option>
		<option value=апрель <? if (Date("m") == '04') echo 'selected';?>>апрель</option>
		<option value=май <? if (Date("m") == '05') echo 'selected';?>>май</option>
		<option value=июнь <? if (Date("m") == '06') echo 'selected';?>>июнь</option>
		<option value=июль <? if (Date("m") == '07') echo 'selected';?>>июль</option>
		<option value=август <? if (Date("m") == '08') echo 'selected';?>>август</option>
		<option value=сентябрь <? if (Date("m") == '09') echo 'selected';?>>сентябрь</option>
		<option value=октябрь <? if (Date("m") == '10') echo 'selected';?>>октябрь</option>
		<option value=ноябрь <? if (Date("m") == '11') echo 'selected';?>>ноябрь</option>
		<option value=декабрь <? if (Date("m") == '12') echo 'selected';?>>декабрь</option>
		</select>
		</TD></TR>
    	<TR><TD VALIGN=top><B>Код:</B></TD><TD></TD></TR>
		<TR><TD colspan=2><TEXTAREA NAME='text' COLS=55 ROWS=20></TEXTAREA></TD></TR>
			<TR><TD colspan=2><INPUT TYPE="CHECKBOX" NAME="new_day_add" VALUE ="yes" id="new_day"> <label for="new_day"><b>Выводить в новостях</b></label></TD></TR>

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