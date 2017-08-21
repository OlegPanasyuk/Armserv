<?php
//require_once("mysql.php"); //  Соединяемся с БД
include("mysql.php");
$result = mysql_query("select count(*) from userlist");
$res=mysql_fetch_array($result);
if ($res[0]==0)
    echo "<HTML><HEAD>
          <META HTTP-EQUIV='Refresh' CONTENT='0; URL=login.php'>
          </HEAD></HTML>";
?>
<html>
<head>
<title>Tree</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
 <link type="text/css" rel="stylesheet" href="css/tree.css">

<script language="JavaScript" src="js/exec_fun.js">
</script>
<?php
echo "<script>\n
if (document.images) {\n
var a=[\n
'imgs/bar.gif',\n
'imgs/book_c.gif',\n
'imgs/book_o.gif',\n
'imgs/corner.gif',\n
'imgs/corner_m.gif',\n
'imgs/corner_p.gif',\n
'imgs/def_c.gif',\n
'imgs/def_o.gif',\n
'imgs/folder_c.gif',\n
'imgs/folder_o.gif',\n
'imgs/folder2_c.gif',\n
'imgs/folder2_o.gif',\n
'imgs/globo_c.gif',\n
'imgs/globo_o.gif',\n
'imgs/install_o.gif',\n
'imgs/install_c.gif',\n
'imgs/link.gif',\n
'imgs/menu_o.gif',\n
'imgs/menu_c.gif',\n
'imgs/spacer.gif',\n
'imgs/tee.gif',\n
'imgs/tee_m.gif',\n
'imgs/tee_p.gif',\n
'imgs/zip_c.gif',\n
'imgs/zip_o.gif',\n
'imgs/script_c.gif',\n
'imgs/script_o.gif',\n
'imgs/counter_c.gif',\n
'imgs/counter_o.gif',\n
'imgs/sum_counter_c.gif',\n
'imgs/sum_counter_o.gif',\n
'imgs/water.gif'\n
];\n
var b=[];\n
for (i=0; i<a.length; i++){\n
b[i] = new Image;\n
b[i].src = a[i];\n
}\n
}\n
</script>\n";
?>
<script src=js/tree.js></script>
</head>
<body topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 background="imgs/fon.gif">
<?php
function getmicrotime()
{
 list($usec, $sec) = explode(" ",microtime());
 return ((float)$usec + (float)$sec);
}
$TIME_START = getmicrotime();
$items = '';
$createSTR='';

function ShowTree($parent_id, $lvl)
{
	global $items;
	global $link;
	global $lvl;
	global $root;
	$lvl++;
	$result = mysql_query("select * from objects where item_parent_id=" . $parent_id." order by node_type desc,icon desc,item_id");
	if (mysql_num_rows($result) > 0)
	{
	 while ( $row = mysql_fetch_array($result) )
	 {
		$ID1 = $row[0];$title=$row[1];$icon=$row[3];$node=$row[4];
		if ($node<2 || $node>=5)
		{
		  $result2=mysql_query("select n_obj,link_adr,znum,c_type from counters where uid=".$ID1." ");
		  if ($result2)
			{
				$res2=mysql_fetch_array($result2);
				$nobj=$res2[0];
				$adr=$res2[1];
				$nzavod=$res2[2];
				$node=$res2[3];
			}
		}
		else
			{
			$result2=mysql_query("select node_type from objects where item_id=".$ID1." ");
		if ($result2)
			{
				$res2=mysql_fetch_array($result2);
				$nobj=-1;
				$adr=-1;
				$nzavod='---';
				$node=$res2[0];
			}
			}
		if (!isset($nobj)) $nobj=-1;
		if (!isset($adr))  $nadr=-1;
		if (!isset($nzavod)) $nzavod='';
		if (!isset($node)) $node=-1;
		 $title=str_replace("'", "&quot; ", $title);
		$url="javascript:defineID(\'".$ID1."\',\'".$parent_id."\',\'".$lvl."\',\'".$node."\',\'".$nobj."\',\'".$adr."\',\'".HTMLSpecialChars($title, ENT_QUOTES)."\',\'".$nzavod."\')";
		$id=$ID1.'_'.$parent_id.'_'.$lvl;
		if ($parent_id==$root)	$items.="var m".$ID1." = new E_Tree('<a target=\"_self\" href=\"$url\" id=\"$id\" name=\"$id\" onclick=\"setName(\'$id\');\">".$title."</a>', '".$icon."');";
		else $items.="var m".$ID1."=m".$parent_id.".addItem('<a target=\"_self\" href=\"$url\" id=\"$id\" name=\"$id\" onclick=\"setName(\'$id\');\">".$title."</a>', '".$icon."', false);\n";
		ShowTree($ID1, $lvl);
		$lvl--;
		}
	}
	return $items;
}

	$StrQuery = "select item_id, item_name,item_parent_id,icon from objects where item_parent_id=-1";
	$result = mysql_query($StrQuery, $link);
	if ($result) {
		if (mysql_num_rows($result)==1)
		{
			if ($row = mysql_fetch_array($result) )
			{
				$ID = $row[0];
				$title=$row[1];
				$pid=$row[2];
				$createSTR='m'.$ID.'.createHtml(); m'.$ID.'.act(); m'.$ID.'.act=function (){};';
				$tree=ShowTree($pid, 0);
			}
		}
	} else {

	}
 mysql_close($link);
?>

<?
echo "<table id=tb cellpadding=0 cellspacing=0 style='margin-left:5px;margin-top:10px'>";
echo "</table>";
echo "</td></tr></table>";
echo "<script>\n
var tpath=\"imgs/\";\n
var tbl=document.getElementById(\"tb\");\n";
echo $tree;
echo $createSTR;
echo "</script>\n";
$TIME_END = getmicrotime();
$TIME_SCRIPT = $TIME_END - $TIME_START;
?>
<script>
function open_menu(str)
{
 eval(str)
}
</script>

<div style="position:absolute;top:250;left:5;z-index:+1;display:none">
Sel_ID: <input type="text" name="cur_id" id="cur_id" size="20" maxlength="10" value=""><br>
NAME: <input type="text" name="item_name" id="item_name" size="20" maxlength="20" value=""><br>
ID: <input type="text" name="item_id" id="item_id" size="4" maxlength="4" value="0"><br>
PID: <input type="text" name="par_id" id="par_id" size="4" maxlength="4" value="-1"><br>
LEVEL: <input type="text" name="level" id="level" size="4" maxlength="4" value="0"><br>
NODE: <input type="text" name="ntype" id="ntype" size="4" maxlength="4" value="-1"><br>
№ object: <input type="text" name="nobj" id="nobj" size="4" maxlength="4" value="-1"><br>
address: <input type="text" name="adr" id="adr" size="4" maxlength="4" value="-1"><br>
nzavod: <input type="text" name="nzavod" id="nzavod" size="4" maxlength="12" value=""><br>
</div>
<script src="js/menu.js"></script>
<center>
<div style="color:red;display:none;" class="help"><b>.::</b>
Время выполнения запроса <?=number_format($TIME_SCRIPT,3,'.','');?> сек.
<b>::.</b>
</div>
</center>
</body>
</html>
