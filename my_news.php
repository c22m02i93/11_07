<?php
declare(strict_types=1);

use App\Service\NewsService;

if (isset($_REQUEST[session_name()])) {
    session_start();
}
$auth = $_SESSION['auth'];
$name_user = $_SESSION['name_user'];
if ($auth != 1) {
    header('Location: my_auth.php');
    exit;
}

require_once __DIR__ . '/vendor/autoload.php';

$newsService = new NewsService();
$submit = $_POST['submit'] ?? null;
if ($submit) {
    $news = $_POST['news'] ?? '';
    if ($news !== '') {
        $newsService->createDailyEntry($news);
        echo '<p style="color:#135B00; text-align: center"><b>Новость добавлена!</b></p><br />';
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
include 'head.php';
?>
<title>Добавление новостей</title>

</head>
<body>

<div style="box-shadow: 0 0 20px rgba(0,0,0,0.5);">
<?php
include 'golova.php';

include 'menu.php';

include 'content.php';
?>
<div id="osnovnoe">

<h1>Добавление новостей</h1>

        <TABLE CELLSPACING=3 CELLPADDING=2 width='500' align='center' border=0>
        <FORM ACTION='<?php echo 'my_news.php'; ?>' method='post'>
        <TR><TD VALIGN=top><B>Новость:</B></TD><TD></TD></TR>
                <TR><TD colspan=2><TEXTAREA NAME='news' COLS=55 ROWS=20 required></TEXTAREA></TD></TR>
        <TR><TD colspan=2>
        <INPUT TYPE='submit' name='submit' value='Добавить' />
        <INPUT TYPE='reset' value='Очистить'></TD></TR>
 </FORM>

        </TABLE>

</div>

<?php
include 'footer.php';
?>

 </div>
</body>
</html>
