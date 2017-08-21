<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>Untitled</title>
	<META HTTP-EQUIV="refresh" CONTENT="100">
</head>

<body>
<?
include("include/mysql.php"); //  Соединяемся с БД
include("util_fun.php");
$n_obj = $_GET["nobj"];
$adr = $_GET["adr"];
echo date('d.m.Y H:i:s')."<br>";
if (!isset($n_obj)) $n_obj=1;
if (!isset($adr)) $adr=46;


if (isset($n_obj) and isset($adr))
 {
//	$result=mysql_query("select max(data),'%d.%m.%Y %m:%i:%s') FROM val_3m WHERE  n_obj=".$n_obj." AND link_adr=".$adr." ");
	$result=mysql_query("select DATE_FORMAT(max(data),'%d.%m.%Y %H:%i:%s') FROM val_3m WHERE  n_obj=".$n_obj." AND link_adr=".$adr." ");
    if ($result)
	while ($res=mysql_fetch_array($result,MYSQL_BOTH))
	{
	 echo "дата: ".$res[0]."<br>";
	} 
	else echo "error!";
 }	

echo "</script>\n";
 $currdate=date("d.m.Y H:i");
list ($ac_dt,$ac_tm) = explode (" ",$currdate);
list ($ac_h,$ac_m) = explode (":",$ac_tm);
if (($ac_m-$ac_m%3)<10) $add='0';else $add='';
$tm=$ac_h.":".$add."".($ac_m-$ac_m%3);
$dt=$ac_dt." ".$tm;
	echo "window.parent.document.forms[0].dc.value='$dt';\n";

echo "</script>\n";
?>


</body>
</html>
