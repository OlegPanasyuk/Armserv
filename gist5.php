<html xmlns:v="urn:schemas-microsoft-com:vml">
 
<head>
	<title>ѓрафик 3-х минуток</title>
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
{width: 100; border: thin solid Black;}
LEGEND
{font-weight: bolder;font-size: 14px;color:blue;}
LABEL
{font-size: 11px;font-weight: bolder;}
SELECT
{font-size: 12px;font-weight: bolder;width:50; }
TD
{font-size: 12px;font-weight: bolder;}
</style>
	<link rel="stylesheet" href="css/j.css"></link>
<?php
echo "<SCRIPT language=\"JavaScript1.2\">var tab=".$_GET["tab"]."</SCRIPT>";
echo "<SCRIPT language=\"JavaScript1.2\" src=\"js/progressbar.js\"></SCRIPT>";
echo "<script language=\"JavaScript1.2\" src=\"js/control_g3.js\"></script>";
echo "<script language=\"JavaScript1.2\">formatData.style.display='none';</script>";
?>	
<script language="JavaScript" src="js/tabs.js">
<!--
//-->
</script>
</head>

<body id="g1" topmargin=0 marginheight=0 marginwidth=0 scroll="auto" onload="startIncrement();" background=tree/imgs/fon.gif>
<div id="padding" style="height:80px;" class="help"></div>
<div id="content">
<?
echo "
<script language=\"JavaScript1.2\">
	if (window.parent.toc.ntype)
	{
	 node=window.parent.toc.ntype.value;
     if (node==0||node==1) {
	  legenda.innerHTML='<span style=\"color:black;font-size:10px;\">вывод данных по объекту:</span> '+window.parent.toc.item_name.value;
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
<?
include("util_fun.php");
$name = $_GET["iname"];
$uid = $_GET["id"];
$node = $_GET["node"];
$dc = $_GET["dc"];
$disp = $_GET["retros"];
$type = $_GET["type"];
$nrg = $_GET["type"];
$n_obj = $_GET["nobj"];
$adr = $_GET["adr"];
$curtime = $_GET["curtime"];
if (!isset($curtime)) $curtime=0;
if (!isset($pwr)) $pwr=1;
if (!isset($izm_type)) $izm_type=$type;
if (!isset($date_)) $date_=$dc; 
 $type_izm = array();
 $znach=array();
 $flag = array();$cnt = array();
	$int_val=0;	$int_val2=0; $maxind=0;$counter=0;$time='';$color='blue';
	$PowerMax=0;$EnergyFull=0; 
	$rangePower="к"; $isLowPower=1; $format="%01.".$prec."f"; //$format="%01.2f"; 
 //$pwr = array();
 //$nrg = array();
 $colname = array();
 $count=0;$num_day=0;$zn="";
 //if (!isset($pw_en)) $pwr=0;
$TIME_START=getmicrotime();

if (isset($dc) and isset($uid) and isset($n_obj) and isset($adr) and isset($pwr) and ( ($node==0) or ($node==1) ) )
{
echo "<script>\n";
echo "window.document.forms[0].dc.value='$dc';";
echo "window.document.forms[0].iname.value='$name';\n";
echo "window.document.forms[0].id.value='$uid';\n";
echo "window.document.forms[0].node.value='$node';\n";
echo "window.document.forms[0].dispe.value='1';";
echo "window.document.forms[0].type.value='$type';";
echo "formatData.style.display='inline';";
echo "</script>";
	if ($curtime==1) 
	{
   $currdate=date("d.m.Y H:i:s");
	list ($ac_dt,$ac_tm) = explode (" ",$currdate);
	list ($ac_day,$ac_month,$ac_year) = explode (".",$ac_dt);
	list ($ac_h,$ac_m,$ac_s) = explode (":",$ac_tm);
	if (($ac_m-$ac_m%3)<10) $add='0';else $add='';
	$tm=$ac_h.":".$add."".($ac_m-$ac_m%3).":".$ac_s;
	$date_header='за '.$ac_dt;
	$time=$ac_tm.' ';
	if ($disp==0)	$dc=$ac_dt." ".$tm;
	$dc=$ac_dt." ".$tm;
	$date_=$ac_year.'-'.$ac_month.'-'.$ac_day.' '.$tm;
	
//	$dc=$date_1;
//	echo "setMode();\n";
	}
	else
	{
	list ($ac_dt,$ac_tm) = explode (" ",$date_);
	list ($ac_h,$ac_m,$ac_s) = explode (":",$ac_tm);
	if (($ac_m-$ac_m%3)<10) $add='0';else $add='';
	$ac_s="00";
	$tm=$ac_h.":".$add."".($ac_m-$ac_m%3).":".$ac_s;
	$time=$ac_tm.' ';
	list ($ac_day,$ac_month,$ac_year) = explode (".",$ac_dt);
	$date_header='за '.$ac_day.'.'.$ac_month.'.'.$ac_year.' ';
	$date_=$ac_year.'-'.$ac_month.'-'.$ac_day.' '.$tm;
	}
	$isLowPower=1;
}
   function incrementProgressBar()
	{
	 global $count;
	 $count++;
	 echo "<script language=\"JavaScript\">incrementProgressBar();</script>\n";
	 return $count;
	}
   
   include("include/mysql2.php");// Connecting with DATABASE
   ShowTitle($uid,$n_obj,$adr,1,$nrg);
	$count=incrementProgressBar();
	$count=incrementProgressBar();
    drawHeader(1,$nrg);
	drawGrid($disp,$date_);
	echo "$date_  $disp";
	//calcData($uid,$n_obj,$adr,$table,$pwr,$nrg,$date_,$disp);
	
	//============================================================================================================================
	/*function calcData($uid,$n_obj,$adr,$table,$pwr,$nrg,$date_3,$retros)
{
global $counter; global $format;
	switch ($retros){
		case 0: $kol_int=0;
		case 15: $kol_int=5;
		case 30: $kol_int=10;
		case 60: $kol_int=20;
		case 120: $kol_int=40;
	}
		list ($ac_dt,$ac_tm) = explode (" ",$date_3);
		list ($ac_h,$ac_m,$ac_s) = explode (":",$ac_tm);
		$ac_m = $ac_m + $kol_int*3;
		if (($ac_m>=60) and ($ac_m<120))
		{
			$ac_h = $ac_h+1;
			$ac_m = $ac_m-60;
		} 
		else 
		{
			if ($ac_m>=120) 
			{
				$ac_h =$ac_h + 2;
				$ac_m = $ac_m-120;
			}
		}
		list ($ac_day,$ac_month,$ac_year) = explode ("-",$ac_dt);
		$ac_dt=$ac_day."-".$ac_month."-".$ac_year;
		$date_2=$ac_dt.' '.$ac_h.':'.$ac_m.':'.$ac_s;
	$result1=mysql_query("select znach,flag,end_int,".$table.".inter_val   FROM ".$table.",intervals_3m WHERE ".$table.".data BETWEEN ".$date_3."  AND ".$date_2." AND n_obj=".$n_obj." AND link_adr=".$adr." AND izm_type=".$nrg." AND ".$table.".inter_val = intervals_3m.inter_val ORDER BY ".$table.".inter_val");
	echo "$date_3  $date_2 $retros";
	$i=0;$tmp=0;
	global $znach;global $flag;global $cnt;
	global $int_val;	global  $int_val2;global $time;

 	 while ($res1=mysql_fetch_array($result1,MYSQL_NUM))
      {
		 $value = $res1[0];  $time=$res1[2];
		 $i++;	if ($i==1) 	$int_val = $res1[3]-1;$int_val2 = $res1[3];
		 $znach[$int_val2]=sprintf($format,$value*2);
		 $flag[$int_val2] = $res1[1];
		 if ($i%4==0) echo '<script language="JavaScript">incrementProgressBar();</script>';
	  }
    $counter=round($i/2)+$int_val;
 }*/

//********************************************************************************************************************************
	
	//==========================================================================================
function ShowTitle($uid,$n_obj,$adr,$pwr,$nrg)
{ 
   global $izmtype; global $name; global $pname; global $znum;
   $result=mysql_query("select pwr,descript FROM izm_type WHERE izm_type=".$nrg);
   while ($res=mysql_fetch_array($result,MYSQL_NUM))
   {
		$izmtype=$res[0].' '.$res[1];
   }
//======================определяем точку учетаи ее название=================================
	$result=mysql_query("select item_name FROM objects WHERE item_parent_id=-1");
	if ($res=mysql_fetch_array($result,MYSQL_BOTH))
	{
 		 $obj_name=$res[0]; 
	}
	$result=mysql_query("select item_name FROM objects WHERE  item_id=(select item_parent_id FROM objects WHERE item_id=".$uid.") ");
    if ($res=mysql_fetch_array($result,MYSQL_BOTH))
	{
	 $pname=$res[0];
	} 
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
//=============================рисование столбцов и подписей=======================================================
	function drawLine($startx, $starty, $endx, $endy, $color,$weight,$dashstyle)//рисование сетки
	{
		echo '<v:line  style="position:absolute;" from="'.$startx.','.$starty.'" to="'.$endx.','.$endy.'" strokecolor="'.$color.'" strokeweight="'.$weight.'pt">';
		echo ' <v:stroke dashstyle="'.$dashstyle.'"/>';
		echo ' </v:line>';
	}
	function drawBar($znach,$k1,$k2,$num,$top,$height,$width,$color)//рисуем столбец гистограммы
	{
	echo '<div onclick="" class="bar" title="" id="'.$num.'_'.$color.'"><v:rect class="col" style="left:'.($k1+$k2*$num).';top:'.$top.';height:'.$height*$znach.';width:'.$width.'px;z-index:1;" ><v:fill angle="0" focus="100%" color="'.$color.'" color2="fill lighten(50)" type="gradient" method="sigma"/> <v:extrusion on="t" backdepth="14" foredepth="14"  /></v:rect></div>';
	echo "\n";
	}

	function drawBar2($select,$format,$znach,$isLowPower,$k1,$k2,$num,$top,$height,$width,$color)//рисуем столбец гистограммы
	{
	echo '<div onclick="selected('.$select.')" class="bar" title="'.sprintf($format,$znach*$isLowPower).'" id="'.$num.'_'.$color.'"><v:rect class="col" style="left:'.($k1+$k2*$num).';top:'.$top.';height:'.$height.';width:'.$width.'px;z-index:1;" ><v:fill angle="0" focus="100%" color="'.$color.'" color2="fill lighten(50)" type="gradient" method="sigma"/> <v:extrusion on="t" backdepth="14" foredepth="14"  /></v:rect></div> ';
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
//=================================Рисуем оглавление=========================================================
	function drawHeader($pwr,$nrg)
	{   global $izmtype; global $name; global $pname; global $znum;
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
	 }
		echo  '<div style="margin-top:15px;text-align:center;position:absolute;z-index:-1;width:100%;"><v:textbox id="nazv" style="font-size:12px;font-weight:bolder;">'.$pname.'&nbsp;'.$name.'&nbsp; '.$znum.'<br>'.$izmtype.'  '.$date_header.'&nbsp;</v:textbox><v:textbox id="timer" style="font-size:12px;font-weight:bolder;">'.$time.'</v:textbox></div>
		<v:group id="myDiv" editas="canvas" style="margin-top:5;margin-left:5" style="width:720px;height:370px;" coordorigin="0,0" coordsize="760,450"><br>';
			
		echo '<script language="JavaScript">incrementProgressBar();</script>';
		echo '<v:rect fillcolor = "#eaeaea" style="z-index:-1;position:absolute;width:755;height:2;left:55;top:476" strokecolor="black" strokeweight="1px"><v:extrusion on=True backdepth="12" foredepth="28" skewangle="-133" style="top:470"/></v:rect>';
		echo '<v:rect fillcolor = "#eaeaea" style="z-index:-1;position:absolute;width:754;height:420;left:60;top:50;" strokecolor="black" strokeweight="1px"/>';
	}
//===============================================рисование вертикальной динамической шкалы=========================================================	
	/*function legend()
	{
	$high=0;	 $title_kf=1;
	global $znach;  
 
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
	  echo 'кВт';
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
	 if ($isPower==1) echo 'Вт'; else echo 'Вт*ч';
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
 global $znach;  
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
	 if ($isPower==1) echo 'КВт'; else echo 'КВт*ч';
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
	 if ($isPower==1) echo 'Вт'; else echo 'Вт*ч';
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
}*/
//********************************************************************************************************************************
	
	function drawGrid($retros,$date_1)
	{
	global $znach; global $flag;
	global $isLowPower; global $rangePower; global $prec; global $format;
	global $izmtype; global $name; global $pname; global $znum;
	global $date_;global $date_header;global $color;global $time;global $node;
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
	if (count($znach)>0) {$minim=min($znach);$maxim=max($znach);$isLowPower=legend();}
	
	//=============================================--прорисовка столбцов--======================================================
	//mysql_free_result($result);
	echo "дата и время выборки: $date_1 <br>";
	list($dt,$tm)=explode(" ",$date_1);
	list($h,$m,$s)=explode(":",$tm);
	$m = $m + $retros;
	if (($m>=60) and ($m<120)) {$h=$h+1;$m=$m-60;}
	if ($m>=120) {$h=$h+2;$m=$m-120;}
	$date_2=$dt.' '.$h.':'.$m.':'.$s;
	echo "дата и время выборки: $date_2 <br>";
	$result = mysql_query("select inter_val,znach FROM val_3m WHERE data BETWEEN DATE_ADD(DATE_FORMAT('".$date_1."','%Y-%m-%d %H:%i:%s'), INTERVAL -".$retros." MINUTE) AND DATE_FORMAT('".$date_1."','%Y-%m-%d %H:%i:%s') AND izm_type=9 AND n_obj=0 AND link_adr=64 ");
	if($result)
		{
			$i==0;
			while ($res=mysql_fetch_array($result, MYSQL_BOTH))
			{
				
				if ($i=1){ 
				$end=$res[0];}
				$znach[$res[0]]=$res[1];
				
				echo "- $i -";
			}
			print_r($znach);
			if (count($znach)>0) {$minim=min($znach);$maxim=max($znach);}
			echo "выборка не пуста начало выборки !!$end!!";
			$k1=44;$k2=15.5;
			$n==1; $top=478; $height=1000; $width=102;
			//$b==$end-$retros;
			
			for ($i=$end-$retros/3; $i<=$end;$i++)
			{
			$n++;
			echo "$i";
			drawBar($znach[i],$k1,$k2,$n,$top,$height,$width,$color);
			}
			
		}
		else
		{
			echo 'выборка пуста';
		}
	
	}
	
//==========================================================================================
}
//==========================================================================================
?>
<?php
$TIME_END=getmicrotime();
$TIME_SCRIPT=$TIME_END-$TIME_START;
if (isset($date_) and isset($uid) and isset($pwr) and isset($nrg) and ($node<2) )
{
 echo "<Script Language=\"JavaScript1.2\" src=\"js/gist1.js\"></script>";
} 
 ?>
 <center>
 <span style="color:black;" class="help"><br><br><b>.::</b>
Время выполнения запроса <?=number_format($TIME_SCRIPT,3,'.','');?> сек.
<b>::.</b>
 </span>
 </center>
</div>
</body>
</html>
