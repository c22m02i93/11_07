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
<title>Добавление новостей епархии</title>

</head>
<body>

<div style="box-shadow: 0 0 20px rgba(0,0,0,0.5);">
<?
include 'golova.php';

include 'menu.php';

include 'content.php';

?>
<div id="osnovnoe">

<h1>Добавление новостей епархии</h1>

<?php
    mysql_connect("localhost", "host1409556", "0f7cd928"); 
mysql_query("SET NAMES 'cp1251'");
 $submit = $_POST['submit'];
if ($submit) {
 $datatime = $_POST['datatime'];
 $news = $_POST['news'];
 $tema = $_POST['tema'];
 $kratko = $_POST['kratko'];
 $albom = $_POST['albom'];
 $sluzba = $_POST['sluzba'];
  $new_day_add = $_POST['new_day_add'];
  $video = $_POST['video'];
if ($video) {	$video_col = mysql_query("SELECT kod FROM host1409556_barysh.video WHERE id = '$video'");
	$video_col = mysql_fetch_array($video_col);
	$video = $video_col[kod];
}

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
if ($new_day_add == 'yes') {
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
}
#####################################
}
else {echo '<p style="color:RED; text-align: center">Неверное расширение файла фотографии<br />Допускается только JPG-формат.</p>'; $error = yes;}

}
else $b =NULL;

#################
    if (empty($error)) {
	$p_msg = array ('/\"/', '/\'/', '/\«/', '/\»/');
	$r_msg = array ('&quot;', '&#039;', '&quot;', '&quot;');
	$tema = preg_replace($p_msg, $r_msg, $tema);
	$kratko = preg_replace($p_msg, $r_msg, $kratko);
	$albom = preg_replace('/\s+$/', '', $albom);
	$datatime = preg_replace('/T/', ' ', $datatime);
	$datatime = preg_replace('/\-/', '.', $datatime);

$data_today = Date("Y.m.d H:i");
if ($data_today >= $datatime) {
	mysql_query("INSERT INTO host1409556_barysh.news_eparhia VALUES ('$datatime', '$b', '$tema', '$kratko', '$news', '$albom', '$video', '0')");
   if ($new_day_add == 'yes') {
	   mysql_query("UPDATE host1409556_barysh.news_day SET data='$datatime', oblozka='$b', tema='$tema', text='$kratko', page='news'");
}
	   $url = 'news_show';
   	   mysql_query("UPDATE host1409556_barysh.raspisanie SET sluzba='$datatime' WHERE id='$sluzba'");
   	   mysql_query("INSERT INTO host1409556_barysh.news VALUES ('$datatime', '$url', '$tema', '$kratko')");
echo '<p style="color:#135B00; text-align: center"><b>Событие успешно добавлено!</b></p><br />';
 }
 else {
 	mysql_query("INSERT INTO host1409556_barysh.news_eparhia_cron VALUES ('$datatime', '$b', '$tema', '$kratko', '$news', '$albom', '$video', '$sluzba')");
	echo '<p style="color:#135B00; text-align: center"><b>Новость отложена до '.$datatime.'!</b></p><br />';
}
 }

}
 $data = Date("Y-m-d");
 $time = Date("H:i");

?>
	<TABLE CELLSPACING=3 CELLPADDING=2 width='400' align='center' border=0>
        <FORM ACTION='<? echo 'my_news_ep.php'; ?>' method='post' enctype=multipart/form-data>
		<TR><TD VALIGN=top><b>Тема:</B></TD><TD></TD></TR>
		<TR><TD colspan=2><INPUT TYPE="TEXT" NAME="tema" SIZE=70 required /></TD></TR>
		<TR><TD>
		<input type=file name="uploadfile"><br /><br />
		</TD><TD></TD></TR>
    	<TR><TD VALIGN=top><b>Дата добавления новости:</B></TD><TD></TD></TR>
		<TR><TD colspan=2><INPUT TYPE="datetime-local" NAME="datatime" SIZE=70 value="<?php echo $data.'T'.$time; ?>"required /></TD></TR>
		<TR><TD VALIGN=top><B>Коротко:</B></TD><TD></TD></TR>
		<TR><TD colspan=2><TEXTAREA NAME='kratko' COLS=55 ROWS=5 required></TEXTAREA></TD></TR>
    	<TR><TD VALIGN=top><B>Событие:</B></TD><TD></TD></TR>
		<TR><TD colspan=2><TEXTAREA NAME='news' COLS=55 ROWS=20 required></TEXTAREA></TD></TR>
		<TR><TD VALIGN=top><B>Фотоальбом</B> (номера фотографий через пробел, без знаков препинания):</TD><TD></TD></TR>
		<TR><TD colspan=2><TEXTAREA NAME='albom' COLS=55 ROWS=5></TEXTAREA></TD></TR>
		<TR><TD colspan=2><select style="width:500px;" name="video"><option disabled selected>Выберите видео</option>
		<?

		$video_all = mysql_query("SELECT * FROM host1409556_barysh.video ORDER BY id DESC LIMIT 10");
for ($t=0; $t<mysql_num_rows($video_all); $t++)
{
$video = mysql_fetch_array($video_all); 

	$patterns = array ('/\n/', '/(\d{1,2}:\d{2})/');
	$replace = array ('</p><p>', '<b>${1}</b>');
	$video[tema] = preg_replace($patterns, $replace, $video[tema]);

echo '<option value="'.$video[id].'">'.$video[tema].'</option>';
}


?></select></TD></TR>
		<TR><TD colspan=2><select style="width:500px;" name="sluzba"><option disabled selected>Выберите службу</option>
		<?
			 $data_today = Date("Y.m.d");

		$news_all = mysql_query("SELECT * FROM host1409556_barysh.raspisanie where data between '2000.12.31' and '$data_today' ORDER BY data DESC LIMIT 10");
for ($t=0; $t<mysql_num_rows($news_all); $t++)
{
$news = mysql_fetch_array($news_all); 

	$patterns = array ('/\n/', '/(\d{1,2}:\d{2})/');
	$replace = array ('</p><p>', '<b>${1}</b>');
	$text = preg_replace($patterns, $replace, $news[text]);

echo '<option value="'.$news[id].'">'.$news[data_text].' - '.$news[nedel].' - '.$text.'</option>';
}


?></select></TD></TR>

				<TR><TD colspan=2><INPUT TYPE="CHECKBOX" NAME="new_day_add" VALUE ="yes" id="new_day"> <label for="new_day"><b>Новость дня</b></label></TD></TR>

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