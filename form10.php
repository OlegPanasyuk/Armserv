<html>
<head>
	<title>����� ��������� �������</title>
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
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
<?
echo "<SCRIPT language=\"JavaScript1.2\">var tab=".$_GET["tab"]."</SCRIPT>";
echo "<SCRIPT language=\"JavaScript1.2\" src=\"js/progressbar.js\"></SCRIPT>";
echo "<script language=\"JavaScript1.2\" src=\"js/control_f11.js\"></script>";
require_once("include/vbs.php");
?>
<script language="JavaScript" src="js/tabs.js">
<!--
//-->
</script>

</head>

<body id="f10" topmargin=0 marginheight=0 marginwidth=0 scroll="auto" onload="startIncrement();" background=tree/imgs/fon.gif>
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
$maxp = $_GET["maxp"];
$n_obj = $_GET["nobj"];
$adr = $_GET["adr"];
$edizm = $_GET["edizm"];
$disp_circle = $_GET["disp_circle"];


if (!isset($edizm)) $edizm = 1;
if (!isset($date_1)) $date_1=$dc;
if (!isset($pw_en)) $pw_en=$disp;

 $type_izm = array();
 $pwr = array();
 $nrg = array();
 $colname = array();
 $summ = array();
 $count=0;$zn="";$ktr=1;
//================================================================================================================================
echo "
<script language=\"JavaScript1.2\">
	if (window.parent.toc.ntype)
	{
	 node=window.parent.toc.ntype.value;
     if (node==4 || node==5 || node ==6) {
	  legenda.innerHTML='<span style=\"color:black;font-size:10px;\">����� ������ �� �������:</span> ';
	  formatData.style.display='inline';
	 }
	 else {
			legenda.innerHTML=' <span style=\"color:black;font-size:10px;\">(�������� ������)</span>';
			formatData.style.display='none';
			content.innerHTML='';
		}
	}
</script>";

$TIME_START = getmicrotime();
if (isset($date_1) and isset($uid) and isset($n_obj) and isset($adr) and isset($pw_en))
{
include("include/mysql.php");
list ($ac_day,$ac_month,$ac_year) = explode (".",$date_1);
$date_header1=$ac_day.'.'.$ac_month.'.'.$ac_year;
$date_1=$ac_year.'-'.$ac_month.'-'.$ac_day;
$type_izm=array();

echo "<script>\n";
echo "window.document.forms[0].disp.value='$disp';\n";
echo "window.document.forms[0].dc.value='$dc';\n";
echo "window.document.forms[0].iname.value='$name';\n";
echo "window.document.forms[0].id.value='$uid';\n";
echo "window.document.forms[0].pid.value='$pid';\n";
echo "window.document.forms[0].lid.value='$lid';\n";
echo "window.document.forms[0].node.value='$node';\n";
echo "window.document.forms[0].disp_circle.value='$disp_circle';\n";

echo "formatData.style.display='inline';\n";
echo "</script>\n";
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
function incrementProgressBar()
{
 global $count;
 $count++;
// echo "<script language=\"JavaScript\">incrementProgressBar();</script>\n";
 return $count;
}

PrintHeader($pw_en,$uid,$n_obj,$adr,$date_header1);
$count=incrementProgressBar();
$count=incrementProgressBar();
PrintData($pw_en,$date_1,$uid,$n_obj,$adr,$table);
$count=incrementProgressBar();
$count=incrementProgressBar();
if ($pw_en<3) PrintSumData($pw_en,$date_1,$uid,$n_obj,$adr,$table);
$count=incrementProgressBar();
$count=incrementProgressBar();
//if ($pw_en<3) PrintZoneData($pw_en,$date_1,$uid,$n_obj,$adr,$table);
mysql_close();
}
//============================================================================================

function PrintHeader($pw_en,$uid,$n_obj,$adr,$date_1)
{
  global $type_izm;
  global $pwr;
  global $nrg;
  global $colname;
  global $zn;
  global $ktr;
  global $edizm;
  global $node;
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
	 $izm_str=$res[0];
	 $type_izm = explode (",",$izm_str); $ktr=$res[4];$ctype=$res[3];
	 $name=$res[1];
	 if (($n_type==7) or ($n_type==9)) {if ($ctype==4 or $c_type=6) {$znum= "����� �������� ".$res[2];$zn=$res[2];} }
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
	if ($pw_en==3) $col=count($nrg)*2+1;
}
// else
// {
// if ($pw_en<3) $col=9;
// if ($pw_en==3) $col=9;
// }

echo "<table cellpadding='0' cellspacing='0' align='center' border='0' id='TB2'>\n";
//echo " 	<tr> <td colspan='".$col."' align='center'>".$obj_name." </td>   </tr>\n";
echo " 	<tr> <td colspan='".$col."' align='center'>".$obj_name."</td>   </tr>\n";
echo " 	<tr> <td colspan='".$col."' align='center'>".$pname." ".$name."</td>   </tr>\n";
if ($znum!="") {echo " 	<tr> <td colspan='".$col."' align='center'>".$znum."</td> </tr>\n";}
else echo "";
echo " 	<tr> <td colspan='".$col."' align='center'>������ �� ���� ". $date_1."</td> </tr>\n";
   	 echo "   		<tr>\n";
   	  if (count($nrg)==0) {echo "			<td class='x23' style=''>���� ������ � ���������� ����������� �� ������������</td>\n";} else {
	 echo "			<td class='x23' style='border-bottom:none'>&nbsp;</td>\n";
//	 echo "			<td rowspan='2' height="34" class='x23' style='border-left:none;width:10px;'>ВЗ</td>\n";
	
	 if ($pw_en==2) echo "			<td  colspan='".(count($nrg)*2)."' class='x23' style='border-left:none' align='center'>���������</td>\n";
	 if (($pw_en==3) and (count($nrg)<>0)) echo "<td  colspan='".(count($nrg)*2)."' class='x23' style='border-left:none' align='center'>���������</td>\n";
	 echo "		</tr>\n";
	$count=incrementProgressBar();
	 echo "		<tr>\n";
	 	echo "			<td class='x23' style='border-top:none'>�����</td>\n";
 		 for ($i=0;$i<count($colname);$i++)
		 {
		  echo "		<td class='x23' style='border-top:none;border-left:none' width='75'>".$colname[$i]."</td>\n";
		  echo "		<td class='x23' style='border-top:none;border-left:none' width='5'>&nbsp;</td>\n";
		 }
		}
	 echo "	</tr>\n";
}
function PrintData($pw_en,$date_1,$uid,$n_obj,$adr,$table)
{
  global $type_izm;
  global $pwr;
  global $nrg;
  global $colname;
  global $ktr;
  global $node;
  global $edizm;
  global $summ;
  global $disp_circle;
  global $summflag;
  $summflag = array();
  $izm = array(); $flag = array(); $start_pokaz = array(); $color = array();

   if ($pw_en==3)
	{
	   $result2=mysql_query("select inter_val FROM ".$table." WHERE ".$table.".data='".$date_1."' AND izm_type=".$nrg[0]." AND n_obj=".$n_obj." AND link_adr=".$adr." ");
	}
    $bgcolor="\n";
	if ($pw_en==2)
	{
	   $result2=mysql_query("select inter_val FROM ".$table." WHERE ".$table.".data='".$date_1."' AND izm_type=".$nrg[0]." AND n_obj=".$n_obj." AND link_adr=".$adr." ");
	}
 if (($result2) and (mysql_num_rows($result2)>0))
  {
	$count=incrementProgressBar();
	for ($i=0;$i<count($colname);$i++)
		{
			$summ[$i] = 0;
		}

	while ($res2=mysql_fetch_array($result2,MYSQL_NUM))
	{
	 $j=$res2[0];
	 $int_val=$j;
	 if ($j%5==0) $count=incrementProgressBar(); // change progress bar
     if ($int_val % 2 == 0)
	 { // if interval is correctly
		for ($i=0;$i<count($colname);$i++)
		{
			$i_type=$nrg[$i];
			if ($pw_en==3) {
				$result=mysql_query("select ".$table.".znach,".$table.".flag,".$table.".inter_val,beg_int,end_int ,intervals.n_zone,intervals.max_zone  FROM ".$table." ,intervals WHERE ".$table.".data='".$date_1."' AND izm_type=".$i_type." AND n_obj=".$n_obj." AND link_adr=".$adr."  AND ".$table.".inter_val=".$int_val." And ".$table.".inter_val = intervals.inter_val Order By ".$table.".inter_val, ".$table.".izm_type");
				$int_val2 = $int_val - 1;
				$result5=mysql_query("select inter_val,beg_int,end_int FROM intervals WHERE inter_val=".$int_val2.""); // for begin znach of interval
				$result7 = mysql_query("select znach, flag, data, inter_val FROM  ".$table." WHERE data=DATE_ADD('".$date_1."',interval -1 DAY) AND inter_val=48 AND n_obj=".$n_obj." AND link_adr=".$adr." AND izm_type=".$i_type." Order By ".$table.".inter_val, ".$table.".izm_type");
			} else {
				$result=mysql_query("select ".$table.".znach,".$table.".flag,".$table.".inter_val,beg_int,end_int ,intervals.n_zone,intervals.max_zone,intervals.heat_zone  FROM ".$table." ,intervals WHERE ".$table.".data='".$date_1."' AND izm_type=".$i_type." AND n_obj=".$n_obj." AND link_adr=".$adr."  AND ".$table.".inter_val=".$int_val." And ".$table.".inter_val = intervals.inter_val Order By ".$table.".inter_val, ".$table.".izm_type");
				$int_val2 = $int_val - 1;
				$result5=mysql_query("select inter_val,beg_int,end_int FROM intervals WHERE inter_val=".$int_val2.""); // for begin znach of interval
				$int_val2 -= 1;
				$result6=mysql_query("select ".$table.".znach,".$table.".flag,".$table.".inter_val,beg_int,end_int ,intervals.n_zone,intervals.max_zone,intervals.heat_zone  FROM ".$table." ,intervals WHERE ".$table.".data='".$date_1."' AND izm_type=".$i_type." AND n_obj=".$n_obj." AND link_adr=".$adr."  AND ".$table.".inter_val=".$int_val2." And ".$table.".inter_val = intervals.inter_val Order By ".$table.".inter_val, ".$table.".izm_type");
				$result7 = mysql_query("select znach, flag, data, inter_val FROM  ".$table." WHERE data=DATE_ADD('".$date_1."',interval -1 DAY) AND inter_val=48 AND n_obj=".$n_obj." AND link_adr=".$adr." AND izm_type=".$i_type." Order By ".$table.".inter_val, ".$table.".izm_type");
				$res6=mysql_fetch_array($result6,MYSQL_BOTH);
			}
		if ($res=mysql_fetch_array($result,MYSQL_BOTH) and $res5=mysql_fetch_array($result5,MYSQL_BOTH) and $res7=mysql_fetch_array($result7,MYSQL_BOTH))// 
		{

		 if (!isset($ktr) or ($ktr<=0)) $ktr=1;
		 if ($pw_en==3) {$izm[$i][$j]=$res[0]; $flag[$i][$j] = $res[1];}
		 else {
			if ($j==2) {
				if (($res[1]!="") or ($res7[1]!="")) {
					$flag[$i][$j] = max($res[1],$res7[1]); 
					$izm[$i][$j] = 0;
				} else {
					$izm[$i][$j]=$res[0]-$res7[0];	
				}
				$summ[$i] =$summ[$i] + $izm[$i][$j];
			} else {
				if (($res[1]!="") or ($res6[1]!="")) {
					$flag[$i][$j] = max($res[1],$res6[1]); 
					$izm[$i][$j] = 0;
				} else {
					$izm[$i][$j]=$res[0]-$res6[0];	
				}
				$summ[$i] =$summ[$i] + $izm[$i][$j];
			}
		 }
		  $int_val=$res[2];
	     $begin = $res5[1]; 	$end = $res[4];
		  if ($node==-1) $zona[$i]=$res[7];
		  else if ($node==-2)
		  {
		    if ($pw_en==1) 
			{
			   if ($i_type==2) $zona[$i]=$res[5]; 
			   else $zona[$i]=$res[6]; 
			}
			if($pw_en==2)
			{
			   if ($i_type==2) $zona[$i]=$res[5]; 
			   else $zona[$i]=$res[5]; 
			}
		  }
		  else
		  {
		   if ($pw_en==1) $zona[$i]=$res[6]; else   $zona[$i]=$res[5];
		  }
		}
		else {
			$izm[$i][$j] = 0;
			$flag[$i][$j]= '^';
			$color[$i][$j] = 'grey';
		}
		$result8 = mysql_query("select MAX(flag) FROM ".$table." WHERE izm_type=".$i_type." AND n_obj=".$n_obj." AND link_adr=".$adr." AND ".$table.".data='".$date_1."' AND inter_val IN (2,4,6,8,10,12,14,16,18,20,22,24,26,28,30,32,34,36,38,40,42,44,46,48)  GROUP BY data,izm_type");
		if ($result8) { 
			$res8 = mysql_fetch_array($result8,MYSQL_BOTH);
			$summflag[$i] = $res8[0];
		}
	}

	  //if ($pw_en==3) $bgcolor="#FFFFFF";
	 echo "<tr>\n";
	 if ($node == 1) {echo "	<td  class='x26' align='center'  style='border-top:none;	padding-right: 1px;' >".$begin.'-'.$end."</td>\n";} else {echo "	<td  class='x26' align='center'  style='border-top:none;	padding-right: 1px;' >".$begin.'-'.$end."</td>\n";}
	 //echo "	<td class='x22' align='center' style='border-top:none;border-left:none;border-right:none;'>".$zona."</td>\n";
	for ($i=0;$i<count($colname);$i++)
	{
	  $bgcolor=$color[$i][$j];
	 if ($pw_en==1)
	 {
	  if ($i>0)  echo "	<td bgcolor='".$bgcolor."' class='x22' style='border-top:none;border-left:none;'>&nbsp;".format($izm[$i][$j]*2/$edizm)."</td>\n";
	  else       echo "	<td bgcolor='".$bgcolor."' class='x22' style='border-top:none;' >&nbsp;".format($izm[$i][$j]*2/$edizm)."</td>\n";
	  echo "	<td bgcolor='".$bgcolor."' class='x22' style='border-top:none;border-left:none;' align='right'>&nbsp;".$flag[$i][$j]."</td>\n";
	 }
	 if ($pw_en==2)
	 {
	    if ($i>0) echo "<td bgcolor='".$bgcolor."' class='x22' style='border-top:none;border-left:none;'>&nbsp;".format($izm[$i][$j]/$edizm)."</td>\n";
		else echo "	<td bgcolor='".$bgcolor."' class='x22' style='border-top:none;'>&nbsp;".format($izm[$i][$j]/$edizm)."</td>\n";
	    echo "	<td bgcolor='".$bgcolor."' class='x22' style='border-top:none;border-left:none' align='right;'>&nbsp;".$flag[$i][$j]."</td>\n";
 	 }
	 if ($pw_en==3) 
	 {
	   if ($node == 1){} else {

	   if ($i>0) echo "<td class='x22' style='border-top:none;border-left:none;'>&nbsp;".format($izm[$i][$j]/$edizm)."</td>\n";
		else echo "	<td class='x22' style='border-top:none;'>&nbsp;".format($izm[$i][$j]/$edizm)."</td>\n";
	    echo "	<td class='x22' style='border-top:none;border-left:none' align='right;'>&nbsp;".$flag[$i][$j]."</td>\n";
 	 }
	 }
   }
   echo "</tr>\n";	
}	 } }
   if ($result) mysql_free_result($result);
   if ($result2) mysql_free_result($result2);
  }	

function PrintSumData($pw_en,$date_1,$uid,$n_obj,$adr,$table)
{
  global $type_izm;
  global $pwr;
  global $nrg;
  global $maxp;
  global $colname;
  global $node;
  global $edizm;
  global $summ;
  global $summflag;
  $izm = array(); $time = array();	$flag = array();
  $count=incrementProgressBar();

 $colspan=count($nrg)*2;
	echo " <tr>	<td height='7' class='x15' colspan='".($colspan+1)."'></td></tr>\n";
	echo " <tr>\n";
	echo "<td height='17' class='x15' >&nbsp;</td>\n";
	if (count($nrg) == 0) {} else {
		if ($pw_en==2) echo "<td class='x23'  colspan=".$colspan."  align='center'>��������� ���������� ��������� ���������</td>\n";
	echo "</tr>\n";
 	$count=incrementProgressBar();
	$count=incrementProgressBar();
	 for ($i=0;$i<count($nrg);$i++)
  	{
	  $i_type=$nrg[$i];
	  $int_val=$j+1;
       if ($pw_en==2)
	   {
			if ($pw_en<>1) $izm[$i]=$summ[$i];
	   }
	    $count=incrementProgressBar();
	  }
		  if ($pw_en==2)
		   {
			echo "<tr>\n";
			echo "	<td height='20' class='x28' align='center' style='border-right:none;'>�� ����</td>\n";
			for ($i=0;$i<count($nrg);$i++)
			{
		    if ($i>0) echo "	<td class='x22' style='border-top:none;border-left:none;'>&nbsp;".format($izm[$i]/$edizm)."</td>\n";
			else echo "	<td class='x22' style='border-top:none;'>&nbsp;".format($izm[$i]/$edizm)."</td>\n";
		    echo "	<td class='x22' style='border-top:none;border-left:none' align='right;'>&nbsp;".$summflag[$i]."</td>\n";
			}
			 echo "</tr>\n";
		   }
	}
	if ($result) mysql_free_result($result);	if ($result2) mysql_free_result($result2);
	$count=incrementProgressBar();
 }

function PrintZoneData($pw_en,$date_1,$uid,$n_obj,$adr,$table)
{
  global $type_izm;
  global $pwr;
  global $nrg;
  global $node;
  global $edizm;
 $izm = array(); $time = array();	 $flag = array();
//================================================================================================
  	$result4=mysql_query("select * from seasons_hint order by n_season");
	if ($result4)
	{
		 while ($res4=mysql_fetch_array($result4,MYSQL_NUM))
			{
			 list ($ac_year,$ac_month,$ac_day) = explode ("-",$date_1);
			$begin_date[$res4[0]-1]=mktime (0,0,0, $res4[2], $res4[1], $ac_year);
			$end_date[$res4[0]-1]=mktime (0,0,0, $res4[4], $res4[3], $ac_year);
		   }
   		
	 $curdate=str2date($date_1);
	 if ($curdate>=$begin_date[1] and $curdate<=$end_date[1])
	{
	$isHeatSeason="Лето";$seas=2;} 
	else {
	$isHeatSeason="Зима";$seas=1;}
	}
//================================================================================================
 if ($pw_en==1) //считаем мощность
 {
  if ($node==-1)//если обогрев
   $result3=mysql_query("select n_zone,color,descript,timezone_h FROM zones where n_zone in (select distinct heat_zone from intervals) order by n_zone");
  else if ($node==-2)//если генератор
  {
    if ($seas==1) $result3=mysql_query("select n_zone,color,descript,timezone_w,timezone_p FROM zones where n_zone in (select distinct max_zone from intervals) order by n_zone");
	else if ($seas==2) $result3=mysql_query("select n_zone,color,descript,timezone_s FROM zones where n_zone in (select distinct max_zone from intervals) order by n_zone");
  } 
  else
   $result3=mysql_query("select n_zone,color,descript,timezone_p FROM zones where n_zone in (select distinct max_zone from intervals) order by n_zone");
 }
 else //считаем энергию
  {
  if ($node==-1)//если обогрев
   $result3=mysql_query("select n_zone,color,descript,timezone_h FROM zones where n_zone in (select distinct heat_zone from intervals) order by n_zone");
  else if ($node==-2)//если генератор
  {
    if ($seas==1) $result3=mysql_query("select n_zone,color,descript,timezone_w FROM zones where n_zone in (select distinct winter_zone from intervals) order by n_zone");
	else if ($seas==2) $result3=mysql_query("select n_zone,color,descript,timezone_s FROM zones where n_zone in (select distinct summer_zone from intervals) order by n_zone");
	}
   else $result3=mysql_query("select n_zone,color,descript,timezone_e FROM zones where n_zone in (select distinct n_zone from intervals) order by n_zone");
  }
 while ($res3=mysql_fetch_array($result3,MYSQL_BOTH))
	{
		$n_zone=$res3[0];$bgcolor=$res3[1]; 
		$tariff_name=$res3[2];
		if ($node==-2)
		{
			$tariff_time="<font style='font-size:8px'>".$res3[3]."</font>";
		} else
		{
			$tariff_time="<font style='font-size:8px'>".$res3[3]."</font>";
		}
		 $count=incrementProgressBar();
 for ($i=0;$i<count($nrg);$i++)
 {
	$i_type=$nrg[$i];
	if ($node==-1 and $n_zone!=2)//обогрев
	{
		$result=mysql_query(" SELECT s.mx,i.beg_int,i.end_int,s.inter_val,i.heat_zone FROM (SELECT MAX(znach) as mx, inter_val FROM ".$table."  WHERE  ".$table.".data='".$date_1."' AND ".$table.".n_obj=".$n_obj." AND link_adr=".$adr." AND ".$table.".izm_type=".$i_type."  GROUP BY inter_val ORDER BY mx DESC) s, intervals i  WHERE s.inter_val = i.inter_val AND i.heat_zone=".$n_zone."");
	}
	 else if ($node==-2)//генерирущий
	 {
		if ($seas==1)//сезон зима
			{
			 if ($i_type==2)
			 { 
			  $result=mysql_query(" SELECT s.mx,i.beg_int,i.end_int,s.inter_val,i.winter_zone,s.flag FROM (SELECT MAX(znach) as mx, inter_val,flag FROM ".$table." WHERE  ".$table.".data='".$date_1."' AND ".$table.".n_obj=".$n_obj." AND link_adr=".$adr." AND ".$table.".izm_type=".$i_type." GROUP BY inter_val ORDER BY mx DESC) s, intervals i WHERE s.inter_val = i.inter_val AND i.winter_zone=".$n_zone."");
			 } 
			 else $result=mysql_query(" SELECT s.mx,i.beg_int,i.end_int,s.inter_val,i.max_zone,s.flag FROM (SELECT    MAX(znach) as mx, inter_val,flag FROM ".$table." WHERE  ".$table.".data='".$date_1."' AND ".$table.".n_obj=".$n_obj." AND link_adr=".$adr." AND ".$table.".izm_type=".$i_type." GROUP BY inter_val ORDER BY mx DESC) s, intervals i WHERE s.inter_val = i.inter_val AND i.max_zone=".$n_zone."");
			}
		else if ($seas==2)//сезон лето
			{
			 if ($i_type==2) $result=mysql_query(" SELECT s.mx,i.beg_int,i.end_int,s.inter_val,i.summer_zone,s.flag FROM (SELECT  MAX(znach) as mx, inter_val,flag FROM ".$table." WHERE  ".$table.".data='".$date_1."' AND ".$table.".n_obj=".$n_obj." AND link_adr=".$adr." AND ".$table.".izm_type=".$i_type." GROUP BY inter_val ORDER BY mx DESC) s, intervals i WHERE s.inter_val = i.inter_val AND i.summer_zone=".$n_zone."");
			 else $result=mysql_query(" SELECT s.mx,i.beg_int,i.end_int,s.inter_val,i.max_zone,s.flag FROM (SELECT    MAX(znach) as mx, inter_val,flag FROM ".$table." WHERE  ".$table.".data='".$date_1."' AND ".$table.".n_obj=".$n_obj." AND link_adr=".$adr." AND ".$table.".izm_type=".$i_type." GROUP BY inter_val ORDER BY mx DESC) s, intervals i WHERE s.inter_val = i.inter_val AND i.max_zone=".$n_zone."");
			}	
	 }
	 else//обычный учет
	 {
		$result=mysql_query(" SELECT s.mx,i.beg_int,i.end_int,s.inter_val,i.max_zone,s.flag FROM (SELECT    MAX(znach) as mx, inter_val,flag FROM ".$table." WHERE  ".$table.".data='".$date_1."' AND ".$table.".n_obj=".$n_obj." AND link_adr=".$adr." AND ".$table.".izm_type=".$i_type." GROUP BY inter_val ORDER BY mx DESC) s, intervals i WHERE s.inter_val = i.inter_val AND i.max_zone=".$n_zone."");
	 }	
	if ($res=mysql_fetch_array($result,MYSQL_NUM))
	 {
	    $izm[$i]=$res[0];$flag[$i]=$res[5]; if ($izm[$i]>0) $time[$i]=$res[1].'-'.$res[2]; else $time[$i]=" \n"; 
	 }
	 else {$time[$i]=" \n";$izm[$i]=0;$flag[$i]='^';}
//=====================================================================================================================	
	if ($pw_en==2)
	 {
	  if ($node==-1 and $n_zone!=2)//обогрев
	   {
	   	$result2=mysql_query("select SUM(znach),MAX(flag) FROM ".$table.",intervals WHERE ".$table.".data='".$date_1."'  AND n_obj=".$n_obj." AND link_adr=".$adr."  AND izm_type=".$i_type." AND intervals.n_zone<>2 AND ".$table.".inter_val=intervals.inter_val group by izm_type order by izm_type");
	   }
	  else if ($node==-2)//генерирущий
		{	  
	   		if ($seas==1) 
			{
			 if ($i_type==2) $result2=mysql_query("select SUM(znach),MAX(flag) FROM ".$table.",intervals WHERE ".$table.".data='".$date_1."'  AND n_obj=".$n_obj." AND link_adr=".$adr."  AND izm_type=".$i_type." AND intervals.winter_zone=".$n_zone." AND ".$table.".inter_val=intervals.inter_val");
			 else  $result2=mysql_query("select SUM(znach),MAX(flag) FROM ".$table.",intervals WHERE ".$table.".data='".$date_1."'  AND n_obj=".$n_obj." AND link_adr=".$adr."  AND izm_type=".$i_type." AND intervals.n_zone=".$n_zone." AND ".$table.".inter_val=intervals.inter_val");
			} 
	   		else if ($seas==2) 
			{
			 if ($i_type==2) $result2=mysql_query("select SUM(znach),MAX(flag) FROM ".$table.",intervals WHERE ".$table.".data='".$date_1."'  AND n_obj=".$n_obj." AND link_adr=".$adr."  AND izm_type=".$i_type." AND intervals.summer_zone=".$n_zone." AND ".$table.".inter_val=intervals.inter_val group by izm_type order by izm_type");
			 else  $result2=mysql_query("select SUM(znach),MAX(flag) FROM ".$table.",intervals WHERE ".$table.".data='".$date_1."'  AND n_obj=".$n_obj." AND link_adr=".$adr."  AND izm_type=".$i_type." AND intervals.n_zone=".$n_zone." AND ".$table.".inter_val=intervals.inter_val");
			} 
		}	
 	  else 
	  {
	   $result2=mysql_query("select SUM(znach),MAX(flag) FROM ".$table.",intervals WHERE ".$table.".data='".$date_1."'  AND n_obj=".$n_obj." AND link_adr=".$adr."  AND izm_type=".$i_type." AND intervals.n_zone=".$n_zone." AND ".$table.".inter_val=intervals.inter_val");
	  } 
    if ($res2=mysql_fetch_array($result2,MYSQL_NUM)) 
	 {
		$izm[$i]=$res2[0];$flag[$i]=$res2[1];
	 }
	else {$time[$i]=" \n";$izm[$i]=0;$flag[$i]='^';}
	 }
  }
 echo "<tr>	<td height='7' class='x15' colspan='".(count($nrg)*2+1)."'></td></tr>\n";		

 //========================отрисовка зон==================================================
	 if ($pw_en==1)
	 {
      echo "<tr bgcolor=".$bgcolor.">\n";
		echo "<td height='15' rowspan='1' class='x23' style='border-bottom:none;border-right:none;width:150px;'>тариф ".$tariff_name."</td>\n";
  		//вывод мощности 
		for ($i=0;$i<count($nrg);$i++)
		{
				 if ($i>0)  echo "	<td class='x22' style='border-left:none;border-bottom:none;'>&nbsp;".format($izm[$i]*2/$edizm)."</td>\n";
				 else       echo "	<td class='x22' style='border-bottom:none;'>&nbsp;".format($izm[$i]*2/$edizm)."</td>\n";
			 	 echo "	<td class='x22' style='border-left:none;border-bottom:none;' align='right'>&nbsp;".$flag[$i]."</td>\n";
	  }	 
	 echo "</tr>\n";	

      echo "<tr bgcolor=".$bgcolor.">\n";
  	echo "<td height='15' rowspan='1' class='x23' style='border-right:none;width:150px;'>&nbsp;".$tariff_time."</td>\n";
  		//вывод мощности 
		for ($i=0;$i<count($nrg);$i++)
		{
		   	if ($i!=1)	
			{
			   $result4=mysql_query("select n_zone,color,descript,timezone_p FROM zones where n_zone=".$n_zone." ");
			   if ($res4=mysql_fetch_array($result4,MYSQL_NUM)) 
			    $t_t="<font style='font-size:8px'>".$res4[3]."</font>";
			 if ($i>0)   echo "	<td class='x22' style='border-left:none;border-top:none;'>&nbsp;".$time[$i]."<br>&nbsp;</td>\n";
			 else    	 echo "	<td class='x22' style='border-top:none;'>&nbsp;".$time[$i]."<br>&nbsp;</td>\n";
		 	 echo "	<td class='x22' style='border-left:none;border-top:none;' align='right'>&nbsp;</td>\n";
			} 
			else
			{
			 if ($i>0)   echo "	<td class='x22' style='border-left:none;border-top:none;'>&nbsp;".$time[$i]."<br>&nbsp;</td>\n";
			 else    	 echo "	<td class='x22' style='border-top:none;'>&nbsp;".$time[$i]."<br>&nbsp;</td>\n";
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
		for ($i=0;$i<count($nrg);$i++)
		{
		    if ($i>0) echo "	<td class='x22' style='border-left:none;border-bottom:none;'>&nbsp;".format($izm[$i]/$edizm)."</td>\n";
				else echo "	<td class='x22' style='border-bottom:none;'>&nbsp;".format($izm[$i]/$edizm)."</td>\n";
		    echo "	<td class='x22' style='border-left:none;border-bottom:none;' align='right;'>&nbsp;".$flag[$i]."</td>\n";
		}	
	 echo "</tr>\n";	
     echo "<tr bgcolor=".$bgcolor.">\n";
		echo "<td height='17' class='x23' style='border-right:none;border-top:none;width:150px;'>".$tariff_time."</td>\n";
	  //вывод энергии 
		for ($i=0;$i<count($nrg);$i++)
		{
	   		if ($i!=1)	
			{
			   $result4=mysql_query("select n_zone,color,descript,timezone_e FROM zones where n_zone=".$n_zone." ");
			   if ($res4=mysql_fetch_array($result4,MYSQL_NUM)) 
			    $t_t="<font style='font-size:8px'>".$res4[3]."</font>";
			    if ($i>0) echo "	<td class='x22' style='border-left:none;border-top:none;'>&nbsp;</td>\n";
				else echo "	<td class='x22' style='border-top:none;'>&nbsp;</td>\n";
			    echo "	<td class='x22' style='border-left:none;border-top:none;' align='right;'>&nbsp;</td>\n";
			}  
			else
			{
		    if ($i>0) echo "	<td class='x22' style='border-left:none;border-top:none;'>&nbsp;</td>\n";
				else echo "	<td class='x22' style='border-top:none;'></td>\n";
		    echo "	<td class='x22' style='border-left:none;border-top:none;' align='right;'>&nbsp;</td>\n";
		   }	
		}	
	 echo "</tr>\n";	
	  }
  }	 
}
//============================================================================================
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
if (!isset($date_1)) $date_1=date('Y-m-d');
list($ac_year,$ac_month,$ac_day)=explode("-",$date_1);
echo "<div id='activator' ONCLICK=ToXls_1('TB',1,'".$pw_en."','".$count."',0,'".$ac_year."-".$ac_month."-".$ac_day."','".$zn."',0)></div>\n"; 
?>

<script language="VBScript" src="js/excel_export.vbs">
<!-- 
// --> 
</script>
</body>
</html>