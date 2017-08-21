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
echo "<SCRIPT language=\"JavaScript1.2\">var tab=".$_GET["tab"]."</SCRIPT>";
echo "<SCRIPT language=\"JavaScript1.2\" src=\"js/progressbar.js\"></SCRIPT>\n";
echo "<script language=\"JavaScript1.2\" src=\"js/control_f12.js\"></script>\n";
echo "<script language=\"JavaScript1.2\">formatData.style.display='none';</script>\n";
require_once("include/vbs.php");
?>
<script language="JavaScript" src="js/tabs.js">

<!--
//-->
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
$disp_circle = $_GET["disp_circle"];
if (!isset($date_2)) $date_2=$dc;
if (!isset($pw_en)) $pw_en=$disp;

 $type_izm = array();
 $pwr = array();
 $nrg = array();
 $colname = array();
 $summ_arr = array();
 $count=0;$num_day=0;$zn="";

echo "
<script language=\"JavaScript1.2\">
	if (window.parent.toc.ntype)
	{
	 node=window.parent.toc.ntype.value;
     if (node==4 || node==5 || node == 6 || node == 7 || node == 9) {
	  legenda.innerHTML='<span style=\"color:black;font-size:10px;\">вывод данных по объекту:</span> ';
	  formatData.style.display='inline';
	 }
	 else {
			legenda.innerHTML=window.parent.toc.item_name.value+' <span style=\"color:black;font-size:10px;\"></span>';
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
if (isset($date_2) and isset($uid) and isset($n_obj) and isset($adr) and isset($pw_en) and ($node==4 or $node==5 or $node==6) )
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
echo "window.document.forms[0].disp_circle.value='$disp_circle';\n";
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
	if ($pw_en==2 or ($maxp==0 and $pw_en==1)) //	PrintZoneData($pw_en,$date_1,$date_2,$uid,$n_obj,$adr,$table);
	mysql_close();
}
//============================================================================================================
function setInterval()
{
global $date_1;
global $date_2;
	$count=incrementProgressBar();
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
  global $disp_circle;
  $type = array();
  $type[1] = array(501,502,503);
  $type[2] = array(501,502,503,506,509,512,513,515,516);
  $type[3] = array(501,502,504,507,510,512,513,515,516);
  $type[4] = array(501,502,505,508,511,512,513,515,516);
  $type[5] = array(501,502,504,505,507,508,510,511,512,513,514,515,516,517);
  $cnt1=0;  $cnt2=0;
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
	 if ($n_type==5 || $n_type==7 || $n_type==9) {if ($ctype==4 or $c_type=6) {$znum= " номер счетчика ".$res[2];$zn=$res[2];} }
	 else {$znum=""; $zn="";}
	} 
	if ($n_type == 7) {
		$result = mysql_query("select uid,circle1, circle2, circle3, circle4 FROM heat_type_of_circles WHERE uid=".$uid."");
		if ($res=mysql_fetch_array($result,MYSQL_BOTH)) {
			$type_circle = $res[$disp_circle];
		}
	}
//==========================================================================================================================
 if($n_type == 7) { 
 for ($i=0;$i<count($type_izm);$i++)
 {
 	if ($disp_circle == 1) {
 		for ($j=1;$j<=5;$j++) {
 			if (($type_circle == $j) and (in_array($type_izm[$i], $type[$j]))) {
 				$nrg[$cnt1]=$type_izm[$i];
 				$cnt1++;
 			}
 		}
 	} else if($disp_circle == 2) {
 		for ($j=1;$j<=5;$j++) {
 			if (($type_circle == $j) and (in_array(($type_izm[$i]-17), $type[$j]))) {
 				$nrg[$cnt1]=$type_izm[$i];
 				$cnt1++;
 			}
 		}
 	}
 }
}
if ($n_type == 9) {
	for ($i=0;$i<count($type_izm);$i++)
 	{
		switch($disp_circle) {
			case 1:
				if (($type_izm[$i] >= 501) and ($type_izm[$i] <= 525)) {
					$nrg[$cnt1] = $type_izm[$i];
					$cnt1++;
				}
				break;
			case 2:
				if (($type_izm[$i] >= 526) and ($type_izm[$i] <= 550)) {
					$nrg[$cnt1] = $type_izm[$i];
					$cnt1++;
				}
				break;
			case 3:
				if (($type_izm[$i] >= 551) and ($type_izm[$i] <= 575)) {
					$nrg[$cnt1] = $type_izm[$i];
					$cnt1++;
				}
				break;
			case 4:
				if (($type_izm[$i] >= 576) and ($type_izm[$i] <= 600)) {
					$nrg[$cnt1] = $type_izm[$i];
					$cnt1++;
				}
				break;
		}
 	}
}

  if ($pw_en==2)
  {
  		if ($n_type == 7) {
		for ($i=0;$i<count($nrg);$i++)
			{
				if ($disp_circle == 1) {
					$result=mysql_query("select nrj_symb,nrj_unit  FROM izm_type WHERE izm_type=". $nrg[$i]." ");
					$row=mysql_fetch_array($result,MYSQL_BOTH);
					$str = $row[1];
					$colname[$i]=$row[0]." ".$str;
				} else if ($disp_circle == 2) {
					$result=mysql_query("select nrj_symb,nrj_unit  FROM izm_type WHERE izm_type=". ($nrg[$i]-17)." ");
					$row=mysql_fetch_array($result,MYSQL_BOTH);
					$str = $row[1];
					$colname[$i]=$row[0]." ".$str;
				}
			}
		}
	if ($n_type == 9) {
		for ($i=0;$i<count($nrg);$i++)
		{
			if ($disp_circle == 1) {
				$result=mysql_query("select symbol,ed_izm  FROM izm_type_tem WHERE izm_type=".$nrg[$i]." ");
				$row=mysql_fetch_array($result,MYSQL_BOTH);
				$str = $row[1];
				$colname[$i]=$row[0]." ".$str;
			} else if ($disp_circle == 2) {
				$result=mysql_query("select symbol,ed_izm  FROM izm_type_tem WHERE izm_type=".($nrg[$i]-25)." ");
				$row=mysql_fetch_array($result,MYSQL_BOTH);
				$str = $row[1];
				$colname[$i]=$row[0]." ".$str;
			} else if ($disp_circle == 3) {
				$result=mysql_query("select symbol,ed_izm  FROM izm_type_tem WHERE izm_type=".($nrg[$i]-50)." ");
				$row=mysql_fetch_array($result,MYSQL_BOTH);
				$str = $row[1];
				$colname[$i]=$row[0]." ".$str;
			} else if ($disp_circle == 4) {
				$result=mysql_query("select symbol,ed_izm  FROM izm_type_tem WHERE izm_type=".($nrg[$i]-75)." ");
				$row=mysql_fetch_array($result,MYSQL_BOTH);
				$str = $row[1];
				$colname[$i]=$row[0]." ".$str;
			}
		}
	}
  }
  if ($pw_en==3)
  {
  	if ($n_type == 7) {
		for ($i=0;$i<count($nrg);$i++)
		{
			if ($disp_circle == 1) {
				$result=mysql_query("select nrj_symb,nrj_unit  FROM izm_type WHERE izm_type=". $nrg[$i]." ");
				$row=mysql_fetch_array($result,MYSQL_BOTH);
				$str = $row[1];
				$colname[$i]=$row[0]." ".$str;
			} else if ($disp_circle == 2) {
				$result=mysql_query("select nrj_symb,nrj_unit  FROM izm_type WHERE izm_type=". ($nrg[$i]-17)." ");
				$row=mysql_fetch_array($result,MYSQL_BOTH);
				$str = $row[1];
				$colname[$i]=$row[0]." ".$str;
			}
		}
	}

	if ($n_type == 9) {
		for ($i=0;$i<count($nrg);$i++)
		{
			if ($disp_circle == 1) {
				$result=mysql_query("select symbol,ed_izm  FROM izm_type_tem WHERE izm_type=".$nrg[$i]." ");
				$row=mysql_fetch_array($result,MYSQL_BOTH);
				$str = $row[1];
				$colname[$i]=$row[0]." ".$str;
			} else if ($disp_circle == 2) {
				$result=mysql_query("select symbol,ed_izm  FROM izm_type_tem WHERE izm_type=".($nrg[$i]-25)." ");
				$row=mysql_fetch_array($result,MYSQL_BOTH);
				$str = $row[1];
				$colname[$i]=$row[0]." ".$str;
			} else if ($disp_circle == 3) {
				$result=mysql_query("select symbol,ed_izm  FROM izm_type_tem WHERE izm_type=".($nrg[$i]-50)." ");
				$row=mysql_fetch_array($result,MYSQL_BOTH);
				$str = $row[1];
				$colname[$i]=$row[0]." ".$str;
			} else if ($disp_circle == 4) {
				$result=mysql_query("select symbol,ed_izm  FROM izm_type_tem WHERE izm_type=".($nrg[$i]-75)." ");
				$row=mysql_fetch_array($result,MYSQL_BOTH);
				$str = $row[1];
				$colname[$i]=$row[0]." ".$str;
			}
		}
	}
  }
	$count=incrementProgressBar();
if (count($nrg)>0)
{
if ($pw_en<3) $col=count($nrg)*2+1;
if ($pw_en==3) $col=count($nrg)*4+1;
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
   	  if (count($nrg)==0) { echo "<td class='x23' style=''>Сбор данный с выбранными параметрами не производится</td>\n";}else{
	 echo "			<td class='x23' style='width:80px;border-bottom:none'>&nbsp;</td>\n";
	 if ($pw_en==1)
	  {
	   if ($maxp==1) echo "	<td  colspan='".(count($pwr)*2)."' class='x23' style='border-left:none' align='center'>Мощность в периоды контроля</td>\n";
	   else echo "<td  colspan='".(count($pwr)*2)."' class='x23' style='border-left:none' align='center'>Мощность</td>\n";
	  }
	 if ($pw_en==2) echo "	<td  colspan='".(count($nrg)*2)."' class='x23' style='border-left:none' align='center'>Объем за сутки</td>\n";
	 if ($pw_en==3 and count($nrg)<>0) echo "	<td  colspan='".(count($nrg)*2)."' class='x23' style='border-left:none' align='center'>Показание (на 24:00)</td>\n";
	 echo "		</tr>\n";
	 echo "		<tr>\n";
	
	 echo "	<td class='x23' style='border-top:none;text-align:center'>Дата&nbsp;</td>\n";
		 for ($i=0;$i<count($colname);$i++)
		 {
		  echo "		<td class='x23' style='border-top:none;border-left:none' width='75'>".$colname[$i]."</td>\n";
		  echo "		<td class='x23' style='border-top:none;border-left:none' width='5'>&nbsp;</td>\n";
		 }
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
  global $summ_arr;
  global $flag_summ;
  $flag_summ = array();
  $pwr_str='';$nrg_str='';

	$izm = array();	$flag = array();  $date_ = array();  $n_day=array(); $izm2 = array();
	$count=incrementProgressBar();
	 $j=0; $i=0;
	 if (count($nrg)==0)
	 {	  $m1=0;$m2=0;	 }
	 else
	 {	  $m1=min($nrg)-1;$m2=max($nrg)+1;	 }
	  if ($pw_en==2)
	  {
	    for ($i=0;$i<count($nrg);$i++)
		  {
		   $nrg_str.=$nrg[$i].',';
		  }
		$nrg_str=substr($nrg_str,0,strrpos($nrg_str, ","));
		$result=mysql_query("select znach,flag,data,izm_type FROM ".$table." WHERE ".$table.".data BETWEEN '".$date_1."' AND '".$date_2."'  AND ".$table.".n_obj=".$n_obj." AND link_adr=".$adr." AND ".$table.".izm_type IN(".$nrg_str.") AND inter_val=48 GROUP BY data,izm_type");
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
	  if ($pw_en==3)
	  {
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
	  }
		if ($pw_en==2) {
			if ($result) {
				if (mysql_num_rows($result)>0) {
					while ($res=mysql_fetch_array($result,MYSQL_NUM)) {
						list ($ac_year,$ac_month,$ac_day) = explode ("-",$res[2]);
						$izm_type=$res[3];
						$j=$izm_type-1;
						$i=$ac_day-1;
						$result2 = mysql_query("select znach,flag,data,izm_type FROM ".$table." WHERE ".$table.".data = DATE_ADD('".$res[2]."',INTERVAL -1 day)  AND ".$table.".n_obj=".$n_obj." AND link_adr=".$adr." AND ".$table.".izm_type=".$izm_type." AND inter_val=48 GROUP BY data,izm_type");
						$res2=mysql_fetch_array($result2,MYSQL_NUM);
							if (max($res[1],$res2[1]) != "") {
								$flag[$i][$j] = max($res[1],$res2[1]);
								$flag_summ[$j] = max($res[1],$res2[1]);
							} else {
								$flag[$i][$j] = max($res[1],$res2[1]);
								$izm[$i][$j] = $res[0] - $res2[0];
								$summ_arr[$j] = $summ_arr[$j] + $izm[$i][$j];
							}
							$date_[$i] =  $res[2];
							if (!isset($izm[$i][$j])) $izm[$i][$j]=0;
							if (!isset($flag[$i][$j])) $flag[$i][$j]="^\n";
						
					}
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
	PrintData($pw_en,$n_day,$date_,$izm,$flag);
}



function PrintData($pw_en,$n_day,$date_,$izm,$flag)
{
  global $type_izm;global $pwr;global $nrg;global $colname;global $num_day;global $name; global $uid; global $n_obj;global $adr;global $pid; global $lid; global $node;global $edizm;
  for ($i=0;$i<count($date_);$i++)
  {
  $num_day++;
  $n=$n_day[$i];

  list ($ac_year,$ac_month,$ac_day) = explode ("-",$date_[$n]);  
	$date_output=$ac_day.".".$ac_month.".".$ac_year;
 echo "<tr>\n";
 echo "<td class='x22' align='center' style='font-weight:700;text-align:center;border-top:none;' id='".$date_output."'>".$date_output."</td>\n";
	if ($pw_en==2)
	for ($j=(min($nrg)-1);$j<max($nrg);$j++)
	 {
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
  global $summ_arr;
  global $flag_summ;
	$izm = array();	$flag = array();
	$pow = array(); $datetime = array();
	$count=incrementProgressBar();
	 for ($i=0;$i<count($colname);$i++)
	 {
		$izm_type=$nrg[$i];
		if ($pw_en==2)
		{
			$izm[$i]=$summ_arr[$izm_type - 1];$flag[$i]=$flag_summ[$izm_type - 1]."\n";
			if (!isset($flag[$i])) $flag[$i]="^\n"; 
		}
		if ($pw_en==3)
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
		if (count($nrg) == 0) {} else {
		echo "<td class='x15'>&nbsp;</td>\n";
		if ($pw_en==2) echo "<td class='x23'  colspan=".(count($colname)*2)."  align='center'>&nbsp;</td>\n";
		if ($pw_en==3 and count($nrg)<>0) echo "<td class='x23'  colspan=".(count($colname)*2)."  align='center'>??????????</td>\n";
		echo "</tr>\n";
	  }
  	$count=incrementProgressBar();
	if ($pw_en==1)
	{
		echo "<tr>\n";
		echo "	<td class='x28' align='center' style='border-right:none;border-bottom:none;'>Сумма</td>\n";
		 for ($i=0;$i<count($colname);$i++)
		 {
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
			 if ($i>0)  
				echo "	<td class='x22' style='border-top:none;border-left:none;'>&nbsp;".$datetime[$i]."</td>\n";
			 else    
				 echo "	<td class='x22' style='border-top:none;'>&nbsp;".$datetime[$i]."</td>\n";
		   echo "	<td class='x22' style='border-top:none;border-left:none;' align='right'>&nbsp;</td>\n";
	 }	 
	 echo "</tr>\n";	
	}
	if ($pw_en==2 and count($nrg)<>0)
	{
		echo "<tr>\n";
		echo "	<td rowspan='1' class='x28' align='center' style='vertical-align:middle;border-right:none;'>Сумма</td>\n";
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
		echo "	<td rowspan='1' class='x28' align='center' style='vertical-align:middle;border-right:none;'>Сумма</td>\n";
		 for ($i=0;$i<count($colname);$i++)
		 {
		    if ($i>0) echo "	<td class='x22' style='border-top:none;border-left:none;'>&nbsp;".format($izm[$i]/$edizm)."</td>\n";
			else echo "	<td class='x22' style='border-top:none;'>&nbsp;".format($izm[$i]/$edizm)."</td>\n";
		   echo "	<td class='x22' style='border-top:none;border-left:none' align='right'>&nbsp;".$flag[$i]."</td>\n";
		 }	 
		}
	 echo "</tr>\n";	
	} 
	$count=incrementProgressBar();
 }
 
function PrintZoneData($pw_en,$date_1,$date_2,$uid,$n_obj,$adr,$table)

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

	$result4=mysql_query("select * from seasons_hint order by n_season");
	if ($node==-2)
	{
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

<script language="VBScript" src="js/excel_export.vbs">
<!-- 
// --> 
</script>
</body>
</html>
