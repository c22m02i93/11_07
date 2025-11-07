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
<title>Святые Барышской епархии</title>

</head>
<body>

<div style="box-shadow: 0 0 20px rgba(0,0,0,0.5);">
<?
include 'golova.php';

include 'menu.php';

include 'content.php';

?>

<div id="osnovnoe">
<a name="zitie"></a>
<h1>Святые Барышской епархии</h1>
<table width="100%" border="0" style = "margin: 0 20px; vertical-align: top">
<?php
		$saints_all = mysql_query("SELECT * FROM host1409556_barysh.saints");
while($saints = mysql_fetch_array($saints_all)) {
echo '<tr><td>';
if ($saints['foto']) echo '<span class="photos"><a href="FOTO/'.$saints['foto'].'.jpg" rel="example_group" alt= "'.$saints[name].'" title="'.$saints[name].'"><img style="box-shadow: 2px 2px 5px rgba(0,0,0,0.3); display: inline;float: left;border: 1px solid #C3D7D4; margin: 0 10px 5px 10px; padding: 10px" src="FOTO_MINI/'.$saints['foto'].'.jpg" alt= "'.$saints['name'].'" title="'.$saints['name'].'"/></a></span>';
echo '</td><td>';
echo '<span class="title"><a href="'.$saints['url'].'"><b>'.$saints['name'].'</b></a></span><br /><br />';
echo '<p>'.$saints['text'].'</p><br /><br /><br /><br />';
echo '</td></tr>';
}
?>
</table>
</div><br /><br />
<?
include 'footer.php';
?>

 </div>
</body>
</html>