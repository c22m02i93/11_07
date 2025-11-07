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
<title>Добавление фотографий</title>

</head>
<body>

<div style="box-shadow: 0 0 20px rgba(0,0,0,0.5);">
<?
include 'golova.php';

include 'menu.php';

include 'content.php';

?>
<div id="osnovnoe">

<h1>Фотографии</h1>

<?php
 $submit = $_POST['submit'];
 
if ($submit) {
    mysql_connect("localhost", "host1409556", "0f7cd928"); 
    mysql_query("SET NAMES 'cp1251'");

################### ФУНКЦИИ
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

###########################33 ОТДЕЛЬНАЯ ФОТОГРАФИЯ ################################
echo '<p style="color:#135B00; text-align: center">';
	for ($tt=0; $tt<count($_FILES['uploadfile']['name']); $tt++)
{

preg_match_all ("/(\.\w+)$/", $_FILES['uploadfile']['name'][$tt], $massiv_uploadfile);

$massiv_uploadfile[0][0]=strtolower($massiv_uploadfile[0][0]);
if ($massiv_uploadfile[0][0] == ".jpeg") $massiv_uploadfile[0][0] = ".jpg";
if ($massiv_uploadfile[0][0] == ".jpg") {
	$foto_col = mysql_query("SELECT * FROM host1409556_barysh.foto_col");
	$foto_col = mysql_fetch_array($foto_col);
	$b=$foto_col[nomer]+1;
	mysql_query("UPDATE  host1409556_barysh.foto_col SET nomer='$b'");
$uploadfile = 'FOTO/'.$b.$massiv_uploadfile[0][0];
$uploadfile_mini = 'FOTO_MINI/'.$b.$massiv_uploadfile[0][0];

copy($_FILES['uploadfile']['tmp_name'][$tt], $uploadfile);
	
	imageresize($uploadfile,$uploadfile,900,900,100);
	imageresize($uploadfile_mini,$uploadfile,130,130,100);

echo $b.' ';
}
else 
	if ($_FILES['uploadfile']['name'][$tt] != "") echo '<p style="color:RED; text-align: center"><b>Неверное расширение файла '.$_FILES['uploadfile']['name'][$tt].'!</b><br />Допускается только JPG-формат, поэтому фотография не была добавлена.</p><br />';
}
}
echo '</p>';
?>

	<TABLE CELLSPACING=3 CELLPADDING=2 width='400' align='center' border=0>
        <FORM ACTION='<? echo 'my_foto.php'; ?>' method='post' enctype=multipart/form-data>
		<TR><TD colspan=2><input type=file name="uploadfile[]"></TD></TR>
		<TR><TD colspan=2><input type=file name="uploadfile[]"></TD></TR>
		<TR><TD colspan=2><input type=file name="uploadfile[]"></TD></TR>
		<TR><TD colspan=2><input type=file name="uploadfile[]"></TD></TR>
		<TR><TD colspan=2><input type=file name="uploadfile[]"></TD></TR>
		<TR><TD colspan=2><input type=file name="uploadfile[]"></TD></TR>
		<TR><TD colspan=2><input type=file name="uploadfile[]"></TD></TR>
		<TR><TD colspan=2><input type=file name="uploadfile[]"></TD></TR>
		<TR><TD colspan=2><input type=file name="uploadfile[]"></TD></TR>
		<TR><TD colspan=2><input type=file name="uploadfile[]"></TD></TR>
		<TR><TD colspan=2><input type=file name="uploadfile[]"></TD></TR>
		<TR><TD colspan=2><input type=file name="uploadfile[]"></TD></TR>
		<TR><TD colspan=2><input type=file name="uploadfile[]"></TD></TR>
		<TR><TD colspan=2><input type=file name="uploadfile[]"></TD></TR>
		<TR><TD colspan=2><input type=file name="uploadfile[]"></TD></TR>
		<TR><TD colspan=2><input type=file name="uploadfile[]"></TD></TR>
		<TR><TD colspan=2><input type=file name="uploadfile[]"></TD></TR>
		<TR><TD colspan=2><input type=file name="uploadfile[]"></TD></TR>
		<TR><TD colspan=2><input type=file name="uploadfile[]"></TD></TR>
		<TR><TD colspan=2><input type=file name="uploadfile[]"></TD></TR>


		
	<TR><TD colspan=2><hr />
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