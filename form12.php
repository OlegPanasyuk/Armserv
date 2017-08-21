<html>
<head>
	<title>Свобная таблица по воде Часовые показания.</title>
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
echo "<script language=\"JavaScript1.2\" src=\"js/control_f13.js\"></script>";
require_once("include/vbs.php");
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

<body id="f1" topmargin=0 marginheight=0 marginwidth=0 scroll="auto" onload="startIncrement();" background=tree/imgs/fon.gif>
	<div id="padding" style="height:60px;" class="help"></div>
	<div id="content" style="height:80%;">
<?php
include("util_fun.php");
$name = $_GET["iname"];
$uid = $_GET["id"];
$pid = $_GET["pid"];
$lid = $_GET["lid"];
$node = $_GET["node"];
$dc = $_GET["dc"];
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
 $summ = array();
 $count=0;$zn="";$ktr=1;
//================================================================================================================================
echo "
<script language=\"JavaScript1.2\">
	if (window.parent.toc.ntype)
	{
	 node=window.parent.toc.ntype.value;
     if (node==2 || node==3) {
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

$TIME_START = getmicrotime();

if (isset($date_1) and isset($uid) and isset($n_obj) and isset($adr) and isset($pw_en) and ($node==2 or $node==3) )
{
include("include/mysql.php"); //  Соединяемся с БД
list ($ac_day,$ac_month,$ac_year) = explode (".",$date_1);
$date_header1=$ac_day.'.'.$ac_month.'.'.$ac_year;
$date_1=$ac_year.'-'.$ac_month.'-'.$ac_day;
$type_izm=array();

echo "<script>\n";
echo "window.document.forms[0].disp.value='$disp';\n";
echo "window.document.forms[0].dc.value='$dc';\n";
echo "window.document.forms[0].iname.value='$name';\n";
echo "window.document.forms[0].id.value='$uid';\n";
echo "window.document.forms[0].pid.value='$pid';\n";
echo "window.document.forms[0].lid.value='$lid';\n";
echo "window.document.forms[0].node.value='$node';\n";
echo "window.document.forms[0].maxp.value='$maxp';\n";
echo "window.document.forms[0].edizm.value='$edizm';\n";
if ($disp!=1){
				echo "window.document.topmenu.maxp.style.visibility='hidden';\n";
				echo "maxp_lab.innerText='';\n";
			}
echo "formatData.style.display='inline';\n";
echo "</script>\n";
?>

		<table width="100%" cellpadding="0" cellspacing="0" height="100%">
			<tr><td height="100%">
 				<table width="100%" cellpadding="0" cellspacing="0" height="100%">
 					<tr><td valign="top" bgcolor="EEEEEE">
						<img src="data:image/gif;base64,R0lGODlhBwAHAID/AMDAwAAAACH5BAEAAAAALAAAAAAHAAcAQAIGhI+py40FADs=" height="1" width="1">
					</td>
					<td width="100%" valign="top" background="tree/imgs/fon.gif">
	 				<table border="1" bordercolor="A5D7D6" width="100%" cellpadding="10" id="TB">
	 				<tr><td  id="container">
	 				<!--
						контент сводной таблицы
					-->
<?php
function incrementProgressBar()
{
 global $count;
 $count++;
// echo "<script language=\"JavaScript\">incrementProgressBar();</script>\n";
 return $count;
}

PrintHeader($pw_en,$uid,$n_obj,$adr,$date_header1);
$count=incrementProgressBar();
$count=incrementProgressBar();
PrintData($pw_en,$date_1,$uid,$n_obj,$adr,$table);
//$count=incrementProgressBar();
//$count=incrementProgressBar();
//if ($pw_en<3) PrintSumData($pw_en,$date_1,$uid,$n_obj,$adr,$table);
//$count=incrementProgressBar();
//$count=incrementProgressBar();
//if ($pw_en<3) PrintZoneData($pw_en,$date_1,$uid,$n_obj,$adr,$table);
mysql_close();
}

function PrintHeader($pw_en,$uid,$n_obj,$adr,$date_header1)
{
  global $type_izm;
  global $pwr;
  global $nrg;
  global $colname;
  global $zn;
  global $ktr;
  global $edizm;
  global $node;
  global $counters;
  global $cnt1;
  global $col;
  $counters = array();
  $cnt1=0;  $cnt2=0;
  $result = mysql_query("select COUNT(item_name) from objects WHERE item_parent_id =".$uid." AND node_type = 5");

  if ($result)
  {
  	$res = mysql_fetch_array($result,MYSQL_BOTH);
  	$col = $res[0];
  }
  $result = mysql_query("select item_name,node_type,item_id from objects WHERE item_parent_id =".$uid." AND node_type = 5");
  if ($result) {
  	while ($res= mysql_fetch_array($result,MYSQL_BOTH)) {
  		$result2 = mysql_query("select n_obj,link_adr from counters where uid=".$res[2]." ");
  		if ($result2) {
  			$res2 = mysql_fetch_array($result2,MYSQL_BOTH);
  			$counters[$cnt1][0]=$res2[0];
  			$counters[$cnt1][1]=$res2[1];
  		}
  		$cnt1++;
  	}
  }	else {
  	echo "array is empty";
  }
  echo "<table cellpadding='0' cellspacing='0' align='center' border='0' id='TB2'>\n";
  echo "<tr><td colspan='".($col*2+1)."' align='center'>Сводная таблица расходомеров (часовые значения)<td></tr>\n";
  echo "<tr><td colspan='".($col*2+1)."' align='center'><FONT COLOR='midnightblue' style='font-size:12px'>Данные за ".$date_header1." </FONT></td></tr>\n";
  if ($pw_en == 3) $name_of_data = 'Показания на конец часа';
  if ($pw_en == 2) $name_of_data = 'Накопленный объем за час';
  echo "<tr><td colspan='".($col*2+1)."'  align='center'>".$name_of_data."&nbsp;</td></tr>";
  echo "<tr><td class='x23' style='border-bottom:none;'>&nbsp;</td>\n";
  
  echo "<td class='x23' colspan='".($col*2)."' style='border-left:none' align='center'>Вода</td></tr>\n";
  echo "<tr>";
  echo "<td class='x23' style='border-top:none;'>Время</td>\n";
  $result = mysql_query("select item_name,node_type from objects WHERE item_parent_id =".$uid." AND node_type = 5");
  if ($result) {
  	while ($res= mysql_fetch_array($result,MYSQL_BOTH)) {
 		echo "<td class='x23' style='border-top:none;border-left:none' width='115'>".$res[0]."</td>\n";
 		echo "<td class='x23' style='border-top:none;border-left:none' width='10'>&nbsp;</td>\n";
  	}
  }	else {
  	echo "array is empty";
 }
  echo "</tr>";
  
}

function PrintData($pw_en,$date_1,$uid,$n_obj,$adr,$table) {
  global $type_izm;
  global $pwr;
  global $nrg;
  global $colname;
  global $ktr;
  global $node;
  global $edizm;
  global $summ;
  global $counters;
  global $cnt1;
  $izm = array(); $flag = array(); $start_pokaz = array();
  $summ = array();
  // производим выборку для поиска максимального интервала
  $maxInterval = 0;
  for ($i = 0; $i<=$cnt1; $i++) {
  	$result=mysql_query("select MAX(".$table.".inter_val) FROM ".$table.",intervals WHERE ".$table.".data='".$date_1."' AND izm_type=5 AND n_obj=".($counters[$i][0])." AND link_adr=".($counters[$i][1])."  And ".$table.".inter_val = intervals.inter_val Order By ".$table.".inter_val, ".$table.".izm_type");
  	if($result) {
  		while($res = mysql_fetch_array($result, MYSQL_BOTH))
  		{
  			if ($maxInterval<$res[0])
  			{
  				$maxInterval = $res[0];
  			}
  		}
  	} else {
  		//echo "array is down";
  	}
  	unset($result);
  }


  for ($i=1; $i<=$maxInterval;$i++) {
  	if($i % 2 == 0) {

  		if ($pw_en == 3) {
  			// вывод показаний конечных на каждый час
  				$result=mysql_query("select ".$table.".inter_val,beg_int,end_int ,intervals.n_zone,intervals.max_zone  FROM ".$table." ,intervals WHERE ".$table.".data='".$date_1."' AND izm_type=5 AND ".$table.".inter_val=".$i." And ".$table.".inter_val = intervals.inter_val Order By ".$table.".inter_val, ".$table.".izm_type");
  				$result2 = mysql_query("select ".$table.".inter_val,beg_int,end_int ,intervals.n_zone,intervals.max_zone  FROM ".$table." ,intervals WHERE ".$table.".data='".$date_1."' AND izm_type=5 AND ".$table.".inter_val=".($i-1)." And ".$table.".inter_val = intervals.inter_val Order By ".$table.".inter_val, ".$table.".izm_type");
  				if($result) {
  					while ($res = mysql_fetch_array($result,MYSQL_BOTH)) {
  						$res2 = mysql_fetch_array($result2,MYSQL_BOTH);
  						$end = $res[2]; $beg_int=$res2[1];
   					}
  				} else {
  					echo "query is down";
  				}
  				  		echo "<tr><td class='x26' align='center'  style='border-top:none;padding-right: 1px;' width='100'>".$beg_int." - ".$end."</td>";
  				for ($j = 0; $j<=$cnt1; $j++) {
  					$result=mysql_query("select ".$table.".znach, ".$table.".flag  FROM ".$table." ,intervals WHERE ".$table.".data='".$date_1."' AND izm_type=5 AND n_obj=".$counters[$j][0]." AND link_adr=".$counters[$j][1]." AND ".$table.".inter_val=".$i." And ".$table.".inter_val = intervals.inter_val Order By ".$table.".inter_val, ".$table.".izm_type");
  					if ($result) {
  						while($res = mysql_fetch_array($result,MYSQL_BOTH)){
  							if ($j>0) {
                  if ($res[0] < 0) {$res[0] = 0;} else {}
  								echo "<td class='x22' align='center' style='border-top:none;padding-right: 1px;border-left:none;' width='115'>".
                 format($res[0])."&nbsp;</td><td class='x22' align='center' style='border-top:none;padding-right: 1px;border-left:none;' width='10'>&nbsp;".$res[1]."</td>";
  								}
  							else {
  								echo "<td class='x22' align='center' style='border-top:none;padding-right: 1px;' width='115'>&nbsp;".format($res[0])."</td><td class='x22' align='center' style='border-top:none;padding-right: 1px;border-left:none;' width='10'>&nbsp;".$res[1]."</td>";
  								}
  						}
  					}
  					
  				}
  			}
  			// выввод разности показаний за каждый час
  		if ($pw_en == 2) {
  				$result=mysql_query("select ".$table.".inter_val,beg_int,end_int ,intervals.n_zone,intervals.max_zone  FROM ".$table." ,intervals WHERE ".$table.".data='".$date_1."' AND izm_type=5 AND ".$table.".inter_val=".$i." And ".$table.".inter_val = intervals.inter_val Order By ".$table.".inter_val, ".$table.".izm_type");
  				$result2 = mysql_query("select ".$table.".inter_val,beg_int,end_int ,intervals.n_zone,intervals.max_zone  FROM ".$table." ,intervals WHERE ".$table.".data='".$date_1."' AND izm_type=5 AND ".$table.".inter_val=".($i-1)." And ".$table.".inter_val = intervals.inter_val Order By ".$table.".inter_val, ".$table.".izm_type");
  				if($result) {
  					while ($res = mysql_fetch_array($result,MYSQL_BOTH)) {
  						$res2 = mysql_fetch_array($result2,MYSQL_BOTH);
  						$end = $res[2]; $beg_int=$res2[1];
   					}
  				} else {
  					echo "query is down";
  				}
  				  		echo "<tr><td class='x26' align='center'  style='border-top:none;padding-right: 1px;' width='100'>".$beg_int." - ".$end."</td>";

  				for ($j = 0; $j<=$cnt1; $j++) {
  					if ($i == 2) {
  						$result = mysql_query("select ".$table.".znach, ".$table.".flag  FROM ".$table." ,intervals WHERE ".$table.".data='".$date_1."' AND izm_type=5 AND n_obj=".$counters[$j][0]." AND link_adr=".$counters[$j][1]." AND ".$table.".inter_val=".$i." And ".$table.".inter_val = intervals.inter_val Order By ".$table.".inter_val, ".$table.".izm_type");
  						$result2 = mysql_query("select ".$table.".znach, ".$table.".flag  FROM ".$table." ,intervals WHERE ".$table.".data=DATE_ADD('".$date_1."',interval -1 DAY) AND izm_type=5 AND n_obj=".$counters[$j][0]." AND link_adr=".$counters[$j][1]." AND ".$table.".inter_val=48 And ".$table.".inter_val = intervals.inter_val Order By ".$table.".inter_val, ".$table.".izm_type");
  						if ($result2) {
  						if ($res = mysql_fetch_array($result, MYSQL_BOTH) and $res2 = mysql_fetch_array($result2,MYSQL_BOTH)) {
  								if ($j>0) {

                    if (max($res[1],$res2[1]) != "") {
                      $a = 0;
                      $flag [$j] = max($res[1],$res2[1]);
                    } else {
                      $a =  $res[0]-$res2[0];
                      $summ[$j] = $summ[$j] + $res[0]-$res2[0];
                    }
  									echo "<td class='x22' align='center' style='border-top:none;padding-right: 1px;border-left:none;' width='115'>".format($a)."&nbsp;</td><td class='x22' align='center' style='border-top:none;padding-right: 1px;border-left:none;' width='10'>&nbsp;".$res[1]."</td>";
  								}
  								else {
                    if (max($res[1],$res2[1]) != "") {
                      $a = 0;
                      $flag [$j] = max($res[1],$res2[1]);
                    } else {
                      $a =  $res[0]-$res2[0];
                      $summ[$j] = $summ[$j] + $res[0]-$res2[0];
                    }
  									echo "<td class='x22' align='center' style='border-top:none;padding-right: 1px;' width='115'>&nbsp;".format($a)."</td><td class='x22' align='center' style='border-top:none;padding-right: 1px;border-left:none;' width='10'>&nbsp;".$res[1]."</td>";
  								}
  							}
  						}
  					} else {
  						$result = mysql_query("select ".$table.".znach, ".$table.".flag  FROM ".$table." ,intervals WHERE ".$table.".data='".$date_1."' AND izm_type=5 AND n_obj=".$counters[$j][0]." AND link_adr=".$counters[$j][1]." AND ".$table.".inter_val=".$i." And ".$table.".inter_val = intervals.inter_val Order By ".$table.".inter_val, ".$table.".izm_type");
  						$result2 = mysql_query("select ".$table.".znach, ".$table.".flag  FROM ".$table." ,intervals WHERE ".$table.".data='".$date_1."' AND izm_type=5 AND n_obj=".$counters[$j][0]." AND link_adr=".$counters[$j][1]." AND ".$table.".inter_val=".($i-2)." And ".$table.".inter_val = intervals.inter_val Order By ".$table.".inter_val, ".$table.".izm_type");

  						if ($result2) {
  						if ($res = mysql_fetch_array($result, MYSQL_BOTH) and $res2 = mysql_fetch_array($result2,MYSQL_BOTH)) {
  								if ($j>0) {
                    if (max($res[1],$res2[1]) != "") {
                      $a = 0;
                      $flag [$j] = max($res[1],$res2[1]);
                    } else {
                      $a =  $res[0]-$res2[0];
                      $summ[$j] = $summ[$j] + $res[0]-$res2[0];
                    }
  									echo "<td class='x22' align='center' style='border-top:none;padding-right: 1px;border-left:none;' width='115'>".format($a)."&nbsp;</td><td class='x22' align='center' style='border-top:none;padding-right: 1px;border-left:none;' width='10'>&nbsp;".$res[1]."</td>";
  								}
  								else {
                    if (max($res[1],$res2[1]) != "") {
                      $a = 0;
                      $flag [$j] = max($res[1],$res2[1]);
                    } else {
                      $a =  $res[0]-$res2[0];
                      $summ[$j] = $summ[$j] + $res[0]-$res2[0];
                    }
  									echo "<td class='x22' align='center' style='border-top:none;padding-right: 1px;' width='115'>&nbsp;".format($a)."</td><td class='x22' align='center' style='border-top:none;padding-right: 1px;border-left:none;' width='10'>&nbsp;".$res[1]."</td>";
  								}
  							}
  						}
  					}
  				}
  			}

  		echo "</tr>";

  		}
  	}
    if ($pw_en == 2) {
    echo "<tr><td class='x26' align='center'  style='border-top:none;padding-right: 1px;' width='100'>Сумма</td>";
    for ($j=0; $j<$cnt1; $j++) {
      if ($j>0) {
        echo "<td class='x22' align='center' style='border-top:none;padding-right: 1px;border-left:none;' width='115'>".format($summ[$j])."&nbsp;</td> <td class='x22' align='center' style='border-top:none;padding-right: 1px;border-left:none;' width='10'>".$flag[$j]."&nbsp;</td>";
      } else {
        echo "<td class='x22' align='center' style='border-top:none;padding-right: 1px;' width='115'>".format($summ[$j])."&nbsp;</td> <td class='x22' align='center' style='border-top:none;padding-right: 1px;border-left:none;' width='10'>".$flag[$j]."&nbsp;</td>";
      }
    }
  }


    echo "</tr>";


  }

echo "</table>";
?>
	 				</td></tr></table>
					</td></tr></table>
					</td></tr></table>
	</div>
<?
if (!isset($pw_en)) $pw_en=0;
if (!isset($date_1)) $date_1=date('Y-m-d');
list($ac_year,$ac_month,$ac_day)=explode("-",$date_1);
echo "<div id='activator' ONCLICK=ToXls_7('TB',1,'".$pw_en."','".$count."',0,'".$ac_year."-".$ac_month."-".$ac_day."','".$zn."',".($col*2+1).")></div>\n"; 
?>
<script language="VBScript" src="js/excel_export.vbs">
<!-- 
// --> 
</script>
</body>
</html>