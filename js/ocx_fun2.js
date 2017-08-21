document.write("<object ID='fw11'	classid='CLSID:48DDB337-6ACA-49EA-A1F0-2CCF0C3CEBCA' codebase='cab/fw11.cab' width=1	height=1><param name='a' value='11'></object>");
//<object 	ID="fw11 Control"	classid="CLSID:48DDB337-6ACA-49EA-A1F0-2CCF0C3CEBCA"	width=80	height=30></object>
//<object 	ID="fw10 Control"	classid="CLSID:E06F12B2-6538-4E97-8A16-19B798EBE1B9"	width=80	height=30></object>

function replace_string(txt,cut_str,paste_str)
{ 
var f=0;
var ht='';
ht = ht + txt;
f=ht.indexOf(cut_str);
while (f!=-1){ 
//цикл для вырезания всех имеющихся подстрок 
f=ht.indexOf(cut_str);
if (f>0){
ht = ht.substr(0,f) + paste_str + ht.substr(f+cut_str.length);
};
};
return ht
};
function timeFormat(mode)
{
 half_hour=HalfP();	
 if (mode)
 {
  hour=(half_hour?(((half_hour-half_hour%2)/2)):(half_hour/2));	 minute=(half_hour%2?30:0+'0');
  return hour+':'+minute;
 }
 else return half_hour;
}
function controlPower_D(izmer,day,month,year,add)
{
 		 m1=GetDataZP(izmer,day,month,year,3,0,add);	p1=Prizn();if ((m1==0)&&(p1=='^')) t1=''; else t1=timeFormat(1);
		 m2=GetDataZP(izmer,day,month,year,4,0,add);    p2=Prizn();if ((m2==0)&&(p2=='^')) t2=''; else t2=timeFormat(1);
		 znach=Math.max(m1,m2); if (znach==m1) {time=t1;prizn=p1;} else {time=t2;prizn=p2;}
//		 alert((Number(izmer)+add)+'_'+day+'.'+month+'.'+year+'_'+m1+'_'+m2)
	 return replace_string((znach).toFixed(dec),".",",")+'_'+time+'_'+prizn;
}

function controlPower_M(izmer,bday,bmon,byear,eday,emon,eyear,add)
{
 		 m1=GetDataPP(izmer,bday,bmon,byear,eday,emon,eyear,3,0,add);	p1=Prizn();if ((m1==0)&&(p1=='^')) t1=''; else {str1=StrRes();dt1=str1.slice(0,str1.length-3);}
		 m2=GetDataPP(izmer,bday,bmon,byear,eday,emon,eyear,4,0,add);	p2=Prizn();if ((m2==0)&&(p2=='^')) t2=''; else {str2=StrRes();dt2=str2.slice(0,str2.length-3);}
		 znach=Math.max(m1,m2); if (znach==m1) {dtime=dt1;prizn=p1;} else {dtime=dt2;prizn=p2;}
	 return replace_string((znach).toFixed(dec),".",",")+'_'+dtime+'_'+prizn;
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
var IsPortOpened=0;

function StrRes()
{
 return fw11.StrRes();
}

function FloatRes()
{
 return fw11.FloatRes();
}

function LongRes()
{
 return fw11.LongRes();
}

function HalfP()
{
 return fw11.HalfP();
}

function SumEn()
{
 return fw11.SumEn();
}

function ConfCounter()
{
 return fw11.ConfCounter();
}

function SetStart(num)
{
 a=fw11.SetStart(num)
 if(a) {alert(GetError());}
  else return StrRes();
}

function SetStop(num)
{
 a=fw11.SetStop(num)
 if(a) {alert(GetError());}
  else return StrRes();
}

//Function GetArcCounter(type As Long, num As Long) As Long
function GetArcCounter(type,num)
{
 a=fw11.GetArcCounter(type,num)
 if(a) return GetError();
  else return StrRes();
}
//Function GetDataZP(numri As Long, day As Long, mon As Long, year As Long, NZ As Long, TD As Long) As Long
function GetDataZP(numri,day,mon,year,nz,td,add)
{
 a=fw11.GetDataZP(Number(numri)+add,day,mon,year,nz,td)
 if(a) return GetError();
  else return FloatRes();
}
//Function GetDataPP(numri As Long, bday As Long, bmon As Long, byear As Long, eday As Long, emon As Long, eyear As Long, NZ As Long, TD As Long) As Long
function GetDataPP(numri,bday,bmon,byear,eday,emon,eyear,nz,td,add)
{
 a=fw11.GetDataPP(Number(numri)+add,bday,bmon,byear,eday,emon,eyear,nz,td)
 if(a) return GetError();
  else return FloatRes();
}
//Function GetDataZE(numri As Long, day As Long, mon As Long, year As Long, NZ As Long, TD As Long) As Long
function GetDataZE(numri,day,mon,year,nz,td,add)
{
 a=fw11.GetDataZE(Number(numri)+add,day,mon,year,nz,td)
 if(a) return GetError();
  else return FloatRes();
}
//Function GetDataPE(numri As Long, bday As Long, bmon As Long, byear As Long, eday As Long, emon As Long, eyear As Long, NZ As Long, TD As Long) As Long
function GetDataPE(numri,bday,bmon,byear,eday,emon,eyear,nz,td,add)
{
 a=fw11.GetDataPE(Number(numri)+add,bday,bmon,byear,eday,emon,eyear,nz,td)
 if(a) return GetError();
  else return FloatRes();
}

//Function GetNameRI(numri As Long) As Long
function GetNameRI(numri)
{
 a=fw11.GetNameRI(numri)
 if(a) return GetError();
 else return StrRes();
}

//Function GetTime() As Long
function GetTime()
{
 a=fw11.GetTime()
 if(a) return GetError();
 else return StrRes();
}

//Function GetEvent(num As Long) As Long
function GetEvent(pos)
{
 a=fw11.GetEvent(pos)
 if(a) return GetError();
 else  return fw11.StrRes();
}
//Function GetArcPos() As Long
function GetArcPos()
{
 a=fw11.GetArcPos()
 if(a) return GetError();
 else  return fw11.LongRes()
}
//Function GetRI(numri As Long, day As Long, mon As Long, year As Long, hour As Long, min As Long) As Long
function GetRI(numri,day,mon,year,hour,minute,add)
{
 a=fw11.GetRI(Number(numri)+add,day,mon,year,hour,minute)
 if(a)  return GetError();
   else return FloatRes();
}
function Prizn()
{
 prizn=fw11.Prizn();
 a=prizn.charCodeAt();
 switch(Number(a))
		   {
		    case 0: return '';
			 break;
		    case 33: return '!';
			 break;
		    case 35: return '#';
			 break;
			case 63: return '?';
		     break;
			case 42: return '*';
		     break;
			case 94: return '^';
		     break;
		    default: return prizn;
		     break;
		   }
 return String.fromCharCode(a);
}
//Function SetCOM(com As Byte, speed As Long, modem As Byte, telephon As String) As Long
function setCom(port,speed,data,stop,parity,modem,telephon)
{//6085594
if (modem) a=fw10.SetCOM(port,speed,data,stop,parity,modem,telephon)
else a=fw10.SetCOM(port,speed,data,stop,parity,0,'')
 alert("Результат выполнения SetCOM: "+a)
 if(a)  return GetError();
   else return a;
}
function setIP(IP,Port)
{
 a=fw11.SetIP(IP,Port)
 if (a)  return GetError();
   else return a;
}
//Function OpenPort(type As Byte, adr As Byte) As Long
function OpenPort(type,adr)
{
 a=fw11.OpenPort(type,adr)
 if(a) {
	 ClosePort();
	 return GetError();
	 }
 else {
 	IsPortOpened=1;//alert("Результат выполнения OpenPort: "+a);
 return a;
 }
}
//Function ClosePort() As Long
function ClosePort()
{
 a=fw11.ClosePort()
 if(a)  return GetError();
   else {IsPortOpened=0;return a;}
}
//Function Zon() As Long
function Zon()
{
 a=fw11.Zon()
 if(a) 	 return GetError();
	 else return a
}
//Function Zoff(password As String) As Long - открытие сеанса связи
function Zoff(pwd)
{
 a=fw11.Zoff(pwd)
 if(a) 	 return GetError();
	 else return a
}
//Function GetError() As String
function GetError()
{
 return fw11.GetError();
// alert("Результат выполнения GetError: "+a)
}

//Function PutRI(numri As Long, day As Long, mon As Long, year As Long, hour As Long, min As Long, value As Single) As Long
function PutRI(numri, day, mon, year, hour, minute, value)
{//numri, day, mon, year, hour, minute, value
 a=fw11.PutRI(numri, day, mon, year, hour, minute, value)
 if(a) 	 return GetError();
	 else return a
}
//Function SetTime(day As Long, mon As Long, year As Long, hour As Long, min As Long, sec As Long) As Long
function SetTime(day, mon, year, hour, min, sec)
{
 a=fw11.SetTime(day, mon, year, hour, min, sec)
 if(a) 	 return GetError();
	 else return a
}
/*
Function SetConnect(num As Long) As Long
Function ChangeTime(day As Long, mon As Long, year As Long, hour As Long, min As Long, sec As Long) As Long
Function ChangeTimeout(n As Long) As Long
Function SetStart(num As Long) As Long
Function SetStop(num As Long) As Long
*/