<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>Мощности по временным зонам, по суткам месяца</title>
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
echo "<script language=\"JavaScript1.2\" src=\"js/control_f3.js\"></script>";
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
		imageHeight: '40px',						//Высота кнопки
		imageWidth: '40px',						//Ширина кнопки
		tabLocation: 'right',						//Расположение панели top - выдвигается сверху, right - выдвигается справа, bottom - выдвигается снизу, left - выдвигается слева
		speed: 300,								//Скорость анимации
		action: 'click',								//Метод показа click - выдвигается по клику на кнопку, hover - выдвигается при наведении курсора
		topPos: '10%',							//Отступ сверху
		fixedPosition: false						//Позиционирование блока false - position: absolute, true - position: fixed
	});
});
</script>

</head>
<body id="f3" topmargin=0 marginheight=0 marginwidth=0 scroll="auto" onload="startIncrement();" background=tree/imgs/fon.gif>
<div id="padding" style="height:60px;" class="help2"></div>
<div id="content" style="height:80%;">
<?
include("include/mysql.php"); //  Соединяемся с БД
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
$edizm = $_GET["edizm"];

if (!isset($date_2)) $date_2=$dc;
if (!isset($pw_en)) $pw_en=$disp;
if (!isset($mode)) $mode=$disp;
if (!isset($izm_type)) $izm_type=$type;
 $type_izm = array();
 $pwr = array();
 $nrg = array();
 $colname = array();
 $zone_num=0;
 $count=0;$num_day=0;$zn="";
 if (!isset($pw_en)) $pw_en=0;
echo "
<script language=\"JavaScript1.2\">
	if (window.parent.toc.ntype)
	{
	 node=window.parent.toc.ntype.value;
     if (node<2) {
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

if (isset($date_2) and isset($uid) and isset($n_obj) and isset($adr) and isset($pw_en) and isset($type) and ($node<2) )
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
echo "window.document.forms[0].disp.value='$disp';\n";
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
 if ($mode==1)
 {
	setIntervalP();
	$count=incrementProgressBar();
	$count=incrementProgressBar();
	PrintHeaderP($uid,$n_obj,$adr,$type,$date_header2);
	$count=incrementProgressBar();
	$count=incrementProgressBar();
	CalcDataP($uid,$n_obj,$adr,$table,$date_1,$date_2,$izm_type);
	$count=incrementProgressBar();
	$count=incrementProgressBar();
 }	
//===============================================================================	
 if ($mode==2)
 {
   setIntervalE();
	$count=incrementProgressBar();
	$count=incrementProgressBar();
	PrintHeaderE($uid,$n_obj,$adr,$type,$date_header2);
	$count=incrementProgressBar();
	$count=incrementProgressBar();
   CalcDataE($uid,$n_obj,$adr,$table,$date_1,$date_2,$izm_type);
	$count=incrementProgressBar();
	$count=incrementProgressBar();
   CalcSumDataE($uid,$n_obj,$adr,$table,$date_1,$date_2,$izm_type); 
  } 
//==============================================================================================================

}
function setIntervalP()
{
global $date_1;
global $date_2;
	$count=incrementProgressBar();
//определяем начало и конец временного интервала
	if ($date_1==$date_2)
	{
	 $result1=mysql_query("select DATE_ADD( DATE_FORMAT('".$date_1."','%Y-%m-%d'), INTERVAL -1 MONTH) ");
     if ($res1=mysql_fetch_array($result1,MYSQL_NUM))
	 $date_1 = $res1[0]; 
	 $result2=mysql_query("select DATE_ADD( DATE_FORMAT('".$date_2."','%Y-%m-%d'), INTERVAL -1 DAY) ");
     if ($res2=mysql_fetch_array($result2,MYSQL_NUM))
	 $date_2 = $res2[0]; 
	}	
	else
	{
	 $result1=mysql_query("select DATE_ADD( DATE_FORMAT('".$date_1."','%Y-%m-%d'), INTERVAL +0 DAY) ");
     if ($res1=mysql_fetch_array($result1,MYSQL_NUM))
	 $date_1 = $res1[0]; 
	 $result2=mysql_query("select DATE_ADD( DATE_FORMAT('".$date_2."','%Y-%m-%d'), INTERVAL -1 DAY) ");
     if ($res2=mysql_fetch_array($result2,MYSQL_NUM))
	 $date_2 = $res2[0]; 
	}	
mysql_free_result($result1);mysql_free_result($result2);
}


function PrintHeaderP($uid,$n_obj,$adr,$type,$date_)
{
	global $zone_num;
	global $zn;
	global $node;
	global $date_1;
	global $date_2;
	global $edizm;
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
	$result=mysql_query("select pwr,pwr_symb,pwr_unit,descript FROM izm_type WHERE  izm_type=".$type." ");
    if ($res=mysql_fetch_array($result,MYSQL_BOTH))
	{
	  $str = $res[2];
	 if ($edizm == 1000)	 $str = str_replace("к","М",$res[2]);
	 
	 $powname=$res[0].' '.$res[3].' '.$res[1].' '.$str;
	} 
	
//==========================================================================================================================
	$result4=mysql_query("select * from seasons_hint order by n_season");
	if ($node==-2)
	{//если нужно считать по сезонам
		 list ($ac_year,$ac_month,$ac_day) = explode ("-",$date_2);
		 $beg_int_date=mktime (0,0,0, $ac_month, 1, $ac_year); 
		 $end_int_date=mktime (0,0,0, $ac_month, $ac_day, $ac_year); 
		 if ($ac_month==4 and $ac_day>14) {$step=1;/*echo $ac_day.".".$ac_month." переход на лето<br>";*/}
		 else if ($ac_month==10 and $ac_day>14) {$step=2;/*echo $ac_day.".".$ac_month." переход на зиму<br>";*/}
		 else {$step=0;/*echo $ac_day.".".$ac_month." нет перехода<br>";*/}
		 $curdate=str2date($date_2);
		 $step=0;$state=$ac_day.".".$ac_month." нет перехода<br>";
	//	 echo $curdate;

		if ($result4)
		{
		 	while ($res4=mysql_fetch_array($result4,MYSQL_NUM))
			{
			 $begin_date[$res4[0]-1]=mktime (0,0,0, $res4[2], $res4[1], $ac_year);
			 $end_date[$res4[0]-1]=mktime (0,0,0, $res4[4], $res4[3], $ac_year);
//			 echo date('d.m.Y',$end_date[$res4[0]-1])."<br>";
			 //echo $begin_date[$res4[0]-1]."_".$end_date[$res4[0]-1]."<br>";
		 	}	
		 }
		 if ($step==0)
		 {
		   if ($curdate>=$begin_date[1] and $curdate<=$end_date[1])
				{ //echo $i."_".$date_2."_Лето<br>";
				$isHeatSeason="Лето";$seas=2;} 
		   else 
		  		{ //echo $i."_".$date_2."_Зима<br>";
				$isHeatSeason="Зима";$seas=1;}
		 }
		 else
		 {
		  $isHeatSeason="Не определено";$seas=0;
		 }		
	 }

//=============== формирование заголовка ===============================
		 if ($node==-1) $result=mysql_query("select n_zone,color,descript,timezone_h FROM zones where n_zone in (select distinct heat_zone from intervals) order by n_zone");
		  else if ($node==-2 and $type==2)//счетчик на генераторе
		  {	
		   if ($seas==1) $result=mysql_query("select n_zone,color,descript,timezone_w FROM zones where n_zone in (select distinct winter_zone from intervals) order by n_zone");
		   if ($seas==2) $result=mysql_query("select n_zone,color,descript,timezone_s FROM zones where n_zone in (select distinct summer_zone from intervals) order by n_zone");
		   if ($seas==0) $result=mysql_query("select n_zone,color,descript,timezone_e FROM zones where n_zone in (select distinct n_zone from intervals) order by n_zone");
		  } 
		 else $result=mysql_query("select n_zone,color,descript,timezone_p FROM zones where n_zone in (select distinct max_zone from intervals) order by n_zone");
		 if ($result) 
		 {
		  $zone_num=mysql_num_rows($result);
		  	$i=0;
			while ($res=mysql_fetch_array($result,MYSQL_NUM))
			{
			 $tarif_name[$i]=$res[2]; $tarif_time[$i]="<font style='font-size:8px'>".$res[3]."</font>";
			 $i++;
			}
			$tariff_count=$i;
		 }
		 else $zone_num=4;
		 $col=($zone_num+1)*3+1;
		list ($ac_day,$ac_month,$ac_year) = explode (".",$date_); 
		echo "<table border='0' cellpadding='0' cellspacing='0' align='center' id='TB2'>\n";
		echo " 	<tr> <td colspan='".$col."' align='center'>".$obj_name."</td>   </tr>\n";
		echo " 	<tr> <td colspan='".$col."' align='center'>".$pname." ".$name."</td>   </tr>\n";
		echo "<tr><td colspan='".$col."' align='center'>Мощность по временным зонам, по суткам месяца</td></tr>\n";
		if ($znum!="") echo " 	<tr> <td colspan='".$col."' align='center'>".$znum."</td> </tr>\n";
		else echo " 	<tr> <td colspan='".$col."' align='center'>&nbsp;".$znum."</td> </tr>\n";
		if ($ac_day=='01')
		 echo " 	<tr> <td colspan='".$col."' align='center'>за ". getMonthName($ac_month-1)." <FONT COLOR='midnightblue' style='font-size:12px'> по состоянию на ".$date_."</FONT> </td> </tr>\n";
		else echo " <tr> <td colspan='".$col."' align='center'>за ". getMonthName($ac_month)."   <FONT COLOR='midnightblue' style='font-size:12px'> по состоянию на ".$date_."</FONT>	</td> </tr>\n";

		echo "<tr><td class='x23' colspan=".$col." style='border-bottom:none;'>".$powname."</td></tr>\n";

		echo "<tr>\n";
		echo "	<td rowspan = 2  class='x23' width='60' style='vertical-align:middle;'>&nbsp;</td>\n";
		for ($i=0;$i<$tariff_count;$i++)
		{
			echo "	<td  class='x23'  style='vertical-align:middle;border-left:none;border-right:none;width:160px;'>тариф </td>\n";
			echo "	<td  class='x23'  style='width:160px;text-align:left;vertical-align:middle;border-left:none;text-align:center;font-size:11px'>".$tarif_name[$i]."</td>\n";
			echo "	<td  class='x23'  style='vertical-align:middle;border-left:none;border-right:none;'>&nbsp;</td>\n";
		}
			echo "	<td  height='34'  class='x23'  style='vertical-align:middle;border-left:none;border-right:none;width:160px;'>&nbsp;</td>\n";
		echo "	<td class='x23'  style='text-align:center;vertical-align:middle;border-left:none;width:160px;'>за сутки</td>\n";
			echo "	<td  height='34' class='x23'  style='vertical-align:middle;border-left:none;'>&nbsp;</td>\n";
		echo "</tr>\n";

		echo "<tr>\n";
		//echo "	<td  class='x23' width='60' style='vertical-align:middle;border-top:none;'>&nbsp;</td>\n";
		for ($i=0;$i<$tariff_count;$i++)
		{
			echo "	<td  class='x23'  style='vertical-align:middle;border-left:none;border-right:none;border-top:none;'>&nbsp;</td>\n";
			if ($step==0) echo "	<td  class='x23'  style='width:140px;text-align:left;vertical-align:middle;border-left:none;border-top:none;text-align:center'><font style='font-size:8px'>".$tarif_time[$i]."</font></td>\n";
			if ($step==1) echo "	<td  class='x23'  style='width:140px;text-align:left;vertical-align:middle;border-left:none;border-top:none;text-align:center'><font style='font-size:8px'>переход на лето</font></td>\n";
			if ($step==2) echo "	<td  class='x23'  style='width:140px;text-align:left;vertical-align:middle;border-left:none;border-top:none;text-align:center'><font style='font-size:8px'>переход на зиму</font></td>\n";
			echo "	<td  class='x23'  style='vertical-align:middle;border-left:none;border-right:none;border-top:none;'>&nbsp;</td>\n";
		}
			echo "	<td  height='34' class='x23'  style='vertical-align:middle;border-left:none;border-right:none;border-top:none;'>&nbsp;</td>\n";
		echo "	<td class='x23'  style='text-align:left;vertical-align:middle;border-left:none;border-top:none;'>&nbsp;</td>\n";
			echo "	<td  height='34' class='x23'  style='vertical-align:middle;border-left:none;border-top:none;'>&nbsp;</td>\n";
		echo "</tr>\n";
		
		echo "<tr>\n";
		echo "	<td class='x23' width='60' style='vertical-align:middle;border-top:none;'>Дата</td>\n";
		for ($i=1;$i<=$zone_num;$i++)
		{
			echo "	<td class='x23' style='border-top:none;border-left:none' width='160'>время</td>\n";
			echo "	<td class='x23' style='border-top:none;border-left:none' align='center'>мощность</td>\n";
			echo "	<td class='x23' style='border-top:none;border-left:none'>&nbsp;</td>\n";
		}
		echo "	<td class='x23' style='border-top:none;border-left:none' width='160'>время</td>\n";
		echo "	<td class='x23' style='border-top:none;border-left:none'>мощность</td>\n";
		echo "	<td class='x23' style='border-top:none;border-left:none'>&nbsp;</td>\n";
		echo "</tr>\n";
	//=========================================================================			
}

function CalcDataP($uid,$n_obj,$adr,$table,$date_1,$date_2,$izm_type)
{
  global $type_izm;
  global $pwr;
  global $nrg;
  global $colname;
  global $node;
	$izm = array();	$flag = array();  $date_ = array();   $time = array();
//	$izm_day = array();	$flag_day = array();     $time_day = array(); $n_day = array();
	$izm_mon = array();	$flag_mon = array();  $date_m = array();   $time_mon = array();
	$bg = array(); $bg_day=array();
	$style = array(); $style_day=array();
	$result4=mysql_query("select * from seasons_hint order by n_season");
	if ($node==-2)
	{//если нужно считать по сезонам
		 list ($ac_year,$ac_month,$ac_day) = explode ("-",$date_2);
		 $beg_int_date=mktime (0,0,0, $ac_month, 1, $ac_year); 
		 $end_int_date=mktime (0,0,0, $ac_month, $ac_day, $ac_year); 
		 if ($ac_month==4 and $ac_day>14) {$step=1;/*echo $ac_day.".".$ac_month." переход на лето<br>";*/}
		 else if ($ac_month==10 and $ac_day>14) {$step=2;/*echo $ac_day.".".$ac_month." переход на зиму<br>";*/}
		 else {$step=0;/*echo $ac_day.".".$ac_month." нет перехода<br>";*/}
		 $curdate=str2date($date_2);
		 $step=0;$state=$ac_day.".".$ac_month." нет перехода<br>";
	//	 echo $curdate;

		if ($result4)
		{
		 	while ($res4=mysql_fetch_array($result4,MYSQL_NUM))
			{
			 $begin_date[$res4[0]-1]=mktime (0,0,0, $res4[2], $res4[1], $ac_year);
			 $end_date[$res4[0]-1]=mktime (0,0,0, $res4[4], $res4[3], $ac_year);
//			 echo date('d.m.Y',$end_date[$res4[0]-1])."<br>";
//			 echo $begin_date[$res4[0]-1]."_".$end_date[$res4[0]-1]."<br>";
		 	}	
		 }
		 if ($step==0)
		 {
		   if ($curdate>=$begin_date[1] and $curdate<=$end_date[1])
				{// echo $i."_".$date_2."_Лето<br>";
				$isHeatSeason="Лето";$seas=2;} 
		   else 
		  		{// echo $i."_".$date_2."_Зима<br>";
				$isHeatSeason="Зима";$seas=1;}
		 }
		 else
		 {
		  $isHeatSeason="Не определено";$seas=0;
		 }		
//			 echo "тип ".$node."<br>";
	 }

 //=========================================== вычисляем итоговые данные ====================================================
  $count=incrementProgressBar();
  //считаем общую макс. мощность
	//по зонам
	 	  if ($node==-1)//счетчик на обогрев
			$result=mysql_query(" SELECT s.mx,s.flag,s.data,s.inter_val,i.beg_int,i.end_int,i.heat_zone FROM (SELECT MAX(znach) as mx, inter_val,flag,data FROM ".$table." WHERE  ".$table.".data BETWEEN '".$date_1."' AND '".$date_2."' AND ".$table.".n_obj=".$n_obj." AND link_adr=".$adr." AND ".$table.".izm_type=".$izm_type." GROUP BY inter_val,data ORDER BY mx DESC) s, intervals i WHERE s.inter_val = i.inter_val GROUP BY i.heat_zone");
		   else if ($node==-2)//генерирущий
			{
			  if ($step==0) //нет перехода сезонов
			  {
				if ($seas==1)//сезон зима
				{
				 if ($izm_type==2) $result=mysql_query(" SELECT s.mx,s.flag,s.data,s.inter_val,i.beg_int,i.end_int,i.winter_zone FROM (SELECT MAX(znach) as mx, inter_val,flag,data FROM ".$table." WHERE  ".$table.".data BETWEEN '".$date_1."' AND '".$date_2."' AND ".$table.".n_obj=".$n_obj." AND link_adr=".$adr." AND ".$table.".izm_type=".$izm_type." GROUP BY inter_val,data ORDER BY mx DESC) s, intervals i WHERE s.inter_val = i.inter_val GROUP BY i.winter_zone");
				 else $result=mysql_query(" SELECT s.mx,s.flag,s.data,s.inter_val,i.beg_int,i.end_int,i.max_zone FROM (SELECT MAX(znach) as mx, inter_val,flag,data FROM ".$table."  WHERE  ".$table.".data BETWEEN '".$date_1."' AND '".$date_2."' AND ".$table.".n_obj=".$n_obj." AND link_adr=".$adr." AND ".$table.".izm_type=".$izm_type." GROUP BY inter_val,data ORDER BY mx DESC) s, intervals i WHERE s.inter_val = i.inter_val GROUP BY i.max_zone");
				}
				else if ($seas==2)//сезон лето
				{
				 if ($izm_type==2) $result=mysql_query(" SELECT s.mx,s.flag,s.data,s.inter_val,i.beg_int,i.end_int,i.summer_zone FROM (SELECT MAX(znach) as mx, inter_val,flag,data FROM ".$table." WHERE  ".$table.".data BETWEEN '".$date_1."' AND '".$date_2."' AND ".$table.".n_obj=".$n_obj." AND link_adr=".$adr." AND ".$table.".izm_type=".$izm_type." GROUP BY inter_val,data ORDER BY mx DESC) s, intervals i WHERE s.inter_val = i.inter_val GROUP BY i.summer_zone");
				 else $result=mysql_query(" SELECT s.mx,s.flag,s.data,s.inter_val,i.beg_int,i.end_int,i.max_zone FROM (SELECT MAX(znach) as mx, inter_val,flag,data FROM ".$table."  WHERE  ".$table.".data BETWEEN '".$date_1."' AND '".$date_2."' AND ".$table.".n_obj=".$n_obj." AND link_adr=".$adr." AND ".$table.".izm_type=".$izm_type." GROUP BY inter_val,data ORDER BY mx DESC) s, intervals i WHERE s.inter_val = i.inter_val GROUP BY i.max_zone");
				}	
			  }
	         else//переход сезонов 	
			 {
				if ($step==1)//сезон зима-->лето
				{
				 if ($izm_type==2) $result=mysql_query("(SELECT s.mx,s.flag,s.data,s.inter_val,i.beg_int,i.end_int,i.winter_zone FROM (SELECT MAX(znach) as mx, inter_val,flag,data FROM ".$table." WHERE  ".$table.".data BETWEEN '".$date_1."' AND '".date('Y-m-d',$end_date[0])."' AND ".$table.".n_obj=".$n_obj." AND link_adr=".$adr." AND ".$table.".izm_type=".$izm_type." GROUP BY inter_val,data ORDER BY mx DESC) s, intervals i WHERE s.inter_val = i.inter_val GROUP BY i.winter_zone)
				 UNION ALL	  ( SELECT s.mx,s.flag,s.data,s.inter_val,i.beg_int,i.end_int,i.summer_zone FROM (SELECT MAX(znach) as mx, inter_val,flag,data FROM ".$table." WHERE  ".$table.".data BETWEEN '".date('Y-m-d',$begin_date[1])."' AND '".$date_2."' AND ".$table.".n_obj=".$n_obj." AND link_adr=".$adr." AND ".$table.".izm_type=".$izm_type." GROUP BY inter_val,data ORDER BY mx DESC) s, intervals i WHERE s.inter_val = i.inter_val GROUP BY i.summer_zone)");
				 else $result=mysql_query(" SELECT s.mx,s.flag,s.data,s.inter_val,i.beg_int,i.end_int,i.max_zone FROM (SELECT MAX(znach) as mx, inter_val,flag,data FROM ".$table."  WHERE  ".$table.".data BETWEEN '".$date_1."' AND '".$date_2."' AND ".$table.".n_obj=".$n_obj." AND link_adr=".$adr." AND ".$table.".izm_type=".$izm_type." GROUP BY inter_val,data ORDER BY mx DESC) s, intervals i WHERE s.inter_val = i.inter_val GROUP BY i.max_zone");
				}
				else if ($step==2)//сезон лето-->зима
				{
				 if ($izm_type==2) $result=mysql_query("(SELECT s.mx,s.flag,s.data,s.inter_val,i.beg_int,i.end_int,i.winter_zone FROM (SELECT MAX(znach) as mx, inter_val,flag,data FROM ".$table." WHERE  ".$table.".data BETWEEN '".$date_1."' AND '".date('Y-m-d',$end_date[1])."' AND ".$table.".n_obj=".$n_obj." AND link_adr=".$adr." AND ".$table.".izm_type=".$izm_type." GROUP BY inter_val,data ORDER BY mx DESC) s, intervals i WHERE s.inter_val = i.inter_val GROUP BY i.winter_zone)
				 UNION ALL	  ( SELECT s.mx,s.flag,s.data,s.inter_val,i.beg_int,i.end_int,i.summer_zone FROM (SELECT MAX(znach) as mx, inter_val,flag,data FROM ".$table." WHERE  ".$table.".data BETWEEN '".date('Y-m-d',$begin_date[0])."' AND '".$date_2."' AND ".$table.".n_obj=".$n_obj." AND link_adr=".$adr." AND ".$table.".izm_type=".$izm_type." GROUP BY inter_val,data ORDER BY mx DESC) s, intervals i WHERE s.inter_val = i.inter_val GROUP BY i.summer_zone) limit 0,1");
				 else $result=mysql_query(" SELECT s.mx,s.flag,s.data,s.inter_val,i.beg_int,i.end_int,i.max_zone FROM (SELECT MAX(znach) as mx, inter_val,flag,data FROM ".$table."  WHERE  ".$table.".data BETWEEN '".$date_1."' AND '".$date_2."' AND ".$table.".n_obj=".$n_obj." AND link_adr=".$adr." AND ".$table.".izm_type=".$izm_type." GROUP BY inter_val,data ORDER BY mx DESC) s, intervals i WHERE s.inter_val = i.inter_val GROUP BY i.max_zone");
				}
			 }
	 	  }
		  else //счетчик обычный тариф
			 $result=mysql_query(" SELECT s.mx,s.flag,s.data,s.inter_val,i.beg_int,i.end_int,i.max_zone FROM (SELECT MAX(znach) as mx, inter_val,flag,data FROM ".$table."  WHERE  ".$table.".data BETWEEN '".$date_1."' AND '".$date_2."' AND ".$table.".n_obj=".$n_obj." AND link_adr=".$adr." AND ".$table.".izm_type=".$izm_type." GROUP BY inter_val,data ORDER BY mx DESC) s, intervals i WHERE s.inter_val = i.inter_val GROUP BY i.max_zone");
	 if ($result)
	 while ($res=mysql_fetch_array($result,MYSQL_NUM))
	 {
	  $n_zone=$res[6]; $j=$n_zone-1;		  $date_m[$j]=$res[2];
	  if (isset($izm_mon[$j])) $izm_mon[$j]=max($izm_mon[$j],$res[0]);else $izm_mon[$j]=$res[0];
	   $flag_mon[$j]=$res[1];	
	  $time_mon[$j]=$res[4]."-".$res[5];
 	  if (!isset($izm_mon[$j])) $izm_mon[$j]=0; 
	  if (!isset($flag_mon[$j])) $flag_mon[$j]="^\n"; 
 	  if (!isset($time_mon[$j])) $time_mon[$j]=" \n"; 
	 }
	 
	 //общая за месяц
	//$result=mysql_query("Select MAX(val.znach) As mx,MAX(flag),data From ".$table." Where ".$table.".data BETWEEN '".$date_1."' AND '".$date_2."'  AND ".$table.".n_obj=".$n_obj." AND link_adr=".$adr." AND ".$table.".izm_type=".$izm_type."  group by data order by mx desc limit 0,1");
 	if ($node==-1)//счетчик на обогрев
	$result=mysql_query(" SELECT s.mx,s.flag,s.data,s.inter_val,i.beg_int,i.end_int FROM (SELECT MAX(znach) as mx, inter_val,flag,data FROM ".$table."  WHERE  ".$table.".data BETWEEN '".$date_1."' AND '".$date_2."' AND ".$table.".n_obj=".$n_obj." AND link_adr=".$adr." AND ".$table.".izm_type=".$izm_type."  GROUP BY inter_val,data ORDER BY mx DESC) s, intervals i WHERE s.inter_val = i.inter_val limit 0,1");
	else //счетчик обычный тариф
	$result=mysql_query(" SELECT s.mx,s.flag,s.data,s.inter_val,i.beg_int,i.end_int FROM (SELECT MAX(znach) as mx, inter_val,flag,data FROM ".$table."  WHERE  ".$table.".data BETWEEN '".$date_1."' AND '".$date_2."' AND ".$table.".n_obj=".$n_obj." AND link_adr=".$adr." AND ".$table.".izm_type=".$izm_type."  GROUP BY inter_val,data ORDER BY mx DESC) s, intervals i WHERE s.inter_val = i.inter_val limit 0,1");
	if ($result)
	 if ($res=mysql_fetch_array($result,MYSQL_NUM))
	 {
	  $Dmax=$res[2]; list ($ac_year,$ac_month,$ac_day) = explode ("-",$Dmax);
	  $Pmax=$res[0]; $Fmax=$res[1];	
	  $Tmax=$res[4]."-".$res[5];
 	  if (!isset($Pmax)) $Pmax=0; 
	  if (!isset($Fmax)) $Fmax="^\n"; 
 	  if (!isset($Tmax)) $Tmax=" \n"; 
	 }
//=========================================================================================
//======================================================= вычисляем данные по дням ==============================================
	 $result_d=mysql_query("SELECT MAX(znach) as mx,data FROM ".$table."  WHERE  ".$table.".data  BETWEEN '".$date_1."' AND '".$date_2."' AND ".$table.".n_obj=".$n_obj." AND link_adr=".$adr." AND ".$table.".izm_type=".$izm_type." GROUP BY data");
	 if ($result_d)
	 while ($res_d=mysql_fetch_array($result_d,MYSQL_NUM))
	 {
	 //общая за день
	 $result2=mysql_query(" SELECT s.mx,s.flag,s.data,s.inter_val,i.beg_int,i.end_int FROM (SELECT MAX(znach) as mx, inter_val,flag,data FROM ".$table."  WHERE  ".$table.".data ='".$res_d[1]."' AND ".$table.".n_obj=".$n_obj." AND link_adr=".$adr." AND ".$table.".izm_type=".$izm_type." GROUP BY inter_val ORDER BY mx DESC) s, intervals i WHERE s.inter_val = i.inter_val limit 1");
	 if ($result2)
	 while ($res2=mysql_fetch_array($result2,MYSQL_NUM))
	 {
	  $izm_day=$res2[0]; $flag_day=$res2[1];	
	  $time_day=$res2[4]."-".$res2[5];
 	  if (!isset($izm_day)) $izm_day=0; 
	  if (!isset($flag_day)) $flag_day="^"; 
 	  if (!isset($time_day)) $time_day=" "; 
	  if (format($izm_day)==format($Pmax)) //$bg_day[$i]="#33ff99"; else $bg_day[$i]="";
	   $style_day=";background-color:#33ff99;font-weight:700;"; else $style_day="";
//по зонам
	 $i=0;
		if ($node==-1)
		$result=mysql_query(" SELECT s.mx,s.flag,s.data,s.inter_val,i.beg_int,i.end_int,i.heat_zone FROM (SELECT MAX(znach) as mx, inter_val,flag,data FROM ".$table." WHERE  ".$table.".data = '".$res_d[1]."' AND ".$table.".n_obj=".$n_obj." AND link_adr=".$adr." AND ".$table.".izm_type=".$izm_type." GROUP BY inter_val ORDER BY mx DESC) s, intervals i WHERE s.inter_val = i.inter_val GROUP BY i.heat_zone");
	    else if ($node==-2)//генерирущий
			 {
			   $curdate=str2date($res2[2]);
			   if ($curdate>=$begin_date[1] and $curdate<=$end_date[1])
				{ //echo $i."_".$date_2."_Лето<br>";
				$isHeatSeason="Лето";$seas=2;} 
		       else 
		  		{ //echo $i."_".$date_2."_Зима<br>";
				$isHeatSeason="Зима";$seas=1;}
				if ($seas==1)//сезон зима
				{
				 if ($izm_type==2) $result=mysql_query(" SELECT s.mx,s.flag,s.data,s.inter_val,i.beg_int,i.end_int,i.winter_zone FROM (SELECT MAX(znach) as mx, inter_val,flag,data FROM ".$table." WHERE  ".$table.".data ='".$res_d[1]."' AND ".$table.".n_obj=".$n_obj." AND link_adr=".$adr." AND ".$table.".izm_type=".$izm_type." GROUP BY inter_val ORDER BY mx DESC) s, intervals i WHERE s.inter_val = i.inter_val GROUP BY i.winter_zone");
				 else $result=mysql_query(" SELECT s.mx,s.flag,s.data,s.inter_val,i.beg_int,i.end_int,i.max_zone FROM (SELECT MAX(znach) as mx, inter_val,flag,data FROM ".$table."  WHERE  ".$table.".data ='".$res_d[1]."' AND ".$table.".n_obj=".$n_obj." AND link_adr=".$adr." AND ".$table.".izm_type=".$izm_type." GROUP BY inter_val ORDER BY mx DESC) s, intervals i WHERE s.inter_val = i.inter_val GROUP BY i.max_zone");
				}
				else if ($seas==2)//сезон лето
				{
				 if ($izm_type==2) $result=mysql_query(" SELECT s.mx,s.flag,s.data,s.inter_val,i.beg_int,i.end_int,i.summer_zone FROM (SELECT MAX(znach) as mx, inter_val,flag,data FROM ".$table." WHERE  ".$table.".data ='".$res_d[1]."' AND ".$table.".n_obj=".$n_obj." AND link_adr=".$adr." AND ".$table.".izm_type=".$izm_type." GROUP BY inter_val ORDER BY mx DESC) s, intervals i WHERE s.inter_val = i.inter_val GROUP BY i.summer_zone");
				 else $result=mysql_query(" SELECT s.mx,s.flag,s.data,s.inter_val,i.beg_int,i.end_int,i.max_zone FROM (SELECT MAX(znach) as mx, inter_val,flag,data FROM ".$table."  WHERE  ".$table.".data ='".$res_d[1]."' AND ".$table.".n_obj=".$n_obj." AND link_adr=".$adr." AND ".$table.".izm_type=".$izm_type." GROUP BY inter_val ORDER BY mx DESC) s, intervals i WHERE s.inter_val = i.inter_val GROUP BY i.max_zone");
				}	
			 }
		else //счетчик обычный тариф
		$result=mysql_query(" SELECT s.mx,s.flag,s.data,s.inter_val,i.beg_int,i.end_int,i.max_zone FROM (SELECT MAX(znach) as mx, inter_val,flag,data FROM ".$table."  WHERE  ".$table.".data ='".$res_d[1]."' AND ".$table.".n_obj=".$n_obj." AND link_adr=".$adr." AND ".$table.".izm_type=".$izm_type." GROUP BY inter_val ORDER BY mx DESC) s, intervals i WHERE s.inter_val = i.inter_val GROUP BY i.max_zone");
	 if ($result)
	 while ($res=mysql_fetch_array($result,MYSQL_NUM))
	 {
	  	   list ($ac_year,$ac_month,$ac_day) = explode ("-",$res[2]);
	 		$n_day[$ac_day-1]=$ac_day-1;
	  $n_zone=$res[6]; $j=$n_zone-1;		  $date_=$res[2];
	  $izm[$j]=$res[0]; $flag[$j]=$res[1];	
	  $time[$j]=$res[4]."-".$res[5];

 	  if (!isset($izm[$j])) $izm[$j]=0; 
	  if (!isset($flag[$j])) $flag[$j]="^"; 
 	  if (!isset($time[$j])) $time[$j]=" "; 
	  if (format($izm[$j])==format($izm_mon[$j])) //$bg[$j]="#ccffcc"; else $bg[$j]="";
	  $style[$j]=";background-color:#ccffcc;font-weight:700;"; else $style[$j]="";
	 }
	}
	PrintDataP($n_day,$date_,$time,$izm,$flag,$time_day,$izm_day,$flag_day,$style,$style_day); 
	 }

	$count=incrementProgressBar();
	 $count=incrementProgressBar();
	PrintSumDataP($date_m,$time_mon,$izm_mon,$flag_mon,$Dmax,$Tmax,$Pmax,$Fmax); 
}


function PrintDataP($n_day,$date_,$time,$izm,$flag,$time_day,$izm_day,$flag_day,$style,$style_day)
{
 global $name; global $uid;global $n_obj;global $adr; global $pid; global $lid; global $node;global $zone_num;global $num_day;  global $edizm;
  list ($ac_year,$ac_month,$ac_day) = explode ("-",$date_);  
	$date_output=$ac_day.".".$ac_month.".".$ac_year;

	//=============== формирование сетки дней ===============================
		 echo "<tr>\n";
 	     echo "<td class='x22' align='center' style='font-weight:700;text-align:center;border-top:none;' id='".$date_output."' >".$date_output."</td>\n";
		for ($j=0;$j<$zone_num;$j++)
		{
		if ($flag[$j]=='^') $time[$j]='';
		 echo "<td class='x22' style='border-top:none;border-left:none;font-size:8px;width:80px;'>&nbsp;".$time[$j]."</td>\n";
		 echo "<td class='x22' style='border-top:none;border-left:none".$style[$j]."'>&nbsp;".format($izm[$j]*2/$edizm)."</td>\n";
		 echo "<td class='x22' style='border-top:none;border-left:none'>&nbsp;".$flag[$j]."</td>\n";
		} 
		if ($flag_day=='^') $time_day='';
		 echo "<td class='x22' style='border-top:none;border-left:none;font-size:8px;width:80px;'>&nbsp;".$time_day."</td>\n";
		 echo "<td class='x22' style='border-top:none;border-left:none".$style_day."'>&nbsp;".format($izm_day*2/$edizm)."</td>\n";
		 echo "<td class='x22' style='border-top:none;border-left:none'>&nbsp;".$flag_day."</td>\n";
		 echo "</tr>\n";
	//===============================================================================			
}

function PrintSumDataP($date_m,$time_mon,$izm_mon,$flag_mon,$Dmax,$Tmax,$Pmax,$Fmax) 
{
	global $zone_num; global $edizm;
 //=============== формирование итоговых результатов ===============================
		echo " <tr>\n";
		echo "<td height='10' class='x15' colspan='13'></td>\n";
		echo "</tr>\n";
		echo "<tr>\n";
		echo "	<td height='20' class='x28'style='text-align:center;border-bottom:none;'>Итого</td>\n";
		for ($j=0;$j<$zone_num;$j++)
		{
			echo "	<td class='x22' style='border-left:none;border-bottom:none;' >&nbsp;</td>\n";
			echo "	<td class='x22' style='border-left:none;border-bottom:none;' >&nbsp;".format( $izm_mon[$j]*2/$edizm)."</td>\n";
			echo "	<td class='x22' style='border-left:none;border-bottom:none;'>&nbsp;".$flag_mon[$j]."</td>\n";
		}
		  	echo "	<td class='x22' style='border-left:none;border-bottom:none;' >&nbsp;</td>\n";
		  	echo "	<td class='x22' style='border-left:none;border-bottom:none;' >&nbsp;".format( $Pmax*2/$edizm)."</td>\n";
			echo "	<td class='x22' style='border-left:none;border-bottom:none;'>&nbsp;".$Fmax."</td>\n";
		echo "</tr>\n";
 //=========================================================================			
 
		echo "<tr>\n";
		echo "	<td height='20' class='x28' align='center' style='border-top:none;'>&nbsp;</td>\n";
		for ($j=0;$j<$zone_num;$j++)
		{
		  list ($ac_year,$ac_month,$ac_day) = explode ("-",$date_m[$j]);  
//		  if (($ac_year-2000)<10)  $date_output=$ac_day.".".$ac_month.".0".($ac_year-2000);
//		  else $date_output=$ac_day.".".$ac_month.".".($ac_year-2000);
			$date_output=$ac_day.".".$ac_month.".".$ac_year;
		  if ($izm_mon[$j]==0) $date_output="\n";
			if ($flag_mon[$j]=='^') $time_mon[$j]='';
			echo "	<td class='x22' style='border-left:none;border-top:none;font-size:8px;' >&nbsp;".$time_mon[$j]."</td>\n";
			echo "	<td class='x22' style='border-left:none;border-top:none;font-size:8px;' >&nbsp;".$date_output."</td>\n";
			echo "	<td class='x22' style='border-left:none;border-top:none;'>&nbsp;</td>\n";
		}
		  list ($ac_year,$ac_month,$ac_day) = explode ("-",$Dmax);  
//		  if (($ac_year-2000)<10)  $date_output=$ac_day.".".$ac_month.".0".($ac_year-2000);
//		  else $date_output=$ac_day.".".$ac_month.".".($ac_year-2000);
			$date_output=$ac_day.".".$ac_month.".".$ac_year;
		  if ($Pmax==0) $date_output="\n";
			if ($Fmax=='^') $Tmax='';
		  	echo "	<td class='x22' style='border-left:none;border-top:none;font-size:8px;'>&nbsp;".$Tmax."</td>\n";
		  	echo "	<td class='x22' style='border-left:none;border-top:none;font-size:8px;'>&nbsp;".$date_output."</td>\n";
			echo "	<td class='x22' style='border-left:none;border-top:none;'>&nbsp;</td>\n";
			echo "</tr>\n";
 
}	
 
//===========================================================================================================================

function setIntervalE()
{
global $date_1;
global $date_2;
global $edizm;
	$count=incrementProgressBar();
//определяем начало и конец временного интервала
	if ($date_1==$date_2)
	{
	 $result1=mysql_query("select DATE_ADD( DATE_FORMAT('".$date_1."','%Y-%m-%d'), INTERVAL -1 MONTH) ");
     if ($res1=mysql_fetch_array($result1,MYSQL_NUM))
	 $date_1 = $res1[0]; 
	 $result2=mysql_query("select DATE_ADD( DATE_FORMAT('".$date_2."','%Y-%m-%d'), INTERVAL -1 DAY) ");
     if ($res2=mysql_fetch_array($result2,MYSQL_NUM))
	 $date_2 = $res2[0]; 
	}	
	else
	{
	 $result1=mysql_query("select DATE_ADD( DATE_FORMAT('".$date_1."','%Y-%m-%d'), INTERVAL +0 DAY) ");
     if ($res1=mysql_fetch_array($result1,MYSQL_NUM))
	 $date_1 = $res1[0]; 
	 $result2=mysql_query("select DATE_ADD( DATE_FORMAT('".$date_2."','%Y-%m-%d'), INTERVAL -1 DAY) ");
     if ($res2=mysql_fetch_array($result2,MYSQL_NUM))
	 $date_2 = $res2[0]; 
	}	
mysql_free_result($result1);mysql_free_result($result2);
}

function PrintHeaderE($uid,$n_obj,$adr,$type,$date_)
{
	global $zone_num;
	global $zn;
	global $node;
	global $date_1;
	global $date_2;
	global $edizm;
//=====================определяем параметры и название точки учета===================================
   $result=mysql_query("select item_name FROM objects WHERE  item_parent_id=-1");
    if ($res=mysql_fetch_array($result,MYSQL_BOTH))
	{
 		$obj_name=$res[0]; 
	}
	$result=mysql_query("select descript,znum,c_type FROM counters WHERE  n_obj=".$n_obj." AND link_adr=".$adr." ");
    if ($res=mysql_fetch_array($result,MYSQL_BOTH))
	{
	 $name=$res[0]; if ($res[2]==0) {$znum= "номер счетчика ".$res[1];$zn=$res[1];} else {$znum=""; $zn="";} 
	} 
	$result=mysql_query("select item_name FROM objects WHERE  item_id=(select item_parent_id FROM objects WHERE item_id=".$uid.") ");
    if ($res=mysql_fetch_array($result,MYSQL_BOTH))
	{
	 $pname=$res[0];
	} 
	
	$result=mysql_query("select nrj,nrj_symb,nrj_unit,descript FROM izm_type WHERE  izm_type=".$type." ");
    if ($res=mysql_fetch_array($result,MYSQL_BOTH))
	{
	 $str = $res[2];
	 if ($edizm == 1000)	 $str = str_replace("к","М",$res[2]);
	 $enname=$res[0]." ".$res[3]." ".$res[1]." ".$str;
	} 
//==========================================================================================================================
	$result4=mysql_query("select * from seasons_hint order by n_season");
	if ($node==-2)
	{//если нужно считать по сезонам
		 list ($ac_year,$ac_month,$ac_day) = explode ("-",$date_2);
		 $beg_int_date=mktime (0,0,0, $ac_month, 1, $ac_year); 
		 $end_int_date=mktime (0,0,0, $ac_month, $ac_day, $ac_year); 
		 if ($ac_month==4 and $ac_day>14) {$step=1;/*echo $ac_day.".".$ac_month." переход на лето<br>";*/}
		 else if ($ac_month==10 and $ac_day>14) {$step=2;/*echo $ac_day.".".$ac_month." переход на зиму<br>";*/}
		 else {$step=0;/*echo $ac_day.".".$ac_month." нет перехода<br>";*/}
		 $curdate=str2date($date_2);
		 $step=0;$state=$ac_day.".".$ac_month." нет перехода<br>";
	//	 echo $curdate;

		if ($result4)
		{
		 	while ($res4=mysql_fetch_array($result4,MYSQL_NUM))
			{
			 $begin_date[$res4[0]-1]=mktime (0,0,0, $res4[2], $res4[1], $ac_year);
			 $end_date[$res4[0]-1]=mktime (0,0,0, $res4[4], $res4[3], $ac_year);
//			 echo date('d.m.Y',$end_date[$res4[0]-1])."<br>";
			 //echo $begin_date[$res4[0]-1]."_".$end_date[$res4[0]-1]."<br>";
		 	}	
		 }
		 if ($step==0)
		 {
		   if ($curdate>=$begin_date[1] and $curdate<=$end_date[1])
				{ //echo $i."_".$date_2."_Лето<br>";
				$isHeatSeason="Лето";$seas=2;} 
		   else 
		  		{ //echo $i."_".$date_2."_Зима<br>";
				$isHeatSeason="Зима";$seas=1;}
		 }
		 else
		 {
		  $isHeatSeason="Не определено";$seas=0;
		 }		
	 }

//=============== формирование заголовка ===============================
		 if ($node==-1) $result=mysql_query("select n_zone,color,descript,timezone_h FROM zones where n_zone in (select distinct heat_zone from intervals) order by n_zone");
		  else if ($node==-2 and $type==2)//счетчик на генераторе
		  {	
		   if ($seas==1) $result=mysql_query("select n_zone,color,descript,timezone_w FROM zones where n_zone in (select distinct winter_zone from intervals) order by n_zone");
		   else if ($seas==2) $result=mysql_query("select n_zone,color,descript,timezone_s FROM zones where n_zone in (select distinct summer_zone from intervals) order by n_zone");
			 else $result=mysql_query("select n_zone,color,descript,timezone_e FROM zones where n_zone in (select distinct n_zone from intervals) order by n_zone");
		  } 
		 else $result=mysql_query("select n_zone,color,descript,timezone_e FROM zones where n_zone in (select distinct n_zone from intervals) order by n_zone");
		$i=0;
		while ($res=mysql_fetch_array($result,MYSQL_NUM))
		{
		 $tarif_name[$i]=$res[2]; $tarif_time[$i]="<font style='font-size:8px'>".$res[3]."</font>";
		 $i++;
		}
		$tariff_count=$i;
		 $zone_num=mysql_num_rows($result);$col=($zone_num+1)*2+1;
		list ($ac_day,$ac_month,$ac_year) = explode (".",$date_); 
		echo "<table border='0' cellpadding='0' cellspacing='0' align='center' id='TB2'>\n";
		echo " 	<tr> <td colspan='".$col."' align='center'>".$obj_name."</td>   </tr>\n";
		echo " 	<tr> <td colspan='".$col."' align='center'>".$pname." ".$name."</td>   </tr>\n";
		echo "<tr><td colspan='".$col."' align='center'>Расход по временным зонам, по суткам месяца</td></tr>\n";
		if ($znum!="") echo " 	<tr> <td colspan='".$col."' align='center'>".$znum."</td> </tr>\n";
		if ($ac_day=='01')
		 echo " 	<tr> <td colspan='".$col."' align='center'>за ". getMonthName($ac_month-1)." <FONT COLOR='midnightblue' style='font-size:12px'> по состоянию на ".$date_."</FONT> </td> </tr>\n";
		else echo " <tr> <td colspan='".$col."' align='center'>за ". getMonthName($ac_month)."   <FONT COLOR='midnightblue' style='font-size:12px'> по состоянию на ".$date_."</FONT>	</td> </tr>\n";

		echo "<tr><td class='x23' colspan=".$col." style='border-bottom:none;'>".$enname."</td></tr>\n";
		echo "<tr>\n";
		echo "	<td class='x23' width='60' style='vertical-align:middle;'>&nbsp;</td>\n";
		for ($i=0;$i<$tariff_count;$i++)
		{
			echo "	<td class='x23' width='85' style='vertical-align:middle;border-left:none;'>тариф ".$tarif_name[$i]."</td>\n";
			echo "	<td class='x23' width='5' style='vertical-align:middle;border-left:none;'>&nbsp;</td>\n";
		}
		echo "	<td  class='x23' width='85' style='vertical-align:middle;border-left:none;'>за сутки</td>\n";
		echo "	<td   class='x23' width='5' style='vertical-align:middle;border-left:none;'>&nbsp;</td>\n";
		echo "</tr>\n";
		
		echo "<tr>\n";
		echo "	<td class='x23' width='60' style='vertical-align:middle;border-top:none;'>Дата/Зона</td>\n";
		for ($i=0;$i<$tariff_count;$i++)
		{
			if ($step==0) echo "	<td class='x23' width='85' style='vertical-align:middle;border-left:none;border-top:none;'>".$tarif_time[$i]."</td>\n";
			if ($step==1) echo "	<td class='x23' width='85' style='vertical-align:middle;border-left:none;border-top:none;'>переход на лето</td>\n";
			if ($step==2) echo "	<td class='x23' width='85' style='vertical-align:middle;border-left:none;border-top:none;'>переход на зиму</td>\n";
			echo "	<td class='x23' width='5' style='vertical-align:middle;border-left:none;border-top:none;'>&nbsp;</td>\n";
		}
		echo "	<td  class='x23' width='85' style='vertical-align:middle;border-left:none;border-top:none;'>&nbsp;</td>\n";
		echo "	<td   class='x23' width='5' style='vertical-align:middle;border-left:none;border-top:none;'>&nbsp;</td>\n";
		echo "</tr>\n";
		
	//=========================================================================			
}

function CalcDataE($uid,$n_obj,$adr,$table,$date_1,$date_2,$izm_type)
{
global $node;
	$result4=mysql_query("select * from seasons_hint order by n_season");
	if ($node==-2)
	{//если нужно считать по сезонам
		 list ($ac_year,$ac_month,$ac_day) = explode ("-",$date_2);
		 $beg_int_date=mktime (0,0,0, $ac_month, 1, $ac_year); 
		 $end_int_date=mktime (0,0,0, $ac_month, $ac_day, $ac_year); 
		 if ($ac_month==4 and $ac_day>14) {$step=1;/*echo $ac_day.".".$ac_month." переход на лето<br>";*/}
		 else if ($ac_month==10 and $ac_day>14) {$step=2;/*echo $ac_day.".".$ac_month." переход на зиму<br>";*/}
		 else {$step=0;/*echo $ac_day.".".$ac_month." нет перехода<br>";*/}
		 $curdate=str2date($date_2);
		 $step=0;$state=$ac_day.".".$ac_month." нет перехода<br>";
	//	 echo $curdate;

		if ($result4)
		{
		 	while ($res4=mysql_fetch_array($result4,MYSQL_NUM))
			{
			 $begin_date[$res4[0]-1]=mktime (0,0,0, $res4[2], $res4[1], $ac_year);
			 $end_date[$res4[0]-1]=mktime (0,0,0, $res4[4], $res4[3], $ac_year);
//			 echo date('d.m.Y',$end_date[$res4[0]-1])."<br>";
			 //echo $begin_date[$res4[0]-1]."_".$end_date[$res4[0]-1]."<br>";
		 	}	
		 }
		 if ($step==0)
		 {
		   if ($curdate>=$begin_date[1] and $curdate<=$end_date[1])
				{ //echo $i."_".$date_2."_Лето<br>";
				$isHeatSeason="Лето";$seas=2;} 
		   else 
		  		{ //echo $i."_".$date_2."_Зима<br>";
				$isHeatSeason="Зима";$seas=1;}
		 }
		 else
		 {
		  $isHeatSeason="Не определено";$seas=0;
		 }		
	 }

 //======================================================= вычисляем данные по дням ==============================================
 //общая за день
	$result=mysql_query("select SUM(znach),MAX(flag),data FROM ".$table." WHERE ".$table.".data BETWEEN '".$date_1."' AND '".$date_2."'  and n_obj=".$n_obj." AND link_adr=".$adr." AND izm_type=".$izm_type."   group by data order by data");	 
	while ($res=mysql_fetch_array($result,MYSQL_NUM))
	 {
	  list ($ac_year,$ac_month,$ac_day) = explode ("-",$res[2]);
	  $i=$ac_day-1;
	  $izm_day[$i]=$res[0]; $flag_day[$i]=$res[1];	
 	  if (!isset($izm_day[$i])) $izm_day[$i]=0; 
	  if (!isset($flag_day[$i])) $flag_day[$i]="^\n"; 
//============================================================================================
		 $curdate=str2date($res[2]);
		   if ($curdate>=$begin_date[1] and $curdate<=$end_date[1])
				{ //echo $i."_".$date_2."_Лето<br>";
				$isHeatSeason="Лето";$seas=2;} 
		   else 
		  		{ //echo $i."_".$date_2."_Зима<br>";
				$isHeatSeason="Зима";$seas=1;}
//=============================================================================================
	  
	  
	  	//по зонам
	  	if ($node==-1) $result2=mysql_query("select SUM(znach),MAX(flag),data,intervals.heat_zone FROM ".$table.", intervals WHERE ".$table.".data = '".$res[2]."' and n_obj=".$n_obj." AND link_adr=".$adr." AND izm_type=".$izm_type." AND ".$table.".inter_val=intervals.inter_val Group By data,intervals.heat_zone Order By data,intervals.heat_zone");
		  else if ($node==-2)//счетчик на генераторе
		  {	
		   if ($seas==1)      
		   {
		    if ($izm_type==2) $result2=mysql_query("select SUM(znach),MAX(flag),data,intervals.winter_zone FROM ".$table.", intervals WHERE ".$table.".data = '".$res[2]."' and n_obj=".$n_obj." AND link_adr=".$adr." AND izm_type=".$izm_type." AND ".$table.".inter_val=intervals.inter_val Group By data,intervals.winter_zone Order By data,intervals.winter_zone");
			else $result2=mysql_query("select SUM(znach),MAX(flag),data,intervals.n_zone FROM ".$table.", intervals WHERE ".$table.".data = '".$res[2]."' and n_obj=".$n_obj." AND link_adr=".$adr." AND izm_type=".$izm_type." AND ".$table.".inter_val=intervals.inter_val Group By data,intervals.n_zone Order By data,intervals.n_zone");
		   }	
		   else if ($seas==2)
		   {
		    if ($izm_type==2) $result2=mysql_query("select SUM(znach),MAX(flag),data,intervals.summer_zone FROM ".$table.", intervals WHERE ".$table.".data = '".$res[2]."' and n_obj=".$n_obj." AND link_adr=".$adr." AND izm_type=".$izm_type." AND ".$table.".inter_val=intervals.inter_val Group By data,intervals.summer_zone Order By data,intervals.summer_zone");
			else $result2=mysql_query("select SUM(znach),MAX(flag),data,intervals.n_zone FROM ".$table.", intervals WHERE ".$table.".data = '".$res[2]."' and n_obj=".$n_obj." AND link_adr=".$adr." AND izm_type=".$izm_type." AND ".$table.".inter_val=intervals.inter_val Group By data,intervals.n_zone Order By data,intervals.n_zone");
	       }	
		  } 
		else //обычный счетчик
		 $result2=mysql_query("select SUM(znach),MAX(flag),data,intervals.n_zone FROM ".$table.", intervals WHERE ".$table.".data = '".$res[2]."' and n_obj=".$n_obj." AND link_adr=".$adr." AND izm_type=".$izm_type." AND ".$table.".inter_val=intervals.inter_val Group By data,intervals.n_zone Order By data,intervals.n_zone");
		 if ($result2)
		 while ($res2=mysql_fetch_array($result2,MYSQL_NUM))
		 {
		  $n_zone=$res2[3];$j=$n_zone-1;	$i=$ac_day-1;
		  $date_[$i]=$res2[2];
		  $izm[$i][$j]=$res2[0]; $flag[$i][$j]=$res2[1];	
		 // echo $res2[0]."_".$res2[1]."_".$res2[2]."_".$res2[3]."_".$ac_day."<br>";
	 	  if (!isset($izm[$i][$j])) $izm[$i][$j]=0; 
		  if (!isset($flag[$i][$j])) $flag[$i][$j]="^\n"; 
		 }
	 }
	$i=0;
	$result=mysql_query("select distinct data FROM ".$table." WHERE ".$table.".data BETWEEN '".$date_1."' AND '".$date_2."'  AND ".$table.".n_obj=".$n_obj." AND link_adr=".$adr." AND ".$table.".izm_type =".$izm_type." ");
     if ($result)
	 {
	   while ($res=mysql_fetch_array($result,MYSQL_NUM))
	  {
	   list ($ac_year,$ac_month,$ac_day) = explode ("-",$res[0]);
	 		$n_day[$i]=$ac_day-1;
			$i++;
	  }
	 } 
	 
	$count=incrementProgressBar();
	PrintDataE($n_day,$date_,$izm,$flag,$izm_day,$flag_day); 

}

function PrintDataE($n_day,$date_,$izm,$flag,$izm_day,$flag_day) 
{
 global $name; global $uid; global $n_obj;global $adr;global $pid; global $lid; global $node;global $zone_num;global $num_day; global $edizm;
 for ($i=0;$i<count($date_);$i++)
 {
  if (count($date_)>10) 
  {
   if ((count($date_))%2==0) $count=incrementProgressBar();
  }
  else $count=incrementProgressBar();
  $num_day++; $n=$n_day[$i];
  list ($ac_year,$ac_month,$ac_day) = explode ("-",$date_[$n]);  
//   if (($ac_year-2000)<10)  $date_output=$ac_day.".".$ac_month.".0".($ac_year-2000);
//	else $date_output=$ac_day.".".$ac_month.".".($ac_year-2000);
	$date_output=$ac_day.".".$ac_month.".".$ac_year;
	//=============== формирование сетки дней ===============================
		 echo "<tr>\n";
// 	     echo "<td class='x22' colspan='1' align='center' style='cursor:hand;font-weight:500;text-align:center;border-top:none;' title='Посмотреть подробнее' id='".$date_output."' ><a href='Form1.php?disp=2&dc=".$date_output."&iname=".$name."&id=".$uid."&pid=".$pid."&lid=".$lid."&node=".$node."&nobj=".$n_obj."&adr=".$adr."'>".$date_output."</a></td>\n";
 	     echo "<td class='x22' colspan='1' align='center' style='font-weight:700;text-align:center;border-top:none;' id='".$date_output."' >".$date_output."</td>\n";
		for ($j=0;$j<$zone_num;$j++)
		{
		 echo "<td class='x22' style='border-top:none;border-left:none;'>&nbsp;".format($izm[$n][$j]/$edizm)."</td>\n";
		 echo "<td class='x22' style='border-top:none;border-left:none;'>&nbsp;".$flag[$n][$j]."</td>\n";
		} 
		 echo "<td class='x22' style='border-top:none;border-left:none;' >&nbsp;".format($izm_day[$n]/$edizm)."</td>\n";
		 echo "<td class='x22' style='border-top:none;border-left:none;'>&nbsp;".$flag_day[$n]."</td>\n";
		 echo "</tr>\n";
	//===============================================================================			
 }	
}
function CalcSumDataE($uid,$n_obj,$adr,$table,$date_1,$date_2,$izm_type)
{
 global $node; 
	$result4=mysql_query("select * from seasons_hint order by n_season");
	if ($node==-2)
	{//если нужно считать по сезонам
		 list ($ac_year,$ac_month,$ac_day) = explode ("-",$date_2);
		 $beg_int_date=mktime (0,0,0, $ac_month, 1, $ac_year); 
		 $end_int_date=mktime (0,0,0, $ac_month, $ac_day, $ac_year); 
		 if ($ac_month==4 and $ac_day>14) {$step=1;/*echo $ac_day.".".$ac_month." переход на лето<br>";*/}
		 else if ($ac_month==10 and $ac_day>14) {$step=2;/*echo $ac_day.".".$ac_month." переход на зиму<br>";*/}
		 else {$step=0;/*echo $ac_day.".".$ac_month." нет перехода<br>";*/}
		 $curdate=str2date($date_2);
		 $step=0;$state=$ac_day.".".$ac_month." нет перехода<br>";
	//	 echo $curdate;

		if ($result4)
		{
		 	while ($res4=mysql_fetch_array($result4,MYSQL_NUM))
			{
			 $begin_date[$res4[0]-1]=mktime (0,0,0, $res4[2], $res4[1], $ac_year);
			 $end_date[$res4[0]-1]=mktime (0,0,0, $res4[4], $res4[3], $ac_year);
//			 echo date('d.m.Y',$end_date[$res4[0]-1])."<br>";
			 //echo $begin_date[$res4[0]-1]."_".$end_date[$res4[0]-1]."<br>";
		 	}	
		 }
		 if ($step==0)
		 {
		   if ($curdate>=$begin_date[1] and $curdate<=$end_date[1])
				{ //echo $i."_".$date_2."_Лето<br>";
				$isHeatSeason="Лето";$seas=2;} 
		   else 
		  		{ //echo $i."_".$date_2."_Зима<br>";
				$isHeatSeason="Зима";$seas=1;}
		 }
		 else
		 {
		  $isHeatSeason="Не определено";$seas=0;
		 }		
	 }
 //======================================================= вычисляем данные по дням ==============================================
	//по зонам
	if ($node==-1)
     $result=mysql_query("select SUM(znach),MAX(flag),intervals.n_zone FROM ".$table.", intervals WHERE ".$table.".data BETWEEN '".$date_1."' AND '".$date_2."' and n_obj=".$n_obj." AND link_adr=".$adr." AND izm_type=".$izm_type." AND ".$table.".inter_val=intervals.inter_val Group By intervals.heat_zone Order By intervals.heat_zone");

	 else if ($node==-2)//генерирущий
	 {
	  if ($step==0) //нет перехода сезонов
	  {
		if ($seas==1)//сезон зима
		{
		 if ($izm_type==2) $result=mysql_query("select SUM(znach),MAX(flag),intervals.winter_zone FROM ".$table.", intervals WHERE ".$table.".data BETWEEN '".$date_1."' AND '".$date_2."' and n_obj=".$n_obj." AND link_adr=".$adr." AND izm_type=".$izm_type." AND ".$table.".inter_val=intervals.inter_val Group By intervals.winter_zone Order By intervals.winter_zone");
		 else $result=mysql_query("select SUM(znach),MAX(flag),intervals.n_zone FROM ".$table.", intervals WHERE ".$table.".data BETWEEN '".$date_1."' AND '".$date_2."' and n_obj=".$n_obj." AND link_adr=".$adr." AND izm_type=".$izm_type." AND ".$table.".inter_val=intervals.inter_val Group By intervals.n_zone Order By intervals.n_zone");
		}
		else if ($seas==2)//сезон лето
		{
		 if ($izm_type==2) $result=mysql_query("select SUM(znach),MAX(flag),intervals.summer_zone FROM ".$table.", intervals WHERE ".$table.".data BETWEEN '".$date_1."' AND '".$date_2."' and n_obj=".$n_obj." AND link_adr=".$adr." AND izm_type=".$izm_type." AND ".$table.".inter_val=intervals.inter_val Group By intervals.summer_zone Order By intervals.summer_zone");
		 else $result=mysql_query("select SUM(znach),MAX(flag),intervals.n_zone FROM ".$table.", intervals WHERE ".$table.".data BETWEEN '".$date_1."' AND '".$date_2."' and n_obj=".$n_obj." AND link_adr=".$adr." AND izm_type=".$izm_type." AND ".$table.".inter_val=intervals.inter_val Group By intervals.n_zone Order By intervals.n_zone");
		}	
/*тут двойная сумма будет				
		else if ($seas==0)//сезон лето/зима
		{
		 $result=mysql_query("(select SUM(znach),MAX(flag) FROM ".$table.",intervals WHERE ".$table.".data BETWEEN '".$date_1."' AND '".$date_2."'  AND ".$table.".n_obj=".$n_obj." AND link_adr=".$adr."  AND ".$table.".izm_type=".$izm_type." AND intervals.winter_zone=".$n_zone." AND ".$table.".inter_val=intervals.inter_val)
		 UNION ALL(select SUM(znach),MAX(flag) FROM ".$table.",intervals WHERE ".$table.".data BETWEEN '".$date_1."' AND '".$date_2."'  AND ".$table.".n_obj=".$n_obj." AND link_adr=".$adr."  AND ".$table.".izm_type=".$izm_type." AND intervals.summer_zone=".$n_zone." AND ".$table.".inter_val=intervals.inter_val)");
		}	
*/		
	  }
	  else 	
	  {
		if ($step==1)//сезон зима-->лето
		{
		 if ($izm_type==2) $result=mysql_query("(select SUM(znach),MAX(flag),intervals.winter_zone FROM ".$table.", intervals WHERE ".$table.".data BETWEEN '".$date_1."' AND '".date('Y-m-d',$end_date[0])."'  and n_obj=".$n_obj." AND link_adr=".$adr." AND izm_type=".$izm_type." AND ".$table.".inter_val=intervals.inter_val Group By intervals.winter_zone Order By intervals.winter_zone)
		 UNION ALL(select SUM(znach),MAX(flag),intervals.summer_zone FROM ".$table.", intervals WHERE ".$table.".data BETWEEN '".date('Y-m-d',$begin_date[1])."' AND '".$date_2."'  and n_obj=".$n_obj." AND link_adr=".$adr." AND izm_type=".$izm_type." AND ".$table.".inter_val=intervals.inter_val Group By intervals.summer_zone Order By intervals.summer_zone)");
		 else $result=mysql_query("select SUM(znach),MAX(flag),intervals.n_zone FROM ".$table.", intervals WHERE ".$table.".data BETWEEN '".$date_1."' AND '".$date_2."' and n_obj=".$n_obj." AND link_adr=".$adr." AND izm_type=".$izm_type." AND ".$table.".inter_val=intervals.inter_val Group By intervals.n_zone Order By intervals.n_zone");
		}
		else if ($step==2)//сезон лето-->зима
		{
		 if ($izm_type==2) $result=mysql_query("(select SUM(znach),MAX(flag),intervals.summer_zone FROM ".$table.", intervals WHERE ".$table.".data BETWEEN '".$date_1."' AND '".date('Y-m-d',$end_date[1])."'  and n_obj=".$n_obj." AND link_adr=".$adr." AND izm_type=".$izm_type." AND ".$table.".inter_val=intervals.inter_val Group By intervals.summer_zone Order By intervals.summer_zone)
		 UNION ALL(select SUM(znach),MAX(flag),intervals.winter_zone FROM ".$table.", intervals WHERE ".$table.".data BETWEEN '".date('Y-m-d',$begin_date[0])."' AND '".$date_2."'  and n_obj=".$n_obj." AND link_adr=".$adr." AND izm_type=".$izm_type." AND ".$table.".inter_val=intervals.inter_val Group By intervals.winter_zone Order By intervals.winter_zone)");
		 else $result=mysql_query("select SUM(znach),MAX(flag),intervals.n_zone FROM ".$table.", intervals WHERE ".$table.".data BETWEEN '".$date_1."' AND '".$date_2."' and n_obj=".$n_obj." AND link_adr=".$adr." AND izm_type=".$izm_type." AND ".$table.".inter_val=intervals.inter_val Group By intervals.n_zone Order By intervals.n_zone");
		}	
	  }
	 }
	else //обычный счетчик
     $result=mysql_query("select SUM(znach),MAX(flag),intervals.n_zone FROM ".$table.", intervals WHERE ".$table.".data BETWEEN '".$date_1."' AND '".$date_2."' and n_obj=".$n_obj." AND link_adr=".$adr." AND izm_type=".$izm_type." AND ".$table.".inter_val=intervals.inter_val Group By intervals.n_zone Order By intervals.n_zone");
	 while ($res=mysql_fetch_array($result,MYSQL_NUM))
	 {
	  list ($ac_year,$ac_month,$ac_day) = explode ("-",$res[2]);
	  $n_zone=$res[2];$j=$n_zone-1;
	  if (!isset($izm[$j])) $izm[$j]=0;
	  $izm[$j]+=$res[0]; $flag[$j]=$res[1];	
 	  if (!isset($izm[$j])) $izm[$j]=0; 
	  if (!isset($flag[$j])) $flag[$j]="^\n"; 
	 }
	 

//========================================================================================================================= 
	//общая за месяц
	$result=mysql_query("select SUM(znach),MAX(flag) FROM ".$table." WHERE ".$table.".data BETWEEN '".$date_1."' AND '".$date_2."'  and n_obj=".$n_obj." AND link_adr=".$adr." AND izm_type=".$izm_type." ");	 
	while ($res=mysql_fetch_array($result,MYSQL_NUM))
	 {
	  list ($ac_year,$ac_month,$ac_day) = explode ("-",$res[2]);
	  $Esum=$res[0]; $Fsum=$res[1];	
 	  if (!isset($Esum)) $Esum=0; 
	  if (!isset($Fsum)) $Fsum="^\n"; 
	 }
	 PrintSumDataE($izm,$flag,$Esum,$Fsum);
}
function PrintSumDataE($izm,$flag,$Esum,$Fsum)
{
	global $zone_num; global $edizm;
 //=============== формирование итоговых результатов ===============================
		echo " <tr>\n";
		echo "<td height='10' class='x15' colspan='9'></td>\n";
		echo "</tr>\n";
		echo "<tr>\n";
		echo "	<td colspan='1' height='20' class='x28' align='center'>Итого</td>\n";
		for ($j=0;$j<$zone_num;$j++)
		{
		 echo "	<td class='x22' style='border-left:none;'>&nbsp;".format($izm[$j]/$edizm)."</td>\n";
		 echo "	<td class='x22' style='border-left:none;'>&nbsp;".$flag[$j]."</td>\n";
		}
		echo "	<td class='x22' style='border-left:none;'>&nbsp;".format($Esum/$edizm)."</td>\n";
		echo "	<td class='x22' style='border-left:none;'>&nbsp;".$Fsum."</td>\n";
		echo "</tr>\n";
	//=========================================================================			
}	
//===========================================================================================================================
  	echo "</table>\n";
$TIME_END = getmicrotime();
$TIME_SCRIPT = $TIME_END - $TIME_START; 
?>
</td></tr></table>
</td></tr></table>
</td></tr></table>
</div>
<center>
<div style="color:white;" class="help2"><b>.::</b>
Время выполнения запроса <?=number_format($TIME_SCRIPT,3,".","");?> сек.
<b>::.</b>
</div>
<?
if (!isset($date_2)) $date_2=date('Y-m-d');
list($ac_year,$ac_month,$ac_day)=explode("-",$date_2);
echo "<div id='activator' ONCLICK=ToXls_3('TB',3,'".$pw_en."','".$count."','".$num_day."','".$ac_day.".".$ac_month.".".$ac_year."','".$zn."','".$izm_type."')></div>\n"; 
?>
</center>
<script language="VBScript" src="js/excel_export.vbs">
<!-- 
// --> 
</script>
</body>
</html>


