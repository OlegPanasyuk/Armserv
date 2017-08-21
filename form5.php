<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>РАСЧЕТ РАСХОДА</title>
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
	<meta http-equiv="Cache-Control" content="no-cache"/>
    <link type="text/css" rel="stylesheet" href="css/TABLE2.CSS">
	<BASE target="frSheet">
	<style media="print">
	.help
	{display:none;font-size:10px;}
	</style>
	<style media="screen">
	.help
	{display:inline;font-size:10px;}
	</style>
<style>
FIELDSET
{width: 100; border: 0 solid Black;}
LEGEND
{font-weight: bolder;font-size: 14px;color:blue;}
LABEL
{font-size: 12px;font-weight: bolder;}
SELECT
{font-size: 12px;font-weight: bolder;width:50; }
TD
{font-size: 12px;font-weight: bolder;}
</style>
	<link rel="stylesheet" href="css/j.css"></link>
<?php
echo "<SCRIPT language=\"JavaScript1.2\">var tab=".$_GET["tab"]."</SCRIPT>";
echo "<SCRIPT language=\"JavaScript1.2\" src=\"js/progressbar.js\"></SCRIPT>";
echo "<script language=\"JavaScript1.2\" src=\"js/control_f6.js\"></script>";
echo "<script language=\"JavaScript1.2\">formatData.style.display='none';</script>";
require_once("include/vbs.php");
?>	
<script language="JavaScript" src="js/tabs.js">
<!--
//-->
</script>
<script src="1/jquery.js" type="text/javascript"></script>
<script src="1/jquery.tabslideout.js" type="text/javascript"></script>
<script type="text/javascript">
$(function(){
	$('.help').tabSlideOut({							//Класс панели
		tabHandle: '.handle',						//Класс кнопки
		pathToTabImage: '1/contacts.png',				//Путь к изображению кнопки
		imageHeight: '138px',						//Высота кнопки
		imageWidth: '40px',						//Ширина кнопки
		tabLocation: 'right',						//Расположение панели top - выдвигается сверху, right - выдвигается справа, bottom - выдвигается снизу, left - выдвигается слева
		speed: 300,								//Скорость анимации
		action: 'click',								//Метод показа click - выдвигается по клику на кнопку, hover - выдвигается при наведении курсора
		topPos: '35%',							//Отступ сверху
		fixedPosition: false						//Позиционирование блока false - position: absolute, true - position: fixed
	});
});
</script>

</head>

<body id="f3" topmargin=0 marginheight=0 marginwidth=0 scroll="auto" onload="startIncrement();" background=tree/imgs/fon.gif>
<div id="padding" style="height:60px;" class="help"></div>
<div id="content" style="height:80%;">
<?
include("util_fun.php");

$name = $_GET["iname"];
$uid = $_GET["id"];
$pid = $_GET["pid"];
$lid = $_GET["lid"];
$node = $_GET["node"];
$dc1 = $_GET["dc1"];
$dc2 = $_GET["dc2"];
$disp = $_GET["disp"];
$type = $_GET["type"];
$n_obj = $_GET["nobj"];
$adr = $_GET["adr"];
$edizm  = $_GET["edizm"];

if (!isset($date_2)) $date_2=$dc2;
if (!isset($date_1)) $date_1=$dc1;
if (!isset($mode)) $mode=$type;

 $type_izm = array();
 $pwr = array();
 $nrg = array();
 $colname = array();
 $count=0;	$zn="";
$izm_type=$type;
echo "
<script language=\"JavaScript1.2\">
	if (window.parent.toc.ntype)
	{
	 node=window.parent.toc.ntype.value;
     if (node==2) {
	  legenda.innerHTML='<span style=\"color:black;font-size:10px;\">вывод данных по объекту:</span> ';
	  formatData.style.display='inline';
	 }
	 else {
			legenda.innerHTML=' <span style=\"color:black;font-size:10px;\">(выберите объект)</span>';
			formatData.style.display='none';
			content.innerHTML='';
		}
	}	
</script>";
?>
<table width="100%" cellpadding="0" cellspacing="0" height="100%">
<tr><td height="100%">
 <table width="100%" cellpadding="0" cellspacing="0" height="100%">
 <tr><td valign="top" bgcolor="EEEEEE">
	<img src="tree/imgs/spacer.gif" height="1" width="1">
	</td>
	<td width="100%" valign="top" background="tree/imgs/fon.gif">
	 <table border="1" bordercolor="A5D7D6" width="100%" cellpadding="10" id="TB">
	 <tr><td  id="container">
<?php
$TIME_START = getmicrotime(); 
$filename="include/options.ini";
$options = @parse_ini_file($filename)or die("Невозможно прочитать файл настроек!");
$ratecount = $options['RateCount'];
if (isset($date_1) and isset($date_2) and isset($uid) and isset($n_obj) and isset($adr) and isset($mode) )
{
list ($ac_day1,$ac_month1,$ac_year1) = explode (".",$date_1);
list ($ac_day2,$ac_month2,$ac_year2) = explode (".",$date_2);

if (!checkdate ($ac_month1,$ac_day1,$ac_year1)) $date_1=date('Y-m-d'); else $date_1=$ac_year1.'-'.$ac_month1.'-'.$ac_day1;
if (!checkdate ($ac_month2,$ac_day2,$ac_year2)) $date_2=date('Y-m-d'); else $date_2=$ac_year2.'-'.$ac_month2.'-'.$ac_day2;
$date_header2=$ac_day1.'.'.$ac_month1.'.'.$ac_year1;
$date_header2=$ac_day1.'.'.$ac_month2.'.'.$ac_year2;
echo "<script>\n";
echo "window.document.forms[0].dc1.value='$dc1';\n";
echo "window.document.forms[0].dc2.value='$dc2';\n";
echo "window.document.forms[0].iname.value='$name';\n";
echo "window.document.forms[0].id.value='$id';\n";
echo "window.document.forms[0].pid.value='$pid';\n";
echo "window.document.forms[0].lid.value='$lid';\n";
echo "window.document.forms[0].node.value='$node';\n";
echo "window.document.forms[0].type.value='$type';\n";
echo "window.document.forms[0].edizm.value='$edizm';\n";
echo "formatData.style.display='inline';\n";
echo "</script>\n";
function incrementProgressBar()
{
 global $count;
 $count++;
 echo "<script language=\"JavaScript\">incrementProgressBar();</script>\n";
 return $count;
}
include("include/mysql.php"); //  Соединяемся с БД
 $result=mysql_query("select DATE_FORMAT('".$date_1."','%m'),DATE_FORMAT('".$date_2."','%m'),DATE_FORMAT('".$date_2."','%d'),DATE_FORMAT('".$date_2."','%Y')");
 if ($res=mysql_fetch_array($result,MYSQL_NUM))
 {
//==============================================================================================================
   setInterval($mode,$date_1,$date_2,$uid,$n_obj,$adr,$table);
	$count=incrementProgressBar();
	$count=incrementProgressBar();
   PrintHeader($uid,$n_obj,$adr,$date_header2,$date_1,$date_2,$mode,$izm_type);
	$count=incrementProgressBar();
	$count=incrementProgressBar();
   PrintData($uid,$n_obj,$adr,$table,$day1,$day2,$type);
	$count=incrementProgressBar();
	$count=incrementProgressBar();
 }	
//==============================================================================================================
mysql_close();
}
function setInterval($mode,$date_1,$date_2,$uid,$n_obj,$adr,$table)
{
global $day0;global $day1; global $day2;
global $month1;global $month2;
global $year1;global $year2;
	$count=incrementProgressBar();
//	echo $date_1.'_'.$date_2.'<br>';
//определяем начало и конец временного интервала
	 $result0=mysql_query("select DATE_ADD( DATE_FORMAT('".$date_2."','%Y-%m-%d'), INTERVAL -1 DAY), 
						 DATE_ADD(DATE_ADD( DATE_FORMAT('".$date_1."','%Y-%m-%d'), INTERVAL -1 MONTH),INTERVAL -1 DAY),
						 DATE_ADD( DATE_FORMAT('".$date_1."','%Y-%m-%d'), INTERVAL -1 DAY) ,DATE_ADD( DATE_FORMAT('".$date_1."','%Y-%m-%d'), INTERVAL -1 MONTH)");
	 $result0=mysql_query("select DATE_ADD( DATE_FORMAT('".$date_2."','%Y-%m-%d'), INTERVAL -1 DAY), 
						 DATE_ADD( DATE_FORMAT('".$date_2."','%Y-%m-%d'), INTERVAL -1 DAY), 
						 DATE_ADD( DATE_FORMAT('".$date_1."','%Y-%m-%d'), INTERVAL -1 DAY) ,DATE_ADD( DATE_FORMAT('".$date_1."','%Y-%m-%d'), INTERVAL -1 DAY)");
     if ($res0=mysql_fetch_array($result0,MYSQL_NUM))
	 {
	 	$day2 = $res0[0]; 	 
		if ($date_1==$date_2) 
		{		$day1 = $res0[1];  $day0 = $res0[3];}
		else 
		{	$day1 = $res0[2]; $day0 = $date_1; }
	 }	
//echo $res0[0]."_".$res0[1]."_".$res0[2]."_".$res0[3];

// echo $day1.'_'.$day2.'<br>'; 
}

function PrintHeader($uid,$n_obj,$adr,$date_,$date_1,$date_2,$mode,$izm_type)
{
global $zn;
global $day0;global $day1; global $day2; global $edizm; global $ratecount;

//=============== формирование заголовка ===============================
list ($ac_day,$ac_month,$ac_year) = explode (".",$date_); 
list ($ac_year1,$ac_month1,$ac_day1) = explode ("-",$date_1); 
list ($ac_year2,$ac_month2,$ac_day2) = explode ("-",$date_2); 
$d1=$ac_day1.".".$ac_month1.".".$ac_year1; $d2=$ac_day2.".".$ac_month2.".".$ac_year2;
//=====================определяем параметры и название точки учета===================================
	$result=mysql_query("select izm_str,descript,znum,c_type FROM counters WHERE  n_obj=".$n_obj." AND link_adr=".$adr." ");
    if ($res=mysql_fetch_array($result,MYSQL_BOTH))
	{
	 $izm_str=$res[0];	$type_izm = explode (",",$izm_str); 
	 $name=$res[1]; 	 if ($res[3]==0) {$znum= "номер счетчика ".$res[2];$zn=$res[2];} else {$znum=""; $zn="";}
	} 
//	$result=mysql_query("select item_name FROM objects WHERE  item_id=(select item_parent_id FROM objects WHERE item_id=".$uid.") ");
	$result=mysql_query("select item_name FROM objects WHERE  item_id=".$uid." ");
    if ($res=mysql_fetch_array($result,MYSQL_BOTH))
	{
	 $pname=$res[0];
	} 
	$result=mysql_query("select descript,nrj_unit FROM izm_type WHERE  izm_type=".$izm_type."-4 ");
    if ($res=mysql_fetch_array($result,MYSQL_BOTH))
	{
	$str = $res[1];
	 if ($edizm == 1000)	 $str = str_replace("к","М",$res[1]);
	 $type=$res[0];
	 $unit=$str;
	 $unit1 = $res[1];
	} 
//==========================================================================================================================
		if ($ratecount == 1) {
		$col=8;
		echo "<table border='0' cellpadding='0' cellspacing='0' align='center' id='TB2' width='70%'>\n";
		echo " 	<tr> <td colspan='".$col."' align='center'>Расчет расхода электроэнергии ".$pname." ".$name."</td>   </tr>\n";
		if ($znum!="") echo " 	<tr> <td colspan='".$col."' align='center'>".$znum."</td> </tr>\n";

		echo "<tr>\n";
		echo "<th colspan='$col'>&nbsp;\n";
        echo "<FONT COLOR='midnightblue' style='font-size:12px'>за период с ".$d1." по ".$d2."  </FONT> 	</th>\n";
		echo "</tr>\n";
		echo "</tr>\n";
		echo "<tr>\n";
		echo "	<td colspan='".($col)."' class='x23' style='border-bottom:none;'>Показания счетчиков ".$type."</td>\n";
		echo "</tr>\n";
		echo "<tr>\n";
		echo "<td class='x23' style='text-align:center;' width='30%'>Наименование точки учета</td>\n";
		echo "<td class='x23' style='border-left:none;' width='70'>Зав. №</td>\n";
		echo "<td class='x23' style='text-align:center;border-left:none;' >Тариф</td>\n";
		echo "<td class='x23' style='text-align:center;border-left:none;' width='70px'>Нач. показ.".$unit."</td>\n";
		echo "<td class='x23' style='text-align:center;border-left:none;' width='70px'>Кон. показ.".$unit."</td>\n";
		echo "<td class='x23' style='text-align:center;border-left:none;' width='70px'>Разность".$unit."</td>\n";
		if ($edizm == 1000) {echo "<td class='x23' style='text-align:center;border-left:none;' width='40'>Кпер.</td>\n";} else
		{echo "<td class='x23' style='text-align:center;border-left:none;' width='40'>Ктр.</td>\n";}
		echo "<td class='x23' style='text-align:center;border-left:none;' width='100'>Расход <br/>".$unit1."</td>\n";

		echo "</tr>\n";
		}
		else {
		$col=7;
		echo "<table border='0' cellpadding='0' cellspacing='0' align='center' id='TB2'>\n";
		echo " 	<tr> <td colspan='".$col."' align='center'>Расчет расхода электроэнергии ".$pname." ".$name."</td>   </tr>\n";
		if ($znum!="") echo " 	<tr> <td colspan='".$col."' align='center'>".$znum."</td> </tr>\n";

		echo "<tr>\n";
		echo "<th colspan='$col'>&nbsp;\n";
        echo "<FONT COLOR='midnightblue' style='font-size:12px'>за период с ".$d1." по ".$d2."  </FONT> 	</th>\n";
		echo "</tr>\n";
		echo "</tr>\n";
		echo "<tr>\n";
		echo "	<td colspan='".($col)."' class='x23' style='border-bottom:none;'>Показания счетчиков ".$type."</td>\n";
		echo "</tr>\n";
		echo "<tr>\n";
		echo "<td class='x23' width='70'>Фидер</td>\n";
		echo "<td class='x23' width='70'>Зав. №</td>\n";
		echo "<td class='x23' width='80'>Нач. показ.</td>\n";
		echo "<td class='x23' width='80'>Кон. показ.</td>\n";
		echo "<td class='x23' width='80'>Разность</td>\n";
		if ($edizm == 1000) {echo "<td class='x23' style='text-align:center;border-left:none;' width='40'>Кпер.</td>\n";
		echo "<td class='x23' width='100'>Расход (кВт*ч)</td>\n";
		} else
		{echo "<td class='x23' style='text-align:center;border-left:none;' width='40'>Ктр.</td>\n";
		echo "<td class='x23' width='100'>Расход ".$unit."</td>\n";
		}
		

		echo "</tr>\n";
		}
	//=========================================================================			
}
	
function PrintData($uid,$n_obj,$adr,$table,$day1,$day2,$izm_type)
{
	global $edizm; 
	global $ratecount;
	$izm_type_mas;
	switch ($izm_type)	{ 
	 case 5: 
		$izm_type_mas = array (122,123,124,125);
		break;
	 case 6:	
	    $izm_type_mas = array (130,131,132,133);
		break;
	 case 7:	
	    $izm_type_mas = array (138,139,140,141);
		break;
	 case 8:	
	    $izm_type_mas = array (146,147,148,149);
		break;		
	}
	
	$summa=0;
	$result2 = mysql_query("select * FROM IZM_TYPE WHERE izm_type=".$izm_type." ");	
	if ($row2=mysql_fetch_array($result2))
	 {	$e_type=$row2[0]; $e_unit=$row2[1];}
	list ($ac_year,$ac_month,$ac_day) = explode ("-",$date_);  
    if (($ac_year-2000)<10)  $date_output=$ac_day.".".$ac_month.".0".($ac_year-2000);
	else $date_output=$ac_day.".".$ac_month.".".($ac_year-2000);
		$result1=mysql_query("select item_id from objects where item_parent_id=".$uid." and node_type<=0");
		while ($row1=mysql_fetch_array($result1))
		{
		$result=mysql_query("select descript,n_obj,link_adr,znum,k_tr,c_type from counters where uid=".$row1[0]." ");
		$row=mysql_fetch_array($result);
		$result3=mysql_query("select znach,flag from ".$table." where n_obj=".$row[1]." and link_adr=".$row[2]." and izm_type=".$izm_type." and inter_val=48 and data='".$day1."' ");
		$row3=mysql_fetch_array($result3);
		$result4=mysql_query("select znach,flag from ".$table." where n_obj=".$row[1]." and link_adr=".$row[2]." and izm_type=".$izm_type." and inter_val=48 and data='".$day2."'");
		$row4=mysql_fetch_array($result4);
		$result5=mysql_query("select znach,flag from ".$table." where n_obj=".$row[1]." and link_adr=".$row[2]." and izm_type=".$izm_type_mas[0]." and inter_val=48 and data='".$day1."'");
		$row5=mysql_fetch_array($result5);
		$result6=mysql_query("select znach,flag from ".$table." where n_obj=".$row[1]." and link_adr=".$row[2]." and izm_type=".$izm_type_mas[0]." and inter_val=48 and data='".$day2."'");
		$row6=mysql_fetch_array($result6);
		$result7=mysql_query("select znach,flag from ".$table." where n_obj=".$row[1]." and link_adr=".$row[2]." and izm_type=".$izm_type_mas[1]." and inter_val=48 and data='".$day1."'");
		$row7=mysql_fetch_array($result7);
		$result8=mysql_query("select znach,flag from ".$table." where n_obj=".$row[1]." and link_adr=".$row[2]." and izm_type=".$izm_type_mas[1]." and inter_val=48 and data='".$day2."'");
		$row8=mysql_fetch_array($result8);
		$result9=mysql_query("select znach,flag from ".$table." where n_obj=".$row[1]." and link_adr=".$row[2]." and izm_type=".$izm_type_mas[2]." and inter_val=48 and data='".$day1."'");
		$row9=mysql_fetch_array($result9);
		$result10=mysql_query("select znach,flag from ".$table." where n_obj=".$row[1]." and link_adr=".$row[2]." and izm_type=".$izm_type_mas[2]." and inter_val=48 and data='".$day2."'");
		$row10=mysql_fetch_array($result10);
		$result11=mysql_query("select znach,flag from ".$table." where n_obj=".$row[1]." and link_adr=".$row[2]." and izm_type=".$izm_type_mas[3]." and inter_val=48 and data='".$day1."'");
		$row11=mysql_fetch_array($result11);
		$result12=mysql_query("select znach,flag from ".$table." where n_obj=".$row[1]." and link_adr=".$row[2]." and izm_type=".$izm_type_mas[3]." and inter_val=48 and data='".$day2."'");
		$row12=mysql_fetch_array($result12);
		if ($ratecount == 1) {
		 if ($row[5] == -1)
		 {
		 echo "<tr>\n";
 	     echo "<td rowspan='3' class='x22' valign='top' style='font-weight:600;text-align:center;border-top:none;vertical-align:middle;' >".$row[0]."</td>\n";
		 echo "<td rowspan='3' class='x22' style='border-top:none;border-left:none;text-align:center;vertical-align:middle;'>".$row[3]."</td>\n";
		 echo "<td class='x22' bgcolor = 'lightgreen' style='border-top:none;border-left:none;text-align:center'>День</td>\n";
		 echo "<td class='x22' bgcolor = 'lightgreen' style='border-top:none;border-left:none'>".format($row5[0]/$edizm)."</td>\n";
		 echo "<td class='x22' bgcolor = 'lightgreen' style='border-top:none;border-left:none'>".format($row6[0]/$edizm)."</td>\n";
		 	
		 if ($row5[0]>$row6[0]) $razn=0;else $razn=$row6[0]-$row5[0];
		 echo "<td class='x22' bgcolor = 'lightgreen' style='border-top:none;border-left:none'>".format($razn/$edizm)."</td>\n";
		 if ($edizm == 1000) { echo "<td rowspan='3' class='x22' style='border-top:none;border-left:none;text-align:center;vertical-align:middle;' >&nbsp;1000</td>\n";
		 } else {
		 echo "<td rowspan='3' class='x22' style='border-top:none;border-left:none;text-align:center;vertical-align:middle;' >".sprintf('%01.0f',$row[4])."</td>\n";}
		 echo "<td class='x22' bgcolor = 'lightgreen' style='border-top:none;border-left:none;text-align:right;'>&nbsp;".sprintf('%01.2f',$razn*$row[4])."</td>\n";
		 echo "</tr>\n";
		 echo "<tr>\n";
 	     
		
		 echo "<td class='x22' bgcolor = 'lightblue' style='border-top:none;border-left:none;text-align:center'>&nbsp;Ночь</td>\n";
		 echo "<td class='x22' bgcolor = 'lightblue' style='border-top:none;border-left:none'>&nbsp;".format($row7[0]/$edizm)."</td>\n";
		 echo "<td class='x22' bgcolor = 'lightblue' style='border-top:none;border-left:none'>&nbsp;".format($row8[0]/$edizm)."</td>\n";
		 	
		 if ($row7[0]>$row8[0]) $razn=0;else $razn=$row8[0]-$row7[0];
		 echo "<td class='x22' bgcolor = 'lightblue' style='border-top:none;border-left:none'>&nbsp;".format($razn/$edizm)."</td>\n";
		 
		 echo "<td class='x22' bgcolor = 'lightblue' style='border-top:none;border-left:none;text-align:right;'>&nbsp;".sprintf('%01.2f',$razn*$row[4])."</td>\n";
		 echo "</tr>\n";
		 
		 echo "<tr>\n";
 	    
		 
		 echo "<td class='x22' bgcolor='#99CCFF' style='border-top:none;border-left:none;text-align:center'>&nbsp;<b>Общее потребление</b></td>\n";
		 echo "<td class='x22' bgcolor='#99CCFF' style='border-top:none;border-left:none'>&nbsp;<b>".format($row3[0]/$edizm)."</b></td>\n";
		 echo "<td class='x22' bgcolor='#99CCFF' style='border-top:none;border-left:none'>&nbsp;<b>".format($row4[0]/$edizm)."</b></td>\n";
		 	
		 if ($row3[0]>$row4[0]) $razn=0;else $razn=$row4[0]-$row3[0];
		 echo "<td class='x22' bgcolor='#99CCFF' style='border-top:none;border-left:none'>&nbsp;<b>".format($razn/$edizm)."</b></td>\n";
		 
		 echo "<td class='x22' bgcolor='#99CCFF' style='border-top:none;border-left:none;text-align:right;'>&nbsp;<b>".sprintf('%01.2f',$razn*$row[4])."</b></td>\n";
		 echo "</tr>\n";
		$summa+=$razn*$row[4];
		}
		else {
		$tarifs = 1;
		if(($row[5] == 0) and ($tarifs ==0)){
		echo "<tr>\n";
 	     echo "<td rowspan='4' class='x22' valign='top' style='font-weight:600;text-align:center;border-top:none;vertical-align:middle;' >".$row[0]."</td>\n";
		 echo "<td rowspan='4' class='x22' style='border-top:none;border-left:none;text-align:center;vertical-align:middle;'>".$row[3]."</td>\n";
		 echo "<td class='x22' bgcolor = 'lightgreen'  style='border-top:none;border-left:none;text-align:center'>День</td>\n";
		 echo "<td class='x22' bgcolor = 'lightgreen' style='border-top:none;border-left:none'>".format($row5[0]/$edizm)."</td>\n";
		 echo "<td class='x22' bgcolor = 'lightgreen' style='border-top:none;border-left:none'>".format($row6[0]/$edizm)."</td>\n";
		 	
		 if ($row5[0]>$row6[0]) $razn=0;else $razn=$row6[0]-$row5[0];
		 echo "<td class='x22' bgcolor = 'lightgreen' style='border-top:none;border-left:none'>".format($razn/$edizm)."</td>\n";
		 if ($edizm == 1000) { echo "<td rowspan='5' class='x22'  style='border-top:none;border-left:none;text-align:center;vertical-align:middle;' >&nbsp;1000</td>\n";
		 } else {
		 echo "<td rowspan='4' class='x22'  style='border-top:none;border-left:none;text-align:center;vertical-align:middle;' >".sprintf('%01.0f',$row[4])."</td>\n";}
		 echo "<td class='x22' bgcolor = 'lightgreen' style='border-top:none;border-left:none;text-align:right;'>&nbsp;".sprintf('%01.2f',$razn*$row[4])."</td>\n";
		 echo "</tr>\n";
		 echo "<tr>\n";
 	     
		
		 echo "<td class='x22' bgcolor = 'lightblue' style='border-top:none;border-left:none;text-align:center'>&nbsp;Ночь</td>\n";
		 echo "<td class='x22' bgcolor = 'lightblue' style='border-top:none;border-left:none'>&nbsp;".format($row7[0]/$edizm)."</td>\n";
		 echo "<td class='x22' bgcolor = 'lightblue' style='border-top:none;border-left:none'>&nbsp;".format($row8[0]/$edizm)."</td>\n";
		 	
		 if ($row7[0]>$row8[0]) $razn=0;else $razn=$row8[0]-$row7[0];
		 echo "<td class='x22' bgcolor = 'lightblue' style='border-top:none;border-left:none'>&nbsp;".format($razn/$edizm)."</td>\n";
		 
		 echo "<td class='x22' bgcolor = 'lightblue' style='border-top:none;border-left:none;text-align:right;'>&nbsp;".sprintf('%01.2f',$razn*$row[4])."</td>\n";
		 echo "</tr>\n";
		 echo "<tr>\n";
 	     
		 
		 echo "<td class='x22' bgcolor = 'lightyellow' style='border-top:none;border-left:none;text-align:center'>&nbsp;Утренний Пик</td>\n";
		 echo "<td class='x22' bgcolor = 'lightyellow' style='border-top:none;border-left:none'>&nbsp;".format($row9[0]/$edizm)."</td>\n";
		 echo "<td class='x22' bgcolor = 'lightyellow' style='border-top:none;border-left:none'>&nbsp;".format($row10[0]/$edizm)."</td>\n";
		 	
		 if ($row9[0]>$row10[0]) $razn=0;else $razn=$row10[0]-$row9[0];
		 echo "<td class='x22' bgcolor = 'lightyellow' style='border-top:none;border-left:none'>&nbsp;".format($razn/$edizm)."</td>\n";
		  
		
		 echo "<td class='x22' bgcolor = 'lightyellow' style='border-top:none;border-left:none;text-align:right;'>&nbsp;".sprintf('%01.2f',$razn*$row[4])."</td>\n";
		 echo "</tr>\n";
		 //echo "<tr>\n";
 	    
		 
		// echo "<td class='x22' bgcolor = 'salmon' style='border-top:none;border-left:none;text-align:center'>&nbsp;Вечерний Пик</td>\n";
		 //echo "<td class='x22' bgcolor = 'salmon' style='border-top:none;border-left:none'>&nbsp;".format($row11[0]/$edizm)."</td>\n";
		// echo "<td class='x22' bgcolor = 'salmon' style='border-top:none;border-left:none'>&nbsp;".format($row12[0]/$edizm)."</td>\n";
		 	
		 //if ($row11[0]>$row12[0]) $razn=0;else $razn=$row12[0]-$row11[0];
		 //echo "<td class='x22' bgcolor = 'salmon' style='border-top:none;border-left:none'>&nbsp;".format($razn/$edizm)."</td>\n";
		 
		 //echo "<td class='x22' bgcolor = 'salmon' style='border-top:none;border-left:none;text-align:right;'>&nbsp;".sprintf('%01.2f',$razn*$row[4])."</td>\n";
		// echo "</tr>\n";
		 echo "<tr>\n";
 	    
		 
		 echo "<td class='x22' bgcolor='#99CCFF' style='border-top:none;border-left:none;text-align:center;'>&nbsp;<b>Общее потребление</b></td>\n";
		 echo "<td class='x22' bgcolor='#99CCFF' style='border-top:none;border-left:none'>&nbsp;<b>".format($row3[0]/$edizm)."</b></td>\n";
		 echo "<td class='x22' bgcolor='#99CCFF' style='border-top:none;border-left:none'>&nbsp;<b>".format($row4[0]/$edizm)."</b></td>\n";
		 	
		 if ($row3[0]>$row4[0]) $razn=0;else $razn=$row4[0]-$row3[0];
		 echo "<td class='x22' bgcolor='#99CCFF' style='border-top:none;border-left:none'>&nbsp;<b>".format($razn/$edizm)."</b></td>\n";
		 
		 echo "<td class='x22' bgcolor='#99CCFF' style='border-top:none;border-left:none;text-align:right;'>&nbsp;<b>".sprintf('%01.2f',$razn*$row[4])."</b></td>\n";
		 echo "</tr>\n";
		$summa+=$razn*$row[4];
		}
		else { // тображние обычного счетчика без тарифа
		echo "<tr>\n";
 	     echo "<td rowspan='' class='x22' valign='top' style='font-weight:600;text-align:center;border-top:none;vertical-align:middle;' >".$row[0]."</td>\n";
		 echo "<td rowspan='' class='x22' style='border-top:none;border-left:none;text-align:center;vertical-align:middle;'>".$row[3]."</td>\n";
		 //echo "<td class='x22' bgcolor = 'lightgreen'  style='border-top:none;border-left:none;text-align:center'>День</td>\n";
		 //echo "<td class='x22' bgcolor = 'lightgreen' style='border-top:none;border-left:none'>".format($row5[0]/$edizm)."</td>\n";
		 //echo "<td class='x22' bgcolor = 'lightgreen' style='border-top:none;border-left:none'>".format($row6[0]/$edizm)."</td>\n";
		 	
		 //if ($row5[0]>$row6[0]) $razn=0;else $razn=$row6[0]-$row5[0];
		 //echo "<td class='x22' bgcolor = 'lightgreen' style='border-top:none;border-left:none'>".format($razn/$edizm)."</td>\n";
		 
		 //echo "<td class='x22' bgcolor = 'lightgreen' style='border-top:none;border-left:none;text-align:right;'>&nbsp;".sprintf('%01.2f',$razn*$row[4])."</td>\n";
		 //echo "</tr>\n";
		 //echo "<tr>\n";
 	     
		
		 //echo "<td class='x22' bgcolor = 'lightblue' style='border-top:none;border-left:none;text-align:center'>&nbsp;Ночь</td>\n";
		 //echo "<td class='x22' bgcolor = 'lightblue' style='border-top:none;border-left:none'>&nbsp;".format($row7[0]/$edizm)."</td>\n";
         //echo "<td class='x22' bgcolor = 'lightblue' style='border-top:none;border-left:none'>&nbsp;".format($row8[0]/$edizm)."</td>\n";
		 	
		 //if ($row7[0]>$row8[0]) $razn=0;else $razn=$row8[0]-$row7[0];
		 //echo "<td class='x22' bgcolor = 'lightblue' style='border-top:none;border-left:none'>&nbsp;".format($razn/$edizm)."</td>\n";
		 
		 //echo "<td class='x22' bgcolor = 'lightblue' style='border-top:none;border-left:none;text-align:right;'>&nbsp;".sprintf('%01.2f',$razn*$row[4])."</td>\n";
		 //echo "</tr>\n";
		 //echo "<tr>\n";
 	     
		 
		 //echo "<td class='x22' bgcolor = 'lightyellow' style='border-top:none;border-left:none;text-align:center'>&nbsp;Утренний Пик</td>\n";
		 //echo "<td class='x22' bgcolor = 'lightyellow' style='border-top:none;border-left:none'>&nbsp;".format($row9[0]/$edizm)."</td>\n";
		 //echo "<td class='x22' bgcolor = 'lightyellow' style='border-top:none;border-left:none'>&nbsp;".format($row10[0]/$edizm)."</td>\n";
		 	
		 //if ($row9[0]>$row10[0]) $razn=0;else $razn=$row10[0]-$row9[0];
		// echo "<td class='x22' bgcolor = 'lightyellow' style='border-top:none;border-left:none'>&nbsp;".format($razn/$edizm)."</td>\n";
		  
		
		 //echo "<td class='x22' bgcolor = 'lightyellow' style='border-top:none;border-left:none;text-align:right;'>&nbsp;".sprintf('%01.2f',$razn*$row[4])."</td>\n";
		 //echo "</tr>\n";
		 //echo "<tr>\n";
 	    
		 
		 //echo "<td class='x22' bgcolor = 'salmon' style='border-top:none;border-left:none;text-align:center'>&nbsp;Вечерний Пик</td>\n";
		 //echo "<td class='x22' bgcolor = 'salmon' style='border-top:none;border-left:none'>&nbsp;".format($row11[0]/$edizm)."</td>\n";
		 //echo "<td class='x22' bgcolor = 'salmon' style='border-top:none;border-left:none'>&nbsp;".format($row12[0]/$edizm)."</td>\n";
		 	
		 //if ($row11[0]>$row12[0]) $razn=0;else $razn=$row12[0]-$row11[0];
		 //echo "<td class='x22' bgcolor = 'salmon' style='border-top:none;border-left:none'>&nbsp;".format($razn/$edizm)."</td>\n";
		 
		 //echo "<td class='x22' bgcolor = 'salmon' style='border-top:none;border-left:none;text-align:right;'>&nbsp;".sprintf('%01.2f',$razn*$row[4])."</td>\n";
		 //echo "</tr>\n";
		 //echo "<tr>\n";
 	    
		 
		 echo "<td class='x22' bgcolor='' style='border-top:none;border-left:none;text-align:center;'>&nbsp;<b>Общее потребление</b></td>\n";
		 echo "<td class='x22' bgcolor='' style='border-top:none;border-left:none'>&nbsp;<b>".format($row3[0]/$edizm)."</b></td>\n";
		 echo "<td class='x22' bgcolor='' style='border-top:none;border-left:none'>&nbsp;<b>".format($row4[0]/$edizm)."</b></td>\n";
		 	
		 if ($row3[0]>$row4[0]) $razn=0;else $razn=$row4[0]-$row3[0];
		 echo "<td class='x22' bgcolor='' style='border-top:none;border-left:none'>&nbsp;<b>".format($razn/$edizm)."</b></td>\n";
		 if ($edizm == 1000) { echo "<td rowspan='' class='x22'  style='border-top:none;border-left:none;text-align:center;vertical-align:middle;' >&nbsp;1000</td>\n";
		 } else {
		 echo "<td rowspan='' class='x22'  style='border-top:none;border-left:none;text-align:center;vertical-align:middle;' >".sprintf('%01.0f',$row[4])."</td>\n";}
		 echo "<td class='x22' bgcolor='' style='border-top:none;border-left:none;text-align:right;'>&nbsp;<b>".sprintf('%01.2f',$razn*$row[4])."</b></td>\n";
		 echo "</tr>\n";
		$summa+=$razn*$row[4];
			}
		}
		}
		else {
		 echo "<tr>\n";
 	     echo "<td class='x22' align='center' style='font-weight:600;text-align:center;border-top:none;' >".$row[0]."</td>\n";
		 echo "<td class='x22' style='border-top:none;border-left:none;text-align:center'>&nbsp;".$row[3]."</td>\n";
		 echo "<td class='x22' style='border-top:none;border-left:none'>&nbsp;".format($row3[0]/$edizm)."</td>\n";
		 echo "<td class='x22' style='border-top:none;border-left:none'>&nbsp;".format($row4[0]/$edizm)."</td>\n";
		 	
		 if ($row3[0]>$row4[0]) $razn=0;else $razn=$row4[0]-$row3[0];
		 echo "<td class='x22' style='border-top:none;border-left:none'>&nbsp;".format($razn/$edizm)."</td>\n";
		 if ($edizm == 1000) { echo "<td  class='x22'  style='border-top:none;border-left:none;text-align:center;vertical-align:middle;' >&nbsp;1000</td>\n";
		 } else {
		 echo "<td class='x22'  style='border-top:none;border-left:none;text-align:center;vertical-align:middle;' >".sprintf('%01.0f',$row[4])."</td>\n";}
		 echo "<td class='x22' style='border-top:none;border-left:none;text-align:right;'>&nbsp;".sprintf('%01.2f',$razn*$row[4])."</td>\n";
		 echo "</tr>\n";
		$summa+=$razn*$row[4];
		}
		 
	}echo "<tr>\n";
 	     echo "<td class='x22' align='center' style='font-weight:600;text-align:left;border-top:none;padding-left:20px;' >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Итого</td>\n";
		 echo "<td class='x22' style='border-top:none;border-left:none;'>&nbsp;</td>\n";
		 echo "<td class='x22' style='border-top:none;border-left:none'>&nbsp;</td>\n";
		 echo "<td class='x22' style='border-top:none;border-left:none'>&nbsp;</td>\n";
		if ($ratecount == 1) {echo "<td class='x22' style='border-top:none;border-left:none'>&nbsp;</td>\n";}
		 echo "<td class='x22' style='border-top:none;border-left:none'>&nbsp;</td>\n";
		 echo "<td class='x22' style='border-top:none;border-left:none'>&nbsp;</td>\n";
		 echo "<td class='x22' style='border-top:none;border-left:none;text-align:center;'>&nbsp;".sprintf('%01.2f',$summa)."</td>\n";
		 echo "</tr>\n";
}
  	echo "</table>\n";
$TIME_END = getmicrotime();
$TIME_SCRIPT = $TIME_END - $TIME_START; 
?>
</td></tr></table>
</td></tr></table>
</td></tr></table>
</div>
<?
if (!isset($pw_en)) $pw_en=0;
if (!isset($date_2)) $date_2=date('Y-m-d');
list($ac_year,$ac_month,$ac_day)=explode("-",$date_2);
echo "<script>
var name='".str_replace('\"', '', $name)."';
topmenu.iname.value=name;
</script>
";
if ($zn=='' or !isset($zn)) echo "<div id='activator' ONCLICK=ToXls_5('TB',5,'".$pw_en."','".$count."','".$ac_day."','".$ac_day.".".$ac_month.".".$ac_year."',topmenu.iname.value,'".$type."')></div>\n"; 
else echo "<div id='activator' ONCLICK=ToXls_5('TB',5,'".$pw_en."','".$count."','".$ac_day."','".$ac_day.".".$ac_month.".".$ac_year."','".$zn."','".$type."')></div>\n"; 

?>
<center>
<div style="color:white;" class="help"><b>.::</b>
Время выполнения запроса <?=number_format($TIME_SCRIPT,3,".","");?> сек.
<b>::.</b>
</div>
</center>
<script language="VBScript" src="js/excel_export.vbs">
<!-- 
// --> 
</script>
</body>
</html>
