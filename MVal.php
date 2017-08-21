<?
include("include/mysql.php"); //  Соединяемся с БД
include("util_fun.php");
header("Content-type: text/plain; charset=windows-1251");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);

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
	$nobj=$_GET["nobj"];	$adr=$_GET["adr"]; $param=$_GET["param"];

			$result = mysql_query("SELECT * FROM counters where n_obj=".$nobj." and link_adr=".$adr."");
			if ($result)
			{
			 $row=mysql_fetch_array($result,MYSQL_BOTH);
			 $name=$row["descript"];$znum=$row["znum"];
			 echo "Запрос мгновенных по счетчику: ".$name.", зав.№ ".$znum."<br>";
			}

if (isset($param))
{
  switch ($param)
  {
   case 0:  {
    $insertStr=$nobj.','.$adr.',1,0,0,0';
    $updateStr='m_query=1, a_cnt_1=0, a_cnt_2=0, a_cnt_3=0';
   }
   break;
   case 1: {
    $insertStr=$nobj.','.$adr.',1,1,0,0';
    $updateStr='m_query=1, a_cnt_1=1, a_cnt_2=0, a_cnt_3=0';
   }
   break;
   case 2: {
    $insertStr=$nobj.','.$adr.',1,0,1,0';
    $updateStr='m_query=1, a_cnt_1=0, a_cnt_2=1, a_cnt_3=0';
   }
   break;
   case 3: {
    $insertStr=$nobj.','.$adr.',1,1,1,0';
    $updateStr='m_query=1, a_cnt_1=1, a_cnt_2=1, a_cnt_3=0';
   }
   break;
   case 4: {
    $insertStr=$nobj.','.$adr.',1,0,0,1';
    $updateStr='m_query=1, a_cnt_1=0, a_cnt_2=0, a_cnt_3=1';
   }
   break;
   case 5: {
    $insertStr=$nobj.','.$adr.',1,1,0,1';
    $updateStr='m_query=1, a_cnt_1=1, a_cnt_2=0, a_cnt_3=1';
   }
   break;
   case 6: {
    $insertStr=$nobj.','.$adr.',1,0,1,1';
    $updateStr='m_query=1, a_cnt_1=0, a_cnt_2=1, a_cnt_3=1';
   }
   break;
   case 7: {
    $insertStr=$nobj.','.$adr.',1,1,1,1';
    $updateStr='m_query=1, a_cnt_1=1, a_cnt_2=1, a_cnt_3=1';
   ;}
   break;
  }
//			echo $nobj."_".$adr."_".$dateStr."_".$zapros."<br>";

			$result = mysql_query("SELECT * FROM query_status where n_obj=".$nobj." and link_adr=".$adr."");
			if ($result)
			if (mysql_num_rows($result)>0)
			{
			echo "такая запись уже есть"; 
			 $result = mysql_query("UPDATE query_status set ".$updateStr." where n_obj=".$nobj." and link_adr=".$adr."");
				    if (($result) and ($status=="")) $status="";
			    	  else        $status="Ошибка изменения  ".mysql_error()."\n";
			}
			else 
			{ 
			 echo "запрос установлен";
				$result = mysql_query("INSERT INTO query_status (n_obj,link_adr,m_query,a_cnt_1,a_cnt_2,a_cnt_3)  VALUES(".$insertStr.")");
					    if (($result) and ($status=="")) $status="";
				    	  else        $status="Ошибка добавления элемента: ".mysql_error()."";
			}

	if ($status=="") echo "<br>OK<br>"; else echo "<br>".$status."<br>";
   echo "
   		<script>
		function refresh()
		{
		window.location.href='MVal.php?nobj=".$nobj."&adr=".$adr."';
		};
		setTimeout('refresh()',5000);
		</script>";
  }
  else
  {
  $now=date('d.m.Y H:i:s');
 $state=array("нет запроса","установлен","выполняется","успешно выполнен","не выполнен");
 $flag_state=array(); 
  echo "сейчас ".$now."<br>";
	$result = mysql_query("SELECT m_query,a_cnt_1,a_cnt_2,a_cnt_3 FROM query_status where n_obj=".$nobj." and link_adr=".$adr."");
	if ($result)
	{
	 if ($row=mysql_fetch_array($result,MYSQL_BOTH))
	 {
	   echo "запрос мгновенных значений: ".$state[$row[0]]." <br>";
	   echo "запрос архива фаз: ".$state[$row[1]]." <br>";
	   echo "запрос архива состояний: ".$state[$row[2]]." <br>";
	   echo "запрос архива корректировок: ".$state[$row[3]]." <br>";

	 $isReady=1;
		for ($i=0;$i<4;$i++)
		{
			if (($row[$i]==1) or ($row[$i]==2))
			$isReady=0;
		}	 
		if ($isReady) 
		{
		 echo "Запрос обработан<br>";
		 echo "
   		<script>
		window.parent.process('inline','none',false,false);
		</script>";
		return;
		} 
		 else echo "Запрос обрабатывается<br>";
	 }
	}
  
	   echo "
   		<script>
		function refresh()
		{
		window.location.href='MVal.php?nobj=".$nobj."&adr=".$adr."';
		};
		 setTimeout('refresh()',10000);
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
