<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>Ручной запрос данных</title>
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
    <OBJECT ID="fwzpx" WIDTH=100 HEIGHT=51
			CLASSID="CLSID:FB965298-CE1D-4004-8561-6C9567891988" codabase="cab/fwzp.cab">
			<PARAM NAME="_Version" VALUE="65536">
			<PARAM NAME="_ExtentX" VALUE="2646">
			<PARAM NAME="_ExtentY" VALUE="1323">
			<PARAM NAME="_StockProps" VALUE="0">
	</OBJECT>
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
{width: 100; border: thin solid Black;}
LEGEND
{font-weight: bolder;font-size: 14px;color:blue;}
LABEL
{font-size: 12px;font-weight: bolder;}
SELECT
{font-size: 12px;font-weight: bolder;width:50; }
TD
{font-size: 12px;font-weight: bolder;}
</style>
<?
include("include/js.php");
echo "<SCRIPT language=\"JavaScript1.2\">var tab=".$_GET["tab"]."</SCRIPT>";
echo "<script language=\"JavaScript1.2\" src=\"js/control_mq.js\"></script>";
echo "<script language=\"JavaScript1.2\" src=\"js/mquery.js\"></script>";
?>

<script language="JavaScript" src="js/tabs.js">
<!--
//-->
</script>

</head>

<body topmargin=0 marginheight=0 marginwidth=0 scroll="auto" onload="" background=tree/imgs/fon.gif>
<div id="padding" style="height:60px;"></div>
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
$n_obj = $_GET["nobj"];
$adr = $_GET["adr"];


if (!isset($disp)) $disp=1;


//================================================================================================================================
echo "
<script language=\"JavaScript1.2\">
	if (window.parent.toc.ntype)
	{
	 node=window.parent.toc.ntype.value;
     if (node==0) {
	  legenda.innerHTML='<span style=\"color:black;font-size:10px;\">ручной запрос по объекту:</span> '+window.parent.toc.item_name.value;
	  formatData.style.display='inline';
	 }
	 else {
			legenda.innerHTML=window.parent.toc.item_name.value+' <span style=\"color:black;font-size:10px;\">(выберите счетчик)</span>';
			formatData.style.display='none';
			<!--content.innerHTML='';-->
		}
	}	
</script>";

$TIME_START = getmicrotime(); 
if  ($node==0) 
{
echo "<script>\n";
//echo "window.document.forms[0].disp1.value='$disp';\n";
//echo "window.document.forms[0].dc.value='$dc';\n";
echo "window.document.forms[0].iname.value='$name';\n";
echo "window.document.forms[0].id.value='$uid';\n";
echo "window.document.forms[0].pid.value='$pid';\n";
echo "window.document.forms[0].lid.value='$lid';\n";
echo "window.document.forms[0].node.value='$node';\n";
echo "formatData.style.display='inline';\n";
echo "</script>\n";
}
?>


<table width="100%" cellpadding="0" cellspacing="0" height="100%">
<tr><td height="100%">
 <table width="100%" cellpadding="0" cellspacing="0" height="100%">
 <tr><td valign="top" bgcolor="EEEEEE">
	<img src="tree/imgs/spacer.gif" height="1" width="1">
	</td>
	<td width="100%" valign="top" background="tree/imgs/fon.gif">
	 <table border="1" bordercolor="A5D7D6" width="100%" cellpadding="5" id="MN">
	 <tr><td  id="container">

<iframe width=174 height=190 name="gToday:normal:agenda.js:gfPop:plugins1.js" id="gToday:normal:agenda.js:gfPop:plugins1.js" src="multipicker/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; left:-500px; top:0px;"></iframe>
<iframe width=188 height=166 name="gToday:normal:agenda.js:gfPop1:plugins_time1.js" id="gToday:normal:agenda.js:gfPop1:plugins_time1.js" src="datetime/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"></iframe>
<table border="0">
<tr>
<td valign=top align="center">
<form name="submitForm">
<input type="Button" value="Отправить" style="display:none" onclick="sendQUERY()" name="sender">
<input type="reset" style="display:none" name="dropval" value="Сброс" onclick="tClearAll();gfPop.fClearAll();gfPop.fRepaint();return false;">
<select name="dataList" size="30" style="width:120px;z-index:-10">
<option value="-">-----------------</option>
</select>
<input type="hidden" name="allSelected">
<input type="hidden" name="disp">
<input type="hidden" name="nobj">
<input type="hidden" name="adr">
</form>
</td>
<td nowrap  valign=top width="50">
<!--
<iframe width=174 height=189 name="gToday:normal:agenda.js:gfFlat:plugins1.js" id="gToday:normal:agenda.js:gfFlat:plugins1.js" src="multipicker/iflateng.htm" scrolling="no" frameborder="0"></iframe>
<br><input type="reset" value="<--Сброс" onclick="tClearAll();gfFlat.fClearAll();gfFlat.fRepaint();return false;">
-->
</td>
<td style="width:100%;">
<div id="results"  style="border: 1px solid #A5D7D6;width:100%; height:400px;"> </div>
<iframe width=100% height=400 name="scanner" id="scanner" src="about:blank" scrolling="auto" frameborder="1" style="display:none;" ></iframe>
</td>
</tr>
</table>
	 
<script language="JavaScript">
document.forms[1].dataList.options[0]=null; // remove the "-------" line. this is a trick to expand the listbox width in NN4.
</script>
<?php
function incrementProgressBar()
{
 global $count;
 $count++;
// echo "<script language=\"JavaScript\">incrementProgressBar();</script>\n";
 return $count;
}
$TIME_END = getmicrotime();
$TIME_SCRIPT = $TIME_END - $TIME_START; 
?>
</td></tr></table>
</td></tr></table>
</td></tr></table>
</div>

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
