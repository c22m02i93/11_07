<?
function yearRus($a, $one, $two, $many)
{
	if (substr($a, -1) == 0 || substr($a, -1) == 5 || substr($a, -1) == 6 || substr($a, -1) == 7 || substr($a, -1) == 8 || substr($a, -1) == 9) $itog = $many;
if (substr($a, -1) == 1 && substr($a, -2,2) != 11) $itog = $one;
if (substr($a, -2,2) == 11) $itog = $many;
if (substr($a, -1) == 2 && substr($a, -2,2) != 12) $itog = $two;
if (substr($a, -2,2) == 12) $itog = $many;
if (substr($a, -1) == 3 && substr($a, -2,2) != 13) $itog = $two;
if (substr($a, -2,2) == 13) $itog = $many;
if (substr($a, -1) == 4 && substr($a, -2,2) != 14) $itog = $two;
if (substr($a, -2,2) == 14) $itog = $many;
return $itog;
}

function GetNav($p, $num_pages, $url){
 
//Проверяем нужна ли ссылка "На первую"
  if($p > 4){
    $first_page = '<a href="/'.$url.'.php?page=1">1...</a> ';   //или просто $first_page = '<a href="/'.$url.'.php"><<</a>';
  }
  elseif ($p > 3){
    $first_page = '<a href="/'.$url.'.php?page=1">1</a> ';   //или просто $first_page = '<a href="/'.$url.'.php"><<</a>';
  }
  else{
    $first_page = '';
  }
 
//Проверяем нужна ли ссылка "На последнюю"
  if($p < ($num_pages - 3)){
    $last_page = ' <a href="/'.$url.'.php?page='.$num_pages.'">...'.$num_pages.'</a> ';
  } elseif($p < ($num_pages - 2)){
    $last_page = ' <a href="/'.$url.'.php?page='.$num_pages.'">'.$num_pages.'</a> ';
  }
  else{
    $last_page = '';
  }
 
//Проверяем нужна ли ссылка "На предыдущую"
  if($p > 1){
    $prev_page = ' <a href="/'.$url.'.php?page='.($p - 1).'">Предыдущая</a> | ';
  }
  else{
    $prev_page = '<span style="color:#999;font-family: Arial">Предыдущая </span>| ';
  }
 
//Проверяем нужна ли ссылка "На следущую"
  if($p < $num_pages){
    $next_page = ' | <a href="/'.$url.'.php?page='.($p + 1).'">Следующая</a>';
  }
  else{
    $next_page = ' | <span style="color:#999;font-family: Arial">Следующая</span>';
  }
 
//Формируем по 2 страницы до и после текущей (при наличии таковых, конечно):
  if($p - 2 > 0){
    $prev_2_page = ' <a href="/'.$url.'.php?page='.($p - 2).'">'.($p - 2).'</a> ';
  }
  else{
    $prev_2_page = '';
  }
  if($p - 1 > 0){
    $prev_1_page = ' <a href="/'.$url.'.php?page='.($p - 1).'">'.($p - 1).'</a> ';
  }
  else{
    $prev_1_page = '';
  }
  if($p + 2 <= $num_pages){
    $next_2_page = ' <a href="/'.$url.'.php?page='.($p + 2).'">'.($p + 2).'</a> ';
  }
  else{
    $next_2_page = '';
  }
  if($p + 1 <= $num_pages){
    $next_1_page = ' <a href="/'.$url.'.php?page='.($p + 1).'">'.($p + 1).'</a> ';
  }
  else{
    $next_1_page = '';
  }
  $nav = '<div style="text-align:center;width:100%;"><span  style="font-family: Arial">'.$prev_page.$first_page.$prev_2_page.$prev_1_page.'<b>'.$p.'</b>'.$next_1_page.$next_2_page.$last_page.$next_page.'</span></div>';
 if ($num_pages > 1) return $nav;
}
function GetNavtip($p, $num_pages, $url, $tip){
 
//Проверяем нужна ли ссылка "На первую"
  if($p > 4){
    $first_page = '<a href="/'.$url.'.php?page=1&tip='.$tip.'">1...</a> ';   //или просто $first_page = '<a href="/'.$url.'.php"><<</a>';
  }
  elseif ($p > 3){
    $first_page = '<a href="/'.$url.'.php?page=1&tip='.$tip.'">1</a> ';   //или просто $first_page = '<a href="/'.$url.'.php"><<</a>';
  }
  else{
    $first_page = '';
  }
 
//Проверяем нужна ли ссылка "На последнюю"
  if($p < ($num_pages - 3)){
    $last_page = ' <a href="/'.$url.'.php?page='.$num_pages.'&tip='.$tip.'">...'.$num_pages.'</a> ';
  } elseif($p < ($num_pages - 2)){
    $last_page = ' <a href="/'.$url.'.php?page='.$num_pages.'&tip='.$tip.'">'.$num_pages.'</a> ';
  }
  else{
    $last_page = '';
  }
 
//Проверяем нужна ли ссылка "На предыдущую"
  if($p > 1){
    $prev_page = ' <a href="/'.$url.'.php?page='.($p - 1).'&tip='.$tip.'">Предыдущая</a> | ';
  }
  else{
    $prev_page = '<span style="color:#999;font-family: Arial">Предыдущая </span>| ';
  }
 
//Проверяем нужна ли ссылка "На следущую"
  if($p < $num_pages){
    $next_page = ' | <a href="/'.$url.'.php?page='.($p + 1).'&tip='.$tip.'">Следующая</a>';
  }
  else{
    $next_page = ' | <span style="color:#999;font-family: Arial">Следующая</span>';
  }
 
//Формируем по 2 страницы до и после текущей (при наличии таковых, конечно):
  if($p - 2 > 0){
    $prev_2_page = ' <a href="/'.$url.'.php?page='.($p - 2).'&tip='.$tip.'">'.($p - 2).'</a> ';
  }
  else{
    $prev_2_page = '';
  }
  if($p - 1 > 0){
    $prev_1_page = ' <a href="/'.$url.'.php?page='.($p - 1).'&tip='.$tip.'">'.($p - 1).'</a> ';
  }
  else{
    $prev_1_page = '';
  }
  if($p + 2 <= $num_pages){
    $next_2_page = ' <a href="/'.$url.'.php?page='.($p + 2).'&tip='.$tip.'">'.($p + 2).'</a> ';
  }
  else{
    $next_2_page = '';
  }
  if($p + 1 <= $num_pages){
    $next_1_page = ' <a href="/'.$url.'.php?page='.($p + 1).'&tip='.$tip.'">'.($p + 1).'</a> ';
  }
  else{
    $next_1_page = '';
  }
  $nav = '<div style="text-align:center;width:100%;"><span style="font-family: Arial">'.$prev_page.$first_page.$prev_2_page.$prev_1_page.'<b>'.$p.'</b>'.$next_1_page.$next_2_page.$last_page.$next_page.'</span></div>';
 if ($num_pages > 1) return $nav;
}
function rus2translit($string) {

$yyn = substr($string,0,4); // Год
$mmn = substr($string,5,2); // Месяц
$ddn = substr($string,8,2); // День

// Переназначаем переменные
if ($mmn == "01") $mm1n="января";
if ($mmn == "02") $mm1n="февраля";
if ($mmn == "03") $mm1n="марта";
if ($mmn == "04") $mm1n="апреля";
if ($mmn == "05") $mm1n="мая";
if ($mmn == "06") $mm1n="июня";
if ($mmn == "07") $mm1n="июля";
if ($mmn == "08") $mm1n="августа";
if ($mmn == "09") $mm1n="сентября";
if ($mmn == "10") $mm1n="октября";
if ($mmn == "11") $mm1n="ноября";
if ($mmn == "12") $mm1n="декабря";

if ($ddn == "01") $ddn="1";
if ($ddn == "02") $ddn="2";
if ($ddn == "03") $ddn="3";
if ($ddn == "04") $ddn="4";
if ($ddn == "05") $ddn="5";
if ($ddn == "06") $ddn="6";
if ($ddn == "07") $ddn="7";
if ($ddn == "08") $ddn="8";
if ($ddn == "09") $ddn="9";
$itog= $ddn.' '.$mm1n;

return $itog;

}
function nedel ($time2) {
// массив с названиями дней недели
 $days = array('Воскресенье' , 'Понедельник' , 'Вторник' , 'Среда' , 'Четверг' , 'Пятница' , 'Суббота' );
// номер дня недели
// с 0 до 6, 0 - воскресенье, 6 - суббота
$tmp=explode(".", $time2);
   $time2 = $tmp[2].".".$tmp[1].".".$tmp[0];
   $num_day = (date('w', strtotime($time2)));
$nedel = '&nbsp; <span style="color: #777">' . $days[$num_day] . '</span>';
return $nedel;

}

?>