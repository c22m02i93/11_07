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

<title>Редактирование новостей</title>

<script type="text/javascript"> 
function confirmDelete() {
	if (confirm("Удалить новость?")) {
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

<h1>Редактирование новостей</h1>

<?php
 $submit = $_POST['submit'];
 $delet = $_POST['delet'];
 $sluzba = $_POST['sluzba'];

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

if ($submit)
{
 $data = $_POST['data'];
 $datatime = $_POST['datatime'];
 	$datatime = preg_replace('/T/', ' ', $datatime);
	$datatime = preg_replace('/\-/', '.', $datatime);
	 $data_form = preg_replace('/\./', '-', substr($datatime,0,10));
	 $time_form = substr($datatime,11,5);

 $table = $_POST['table'];
 $tema = $_POST['tema'];
 $kratko = $_POST['kratko'];
 $news = $_POST['news'];
 $albom = $_POST['albom'];
 $views = $_POST['views'];
 $oblozka = $_POST['oblozka'];
  $when= $_POST['when'];
 $b = $oblozka;
  $name_user_add = $_POST['name_user_add'];
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
	$news_day = mysql_query("SELECT * FROM host1409556_barysh.news_day");

	$news_day = mysql_fetch_array($news_day); 

if(is_uploaded_file($_FILES['uploadfile']['tmp_name']))  {


preg_match_all ("/(\.\w+)$/", $_FILES['uploadfile']['name'], $massiv_uploadfile);

$massiv_uploadfile[0][0]=strtolower($massiv_uploadfile[0][0]);
if ($massiv_uploadfile[0][0] == ".jpeg") $massiv_uploadfile[0][0] = ".jpg";
if ($massiv_uploadfile[0][0] == ".jpg") {
if (empty($b))
{	$foto_col = mysql_query("SELECT * FROM host1409556_barysh.foto_col");
	$foto_col = mysql_fetch_array($foto_col);
	$b=$foto_col[nomer]+1;
	mysql_query("UPDATE  host1409556_barysh.foto_col SET nomer='$b'");

}
$uploadfile = 'FOTO/'.$b.$massiv_uploadfile[0][0];
$uploadfile_mini = 'FOTO_MINI/'.$b.$massiv_uploadfile[0][0];

copy($_FILES['uploadfile']['tmp_name'], $uploadfile);
	
	imageresize($uploadfile,$uploadfile,900,900,75);
	imageresize($uploadfile_mini,$uploadfile,130,130,75);

	#           ЕСЛИ НОВОСТЬ ДНЯ
if ($news_day[data] == $data) {

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
imageresize($uploadfile_day,$uploadfile,200,200,75);
}
	#####
	}
else {echo '<p style="color:RED; text-align: center">Неверное расширение файла фотографии<br />Допускается только JPG-формат.</p>'; $error = yes;}

}

########################
    if (empty($error)) {
	$p_msg = array ('/\"/', '/\'/');
	$r_msg = array ('&quot;', '&#039;');
	$tema = preg_replace($p_msg, $r_msg, $tema);
	$kratko = preg_replace($p_msg, $r_msg, $kratko);

  mysql_connect("localhost", "host1409556", "0f7cd928"); 
  mysql_query("SET NAMES 'cp1251'");
if (empty($video)) {$v_all=mysql_query("SELECT video FROM host1409556_barysh.news_eparhia WHERE data = '$data'"); $video = mysql_fetch_array($v_all); $video=$video[video];}
mysql_query ("DELETE FROM host1409556_barysh.$table WHERE data = '$data'");
if ($table == "anons") mysql_query("INSERT INTO host1409556_barysh.anons VALUES ('$when', '$datatime', '$b', '$tema', '$kratko', '$news', '$name_albom', '$views')");

if ($table == 'news_eparhia' || $table == 'news_eparhia_cron')  mysql_query("INSERT INTO host1409556_barysh.$table VALUES ('$datatime', '$b', '$tema', '$kratko', '$news', '$albom', '$video', '$views')");
if ($table == 'publikacii') mysql_query("INSERT INTO host1409556_barysh.publikacii VALUES ('$datatime', '$b', '$tema', '$kratko', '$news', '$albom', '$views')");

	if ($table == 'news_eparhia') $stranica = 'news'; 
if ($table == 'anons') $stranica = 'anons';
if ($table == 'publikacii') $stranica = 'pub';
if ($news_day[data] == $data) {
	   mysql_query("UPDATE host1409556_barysh.news_day SET data='$datatime', oblozka='$b', tema='$tema', text='$kratko', page='$stranica'");

}

if ($table != 'news_eparhia_cron') {
mysql_query ("DELETE FROM host1409556_barysh.news WHERE data = '$data'");
$url = $stranica.'_show';
mysql_query("INSERT INTO host1409556_barysh.news VALUES ('$datatime', '$url', '$tema', '$kratko')");
}
mysql_query("UPDATE host1409556_barysh.raspisanie SET sluzba='$datatime' WHERE id='$sluzba'");

}
 ################################## Выводим просмотр редактированного

$dtn = $datatime; 
$yyn = substr($dtn,0,4); // Год
$mmn = substr($dtn,5,2); // Месяц
$ddn = substr($dtn,8,2); // День

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

$hours = substr($dtn,11,5); // Время 

$ddttn = '<span class="date">'.$ddn.' '.$mm1n.' '.$yyn.' г. '.$hours.'</span>'; // Конечный вид строки

echo '<br /><p style="color:#135B00; text-align: center"><b>Событие успешно отредактировано!</b></p>';

  	$patterns = array ('/(?:\/{3})(.+)(?:\/{3})/U', '/(?:\|{3})(.+)(?:\|{3})/U', '/(?:\{{3})(http[s]*:\/\/[^\s\[<\(\)\|]+)(?:\}{3})-(?:\{{3})([^}]+)(?:\}{3})/i', '/(?:\{{3})(http[s]*:\/\/[^\s\[<\(\)\|]+)(?:\}{3})/i', '/(?:\{{3})([_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z]{2,3}))(?:\}{3})/', '/\n/', '/@R(\d+)[-]?([^@]*)@/', '/@L(\d+)[-]?([^@]*)@/', '/(?:\[{3})(([0-9]*[^\]{3}]*)*)(?:\]{3})/');
	$replace = array ('<i>${1}</i>', '<b>${1}</b>', '<a href="${1}" target=_blank>${2}</a>', '<a href="${1}" target=_blank>${1}</a>', '<a href="mailto:${1}">${1}</a>', '</p><p>', '<span class="photos"><a href="FOTO/${1}.jpg" rel="example_group" alt="${2}" title="${2}"><img style="border: 1px solid #C3D7D4; margin: 5px 10px 5px 10px;display: block;float: right;box-shadow: 2px 2px 5px rgba(0,0,0,0.3); padding: 10px" src="FOTO_MINI/${1}.jpg" /></a></span>', '<span class="photos"><a href="FOTO/${1}.jpg" rel="example_group" alt="${2}" title="${2}"><img style="border: 1px solid #C3D7D4; margin: 5px 10px 5px 10px;display: block;float: left;box-shadow: 2px 2px 5px rgba(0,0,0,0.3); padding: 10px" src="FOTO_MINI/${1}.jpg" /></a></span>', '<div style="text-align: center; font-weight: bolder;Width:100%; color:#743C00">${1}</div>');
	$text = preg_replace($patterns, $replace, $news);

	echo '<div class="block_title"><span class="title">'.$tema.'</span><br />'.$ddttn.'</div><br />';

if ($b) echo '<span class="photos"><a href="FOTO/'.$b.'.jpg" rel="example_group" alt= "'.$tema.'" title="'.$tema.'"><img style="box-shadow: 2px 2px 5px rgba(0,0,0,0.3); display: inline;float: left;border: 1px solid #C3D7D4; margin: 0 10px 5px 10px; padding: 10px" src="FOTO_MINI/'.$b.'.jpg"/></a></span>';


echo '<p>'.$text.'</p>';
if ($video) {
echo '<hr /><p style="text-align: center;">'.$video.'</p>';
}

if ($albom) {
echo '<hr /><div style="margin-left: 15px;">';
$albom_mas = preg_split("/\s/", $albom);
for ($j=0; $j<count($albom_mas); $j++)
{
echo '<span class="photos"><a href="FOTO/'.$albom_mas[$j].'.jpg" rel="example_group"><img style="border: 1px solid #BEC7BE; margin: 5px; padding: 10px" src="FOTO_MINI/'.$albom_mas[$j].'.jpg" /></a></span>';

}
echo '</div>';

}
###################
$text=$news;
}

elseif ($delet)
{
 $data = $_POST['data'];
 $table = $_POST['table'];
  $oblozka = $_POST['oblozka'];

  mysql_connect("localhost", "host1409556", "0f7cd928"); 
mysql_query ("DELETE FROM host1409556_barysh.$table WHERE data = '$data'");
mysql_query ("DELETE FROM host1409556_barysh.news WHERE data = '$data'");

deletfile('FOTO', $oblozka.'.jpg');
deletfile('FOTO_MINI', $oblozka.'.jpg');

echo '<p style="color:RED; text-align: center">Новость успешно удалена</p>'; 

}

else {
 $data = $_GET['data'];
 $table = $_GET['table'];
 
 ################################## Выводим просмотр
 mysql_connect("localhost", "host1409556", "0f7cd928"); 
$news_all = mysql_query("SELECT * FROM host1409556_barysh.$table WHERE data = '$data'");
$news_wer = mysql_fetch_array($news_all); 

$dtn = $news_wer[data]; 
$yyn = substr($dtn,0,4); // Год
$mmn = substr($dtn,5,2); // Месяц
$ddn = substr($dtn,8,2); // День

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

$hours = substr($dtn,11,5); // Время 

$ddttn = '<span class="date">'.$ddn.' '.$mm1n.' '.$yyn.' г. '.$hours.'</span>'; // Конечный вид строки


  	$patterns = array ('/(?:\/{3})(.+)(?:\/{3})/U', '/(?:\|{3})(.+)(?:\|{3})/U', '/(?:\{{3})(http[s]*:\/\/[^\s\[<\(\)\|]+)(?:\}{3})-(?:\{{3})([^}]+)(?:\}{3})/i', '/(?:\{{3})(http[s]*:\/\/[^\s\[<\(\)\|]+)(?:\}{3})/i', '/(?:\{{3})([_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z]{2,3}))(?:\}{3})/', '/\n/', '/@R(\d+)[-]?([^@]*)@/', '/@L(\d+)[-]?([^@]*)@/', '/(?:\[{3})(([0-9]*[^\]{3}]*)*)(?:\]{3})/');
	$replace = array ('<i>${1}</i>', '<b>${1}</b>', '<a href="${1}" target=_blank>${2}</a>', '<a href="${1}" target=_blank>${1}</a>', '<a href="mailto:${1}">${1}</a>', '</p><p>', '<span class="photos"><a href="FOTO/${1}.jpg" rel="example_group" alt="${2}" title="${2}"><img style="border: 1px solid #C3D7D4; margin: 5px 10px 5px 10px;display: block;float: right;box-shadow: 2px 2px 5px rgba(0,0,0,0.3); padding: 10px" src="FOTO_MINI/${1}.jpg" /></a></span>', '<span class="photos"><a href="FOTO/${1}.jpg" rel="example_group" alt="${2}" title="${2}"><img style="border: 1px solid #C3D7D4; margin: 5px 10px 5px 10px;display: block;float: left;box-shadow: 2px 2px 5px rgba(0,0,0,0.3); padding: 10px" src="FOTO_MINI/${1}.jpg" /></a></span>', '<div style="text-align: center; font-weight: bolder;Width:100%; color:#743C00">${1}</div>');
	$text = preg_replace($patterns, $replace, $news_wer[text]);

	echo '<div class="block_title"><span class="title">'.$news_wer[tema].'</span><br />'.$ddttn.'</div><br />';

if ($news_wer[oblozka]) echo '<span class="photos"><a href="FOTO/'.$news_wer[oblozka].'.jpg" rel="example_group" alt= "'.$news_wer[tema].'" title="'.$news_wer[tema].'"><img style="box-shadow: 2px 2px 5px rgba(0,0,0,0.3); display: inline;float: left;border: 1px solid #C3D7D4; margin: 0 10px 5px 10px; padding: 10px" src="FOTO_MINI/'.$news_wer[oblozka].'.jpg"/></a></span>';


echo '<p>'.$text.'</p>';
if ($news_wer[video]) {
echo '<hr /><p style="text-align: center;">'.$news_wer[video].'</p>';
}

if ($news_wer[albom]) {
echo '<hr /><div style="margin-left: 15px;">';
$albom_mas = preg_split("/\s/", $news_wer[albom]);
for ($j=0; $j<count($albom_mas); $j++)
{
echo '<span class="photos"><a href="FOTO/'.$albom_mas[$j].'.jpg" rel="example_group"><img style="border: 1px solid #BEC7BE; margin: 5px; padding: 10px" src="FOTO_MINI/'.$albom_mas[$j].'.jpg" /></a></span>';

}
echo '</div>';

}
$tema =$news_wer[tema];
$datatime = $news_wer[data];
 $data_form = preg_replace('/\./', '-', substr($datatime,0,10));
 $time_form = substr($datatime,11,5);

$kratko =$news_wer[kratko];
$views=$news_wer[views];
$oblozka=$news_wer[oblozka];
$text=$news_wer[text];
$albom=$news_wer[albom];
$name_user_add=$news_wer[name_user];
$when=$news_wer[when];

}
 ######################################################
?> 
<hr />
	<TABLE CELLSPACING=3 CELLPADDING=2 width='400' align='center' border=0>
        <FORM ACTION='edit.php' method='post' enctype=multipart/form-data>
		<? if ($table != "anons") echo '<!--';?>
		<TR><TD VALIGN=top><b>Дата события</B> (в свободном формате):</TD><TD></TD></TR>
		<TR><TD colspan=2><INPUT TYPE="TEXT" NAME="when" SIZE=35 value ="<? echo $when;?>" required/></TD></TR>
		<? if ($table != "anons") echo '-->';?>

		<TR><TD VALIGN=top><b>Тема:</B></TD><TD></TD></TR>
		<TR><TD colspan=2><INPUT TYPE="TEXT" NAME="tema" SIZE=70 value ="<? echo $tema;?>"/></TD></TR>
		<TR><TD>
		<input type=file name="uploadfile"><br /><br />
				<input type='hidden' name='data' value='<? echo $data; ?>'>
				<input type='hidden' name='table' value='<? echo $table; ?>'>
				<input type='hidden' name='views' value='<? echo $views; ?>'>
				<input type='hidden' name='oblozka' value='<? echo $oblozka; ?>'>
<input type="hidden" name="name_user_add" value='<? echo $name_user_add; ?>'>
		</TD><TD></TD></TR>
    	<TR><TD VALIGN=top><b>Дата добавления новости:</B></TD><TD></TD></TR>
		<TR><TD colspan=2><INPUT TYPE="datetime-local" NAME="datatime" SIZE=70 value="<?php echo $data_form.'T'.$time_form; ?>"required /></TD></TR>
    	<TR><TD VALIGN=top><B>Коротко:</B></TD><TD></TD></TR>
		<TR><TD colspan=2><TEXTAREA NAME='kratko' COLS=55 ROWS=5 required><? echo $kratko;?></TEXTAREA></TD></TR>
<TR><TD VALIGN=top><B>Событие:</B></TD><TD></TD></TR>
		<TR><TD colspan=2><TEXTAREA NAME='news' COLS=55 ROWS=20><? echo $text;?></TEXTAREA></TD></TR>
		
		<? if ($table == "anons") echo '<!--';?>
		<TR><TD VALIGN=top><B>Фотоальбом</B> (номера фотографий через пробел, без знаков препинания):</TD><TD></TD></TR>
		<TR><TD colspan=2><TEXTAREA NAME='albom' COLS=55 ROWS=5><? echo $albom;?></TEXTAREA></TD></TR>
				<? if ($table == "publikacii") echo '<!--';?>
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
<TR><TD colspan=2><select style="width:500px;" name="sluzba"><option selected>Выберите службу</option>
		<?
			 $data_today = Date("Y.m.d");

		$news_all = mysql_query("SELECT * FROM host1409556_barysh.raspisanie where data between '2000.12.31' and '$data_today' ORDER BY data DESC LIMIT 20");
for ($t=0; $t<mysql_num_rows($news_all); $t++)
{
$news = mysql_fetch_array($news_all); 

	$patterns = array ('/\n/', '/(\d{1,2}:\d{2})/');
	$replace = array ('</p><p>', '<b>${1}</b>');
	$text = preg_replace($patterns, $replace, $news[text]);

echo '<option value="'.$news[id].'">'.$news[data_text].' - '.$news[nedel].' - '.$text.'</option>';
}


?></select></TD></TR>

		<? if ($table == "publikacii") echo '-->';?>
		<? if ($table == "anons") echo '-->';?>

			<TR><TD VALIGN=top>
								
				</TD><TD></TD></TR><TR><TD VALIGN=top colspan=2>
	<INPUT TYPE='submit' name='submit' value='Редактировать' />
        <INPUT TYPE='reset' value='Очистить'>
<INPUT TYPE='submit' name='delet' value='Удалить' onclick="return confirmDelete();"/>
</TD></TR>
 </FORM>  

	</TABLE>	
	<hr />
	<p><b>Правила оформления:</b></p>
	<p><b>@R15-Комментарий@</b> - фотография, выровненная по правому краю, где цифра (15) - номер фотографии, коммментарий - коментарий к фотографии (может отсутствовать).</p>
	<p><b>@L15-Комментарий@</b> - фотография, выровненная по левому краю, где цифра (15) - номер фотографии, коммментарий - коментарий к фотографии (может отсутствовать).</p>
	<p><b>|||слово|||</b> - выделить текст жирным.</p>
	<p><b>///слово///</b> - выделить текст курсивом.</p>
	<p><b>{{{http://ссылка}}}-{{{текст, который будет отображаться}}}</b> - активная ссылка. Ввод <b>http://</b> перед ссылкой обязателен. </p>


</div>

<?
include 'footer.php';
?>

 </div>
</body>
</html>