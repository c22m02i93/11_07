<?
$id = $_GET['id'];

 mysql_connect("localhost", "host1409556", "0f7cd928"); 
 mysql_query("SET NAMES 'cp1251'");
mysql_query("DELETE FROM host1409556_barysh.raspisanie WHERE id = '$id'");

Header ("Location: raspisanie.php");

?>