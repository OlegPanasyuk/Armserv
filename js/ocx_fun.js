//Function GetErrorString() As String
function ax_GetErrorString()
{
rez=s7ax.GetErrorString()
 return rez;
}
//Function GetErrorLong() As Long
function ax_GetErrorLong()
{
 rez=s7ax.GetErrorLong()
 return rez;
}
//Function GetMoment_7_1(Obj As Long, Counter As Long) As Long
function ax_GetMoment_7_1(Obj, Counter)
{
//Obj=2;Counter=0;
 rez=s7ax.GetMoment_7_1(Obj, Counter)
 return rez;
}
//Function GetArhCounter_7_2(Obj As Long, Counter As Long, TypeArh As Long) As Long
function ax_GetArhCounter_7_2(Obj, Counter, TypeArh)
{
 rez=s7ax.GetArhCounter_7_2(Obj, Counter, TypeArh)
 return rez;
}
//Function GetResult() As Long
function ax_GetResult()
{
 rez=s7ax.GetResult()
 return rez;
}
//Function GetStrResult() As String
function ax_GetStrResult()
{
 rez=s7ax.GetStrResult()
 return rez;
}

//Function Open(Type As Long) As Long
function ax_Open(type) //1-COM, 2-UDP
{
 rez=s7ax.Open(type)
 if (rez!=0) ax_GetErrorString();
 return rez;
}
//Function Close() As Long
function ax_Close()
{
 rez=s7ax.Close()
 if (rez!=0) ax_GetErrorString();
 return rez;
}
//Function SetTimeout(Timeout As Long) As Long
function ax_SetTimeout(Timeout)
{
 rez=s7ax.SetTimeout(Timeout)
 if (rez!=0) ax_GetErrorString();
 return rez;
}
//Function SetCOMParam(COM As Long, Speed As Long, Databits As Long, Stopbits As Long, Parity As Long) As Long
function ax_SetCOMParam(COM, Speed, Databits, Stopbits, Parity)
{
 rez=s7ax.SetCOMParam(COM, Speed, Databits, Stopbits-1, Parity)
 return rez;
}
//Function SetUDPParam(IP As String, Port As Long) As Long
function ax_SetUDPParam(IP, Port)
{
 rez=s7ax.SetUDPParam(IP, Port);
 if (rez!=0) ax_GetErrorString();
 return rez;
}

//Function Dial(Telephon As String) As Long
function ax_Dial(tel)
{
 return s7ax.Dial(tel)
}
//Function Disconnect() As Long
function ax_Disconnect()
{
 return s7ax.Disconnect()
}
