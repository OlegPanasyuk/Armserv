//================================================================================================
var div_height=50;
var now=new Date();
var day=now.getDate()>9?now.getDate():'0'+now.getDate();
var month=now.getMonth()>8?(now.getMonth()+1):'0'+(now.getMonth()+1);
var year=now.getYear();
var curdate=day+'.'+month+'.'+year;

control="<div class='help' id='subcontrol' style='width:100%; height:"+div_height+"; Text-align:center;z-index:+1'>"
//===========================================================================================================================
control+="<form name=\"topmenu\" method=\"get\">";
control+="<FIELDSET ID='fld3' style='width:100%;background-color:#B04D4F;'>";
control+="<LEGEND ALIGN='left' id='legenda'>‘ормат данных</LEGEND>";
control+="<TABLE BORDER='0' cellpadding='1' cellpadding='1' width='99%' id='formatData'>";
control+="<TR>";
control+="  <TD style='width:1px;'>&nbsp;</TD>";

control+="  <TD style='width:180px'>";
control+="<input type='hidden' name='tab' value='"+tab+"' size=2>";
control+=" <input type='checkbox' name='curtime' id='curtime' value='0' onclick='setMode(this)'><label for='curtime'>привязать к тек. времени</label>";
control+="</TD>";

control+="  <TD style='width:45px;'>врем€ &nbsp;</TD>";
control+=" <td align='left' style='width:160px'><input name='dc' value='' size='14' readonly style='font-weight:bolder'>";
control+="<a href='javascript:void(0)' onclick='if(self.gfPop) gfPop.fPopCalendar(dc);return false;' HIDEFOCUS>";
control+="<img align='absmiddle' id='imgCal' name='imgCal' src='images/calbtn_small.gif' width='14' height='22' border='0' alt=' јЋ≈Ќƒј–№' onMouseOver='this.style.cursor=\"hand\"'>	</a> </td>";

control+="  <TD style='width:30px;'>ретроспектива&nbsp;</TD>";
control+="  <TD style='width:100px;'>";
control+="   <select name='disp' size='1' style='width:90px'>";
control+="	<option value='0' SELECTE>нет</option>";
control+="	<option value='3'D>3 минуты</option>";
control+="	<option value='15'>15 минут</option>";
control+="	<option value='30'>30 минут</option>";
control+="	<option value='60'>1 час</option>";
control+="	<option value='120'>2 часа</option>";
control+="	<option value='180'>3 часа</option>";
control+="	<option value='360'>6 часов</option>";
control+="	<option value='720'>12 часа</option>";
control+="	<option value='1440'>24 часа</option>";
control+="   </select>";
control+="</TD>";

control+="<td><input type='submit' value='чтение' id='go' onclick='checkID()' style=\"font-size:12px;font-weight:bolder;\"></td>";

control+="<TD>";
control+="<img src='images/print.gif' alt='печать' style='cursor:hand' width='16' height='14' border='0' align='middle' onclick='print()'>";
//control+="&nbsp;&nbsp;<img src='images/excel24.gif' id='toXLS' alt='экспорт в Excel' style='cursor:hand' width='24' height='24' border='0' align='middle' ONCLICK='excel_exp();'>";
control+="<input type='hidden' name='iname' value='-1' size=2>";
control+="<input type='hidden' name='id' value='-1' size=2>";
control+="<input type='hidden' name='pid' value='-1' size=2'>";
control+="<input type='hidden' name='lid' value='-1' size=2'>";
control+="<input type='hidden' name='node' value='-1' size=2'>";
control+="<input type='hidden' name='nobj' value='-1' size=2'>";
control+="<input type='hidden' name='adr' value='-1' size=2'>";
control+="<input type='hidden' name='frameName' id='frameName' value='3min_p'>";
control+="  </TD>";
control+="</tr></table></FIELDSET>";
control+="</form>";
//===========================================================================================================================
control+="</div>";
function setMode(obj)
{
 if (obj.value==0) 
 {
  obj.value=1; 
  //window.document.topmenu.curtime.value=value
  // window.document.topmenu.disp.disabled=true;
  // window.document.imgCal.style.display='none'
 } 
 else 
 {
  obj.value=0;
  //window.document.topmenu.curtime.value=value
//  window.document.topmenu.disp.disabled=false;
//  window.document.imgCal.style.display='inline'
 } 
 window.document.topmenu.curtime.value=obj.value;
}
function set_Time()
{
var delay=30;
SetIP(IP,Port);
OpenPort();
realTime=fw10.GetTime();
timeStr=realTime.split(":");
alert(timeStr[0]+":"+timeStr[1])
ClosePort();
}

function SetIP(IP,Port)
{
//	SetIP("[IP-адрес сервера с12]",[UDP-порт прив€зки - 5150 по умолчанию]);
	var result=0;
	result=fw10.SetIP(IP,Port);
	return result;
}
function OpenPort()
{
 var result=0;
 result=fw10.OpenPort(1,1,9600);
 return result;
}
function ClosePort()
{
 var result=1;
 result=fw10.ClosePort(1,1);
 return result;
}
function val(row,col)
{
 return document.all.TB2.rows[row].cells[col].innerText;
}

function excel_exp()
{
 try
 {
  if ((document.all('TB').innerText)!='') 
  {
	var tbls = document.getElementsByTagName("TABLE");
	OpenXls();
	i=5;
	var row_count=tbls[i].rows.length
	// последовательнный перебор всех таблиц в коллекции
	  for (var r=0; r<tbls[i].rows.length; r++) 
	  {  // последовательнный перебор всех р€дов в каждой таблице
	    for (var c=0; c<tbls[i].rows[r].cells.length; c++) 
		{   // последовательный перебор всех €чеек
			val=tbls[i].rows[r].cells[c].innerText;
			FillXls(r+1,c+1,val,row_count)
	    }
	  }
	activator.click()
//CloseXls();
   }
 }
 catch(e)
 {
  alert("ќшибка: "+e.name);return 0;
 }
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
}

ctrl_width=0;
ctrl_height=5;
ie4=document.all;
document.write('<div id="control" style="position:absolute;top:'+ctrl_height+';right:'+ctrl_width+';z-index:+1">'+control+'</div>')
document.write('<iframe width=188 height=166 name="gToday:normal::gfPop:plugins_time2.js" id="gToday:normal::gfPop:plugins_time2.js" src="datetime/ipopeng2.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"></iframe>');
//if (window.document.topmenu.dc.value=='') window.document.topmenu.dc.value=curdate;
if ((window.parent.toc.ntype)&&(window.parent.toc.ntype.value!=0))
legenda.innerHTML=window.parent.toc.item_name.value+' <span style="color:black;font-size:10px;">(выберите счетчик)</span>';
 ctrl_width_start=0;ctrl_height_start=0;  
 ydiff=ctrl_height_start-document.body.scrollTop;
 xdiff=ctrl_width_start-document.body.scrollLeft
if(ydiff!=0){ movey=Math.round(ydiff/10); ctrl_height_start-=movey}
if(xdiff!=0) { movex=Math.round(xdiff/10); ctrl_width_start-=movex}


function ctrl_move()
{
ctrl_height=document.body.scrollTop;
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


