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
<title>Фото крестного хода</title>

</head>
<body>

<div style="box-shadow: 0 0 20px rgba(0,0,0,0.5);">
<?
include 'golova.php';

include 'menu.php';

include 'content.php';

?>

<div id="osnovnoe">
<h1>Фото крестного хода</h1>

<?php
	$god_today = Date("Y");

 $submit = $_POST['submit'];
if ($submit) {
 $foto = $_POST['foto'];
 $id = $_POST['id'];

 mysql_connect("localhost", "host1409556", "0f7cd928"); 
mysql_query("SET NAMES 'cp1251'");	

	
	   	mysql_query("UPDATE  host1409556_barysh.krest_hod_$god_today SET foto='$foto' WHERE id='$id'");

echo '<p style="color:#135B00; text-align: center"><b>Фото добавлены</b></p><br />';
}
?>

	<TABLE CELLSPACING=3 CELLPADDING=2 width='400' align='center' border=0>
        <FORM ACTION='my_hod_foto.php' method='post'>
		    	<TR><TD VALIGN=top><B>Населенный пункт:</B></TD><TD></TD></TR><TR><TD colspan=2>
<select name="id">
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
$itog= $ddn.' '.$mm1n;

return $itog;

}
 mysql_connect("localhost", "host1409556", "0f7cd928"); 
 	$data_today = Date("Y.m.d");
$data_yesterday = date ("Y.m.d", time() - 15*60*60*24);

	$hod_all = mysql_query("SELECT * FROM host1409556_barysh.krest_hod_$god_today where data between '$data_yesterday' and '$data_today' group BY data, pribyv");
for ($t=0; $t<mysql_num_rows($hod_all); $t++)
{
$hod = mysql_fetch_array($hod_all); 

$data_hoda = $hod['data']; echo '<option value="'.$hod[id].'">'.rus2translit($data_hoda).' - '.$hod['nas_punkt'].'</option>';
}

?>
<select>

		</TD></TR>
    	<TR><TD VALIGN=top><B>Фото:</B></TD><TD></TD></TR>
		<TR><TD colspan=2><TEXTAREA NAME='foto' COLS=55 ROWS=5></TEXTAREA></TD></TR>


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