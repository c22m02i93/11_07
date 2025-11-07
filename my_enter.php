<?
$login = $_POST['login'];
$pass = $_POST['pass'];
$login=strip_tags($login);
$pass=strip_tags($pass);
$login=substr($login,0,30);
$pass=substr($pass,0,30);

  	$p_msg = array ('/\\\/', '/\"/', '/\'/', '/\`/', '/\%/', '/\$/', '/\</', '/\>/');
	$r_msg = array ('&#092;', '&quot;', '&#039;', '&#096;', '&#037;', '&#036;', '&#060;', '&#062;');
	$login = preg_replace($p_msg, $r_msg, $login);
	$pass = preg_replace($p_msg, $r_msg, $pass);

 /* Соединяемся, выбираем базу данных */
    $connect = mysql_connect("localhost", "host1409556", "0f7cd928");
    mysql_query("SET NAMES 'cp1251'");
	 
	 $x=mysql_query("SELECT * FROM host1409556_barysh.admin WHERE login LIKE '$login' AND passw LIKE '$pass'");
	 
if (mysql_num_rows($x) == 1) {
session_start ();
$_SESSION['auth'] = "1";
$_SESSION['name_user'] = "$login";
Header ("Location: my_cell.php");
}
else Header ("Location: my_auth.php");

?>