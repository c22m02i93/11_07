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
<title>Добавление видео</title>

</head>
<body>

<div style="box-shadow: 0 0 20px rgba(0,0,0,0.5);">
<?
include 'golova.php';

include 'menu.php';

include 'content.php';

?>
<div id="osnovnoe">

<h1>Добавление видео</h1>

<?php
 $submit = $_POST['submit'];
if ($submit) {
 $news = $_POST['news'];
 $tema = $_POST['tema'];
  $new_day_add = $_POST['new_day_add'];
	$patterns = array ('/width="\d{3}" height="\d{3}"/');
	$replace = array ('width="46%"');
	$news = preg_replace($patterns, $replace, $news);
 $data = Date("Y.m.d H:i");

    mysql_connect("localhost", "host1409556", "0f7cd928"); 
    mysql_query("SET NAMES 'cp1251'");
	   mysql_query("INSERT INTO host1409556_barysh.video VALUES ('', '$data', '$tema', '$news')");
	   	   if ($new_day_add == 'yes') {
		   $url = 'video'; 
		   $kratko = 'Добавлено видео.';
	   	   mysql_query("INSERT INTO host1409556_barysh.news VALUES ('$data', '$url', '$tema', '$kratko')");
}
echo '<p style="color:#135B00; text-align: center"><b>Видео успешно добавлено!</b></p><br />';
}
?>
	<TABLE CELLSPACING=3 CELLPADDING=2 width='500' align='center' border=0>
        <FORM ACTION='<? echo 'my_video.php'; ?>' method='post'>
    			<TR><TD VALIGN=top><b>Тема:</B></TD><TD></TD></TR>
		<TR><TD colspan=2><INPUT TYPE="TEXT" NAME="tema" SIZE=70 required/></TD></TR>
<TR><TD VALIGN=top><B>Код:</B></TD><TD></TD></TR>
		<TR><TD colspan=2><TEXTAREA NAME='news' COLS=55 ROWS=20 required></TEXTAREA></TD></TR>
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