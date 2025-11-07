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
<title>Разрушенные храмы</title>

</head>
<body>

<div style="box-shadow: 0 0 20px rgba(0,0,0,0.5);">
<?
include 'golova.php';
$old_prihods = 'yes';
include 'menu.php';

include 'content.php';

?>

<div id="osnovnoe">

<h1>Разрушенные храмы</h1>
<?
$blag = $_GET['blag'];
$raion = $_GET['raion'];
include 'menu_old_prihods.php';

if (empty($blag) && empty($raion)) {
echo '<ol>';
 mysql_connect("localhost", "host1409556", "0f7cd928"); 
 mysql_query("SET NAMES 'cp1251'");
		echo '<p><span class="title" style="color:#5A5A5A"><b>Храмы</b></span></p>';
$news_all = mysql_query("SELECT * FROM host1409556_barysh.old_prihods WHERE name LIKE '%Храм%' OR name LIKE '%Собор%' ORDER BY name");

	for ($tr=0; $tr<mysql_num_rows($news_all); $tr++)
{	$pr = mysql_fetch_array($news_all);
echo '<li><a href="old_prihod.php?id='.$pr[id].'">'.$pr[name].'</a>.</li>';
}
		echo '<br /><p><span class="title" style="color:#5A5A5A"><b>Часовни</b></span></p>';
$news_all = mysql_query("SELECT * FROM host1409556_barysh.old_prihods WHERE name LIKE '%Часовня%' ORDER BY name");

	for ($tr=0; $tr<mysql_num_rows($news_all); $tr++)
{	$pr = mysql_fetch_array($news_all);
echo '<li><a href="old_prihod.php?id='.$pr[id].'">'.$pr[name].'</a>.</li>';
}

	/*	echo '<br /><p><span class="title" style="color:#5A5A5A"><b>Молитвенные дома и комнаты</b></span></p>';
$news_all = mysql_query("SELECT * FROM host1409556_barysh.old_prihods WHERE name LIKE '%дом%' OR name LIKE '%комната%' ORDER BY name");

	for ($tr=0; $tr<mysql_num_rows($news_all); $tr++)
{	$pr = mysql_fetch_array($news_all);
echo '<li><a href="old_prihod.php?id='.$pr[id].'">'.$pr[name].'</a>.</li>';
}
*/
}

if ($blag) {
echo '<p><span class="title"><b>'.$blag.'-е Благочиние</b></span></p>';

$blag_all = mysql_query("SELECT * FROM host1409556_barysh.blagochiniya WHERE blag LIKE '$blag' LIMIT 1");
$blag_text = mysql_fetch_array($blag_all);
echo $blag_text['text']. '<hr />';
echo '<ol>';

 mysql_connect("localhost", "host1409556", "0f7cd928"); 
		echo '<p><span class="title" style="color:#5A5A5A"><b>Храмы</b></span></p>';
$news_all = mysql_query("SELECT * FROM host1409556_barysh.old_prihods WHERE name LIKE '%Храм%' AND blag = '$blag' ORDER BY name");

	for ($tr=0; $tr<mysql_num_rows($news_all); $tr++)
{	$pr = mysql_fetch_array($news_all);
echo '<li><a href="old_prihod.php?id='.$pr[id].'">'.$pr[name].'</a>.</li>';
}
$news_all = mysql_query("SELECT * FROM host1409556_barysh.old_prihods WHERE name LIKE '%Часовня%' AND blag = '$blag' ORDER BY name");
if (mysql_num_rows($news_all) > '0') {
		echo '<br /><p><span class="title" style="color:#5A5A5A"><b>Часовни</b></span></p>';

	for ($tr=0; $tr<mysql_num_rows($news_all); $tr++)
{	$pr = mysql_fetch_array($news_all);
echo '<li><a href="old_prihod.php?id='.$pr[id].'">'.$pr[name].'</a>.</li>';
}
}
}
if ($raion) {
echo '<p><span class="title"><b>'.$raion.' р-н.</b></span></p>';

echo '<ol>';

 mysql_connect("localhost", "host1409556", "0f7cd928"); 
		echo '<p><span class="title" style="color:#5A5A5A"><b>Храмы</b></span></p>';
$news_all = mysql_query("SELECT * FROM host1409556_barysh.old_prihods WHERE name LIKE '%Храм%' AND raion = '$raion' ORDER BY name");

	for ($tr=0; $tr<mysql_num_rows($news_all); $tr++)
{	$pr = mysql_fetch_array($news_all);
echo '<li><a href="old_prihod.php?id='.$pr[id].'">'.$pr[name].'</a>.</li>';
}
$news_all = mysql_query("SELECT * FROM host1409556_barysh.old_prihods WHERE name LIKE '%Часовня%' AND raion = '$raion' ORDER BY name");
if (mysql_num_rows($news_all) > '0') {
		echo '<br /><p><span class="title" style="color:#5A5A5A"><b>Часовни</b></span></p>';

	for ($tr=0; $tr<mysql_num_rows($news_all); $tr++)
{	$pr = mysql_fetch_array($news_all);
echo '<li><a href="old_prihod.php?id='.$pr[id].'">'.$pr[name].'</a>.</li>';
}
}
}
?>
</ol>

</div>
<?
include 'footer.php';
?>

 </div>
</body>
</html>