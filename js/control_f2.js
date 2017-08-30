//================================================================================================
var div_height=50;
var now=new Date();
var day=now.getDate()>9?now.getDate():'0'+now.getDate();
var month=now.getMonth()>8?(now.getMonth()+1):'0'+(now.getMonth()+1);
var year=now.getYear();
var curdate=day+'.'+month+'.'+year;
control="<div class='help' id='subcontrol' style='width:140px; height:"+div_height+"; Text-align:right;z-index:+1'>"
//===========================================================================================================================
control+="<div class='handle' href=''></div> <!-- Ссылка для пользователей с отключенным JavaScript -->"
control+="<FIELDSET ID='fld3' style='width:140px;background-color:#c1cdcd;'>";
control+="<form name=\"topmenu\" method=\"get\">";
control+="<LEGEND ALIGN='right' id='legenda'>‘ормат данных</LEGEND>";

control+="<TABLE BORDER='0' cellpadding='1' width='140px' id='formatData'>";
control+="<TR>";
control+="  <TD style='width:110px;'>отображать как&nbsp;</TD></TR>";
control+=" <TR><TD style='width:95px'>";
control+="<input type='hidden' name='tab' value='"+tab+"' size=2>";
control+="   <select name='disp' size='1' style='width:90px' onchange='powerc(this.value)'>";
control+="	<option value='1' SELECTED>мощность</option>";
control+="	<option value='2'>энергию</option>";
control+="	<option value='3'>показания</option>";
control+="   </select>";
control+="</TD></TR>";
control+="  <TR><TD style='width:140px;' id='maxp_lab'>контроль мощности&nbsp;</TD></TR>";
control+="  <TR><TD style='width:55px'>";
control+="   <select name='maxp' size='1' style='width:50px'>";
control+="	<option value='0' SELECTED>нет</option>";
control+="	<option value='1'>да</option>";
control+="   </select>";
control+="</TD></TR>";
control+="<TR><TD style='width:140px;' id='maxp_lab'>единицы измерения&nbsp;</TD></TR>";
control+=" <TR><TD style='width:105px'>";
control+="   <select name='edizm' size='1' style='width:105px'>";
control+="	<option value='1' SELECTED>кВт/квар</option>";
control+="	<option value='1000'>МВт/Мвар</option>";
control+="   </select>";
control+="</TD></TR>";
control+="  <TR><TD style='width:60px;'>на день&nbsp;</TD></TR>";
control+=" <td style='width:115px'><input name='dc' value='' size='9' readonly style='font-weight:bolder'>";
control+=" <a href='javascript:void(0)' onclick='if(self.gfPop) gfPop.fPopCalendar(dc);return false;' HIDEFOCUS>";
control+="<img align='absmiddle' src='images/calbtn_small.gif' width='14' height='22' border='0' alt='Календарь' onMouseOver='this.style.cursor=\"hand\"'>	</a> </td></TR>";
control+="<td><input type='submit' value='чтение' onclick='checkID()' style=\"font-size:12px;font-weight:bolder;\"></td></tr>";
control+=" <tr><TD style='width:65px'>";
control+="<img id='print' src='images/print.gif' alt='печать' style='cursor:hand' width='26' height='22' border='0' align='middle' onclick='window.print();' onmouseover='ptintimg()' onmouseout ='ptintimg2()' >";
control+="&nbsp;&nbsp;<img src='images/excel24.gif' id='toXLS' alt='экспорт в Excel' style='cursor:hand' width='24' height='24' border='0' align='middle' ONCLICK='excel_exp();'>";
control+="<input type='hidden' name='iname' value='-1' size=2>";
control+="<input type='hidden' name='id' value='-1' size=2>";
control+="<input type='hidden' name='pid' value='-1' size=2'>";
control+="<input type='hidden' name='lid' value='-1' size=2'>";
control+="<input type='hidden' name='node' value='-1' size=2'>";
control+="<input type='hidden' name='nobj' value='-1' size=2'>";
control+="<input type='hidden' name='adr' value='-1' size=2'>";
control+="<input type='hidden' name='halfmtab' value='-1' size=2>";
control+="<input type='hidden' name='frameName' id='frameName' value='form2'>";
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
function powerc(sel)
{
 if (sel!=1) {window.document.topmenu.maxp.style.visibility='hidden';maxp_lab.innerText='';}
 else  {window.document.topmenu.maxp.style.visibility='visible';maxp_lab.innerText='контроль мощности';}
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
	  {  // последовательнный перебор всех р¤дов в каждой таблице
	    for (var c=0; c<tbls[i].rows[r].cells.length; c++) 
		{   // последовательный перебор всех ¤чеек
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
	window.document.topmenu.halfmtab.value=halfmtab;
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


