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
<title>Редактирование разрушенного храма</title>
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

<h1>Редактирование разрушенного храма</h1>
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
 $id = $_POST['id'];
 $b_for_del = $_POST['foto'];
 $b = $_POST['foto'];
 $albom = $_POST['albom'];
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
	
	imageresize($uploadfile,$uploadfile,700,700,75);
	imageresize($uploadfile_mini,$uploadfile,130,130,75);
	
	 function deletfile($directory,$filename) 
{ 
  // открываем директорию (получаем дескриптор директории) 
  $dir = opendir($directory); 
   
  // считываем содержание директории 
while(($file = readdir($dir))) 
{ 
          // Если это файл и он равен удаляемому ... 
  if((is_file("$directory/$file")) && ("$directory/$file" == "$directory/$filename")) 
  { 
    // ...удаляем его. 
    unlink("$directory/$file"); 
                   
     // Если файла нет по запрошенному пути, возвращаем TRUE - значит файл удалён. 
    if(!file_exists($directory."/".$filename)) return $s = TRUE; 
  } 
} 
  // Закрываем дескриптор директории. 
  closedir($dir); 
} 
deletfile('FOTO', $b_for_del.'.jpg');
deletfile('FOTO_MINI', $b_for_del.'.jpg');

}
else {echo '<p style="color:RED; text-align: center">Неверное расширение файла фотографии<br />Допускается только JPG-формат.</p>'; $error = yes;}

}

#################
    if (empty($error)) {
    mysql_connect("localhost", "host1409556", "0f7cd928"); 
mysql_query ("DELETE FROM host1409556_barysh.old_prihods WHERE id = '$id'");

	   mysql_query("INSERT INTO host1409556_barysh.old_prihods VALUES ('$id', '$name', '$adres', '$raion', '$b', '$histor', '$kontakt', '$web', '$other', '$blag', '$albom')");
	   
echo '<p style="color:#135B00; text-align: center"><b>Храм успешно отредактирован!</b></p><br />';
}

}
else {
 $id= $_GET['id'];
	}
  echo '<a style="float: right; margin: 10px;" href="old_prihod.php?id='.$id.'"><img src="IMG/close.png" title="Закрыть редактирование" /></a> ';

  mysql_connect("localhost", "host1409556", "0f7cd928"); 
	$news_all = mysql_query("SELECT * FROM host1409556_barysh.old_prihods WHERE id='$id'");
	$pr = mysql_fetch_array($news_all);
	
		$patterns = array ('/\n/', '/([_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z]{2,3}))/', );
	$replace = array ('</p><p>', '<a href="mailto:${1}">${1}</a>');
	$histor = preg_replace($patterns, $replace, $pr[histor]);
	$other = preg_replace($patterns, $replace, $pr[other]);
	$klir = preg_replace($patterns, $replace, $pr[klir]);
	$kontakt = preg_replace($patterns, $replace, $pr[kontakt]);
	$albom = $pr['albom'];

echo '<p><span class="title"><b>'.$pr[name].' ('.$pr[blag].' благочиние)</b></span></p>';
if ($pr[foto]) echo '
<span class="photos"><a href="FOTO/'.$pr[foto].'.jpg" rel="example_group"><img style="box-shadow: 2px 2px 5px rgba(0,0,0,0.3); display: inline;float: left;border: 1px solid #C3D7D4; margin: 0 10px 5px 10px; padding: 10px" src="FOTO_MINI/'.$pr[foto].'.jpg" alt= "'.$pr[name].'" title="'.$pr[name].'"/></a></span>';
if ($pr[histor]) echo '<p><b>История храма:</b></p><p>'.$histor.'</p>';	
echo '<p><b>Адрес:</b> '.$pr[adres].'</p>';
if ($pr[kontakt]) echo '<p><b>Реквизиты для пожертвований:</b></p><p>'.$kontakt.'</p>';	
if ($pr[web]) echo '<p><b>Сайт:</b> <a href="http://'.$pr[web].'" target="_blank">'.$pr[web].'</a></p>';	
if ($pr[other]) echo '<p><b>Дополнительная информация:</b></p><p>'.$other.'</p>';	
if ($pr[albom]) {
echo '<hr /><div style="margin-left: 15px;">';
$albom_mas = preg_split("/\s/", $pr[albom]);
for ($j=0; $j<count($albom_mas); $j++)
{
echo '<span class="photos"><a href="FOTO/'.$albom_mas[$j].'.jpg" rel="example_group"><img style="border: 1px solid #BEC7BE; margin: 5px; padding: 10px" src="FOTO_MINI/'.$albom_mas[$j].'.jpg" /></a></span>';

}
echo '</div>';

}

?>
<hr />

	<TABLE CELLSPACING=3 CELLPADDING=2 width='400' align='center' border=0>
        <FORM ACTION='<? echo 'edit_old_prihod.php'; ?>' method='post'  onSubmit='return checkSubmit(this);' enctype=multipart/form-data>
		<TR><TD VALIGN=top><b>Название:</B></TD><TD></TD></TR>
		<TR><TD colspan=2><INPUT TYPE="TEXT" NAME="name" SIZE=70 value="<? echo $pr[name]; ?>" required/></TD></TR>
		<TR><TD>
		<input type=file name="uploadfile"><br /><br />
		</TD><TD></TD></TR>
    	<TR><TD VALIGN=top><B>Адрес:</B></TD><TD></TD></TR>
		<TR><TD colspan=2><TEXTAREA NAME='adres' COLS=55 ROWS=5 required><? echo $pr[adres]; ?></TEXTAREA></TD></TR>
		<TR><TD VALIGN=top><B>Район:</B></TD><TD></TD></TR>
		<TR><TD colspan=2>
				<SELECT NAME="raion">
<OPTION DISABLED>Выберите район</option>
<OPTION <? if ($pr[raion] == 'Базарносызганский') echo 'SELECTED';?>>Базарносызганский</option>
<OPTION <? if ($pr[raion] == 'Барышский') echo 'SELECTED';?>>Барышский</option>
<OPTION <? if ($pr[raion] == 'Инзенский') echo 'SELECTED';?>>Инзенский</option>
<OPTION <? if ($pr[raion] == 'Николаевский') echo 'SELECTED';?>>Николаевский</option>
<OPTION <? if ($pr[raion] == 'Павловский') echo 'SELECTED';?>>Павловский</option>
<OPTION <? if ($pr[raion] == 'Радищевский') echo 'SELECTED';?>>Радищевский</option>
<OPTION <? if ($pr[raion] == 'Старокулаткинский') echo 'SELECTED';?>>Старокулаткинский</option>
</SELECT>
</TD></TR>

				<input type='hidden' name='foto' value='<? echo $pr[foto]; ?>'>
				<INPUT TYPE="HIDDEN" NAME="id" VALUE ="<? echo $id; ?>">

    	<TR><TD VALIGN=top><B>История:</B></TD><TD></TD></TR>
		<TR><TD colspan=2><TEXTAREA NAME='histor' COLS=55 ROWS=5 ><? echo $pr[histor]; ?></TEXTAREA></TD></TR>

		<TR><TD VALIGN=top><B>Сайт:</B></TD><TD></TD></TR>
		<TR><TD colspan=2><INPUT TYPE="TEXT" NAME='web' SIZE=70  value="<? echo $pr[web]; ?>" /></TD></TR>
		<TR><TD VALIGN=top><B>Благочиние:</B></TD><TD></TD></TR>
		<TR><TD colspan=2><INPUT TYPE="TEXT" NAME='blag' SIZE=5  value="<? echo $pr[blag]; ?>" required/></TD></TR>

    	<TR><TD VALIGN=top><B>Реквизиты для пожертвований:</B></TD><TD></TD></TR>
		<TR><TD colspan=2><TEXTAREA NAME='kontakt' COLS=55 ROWS=5><? echo $pr[kontakt]; ?></TEXTAREA></TD></TR>
		<TR><TD VALIGN=top><B>Дополнительная информация:</B></TD><TD></TD></TR>
		<TR><TD colspan=2><TEXTAREA NAME='other' COLS=55 ROWS=5><? echo $pr[other]; ?></TEXTAREA></TD></TR>
		<TR><TD VALIGN=top><B>Фотоальбом</B> (номера фотографий через пробел, без знаков препинания):</TD><TD></TD></TR>
		<TR><TD colspan=2><TEXTAREA NAME='albom' COLS=55 ROWS=5><? echo $albom;?></TEXTAREA></TD></TR>

<TR><TD VALIGN=top colspan=2>
	<INPUT TYPE='submit' name='submit' value='Редактировать' />
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