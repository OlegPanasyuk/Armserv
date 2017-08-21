<html xmlns:v="urn:schemas-microsoft-com:vml">
 
<head>
	<title>График потребления энергии (по суткам) за месяц</title>
	<link href="css/gist2.css" rel="stylesheet" type="text/css">
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
echo "<script language=\"JavaScript1.2\" src=\"js/control_g2.js\"></script>";
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

<body id="g2" topmargin=0 marginheight=0 marginwidth=0 scroll="auto" onload="startIncrement();" background=tree/imgs/fon.gif>
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
<?php
include("include/mysql.php"); //  Соединяемся с БД
include("util_fun.php");
	$result=mysql_query("select * FROM zones order by n_zone");
    if ($result)
	{
	echo "<script>\n";
	echo "var options= new Array;
	      options[0] = new Option('нет');
		 var optval= new Array;
	      optval[0] = 0;";
	 $text='';
	while ($res=mysql_fetch_array($result,MYSQL_BOTH))
	{
	 echo "
	   options[".$res[0]."] = new Option('".$res[1]."');
	   window.document.topmenu.zone.options[".$res[0]."] = options[".$res[0]."];
	   window.document.topmenu.zone.options[".$res[0]."].value=".$res[0]."";
	 
	}
	 $lastItem=mysql_num_rows($result);	
	 echo "
	   options[".$lastItem."] = new Option('контроль');
	   window.document.topmenu.zone.options[".$lastItem."] = options[".$lastItem."];
	   window.document.topmenu.zone.options[".$lastItem."].value=-1";
	echo "</script>\n";
    }
$name = $_GET["iname"];
$uid = $_GET["id"];
$pid = $_GET["pid"];
$lid = $_GET["lid"];
$node = $_GET["node"];
$dc = $_GET["dc"];
$disp = $_GET["disp"];
$type = $_GET["type"];
$n_zone = $_GET["zone"];
$n_obj = $_GET["nobj"];
$adr = $_GET["adr"];

if (!isset($date_2)) $date_2=$dc;
if (!isset($pwr)) $pwr=$disp;
if (!isset($nrg)) $nrg=$type;
if (!isset($n_zone))  $n_zone=0;
$TIME_START = getmicrotime(); 
if (isset($date_2) and isset($uid) and isset($n_obj) and isset($adr) and isset($pwr) and isset($nrg) and ($node<2))
{
	
list ($ac_day,$ac_month,$ac_year) = explode (".",$date_2);
if (!checkdate($ac_month,$ac_day,$ac_year)) $date_2=date('Y-m-d'); else $date_2=$ac_year.'-'.$ac_month.'-'.$ac_day;
$date_1=$ac_year.'-'.$ac_month.'-01';
$date_header1='01.'.$ac_month.'.'.$ac_year;
$date_header2=$ac_day.'.'.$ac_month.'.'.$ac_year;

	echo "<script>";
	echo "window.document.forms[0].dc.value='$dc';";
	echo "window.document.forms[0].iname.value='$name';";
	echo "window.document.forms[0].id.value='$uid';";
	echo "window.document.forms[0].pid.value='$pid';";
	echo "window.document.forms[0].lid.value='$lid';";
	echo "window.document.forms[0].node.value='$node';";
	echo "window.document.forms[0].disp.value='$disp';";
	echo "window.document.forms[0].type.value='$type';";
	echo "window.document.forms[0].zone.value='$n_zone';";
	echo "formatData.style.display='inline';";
	echo "</script>";
	
	function incrementProgressBar()
	{
	 global $count;
	 $count++;
	 echo "<script language=\"JavaScript\">incrementProgressBar();</script>\n";
	 return $count;
	}
include("include/mysql.php"); //  Соединяемся с БД

$count=incrementProgressBar();
$count=incrementProgressBar();
	setInterval();
$count=incrementProgressBar();
$count=incrementProgressBar();
	showTitle($uid,$n_obj,$adr,$pwr,$nrg);
$count=incrementProgressBar();
$count=incrementProgressBar();
	$znach= array();
	$znach2= array();
	$flag = array();
	$maxind=0;	$PowerMax=0;$EnergyFull=0; $num_bar=0;
	$rangePower="к"; $isLowPower=1; $format="%01.".$prec."f"; //$format="%01.2f"; 
	$counter=1;  $beg_date=1;$num_bar=0;
	$num_bar=calcData($n_obj,$adr,$table,$date_1,$date_2,$pwr,$nrg,$n_zone);
$count=incrementProgressBar();
$count=incrementProgressBar();
	calcSumData($n_obj,$adr,$table,$date_1,$date_2,$pwr,$nrg,$n_zone);
$count=incrementProgressBar();
	 drawGrid($pwr,$num_bar,$beg_date);
$count=incrementProgressBar();
$count=incrementProgressBar();
	 drawScale($pwr,$num_bar,$maxind);
$count=incrementProgressBar();
$count=incrementProgressBar();
$count=incrementProgressBar();
$count=incrementProgressBar();
mysql_close();		
 }

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
	 $izm_str=$res[0];	$type_izm = explode (",",$izm_str); $ktr=$res[4];$ctype=$res[3];
	 $name=$res[1]; 
	 if ($n_type==0) {if ($ctype==0 or $ctype==-1 or $ctype==-2) {$znum= "номер счетчика ".$res[2];$zn=$res[2];} }
	 else {$znum=""; $zn="";}
	} 
//==========================================================================================================================
}   
//========================================================запрос значений======================================================
function setInterval()
{
global $date_1;
global $date_2;
//определяем начало и конец временного интервала
	if ($date_1==$date_2)
	{
	 $result1=mysql_query("select DATE_ADD( DATE_FORMAT('".$date_1."','%Y-%m-%d'), INTERVAL -1 MONTH) ");
     if ($res1=mysql_fetch_array($result1,MYSQL_NUM))
	 $date_1 = $res1[0]; 
	 $result2=mysql_query("select DATE_ADD( DATE_FORMAT('".$date_2."','%Y-%m-%d'), INTERVAL -1 DAY) ");
     if ($res2=mysql_fetch_array($result2,MYSQL_NUM))
	 $date_2 = $res2[0]; 
	  mysql_free_result($result1);mysql_free_result($result2);
	}	
	else
	{
	 $result1=mysql_query("select DATE_ADD( DATE_FORMAT('".$date_1."','%Y-%m-%d'), INTERVAL +0 DAY) ");
     if ($res1=mysql_fetch_array($result1,MYSQL_NUM))
	 $date_1 = $res1[0]; 
	 $result2=mysql_query("select DATE_ADD( DATE_FORMAT('".$date_2."','%Y-%m-%d'), INTERVAL -1 DAY) ");
     if ($res2=mysql_fetch_array($result2,MYSQL_NUM))
	 $date_2 = $res2[0]; 
	  mysql_free_result($result1);mysql_free_result($result2);
	}	
}	 
//===============================================================================	
function calcData($n_obj,$adr,$table,$date_1,$date_2,$pwr,$nrg,$n_zone)
{
	global $znach; global $znach2; global $flag;global $num_bar;
	global $counter; global $beg_date;global $format; global $node;
	echo '<script language="JavaScript">incrementProgressBar();</script>';
	
	$result4=mysql_query("select * from seasons_hint order by n_season");
	if ($node==-2)
	{//если нужно считать по сезонам
		 list ($ac_year,$ac_month,$ac_day) = explode ("-",$date_2);
		 $beg_int_date=mktime (0,0,0, $ac_month, 1, $ac_year); 
		 $end_int_date=mktime (0,0,0, $ac_month, $ac_day, $ac_year); 
		 if ($ac_month==4 and $ac_day>14) {$step=1;/*echo $ac_day.".".$ac_month." переход на лето<br>";*/}
		 else if ($ac_month==10 and $ac_day>14) {$step=2;/*echo $ac_day.".".$ac_month." переход на зиму<br>";*/}
		 else {$step=0;/*echo $ac_day.".".$ac_month." нет перехода<br>";*/}
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
				{// echo $i."_".$date_2."_Лето<br>";
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
	 }

	
  if ($n_zone==0)
	{
	 $result1=mysql_query("select MAX(znach),MAX(flag),".$table.".data FROM ".$table." WHERE ".$table.".data BETWEEN '".$date_1."' AND '".$date_2."'  and n_obj=".$n_obj." AND link_adr=".$adr." AND izm_type=".$nrg." group by data order by data");
     $result2=mysql_query("select SUM(znach),MAX(flag),".$table.".data FROM ".$table." WHERE ".$table.".data BETWEEN '".$date_1."' AND '".$date_2."'  and n_obj=".$n_obj." AND link_adr=".$adr." AND izm_type=".$nrg."  group by ".$table.".data order by ".$table.".data");
	}
  else if ($n_zone>0 and $n_zone<4)
	{
if ($node==-2)//генерирущий
			{
			  if ($step==0) //нет перехода сезонов
			  {
				if ($seas==1)//сезон зима
				{
				   if ($nrg==2)
				   {
				    $result1=mysql_query("select MAX(znach),MAX(flag),".$table.".data FROM ".$table.",intervals WHERE ".$table.".data BETWEEN '".$date_1."' AND '".$date_2."'  and n_obj=".$n_obj." AND link_adr=".$adr." AND izm_type=".$nrg." AND intervals.winter_zone=".$n_zone." AND ".$table.".inter_val=intervals.inter_val  group by data order by data");
			        $result2=mysql_query("select SUM(znach),MAX(flag),".$table.".data FROM ".$table.",intervals WHERE ".$table.".data BETWEEN '".$date_1."' AND '".$date_2."'  and n_obj=".$n_obj." AND link_adr=".$adr." AND izm_type=".$nrg."  AND intervals.winter_zone=".$n_zone." AND ".$table.".inter_val=intervals.inter_val  group by data order by data");
				   }
				   else
				   {
				    $result1=mysql_query("select MAX(znach),MAX(flag),".$table.".data FROM ".$table.",intervals WHERE ".$table.".data BETWEEN '".$date_1."' AND '".$date_2."'  and n_obj=".$n_obj." AND link_adr=".$adr." AND izm_type=".$nrg." AND intervals.n_zone=".$n_zone." AND ".$table.".inter_val=intervals.inter_val  group by data order by data");
	    		    $result2=mysql_query("select SUM(znach),MAX(flag),".$table.".data FROM ".$table.",intervals WHERE ".$table.".data BETWEEN '".$date_1."' AND '".$date_2."'  and n_obj=".$n_obj." AND link_adr=".$adr." AND izm_type=".$nrg."  AND intervals.n_zone=".$n_zone." AND ".$table.".inter_val=intervals.inter_val  group by data order by data");
				   }	
				}
				else if ($seas==2)//сезон лето
				{
				   if ($nrg==2)
				   {
				    $result1=mysql_query("select MAX(znach),MAX(flag),".$table.".data FROM ".$table.",intervals WHERE ".$table.".data BETWEEN '".$date_1."' AND '".$date_2."'  and n_obj=".$n_obj." AND link_adr=".$adr." AND izm_type=".$nrg." AND intervals.summer_zone=".$n_zone." AND ".$table.".inter_val=intervals.inter_val  group by data order by data");
			        $result2=mysql_query("select SUM(znach),MAX(flag),".$table.".data FROM ".$table.",intervals WHERE ".$table.".data BETWEEN '".$date_1."' AND '".$date_2."'  and n_obj=".$n_obj." AND link_adr=".$adr." AND izm_type=".$nrg."  AND intervals.summer_zone=".$n_zone." AND ".$table.".inter_val=intervals.inter_val  group by data order by data");
				   }
				   else
				   {
				    $result1=mysql_query("select MAX(znach),MAX(flag),".$table.".data FROM ".$table.",intervals WHERE ".$table.".data BETWEEN '".$date_1."' AND '".$date_2."'  and n_obj=".$n_obj." AND link_adr=".$adr." AND izm_type=".$nrg." AND intervals.n_zone=".$n_zone." AND ".$table.".inter_val=intervals.inter_val  group by data order by data");
	    		    $result2=mysql_query("select SUM(znach),MAX(flag),".$table.".data FROM ".$table.",intervals WHERE ".$table.".data BETWEEN '".$date_1."' AND '".$date_2."'  and n_obj=".$n_obj." AND link_adr=".$adr." AND izm_type=".$nrg."  AND intervals.n_zone=".$n_zone." AND ".$table.".inter_val=intervals.inter_val  group by data order by data");
				   }	
				}	
			  }
	         else//переход сезонов 	
			 {
				if ($step==1)//сезон зима-->лето
				{
				   if ($nrg==2)
				   {
				    $result1=mysql_query("(select MAX(znach),MAX(flag),".$table.".data FROM ".$table.",intervals WHERE ".$table.".data BETWEEN '".$date_1."' AND '".date('Y-m-d',$end_date[0])."'  and n_obj=".$n_obj." AND link_adr=".$adr." AND izm_type=".$nrg." AND intervals.winter_zone=".$n_zone." AND ".$table.".inter_val=intervals.inter_val  group by data order by data)
				    UNION ALL (select MAX(znach),MAX(flag),".$table.".data FROM ".$table.",intervals WHERE ".$table.".data BETWEEN '".date('Y-m-d',$begin_date[1])."' AND '".$date_2."'  and n_obj=".$n_obj." AND link_adr=".$adr." AND izm_type=".$nrg." AND intervals.summer_zone=".$n_zone." AND ".$table.".inter_val=intervals.inter_val  group by data order by data)");
			        $result2=mysql_query("(select SUM(znach),MAX(flag),".$table.".data FROM ".$table.",intervals WHERE ".$table.".data BETWEEN '".$date_1."' AND '".date('Y-m-d',$end_date[0])."'  and n_obj=".$n_obj." AND link_adr=".$adr." AND izm_type=".$nrg."  AND intervals.winter_zone=".$n_zone." AND ".$table.".inter_val=intervals.inter_val  group by data order by data)
				    UNION ALL (select SUM(znach),MAX(flag),".$table.".data FROM ".$table.",intervals WHERE ".$table.".data BETWEEN '".date('Y-m-d',$begin_date[1])."' AND '".$date_2."' and n_obj=".$n_obj." AND link_adr=".$adr." AND izm_type=".$nrg."  AND intervals.summer_zone=".$n_zone." AND ".$table.".inter_val=intervals.inter_val  group by data order by data)");
				   }	
				   else
				   {
				    $result1=mysql_query("select MAX(znach),MAX(flag),".$table.".data FROM ".$table.",intervals WHERE ".$table.".data BETWEEN '".$date_1."' AND '".$date_2."'  and n_obj=".$n_obj." AND link_adr=".$adr." AND izm_type=".$nrg." AND intervals.n_zone=".$n_zone." AND ".$table.".inter_val=intervals.inter_val  group by data order by data");
	    		    $result2=mysql_query("select SUM(znach),MAX(flag),".$table.".data FROM ".$table.",intervals WHERE ".$table.".data BETWEEN '".$date_1."' AND '".$date_2."'  and n_obj=".$n_obj." AND link_adr=".$adr." AND izm_type=".$nrg."  AND intervals.n_zone=".$n_zone." AND ".$table.".inter_val=intervals.inter_val  group by data order by data");
				   }	
				}
				else if ($step==2)//сезон лето-->зима
				{
				   if ($nrg==2)
				   {
				    $result1=mysql_query("(select MAX(znach),MAX(flag),".$table.".data FROM ".$table.",intervals WHERE ".$table.".data BETWEEN  '".$date_1."' AND '".date('Y-m-d',$end_date[1])."'  and n_obj=".$n_obj." AND link_adr=".$adr." AND izm_type=".$nrg." AND intervals.summer_zone=".$n_zone." AND ".$table.".inter_val=intervals.inter_val  group by data order by data)
				    UNION ALL (select MAX(znach),MAX(flag),".$table.".data FROM ".$table.",intervals WHERE ".$table.".data BETWEEN '".date('Y-m-d',$begin_date[0])."' AND '".$date_2."'  and n_obj=".$n_obj." AND link_adr=".$adr." AND izm_type=".$nrg." AND intervals.winter_zone=".$n_zone." AND ".$table.".inter_val=intervals.inter_val  group by data order by data)");
			        $result2=mysql_query("(select SUM(znach),MAX(flag),".$table.".data FROM ".$table.",intervals WHERE ".$table.".data BETWEEN '".$date_1."' AND '".date('Y-m-d',$end_date[1])."'  and n_obj=".$n_obj." AND link_adr=".$adr." AND izm_type=".$nrg."  AND intervals.summer_zone=".$n_zone." AND ".$table.".inter_val=intervals.inter_val  group by data order by data)
				    UNION ALL (select SUM(znach),MAX(flag),".$table.".data FROM ".$table.",intervals WHERE ".$table.".data BETWEEN '".date('Y-m-d',$begin_date[0])."'  and n_obj=".$n_obj." AND link_adr=".$adr." AND izm_type=".$nrg."  AND intervals.winter_zone=".$n_zone." AND ".$table.".inter_val=intervals.inter_val  group by data order by data)");
				   }	
				   else
				   {
				    $result1=mysql_query("select MAX(znach),MAX(flag),".$table.".data FROM ".$table.",intervals WHERE ".$table.".data BETWEEN '".$date_1."' AND '".$date_2."'  and n_obj=".$n_obj." AND link_adr=".$adr." AND izm_type=".$nrg." AND intervals.n_zone=".$n_zone." AND ".$table.".inter_val=intervals.inter_val  group by data order by data");
	    		    $result2=mysql_query("select SUM(znach),MAX(flag),".$table.".data FROM ".$table.",intervals WHERE ".$table.".data BETWEEN '".$date_1."' AND '".$date_2."'  and n_obj=".$n_obj." AND link_adr=".$adr." AND izm_type=".$nrg."  AND intervals.n_zone=".$n_zone." AND ".$table.".inter_val=intervals.inter_val  group by data order by data");
				   }	
				}
			 }
	 	  }
		  else
		  {
		   $result1=mysql_query("select MAX(znach),MAX(flag),".$table.".data FROM ".$table.",intervals WHERE ".$table.".data BETWEEN '".$date_1."' AND '".$date_2."'  and n_obj=".$n_obj." AND link_adr=".$adr." AND izm_type=".$nrg." AND intervals.n_zone=".$n_zone." AND ".$table.".inter_val=intervals.inter_val  group by data order by data");
	       $result2=mysql_query("select SUM(znach),MAX(flag),".$table.".data FROM ".$table.",intervals WHERE ".$table.".data BETWEEN '".$date_1."' AND '".$date_2."'  and n_obj=".$n_obj." AND link_adr=".$adr." AND izm_type=".$nrg."  AND intervals.n_zone=".$n_zone." AND ".$table.".inter_val=intervals.inter_val  group by data order by data");
		  } 
	}
  else if ($n_zone==-1)
	{
	 $result1=mysql_query("select MAX(znach),MAX(flag),".$table.".data FROM ".$table.",intervals WHERE ".$table.".data BETWEEN '".$date_1."' AND '".$date_2."'  and n_obj=".$n_obj." AND link_adr=".$adr." AND izm_type=".$nrg." AND intervals.max_zone>2 AND ".$table.".inter_val=intervals.inter_val  group by data order by data");
     $result2=mysql_query("select SUM(znach),MAX(flag),".$table.".data FROM ".$table.",intervals WHERE ".$table.".data BETWEEN '".$date_1."' AND '".$date_2."'  and n_obj=".$n_obj." AND link_adr=".$adr." AND izm_type=".$nrg."  AND intervals.max_zone>2 AND ".$table.".inter_val=intervals.inter_val  group by data order by data");
	}
	echo '<script language="JavaScript">incrementProgressBar();</script>'; 
	$i=0;	
	 if ($pwr==1)	
	  {//считаем мощность
		while (($res1=mysql_fetch_array($result1,MYSQL_NUM)) and ($res2=mysql_fetch_array($result2,MYSQL_NUM)) )
	      {
			 $i++;
			 $value = $res1[0]*2;   $value2 = $res2[0];   $time=$res2[2]; 
		     list ($ac_year,$ac_month,$ac_day) = explode ("-",$time);
		  	 if ($i==1)    $beg_date=intval($ac_day);
			 $num_bar=intval($ac_day);		  
			 $znach[$num_bar]=sprintf($format,$value); $znach2[$num_bar]=sprintf($format,$value2);
			 $flag[$num_bar] = $res2[1];
			 if ($i%3==0) echo '<script language="JavaScript">incrementProgressBar();</script>';
		  }
	  }	  
	 else 
	  {//считаем энергию
	 if (!$result1) echo "<br><br>err 1";
	 if (!$result2) echo "<br><br>err 2";
		while (($res1=mysql_fetch_array($result1,MYSQL_NUM)) and ($res2=mysql_fetch_array($result2,MYSQL_NUM)) )
	      {
			 $i++;
			 $value = $res2[0];   $value2 = $res1[0]*2;   $time=$res2[2]; 
		     list ($ac_year,$ac_month,$ac_day) = explode ("-",$time);
		  	 if ($i==1)    $beg_date=intval($ac_day);
			 $num_bar=intval($ac_day);		  
			 $znach[$num_bar]=sprintf($format,$value); $znach2[$num_bar]=sprintf($format,$value2);
			 $flag[$num_bar] = $res2[1];
			if ($i%3==0) echo '<script language="JavaScript">incrementProgressBar();</script>';
		  }
	  }	  
	$counter=$i;
	for ($j=1;$j<=31;$j++)  
		{if (!isset($flag[$j])) $flag[$j] = "^";}
	return $num_bar;
 }
 
 function calcSumData($n_obj,$adr,$table,$date_1,$date_2,$pwr,$nrg,$n_zone)
{
	global $maxind;	global $PowerMax;global $EnergyFull;
	 if ($n_zone==0)
	 { 
	   $result0=mysql_query("Select MAX(".$table.".znach) AS mx,MAX(flag) From ".$table." Where ".$table.".data BETWEEN '".$date_1."' AND '".$date_2."'  and n_obj=".$n_obj." AND link_adr=".$adr." AND izm_type=".$nrg." ");
	   if ($res0=mysql_fetch_array($result0,MYSQL_NUM))
	   {
	    $PowerMax = $res0[0];
		if (isset($PowerMax))
		{
		  	$result_t=mysql_query("Select  ".$table.".inter_val,".$table.".data  From ".$table.", intervals Where ".$table.".data BETWEEN '".$date_1."' AND '".$date_2."' AND ".$table.".n_obj=".$n_obj." AND link_adr=".$adr." AND ".$table.".izm_type=".$nrg." 	AND ".$table.".inter_val = intervals.inter_val  order by znach desc");
			if ($m_ind=mysql_fetch_array($result_t,MYSQL_NUM))
			{
			 list ($ac_year,$ac_month,$ac_day) = explode ("-",$m_ind[1]);
			 $maxind=$ac_day;  
			} 
		}
	   }	
	  $result1=mysql_query("select SUM(znach),MAX(flag) FROM ".$table." WHERE ".$table.".data BETWEEN '".$date_1."' AND '".$date_2."'  and n_obj=".$n_obj." AND link_adr=".$adr." AND izm_type=".$nrg." ");
	  while ($res1=mysql_fetch_array($result1,MYSQL_NUM))
	  {
	    $EnergyFull = $res1[0]; 
	  }
	 }	
   else if ($n_zone>0 and $n_zone<4)
	 { 
	  $result0=mysql_query("Select MAX(".$table.".znach) AS mx,MAX(flag) From ".$table.",intervals Where ".$table.".data BETWEEN '".$date_1."' AND '".$date_2."'  and n_obj=".$n_obj." AND link_adr=".$adr." AND izm_type=".$nrg." AND intervals.n_zone=".$n_zone." AND ".$table.".inter_val=intervals.inter_val");
	  if ($res0=mysql_fetch_array($result0,MYSQL_NUM))
	  {
	   $PowerMax = $res0[0];
		if (isset($PowerMax))
		{
		  	$result_t=mysql_query("Select  ".$table.".inter_val,".$table.".data  From ".$table.", intervals Where ".$table.".data BETWEEN '".$date_1."' AND '".$date_2."'  AND ".$table.".n_obj=".$n_obj." AND link_adr=".$adr." AND ".$table.".izm_type=".$nrg." 	AND intervals.n_zone=".$n_zone." AND ".$table.".inter_val=intervals.inter_val order by znach desc");
			if ($m_ind=mysql_fetch_array($result_t,MYSQL_NUM))
			{
			 list ($ac_year,$ac_month,$ac_day) = explode ("-",$m_ind[1]);
			 $maxind=$ac_day;  
			} 
		}
	  }	
	 $result1=mysql_query("select SUM(znach),MAX(flag) FROM ".$table.",intervals WHERE ".$table.".data BETWEEN '".$date_1."' AND '".$date_2."'  and n_obj=".$n_obj." AND link_adr=".$adr." AND izm_type=".$nrg." AND intervals.n_zone=".$n_zone." AND ".$table.".inter_val=intervals.inter_val ");
	 while ($res1=mysql_fetch_array($result1,MYSQL_NUM))
	 {
	    $EnergyFull = $res1[0]; 
	 }
	}	
   else if ($n_zone==-1)
	 { 
	  $result0=mysql_query("Select MAX(".$table.".znach) AS mx,MAX(flag) From ".$table.",intervals Where ".$table.".data BETWEEN '".$date_1."' AND '".$date_2."'  and n_obj=".$n_obj." AND link_adr=".$adr." AND izm_type=".$nrg." AND intervals.max_zone>2 AND ".$table.".inter_val=intervals.inter_val");
	  if ($res0=mysql_fetch_array($result0,MYSQL_NUM))
	  {
	   $PowerMax = $res0[0];
		if (isset($PowerMax))
		{
		  	$result_t=mysql_query("Select  ".$table.".inter_val,".$table.".data  From ".$table.", intervals Where ".$table.".data BETWEEN '".$date_1."' AND '".$date_2."'  AND ".$table.".n_obj=".$n_obj." AND link_adr=".$adr." AND ".$table.".izm_type=".$nrg." 	AND intervals.max_zone>2 AND ".$table.".inter_val=intervals.inter_val order by znach desc");
			if ($m_ind=mysql_fetch_array($result_t,MYSQL_NUM))
			{
			 list ($ac_year,$ac_month,$ac_day) = explode ("-",$m_ind[1]);
			 $maxind=$ac_day;  
			} 
		}
	  }	
	 $result1=mysql_query("select SUM(znach),MAX(flag) FROM ".$table.",intervals WHERE ".$table.".data BETWEEN '".$date_1."' AND '".$date_2."'  and n_obj=".$n_obj." AND link_adr=".$adr." AND izm_type=".$nrg." AND intervals.max_zone>2 AND ".$table.".inter_val=intervals.inter_val ");
	 while ($res1=mysql_fetch_array($result1,MYSQL_NUM))
	 {
	    $EnergyFull = $res1[0]; 
	 }
	}	
 }

function drawGrid($pwr,$num_bar,$beg_date)
{ 
 global $znach; global $znach2;global $flag;global $counter;
 global $isLowPower; global $rangePower; global $prec; global $format;
 global $izmtype; global $name; global $pname; global $znum;
 global $date_header2;
list ($ac_day,$ac_month,$ac_year) = explode (".",$date_header2);
if (isset($date_header2))
{
  if ($ac_day=='01')	
  {
	echo '<div style="margin-top:15px;text-align:center;position:absolute;z-index:-1;width:100%;"><v:textbox id="nazv" style="font-size:12px;font-weight:bolder;">'.$pname.'&nbsp;'.$name.'&nbsp;'.$znum.'<br>'.$izmtype.'  за '.getMonthName($ac_month-1).'&nbsp;</v:textbox>';
	  echo '<v:textbox id="dates" style="font-size:14px;font-weight:bolder;">на дату '.$date_header2.'</v:textbox></div>';
  } 
 else 
  {
	echo '<div style="margin-top:15px;text-align:center;position:absolute;z-index:-1;width:100%;"><v:textbox id="nazv" style="font-size:12px;font-weight:bolder;">'.$pname.'&nbsp;'.$name.'&nbsp;'.$znum.'<br>'.$izmtype.'  за '.getMonthName($ac_month).'&nbsp;</v:textbox>';
	  echo '<v:textbox id="dates" style="font-size:14px;font-weight:bolder;">на дату '.$date_header2.'</v:textbox></div>';
  } 
}  
else {
	echo '<div style="margin-top:15px;text-align:center;position:absolute;z-index:-1;width:100%;"><v:textbox id="nazv" style="font-size:12px;font-weight:bolder;">'.$pname.'&nbsp;'.$name.'&nbsp;'.$znum.'<br> '.$izmtype.' &nbsp;</v:textbox>';
	  echo '<v:textbox id="dates" style="font-size:14px;font-weight:bolder;">на дату '.$date_header2.'</v:textbox></div>';
	}
	echo '<v:group id="myDiv" editas="canvas" style="margin-top:5;margin-left:10" style="width:705px;height:370px;" coordorigin="0,0" coordsize="750,450">
	<v:rect id="rect0" fillcolor = "#eaeaea" style="position:absolute;left:50;top:55;width:5;height:420;z-index:-1">
	 <v:extrusion on=True backdepth="12" foredepth="22"/>
	</v:rect>';
			for ($i=0;$i<=31;$i++)		  
			{
			 drawLine(55+$i*24,487,70+$i*24,470,"black",1,"solid");
			 drawLine(55+$i*24,488,55+$i*24,497,"black",2,"solid");
			} 
			for ($i=0;$i<=20;$i++)
			{		  
			drawLine(33,485-$i*20,43,485-$i*20,"black",1,"solid");
			drawLine(44,485-$i*20,62,470-$i*20,"black",1,"dot");
			drawLine(62,470-$i*20,810,470-$i*20,"black",1,"dot");
			}
	if (count($znach)>0) 
	{
		$minim=min($znach);$maxim=max($znach);$minim2=min($znach2);$maxim2=max($znach2);
		$isLowPower=legend($pwr);
	}
	if ($isLowPower==1)  {$rangePower="к";$format="%01.".$prec."f";} else {$rangePower=" ";$format="%0.0f";}
	if (!isset($isLowPower)) $rangePower="к";
		for ($num=1;$num<$beg_date;$num++)
		{
		 $height=0;	$top=478; 
		 $color="blue";$flag[$num]="^";
		 $k1=40;$k2=24;$width=22;
		 echo "<div onclick='selected(".$num.")' class='bar' title='".sprintf($format,0)."'><v:rect class='col' title='".sprintf($format,0)."' style='left:".($k1+$k2*$num).";top:".$top.";height:".$height.";width:".$width."px;z-index:+1;' ><v:fill angle='0' focus='100%' color='".$color."' color2='fill lighten(50)' type='gradient' method='sigma'/> <v:extrusion on='t' backdepth='14' foredepth='14'  /></v:rect></div>\n";
		}
		for ($num=$beg_date;$num<($num_bar+$beg_date);$num++)
		{
//==============================================================================================
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
		 if ($znach[$num]<0)
		  {
   			 if (($maxim>=0)and($minim<0))
			     {
  			 	   $height=abs($znach[$num]*404/($maxim-$minim));
				   $top=(74+404/($maxim-$minim)*$maxim);
				 } 
                else if (($maxim<=0)and($minim<0))
			     {
				  $height=$znach[$num]*401/($minim);
				  $top=76;
				 } 		
		  }
		if ($znach[$num]==0) 
		 { 
	   	   if ($maxim<=0)
		   {   $height=0;	$top=74; }
		   if ($minim>=0)
		   {    $height=0;	$top=478; }
		   
		    if (($maxim>=0)and($minim<0))
			     {
  			 	   $height=0;
				   $top=(74+404/($maxim-$minim)*$maxim);
				 } 
		 }  
//========================================================================================================

		 $color="blue";
		 $k1=40;$k2=24;$width=22;
		 
		 echo "<div onclick='selected(".$num.")' class='bar' title='".sprintf($format,$znach2[$num]*$isLowPower)."'><v:rect class='col' title='".sprintf($format,$znach[$num]*$isLowPower)."' style='left:".($k1+$k2*$num).";top:".$top.";height:".$height.";width:".$width."px;z-index:+1;' ><v:fill angle='0' focus='100%' color='".$color."' color2='fill lighten(50)' type='gradient' method='sigma'/> <v:extrusion on='t' backdepth='14' foredepth='14'  /></v:rect></div>\n";
		echo "\n";
		}
	echo '<v:rect fillcolor = "#eaeaea" style="z-index:-1;position:absolute;width:760;height:2;left:53;top:475" strokecolor="black" strokeweight="1px">
	<v:extrusion on=True backdepth="12" foredepth="28" skewangle="-132"/>
	</v:rect>
	<v:rect fillcolor = "#eaeaea" style="z-index:-1;position:absolute;width:755;height:420;left:60;top:50;" strokecolor="black" strokeweight="1px"/>';
	echo "\n";
   if (($maxim>0) and ($minim<0))
   {
	drawLine(62,58+420/($maxim-$minim)*$maxim,815,58+420/($maxim-$minim)*$maxim,"red",3,"solid");
	$rectTop=65+420/($maxim-$minim)*$maxim;
	echo '<v:rect id="hiddenScale" fillcolor = "#eaeaea" style="z-index:0;position:absolute;width:750;height:2;left:55;top:'.$rectTop.';visibility:visible" strokecolor="black" strokeweight="8px">
	<v:extrusion on=True render="wireframe"	backdepth="16" foredepth="16" skewangle="-133" />
	</v:rect>';
	echo "\n";
   }
	echo '</v:group>';
 }
//==============================================================================================================================
function drawScale($pwr,$num_bar,$maxind)
{
 global $znach;
 global $counter;
  echo '<v:group id="myDiv2" editas="canvas" style="z-index:+10;position:absolute;margin-top:-40;left:1" style="width:682px;height:16px;" coordorigin="0,0" coordsize="745,16">';
  $click_num=0;
	if ($pwr==1)
	{
	 for ($i=1;$i<=31;$i++)
	 {
	  if ($click_num<$num_bar) $click_num++;
	  if ($i==$maxind and $i<=$num_bar) $max_color="red"; else $max_color="transparent";
	  if ($i==$num_bar and $max_color=="transparent")  $cursor_color="yellow"; else $cursor_color="transparent";
	  if ($i<=$counter)	$event='selected('.$click_num.')'; else $event='';
	  if ($flag[$click_num]=='' or $flag[$click_num]==' ')
	    echo '<div id="d'.$i.'" title="'.$znach[$i].'" class="c21" onclick="'.$event.'" style="left:'.(70+22.7*($i-1)).';background-color:'.$max_color.'"><v:textbox id="t'.$i.'" class="text2" style="background-color:'.$cursor_color.'">'.$i.'</v:textbox></div>';
	  else 
      {
		 if ($i<=$click_num) echo '<div id="d'.$i.'" title="'.$znach[$i].'" class="c21" onclick="'.$event.'" style="left:'.(70+22.7*($i-1)).';background-color:'.$max_color.'"><v:textbox id="t'.$i.'" class="text2" style="background-color:'.$cursor_color.';color:red;">'.$flag[$click_num].'</v:textbox></div>';
		 else echo '<div id="d'.$i.'" title="'.$znach[$i].'" class="c21" onclick="'.$event.'" style="left:'.(70+22.7*($i-1)).';background-color:'.$max_color.'"><v:textbox id="t'.$i.'" class="text2" style="background-color:'.$cursor_color.';">'.$i.'</v:textbox></div>';
	  }
	echo "\n";
	 } 
   }
   else
   {
	 for ($i=1;$i<=31;$i++)
	 {
	  if ($click_num<$num_bar) $click_num++;
	  if (count($znach)>0)
	 	 if ($znach[$click_num]==max($znach) and $i<=$num_bar) $max_color="red"; else $max_color="transparent";
	  if ($i==$num_bar and $max_color=="transparent")  $cursor_color="yellow"; else $cursor_color="transparent";
	  if ($i<=$counter)	$event='selected('.$click_num.')'; else $event='';
	  if ($flag[$click_num]=='' or $flag[$click_num]==' ')
	  	echo '<div id="d'.$i.'" title="'.$znach[$i].'" class="c21" onclick="'.$event.'" style="left:'.(70+22.7*($i-1)).';background-color:'.$max_color.'"><v:textbox id="t'.$i.'" class="text2" style="background-color:'.$cursor_color.'">'.$i.'</v:textbox></div>';
  	  else 
	   {
		 if ($i<=$click_num) echo '<div id="d'.$i.'" title="'.$znach[$i].'" class="c21" onclick="'.$event.'" style="left:'.(70+22.7*($i-1)).';background-color:'.$max_color.'"><v:textbox id="t'.$i.'" class="text2" style="background-color:'.$cursor_color.';color:red;">'.$flag[$click_num].'</v:textbox></div>';
		 else echo '<div  id="d'.$i.'" title="'.$znach[$i].'" class="c21" onclick="'.$event.'" style="left:'.(70+22.7*($i-1)).';background-color:'.$max_color.'"><v:textbox id="t'.$i.'" class="text2" style="background-color:'.$cursor_color.';">'.$i.'</v:textbox></div>';
	   }
	echo "\n";
	 } 
   } 
	echo '</v:group>';
 } 
 //=============== формирование сетки  ===============================

function drawLine($startx, $starty, $endx, $endy, $color,$weight,$dashstyle)
{
echo '<v:line  style="position:absolute;" from="'.$startx.','.$starty.'" to="'.$endx.','.$endy.'" strokecolor="'.$color.'" strokeweight="'.$weight.'pt">';
echo ' <v:stroke dashstyle="'.$dashstyle.'"/>';
echo ' </v:line>';
	echo "\n";

}
function drawPodpis($width,$height,$top,$left,$string)
{
 echo ' <v:shape type="#t202" style="z-index:+9;position:absolute;top:'.($top-5).';left:'.($left-40).';width:'.$width.'; height:'.$height.';" filled="f" fillcolor="#ffffcc" stroked="f">
   <v:textbox inset="0mm,,0mm">
     <div style="color:red;text-align:right;font-size:10px;">	 <b> '.$string.'</b>     </div>
	</v:textbox>
 </v:shape>';
 	echo "\n";

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
   if ($high>=20)
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
   if ($high>=20)
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
?>
<br>
<?
if ((($pwr==1) and ($nrg==1)) or(($pwr==1) and ($nrg==2)) or (($pwr==2) and($nrg==1)) or (($pwr==2) and ($nrg==2))) $izmer='Вт';

if ((($pwr==1) and ($nrg==3)) or(($pwr==1) and ($nrg==4)) or (($pwr==2) and($nrg==3)) or (($pwr==2) and ($nrg==4)))	$izmer='вар';
if (($pwr==1) or ($pwr==2))
{
if ($pwr==1) $currday=sprintf($format,$znach2[$counter]*$isLowPower); else if ($pwr==2) $currday= sprintf($format,$znach[$counter]*$isLowPower);
if ($pwr==1) $currmax=sprintf($format,$znach[$counter]*$isLowPower); else if ($pwr==2) $currmax=sprintf($format,$znach2[$counter]*$isLowPower);
echo '<table  id="comment" cellpadding="0" cellspacing="0" border="0" style="margin-top: 15px;margin-left: 30px; position: relative;">
<tr>
	<td>&nbsp;</td>
    <td colspan="4" align="center" valign="bottom" style="height:16px"><font style="font-size:12px;font-weight:bold">М о щ н о с т ь ('.$rangePower.$izmer.')</font></td>
    <td colspan="6" align="center" valign="bottom" style="height:16px"><font style="font-size:12px;font-weight:bold">Э н е р г и я ('.$rangePower.$izmer.'*ч)</font></td>
	<td colspan="3">&nbsp;</td>
</tr>
<tr>
	<td style="height:12px;width:50px">&nbsp;</td>
	<td align="center"><font class="podpis">за месяц </font></td>
	<td style="height:12px;width:20px">&nbsp;</td>
    <td align="center"><font class="podpis">за сутки </font></td>
	<td>&nbsp;</td>	<td>&nbsp;</td>
    <td align="center"><font class="podpis">за сутки</font></td>
	<td>&nbsp;</td>
    <td align="center"><font class="podpis">с начала месяца</font></td>
	<td>&nbsp;</td>
    <td align="center"><font class="podpis">за месяц</font></td>
	<td>&nbsp;</td>
    <td align="center"><font class="podpis"></font></td>
	<td colspan="2" rowspan="2">&nbsp;	
	 <form name="navigate" style="display:none;">
      <input type="button" id="power" name="power" value="Мощность за день" style="width:1;visibility:hidden;" onclick="go_power()">
	  <input type="button" id="energy" name="energy" value="Энергия за день" style="width:1;visibility:hidden;" onclick="go_energy()">
	  <input type="button" id="print" name="print" value="Печать" style="width:1;visibility:hidden;" onclick="go_printer()">
	 </form>
</td>
</tr>
<tr>
<form name="stat">
	<td>&nbsp;</td>
	<td align="center"><input type="text" name="fullmax" size=10 class="input" readonly value="'.sprintf($format,$PowerMax*2*$isLowPower).'"></td>
	<td width="20">&nbsp;</td>
    <td align="center"><input type="text" name="currmax" size=10 class="input" readonly value="'.$currmax.'"></td>
	<td width="20">&nbsp;</td>
	<td width="40">&nbsp;</td>
    <td align="center"><input type="text" name="currday" size=10 class="input" readonly value="'.$currday.'"></td>
	<td width="20">&nbsp;</td>
    <td align="center"><input type="text" name="oncurrday" size=10 class="input" readonly value="'.sprintf($format,$EnergyFull*$isLowPower).'"></td>
	<td width="20">&nbsp;</td>
    <td align="center"><input type="text" name="fullmonth" size=10 class="input" readonly value="'.sprintf($format,$EnergyFull*$isLowPower).'"></td>
	<td>&nbsp;</td>
   </form> 
</tr>
</table>';

}
?>

<?
echo '<table cellpadding="0" cellspacing="0" style="display:none">
<tr>
<td>	
	<form name="myform1">
	<input type="hidden" name="maxind" value="'.$maxind.'"><input type="hidden" name="active" value="'.$counter.'">
	<input type="hidden" name="format" value="'.$format.'"><input type="hidden" name="isPower" value="'.$pwr.'">
	</form>
</td>
</tr>
</table>';
$TIME_END = getmicrotime();
$TIME_SCRIPT = $TIME_END - $TIME_START; 
echo '<center>
<span style="color:white;" class="help"><b>.::</b>
Время выполнения запроса '.number_format($TIME_SCRIPT,3,'.','').' сек.
<b>::.</b>
</span>
</center>
</div>';
if (isset($date_2) and isset($uid) and isset($pwr) and isset($nrg) and ($node<2)  )
{
    echo "<Script Language=\"JavaScript1.2\" src=\"js/gist2.js\"></script>";
} 
?>
</div>
</body>
</html>
