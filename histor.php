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
<title>История епархии</title>

</head>
<body>

<div style="box-shadow: 0 0 20px rgba(0,0,0,0.5);">
<?
include 'golova.php';
$histor = yes;

include 'menu.php';

include 'content.php';

?>

<div id="osnovnoe">

<h1>История епархии</h1>

<?
$text='Барышская епархия входит в состав Симбирской митрополии.
Образована решением Священного Синода от |||26 июля 2012 г.||| (журнал № 61) путем выделения из состава Симбирской епархии. Включена в состав Симбирской митрополии.
Правящему архиерею Синод постановил иметь титул Барышский и Инзенский.
Объединяет приходы в административных границах Базарносызганского, Барышского, Инзенского, Николаевского, Павловского, Радищевского, Старокулаткинского районов Ульяновской области.
Первым правящим ариереем Барышской епархии избран игумен Филарет (Коньков), наместник Жадовского мужского монастыря.
||| 28 октября |||за Божественной литургией, которую возглавил Святейший Патриарх Московский и всея Руси Кирилл,  в Никольском соборе Никольского Черноостровского монастыря (Калужская обл.) архимандрит Филарет рукоположен во епископа Барышского и Инзенского.';

  	$patterns = array ('/(?:\/{3})(.+)(?:\/{3})/U', '/(?:\|{3})(.+)(?:\|{3})/U', '/(?:\{{3})(http:\/\/[^\s\[<\(\)\|]+)(?:\}{3})-(?:\{{3})([^}]+)(?:\}{3})/i', '/(?:\{{3})(http:\/\/[^\s\[<\(\)\|]+)(?:\}{3})/i', '/(?:\{{3})([_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z]{2,3}))(?:\}{3})/', '/\n/', '/@R(\d+)[-]?([^@]*)@/', '/@L(\d+)[-]?([^@]*)@/');
	$replace = array ('<i>${1}</i>', '<b>${1}</b>', '<a href="${1}" target=_blank>${2}</a>', '<a href="${1}" target=_blank>${1}</a>', '<a href="mailto:${1}">${1}</a>', '</p><p>', '<span class="photos"><a href="FOTO/${1}.jpg" rel="example_group"><img style="border: 1px solid #BEC7BE; margin: 5px 10px 5px 10px;display: block;float: right;" src="FOTO_MINI/${1}.jpg" alt="${2}" title="${2}" /></a></span>', '<span class="photos"><a href="FOTO/${1}.jpg" rel="example_group"><img style="border: 1px solid #BEC7BE; margin: 5px 10px 5px 10px;display: block;float: left;" src="FOTO_MINI/${1}.jpg" alt="${2}" title="${2}" /></a></span>');
	$text = preg_replace($patterns, $replace, $text);
echo '<p>'.$text.'</p>';

?>

</div>

<?
include 'footer.php';
?>

 </div>
</body>
</html>