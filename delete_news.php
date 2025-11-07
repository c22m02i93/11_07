<?
$data = $_GET['data'];

 mysql_connect("localhost", "host1409556", "0f7cd928"); 
 mysql_query("SET NAMES 'cp1251'");
mysql_query("DELETE FROM host1409556_barysh.news WHERE data = '$data'");

Header ("Location: my_cell.php");

?>