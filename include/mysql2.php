<?
$filename="include/options.ini";
$options = @parse_ini_file($filename)or die("Невозможно прочитать файл настроек!"); 

 $hostName = $options['hostName']; 
 $dbName = $options['dbName']; 
 $userName = $options['userName']; 
 $password = $options['Password']; 

  $table="val_3m";//имя таблицы с данными
  $root=-1;
///////////////////////////////////////////////////////////////
  if (!($link=@mysql_connect($hostName,$userName,$password))) {
	printf("Ошибка при соединении с MySQL !\n");
	if (mysql_errno()) print "Код ошибки = ".mysql_errno()." : ".mysql_error()."<br><br>";
	exit();
	}
  if (!mysql_select_db($dbName, $link)) {
	printf("Ошибка базы данных !");
	if (mysql_errno()) print "Код ошибки = ".mysql_errno()." : ".mysql_error()."<br><br>";
	exit();
	}
//else {echo "Cоединение с базой ".$dbName." установлено!<br>";} 
?>
