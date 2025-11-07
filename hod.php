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
$year=$_GET['year'];
?>
<title>Крестный ход 2023 год <? echo $year; if ($year) echo ' год';?></title>
<script type='text/javascript'>
window.onload=function(){window.scrollBy(0,-80);}
</script>
</head>
<body>

<div style="box-shadow: 0 0 20px rgba(0,0,0,0.5);">
<?
include 'golova.php';

include 'menu.php';

include 'content.php';
include 'function.php';

?>

<div id="osnovnoe">

<h1>Крестный ход с Чудотворной иконой Пресвятой Богородицы "Казанская — Жадовская" в храмы Симбирской митрополии <? echo $year; if ($year) echo ' год';?></h1>
<div style="margin-left: 15px">
<?
if ($year) {

 mysql_connect("localhost", "host1409556", "0f7cd928"); 
	$data_today = Date("Y.m.d");
	$chas_today = Date("H:i");
	$hod_all = mysql_query("SELECT * FROM host1409556_barysh.krest_hod_$year group BY data, pribyv");
for ($t=0; $t<mysql_num_rows($hod_all); $t++)
{
$hod = mysql_fetch_array($hod_all); 

if ($hod['pribyv'] == '00:00' && $hod['otbyv'] == '24:00') 
	$pribyv_otbyv = 'Весь день &#8195; ';
/* elseif ($hod['pribyv'] == '00:00') 
	$pribyv_otbyv = 'До '.$hod['otbyv'].' &#8195;  &#8195; ';
elseif ($hod['otbyv'] == '24:00') 
	$pribyv_otbyv = 'С '.$hod['pribyv'].' &#8195;  &#8195; ';
 */
else
	$pribyv_otbyv = $hod['pribyv'].' - '.$hod['otbyv'].' &#8195; ';

if ($data_today > $hod['data']) {
 echo '<span style="color: #777">';
if ($data_hoda != $hod['data'])
{$data_hoda = $hod['data']; echo '<a name="'.$data_hoda.'"></a><br /><span style="color:#005698;font-size: 130%">'.rus2translit($data_hoda).'</span> '.nedel($data_hoda).'<br /><br />';
 }
 echo '<b>'.$pribyv_otbyv.'</b> '.$hod['nas_punkt'].'</span>';
 if ($hod['foto']) echo '&#8195;<a href="hod_show.php?id='.$hod['id'].'&year='.$year.'">ФОТООТЧЕТ</a>';
 echo '<br />'; 
}
elseif ($data_today < $hod['data']) { 
if ($data_hoda != $hod['data'])
{$data_hoda = $hod['data']; echo '<a name="'.$data_hoda.'"></a><br /><span style="color:#005698;font-size: 130%">'.rus2translit($data_hoda).'</span> '.nedel($data_hoda).'<br /><br />';
 }

 echo '<b>'.$pribyv_otbyv.'</b> '.$hod['nas_punkt'];
 if ($hod['foto']) echo '&#8195;<a href="hod_show.php?id='.$hod['id'].'&year='.$year.'">ФОТООТЧЕТ</a>';
 echo '<br />'; }
else {
if ($data_hoda != $hod['data'])
{$data_hoda = $hod['data']; echo '<a name="'.$data_hoda.'"></a><br /><span style="color:#005698;font-size: 130%">'.rus2translit($data_hoda).'</span> '.nedel($data_hoda).'<br /><br />';
 }

if ($chas_today > $hod['otbyv']) {echo '<span style="color: #777"><b>'.$pribyv_otbyv.'</b> '.$hod['nas_punkt'].'</span>'; if ($hod['foto']) echo '&#8195;<a href="hod_show.php?id='.$hod['id'].'&year='.$year.'">ФОТООТЧЕТ</a>';
 echo '<br />'; }
elseif ($chas_today < $hod['pribyv']) {echo '<b>'.$pribyv_otbyv.'</b> '.$hod['nas_punkt'];if ($hod['foto']) echo '&#8195;<a href="hod_show.php?id='.$hod['id'].'&year='.$year.'">ФОТООТЧЕТ</a>';
 echo '<br />'; }
else {echo '<div style="width:100%; background:#F8FCBE"><b>'.$pribyv_otbyv.'</b> '.$hod['nas_punkt'];if ($hod['foto']) echo '&#8195;<a href="hod_show.php?id='.$hod['id'].'&year='.$year.'">ФОТООТЧЕТ</a>';
 echo '</div>'; }
}
}
}
else {
echo '<br />Крестный ход с Чудотворной Казанской Жадовской иконой Божией Матери впервые состоялся в 1847 году и проходил ежегодно до 1927 года. Благочестивая традиция возродилась в 2004 году.<br /><br />Предлагаем Вашему вниманию расписание крестного хода (с 2014 года) с фотоотчетами (с 2015 года).<br /><br />';
echo '<p><a href="hod.php?year=2025">Крестный ход 2025 год</a></p>';
echo '<p><a href="hod.php?year=2024">Крестный ход 2024 год</a></p>';
echo '<p><a href="hod.php?year=2023">Крестный ход 2023 год</a></p>';
echo '<p><a href="hod.php?year=2022">Принесение Чудотворной иконы Пресвятой Богородицы "Казанская — Жадовская" в храмы Симбирской митрополии 2022 год</a></p>';
echo '<p><a href="hod.php?year=2020">Крестный ход 2021 год</a></p>';
echo '<p><a href="hod.php?year=2020">Крестный ход 2020 год</a></p>';
echo '<p><a href="hod.php?year=2019">Крестный ход 2019 год</a></p>';
echo '<p><a href="hod.php?year=2018">Крестный ход 2018 год</a></p>';
echo '<p><a href="hod.php?year=2017">Крестный ход 2017 год</a></p>';
echo '<p><a href="hod.php?year=2016">Крестный ход 2016 год</a></p>';
echo '<p><a href="hod.php?year=2015">Крестный ход 2015 год</a></p>';
echo '<p><a href="hod.php?year=2014">Крестный ход 2014 год</a></p>';
}
?>
</div><br /><br />
<script type="text/javascript" src="//yandex.st/share/share.js" charset="utf-8"></script>
<div class="yashare-auto-init" data-yashareL10n="ru" data-yashareType="button" data-yashareQuickServices="yaru,vkontakte,facebook,twitter,odnoklassniki,moimir,lj"></div> 
</div>
<?
include 'footer.php';
?>

 </div>
</body>
</html>