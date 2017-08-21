//================================================================================================
var div_height=50;
control="<div class='help' id='subcontrol' style='width:100%; height:"+div_height+"; Text-align:center;z-index:+1'>"
//===========================================================================================================================
control+="<form name=\"topmenu\" method=\"get\">";
control+="<FIELDSET ID='fld3' style='width:99%;background-color:#c1cdcd;'>";
control+="<LEGEND ALIGN='left' id='legenda'>Запрос архивов событий </LEGEND>";
control+="<TABLE BORDER='0' cellpadding='1' cellpadding='1' width='99%' id='formatData'>";
control+="<TR>";
control+="  <TD style='width:80px'>запрашивать: </TD>";
control+="<TD style='width:20px'>";
control+="<input type='hidden' name='tab' value='"+tab+"' size=2>";
control+="<input type='radio' name='arh' id='arh1' value='1' onclick=\"javascript:ArhType.value=this.value;getA.disabled=false;\"></TD><TD style='width:80px'><label for='arh1'>архив фаз</label></TD>";
control+="<TD style='width:20px'><input type='radio' name='arh' id='arh2' value='2' onclick=\"javascript:ArhType.value=this.value;getA.disabled=false;\"></TD><TD style='width:110px'><label for='arh2'>архив состояний</label></TD>";
control+="<TD style='width:20px'><input type='radio' name='arh' id='arh3' value='3' onclick=\"javascript:ArhType.value=this.value;getA.disabled=false;\"></TD><TD style='width:140px'><label for='arh3'>архив корректировок</label></TD>";
control+="<td align=left>&nbsp;<img src='images/binaries.gif' height=20 width=80 style='display:none'>";
control+="<input type='button' id='getA' value='запросить' onclick='getArchive()' style=\"font-size:12px;font-weight:bolder;text-align:center;width:80px;\" disabled>";
control+="<input type='submit' id='refresh' value='обновить' onclick='checkID();' style=\"font-size:12px;font-weight:bolder;text-align:center;width:80px;\"></td>";
control+="  <TD style='text-align:right'>";
control+="<img id='print' src='images/print.gif' alt='печать' style='cursor:hand' width='26' height='22' border='0' align='middle' onclick='window.print();' onmouseover='ptintimg()' onmouseout ='ptintimg2()' >";
control+="&nbsp;&nbsp;<img src='images/excel24.gif' id='toXLS' alt='экспорт в Excel' style='cursor:hand' width='24' height='24' border='0' align='middle' ONCLICK='excel_exp();'>";
control+="<input type='hidden' name='iname' value='-1' size=2>";
control+="<input type='hidden' name='id' value='-1' size=2>";
control+="<input type='hidden' name='pid' value='-1' size=2'>";
control+="<input type='hidden' name='lid' value='-1' size=2'>";
control+="<input type='hidden' name='node' value='-1' size=2'>";
control+="<input type='hidden' name='nobj' value='-1' size=2'>";
control+="<input type='hidden' name='adr' value='-1' size=2'>";
control+="<input type='hidden' name='ArhType' value='-1' size=2'>";
control+="<input type='hidden' name='zn' value='00000000' size=2'>";
control+="<input type='hidden' name='frameName' id='frameName' value='meterarh'>";
control+="</TD>";

control+="</tr></table></FIELDSET>";
control+="</form>";
//===========================================================================================================================
control+="</div>";
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

function process(state1,state2,d1,d2)
{
 document.topmenu.getA.style.display=state1;
 document.images[0].style.display=state2;
 document.topmenu.refresh.disabled=d1;
 document.topmenu.getA.disabled=d2;
}

function traceMoment(attempt)
{
var max_try=Timeout;
window.defaultStatus='Готово';
attempt+=Frequency/1000;
if (attempt>max_try)
 {
  setTimeout('window.status="Таймаут приема мгновенных значений."',1000);
  if (ax_Close()!=0) {process('inline','none',true,false); return false;}
  alert("Таймаут приема мгновенных значений.");
  process('inline','none',true,false);setTimeout('window.status=window.defaultStatus;',5000);
  return 0;
 }
else
 {
	S = ax_GetResult();
	if (S!=1)
	{
		window.status=S+' || прошло '+String(Number(attempt).toFixed(3))+' сек. из '+Timeout;
		if (S==-1) {process('inline','none',true,false); alert(ax_GetErrorString());ax_Close();return 0;}		
		myTimeout=setTimeout('traceMoment('+attempt+')',Frequency)
	}
		if (S==1)		
		{
		 setTimeout('window.status=window.defaultStatus;',5000);process('inline','none',false,true);
         result=(ax_GetStrResult()).split(";");
		 ArhType=window.document.topmenu.ArhType.value;
		 for (i=0;i<result.length-1;i++)
		 {
		  addStr(document.all.TB2,i+1,result[i].substring(0,17),result[i].substring(18,result[i].length),ArhType)
		 }
		 
		 if (ax_Close()!=0) {process('inline','none',false,true); return false;}
		  return 1;
		}

  }		
}

function addStr(table,cell_1,cell_2,cell_3,ArhType)
{

 var newRow = table.insertRow(-1); 
 newRow.style.backgroundColor='InfoBackground';
 if (ArhType==1)
 {
	var newCell = newRow.insertCell(0);newCell.innerHTML = cell_1;
	newCell.className='x22';newCell.style.textAlign='center';
	newCell = newRow.insertCell(1); newCell.innerHTML =  cell_2;
	newCell.className='x22';newCell.style.textAlign='center';
	newCell = newRow.insertCell(2); newCell.innerHTML =  cell_3.length>0?cell_3:'&nbsp;';
	newCell.className='x22';newCell.style.textAlign='left';
	state=cell_3.substring(cell_3.indexOf("(" )+1,cell_3.indexOf(")")).split("/");
	newCell = newRow.insertCell(3);newCell.className='x22';newCell.style.textAlign='left';newCell.style.width='60px';
	document.all.faza.style.display='inline';
	for (j=0;j<state.length;j++)
	{
	 if (state[j]=='Вкл '){newCell.innerHTML+="&nbsp;<span class='fazaA'></span>&nbsp;"}
	 else if (state[j]=='Выкл') {newCell.innerHTML+="&nbsp;<span class='fazaB'></span>&nbsp;"}
	}

 }
else if (ArhType>1)
 {
	var newCell = newRow.insertCell(0);newCell.innerHTML = cell_1;
	newCell.className='x22';newCell.style.textAlign='center';
	newCell = newRow.insertCell(1); newCell.innerHTML =  cell_2;
	newCell.className='x22';newCell.style.textAlign='center';
	newCell = newRow.insertCell(2); newCell.innerHTML =  cell_3.length>0?cell_3:'&nbsp;';
	newCell.className='x22';newCell.style.textAlign='left';
	document.all.faza.style.display='none';
 }
}

function getArchive()
{
	checkID();
	Object=window.document.topmenu.nobj.value;//объект
	Counter=window.document.topmenu.adr.value;//адрес
	ArhType=window.document.topmenu.ArhType.value;
	if (ArhType)
	{
    for (i=(TB2.rows.length);i>3;i--)
	{
	 TB2.deleteRow();
	} 
	
	 ax_SetTimeout(Timeout);
	 if (ax_SetUDPParam(IP,Port)!=0) {return false;}
	 if (ax_Open(2)!=0) { return false;}
	 ax_GetArhCounter_7_2(Object, Counter,ArhType);
 	 fhead.location.href='head_maker.php?nobj='+Object+'&adr='+(Counter)+'&node=0&arh='+ArhType;
	 if (ax_GetResult()!=1) {process('none','inline',true,false); traceMoment(0);TB2.style.display="inline";}
	}
}

function excel_exp()
{
 try
 {
  if ((document.all('TB').innerText)!='') 
  ToXls('TB',6,window.document.topmenu.ArhType.value,0,0,0,window.document.topmenu.znum.value,0)
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
ctrl_width=0;
ctrl_height=5;
ie4=document.all;
document.write('<div id="control" style="position:absolute;top:'+ctrl_height+';right:'+ctrl_width+';z-index:+1">'+control+'</div>')
if (window.parent.toc.ntype.value!=0)
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




