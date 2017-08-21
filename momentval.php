<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html xmlns:v="urn:schemas-microsoft-com:vml" xmlns="http://www.w3.org/TR/REC-html40">
<head>
<meta http-equiv=Content-Type content="text/html; charset=windows-1251">
	<title>Мгновенные значения и конфигурация счетчика</title>
<object ID="s7ax" classid="CLSID:175F6EEF-B2F6-455B-9978-26E2EA2569F5"	width=80 height=30  codebase="cab/s7ax.cab">
	<param name="a" value="1">
</object>
		
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
 INPUT {text-align:right;}
 FIELDSET
 {width: 100; border: 0 solid Black; }
 LEGEND
 {font-weight: bolder;font-size: 14px;color:darkred;}
 LABEL
 {font-size: 12px;font-weight: bolder;width: 100%;}
 TD
 {font-size: 12px;font-weight: bolder; }
.xinp
			{
				padding-top:0px;
				padding-bottom:0px;
				padding-right:1px;
				padding-left:1px;
				font-weight:400;
				font-style:normal;
				text-decoration:none;
				text-align:right;
				vertical-align:middle;
				border:1px solid #6699cc;
				background-color:white;
				font-size: 12px; 
				color: #004137; 
				font-family: tahoma,arial,helvetica,geneva,sans-serif;
				height:22px;
}
v\:* {behavior:url(#default#VML);}
.shape {behavior:url(#default#VML);}
  div
	{
	margin:0cm;
	font-size:12.0;
	font-weight:700;
	font-family:"Times New Roman";
	}

	.aw-quirks * {
		box-sizing: border-box;
		-moz-box-sizing: border-box;
		-webkit-box-sizing: border-box;
	}

	body {font: 12px Tahoma}
@page Section1
	{size:595.3pt 841.9pt;
	margin:2.0cm 2.0cm 2.0cm 3.0cm;
	}
</style>

<!-- include links to the script and stylesheet files -->
	<script src="js/aw.js" type="text/javascript"></script>
	<link href="css/aw.css" rel="stylesheet">

<!-- add image libraries -->
	<link href="css/mini.css" rel="stylesheet"></link>
	<link rel="stylesheet" href="css/j.css"></link>

<!-- change default styles, set control size and position -->
<style type="text/css">

	#myTabs {width: 100%}

</style>

<title> </title>
<script language="JavaScript" src="js/tabs.js">
<!--
//-->
</script>
<script src="1/jquery.js" type="text/javascript"></script>
<script src="1/jquery.tabslideout.js" type="text/javascript"></script>
<script type="text/javascript">

</script>

<iframe id="fhead" src="head_maker.php" scrolling="no" width="1" height="1" frameborder="0" align="middle"></iframe>
<?php
echo "<SCRIPT language=\"JavaScript1.2\" src=\"js/progressbar.js\"></SCRIPT>";
require_once("include/js.php");
require_once("include/vbs.php");
echo "<script language=\"JavaScript1.2\" src=\"js/ocx_fun.js\"></script>";
echo "<script language=\"JavaScript1.2\" src=\"js/control_mv.js\"></script>";
?>	
</head>
<body background=tree/imgs/fon.gif onload="startIncrement();"  onClick="getID(event.srcElement)">
<div id="padding" style="height:60px;"></div>
<div id="content" style="height:80%;">
<?
include("include/mysql.php"); //  Соединяемся с БД
include("util_fun.php");
?>

<?
 $uid = $_GET['id'];
 $pid = $_GET['pid'];
 $level=$_GET['lid'];
 $name=$_GET['iname'];
  $todo = $_GET['todo'];
  $icon = $_GET['icon'];
  $node= $_GET['node'];
  $n_obj= $_GET['nobj'];
  $adr= $_GET['adr'];
  $count=0;$zn="";
  $currdate=date('Y-m-d H:i:s');
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
			legenda.innerHTML=window.parent.toc.item_name.value+' <span style=\"color:black;font-size:10px;\">(выберите счетчик)</span>';
			formatData.style.display='none';
			content.innerHTML='';
		}
	}
</script>";
?>
<!-- insert control tags -->
	<span id="myTabs"></span>
	<div id="myContent" style="border: 1px solid #aaa; height: 200px; padding: 10px">
		<div id="div1" style="display:none">
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
	echo "<div style='text-align:center;font-size:14px;font-weight:bolder;' id='header'></div>";
$TIME_START = getmicrotime(); 
	ShowMomentVal($n_obj,$adr);
//==========================================================================================================================
?>
<?
function ShowMomentVal($n_obj,$adr)
{
echo "<table id='mval' style='display:inline'>
		<tr>
		<td style='padding-left:10px;'>
	<FIELDSET ID='fld1'>
	<LEGEND ALIGN='left'>Константы</LEGEND>
	<table style='text-align:center;background-color:#c1cdcd;width:280px;' cellpadding=1 cellspacing=1>
	<tr>
		<td width='90'>Тип прибора</td>
		<td width='90'>Зав. номер</td>
		<td  width='150' colspan='2'>Дата выпуска</td>
	</tr>
	<tr>
		<td class='xinp' id='meter_type'>&nbsp;</td>
		<td class='xinp' id='znum'>&nbsp;</td>
		<td class='xinp' colspan='2' id='date_issue'>&nbsp;</td>
	</tr>
	<tr>
		<td>Сет. адрес</td>
		<td>&nbsp;</td>
		<td>Версия ПО</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td class='xinp' id='meter_adr'>&nbsp;</td>
		<td>&nbsp;</td>
		<td class='xinp' id='vers_program'>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>Ke</td>
		<td>KU</td>
		<td>KI</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td class='xinp' id='Ke'>&nbsp;</td>
		<td class='xinp' id='KU'>&nbsp;</td>
		<td class='xinp' id='KI'>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	</table>
	</FIELDSET><span style='width:30px;'> </span>";
	echo "<FIELDSET ID='fld2'>
	<LEGEND ALIGN='left'>Время</LEGEND>
	<table style='text-align:center;background-color:#c1cdcd;width:150px;' cellpadding=1 cellspacing=1'>
	<tr>
		<td width='150'>Системное(УСПД)</td>
	</tr>
	<tr>
		<td width='150' class='xinp' id='on_date_time'>&nbsp;</td>
	</tr>
	<tr>
		<td>Электросчетчика</td>
	</tr>
	<tr>
		<td class='xinp' id='meter_time'>&nbsp;</td>
	</tr>
	</table>
	</FIELDSET>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	echo "<FIELDSET ID='fld3'>
	<LEGEND ALIGN='left'>Конфигурация</LEGEND>
	<table style='text-align:center;background-color:#c1cdcd;width:200px;' cellpadding=1 cellspacing=1'>
	<tr>
		<td>Квадрант</td>
		<td>Тариф</td>
	</tr>
	<tr>
		<td class='xinp' id='meter_quadrant'>&nbsp;</td>
		<td class='xinp' id='meter_tarif'>&nbsp;</td>
	</tr>
	<tr>
		<td>Сезон</td>
		<td>Батарея</td>
	</tr>
	<tr>
		<td class='xinp' id='meter_season'>&nbsp;</td>
		<td class='xinp' id='meter_resource'>&nbsp;</td>
	</tr>
	</table>
	</FIELDSET><br>";
	echo "<FIELDSET ID='fld4'>
	<LEGEND ALIGN='left'>Мгновенные значения</LEGEND>
	<table style='text-align:center;background-color:#c1cdcd;;width:550px;' border=0>
	<tr>
		<td width='20'>Pa:</td><td class='xinp' width='80' id='Pa'>&nbsp;</td><td width='40' align='left'>&nbsp;</td>
		<td width='20'>Pb:</td><td class='xinp' width='80' id='Pb'>&nbsp;</td><td width='40' align='left'>&nbsp;</td>
		<td width='20'>Pc:</td><td class='xinp' width='80' id='Pc'>&nbsp;</td><td width='40' align='left'>&nbsp;</td>
		<td width='20'>Psum:</td><td class='xinp' width='80' id='P'>&nbsp;</td><td width='30' align='left' style='font-style: italic;' id='label_P'>Вт</td>
	</tr>
	<tr>
		<td>Qa:</td><td class='xinp' id='Qa'>&nbsp;</td><td align='left'>&nbsp;</td>
		<td>Qb:</td><td class='xinp' id='Qb'>&nbsp;</td><td align='left'>&nbsp;</td>
		<td>Qc:</td><td class='xinp' id='Qc'>&nbsp;</td><td align='left'>&nbsp;</td>
		<td width='20'>Qsum:</td><td class='xinp' id='Q'>&nbsp;</td><td align='left' style='font-style: italic;' id='label_Q'>вар</td>
	</tr>
	<tr>
		<td>Ua:</td><td class='xinp' id='Ua'>&nbsp;</td><td align='left' style='font-style: italic;' id='label_Ua'>В</td>
		<td>Ub:</td><td class='xinp' id='Ub'>&nbsp;</td><td align='left' style='font-style: italic;' id='label_Ub'>В</td>
		<td>Uc:</td><td class='xinp' id='Uc'>&nbsp;</td><td align='left' style='font-style: italic;' id='label_Uc'>В</td>
		<td>Usum:</td><td class='xinp' id='Usum1'>&nbsp;</td><td align='left' style='font-style: italic;' id='label_Usum'>В</td>
	</tr>
	<tr>
		<td>Ia:</td><td class='xinp' id='Ia'>&nbsp;</td><td align='left' style='font-style: italic;' id='label_Ia'>А</td>
		<td>Ib:</td><td class='xinp' id='Ib'>&nbsp;</td><td align='left' style='font-style: italic;' id='label_Ib'>А</td>
		<td>Ic:</td><td class='xinp' id='Ic'>&nbsp;</td><td align='left' style='font-style: italic;' id='label_Ic'>А</td>
		<td>Isum:</td><td class='xinp' id='Isum'>&nbsp;</td><td align='left' style='font-style: italic;' id='label_Isum'>А</td>
	</tr>
	<tr>
		<td>Ka:</td><td class='xinp' id='KPa'>&nbsp;</td><td align='left'>&nbsp;</td>
		<td>Kb:</td><td class='xinp' id='KPb'>&nbsp;</td><td align='left'>&nbsp;</td>
		<td>Kc:</td><td class='xinp' id='KPc'>&nbsp;</td><td align='left'>&nbsp;</td>
		<td>частота:</td><td class='xinp' id='F'>&nbsp;</td><td align='left'><i>Гц</i></td>
		<td colspan=4>&nbsp;</td>
	</tr>
	</table>
	</FIELDSET>
  </td>
 </tr>
</table>
<div id='Usum'></div>
<div id='qw'></div>";
}	
$TIME_END = getmicrotime();
$TIME_SCRIPT = $TIME_END - $TIME_START; 
?>

</td></tr></table>
</td></tr></table>
</td></tr></table>
</div>
<div id="div2" style="display:none">
<!--
<v:group id="phaze" editas="canvas" style="z-index:999;position:absolute;margin-top:-50;margin-left:50;width:200px;height:200px;" coordorigin="0,0" coordsize="200,200" filled="t" fillcolor="yellow">
<v:oval id="s1041" style='position:relative;left:90;top:90;width:400;height:400;' strokeweight="2.5" filled="f"/>
<v:oval id="s1042" style='position:relative;left:288;top:288;width:4;height:4;z-index:1;' strokeweight="1.5" strokecolor="#00ff00"/>
<v:oval id="s1043" style='position:relative;left:288;top:88;width:4;height:4;z-index:1;' strokeweight="1.5" strokecolor="#00ff00"/>
<v:oval id="s1044" style='position:relative;left:288;top:488;width:4;height:4;z-index:1;' strokeweight="1.5" strokecolor="#00ff00"/>
<v:oval id="s1045" style='position:relative;left:88;top:288;width:4;height:4;z-index:1;' strokeweight="1.5" strokecolor="#00ff00"/>
<v:oval id="s1046" style='position:relative;left:488;top:288;width:4;height:4;z-index:1;' strokeweight="1.5" strokecolor="#00ff00"/>

<v:line id="s1047" style='position:relative;' from="90,290" to="490,290"  strokeweight="1.5"/>
<v:line id="s1048" style='position:relative;' from="290,90" to="290,490" strokeweight="1.5"/>

<v:line id="A" from="290,290" to="290,90" strokecolor="yellow" strokeweight="2.5">
 <v:stroke endarrow="classic" endarrowwidth="wide" endarrowlength="long"/>
</v:line>
<v:line id="B" style='position:absolute;' from="290,290" to="290,90" strokecolor="green" strokeweight="2.5">
 <v:stroke endarrow="classic" endarrowwidth="wide" endarrowlength="long"/>
</v:line>
<v:line id="C" style='position:absolute;' from="290,290" to="290,90" strokecolor="red" strokeweight="2.5">
 <v:stroke endarrow="classic" endarrowwidth="wide" endarrowlength="long"/>
</v:line>

<v:shape id="s2021"  style='position:relative;top:285;left:495;width:70;height:40;font-size:10px'>
   <v:textbox inset=".1mm,.1mm,.1mm,.1mm">
	0&ordm;
  </v:textbox>
 </v:shape>
<v:shape id="s2021"  style='position:relative;top:285;left:55;width:70;height:40;font-size:10px'>
   <v:textbox inset=".1mm,.1mm,.1mm,.1mm">
	180&ordm;
  </v:textbox>
 </v:shape>
<v:shape id="s2021"  style='position:relative;top:75;left:285;width:70;height:40;font-size:10px'>
   <v:textbox inset=".1mm,.1mm,.1mm,.1mm">
	90&ordm;
  </v:textbox>
 </v:shape>
<v:shape id="s2021"  style='position:relative;top:495;left:280;width:70;height:40;font-size:10px'>
   <v:textbox inset=".1mm,.1mm,.1mm,.1mm">
	270&ordm;
  </v:textbox>
 </v:shape>
</v:group>
-->
<table style="visibility:hidden;" cellspacing="1" cellpadding="1" border="1">
<tr>
	<th align="center" nowrap bgcolor="#ffff00">фаза А</th>
	<th align="center" nowrap bgcolor="#008000">фаза В</th>
	<th align="center" nowrap bgcolor="#ff0000">фаза С</th>
</tr>
<tr>
	<td align="center"><input type="text" name="pA" id="pA" value="0" size="7" maxlength="6"></td>
	<td align="center"><input type="text" name="pB" id="pB" value="0" size="7" maxlength="6"></td>
	<td align="center"><input type="text" name="pC" id="pC" value="0" size="7" maxlength="6"></td>
</tr>
<tr>
	<td align="center"><input type="text" name="lA" id="lA" value="0" size="10" maxlength="10"><input type="text" name="fA" id="fA" value="0" size="10" maxlength="10"><input type="text" name="tA" id="tA" value="0" size="10" maxlength="10"></td>
	<td align="center"><input type="text" name="lB" id="lB" value="0" size="10" maxlength="10"><input type="text" name="fB" id="fB" value="0" size="10" maxlength="10"><input type="text" name="tB" id="tB" value="0" size="10" maxlength="10"></td>
	<td align="center"><input type="text" name="lC" id="lC" value="0" size="10" maxlength="10"><input type="text" name="fC" id="fC" value="0" size="10" maxlength="10"><input type="text" name="tC" id="tC" value="0" size="10" maxlength="10"></td>
</tr>
<tr>
	<td colspan="3" align="center"><input type="button" name="setAngle" value="задать" onclick="VRClk41();"></td>
</tr>
</table>


<v:group
 id="s1027" editas="canvas" style='width:459pt;height:282.1pt;
 mso-position-horizontal-relative:char;mso-position-vertical-relative:line'
 coordorigin="1701,1134" coordsize="9180,5642">
 <o:lock v:ext="edit" aspectratio="t"/>
 <v:shapetype id="t75" coordsize="21600,21600" o:spt="75"
  o:preferrelative="t" path="m@4@5l@4@11@9@11@9@5xe" filled="f" stroked="f">
  <v:stroke joinstyle="miter"/>
  <v:formulas>
   <v:f eqn="if lineDrawn pixelLineWidth 0"/>
   <v:f eqn="sum @0 1 0"/>
   <v:f eqn="sum 0 0 @1"/>
   <v:f eqn="prod @2 1 2"/>
   <v:f eqn="prod @3 21600 pixelWidth"/>
   <v:f eqn="prod @3 21600 pixelHeight"/>
   <v:f eqn="sum @0 0 1"/>
   <v:f eqn="prod @6 1 2"/>
   <v:f eqn="prod @7 21600 pixelWidth"/>
   <v:f eqn="sum @8 21600 0"/>
   <v:f eqn="prod @7 21600 pixelHeight"/>
   <v:f eqn="sum @10 21600 0"/>
  </v:formulas>
  <v:path o:extrusionok="f" gradientshapeok="t" o:connecttype="rect"/>
  <o:lock v:ext="edit" aspectratio="t"/>
 </v:shapetype>
 <v:shape id="s1026" type="#t75" style='position:absolute;  left:1701;top:1134;width:9180;height:5642' o:preferrelative="f" filled="t"  fillcolor="#eaeaea"> </v:shape>

 <v:group id="s1068" style='position:absolute;left:1701;top:1674;  width:7380;height:5102' coordorigin="2241,1449" coordsize="7380,5102">
  <v:oval id="s1028" style='position:absolute;left:2511;top:1674;   width:4536;height:4536' filled="f" strokeweight="2pt">
   <v:stroke dashstyle="1 1"/>
  </v:oval>
  <v:oval id="s1029" style='position:absolute;left:4708;top:3909;   width:113;height:117' strokecolor="red" strokeweight="1.5pt">
   <o:lock v:ext="edit" aspectratio="t"/>
  </v:oval>
  <v:rect id="s1030" style='position:absolute;left:2241;top:1449;   width:5102;height:5102' filled="f" strokeweight="1pt"/>
  <v:line id="s1031" style='position:absolute' from="8181,2214" to="9621,2215"   strokecolor="yellow" strokeweight="2.5pt">
   <v:stroke endarrow="open" endarrowwidth="wide"/>
  </v:line>
  <v:line id="s1033" style='position:absolute' from="8181,2574"   to="9621,2575" strokecolor="green" strokeweight="2.5pt">
   <v:stroke endarrow="open" endarrowwidth="wide"/>
  </v:line>
  <v:line id="s1035" style='position:absolute' from="8181,2933"   to="9621,2934" strokecolor="red" strokeweight="2.5pt">
   <v:stroke endarrow="open" endarrowwidth="wide"/>
  </v:line>
  <v:shapetype id="t202" coordsize="21600,21600" o:spt="202"   path="m,l,21600r21600,l21600,xe">
   <v:stroke joinstyle="miter"/>
   <v:path gradientshapeok="t" o:connecttype="rect"/>
  </v:shapetype>
  <v:shape id="s1037" type="#t202" style='position:absolute;  left:7821;top:2034;width:285;height:363;mso-wrap-style:none' filled="f"
   stroked="f">
   <v:textbox inset="0,0,0,0">
      <div>Ua    </div>
    </v:textbox>
  </v:shape>
  <v:shape id="s1038" type="#t202" style='position:absolute;   left:7821;top:2754;width:270;height:363;mso-wrap-style:none' filled="f"  stroked="f">
   <v:textbox inset="0,0,0,0">
      <div>Uc    </div>
    </v:textbox>
  </v:shape>
  <v:shape id="s1039" type="#t202" style='position:absolute;   left:7821;top:2391;width:285;height:363;mso-wrap-style:none' filled="f"   stroked="f">
   <v:textbox inset="0,0,0,0">
      <div>Ub     </div>
    </v:textbox>
  </v:shape>
  <v:line id="s1040" style='position:absolute' from="8234,3654"   to="9314,3655" strokecolor="yellow" strokeweight="1.5pt">
   <v:stroke endarrow="open" endarrowwidth="wide"/>
  </v:line>
  <v:line id="s1041" style='position:absolute' from="8234,4014"   to="9314,4015" strokecolor="green" strokeweight="1.5pt">
   <v:stroke endarrow="open" endarrowwidth="wide"/>
  </v:line>
  <v:line id="s1042" style='position:absolute' from="8234,4373"   to="9314,4374" strokecolor="red" strokeweight="1.5pt">
   <v:stroke endarrow="open" endarrowwidth="wide"/>
  </v:line>
  <v:shape id="s1043" type="#t202" style='position:absolute;   left:7874;top:3474;width:214;height:363;mso-wrap-style:none' filled="f"   stroked="f">
   <v:textbox inset="0,0,0,0">
      <div>Ia </div>
    </v:textbox>
  </v:shape>
  <v:shape id="s1044" type="#t202" style='position:absolute;   left:7874;top:4194;width:200;height:363;mso-wrap-style:none' filled="f"   stroked="f">
   <v:textbox inset="0,0,0,0">
      <div>Ic      </div>
    </v:textbox>
  </v:shape>
  <v:shape id="s1045" type="#t202" style='position:absolute;   left:7874;top:3831;width:210;height:363;mso-wrap-style:none' filled="f"   stroked="f">
   <v:textbox inset="0,0,0,0">
      <div>Ib      </div>
    </v:textbox>
  </v:shape>
  <v:shape id="s1046" type="#t202" style='position:absolute;   left:7200;top:3864;width:200;height:249;mso-wrap-style:none' fillcolor="#eaeaea"   stroked="f">
   <v:textbox inset="0,0,0,0">
      <div>0&ordm; </div>
    </v:textbox>
  </v:shape>
  <v:shape id="s1047" type="#t202" style='position:absolute;  left:4641;top:1400;width:440;height:249;mso-wrap-style:none' fillcolor="#eaeaea"   stroked="f">
   <v:textbox inset="0,0,0,0">
      <div>270&ordm;     </div>
    </v:textbox>
  </v:shape>
  <v:shape id="s1048" type="#t202" style='position:absolute;   left:2051;top:3864;width:440;height:249;mso-wrap-style:none' fillcolor="#eaeaea"   stroked="f">
   <v:textbox inset="0,0,0,0">
      <div>180&ordm; </div>
    </v:textbox>
  </v:shape>
  <v:shape id="s1049" type="#t202" style='position:absolute;  left:4656;top:6269;width:320;height:249;mso-wrap-style:none' fillcolor="#eaeaea"  stroked="f">
   <v:textbox inset="0,0,0,0">
      <div>90&ordm; </div>
    </v:textbox>
  </v:shape>
  <v:shape id="s1050" type="#t202" style='position:absolute; left:6901;top:2754;width:440;height:249;mso-wrap-style:none' fillcolor="#eaeaea"  stroked="f">
   <v:textbox inset="0,0,0,0">
      <div>330&ordm; </div>
    </v:textbox>
  </v:shape>
  <v:shape id="s1051" type="#t202" style='position:absolute;  left:6091;top:1835;width:440;height:249;mso-wrap-style:none' fillcolor="#eaeaea"  stroked="f">
   <v:textbox inset="0,0,0,0">
      <div>300&ordm; </div>
    </v:textbox>
  </v:shape>
  <v:shape id="s1052" type="#t202" style='position:absolute;  left:3076;top:1835;width:440;height:249;mso-wrap-style:none' fillcolor="#eaeaea"  stroked="f">
   <v:textbox inset="0,0,0,0">
      <div>240&ordm;  </div>
    </v:textbox>
  </v:shape>
  <v:shape id="s1053" type="#t202" style='position:absolute;  left:2301;top:2754;width:440;height:249;mso-wrap-style:none' fillcolor="#eaeaea"  stroked="f">
   <v:textbox inset="0,0,0,0">
      <div>210&ordm; </div>
    </v:textbox>
  </v:shape>
  <v:shape id="s1054" type="#t202" style='position:absolute; left:2301;top:4999;width:440;height:249;mso-wrap-style:none' fillcolor="#eaeaea"  stroked="f">
   <v:textbox inset="0,0,0,0">
      <div>150&ordm; </div>
    </v:textbox>
  </v:shape>
  <v:shape id="s1055" type="#t202" style='position:absolute; left:3076;top:5810;width:440;height:249;mso-wrap-style:none' fillcolor="#eaeaea" stroked="f">
   <v:textbox inset="0,0,0,0">
      <div>120&ordm;</div>
    </v:textbox>
  </v:shape>
  <v:shape id="s1056" type="#t202" style='position:absolute; left:6091;top:5810;width:320;height:249;mso-wrap-style:none' fillcolor="#eaeaea"  stroked="f">
   <v:textbox inset="0,0,0,0">
      <div>60&ordm;</div>
    </v:textbox>
  </v:shape>
  <v:shape id="s1057" type="#t202" style='position:absolute;  left:6901;top:4999;width:320;height:249;mso-wrap-style:none' fillcolor="#eaeaea" stroked="f">
   <v:textbox inset="0,0,0,0">
      <div>30&ordm;</div>
    </v:textbox>
  </v:shape>
  <v:oval id="g30" style='position:absolute;left:0;top:3309;   width:50;height:50' strokecolor="red" strokeweight="1.5pt">
   <o:lock v:ext="edit" aspectratio="t"/>
  </v:oval>
  <v:oval id="g60" style='position:absolute;left:0;top:3309;   width:50;height:50' strokecolor="red" strokeweight="1.5pt">
   <o:lock v:ext="edit" aspectratio="t"/>
  </v:oval>
  <v:oval id="g90" style='position:absolute;left:0;top:3309;   width:50;height:50' strokecolor="red" strokeweight="1.5pt">
   <o:lock v:ext="edit" aspectratio="t"/>
  </v:oval>
  <v:oval id="g120" style='position:absolute;left:0;top:3309;   width:50;height:50' strokecolor="red" strokeweight="1.5pt">
   <o:lock v:ext="edit" aspectratio="t"/>
  </v:oval>
  <v:oval id="g150" style='position:absolute;left:0;top:3309;   width:50;height:50' strokecolor="red" strokeweight="1.5pt">
   <o:lock v:ext="edit" aspectratio="t"/>
  </v:oval>
  <v:oval id="g180" style='position:absolute;left:0;top:3309;   width:50;height:50' strokecolor="red" strokeweight="1.5pt">
   <o:lock v:ext="edit" aspectratio="t"/>
  </v:oval>
  <v:oval id="g210" style='position:absolute;left:0;top:3309;   width:50;height:50' strokecolor="red" strokeweight="1.5pt">
   <o:lock v:ext="edit" aspectratio="t"/>
  </v:oval>
  <v:oval id="g240" style='position:absolute;left:0;top:3309;   width:50;height:50' strokecolor="red" strokeweight="1.5pt">
   <o:lock v:ext="edit" aspectratio="t"/>
  </v:oval>
  <v:oval id="g270" style='position:absolute;left:0;top:3309;   width:50;height:50' strokecolor="red" strokeweight="1.5pt">
   <o:lock v:ext="edit" aspectratio="t"/>
  </v:oval>
  <v:oval id="g300" style='position:absolute;left:0;top:3309;   width:50;height:50' strokecolor="red" strokeweight="1.5pt">
   <o:lock v:ext="edit" aspectratio="t"/>
  </v:oval>
  <v:oval id="g330" style='position:absolute;left:0;top:3309;   width:50;height:50' strokecolor="red" strokeweight="1.5pt">
   <o:lock v:ext="edit" aspectratio="t"/>
  </v:oval>
  <v:oval id="g360" style='position:absolute;left:0;top:3309;   width:50;height:50' strokecolor="red" strokeweight="1.5pt">
   <o:lock v:ext="edit" aspectratio="t"/>
  </v:oval>
  <v:line id="A" style='position:absolute;' from="4761,3954" to="7029,3954" strokecolor="yellow" strokeweight="2.5pt">
   <v:stroke endarrow="open" endarrowwidth="wide"/>
  </v:line>
  <v:line id="B" style='position:absolute' from="4761,3954" to="7029,3954" strokecolor="green" strokeweight="2.5pt">
   <v:stroke endarrow="open" endarrowwidth="wide"/>
  </v:line>
  <v:line id="C" style='position:absolute;' from="4761,3954" to="7029,3954" strokecolor="red" strokeweight="2.5pt">
   <v:stroke endarrow="open" endarrowwidth="wide"/>
  </v:line>
  
 <v:line id="iA" style='position:absolute' from="4761,3954" to="5661,4914" strokecolor="yellow" strokeweight="1.5pt">
   <v:stroke endarrow="open" endarrowwidth="wide"/>
  </v:line>
  <v:line id="iB" style='position:absolute;' from="4761,3954" to="5661,4914" strokecolor="green" strokeweight="1.5pt">
   <v:stroke endarrow="open" endarrowwidth="wide"/>
  </v:line>
  <v:line id="iC" style='position:absolute;' from="4761,3954" to="5661,4914" strokecolor="red" strokeweight="1.5pt">
   <v:stroke endarrow="open" endarrowwidth="wide"/>
  </v:line>
  </v:group>
</v:group>

	

</div>
</div>

<center>
<div style="color:white;" class="help"><b>.::</b>
Время выполнения запроса <?=number_format($TIME_SCRIPT,3,".","");?> сек.
<b>::.</b>
</div>

</center>
<!-- create controls -->
<script type="text/javascript">

	var names = ["Основные", "Диаграмма"];
	var values = ["div1", "div2"];

	var tabs = new AW.UI.Tabs;
	tabs.setId("myTabs");
	tabs.setItemText(names);
	tabs.setItemValue(values); // store ids of content DIVs
	tabs.setItemCount(2);
	tabs.refresh();

</script>
<script language="VBScript" src="js/excel_export.vbs">
<!-- 
// --> 
</script>
<!-- add page behavior -->
<script type="text/javascript">

	tabs.onSelectedItemsChanged = function(selected){

		var i, divs = document.getElementById("myContent").childNodes;

		for(i=0; i<divs.length;i++){
			if (divs[i].style) {
				divs[i].style.display = "none"; // hide all elements
			}
		}

		var index = selected[0];
		var value = this.getItemValue(index);
		document.getElementById(value).style.display = "block"; // show selected
	}

	tabs.setSelectedItems([1]); // load the first page.
//VRClk41()

</script>
<script language="JavaScript1.2">
var R=2268;var topMargin=2*R;var leftMargin=2*R;
var sinA;
var sinB;
var sinC;
var cosA;
var cosB;
var cosC;
var max;

function VRClk41() {
 
 
 pA.value=document.getElementById('Ua').innerHTML;
 pB.value=document.getElementById('Ub').innerHTML;
 pC.value=document.getElementById('Uc').innerHTML;
 lA.value=document.getElementById('Ia').innerHTML;
 lB.value=document.getElementById('Ib').innerHTML;
 lC.value=document.getElementById('Ic').innerHTML;
 tA.value=document.getElementById('KPa').innerHTML;
 tB.value=document.getElementById('KPb').innerHTML;
 tC.value=document.getElementById('KPc').innerHTML;
 /*document.getElementById('g30').style.top =3954 - R/2;
 document.getElementById('g30').style.left = 4761 + Math.sin(Math.PI/180*60)*R;
 document.getElementById('g60').style.top =3954 - Math.sin(Math.PI/180*60)*R;
 document.getElementById('g60').style.left = 4761 + R/2;
 document.getElementById('g90').style.top =3954 - R;
 document.getElementById('g90').style.left = 4761 ;
 document.getElementById('g150').style.top =3954 - R/2;
 document.getElementById('g150').style.left = 4761 - Math.sin(Math.PI/180*60)*R;
 document.getElementById('g120').style.top =3954 - Math.sin(Math.PI/180*60)*R;
 document.getElementById('g120').style.left = 4761 - R/2;
 document.getElementById('g180').style.top =3954;
 document.getElementById('g180').style.left = 4761 - R ;
 document.getElementById('g210').style.top =3954 + R/2;
 document.getElementById('g210').style.left = 4761 - Math.sin(Math.PI/180*60)*R;
 document.getElementById('g240').style.top =3954 + Math.sin(Math.PI/180*60)*R;
 document.getElementById('g240').style.left = 4761 - R/2;
 document.getElementById('g270').style.top =3954 + R;
 document.getElementById('g270').style.left = 4761  ;
 document.getElementById('g330').style.top =3954 + R/2;
 document.getElementById('g330').style.left = 4761 + Math.sin(Math.PI/180*60)*R;
 document.getElementById('g300').style.top =3954 + Math.sin(Math.PI/180*60)*R;
 document.getElementById('g300').style.left = 4761 + R/2;
 document.getElementById('g360').style.top =3954 ;
 document.getElementById('g360').style.left = 4761  + R;*/
 max = Math.max(pA.value,pB.value,pC.value);
 maxI =  Math.max(lA.value,lB.value,lC.value);
 fA.value=R*pA.value/max;
 fB.value=R*pB.value/max;
 fC.value=R*pC.value/max;
sinA=0;
sinB=0;
sinC=0;
cosA=1;
cosB=1;
cosC=1;
/*
xA=leftMargin+R*cosA;yA=topMargin-R*sinA; 
xB=leftMargin+R*cosB;yB=topMargin-R*sinB; 
xC=leftMargin+R*cosC;yC=topMargin-R*sinC; 
*/
xA=4761+R*pA.value/max;yA=3954; 
xB=4761-(R*pB.value/max)/2;yB=3954 + Math.sin(Math.PI/180*60)*(R*pB.value/max); 
xC=4761-(R*pC.value/max)/2;yC=3954 - Math.sin(Math.PI/180*60)*(R*pC.value/max); 
xiA=4761+(R*lA.value/maxI)*tA.value;yiA=3954+Math.sqrt(1-tA.value*tA.value)*(R*lA.value/maxI);
xiB=4761-R*(0.5*tB.value+ Math.cos(Math.PI/180*30) * Math.sqrt(1-tB.value*tB.value))*lB.value/maxI;yiB=3954+R*(Math.cos(Math.PI/180*30)*tB.value-0.5*Math.sqrt(1-tB.value*tB.value))*lB.value/maxI;
xiC=4761-R*(0.5*tC.value- Math.cos(Math.PI/180*30) * Math.sqrt(1-tC.value*tC.value))*lC.value/maxI;yiC=3954-R*(Math.cos(Math.PI/180*30)*tB.value+0.5*Math.sqrt(1-tC.value*tB.value))*lB.value/maxI;

//A.from=(xA-10)+","+(yA-10);
//B.from=(xB-10)+","+(yB-10);
//C.from=(xC-10)+","+(yC-10);
A.to=(xA-10)+","+(yA-10);
B.to=(xB-10)+","+(yB-10);
C.to=(xC-10)+","+(yC-10);
iA.to=(xiA-10)+","+(yiA-10);
iB.to=(xiB-10)+","+(yiB-10);
iC.to=(xiC-10)+","+(yiC-10);
fill();
}

function fill()
{
// fA.value=A.from;
// fB.value=B.from;
//fC.value=C.from;
// tA.value=A.to;
// tB.value=B.to;
 //tC.value=C.to;
//a1=(fA.value).split(",");a2=(tA.value).split(",");
//b1=(fB.value).split(",");b2=(tB.value).split(",");
//c1=(fC.value).split(",");c2=(tC.value).split(",");

// lA.value=Math.sqrt(Math.pow(a2[0]-a1[0],2)+Math.pow(a2[1]-a1[1],2)).toFixed(0);
// lB.value=Math.sqrt(Math.pow(b2[0]-b1[0],2)+Math.pow(b2[1]-b1[1],2)).toFixed(0);
// lC.value=Math.sqrt(Math.pow(c2[0]-c1[0],2)+Math.pow(c2[1]-c1[1],2)).toFixed(0);
 
}



function VRClk52(VRClk53) {
	var VRClk54 = document.getElementById(VRClk53);
	VRClk54.style.display = (VRClk54.style.display == "none") ? "block" : "none";
}

function showMessage(element,msg)
{
  element.title=msg;
}

function getID(element)
{
showMessage(element,element.from+"_"+element.to)
 window.status=element.id;
}
fill()
</script>
</body>
</html>
