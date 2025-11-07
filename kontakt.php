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
<title>Контакты</title>

</head>
<body>

<div style="box-shadow: 0 0 20px rgba(0,0,0,0.5);">
<?
include 'golova.php';
$kontakt = yes;

include 'menu.php';
include 'content.php';

?>

<div id="osnovnoe">
<h1>Контакты</h1>

<p><span class="title"><b>Барышское епархиальное управление</b></span></p>
<p><b>Адрес:</b> 433750, Ульяновская область, г.Барыш, пер. Пушкина, д.26.</p>
<p><b>Телефон/факс:</b> 8 (84253) 2-26-26.</p>
<p><b>E-mail:</b> <a href="mailto:upravlenie@barysh-eparhia.ru">upravlenie@barysh-eparhia.ru</a></p><br />
<p><b>Секретарь управления:</b> Протоиерей Александр Егоров.</p>
<p><b>Телефон:</b> +7 991 461 54 88</p> <p style="color: #666">(звонки только в рабочее время: вторник, среда, четверг с 10:00 до 14:00).</p>
<br />
<p><span class="title"><b>Дни приема правящим архиереем</b></span></p>
<p><b>Вторник</b> - с 10:00 до 14:00</p>
<p><b>Среда</b> - с 10:00 до 14:00</p>
<p><b>Четверг</b> - с 10:00 до 14:00</p>
<p>Прием осуществляется по адресу: г.Барыш, пер. Пушкина, д.26.</p>
<br />
<p><span class="title"><b>Пресс-служба епархии</b></span></p>
<p><b>Пресс-секретарь:</b> диакон Валерий Викторович Шигаев  
<p><b>Телефон:</b> 8-917-638-08-75.</p>
<p><b>E-mail:</b> <a href="mailto:vashigaev@yandex.ru">vashigaev@yandex.ru</a></p>
<br />
<hr />
<p><span class="title"><b>Епархиальный склад</b></span></p>
<p><b>E-mail:</b> <a href="mailto:sklad@barysh-eparhia.ru">sklad@barysh-eparhia.ru</a></p>
<br />
<p><span class="title"><b>Реквизиты для пожертвований</b></span></p>
<p>Ульяновское отделение № 8588 г.Ульяновск Сбербанка России</p>
<p>ИНН: 7306042434 </p>
<p>КПП: 730601001</p>
<p>БИК: 047308602</p>
<p>К/с № 30101810000000000602</p>
<p>Р/с № 40703810869000095051</p>
<p>Получатель - Религиозная организация «Барышская Епархия Русской Православной Церкви (Московский Патриархат)»</p>
<br />
<hr />
<p><span class="title"><b>Наши баннеры</b></span></p>
<table width="500" align="left" cellpadding="5" cellspacing="0" border="0" style="margin-left: 15px">
<tr><td>
<TEXTAREA COLS=40 ROWS=10><a href='http://www.barysh-eparhia.ru/' target=_blank><img src='http://www.barysh-eparhia.ru/IMG/banner.png' width=164 height=63 title="Барышская епархия" alt='Барышская епархия'></a>
</TEXTAREA>
</td><td>
<img src="IMG/banner.png" /><br />
<p><span style="font-size:12px;">(164х63 px)</span></p>
</td></tr>
</table>

<table width="500" align="left" cellpadding="5" cellspacing="0" border="0" style="margin-left: 15px">
<tr><td>
<TEXTAREA COLS=40 ROWS=10><a href='http://www.barysh-eparhia.ru/' target=_blank><img src='http://www.barysh-eparhia.ru/IMG/banner_mini.png' width=88 height=34 title="Барышская епархия" alt='Барышская епархия'></a>
</a>
</TEXTAREA>
</td><td>
<img src="IMG/banner_mini.png" /><br />
<p><span style="font-size:12px;">(88x34 px)</span></p>
</td></tr>
</table>

</div>

<?
include 'footer.php';
?>

 </div>
</body>
</html>