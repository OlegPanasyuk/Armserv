<html xmlns="http://www.w3.org/TR/REC-html40">
<head>
<title>header</title>
<!--<META HTTP-EQUIV="Refresh" content="10;URL=header.php">-->
<script language="JavaScript" src="js/xml.js"></script>
<style type="text/css">
#alert  { 
	background: green;
	position: absolute;
    top:0;left:300px;z-index:+20;
	width:100%;
	height:100%;
	font-size:11px;
	}
label {
	width : 40px; 
	margin-right:5;
	margin-left:5;
}
input {
	font-size:10px;
	position: relative;
	top:-5;
	
}
</style>


<script>
function click() {
event.cancelBubble = true;
event.returnValue = false;
}
//document.oncontextmenu = click;
</script>
</head>
<body onload="initAll()" bgcolor="#d2b48c" text="white" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

<img src="images/logo.png" alt=""  height="30" border="0" style="z-index:50; position: relative; float:right;">
<img src="images/head.png" alt="" width="100%" height="30" border="0" style="z-index:-1; position: absolute;  top: 0px;">
<div style="z-index:51; position: relative;  top: 0px; float:right; left:0px; font: 12px; color:black; text-align:center;" id="testdiv3">8(0162) 21 65 42, 20 73 43<br/> Частное предприятие "АИРЭКС"</div>

<script>
var initial = 0;
function fLoadScript(url,postData) { 
   var req = createXMLHTTPObject(); 
   if (!req) return; 
   var method = (postData) ? "POST" : "GET"; 
   req.open(method,url,true); 
   req.setRequestHeader('User-Agent','XMLHTTP/1.0'); 
   if (postData) 
      req.setRequestHeader('Content-type','application/x-www-form-urlencoded'); 
	  req.onreadystatechange = function () { 
      if (req.readyState != 4) return; 
      if (req.status != 200 && req.status != 304) return; 
	  else fCallback(req);
   } 
   if (req.readyState == 4) return; 
   req.send(postData); 
}

function fLoadScript2(url2,postData2) { 
   var req2 = createXMLHTTPObject2(); 
   if (!req2) return; 
   var method2 = (postData2) ? "POST" : "GET"; 
   req2.open(method2,url2,true); 
   req2.setRequestHeader('User-Agent','XMLHTTP/1.0'); 
   if (postData2) 
      req2.setRequestHeader('Content-type','application/x-www-form-urlencoded'); 
	  req2.onreadystatechange = function () { 
      if (req2.readyState != 4) return; 
      if (req2.status != 200 && req2.status != 304) return; 
	  else fCallback2(req2);
   } 
   if (req2.readyState == 4) return; 
   req2.send(postData2); 
}

function fCallback(req) { 
//   eval(req.responseText); 
//document.write(req.responseText)
var znachenie = eval('('+req.responseText+')');
var nowvalues = document.getElementById("nowvalue");
var values = document.getElementById("controltext");
nowvalues.value = roundPlus(znachenie.chislo, 1);
//values.value = znachenie.premax;
//return req.responseText; 
}
 function roundPlus(x, n) { //x - число, n - количество знаков
  if(isNaN(x) || isNaN(n)) return false;
  var m = Math.pow(10,n);
  return Math.round(x*m)/m;
}

 function fCallback2(req2) { 
//   eval(req.responseText); 
//document.write(req.responseText)
getUSPDTime.value = req2.responseText;
//return req.responseText; 
}
 
var XMLHttpFactories = [ 
   function () {return new XMLHttpRequest()}, 
   function () {return new ActiveXObject("Msxml2.XMLHTTP")}, 
   function () {return new ActiveXObject("Msxml3.XMLHTTP")}, 
   function () {return new ActiveXObject("Microsoft.XMLHTTP")} 
]; 

function createXMLHTTPObject() { 
   var xmlhttp = false; 
   for (var i=0;i<XMLHttpFactories.length;i++) { 
      try { 
         xmlhttp = XMLHttpFactories[i](); 
      } 
      catch (e) { 
         continue; 
      } 
      break; 
   } 
   return xmlhttp;
} 

var XMLHttpFactories2 = [ 
   function () {return new XMLHttpRequest()}, 
   function () {return new ActiveXObject("Msxml2.XMLHTTP")}, 
   function () {return new ActiveXObject("Msxml3.XMLHTTP")}, 
   function () {return new ActiveXObject("Microsoft.XMLHTTP")} 
]; 

function createXMLHTTPObject2() { 
   var xmlhttp2 = false; 
   for (var i=0;i<XMLHttpFactories2.length;i++) { 
      try { 
         xmlhttp2 = XMLHttpFactories2[i](); 
      } 
      catch (e) { 
         continue; 
      } 
      break; 
   } 
   return xmlhttp2;
} 

function USPD_Time()
{

fLoadScript2("getTime.php","GET");

}		

function pushButton()
{
    if (getUSPDTime.value == "Время УСПД")
	{
		getUSPDTime.value = "Время УСПД"
		myInterval=setInterval('USPD_Time()',1000);
	}
	else
	{	
		getUSPDTime.value = "Время УСПД"
		clearInterval(myInterval)
	}
}

function queryVal3m()
{
	var Time = new Date();
	var h = Time.getHours();

	if (((h<h2) && (h>=h1)) || ((h>=h3) && (h<h4))) 
	{
		fLoadScript("getVal3m.php","GET");
		
	}
}

function initAll()
{
	
	
	if (control != 0){
	fLoadScript("getVal3m.php","GET");
	myinterval = setInterval('queryVal3m()',180000);
	myInterval2 = setInterval('compare()',120000);}
	
}
function compare()
{ 
	var soundofalert = "include/Sirena.mp3";
	var values = document.getElementById("controltext");
	var nowvalues = document.getElementById("nowvalue");
	var maxvalues = document.getElementById("maxvalue");
	var yellowvalue = PreMax;
	//var yellowvalue = parseFloat(values.value) *0.9;
	var ifcontol = document.getElementById("ifcontrol");
	
	if ((parseFloat(values.value)<parseFloat(nowvalues.value)) && (ifcontol.checked) )
	{ 
		document.getElementById("alert").style.backgroundColor="red";
		document.getElementById("mus1").innerHTML = '';
		for (i=0;i<3;i++){
	 document.getElementsByTagName('label')[i].style.color='white';
	 }
		myWindow= open("", "TestWindow",
"width=300,height=100,status=no,toolbar=no,menubar=no");
myWindow.document.open();
myWindow.document.write("<html><head><title>NewWindow");
myWindow.document.write("</title><bgsound src='include/Sirena.mp3' loop='-1'></head><body bgcolor=\"red\">");
myWindow.document.write("<script>");
myWindow.document.write("function closeW() {window.close();}"); 
myWindow.document.write("<\/script>");
myWindow.document.write("у  вас привышен лимит мощности.");
myWindow.document.write("<button onclick = 'closeW()'>Закрыть</button>");
myWindow.document.write("</body></html>");
myWindow.document.close();
	}
	else 
	{
	if ((yellowvalue<parseFloat(nowvalues.value)) && (ifcontol.checked) )
	 {
	 document.getElementById("alert").style.backgroundColor="yellow";
	 for (i=0;i<3;i++){
	 document.getElementsByTagName('label')[i].style.color='blue';
	 }
	 	 myWindow= open("", "TestWindow",
"width=300,height=100,status=no,toolbar=no,menubar=no");
myWindow.document.open();
myWindow.document.write("<html><head><title>NewWindow");
myWindow.document.write("</title><bgsound src='include/Sirena.mp3' loop='-1'></head><body bgcolor=\"yellow\">");
myWindow.document.write("<script>");
myWindow.document.write("function closeW() {window.close();}"); 
myWindow.document.write("<\/script>");
myWindow.document.write("у  вас привышен лимит мощности.");
myWindow.document.write("<button onclick = 'closeW()'>Закрыть</button>");
myWindow.document.write("</body></html>");
myWindow.document.close();
	 }
	else
	 {
		document.getElementById("alert").style.backgroundColor="green";
		document.getElementById("mus1").innerHTML = ' ';
		for (i=0;i<3;i++){
	 document.getElementsByTagName('label')[i].style.color='white';
	 }
	 }
	}
	if(parseFloat(nowvalues.value)>parseFloat(maxvalues.value))
	{
		maxvalues.value = nowvalues.value;
	}
}
function fnGetIEVer()
{
 var ua=window.navigator.userAgent
 var msie=ua.indexOf("MSIE")
 if (msie>0 && window.navigator.platform=="Win32")
  return parseInt(ua.substring(msie+5,ua.indexOf(".", msie)));
 else
  return 0;
}


window.g_iIEVer=fnGetIEVer();
//document.getElementById("testdiv").innerHTML = window.navigator.userAgent;


</script>
<!--<div name="currtime" id="currtime" style="font-size:12px;font-weight:bold;font:color:#FFFFFF;border:none;position:absolute;top:10;left:10;z-index:+10;" ></div>-->
<input type="button" name="getUSPDTime" value="Время УСПД" onclick="pushButton()" style="font-size:10px;position:absolute;top:7;left:10;z-index:+10;width:105px;">


<?php
$filename = "include/options.ini";$options = @parse_ini_file($filename)or die("Невозможно прочитать файл настроек!");$Max = $options['MaxVal'];
$PreMax = $options['PreMax'];
$h1 = $options['H1'];
$h2 = $options['H2'];
$h3 = $options['H3'];
$h4 = $options['H4'];
$vis= '';
$control1 = $options['Control'];
if ($control1 == 0) $vis = 'display:none;';
echo "
<script>
 
 var PreMax = ".$PreMax.";
 var h1 = ".$h1.";
 var h2 = ".$h2.";
 var h3 = ".$h3.";
 var h4 = ".$h4.";
 var control = ".$control1.";
 </script>
<div style ='".$vis."' id='alert' >
<input type='checkbox' id='ifcontrol'>
<label for='controltext'> контрольная мощность</label><input id='controltext' type='text' value='0'>
<label for='nowvalue'> текущая мощность </label><input id='nowvalue' type='text' value='0'>
<label for='maxvalue'> максимальная мощность </label><input name='maxvalue' id='maxvalue' type='text' value='0'>
</div>
<script>
document.getElementById('controltext').value=".$Max.";
</script>
";
?>

<span id="mus1"></span>
<div name="testdiv" id="testdiv" style="font-size:12px;font-weight:bold;font:color:#FFFFFF;border:none;position:absolute;top:100;left:10;z-index:+20;">
</div>

<div id="time"></div>
</body>
</html>