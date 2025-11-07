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
<title>Выбор новости дня</title>

</head>
<body>

<div style="box-shadow: 0 0 20px rgba(0,0,0,0.5);">
<?
include 'golova.php';

include 'menu.php';

include 'content.php';
 mysql_connect("localhost", "host1409556", "0f7cd928"); 
 mysql_query("SET NAMES 'cp1251'");
if ($_POST['submit']) {
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
################

if ($_POST['news']) {
$data=$_POST['news'];
 	$news_all = mysql_query("SELECT * FROM host1409556_barysh.news_eparhia WHERE data = '$data'");
$news = mysql_fetch_array($news_all); 
$tema=$news['tema'];
$kratko=$news['kratko'];
$oblozka=$news['oblozka'];


removedir ('DAY');
mkdir('DAY', 0755, true);

$uploadfile = 'FOTO/'.$oblozka.'.jpg';
$uploadfile_day = 'DAY/'.$oblozka.'.jpg';
imageresize($uploadfile_day,$uploadfile,200,200,75);

	   //mysql_query("UPDATE host1409556_barysh.news_day SET data='$data', oblozka='$oblozka', tema='$tema', text='$kratko', page='news'");
	mysql_query ("DELETE FROM host1409556_barysh.news_day");
	mysql_query("INSERT INTO host1409556_barysh.news_day VALUES ('$data', '$oblozka', '$tema', '$kratko', 'news')");

}
if ($_POST['anons']) {
$data=$_POST['anons'];
 	$news_all = mysql_query("SELECT * FROM host1409556_barysh.anons WHERE data = '$data'");
$news = mysql_fetch_array($news_all); 
$tema=$news['tema'];
$kratko=$news['kratko'];
$oblozka=$news['oblozka'];


removedir ('DAY');
mkdir('DAY', 0755, true);

$uploadfile = 'FOTO/'.$oblozka.'.jpg';
$uploadfile_day = 'DAY/'.$oblozka.'.jpg';
imageresize($uploadfile_day,$uploadfile,200,200,75);

	   mysql_query("UPDATE host1409556_barysh.news_day SET data='$data', oblozka='$oblozka', tema='$tema', text='$kratko', page='anons'");

}
if ($_POST['padre']) {
$data=$_POST['padre'];
 	$news_all = mysql_query("SELECT * FROM host1409556_barysh.padre WHERE data = '$data'");
$news = mysql_fetch_array($news_all); 
$tema=$news['tema'];
	   if (preg_match_all ("/^[^\t]{350}/", $news['text'], $massiv_news)) {
	   $kratko = $massiv_news[0][0].'... <a href="slovo_padre_show.php?data='.$data.'">(читать далее)</a>';}
	   else $kratko = $news['text'];
$oblozka=$news['img'];


removedir ('DAY');
mkdir('DAY', 0755, true);

$uploadfile = 'IMG/'.$oblozka.'.jpg';
$uploadfile_day = 'DAY/'.$oblozka.'.jpg';
imageresize($uploadfile_day,$uploadfile,120,120,75);

	   mysql_query("UPDATE host1409556_barysh.news_day SET data='$data', oblozka='$oblozka', tema='$tema', text='$kratko', page='slovo_padre'");

}
if ($_POST['pub']) {
$data=$_POST['pub'];
 	$news_all = mysql_query("SELECT * FROM host1409556_barysh.publikacii WHERE data = '$data'");
$news = mysql_fetch_array($news_all); 
$tema=$news['tema'];
$kratko=$news['kratko'];
$oblozka=$news['oblozka'];


removedir ('DAY');
mkdir('DAY', 0755, true);

$uploadfile = 'FOTO/'.$oblozka.'.jpg';
$uploadfile_day = 'DAY/'.$oblozka.'.jpg';
imageresize($uploadfile_day,$uploadfile,200,200,75);

	   mysql_query("UPDATE host1409556_barysh.news_day SET data='$data', oblozka='$oblozka', tema='$tema', text='$kratko', page='pub'");


}

}
?>

<div id="osnovnoe">

<h1>Выбор новости дня</h1>
<div class="title"><b>Новости епархии</b></div>
        <FORM ACTION='<? echo 'my_news_day.php'; ?>' method='post' enctype=multipart/form-data>
<select style="width:500px;" name="news"><option disabled selected>Выберите новость</option>
 <?  
 	$news_all = mysql_query("SELECT * FROM host1409556_barysh.news_eparhia WHERE data != '$dtn_day' ORDER BY data DESC LIMIT 20");
	for ($t=0; $t<mysql_num_rows($news_all); $t++)
{
$news = mysql_fetch_array($news_all); 

echo '<option value="'.$news[data].'">'.$news[tema].'</option>';
}
?>
</select><br />
	<INPUT TYPE='submit' name='submit' value='OK' /><br /><br />

<div class="title"><b>Анонсы</b></div>
<select style="width:500px;" name="anons"><option disabled selected>Выберите анонс</option>

 <?   
	$news_all = mysql_query("SELECT * FROM host1409556_barysh.anons WHERE data != '$dtn_day' ORDER BY data DESC LIMIT 20");
	for ($t=0; $t<mysql_num_rows($news_all); $t++)
{
$news = mysql_fetch_array($news_all); 

echo '<option value="'.$news[data].'">'.$news[tema].'</option>';
}
?>
</select><br />
	<INPUT TYPE='submit' name='submit' value='OK' /><br /><br />
	
<div class="title"><b>Слово архипастыря</b></div>
<select style="width:500px;" name="padre"><option disabled selected>Выберите статью</option>

 <?   
 	$news_all = mysql_query("SELECT * FROM host1409556_barysh.padre WHERE data != '$dtn_day' ORDER BY data DESC LIMIT 20");
	for ($t=0; $t<mysql_num_rows($news_all); $t++)
{
$news = mysql_fetch_array($news_all); 

echo '<option value="'.$news[data].'">'.$news[tema].'</option>';
}
?>
</select><br />
	<INPUT TYPE='submit' name='submit' value='OK' /><br /><br />
	
<div class="title"><b>Публикации</b></div>
<select style="width:500px;" name="pub"><option disabled selected>Выберите публикацию</option>

 <?   
 	$pub_all = mysql_query("SELECT * FROM host1409556_barysh.publikacii WHERE data != '$dtn_day' ORDER BY data DESC LIMIT 20");
	for ($t=0; $t<mysql_num_rows($pub_all); $t++)
{
$pub = mysql_fetch_array($pub_all); 

echo '<option value="'.$pub[data].'">'.$pub[tema].'</option>';
}
?>
</select><br />
	<INPUT TYPE='submit' name='submit' value='OK' /><br /><br />


 </FORM>  

</div>
<?
include 'footer.php';
?>

 </div>
</body>
</html>