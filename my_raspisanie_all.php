<?
if (isset($_REQUEST[session_name()])) session_start ();
$auth=$_SESSION['auth'];
$name_user=$_SESSION['name_user'];
if ($auth!=1) {Header ("Location: my_auth.php");}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?
include 'head.php';
?>
<title>Все служение владыки</title>

</head>
<body>

<div style="box-shadow: 0 0 20px rgba(0,0,0,0.5);">
<?
include 'golova.php';

include 'menu.php';

include 'content.php';

$data_year = $_POST['data_year'];
?>

<div id="osnovnoe">
<h1>Все служение владыки</h1>
<? if (isset($data_year)) echo '<!--';
	?>
	
	<TABLE CELLSPACING=3 CELLPADDING=2 width='400' align='center' border=0>
        <FORM ACTION='<? echo 'my_raspisanie_all.php'; ?>' method='post'>
		<TR><TD VALIGN=top><b>За год (в формате 'ГГГГ'):</B></TD><TD></TD></TR>
		<TR><TD colspan=2>
		
<INPUT TYPE="TEXT" NAME="data_year" SIZE=5 maxlength="4" />

	<TR><TD colspan=2>
	<INPUT TYPE='submit' name='submit' value='Найти'/>
        <INPUT TYPE='reset' value='Очистить'></TD></TR>
 </FORM>  

	</TABLE>	

<? if (isset($data_year)) echo '-->';
 if (!isset($data_year)) echo '<!--';

$data_year_last = $data_year - 1;
    mysql_connect("localhost", "host1409556", "0f7cd928"); 

	$news_all = mysql_query("SELECT * FROM host1409556_barysh.raspisanie where data between '$data_year_last.12.01' and '$data_year.11.31' ORDER BY data ASC, (text+0) ASC");
	echo '<p><b>Всего найдено '.mysql_num_rows($news_all).'</b></p>';
	for ($t=0; $t<mysql_num_rows($news_all); $t++)
{
$news = mysql_fetch_array($news_all); 
$dd_today = substr($news['data'],8,2); // День
$mm_today = substr($news['data'],5,2); // Месяц
$yy_today = substr($news['data'],0,4); // Год
$data = $dd_today.'.'.$mm_today.'.'.$yy_today;
echo '<p><b>'.$data.'</b> ';
/* 	$patterns = array ('/\n/', '/(\d{1,2}:\d{2})/');
	$replace = array ('</p><p>', '<b>${1}</b>');
 */	
	$patterns = array ('/(\d{1,2}:\d{2}\s\-\s)/');
	$replace = array ('');
	$text = preg_replace($patterns, $replace, $news[text]);
	$text = strip_tags ($text);

echo $text;
//if ($news['sluzba']) echo ' + <a href="news_show.php?data='.$news['sluzba'].'"><b>СТАТЬЯ</b></a>';
echo '</p><br />';
}

if (!isset($data_year)) echo '-->';
?>



</div>

<?
include 'footer.php';
?>

 </div>
</body>
</html>