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
<title>Документы

<?
$tip = $_GET['tip'];
if ($tip == 'ukaz') echo ' - Указы';
if ($tip == 'raspor') echo ' - Распоряжения';
if ($tip == 'udostoverenie') echo ' - Удостоверения';
if ($tip == 'cirk') echo ' - Циркуляры';

?>
</title>
</head>
<body>

<div style="box-shadow: 0 0 20px rgba(0,0,0,0.5);">
<?
include 'golova.php';
include 'menu.php';

include 'content.php';
include 'function.php';

?>

<div id="osnovnoe">

<h1>Документы</h1>

 <?  

if (empty($_GET['tip'])) {
echo '<div style="margin: 15px"><a href="doks.php?tip=ukaz" style="font-size: 150%">Указы</a><br />
<a href="doks.php?tip=raspor" style="font-size: 150%">Распоряжения</a><br />
<a href="doks.php?tip=cirk" style="font-size: 150%">Циркуляры</a><br />
<a href="doks.php?tip=udostoverenie" style="font-size: 150%">Удостоверения</a></div>';
}

 if(!isset($_GET['page'])){
  $p = 1;
}
else{
  $p = addslashes(strip_tags(trim($_GET['page'])));
  if($p < 1) $p = 1;
}
$num_elements = 10;
$total = mysql_result(mysql_query("SELECT COUNT(*) FROM host1409556_barysh.doks WHERE tematika LIKE '$tip'"),0,0); //Подсчет общего числа записей
$num_pages = ceil($total / $num_elements); //Подсчет числа страниц
if ($p > $num_pages) $p = $num_pages;
$start = ($p - 1) * $num_elements; //Стартовая позиция выборки из БД
                    
					
 if ($tip) echo GetNavtip($p, $num_pages, "doks", $tip).'<hr style="width: 100%" />';
            $sel = "SELECT * FROM host1409556_barysh.doks WHERE tematika LIKE '$tip' ORDER BY date DESC LIMIT ".$start.", ".$num_elements;
            $query = mysql_query($sel);
            if(mysql_num_rows($query)>0){

			while($res = mysql_fetch_array($query)){


$dtn = $res[date]; 
$yyn = substr($dtn,0,4); // Год
$mmn = substr($dtn,5,2); // Месяц
$ddn = substr($dtn,8,2); // День

// Переназначаем переменные
if ($mmn == "01") $mm1n="января";
if ($mmn == "02") $mm1n="февраля";
if ($mmn == "03") $mm1n="марта";
if ($mmn == "04") $mm1n="апреля";
if ($mmn == "05") $mm1n="мая";
if ($mmn == "06") $mm1n="июня";
if ($mmn == "07") $mm1n="июля";
if ($mmn == "08") $mm1n="августа";
if ($mmn == "09") $mm1n="сентября";
if ($mmn == "10") $mm1n="октября";
if ($mmn == "11") $mm1n="ноября";
if ($mmn == "12") $mm1n="декабря";

if ($ddn == "01") $ddn="1";
if ($ddn == "02") $ddn="2";
if ($ddn == "03") $ddn="3";
if ($ddn == "04") $ddn="4";
if ($ddn == "05") $ddn="5";
if ($ddn == "06") $ddn="6";
if ($ddn == "07") $ddn="7";
if ($ddn == "08") $ddn="8";
if ($ddn == "09") $ddn="9";


$ddttn = $ddn.' '.$mm1n.' '.$yyn.' г.'; // Конечный вид строки

  	$patterns = array ('/(?:\/{3})(.+)(?:\/{3})/U', '/(?:\|{3})(.+)(?:\|{3})/U', '/(?:\{{3})(http:\/\/[^\s\[<\(\)\|]+)(?:\}{3})-(?:\{{3})([^}]+)(?:\}{3})/i', '/(?:\{{3})(http:\/\/[^\s\[<\(\)\|]+)(?:\}{3})/i', '/(?:\{{3})([_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z]{2,3}))(?:\}{3})/', '/\n/', '/@R(\d+)[-]?([^@]*)@/', '/@L(\d+)[-]?([^@]*)@/', '/(?:\[{3})(([0-9]*[^\]{3}]*)*)(?:\]{3})/');
	$replace = array ('<i>${1}</i>', '<b>${1}</b>', '<a href="${1}" target=_blank>${2}</a>', '<a href="${1}" target=_blank>${1}</a>', '<a href="mailto:${1}">${1}</a>', '</p><p>', '<span class="photos"><a href="FOTO/${1}.jpg" rel="example_group"><img style="border: 1px solid #C3D7D4; margin: 5px 10px 5px 10px;display: block;float: right;box-shadow: 2px 2px 5px rgba(0,0,0,0.3); padding: 10px" src="FOTO_MINI/${1}.jpg" alt="${2}" title="${2}" /></a></span>', '<span class="photos"><a href="FOTO/${1}.jpg" rel="example_group"><img style="border: 1px solid #C3D7D4; margin: 5px 10px 5px 10px;display: block;float: left;box-shadow: 2px 2px 5px rgba(0,0,0,0.3); padding: 10px" src="FOTO_MINI/${1}.jpg" alt="${2}" title="${2}" /></a></span>', '<div style="text-align: center; font-weight: bolder;Width:100%; color:#743C00">${1}</div>');

	$text = preg_replace($patterns, $replace, $res[text]);

echo '<div style="margin-left: 5px;"><span class="title">';
if ($res[tematika] == 'ukaz') echo 'Указ';
if ($res[tematika] == 'raspor') echo 'Распоряжение';
if ($res[tematika] == 'cirk') echo 'Циркуляр';
if ($res[tematika] == 'udostoverenie') echo 'Удостоверение о рукоположении в сан '.$res[name];
echo ' № '.$res[nomer].' от '.$ddttn.'</span><br />';
if ($res[tematika] != 'udostoverenie') echo '<div style="padding-left: 25%; padding-right: 15px; float:right; text-align: right; margin-top: 5px; margin-bottom: 5px"><i>'.$res[name].'</i></div><br /><br />';
echo '</div><div style="border-bottom: 1px #D7D7D7 solid; margin-top: 5px; margin-bottom: 5px">';


echo '<p>'.$text.'<br /><br /></p></div>';
}

}

 if ($tip)  echo '<table width="100%"><tr><td>'.GetNavtip($p, $num_pages, "doks", $tip).'</td></tr></table><hr style="width: 100%" />';


?>
<br />
</div>

<?
include 'footer.php';
?>

 </div>
</body>
</html>