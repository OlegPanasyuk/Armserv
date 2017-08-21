<html xmlns:v="urn:schemas-microsoft-com:vml">
 
<head>
	<title>График получасовых нагрузок</title>
	<link href="css/gist1.css" rel="stylesheet" type="text/css">
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
	<meta http-equiv="Cache-Control" content="no-cache"/>
	<BASE target="frSheet">
<style>
	v\:* { behavior: url(#default#VML); }
	.shape {behavior:url(#default#VML);}
</style>
	<style media="print">
	.help
	{display:none;font-size:10px;}
	.c21
	{
		border: none;
		font-size: 12px;
		font-weight: 600;
		height: 15px;
		width: 15px;
		text-align :right;
		margin-left : -10px;
		position: absolute;
		top:455;
		cursor: hand;
		background-color: transparent;
		z-index: +1;
		font-family: Arial, Helvetica, sans-serif;
    }		
	</style>
	<style media="screen">
	.help
	{display:inline;font-size:10px;}
	.c21
	{
		border: none;
		font-size: 12px;
		font-weight: 600;
		height: 15px;
		width: 15px;
		text-align :right;
		margin-right : 2px;
		position: absolute;
		top:455;
		cursor: hand;
		background-color: transparent;
		z-index: +1;
		font-family: Arial, Helvetica, sans-serif;
	}
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
echo "<script language=\"JavaScript1.2\" src=\"js/control_g1.js\"></script>";
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
	$('.help').tabSlideOut({							//Љласс панели
		tabHandle: '.handle',						//Љласс кнопки
		pathToTabImage: '1/contacts.png',				//Џуть к изображению кнопки
		imageHeight: '138px',						//‚ысота кнопки
		imageWidth: '40px',						//ирина кнопки
		tabLocation: 'right',						//ђасположение панели top - выдвигаетсЯ сверху, right - выдвигаетсЯ справа, bottom - выдвигаетсЯ снизу, left - выдвигаетсЯ слева
		speed: 300,								//‘корость анимации
		action: 'click',								//Њетод показа click - выдвигаетсЯ по клику на кнопку, hover - выдвигаетсЯ при наведении курсора
		topPos: '35%',							//Ћтступ сверху
		fixedPosition: false						//Џозиционирование блока false - position: absolute, true - position: fixed
	});
});
</script>
</head>

<body id="g1" topmargin=0 marginheight=0 marginwidth=0 scroll="auto" onload="startIncrement();" background=tree/imgs/fon.gif>
<div id="padding" style="height:40px;" class="help"></div>
<div id="content">
<?
echo "
<script language=\"JavaScript1.2\">
	if (window.parent.toc.ntype)
	{
	 node=window.parent.toc.ntype.value;
     if (node<2) {
	  legenda.innerHTML='<span style=\"color:black;font-size:10px;\">вывод данных по объекту:</span> ';
	  formatData.style.display='none';
	 }
	 else {
			legenda.innerHTML=' <span style=\"color:black;font-size:10px;\">(выберите счетчик)</span>';
			formatData.style.display='none';
			content.innerHTML='';
		}
	}	
</script>";
?>
<?php
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
if (!isset($date_)) $date_=$dc;
if (!isset($pwr)) $pwr=$disp;
if (!isset($nrg)) $nrg=$type;

$TIME_START = getmicrotime(); 
if (isset($date_) and isset($uid) and isset($n_obj) and isset($adr) and isset($pwr) and isset($nrg) and ($node<2)  )
{
list ($ac_day,$ac_month,$ac_year) = explode (".",$date_);
$date_header='за '.$ac_day.'.'.$ac_month.'.'.$ac_year;
$date_=$ac_year.'-'.$ac_month.'-'.$ac_day;

	echo "<script>";
	echo "window.document.forms[0].dc.value='$dc';";
	echo "window.document.forms[0].iname.value='$name';";
	echo "window.document.forms[0].id.value='$uid';";
	echo "window.document.forms[0].pid.value='$pid';";
	echo "window.document.forms[0].lid.value='$lid';";
	echo "window.document.forms[0].node.value='$node';";
	echo "window.document.forms[0].disp.value='$disp';";
	echo "window.document.forms[0].type.value='$type';";
	echo "formatData.style.display='inline';";
	echo "</script>";
	$znach= array();$flag = array();$cnt = array();
	$int_val=0;	$int_val2=0; $maxind=0;$counter=0;$time='24:00';$color='blue';
	$PowerMax=0;$EnergyFull=0; 
	$rangePower="к"; $isLowPower=1; $format="%01.".$prec."f"; //$format="%01.2f"; 
	function incrementProgressBar()
	{
	 global $count;
	 $count++;
	 echo "<script language=\"JavaScript\">incrementProgressBar();</script>\n";
	 return $count;
	}
	
include("include/mysql.php"); //  Соединяемся с БД
	
	showTitle($uid,$n_obj,$adr,$pwr,$nrg);
$count=incrementProgressBar();
$count=incrementProgressBar();
	calcData($uid,$n_obj,$adr,$table,$pwr,$nrg,$date_);
$count=incrementProgressBar();
$count=incrementProgressBar();
	calcSumData($uid,$n_obj,$adr,$table,$pwr,$nrg,$date_);
$count=incrementProgressBar();
$count=incrementProgressBar();
	drawGrid($pwr,$nrg,$int_val,$int_val2);
$count=incrementProgressBar();
$count=incrementProgressBar();
	drawScale($pwr,$nrg,$int_val,$int_val2,$maxind);
	
mysql_close();	
}
//=================================================================================================================
function showTitle($uid,$n_obj,$adr,$pwr,$nrg)
{
 global $izmtype; global $name; global $pname; global $znum;
 if ($pwr==1) $result=mysql_query("select pwr,descript FROM IZM_TYPE WHERE izm_type=".$nrg."  ");
 else $result=mysql_query("select nrj,descript FROM IZM_TYPE WHERE izm_type=".$nrg."  ");
    while ($res=mysql_fetch_array($result,MYSQL_NUM))
	{$izmtype =$res[0].' '.$res[1];}
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
	 $izm_str=$res[0];	
	 $name=$res[1]; 
	 $type_izm = explode (",",$izm_str);  
	 $ctype=$res[3]; 
	 $ktr=$res[4];
	 if ($n_type==0) {if ($ctype==0 or $ctype==-1 or $ctype==-2) {$znum= "номер счетчика ".$res[2];$zn=$res[2];} }
	 else {$znum=""; $zn="";}
	} 
//==========================================================================================================================
}
function calcData($uid,$n_obj,$adr,$table,$pwr,$nrg,$date_)
{
global $counter; global $format;
 $result1=mysql_query("select znach,flag,end_int,".$table.".inter_val   FROM ".$table.",intervals WHERE ".$table.".data='".$date_."'  AND n_obj=".$n_obj." AND link_adr=".$adr." AND izm_type=".$nrg." AND ".$table.".inter_val = intervals.inter_val ORDER BY ".$table.".inter_val");

$i=0;$tmp=0;
global $znach;global $flag;global $cnt;
global $int_val;	global  $int_val2;global $time;

 if ($pwr==1)	
  {//считаем мощность
	 while ($res1=mysql_fetch_array($result1,MYSQL_NUM))
      {
		 $value = $res1[0];  $time=$res1[2];
		 $i++;	if ($i==1) 	$int_val = $res1[3]-1;$int_val2 = $res1[3];
		 $znach[$int_val2]=sprintf($format,$value*2);
		 $flag[$int_val2] = $res1[1];
		 if ($i%4==0) echo '<script language="JavaScript">incrementProgressBar();</script>';
	  }
  }	  

 else 
  {//считаем энергию
	 while ($res1=mysql_fetch_array($result1,MYSQL_NUM))
      {
		 $value = $res1[0];  $time=$res1[2];
		 $i++;	if ($i==1) 	$int_val = $res1[3]-1;$int_val2 = $res1[3];
		 $znach[$int_val2]=sprintf($format,$value);
		 $flag[$int_val2] = $res1[1];
		 if ($i%4==0) echo '<script language="JavaScript">incrementProgressBar();</script>';
	  }
  }	  
    $counter=round($i/2)+$int_val;
 }

//********************************************************************************************************************************
function CalcSumData($uid,$n_obj,$adr,$table,$pwr,$nrg,$date_)
{
global  $PowerMax; 
global  $maxind; 
global  $EnergyFull; 
	$result=mysql_query("Select MAX(".$table.".znach) As mx, ".$table.".inter_val From ".$table.", intervals Where ".$table.".data='".$date_."'  AND ".$table.".n_obj=".$n_obj." AND link_adr=".$adr." AND ".$table.".izm_type=".$nrg." AND ".$table.".inter_val = intervals.inter_val AND intervals.max_zone>2 Group By ".$table.".inter_val Order By mx");
    while ( $res=mysql_fetch_array($result,MYSQL_NUM))
	 {
	    $PowerMax=$res[0]; 
		$maxind=$res[1];
	 }
	$result2=mysql_query("select SUM(znach),MAX(flag) FROM ".$table." WHERE ".$table.".data='".$date_."' AND n_obj=".$n_obj." AND link_adr=".$adr."  AND izm_type=".$nrg." ");
    while ($res2=mysql_fetch_array($result2,MYSQL_NUM)) 
	 {
		$EnergyFull = $res2[0];
	 }
}

function drawGrid($pwr,$nrg,$int_val,$int_val2)
{
global $znach; global $flag;
global $isLowPower; global $rangePower; global $prec; global $format;
 global $izmtype; global $name; global $pname; global $znum;
global $date_;global $date_header;global $color;global $time;global $node;
	echo '<script language="JavaScript">incrementProgressBar();</script>';
	$result4=mysql_query("select * from seasons_hint order by n_season");
	if ($node==-2)
	{//если нужно считать по сезонам
		if ($result4)
		{
		 	while ($res4=mysql_fetch_array($result4,MYSQL_NUM))
			{
			 list ($ac_year,$ac_month,$ac_day) = explode ("-",$date_);
			 $begin_date[$res4[0]-1]=mktime (0,0,0, $res4[2], $res4[1], $ac_year);
			 $end_date[$res4[0]-1]=mktime (0,0,0, $res4[4], $res4[3], $ac_year);
		 	}	
		 }				 
		 $curdate=str2date($date_);
		 if ($curdate>=$begin_date[1] and $curdate<=$end_date[1])
			  {$isHeatSeason="Лето";$seas=2;} 
		 else {$isHeatSeason="Зима";$seas=1;}
	 }//=============== формирование сетки  ===============================
	echo '<div style="margin-top:15px;text-align:center;position:absolute;z-index:-1;width:100%;"><v:textbox id="nazv" style="font-size:12px;font-weight:bolder;">'.$pname.'&nbsp;'.$name.'&nbsp; '.$znum.'<br>'.$izmtype.'  '.$date_header.'&nbsp;</v:textbox><v:textbox id="timer" style="font-size:12px;font-weight:bolder;">'.$time.'</v:textbox></div>
	<v:group id="myDiv" editas="canvas" style="margin-top:5;margin-left:5" style="width:720px;height:370px;" coordorigin="0,0" coordsize="760,450">';
	echo '<v:rect id="rect0" strokecolor="black" strokeweight="1px" fillcolor = "#eaeaea" style="position:absolute;left:50;top:55;width:5;height:425;z-index:-1">	<v:extrusion on=True backdepth="12" foredepth="12"/></v:rect>';
	for ($i=0;$i<=20;$i++)
	{
	 drawLine(35,483-$i*20,45,483-$i*20,"black",1,"solid");
	 drawLine(45,483-$i*20,62,468-$i*20,"black",1,"dot");
	 drawLine(62,468-$i*20,810,468-$i*20,"black",1,"dot");
	}
	if ($isLowPower==1)  {$rangePower="к";$format="%01.".$prec."f";} else {$rangePower=" ";$format="%0.0f";}
	if (!isset($isLowPower)) $rangePower="к";
	echo '<script language="JavaScript">incrementProgressBar();</script>';
	if (count($znach)>0) {$minim=min($znach);$maxim=max($znach);$isLowPower=legend($pwr);}
//=============================================--прорисовка столбцов--======================================================
	if ($int_val>0)//нет данных в начале дня
	{
		for ($num=1;$num<=($int_val);$num++)
		{
		if ($node==-1)	$result=mysql_query("select zones.n_zone,gist_color from zones, intervals where inter_val=".$num." and intervals.heat_zone=zones.n_zone");
		else if ($node==-2)
		 {
		  if ($seas==1)	 
		  {
		   if ($nrg==2) $result=mysql_query("select zones.n_zone,gist_color from zones, intervals where inter_val=".$num." and intervals.winter_zone=zones.n_zone");
		   else
		   {
		    if ($pwr==1)  $result=mysql_query("select zones.n_zone,gist_color from zones, intervals where inter_val=".$num." and intervals.max_zone=zones.n_zone");
		    else	  	   $result=mysql_query("select zones.n_zone,gist_color from zones, intervals where inter_val=".$num." and intervals.n_zone=zones.n_zone");
		   }
		  }
		  else if ($seas==2)
		  {
		  	if ($nrg==2) $result=mysql_query("select zones.n_zone,gist_color from zones, intervals where inter_val=".$num." and intervals.summer_zone=zones.n_zone");
		    else
		    {
		     if ($pwr==1)  $result=mysql_query("select zones.n_zone,gist_color from zones, intervals where inter_val=".$num." and intervals.max_zone=zones.n_zone");
		     else	  	   $result=mysql_query("select zones.n_zone,gist_color from zones, intervals where inter_val=".$num." and intervals.n_zone=zones.n_zone");
		    }
		  }
		 }//END  else if ($node==-2)
		else
		{
		 if ($pwr==1)  $result=mysql_query("select zones.n_zone,gist_color from zones, intervals where inter_val=".$num." and intervals.max_zone=zones.n_zone");
		 else	  	   $result=mysql_query("select zones.n_zone,gist_color from zones, intervals where inter_val=".$num." and intervals.n_zone=zones.n_zone");
		}
		 if ($res=mysql_fetch_array($result,MYSQL_NUM))	
		 {		  $zona=$res[0];	$color=$res[1];	 }
		 $znach[$num]=0;  $height=0;	$top=478; $flag[$num]="^";
		 $k1=44;$k2=15.5;
		 drawBar(($int_val+1),$format,$znach[$num],$isLowPower,$k1,$k2,$num,$top,$height,$width,$color);
		}
	}	
	for ($num=($int_val+1);$num<=$int_val2;$num++)//есть данные
		{
		if ($node==-1)	$result=mysql_query("select zones.n_zone,gist_color from zones, intervals where inter_val=".$num." and intervals.heat_zone=zones.n_zone");
		else if ($node==-2)
		 {
		  if ($seas==1)	 
		  {
		   if ($nrg==2) $result=mysql_query("select zones.n_zone,gist_color from zones, intervals where inter_val=".$num." and intervals.winter_zone=zones.n_zone");
		   else
		   {
		    if ($pwr==1)  $result=mysql_query("select zones.n_zone,gist_color from zones, intervals where inter_val=".$num." and intervals.max_zone=zones.n_zone");
		    else	  	   $result=mysql_query("select zones.n_zone,gist_color from zones, intervals where inter_val=".$num." and intervals.n_zone=zones.n_zone");
		   }
		  } 
		  else if ($seas==2)
		  {
		   if ($nrg==2) $result=mysql_query("select zones.n_zone,gist_color from zones, intervals where inter_val=".$num." and intervals.summer_zone=zones.n_zone");
		   else
		   {
		    if ($pwr==1)  $result=mysql_query("select zones.n_zone,gist_color from zones, intervals where inter_val=".$num." and intervals.max_zone=zones.n_zone");
		    else	  	   $result=mysql_query("select zones.n_zone,gist_color from zones, intervals where inter_val=".$num." and intervals.n_zone=zones.n_zone");
		   }
		  }	
		 } 
		else
		{
		 if ($pwr==1)  $result=mysql_query("select zones.n_zone,gist_color from zones, intervals where inter_val=".$num." and intervals.max_zone=zones.n_zone");
		 else	  	   $result=mysql_query("select zones.n_zone,gist_color from zones, intervals where inter_val=".$num." and intervals.n_zone=zones.n_zone");
		}
		 if ($res=mysql_fetch_array($result,MYSQL_NUM))	
		 {		  $zona=$res[0];	$color=$res[1];	 }
//========================================================================================================
		 
		 if ($znach[$num]>0)
		 { 
             if (($maxim>0) and ($minim<0))
				{
				 	$height=abs($znach[$num]*400/($maxim-$minim));	
					$top=(76+404/($maxim-$minim)*$maxim)-abs($znach[$num]*404/($maxim-$minim));
				} 
                if (($maxim>0) and ($minim>=0))
				 {
				  $height=$znach[$num]*407/($maxim+0.0001);		
				  $top=480-$znach[$num]*406/($maxim);
				 }
		 }
		 //else { $height=0;	$top=478; }
		 if ($znach[$num]<0)
		  {
   			 if (($maxim>0)and($minim<0))
			     {
  			 	   $height=abs($znach[$num]*404/($maxim-$minim));
				   $top=(74+404/($maxim-$minim)*$maxim);
				 } 
                if (($maxim<0)and($minim<0))
			     {
				  $height=$znach[$num]*401/($minim);
				  $top=76;
				 } 		  
		  }
		  if ($znach[$num]==0) 
		 { 
		   if ($maxim<=0)
		   {$height=0;	$top=76; }
		   if ($minim>=0)
		   { $height=0;	$top=478; }
		 }  
//========================================================================================================

		 $k1=44;$k2=15.5;
		 drawBar($num,$format,$znach[$num],$isLowPower,$k1,$k2,$num,$top,$height,$width,$color);
		}

		$max_col_num=48;
		if ($int_val2<$max_col_num)//нет данных в конце дня
		for ($num=($int_val2+1);$num<=$max_col_num;$num++)
		{
		if ($node==-1)	$result=mysql_query("select zones.n_zone,gist_color from zones, intervals where inter_val=".$num." and intervals.heat_zone=zones.n_zone");
		else if ($node==-2)
		 {
		  if ($seas==1)
		  {
		  	if ($nrg==2) $result=mysql_query("select zones.n_zone,gist_color from zones, intervals where inter_val=".$num." and intervals.winter_zone=zones.n_zone");
		    else
		    {
		     if ($pwr==1)  $result=mysql_query("select zones.n_zone,gist_color from zones, intervals where inter_val=".$num." and intervals.max_zone=zones.n_zone");
		     else	  	   $result=mysql_query("select zones.n_zone,gist_color from zones, intervals where inter_val=".$num." and intervals.n_zone=zones.n_zone");
		    }
		  }	 
		  else if ($seas==2)
		  {
		    if ($nrg==2)  $result=mysql_query("select zones.n_zone,gist_color from zones, intervals where inter_val=".$num." and intervals.summer_zone=zones.n_zone");
		    else
		    {
		     if ($pwr==1)  $result=mysql_query("select zones.n_zone,gist_color from zones, intervals where inter_val=".$num." and intervals.max_zone=zones.n_zone");
		     else	  	   $result=mysql_query("select zones.n_zone,gist_color from zones, intervals where inter_val=".$num." and intervals.n_zone=zones.n_zone");
		    }
		  }	 
		 } 
		else
		{
		 if ($pwr==1)  $result=mysql_query("select zones.n_zone,gist_color from zones, intervals where inter_val=".$num." and intervals.max_zone=zones.n_zone");
		 else	  	   $result=mysql_query("select zones.n_zone,gist_color from zones, intervals where inter_val=".$num." and intervals.n_zone=zones.n_zone");
		}
		 if ($res=mysql_fetch_array($result,MYSQL_NUM))	
		 {		  $zona=$res[0];	$color=$res[1];	 }
		 $znach[$num]=0;  $height=0;	$top=478; $flag[$num]="^";
		 $k1=44;$k2=15.5;$width=15;
		 drawBar($int_val2,$format,$znach[$num],$isLowPower,$k1,$k2,$num,$top,$height,$width,$color);
		}
	echo '<script language="JavaScript">incrementProgressBar();</script>';
	echo '<v:rect fillcolor = "#eaeaea" style="z-index:-1;position:absolute;width:755;height:2;left:55;top:476" strokecolor="black" strokeweight="1px"><v:extrusion on=True backdepth="12" foredepth="28" skewangle="-133" style="top:470"/></v:rect>';
	echo '<v:rect fillcolor = "#eaeaea" style="z-index:-1;position:absolute;width:754;height:420;left:60;top:50;" strokecolor="black" strokeweight="1px"/>';
   if (($maxim>0) and ($minim<0))
   {
	drawLine(62,58+420/($maxim-$minim)*$maxim,815,58+420/($maxim-$minim)*$maxim,"red",3,"solid");
	$rectTop=65+420/($maxim-$minim)*$maxim;
	echo '<v:rect id="hiddenScale" fillcolor = "#eaeaea" style="z-index:0;position:absolute;width:750;height:2;left:55;top:'.$rectTop.';visibility:visible" strokecolor="black" strokeweight="8px">
	<v:extrusion on=True render="wireframe"	backdepth="16" foredepth="16" skewangle="-133" />
	</v:rect>';
   }
	echo '</v:group> ';
	echo '<script language="JavaScript">incrementProgressBar();</script>';
}
function drawScale($pwr,$nrg,$int_val,$int_val2,$maxind)
{
	global $flag;
	echo '<v:group id="myDiv2" editas="canvas" style="z-index:+10;position:absolute;margin-top:-40px;left:-1px;width:720px;height:16px;" coordorigin="0,0" coordsize="720,16" filled="t" fillcolor="yellow">';
	$click_num=0;
	 for ($i=1;$i<=48;$i++)
	 {
	  if ($i==$int_val2) $cursor_color="yellow"; else $cursor_color="transparent"; 
	  if ($i==$maxind) $max_color="red"; else $max_color="transparent";
	  if ($click_num<$int_val2) $click_num++;
	  if ($int_val>0 and $i<=$int_val) $clicker=$int_val+1; else $clicker=$click_num;
	   if ($i%2==0) {echo '<div class="c21" onclick="selected('.$clicker.')" style="left:'.(64+14.7*($i-1)).';background-color:'.$max_color.'"><v:textbox id="t'.$i.'" class="text2" style="background-color:'.$cursor_color.'">'.($i/2).' </v:textbox></div>';echo "\n";}
	   else 		{echo '<div class="c21" onclick="selected('.$clicker.')" style="left:'.(64+14.7*($i-1)).';background-color:'.$max_color.'"><v:textbox id="t'.$i.'" class="text2" style="background-color:'.$cursor_color.'">|</v:textbox></div>';echo "\n";}
	 } 
	 echo '</v:group>'; 
} 

function drawBar($select,$format,$znach,$isLowPower,$k1,$k2,$num,$top,$height,$width,$color)//рисуем столбец гистограммы
{
 echo '<div onclick="selected('.$select.')" class="bar" title="'.sprintf($format,$znach*$isLowPower).'" id="'.$num.'_'.$color.'"><v:rect class="col" style="left:'.($k1+$k2*$num).';top:'.$top.';height:'.$height.';width:'.$width.'px;z-index:1;" ><v:fill angle="0" focus="100%" color="'.$color.'" color2="fill lighten(50)" type="gradient" method="sigma"/> <v:extrusion on="t" backdepth="14" foredepth="14"  /></v:rect></div>';
 echo "\n";
}

function drawPodpis($width,$height,$top,$left,$string)
{
 echo ' <v:shape type="#t202" style="z-index:+9;position:absolute;top:'.($top-5).';left:'.($left-30).';width:'.$width.'; height:'.$height.';" filled="f" fillcolor="#ffffcc" stroked="f">
   <v:textbox inset="0mm,,0mm">
     <div style="color:red;text-align:right;font-size:10px;">	 <b> '.$string.'</b>     </div>
	</v:textbox>
 </v:shape>';
}

function drawLine($startx, $starty, $endx, $endy, $color,$weight,$dashstyle)//рисование сетки
{
 echo '<v:line  style="position:absolute;" from="'.$startx.','.$starty.'" to="'.$endx.','.$endy.'" strokecolor="'.$color.'" strokeweight="'.$weight.'pt">';
 echo ' <v:stroke dashstyle="'.$dashstyle.'"/>';
 echo ' </v:line>';
}

function legend($isPower)//рисование вертикальной динамической шкалы
{
 $high=0;	 $title_kf=1;
 global $znach;  global $nrg;
if (count($znach)==0) return;
		if ((max($znach)>0) and (min($znach)<0))		$high=max($znach)-min($znach);
		if ((max($znach)>0) and (min($znach)>=0))		$high=max($znach);
		if ((max($znach)<=0) and (min($znach)<0))		$high=abs(min($znach));
  if (max($znach)>=0)
  {
//   echo "1<br>";
   if ($high>=20)
   {
//   echo "2<br>";
	 $title_kf=1;
     echo '<v:shape class="shape" style="z-index:+3;position:absolute;left:5;width:20;height:40;top:43;left:0;" > <v:textbox id="lable" class="text">';
	 if ((($isPower==1) and ($nrg==1)) or(($isPower==1) and ($nrg==2)))	
		{
			echo 'кВт';
		}
	 else if ((($isPower==1) and ($nrg==3)) or(($isPower==1) and ($nrg==4))) 
		{
			echo 'квар';
		}
	if ((($isPower==2) and ($nrg==1)) or(($isPower==2) and ($nrg==2)))	
		{
			echo 'кВт*ч';
		}
	 else if ((($isPower==2) and ($nrg==3)) or(($isPower==2) and ($nrg==4))) 
		{
			echo 'квар*ч';
		}	
	 echo'</v:textbox></v:shape>';
      if (min($znach)>=0)
	  {
//   echo "3<br>";
	   for ($i=20;$i>=0;$i--)
   		{
		 $text=round($i*$high/20);  $top=470-$i*20;
	     echo '<v:shape id="s'.$i.'" class="shape" style="left:-15;top:'.$top.'"> <v:textbox id="L'.($i+1).'" class="text">'.$text.'</v:textbox> </v:shape>';
	    }
	  }
	  else //if (min($znach)<0)
	  {
//   echo "4<br>";
	   for ($i=20;$i>=0;$i--)
   		{
		 $text=round($high+min($znach)- (20-$i)*$high/20);  
		 $top=470-$i*20;
	     echo '<v:shape id="s'.$i.'" class="shape" style="left:-15;top:'.$top.'"> <v:textbox id="L'.($i+1).'" class="text">'.$text.'</v:textbox> </v:shape>';
	    }
	  }
    }
    else //if (max($znach)<20)
    {
//   echo "5<br>";
     $title_kf=1;
     echo '<v:shape class="shape" style="z-index:+3;position:absolute;left:5;width:20;height:40;top:43;left:0;" > <v:textbox id="lable" class="text">';
	 if ((($isPower==1) and ($nrg==1)) or(($isPower==1) and ($nrg==2)))	
		{
			echo 'Вт';
		}
	 else if ((($isPower==1) and ($nrg==3)) or(($isPower==1) and ($nrg==4))) 
		{
			echo 'вар';
		}
	if ((($isPower==2) and ($nrg==1)) or(($isPower==2) and ($nrg==2)))	
		{
			echo 'Вт*ч';
		}
	 else if ((($isPower==2) and ($nrg==3)) or(($isPower==2) and ($nrg==4))) 
		{
			echo 'вар*ч';
		}	
	 echo'</v:textbox></v:shape>';
     if (min($znach)>=0)
	  {
//   echo "6<br>";
	   for ($i=20;$i>=0;$i--)
   		{
		 $text=round($i*$high*50,0)*$title_kf;  $top=470-$i*20;
	     echo '<v:shape id="s'.$i.'" class="shape" style="left:-15;top:'.$top.';text-align:left;"> <v:textbox id="L'.($i+1).'" class="text" style="text-align:left;">'.$text.'</v:textbox> </v:shape>';
	    }
	  }
	  else //if (min($znach)<0)
	  {
//   echo "7<br>";
	   for ($i=20;$i>=0;$i--)
   		{
		 $text=(round($high+min($znach)- (20-$i)*$high/20))*$title_kf;  
		 $top=470-$i*20;
	     echo '<v:shape id="s'.$i.'" class="shape" style="left:-15;top:'.$top.';text-align:left;"> <v:textbox id="L'.($i+1).'" class="text" style="text-align:left;">'.$text.'</v:textbox> </v:shape>';
	    }
	  
	  }
    }
 }
 else //if (max($znach)<0)
 {
//   echo "8<br>";
	 $title_kf=1;
     echo '<v:shape class="shape" style="z-index:+3;position:absolute;left:5;width:20;height:40;top:43;left:0;" > <v:textbox id="lable" class="text">';
	 if ($isPower==1) echo 'КВт'; else echo 'КВт*ч';
	 echo'</v:textbox></v:shape>';
   if ($high>=20)
		   {
//   echo "9<br>";
		   for ($i=20;$i>=0;$i--)
	   		{
		     $top=70+$i*20;	     $text=round(-$i*$high/20);
		     echo '<v:shape id="s'.$i.'" class="shape" style="left:-15;top:'.$top.'"> <v:textbox id="L'.($i+1).'" class="text">'.$text.'</v:textbox> </v:shape>';
		    }
		   }
		   else 
		   {
//   echo "10<br>";
		     for ($i=0;$i<=0;$i)
   			 {
		      $top=470-$i*20;	     $text=round(-$i*$high/20);
		      echo '<v:shape id="s'.$i.'" class="shape" style="left:-15;top:'.$top.'"> <v:textbox id="L'.($i+1).'" class="text">'.$text.'</v:textbox> </v:shape>';
			 } 
		   }
 }
//end function
return $title_kf;
}

function legend2($isPower)//рисование вертикальной динамической шкалы
{
 $high=0;	 $title_kf=1;
 global $znach;  global $nrg;
if (count($znach)==0) return;
		if ((max($znach)>0) and (min($znach)<0))		$high=max($znach)-min($znach);
		if ((max($znach)>0) and (min($znach)>=0))		$high=max($znach);
		if ((max($znach)<=0) and (min($znach)<0))		$high=abs(min($znach));
  if (max($znach)>=0)
  {
   if (max($znach)>=20)
   {
	 $title_kf=1;
     echo '<v:shape class="shape" style="z-index:+3;position:absolute;left:5;width:20;height:40;top:43;left:0;" > <v:textbox id="lable" class="text">';
	 if ((($isPower==1) and ($nrg==1)) or(($isPower==1) and ($nrg==2)))	
		{
			echo 'кВт';
		}
	 else if ((($isPower==1) and ($nrg==3)) or(($isPower==1) and ($nrg==4))) 
		{
			echo 'квар';
		}
	if ((($isPower==2) and ($nrg==1)) or(($isPower==2) and ($nrg==2)))	
		{
			echo 'кВт*ч';
		}
	 else if ((($isPower==2) and ($nrg==3)) or(($isPower==2) and ($nrg==4))) 
		{
			echo 'квар*ч';
		}	
	 echo'</v:textbox></v:shape>';
      if (min($znach)>=0)
	  {
	   for ($i=20;$i>=0;$i--)
   		{
		 $text=round($i*$high/20);  $top=470-$i*20;
	     echo '<v:shape id="s'.$i.'" class="shape" style="left:-15;top:'.$top.'"> <v:textbox id="L'.($i+1).'" class="text">'.$text.'</v:textbox> </v:shape>';
	    }
	  }
	  else //if (min($znach)<0)
	  {
	   for ($i=20;$i>=0;$i--)
   		{
		 $text=round($high+min($znach)- (20-$i)*$high/20);  
		 $top=470-$i*20;
	     echo '<v:shape id="s'.$i.'" class="shape" style="left:-15;top:'.$top.'"> <v:textbox id="L'.($i+1).'" class="text">'.$text.'</v:textbox> </v:shape>';
	    }
	  }
    }
    else //if (max($znach)<20)
    {
     $title_kf=1000;
     echo '<v:shape class="shape" style="z-index:+3;position:absolute;left:5;width:20;height:40;top:43;left:0;" > <v:textbox id="lable" class="text">';
	 if ((($isPower==1) and ($nrg==1)) or(($isPower==1) and ($nrg==2)))	
		{
			echo 'Вт';
		}
	 else if ((($isPower==1) and ($nrg==3)) or(($isPower==1) and ($nrg==4))) 
		{
			echo 'вар';
		}
	if ((($isPower==2) and ($nrg==1)) or(($isPower==2) and ($nrg==2)))	
		{
			echo 'Вт*ч';
		}
	 else if ((($isPower==2) and ($nrg==3)) or(($isPower==2) and ($nrg==4))) 
		{
			echo 'вар*ч';
		}	
	 echo'</v:textbox></v:shape>';
     if (min($znach)>=0)
	  {
	   for ($i=20;$i>=0;$i--)
   		{
		 $text=round($i*$high*50)*$title_kf;  $top=470-$i*20;
	     echo '<v:shape id="s'.$i.'" class="shape" style="left:-15;top:'.$top.';text-align:left;"> <v:textbox id="L'.($i+1).'" class="text" style="text-align:left;">'.$text.'</v:textbox> </v:shape>';
	    }
	  }
	  else //if (min($znach)<0)
	  {
	   for ($i=20;$i>=0;$i--)
   		{
		 $text=(round($high+min($znach)- (20-$i)*$high/20))*$title_kf;  
		 $top=470-$i*20;
	     echo '<v:shape id="s'.$i.'" class="shape" style="left:-15;top:'.$top.';text-align:left;"> <v:textbox id="L'.($i+1).'" class="text" style="text-align:left;">'.$text.'</v:textbox> </v:shape>';
	    }
	  
	  }
    }
 }
 else //if (max($znach)<0)
 {
	 $title_kf=1;
     echo '<v:shape class="shape" style="z-index:+3;position:absolute;left:5;width:20;height:40;top:43;left:0;" > <v:textbox id="lable" class="text">';
	 if ($isPower==1) echo 'КВт'; else echo 'КВт*ч';
	 echo'</v:textbox></v:shape>';

   if (min($znach)<=-20)
		   {
		   for ($i=20;$i>=0;$i--)
	   		{
		     $top=70+$i*20;	     $text=round(-$i*$high/20);
		     echo '<v:shape id="s'.$i.'" class="shape" style="left:-15;top:'.$top.'"> <v:textbox id="L'.($i+1).'" class="text">'.$text.'</v:textbox> </v:shape>';
		} 
		   }
		   else 
		   {
		     for ($i=0;$i<=0;$i)
   			{
		     $top=470-$i*20;	     $text=round(-$i*$high/20);
		     echo '<v:shape id="s'.$i.'" class="shape" style="left:-15;top:'.$top.'"> <v:textbox id="L'.($i+1).'" class="text">'.$text.'</v:textbox> </v:shape>';
			} 
		   }
 }
//end function
return $title_kf;
}
//********************************************************************************************************************************
?>
<br>
<table id="comment" border="0" cellpadding="0" cellspacing="0" style="margin-top: 5px;margin-left: 30px; position: relative;">
<tr>
	<td style="height:25px">&nbsp;</td>
<? 
if ((($pwr==1) and ($nrg==1)) or(($pwr==1) and ($nrg==2)) or (($pwr==2) and($nrg==1)) or (($pwr==2) and ($nrg==2)))	
echo'<td colspan="4" align="center" valign="bottom"><font style="font-size:12px;font-weight:bolder;">М о щ н о с т ь('.$rangePower.'Вт)</font></td>
    <td colspan="6" align="center" valign="bottom"><font style="font-size:12px;font-weight:bolder;">Э н е р г и я ('.$rangePower.'Вт*ч)</font></td>';
else 
if ((($pwr==1) and ($nrg==3)) or(($pwr==1) and ($nrg==4)) or (($pwr==2) and($nrg==3)) or (($pwr==2) and ($nrg==4)))	
echo'<td colspan="4" align="center" valign="bottom"><font style="font-size:12px;font-weight:bolder;">М о щ н о с т ь('.$rangePower.'вар)</font></td> 
     <td colspan="6" align="center" valign="bottom"><font style="font-size:12px;font-weight:bolder;">Э н е р г и я ('.$rangePower.'вар*ч)</font></td>';


echo'    <td colspan="8" align="center" valign="bottom">&nbsp;</td></tr>';

if ($pwr==1)		
echo '<tr>	<td>&nbsp;</td>	   <td align="center"><font class="podpis">максимум</font></td>
	    <td>&nbsp;</td>    <td align="center"><font class="podpis">за получас</font></td>
 	    <td>&nbsp;</td>    <td align="center"><font class="podpis">за получас</font></td>';
else if ($pwr==2)	echo '	<td>&nbsp;</td>    <td align="center"><font class="podpis">за текущий час</font></td>';
if (($pwr==2) or ($pwr==1))
echo '	<td>&nbsp;</td>    <td align="center"><font class="podpis">с начала суток</font></td>
	<td>&nbsp;</td>    <td align="center"><font class="podpis">за сутки</font></td>
	<td>&nbsp;</td>    <td align="center"><font class="podpis">Время</font></td>
	<td>&nbsp;</td>    <td align="center"><font style="font-size:12px;">&nbsp;</font></td>
	<td>&nbsp;</td>';
?>	
<td rowspan="2" align="center">&nbsp;
	 <form name="navigate" style="display:none;">
	  <input type="button" id="power" name="power" value="Мощность за месяц" style="width:1;height:1;visibility:hidden;" onclick="go_power()">
      <input type="button" id="energy" name="energy" value="Энергия за месяц" style="width:1;height:1;visibility:hidden;" onclick="go_energy()">
	  <input type="button" id="print" name="print" value="Печать" style="width:1;height:1;visibility:hidden;" onclick="go_printer()">
	 </form>
</td>
</tr>
<tr>

<? 
 echo ' <form name="stat">';
 if	($pwr==1)
 echo '<td>&nbsp;</td>			  <td align="center"><input type="text" name="maximum" size=10 class="input" value="'.sprintf($format,$PowerMax*2*$isLowPower).'"></td>
	<td width="10">&nbsp;</td>    <td align="center"><input type="text" name="itogona"  size=10 class="input" value="'.sprintf($format,$znach[$counter*2]*$isLowPower).'"></td>
	<td width="50">&nbsp;</td>    <td align="center"><input type="text" name="itogona2"  size=10 class="input" value="'.sprintf($format,$znach[$counter*2]*$isLowPower/2).'"></td>
	<td width="10">&nbsp;</td>    <td align="center"><input type="text" name="itogodo"   size=10 class="input" value="'.sprintf($format,$EnergyFull*$isLowPower).'"></td>
	<td width="10">&nbsp;</td>    <td align="center"><input type="text" name="itogo" size=10 class="input" value="'.sprintf($format,$EnergyFull*$isLowPower).'"></td>
	<td width="10">&nbsp;</td>    <td align="right"><input type="text" name="time" size=4 class="input" value="'.$time.'">&nbsp;<input type="text" name="zona" disabled="true" style="width:20;height:20;text-align: right;background-color:'.$color.'"></td>';
 else if ($pwr==2)	
{
 $time=sprintf('%01.0f',$counter).':00';
 echo '
	<td width="50">&nbsp;</td>    <td align="center"><input type="text" name="itogona" title="itogona" size=12 class="input" value="'.sprintf($format,$znach[$counter]*$isLowPower).'"></td>
	<td width="30">&nbsp;</td>    <td align="center"><input type="text" name="itogodo" title="itogodo" size=12 class="input" value="'.sprintf($format,$EnergyFull*$isLowPower).'"></td>
	<td width="30">&nbsp;</td>    <td align="center"><input type="text" name="itogo" title="itogo" size=12 class="input" value="'.sprintf($format,$EnergyFull*$isLowPower).'"></td>
	<td width="10">&nbsp;</td>    <td align="right"><input type="text" name="time" size=4 class="input" value="'.$time.'">&nbsp;<input type="text" name="zona" disabled="true" style="width:20;height:20;text-align: right;background-color:'.$color.'"></td>';
}	
 echo '  </form>
</tr>
</table>
<table cellpadding="0" cellspacing="0" style="display:none;">
<tr>
<td>	
	<form name="myform1">
	<input type="hidden" name="maxind" value="'.$maxind.'"><input type="hidden" name="active" value="'.$int_val2.'">
	<input type="hidden" name="format" value="'.$format.'"><input type="hidden" name="isPower" value="'.$pwr.'">
	</form>
</td>
</tr>
</table>';
$TIME_END = getmicrotime();
$TIME_SCRIPT = $TIME_END - $TIME_START; 
if (isset($date_) and isset($uid) and isset($pwr) and isset($nrg) and ($node<2) )
{
 echo "<Script Language=\"JavaScript1.2\" src=\"js/gist1.js\"></script>";
} 
?>
<center>
<span style="color:white;" class="help"><b>.::</b>
Время выполнения запроса <?=number_format($TIME_SCRIPT,3,'.','');?> сек.
<b>::.</b>
</span>
</center>
</div>
</body>
</html>
