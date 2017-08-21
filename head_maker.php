<?
  $node= $_GET['node'];
  $n_obj= $_GET['nobj'];
  $adr= $_GET['adr'];
  $arh=$_GET['arh'];
if (isset($n_obj) and isset($adr) and isset($node))
if ($n_obj>=0 and $adr>=0 and $node==0)
{
include("include/mysql.php"); //  Соединяемся с БД
//=====================определяем параметры и название точки учета===================================
	$result=mysql_query("select izm_str,descript,znum,c_type,uid FROM counters WHERE  n_obj=".$n_obj." AND link_adr=".$adr." ");
    if ($result)
	{
	 $res=mysql_fetch_array($result,MYSQL_BOTH);
	 $izm_str=$res[0];	$type_izm = explode (",",$izm_str); $uid=$res[4];
	 $name=$res[1]; if ($res[3]==0) {$znum= "<br>номер счетчика ".$res[2];$zn=$res[2];} else {$znum=""; $zn="";}
	} 
	$result=mysql_query("select item_name FROM objects WHERE  item_id=(select item_parent_id FROM objects WHERE item_id=".$uid.") ");
    if ($result)
	{
	 $res=mysql_fetch_array($result,MYSQL_BOTH);
	 $pname=$res[0];
	 $str_title="Данные по точке учета ".$pname." ".$name." ".$znum;
	} 
	if ($arh==1) $arh_name="Архив фаз";
	if ($arh==2) $arh_name="Архив состояний";
	if ($arh==3) $arh_name="Архив корректировок";

	echo "<script>
	window.parent.header.innerHTML='';window.parent.header.innerHTML='".$str_title."';";
		if (isset($arh)) 
		{
		 echo "window.parent.header2.innerHTML='';window.parent.header2.innerHTML='".$arh_name."';";
		}
		 echo "window.parent.document.topmenu.zn.value='".$zn."';";
	echo "</script>";
}	
?>