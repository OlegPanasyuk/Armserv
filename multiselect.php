<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>��������</title>
<style>
.active{
		color:HighlightText;
		background-color:Highlight;
		}
.inactive{
		color: MenuText;
		background-color: Menu;
		}
</style>
<script language="JavaScript" src="js/tabs.js">
<!--
//-->
</script>

<script language="JavaScript">
function click() {
event.cancelBubble = true;
event.returnValue = false;
}
document.oncontextmenu = click;
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	var cur=0;
	function roll(active)
	{
	with (document)
	{
	 if (params.mult.options[active].className=='inactive')
	 {
		params.mult.options[active].className='active'
	 }
	 else
	 {
		params.mult.options[active].className='inactive'
	 }
   }
}

function showSelected()
{
  var TypeOfDate = document.getElementById("nameoflist").value;
  str="";n_str="";
  for (i=0;i<(document.params.mult.options.length);i++)
  {
    if (document.params.mult.options[i].className=='active')
    if (str=="")
    {
      str+=document.params.mult.options[i].innerText;
	    n_str+=document.params.mult.options[i].value;
    }
    else
    {
      str+=",\n";n_str+=",";
      str+=document.params.mult.options[i].innerText;
	    n_str+=document.params.mult.options[i].value;
    }
  }
  str+=".";
  if (Number(TypeOfDate) === 1) {
      document.params.opt_c_mTabs.value=document.params.mult.length;
      document.params.opt_c_lTabs_energy.value=str.split(',').length;
      document.params.opt_c_strTabs_energy.value=n_str;
      document.params.selid.value=str;
  } else if (Number(TypeOfDate) === 2) {
      document.params.opt_c_mTabs.value=document.params.mult.length;
      document.params.opt_c_lTabs_water.value=str.split(',').length;
      document.params.opt_c_strTabs_water.value=n_str;
      document.params.selid.value=str;
  } else if (Number(TypeOfDate) === 3) {
      document.params.opt_c_mTabs.value=document.params.mult.length;
      document.params.opt_c_lTabs_folder.value=str.split(',').length;
      document.params.opt_c_strTabs_folder.value=n_str;
      document.params.selid.value=str;
  } else if (Number(TypeOfDate) === 4) {
      document.params.opt_c_mTabs.value=document.params.mult.length;
      document.params.opt_c_lTabs_heat.value=str.split(',').length;
      document.params.opt_c_strTabs_heat.value=n_str;
      document.params.selid.value=str;
  }

}

function changer(c_mTabs)
{
 //document.params.sid.value=''; document.params.sid.value=cur+' --> '+document.params.mult.selectedIndex;
 cur=document.params.mult.selectedIndex;
 document.params.mult.selectedIndex=-1;
 if (cur!=c_mTabs)
 {
  roll(cur);
  showSelected();
 }
}

function testofList() {
  var TypeOfDate = document.getElementById("nameoflist").value;
  if (Number(TypeOfDate) === 1) {
      for (i=0;i<(document.params.mult.options.length);i++)
      {
        document.params.mult.options[i].className='inactive'
      }
      activeTabs=document.params.opt_c_strTabs_energy.value.split(',');
      for (i=0;i<(activeTabs.length);i++)
        document.params.mult.options[activeTabs[i]].className='active';
      showSelected();
  } else if (Number(TypeOfDate) === 2) {
       for (i=0;i<(document.params.mult.options.length);i++)
       {
         document.params.mult.options[i].className='inactive'
       }
       activeTabs=document.params.opt_c_strTabs_water.value.split(',');
       for (i=0;i<(activeTabs.length);i++)
         document.params.mult.options[activeTabs[i]].className='active';
       showSelected();
  } else if (Number(TypeOfDate) === 3) {
       for (i=0;i<(document.params.mult.options.length);i++)
       {
         document.params.mult.options[i].className='inactive'
       }
       activeTabs=document.params.opt_c_strTabs_folder.value.split(',');
       for (i=0;i<(activeTabs.length);i++)
         document.params.mult.options[activeTabs[i]].className='active';
       showSelected();
  } else if (Number(TypeOfDate) === 4) {
       for (i=0;i<(document.params.mult.options.length);i++)
       {
         document.params.mult.options[i].className='inactive'
       }
       activeTabs=document.params.opt_c_strTabs_heat.value.split(',');
       for (i=0;i<(activeTabs.length);i++)
         document.params.mult.options[activeTabs[i]].className='active';
       showSelected();
  }
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	</script>
</head>
<body background="tree/imgs/fon.gif" onload="startIncrement();">
<?
$filename="include/tabs.ini";
$options = parse_ini_file($filename) or die("���������� ��������� ���� tabs.ini!"); 
 $c_lTabs = $options['c_lTabs']; 
 $c_mTabs = $options['c_mTabs']; 
 $c_strTabs = $options['c_strTabs']; 
 $c_lTabs_energy = $options['c_lTabs_energy']; 
 $c_strTabs_energy = $options['c_strTabs_energy'];
 $c_lTabs_water = $options['c_lTabs_water']; 
 $c_strTabs_water = $options['c_strTabs_water']; 
 $c_lTabs_heat = $options['c_lTabs_heat']; 
 $c_strTabs_heat = $options['c_strTabs_heat']; 
 $c_lTabs_folder = $options['c_lTabs_folder']; 
 $c_strTabs_folder = $options['c_strTabs_folder']; 


 $activeTabs=explode(",",$c_strTabs);
 $activeTabs_energy=explode(",",$c_strTabs_energy);
 $activeTabs_water=explode(",",$c_strTabs_water);
 $activeTabs_heat=explode(",",$c_strTabs_heat);
 $activeTabs_folder=explode(",",$c_strTabs_folder);
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
$tab=$_GET['tab'];
 $file = file($filename) or die("���������� ��������� ���� ��������!");
  echo "<br><form name='params' action='".$_SERVER['PHP_SELF']."?tab=".$tab."' method=post  target=\"_self\">\n"; 
  echo "<center>\n"; 
  echo "  <table cellpadding=2 cellspacing=1 bgcolor=#000000>\n"; 
  echo "<tr style='text-align: center;font-family: tahoma; font-size: 12px;font-weight: bold;background-color: #FFD700;'>\n";
  echo "<td colspan='2'><select id='nameoflist' onchange='testofList()'>
        <option value=1>��������������</option>\n";
  echo "<option value=2>����</option>\n";
  echo "<option value=3>�����</option>\n";
  echo "<option value=4>�����</option></select></td>\n";
  echo "</tr>";
  echo "  <tr style='text-align: center;font-family: tahoma; font-size: 12px;font-weight: bold;background-color: #FFD700;'>\n"; 
  echo "    <td>��� ��������</td>\n"; 
  echo "    <td>��������� ��������</td>\n"; 
  echo "  </tr>\n"; 
  $cnt = 0; 
 // for($z=0;$z<4;$z++) {
  for($a=0;$a<count($file);$a++) 
  {
    $pat_depart = "^((\[)([[:alpha:][:space:]]+)(\]))$"; 
    $str = Trim($file[$a]); 
    if(eregi($pat_depart,$str)) 
    {
      echo "  <tr style='display:none;'>\n"; 
      echo "    <td colspan=2 style='background-color: #FFFFCC;font-family: verdana; font-weight: bold; font-size: 12px;text-align: center;'>$str</td>\n"; 
      echo "  </tr>\n"; 
    } 
    elseif(eregi($pat_param,$str)) 
    {          
      list($key,$value,$comment) = Ini_Params_From_String($str); 
      if($comment == '') $comment = '&nbsp;'; 
      $cnt++; 
	  if ($cnt<14)
	  {
       echo "  <tr style='font-family: verdana; font-size: 12px;background-color: #F6F9F3;display:none;'>\n"; 
	   $type='text';
		  if (!isset($_POST["opt_".$key]))
	      echo "    <td><input type=$type size=20 maxlength=255 name='opt_".$key."' value=\"".HtmlSpecialChars($value)."\" readonly></td>\n"; 
	      else
		  echo "    <td><input type=$type size=20 maxlength=255 name='opt_".$key."' value=\"".$_POST["opt_".$key]."\" readonly></td>\n"; 
	      echo "    <td>$comment</td>\n"; 
       echo "  </tr>\n";        
	  $count=0;
	  } 
	  else//������� ������ ��������
	  {
	   if ($count==0)
	   {
		 echo "  <tr style='font-family: verdana; font-size: 12px;background-color: #F6F9F3;'>\n"; 
	   	echo "<td> 
				<select name='mult' style='width:200px;' size='".$c_mTabs."' onclick='changer(".$c_mTabs.")'>\n";
        echo "    	<option value='$comment'>$value</option>\n"; 
        $count++;
	   }	
	   else
	   {
        echo "    	<option value='$comment'>$value</option>\n"; 
        $count++;
	   }
			if ($count>($c_mTabs-1))
			{
	         echo "</select>
			 </td><td>
			  <textarea cols='30' rows='".$c_mTabs."' name='selid' readonly></textarea>";
			echo "</td> ";
      
      echo "</tr>\n";

		  }	
	  } 
    } 
  } 
//}
  echo "  </table>\n"; 
  echo "<br>\n"; 
  echo "  <input type=button value='��������' name=go onclick='document.params.submit();window.parent.location.href=window.parent.location.href;'></center>\n"; 
  echo "</center>\n</form>\n"; 
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
            $val = stripslashes($val); 
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
<script event=onload for=window >
 document.params.mult.selectedIndex=-1;
for (i=0;i<(document.params.mult.options.length);i++)
{
  document.params.mult.options[i].className='inactive'
}
activeTabs=document.params.opt_c_strTabs_energy.value.split(',');
for (i=0;i<(activeTabs.length);i++)
document.params.mult.options[activeTabs[i]].className='active';
showSelected()
</script>
</body>
</html>
