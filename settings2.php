<?php
  ///////////////////////////////////////////////////
  // ������ ������������
  require_once("security_mod.php");
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
  <title>��������� ����������</title>
  <meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
  <meta http-equiv="Cache-Control" content="no-cache"/>
  <script language="JavaScript" src="js/tabs.js">
  
  
  </script>
  
<script language="JavaScript">
function click() {
event.cancelBubble = true;
event.returnValue = false;
}
document.oncontextmenu = click;

function validator(ip,port,tout,freq,vers) 
{
 var d = ip.split('.');
 for (x=0; x<4; x++) 
  {
  if ( isNaN(d[x]) || (d[x]<0) || (d[x]>255) ) 
    {alert('�������� IP-�����');return false;}
  } 
  if (isNaN(port) || (port<1500))
    {alert('�������� UDP-����');return false;}
  if (isNaN(tout) || (tout<0) || (tout>300))
    {alert('�������� �������� �������� �������');return false;}
  if (isNaN(freq) || (freq<10) || (freq>3000))
    {alert('�������� �������� ������� �������');return false;}
//  if (isNaN(vers) || ((vers!=2003) && (vers!=2007)))
//    {alert('�������� �������� ��������� "������������� � MS Excel"');return false;}
 document.params.submit();
}
</script>
</head>

<body background="tree/imgs/fon.gif">
<?
$filename="include/options.ini";
?>
<?php 
 // ��������� ���� � ������ 
      $file = file($filename) or die("���������� ��������� ���� ��������!"); 
        // ���������� ������ ����� 
      for($a=0;$a<count($file);$a++) 
      {  
          $pat_depart = "^((\[)([[:alpha:][:space:]]+)(\]))$"; 
          $str = Trim($file[$a]); 
          if(eregi($pat_depart,$str)) 
          { 
            // ��� ������ - �������� ������� 
          } 
      } 
    ?> 

<?php 
 // ��������� ���� � ������ 
      $file = file($filename) or die("���������� ��������� ���� ��������!"); 
        // ���������� ������ ����� 
      for($a=0;$a<count($file);$a++) 
      {  
    $pat_param = "^([[:space:]]*)([[:alnum:]_\.]+)([[:space:]]*)(=)"; 
        $str = Trim($file[$a]); 
      if(eregi($pat_param,$str)) 
      { 
       // ����� ������ � ���������� ��������� 
      } 
    }
?> 

<?php 
 function Ini_Params_From_String($str) 
  { 
       // ����� ������ �� �������� ���������  � ��� ��������� 
    $k = explode('=',$str,2); 
    $key = Trim($k[0]); // �������� ��������� 
    $val = Trim($k[1]); // ��������� ����� ������ 
      // ���� �������� ���������  ��������� � �������� 
    if($val && $val{0} == '"') 
    { 
      $value = ''; 
      $pos = 1; 
      $len = StrLen($val); 
        // ������ ������ ����� ������� ������� 
      while($val{$pos} !== '"' && $pos<$len) 
      { 
        $value .= $val{$pos}; 
        $pos++; 
      } 
        // ��� ������ ����� �������� ��������� 
      $rest = trim(substr($val,$pos + 1)); 
        // ������� ����������� 
      if(($pos = strpos($rest,";")) !== false) 
        $comment = substr($rest,$pos+1); 
      else 
        $comment = ''; 
    }      
      // ���� �������� ��������� ������� ��� ������� � ���� ���� ����������� 
    elseif(substr_count($str,';')) 
    { 
      $v = explode(';',$k[1]); 
      $value= Trim($v[0]); // �������� ��������� 
      $comment = Trim($v[1]); // ����������� 
    } 
      // ���� �������� ��������� ������� ��� ������� � ���� ����������� ��� 
    else 
    { 
      $value = Trim($k[1]); 
      $comment = ''; 
    } 
    $ret[0] = $key; // �������� ��������� 
    $ret[1] = $value; // �������� ��������� 
    $ret[2] = $comment; // ����������� 
    return $ret;   
  } // function Ini_Params_From_String($str)
?> 
<?php 
/** 
* @desc ������� ������� ������������ ����� �� ������ ��� ������� 
* @param mixed $data 
* @return void 
*/ 
function array_stripslashes (& $data ) 
{ 
    if ( is_array($data) )
    {
        array_walk($data, __FUNCTION__);
    }
    elseif ( is_string($data) )
    {
        $data = stripcslashes($data);
    }
}
// ���� ���������� ������� ��������, �� ������� �������������
if ( get_magic_quotes_gpc() )
{
    if ( $_GET    ) array_stripslashes($_GET   );
    if ( $_POST   ) array_stripslashes($_POST);
    if ( $_COOKIE ) array_stripslashes($_COOKIE);
}
function stripslashes2($string) {
    $string = str_replace("\\\"", "\"", $string);
    $string = str_replace("\\'", "'", $string);
    $string = str_replace("\\\\", "\\", $string);
    return $string;
}

$tab=$_GET['tab'];
 $file = file($filename) or die("���������� ��������� ���� ��������!");      
  echo "<form name='params' action='".$_SERVER['PHP_SELF']."?tab=".$tab."' method=post  target=\"_self\">\n"; 
  echo "<center>\n"; 
  echo "  <table cellpadding=2 cellspacing=1 bgcolor=#000000>\n"; 
  echo "  <tr style='text-align: center;font-family: tahoma; font-size: 12px;font-weight: bold;background-color: #FFD700;'>\n"; 
  echo "    <td>�</td>\n"; 
  echo "    <td>��������</td>\n"; 
  echo "    <td>��������</td>\n"; 
  echo "    <td>�����������</td>\n"; 
  echo "  </tr>\n"; 
  $cnt = 0; 
  for($a=0;$a<count($file);$a++) 
  {      
    $pat_depart = "^((\[)([[:alpha:][:space:]]+)(\]))$"; 
    $str = Trim($file[$a]); 
    if(eregi($pat_depart,$str)) 
    {       
      echo "  <tr>\n"; 
      echo "    <td colspan=4 style='background-color: #FFFFCC;font-family: verdana; font-weight: bold; font-size: 12px;text-align: center;'>$str</td>\n"; 
      echo "  </tr>\n"; 
    } 
    elseif(eregi($pat_param,$str)) 
    {          
      list($key,$value,$comment) = Ini_Params_From_String($str); 
      if($comment == '') $comment = '&nbsp;'; 
      $cnt++; 
      echo "  <tr style='font-family: verdana; font-size: 12px;background-color: #F6F9F3;'>\n"; 
      echo "    <td align=center style='background-color: #E0E0E0'><b>$cnt</b></td>\n"; 
      echo "    <td style='font-weight:bold;'>$key</td>\n"; 
     if ($key=='Password')  $type='password'; 
      else $type='text';
     if (!isset($_POST["opt_".$key]))
          echo "    <td><input type=$type size=20 maxlength=255 name='opt_".$key."' value=\"".HtmlSpecialChars($value)."\"></td>\n"; 
       else
        {
          if ($key=='Path')   echo "    <td><input type=$type size=20 maxlength=255 name='opt_".$key."' value=\"".stripslashes2($_POST["opt_".$key], '"$\\') ."\"></td>\n"; 
        else
          echo "    <td><input type=$type size=20 maxlength=255 name='opt_".$key."' value=\"".$_POST["opt_".$key]."\"></td>\n"; 
      }  
        echo "    <td>$comment</td>\n"; 
     echo "  </tr>\n";   
  
    } 
  } 
  echo "<tr ><td colspan=4 style='text-align: center;font-family: tahoma; font-size: 12px;font-weight: bold;background-color: #FFD700;'>������ ��: 1.90</td></tr>\n";  
  
  echo "  </table>\n"; 
  echo "<br>\n"; 
  echo "  <input type=button value='��������' name=go onclick='validator(elements[4].value,elements[5].value,elements[6].value,elements[7].value)'></center>\n"; 
  echo "</center>\n</form>\n"; 
 $val="���������";
  echo "<center><form name='validate' action='".$_SERVER['PHP_SELF']."?tab=".$tab."' method=post target=\"_self\">\n"; 
  echo " <input type='submit' name='check' value='".$val."' style='word-break: keep-all; word-wrap: normal;'>\n"; 
    echo "</center>\n</form>\n"; 
 if (isset($_POST["check"])) 
 {
  require_once("include/testconnect.php");
  retMsg($msg);
 }

?> 
<?php 
 $pars = ReturnDefinedQuery('opt_'); 
  function ReturnDefinedQuery($pattern) 
  { 
    $count = 0; 
    $params_array = array(); 
    $newParamArray = array(); 
    $pat = "^($pattern)"; 
    foreach($_POST as $k=>$v) 
    { 
      if(eregi($pat,$k)) 
      { 
        $len = strlen($pattern); 
        $kk = substr($k,$len); 
        $newParamArray[$kk] = $v; 
      } 
    } 
    return $newParamArray;  
  } // function ReturnDefinedQuery($pattern) 
?> 
<?php 
   // ������� ������ ��� ��������� 
    $file = file($filename)      or die("���������� ��������� ���� ��������!"); 
      // ������� ���� �� ������ 
    $fh = fopen($filename,"w")   or die("���������� ��������� ���� ��������!"); 
    $pars = ReturnDefinedQuery('opt_'); 
      // ��������� ��� ������ ����� 
    for($b=0;$b<count($file);$b++) 
    {      
      $str = $file[$b]; 
        // ���� ������ - �������� ��������� 
      if(eregi($pat_param,$str)) 
      { 
        $fpars = Ini_Params_From_String($str); 
        $key = $fpars[0]; // ��� ��������� 
        $comment = $fpars[2]; // ����������� � ��������� 
          // ���� ��� ��������� ���� �������� 
        if(array_key_exists($key,$pars)) 
        { 
          if($fpars[2] !== '') $fpars[2] = ';'.$fpars[2]; 
          $val = $pars[$key]; 
            // ���� ��� ��������� ��������... 
          if(!is_numeric($val)) 
          { 
              // ������� ������ �����... 
           // $val = stripslashes($val); 
              // ������� ������� ������� ���������� 
            $val = str_replace('"',"'",$val); 
              // ����������� ������ ����� ��������  �� ��������� � �������� �� �� ����� ������� ������� 
            $val = '"'.UrlDecode($val).'"'; 
          } 
            // �������� ������ 
          $file[$b] = $fpars[0]." = ".$val.$fpars[2]."\n"; 
        } 
      } 
       // ������� ������ � ���� 
      fwrite($fh,$file[$b]); 
    } 
      // ������� ���� 
    fclose($fh); 
?>
</body>
</html>
