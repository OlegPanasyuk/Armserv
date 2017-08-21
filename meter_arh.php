<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>Архивы счетчика</title>
	<meta http-equiv=Content-Type content="text/html; charset=windows-1251">
	<link rel="STYLESHEET" type="text/css" href="css/TABLE2.css">
<object ID="s7ax" classid="CLSID:175F6EEF-B2F6-455B-9978-26E2EA2569F5"	width=80 height=30 codebase="cab/s7ax.cab">
	<param name="a" value="1">
</object>
<BASE target="frSheet">
	<style media="print">
	.help
	{display:none;font-size:10px;}
	</style>
	<style media="screen">
	.help
	{display:inline;font-size:10px;}
	</style><style>
INPUT {text-align:right;}
FIELDSET
{width: 100; border: 0 solid Black;}
LEGEND
{font-weight: bolder;font-size: 14px;color:blue;}
LABEL
{font-size: 12px;font-weight: bolder;width: 100%;}
TD
{font-size: 12px;font-weight: bolder;}
span.fazaA{
	width: 10px;
	height: 10px;
	background-color: Red;
}
span.fazaB{
	width: 10px;
	height: 10px;
	background-color: Lime;
}
</style>
	<link rel="stylesheet" href="css/j.css"></link>
<?php
echo "<SCRIPT language=\"JavaScript1.2\">var tab=".$_GET["tab"]."</SCRIPT>";
echo "<SCRIPT language=\"JavaScript1.2\" src=\"js/progressbar.js\"></SCRIPT>";
require_once("include/js.php");
require_once("include/vbs.php");
echo "<script language=\"JavaScript1.2\" src=\"js/ocx_fun.js\"></script>";
echo "<script language=\"JavaScript1.2\" src=\"js/control_am.js\"></script>";
?>	
<script language="JavaScript" src="js/tabs.js">
<!--
//-->
</script>
</head>
<body background=tree/imgs/fon.gif onload="startIncrement();">
<div id="padding" style="height:60px;"></div>
<div id="content" style="height:80%;">
<iframe id="fhead" src="head_maker.php" scrolling="no" width="1" height="1" frameborder="0" align="middle"></iframe>
<?
include("include/mysql.php"); //  Соединяемся с БД
include("util_fun.php");
 $uid = $_GET['id'];
 $pid = $_GET['pid'];
 $level=$_GET['lid'];
 $name=$_GET['iname'];
  $todo = $_GET['todo'];
  $icon = $_GET['icon'];
  $node= $_GET['node'];
  $n_obj= $_GET['nobj'];
  $adr= $_GET['adr'];
  $arh= $_GET['arh'];

if (isset($arh)) echo '<script>window.document.topmenu.arh'.$arh.'.click();</script>';
if (!isset($arh)) $arh=0;

echo "
<script language=\"JavaScript1.2\">
	var node=window.parent.toc.ntype.value;
    if (node<1) {
	 legenda.innerHTML='<span style=\"color:black;font-size:10px;\">вывод данных по объекту:</span> '+window.parent.toc.item_name.value;
	 formatData.style.display='inline';
	}
	else {
			legenda.innerHTML=window.parent.toc.item_name.value+' <span style=\"color:black;font-size:10px;\">(выберите счетчик)</span>';
			formatData.style.display='none';
			content.innerHTML='';
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
<?
{
//==========================================================================================================================
echo "<table cellspacing='1' cellpadding='1' border='0' width='520' align='center' id='TB2' style='display:none'>";
echo "<th colspan='3' width='520'>";
	echo "<div style='text-align:center;font-size:14px;font-weight:bolder;' id='header'></div>";

echo "</tr>";

if ($arh==1) $arh_name="Архив фаз";
if ($arh==2) $arh_name="Архив состояний";
if ($arh==3) $arh_name="Архив корректировок";


echo "<tr >
	<th colspan='3' align='center' nowrap id='header2'>".$arh_name."</th>
</tr>
	<tr>
	<td class='x23' width='50'>&nbsp;№</td>
	<td class='x23' width='150'>время события </td>
	<td class='x23' width='250'>Событие</td>
	<td class='x23' width='60' id='faza' style='display:none'>Фазы</td>
	</tr>";

$count=32;
echo "</table>";
}
?>
</td></tr></table>
</td></tr></table>
</td></tr></table>
</div>
<script language="VBScript" src="js/excel_export.vbs">
<!-- 
// --> 
</script>
</body>
</html>
