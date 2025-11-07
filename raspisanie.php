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
<title>Àðõèåðåéñêîå ñëóæåíèå</title>

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
<h1>Àðõèåðåéñêîå ñëóæåíèå</h1>

<? 
  if(!isset($_GET['page'])){
  $p = 1;
}
else{
  $p = addslashes(strip_tags(trim($_GET['page'])));
  if($p < 1) $p = 1;
}
$num_elements = 15;
$cover_html = '';
if (!empty($res['sluzba'])) {
	$sluzba_data = mysql_real_escape_string($res['sluzba']);
	$cover_query = mysql_query("SELECT oblozka FROM host1409556_barysh.news_eparhia WHERE data = '$sluzba_data' LIMIT 1");
	if ($cover_query && mysql_num_rows($cover_query) == 0) {
		$cover_query = mysql_query("SELECT oblozka FROM host1409556_barysh.news_eparhia_cron WHERE data = '$sluzba_data' LIMIT 1");
	}
	if ($cover_query && mysql_num_rows($cover_query) > 0) {
		$cover_row = mysql_fetch_array($cover_query);
		if (!empty($cover_row['oblozka'])) {
			$cover_path = $cover_row['oblozka'];
			$cover_html = '<span class="photos"><a href="FOTO/'.$cover_path.'.jpg" rel="example_group" title=""><img style="box-shadow: 2px 2px 5px rgba(0,0,0,0.3); display: inline; float: left; border: 1px solid #C3D7D4; margin: 0 10px 5px 10px; padding: 10px; width: 150px; height: auto;" src="FOTO/'.$cover_path.'.jpg" alt="" /></a></span>';
		}
	}
}

echo $cover_html.'<p>'.$text;
$num_pages = ceil($total / $num_elements); //Ïîäñ÷åò ÷èñëà ñòðàíèö
if ($p > $num_pages) $p = $num_pages;
$start = ($p - 1) * $num_elements; //Ñòàðòîâàÿ ïîçèöèÿ âûáîðêè èç ÁÄ
                    
					
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
if ($res['sluzba']) echo ' + <a href="news_show.php?data='.$res['sluzba'].'"><b>ÑÒÀÒÜß</b></a>';
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