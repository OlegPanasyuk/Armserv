
//================================================================================================
var div_height=50;
var now=new Date();
var day=now.getDate()>9?now.getDate():'0'+now.getDate();
var month=now.getMonth()>8?(now.getMonth()+1):'0'+(now.getMonth()+1);
var year=now.getYear();
var curdate=day+'.'+month+'.'+year;
var adruspd;
var obj;
var adr;
var tweener;
control="<div class='help' id='subcontrol' style='width:100%; height:"+div_height+"; Text-align:center;z-index:+1'>"
//===========================================================================================================================
control+="<form name=\"topmenu\" method=\"get\">";
control+="<FIELDSET ID='fld3' style='width:100%;background-color:#B04D4F;'>";
control+="<LEGEND ALIGN='left' id='legenda'>Ручной запрос данных</LEGEND>";
control+="<TABLE BORDER='0' cellpadding='1' cellpadding='1' width='99%' id='formatData'>";
control+="<TR>";
control+="  <TD style='width:90px;'>запрашивать&nbsp;</TD>";
control+=" <TD style='width:120px;'>";
control+="  <select name='disp' size='1' style='width:110px'>";

control+="	 <option value='2' SELECTED>по дням</option>";
control+="  </select>";
control+="</TD>";
control+="<TD>номер объекта tweener <input type='text' name='tweener' value = '0'></input></TD>";
control+="<td>адрес успд<input type='text' name='adr_uspd' value='-1' size=2'></input></td>";
control+="  <TD style='width:300px;'>&nbsp;дата/время: <input class='plain' name='dc' value='' size='14' readonly style='font-weight:bolder'>";
control+=" <a href='javascript:void(0)' onclick='checkMode(self);return false;'>";
control+=" <img name='popcal' align='absmiddle' src='images/calbtn.gif' width='34' height='22' border='0' alt='КАЛЕНДАРЬ'></a>";
control+=" <input type='Button' value='+' onclick='tAddListItem(window.document.topmenu.dc.value);'>&nbsp;";
control+=" <input type='Button' value='-' onclick='tRemoveListItem(window.document.topmenu.dc.value);'>";
control+=" </TD>";
control+="<td width='60px'><input type='button' value='запросить' onclick='window.document.submitForm.sender.click()' style=\"font-size:12px;font-weight:bolder;\"></td>";
control+="<td width='60px'><input type='button' value='сброс' onclick='window.document.submitForm.dropval.click()' style=\"font-size:12px;font-weight:bolder;\"></td>";
//control+="<td width='60px'><input type='button' value='статус' onclick='javascript:if (showStat()) setInt();' style=\"font-size:12px;font-weight:bolder;\"></td>";
control+="</td>";
control+="  <TD>";
control+="<input type='hidden' name='tab' value='"+tab+"' size=2>";
control+="<input type='hidden' name='iname' value='' size=2>";
control+="<input type='hidden' name='id' value='-1' size=2>";
control+="<input type='hidden' name='pid' value='-1' size=2'>";
control+="<input type='hidden' name='lid' value='-1' size=2'>";
control+="<input type='hidden' name='node' value='-1' size=2'>";
control+="<input type='hidden' name='nobj' value='-1' size=2'>";
control+="<input type='hidden' name='adr' value='-1' size=2'>";

control+="<input type='hidden' name='frameName' id='frameName' value='manual_query'>";
control+="</TD>";
control+="</tr></table></FIELDSET>";
control+="</form>";
//===========================================================================================================================
control+="</div>";

function showStat()
{
if (checkID())
 {
  nobj=window.document.topmenu.nobj.value;
    adr=window.document.topmenu.adr.value;
  window.scanner.location.href="ByDate.php?nobj="+nobj+"&adr="+adr;
  return 1;
 }
 return 0;
}
function checkID()
{
	window.document.topmenu.iname.value=window.parent.toc.item_name.value;
	window.document.topmenu.id.value=window.parent.toc.item_id.value;
	window.document.topmenu.pid.value=window.parent.toc.par_id.value;
	window.document.topmenu.lid.value=window.parent.toc.level.value;
	window.document.topmenu.nobj.value=window.parent.toc.nobj.value;
	window.document.topmenu.node.value=window.parent.toc.ntype.value;
	window.document.topmenu.adr.value=window.parent.toc.adr.value;
	
	var id=window.document.topmenu.id.value;
	var pid=window.document.topmenu.pid.value;
	var lid=window.document.topmenu.lid.value;
	adruspd = window.document.topmenu.adr_uspd.value;
	adr = window.document.topmenu.adr.value;
	obj = window.document.topmenu.nobj.value;
	tweener = window.document.topmenu.tweener.value;

	if (window.document.topmenu.nobj.value<0) {alert("Не выбран объект");return 0;}
	if (window.document.topmenu.adr.value<0) {alert("Не выбран объект");return 0;}
	if (window.document.topmenu.node.value<0) {alert("Не выбран счетчик");return 0;}

document.forms[1].adr.value=window.document.topmenu.adr.value;
document.forms[1].nobj.value=window.document.topmenu.nobj.value;
document.forms[1].disp.value=window.document.topmenu.disp.value;
 return 1;
}




ctrl_width=0;
ctrl_height=5;
ie4=document.all;
document.write('<div id="control" style="position:absolute;top:'+ctrl_height+';right:'+ctrl_width+';z-index:+1">'+control+'</div>')
if ((window.parent.toc.ntype.value!=0)&&(window.parent.toc.ntype.value!=1))
legenda.innerHTML=window.parent.toc.item_name.value+' <span style="color:black;font-size:10px;">(выберите счетчик)</span>';
//document.all.control.style.display='none';
 ctrl_width_start=0;ctrl_height_start=0;  
 ydiff=ctrl_height_start-document.body.scrollTop;
 xdiff=ctrl_width_start-document.body.scrollLeft
if(ydiff!=0){ movey=Math.round(ydiff/10); ctrl_height_start-=movey}
if(xdiff!=0) { movex=Math.round(xdiff/10); ctrl_width_start-=movex}

function ctrl_move()
{
ctrl_height=document.body.scrollTop;
//ctrl_height=0;
 if(ie4)
 { 
  ydiff=ctrl_height_start=0;
  xdiff=ctrl_width_start-document.body.scrollLeft
 }
if(ydiff!=0){ movey=Math.round(ydiff/10); ctrl_height_start-=movey}
if(xdiff!=0) { movex=Math.round(xdiff/10); ctrl_width_start-=movex}
try{
if(ie4){document.all.control.style.top=ctrl_height_start+ctrl_height;document.all.control.style.right=ctrl_width_start+ctrl_width}
}
catch(e) {}
document.all.control.style.display='inline';
}
controls=setInterval("ctrl_move()",20)

function cal_onclick()
{
if(self.gfPop) gfPop.fPopCalendar(dc);return false;
}





