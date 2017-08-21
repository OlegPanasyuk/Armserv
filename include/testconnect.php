<?
function retMsg($msg)
{
echo '<script>
 var msg="'.$msg.'";
 document.validate.check.value=msg;
 document.validate.check.style.width=(msg.length*7+30);
 window.parent.frames[1].location.href=window.parent.frames[1].location.href;
</script>';
 return $msg;
}
$filename="include/options.ini";
$options = @parse_ini_file($filename)or die("Невозможно прочитать файл настроек!"); 

 $hostName = $options['hostName']; 
 $dbName = $options['dbName']; 
 $userName = $options['userName']; 
 $password = $options['Password']; 
 $msg='';
///////////////////////////////////////////////////////////////
  if (!($link=@mysql_connect($hostName,$userName,$password))) {
	$msg="Ошибка при соединении с MySQL !";
	if (mysql_errno()) $msg.="Код ошибки = ".mysql_errno()." : ".mysql_error()."";
	retMsg($msg);
	exit();
	}
  if (!mysql_select_db($dbName, $link)) {
	$msg="Ошибка базы данных !";
	if (mysql_errno()) $msg.="Код ошибки = ".mysql_errno()." : ".mysql_error()."";
	retMsg($msg);
	exit();
	}
else {
		$msg="Cоединение с базой ".$dbName." установлено!";
		retMsg($msg);
	 } 
?>
