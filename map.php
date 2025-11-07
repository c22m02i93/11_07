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
<title>Карта приходов Барышской епархии</title>

</head>
<body>

<div style="box-shadow: 0 0 20px rgba(0,0,0,0.5);">
<?
include 'golova.php';
$map = 'yes';
include 'menu.php';

include 'content.php';

?>

<div id="osnovnoe">

<h1>Карта приходов</h1><br />
<div style="display: table; margin: 0 auto; text-align: center;border: #BEC7BE 1px solid;">
<script  type="text/javascript" src="http://prihod.ru/ortox-map.php?eparchy=1227&w=600&h=600&map=1&t=19,4,3,7"></script>
</div><br />
Приходы Епархии на <a href="http://barysh-eparhia.cerkov.ru/xramy/" target="_blank">Приход.ру</a>
</div>
<?
include 'footer.php';
?>

 </div>
</body>
</html>