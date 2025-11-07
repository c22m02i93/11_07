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
$id=$_GET['id'];
 mysql_connect("localhost", "host1409556", "0f7cd928"); 
mysql_query("SET NAMES 'cp1251'");
 $hod_all = mysql_query("SELECT * FROM host1409556_barysh.krest_hod_$year WHERE id = $id");

 $hod = mysql_fetch_array($hod_all); 

?>
<title>Крестный ход - <? echo $year.' - '.$hod['nas_punkt']; ?></title>

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

<h1>Крестный ход - <? echo $year; ?></h1>
<div style="margin-left: 15px">

<?

 $data_hoda = $hod['data']; echo '<br /><span style="color:#005698;font-size: 130%">'.rus2translit($data_hoda).'</span> '. nedel($data_hoda) .'<br /><br />';

 echo '<b>'.$hod['pribyv'].' - '.$hod['otbyv'].'</b> '.$hod['nas_punkt'].'<br /><br />';
echo '<hr /><div style="margin-left: 15px;">';
$albom_mas = preg_split("/\s/", $hod[foto]);
for ($j=0; $j<count($albom_mas); $j++)
{
echo '<span class="photos"><a href="FOTO/'.$albom_mas[$j].'.jpg" rel="example_group"><img style="border: 1px solid #BEC7BE; box-shadow: 2px 2px 5px rgba(0,0,0,0.3);margin: 5px; padding: 10px" src="FOTO_MINI/'.$albom_mas[$j].'.jpg" /></a></span>';

}
echo '</div>';

?>


</div><br /><hr />
<script type="text/javascript" src="//yandex.st/share/share.js" charset="utf-8"></script>
<div class="yashare-auto-init" data-yashareL10n="ru" data-yashareType="button" data-yashareQuickServices="yaru,vkontakte,facebook,twitter,odnoklassniki,moimir,lj"></div> 
</div>
<?
include 'footer.php';
?>

 </div>
</body>
</html>