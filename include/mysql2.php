<?
$filename="include/options.ini";
$options = @parse_ini_file($filename)or die("���������� ��������� ���� ��������!"); 

 $hostName = $options['hostName']; 
 $dbName = $options['dbName']; 
 $userName = $options['userName']; 
 $password = $options['Password']; 

  $table="val_3m";//��� ������� � �������
  $root=-1;
///////////////////////////////////////////////////////////////
  if (!($link=@mysql_connect($hostName,$userName,$password))) {
	printf("������ ��� ���������� � MySQL !\n");
	if (mysql_errno()) print "��� ������ = ".mysql_errno()." : ".mysql_error()."<br><br>";
	exit();
	}
  if (!mysql_select_db($dbName, $link)) {
	printf("������ ���� ������ !");
	if (mysql_errno()) print "��� ������ = ".mysql_errno()." : ".mysql_error()."<br><br>";
	exit();
	}
//else {echo "C��������� � ����� ".$dbName." �����������!<br>";} 
?>
