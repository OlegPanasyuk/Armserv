<html>
<head>
	<title>Ћбслуживание.</title>
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
echo "<script language=\"JavaScript1.2\" src=\"js/control_f7.js\"></script>";
require_once("include/vbs.php");
?>
<script language="JavaScript" src="js/tabs.js">
<!--
//-->
</script>
</head>

<body id="f1" topmargin=0 marginheight=0 marginwidth=0 scroll="auto" onload="startIncrement();" background=tree/imgs/fon.gif>
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
$maxp = $_GET["maxp"];
$n_obj = $_GET["nobj"];
$adr = $_GET["adr"];
$edizm = $_GET["edizm"];
if (!isset($date_1)) $date_1=$dc;
if (!isset($pw_en)) $pw_en=$disp;

 $type_izm = array();
 $pwr = array();
 $nrg = array();
 $colname = array();
 $count=0;$zn="";$ktr=1;
//================================================================================================================================


$TIME_START = getmicrotime(); 
echo "<script>\n";
echo "window.document.forms[0].dc1.value='$dc1';\n";
echo "window.document.forms[0].dc2.value='$dc2';\n";
echo "window.document.forms[0].iname.value='$name';\n";
echo "window.document.forms[0].id.value='$id';\n";
echo "window.document.forms[0].pid.value='$pid';\n";
echo "window.document.forms[0].lid.value='$lid';\n";
echo "window.document.forms[0].node.value='$node';\n";
//echo "window.document.forms[0].type.value='$type';\n";
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
include("include/mysql.php"); //  ‘оединЯемсЯ с Ѓ„
    
	if(isset($dc1,$dc2)){
	PrintData($dc1,$dc2);
	$count=incrementProgressBar();
	$count=incrementProgressBar();
}

mysql_close();


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

//============================================================================================
function PrintData ($dc1,$dc2)
{
	
	$result = mysql_query ("select n_obj, link_adr, c_type, descript, uid, znum, k_tr FROM counters WHERE c_type<1 AND znum<>'00000000'");
	//echo "$dc1,$dc2";
	list ($ac_day1,$ac_month1,$ac_year1) = explode (".",$dc1);
	list ($ac_day2,$ac_month2,$ac_year2) = explode (".",$dc2);
	if (!checkdate ($ac_month1,$ac_day1,$ac_year1)) $dc1=date('Y-m-d'); else $dc1=$ac_year1.'-'.$ac_month1.'-'.$ac_day1;
	if (!checkdate ($ac_month2,$ac_day2,$ac_year2)) $dc2=date('Y-m-d'); else $dc2=$ac_year2.'-'.$ac_month2.'-'.$ac_day2;
	//echo "$dc1,$dc2";
	$result0=mysql_query("select DATE_ADD( DATE_FORMAT('".$dc1."','%Y-%m-%d'), INTERVAL 0 DAY), 
						 DATE_ADD( DATE_FORMAT('".$dc2."','%Y-%m-%d'), INTERVAL -1 DAY), 
						 DATE_ADD( DATE_FORMAT('".$dc1."','%Y-%m-%d'), INTERVAL -1 DAY) ,DATE_ADD( DATE_FORMAT('".$dc1."','%Y-%m-%d'), INTERVAL -1 DAY)");
     if ($res0=mysql_fetch_array($result0,MYSQL_NUM))
	 {
	 	$day2 = $res0[0]; 	 
		if ($date_1==$date_2) 
		{		$day1 = $res0[1];  $day0 = $res0[3];}
		else 
		{	$day1 = $res0[2]; $day0 = $dc1; }
	 }	
	//echo "$day1,$day0";
	if ($result)
			echo "<table border='0' cellpadding='0' cellspacing='0' align='center' id='TB2' width='100%'>\n";
			echo "<tr ><td colspan='10' align='center' class='x23'> расчет расхода по всем счетчикам</td></tr>\n";
			echo "<tr ><td align='center' class='x23' style='border-top:none;'> счетчик</td>";
			echo "<td align='center' class='x23' style='border-top:none;border-left:none;'> номер счетчика</td>";
			echo "<td align='center' class='x23' style='border-top:none;border-left:none;'> тип энергии</td>";
			echo "<td align='center' class='x23' style='border-top:none;border-left:none;'> нач. показаниЯ</td>";
			echo "<td align='center' class='x23' style='border-top:none;border-left:none;'> кон показаниЯ</td>";
			echo "<td align='center' class='x23' style='border-top:none;border-left:none;'> разность</td>";
			echo "<td align='center' class='x23' style='border-top:none;border-left:none;'> коэфф транс</td>";
			echo "<td align='center' class='x23' style='border-top:none;border-left:none;'> расход</td>";
			echo "<td align='center' class='x23' style='border-top:none;border-left:none;width:10%'> энегриЯ из за месЯц по днЯм</td>";
			echo "<td align='center' class='x23' style='border-top:none;border-left:none;'> контроль</td>";
			echo "</tr>\n";
			
		{while ($res = mysql_fetch_array($result,MYSQL_BOTH))
		{
			//echo "<b>$res[3]</b> - объект: $res[0] - свЯзной: $res[1] тип счетчика: $res[2] номер: $res[5] <br />";
			$fiderName=$res[3];
			$izm_type = array(5,6,7,8);
			$result5=mysql_query("select znach,flag from val where n_obj=".$res[0]." and link_adr=".$res[1]." and izm_type='5' and inter_val=48 and data='".$day0."' ");
			$row5=mysql_fetch_array($result5);
			$result6=mysql_query("select znach,flag from val where n_obj=".$res[0]." and link_adr=".$res[1]." and izm_type='6' and inter_val=48 and data='".$day0."' ");
			$row6=mysql_fetch_array($result6);
			$result7=mysql_query("select znach,flag from val where n_obj=".$res[0]." and link_adr=".$res[1]." and izm_type='7' and inter_val=48 and data='".$day0."' ");
			$row7=mysql_fetch_array($result7);
			$result8=mysql_query("select znach,flag from val where n_obj=".$res[0]." and link_adr=".$res[1]." and izm_type='8' and inter_val=48 and data='".$day0."' ");
			$row8=mysql_fetch_array($result8);
			$result9=mysql_query("select znach,flag from val where n_obj=".$res[0]." and link_adr=".$res[1]." and izm_type='5' and inter_val=48 and data='".$day1."' ");
			$row9=mysql_fetch_array($result9);
			$result10=mysql_query("select znach,flag from val where n_obj=".$res[0]." and link_adr=".$res[1]." and izm_type='6' and inter_val=48 and data='".$day1."' ");
			$row10=mysql_fetch_array($result10);
			$result11=mysql_query("select znach,flag from val where n_obj=".$res[0]." and link_adr=".$res[1]." and izm_type='7' and inter_val=48 and data='".$day1."' ");
			$row11=mysql_fetch_array($result11);
			$result12=mysql_query("select znach,flag from val where n_obj=".$res[0]." and link_adr=".$res[1]." and izm_type='8' and inter_val=48 and data='".$day1."' ");
			$row12=mysql_fetch_array($result12);
			
			//=================================
			$sum = array();
			for ($i=1; $i<5;$i++)
			{
				$nrgia=mysql_query("select SUM(znach),MAX(flag),data,izm_type FROM val WHERE data BETWEEN '".$day2."' AND '".$day1."'  AND n_obj=".$res[0]." AND link_adr=".$res[1]." AND izm_type=".$i." GROUP BY data,izm_type");
				while($nrgi= mysql_fetch_array($nrgia,MYSQL_BOTH))
				{
				//echo "$nrgi[0] - $nrgi[2] - $nrgi[3]<br/>";
				//echo "$day0,$day1,$day2<br/>";
				$sum[$i]=$sum[$i]+$nrgi[0];
				}
			}
			
			$bgcolor = '';
			//=================================
			echo "<tr>";
			echo "<TD rowspan='4' class='x22' valign='top' style='font-weight:600;text-align:center;border-top:none;vertical-align:middle;'>".$fiderName."</TD>";
			echo "<td rowspan='4' class='x22' style='border-top:none;border-left:none;text-align:center;vertical-align:middle;'>".$res[5]."</td>";
			echo "<td class='x22'  style='border-top:none;border-left:none;'>активнаЯ прием</td>";
			echo "<td class='x22'  style='border-top:none;border-left:none;'>&nbsp;".format($row5[0])."</td>";
			echo "<td class='x22'  style='border-top:none;border-left:none;'>&nbsp;".format($row9[0])."</td>";
			echo "<td class='x22'  style='border-top:none;border-left:none;'>&nbsp;".format($row9[0]-$row5[0])."</td>";
			echo "<td class='x22' rowspan='4' style='border-top:none;border-left:none;text-align:center;vertical-align:middle;'>&nbsp;".$res[6]."</td>";
			echo "<td class='x22'  style='border-top:none;border-left:none;'>&nbsp;".format(($row9[0]-$row5[0])*$res[6])."</td>";
			echo "<td class='x22'  style='border-top:none;border-left:none;'>&nbsp;".format($sum[1])."</td>";
			if (abs(($row9[0]-$row5[0])*$res[6]-$sum[1])>1 )
			{
				if ((($row9[0]-$row5[0])*$res[6]-$sum[1])>0 ) {$bgcolor = 'red';} else {$bgcolor = 'yellow';}
			}
			echo "<td class='x22'  style='border-top:none;border-left:none;' bgcolor ='".$bgcolor."'>&nbsp;".format(($row9[0]-$row5[0])*$res[6]-$sum[1])."</td>";
			echo "</tr>\n";
			echo "<tr>";
			echo "<td class='x22'  style='border-top:none;border-left:none;'>активнаЯ отдача</td>";
			echo "<td class='x22'  style='border-top:none;border-left:none;'>&nbsp;".format($row6[0])."</td>";
			echo "<td class='x22'  style='border-top:none;border-left:none;'>&nbsp;".format($row10[0])."</td>";
			echo "<td class='x22'  style='border-top:none;border-left:none;'>&nbsp;".format($row10[0]-$row6[0])."</td>";
			
			echo "<td class='x22'  style='border-top:none;border-left:none;'>&nbsp;".format(($row10[0]-$row6[0])*$res[6])."</td>";
			echo "<td class='x22'  style='border-top:none;border-left:none;'>&nbsp;".format($sum[2])."</td>";
			if (abs(($row10[0]-$row6[0])*$res[6]-$sum[2])>1 )
			{
				if ((($row10[0]-$row6[0])*$res[6]-$sum[2])>0 ) {$bgcolor = 'red';} else {$bgcolor = 'yellow';}
			}
			echo "<td class='x22'  style='border-top:none;border-left:none;'>&nbsp;".format(($row10[0]-$row6[0])*$res[6]-$sum[2])."</td>";
			$bgcolor = '';
			echo "</tr>\n";
			echo "<tr>";
			echo "<td class='x22'  style='border-top:none;border-left:none;'>реактивнаЯ прием</td>";
			echo "<td class='x22'  style='border-top:none;border-left:none;'>&nbsp;".format($row7[0])."</td>";
			echo "<td class='x22'  style='border-top:none;border-left:none;'>&nbsp;".format($row11[0])."</td>";
			echo "<td class='x22'  style='border-top:none;border-left:none;'>&nbsp;".format($row11[0]-$row7[0])."</td>";
			
			echo "<td class='x22'  style='border-top:none;border-left:none;'>&nbsp;".format(($row11[0]-$row7[0])*$res[6])."</td>";
			echo "<td class='x22'  style='border-top:none;border-left:none;'>&nbsp;".format($sum[3])."</td>";
			if (abs(($row11[0]-$row7[0])*$res[6]-$sum[3])>1 )
			{
				if ((($row11[0]-$row7[0])*$res[6]-$sum[3])>0 ) {$bgcolor = 'red';} else {$bgcolor = 'yellow';}
			}
			echo "<td class='x22'  style='border-top:none;border-left:none;'>&nbsp;".format(($row11[0]-$row7[0])*$res[6]-$sum[3])."</td>";
			$bgcolor = '';
			echo "</tr>\n";
			echo "<tr>";
			echo "<td class='x22'  style='border-top:none;border-left:none;'>реактивнаЯ отдача</td>";
			echo "<td class='x22'  style='border-top:none;border-left:none;'>&nbsp;".format($row8[0])."</td>";
			echo "<td class='x22'  style='border-top:none;border-left:none;'>&nbsp;".format($row12[0])."</td>";
			echo "<td class='x22'  style='border-top:none;border-left:none;'>&nbsp;".format($row12[0]-$row8[0])."</td>";
			
			echo "<td class='x22'  style='border-top:none;border-left:none;'>&nbsp;".format(($row12[0]-$row8[0])*$res[6])."</td>";
			echo "<td class='x22'  style='border-top:none;border-left:none;'>&nbsp;".format($sum[4])."</td>";
			if (abs(($row12[0]-$row8[0])*$res[6]-$sum[4])>1 )
			{
				if ((($row12[0]-$row8[0])*$res[6]-$sum[4])>0 ) {$bgcolor = 'red';} else {$bgcolor = 'yellow';}
			}
			echo "<td class='x22'  style='border-top:none;border-left:none;'>&nbsp;".format(($row12[0]-$row8[0])*$res[6]-$sum[4])."</td>";
			$bgcolor = '';
			echo "</tr>\n";
			
		}
		echo " </table>\n";
	}
}


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
echo "<div id='activator' ONCLICK=ToXls('TB',1,'".$pw_en."','".$count."',0,'".$ac_year."-".$ac_month."-".$ac_day."','".$zn."',0)></div>\n"; 
?>
<center>
<div style="color:white;" class="help"><b>.::</b>

‚ремЯ выполнения запроса <?=number_format($TIME_SCRIPT,3,".","");
//phpinfo();
?> сек.
<b>::.</b>
</div>
</center>
<script language="VBScript" src="js/excel_export.vbs">
<!-- 
// --> 
</script>

</body>
</html>
