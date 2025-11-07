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
<title>Добавление клирика</title>
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

<h1>Добавление клирика</h1>

<?php
 $submit = $_POST['submit'];
if ($submit) {
 $name = $_POST['name'];
 $san = $_POST['san'];
 $blag = $_POST['blag'];
 $rozd = $_POST['rozd'];
 $diak = $_POST['diak'];
 $presv = $_POST['presv'];
 $monah = $_POST['monah'];
 $angel = $_POST['angel'];
 $obrazovanie = $_POST['obrazovanie'];
 $poslush = $_POST['poslush'];
 $kontakt = $_POST['kontakt'];
 $status = $_POST['status'];
 $celibat = $_POST['celibat'];
 $orar = $_POST['orar'];
 $protodiak = $_POST['protodiak'];
 $nabedr = $_POST['nabedr'];
 $kamilavk = $_POST['kamilavk'];
 $krest = $_POST['krest'];
 $protoier = $_POST['protoier'];
 $palica = $_POST['palica'];
 $krestprekras = $_POST['krestprekras'];
 $mitra = $_POST['mitra'];
 $otverstie1 = $_POST['otverstie1'];
 $otverstie2 = $_POST['otverstie2'];

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
	imageresize($uploadfile_mini,$uploadfile,200,200,100);
}
else {echo '<p style="color:RED; text-align: center">Неверное расширение файла фотографии<br />Допускается только JPG-формат.</p>'; $error = yes;}

}
else $b =NULL;

#################
    if (empty($error)) {
    mysql_connect("localhost", "host1409556", "0f7cd928"); 
     mysql_query("SET NAMES 'cp1251'");
if ($blag == 'Монастырь') $blag = 'mon';
	   mysql_query("INSERT INTO host1409556_barysh.klir VALUES ('', '$b', '$name', '$san', '$blag',  '$rozd', '$diak', '$presv', '$monah', '$angel', '$obrazovanie', '$poslush', '$kontakt', '$status', '$celibat', '$orar', '$protodiak', '$nabedr', '$kamilavk', '$krest', '$protoier', '$palica', '$krestprekras', '$mitra', '$otverstie1', '$otverstie2')");
	   
echo '<p style="color:#135B00; text-align: center"><b>Клирик успешно добавлен в базу!</b></p><br />';
}

}

?>
	<TABLE CELLSPACING=3 CELLPADDING=2 width='400' align='center' border=0>
        <FORM ACTION='<? echo 'add_klir.php'; ?>' method='post'  onSubmit='return checkSubmit(this);' enctype=multipart/form-data>
		<TR><TD VALIGN=top><b>Имя Отчество Фамилия / для монахов Имя (ИОФ):</B></TD><TD></TD></TR>
		<TR><TD colspan=2><INPUT TYPE="TEXT" NAME="name" SIZE=70 required/></TD></TR>
		<TR><TD>
		<input type=file name="uploadfile"><br /><br />
		</TD><TD></TD></TR>
    			<TR><TD colspan=2>
				<SELECT NAME="san">
<OPTION DISABLED SELECTED>Сан</option>
<OPTION>Диакон</option>
<OPTION>Иеродиакон</option>
<OPTION>Архидиакон</option>
<OPTION>Протодиакон</option>
<OPTION>Иерей</option>
<OPTION>Иеромонах</option>
<OPTION>Протоиерей</option>
<OPTION>Игумен</option>
<OPTION>Архимандрит</option>
</SELECT>
</TD></TR>
    			<TR><TD colspan=2>
				<SELECT NAME="status">
<OPTION DISABLED SELECTED>Статус</option>
<OPTION>штатный</option>
<OPTION>на покое</option>
<OPTION>заштатный</option>
<OPTION>запрещенный</option>
<OPTION>архивный</option>
</SELECT>
</TD></TR><TR><TD colspan=2>
				<SELECT NAME="blag">
<OPTION DISABLED SELECTED>Благочиние</option>
<OPTION>1</option>
<OPTION>2</option>
<OPTION>3</option>
<OPTION>4</option>
<OPTION>5</option>
<OPTION>Монастырь</option>
</SELECT>
</TD></TR>

		<TR><TD VALIGN=top><B>Дата рождения (гггг.мм.дд):</B></TD><TD></TD></TR>
		<TR><TD colspan=2><INPUT TYPE="TEXT" NAME='rozd' SIZE=70 /></TD></TR>
		<TR><TD VALIGN=top><B>Диаконская хиротония (гггг.мм.дд):</B></TD><TD></TD></TR>
		<TR><TD colspan=2><INPUT TYPE="TEXT" NAME='diak' SIZE=70 /></TD></TR>
		<TR><TD VALIGN=top><B>Иерейская хиротония (гггг.мм.дд):</B></TD><TD></TD></TR>
		<TR><TD colspan=2><INPUT TYPE="TEXT" NAME='presv' SIZE=70 /></TD></TR>
		<TR><TD VALIGN=top><B>Дата пострига (гггг.мм.дд):</B></TD><TD></TD></TR>
		<TR><TD colspan=2><INPUT TYPE="TEXT" NAME='monah' SIZE=70 /></TD></TR>
		<TR><TD VALIGN=top><B>День ангела (дд.мм)</B> если несколько значений, то через запятую (дд.мм, дд.мм):</TD><TD></TD></TR>
		<TR><TD colspan=2><INPUT TYPE="TEXT" NAME='angel' SIZE=70 /></TD></TR>

    	<TR><TD VALIGN=top><B>Образование:</B></TD><TD></TD></TR>
		<TR><TD colspan=2><TEXTAREA NAME='obrazovanie' COLS=55 ROWS=5></TEXTAREA></TD></TR>
    	<TR><TD VALIGN=top><B>Епархиальные послушания:</B></TD><TD></TD></TR>
		<TR><TD colspan=2><TEXTAREA NAME='poslush' COLS=55 ROWS=5></TEXTAREA></TD></TR>
		<TR><TD VALIGN=top><B>Контакты:</B></TD><TD></TD></TR>
		<TR><TD colspan=2><TEXTAREA NAME='kontakt' COLS=55 ROWS=5></TEXTAREA></TD></TR>
				<TR><TD colspan=2><INPUT TYPE="CHECKBOX" NAME="celibat" VALUE ="yes" id="celibat"> <label for="celibat"><b>Целибат / вдовый</b></label></TD></TR>

<TR><TD VALIGN=top colspan=2>
	<hr />
</TD></TR>

		<TR><TD><B>Двойной орарь</B></TD><TD><INPUT TYPE="TEXT" NAME='orar' SIZE=4 /></TD></TR>
		<TR><TD><B>Протодиакон / архидиакон</B></TD><TD><INPUT TYPE="TEXT" NAME='protodiak' SIZE=4 /></TD></TR>
		<TR><TD><B>Набедренник</B></TD><TD><INPUT TYPE="TEXT" NAME='nabedr' SIZE=4 /></TD></TR>
		<TR><TD><B>Камилавка</B></TD><TD><INPUT TYPE="TEXT" NAME='kamilavk' SIZE=4 /></TD></TR>
		<TR><TD><B>Крест</B></TD><TD><INPUT TYPE="TEXT" NAME='krest' SIZE=4 /></TD></TR>
		<TR><TD><B>Протоиерей / игумен</B></TD><TD><INPUT TYPE="TEXT" NAME='protoier' SIZE=4 /></TD></TR>
		<TR><TD><B>Палица</B></TD><TD><INPUT TYPE="TEXT" NAME='palica' SIZE=4 /></TD></TR>
		<TR><TD><B>Крест с украшениями</B></TD><TD><INPUT TYPE="TEXT" NAME='krestprekras' SIZE=4 /></TD></TR>
		<TR><TD><B>Митра / архимандрит</B></TD><TD><INPUT TYPE="TEXT" NAME='mitra' SIZE=4 /></TD></TR>
		<TR><TD><B>Отверстые Врата до "Херувимской"</B></TD><TD><INPUT TYPE="TEXT" NAME='otverstie1' SIZE=4 /></TD></TR>
		<TR><TD><B>Отверстые Врата до "Отче наш"</B></TD><TD><INPUT TYPE="TEXT" NAME='otverstie2' SIZE=4 /></TD></TR>


<TR><TD VALIGN=top colspan=2>
	<br /><br /><INPUT TYPE='submit' name='submit' value='Добавить' />
        <INPUT TYPE='reset' value='Очистить'></TD></TR>
 </FORM>  

	</TABLE>	
<br /><br /><br />
</div>

<?
include 'footer.php';
?>

 </div>
</body>
</html>