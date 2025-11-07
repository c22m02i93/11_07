<?
mysql_connect("localhost", "host1409556", "0f7cd928"); 
mysql_query("SET NAMES 'cp1251'");
ini_set('date.timezone', 'Europe/Samara');
$data_today = Date("Y.m.d H:i");

$news_all_wer = mysql_query("SELECT * FROM host1409556_barysh.news_eparhia_cron WHERE data = '$data_today'");
for ($t=0; $t<mysql_num_rows($news_all_wer); $t++)
{
	$news_wer = mysql_fetch_array($news_all_wer); 
 $datatime = $news_wer['data'];
 $b = $news_wer['oblozka'];
 $tema = $news_wer['tema'];
 $kratko = $news_wer['kratko'];
 $news = $news_wer['text'];
 $albom = $news_wer['albom'];
 $video = $news_wer['video'];
 $sluzba = $news_wer['views'];

		mysql_query("INSERT INTO host1409556_barysh.news_eparhia VALUES ('$datatime', '$b', '$tema', '$kratko', '$news', '$albom', '$video', '0')");
	   mysql_query("UPDATE host1409556_barysh.news_day SET data='$datatime', oblozka='$b', tema='$tema', text='$kratko', page='news'");
	   $url = 'news_show';
   	   mysql_query("UPDATE host1409556_barysh.raspisanie SET sluzba='$datatime' WHERE id='$sluzba'");
   	   mysql_query("INSERT INTO host1409556_barysh.news VALUES ('$datatime', '$url', '$tema', '$kratko')");
}
?>