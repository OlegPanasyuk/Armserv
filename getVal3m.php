<?
include("include/mysql.php"); //  Соединяемся с БД
include("util_fun.php");
//header("Content-type: text/plain; charset=windows-1251");
header("Content-type: text/javascript"); 
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);

?>
<script language="php">
$filename="include/options.ini";
$options = @parse_ini_file($filename)or die("Невозможно прочитать файл настроек!");

$obj = $options['Obj'];
$adr = $options['Adr'];


include("include/mysql.php"); //  Соединяемся с БД "premax": '.$premaxs.'
sleep(2);
$result=mysql_query("select znach from val_3m WHERE n_obj=".$obj." AND link_adr=".$adr." AND izm_type=9 AND data BETWEEN  DATE_ADD(DATE_FORMAT(CURRENT_TIMESTAMP,'%Y-%m-%d %H:%i:%s'), INTERVAL -5 MINUTE) AND DATE_ADD(DATE_FORMAT(CURRENT_TIMESTAMP,'%Y-%m-%d %H:%i:%s'), INTERVAL +1 MINUTE)");
if ($result) 
{ 
	$res=mysql_fetch_array($result); 
	echo '{	"chislo": '.$res[0].'}';
}
mysql_close()
</script>