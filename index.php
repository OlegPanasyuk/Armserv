<html xmlns="http://www.w3.org/TR/REC-html40">

<head>
<meta http-equiv=Content-Type content="text/html; charset=windows-1251">
<title>��� ����������</title>
<?php
 $filename="include/tabs.ini";
 $filename2="include/links.ini";
 $scriptCode="";
 $linkCode="";
 $options = parse_ini_file($filename) or die("Невозможно прочитать файл tabs.ini!");
 $options2 = parse_ini_file($filename2) or die("Невозможно прочитать файл links.ini!");

 $c_mTabs = $options['c_mTabs'];
 $c_lTabs = $options['c_lTabs'];
 $c_strTabs = $options['c_strTabs'];
 $c_lTabs_energy = $options['c_lTabs_energy'];
 $c_strTabs_energy = $options['c_strTabs_energy'];
 $c_lTabs_water = $options['c_lTabs_water'];
 $c_strTabs_water = $options['c_strTabs_water'];
 $c_lTabs_heat = $options['c_lTabs_heat'];
 $c_strTabs_heat = $options['c_strTabs_heat'];
 $c_lTabs_folder = $options['c_lTabs_folder'];
 $c_strTabs_folder = $options['c_strTabs_folder'];
 $c_lTabs_sett = $options['c_lTabs_sett'];
 $c_strTabs_sett = $options['c_strTabs_sett'];

 $activeTabs=explode(",",$c_strTabs);
 $activeTabs_energy=explode(",",$c_strTabs_energy);
 $activeTabs_water=explode(",",$c_strTabs_water);
 $activeTabs_heat=explode(",",$c_strTabs_heat);
 $activeTabs_folder=explode(",",$c_strTabs_folder);
 $activeTabs_sett=explode(",",$c_strTabs_sett);
 $activeTabs_heat=explode(",",$c_strTabs_heat);

 for ($i=0;$i<$c_mTabs;$i++)
 {
	$c_rgszSh[$i] = $options['c_rgszSh_'.$i];
 }

 for ($i=0;$i<$c_mTabs;$i++)
 {
	$c_link[$i] = $options2['c_link_'.$i];
 }
// Обычное отображение закладок
  $scriptCode.="
   var c_lTabs=".$c_lTabs.";
   var c_rgszSh=new Array(c_lTabs);\n";
 for ($i=0;$i<$c_lTabs;$i++)
 {
	$scriptCode.= "c_rgszSh[".$i."]=\"".$c_rgszSh[$activeTabs[$i]]."\";\n";
	$linkCode.="<link id='shLink' href='".$c_link[$activeTabs[$i]].".php?tab=".$i."'>\n";
 }

// Отображение для электроэенергии
 $scriptCode.="
   var c_lTabs_energy=".$c_lTabs_energy.";
   var c_rgszSh_energy=new Array(c_lTabs_energy);\n";
 for ($i=0;$i<$c_lTabs_energy;$i++)
 {
  $scriptCode.= "c_rgszSh_energy[".$i."]=\"".$c_rgszSh[$activeTabs_energy[$i]]."\";\n";
  $linkCode.="<link id='shLink_energy' href='".$_SERVER['REQUEST_URI']."".$c_link[$activeTabs_energy[$i]].".php?tab=".$i."'>\n";
 }

// Отображение для воды
 $scriptCode.="
   var c_lTabs_water=".$c_lTabs_water.";
   var c_rgszSh_water=new Array(c_lTabs_water);\n";
 for ($i=0;$i<$c_lTabs_water;$i++)
 {
  $scriptCode.= "c_rgszSh_water[".$i."]=\"".$c_rgszSh[$activeTabs_water[$i]]."\";\n";
  $linkCode.="<link id='shLink_water' href='".$_SERVER['REQUEST_URI']."".$c_link[$activeTabs_water[$i]].".php?tab=".$i."'>\n";
 }
 //Отображение для папок
 $scriptCode.="
   var c_lTabs_folder=".$c_lTabs_folder.";
   var c_rgszSh_folder=new Array(c_lTabs_folder);\n";
 for ($i=0;$i<$c_lTabs_folder;$i++)
 {
  $scriptCode.= "c_rgszSh_folder[".$i."]=\"".$c_rgszSh[$activeTabs_folder[$i]]."\";\n";
  $linkCode.="<link id='shLink_folder' href='".$_SERVER['REQUEST_URI']."".$c_link[$activeTabs_folder[$i]].".php?tab=".$i."'>\n";
 }

//Отображение для настроек
 $scriptCode.="
   var c_lTabs_sett=".$c_lTabs_sett.";
   var c_rgszSh_sett=new Array(c_lTabs_sett);\n";
 for ($i=0;$i<$c_lTabs_sett;$i++)
 {
  $scriptCode.= "c_rgszSh_sett[".$i."]=\"".$c_rgszSh[$activeTabs_sett[$i]]."\";\n";
  $linkCode.="<link id='shLink_sett' href='".$_SERVER['REQUEST_URI']."".$c_link[$activeTabs_sett[$i]].".php?tab=".$i."'>\n";
 }

//Отображение для тепла
 $scriptCode.="
   var c_lTabs_heat=".$c_lTabs_heat.";
   var c_rgszSh_heat=new Array(c_lTabs_heat);\n";
 for ($i=0;$i<$c_lTabs_heat;$i++)
 {
  $scriptCode.= "c_rgszSh_heat[".$i."]=\"".$c_rgszSh[$activeTabs_heat[$i]]."\";\n";
  $linkCode.="<link id='shLink_heat' href='".$_SERVER['REQUEST_URI']."".$c_link[$activeTabs_heat[$i]].".php?tab=".$i."'>\n";
 }

 echo $linkCode;
?>
<link id="shLink">
<script language="JavaScript">
function expand()
{window.resizeTo(screen.availWidth, screen.availHeight);
window.moveTo(0,0);}
</script>

<script language="JavaScript">
<!--
<?php
  echo $scriptCode;
?>
 var c_rgszClr=new Array(8);
 c_rgszClr[0]="window";
 c_rgszClr[1]="buttonface";
 c_rgszClr[2]="windowframe";
 c_rgszClr[3]="windowtext";
 c_rgszClr[4]="threedlightshadow";
 c_rgszClr[5]="threedhighlight";
 c_rgszClr[6]="threeddarkshadow";
 c_rgszClr[7]="threedshadow";

 var g_iShCur;
 var g_rglTabX=new Array(c_lTabs);
 var typeOfTabs = 0; // тип 0 - для стэнда 1 - для электроэнергии 2- для воды - 3 для папок

function fnGetIEVer()
{
	var ua=window.navigator.userAgent
	var msie=ua.indexOf("MSIE")
	if (msie>0 && window.navigator.platform=="Win32")
		return parseInt(ua.substring(msie+5,ua.indexOf(".", msie)));
	else
		return 0;
}

function fnBuildFrameset()
{
<!-- frames -->

 var szHTML="<frameset  rows=\"30,*,18\" border=\"0\" FRAMESPACING=2 TOPMARGIN=0 LEFTMARGIN=0 MARGINHEIGHT=0 MARGINWIDTH=0 BORDERCOLOR=\"#C1cdcd\">"+
   "<frame name=\"header\" src=\"header.php\" scrolling=no border=0 frameborder=\"no\" noresize TOPMARGIN=0 LEFTMARGIN=0 MARGINHEIGHT=0 MARGINWIDTH=0 BORDERCOLOR=\"#c1cdcd\">"+
    "<frameset  cols=\"380,*\">"+
        "<frame name=\"toc\" src=\"tree/tree.php\" border=0 TOPMARGIN=4 LEFTMARGIN=4 MARGINHEIGHT=4 MARGINWIDTH=4 BORDERCOLOR=\"#c1cdcd\" >"+
        "<frame name=\"frSheet\" src=\"\"BORDERCOLOR=\"#c1cdcd\" border=0 frameborder=\"no\">"+
    "</frameset>"+
    "<frameset  cols=\"54,*\">"+
        "<frame name=\"frScroll\" src=\"\"  border=\"5\" marginwidth=0 marginheight=0 scrolling=no noresize frameborder=\"no\">"+
        "<frame name=\"frTabs\" src=\"\" marginwidth=0 marginheight=0 scrolling=no noresize frameborder=\"no\">"+
    "</frameset>"+
"</frameset>"+
"<plaintext>";
 with (document) {
  open("text/html","replace");
  write(szHTML);
  close();
 }

 fnBuildTabStrip("" , 0);
}

function testFn(node,obj,addr,lvl) {
   if ((node == -1) ||  (node == 0) || (node == 1)){
       c_lTabs = c_lTabs_energy;
       c_rgszSh = c_rgszSh_energy.slice(0);
       if (typeOfTabs !== 1) {
         fnBuildTabStrip("_energy" , 1);
       }
   }
   if ((node == 2) || (node == 3)) {
     if ((node == 2) && (obj == -1)) {
       c_lTabs = c_lTabs_folder;
       c_rgszSh = c_rgszSh_folder.slice(0);
       if (lvl == 1) {
         c_lTabs = c_lTabs_sett;
         c_rgszSh = c_rgszSh_sett.slice(0);
         if (typeOfTabs !== 0) {
           fnBuildTabStrip("_sett" , 0);
         }
       } else {
         if (typeOfTabs !== 3) {
           fnBuildTabStrip("_folder" , 3);
         }
       }
     } else {
       c_lTabs = c_lTabs_water;
       c_rgszSh = c_rgszSh_water.slice(0);
       if (typeOfTabs !== 2) {
         fnBuildTabStrip("_water" , 2);
       }
     }
   }
   if ((node == 4) || (node == 5) || (node == 6)) {
       c_lTabs = c_lTabs_heat;
       c_rgszSh = c_rgszSh_heat.slice(0);
       if (typeOfTabs !== 4) {
         fnBuildTabStrip("_heat" , 4);
       }
   }
}

function fnBuildTabStrip(name_L , typeOfTab) //c_rgszSh - массив с названиями вкладов c_lTabs - колво вкладок
{
 typeOfTabs = typeOfTab;
 var name_link = "shLink" + name_L;
 var szHTML=
  "<html><head><style>.clScroll {font:8pt Courier New;color:"+c_rgszClr[6]+";cursor:default;line-height:10pt;}"+
  ".clScroll2 {font:10pt Arial;color:"+c_rgszClr[6]+";cursor:default;line-height:11pt;}</style></head>"+
  "<body onclick=\"event.returnValue=false;\" ondragstart=\"event.returnValue=false;\" onselectstart=\"event.returnValue=false;\" bgcolor="+c_rgszClr[4]+" topmargin=0 leftmargin=0><table cellpadding=0 cellspacing=0 width=100%>"+
  "<tr><td colspan=6 height=1 bgcolor="+c_rgszClr[2]+"></td></tr>"+
  "<tr><td style=\"font:1pt\">&nbsp;<td>"+
  "<td valign=top id=tdScroll class=\"clScroll\" onclick=\"parent.fnFastScrollTabs(0);\" onmouseover=\"parent.fnMouseOverScroll(0);\" onmouseout=\"parent.fnMouseOutScroll(0);\"><a>&#171;</a></td>"+
  "<td valign=top id=tdScroll class=\"clScroll2\" onclick=\"parent.fnScrollTabs(0);\" ondblclick=\"parent.fnScrollTabs(0);\" onmouseover=\"parent.fnMouseOverScroll(1);\" onmouseout=\"parent.fnMouseOutScroll(1);\"><a>&lt</a></td>"+
  "<td valign=top id=tdScroll class=\"clScroll2\" onclick=\"parent.fnScrollTabs(1);\" ondblclick=\"parent.fnScrollTabs(1);\" onmouseover=\"parent.fnMouseOverScroll(2);\" onmouseout=\"parent.fnMouseOutScroll(2);\"><a>&gt</a></td>"+
  "<td valign=top id=tdScroll class=\"clScroll\" onclick=\"parent.fnFastScrollTabs(1);\" onmouseover=\"parent.fnMouseOverScroll(3);\" onmouseout=\"parent.fnMouseOutScroll(3);\"><a>&#187;</a></td>"+
  "<td style=\"font:1pt\">&nbsp;<td></tr></table></body></html>";

 with (frames['frScroll'].document) {
  open("text/html","replace");
  write(szHTML);
  close();
 }

 szHTML =
  "<html><head>"+
  "<style>A:link,A:visited,A:active {text-decoration:none;"+"color:"+c_rgszClr[3]+";}"+
  ".clTab {cursor:hand;background:"+c_rgszClr[1]+";font:8pt Arial;padding-left:3px;padding-right:3px;text-align:center;}"+
  ".clBorder {background:"+c_rgszClr[2]+";font:1pt;}"+
  "</style></head><body onload=\"parent.fnInit();\" onselectstart=\"event.returnValue=false;\" ondragstart=\"event.returnValue=false;\" bgcolor="+c_rgszClr[4]+
  " topmargin=0 leftmargin=0><table id=tbTabs cellpadding=0 cellspacing=0>";

 var iCellCount=(c_lTabs+1)*2;

 var i;
 for (i=0;i<iCellCount;i+=2)
  szHTML+="<col width=1><col>";

 var iRow;
 for (iRow=0;iRow<6;iRow++) {

  szHTML+="<tr>";

  if (iRow==5)
   szHTML+="<td colspan="+iCellCount+"></td>";
  else {
   if (iRow==0) {
    for(i=0;i<iCellCount;i++)
     szHTML+="<td height=1 class=\"clBorder\"></td>";
   } else if (iRow==1) {
    for(i=0;i<c_lTabs;i++) {
     szHTML+="<td height=1 nowrap class=\"clBorder\">&nbsp;</td>";
     szHTML+=
      "<td id=tdTab height=1 nowrap class=\"clTab\" onmouseover=\"parent.fnMouseOverTab("+i+");\" onmouseout=\"parent.fnMouseOutTab("+i+");\">"+
      "<a href=\""+document.all.item(name_link)[i].href+"\" target=\"frSheet\" id=aTab>&nbsp;"+c_rgszSh[i]+"&nbsp;</a></td>";
    }
    szHTML+="<td id=tdTab height=1 nowrap class=\"clBorder\"><a id=aTab>&nbsp;</a></td><td width=100%></td>";
   } else if (iRow==2) {
    for (i=0;i<c_lTabs;i++)
     szHTML+="<td height=1></td><td height=1 class=\"clBorder\"></td>";
    szHTML+="<td height=1></td><td height=1></td>";
   } else if (iRow==3) {
    for (i=0;i<iCellCount;i++)
     szHTML+="<td height=1></td>";
   } else if (iRow==4) {
    for (i=0;i<c_lTabs;i++)
     szHTML+="<td height=1 width=1></td><td height=1></td>";
    szHTML+="<td height=1 width=1></td><td></td>";
   }
  }
  szHTML+="</tr>";
 }

 szHTML+="</table></body></html>";
 with (frames['frTabs'].document) {
  open("text/html","replace");
  charset=document.charset;
  write(szHTML);
  close();
 }
 frames["frTabs"].document.getElementById("aTab").click();
}

function fnInit()
{
 g_rglTabX[0]=0;
 var i;
 for (i=1;i<=c_lTabs;i++)
  with (frames['frTabs'].document.all.tbTabs.rows[1].cells[fnTabToCol(i-1)])
   g_rglTabX[i]=offsetLeft+offsetWidth-6;
}

function fnTabToCol(iTab)
{
 return 2*iTab+1;
}

function fnNextTab(fDir)
{
 var iNextTab=-1;
 var i;

 with (frames['frTabs'].document.body) {
  if (fDir==0) {
   if (scrollLeft>0) {
    for (i=0;i<c_lTabs&&g_rglTabX[i]<scrollLeft;i++);
    if (i<c_lTabs)
     iNextTab=i-1;
   }
  } else {
   if (g_rglTabX[c_lTabs]+6>offsetWidth+scrollLeft) {
    for (i=0;i<c_lTabs&&g_rglTabX[i]<=scrollLeft;i++);
    if (i<c_lTabs)
     iNextTab=i;
   }
  }
 }
 return iNextTab;
}

function fnScrollTabs(fDir)
{
 var iNextTab=fnNextTab(fDir);

 if (iNextTab>=0) {
  frames['frTabs'].scroll(g_rglTabX[iNextTab],0);
  return true;
 } else
  return false;
}

function fnFastScrollTabs(fDir)
{
 if (c_lTabs>16)
  frames['frTabs'].scroll(g_rglTabX[fDir?c_lTabs-1:1],0);
 else
  if (fnScrollTabs(fDir)>0) window.setTimeout("fnFastScrollTabs("+fDir+");",5);
}

function fnSetTabProps(iTab,fActive)
{
  if (iTab == undefined) {
    iTab = 0;
  }
 var iCol=fnTabToCol(iTab);
 var i;

 if (iTab>=0) {
  with (frames['frTabs'].document.all) {
   with (tbTabs) {
    for (i=0;i<=4;i++) {
     with (rows[i]) {
      if (i==0)
       cells[iCol].style.background=c_rgszClr[fActive?0:2];
      else if (i>0 && i<4) {
       if (fActive) {
        cells[iCol-1].style.background=c_rgszClr[2];
        cells[iCol].style.background=c_rgszClr[0];
        cells[iCol+1].style.background=c_rgszClr[2];
       } else {
        if (i==1) {
         cells[iCol-1].style.background=c_rgszClr[2];
         cells[iCol].style.background=c_rgszClr[1];
         cells[iCol+1].style.background=c_rgszClr[2];
        } else {
         cells[iCol-1].style.background=c_rgszClr[4];
         cells[iCol].style.background=c_rgszClr[(i==2)?2:4];
         cells[iCol+1].style.background=c_rgszClr[4];
        }
       }
      } else
       cells[iCol].style.background=c_rgszClr[fActive?2:4];
     }
    }
   }
   with (aTab[iTab].style) {
    cursor=(fActive?"default":"hand");
    color=c_rgszClr[3];
   }
  }
 }
}

function fnMouseOverScroll(iCtl)
{
 frames['frScroll'].document.all.tdScroll[iCtl].style.color=c_rgszClr[7];
}

function fnMouseOutScroll(iCtl)
{
 frames['frScroll'].document.all.tdScroll[iCtl].style.color=c_rgszClr[6];
}

function fnMouseOverTab(iTab)
{
 if (iTab!=g_iShCur) {
  var iCol=fnTabToCol(iTab);
  with (frames['frTabs'].document.all) {
   tdTab[iTab].style.background=c_rgszClr[5];
  }
 }
}

function fnMouseOutTab(iTab)
{
 if (iTab>=0) {
  var elFrom=frames['frTabs'].event.srcElement;
  var elTo=frames['frTabs'].event.toElement;

  if ((!elTo) ||
   (elFrom.tagName==elTo.tagName) ||
   (elTo.tagName=="A" && elTo.parentElement!=elFrom) ||
   (elFrom.tagName=="A" && elFrom.parentElement!=elTo)) {

   if (iTab!=g_iShCur) {
    with (frames['frTabs'].document.all) {
     tdTab[iTab].style.background=c_rgszClr[1];
    }
   }
  }
 }
}

function fnSetActiveSheet(iSh)
{
 if (iSh!=g_iShCur) {
  fnSetTabProps(g_iShCur,false);
  fnSetTabProps(iSh,true);
  g_iShCur=iSh;
 }
}

window.g_iIEVer=fnGetIEVer();
//if (window.g_iIEVer>=4)
  fnBuildFrameset();
</script>
</head>

<frameset>
 <noframes>
<body onLoad="expand()">
   <p>Эта страница содержит фреймы, но ваш браузер фреймы не поддерживает </p>
  </body>
 </noframes>
</frameset>
</html>
