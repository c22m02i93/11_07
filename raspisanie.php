<?php
declare(strict_types=1);

use App\Service\ScheduleService;

if (isset($_REQUEST[session_name()])) {
    session_start();
}
$auth = $_SESSION['auth'];
$name_user = $_SESSION['name_user'];

require_once __DIR__ . '/vendor/autoload.php';

$scheduleService = new ScheduleService();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
include 'head.php';
?>
<title>Архиерейское служение</title>

</head>
<body>

<div style="box-shadow: 0 0 20px rgba(0,0,0,0.5);">
<?php
include 'golova.php';
$raspisanie = yes;

include 'menu.php';
include 'function.php';

include 'content.php';

$data_year = $_POST['data_year'];
?>

<div id="osnovnoe">
<h1>Архиерейское служение</h1>

<?php
if (!isset($_GET['page'])) {
    $p = 1;
} else {
    $p = addslashes(strip_tags(trim($_GET['page'])));
    if ($p < 1) {
        $p = 1;
    }
}
$num_elements = 15;

$total = $scheduleService->count();
$num_pages = ($total > 0) ? ceil($total / $num_elements) : 1;
if ($num_pages < 1) {
    $num_pages = 1;
}
if ($p > $num_pages) {
    $p = $num_pages;
}
if ($p < 1) {
    $p = 1;
}
$start = ($p - 1) * $num_elements;


echo GetNav($p, $num_pages, "raspisanie").'<hr />';
$scheduleItems = $scheduleService->getPaginated($num_elements, $start);
if (!empty($scheduleItems)) {
    foreach ($scheduleItems as $res) {
        echo '<b>'.$res['data_text'].'</b> - '.$res['nedel'];
        if ($auth == 1) {
            echo '<a href="delete_raspisanie.php?id='.$res['id'].'"><img style="display: block;float: right;border: 0; margin: 0 5px 0 0; " src="IMG/delete.png"/></a>';
        }

        echo '<br />';
        $patterns = array ('/\n/', '/(\d{1,2}:\d{2})/');
        $replace = array ('</p><p>', '<b>${1}</b>');
        $text = preg_replace($patterns, $replace, $res['text']);

        $cover_html = '';
        if (!empty($res['sluzba'])) {
            $coverSrc = $scheduleService->findCover($res['sluzba']);
            if (!empty($coverSrc)) {
                if (strpos($coverSrc, '/') !== false || preg_match('/\.\w{2,4}$/', $coverSrc)) {
                    $coverFull = $coverSrc;
                    $coverThumb = $coverSrc;
                } else {
                    $coverFull = 'FOTO/'.$coverSrc.'.jpg';
                    $coverThumb = 'FOTO_MINI/'.$coverSrc.'.jpg';
                }

                $cover_html = '<span class="photos"><a href="'.$coverFull.'" rel="example_group" title=""><img style="box-shadow: 2px 2px 5px rgba(0,0,0,0.3); display: inline; float: left; border: 1px solid #C3D7D4; margin: 0 10px 5px 10px; padding: 10px; width: 150px; height: auto;" src="'.$coverThumb.'" alt="" /></a></span>';
            }
        }

        echo $cover_html.'<p>'.$text;
        if (!empty($res['sluzba'])) {
            echo ' + <a href="news_show.php?data='.$res['sluzba'].'"><b>СТАТЬЯ</b></a>';
        }
        echo '</p><br />
  <hr />
';
    }
}
  echo GetNav($p, $num_pages, "raspisanie").'<hr />';

?>



</div>

<?php
include 'footer.php';
?>

 </div>
</body>
</html>
