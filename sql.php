<?php
  ///////////////////////////////////////////////////
  // Модуль безопасности
  require_once("security_mod.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>Редактирование структуры</title>
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
    <link type="text/css" rel="stylesheet" href="css/default.css">
	<link rel="stylesheet" href="css/j.css"></link>

<style>
SUP {font-size:14px;font-weight:bolder;color:red}
</style>
<script>

function changeForm(obj) {
	if (obj.value <= 4) {document.forms[0].generation.disabled = false;document.forms[0].heating.disabled = false;}
	if (obj.value >= 5) {document.forms[0].generation.disabled = true;document.forms[0].heating.disabled = true;}
}


function click() {
event.cancelBubble = true;
event.returnValue = false;
}
//document.oncontextmenu = click;
function set()
{
 adr=0;nobj=0;
 sid=document.forms[0].sid.value;
 pid=document.forms[0].pid.value;
 level=document.forms[0].level.value;
 todo=document.forms[0].todo.value;
 icon=document.forms[0].icon.value;
 node=document.forms[0].node.value;
 iname=document.forms[0].iname.value;
 dd=document.forms[0].deldata.value;
 param_string='_';
 ktr=1;
 if ((node==0||node==1)&&(pid>=0)&&(todo!='delete'))
 {
  nzavod=document.forms[0].nzavod.value;
  ktr=document.forms[0].ktr.value;
  if (todo=='insert')
  {
   adr=document.forms[0].adr.value;
   nobj=document.forms[0].nobj.value;
   typeofcircles = document.forms[0].typeofcircles.value;
   if (document.forms[0].t1.checked) {ctype=0;  icon='counter';}
   if (document.forms[0].heating.checked) {ctype=-1;  icon='counter';}
   if (document.forms[0].t2.checked) { if (document.forms[0].heating.checked) ctype=-1; else ctype=1;  icon='sum_counter';node=1;ktr=0}
   if (document.forms[0].t3.checked) { if (document.forms[0].heating.checked) ctype=-1; else ctype=1;  icon='sum_counter';node=3;ktr=0}
   if (document.forms[0].t4.checked) { if (document.forms[0].heating.checked) ctype=-1; else ctype=1;  icon='sum_counter';node=4;ktr=0}
   if (document.forms[0].t5.checked) { ctype=2;  icon='water';   node=5;}
   if (document.forms[0].t6.checked) { ctype=3;  icon='water';   node=6;}
   if (document.forms[0].t7.checked) { ctype=4;  icon='heat';    node=7; typeofcircles = document.forms[0].typeofcircles.value;}
   if (document.forms[0].t8.checked) { ctype=5;  icon='sumheat'; node=8;}
   if (document.forms[0].t9.checked) { ctype=6;  icon='heat';    node=9;}
   if (document.forms[0].generation.checked) {ctype=-2;  icon='counter';}
   param_string='id='+sid+'&pid='+pid+'&level='+level+'&name='+iname+'&todo='+todo+'&icon='+icon+'&node='+node+'&nzavod='+nzavod+'&adr='+adr+'&nobj='+nobj+'&ctype='+ctype+'&ktr='+ktr+'&typeofcircles='+typeofcircles;
  }
  else param_string='id='+sid+'&pid='+pid+'&level='+level+'&name='+iname+'&todo='+todo+'&icon='+icon+'&node='+node+'&nzavod='+nzavod+'&adr='+adr+'&nobj='+nobj+'&ctype=-1'+'&deldata='+dd+'&ktr='+ktr;
  //alert(param_string);//return;

 }
 else
 {
    param_string='id='+sid+'&pid='+pid+'&level='+level+'&name='+iname+'&todo='+todo+'&icon='+icon+'&node='+node+'&nzavod=&adr=-1&nobj=-1&ctype=-1'+'&deldata='+dd+'&ktr='+ktr;
	window.ifr.location.href='tree_edit.php?'+param_string;
    return;
 }
 if (todo!='delete')
 {
	if ((iname=='')||(isNaN(adr))||(isNaN(nobj)))
		alert('Проверьте правильность заполнения полей !');
	else if ((adr>=0)&&(nobj>=0))
		{
		 if (node==0)
		 {
		  window.ifr.location.href='tree_edit.php?'+param_string;
		 }
		 if (node==1)
		 {
		  if ((adr>1000)||(nobj>1000)) window.ifr.location.href='tree_edit.php?'+param_string;
			else	alert('Проверьте правильность заполнения полей !');
		 }
		 if (node==3)
		 {
		  if ((adr>1000)||(nobj>1000)) window.ifr.location.href='tree_edit.php?'+param_string;
			else	alert('Проверьте правильность заполнения полей !');
		 }
		 if (node==4)
		 {
		  if ((adr>1000)||(nobj>1000)) window.ifr.location.href='tree_edit.php?'+param_string;
			else	alert('Проверьте правильность заполнения полей !');
		 }
		 if (node==5)
		 {
		  window.ifr.location.href='tree_edit.php?'+param_string;
		 }
         if (node==6)
		 {
		  if ((adr>1000)||(nobj>1000)) window.ifr.location.href='tree_edit.php?'+param_string;
		 }
		 if (node==7)
		 {
		  window.ifr.location.href='tree_edit.php?'+param_string;
		 }
         if (node==8)
		 {
		  if ((adr>1000)||(nobj>1000)) window.ifr.location.href='tree_edit.php?'+param_string;
		 }
		 if (node==9)
		 {
		  window.ifr.location.href='tree_edit.php?'+param_string;
		 }
		}
	else	alert('Проверьте правильность заполнения полей !');
 }
 else  {
     window.ifr.location.href='tree_edit.php?'+param_string;
 }
}
</script>
</head>
<body background=tree/imgs/fon.gif>
<table width=100% cellpadding=0 cellspacing=0 height=100% background=tree/imgs/fon.gif><tr><td>
<table width=100% cellpadding=0 cellspacing=0 background=tree/imgs/fon.gif>
<tr valign=bottom><td height=50>
&nbsp;
</td>
</tr></table>
</td></tr><tr><td height=100%>

<table width=100% cellpadding=7 cellspacing=0 height=100%><tr><td valign=top >
<img src=tree/imgs/spacer.gif height=1 width=10 >
<table id=tb cellpadding=0 cellspacing=0>
</table>

</td><td width=100% valign=top background=tree/imgs/fon.gif>

<img src=tree/imgs/spacer.gif height=3 width=350 ><br>
<table border=1 bordercolor=A5D7D6 width=100% cellpadding=10><tr><td  id=container>

<TABLE width="100%" border=0 cellpadding=0>
<tr><td align=right><img src='tree/imgs/rline.gif' width=350 height=2 border=0></td></tr>
<tr><td><BIG>Редактирование структуры объектов АСКУЭ.</BIG></td></tr>
<tr><td><img src='tree/imgs/lline.gif' width=350 height=2 border=0></td></tr>
<TR><TD valign=top>
<br>

<?
include("util_fun.php");
 $id = $_GET['id'];
 $pid = $_GET['pid'];
 $level=$_GET['level'];
 $name=$_GET['name'];
  $todo = $_GET['todo'];
  $icon = $_GET['icon'];
  $node= $_GET['node'];
  $typeofcircles = $_GET['typeofcircles'];
  if (!isset($typeofcircles)){
	$typeofcircles = "1,1,1,1";
  }
  $new_id=$id;
$action='не определено';
$caption='';
$field='';
              // Вырежем лишние слеши...
            $name = stripslashes($name);
              // Заменим двойные кавычки одинарными
            $name = str_replace("'",'"',$name);
              // Раскодируем строку после передачи  ее браузером и поставим на ее краях двойные кавычки
//            $name = ''.UrlDecode($name).'';

switch ($todo)
{
 case 'insert' :
 				{
					if ($node==0) {
									// общие параметры точки учета
									$action='добавление нового узла к объекту <strong>'.$name.'</strong>';
									$field="<tr><td>название узла</td><td><input type=\"text\" name=\"iname\" id=\"iname\" size=\"20\" maxlength=\"100\" onfocus=\"this.select()\" value=\"новый узел\"><SUP>*</SUP></td></tr>\n";
									$field.="<tr><td>заводской номер</td><td> <input type=\"text\" name=\"nzavod\" id=\"nzavod\" size=\"15\" maxlength=\"10\" onfocus=\"this.select()\" value=\"00000000\"></td></tr>\n";
									$field.="<tr><td>коэф-т трансф.</td><td> <input type=\"text\" name=\"ktr\" id=\"ktr\" size=\"6\" maxlength=\"5\" onfocus=\"this.select()\" value=\"1\"><SUP>*</SUP></td></tr>\n";
									$field.="<tr><td>сетевой адрес</td><td> <input type=\"text\" name=\"adr\" id=\"adr\" size=\"5\" maxlength=\"4\" onfocus=\"this.select()\" value=\"0\"><SUP>*</SUP></td></tr>\n";
									$field.="<tr><td>№ объекта с12 </td><td><input type=\"text\" name=\"nobj\" id=\"nobj\" size=\"5\" maxlength=\"4\" onfocus=\"this.select()\" value=\"0\"><SUP>*</SUP></td></tr>\n";

									// выбор точки учета
									$field2="<tr><td colspan=2><hr width='100%' size='1' noshade>добавляемый узел является:</td></tr>\n";
									$field2.="<tr><td><input type=\"radio\" name=\"ctype\" id=\"t1\" value=\"1\" checked onclick=\"changeForm(this);\"><label for=\"t1\">точкой учета электроэнергии</label></td><td><input type=\"radio\" name=\"ctype\" id=\"t2\" value=\"2\"  onclick=\"changeForm(this);\"><label for=\"t2\">суммирующей точкой учета электроэнергии</label></td></tr>\n";
									$field2.="<tr><td><input type=\"radio\" name=\"ctype\" id=\"t3\" value=\"3\" onclick=\"changeForm(this);\"><label for=\"t3\">А+</label></td>\n";
									$field2.="<td><input type=\"radio\" name=\"ctype\" id=\"t4\" value=\"4\" onclick=\"changeForm(this);\"><label for=\"t4\">А-</label></td></tr>\n";
									$field2.="<tr><td><input type=\"radio\" name=\"ctype\" id=\"t5\" value=\"5\" onclick=\"changeForm(this);\"><label for=\"t5\">точкой учета воды</label></td>\n";
									$field2.="<td><input type=\"radio\" name=\"ctype\" id=\"t6\" value=\"6\"  onclick=\"changeForm(this);\"><label for=\"t6\">суммирующей точкой учета воды</label></td>\n</tr>";
									$field2.="<tr><td><input type=\"radio\" name=\"ctype\" id=\"t7\" value=\"7\"  onclick=\"changeForm(this);\"><label for=\"t7\">Учет тепла ТС-07</label><td><input type=\"text\" name=\"typeofcircles\" id=\"t7-1\" value=\"1,1,1,1\"></td>\n</tr>";
									$field2.="<td><input type=\"radio\" name=\"ctype\" id=\"t8\" value=\"8\"  onclick=\"changeForm(this);\"><label for=\"t8\">Суммирующей учет тепла</label></td>\n</tr>";
									$field2.="<tr><td><input type=\"radio\" name=\"ctype\" id=\"t9\" value=\"9\"  onclick=\"changeForm(this);\"><label for=\"t9\">Учет тепла ТЭМ-104</label></td>\n</tr>";
									$field2.="<tr><td colspan=2><input type=\"checkbox\" name=\"heating\" id=\"heating\" value=\"0\">&nbsp;<label for=\"heating\">считать как обогрев</label></td></tr>\n";
									$field2.="<tr><td colspan=2><input type=\"checkbox\" name=\"generation\" id=\"generation\" value=\"0\">&nbsp;<label for=\"generation\">устанавливается на объекте генерации</label></td></tr>\n";
									$field2.="<tr><td colspan=2><hr width='100%' size='1' noshade><SUP>*</SUP> - поля являются обязательными для заполнения</td></tr>\n";
									$field.=$field2;
//									if ($node==0) $field="<tr><td colspan=2>Выбранный элемент является точкой учета.<br> Добавление нового элемента невозможно</td></tr>";
								}
					if ($node==2) {
									$action='добавление новой папки к объекту <strong>'.$name.'</strong>';
									$field="<tr><td>название папки</td><td><input type=\"text\" name=\"iname\" id=\"iname\" size=\"30\" maxlength=\"25\" onfocus=\"this.select()\" value=\"новая папка\"><SUP>*</SUP></td></tr>\n";
									$field.="<tr><td colspan=2><hr width='100%' size='1' noshade><SUP>*</SUP> - поля являются обязательными для заполнения</td></tr>";
								}
				}
 break;
 case 'delete' :
 				{
					$action='удаление объекта <strong>'.$name.'</strong>';
					$field="<tr><td colspan=2>Внимание: также будут удалены все объекты входящие в <strong>".$name."</strong> !<input type=\"hidden\" name=\"iname\" id=\"iname\" onfocus=\"this.select()\"  size=\"1\" maxlength=\"20\" value=\"\"></td></tr>\n";
					$field.="<tr><td colspan=2><input type='checkbox' name='ddata' id='ddata' value='1' checked onclick='if (this.checked) document.forms[0].deldata.value=1;else document.forms[0].deldata.value=0'>удалять данные </td></tr>\n";
				}
 break;
 case 'update' :
 				{
 					$action='редактирование объекта <strong>'.$name.'</strong>';
					$field="<tr><td>название узла</td><td><input type=\"text\" name=\"iname\" id=\"iname\" size=\"20\" maxlength=\"20\" onfocus=\"this.select()\" value='".$name."'><SUP>*</SUP></td></tr>\n";
					$result = mysql_query( "select node_type from objects where item_id=" . $id." ");
					if (mysql_num_rows($result) > 0)
					 {
					  $row = mysql_fetch_array($result);
					  $n_type=$row[0];
					 }
					if (($n_type==0) or ($n_type==1))
					 {
					  $result0 = mysql_query( "select n_obj,link_adr,znum,k_tr from counters where uid=" . $id." ");
					  if ($row0 = mysql_fetch_array($result0) )
					  {
					   $nobj=$row0[0]; $adr=$row0[1];$znum=$row0[2];$ktr=$row0[3];
					  }
					  if ($n_type==0)
					  {
									$field.="<tr><td>заводской номер</td><td> <input type=\"text\" name=\"nzavod\" id=\"nzavod\" size=\"15\" maxlength=\"10\" onfocus=\"this.select()\" value=\"".$znum."\"></td></tr>\n";
									 $field.="<tr><td>коэф-т трансф.</td><td> <input type=\"text\" name=\"ktr\" id=\"ktr\" size=\"6\" maxlength=\"5\" onfocus=\"this.select()\" value=\"".$ktr."\"><SUP>*</SUP></td></tr>\n";
									//$field.="<tr><td>сетевой адрес</td><td> <input type=\"text\" name=\"adr\" id=\"adr\" size=\"5\" maxlength=\"4\" onfocus=\"this.select()\" value=\"".$adr."\"><SUP>*</SUP></td></tr>\n";
									//$field.="<tr><td>№ объекта с12 </td><td><input type=\"text\" name=\"nobj\" id=\"nobj\" size=\"5\" maxlength=\"4\" onfocus=\"this.select()\" value=\"".$nobj."\"><SUP>*</SUP></td></tr>\n";
					  }
					}
					$field.="<tr><td colspan=2><hr width='100%' size='1' noshade><SUP>*</SUP> - поля являются обязательными для заполнения</td></tr>";
				}
 break;
 case 'info' :
 				{
				if ($node==0) {
					$result=mysql_query("select n_obj,link_adr,znum,k_tr from counters where uid=".$id."");
 					$action='параметры объекта '.$name;
					if ($result) $res=mysql_fetch_array($result,MYSQL_BOTH);
					 $obj=$res[0];$adr=$res[1];$znum=$res[2];$ktr=$res[3];
					$field="<tr><td>Идентификатор: </td><td>$id</td></tr>\n";
					$field.="<tr><td>№ объекта: </td><td>$obj</td></tr>\n";
					$field.="<tr><td>Сетевой адрес: </td><td>$adr</td></tr>\n";
					$field.="<tr><td>Зав. номер: </td><td>$znum</td></tr>\n";
					$field.="<tr><td>Коэф-т трансф.: </td><td>$ktr</td></tr>\n";
				   }
				}
 break;
}
if ($todo<>'info') echo "<br>Будет выполнено следующее действие: <i>".$action."</i>";
echo "<form  method=\"get\">\n";
echo "<FIELDSET style=\"width:450px;border: thin solid #A5D7D6;\">";
echo "<LEGEND>$action</LEGEND><table border=0 style='margin-left:20px;'>";
echo "<input type=\"hidden\" name=\"todo\" id=\"todo\" size=\"20\" maxlength=\"20\" value=\"$todo\"><br>\n";
echo $field;
if ($todo<>'info') echo "<tr><td colspan=2 align=center><br><input type=\"button\" value=\"выполнить\" onclick=\"set()\">\n</td></tr>";
echo "</table></FIELDSET>";
echo "<input type=\"hidden\" name=\"sid\" id=\"sid\" size=\"4\" maxlength=\"4\" value=\"$id\">\n";
echo "<input type=\"hidden\" name=\"pid\" id=\"pid\" size=\"4\" maxlength=\"4\" value=\"$pid\">\n";
echo "<input type=\"hidden\" name=\"level\" id=\"level\" size=\"4\" maxlength=\"4\" value=\"$level\">\n";
echo "<input type=\"hidden\" name=\"icon\" id=\"icon\" size=\"4\" maxlength=\"4\" value=\"$icon\">\n";
echo "<input type=\"hidden\" name=\"node\" id=\"node\" size=\"4\" maxlength=\"4\" value=\"$node\">\n";
echo "<input type=\"hidden\" name=\"deldata\" id=\"deldata\" size=\"4\" maxlength=\"4\" value=\"1\">\n";
echo "</form>\n";
?>
	<table name="tem" style="display: none;">
		<tr>
			
		</tr>
		<tr>
			<td>
			<form name="typeOfCirclesTem">
				<td><label for="countOfCircles">Количество контуров</label>
					<select name="countOfCircles">
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
				</select></td>
				<label for="typeOfCercle1">Тип Контура №1</label>
				<select name="typeOfCercle1" id="typeOfCercle1">
					<option value=1>Подача</option>
					<option value=2>Обратка</option>
					<option value=3>Тупиковая ГВС</option>
					<option value=4>Подпитка НСО</option>
					<option value=5>Подпитка источника</option>
					<option value=6>Подача+Р</option>
					<option value=7>ГВС циркуляция</option>
					<option value=8>Открытая</option>
					<option value=9>Источник</option>
					<option value=10>Р-Подача+Подп.</option>
					<option value=11>Расходомер V</option>
					<option value=12>Расходомер M</option>
					<option value=13>Магистраль</option>
				</select>
				<label for="typeOfCercle2">Тип Контура №2</label>
				<select name="typeOfCercle2" id="typeOfCercle2">
					<option value=1>Подача</option>
					<option value=2>Обратка</option>
					<option value=3>Тупиковая ГВС</option>
					<option value=4>Подпитка НСО</option>
					<option value=5>Подпитка источника</option>
					<option value=6>Подача+Р</option>
					<option value=7>ГВС циркуляция</option>
					<option value=8>Открытая</option>
					<option value=9>Источник</option>
					<option value=10>Р-Подача+Подп.</option>
					<option value=11>Расходомер V</option>
					<option value=12>Расходомер M</option>
					<option value=13>Магистраль</option>
				</select>
				<label for="typeOfCercle3">Тип Контура №3</label>
				<select name="typeOfCercle3" id="typeOfCercle3">
					<option value=1>Подача</option>
					<option value=2>Обратка</option>
					<option value=3>Тупиковая ГВС</option>
					<option value=4>Подпитка НСО</option>
					<option value=5>Подпитка источника</option>
					<option value=6>Подача+Р</option>
					<option value=7>ГВС циркуляция</option>
					<option value=8>Открытая</option>
					<option value=9>Источник</option>
					<option value=10>Р-Подача+Подп.</option>
					<option value=11>Расходомер V</option>
					<option value=12>Расходомер M</option>
					<option value=13>Магистраль</option>
				</select>
				<label for="typeOfCercle4">Тип Контура №1</label>
				<select name="typeOfCercle4" id="typeOfCercle4">
					<option value=1>Подача</option>
					<option value=2>Обратка</option>
					<option value=3>Тупиковая ГВС</option>
					<option value=4>Подпитка НСО</option>
					<option value=5>Подпитка источника</option>
					<option value=6>Подача+Р</option>
					<option value=7>ГВС циркуляция</option>
					<option value=8>Открытая</option>
					<option value=9>Источник</option>
					<option value=10>Р-Подача+Подп.</option>
					<option value=11>Расходомер V</option>
					<option value=12>Расходомер M</option>
					<option value=13>Магистраль</option>
				</select>
			</form>
			</td>
		</tr>
		<tr id="paramCircle1">
			<td id="Podacha1">
				G порт подключения расходомера: <select name="G1"> 
					<option value="1">G1</option>
					<option value="2">G2</option>
					<option value="3">G3</option>
					<option value="4">G4</option>
				</select><br>
				tп номер датчика: <select name="tp">
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
				</select><br>
				pп номер датчика: <select name="pp">
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
				</select><br>
				tо номер датчика: <select name="to">
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
				</select><br>
				pо номер датчика: <select name="po">
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
				</select>
			</td>
			<td id="Obratka1">
				G порт подключения расходомера: <select name="G1"> 
					<option value="1">G1</option>
					<option value="1">G2</option>
					<option value="1">G3</option>
					<option value="1">G4</option>
				</select><br>
				tп номер датчика: <select name="tp">
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
				</select><br>
				pп номер датчика: <select name="pp">
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
				</select><br>
				tо номер датчика: <select name="to">
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
				</select><br>
				pо номер датчика: <select name="po">
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
				</select>
			</td>
			<td id="TypikovayaGVS1">
				G порт подключения расходомера: <select name="G1"> 
					<option value="1">G1</option>
					<option value="1">G2</option>
					<option value="1">G3</option>
					<option value="1">G4</option>
				</select><br>
				tг номер датчика: <select name="tg">
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
				</select><br>
				pг номер датчика: <select name="pg">
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
				</select><br>
				tх номер датчика: <select name="th">
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
				</select><br>
				pх номер датчика: <select name="ph">
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
				</select>
			</td>
			<td id="PodpitkaNSO1">
				G порт подключения расходомера: <select > 
					<option value="1">G1</option>
					<option value="1">G2</option>
					<option value="1">G3</option>
					<option value="1">G4</option>
				</select><br>
				to номер датчика: <select>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
				</select><br>
				po номер датчика: <select>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
				</select><br>
				tх номер датчика: <select>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
				</select><br>
				pх номер датчика: <select>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
				</select>
			</td>
			<td id="PodpitkaNSO1">
				G порт подключения расходомера: <select> 
					<option value="1">G1</option>
					<option value="1">G2</option>
					<option value="1">G3</option>
					<option value="1">G4</option>
				</select><br>
				to номер датчика: <select>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
				</select><br>
				po номер датчика: <select>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
				</select><br>
				tх номер датчика: <select>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
				</select><br>
				pх номер датчика: <select>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
				</select>
			</td>
			<td id="PodpitkaIstochnika1">
				G1 порт подключения расходомера: <select> 
					<option value="1">G1</option>
					<option value="1">G2</option>
					<option value="1">G3</option>
					<option value="1">G4</option>
				</select><br>
				G2 порт подключения расходомера: <select> 
					<option value="1">G1</option>
					<option value="1">G2</option>
					<option value="1">G3</option>
					<option value="1">G4</option>
				</select><br>
				to номер датчика: <select>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
				</select><br>
				po номер датчика: <select>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
				</select><br>
				tх номер датчика: <select>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
				</select><br>
				pх номер датчика: <select>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
				</select>
			</td>
			<td id="Podacha+P1">
				G1 порт подключения расходомера: <select> 
					<option value="1">G1</option>
					<option value="1">G2</option>
					<option value="1">G3</option>
					<option value="1">G4</option>
				</select><br>
				G2 порт подключения расходомера: <select> 
					<option value="1">G1</option>
					<option value="1">G2</option>
					<option value="1">G3</option>
					<option value="1">G4</option>
				</select><br>
				tп номер датчика: <select>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
				</select><br>
				pп номер датчика: <select>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
				</select><br>
				tо номер датчика: <select>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
				</select><br>
				pо номер датчика: <select>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
				</select>
			</td>
			<td id="PodpitkaIstochnika1">
				G1 порт подключения расходомера: <select> 
					<option value="1">G1</option>
					<option value="1">G2</option>
					<option value="1">G3</option>
					<option value="1">G4</option>
				</select><br>
				G2 порт подключения расходомера: <select> 
					<option value="1">G1</option>
					<option value="1">G2</option>
					<option value="1">G3</option>
					<option value="1">G4</option>
				</select><br>
				tп номер датчика: <select>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
				</select><br>
				pп номер датчика: <select>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
				</select><br>
				to номер датчика: <select>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
				</select><br>
				po номер датчика: <select>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
				</select><br>
				tх номер датчика: <select>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
				</select><br>
				pх номер датчика: <select>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
				</select>
			</td>
			<td id="Otkrtaya1">
				G1 порт подключения расходомера: <select> 
					<option value="1">G1</option>
					<option value="1">G2</option>
					<option value="1">G3</option>
					<option value="1">G4</option>
				</select><br>
				G2 порт подключения расходомера: <select> 
					<option value="1">G1</option>
					<option value="1">G2</option>
					<option value="1">G3</option>
					<option value="1">G4</option>
				</select><br>
				tп номер датчика: <select>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
				</select><br>
				pп номер датчика: <select>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
				</select><br>
				to номер датчика: <select>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
				</select><br>
				po номер датчика: <select>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
				</select><br>
				tх номер датчика: <select>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
				</select><br>
				pх номер датчика: <select>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
				</select>
			</td>
			<td id="Istochnik1">
				G1 порт подключения расходомера: <select> 
					<option value="1">G1</option>
					<option value="1">G2</option>
					<option value="1">G3</option>
					<option value="1">G4</option>
				</select><br>
				G2 порт подключения расходомера: <select> 
					<option value="1">G1</option>
					<option value="1">G2</option>
					<option value="1">G3</option>
					<option value="1">G4</option>
				</select><br>
				tп номер датчика: <select>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
				</select><br>
				pп номер датчика: <select>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
				</select><br>
				to номер датчика: <select>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
				</select><br>
				po номер датчика: <select>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
				</select><br>
				tх номер датчика: <select>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
				</select><br>
				pх номер датчика: <select>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
				</select>
			</td>
			<td id="P-Podacha+podpitka1">
				G1 порт подключения расходомера: <select> 
					<option value="1">G1</option>
					<option value="1">G2</option>
					<option value="1">G3</option>
					<option value="1">G4</option>
				</select><br>
				G2 порт подключения расходомера: <select> 
					<option value="1">G1</option>
					<option value="1">G2</option>
					<option value="1">G3</option>
					<option value="1">G4</option>
				</select><br>
				tп номер датчика: <select>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
				</select><br>
				pп номер датчика: <select>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
				</select><br>
				to номер датчика: <select>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
				</select><br>
				po номер датчика: <select>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
				</select><br>
				tх номер датчика: <select>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
				</select><br>
				pх номер датчика: <select>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
				</select>
			</td>
			<td id="RashodomerV1">
				G порт подключения расходомера: <select> 
					<option value="1">G1</option>
					<option value="1">G2</option>
					<option value="1">G3</option>
					<option value="1">G4</option>
				</select><br>
			</td>
			<td id="RashodomerM1">
				G порт подключения расходомера: <select> 
					<option value="1">G1</option>
					<option value="1">G2</option>
					<option value="1">G3</option>
					<option value="1">G4</option>
				</select><br>
				t номер датчика: <select>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
				</select><br>
				p номер датчика: <select>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
				</select>
			</td>
			<td id="Magistral1">
				G порт подключения расходомера: <select> 
					<option value="1">G1</option>
					<option value="1">G2</option>
					<option value="1">G3</option>
					<option value="1">G4</option>
				</select><br>
				t номер датчика: <select>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
				</select><br>
				p номер датчика: <select>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
				</select>
			</td>
			</tr>
	</table>

<iframe width=1 height=1 name=ifr id=ifr frameborder=0 scrolling=0 src="about:blank"></iframe>
</TD></TR>
<tr><td align=right><img src='tree/imgs/rline.gif' width=350 height=2 border=0><br></td></tr>
 </TABLE>
</td></tr></table>
</td></tr></table>
</td></tr></table>


</body>
</html>
