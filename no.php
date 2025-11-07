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
<title>Страница не найдена</title>

</head>
<body>

<div style="box-shadow: 0 0 20px rgba(0,0,0,0.5);">
<?
include 'golova.php';

include 'menu.php';

include 'content.php';

?>

<div id="osnovnoe">

<h1>Страница не найдена</h1>
<div style="text-align: center;font-size: 140px;font-weight: 900;color: #D6E6E4;">404</div> 
<div style="text-align: center;font-size: 20px; margin-top: -70px; margin-left: 250px">Not Found</div>
<div style="text-align: center; color: red;margin-left: -100px; margin-top: 20px">Извините, но такая страница на нашем сайте отсутствует :-(</div>
</div>
<?
include 'footer.php';
?>

 </div>
</body>
</html>