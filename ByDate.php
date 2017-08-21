<?
include("include/mysql.php"); //  Соединяемся с БД
include("util_fun.php");
echo "	<meta http-equiv='Content-Type' content='text/html; charset=windows-1251'>";

$TIME_START = getmicrotime(); 
?>
	<style media="print">
	.help
	{display:none;font-size:10px;}
	</style>
	<style media="screen">
	.help
	{display:inline;font-size:10px;}
	body
	{
	 font-size:14px;
	 font-weight:bold;
	}
	</style>
	
<script language="php">

Function GetDates()
{
	global $HTTP_GET_VARS;
	$dateList=$HTTP_GET_VARS["allSelected"]; 
	$nobj=$_GET["nobj"];	$adr=$_GET["adr"]; $disp=$_GET["disp"];

			$result = mysql_query("SELECT * FROM counters where n_obj=".$nobj." and link_adr=".$adr."");
			if ($result)
			{
			 $row=mysql_fetch_array($result,MYSQL_BOTH);
			 $name=$row["descript"];$znum=$row["znum"];
			 echo "Ручной запрос по счетчику: ".$name.", зав.№ ".$znum."<br>";
			}
if (isset($dateList))
 {
	$items = split( ',', $dateList);
	$tempstr="Date list(sorted by user selected)-:-)"."<br>"; 
	for ($i = 0; $i < count($items); $i++) 
	{
		$tempstr=$tempstr.$items[$i]."<br>";
		
		if (strlen($items[$i])==16)
		{
			$itemStr=split( ' ', $items[$i]);
			$dateStr=$itemStr[0]; $timeStr=$itemStr[1];
			list($day,$month,$year)=explode(".",$dateStr);
			$dateStr=$year."/".$month."/".$day;
			list($hour,$minute)=explode(":",$timeStr);
			$zapros=$hour*2+(($minute<30)?0:1)+1;
		}
		if (strlen($items[$i])==10)
		{
			$dateStr=$items[$i];
			list($year,$month,$day)=explode("/",$dateStr);
			$zapros=0;$hour="24";$minute="00";
		}
			echo "<br>".$nobj."_".$adr."_".$dateStr."_".$hour.":".$minute."&nbsp;&nbsp;";
//			echo $nobj."_".$adr."_".$dateStr."_".$zapros."<br>";
			$result = mysql_query("SELECT * FROM manual_query where n_obj=".$nobj." and link_adr=".$adr." and date_query=DATE_FORMAT('".$dateStr."','%Y-%m-%d') and num_query=".$zapros."");
			if ($result)
			if (mysql_num_rows($result)>0)
			{
			echo "такая запись уже есть"; 
			 $result = mysql_query("UPDATE manual_query set flag_query=1 where n_obj=".$nobj." and link_adr=".$adr." and date_query=DATE_FORMAT('".$dateStr."','%Y-%m-%d') and num_query=".$zapros."");
				    if (($result) and ($status=="")) $status="";
			    	  else        $status="Ошибка изменения  ".mysql_error()."\n";
			}
			else 
			{ 
			 echo "запрос установлен";
				$result = mysql_query("INSERT INTO manual_query (n_obj,link_adr,date_query,num_query,flag_query)  VALUES('1','1',DATE_FORMAT('".$dateStr."','%Y-%m-%d'),'".$zapros."','1')");
					    if (($result) and ($status=="")) $status="";
				    	  else        $status="<br>Ошибка добавления элемента: ".mysql_error()."";
			}
		
		}
	if ($status=="") echo "<br>OK<br>"; else echo "<br>".$status."<br>";
	return $tempstr;
  }
  else
  {
  $now=date('d.m.Y H:i:s');
 $state=array("запрос не установлен","установлено запросов","выполняется запросов","успешно выполнено запросов","не выполнено запросов");  
  
  echo "сейчас ".$now."<br>";

	$result = mysql_query("SELECT flag_query,count(flag_query) FROM manual_query where n_obj=".$nobj." and link_adr=".$adr." group by flag_query order by flag_query");
	if ($result)
	{

	 while ($row=mysql_fetch_array($result,MYSQL_BOTH))
	 {
	   echo $state[$row[0]].": ".$row[1]."<br>";
	 }
	}
//  echo "всего запросов: ".$all_q."<br>";
  
   echo "
   		<script>

		</script>";
  }	
}

</script>
<?php
		$returndate=GetDates();
//		echo $returndate;
$TIME_END = getmicrotime();
$TIME_SCRIPT = $TIME_END - $TIME_START; 
?>
<center>
<div style="color:red;" class="help"><b>.::</b>
Время выполнения запроса <?=number_format($TIME_SCRIPT,3,".","");?> сек.
<b>::.</b>
</div>
</center>
