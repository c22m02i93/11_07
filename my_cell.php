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
<title>Мой кабинет</title>
<style>
a.disabled {
    pointer-events: none; /* делаем ссылку некликабельной */
    cursor: default;  /* устанавливаем курсор в виде стрелки */
    color: #999; /* цвет текста для нективной ссылки */
}
</style>
</head>
<body>

<div style="box-shadow: 0 0 20px rgba(0,0,0,0.5);">
<?
include 'golova.php';

include 'menu.php';

include 'content.php';

?>

<div id="osnovnoe">
<h1>Мой кабинет</h1>

<div style="float:left">

<p><a href="my_cron.php" style="color: red">Отложенные новости</a></p>
<p><a href="my_anons.php">Анонсы и объявления</a></p>
<p><a href="my_audio.php">Аудио</a></p>
<p><a href="my_video.php">Видео</a></p>
<p><a href="my_gazeta.php">Газета "Моя епархия"</a></p>
<p><a href="my_doks.php">Документы</a></p>
<p><a href="my_docs.php">Документы на сервер</a></p>
<p><a href="my_hod.php">Крестный ход</a></p>
<p><a href="my_news.php">Новости</a></p>
<p><a href="my_news_ep.php">Новости епархии</a></p>
<p><a href="my_news_day.php">Новость дня</a></p>
<p><a href="my_prihods.php">Приходы</a></p>
<p><a href="my_pub.php">Публикации</a></p>
<p><a href="my_radio.php">Радиопередача "Светлый вечер"</a></p>
<p><a href="my_old_prihods.php">Разрушенные храмы</a></p>
<p><a href="my_raspisanie.php">Расписание</a></p>
<p><a href="my_padre.php">Слово архипастыря</a></p>
<p><a href="my_foto.php">Фотографии</a></p>
<p><a href="my_hod_foto.php">Фотоотчет крестного хода</a></p>
<hr />
<p><a href="my_raspisanie_all.php">Все служение владыки</a></p>
<hr />
<p><a <? if ($name_user == 'Стас') echo 'onclick="return false" class="disabled"';?> href="add_klir.php">Добавление клириков</a></p>
<p><a <? if ($name_user == 'Стас') echo 'onclick="return false" class="disabled"';?> href="my_klir.php">Духовенство</a></p>
<hr />
<p><a href="kalendar.php">Календарь епархии</a></p>

</div>
</div>

<?
include 'footer.php';
?>

 </div>
</body>
</html>