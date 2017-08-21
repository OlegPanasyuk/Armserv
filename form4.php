<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>Приращение энергии</title>
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
echo "<script language=\"JavaScript1.2\" src=\"js/control_f4.js\"></script>";
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
$dc = $_GET["dc"];
$disp = $_GET["disp"];
$type = $_GET["type"];
$n_obj = $_GET["nobj"];
$adr = $_GET["adr"];

if (!isset($date_2)) $date_2=$dc;
if (!isset($mode)) $mode=$type;

 $type_izm = array();
 $pwr = array();
 $nrg = array();
 $colname = array();
 $count=0;	$zn="";

echo "
<script language=\"JavaScript1.2\">
	if (window.parent.toc.ntype)
	{
	 node=window.parent.toc.ntype.value;
     if (node<1) {
	  legenda.innerHTML='<span style=\"color:black;font-size:10px;\">вывод данных по объекту:</span> ';
	  formatData.style.display='inline';
	 }
	 else {
			legenda.innerHTML=' <span style=\"color:black;font-size:10px;\">(выберите счетчик)</span>';
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
if (isset($date_2) and isset($uid) and isset($n_obj) and isset($adr) and isset($mode) and ($node<1) )
{
list ($ac_day,$ac_month,$ac_year) = explode (".",$date_2);
if (!checkdate ($ac_month,$ac_day,$ac_year)) $date_2=date('Y-m-d'); else $date_2=$ac_year.'-'.$ac_month.'-'.$ac_day;
$date_1=$ac_year.'-'.$ac_month.'-01';
$date_header1='01.'.$ac_month.'.'.$ac_year;
$date_header2=$ac_day.'.'.$ac_month.'.'.$ac_year;
echo "<script>\n";
echo "window.document.forms[0].dc.value='$dc';\n";
echo "window.document.forms[0].iname.value='$name';\n";
echo "window.document.forms[0].id.value='$id';\n";
echo "window.document.forms[0].pid.value='$pid';\n";
echo "window.document.forms[0].lid.value='$lid';\n";
echo "window.document.forms[0].node.value='$node';\n";
echo "window.document.forms[0].type.value='$type';\n";
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
//==============================================================================================================
{
   setInterval($mode,$date_1,$date_2,$uid,$n_obj,$adr,$table);
	$count=incrementProgressBar();
	$count=incrementProgressBar();
   PrintHeader($uid,$n_obj,$adr,$date_header2,$date_2,$mode);
	$count=incrementProgressBar();
	$count=incrementProgressBar();
   PrintData($uid,$n_obj,$adr,$table,$day1,$day2,$month1,$month2,$year1,$year2,$izm_type,$mode);
	$count=incrementProgressBar();
	$count=incrementProgressBar();
}	
//==============================================================================================================
 mysql_close();

}
function setInterval($mode,$date_1,$date_2,$uid,$n_obj,$adr,$table)
{
global $day1; global $day2;
global $month1;global $month2;
global $year1;global $year2;
	$count=incrementProgressBar();
//определяем начало и конец временного интервала
if ($mode==1)
{
	//приращение энергии
	 $result0=mysql_query("select DATE_ADD( DATE_FORMAT('".$date_2."','%Y-%m-%d'), INTERVAL -1 DAY),DATE_FORMAT('".$date_2."','%Y-%m-%d'), 
						 DATE_ADD( DATE_FORMAT('".$date_1."','%Y-%m-%d'), INTERVAL -1 DAY),
						 DATE_ADD( DATE_FORMAT('".$date_1."','%Y-%12-%31'), INTERVAL -1 YEAR ) ");
     if ($res0=mysql_fetch_array($result0,MYSQL_NUM))
	 {
	 	$day1 = $res0[0]; 	 $day2 = $res0[1]; 
	 	$month1 = $res0[2];  $month2 = $res0[1]; 
	 	$year1 = $res0[3]; 	 $year2 = $res0[1]; 
		$total=$res0[1];
		mysql_free_result($result0);
	}
}
if ($mode==2)
{	//накопление энергии
	 $result1=mysql_query("select min(data) from ".$table." where n_obj=".$n_obj." AND link_adr=".$adr."");
     if ($res1=mysql_fetch_array($result1,MYSQL_NUM))
	 {
	  $day1=$res1[0];$month1 = $res1[0];$year1 = $res1[0];
	 }
	 $result0=mysql_query("select DATE_ADD( DATE_FORMAT('".$date_2."','%Y-%m-%d'), INTERVAL -1 DAY), 
	 					 DATE_ADD( DATE_FORMAT('".$date_1."','%Y-%m-%d'), INTERVAL -1 DAY),
						 DATE_ADD( DATE_FORMAT('".$date_1."','%Y-%12-%31'), INTERVAL -1 YEAR ),
						 DATE_FORMAT('".$date_2."','%Y-%m-%d') ");
     if ($res0=mysql_fetch_array($result0,MYSQL_NUM))
	 {
	 	 $day2 = $res0[0]; 	  $month2 = $res0[1];  	 $year2 = $res0[2]; 		$total=$res0[3];
		mysql_free_result($result0);
	}
 }
}

function PrintHeader($uid,$n_obj,$adr,$date_,$date_2,$mode)
{
global $zn;
//=============== формирование заголовка ===============================
list ($ac_day,$ac_month,$ac_year) = explode (".",$date_); 
if ($mode==1)
{
	$col1_1="за день";
	$col1_2=$date_;
	$col2_1="за месяц";
	$col2_2=rdate($date_2,' \P-Y ');
	$col3_1="за год";
	$col3_2=$ac_year;
	$header="Приращение энергии";
}
if ($mode==2)
{
	$col1_1="на ";
	$col1_2=$date_;
	$col2_1="на ";
	$col2_2="01.".$ac_month.".".$ac_year;
	$col3_1="на ";
	$col3_2=rdate($date_2,'01.01.Y');
	$header="Накопление энергии";
}
//=====================определяем параметры и название точки учета===================================
   $result=mysql_query("select item_name FROM objects WHERE  item_parent_id=-1");
    if ($res=mysql_fetch_array($result,MYSQL_BOTH))
	{
 		$obj_name=$res[0]; 
	}
	$result=mysql_query("select item_name FROM objects WHERE  item_id=(select item_parent_id FROM objects WHERE item_id=".$uid.") ");
    if ($res=mysql_fetch_array($result,MYSQL_BOTH))
	{
	 $pname=$res[0];
	} 
	$result=mysql_query("select node_type FROM objects WHERE  item_id=".$uid." ");
    if ($res=mysql_fetch_array($result,MYSQL_BOTH))
	{
	 $n_type=$res[0];
	} 
	$result=mysql_query("select izm_str,descript,znum,c_type,k_tr FROM counters WHERE  n_obj=".$n_obj." AND link_adr=".$adr." ");
    if ($res=mysql_fetch_array($result,MYSQL_BOTH))
	{
	 $izm_str=$res[0];	$type_izm = explode (",",$izm_str); $ktr=$res[4];$ctype=$res[3];
	 $name=$res[1]; 
	 if ($n_type==0) {if ($ctype==0 or $ctype==-1 or $ctype==-2) {$znum= "номер счетчика ".$res[2];$zn=$res[2];} }
	 else {$znum=""; $zn="";}
	} 
//==========================================================================================================================
		$col=8;
		echo "<table border='0' cellpadding='0' cellspacing='0' align='center' id='TB2'>\n";

		echo " 	<tr> <td colspan='".$col."' align='center'>".$obj_name."</td>   </tr>\n";
		echo " 	<tr> <td colspan='".$col."' align='center'>".$pname." ".$name."</td>   </tr>\n";
		if ($znum!="") echo " 	<tr> <td colspan='".$col."' align='center'>".$znum."</td> </tr>\n";
		else echo " 	<tr> <td colspan='".$col."' align='center'>&nbsp;".$znum."</td> </tr>\n";

		echo "<tr>\n";
		echo "<th colspan='$col'>&nbsp;\n";
        echo "<FONT COLOR='midnightblue' style='font-size:12px'>данные по состоянию на ".$date_."  </FONT> 	</th>\n";
		echo "</tr>\n";
		echo "</tr>\n";
		echo "<tr>\n";
		echo "	<td colspan='".($col)."' class='x23' style='border-bottom:none;'>".$header."</td>\n";
		echo "</tr>\n";
		echo "<tr>\n";
//		echo "	<td width='85' height='17' align='center' class='x23' style='border-top: none; border-left: none; vertical-align: middle;'>всего<br></td>\n";
//		echo "	<td class='x23' style='border-top:none;border-left:none'>&nbsp;</td>\n";
		echo "	<td class='x23' width='60' style='border-top:none;vertical-align:middle'>&nbsp;</td>\n";
		echo "	<td class='x23' style='border-bottom:none;border-left:none' width='85' align='center'>".$col1_1."</td>\n";
		echo "	<td class='x23' style='border-bottom:none;border-left:none'>&nbsp;</td>\n";
		echo "	<td class='x23' style='border-bottom:none;border-left:none' width='85' align='center'>".$col2_1."</td>\n";
		echo "	<td class='x23' style='border-bottom:none;border-left:none'>&nbsp;</td>\n";
		echo "	<td class='x23' style='border-bottom:none;border-left:none' width='85' align='center'>".$col3_1."</td>\n";
		echo "	<td class='x23' style='border-bottom:none;border-left:none'>&nbsp;</td>\n";
		echo "	<td class='x23'  style='border-top:none;vertical-align:middle;border-left:none;'>&nbsp;</td>\n";
		echo "</tr>\n";
		echo "<tr>\n";
//		echo "	<td width='85' height='17' align='center' class='x23' style='border-top: none; border-left: none; vertical-align: middle;'>всего<br></td>\n";
//		echo "	<td class='x23' style='border-top:none;border-left:none'>&nbsp;</td>\n";
		echo "	<td class='x23' width='60' style='border-top:none;vertical-align:middle'>Энергия</td>\n";
		echo "	<td class='x23' style='border-top:none;border-left:none' width='85' align='center'>".$col1_2."</td>\n";
		echo "	<td class='x23' style='border-top:none;border-left:none'>&nbsp;</td>\n";
		echo "	<td class='x23' style='border-top:none;border-left:none' width='85' align='center'>".$col2_2."</td>\n";
		echo "	<td class='x23' style='border-top:none;border-left:none'>&nbsp;</td>\n";
		echo "	<td class='x23' style='border-top:none;border-left:none' width='85' align='center'>".$col3_2."</td>\n";
		echo "	<td class='x23' style='border-top:none;border-left:none'>&nbsp;</td>\n";
		echo "	<td class='x23'  style='border-top:none;vertical-align:middle;border-left:none;'>ед. изм.</td>\n";
		echo "</tr>\n";
	//=========================================================================			
}
	
function PrintData($uid,$n_obj,$adr,$table,$day1,$day2,$month1,$month2,$year1,$year2,$izm_type,$mode)
{
	$result2 = mysql_query("select nrj_symb,nrj_unit,izm_type FROM IZM_TYPE WHERE izm_type between 5 and 8 group by izm_type ");	
	while ($row2=mysql_fetch_array($result2))
 {	  
	$e_type=$row2[0]; $e_unit=$row2[1];$izm_type=$row2[2];
	if ($mode==1)
	{
	 	$result=mysql_query("select max(inter_val) FROM ".$table." WHERE data='".$day2."' ");
		if (mysql_num_rows($result)>0)
		{
		 $res=mysql_fetch_array($result,MYSQL_BOTH); $max_int=$res[0]; 
		}
		 if (!isset($max_int)) $max_int=48;
		$result=mysql_query("select znach,flag from ".$table." where n_obj=".$n_obj." AND link_adr=".$adr." and izm_type=".$izm_type." and data='".$day2."' and inter_val=".$max_int." ");
		if (mysql_num_rows($result)>0)
		{
		 $res=mysql_fetch_array($result,MYSQL_BOTH); $e_day2=$res[0]; $fl_day2=$res[1];		mysql_free_result($result);
		}
		else {$e_day2=0;$fl_day2="^";}
		$result=mysql_query("select znach,flag from ".$table." where n_obj=".$n_obj." AND link_adr=".$adr." and izm_type=".$izm_type." and data='".$day1."' and inter_val=48 ");
		if (mysql_num_rows($result)>0)
		{
		 $res=mysql_fetch_array($result,MYSQL_BOTH); $e_day1=$res[0]; $fl_day1=$res[1]; 		mysql_free_result($result);
		}
		else {$e_day1=0;$fl_day1="^";}
		if ($e_day2>=$e_day1)	$e_day=$e_day2-$e_day1;
		else $e_day=0; 
		$fl_day=$fl_day1 or $fl_day2;
		$result=mysql_query("select znach,flag from ".$table." where n_obj=".$n_obj." AND link_adr=".$adr." and izm_type=".$izm_type." and data='".$month2."' and inter_val=".$max_int." ");
		if (mysql_num_rows($result)>0)
		{
		 $res=mysql_fetch_array($result,MYSQL_BOTH); $e_month2=$res[0]; $fl_month2=$res[1];		mysql_free_result($result);
		}
		else {$e_month2=0;$fl_month2="^";}
		$result=mysql_query("select znach,flag from ".$table." where n_obj=".$n_obj." AND link_adr=".$adr." and izm_type=".$izm_type." and data='".$month1."' and inter_val=48 ");
		if (mysql_num_rows($result)>0)
		{
		 $res=mysql_fetch_array($result,MYSQL_BOTH); $e_month1=$res[0]; $fl_month1=$res[1];
		}
		else {$e_month1=0;$fl_month1="^";}
		if ($e_month2>=$e_month1)	$e_month=$e_month2-$e_month1;
		else $e_month=0; 
		$fl_month=$fl_month1 or $fl_month2;
		$result=mysql_query("select znach,flag from ".$table." where n_obj=".$n_obj." AND link_adr=".$adr." and izm_type=".$izm_type." and data='".$year2."' and inter_val=".$max_int." ");
		if (mysql_num_rows($result)>0)
		{
		 $res=mysql_fetch_array($result,MYSQL_BOTH); $e_year2=$res[0]; $fl_year2=$res[1];		mysql_free_result($result);
		}
		else {$e_year2=0;$fl_year2="^";}
		$result=mysql_query("select znach,flag from ".$table." where n_obj=".$n_obj." AND link_adr=".$adr." and izm_type=".$izm_type." and data='".$year1."' and inter_val=48 ");
		if (mysql_num_rows($result)>0)
		{
		 $res=mysql_fetch_array($result,MYSQL_BOTH); $e_year1=$res[0]; $fl_year1=$res[1];
		}
		else {$e_year1=0;$fl_year1="^";}
		if ($e_year2>=$e_year1)	$e_year=$e_year2-$e_year1;
		else $e_year=0;
		$fl_year=$fl_year1 or $fl_year2;
//		$e_sum=$e_day2;
	}
		
	if ($mode==2)
	{   //считаем накопление за день
	 	$result=mysql_query("select min(inter_val) FROM ".$table." WHERE data='".$day1."' ");
		if (mysql_num_rows($result)>0)
		{
		 $res=mysql_fetch_array($result,MYSQL_BOTH); $min_int=$res[0]; 
		}
		 if (!isset($min_int)) $min_int=1;
	 		 $min_int=48;
		$result=mysql_query("select znach,flag from ".$table." where n_obj=".$n_obj." AND link_adr=".$adr." and izm_type=".$izm_type." and data='".$day2."' and inter_val=48 ");
		if (mysql_num_rows($result)>0)
		{
		 $res=mysql_fetch_array($result,MYSQL_BOTH); $e_day2=$res[0]; $fl_day2=$res[1];		mysql_free_result($result);
		}
		else {$e_day2=0;$fl_day2="^";}
		$e_day=$e_day2; $fl_day=$fl_day2;
		//считаем накопление за месяц
		$result=mysql_query("select znach,flag from ".$table." where n_obj=".$n_obj." AND link_adr=".$adr." and izm_type=".$izm_type." and data='".$month2."'  and inter_val=48 ");
		if (mysql_num_rows($result)>0)
		{
		 $res=mysql_fetch_array($result,MYSQL_BOTH); $e_month2=$res[0]; $fl_month2=$res[1];		mysql_free_result($result);
		}
		else {$e_month2=0;$fl_month2="^";}
		$e_month=$e_month2;$fl_month=$fl_month2;
		//считаем накопление за год
		$result=mysql_query("select znach,flag from ".$table." where n_obj=".$n_obj." AND link_adr=".$adr." and izm_type=".$izm_type." and data='".$year2."' and inter_val=48");
		if (mysql_num_rows($result)>0)
		{
		 $res=mysql_fetch_array($result,MYSQL_BOTH); $e_year2=$res[0]; $fl_year2=$res[1];		mysql_free_result($result);
		}
		else {$e_year2=0;$fl_year2="^";}
		$e_year=$e_year2;$fl_year=$fl_year2;
		//считаем накопление всего
//		$e_sum=$e_day2;
	}
	list ($ac_year,$ac_month,$ac_day) = explode ("-",$date_);  
    if (($ac_year-2000)<10)  $date_output=$ac_day.".".$ac_month.".0".($ac_year-2000);
	else $date_output=$ac_day.".".$ac_month.".".($ac_year-2000);
	//=============== формирование сетки дней ===============================
		 echo "<tr>\n";
 	     echo "<td class='x22' align='center' style='font-weight:600;text-align:left;border-top:none;padding-left:20px;' >".$e_type."</td>\n";
//		 echo "<td class='x22' style='border-top:none'>&nbsp;".format($e_sum)."</td>\n";
//		 echo "<td class='x22' style='border-top:none;border-left:none'>&nbsp;".$flag_sum."</td>\n";
		 echo "<td class='x22' style='border-top:none;border-left:none;'>&nbsp;".format($e_day)."</td>\n";
		 echo "<td class='x22' style='border-top:none;border-left:none'>&nbsp;".$fl_day."</td>\n";
		 echo "<td class='x22' style='border-top:none;border-left:none'>&nbsp;".format($e_month)."</td>\n";
		 echo "<td class='x22' style='border-top:none;border-left:none'>&nbsp;".$fl_month."</td>\n";
		 echo "<td class='x22' style='border-top:none;border-left:none'>&nbsp;".format($e_year)."</td>\n";
		 echo "<td class='x22' style='border-top:none;border-left:none'>&nbsp;".$fl_year."</td>\n";
		 echo "<td class='x22' style='border-top:none;border-left:none;text-align:left;padding-left:5px;'>&nbsp;".$e_unit."</td>\n";
		 echo "</tr>\n";
	//===============================================================================			
 }
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
echo "<div id='activator' ONCLICK=ToXls_4('TB',4,'".$pw_en."','".$count."','".$ac_day."','".$ac_day.".".$ac_month.".".$ac_year."','".$zn."','".$type."')></div>\n"; 
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
