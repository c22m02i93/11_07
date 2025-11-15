<?php
declare(strict_types=1);

use App\Service\ScheduleService;

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

$scheduleService = new ScheduleService();
$submit = $_POST['submit'] ?? null;
if ($submit) {
    $sluzba = $_POST['sluzba'] ?? '';
    $hram = $_POST['hram'] ?? '';
    $data = $_POST['data'] ?? '';
    $month = $_POST['month'] ?? '';
    $year = $_POST['year'] ?? date('Y');

    if ($sluzba !== '' && $data !== '' && $month !== '' && $year !== '') {
        $scheduleService->createEntry($sluzba, $hram, $data, $month, $year);
        echo '<p style="color:#135B00; text-align: center"><b>Расписание добавлено</b></p><br />';
    }
}

$prihods = $scheduleService->getPrihods();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
include 'head.php';
?>
<title>Расписание архиерейских служб</title>

</head>
<body>

<div style="box-shadow: 0 0 20px rgba(0,0,0,0.5);">
<?php
include 'golova.php';

include 'menu.php';

include 'content.php';
?>

<div id="osnovnoe">
<h1>Расписание архиерейских служб</h1>

        <TABLE CELLSPACING=3 CELLPADDING=2 width='400' align='center' border=0>
        <FORM ACTION='<?php echo 'my_raspisanie.php'; ?>' method='post'>
                <TR><TD VALIGN=top><b>Дата:</B></TD><TD></TD></TR>
                <TR><TD colspan=2>


<INPUT TYPE="TEXT" NAME="data" SIZE=1/>

                                <select name='month' size=1>
                <option value=января <?php if (Date("m") == '01') echo 'selected';?> >января</option>
                <option value=февраля <?php if (Date("m") == '02') echo 'selected';?>>февраля</option>
                <option value=марта <?php if (Date("m") == '03') echo 'selected';?>>марта</option>
                <option value=апреля <?php if (Date("m") == '04') echo 'selected';?>>апреля</option>
                <option value=мая <?php if (Date("m") == '05') echo 'selected';?>>мая</option>
                <option value=июня <?php if (Date("m") == '06') echo 'selected';?>>июня</option>
                <option value=июля <?php if (Date("m") == '07') echo 'selected';?>>июля</option>
                <option value=августа <?php if (Date("m") == '08') echo 'selected';?>>августа</option>
                <option value=сентября <?php if (Date("m") == '09') echo 'selected';?>>сентября</option>
                <option value=октября <?php if (Date("m") == '10') echo 'selected';?>>октября</option>
                <option value=ноября <?php if (Date("m") == '11') echo 'selected';?>>ноября</option>
                <option value=декабря <?php if (Date("m") == '12') echo 'selected';?>>декабря</option>
                </select>
                <INPUT TYPE="TEXT" value="<?php echo Date("Y");?>" NAME="year" SIZE=2/>

                </TD></TR>

        <TR><TD VALIGN=top><B>Время и служба:</B></TD><TD></TD></TR>
                <TR><TD colspan=2><INPUT TYPE="TEXT" NAME="sluzba" SIZE=40/></TD></TR>
        <TR><TD VALIGN=top><B>Храм:</B></TD><TD></TD></TR>
                <TR><TD colspan=2><INPUT TYPE="TEXT" NAME="hram" SIZE=40 list="hrams" /></TD></TR>

                <datalist id="hrams">
                <?php
                foreach ($prihods as $pr) {
                    echo '<option value="'.$pr['name'].'">';
                }
                ?>
                <option value="Жадовский монастырь">
</datalist>

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
