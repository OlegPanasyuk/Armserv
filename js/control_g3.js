//================================================================================================
var div_height=50;
var now=new Date();
var day=now.getDate()>9?now.getDate():'0'+now.getDate();
var month=now.getMonth()>8?(now.getMonth()+1):'0'+(now.getMonth()+1);
var year=now.getYear();
var curdate=day+'.'+month+'.'+year;
control="<div class='help' id='subcontrol' style='width:190px; height:"+div_height+"; Text-align:center;z-index:+1'>"
//===========================================================================================================================
control+="<div class='handle' href=''></div> <!-- Ссылка для пользователей с отключенным JavaScript -->"
control+="<form name=\"topmenu\" method=\"get\">";
control+="<FIELDSET ID='fld3' style='width:100%;background-color:#c1cdcd;'>";
control+="<LEGEND ALIGN='left' id='legenda'>‘ормат данных</LEGEND>";
control+="<TABLE BORDER='0' cellpadding='1' cellpadding='1' width='99%' id='formatData'>";
control+="<TR>";
control+="<TD style='width:25px;'>";
control+="    <input type='hidden' name='tab' value='"+tab+"' size=2>";
control+="    <input type='hidden' name='dispe' size='1' style='width:100px' value='1'>";
control+="";
control+="  тип</TD></tr>";
control+="  <tr><TD style='width:150px'>";
control+="   <select name='type' size='1' style='width:150px'>";
control+="	<option value='9' SELECTED>активная прием</option>";
control+="	<option value='10'>активная отдача</option>";
control+="	<option value='11'>реактивная прием</option>";
control+="	<option value='12'>реактивная отдача</option>";
control+="   </select>";
control+="</TD></tr>";
control+="<tr><TD style='width:130px;' id='maxp_lab'>единицы измерения</TD></tr>";
control+="  <tr><TD style='width:95px'>";
control+="   <select name='edizm' size='1' style='width:95px'>";
control+="	<option value='1' SELECTED>кВт/квар</option>";
control+="	<option value='1000'>МВт/Мвар</option>";
control+="   </select>";
control+="</TD></tr>";

control+="  <tr><TD style='width:190px'>";
control+="<input type='hidden' name='tab' value='"+tab+"' size=2>";
control+=" <input type='checkbox' name='curtime' id='curtime' value='0' onclick='setMode(this)'>привязать к тек. времени";
control+="</TD></tr>";
control+="  <tr><TD style='width:35px; '>время</TD></tr>";
control+=" <tr><td align='left' style='width:140px'><input name='dc' value='' size='14' readonly style='font-weight:bolder;width:120px;'>";
control+="<a href='javascript:void(0)' onclick='if(self.gfPop) gfPop.fPopCalendar(dc);return false;' HIDEFOCUS>";
control+="<img align='absmiddle' id='imgCal' name='imgCal' src='images/calbtn_small.gif' width='14' height='22' border='0' alt='Календарь' onMouseOver='this.style.cursor=\"hand\"'>	</a> </td></tr>";

control+="  <tr><TD style='width:30px;'>ретроспектива&nbsp;</TD></tr>";
control+="  <tr><TD style='width:100px;'>";
control+="  <select name='retros' size='1' style='width:90px'>";
control+="	<option value='15' SELECTE>15 минут</option>";
control+="	<option value='30'>30 минут</option>";
control+="	<option value='60'>1 час</option>";
control+="	<option value='120'>2 часа</option>";
control+="	<option value='180'>3 часа</option>";

control+="   </select>";
control+="</TD></tr>";
control+="<tr><td><input type='submit' value='чтение' id='go' onclick='checkID()' style=\"font-size:12px;font-weight:bolder;\"></td>";
control+="  <TD STYLE ='text-align:right'>";
control+="<img id='print' src='images/print.gif' alt='печать' style='cursor:hand' width='26' height='22' border='0' align='middle' onclick='window.print();' onmouseover='ptintimg()' onmouseout ='ptintimg2()' >";
//control+="&nbsp;<img src='images/excel24.gif' id='toXLS' alt='экспорт в Excel' style='cursor:hand' width='24' height='24' border='0' align='middle' ONCLICK='excel_exp()'>";control+="  </TD>";
control+="<input type='hidden' name='iname' value='-1' size=2>";
control+="<input type='hidden' name='id' value='-1' size=2>";
control+="<input type='hidden' name='pid' value='-1' size=2'>";
control+="<input type='hidden' name='lid' value='-1' size=2'>";
control+="<input type='hidden' name='node' value='-1' size=2'>";
control+="<input type='hidden' name='nobj' value='-1' size=2'>";
control+="<input type='hidden' name='adr' value='-1' size=2'>";
control+="<input type='hidden' name='frameName' id='frameName' value='gist3'>";
control+="  </TD>";
control+="</tr></table></FIELDSET>";
control+="</form>";
control+="</div>";
//===========================================================================================================================

function ptintimg()
{
 var i = 'images/print2.gif';
 var i2 = 'images/print.gif';
 var print = document.getElementById('print');
 print.src = print.src != i ? i: i2;
}
function ptintimg2()
{
 var i = 'images/print2.gif';
 var i2 = 'images/print.gif';
 var print = document.getElementById('print');
 print.src = i2;
}
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
//	SetIP("[IP-адрес сервера с12]",[UDP-порт прив¤зки - 5150 по умолчанию]);
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
function excel_exp()
{
 try
 {
//  if ((document.all('TB').innerText)!='') 
  {
	var div = document.getElementsByTagName("div");
	OpenXLS();
	var row_count=div.length
    for (var r=1; r<49; r++) 
  	{   // последовательный перебор всех ¤чеек
			val=div[r+5].title;
			FillXls(r,1,r,row_count);
			FillXls(r,2,val,row_count);
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
document.write('<iframe width=174 height=190 name="gToday:normal::gfPop:plugins_time2.js" id="gToday:normal::gfPop:plugins_time2.js" src="datetime/ipopeng2.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; left:-500px; top:0px;"></iframe>');
if (window.document.topmenu.dc.value=='') window.document.topmenu.dc.value=curdate;
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
if(self.gfPop) gfPop.fPopCalendar(dc);
return false;
}


