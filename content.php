<!--noindex--><div id="content_right"> 
<div class="box"><h3>События</h3>
 <?   mysql_connect("localhost", "host1409556", "0f7cd928");
 mysql_query("SET NAMES 'cp1251'");
	$news_all = mysql_query("SELECT * FROM host1409556_barysh.news ORDER BY data DESC LIMIT 5");
	for ($t=0; $t<mysql_num_rows($news_all); $t++)
{
$news = mysql_fetch_array($news_all); 

$dtn = $news[data]; 
$yyn = substr($dtn,0,4); // Год
$mmn = substr($dtn,5,2); // Месяц
$ddn = substr($dtn,8,2); // День

// Переназначаем переменные
if ($mmn == "01") $mm1n="янв.";
if ($mmn == "02") $mm1n="фев.";
if ($mmn == "03") $mm1n="мар.";
if ($mmn == "04") $mm1n="апр.";
if ($mmn == "05") $mm1n="мая";
if ($mmn == "06") $mm1n="июн.";
if ($mmn == "07") $mm1n="июл.";
if ($mmn == "08") $mm1n="авг.";
if ($mmn == "09") $mm1n="сен.";
if ($mmn == "10") $mm1n="окт.";
if ($mmn == "11") $mm1n="нояб.";
if ($mmn == "12") $mm1n="дек.";

if ($ddn == "01") $ddn="1";
if ($ddn == "02") $ddn="2";
if ($ddn == "03") $ddn="3";
if ($ddn == "04") $ddn="4";
if ($ddn == "05") $ddn="5";
if ($ddn == "06") $ddn="6";
if ($ddn == "07") $ddn="7";
if ($ddn == "08") $ddn="8";
if ($ddn == "09") $ddn="9";

$hours = substr($dtn,11,5); // Время 

$ddttn = '<span class="date">'.$ddn.' '.$mm1n.' '.$yyn.' г. '.$hours.'</span>'; // Конечный вид строки

	$patterns = array ('/\n/');
	$replace = array ('</p><p>');
	$text = preg_replace($patterns, $replace, $news[text]);

echo $ddttn;

if ($auth == 1) echo '<a href="delete_news.php?data='.$news[data].'"><img style="display: block;float: right;border: 0; margin: 0 5px 0 0; " src="IMG/delete.png"/></a>';

echo '<p><a href="'.$news[url].'.php?data='.$news[data].'">'.$news[tema].'</a></p><p>'.$text.'</p><br />';
}
?>
</div>
<br />

<div class="box"><h3>Карта приходов</h3>
<a href="http://www.barysh-eparhia.ru/map.php" ><CENTER><img style="border: #BEC7BE 1px solid; width: 75%; margin: 0 auto" src="IMG/map.png" /></CENTER></a>
</div>

<br />

<div style="text-align: center"><a href="http://ekzeget.ru/" target="_blank" ><img style="width: 75%; margin: 0 auto" src="/IMG/ekzeget.png" border="0" /></a>
</div>
<br />
</div>
<!--/noindex-->