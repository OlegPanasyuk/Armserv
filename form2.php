<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>Данные за месяц по дням</title>
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
    <link type="text/css" rel="stylesheet" href="css/TABLE2.CSS">
    <meta http-equiv="Cache-Control" content="no-cache"/>
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
HTML { overflow-x: hidden; }
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
.handle {border-radius: 11px;
-moz-border-radius: 10px;
	behavior: url(border-radius.htc);}

</style>
	<link rel="stylesheet" href="css/j.css"></link>
<?php
echo "<SCRIPT language=\"JavaScript1.2\">var tab=".$_GET["tab"].";\n";
echo "var halfmtab = ".$_GET["halfmtab"].";</SCRIPT>";
echo "<SCRIPT language=\"JavaScript1.2\" src=\"js/progressbar.js\"></SCRIPT>\n";
echo "<script language=\"JavaScript1.2\" src=\"js/control_f2.js\"></script>\n";
echo "<script language=\"JavaScript1.2\">formatData.style.display='none';</script>\n";
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
		topPos: '35%',							//Отступ сверху
		fixedPosition: false						//Позиционирование блока false - position: absolute, true - position: fixed
	});
});
</script>
</head>

<body id="f2" topmargin=0 marginheight=0 marginwidth=0 scroll="auto" onload="startIncrement();" background=tree/imgs/fon.gif>
<div id="padding" style="height:60px;" class="help2"></div>
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
$n_obj = $_GET["nobj"];
$adr = $_GET["adr"];
$maxp = $_GET["maxp"];
$edizm = $_GET["edizm"];
$halfmtab = $_GET["halfmtab"];

if (!isset($date_2)) $date_2=$dc;
if (!isset($pw_en)) $pw_en=$disp;

 $type_izm = array();
 $pwr = array();
 $nrg = array();
 $colname = array();
 $count=0;$num_day=0;$zn="";
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
			legenda.innerHTML=window.parent.toc.item_name.value+' <span style=\"color:black;font-size:10px;\">(выберите счетчик)</span>';
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
if (isset($date_2) and isset($uid) and isset($n_obj) and isset($adr) and isset($pw_en) and ( $node<2 ) )
{
include("include/mysql.php"); //  Соединяемся с БД
list ($ac_day,$ac_month,$ac_year) = explode (".",$date_2);
if (!checkdate ($ac_month,$ac_day,$ac_year)) $date_2=date('Y-m-d'); else $date_2=$ac_year.'-'.$ac_month.'-'.$ac_day;
$date_1=$ac_year.'-'.$ac_month.'-01';
$date_header1='01.'.$ac_month.'.'.$ac_year;
$date_header2=$ac_day.'.'.$ac_month.'.'.$ac_year;
echo "<script>\n";
echo "window.document.forms[0].disp.value='$disp';\n";
echo "window.document.forms[0].dc.value='$dc';\n";
echo "window.document.forms[0].iname.value='$name';\n";
echo "window.document.forms[0].id.value='$id';\n";
echo "window.document.forms[0].pid.value='$pid';\n";
echo "window.document.forms[0].lid.value='$lid';\n";
echo "window.document.forms[0].node.value='$node';\n";
echo "window.document.forms[0].maxp.value='$maxp';\n";
echo "window.document.forms[0].edizm.value='$edizm';\n";
echo "window.document.forms[0].halfmtab.value='$halfmtab'\n";
if ($disp!=1){
				echo "window.document.topmenu.maxp.style.visibility='hidden';\n";
				echo "maxp_lab.innerText='';\n";
			}
// else  echo "window.document.topmenu.maxp.style.visibility='visible';\n";
echo "formatData.style.display='inline';\n";
echo "</script>\n";
//============================================================================================================
function incrementProgressBar()
{
 global $count;
 $count++;
 echo "<script language=\"JavaScript\">incrementProgressBar();</script>\n";
 return $count;
}

	setInterval();
	$count=incrementProgressBar();
	$count=incrementProgressBar();
	PrintHeader($pw_en,$uid,$n_obj,$adr,$date_header2);
	$count=incrementProgressBar();
	$count=incrementProgressBar();
	CalcData($pw_en,$date_1,$date_2,$uid,$n_obj,$adr,$table);
	$count=incrementProgressBar();
	$count=incrementProgressBar();
	$count=incrementProgressBar();
	PrintSumData($pw_en,$date_1,$date_2,$uid,$n_obj,$adr,$table);
	$count=incrementProgressBar();
	$count=incrementProgressBar();
	if ($pw_en==2 or ($maxp==0 and $pw_en==1)) 	PrintZoneData($pw_en,$date_1,$date_2,$uid,$n_obj,$adr,$table);
	mysql_close();
}	
//============================================================================================================
function setInterval()
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


function PrintHeader($pw_en,$uid,$n_obj,$adr,$date_2)
{
  global $type_izm;
  global $pwr;
  global $nrg;
  global $maxp;
  global $colname;
  global $zn;
  global $edizm;
  
  $cnt1=0;  $cnt2=0;
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
 for ($i=0;$i<count($type_izm);$i++)
 {
  if ($type_izm[$i]<=4)
  {
	if ($pw_en<3)
	{
	 $pwr[$cnt1]=$type_izm[$i];
	 $nrg[$cnt1]=$type_izm[$i];
	 $cnt1++;
	} 
  }
  if ($type_izm[$i]>=5 and $type_izm[$i]<=8)
  {
	if ($pw_en==3)
	{
	 $nrg[$cnt2]=$type_izm[$i];
	 $cnt2++;
	} 
  }
 }
  if ($pw_en==1)  
  {
  	for ($i=0;$i<count($pwr);$i++)
	{
	 $result=mysql_query("select pwr_symb,pwr_unit FROM izm_type WHERE izm_type=". $pwr[$i]." ");
	 $row=mysql_fetch_array($result,MYSQL_BOTH);
	 $str = $row[1];
	 if ($edizm == 1000)	 $str = str_replace("к","М",$row[1]);
	 $colname[$i]=$row[0]." ".$str;
	}
  }	
  if ($pw_en==2)  
  {
  	for ($i=0;$i<count($nrg);$i++)
	{
	 $result=mysql_query("select nrj_symb,nrj_unit  FROM izm_type WHERE izm_type=". $nrg[$i]." ");
	 $row=mysql_fetch_array($result,MYSQL_BOTH);
	 $str = $row[1];
	 if ($edizm == 1000)	 $str = str_replace("к","М",$row[1]);
	 $colname[$i]=$row[0]." ".$str;
	}
  }	
  if ($pw_en==3)  
  {
  	for ($i=0;$i<count($nrg);$i++)
	{
	 $result=mysql_query("select nrj_symb,nrj_unit  FROM izm_type WHERE izm_type=". $nrg[$i]." ");
	 $row=mysql_fetch_array($result,MYSQL_BOTH);
	 $str = $row[1];
	 if ($edizm == 1000)	 $str = str_replace("к","М",$row[1]);
	 $colname[$i]=$row[0]." ".$str;
	 
	}
  }	
	$count=incrementProgressBar();
if (count($pwr)>0)
{
if ($pw_en<3) $col=count($pwr)*2+1;
if ($pw_en==3) $col=count($pwr)*4+1;
}
else
{
if ($pw_en<3) $col=7;
if ($pw_en==3) $col=9;
}
		list ($ac_day,$ac_month,$ac_year) = explode (".",$date_2); 
		echo "<table border='0' cellpadding='0' cellspacing='0' align='center' id='TB2'>\n";
		echo " 	<tr> <td colspan='".$col."' align='center'>".$obj_name."</td>   </tr>\n";
		echo " 	<tr> <td colspan='".$col."' align='center'>".$pname." ".$name."</td>   </tr>\n";
		if ($znum!="") echo " 	<tr> <td colspan='".$col."' align='center'>".$znum."</td> </tr>\n";
		else echo "";
		if ($ac_day=='01')
		 echo " 	<tr> <td colspan='".$col."' align='center'>за ". getMonthName($ac_month-1)." <FONT COLOR='midnightblue' style='font-size:12px'> по состоянию на ".$date_2."</FONT> </td> </tr>\n";
		else echo " <tr> <td colspan='".$col."' align='center'>за ". getMonthName($ac_month)."   <FONT COLOR='midnightblue' style='font-size:12px'> по состоянию на ".$date_2."</FONT>	</td> </tr>\n";

   	 echo "   		<tr>\n";
	 echo "			<td class='x23' style='width:80px;border-bottom:none'>&nbsp;</td>\n";
	 if ($pw_en==1) 
	  {
	   if ($maxp==1) echo "	<td  colspan='".(count($pwr)*2)."' class='x23' style='border-left:none' align='center'>Мощность в периоды контроля</td>\n";
	   else echo "<td  colspan='".(count($pwr)*2)."' class='x23' style='border-left:none' align='center'>Мощность</td>\n";
	  }
	 if ($pw_en==2) echo "	<td  colspan='".(count($nrg)*2)."' class='x23' style='border-left:none' align='center'>Энергия</td>\n";
	 if ($pw_en==3 and count($nrg)<>0) echo "	<td  colspan='".(count($nrg)*2)."' class='x23' style='border-left:none' align='center'>Показания (на 24:00)</td>\n";
	 echo "		</tr>\n";
	 echo "		<tr>\n";
	 if (count($nrg)==0) { echo "<td class='x23' style='border-top:none;'>Данная группа не предусматривает вывод показаний</td>\n";}else{
	 echo "	<td class='x23' style='border-top:none;text-align:center'>Дата</td>\n";}
		 for ($i=0;$i<count($colname);$i++)
		 {
		  echo "		<td class='x23' style='border-top:none;border-left:none' width='75'>".$colname[$i]."</td>\n";
		  echo "		<td class='x23' style='border-top:none;border-left:none' width='5'>&nbsp;</td>\n";
		 }
	 echo "		</tr>\n";
	$count=incrementProgressBar();
}
	
function CalcData($pw_en,$date_1,$date_2,$uid,$n_obj,$adr,$table)
{
  global $type_izm;
  global $pwr;
  global $nrg;
  global $maxp;
  global $colname;
  global $edizm;
  global $halfmtab;
  global $name;
  $a;
  $pwr_str='';$nrg_str='';

	$izm = array();	$flag = array();  $date_ = array();  $n_day=array();
	$count=incrementProgressBar();
	 $j=0; $i=0;
	 if (count($nrg)==0)
	 {	  $m1=0;$m2=0;	 }
	 else
	 {	  $m1=min($nrg);$m2=max($nrg);	 }
	  
	  
	  if ($pw_en==1)  
	  {
	    for ($i=0;$i<count($pwr);$i++)
		  {
		   $pwr_str.=$pwr[$i].',';
		  }
		$pwr_str=substr($pwr_str,0,strrpos($pwr_str, ","));
	   if ($maxp==1) //мощностьв периоды контроля
	   {
	   	$result=mysql_query("Select MAX(val.znach) As mx,MAX(flag),data,izm_type From ".$table.", intervals Where ".$table.".data BETWEEN '".$date_1."' AND '".$date_2."'  AND ".$table.".n_obj=".$n_obj." AND link_adr=".$adr." AND ".$table.".izm_type IN(".$pwr_str.") AND val.inter_val = intervals.inter_val AND intervals.max_zone IN(3,4) Group By data,izm_type order by ".$table.".izm_type");
	    $result2=mysql_query("Select MAX(val.znach) As mx,MAX(flag),data,izm_type From ".$table.", intervals Where ".$table.".data BETWEEN '".$date_1."' AND '".$date_2."'  AND ".$table.".n_obj=".$n_obj." AND link_adr=".$adr." AND ".$table.".izm_type IN(".$pwr_str.") AND val.inter_val = intervals.inter_val AND intervals.winter_zone IN(3,4) Group By data,izm_type order by ".$table.".izm_type");
	   }	
	    else//общий максимум мощности
	   {
		$result=mysql_query("Select MAX(val.znach) As mx,MAX(flag),data,izm_type From ".$table." Where ".$table.".data BETWEEN '".$date_1."' AND '".$date_2."'  AND ".$table.".n_obj=".$n_obj." AND link_adr=".$adr." AND ".$table.".izm_type IN(".$pwr_str.") Group By data,izm_type order by ".$table.".izm_type");
		}	
	  }
	  
	  
	  
	  if ($pw_en==2)  
	  {
	    for ($i=0;$i<count($nrg);$i++)
		  {
		   $nrg_str.=$nrg[$i].',';
		  }
		$nrg_str=substr($nrg_str,0,strrpos($nrg_str, ","));
	    $result=mysql_query("select SUM(znach),MAX(flag),data,izm_type FROM ".$table." WHERE ".$table.".data BETWEEN '".$date_1."' AND '".$date_2."'  AND ".$table.".n_obj=".$n_obj." AND link_adr=".$adr." AND ".$table.".izm_type IN(".$nrg_str.") GROUP BY data,izm_type");
	  }
	  if ($pw_en==3)  
	  {
	    for ($i=0;$i<count($nrg);$i++)
		  {
		   $nrg_str.=$nrg[$i].',';
		  }
		$nrg_str=substr($nrg_str,0,strrpos($nrg_str, ","));
	  	$result=mysql_query("select znach,flag,data,izm_type FROM ".$table." WHERE ".$table.".data BETWEEN '".$date_1."' AND '".$date_2."'  AND ".$table.".n_obj=".$n_obj." AND link_adr=".$adr."  AND ".$table.".izm_type IN(".$nrg_str.")  and ".$table.".inter_val=48 GROUP BY data,izm_type");
	  }
     
	 if ($result)
	 {
	  if (mysql_num_rows($result)>0)
	  while ($res=mysql_fetch_array($result,MYSQL_NUM))
	  {
	   list ($ac_year,$ac_month,$ac_day) = explode ("-",$res[2]);
	   $izm_type=$res[3];
	   $j=$izm_type-1;	
	   $i=$ac_day-1;
	   $izm[$i][$j]=$res[0]; 
	   $flag[$i][$j]=$res[1];	
	   $date_[$i]=$res[2];
 	   if (!isset($izm[$i][$j])) $izm[$i][$j]=0; 
 	   if (!isset($flag[$i][$j])) $flag[$i][$j]="^\n"; 
	   
	  }
	 } 
	 
	 if ($result2)
	 {
	  $a = 0;
	  if (mysql_num_rows($result2)>0)
	  while ($res2=mysql_fetch_array($result2,MYSQL_NUM))
	  {
	   list ($ac_year,$ac_month,$ac_day) = explode ("-",$res2[2]);
	   $izm_type=$res2[3];
	  
	   if ($izm_type==2){
	     $j=$izm_type-1;	
	   $i=$ac_day-1;
	   $izm[$i][$j]=$res2[0]; 
	   $flag[$i][$j]=$res2[1];
	  }
	 }
	}	 
    $count=incrementProgressBar();
	$i=0;
	$result=mysql_query("select distinct data FROM ".$table." WHERE ".$table.".data BETWEEN '".$date_1."' AND '".$date_2."'  AND ".$table.".n_obj=".$n_obj." AND link_adr=".$adr." AND ".$table.".izm_type between ".$m1." and ".$m2." ");
     if ($result)
	 {
	   while ($res=mysql_fetch_array($result,MYSQL_NUM))
	  {
	  
	   list ($ac_year,$ac_month,$ac_day) = explode ("-",$res[0]);
	 		$n_day[$i]=$ac_day-1;
			$i++;
	  }
	 } 
	PrintData($pw_en,$n_day,$date_,$izm,$flag,$halfmtab);
//}	
//===============================================================================			
}

function PrintData($pw_en,$n_day,$date_,$izm,$flag,$halfmtab)
{
  global $type_izm;
  global $pwr;
  global $nrg;
  global $colname;
  global $num_day;
  global $name; global $uid; global $n_obj;global $adr;global $pid; global $lid; global $node;
  global $edizm;
  global $maxp;

  for ($i=0;$i<count($date_);$i++)
  {
  $num_day++;
  $n=$n_day[$i];
  list ($ac_year,$ac_month,$ac_day) = explode ("-",$date_[$n]);  
	$date_output=$ac_day.".".$ac_month.".".$ac_year;
 echo "<tr>\n";
 echo "<td class='x22' align='center' style='font-weight:700;text-align:center;border-top:none;' id='".$date_output."'><a href='/form1.php?tab=".$halfmtab."&disp=".$pw_en."&edizm=".$edizm."&maxp=".$maxp."&dc=".$date_output."&iname=".$name."&id=".$uid."&pid=".$pid."&lid=".$lid."&node=".$node."&nobj=".$n_obj."&adr=".$adr."&framenode=form1&parentFrame=form2'>".$date_output."</a></td>\n";
	if ($pw_en==1)
	for ($j=(min($nrg)-1);$j<max($nrg);$j++)
	 {
	  //вывод мощности 
	  if (in_array(($j+1),$nrg))
	  {
	   if ($j>0)  echo "	<td class='x22' style='border-top:none;border-left:none;'>&nbsp;".format($izm[$n][$j]*2/$edizm)."</td>\n";
	   else       echo "	<td class='x22' style='border-top:none; '>&nbsp;".format($izm[$n][$j]*2/$edizm)."</td>\n";
	   echo "	<td class='x22' style='border-top:none;border-left:none;' align='right'>&nbsp;".$flag[$n][$j]."</td>\n";
	  } 
	 }	 
	if ($pw_en==2)
	for ($j=(min($nrg)-1);$j<max($nrg);$j++)
	 {
	  //вывод энергии 
	  if (in_array(($j+1),$nrg))
	  {
	    if ($j>0) echo "	<td class='x22' style='border-top:none;border-left:none;'>&nbsp;".format($izm[$n][$j]/$edizm)."</td>\n";
		else echo "	<td class='x22' style='border-top:none; border-left:none;'>&nbsp;".format($izm[$n][$j]/$edizm)."</td>\n";
	    echo "	<td class='x22' style='border-top:none;border-left:none' align='right'>&nbsp;".$flag[$n][$j]."</td>\n";
	  }	
	 }	 
	if ($pw_en==3)
	for ($j=(min($nrg)-1);$j<max($nrg);$j++)
	 {
	  //вывод показаний
	  if (in_array(($j+1),$nrg))
	  {
		if ($j>4) echo "	<td class='x22' style='border-top:none;border-left:none;'>&nbsp;".format($izm[$n][$j]/$edizm)."</td>\n";
		else echo "	<td class='x22' style='border-top:none;'>&nbsp;".format($izm[$n][$j]/$edizm)."</td>\n";
	    echo "	<td class='x22' style='border-top:none;border-left:none' align='right'>&nbsp;".$flag[$n][$j]."</td>\n";
	  }	
	 }	 
	 echo "</tr>\n";	
  }	 
}
function PrintSumData($pw_en,$date_1,$date_2,$uid,$n_obj,$adr,$table)
{
  global $type_izm;
  global $pwr;
  global $nrg;
  global $maxp;
  global $colname;
   global $node;
   global $edizm;
	$izm = array();	$flag = array();
	$pow = array(); $datetime = array();  
	$count=incrementProgressBar();		
	 for ($i=0;$i<count($colname);$i++)
	 {
		$izm_type=$nrg[$i];	
		if ($pw_en==1)//считать мощность
		{
 		 if ($maxp==1) //мощность в период контроля
		 {
	 	  if ($node==-1)//счетчик на обогрев
			$result=mysql_query(" SELECT s.mx,s.flag,DATE_FORMAT(s.data,'%d.%m.%Y'),s.inter_val,i.beg_int,i.end_int,i.heat_zone FROM (
		     SELECT MAX(znach) as mx, inter_val,flag,data FROM ".$table."
		     WHERE  ".$table.".data BETWEEN '".$date_1."' AND '".$date_2."' AND ".$table.".n_obj=".$n_obj." AND link_adr=".$adr." AND ".$table.".izm_type=".$izm_type."
		     GROUP BY inter_val,data ORDER BY mx DESC) s, intervals i
			 WHERE s.inter_val = i.inter_val and i.heat_zone IN(3,4) GROUP BY i.heat_zone  ORDER BY s.mx DESC limit 0,1");
		  else //счетчик обычный тариф
			$result=mysql_query(" SELECT s.mx,s.flag,DATE_FORMAT(s.data,'%d.%m.%Y'),s.inter_val,i.beg_int,i.end_int,i.max_zone FROM (
		     SELECT MAX(znach) as mx, inter_val,flag,data FROM ".$table."
		     WHERE  ".$table.".data BETWEEN '".$date_1."' AND '".$date_2."' AND ".$table.".n_obj=".$n_obj." AND link_adr=".$adr." AND ".$table.".izm_type=".$izm_type."
		     GROUP BY inter_val,data ORDER BY mx DESC) s, intervals i
			WHERE s.inter_val = i.inter_val and i.max_zone IN(3,4) GROUP BY i.max_zone  ORDER BY s.mx DESC limit 0,1");
		 }
		 else 
		 {
		   if ($node==-1)//счетчик на обогрев
			$result=mysql_query(" SELECT s.mx,s.flag,DATE_FORMAT(s.data,'%d.%m.%Y'),s.inter_val,i.beg_int,i.end_int FROM (
		     SELECT MAX(znach) as mx, inter_val,flag,data FROM ".$table."
		     WHERE  ".$table.".data BETWEEN '".$date_1."' AND '".$date_2."' AND ".$table.".n_obj=".$n_obj." AND link_adr=".$adr." AND ".$table.".izm_type=".$izm_type."
		     GROUP BY inter_val,data ORDER BY mx DESC) s, intervals i
		 	 WHERE s.inter_val = i.inter_val limit 0,1");
		   else //счетчик обычный тариф
			$result=mysql_query(" SELECT s.mx,s.flag,DATE_FORMAT(s.data,'%d.%m.%Y'),s.inter_val,i.beg_int,i.end_int FROM (
			SELECT MAX(znach) as mx, inter_val,flag,data FROM ".$table."
		    WHERE  ".$table.".data BETWEEN '".$date_1."' AND '".$date_2."' AND ".$table.".n_obj=".$n_obj." AND link_adr=".$adr." AND ".$table.".izm_type=".$izm_type."
		    GROUP BY inter_val,data ORDER BY mx DESC) s, intervals i
			WHERE s.inter_val = i.inter_val limit 0,1");
		 }	
		 if ($result)//выборка не пустая
			 {
			  $res=mysql_fetch_array($result,MYSQL_NUM);
			  $izm[$i]=$res[0]; $flag[$i]=$res[1];	
			  $datetime[$i]=$res[2]."<br>".$res[4]."-".$res[5];
//			  list ($ac_year,$ac_month,$ac_day) = explode ("-",$datetime[$i]);
		 	  if (!isset($izm[$i])) $izm[$i]=0; 
			  if (!isset($flag[$i])) $flag[$i]="^\n"; 
		 	  if (!isset($datetime[$i]) or ($izm[$i]==0)) $datetime[$i]=" \n"; 
			 }
		}
		if ($pw_en==2)//считать энергию
		{
		 $result=mysql_query("select SUM(znach),MAX(flag) FROM ".$table." WHERE ".$table.".data BETWEEN '".$date_1."' AND '".$date_2."' AND ".$table.".n_obj=".$n_obj." AND link_adr=".$adr."  AND ".$table.".izm_type=".$izm_type." ");
		  if ($result)
			 {
				$res=mysql_fetch_array($result,MYSQL_NUM);
			   	$izm[$i]=$res[0];$flag[$i]=$res[1];
				if (!isset($flag[$i])) $flag[$i]="^\n"; 
			 }
		} 
		if ($pw_en==3)//считать показания
		{
		 $result=mysql_query("select znach,flag FROM ".$table." WHERE ".$table.".data = '".$date_2."' AND ".$table.".n_obj=".$n_obj." AND link_adr=".$adr."  AND ".$table.".izm_type=".$izm_type." and ".$table.".inter_val=48");
		  if ($result)
			 {
				$res=mysql_fetch_array($result,MYSQL_NUM);
			   	$izm[$i]=$res[0];$flag[$i]=$res[1];
				if (!isset($flag[$i])) $flag[$i]="^\n"; 
			 }
		} 
	  }	
//==========================================================================================================================
	  {
  		echo " <tr>	<td height='3' class='x15' colspan='".(count($colname)*2+1)."'></td></tr>\n";
		echo " <tr>\n";
		echo "<td class='x15'>&nbsp;</td>\n";
		if ($pw_en==1)//вывод мощности 
		{
			if ($maxp==1) echo "<td class='x23'  colspan=".(count($colname)*2)."  align='center'>максимальная мощность в периоды контроля</td>\n";
			else echo "<td class='x23'  colspan=".(count($colname)*2)."  align='center'>максимальная мощность</td>\n";
		}
		if ($pw_en==2) echo "<td class='x23'  colspan=".(count($colname)*2)."  align='center'>суммарная энергия</td>\n";
		if ($pw_en==3 and count($nrg)<>0) echo "<td class='x23'  colspan=".(count($colname)*2)."  align='center'>итоговые показания</td>\n";
		echo "</tr>\n";
	  }
  	$count=incrementProgressBar();
	if ($pw_en==1)
	{
		echo "<tr>\n";
		echo "	<td class='x28' align='center' style='border-right:none;border-bottom:none;'>за месяц</td>\n";
		 for ($i=0;$i<count($colname);$i++)
		 {
		  //вывод мощности 
			 if ($i>0)  
				 echo "	<td class='x22' style='border-top:none;border-left:none;border-bottom:none;'>&nbsp;".format($izm[$i]*2/$edizm)."</td>\n";
			 else    
				 echo "	<td class='x22' style='border-top:none;border-bottom:none;'>&nbsp;".format($izm[$i]*2/$edizm)."</td>\n";
	   echo "	<td class='x22' style='border-top:none;border-left:none;border-bottom:none;' align='right'>&nbsp;".$flag[$i]."</td>\n";
	 }	 
	 echo "</tr>\n";	
		echo "<tr>\n";
		echo "	<td class='x28' style='border-right:none;border-top:none;'>&nbsp;</td>\n";
		 for ($i=0;$i<count($colname);$i++)
		 {
		  //вывод мощности 
			 if ($i>0)  
				echo "	<td class='x22' style='border-top:none;border-left:none;'>&nbsp;".$datetime[$i]."</td>\n";
			 else    
				 echo "	<td class='x22' style='border-top:none;'>&nbsp;".$datetime[$i]."</td>\n";
		   echo "	<td class='x22' style='border-top:none;border-left:none;' align='right'>&nbsp;</td>\n";
	 }	 
	 echo "</tr>\n";	
	}
	if ($pw_en==2)
	{
		echo "<tr>\n";
		echo "	<td rowspan='1' class='x28' align='center' style='vertical-align:middle;border-right:none;'>за месяц</td>\n";
		 for ($i=0;$i<count($colname);$i++)
		 {
		    if ($i>0) echo "	<td class='x22' style='border-top:none;border-left:none;'>&nbsp;".format($izm[$i]/$edizm)."</td>\n";
			else echo "	<td class='x22' style='border-top:none;'>&nbsp;".format($izm[$i]/$edizm)."</td>\n";
		   echo "	<td class='x22' style='border-top:none;border-left:none' align='right'>&nbsp;".$flag[$i]."</td>\n";
		 }	 
	 echo "</tr>\n";	
	 }
	if ($pw_en==3 and count($nrg)<>0)
	{
		echo "<tr>\n";
		echo "	<td rowspan='1' class='x28' align='center' style='vertical-align:middle;border-right:none;'>за месяц</td>\n";
		 for ($i=0;$i<count($colname);$i++)
		 {
		    if ($i>0) echo "	<td class='x22' style='border-top:none;border-left:none;'>&nbsp;".format($izm[$i]/$edizm)."</td>\n";
			else echo "	<td class='x22' style='border-top:none;'>&nbsp;".format($izm[$i]/$edizm)."</td>\n";
		   echo "	<td class='x22' style='border-top:none;border-left:none' align='right'>&nbsp;".$flag[$i]."</td>\n";
		 }	 
	 echo "</tr>\n";	
	} 
	$count=incrementProgressBar();
 }
 
function PrintZoneData($pw_en,$date_1,$date_2,$uid,$n_obj,$adr,$table)
//рисование итогов по зонам 
{
  global $type_izm;
  global $pwr;
  global $nrg;
  global $colname;
   global $node;
   global $edizm;
	$izm = array();	$flag = array();
	$pow = array(); $datetime = array();  
 $count=incrementProgressBar();
//	$result3=mysql_query("select n_zone,color,descript FROM zones order by n_zone");
	$result4=mysql_query("select * from seasons_hint order by n_season");
	if ($node==-2)
	{//если нужно считать по сезонам
		 list ($ac_year,$ac_month,$ac_day) = explode ("-",$date_2);
		 $beg_int_date=mktime (0,0,0, $ac_month, 1, $ac_year); 
		 $end_int_date=mktime (0,0,0, $ac_month, $ac_day, $ac_year); 
		 if ($ac_month==4 and $ac_day>14) {$step=1;$state=$ac_day.".".$ac_month." переход на лето<br>";}
		 else if ($ac_month==10 and $ac_day>14) {$step=2;$state=$ac_day.".".$ac_month." переход на зиму<br>";}
		 else {$step=0;$state=$ac_day.".".$ac_month." нет перехода<br>";}
		 $step=0;$state=$ac_day.".".$ac_month." нет перехода<br>";
//		 echo $state;
		 $curdate=str2date($date_2);
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
				{ //echo $i."_".$date_2."_Лето<br>";
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
	//	 echo $summer_begin."<".$curdate."<".$summer_end."<br>";
	 }

 if ($pw_en==1)//считаем зоны мощности 
 {
  if ($node==-1)//счетчик на обогрев
   {$result3=mysql_query("select n_zone,color,descript,timezone_h FROM zones where n_zone in (select distinct heat_zone from intervals) order by n_zone");}
  else if ($node==-2)//счетчик на генераторе
  {	
   if ($seas==1) $result3=mysql_query("select n_zone,color,descript,timezone_w,timezone_p FROM zones where n_zone in (select distinct max_zone from intervals) order by n_zone");
   if ($seas==2) $result3=mysql_query("select n_zone,color,descript,timezone_s,timezone_p FROM zones where n_zone in (select distinct max_zone from intervals) order by n_zone");
   if ($seas==0) $result3=mysql_query("select n_zone,color,descript,timezone_p FROM zones where n_zone in (select distinct max_zone from intervals) order by n_zone");
  } 
  else//счетчик обычный тариф
   $result3=mysql_query("select n_zone,color,descript,timezone_p FROM zones where n_zone in (select distinct max_zone from intervals) order by n_zone");
 }
 
 else //считаем зоны энергии 
  {
  if ($node==-1)//счетчик на обогрев
   $result3=mysql_query("select n_zone,color,descript,timezone_h FROM zones where n_zone in (select distinct heat_zone from intervals) order by n_zone");
  else if ($node==-2)//счетчик на генераторе
  {	
   if ($seas==1) $result3=mysql_query("select n_zone,color,descript,timezone_w FROM zones where n_zone in (select distinct winter_zone from intervals) order by n_zone");
   if ($seas==2) $result3=mysql_query("select n_zone,color,descript,timezone_s FROM zones where n_zone in (select distinct summer_zone from intervals) order by n_zone");
   if ($seas==0) $result3=mysql_query("select n_zone,color,descript,timezone_e FROM zones where n_zone in (select distinct n_zone from intervals) order by n_zone");
  } 
  else //обычный счетчик
   $result3=mysql_query("select n_zone,color,descript,timezone_e FROM zones where n_zone in (select distinct n_zone from intervals) order by n_zone");
  }
   if ($result3)
	$k=0;
	while ($res3=mysql_fetch_array($result3,MYSQL_BOTH))
	{
		$k++;
		
		$n_zone=$res3[0];$bgcolor=$res3[1]; $tariff_name=$res3[2];
		if ($k==4)
		{
			if ($node == -2){
				if ($pw_en==1)
				{
					$tariff_time="<font style='font-size:8px'>1.P+,Q+,Q- ".$res3[4]." 2. P- ".$res3[3]."</font>";
				}
				else $tariff_time="<font style='font-size:8px'> A- ".$res3[3]."</font>";}
				else $tariff_time="<font style='font-size:8px'>".$res3[3]."</font>";
		}
		else $tariff_time="<font style='font-size:8px'>".$res3[3]."</font>";
		//echo "$tariff_time, $n_zone";
		
	 for ($i=0;$i<count($colname);$i++)
 	 {
		$izm_type=$nrg[$i];
		if ($pw_en==1)//считаем мощность по зонам
		{
   	 	   if ($node==-1)//счетчик на обогрев
			$result=mysql_query(" SELECT s.mx,s.flag,DATE_FORMAT(s.data,'%d.%m.%Y'),s.inter_val,i.beg_int,i.end_int,i.heat_zone FROM (SELECT MAX(znach) as mx, inter_val,flag,data FROM ".$table." WHERE  ".$table.".data BETWEEN '".$date_1."' AND '".$date_2."' AND ".$table.".n_obj=".$n_obj." AND link_adr=".$adr." AND ".$table.".izm_type=".$izm_type." GROUP BY inter_val,data ORDER BY mx DESC) s, intervals i WHERE s.inter_val = i.inter_val and i.heat_zone=".$n_zone." ");
		   else if ($node==-2)//генерирущий
			{
			  if ($step==0) //нет перехода сезонов
			  {
				if ($seas==1)//сезон зима
				{
	 			 if ($izm_type==2) $result=mysql_query(" SELECT s.mx,s.flag,DATE_FORMAT(s.data,'%d.%m.%Y'),s.inter_val,i.beg_int,i.end_int,i.winter_zone FROM (SELECT MAX(znach) as mx, inter_val,flag,data FROM ".$table." WHERE  ".$table.".data BETWEEN '".$date_1."' AND '".$date_2."' AND ".$table.".n_obj=".$n_obj." AND link_adr=".$adr." AND ".$table.".izm_type=".$izm_type."  GROUP BY inter_val,data ORDER BY mx DESC) s, intervals i WHERE s.inter_val = i.inter_val and i.winter_zone=".$n_zone." ");
				 else $result=mysql_query(" SELECT s.mx,s.flag,DATE_FORMAT(s.data,'%d.%m.%Y'),s.inter_val,i.beg_int,i.end_int,i.n_zone FROM (SELECT MAX(znach) as mx, inter_val,flag,data FROM ".$table." WHERE  ".$table.".data BETWEEN '".$date_1."' AND '".$date_2."' AND ".$table.".n_obj=".$n_obj." AND link_adr=".$adr." AND ".$table.".izm_type=".$izm_type."  GROUP BY inter_val,data ORDER BY mx DESC) s, intervals i WHERE s.inter_val = i.inter_val and i.max_zone=".$n_zone." ");
				}
				else if ($seas==2)//сезон лето
				{
				 if ($izm_type==2) $result=mysql_query(" SELECT s.mx,s.flag,DATE_FORMAT(s.data,'%d.%m.%Y'),s.inter_val,i.beg_int,i.end_int,i.summer_zone FROM (SELECT MAX(znach) as mx, inter_val,flag,data FROM ".$table." WHERE  ".$table.".data BETWEEN '".$date_1."' AND '".$date_2."' AND ".$table.".n_obj=".$n_obj." AND link_adr=".$adr." AND ".$table.".izm_type=".$izm_type."  GROUP BY inter_val,data ORDER BY mx DESC) s, intervals i WHERE s.inter_val = i.inter_val and i.winter_zone=".$n_zone." ");
				 else $result=mysql_query(" SELECT s.mx,s.flag,DATE_FORMAT(s.data,'%d.%m.%Y'),s.inter_val,i.beg_int,i.end_int,i.n_zone FROM (SELECT MAX(znach) as mx, inter_val,flag,data FROM ".$table." WHERE  ".$table.".data BETWEEN '".$date_1."' AND '".$date_2."' AND ".$table.".n_obj=".$n_obj." AND link_adr=".$adr." AND ".$table.".izm_type=".$izm_type."  GROUP BY inter_val,data ORDER BY mx DESC) s, intervals i WHERE s.inter_val = i.inter_val and i.max_zone=".$n_zone." ");
				}	
			  }
	         else//переход сезонов 	
			 {
				if ($step==1)//сезон зима-->лето
				{
				 if ($izm_type==2) $result=mysql_query("(SELECT s.mx,s.flag,DATE_FORMAT(s.data,'%d.%m.%Y'),s.inter_val,i.beg_int,i.end_int,i.winter_zone FROM (SELECT MAX(znach) as mx, inter_val,flag,data FROM ".$table." WHERE  ".$table.".data BETWEEN '".$date_1."' AND '".date('Y-m-d',$end_date[0])."' AND ".$table.".n_obj=".$n_obj." AND link_adr=".$adr." AND ".$table.".izm_type=".$izm_type."  GROUP BY inter_val,data ORDER BY mx DESC) s, intervals i WHERE s.inter_val = i.inter_val and i.winter_zone=".$n_zone.") 
				 UNION ALL	  (SELECT s.mx,s.flag,DATE_FORMAT(s.data,'%d.%m.%Y'),s.inter_val,i.beg_int,i.end_int,i.winter_zone FROM (SELECT MAX(znach) as mx, inter_val,flag,data FROM ".$table." WHERE  ".$table.".data BETWEEN '".date('Y-m-d',$begin_date[1])."' AND '".$date_2."' AND ".$table.".n_obj=".$n_obj." AND link_adr=".$adr." AND ".$table.".izm_type=".$izm_type."  GROUP BY inter_val,data ORDER BY mx DESC) s, intervals i WHERE s.inter_val = i.inter_val and i.summer_zone=".$n_zone.") limit 0,1");
				 else $result=mysql_query(" SELECT s.mx,s.flag,DATE_FORMAT(s.data,'%d.%m.%Y'),s.inter_val,i.beg_int,i.end_int,i.n_zone FROM (SELECT MAX(znach) as mx, inter_val,flag,data FROM ".$table." WHERE  ".$table.".data BETWEEN '".$date_1."' AND '".$date_2."' AND ".$table.".n_obj=".$n_obj." AND link_adr=".$adr." AND ".$table.".izm_type=".$izm_type."  GROUP BY inter_val,data ORDER BY mx DESC) s, intervals i WHERE s.inter_val = i.inter_val and i.max_zone=".$n_zone." ");
				}
				else if ($step==2)//сезон лето-->зима
				{
				 if ($izm_type==2) $result=mysql_query("(SELECT s.mx,s.flag,DATE_FORMAT(s.data,'%d.%m.%Y'),s.inter_val,i.beg_int,i.end_int,i.winter_zone FROM (SELECT MAX(znach) as mx, inter_val,flag,data FROM ".$table." WHERE  ".$table.".data BETWEEN '".$date_1."' AND '".date('Y-m-d',$end_date[1])."' AND ".$table.".n_obj=".$n_obj." AND link_adr=".$adr." AND ".$table.".izm_type=".$izm_type."  GROUP BY inter_val,data ORDER BY mx DESC) s, intervals i WHERE s.inter_val = i.inter_val and i.winter_zone=".$n_zone.") 
				 UNION ALL	  (SELECT s.mx,s.flag,DATE_FORMAT(s.data,'%d.%m.%Y'),s.inter_val,i.beg_int,i.end_int,i.winter_zone FROM (SELECT MAX(znach) as mx, inter_val,flag,data FROM ".$table." WHERE  ".$table.".data BETWEEN '".date('Y-m-d',$begin_date[0])."' AND '".$date_2."' AND ".$table.".n_obj=".$n_obj." AND link_adr=".$adr." AND ".$table.".izm_type=".$izm_type."  GROUP BY inter_val,data ORDER BY mx DESC) s, intervals i WHERE s.inter_val = i.inter_val and i.summer_zone=".$n_zone.") limit 0,1");
				 else $result=mysql_query(" SELECT s.mx,s.flag,DATE_FORMAT(s.data,'%d.%m.%Y'),s.inter_val,i.beg_int,i.end_int,i.n_zone FROM (SELECT MAX(znach) as mx, inter_val,flag,data FROM ".$table." WHERE  ".$table.".data BETWEEN '".$date_1."' AND '".$date_2."' AND ".$table.".n_obj=".$n_obj." AND link_adr=".$adr." AND ".$table.".izm_type=".$izm_type."  GROUP BY inter_val,data ORDER BY mx DESC) s, intervals i WHERE s.inter_val = i.inter_val and i.max_zone=".$n_zone." ");
				}
			 }
	 	  }
		  else //счетчик обычный тариф
			$result=mysql_query(" SELECT s.mx,s.flag,DATE_FORMAT(s.data,'%d.%m.%Y'),s.inter_val,i.beg_int,i.end_int,i.max_zone FROM (SELECT MAX(znach) as mx, inter_val,flag,data FROM ".$table." WHERE  ".$table.".data BETWEEN '".$date_1."' AND '".$date_2."' AND ".$table.".n_obj=".$n_obj." AND link_adr=".$adr." AND ".$table.".izm_type=".$izm_type."  GROUP BY inter_val,data ORDER BY mx DESC) s, intervals i WHERE s.inter_val = i.inter_val and i.max_zone=".$n_zone." ");
	}//END OF if ($pw_en==1)
		 if ($result)//выборка не пустая
			 {
			  $res=mysql_fetch_array($result,MYSQL_NUM);
			  $izm[$i]=$res[0]; $flag[$i]=$res[1];	
			  $datetime[$i]=$res[2]."<br>".$res[4]."-".$res[5];
//			  list ($ac_year,$ac_month,$ac_day) = explode ("-",$datetime[$i]);
		 	  if (!isset($izm[$i])) $izm[$i]=0; 
			  if (!isset($flag[$i])) $flag[$i]="^\n"; 
		 	  if (!isset($datetime[$i]) or ($izm[$i]==0)) $datetime[$i]=" \n"; 
			 }
		
	if ($pw_en==2)//считаем энергию
	{
	 if ($node==-1)//счетчик на обогрев
		 $result=mysql_query("select SUM(znach),MAX(flag) FROM ".$table.",intervals WHERE ".$table.".data BETWEEN '".$date_1."' AND '".$date_2."'  AND ".$table.".n_obj=".$n_obj." AND link_adr=".$adr."  AND ".$table.".izm_type=".$izm_type." AND intervals.heat_zone=".$n_zone." AND ".$table.".inter_val=intervals.inter_val");
	 else if ($node==-2)//генерирущий
	 {
	  if ($step==0) //нет перехода сезонов
	  {
		if ($seas==1)//сезон зима
		{
		 if ($izm_type==2) $result=mysql_query("select SUM(znach),MAX(flag) FROM ".$table.",intervals WHERE ".$table.".data BETWEEN '".$date_1."' AND '".$date_2."'  AND ".$table.".n_obj=".$n_obj." AND link_adr=".$adr."  AND ".$table.".izm_type=".$izm_type." AND intervals.winter_zone=".$n_zone." AND ".$table.".inter_val=intervals.inter_val");
		 else $result=mysql_query("select SUM(znach),MAX(flag) FROM ".$table.",intervals WHERE ".$table.".data BETWEEN '".$date_1."' AND '".$date_2."'  AND ".$table.".n_obj=".$n_obj." AND link_adr=".$adr."  AND ".$table.".izm_type=".$izm_type." AND intervals.summer_zone=".$n_zone." AND ".$table.".inter_val=intervals.inter_val");
		}
		else if ($seas==2)//сезон лето
		{
		 if ($izm_type==2) $result=mysql_query("select SUM(znach),MAX(flag) FROM ".$table.",intervals WHERE ".$table.".data BETWEEN '".$date_1."' AND '".$date_2."'  AND ".$table.".n_obj=".$n_obj." AND link_adr=".$adr."  AND ".$table.".izm_type=".$izm_type." AND intervals.winter_zone=".$n_zone." AND ".$table.".inter_val=intervals.inter_val");
		 else $result=mysql_query("select SUM(znach),MAX(flag) FROM ".$table.",intervals WHERE ".$table.".data BETWEEN '".$date_1."' AND '".$date_2."'  AND ".$table.".n_obj=".$n_obj." AND link_adr=".$adr."  AND ".$table.".izm_type=".$izm_type." AND intervals.summer_zone=".$n_zone." AND ".$table.".inter_val=intervals.inter_val");
		}	
/*тут двойная сумма будет		
		else if ($seas==0)//сезон лето/зима
		{
		 $result=mysql_query("(select SUM(znach),MAX(flag) FROM ".$table.",intervals WHERE ".$table.".data BETWEEN '".$date_1."' AND '".$date_2."'  AND ".$table.".n_obj=".$n_obj." AND link_adr=".$adr."  AND ".$table.".izm_type=".$izm_type." AND intervals.winter_zone=".$n_zone." AND ".$table.".inter_val=intervals.inter_val)
		 UNION ALL(select SUM(znach),MAX(flag) FROM ".$table.",intervals WHERE ".$table.".data BETWEEN '".$date_1."' AND '".$date_2."'  AND ".$table.".n_obj=".$n_obj." AND link_adr=".$adr."  AND ".$table.".izm_type=".$izm_type." AND intervals.summer_zone=".$n_zone." AND ".$table.".inter_val=intervals.inter_val)");
		}	
*/		 
	  }
	  else 	//переход сезонов
	  {
		if ($step==1)//сезон зима-->лето
		{
		 if ($izm_type==2) $result=mysql_query("(select SUM(znach),MAX(flag) FROM ".$table.",intervals WHERE ".$table.".data BETWEEN '".$date_1."' AND '".date('Y-m-d',$end_date[0])."'  AND ".$table.".n_obj=".$n_obj." AND link_adr=".$adr."  AND ".$table.".izm_type=".$izm_type." AND intervals.winter_zone=".$n_zone." AND ".$table.".inter_val=intervals.inter_val)
		 UNION ALL(select SUM(znach),MAX(flag) FROM ".$table.",intervals WHERE ".$table.".data BETWEEN '".date('Y-m-d',$begin_date[1])."' AND '".$date_2."'  AND ".$table.".n_obj=".$n_obj." AND link_adr=".$adr."  AND ".$table.".izm_type=".$izm_type." AND intervals.summer_zone=".$n_zone." AND ".$table.".inter_val=intervals.inter_val)");
		 else $result=mysql_query("select SUM(znach),MAX(flag) FROM ".$table.",intervals WHERE ".$table.".data BETWEEN '".$date_1."' AND '".$date_2."'  AND ".$table.".n_obj=".$n_obj." AND link_adr=".$adr."  AND ".$table.".izm_type=".$izm_type." AND intervals.n_zone=".$n_zone." AND ".$table.".inter_val=intervals.inter_val");
		}
		else if ($step==2)//сезон лето-->зима
		{
		 if ($izm_type==2) $result=mysql_query("(select SUM(znach),MAX(flag) FROM ".$table.",intervals WHERE ".$table.".data BETWEEN '".$date_1."' AND '".date('Y-m-d',$end_date[1])."'  AND ".$table.".n_obj=".$n_obj." AND link_adr=".$adr."  AND ".$table.".izm_type=".$izm_type." AND intervals.summer_zone=".$n_zone." AND ".$table.".inter_val=intervals.inter_val)
		 UNION ALL(select SUM(znach),MAX(flag) FROM ".$table.",intervals WHERE ".$table.".data BETWEEN '".date('Y-m-d',$begin_date[0])."' AND '".$date_2."'  AND ".$table.".n_obj=".$n_obj." AND link_adr=".$adr."  AND ".$table.".izm_type=".$izm_type." AND intervals.winter_zone=".$n_zone." AND ".$table.".inter_val=intervals.inter_val)");
		 else $result=mysql_query("select SUM(znach),MAX(flag) FROM ".$table.",intervals WHERE ".$table.".data BETWEEN '".$date_1."' AND '".$date_2."'  AND ".$table.".n_obj=".$n_obj." AND link_adr=".$adr."  AND ".$table.".izm_type=".$izm_type." AND intervals.n_zone=".$n_zone." AND ".$table.".inter_val=intervals.inter_val");
		}	
	  }
	 }
	 else	//обычный счетчик
		 $result=mysql_query("select SUM(znach),MAX(flag) FROM ".$table.",intervals WHERE ".$table.".data BETWEEN '".$date_1."' AND '".$date_2."'  AND ".$table.".n_obj=".$n_obj." AND link_adr=".$adr."  AND ".$table.".izm_type=".$izm_type." AND intervals.n_zone=".$n_zone." AND ".$table.".inter_val=intervals.inter_val");
	 if ($result)
	 {
	   $izm[$i]=0; $flag[$i]='';
	   while ($res=mysql_fetch_array($result,MYSQL_NUM))
	   {
		   	$izm[$i]+=$res[0];$flag[$i]=$res[1];
			if (!isset($flag[$i])) $flag[$i]="\n"; 
	   }
	 } 
	} 
  }	
	echo " <tr>	<td height='3' class='x15' colspan='".(count($colname)*2+1)."'></td></tr>\n";		
//=============================================вывод полученных данных==================================================================
	 if ($pw_en==1)
	 {
      echo "<tr bgcolor=".$bgcolor.">\n";
		echo "<td rowspan='1' class='x23' style='border-bottom:none;border-right:none;width:150px;'>тариф ".$tariff_name."</td>\n";
  		//вывод мощности 
		for ($i=0;$i<count($nrg);$i++)
		{
		 if ($i>0)  
			echo "	<td class='x22' style='border-left:none;border-bottom:none;'>&nbsp;".format($izm[$i]*2/$edizm)."</td>\n";
		 else    
		    echo "	<td class='x22' style='border-bottom:none;'>&nbsp;".format($izm[$i]*2/$edizm)."</td>\n";
	 	echo "	<td class='x22' style='border-left:none;border-bottom:none;' align='right'>&nbsp;".$flag[$i]."</td>\n";
	  }	 
	 echo "</tr>\n";	

      echo "<tr bgcolor=".$bgcolor.">\n";
  	
		if ($step==0) echo "<td rowspan='1' class='x23' style='border-right:none;width:150px;'>".$tariff_time."</td>\n";
		if ($step==1) echo "<td rowspan='1' class='x23' style='border-right:none;width:150px;'>переход на лето</td>\n";
		if ($step==2) echo "<td rowspan='1' class='x23' style='border-right:none;width:150px;'>перход на зиму</td>\n";
  		//вывод мощности 
		for ($i=0;$i<count($nrg);$i++)
		{
		 	if ($i!=1)	
			{
			   $result4=mysql_query("select n_zone,color,descript,timezone_p FROM zones where n_zone=".$n_zone." ");
			   if ($res4=mysql_fetch_array($result4,MYSQL_NUM)) 
			    $t_t="<font style='font-size:8px'>".$res4[3]."</font>";
		 		if ($i>0)  echo "	<td class='x22' style='border-left:none;border-top:none;'>&nbsp;".$datetime[$i]."<br>&nbsp;</td>\n";
				else       echo "	<td class='x22' style='border-top:none;'>&nbsp;".$datetime[$i]."<br>&nbsp;</td>\n";
			 	echo "	<td class='x22' style='border-left:none;border-top:none;' align='right'>&nbsp;</td>\n";
		} 
		else
		{
				if ($step!=0) $tariff_time='';
		 		if ($i>0)  echo "	<td class='x22' style='border-left:none;border-top:none;'>&nbsp;".$datetime[$i]."<br>&nbsp;</td>\n";
				else       echo "	<td class='x22' style='border-top:none;'>&nbsp;".$datetime[$i]."<br>&nbsp;</td>\n";
			 	echo "	<td class='x22' style='border-left:none;border-top:none;' align='right'>&nbsp;</td>\n";
		}
	  }	 
	 echo "</tr>\n";	
	}	 
	
	   if ($pw_en==2)  
	   {
     echo "<tr bgcolor=".$bgcolor.">\n";
		echo "<td height='17' class='x23' style='border-right:none;width:150px;'>тариф ".$tariff_name."</td>\n";
	  //вывод энергии 
		for ($i=0;$i<count($colname);$i++)
		{
		    if ($i>0) echo "	<td class='x22' style='border-left:none;border-bottom:none;'>&nbsp;".format($izm[$i]/$edizm)."</td>\n";
				else echo "	<td class='x22' style='border-bottom:none;'>&nbsp;".format($izm[$i]/$edizm)."</td>\n";
		    echo "	<td class='x22' style='border-left:none;border-bottom:none;' align='right;'>&nbsp;".$flag[$i]."</td>\n";
		}	
	 echo "</tr>\n";	
     echo "<tr bgcolor=".$bgcolor.">\n";
		if ($step==0) echo "<td height='17' class='x23' style='border-right:none;border-top:none;width:150px;'>&nbsp;".$tariff_time."</td>\n";
		if ($step==1) echo "<td height='17' class='x23' style='border-right:none;border-top:none;width:150px;'>переход на лето</td>\n";
		if ($step==2) echo "<td height='17' class='x23' style='border-right:none;border-top:none;width:150px;'>перход на зиму</td>\n";
	  //вывод энергии 
		for ($i=0;$i<count($colname);$i++)
		{
	   		if ($i!=1)	
			{
			   $result4=mysql_query("select n_zone,color,descript,timezone_h FROM zones where n_zone=".$n_zone." ");
			   if ($res4=mysql_fetch_array($result4,MYSQL_NUM)) 
			    $t_t="<font style='font-size:8px'>".$res4[3]."</font>";
			    if ($i>0) echo "	<td class='x22' style='border-left:none;border-top:none;'>&nbsp;</td>\n";
				else echo "	<td class='x22' style='border-top:none;'>&nbsp;</td>\n";
			    echo "	<td class='x22' style='border-left:none;border-top:none;' align='right;'>&nbsp;</td>\n";
			}  
			else
			{
		     if ($i>0) echo "	<td class='x22' style='border-left:none;border-top:none;'>&nbsp;</td>\n";
				else echo "	<td class='x22' style='border-top:none;'>&nbsp;</td>\n";
		     echo "	<td class='x22' style='border-left:none;border-top:none;' align='right;'>&nbsp;</td>\n";
			}
		}	
	 echo "</tr>\n";	

	} 
	$count=incrementProgressBar();	 
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

echo "<script>
var name='".str_replace('\"', '', $name)."';
topmenu.iname.value=name;
</script>
";
if ($zn=='' or !isset($zn)) echo "<div id='activator' ONCLICK=ToXls_2('TB',2,'".$pw_en."','".$count."','".$num_day."','".$ac_day.".".$ac_month.".".$ac_year."',topmenu.iname.value,0)></div>\n"; 
else echo "<div id='activator' ONCLICK=ToXls_2('TB',2,'".$pw_en."','".$count."','".$num_day."','".$ac_day.".".$ac_month.".".$ac_year."','".$zn."',0)></div>\n"; 
?>
<center>
<div style="color:white;" class="help2"><b>.::</b>
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
