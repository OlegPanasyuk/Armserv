var DataLArr =new Array();
var DataLDay = new Array();
var DataLMon = new Array();
var DataLYear = new Array();

function fAddListItem(strDate) {
	var dl=document.forms[1].dataList;
	dl.options[dl.options.length]=new Option(strDate,strDate);
}
function fRemoveListItem(strDate) {
	var dl=document.forms[1].dataList;
	for (var i=0;i<dl.options.length;i++)
		if (strDate==dl.options[i].value) break;
	dl.options[i]=null;
}

function tAddListItem(strTime) {
if (!checkDate(window.document.topmenu.disp.value,window.document.topmenu.dc.value)) return 0;
	var dl=document.forms[1].dataList;
	isSuchItem=1;
	if (strTime!='') 
	{
	for (var i=0;i<dl.options.length;i++)
		if (strTime==dl.options[i].value) isSuchItem=0;
	 if (isSuchItem) dl.options[dl.options.length]=new Option(strTime,strTime);
	}
}
function tRemoveListItem(strTime) {
	var dl=document.forms[1].dataList;
	if (dl.options.length>0)
	{
	if (dl.selectedIndex<0)
	{
	 for (var i=(dl.options.length-1);i>0;i--)
		if (strTime==dl.options[i].value) break;
	 dl.options[i]=null;
	}
	else dl.options[dl.selectedIndex]=null;
	}
}

function tClearAll() {
	var dl=document.forms[1].dataList;
	for (var i=dl.options.length;i>=0;i--)
	dl.options[i]=null;
	window.document.topmenu.reset();
	//window.scanner.location.href="about:blank"
	stop()
}

		var update;
		function refresh()
		{
		  nobj=window.document.topmenu.nobj.value;
		  adr=window.document.topmenu.adr.value;
		  window.scanner.location.href="ByDate.php?nobj="+nobj+"&adr="+adr;
		}
		function setInt() 
		{
		 update=setInterval('refresh()',10000);
		}  
		 function stop()
		 {
		  clearInterval(update)
		 }

function submitDataSet(fm) {	// construct the selected dates in the hidden form field allSelected
	var dl=document.forms[1].dataList;
	fm.allSelected.value="";
	for (var i=0; i<dl.length; i++) 
	{
		if (i>0) fm.allSelected.value+=",";
		fm.allSelected.value+=dl.options[i].value;
	}
//	 fm.action="ByDate.php";	 fm.method="post";	 fm.submit();
	param_string="allSelected="+fm.allSelected.value+"&nobj="+fm.nobj.value+"&adr="+fm.adr.value+"&disp="+fm.disp.value;
	window.scanner.location.href='ByDate.php?'+param_string;
}


function DataSetList()
{
	var dl=window.document.submitForm.dataList;
	for (var i=0; i<dl.options.length; i++)
	{
		DataLArr[i] = dl.options[i].value;
		DataLYear[i] = DataLArr[i].slice(2,4);
		DataLMon[i] = DataLArr[i].slice(5,7);
		DataLDay[i] = DataLArr[i].slice(8,10);
		
		
	}
	
}

function checkDate(disp,dc)
{
var now=new Date()
if (disp==1)
{
	 dataStr=dc.split(" ");
	 dateStr=dataStr[0].split('.'); 
	 timeStr=dataStr[1].split(':');
	 day=dateStr[0];			month=dateStr[1];			year=dateStr[2];
	 hour=timeStr[0]; minute=timeStr[1];
	 dif=(year-now.getYear())*32140800+(month-now.getMonth()-1)*2678400+(day-now.getDate())*86400+(hour-now.getHours())*3600+(minute-now.getMinutes())*60; 
}
if (disp==2)
{
	dataStr=dc
	dateStr=dataStr.split('.'); 
	day=dateStr[0];			month=dateStr[1];			year=dateStr[2];
    dif=(year-now.getYear())*32140800+(month-now.getMonth()-1)*2678400+(day-now.getDate())*86400; 
}
if (dif<0) return 1;
else return 0;
}

function checkForm(fm)
{ 
 DL=document.forms[1].dataList;
  if (DL.length<1) {alert("Ни один запрос не установлен"); return 0;}

 var mode=window.document.topmenu.disp.value;
  if (mode==1)
   {
    if (checkID())
    submitDataSet(fm);
   }
  if (mode==2)
   {
    if (checkID())
    submitDataSet(fm);
   }
}

function sendQUERY() {
	checkID();
	DataSetList();
	var D;
	var S;
	
	for(var i=0; i<DataLArr.length; i++)
	{
		S = fwzpx.setzp(IP, 5150, 0, Timeout, adruspd, obj, adr, DataLDay[i], DataLMon[i], DataLYear[i], 1, 48);
		D = fwzpx.setzp(IP, 5150, 0, Timeout, adruspd, tweener, 1, DataLDay[i], DataLMon[i], DataLYear[i], 1, 48);
		if (S==0) {
		document.getElementById("results").innerHTML+= DataLArr[i] + "успешное выполнение, объект и счетчик найдены, запросы установлены <br>";
	}
	if (S==-1) {
		document.getElementById("results").innerHTML+= "неправильный ip-адрес <br>";
	}
	if (S==-2) {
		document.getElementById("results").innerHTML+= "порт больше 65000 или меньше 1024 <br>";
	}
	if (S==-3) {
		document.getElementById("results").innerHTML+= "ошибка инициализации (WSAStartup()) <br>";
	}
	if (S==-4) {
		document.getElementById("results").innerHTML+= "ошибка создания сокета <br>";
	}
	if (S==-5) {
		document.getElementById("results").innerHTML+= "ошибка привязки сокета <br>";
	}
	if (S==-6) {
		document.getElementById("results").innerHTML+= "ошибка при передаче запроса <br>";
	}
	if (S==-7) {
		document.getElementById("results").innerHTML+= "ошибка установки ожидания ответа <br>";
	}
	if (S==-8) {
		document.getElementById("results").innerHTML+= "ошибка приема ответа <br>";
	}
	if (S==-9) {
		document.getElementById("results").innerHTML+= "ответ другой длины <br>";
	}
	if (S==-10) {
		document.getElementById("results").innerHTML+= " принят ответ от другого адреса <br>";
	}
	if (S==-11) {
		document.getElementById("results").innerHTML+= "получен ответ с ошибкой выполнения запроса <br>";
	}
	if (S==-12) {
		document.getElementById("results").innerHTML+= "истек тайаут <br>";
	}
	}
	//S = fwzpx.setzp(IP, 5150, 0, Timeout, adruspd, obj, adr, 20, 3, 16, 1, 5);
	
	
	//document.getElementById("results").innerHTML = S;
	/*document.getElementById("results").innerHTML = '';
	document.getElementById("results").innerHTML += IP + "<br>";
	document.getElementById("results").innerHTML += Port + "<br>";
	document.getElementById("results").innerHTML += Timeout + "<br>";
	document.getElementById("results").innerHTML += adruspd + "<br>";
	document.getElementById("results").innerHTML += adr + "<br>";
	document.getElementById("results").innerHTML += obj + "<br>";
	*/
	
	<div>
	mama mila ramu 
	</div>
	
}

function checkMode(obj)
{
var mode=window.document.topmenu.disp.value;
 if (mode==1)
 { 
	if(self.gfPop1) gfPop1.fPopCalendar(window.document.topmenu.dc);
 }
 else
 {
	if(self.gfPop) gfPop.fPopCalendar(window.document.topmenu.dc);
 }
}
