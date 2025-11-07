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
<title>Карта приходов</title>

</head>
<body>

<div style="box-shadow: 0 0 20px rgba(0,0,0,0.5);">
<?
include 'golova.php';

include 'menu.php';

include 'content.php';

?>

<div id="osnovnoe" >

<h1>Карта приходов</h1><br />
<div style="position: relative; left: 50%; margin-left: -250px" ><script type="text/javascript" src="http://prihod.ru/ortox-map.php?eparchy=1227&w=500&h=500&map=1"></script></div></div>
<?
include 'footer.php';
?>

 </div>
</body>
</html>