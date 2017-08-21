<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>Архив событий УСПД</title>
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
	    <link type="text/css" rel="stylesheet" href="css/TABLE2.CSS">
	<BASE target="frSheet">
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
	<link rel="stylesheet" href="tree/j.css"></link>
<?php
$tab=$_GET["tab"];
echo "<SCRIPT language=\"JavaScript1.2\">var tab=".$tab."</SCRIPT>";
echo "<SCRIPT language=\"JavaScript1.2\" src=\"js/progressbar.js\"></SCRIPT>";
echo "<script language=\"JavaScript1.2\" src=\"js/control_au.js\"></script>";
require_once("include/vbs.php");
?>	
<script language="JavaScript" src="js/tabs.js">
<!--
//-->
</script>
</head>

<body background=tree/imgs/fon.gif onload="startIncrement();">
<div id="padding" style="height:60px;"></div>
<div id="content" style="height:80%;">
<table width="100%" cellpadding="0" cellspacing="0" height="100%">
<tr><td height="100%">
 <table width="100%" cellpadding="0" cellspacing="0" height="100%">
 <tr><td valign="top" bgcolor="EEEEEE">
	<img src="tree/imgs/spacer.gif" height="1" width="1">
	</td>
	<td width="100%" valign="top" background="tree/imgs/fon.gif">
	 <table border="1" bordercolor="A5D7D6" width="100%" cellpadding="10">
	 <tr><td  id="container">
<?
include("util_fun.php");
$cursor=$_GET["next"];
$obj=$_GET["n_obj"];
$dt=$_GET["dt"];
if (!isset($cursor)) $cursor=0;
if ($cursor<0) $cursor=0;
$cNum=32;
function writeEvent($txt)
{
 echo $txt;
}
?>
<table align="center" cellspacing="0" cellpadding="0" border="0" width="600">
<tr>
	<td width="600" height="330" valign="top">
	<table cellpadding="3" cellspacing="1" align="center" border="0"  style="background-color: InfoBackground;"  id='TB'>
	<tr>
	<td class="x23" colspan="4">АРХИВ СОБЫТИЙ УСПД</td>
	</tr>
<?
//if (isset($obj) and isset($dt))
{
include("include/mysql.php"); //  Соединяемся с БД

	$result1=mysql_query("select distinct n_obj from arch_uspd order by n_obj limit 0,".($cNum-1)."");
	$result2=mysql_query("select distinct DATE_FORMAT(on_date_time,'%d.%m.%Y') from arch_uspd order by on_date_time desc limit 0,31");

	$out_str="";
	$out_str.="<input type='hidden' name='tab' value='$tab' size=2>";
	$out_str.=" дата ";
	$out_str.="<select name='dt' style='width:100px;'>";
	$out_str.="<option value='' >все</option>";
	while ($res2=mysql_fetch_row($result2))
	{
	 if ($res2[0]==$dt) $selectItem='selected'; else $selectItem='';
	 $out_str.="<option value='".$res2[0]."' ".$selectItem.">".$res2[0]."</option>";
	}
	$out_str.="</select>";
	echo '<script>var str="";str="'.$out_str.'";filter_date.innerHTML=str;</script>';
	$out_str="";
	$out_str.="№ объекта <select name='n_obj' style='width:70px;'>";
	$out_str.="<option value='' >все</option>";
	while ($res1=mysql_fetch_row($result1))
	{
	if ($res1[0]==$obj) $selectItem='selected'; else $selectItem='';
	 if ($res1[0]==-1)  $out_str.= "	<option value='".$res1[0]."' ".$selectItem.">УСПД</option>";
	 else $out_str.= "	<option value='".$res1[0]."' ".$selectItem.">".$res1[0]."</option>";
	}
	$out_str.="</select>";
	echo '<script>var str="";str="'.$out_str.'";filter_object.innerHTML=str;</script>';
	echo "\n<tr>\n";
	echo "<td class='x23' width='50'>&nbsp;№</td>\n";
	echo "<td class='x23' width='150'>время события\n";
	echo "</td>\n";
	echo "<td class='x23' width='70'>объект\n";
	echo "</td>\n";
	echo "	<td class='x23' width='400'>Событие</td>\n";
	echo "	</tr>\n";
	if ($obj<>"") $add_str=" where n_obj=".$obj." ";else $add_str=" ";
	if ($dt<>"")
	 {
	  if ($add_str==" ") $add_str=" where DATE_FORMAT(on_date_time,'%d.%m.%Y')='".$dt."' "; 
	  else $add_str.=" and DATE_FORMAT(on_date_time,'%d.%m.%Y')='".$dt."' ";
	 }
	$max_record=0;$n_bk=0;$n_fw=0;$n_qbk=0;$n_qfw=0;$step=20;
	$result=mysql_query("select count(*) from arch_uspd ".$add_str." ");
	$res=mysql_fetch_array($result,MYSQL_NUM);
	 $max_record=$res[0];
	$num=0;
	 $result=mysql_query("select idx,DATE_FORMAT(on_date_time,'%d.%m.%Y %H:%i:%s'),event_text,n_obj,link_adr from arch_uspd ".$add_str." order by idx desc limit ".$cursor.",".$step." ");
     while ($res=mysql_fetch_array($result,MYSQL_NUM))
	 {$num++;
	 if ($res[3]==-1)	 $text="<tr><td class='x22' style='text-align:center;'>".($cursor+$num)."</td>
	 <td class='x22' style='text-align:center;'>".$res[1]."</td>
	 <td class='x22' style='text-align:center;'>[". sprintf("%03d",$res[3])."/".sprintf("%03d",$res[4])."]&nbsp;</td>
	 <td class='x22' style='text-align:left;'>".$res[2]."</td></tr>\n";
	 else $text="<tr><td class='x22' style='text-align:center;'>".($cursor+$num)."</td>
	 <td class='x22' style='text-align:center;'>".$res[1]."&nbsp;</td>
	 <td class='x22' style='text-align:center;'>[". sprintf("%03d",$res[3])."/".sprintf("%03d",$res[4])."]&nbsp;</td>
	 <td class='x22' style='text-align:left;'>".$res[2]."&nbsp;</td></tr>\n";
	 writeEvent($text);
	}
mysql_close();
 }	
?>
	</table>
	</td>
	<td>
	 <table>
<?
$begin=0; 
$n_fw=$cursor-$step; if ($n_fw<0) $n_fw=$begin;
$n_bk=$cursor+$step; if ($n_bk>($max_record-$step)) $n_bk=$max_record-$step;
$n_qfw=$cursor-$step*4; if ($n_qfw<0) $n_qfw=$begin;
$n_qbk=$cursor+$step*4; if ($n_qbk>($max_record-$step*5)) $n_qbk=$max_record-$step;
$end=$max_record-$step; //if ($end<0) $end=$max_record+$end;
//===========================================================================
$width=32;$height=32;
$path='images/navigate/';
$direct_fw='up';$direct_bk='down';
if ($cursor==$begin) 
{ $img_fw=$direct_fw.'1_b';  $str_fw='<img src="'.$path.''.$img_fw.'.gif"  alt="вперед +'.$step.'" width="'.$width.'" height="'.$height.'" border="0">';} 
else 
{ $img_fw=$direct_fw.'1_a'; $str_fw='<a href="?tab='.$tab.'&next='.$n_fw.'&n_obj='.$obj.'&dt='.$dt.'" ><img src="'.$path.''.$img_fw.'.gif"  alt="вперед +'.$step.'" width="'.$width.'" height="'.$height.'" border="0"></a>';} 
if ($n_qfw==$begin) 
{$img_qfw=$direct_fw.'2_b'; $str_qfw='<img src="'.$path.''.$img_qfw.'.gif" alt="вперед +'.($step*5).'" width="'.$width.'" height="'.$height.'" border="0">';}
else 
{ $img_qfw=$direct_fw.'2_a'; $str_qfw='<a href="?tab='.$tab.'&next='.($n_qfw).'&n_obj='.$obj.'&dt='.$dt.'" ><img src="'.$path.''.$img_qfw.'.gif" alt="вперед +'.($step*5).'" width="'.$width.'" height="'.$height.'" border="0"></a>';}
if ($cursor==$begin) 
{$img_beg=$direct_fw.'3_b';  $str_beg='<img src="'.$path.''.$img_beg.'.gif" alt="в начало" width="'.$width.'" height="'.$height.'" border="0">';}
else 
{ $img_beg=$direct_fw.'3_a'; $str_beg='<a href="?tab='.$tab.'&next='.$begin.'&n_obj='.$obj.'&dt='.$dt.'" ><img src="'.$path.''.$img_beg.'.gif" alt="в начало" width="'.$width.'" height="'.$height.'" border="0"></a>';} 
if ($cursor==$end) 
{ $img_bk=$direct_bk.'1_b';  $str_bk='<img src="'.$path.''.$img_bk.'.gif" alt="назад -'.$step.'" width="'.$width.'" height="'.$height.'" border="0">';} 
else 
{ $img_bk=$direct_bk.'1_a'; $str_bk='<a href="?tab='.$tab.'&next='.$n_bk.'&n_obj='.$obj.'&dt='.$dt.'" ><img src="'.$path.''.$img_bk.'.gif" alt="назад -'.$step.'" width="'.$width.'" height="'.$height.'" border="0"></a>';} 
if ($n_qbk==$end) 
{ $img_qbk=$direct_bk.'2_b'; $str_qbk='<img src="'.$path.''.$img_qbk.'.gif" alt="назад -'.($step*5).'"width="'.$width.'" height="'.$height.'" border="0">';}  
else 
{ $img_qbk=$direct_bk.'2_a'; $str_qbk='<a href="?tab='.$tab.'&next='.($n_qbk).'&n_obj='.$obj.'&dt='.$dt.'" ><img src="'.$path.''.$img_qbk.'.gif" alt="назад -'.($step*5).'"width="'.$width.'" height="'.$height.'" border="0"></a>';} 
if ($cursor==$end) 
{ $img_end=$direct_bk.'3_b';  $str_end='<img src="'.$path.''.$img_end.'.gif" alt="в конец"  width="'.$width.'" height="'.$height.'" border="0">';} 
else 
{ $img_end=$direct_bk.'3_a'; $str_end='<a href="?tab='.$tab.'&next='.$end.'&n_obj='.$obj.'&dt='.$dt.'" ><img src="'.$path.''.$img_end.'.gif" alt="в конец"  width="'.$width.'" height="'.$height.'" border="0"></a>';}
//==========================================================================
echo "	<td>\n";
echo "	 <table>\n";
echo "	<tr><td height='50'>&nbsp;</td></tr>\n"; 
echo "	<tr><td>".$str_beg."</td></tr>\n"; 
echo "	<tr><td>".$str_qfw."</td></tr>\n";
echo "	<tr><td>".$str_fw."</td></tr>\n"; 
echo "	<tr><td height='150'>&nbsp;</td></tr>\n"; 
echo "	<tr><td>".$str_bk."</td></tr>\n"; 
echo "	<tr><td>".$str_qbk."</td></tr>\n"; 
echo "	<tr><td>".$str_end."</td></tr>\n"; 
echo "	 </table>\n";
echo "	</td>\n";
echo "</tr>\n";
echo "</table>\n";
?>
</td></tr></table>
</td></tr></table>
</td></tr></table>
</div>
<?
if ($n_obj=='') $f1='n'; else $f1=$n_obj;
if ($dt=='') $f2='n'; else $f2=$dt;
echo "<div id='activator' ONCLICK=ToXls('TB',5,".$cursor.",".($cursor+20).",'".$f1."','".$f2."','',0)></div>\n"; 
?>
<script language="VBScript" src="js/excel_export.vbs">
<!-- 
// --> 
</script>
</body>
</html>
