<?php 
  ///////////////////////////////////////////////////
  // ������������� ���������� � ����� ������
  // ���� ������������ �� ������������� - ������������
  if(!isset($_SERVER['PHP_AUTH_USER'])) 
  { 
    Header("WWW-Authenticate: Basic realm=\"���������\"",false); 
    Header("HTTP/1.0 401 Unauthorized",false); 
    exit(); 
  } 
  else 
  { 
    // ������ ���������� $_SERVER['PHP_AUTH_USER'] � $_SERVER['PHP_AUTH_PW'], ����� ���� �� ����������
    require_once("include/mysql.php");
    if (!get_magic_quotes_gpc())
    {
      $_SERVER['PHP_AUTH_USER'] = mysql_escape_string($_SERVER['PHP_AUTH_USER']);
      $_SERVER['PHP_AUTH_PW'] = mysql_escape_string($_SERVER['PHP_AUTH_PW']);
    }
    $_SERVER['PHP_AUTH_USER'] = str_replace("'","`",$_SERVER['PHP_AUTH_USER']);
    $_SERVER['PHP_AUTH_PW'] = str_replace("'","`",$_SERVER['PHP_AUTH_PW']);
    $query = "SELECT userpass FROM userlist WHERE username='".$_SERVER['PHP_AUTH_USER']."'";
    $lst = @mysql_query($query); 
    // ���� ������ � SQL-������� - ����� ����
    if(!$lst)
    {
    Header("WWW-Authenticate: Basic realm=\"�������������� ���������\""); 
      Header("HTTP/1.0 401 Unauthorized"); 
      exit(); 
    }
    // ���� ������ ������������ ��� - ����� ����
    if(mysql_num_rows($lst) == 0)
    {
    Header("WWW-Authenticate: Basic realm=\"�������������� ���������\""); 
      Header("HTTP/1.0 401 Unauthorized"); 
      exit(); 
    }
    // ���� ��� �������� ��������, ���������� ���� �������
    $pass = @mysql_fetch_array($lst);
    if ((md5($_SERVER['PHP_AUTH_PW']) != $pass['userpass']) and ($_SERVER['PHP_AUTH_PW'] != $pass['userpass']) )
    {
    Header("WWW-Authenticate: Basic realm=\"�������������� ���������\""); 
      Header("HTTP/1.0 401 Unauthorized"); 
      exit(); 
    }
  }
?>