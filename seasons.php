<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>Untitled</title>
</head>

<body>
<?
include("include/mysql.php"); //  Соединяемся с БД
include("util_fun.php");
$TIME_START = getmicrotime(); 
$date_1="2010-01-01";$i=0;
function str2date($in){
$t = split("/",$in);
if (count($t)!=3) $t = split("-",$in);
if (count($t)!=3) $t = split(" ",$in);
if (count($t)!=3) return -1;
if (!is_numeric($t[0])) return -1;
if (!is_numeric($t[1])) return -2;
if (!is_numeric($t[2])) return -3;

if ($t[0]<1902 || $t[0]>2037) return -3;
return mktime (0,0,0, $t[1], $t[2], $t[0]);
}
list ($ac_year,$ac_month,$ac_day) = explode ("-",$date_1);
$summer_begin=mktime (0,0,0, 4, 15, $ac_year);
$summer_end=mktime (0,0,0, 10, 14, $ac_year);

for ($i=0;$i<=364;$i++)
{
	 $curdate=str2date($date_1);
if ($curdate>=$summer_begin and $curdate<=$summer_end)
{// echo $i."_".$date_1."_Лето<br>";
$isHeatSeason="Лето";$seas=2;} 
else { //echo $i."_".$date_1."_Зима<br>";
$isHeatSeason="Зима";$seas=2;}

echo $i."_".$date_1."_".$summer_begin."_".$curdate."_".$summer_end."_".$isHeatSeason."<br>";
list ($ac_year,$ac_month,$ac_day) = explode ("-",$date_1);
	$result = mysql_query("INSERT INTO seasons (n_season,begin_day,begin_month,descript) VALUES('".$seas."','".$ac_day."','".$ac_month."','".$isHeatSeason."')");
		    if (($result)) $status="";
	    	  else        $status="Ошибка добавления элемента: ".mysql_error()."";
//echo "INSERT INTO seasons (n_season,begin_day,begin_month,descript) VALUES('".$seas."','".$ac_day."','".$ac_month."','".$isHeatSeason."')";

   $result1=mysql_query("select DATE_ADD( DATE_FORMAT('".$date_1."','%Y-%m-%d'), INTERVAL +1 DAY)");
     $res1=mysql_fetch_array($result1,MYSQL_NUM);
	  $date_1=$res1[0];
	 echo $status."<br>";


}	 
	 
?>

<center>
<div style="color:red;z-index:+1;position:absolute;top:10px; left:400px" class="help" ><b>.::</b>
Время выполнения запроса <?=number_format($TIME_SCRIPT,3,".","");?> сек.
<b>::.</b>
</div>
</center>

</body>
</html>
