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
<title>Добавление публикаций</title>

</head>
<body>

<div style="box-shadow: 0 0 20px rgba(0,0,0,0.5);">
<?
include 'golova.php';

include 'menu.php';

include 'content.php';

?>
<div id="osnovnoe">

<h1>Добавление публикаций</h1>

<?php
    mysql_connect("localhost", "host1409556", "0f7cd928"); 
mysql_query("SET NAMES 'cp1251'");
 $submit = $_POST['submit'];
if ($submit) {
 $news = $_POST['news'];
 $tema = $_POST['tema'];
 $kratko = $_POST['kratko'];
 $albom = $_POST['albom'];

 $data = Date("Y.m.d H:i");

#######3
function imageresize($outfile,$infile,$neww,$newh,$quality) {
    $im=imagecreatefromjpeg($infile);
    $k1=$neww/imagesx($im);
    $k2=$newh/imagesy($im);
    $k=$k1>$k2?$k2:$k1;

    $w=intval(imagesx($im)*$k);
    $h=intval(imagesy($im)*$k);

    $im1=imagecreatetruecolor($w,$h);
    imagecopyresampled($im1,$im,0,0,0,0,$w,$h,imagesx($im),imagesy($im));

    imagejpeg($im1,$outfile,$quality);
    imagedestroy($im);
    imagedestroy($im1);
    }	
################

if(is_uploaded_file($_FILES['uploadfile']['tmp_name']))  {

	$foto_col = mysql_query("SELECT * FROM host1409556_barysh.foto_col");
	$foto_col = mysql_fetch_array($foto_col);
	$b=$foto_col[nomer]+1;
	mysql_query("UPDATE  host1409556_barysh.foto_col SET nomer='$b'");

preg_match_all ("/(\.\w+)$/", $_FILES['uploadfile']['name'], $massiv_uploadfile);

$massiv_uploadfile[0][0]=strtolower($massiv_uploadfile[0][0]);
if ($massiv_uploadfile[0][0] == ".jpeg") $massiv_uploadfile[0][0] = ".jpg";
if ($massiv_uploadfile[0][0] == ".jpg") {
$uploadfile = 'FOTO/'.$b.$massiv_uploadfile[0][0];
$uploadfile_mini = 'FOTO_MINI/'.$b.$massiv_uploadfile[0][0];

copy($_FILES['uploadfile']['tmp_name'], $uploadfile);
	
	imageresize($uploadfile,$uploadfile,900,900,100);
	imageresize($uploadfile_mini,$uploadfile,130,130,100);
###################### новость дня
function removedir ($directory){
$dir = opendir($directory);
while($file = readdir($dir))
{if ( is_file ($directory."/".$file))
{unlink ($directory."/".$file);}
else if ( is_dir ($directory."/".$file) && ($file != ".") && ($file != ".."))
{removedir ($directory."/".$file);}}
closedir ($dir);
rmdir ($directory);
return TRUE;}

removedir ('DAY');
mkdir('DAY', 0755, true);

$uploadfile_day = 'DAY/'.$b.'.jpg';
imageresize($uploadfile_day,$uploadfile,200,200,100);

#####################################
}
else {echo '<p style="color:RED; text-align: center">Неверное расширение файла фотографии<br />Допускается только JPG-формат.</p>'; $error = yes;}

}
else $b =NULL;

#################
    if (empty($error)) {
	$p_msg = array ('/\"/', '/\'/');
	$r_msg = array ('&quot;', '&#039;');
	$tema = preg_replace($p_msg, $r_msg, $tema);
	$kratko = preg_replace($p_msg, $r_msg, $kratko);

	   mysql_query("INSERT INTO host1409556_barysh.publikacii VALUES ('$data', '$b', '$tema', '$kratko', '$news', '$albom', '0')");
	   
	   mysql_query("UPDATE host1409556_barysh.news_day SET data='$data', oblozka='$b', tema='$tema', text='$kratko', page='pub'");

	   $url = 'pub_show';

	   	   mysql_query("INSERT INTO host1409556_barysh.news VALUES ('$data', '$url', '$tema', '$kratko')");
echo '<p style="color:#135B00; text-align: center"><b>Публикация успешно добавлена!</b></p><br />';
}

}

?>
	<TABLE CELLSPACING=3 CELLPADDING=2 width='400' align='center' border=0>
        <FORM ACTION='my_pub.php' method='post' enctype=multipart/form-data>
		<TR><TD VALIGN=top><b>Тема:</B></TD><TD></TD></TR>
		<TR><TD colspan=2><INPUT TYPE="TEXT" NAME="tema" SIZE=70 required/></TD></TR>
		<TR><TD>
		<input type=file name="uploadfile"><br /><br />
		</TD><TD></TD></TR>
    	<TR><TD VALIGN=top><B>Коротко:</B></TD><TD></TD></TR>
		<TR><TD colspan=2><TEXTAREA NAME='kratko' COLS=55 ROWS=5 required></TEXTAREA></TD></TR>
    	<TR><TD VALIGN=top><B>Событие:</B></TD><TD></TD></TR>
		<TR><TD colspan=2><TEXTAREA NAME='news' COLS=55 ROWS=20 required></TEXTAREA></TD></TR>
		<TR><TD VALIGN=top><B>Фотоальбом</B> (номера фотографий через пробел, без знаков препинания):</TD><TD></TD></TR>
		<TR><TD colspan=2><TEXTAREA NAME='albom' COLS=55 ROWS=5></TEXTAREA></TD></TR>

<TR><TD VALIGN=top colspan=2>
	<INPUT TYPE='submit' name='submit' value='Добавить' />
        <INPUT TYPE='reset' value='Очистить'></TD></TR>
 </FORM>  

	</TABLE>	
	<hr />
	<p><b>Правила оформления:</b></p>
	<p><b>@R15-Комментарий@</b> - фотография, выровненная по правому краю, где цифра (15) - номер фотографии, коммментарий - коментарий к фотографии (может отсутствовать).</p>
	<p><b>@L15-Комментарий@</b> - фотография, выровненная по левому краю, где цифра (15) - номер фотографии, коммментарий - коментарий к фотографии (может отсутствовать).</p>
	<p><b>|||слово|||</b> - выделить текст жирным.</p>
	<p><b>///слово///</b> - выделить текст курсивом.</p>
	<p><b>[[[слово]]]</b> - текст по центру.</p>
	<p><b>{{{http://ссылка}}}-{{{текст, который будет отображаться}}}</b> - активная ссылка. Ввод <b>http://</b> перед ссылкой обязателен. </p>

</div>

<?
include 'footer.php';
?>

 </div>
</body>
</html>