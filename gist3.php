<html xmlns:v="urn:schemas-microsoft-com:vml">
<head>
	<title>График 3-х минутных</title>
	<link href="css/gist1.css" rel="stylesheet" type="text/css">
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
	<meta http-equiv="Cache-Control" content="no-cache"/>
	<BASE target="frSheet"/>
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
<script src="1/jquery.js" type="text/javascript"></script>
<script src="1/jquery.tabslideout.js" type="text/javascript"></script>
<script type="text/javascript">
$(function(){
	$('.help').tabSlideOut({							//Класс панели
		tabHandle: '.handle',						//Класс кнопки
		pathToTabImage: '1/contacts.png',				//Путь к изображению кнопки
		imageHeight: '138px',						//Высота кнопки
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
<body id="g1" topmargin=0 marginheight=0 marginwidth=0 scroll="auto" onload="startIncrement();" background=tree/imgs/fon.gif>
<div id="padding" style="height:40px;" class="help"></div>
<div id="content">
<?
//==================выводим легенду дл¤ счетсика============================================================================================
echo "
<script language=\"JavaScript1.2\">
	if (window.parent.toc.ntype)
	{
	 node=window.parent.toc.ntype.value;
     if (node==0||node==1||node==-1) {
	  legenda.innerHTML='<span style=\"color:black;font-size:10px;\">вывод данных по объекту:</span> ';
	  formatData.style.display='inline';
	 }
	 else {
			legenda.innerHTML=' <span style=\"color:black;font-size:10px;\">((выберите счетчик)</span>';
			formatData.style.display='none';
			content.innerHTML='';
		}
	}	
</script>";
include("util_fun.php");//подключаем функции дл¤ работы с датой.

//=========================забираем переменные из формы topmenu==============================================================================

$type=$_GET["type"];//тип измерени¤ активна¤ реактивна¤ и направление
$curtime = $_GET["curtime"]; //прив¤зка к текущему времени 1 да 0 нет
$dc = $_GET["dc"];// получает дату из ¤чейки
$retros=$_GET["retros"];// возвращает ретроспективу
$name = $_GET["iname"];//название объекта
$uid = $_GET["id"];//номер объекта в базе
$node = $_GET["node"];//тип объекта(счетсик или папка)
$n_obj = $_GET["nobj"];
$adr = $_GET["adr"];
$edizm = $_GET["edizm"];
if (!isset($curtime)) $curtime=0;
if (!isset($pwr)) $pwr=1;
if (!isset($date)) $date=$dc;
if(!isset($nrg)) $nrg=$type;
$znach = array();
$datar = array();
//начало обработки даты если все необходимые параметры введены==============================================================================
if (isset($dc) and isset($uid) and isset($n_obj) and isset($adr) and isset($pwr) and isset($nrg) and ( ($node==0) or ($node==1) ) )
{
	echo "<script>";
	
	echo "window.document.forms[0].iname.value='$name';\n";
echo "window.document.forms[0].id.value='$id';\n";
echo "window.document.forms[0].pid.value='$pid';\n";
echo "window.document.forms[0].lid.value='$lid';\n";
echo "window.document.forms[0].node.value='$node';\n";
echo "window.document.forms[0].dc.value='$dc';\n";
echo "window.document.forms[0].retros.value='$retros';\n";
	
//=================просчет исходного времени и представление его в необходимой форме дл¤ базы данных=============================
	if ($curtime==1) //если установлен флаг текща¤ дата
	{
		$currdate=date("d.m.Y H:i:s");
		list ($ac_dt,$ac_tm) = explode (" ",$currdate);
		list ($ac_day,$ac_month,$ac_year) = explode (".",$ac_dt);
		list ($ac_h,$ac_m,$ac_s) = explode (":",$ac_tm);
		if (($ac_m-$ac_m%3)<10) $add='0';else $add='';
		$tm=$ac_h.":".$add."".($ac_m-$ac_m%3).":".$ac_s;
		$date_header='за '.$ac_dt;//дата в заголовок
		$time=$ac_tm.' ';//врем¤ в заголовок
		$date=$ac_year."-".$ac_month."-".$ac_day." ".$tm;
		 echo "
   	
		function refresh()
		{
		window.document.topmenu.go.click();
		};
		setTimeout('refresh()',60000);";
		
		echo "window.document.forms[0].curtime.checked='$curtime';\n";
		echo "window.document.forms[0].curtime.value='$curtime';\n";
		
		echo "formatData.style.display='inline';\n";
		
	}
	else if ($curtime==0)
	{
		list ($ac_dt,$ac_tm) = explode (" ",$date);
		list ($ac_day,$ac_month,$ac_year) = explode (".",$ac_dt);
		list ($ac_h,$ac_m,$ac_s) = explode (":",$ac_tm);
		if (($ac_m-$ac_m%3)<10) $add='0';else $add='';
		$tm=$ac_h.":".$add."".($ac_m-$ac_m%3).":".$ac_s;
		$date_header='за '.$ac_dt;//дата в заголовок
		$time=$ac_tm.' ';//врем¤ в заголовок
		$date=$ac_year."-".$ac_month."-".$ac_day." ".$tm;
	}

	//echo "window.document.forms[0].dc.value='$dc';";
	//echo "<script>if (h1) h1.innerText=h1.innerText+' '+window.document.forms[0].disp.options[window.document.forms[0].disp.selectedIndex].innerText;</script>";
	echo "</script>";

include("include/mysql2.php");//соединение с базой данных
   $prec=$options['Prec'];
   $format="%0.0f";
   //$format="%01.".$prec."f";
	if (isset($date) and isset($uid) and isset($nrg) and isset($n_obj) and isset($adr) and isset($retros) )
	

  { showTitle($uid,$n_obj,$adr,$nrg);
    $count=incrementProgressBar();
	$count=incrementProgressBar();
	CalcZnach($date,$retros,$n_obj,$adr,$nrg);
	$count=incrementProgressBar();
	$count=incrementProgressBar();
	drawHeader();
	$count=incrementProgressBar();
	$count=incrementProgressBar();
	drawGrid();
	$count=incrementProgressBar();
	$count=incrementProgressBar();
}
	mysql_close();
}
function incrementProgressBar()// прогресс загрузки страинцы
	{
	 global $count;
	 $count++;
	 echo "<script language=\"JavaScript\">incrementProgressBar();</script>\n";
	 return $count;
	}	
//======================================основные исполн¤ющие операторы программы================================================


//==============================================================================================================================

//=======================определ¤ем точку учета и ее название===================================================================
function showTitle($uid,$n_obj,$adr,$nrg)
{ 
   global $izmtype; global $name; global $pname; global $znum;
   $result=mysql_query("select pwr,descript FROM izm_type WHERE izm_type=".$nrg);
   while ($res=mysql_fetch_array($result,MYSQL_NUM))
   {
		$izmtype=$res[0].' '.$res[1];
   }
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
	   
	 $ctype=$res[3]; 
	 $ktr=$res[4];
	 if ($n_type==0) {if ($ctype==0 or $ctype==-1 or $ctype==-2) {$znum= "номер счетчика ".$res[2];$zn=$res[2];} }
	 else {$znum=""; $zn="";}
	} 
}	
//==========================дополнительные финкции дл¤ рисовани¤ графика=========================================
function drawLine($startx, $starty, $endx, $endy, $color,$weight,$dashstyle)//рисование линии
	{
		echo '<v:line  style="position:absolute;" from="'.$startx.','.$starty.'" to="'.$endx.','.$endy.'" strokecolor="'.$color.'" strokeweight="'.$weight.'pt">';
		echo ' <v:stroke dashstyle="'.$dashstyle.'"/>';
		echo ' </v:line>';
	}
function drawBar($format, $isLowPower,$znach,$k1,$k2,$num,$top,$height,$width,$color)//рисуем столбец гистограммы
{
 
 echo '<div onclick="" class="bar" title="'.sprintf($format,$znach*$isLowPower).'" id=""><v:rect class="col" style="left:'.($k1+$k2*$num+2).';top:'.($top).';height:'.$height.';width:'.$width.'px;z-index:1;" ><v:fill angle="0" focus="100%" color="'.$color.'" color2="fill lighten(100)" type="gradient" method="sigma"/> <v:extrusion on=True backdepth="55" foredepth="8"  /></v:rect></div>';
 echo "\n";
}	
function drawBar2($select,$format,$znach,$isLowPower,$k1,$k2,$num,$top,$height,$width,$color)//рисуем столбец гистограммы
{
 echo '<div onclick="selected('.$select.')" class="bar" title="'.sprintf($format,$znach*$isLowPower).'" id="'.$num.'_'.$color.'"><v:rect class="col" style="left:'.($k1+$k2*$num+2).';top:'.$top.';height:'.$height.';width:'.$width.'px;z-index:1;" ><v:fill angle="0" focus="100%" color="'.$color.'" color2="fill lighten(50)" type="gradient" method="sigma" style="border:3px solid black"/> <v:extrusion on="t" backdepth="16" foredepth="12"  /></v:rect></div>';
 echo "\n";
}	
function drawPodpis($width,$height,$top,$left,$string)
{
 
 echo ' <v:shape type="#t202" style="z-index:+100;position:absolute;top:'.($top+$height+5).';left:'.($left-30).';width:'.$width.'; height:50;" filled="f" fillcolor="#ffffcc" stroked="f">
   <v:textbox>
 <div style="color:black;text-align:center;font-size:10px;z-index:+100; 
    -moz-transform: rotate(90deg);
    -webkit-transform: rotate(90deg);
    -o-transform: rotate(90deg);
    layout-flow: vertical-ideographic;">	 <b> '.$string.'</b>     </div>   
	</v:textbox>
 </v:shape>';
}
function drawPodpis2($width,$height,$top,$left,$string)
{
 
 echo ' <v:shape type="#t202" style="z-index:+100;position:absolute;top:'.($top+$height+5).';left:'.($left-30).';width:'.($width+20).'; height:50;" filled="f" fillcolor="#ffffcc" stroked="f">
   <v:textbox>
 <div style="color:black;text-align:center;font-size:10px;z-index:+100;">	 <b> '.$string.'</b>     </div>   
	</v:textbox>
 </v:shape>';
}

//==================================–исуем статические элементы==================================================
function drawHeader()
	{   global $izmtype; global $name; global $pname; global $znum;
		global $date;global $date_header;global $color;global $time;global $node; 
		echo '<script language="JavaScript">incrementProgressBar();</script>';
		$result4=mysql_query("select * from seasons_hint order by n_season");
	if ($node==-2)
	{//если нужно считать по сезонам
		if ($result4)
		{
		 	while ($res4=mysql_fetch_array($result4,MYSQL_NUM))
			{
			 list ($ac_year,$ac_month,$ac_day) = explode ("-",$date);
			 $begin_date[$res4[0]-1]=mktime (0,0,0, $res4[2], $res4[1], $ac_year);
			 $end_date[$res4[0]-1]=mktime (0,0,0, $res4[4], $res4[3], $ac_year);
		 	}	
		 }				 
		 $curdate=str2date($date);
		 if ($curdate>=$begin_date[1] and $curdate<=$end_date[1])
			  {$isHeatSeason="Лето";$seas=2;} 
		 else {$isHeatSeason="Зима";$seas=1;}
	 }
		echo  '<div style="margin-top:25px;text-align:center;position:absolute;z-index:-1;width:100%;"><v:textbox id="nazv" style="font-size:12px;font-weight:bolder;">'.$pname.'&nbsp;'.$name.'&nbsp; '.$znum.'<br>'.$izmtype.'  '.$date_header.'&nbsp;</v:textbox><v:textbox id="timer" style="font-size:12px;font-weight:bolder;">'.$time.'</v:textbox></div>
		<v:group id="myDiv" editas="canvas" style="margin-top:15;margin-left:5;" style="width:100%;height:500px;" coordorigin="0,0" coordsize="850,450"><br>';
			
		echo '<script language="JavaScript">incrementProgressBar();</script>';
		echo '<v:rect fillcolor = "#eaeaea" style="z-index:-1;position:absolute;width:770;height:2;left:55;top:476" strokecolor="black" strokeweight="1px"><v:extrusion on=True backdepth="22" foredepth="28" skewangle="-133" style="top:470"/></v:rect>';
		echo '<v:rect fillcolor = "#eaeaea" style="z-index:-1;position:absolute;width:770;height:425;left:65;top:40;" strokecolor="black" strokeweight="1px"/>';
	}
function drawGrid()
	{
	global $znach; global $flag;
	global $rangePower; global $prec; global $format;
	global $izmtype; global $name; global $pname; global $znum;
	global $date;global $date_header;global $color;global $time;global $node;
	global $retros; global $int_val; global $datar;
		echo '<v:rect id="rect0" strokecolor="black" strokeweight="1px" fillcolor = "#eaeaea" style="position:absolute;left:50;top:55;width:5;height:425;z-index:-1">	<v:extrusion on=True backdepth="32" foredepth="12"/></v:rect>';
		for ($i=0;$i<=20;$i++)
		{
			drawLine(35,483-$i*20,50,483-$i*20,"black",1,"solid");
			drawLine(50,483-$i*20,67,462-$i*20,"black",1,"dot");
			drawLine(67,462-$i*20,835,462-$i*20,"black",1,"dot");
		}	
		if (count($znach)>0)
		{
			$maxim=max($znach); 
			$minim=min($znach);
			if($maxim==0) $maxim=1;
		}
		$isLowPower=legend();
		$color="blue";
		$j=0;
		$k1=52; $k2=760/($retros/3);
		$width=760/($retros/3); //ширина окна для столбцов
		for ($i=$int_val-$retros/3;$i<=$int_val-1;$i++)
		{
			
			$color="yellow";
			if ($maxim == '') $maxim = 1;
			$height=abs($znach[$i]*400/($maxim-0));	
			$top=76+410-abs($znach[$i]*400/($maxim-0));
			$left=92+$k2*$j-20;
			$result3=mysql_query("select n_zone FROM intervals_3m WHERE inter_val=".$i);
			if ($result3){
			while ($res3=mysql_fetch_array($result3,MYSQL_NUM))	
			{		  $zona=$res3[0];	}
			}
			if ($result3) {mysql_free_result($result3);}
			$result3=mysql_query("select gist_color from zones where n_zone=".$zona);
			if ($result3){
			while ($res3=mysql_fetch_array($result3,MYSQL_NUM))	
			{		  $color=$res3[0];	}
			}
			if ($znach[$i]>=$maxim) $color="yellow";
			
			drawBar($format,$isLowPower,$znach[$i],$k1,$k2,$j,$top,$height,$width,$color);
			list($dt,$tm) = explode (" ",$datar[$i]);
			list($h,$m,$s)=explode(":",$tm);
			$tm=$h.".".$m;
			if ($retros<=60) 
			{
				drawPodpis2($width,$height,$top,$left,$tm);
			}
			else {
			drawPodpis($width+11,$height,$top,$left+3,$tm);
			}
			$j++;
			
		}
		
		
	}

//=========================================«аполн¤ем массив значани¤ми на выбранном промежутке=====================================
function CalcZnach($date,$retros,$n_obj,$adr,$nrg)
	{
		global $znach; global $int_val; global $datar;
		$result = mysql_query("select inter_val,znach,data FROM val_3m WHERE data BETWEEN DATE_ADD(DATE_FORMAT('".$date."','%Y-%m-%d %H:%i:%s'), INTERVAL -".$retros." MINUTE) AND DATE_FORMAT('".$date."','%Y-%m-%d %H:%i:%s') AND izm_type=".$nrg." AND n_obj=".$n_obj." AND link_adr=".$adr."");
		if ($result) 
		{
			while ($res=mysql_fetch_array($result,MYSQL_BOTH))
			{
				$znach[$res[0]]=$res[1];
				$int_val=$res[0];
				$datar[$res[0]] = $res[2];
				
			}
		}
		
			print_r($z);
		    if ($result3) {mysql_free_result($result3); echo "true";}
		
	}
//=========================================создание вертикального столбца со значени¤ми=============================================	
function legend()
{
	$high=0;	 $title_kf=1;
	global $znach;
	global $nrg;
	global $edizm;
	
	if (count($znach)==0) return;
		if ((max($znach)>0) and (min($znach)<0))		$high=max($znach)-min($znach);
		if ((max($znach)>0) and (min($znach)>=0))		$high=max($znach);
		if ((max($znach)<=0) and (min($znach)<0))		$high=abs(min($znach));
		if ($high<1) $title_kf=1000;
		if ($high>=1) $title_kf=1;
		if ($edizm == 1000) {$b ='М';} else {$b ='к';}
		echo '<v:shape class="shape" style="z-index:+300;position:absolute;left:-5;width:50;height:50;top:50;" > <v:textbox id="lable" class="text">';
		if (($nrg==9) or ($nrg==10)) 
		{echo $b.'Вт'; 
		}
		else echo $b.'вар';
		
		echo'</v:textbox></v:shape>' ;
		$high = $high*$title_kf;
		for ($i=20;$i>=0;$i--)
   		{
		 
		 $text=round($i*$high/20)/$edizm;  $top=470-$i*20;
	     echo '<v:shape id="" class="shape" style="left:-15;top:'.$top.'"> <v:textbox id="" class="text">'.$text.'</v:textbox> </v:shape>';
	    }
		return $title_kf;
}
//==================================================================================================================================

?>


</div>	
<div style="position:relative; top:100;"></div>
</body>
</html>