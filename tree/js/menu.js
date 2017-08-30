var isie=0;
if(window.navigator.appName=="Microsoft Internet Explorer"&&window.navigator.appVersion.substring(window.navigator.appVersion.indexOf("MSIE")+5,window.navigator.appVersion.indexOf("MSIE")+8)>=5.5) 
{
 isie=1;
}
else 
{
 isie=0;
}
if(isie) 
{
 var oPopup = window.createPopup();
}

function go_to(toDO,icon,node)
{
if (toDO=='insert')
{
 if (node<2)
 {
  if (ntype.value<=0) {alert('Объект является точкой учета. Добавление элемента невозможно !'); return;}
  if (ntype.value==1) {alert('Объект суммирующей является точкой учета. Добавление элемента невозможно !');return;}
 }
} 
if (toDO=='update') node=ntype.value;
url="../sql.php?id="+item_id.value+"&pid="+par_id.value+"&level="+level.value+"&name="+item_name.value+"&todo="+toDO+"&icon="+icon+"&node="+node;
if (toDO == 'sett') url = "../settings2.php";
window.parent.frSheet.src=url;
window.parent.frames[2].location.href=url;
window.parent.frames[2].focus;
}

function dopopup(x,y) 
{
 if(isie) 
 {
 var html="";
 html+='<TABLE id="popup2" name="222" STYLE="border:1pt solid #808080" BGCOLOR="#CCCCCC" WIDTH="140" HEIGHT="300" CELLPADDING="0" CELLSPACING="1">';
 html+='<STYLE TYPE="text/css">\n';
 html+='a:link {text-decoration:none;font-family:Arial;font-size:8pt;}\n';
 html+='a:visited {text-decoration:none;font-family:Arial;font-size:8pt;}\n';
 html+='td {font-size:8pt;}\n';
 html+='</STYLE>\n';
 html+='<TR><TD STYLE="border:1pt solid #CCCCCC;text-align:center;" id="obj_name"><b>'+item_name.value+'</b></TD></TR>';
 html+='<TR><TD STYLE="border:1pt solid #CCCCCC;"><IMG SRC="../images/pixel.gif" WIDTH="130" HEIGHT="1"></TD></TR>';
 html+='<TR><TD STYLE="border:1pt solid #CCCCCC;cursor:hand;" ID="i7" ONMOUSEOVER="document.all.i7.style.background=\'#CFD6E8\';document.all.i7.style.border=\'1pt solid #737B92\';" ONMOUSEOUT="document.all.i7.style.background=\'#CCCCCC\';document.all.i7.style.border=\'1pt solid #CCCCCC\';" ONCLICK="window.parent.go_to(\'insert\',\'folder2\',2)"><img src="img/tree3.gif" alt="" width="24" height="24" border="0">Добавить папку</TD></TR>';
 html+='<TR><TD STYLE="border:1pt solid #CCCCCC;cursor:hand;" ID="i8" ONMOUSEOVER="document.all.i8.style.background=\'#CFD6E8\';document.all.i8.style.border=\'1pt solid #737B92\';" ONMOUSEOUT="document.all.i8.style.background=\'#CCCCCC\';document.all.i8.style.border=\'1pt solid #CCCCCC\';" ONCLICK="window.parent.go_to(\'insert\',\'counter\',0)"><img src="img/treenode_add.gif" alt="" width="24" height="24" border="0">Добавить узел</TD></TR>';
 html+='<TR><TD STYLE="border:1pt solid #CCCCCC;"><IMG SRC="../images/pixel.gif" WIDTH="130" HEIGHT="1"></TD></TR>';
 html+='<TR><TD STYLE="border:1pt solid #CCCCCC;cursor:hand;" ID="i9" ONMOUSEOVER="document.all.i9.style.background=\'#CFD6E8\';document.all.i9.style.border=\'1pt solid #737B92\';" ONMOUSEOUT="document.all.i9.style.background=\'#CCCCCC\';document.all.i9.style.border=\'1pt solid #CCCCCC\';" ONCLICK="window.parent.go_to(\'delete\',\'\',-1)"><img src="img/treenode_delete.gif" alt="" width="24" height="24" border="0">Удалить</TD></TR>';
 html+='<TR><TD STYLE="border:1pt solid #CCCCCC;cursor:hand;" ID="i10" ONMOUSEOVER="document.all.i10.style.background=\'#CFD6E8\';document.all.i10.style.border=\'1pt solid #737B92\';" ONMOUSEOUT="document.all.i10.style.background=\'#CCCCCC\';document.all.i10.style.border=\'1pt solid #CCCCCC\';" ONCLICK="window.parent.go_to(\'update\',\'\',-1)"><img src="img/treenode_edit.gif" alt="" width="24" height="24" border="0">Редактировать</TD></TR>';
 html+='<TR><TD STYLE="border:1pt solid #CCCCCC;"><IMG SRC="../images/pixel.gif" WIDTH="130" HEIGHT="1"></TD></TR>';
 html+='<TR><TD STYLE="border:1pt solid #CCCCCC;cursor:hand;" ID="i11" ONMOUSEOVER="document.all.i11.style.background=\'#CFD6E8\';document.all.i11.style.border=\'1pt solid #737B92\';" ONMOUSEOUT="document.all.i11.style.background=\'#CCCCCC\';document.all.i11.style.border=\'1pt solid #CCCCCC\';" ONCLICK="window.parent.go_to(\'info\',\'\',0)"><img src="img/about.gif" alt="" width="24" height="24" border="0">Справка</TD></TR>';
 html+='<TR><TD STYLE="border:1pt solid #CCCCCC;"><IMG SRC="../images/pixel.gif" WIDTH="130" HEIGHT="1"></TD></TR>';
 html+='<TR><TD STYLE="border:1pt solid #CCCCCC;cursor:hand;" ID="i12" ONMOUSEOVER="document.all.i12.style.background=\'#CFD6E8\';document.all.i11.style.border=\'1pt solid #737B92\';" ONMOUSEOUT="document.all.i11.style.background=\'#CCCCCC\';document.all.i11.style.border=\'1pt solid #CCCCCC\';" ONCLICK="window.parent.go_to(\'sett\',\'\',0)"><img src="img/about.gif" alt="" width="24" height="24" border="0">Настройки</TD></TR>';
 html+='</TABLE>';
	var oPopupBody = oPopup.document.body;
	oPopupBody.innerHTML = html;
	oPopup.show(x, y, 140, 300, document.body);
 }
 return false;
}

function click() 
{
  if(document.all) 
  {
	if(event.button==2||event.button==3) 
	{
	 dopopup(event.x-1,event.y-1);
	}
  }
return false;
}
function click2() 
{
 event.cancelBubble = true;
 event.returnValue = false;
}
if(isie) 
{
  //document.oncontextmenu = click;
  document.oncontextmenu = function() {dopopup(event.x,event.y);return false;}
}

//================================================================================================

