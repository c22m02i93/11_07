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
<title>Управление</title>

</head>
<body>

<div style="box-shadow: 0 0 20px rgba(0,0,0,0.5);">
<?
include 'golova.php';
$upravlenie = yes;

include 'menu.php';
include 'content.php';

?>

<div id="osnovnoe">
<h1>Управление</h1>

<div class="struktura">
<div class="photos"><a href="IMG/filaret.jpg" rel="example_group"><img style="box-shadow: 2px 2px 5px rgba(0,0,0,0.3); display: inline;float: left;border: 1px solid #C3D7D4; margin: 0 10px 5px 10px; padding: 10px" src="IMG/filaret_mini.jpg" alt= "Епископ Филарет (Коньков)" title="Епископ Филарет (Коньков)"/></a></div>
<p>
<b>Епископ Филарет (Коньков)</b> - управляющий Барышской епархией.
</p>
</div>

<div class="struktura">
<div class="photos"><a href="IMG/o_alex_max.jpg" rel="example_group"><img style="box-shadow: 2px 2px 5px rgba(0,0,0,0.3); display: inline;float: left;border: 1px solid #C3D7D4; margin: 0 10px 5px 10px; padding: 10px" src="IMG/o_alex_min.jpg" alt= "Протоиерей Александр Егоров" title="Протоиерей Александр Егоров"/></a></div>
<p>
<b>Протоиерей Александр Егоров</b> - секретарь епархиального управления.
</p>
<p>Тел.: +7 991 461 54 88.</p>
</div>

<div class="struktura">
<p>
<b>Светлана Валерьевна Егорова</b> - главный бухгалтер епархиального управления.
</p>
</div>
<div class="struktura">
<div class="photos"><a href="IMG/o_daniil_max.jpg" rel="example_group"><img style="box-shadow: 2px 2px 5px rgba(0,0,0,0.3); display: inline;float: left;border: 1px solid #C3D7D4; margin: 0 10px 5px 10px; padding: 10px" src="IMG/o_daniil_min.jpg" alt= "Иеромонах Даниил (Селеверстов)" title="Иеромонах Даниил (Селеверстов)"/></a></div>
<p>
<b>Иеромонах Даниил (Селеверстов)</b> - благочинный I округа Епархии.
</p>
<p>Тел.: 8-937-036-02-50.</p>
<p>E-mail помощника: <a href="mailto:info@barysh-eparhia.ru" target="_blank">info@barysh-eparhia.ru</a></p>

</div>

<div class="struktura">
<div class="photos"><a href="IMG/o_pavel_bobrov_max.jpg" rel="example_group"><img style="box-shadow: 2px 2px 5px rgba(0,0,0,0.3); display: inline;float: left;border: 1px solid #C3D7D4; margin: 0 10px 5px 10px; padding: 10px" src="IMG/o_pavel_bobrov_min.jpg" alt= "Протоиерей Павел Бобров" title="Протоиерей Павел Бобров"/></a></div>
<p>
<b>Протоиерей Павел Бобров</b> - благочинный II округа Епархии.
</p>
<p>Тел.: 8-927-631-68-58.</p>
</p>E-mail помощника благочинного: <a href="seminarist173@gmail.com" target="_blank">seminarist173@gmail.com</a></p>

</div>

<div class="struktura">
<div class="photos"><a href="IMG/o_iosif.jpg" rel="example_group"><img style="box-shadow: 2px 2px 5px rgba(0,0,0,0.3); display: inline;float: left;border: 1px solid #C3D7D4; margin: 0 10px 5px 10px; padding: 10px" src="IMG/o_iosif_mini.jpg" alt= "Иеромонах Иосиф (Пашенцев)" title="Иеромонах Иосиф (Пашенцев)"/></a></div>
<p>
<b>Иеромонах Иосиф (Пашенцев)</b> - благочинный III округа Епархии.
</p>
<p>Тел.: 8-917-059-48-66.</p>
<p>E-mail: <a href="mailto:igor_paschenzeff@mail.ru" target="_blank">igor_paschenzeff@mail.ru</a></p>
</div>


<div class="struktura">
<div class="photos"><a href="IMG/filkin.jpg" rel="example_group"><img style="box-shadow: 2px 2px 5px rgba(0,0,0,0.3); display: inline;float: left;border: 1px solid #C3D7D4; margin: 0 10px 5px 10px; padding: 10px" src="IMG/filkin_mini.jpg" alt= "Протоиерей Андрей Филькин" title="Протоиерей Андрей Филькин"/></a></div>

<p>
<b>Протоиерей Андрей Филькин</b> - благочинный IV округа Епархии.
</p>
<p>Тел.: 8-937-036-43-33.</p>
<p>E-mail: <a href="mailto:blago3pavlovka@mail.ru" target="_blank">blago3pavlovka@mail.ru</a></p>
<p>Сайт: <a href="http://pavlovka.cerkov.ru" target="_blank">pavlovka.cerkov.ru</a></p>

</div>

<div class="struktura"><!--
<div class="photos"><a href="IMG/filkin.jpg" rel="example_group"><img style="box-shadow: 2px 2px 5px rgba(0,0,0,0.3); display: inline;float: left;border: 1px solid #C3D7D4; margin: 0 10px 5px 10px; padding: 10px" src="IMG/filkin_mini.jpg" alt= "Протоиерей Андрей Филькин" title="Протоиерей Андрей Филькин"/></a></div>
-->
<p>
<b>Протоиерей Николай Леванов</b> - благочинный V округа Епархии.
<div class="photos"><a href="IMG/о_nik_liv_max.jpg" rel="example_group"><img style="box-shadow: 2px 2px 5px rgba(0,0,0,0.3); display: inline;float: left;border: 1px solid #C3D7D4; margin: 0 10px 5px 10px; padding: 10px" src="IMG/о_nik_liv_min.jpg" alt= "Протоиерей Николай Леванов" title="Протоиерей Николай Леванов"/></a></div>
</p>
<p>Тел.: 8-927-823-52-33.</p>
<p>E-mail: <a href="mailto:nikolay.levanov@mail.ru" target="_blank">nikolay.levanov@mail.ru</a></p>

</div>

</div>

<?
include 'footer.php';
?>

 </div>
</body>
</html>