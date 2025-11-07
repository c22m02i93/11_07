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
<title>Добавление разрушенных храмов</title>
<script type="text/javascript" language="javascript"> 
function checkSubmit ( thisForm ) {
if ( thisForm.raion.value =="Выберите район"){ 
alert('Пожалуйста, выберите район!'); 
return false;
}

return true;
}
</script>

</head>
<body>

<div style="box-shadow: 0 0 20px rgba(0,0,0,0.5);">
<?
include 'golova.php';

include 'menu.php';

include 'content.php';

?>
<div id="osnovnoe">

<h1>Добавление разрушенных храмов</h1>

<?php
 $submit = $_POST['submit'];
if ($submit) {
 $name = $_POST['name'];
 $adres = $_POST['adres'];
 $histor = $_POST['histor'];
 $web = $_POST['web'];
 $blag = $_POST['blag'];
 $kontakt = $_POST['kontakt'];
 $other = $_POST['other'];
 $raion = $_POST['raion'];
 $albom = $_POST['albom'];
#######3
function imageresize($outfile,$infile,$neww,$newh,$quality) {
   
    $im=imagecreatefromjpeg($infile);
    if ((imagesx($im) > $neww) || (imagesy($im) > $newh)) 
	{
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
}
else {echo '<p style="color:RED; text-align: center">Неверное расширение файла фотографии<br />Допускается только JPG-формат.</p>'; $error = yes;}

}
else $b =NULL;

#################
    if (empty($error)) {
    mysql_connect("localhost", "host1409556", "0f7cd928"); 
	$albom = preg_replace('/\s+$/', '', $albom);

	   mysql_query("INSERT INTO host1409556_barysh.old_prihods VALUES (null, '$name', '$adres', '$raion', '$b', '$histor', '$kontakt', '$web', '$other', 
	   '$blag', '$albom')");
	   
echo '<p style="color:#135B00; text-align: center"><b>Приход успешно добавлен в базу!</b></p><br />';
}

}

?>
	<TABLE CELLSPACING=3 CELLPADDING=2 width='400' align='center' border=0>
        <FORM ACTION='<? echo 'my_old_prihods.php'; ?>' method='post'  onSubmit='return checkSubmit(this);' enctype=multipart/form-data>
		<TR><TD VALIGN=top><b>Название:</B></TD><TD></TD></TR>
		<TR><TD colspan=2><INPUT TYPE="TEXT" NAME="name" SIZE=70 required/></TD></TR>
		<TR><TD>
		<input type=file name="uploadfile"><br /><br />
		</TD><TD></TD></TR>
    	<TR><TD VALIGN=top><B>Адрес:</B></TD><TD></TD></TR>
		<TR><TD colspan=2><TEXTAREA NAME='adres' COLS=55 ROWS=5 required></TEXTAREA></TD></TR>
		<TR><TD VALIGN=top><B>Район:</B></TD><TD></TD></TR>
		<TR><TD colspan=2>
				<SELECT NAME="raion">
<OPTION DISABLED SELECTED>Выберите район</option>
<OPTION>Базарносызганский</option>
<OPTION>Барышский</option>
<OPTION>Инзенский</option>
<OPTION>Николаевский</option>
<OPTION>Павловский</option>
<OPTION>Радищевский</option>
<OPTION>Старокулаткинский</option>
</SELECT>
</TD></TR>


    	<TR><TD VALIGN=top><B>История:</B></TD><TD></TD></TR>
		<TR><TD colspan=2><TEXTAREA NAME='histor' COLS=55 ROWS=5 ></TEXTAREA></TD></TR>

		<TR><TD VALIGN=top><B>Сайт:</B></TD><TD></TD></TR>
		<TR><TD colspan=2><INPUT TYPE="TEXT" NAME='web' SIZE=70 /></TD></TR>
		<TR><TD VALIGN=top><B>Благочиние:</B></TD><TD></TD></TR>
		<TR><TD colspan=2><INPUT TYPE="TEXT" NAME='blag' SIZE=5 required/></TD></TR>

    	<TR><TD VALIGN=top><B>Реквизиты для пожертвований:</B></TD><TD></TD></TR>
		<TR><TD colspan=2><TEXTAREA NAME='kontakt' COLS=55 ROWS=5></TEXTAREA></TD></TR>
		<TR><TD VALIGN=top><B>Дополнительная информация:</B></TD><TD></TD></TR>
		<TR><TD colspan=2><TEXTAREA NAME='other' COLS=55 ROWS=5></TEXTAREA></TD></TR>
		<TR><TD VALIGN=top><B>Фотоальбом</B> (номера фотографий через пробел, без знаков препинания):</TD><TD></TD></TR>
		<TR><TD colspan=2><TEXTAREA NAME='albom' COLS=55 ROWS=5></TEXTAREA></TD></TR>

<TR><TD VALIGN=top colspan=2>
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