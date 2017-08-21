//================================================================================================
var R=2268;var topMargin=2*R;var leftMargin=2*R;
var sinA;
var sinB;
var sinC;
var cosA;
var cosB;
var cosC;
var max;

function VRClk41() {
 
 
 pA.value=document.getElementById('Ua').innerHTML;
 pB.value=document.getElementById('Ub').innerHTML;
 pC.value=document.getElementById('Uc').innerHTML;
 lA.value=document.getElementById('Ia').innerHTML;
 lB.value=document.getElementById('Ib').innerHTML;
 lC.value=document.getElementById('Ic').innerHTML;
 tA.value=document.getElementById('KPa').innerHTML;
 tB.value=document.getElementById('KPb').innerHTML;
 tC.value=document.getElementById('KPc').innerHTML;
 /*document.getElementById('g30').style.top =3954 - R/2;
 document.getElementById('g30').style.left = 4761 + Math.sin(Math.PI/180*60)*R;
 document.getElementById('g60').style.top =3954 - Math.sin(Math.PI/180*60)*R;
 document.getElementById('g60').style.left = 4761 + R/2;
 document.getElementById('g90').style.top =3954 - R;
 document.getElementById('g90').style.left = 4761 ;
 document.getElementById('g150').style.top =3954 - R/2;
 document.getElementById('g150').style.left = 4761 - Math.sin(Math.PI/180*60)*R;
 document.getElementById('g120').style.top =3954 - Math.sin(Math.PI/180*60)*R;
 document.getElementById('g120').style.left = 4761 - R/2;
 document.getElementById('g180').style.top =3954;
 document.getElementById('g180').style.left = 4761 - R ;
 document.getElementById('g210').style.top =3954 + R/2;
 document.getElementById('g210').style.left = 4761 - Math.sin(Math.PI/180*60)*R;
 document.getElementById('g240').style.top =3954 + Math.sin(Math.PI/180*60)*R;
 document.getElementById('g240').style.left = 4761 - R/2;
 document.getElementById('g270').style.top =3954 + R;
 document.getElementById('g270').style.left = 4761  ;
 document.getElementById('g330').style.top =3954 + R/2;
 document.getElementById('g330').style.left = 4761 + Math.sin(Math.PI/180*60)*R;
 document.getElementById('g300').style.top =3954 + Math.sin(Math.PI/180*60)*R;
 document.getElementById('g300').style.left = 4761 + R/2;
 document.getElementById('g360').style.top =3954 ;
 document.getElementById('g360').style.left = 4761  + R;*/
 max = Math.max(pA.value,pB.value,pC.value);
 maxI =  Math.max(lA.value,lB.value,lC.value);
 fA.value=R*pA.value/max;
 fB.value=R*pB.value/max;
 fC.value=R*pC.value/max;
sinA=0;
sinB=0;
sinC=0;
cosA=1;
cosB=1;
cosC=1;
/*
xA=leftMargin+R*cosA;yA=topMargin-R*sinA; 
xB=leftMargin+R*cosB;yB=topMargin-R*sinB; 
xC=leftMargin+R*cosC;yC=topMargin-R*sinC; 
*/
xA=4761+R*pA.value/max;yA=3954; 
xB=4761-(R*pB.value/max)/2;yB=3954 + Math.sin(Math.PI/180*60)*(R*pB.value/max); 
xC=4761-(R*pC.value/max)/2;yC=3954 - Math.sin(Math.PI/180*60)*(R*pC.value/max); 
xiA=4761+(R*lA.value/maxI)*tA.value;yiA=3954+Math.sqrt(1-tA.value*tA.value)*(R*lA.value/maxI);
xiB=4761-R*(0.5*tB.value+ Math.cos(Math.PI/180*30) * Math.sqrt(1-tB.value*tB.value))*lB.value/maxI;yiB=3954+R*(Math.cos(Math.PI/180*30)*tB.value-0.5*Math.sqrt(1-tB.value*tB.value))*lB.value/maxI;
xiC=4761-R*(0.5*tC.value- Math.cos(Math.PI/180*30) * Math.sqrt(1-tC.value*tC.value))*lC.value/maxI;yiC=3954-R*(Math.cos(Math.PI/180*30)*tB.value+0.5*Math.sqrt(1-tC.value*tB.value))*lB.value/maxI;

//A.from=(xA-10)+","+(yA-10);
//B.from=(xB-10)+","+(yB-10);
//C.from=(xC-10)+","+(yC-10);
A.to=(xA-10)+","+(yA-10);
B.to=(xB-10)+","+(yB-10);
C.to=(xC-10)+","+(yC-10);
iA.to=(xiA-10)+","+(yiA-10);
iB.to=(xiB-10)+","+(yiB-10);
iC.to=(xiC-10)+","+(yiC-10);
fill();
}

function fill()
{
// fA.value=A.from;
// fB.value=B.from;
//fC.value=C.from;
// tA.value=A.to;
// tB.value=B.to;
 //tC.value=C.to;
//a1=(fA.value).split(",");a2=(tA.value).split(",");
//b1=(fB.value).split(",");b2=(tB.value).split(",");
//c1=(fC.value).split(",");c2=(tC.value).split(",");

// lA.value=Math.sqrt(Math.pow(a2[0]-a1[0],2)+Math.pow(a2[1]-a1[1],2)).toFixed(0);
// lB.value=Math.sqrt(Math.pow(b2[0]-b1[0],2)+Math.pow(b2[1]-b1[1],2)).toFixed(0);
// lC.value=Math.sqrt(Math.pow(c2[0]-c1[0],2)+Math.pow(c2[1]-c1[1],2)).toFixed(0);
 
}
var div_height=50;
var step_query=new Array(5);
control="<div class='help' id='subcontrol' style='width:250px; height:"+div_height+"; Text-align:left;z-index:+1'>"
//===========================================================================================================================
control+="<div class='handle' href=''></div> <!-- Ссылка для пользователей с отключенным JavaScript -->"
control+="<form name=\"topmenu\" method=\"get\">";
control+="<FIELDSET ID='fld3' style='width:250px;background-color:#C1CDCD;'>";
control+="<LEGEND ALIGN='left' id='legenda'>Запрос мгновенных значений</LEGEND>";
control+="<TABLE BORDER='0' cellpadding='1' cellpadding='1' width='250px' id='formatData'>";
control+="<TR>";
control+="<td width='100' align=center>&nbsp;<img src='images/binaries.gif' height=20 width=80 style='display:none'>";
control+="<input type='button' id='getM' value='запросить' onclick='getMoment();' style=\"font-size:12px;font-weight:bolder;text-align:center;width:80px;\"> </td>";
control+="<td width='100' align=center><input type='submit' onclick='checkID()' id='refresh'  value='обновить'  style=\"font-size:12px;font-weight:bolder;text-align:center;width:80px;\"></td>";
control+="  <TD>";
control+="<img id='print' src='images/print.gif' alt='печать' style='cursor:hand' width='26' height='22' border='0' align='middle' onclick='window.print()' onmouseover='ptintimg()' onmouseout ='ptintimg2()' >";
control+="&nbsp;&nbsp;<img src='images/Excelicon.png' id='toXLS' alt='экспорт в Excel' style='cursor:hand' width='24' height='24' border='0' align='middle' ONCLICK='excel_exp();'>";
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
		if (parseFloat(result[13])!=0 || parseFloat(result[14])!=0)
		  document.getElementById('Usum1').innerHTML=((parseFloat(result[12])+parseFloat(result[13])+parseFloat(result[14]))/3).toFixed(Prec);
		 else
		  document.getElementById('Usum1').innerHTML = Math.max(parseFloat(result[12]),parseFloat(result[13]),parseFloat(result[14])).toFixed(Prec);
		  
		  document.getElementById('Isum').innerHTML = Number(parseFloat(result[15])+parseFloat(result[16])+parseFloat(result[16])).toFixed(Prec);
		  VRClk41();
		 if (ax_Close()!=0) {process('inline','none',false,true); return false;}
		 
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
	if (ax_GetResult()!=1) {process('none','inline',true,false); traceMoment(0);if (mval) mval.style.display="inline"; else {alert("Во время запроса произошла ошибка.\n  Попробуйте перезагрузить приложение.");return 0;}
	}
	
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




