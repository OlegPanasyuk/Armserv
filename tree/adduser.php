<?php
  ///////////////////////////////////////////////////
  // ������������� ���������� � ����� ������
  require_once("mysql.php"); 

  // ������ ������������
  // require_once("../security_mod.php");

  // ��������� �������� �� ��� ������������ � ������
  if(empty($_POST['name'])) exit("�� ������� ��� ������ ������������");
  if(empty($_POST['pass'])) exit("�� ������ ������ ������������");

  // ��������� ����� �� ������
  if($_POST['pass'] != $_POST['pass_again']) exit("������ �� �����");

  // ���������, ����� �� ���� ������� SQL-��������
  if (!get_magic_quotes_gpc())
  {
     $_POST['name'] = mysql_escape_string($_POST['name']);
     $_POST['pass'] = mysql_escape_string($_POST['pass']);
  }
  $_POST['name'] = str_replace("'","`",$_POST['name']);
  $_POST['pass'] = str_replace("'","`",$_POST['pass']);

  // ���� �� ��������� ������ ������ ������������ 
  $query = "INSERT INTO userlist VALUES (NULL,'$_POST[name]','".md5($_POST['pass'])."','2')";
  if(mysql_query($query))
  {
   echo "������� ������ �������";
    echo "<HTML><HEAD>
            <META HTTP-EQUIV='Refresh' CONTENT='0; URL=tree.php'>
            </HEAD></HTML>";
  }
  else
  {
    exit("������ ��� ���������� ������� ������");
  }
?>