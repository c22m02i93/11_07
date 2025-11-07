<?php
// Задаем формат даты
define('DATE_FORMAT_RFC822','r');
// Сообщяем браузеру что передаем XML
header("Content-type: text/xml; charset=windows-1251");

// Дата последней сборки фида
$lastBuildDate=date(DATE_FORMAT_RFC822);

echo <<<END
<?xml version="1.0" encoding="windows-1251"?>
<rss version="2.0">
<channel>
    <title>Новости Барышской епархии</title>
    <link>http://barysh-eparhia.ru</link>
    <description>Новости и анонсы Барышской епархии (Симбирская митрополия)</description>
    <pubDate>$lastBuildDate</pubDate>
    <lastBuildDate>$lastBuildDate</lastBuildDate>
    <docs>http://blogs.law.harvard.edu/tech/rss</docs>
    <generator>Weblog Editor 2.0</generator>
    <managingEditor>admin@barysh-eparhia.ru</managingEditor>
    <language>ru</language>
END;
 mysql_connect("localhost", "host1409556", "0f7cd928"); 
mysql_query("SET NAMES 'cp1251'");
 $result=MYSQL_QUERY("SELECT url, tema, text, data, UNIX_TIMESTAMP(data) as pubdate FROM host1409556_barysh.news ORDER BY data DESC LIMIT 10");
    while ($row=MYSQL_FETCH_ARRAY($result))
   {
     $id=$row['url'];
     $title=$row['tema'];
     $text=$row['text'];
	 $date=$row['data'];
$pubDate = date(DATE_FORMAT_RFC822, $row['pubdate']);

 echo '<item>
            <title>'.$title.'</title>
            <link>http://barysh-eparhia.ru/'.$id.'.php?data='.$date.'</link>
            <description><p>'.$text.'</p></description>
            <pubDate>'.$pubDate.'</pubDate>
         </item>';
   }     
   echo '</channel>
   </rss>';      
   ?>