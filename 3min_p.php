<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
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
$curtime = $_GET["curtime"];
if (!isset($curtime)) $curtime=0;
if (!isset($pw_en)) $pw_en=$disp;
if (!isset($mode)) $mode=$disp;
if (!isset($izm_type)) $izm_type=$type;
 $type_izm = array();
 $pwr = array();
 $nrg = array();
 $colname = array();
 $count=0;$num_day=0;$zn="";
 if (!isset($pw_en)) $pw_en=0;
?>
	<title>3-минутная мощность с ретроспективой</title>
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

<?php
echo "<SCRIPT language=\"JavaScript1.2\">var tab=".$_GET["tab"]."</SCRIPT>";
echo "<SCRIPT language=\"JavaScript1.2\" src=\"js/progressbar.js\"></SCRIPT>";
echo "<script language=\"JavaScript1.2\" src=\"js/control_3m.js\"></script>";
echo "<script language=\"JavaScript1.2\">formatData.style.display='none';</script>";
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
<body id="f5" topmargin=0 marginheight=0 marginwidth=0 scroll="auto" onload="startIncrement();" background=tree/imgs/fon.gif>
<div id="padding" style="height:60px;"></div>
<div id="content" style="height:80%;">
<?
echo "
<script language=\"JavaScript1.2\">
	if (window.parent.toc.ntype)
	{
	 node=window.parent.toc.ntype.value;
     if (node==0||node==1) {
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
include("include/mysql.php"); //  Соединяемся с БД
$currdate=date("d.m.Y H:i");
list($ac_dt,$ac_tm) = explode (" ",$currdate);
list($d,$m,$y) = explode (".",$ac_dt);
if($m<=10 and $m>=4)
{
	if (($m=10 and $d<=14) or ($m=4 and $d>=15))
	{
		date_default_timezone_set('Europe/Kiev');
	}
	else date_default_timezone_set('Europe/Moskow');
}

$TIME_START = getmicrotime(); 
if (isset($dc) and isset($uid) and isset($n_obj) and isset($adr) and isset($pw_en) and ( ($node==0) or ($node==1) or ($node==-1)) )
{
echo "<script>\n";
echo "window.document.forms[0].iname.value='$name';\n";
echo "window.document.forms[0].id.value='$id';\n";
echo "window.document.forms[0].pid.value='$pid';\n";
echo "window.document.forms[0].lid.value='$lid';\n";
echo "window.document.forms[0].node.value='$node';\n";
if ($curtime==1) 
{
   $currdate=date("d.m.Y H:i");
	list ($ac_dt,$ac_tm) = explode (" ",$currdate);
	list ($ac_h,$ac_m) = explode (":",$ac_tm);
	if (($ac_m-$ac_m%3)<10) $add='0';else $add='';
	$tm=$ac_h.":".$add."".($ac_m-$ac_m%3);

if ($disp==0)	$dc=$ac_dt." ".$tm;
$dc=$ac_dt." ".$tm;

//	$dc=$date_1;

//	echo "setMode();\n";
}	
			$itemStr=split( ' ', $dc);
			$dateStr=$itemStr[0]; $timeStr=$itemStr[1];
			list($day,$month,$year)=explode(".",$dateStr);
			$dateStr=$year."-".$month."-".$day;
			list($hour,$minute)=explode(":",$timeStr);
			$date_1=$dateStr." ".$timeStr;
//else echo "window.document.forms[0].disp.value='0';\n";
echo "window.document.forms[0].disp.value='$disp';\n";
echo "window.document.forms[0].dc.value='$dc';\n";
echo "window.document.forms[0].curtime.checked=$curtime;\n";
echo "window.document.forms[0].curtime.value=$curtime;\n";
echo "formatData.style.display='inline';\n";
echo "</script>\n";
//echo $curtime."_".$disp."_".$date_1."_".$dc."_".$n_obj."<br>";

function incrementProgressBar()
{
 global $count;
 $count++;
 echo "<script language=\"JavaScript\">incrementProgressBar();</script>\n";
 return $count;
}


if ($curtime==0)
{//вывод заданного счетчика с ретроспективой от заданого времени
	$count=incrementProgressBar();
	$count=incrementProgressBar();
	PrintHeader($pw_en,$uid,$n_obj,$adr,$dc);
	$count=incrementProgressBar();
	echo "<script>if (h1) h1.innerText=h1.innerText+' '+window.document.forms[0].disp.options[window.document.forms[0].disp.selectedIndex].innerText;</script>";
	$count=incrementProgressBar();
	PrintData($pw_en,$date_1,$disp,$n_obj,$adr);
	$count=incrementProgressBar();
 }
 else if ($curtime==1 and $disp==0)
 {//вывод всех счетчиков за тек. время с периодическим обновлением
	$count=incrementProgressBar();
	$count=incrementProgressBar();
	PrintHeader2($pw_en,$uid,$n_obj,$adr,$dc);
	$count=incrementProgressBar();
	$count=incrementProgressBar();
	PrintData2($pw_en,$date_1,$disp,$n_obj,$adr);
	$count=incrementProgressBar();
   echo "
   		<script>
		function refresh()
		{
		window.document.topmenu.go.click();
		};
		setTimeout('refresh()',60000);
		</script>";
  }	
  else if ($curtime==1 and $disp<>0)
   {//вывод заданного счетчика с ретроспективой от тек. времени с периодическим обновлением
	$count=incrementProgressBar();
	$count=incrementProgressBar();
	PrintHeader($pw_en,$uid,$n_obj,$adr,$dc);
	$count=incrementProgressBar();
	echo "<script>if (h1) h1.innerText=h1.innerText+' '+window.document.forms[0].disp.options[window.document.forms[0].disp.selectedIndex].innerText;</script>";
	$count=incrementProgressBar();
	PrintData($pw_en,$date_1,$disp,$n_obj,$adr);
	$count=incrementProgressBar();
   echo "
   		<script>
		function refresh()
		{
		window.document.topmenu.go.click();
		};
		setTimeout('refresh()',60000);
		</script>";
   }
//===============================================================================	
mysql_close();
}


function PrintHeader2($pw_en,$uid,$n_obj,$adr,$date_1)
{
  global $type_izm;
  global $pwr;
  global $nrg;
  global $colname;
  global $zn;
  $cnt1=0;  $cnt2=0;
//=====================определяем параметры и название точки учета===================================
	$result=mysql_query("select izm_str,descript,znum,c_type FROM counters WHERE  n_obj=".$n_obj." AND link_adr=".$adr." ");
    if ($result)
	if ($res=mysql_fetch_array($result,MYSQL_BOTH))
	{
	 $izm_str=$res[0];	$type_izm = explode (",",$izm_str); 
	 $name=$res[1]; if ($res[3]==0) {$znum= "номер счетчика ".$res[2];$zn=$res[2];} else {$znum=""; $zn="";}
	} 
	$result=mysql_query("select item_name FROM objects WHERE  item_id=(select item_parent_id FROM objects WHERE item_id=".$uid.") ");
    if ($result)
    if ($res=mysql_fetch_array($result,MYSQL_BOTH))
	{
	 $pname=$res[0];
	} 
	$pname="";$name="";
//==========================================================================================================================
 for ($i=0;$i<count($type_izm);$i++)
 {
  if ($type_izm[$i]>=9)
  {
	 $pwr[$cnt1]=$type_izm[$i];
	 $nrg[$cnt1]=$type_izm[$i];
	 $cnt1++;
  }
 }

  	for ($i=0;$i<count($pwr);$i++)
	{
	 $result=mysql_query("select pwr_symb,pwr_unit FROM izm_type WHERE izm_type=". $pwr[$i]." ");
	 $row=mysql_fetch_array($result,MYSQL_BOTH);
	 $colname[$i]=$row[0]." ".$row[1];
	}
$count=incrementProgressBar();
if (count($pwr)>0) $col=count($pwr)*2+1;
else $col=0;


	echo "<table cellpadding='0' cellspacing='0' align='center' border='0' id='TB2'>\n";
	echo " 	<tr> <td colspan='".$col."' align='center'>".$pname." ".$name."</td>   </tr>\n";
   	 echo "   		<tr>\n";
	 echo "			<td class='x23' colspan='1' style='border-bottom:none'>&nbsp;</td>\n";
	 echo "			<td  colspan='".(count($pwr)*2)."' class='x23' style='border-left:none' align='center' id='h1'>3-минутная мощность за ".$date_1."</td>\n";
	 echo "	</tr>\n";
	$count=incrementProgressBar();

	 echo "		<tr>\n";
	 	echo "			<td class='x23' style='width:60px;border-top:none;' >Название</td>\n";
 		 for ($i=0;$i<count($colname);$i++)
		 {
		  echo "		<td class='x23' style='border-top:none;border-left:none' width='75'>".$colname[$i]."</td>\n";
		  echo "		<td class='x23' style='border-top:none;border-left:none' width='5'>&nbsp;</td>\n";
		 }
	 echo "	</tr>\n";
}

function PrintHeader($pw_en,$uid,$n_obj,$adr,$date_1)
{
  global $type_izm;
  global $pwr;
  global $nrg;
  global $colname;
  global $zn;
  $cnt1=0;  $cnt2=0;
//=====================определяем параметры и название точки учета===================================
	$result=mysql_query("select izm_str,descript,znum,c_type FROM counters WHERE  n_obj=".$n_obj." AND link_adr=".$adr." ");
    if ($result)
	if ($res=mysql_fetch_array($result,MYSQL_BOTH))
	{
	 $izm_str=$res[0];	$type_izm = explode (",",$izm_str); 
	 $name=$res[1]; if ($res[3]==0) {$znum= "номер счетчика ".$res[2];$zn=$res[2];} else {$znum=""; $zn="";}
	} 
	$result=mysql_query("select item_name FROM objects WHERE  item_id=(select item_parent_id FROM objects WHERE item_id=".$uid.") ");
    if ($result)
    if ($res=mysql_fetch_array($result,MYSQL_BOTH))
	{
	 $pname=$res[0];
	} 
//==========================================================================================================================
 for ($i=0;$i<count($type_izm);$i++)
 {
  if ($type_izm[$i]>=9)
  {
	 $pwr[$cnt1]=$type_izm[$i];
	 $nrg[$cnt1]=$type_izm[$i];
	 $cnt1++;
	 echo $pwr[$cnt1];
  }
 }

  	for ($i=0;$i<count($pwr);$i++)
	{
	 $result=mysql_query("select pwr_symb,pwr_unit FROM izm_type WHERE izm_type=". $pwr[$i]." ");
	 $row=mysql_fetch_array($result,MYSQL_BOTH);
	 $colname[$i]=$row[0]." ".$row[1];
	}
$count=incrementProgressBar();
if (count($pwr)>0) $col=count($pwr)*2+1;
else $col=0;


	echo "<table cellpadding='0' cellspacing='0' align='center' border='0' id='TB2'>\n";
	echo " 	<tr> <td colspan='".$col."' align='center'>".$pname." ".$name."</td>   </tr>\n";
	 echo " 	<tr> <td colspan='".$col."' align='center'>".$znum."</td> </tr>\n";
	 echo "	<tr> <td colspan='".$col."' align='center'>по состоянию на ". $date_1."</td> </tr>\n";
   	 echo "   		<tr>\n";
	 echo "			<td class='x23' colspan='2' style='border-bottom:none'>&nbsp;</td>\n";
	 echo "			<td  colspan='".(count($pwr)*2)."' class='x23' style='border-left:none' align='center' id='h1'>3-минутная мощность с ретроспективой </td>\n";
	 echo "	</tr>\n";
	$count=incrementProgressBar();

	 echo "		<tr>\n";
	 	echo "			<td class='x23' style='width:60px;border-top:none;border-right:none' >дата</td>\n";
	 	echo "			<td class='x23' style='width:50px;border-top:none;' >время</td>\n";
 		 for ($i=0;$i<count($colname);$i++)
		 {
		  echo "		<td class='x23' style='border-top:none;border-left:none' width='75'>".$colname[$i]."</td>\n";
		  echo "		<td class='x23' style='border-top:none;border-left:none' width='5'>&nbsp;</td>\n";
		 }
	 echo "	</tr>\n";
}

function PrintData2($pw_en,$date_1,$disp,$n_obj,$adr)
{
  global $type_izm;
  global $pwr;
  global $nrg;
  global $colname;
  $izm = array(); $maxP = array();	  $flag = array();
  $result=mysql_query("select descript,n_obj,link_adr from counters where (link_adr<1000 or link_adr=1001) order by descript");
   if ($result)
   {
	 while ($res=mysql_fetch_array($result,MYSQL_BOTH))
	 {
	  	  $fiderName=$res[0];
	  $id_1=$res[1]."_".$res[2]."_1";
	  $id_2=$res[1]."_".$res[2]."_2";
	  $id_3=$res[1]."_".$res[2]."_3";
	  $id_4=$res[1]."_".$res[2]."_4";
	  echo "<tr>\n";
	  echo "	<td class='x26' align='center'  style='border-top:none;	padding-right: 1px;' >".$fiderName."</td>\n";
		  echo "	<td class='x22' id='v_$id_1' style='border-top:none;'>&nbsp;</td>\n";
	  	  echo "	<td class='x22' id='f_$id_1' style='border-top:none;border-left:none;' align='right'>&nbsp;</td>\n";
		  echo "	<td class='x22' id='v_$id_2' style='border-top:none;border-left:none;'>&nbsp;</td>\n";
	  	  echo "	<td class='x22' id='f_$id_2' style='border-top:none;border-left:none;' align='right'>&nbsp;</td>\n";
		  echo "	<td class='x22' id='v_$id_3' style='border-top:none;border-left:none;'>&nbsp;</td>\n";
	  	  echo "	<td class='x22' id='f_$id_3' style='border-top:none;border-left:none;' align='right'>&nbsp;</td>\n";
		  echo "	<td class='x22' id='v_$id_4' style='border-top:none;border-left:none;'>&nbsp;</td>\n";
	  	  echo "	<td class='x22' id='f_$id_4' style='border-top:none;border-left:none;' align='right'>&nbsp;</td>\n";
	  echo "</tr>\n";
	 }
   }
echo "<script>\n";
		$result2=mysql_query("select n_obj,link_adr,izm_type,znach,flag From val_3m WHERE DATE_FORMAT(data,'%Y-%m-%d %H:%i')= '".$date_1."' and (link_adr<1000 or link_adr=1001) Order By n_obj,link_adr,izm_type");
		while($res2=mysql_fetch_array($result2,MYSQL_BOTH))
		{
 		echo "window.document.getElementById('v_".$res2[0]."_".$res2[1]."_".($res2[2]-8)."').innerText='".format($res2[3])."';\n";	
		}
echo "</script>\n";
   if ($result) mysql_free_result($result);
   if ($result2) mysql_free_result($result2);
}


function PrintData($pw_en,$date_1,$disp,$n_obj,$adr)
{
  global $type_izm;
  global $pwr;
  global $nrg;
  global $colname;
  $izm = array(); $maxP = array();	  $flag = array();
	$result3=mysql_query("select max(znach),izm_type From val_3m WHERE data BETWEEN DATE_ADD(DATE_FORMAT('".$date_1."','%Y-%m-%d %H:%i:%s'), INTERVAL -".$disp." MINUTE) AND DATE_FORMAT('".$date_1."','%Y-%m-%d %H:%i:%s') AND izm_type in(9,11,12,13) AND n_obj=".$n_obj." AND link_adr=".$adr." group by izm_type order by izm_type");
   if ($result3)
   {
	 while ($res3=mysql_fetch_array($result3,MYSQL_BOTH))
	 {
	  $maxP[$res3[1]]=$res3[0];
	 }
   
   }
  $result2=mysql_query("select DATE_FORMAT(data,'%d.%m.%Y %H:%i'),data From val_3m WHERE data BETWEEN DATE_ADD(DATE_FORMAT('".$date_1."','%Y-%m-%d %H:%i:%s'), INTERVAL -".$disp." MINUTE) AND DATE_FORMAT('".$date_1."','%Y-%m-%d %H:%i:%s') AND izm_type=9 AND n_obj=".$n_obj." AND link_adr=".$adr." Order By data desc" );
  if ($result2)
  {	
  	$j=0;
	while ($res2=mysql_fetch_array($result2,MYSQL_BOTH))
	{
      $datetime=$res2[0];$j++;
	  $itemStr=split( ' ', $datetime);
			$date=$itemStr[0]; $time=$itemStr[1];
	  echo "<tr>\n";
	  echo "	<td class='x26' align='center'  style='border-top:none;	padding-right: 1px;' >".$date."</td>\n";
	  echo "	<td class='x26' align='center'  style='border-top:none;	padding-right: 1px;' >".$time."</td>\n";
      for ($i=0;$i<count($colname);$i++)
	  {
		$i_type=$nrg[$i];
		$result=mysql_query("select znach,flag,DATE_FORMAT(data,'%d.%m.%Y %H:%i'),izm_type From val_3m WHERE data= '".$res2[1]."' AND izm_type=".$i_type." AND n_obj=".$n_obj." AND link_adr=".$adr."  Order By data desc");
		  $res=mysql_fetch_array($result,MYSQL_BOTH);
		  $izm[$i][$j]=$res[0];  $flag[$i][$j]=$res[1];  
		  if (($izm[$i][$j]==$maxP[$i_type]) and ($maxP[$i_type]!=0) and ($disp!=0))  $bgcolor="#33ff99"; else $bgcolor="#ffffff";
	  	  if ($i>0)  echo "	<td class='x22' style='border-top:none;border-left:none;' bgcolor='".$bgcolor."'>&nbsp;".format($izm[$i][$j])."</td>\n";
	  	  else       echo "	<td class='x22' style='border-top:none;' bgcolor='".$bgcolor."'>&nbsp;".format($izm[$i][$j])."</td>\n";
	  	  echo "	<td class='x22' style='border-top:none;border-left:none;' align='right'>&nbsp;".$flag[$i][$j]."</td>\n";
	   }//end for $i
     echo "</tr>\n";	
    }//end while $res2
   }//end if
   if ($result) mysql_free_result($result);
   if ($result2) mysql_free_result($result2);
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
<div style="color:white;" class="help"><b>.::</b>
Время выполнения запроса <?=number_format($TIME_SCRIPT,3,".",""); 
$currdate=date("d.m.Y H:i");
list($ac_dt,$ac_tm) = explode (" ",$currdate);
list($d,$m,$y) = explode (".",$ac_dt);
$d = $d + 1;
echo "$d,$m,$y";
?> сек.
<?

?>

<b>::.</b>
</div>
<?
$dc=str_replace(".","-",$dc);
$dc=str_replace(":",".",$dc);
if ($zn=="") $zn=$name;
echo "<div id='activator' ONCLICK=\"ToXls_5('TB','5','".$pw_en."','0','0','".$dc."','".$zn."','0')\"></div>\n"; 
?>
</center>
<script language="VBScript" src="js/excel_export.vbs">
<!-- 
// --> 
</script>
</body>
</html>


