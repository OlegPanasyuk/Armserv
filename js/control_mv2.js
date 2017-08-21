//================================================================================================
var div_height=50;
var step_query=new Array(5);
control="<div class='help' id='subcontrol' style='width:100%; height:"+div_height+"; Text-align:center;z-index:+1'>"
//===========================================================================================================================
control+="<form name=\"topmenu\" method=\"get\">";
control+="<FIELDSET ID='fld3' style='width:99%;background-color:#CDDBEB;'>";
control+="<LEGEND ALIGN='left' id='legenda'>Запрос мгновенных значений</LEGEND>";
control+="<TABLE BORDER='0' cellpadding='1' cellpadding='1' width='99%' id='formatData'>";
control+="<TR>";
control+="<td width='100' align=center>&nbsp;<img src='images/binaries.gif' height=20 width=80 style='display:none'>";
control+="<input type='button' id='getM' value='запросить' onclick='getMoment();' style=\"font-size:12px;font-weight:bolder;text-align:center;width:80px;\"> </td>";
control+="<td width='100' align=center><input type='submit' onclick='checkID()' id='refresh'  value='обновить'  style=\"font-size:12px;font-weight:bolder;text-align:center;width:80px;\"></td>";
control+="  <TD>";
control+="<img src='images/print.gif' alt='печать' style='cursor:hand' width='16' height='14' border='0' align='middle' onclick='print()'>";
control+="&nbsp;&nbsp;<img src='images/excel24.gif' id='toXLS' alt='экспорт в Excel' style='cursor:hand' width='24' height='24' border='0' align='middle' ONCLICK='excel_exp();'>";
control+="<input type='hidden' name='tab' value='0' size=2>";
control+="<input type='hidden' name='iname' value='-1' size=2>";
control+="<input type='hidden' name='id' value='-1' size=2>";
control+="<input type='hidden' name='pid' value='-1' size=2'>";
control+="<input type='hidden' name='lid' value='-1' size=2'>";
control+="<input type='hidden' name='node' value='-1' size=2'>";
control+="<input type='hidden' name='nobj' value='-1' size=2'>";
control+="<input type='hidden' name='adr' value='-1' size=2'>";
control+="<input type='hidden' name='zn' value='00000000' size=2'>";
control+="<input type='hidden' name='frameName' id='frameName' value='momentval'>";
control+="</TD>";
control+="</tr></table></FIELDSET>";
control+="</form>";
//===========================================================================================================================
control+="</div>";
function excel_exp()
{
 try
 {
  if ((document.all('TB').innerText)!='') 
  ToXls('TB',0,0,0,0,0,window.document.topmenu.znum.value,0)
 }
 catch(e)
 {
  return 0;
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

function process(state1,state2,d1,d2)
{
 document.topmenu.getM.style.display=state1;
 document.images[0].style.display=state2;
 document.topmenu.refresh.disabled=d1;
 document.topmenu.getM.disabled=d2;
}


function traceMoment(attempt)
{
var max_try=Timeout;
Prec=3;
window.defaultStatus='Готово';
attempt+=Frequency/1000;
if (attempt>max_try)
 {
  setTimeout('window.status="Таймаут приема мгновенных значений."',1000);
  if (ax_Close()!=0) {process('inline','none',true,false); return false;}
  alert("Таймаут приема мгновенных значений.");
  process('inline','none',true,false);setTimeout('window.status=window.defaultStatus;',5000);
//  process('inline','none',false,true);
  return 0;
 }
else
 {
	S = ax_GetResult();
	if (S!=1)
	{
		window.status=S+' || прошло '+String(Number(attempt).toFixed(Prec))+' сек. из '+Timeout;
		if (S==-1) {process('inline','none',true,false); alert(ax_GetErrorString());ax_Close();return 0;}		
		myTimeout=setTimeout('traceMoment('+attempt+')',Frequency)
	}
		if (S==1)		
		{
		 setTimeout('window.status=window.defaultStatus;',5000);process('inline','none',false,true);
		 var param=new Array("on_date_time","F","P","Pa","Pb","Pc","Q","Qa","Qb","Qc","Ua","Ub","Uc","Ia","Ib","Ic","KPa","KPb","KPc","Ke","KU","KI","meter_type","meter_adr","znum","date_issue","meter_time","meter_quadrant","meter_tarif","meter_season","meter_resource","vers_program")
         result=(ax_GetStrResult()).split(";");
		 
		 for (i=0;i<param.length;i++)
		 {
		  if (i>0 && i<19) document.getElementById(param[i]).innerText=Number(result[i+2]).toFixed(Prec);
		  else  document.getElementById(param[i]).innerText=result[i+2];
		  if (param[i]=='vers_program') document.getElementById(param[i]).innerText+='.';
		 }
		 
		 if (ax_Close()!=0) {process('inline','none',false,true); return false;}
		 VRClk41(result[18],result[19],result[20])
		  return 1;
		}

  }		
}

function getMoment()
{
	checkID();
	Object=window.document.topmenu.nobj.value;//объект
	Counter=window.document.topmenu.adr.value;//адрес
	ax_SetTimeout(Timeout);
	if (ax_SetUDPParam(IP,Port)!=0) {return false;}
	if (ax_Open(2)!=0) { return false;}
	ax_GetMoment_7_1(Object, Counter);
	fhead.location.href='head_maker.php?nobj='+Object+'&adr='+(Counter)+'&node=0';
	if (ax_GetResult()!=1) {process('none','inline',true,false); traceMoment(0);if (mval) mval.style.display="inline"; else {alert("Во время запроса произошла ошибка.\n  Попробуйте перезагрузить приложение.");return 0;}}
}

ctrl_width=0;
ctrl_height=5;
ie4=document.all;
window.status=window.defaultStatus;
document.write('<div id="control" style="position:absolute;top:'+ctrl_height+';right:'+ctrl_width+';z-index:+1">'+control+'</div>')
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




