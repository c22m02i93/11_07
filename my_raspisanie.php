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
<title>Расписание архиерейских служб</title>

</head>
<body>

<div style="box-shadow: 0 0 20px rgba(0,0,0,0.5);">
<?
include 'golova.php';

include 'menu.php';

include 'content.php';

?>

<div id="osnovnoe">
<h1>Расписание архиерейских служб</h1>

<?php
 $submit = $_POST['submit'];
if ($submit) {
 $sluzba = $_POST['sluzba'];
 $hram = $_POST['hram'];
 $data = $_POST['data'];
 $month = $_POST['month'];
 $year = $_POST['year'];

 if ($month == 'января') $mon2 = '01';
 if ($month == 'февраля') $mon2 = '02';
 if ($month == 'марта') $mon2 = '03';
 if ($month == 'апреля') $mon2 = '04';
 if ($month == 'мая') $mon2 = '05';
 if ($month == 'июня') $mon2 = '06';
 if ($month == 'июля') $mon2 = '07';
 if ($month == 'августа') $mon2 = '08';
 if ($month == 'сентября') $mon2 = '09';
 if ($month == 'октября') $mon2 = '10';
 if ($month == 'ноября') $mon2 = '11';
 if ($month == 'декабря') $mon2 = '12';

 $data_s = preg_replace('/^(\d)$/', '0${1}', $data);
 $time = $year.'.'.$mon2.'.'.$data_s;
 $time2 = $data_s.'.'.$mon2.'.'.$year;
$data = "$data $month";


// массив с названиями дней недели
 $days = array('ВС' , 'ПН' , 'ВТ' , 'СР' , 'ЧТ' , 'ПТ' , 'СБ' );
// номер дня недели
// с 0 до 6, 0 - воскресенье, 6 - суббота
$num_day = (date('w', strtotime("$time2")));
// получаем название дня из массива
$nedel = $days[$num_day];

  mysql_connect("localhost", "host1409556", "0f7cd928"); 
	mysql_query("SET NAMES 'cp1251'");
		$news_all = mysql_query("SELECT * FROM host1409556_barysh.prihods WHERE name = '$hram'");
	$pr = mysql_fetch_array($news_all);
if ($pr[name]) $text = $sluzba.'. <a href="prihod.php?id='.$pr[id].'">'.$hram.'</a>';
elseif ($hram == 'Жадовский монастырь') $text = $sluzba.'. <a href="mon.php">Жадовский монастырь</a>';
else $text= $sluzba.'. '.$hram;

  	$patterns = array ('/великомученика/', '/святителя/', '/мучениц/', '/святого/', '/святых/', '/священномученика/', '/равноапостольных/', '/апостола/', '/преподобного/');
	$replace = array ('вмч.', 'свт.', 'мц.', 'св.', 'свв.', 'сщмч.', 'равноап.', 'ап.', 'прп.');
	$text = preg_replace($patterns, $replace, $text);

mysql_query("INSERT INTO host1409556_barysh.raspisanie VALUES ('$time', '$data','$nedel', '$text', '', '')");
	   

echo '<p style="color:#135B00; text-align: center"><b>Расписание добавлено</b></p><br />';
}
?>

	<TABLE CELLSPACING=3 CELLPADDING=2 width='400' align='center' border=0>
        <FORM ACTION='<? echo 'my_raspisanie.php'; ?>' method='post'>
		<TR><TD VALIGN=top><b>Дата:</B></TD><TD></TD></TR>
		<TR><TD colspan=2>
						
		
<INPUT TYPE="TEXT" NAME="data" SIZE=1/>

				<select name='month' size=1>
		<option value=января <? if (Date("m") == '01') echo 'selected';?> >января</option>
		<option value=февраля <? if (Date("m") == '02') echo 'selected';?>>февраля</option>
		<option value=марта <? if (Date("m") == '03') echo 'selected';?>>марта</option>
		<option value=апреля <? if (Date("m") == '04') echo 'selected';?>>апреля</option>
		<option value=мая <? if (Date("m") == '05') echo 'selected';?>>мая</option>
		<option value=июня <? if (Date("m") == '06') echo 'selected';?>>июня</option>
		<option value=июля <? if (Date("m") == '07') echo 'selected';?>>июля</option>
		<option value=августа <? if (Date("m") == '08') echo 'selected';?>>августа</option>
		<option value=сентября <? if (Date("m") == '09') echo 'selected';?>>сентября</option>
		<option value=октября <? if (Date("m") == '10') echo 'selected';?>>октября</option>
		<option value=ноября <? if (Date("m") == '11') echo 'selected';?>>ноября</option>
		<option value=декабря <? if (Date("m") == '12') echo 'selected';?>>декабря</option>
		</select>
		<INPUT TYPE="TEXT" value="<? echo Date("Y");?>" NAME="year" SIZE=2/>

		</TD></TR>

    	<TR><TD VALIGN=top><B>Время и служба:</B></TD><TD></TD></TR>
		<TR><TD colspan=2><INPUT TYPE="TEXT" NAME="sluzba" SIZE=40/></TD></TR>
    	<TR><TD VALIGN=top><B>Храм:</B></TD><TD></TD></TR>
		<TR><TD colspan=2><INPUT TYPE="TEXT" NAME="hram" SIZE=40 list="hrams" /></TD></TR>

		<datalist id="hrams">
		<?
		 mysql_connect("localhost", "host1409556", "0f7cd928"); 
	$news_all = mysql_query("SELECT * FROM host1409556_barysh.prihods ORDER BY name");
	for ($tr=0; $tr<mysql_num_rows($news_all); $tr++)
{	$pr = mysql_fetch_array($news_all);
echo '<option value="'.$pr[name].'">';
}
		?>
		<option value="Жадовский монастырь">
</datalist>

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