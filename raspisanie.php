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
<title>Архиерейское служение</title>

</head>
<body>

<div style="box-shadow: 0 0 20px rgba(0,0,0,0.5);">
<?
include 'golova.php';
$raspisanie = yes;

include 'menu.php';
include 'function.php';

include 'content.php';

$data_year = $_POST['data_year'];
?>

<div id="osnovnoe">
<h1>Архиерейское служение</h1>

<? 
  if(!isset($_GET['page'])){
  $p = 1;
}
else{
  $p = addslashes(strip_tags(trim($_GET['page'])));
  if($p < 1) $p = 1;
}
$num_elements = 15;
$total = mysql_result(mysql_query("SELECT COUNT(*) FROM host1409556_barysh.raspisanie"),0,0); //Подсчет общего числа записей
$num_pages = ceil($total / $num_elements); //Подсчет числа страниц
if ($p > $num_pages) $p = $num_pages;
$start = ($p - 1) * $num_elements; //Стартовая позиция выборки из БД
                    
					
  echo GetNav($p, $num_pages, "raspisanie").'<hr />';
            $sel = "SELECT * FROM host1409556_barysh.raspisanie ORDER BY data DESC, (text+0) DESC LIMIT ".$start.", ".$num_elements;
            $query = mysql_query($sel);
            if(mysql_num_rows($query)>0){

			while($res = mysql_fetch_array($query)){
echo '<b>'.$res[data_text].'</b> - '.$res[nedel];
if ($auth == 1) echo '<a href="delete_raspisanie.php?id='.$res[id].'"><img style="display: block;float: right;border: 0; margin: 0 5px 0 0; " src="IMG/delete.png"/></a>';

echo '<br />';
	$patterns = array ('/\n/', '/(\d{1,2}:\d{2})/');
	$replace = array ('</p><p>', '<b>${1}</b>');
	$text = preg_replace($patterns, $replace, $res[text]);

echo '<p>'.$text;
if ($res['sluzba']) echo ' + <a href="news_show.php?data='.$res['sluzba'].'"><b>СТАТЬЯ</b></a>';
echo '</p><br />

  <hr />
';
}
}
  echo GetNav($p, $num_pages, "raspisanie").'<hr />';

?>



</div>

<?
include 'footer.php';
?>

 </div>
</body>
</html>