//================================================================================================
var div_height=50;
var now=new Date();
var day=now.getDate()>9?now.getDate():'0'+now.getDate();
var month=now.getMonth()>8?(now.getMonth()+1):'0'+(now.getMonth()+1);
var year=now.getYear();
var curdate=day+'.'+month+'.'+year;
control="<div class='help' id='subcontrol' style='width:160px; height:"+div_height+"; Text-align:center;z-index:+1'>"
//===========================================================================================================================
control+="<div class='handle' href=''></div> <!-- ������ ��� ������������� � ����������� JavaScript -->"
control+="<form name=\"topmenu\" method=\"get\">";
control+="<FIELDSET ID='fld3' style='width:100%;background-color:#c1cdcd;'>";
control+="<LEGEND ALIGN='left' id='legenda'>������ ������2</LEGEND>";
control+="<TABLE BORDER='0' cellpadding='1' cellpadding='1' width='99%' id='formatData'>";
control+="<TR>";
control+="  <TD style='width:110px;'>���������� ���</TD></tr>";
control+="  <tr><TD style='width:90px;>";
control+="<input type='hidden' name='tab' value='"+tab+"' size=2>";
control+="   <select name='disp' size='1' style='width:90px' onchange='optListChange(this)'>";
control+="	<option value='1' SELECTED>��������</option>";
control+="	<option value='2'>�������</option>";
control+="   </select>";
control+="</TD></tr>";
control+="  <tr><TD style='width:25px;'>���</TD></tr>";
control+="  <tr><TD style='width:150px'>";
control+="   <select name='type' size='1' style='width:150px'>";
control+="	<option value='1' SELECTED>�������� �����</option>";
control+="	<option value='2'>�������� ������</option>";
control+="	<option value='3'>���������� �����</option>";
control+="	<option value='4'>���������� ������</option>";
control+="   </select>";
control+="</TD></tr>";
control+="  <tr><TD style='width:50px;'>�� ����</TD></tr>";
control+=" <tr><td align='center' style='width:100px'><input name='dc' value='' size='9' readonly style='font-weight:bolder'>";
control+="<a href='javascript:void(0)' onclick='if(self.gfPop) gfPop.fPopCalendar(dc);return false;' HIDEFOCUS>";
control+="<img align='absmiddle' src='images/calbtn_small.gif' width='14' height='22' border='0' alt='���������' onMouseOver='this.style.cursor=\"hand\"'>	</a> </td></tr>";
control+="<tr><td><input type='submit' value='������' onclick='checkID()' style=\"font-size:12px;font-weight:bolder;\"></td>";
control+="  <TD style='text-align:right;'>";
control+="<img id='print' src='images/print.gif' alt='������' style='cursor:hand' width='26' height='22' border='0' align='middle' onclick='window.print();' onmouseover='ptintimg()' onmouseout ='ptintimg2()' >";control+="&nbsp;<img src='images/excel24.gif' id='toXLS' alt='������� � Excel' style='cursor:hand' width='24' height='24' border='0' align='middle' ONCLICK='excel_exp()'>";control+="  </TD>";
control+="<input type='hidden' name='iname' value='-1' size=2>";
control+="<input type='hidden' name='id' value='-1' size=2>";
control+="<input type='hidden' name='pid' value='-1' size=2'>";
control+="<input type='hidden' name='lid' value='-1' size=2'>";
control+="<input type='hidden' name='node' value='-1' size=2'>";
control+="<input type='hidden' name='nobj' value='-1' size=2'>";
control+="<input type='hidden' name='adr' value='-1' size=2'>";
control+="<input type='hidden' name='frameName' id='frameName' value='gist2'>";
control+="  </TD>";
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
//  if ((document.all('TB').innerText)!='') 
  {
	var div = document.getElementsByTagName("div");
	OpenXls();
	var row_count=div.length
    for (var r=1; r<49; r++) 
  	{   // ���������������� ������� ���� �����
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
  alert("������: "+e.name);return 0;
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
document.write('<iframe width=174 height=190 name="gToday:normal" id="gToday:normal" src="datepicker/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; left:-500px; top:0px;"></iframe>');
if (window.document.topmenu.dc.value=='') window.document.topmenu.dc.value=curdate;
if ((window.parent.toc.ntype.value!=0)&&(window.parent.toc.ntype.value!=1))
//legenda.innerHTML=window.parent.toc.item_name.value+' <span style="color:black;font-size:10px;">(�������� �������)</span>';
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


