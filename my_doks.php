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
<title>Добавление документов</title>
<script src="jquery.js" type="text/javascript"></script>
<script type="text/javascript">
$(function () {
    var tabContainers = $('div.tabs > div');
    tabContainers.hide().filter(':first').show();
    
    $('div.tabs ul.tabNavigation a').click(function () {
        tabContainers.hide();
        tabContainers.filter(this.hash).show();
        $('div.tabs ul.tabNavigation a').removeClass('selected');
        $(this).addClass('selected');
        return false;
    }).filter(':first').click();
});
</script>

</head>
<body>

<div style="box-shadow: 0 0 20px rgba(0,0,0,0.5);">
<?
include 'golova.php';

include 'menu.php';

include 'content.php';

?>
<div id="osnovnoe">

<h1>Добавление документов</h1>

<?php
 $submit = $_POST['submit'];
if ($submit) {
 $tematika = $_POST['tematika'];
 $name = $_POST['name'];
 $san = $_POST['san'];
 $nomer = $_POST['nomer'];
 $text = $_POST['text'];
 $date = Date("Y.m.d H:i:s");
 $year = Date("Y");

    mysql_connect("localhost", "host1409556", "0f7cd928"); 
  	$p_msg = array ('/\\\/', '/\"/', '/\'/', '/\`/', '/\%/', '/\$/', '/\</', '/\>/');
	$r_msg = array ('&#092;', '&quot;', '&#039;', '&#096;', '&#037;', '&#036;', '&#060;', '&#062;');
	$text = preg_replace($p_msg, $r_msg, $text);
	
	$xx = mysql_query("SELECT * FROM host1409556_barysh.doks WHERE year=$year AND tematika LIKE '$tematika'");
if ($tematika == 'ukaz') {$a = mysql_num_rows($xx);
$numer= $a+1;}
else $numer = $nomer;
if ($tematika == 'udostoverenie') {$name = $san;}

	   mysql_query("INSERT INTO host1409556_barysh.doks VALUES ('$date', '$year', '$numer', '$name', '$text', '$tematika')");

echo '<p style="color:#135B00; text-align: center"><b>Документ успешно добавлен!</b></p><br />';


}

?>
<br />
<div class="tabs">
<!-- Это сами вкладки -->
    <ul class="tabNavigation">
        <li><a class="" href="#first">Указ</a></li>
        <li><a class="" href="#second">Распоряжение</a></li>
        <li><a class="" href="#cirk">Циркуляр</a></li>
        <li><a class="" href="#fift">Удостоверение</a></li>
    </ul>
<!-- Это контейнеры содержимого -->    
    <div id="first">
<span class="table">
	<TABLE CELLSPACING=3 CELLPADDING=2 width='400' align='center' border=0>
        <FORM ACTION='my_doks.php' method='post'>
		<TR><TD VALIGN=top>
 <INPUT TYPE="HIDDEN" NAME="tematika" VALUE ="ukaz">

					</TD><TD>
				</TD></TR>

		<TR><TD VALIGN=top><b>Кому выдан документ:</B></TD><TD></TD></TR>
		<TR><TD colspan=2><INPUT TYPE="TEXT" NAME='name' SIZE=75 required/></TD></TR>
		<TR><TD VALIGN=top><b>Текст:</B></TD><TD></TD></TR>
		<TR><TD colspan=2><TEXTAREA NAME='text' COLS=55 ROWS=10 required></TEXTAREA></TD></TR>
		<TR><TD VALIGN=top colspan=2>
	<INPUT TYPE='submit' name='submit' value='Добавить' />
        <INPUT TYPE='reset' value='Очистить'></TD></TR>
 </FORM>  

	</TABLE>	

</span>   
    </div>
    <div id="second">
<span class="table">
	<TABLE CELLSPACING=3 CELLPADDING=2 width='400' align='center' border=0>
        <FORM ACTION='my_doks.php' method='post'>
		<TR><TD VALIGN=top>
 <INPUT TYPE="HIDDEN" NAME="tematika" VALUE ="raspor">
					</TD><TD>
				</TD></TR>

		<TR><TD VALIGN=top><b>Номер документа:</B></TD><TD></TD></TR>
		<TR><TD colspan=2><INPUT TYPE="TEXT" NAME='nomer' SIZE=75 required/></TD></TR>

		<TR><TD VALIGN=top><b>Кому выдан документ:</B></TD><TD></TD></TR>
		<TR><TD colspan=2><INPUT TYPE="TEXT" NAME='name' SIZE=75/></TD></TR>
		<TR><TD VALIGN=top><b>Текст:</B></TD><TD></TD></TR>
		<TR><TD colspan=2><TEXTAREA NAME='text' COLS=55 ROWS=10 required></TEXTAREA></TD></TR>
		<TR><TD VALIGN=top colspan=2>
	<INPUT TYPE='submit' name='submit' value='Добавить' />
        <INPUT TYPE='reset' value='Очистить'></TD></TR>
 </FORM>  

	</TABLE>	

</span>   
    </div>
    <div id="cirk">
<span class="table">
	<TABLE CELLSPACING=3 CELLPADDING=2 width='400' align='center' border=0>
        <FORM ACTION='my_doks.php' method='post'>
		<TR><TD VALIGN=top>
 <INPUT TYPE="HIDDEN" NAME="tematika" VALUE ="cirk">
					</TD><TD>
				</TD></TR>

		<TR><TD VALIGN=top><b>Номер документа:</B></TD><TD></TD></TR>
		<TR><TD colspan=2><INPUT TYPE="TEXT" NAME='nomer' SIZE=75 required/></TD></TR>

		<TR><TD VALIGN=top><b>Кому выдан документ:</B></TD><TD></TD></TR>
		<TR><TD colspan=2><INPUT TYPE="TEXT" NAME='name' SIZE=75/></TD></TR>
		<TR><TD VALIGN=top><b>Текст:</B></TD><TD></TD></TR>
		<TR><TD colspan=2><TEXTAREA NAME='text' COLS=55 ROWS=10 required></TEXTAREA></TD></TR>
		<TR><TD VALIGN=top colspan=2>
	<INPUT TYPE='submit' name='submit' value='Добавить' />
        <INPUT TYPE='reset' value='Очистить'></TD></TR>
 </FORM>  

	</TABLE>	

</span>   
    </div>
    <div id="fift">
<span class="table">
	<TABLE CELLSPACING=3 CELLPADDING=2 width='400' align='center' border=0>
        <FORM ACTION='my_doks.php' method='post'>
				<TR><TD VALIGN=top><b>Сан:</B></TD><TD></TD></TR>

		<TR><TD VALIGN=top>
 <INPUT TYPE="HIDDEN" NAME="tematika" VALUE ="udostoverenie">
		<input type='radio' name='san' value='диакона' checked id="diak"><label for="diak">диакона</label><br />
		<input type='radio' name='san' value='пресвитера' id="ierei"><label for="ierei">пресвитера</label><br />

					</TD><TD>
				</TD></TR>

		<TR><TD VALIGN=top><b>Номер документа:</B></TD><TD></TD></TR>
		<TR><TD colspan=2><INPUT TYPE="TEXT" NAME='nomer' SIZE=75 required/></TD></TR>

		<TR><TD VALIGN=top><b>Текст:</B></TD><TD></TD></TR>
		<TR><TD colspan=2><TEXTAREA NAME='text' COLS=55 ROWS=10 required></TEXTAREA></TD></TR>
		<TR><TD VALIGN=top colspan=2>
	<INPUT TYPE='submit' name='submit' value='Добавить' />
        <INPUT TYPE='reset' value='Очистить'></TD></TR>
 </FORM>  

	</TABLE>	

</span>   
  		<hr />
	<p><b>Правила оформления:</b></p>
	<p><b>{{{http://ссылка}}}-{{{текст, который будет отображаться}}}</b> - активная ссылка. Ввод <b>http://</b> перед ссылкой обязателен. </p>
  </div>
</div>


</div>

<?
include 'footer.php';
?>

 </div>
</body>
</html>