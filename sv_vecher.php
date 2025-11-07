<?
if (isset($_REQUEST[session_name()])) session_start ();
$auth=$_SESSION['auth'];
$name_user=$_SESSION['name_user'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?
include 'head.php';
?>
<title>Радиопередача "Светлый вечер"</title>

</head>
<body>

<div style="box-shadow: 0 0 20px rgba(0,0,0,0.5);">
<?
include 'golova.php';
$radio = 'yes';
include 'menu.php';
include 'function.php';

include 'content.php';

?>
<div id="osnovnoe">

<h1>Радиопередача "Светлый вечер"</h1>
<p>
Радипередача "Светлый вечер" с епископом Барышским и Инзенским выходит с 1 октября 2014 года на волнах "Радио Барыш" на чистоте 100,2 fm. Беседует с владыкой священник Сергий Жидков. 
</p>
<p>Группа радиопередачи ВКонтакте - <a href="http://vk.com/sv_vecher">www.vk.com/sv_vecher</a>.
</p><hr style="width: 100%" />
 <?   if(!isset($_GET['page'])){
  $p = 1;
}
else{
  $p = addslashes(strip_tags(trim($_GET['page'])));
  if($p < 1) $p = 1;
}
$num_elements = 10;
$total = mysql_result(mysql_query("SELECT COUNT(*) FROM host1409556_barysh.radio"),0,0); //Подсчет общего числа записей
$num_pages = ceil($total / $num_elements); //Подсчет числа страниц
if ($p > $num_pages) $p = $num_pages;
$start = ($p - 1) * $num_elements; //Стартовая позиция выборки из БД
                    
					
 # echo GetNav($p, $num_pages, "sv_vecher").'<hr style="width: 100%" />';
            $sel = "SELECT * FROM host1409556_barysh.radio ORDER BY id DESC LIMIT ".$start.", ".$num_elements;
            $query = mysql_query($sel);
            if(mysql_num_rows($query)>0){

			while($res = mysql_fetch_array($query)){
$dtn = $res[data]; 
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

	$patterns = array ('/(?:\{{3})(http:\/\/[^\s\[<\(\)\|]+)(?:\}{3})-(?:\{{3})([^}]+)(?:\}{3})/i', '/\n/', '/(?:\/{3})/', '/(?:\|{3})/', '/@[^@]+@/', '/(?:\{{3})/', '/(?:\}{3})/');
	$replace = array ('${2}', '</p><p>', '', '', '', '', '');
	$text = preg_replace($patterns, $replace, $res[kratko]);

echo '<div style="float: left; margin-bottom: 10px; border-bottom: 1px #D7D7D7 solid"><div class="block_title"><span class="title">'.$res[tema].'</span>';
/*if ($auth == 1) echo '<a href="delete_video.php?id='.$res[id].'"><img style="display: block;float: right;border: 0; margin: 0 5px 0 0; " src="IMG/delete.png"/></a>';*/
echo '<br />'.$ddttn.'</div>';

	$kod =  $res[kod];

echo '<p style=" display: inline;float: left; margin: 0 10px 5px 10px;"> <audio controls>
    <source src="AUDIO/'.$kod.'"></audio> <a href="AUDIO/'.$kod.'">Скачать аудио-файл</a></p></div>';
}
}
echo '<br /><table width="100%"><tr><td>';

  #echo '<hr style="width: 100%" />'.GetNav($p, $num_pages, "sv_vecher").'<hr style="width: 100%" />';
echo '</td></tr></table>';
?>

</div>

<?
include 'footer.php';
?>

 </div>
</body>
</html>