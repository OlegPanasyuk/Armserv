<?
 //  Соединяемся с БД
include("util_fun.php");
header("Content-type: text/plain; charset=windows-1251");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Content-type: text/javascript"); 
include("include/mysql.php");
?>
<script language="php">
include("include/mysql.php"); //  Соединяемся с БД
$znach=array();
$result=mysql_query("select DATE_FORMAT(CURRENT_TIMESTAMP,'%d.%m.%Y %H:%i:%s')");
if ($result) { $res=mysql_fetch_array($result); echo $res[0];}

mysql_close()
</script>
