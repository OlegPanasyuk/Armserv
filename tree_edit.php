<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>�������������� ��������� ������</title>
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
</head>

<body>
<?
include("include/mysql.php"); //  ����������� � ��
include("util_fun.php");
 $id = $_GET['id'];
 $pid = $_GET['pid'];
 $level=$_GET['level'];
 $name=$_GET['name'];
 $todo = $_GET['todo'];
 $icon = $_GET['icon'];
 $node= $_GET['node'];
 $nzavod= $_GET['nzavod'];
 $adr= $_GET['adr'];
 $nobj= $_GET['nobj'];
 $ctype= $_GET['ctype'];
 $ktr=$_GET['ktr'];
 $delAllData=$_GET['deldata'];
 $new_id=$id;
 $typeofcircles=$_GET['typeofcircles'];
 if (!isset($typeofcircles)){
 	$typeofcircles = "1,1,1,1";
 }
//===================================================================================================================
$str='';$lvl=$level;$status='';
if (isset($todo))
{
	if ($todo=='insert')
	{
	 	insertItem($id,$pid,$level,$name,$todo,$icon,$node,$ctype,$nzavod,$nobj,$adr,$ktr,$typeofcircles);
		$str=expand($id,$level);
	}
	if ($todo=='delete')
	{
		$new_id=deleteItem($id,$pid�,$level,$name,$todo,$icon,$node);
		$str=expand($pid,$level);
	}
	if ($todo=='update')
	{
		update($id,$pid,$level,$name,$todo,$icon,$node,$nobj,$adr,$nzavod,$ktr);
		$str=expand($pid,$level);
	}

	if ($status=="") {$operation_result="�������� ��������� �������";}
	else {$operation_result="ERROR: ".$status;}
	echo $operation_result;
		expandmenu($str,$operation_result);
}

//===================================================================================================================
 function insertItem($id,$pid,$level,$name,$todo,$icon,$node,$ctype,$nzavod,$nobj,$adr,$ktr,$typeofcircles)
 {
	global $status;
	global $root;
	//��������� ������
	$result = mysql_query("SELECT count(*) from objects where item_parent_id=".$root."");
	if (mysql_num_rows($result)> 0)
		$row = mysql_fetch_array($result);
		if ($row[0]==0)
		{
			if (!isset($name) or $name=='') $name='�����';
			$result = mysql_query("INSERT INTO objects (item_id,item_name,item_parent_id,icon,node_type) VALUES('0','".$name."','".$root."','logo','2')");
			if (($result) and ($status=="")) $status="";
			  else $status="������ ���������� ��������: ".mysql_error()."";
		}
	else
	{
//======================���������� ����� ������============================================================
	$result = mysql_query("SELECT MAX(item_id)+1 from objects");
	if ($row=mysql_fetch_row($result))
	{
		$item_id=$row[0];
	}
	$result = mysql_query( "select node_type  from objects where item_id=" . $id." ");
	if (mysql_num_rows($result) > 0)
	{
		$row = mysql_fetch_array($result);
		$p_node=$row[0];
	}
	if (isset($p_node) and $p_node)
	{
	//�������� �� �������� �� ���� ������ ������
	 if ($pid>0)
	 {
		//�������� ������ ������������� ���� �� �����
	    $result = mysql_query("UPDATE objects set icon='folder' where item_id='".$id."' ");
	    if (($result) and ($status=="")) $status="";
	      else        $status="������ ��������� ������ ���� ".mysql_error()."";
	 }
		//��������� �������
		if ($node==0 or $node==-1)
		{
		 $result = mysql_query("INSERT INTO counters (uid,descript,znum,n_obj,link_adr,c_type,izm_str,k_tr) VALUES('".$item_id." ','".$name."','".$nzavod."','".$nobj."','".$adr."','".$ctype."','1,2,3,4,5,6,7,8,9,10,11,12',".$ktr.")");
		 if ($result)
		 	{
			   $result = mysql_query("INSERT INTO objects (item_id,item_name,item_parent_id,icon,node_type) VALUES('".$item_id." ','".$name."','".$id."','".$icon."','".$node."')");
			  if (($result) and ($status=="")) $status="";
			  else        $status="������ ���������� ������ � ������� ��������� 1 ".mysql_error()."";
			}
		  else        $status="������ ���������� ������ � ������� ��������� ".mysql_error()."";
		}
		//��������� group
		else if ($node==1)
		{
//    	 $result = mysql_query("INSERT INTO counters (uid,descript,izm_str,n_obj,link_adr,c_type) VALUES('".$item_id." ','".$name."','1,2,3,4','".$nobj."','-1','".$ctype."')");
    	 $result = mysql_query("INSERT INTO counters (uid,descript,izm_str,n_obj,link_adr,c_type) VALUES('".$item_id." ','".$name."','1,2,3,4,9,10,11,12','".$nobj."','".$adr."','".$ctype."')");
	     if ($result)
		 	{
			   $result = mysql_query("INSERT INTO objects (item_id,item_name,item_parent_id,icon,node_type) VALUES('".$item_id." ','".$name."','".$id."','".$icon."','".$node."')");
		      if (($result) and ($status=="")) $status="";
	    	  else        $status="������ ���������� ������ � ������� ��������� 2 ".mysql_error()."";
			}
    	  else        $status="������ ���������� ������ � ������� ��������� 3 ".mysql_error()."";
		}
		else if ($node==3)
		{
    	 $result = mysql_query("INSERT INTO counters (uid,descript,izm_str,n_obj,link_adr,c_type) VALUES('".$item_id."','".$name."','1','".$nobj."','".$adr."','".$ctype."')");
	     if ($result)
		 	{
			   $result = mysql_query("INSERT INTO objects (item_id,item_name,item_parent_id,icon,node_type) VALUES('".$item_id." ','".$name."','".$id."','".$icon."','1')");
		      if (($result) and ($status=="")) $status="";
	    	  else        $status="������ ���������� ������ � ������� ��������� 2 ".mysql_error()."";
			}
    	  else        $status="������ ���������� ������ � ������� ��������� 3 ".mysql_error()."";
		}
		else if ($node==4)
		{
//    	 $result = mysql_query("INSERT INTO counters (uid,descript,izm_str,n_obj,link_adr,c_type) VALUES('".$item_id." ','".$name."','1,2,3,4','".$nobj."','-1','".$ctype."')");
    	 $result = mysql_query("INSERT INTO counters (uid,descript,izm_str,n_obj,link_adr,c_type) VALUES('".$item_id." ','".$name."','2','".$nobj."','".$adr."','".$ctype."')");
	     if ($result)
		 	{
			   $result = mysql_query("INSERT INTO objects (item_id,item_name,item_parent_id,icon,node_type) VALUES('".$item_id." ','".$name."','".$id."','".$icon."','1')");
		      if (($result) and ($status=="")) $status="";
	    	  else        $status="������ ���������� ������ � ������� ��������� 2 ".mysql_error()."";
			}
    	  else        $status="������ ���������� ������ � ������� ��������� 3 ".mysql_error()."";
		}
//���������� ����
        else if ($node==5)
		{
//    	 $result = mysql_query("INSERT INTO counters (uid,descript,izm_str,n_obj,link_adr,c_type) VALUES('".$item_id." ','".$name."','1,2,3,4','".$nobj."','-1','".$ctype."')");
    	 $result = mysql_query("INSERT INTO counters (uid,descript,znum,izm_str,n_obj,link_adr,c_type) VALUES('".$item_id." ','".$name."','".$nzavod."','503','".$nobj."','".$adr."','".$ctype."')");
	     if ($result)
			{
			   $result = mysql_query("INSERT INTO objects (item_id,item_name,item_parent_id,icon,node_type) VALUES('".$item_id." ','".$name."','".$id."','".$icon."','5')");
		      if (($result) and ($status=="")) $status="";
	    	  else        $status="������ ���������� ������ � ������� ��������� 2 ".mysql_error()."";
			}
    	  else        $status="������ ���������� ������ � ������� ��������� 3 ".mysql_error()."";
		}
		// ���������� ������ ����
        else if ($node==6)
		{
    	 $result = mysql_query("INSERT INTO counters (uid,descript,znum,izm_str,n_obj,link_adr,c_type) VALUES('".$item_id." ','".$name."','".$nzavod."','503','".$nobj."','".$adr."','".$ctype."')");
		 if ($result)
			{
				$result = mysql_query("INSERT INTO objects (item_id,item_name,item_parent_id,icon,node_type) VALUES('".$item_id." ','".$name."','".$id."','".$icon."','6')");
				if (($result) and ($status=="")) $status="";
				else        $status="������ ���������� ������ � ������� ��������� 2 ".mysql_error()."";
			}
			else $status="������ ���������� ������ � ������� ��������� 3 ".mysql_error()."";
		}
		else if ($node == 7) {
			// ���������� �����
			 $result = mysql_query("INSERT INTO counters (uid,descript,znum,izm_str,n_obj,link_adr,c_type) VALUES('".$item_id." ','".$name."','".$nzavod."','501,502,503,504,505,506,507,508,509,510,511,512,513,514,515,516,517,518,519,520,521,522,523,524,525,526,527,528,529,530,531,532,533,534','".$nobj."','".$adr."','".$ctype."')");
			if ($result)
				{
					$result = mysql_query("INSERT INTO objects (item_id,item_name,item_parent_id,icon,node_type) VALUES('".$item_id." ','".$name."','".$id."','".$icon."','7')");
					if (($result) and ($status=="")) $status="";
					else $status="������ ���������� ������ � ������� ��������� 2 ".mysql_error()."";
					$typeofcircles_a = explode(",", $typeofcircles);
					$result = mysql_query("INSERT INTO heat_type_of_circles (uid,circle1,circle2,circle3,circle4) VALUES('".$item_id."','".$typeofcircles_a[0]."','".$typeofcircles_a[1]."','".$typeofcircles_a[2]."','".$typeofcircles_a[3]."')");
					if (($result) and ($status=="")) $status="";
					else $status="������ ���������� ������ � ������� ��������� 2 ".mysql_error()."";
				}
				else $status="������ ���������� ������ � ������� ��������� 3 ".mysql_error()."";
		}
		else if ($node == 8) {
			// ���������� ������ �����
			$result = mysql_query("INSERT INTO counters (uid,descript,znum,izm_str,n_obj,link_adr,c_type) VALUES('".$item_id." ','".$name."','".$nzavod."','501,502,503,504,505,506,507,508,509,510,511,512,513,514,515,516,517','".$nobj."','".$adr."','".$ctype."')");
			if ($result)
				{
					$result = mysql_query("INSERT INTO objects (item_id,item_name,item_parent_id,icon,node_type) VALUES('".$item_id." ','".$name."','".$id."','".$icon."','8')");
					if (($result) and ($status=="")) $status="";
					else $status="������ ���������� ������ � ������� ��������� 2 ".mysql_error()."";
				}
				else $status="������ ���������� ������ � ������� ��������� 3 ".mysql_error()."";
		}
		else if ($node == 9) {
			// ���������� ������ �����
			$result = mysql_query("INSERT INTO counters (uid,descript,znum,izm_str,n_obj,link_adr,c_type) VALUES('".$item_id." ','".$name."','".$nzavod."','501,502,503,504,505,506,507,508,509,510,511,512,513,514,515,516,517,518,519,520,521,522,523,524,525,526,527','".$nobj."','".$adr."','".$ctype."')");
			if ($result)
				{
					$result = mysql_query("INSERT INTO objects (item_id,item_name,item_parent_id,icon,node_type) VALUES('".$item_id." ','".$name."','".$id."','".$icon."','9')");
					if (($result) and ($status=="")) $status="";
					else $status="������ ���������� ������ � ������� ��������� 2 ".mysql_error()."";
				}
				else $status="������ ���������� ������ � ������� ��������� 3 ".mysql_error()."";
		}

		else
		{
		 //��������� �������� ���� - �����
		  $result = mysql_query("INSERT INTO objects (item_id,item_name,item_parent_id,icon,node_type) VALUES('".$item_id." ','".$name."','".$id."','".$icon."','".$node."')");
	      if (($result) and ($status=="")) $status="";
    	  else        $status="������ ���������� ������ � ������� ��������� 4 ".mysql_error()."\n";
	    }
	}
	else  $status="��������� ������� �������� �������� �����. ���������� ����������.";
  }
 }
function deleteVal($uid,$n_type)
{
  $delAllData=$_GET['deldata'];
	$status="";
	$result0 = mysql_query( "select n_obj,link_adr from counters where uid=" . $uid." ");
	if ($row0 = mysql_fetch_array($result0) )
	{
	 $nobj=$row0[0]; $adr=$row0[1];
	 if ($delAllData==1)//����� ���� ������� ������
	 {
	     $result = mysql_query("DELETE FROM val where n_obj='".$nobj."' and link_adr='".$adr."'");
	     if (($result) and ($status=="")) $status="";
	      else        $status="������ �������� ������ �� ������� �������� ".mysql_error()."";
    	 $result = mysql_query("DELETE FROM val_3m where n_obj='".$nobj."' and link_adr='".$adr."'");
	     if (($result) and ($status=="")) $status="";
	      else        $status="������ �������� ������ �� ������� 3���. ��������".mysql_error()."";
    	 if ($n_type==0) 
		 {
		 	$result = mysql_query("DELETE FROM moment_val where n_obj='".$nobj."' and link_adr='".$adr."'");
	     	if (($result) and ($status=="")) $status="";
	      	else        $status="������ �������� ������ �� ������� ���������� �������� ".mysql_error()."";
	     	$result = mysql_query("DELETE FROM arch_meter where n_obj='".$nobj."' and link_adr='".$adr."'");
	     	if (($result) and ($status=="")) $status="";
	      	else        $status="������ �������� ������ �� ������� ������� ".mysql_error()."";
		 }
	  }
	}
	  return $status;
}
 //================================������� ���� ��� �����==========================================
 function deleteItem($id,$pid,$level,$name,$todo,$icon,$node)
 {
	global $status;
	$result = mysql_query( "select item_parent_id,node_type  from objects where item_id=" . $id." ");
	if (mysql_num_rows($result) > 0)
	{
		$row = mysql_fetch_array($result);
		$new_id=$row[0];  $n_type=$row[1];
	}
	 if (($n_type==0) or ($n_type==1)) $status=deleteVal($id,$n_type);
    $result = mysql_query("DELETE FROM objects where item_id='".$id."' ");
    if (($result) and ($status=="")) $status="";
      else        $status="������ �������� ������ �� ������� ��������".mysql_error()."\n";
    $result = mysql_query("DELETE FROM counters where uid='".$id."' ");
    if (($result) and ($status=="")) $status="";
     else        $status="������ �������� ������ �� ������� ���������".mysql_error()."";
    $PID=$pid;
    $PID1=DelTree($id);
	 //���������� ���-�� �������� ����� � �������
	$result = mysql_query( "select count(item_id)  from objects where item_parent_id=" . $PID." ");
	if (mysql_num_rows($result) > 0) 
	{
	 $row = mysql_fetch_array($result);
	 if ($row[0]==0) 
	  {
	 //�������� ������ ������������� ���� �� ����� ���� ��� ������ �������� �����
	    $result = mysql_query("UPDATE objects set icon='folder2' where item_id='".$PID."' ");
	    if (($result) and ($status=="")) $status="";
    	  else        $status="������ ��������� ���� ���� ".mysql_error()."\n";
	  }
	}
	return $new_id;
 }
 
 function DelTree($id) 
 {
   global $PID;
	global $status;
	$result = mysql_query( "select item_id, item_name,item_parent_id,node_type  from objects where item_parent_id=" . $id." ");
	if (mysql_num_rows($result) > 0) 
	{
		while ( $row = mysql_fetch_array($result) ) 
		{
		    $ID1 = $row[0];$PID=$row[2];$n_type=$row[3];
			 if (($n_type==0) or ($n_type==1)) $status=deleteVal($ID1,$n_type);
			  //������� ������ �� ������� �������� �����
		    $result1 = mysql_query("DELETE FROM objects where item_id='".$ID1."' ");
		    if (($result1) and ($status=="")) $status="";
		      else        $status="������ �������� ������ �� ������� �������� �����".mysql_error()."";
			  //������� ������ �� ������� ���������
	        $result2 = mysql_query("DELETE FROM counters where uid='".$ID1."' ");
		    if (($result2) and ($status=="")) $status="";
			   else        $status="������ �������� ������ �� ������� ���������".mysql_error()."";
			$level--;
 		  DelTree($ID1); 
		}
	}
	return $ID1;
 }

//===========================�������� �������� ���� ��� �����===================================================
function update($id,$pid,$level,$name,$todo,$icon,$node,$nobj,$adr,$znum,$ktr)
{ 
	global $status;
	$item_id=$id;
    $result = mysql_query("UPDATE objects set item_name='".$name."' where item_id='".$item_id."' ");
     if (($result) and ($status=="")) $status="";
     else        $status="������ ��������� ������ � ������� ��������� �����. ".mysql_error()."";
	  if ($node==1)  
	  {
	      $result = mysql_query("UPDATE counters set descript='".$name."' where uid='".$item_id."' ");
	      if (($result) and ($status=="")) $status="";
    	  else        $status="������ ��������� ������ � ������� ���������. ".mysql_error()."";
	 }
	  if ($node==0)  
	  {
echo "UPDATE counters set descript='".$name."',znum='".$znum."',k_tr='".$ktr."' where uid='".$item_id."' <br>";
	      $result = mysql_query("UPDATE counters set descript='".$name."',znum='".$znum."',k_tr='".$ktr."' where uid='".$item_id."' ");
	      if (($result) and ($status=="")) $status="";
    	  else        $status="������ ��������� ������ � ������� ���������. ".mysql_error()."";
	 }
}
//======================================================================================================================
function expand($child_id,$lvl)
{ 
global $str;
	$result = mysql_query("select item_id, item_name,item_parent_id from objects where item_id=" . $child_id." ");
	if (mysql_num_rows($result)>0)
	{
		while ($row=mysql_fetch_row($result)) 
		{
			$lvl--;
			$str='m'.$child_id.'.act();'.$str;
			expand($row[2],$lvl);
		}
	}	
	 return $str;
 }	
 
mysql_close();

function expandmenu($str,$res)
{
	echo "<SCRIPT language='JavaScript' >\n";
	echo "var str='".$str."';\n";
	echo "var res='".str_replace("'","`",$res)."';\n";
	echo "setTimeout('reload()',1000);\n";
	echo "</SCRIPT>\n";
}
?>
 <script>
		function reload()
		{
			window.parent.document.all.tags('fieldset')[0].innerHTML=res;
			window.parent.parent.frames[1].location.href=window.parent.parent.frames[1].location.href;
			setTimeout('expander()',2000);
		}
		function expander()
		{
			window.parent.parent.frames[1].open_menu(str);
			return;
		}
</SCRIPT>
</body>
</html>
