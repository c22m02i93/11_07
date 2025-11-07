<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?
include 'head.php';
?>
<title>Вход</title>

</head>
<body>

<div style="box-shadow: 0 0 20px rgba(0,0,0,0.5);">
<?
include 'golova.php';

include 'menu.php';

include 'content.php';

?>
<div id="osnovnoe">

<h1>Авторизация</h1>
 <table align='center'><tr><td><form action='my_enter.php' method=post>
 Имя: </td><td><input type="text" name='login' size='15' maxlength='30'></td></tr>
<tr><td> Пароль: </td><td><input type='password' name='pass' size='15' maxlength='20'><br /></td></tr>
<tr><td></td><td> <input type='submit' value='Войти'></form></td></tr>
</table>
<div style='text-align: center'><b>Cookies должны быть включены!</b></div>

</div>

<?
include 'footer.php';
?>

 </div>
</body>
</html>