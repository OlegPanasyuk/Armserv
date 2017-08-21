//<!--
var tabArr=location.search;
	if (tabArr!="") tab=(tabArr.split("&")[0]).slice(5);else tab=0;
function fnUpdateTabs(tab)
 {
  if (parent.window.g_iIEVer>=4) {
   if (parent.document.readyState=="complete"
    && parent.frames['frTabs'].document.readyState=="complete")
   parent.fnSetActiveSheet(tab);
  else
   window.setTimeout("fnUpdateTabs("+tab+");",150);
 }
}
if (window.name!="frSheet") window.location.replace("index.php");
else
 fnUpdateTabs(tab);
//-->
