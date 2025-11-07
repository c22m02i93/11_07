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
<title>Редактирование клирика</title>
<script type="text/javascript"> 
function confirmDelete() {
	if (confirm("Удалить информацию о клирике?")) {
		return true;
	} else {
		return false;
	}
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

<h1>Редактирование клирика</h1>

<?php
    mysql_connect("localhost", "host1409556", "0f7cd928"); 
     mysql_query("SET NAMES 'cp1251'");
 $submit = $_POST['submit'];
if ($submit) {
   $id= $_POST['id'];
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
else {
$klirik_foto = mysql_query("SELECT foto FROM host1409556_barysh.klir WHERE id = '$id' LIMIT 1");
$foto = mysql_fetch_array($klirik_foto); 
$b = $foto['foto'];
}

#################
    if (empty($error)) {
if ($blag == 'Монастырь') $blag = 'mon';
	   	   mysql_query("UPDATE host1409556_barysh.klir SET foto='$b', name='$name', san='$san', blag='$blag',  rozd='$rozd', diak='$diak', presv='$presv', monah='$monah', angel='$angel', obrazovanie='$obrazovanie', poslush='$poslush', kontakt='$kontakt', status='$status', celibat='$celibat', orar='$orar', protodiak='$protodiak', nabedr='$nabedr', kamilavk='$kamilavk', krest='$krest', protoier='$protoier', palica='$palica', krestprekras='$krestprekras', mitra='$mitra', 1otverstie='$otverstie1', 2otverstie='$otverstie2'  WHERE id='$id'");

echo '<p style="color:#135B00; text-align: center"><b>Информация о клирике успешно отредактирована!</b><br /><br /><a href="/klirik.php?id='.$id.'">К карточке клирика</a></p><br />';
}
$klirik_all = mysql_query("SELECT * FROM host1409556_barysh.klir WHERE id = '$id' LIMIT 1");
$klirik = mysql_fetch_array($klirik_all); 

}
elseif ($_POST['delet'])
{
  $id= $_POST['id'];
mysql_query ("DELETE FROM host1409556_barysh.klir WHERE id = '$id' LIMIT 1");
echo '<p style="color:RED; text-align: center">Информация о клирике успешно удалена<br /><br /><a href="/klir.php">Вернуться к списку духовенства</a></p><br /><br />'; 

}

else {
  $id= $_GET['id'];
$klirik_all = mysql_query("SELECT * FROM host1409556_barysh.klir WHERE id = '$id' LIMIT 1");
$klirik = mysql_fetch_array($klirik_all); 

  }
?>
	<TABLE CELLSPACING=3 CELLPADDING=2 width='400' align='center' border=0>
        <FORM ACTION='<? echo 'edit_klirik.php'; ?>' method='post'  onSubmit='return checkSubmit(this);' enctype=multipart/form-data>
		<TR><TD VALIGN=top><b>Имя Отчество Фамилия / для монахов Имя (ИОФ):</B></TD><TD></TD></TR>
		<TR><TD colspan=2><INPUT TYPE="TEXT" NAME="name" SIZE=70 required value="<? echo $klirik['name'];?>" /></TD></TR>
		<TR><TD><br />
		<?
		if ($klirik[foto]) echo '<span class="photos"><a href="FOTO/'.$klirik[foto].'.jpg" rel="example_group" alt= "'.$klirik[san].' '.$klirik[name].'" title="'.$klirik[san].' '.$klirik[name].'"><img style="box-shadow: 2px 2px 5px rgba(0,0,0,0.3); display: inline;float: left;border: 1px solid #C3D7D4; margin: 0 10px 5px 10px; padding: 10px" src="FOTO_MINI/'.$klirik[foto].'.jpg" alt= "'.$klirik[san].' '.$klirik[name].'" title="'.$klirik[san].' '.$klirik[name].'"/></a></span>';
else echo '<span class="photos"><img style="box-shadow: 2px 2px 5px rgba(0,0,0,0.3); display: inline;float: left;border: 1px solid #C3D7D4; margin: 0 10px 5px 10px; padding: 10px" src="IMG/no_foto.jpg" alt= "'.$klirik[san].' '.$klirik[name].'" title="'.$klirik[san].' '.$klirik[name].'"/></span>';

?>
<input type=file name="uploadfile"><br /><br />
		</TD><TD></TD></TR>
    			<TR><TD colspan=2>
				<SELECT NAME="san">
<OPTION DISABLED SELECTED>Сан</option>
<OPTION <? if ($klirik[san] == 'Диакон') echo 'selected'; ?>>Диакон</option>
<OPTION <? if ($klirik[san] == 'Иеродиакон') echo 'selected'; ?>>Иеродиакон</option>
<OPTION <? if ($klirik[san] == 'Архидиакон') echo 'selected'; ?>>Архидиакон</option>
<OPTION <? if ($klirik[san] == 'Протодиакон') echo 'selected'; ?>>Протодиакон</option>
<OPTION <? if ($klirik[san] == 'Иерей') echo 'selected'; ?>>Иерей</option>
<OPTION <? if ($klirik[san] == 'Иеромонах') echo 'selected'; ?>>Иеромонах</option>
<OPTION <? if ($klirik[san] == 'Протоиерей') echo 'selected'; ?>>Протоиерей</option>
<OPTION <? if ($klirik[san] == 'Игумен') echo 'selected'; ?>>Игумен</option>
<OPTION <? if ($klirik[san] == 'Архимандрит') echo 'selected'; ?>>Архимандрит</option>
</SELECT>
</TD></TR>
    			<TR><TD colspan=2>
				<SELECT NAME="status">
<OPTION DISABLED SELECTED>Статус</option>
<OPTION <? if ($klirik[status] == 'штатный') echo 'selected'; ?>>штатный</option>
<OPTION <? if ($klirik[status] == 'на покое') echo 'selected'; ?>>на покое</option>
<OPTION <? if ($klirik[status] == 'заштатный') echo 'selected'; ?>>заштатный</option>
<OPTION <? if ($klirik[status] == 'запрещенный') echo 'selected'; ?>>запрещенный</option>
<OPTION <? if ($klirik[status] == 'архивный') echo 'selected'; ?>>архивный</option>
</SELECT>
</TD></TR><TR><TD colspan=2>
				<SELECT NAME="blag">
<OPTION DISABLED SELECTED>Благочиние</option>
<OPTION <? if ($klirik[blag] == '1') echo 'selected'; ?>>1</option>
<OPTION <? if ($klirik[blag] == '2') echo 'selected'; ?>>2</option>
<OPTION <? if ($klirik[blag] == '3') echo 'selected'; ?>>3</option>
<OPTION <? if ($klirik[blag] == '4') echo 'selected'; ?>>4</option>
<OPTION <? if ($klirik[blag] == '5') echo 'selected'; ?>>5</option>
<OPTION <? if ($klirik[blag] == 'mon') echo 'selected'; ?>>Монастырь</option>
</SELECT>
</TD></TR>

		<TR><TD VALIGN=top><B>Дата рождения (гггг.мм.дд):</B></TD><TD></TD></TR>
		<TR><TD colspan=2><INPUT TYPE="TEXT" NAME='rozd' SIZE=70 value="<? echo $klirik['rozd'];?>" /></TD></TR>
		<TR><TD VALIGN=top><B>Диаконская хиротония (гггг.мм.дд):</B></TD><TD></TD></TR>
		<TR><TD colspan=2><INPUT TYPE="TEXT" NAME='diak' SIZE=70 value="<? echo $klirik['diak'];?>" /></TD></TR>
		<TR><TD VALIGN=top><B>Иерейская хиротония (гггг.мм.дд):</B></TD><TD></TD></TR>
		<TR><TD colspan=2><INPUT TYPE="TEXT" NAME='presv' SIZE=70 value="<? echo $klirik['presv'];?>" /></TD></TR>
		<TR><TD VALIGN=top><B>Дата пострига (гггг.мм.дд):</B></TD><TD></TD></TR>
		<TR><TD colspan=2><INPUT TYPE="TEXT" NAME='monah' SIZE=70 value="<? echo $klirik['monah'];?>" /></TD></TR>
		<TR><TD VALIGN=top><B>День ангела (дд.мм)</B> если несколько значений, то через запятую (дд.мм, дд.мм):</TD><TD></TD></TR>
		<TR><TD colspan=2><INPUT TYPE="TEXT" NAME='angel' SIZE=70 value="<? echo $klirik['angel'];?>" /></TD></TR>

    	<TR><TD VALIGN=top><B>Образование:</B></TD><TD></TD></TR>
		<TR><TD colspan=2><TEXTAREA NAME='obrazovanie' COLS=55 ROWS=5><? echo $klirik['obrazovanie'];?></TEXTAREA></TD></TR>
    	<TR><TD VALIGN=top><B>Епархиальные послушания:</B></TD><TD></TD></TR>
		<TR><TD colspan=2><TEXTAREA NAME='poslush' COLS=55 ROWS=5><? echo $klirik['poslush'];?></TEXTAREA></TD></TR>
		<TR><TD VALIGN=top><B>Контакты:</B></TD><TD></TD></TR>
		<TR><TD colspan=2><TEXTAREA NAME='kontakt' COLS=55 ROWS=5><? echo $klirik['kontakt'];?></TEXTAREA></TD></TR>
				<TR><TD colspan=2><INPUT TYPE="CHECKBOX" NAME="celibat" VALUE ="yes" id="celibat"  <? if ($klirik[celibat] == 'yes') echo 'checked'; ?>> <label for="celibat"><b>Целибат / вдовый</b></label></TD></TR>

<TR><TD VALIGN=top colspan=2>
	<hr />
</TD></TR>

		<TR><TD><B>Двойной орарь</B></TD><TD><INPUT TYPE="TEXT" NAME='orar' SIZE=4 value="<? echo $klirik['orar'];?>"  /></TD></TR>
		<TR><TD><B>Протодиакон / архидиакон</B></TD><TD><INPUT TYPE="TEXT" NAME='protodiak' SIZE=4 value="<? echo $klirik['protodiak'];?>"  /></TD></TR>
		<TR><TD><B>Набедренник</B></TD><TD><INPUT TYPE="TEXT" NAME='nabedr' SIZE=4 value="<? echo $klirik['nabedr'];?>"  /></TD></TR>
		<TR><TD><B>Камилавка</B></TD><TD><INPUT TYPE="TEXT" NAME='kamilavk' SIZE=4  value="<? echo $klirik['kamilavk'];?>" /></TD></TR>
		<TR><TD><B>Крест</B></TD><TD><INPUT TYPE="TEXT" NAME='krest' SIZE=4  value="<? echo $klirik['krest'];?>" /></TD></TR>
		<TR><TD><B>Протоиерей / игумен</B></TD><TD><INPUT TYPE="TEXT" NAME='protoier' SIZE=4 value="<? echo $klirik['protoier'];?>"  /></TD></TR>
		<TR><TD><B>Палица</B></TD><TD><INPUT TYPE="TEXT" NAME='palica' SIZE=4 value="<? echo $klirik['palica'];?>"  /></TD></TR>
		<TR><TD><B>Крест с украшениями</B></TD><TD><INPUT TYPE="TEXT" NAME='krestprekras' SIZE=4 value="<? echo $klirik['krestprekras'];?>"  /></TD></TR>
		<TR><TD><B>Митра / архимандрит</B></TD><TD><INPUT TYPE="TEXT" NAME='mitra' SIZE=4 value="<? echo $klirik['mitra'];?>"  /></TD></TR>
		<TR><TD><B>Отверстые Врата до "Херувимской"</B></TD><TD><INPUT TYPE="TEXT" NAME='otverstie1' SIZE=4 value="<? echo $klirik['1otverstie'];?>"  /></TD></TR>
		<TR><TD><B>Отверстые Врата до "Отче наш"</B></TD><TD><INPUT TYPE="TEXT" NAME='otverstie2' SIZE=4  value="<? echo $klirik['2otverstie'];?>" /></TD></TR>
				
				<INPUT TYPE="HIDDEN" NAME="id" VALUE ="<? echo $id; ?>">

<TR><TD VALIGN=top colspan=2>
	<br /><br /><INPUT TYPE='submit' name='submit' value='Редактировать' />
        <INPUT TYPE='reset' value='Очистить'>
<INPUT TYPE='submit' name='delet' value='Удалить' onclick="return confirmDelete();"/>
	  </TD></TR>
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