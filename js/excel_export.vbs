	Dim objExcel
	Dim rowcount
	rowcount=0

Function CreateFolder(path)
Dim fso, f
 Set fso = CreateObject("Scripting.FileSystemObject")
 if not (fso.FolderExists(path)) then
 Set f = fso.CreateFolder(path)
 CreateFolder = path
end if
CreateFolder = path
End Function 

Sub DeleteAFolder(filespec)
Dim fso
Set fso = CreateObject("Scripting.FileSystemObject")
fso.DeleteFolder(filespec)
End Sub

Sub OpenXls()
 On Error Resume Next
	Set objExcel = CreateObject("Excel.Application") 
       IF Err.Number<>0 OR objExcel =NULL THEN 
			msgbox("Проверьте, установлен ли MS Excel и разрешено выполнение ActiveX в браузере.") 
            EXIT SUB 
        END IF 
	Set objWorkbook = objExcel.Workbooks.Add 
	objExcel.Visible = False
End Sub

Sub FillXls(row,col,val,rc)
	 objExcel.Cells(row,col).Value=Trim(val)
	 rowcount=rc
End Sub

Sub CloseXls()
'	 objExcel.Close false
     objExcel.Quit
	 Set objWorkbook = Nothing
	 Set objExcel = Nothing
End Sub

'мощность/энергия за сутки
Sub ToXls_1(table,n_form,pw_en,pics,num_day,date,zn,tp)
	If pw_en=1 then	 
		maxp=rowcount-14
	ElseIf pw_en=2 then	 
		maxp=rowcount-10
	Else
		maxp=rowcount+1
	End If	 
	With objExcel
		.Range("A1:H1").Merge
		.Range("A2:H2").Merge
		.Range("A3:H3").Merge
		.Range("A4:H4").Merge
		.Range("B5:H5").Merge
		maxstr="B"+CStr(maxp)+":I"+CStr(maxp)
		.Range(CStr(maxstr)).Merge
	    .Columns("A:H").AutoFit
	    .Columns("A:H").NumberFormat = "#,##0.000"
		.Range("A1").Select
	End With
	path=CreateFolder(folder)
	Select Case pw_en
	Case 1
		str="S_P_"+zn+"_"+CStr(date)
	Case 2
		str="S_E_"+zn+"_"+CStr(date)
	Case 3
		str="S_M_"+zn+"_"+CStr(date)
	End Select
	On Error Resume Next
'========================================================================	
 sXLS = path+""+str+".xls"
 appVerInt=Split(objExcel.Version, ".")(0)
 With objExcel
   .Application.DisplayAlerts = False
   .Visible = True
    If appVerInt>=12 Then
       .ActiveWorkbook.SaveAs(sXLS), 56  'office 2007
    Else
       .ActiveWorkbook.SaveAs(sXLS), 43  'office 2003
    End If
 End With
 objExcel.Application.DisplayAlerts = True
'========================================================================
 CloseXls()
 MsgBox "файл сохранен: "+sXLS
End Sub

'мощность/энергия по дням
Sub ToXls_2(table,n_form,pw_en,pics,num_day,date,zn,tp)
	If pw_en=1 then	 
		maxp=rowcount-14
	ElseIf pw_en=2 then	 
		maxp=rowcount-10
	Else
		maxp=rowcount-1
	End If	 
	With objExcel
		.Range("A1:I1").Merge
		.Range("A2:I2").Merge
		.Range("A3:I3").Merge
		.Range("A4:I4").Merge
		.Range("B5:I5").Merge
		maxstr="B"+CStr(maxp)+":I"+CStr(maxp)
		.Range(CStr(maxstr)).Merge
    	.Columns("A:I").ColumnWidth = 14
	    .Columns("A:I").AutoFit
	    .Columns("A:I").NumberFormat = "#,##0.000"
		.Range("A1").Select
	End With
	path=CreateFolder(folder)
	month2=Mid(CStr(date),4,2)
	year2=Mid(CStr(date),7,4)
	Select Case pw_en
	Case 1
	str="S_P_"+zn+"_"+MonthName(CInt(month2),true)+CStr(year2)
	Case 2
	str="S_E_"+zn+"_"+MonthName(CInt(month2),true)+CStr(year2)
	Case 3
	str="S_M_"+zn+"_"+MonthName(CInt(month2),true)+CStr(year2)
	End Select
	On Error Resume Next
'========================================================================	
 sXLS = path+""+str+".xls"
 appVerInt=Split(objExcel.Version, ".")(0)
 With objExcel
   .Application.DisplayAlerts = False
   .Visible = True
    If appVerInt>=12 Then
       .ActiveWorkbook.SaveAs(sXLS), 56  'office 2007
    Else
       .ActiveWorkbook.SaveAs(sXLS), 43  'office 2003
    End If
 End With
 objExcel.Application.DisplayAlerts = True
'========================================================================
 CloseXls()
 MsgBox "файл сохранен: "+sXLS
End Sub

'мощность/энергия по зонам
Sub ToXls_3(table,n_form,pw_en,pics,num_day,date,zn,tp)
	With objExcel
	 if pw_en=1 then
		.Range("A1:P1").Merge
		.Range("A2:P2").Merge
		.Range("A3:P3").Merge
		.Range("A4:P4").Merge
		.Range("A5:P5").Merge
		.Range("A6:B6").Merge
    	.Columns("A:P").ColumnWidth = 14
	    .Columns("A:P").AutoFit
	    .Columns("A:P").NumberFormat = "#,##0.000"
	    .Range("A6:P6").NumberFormat = "0"
	End If	
	 if pw_en=2 then
		.Range("A1:I1").Merge
		.Range("A2:I2").Merge
		.Range("A3:I3").Merge
		.Range("A4:I4").Merge
		.Range("A5:I5").Merge
		.Range("A6:I6").Merge
    	.Columns("A:I").ColumnWidth = 14
	    .Columns("A:I").AutoFit
	    .Columns("A:I").NumberFormat = "#,##0.000"
'	    .Range("A6:I6").NumberFormat = "0"
	End If	
		.Range("A1").Select
	End With
	path=CreateFolder(folder)
	month3=Mid(CStr(date),4,2)
	year3=Mid(CStr(date),7,4)
	Select Case tp
	Case 1
	 if pw_en=1 then
	 str="Pp_TZ_"	 
	 end if
	 if pw_en=2 then
	 str="Ap_TZ_"	 
	 end if
	Case 2
	 if pw_en=1 then
	 str="Po_TZ_"	 
	 end if
	 if pw_en=2 then
	 str="Ao_TZ_"	 
	 end if
	Case 3
	 if pw_en=1 then
	 str="Qp_TZ_"	 
	 end if
	 if pw_en=2 then
	 str="Rp_TZ_"	 
	 end if
	Case 4
	 if pw_en=1 then
	 str="Qo_TZ_"	 
	 end if
	 if pw_en=2 then
	 str="Ro_TZ_"	 
	 end if
	End Select
	str=str+zn+"_"+MonthName(CInt(month3),true)+CStr(year3)
	On Error Resume Next
'========================================================================	
 sXLS = path+""+str+".xls"
 appVerInt=Split(objExcel.Version, ".")(0)
 With objExcel
   .Application.DisplayAlerts = False
   .Visible = True
    If appVerInt>=12 Then
       .ActiveWorkbook.SaveAs(sXLS), 56  'office 2007
    Else
       .ActiveWorkbook.SaveAs(sXLS), 43  'office 2003
    End If
 End With
 objExcel.Application.DisplayAlerts = True
'========================================================================
 CloseXls()
 MsgBox "файл сохранен: "+sXLS
End Sub

'накопление/приращение энергии
Sub ToXls_4(table,n_form,pw_en,pics,num_day,date,zn,tp)
	With objExcel
	'	.Selection.HorizontalAlignment = "xlCenter"
		.Range("A1:H1").Merge
		.Range("A2:H2").Merge
		.Range("A3:H3").Merge
		.Range("A4:H4").Merge
	    .Columns("A:H").AutoFit
	    .Columns("A:H").NumberFormat = "#,##0.000"
	    .Range("A6:I6").NumberFormat = "0"
		.Range("A1").Select
	End With
	path=CreateFolder(folder)
	Select Case tp
	Case 1
	str="E_INC_"+zn+"_"++CStr(date)
	Case 2
	str="E_ACC_"+zn+"_"++CStr(date)
	End Select
 On Error Resume Next
'========================================================================	
 sXLS = path+""+str+".xls"
 appVerInt=Split(objExcel.Version, ".")(0)
 With objExcel
   .Application.DisplayAlerts = False
   .Visible = True
    If appVerInt>=12 Then
       .ActiveWorkbook.SaveAs(sXLS), 56  'office 2007
    Else
       .ActiveWorkbook.SaveAs(sXLS), 43  'office 2003
    End If
 End With
 objExcel.Application.DisplayAlerts = True
'========================================================================
 CloseXls()
 MsgBox "файл сохранен: "+sXLS
End Sub

'расход энергии
Sub ToXls_5(table,n_form,pw_en,pics,num_day,date,zn,tp)
	With objExcel
		.Range("A1:G1").Merge
		.Range("A2:G2").Merge
		.Range("A3:G3").Merge
    	.Columns("A:G").ColumnWidth = 14
	    .Columns("A:G").AutoFit
		.Range("A1").Select
	End With
	path=CreateFolder(folder)
	month3=Mid(CStr(date),4,2)
	year3=Mid(CStr(date),7,4)
	Select Case tp
	Case 1
	 if pw_en=1 then
	 str="Pp_TZ_"	 
	 end if
	Case 2
	 if pw_en=1 then
	 str="Po_TZ_"	 
	 end if
	Case 3
	 if pw_en=1 then
	 str="Qp_TZ_"	 
	 end if
	Case 4
	 if pw_en=1 then
	 str="Qo_TZ_"	 
	 end if
	End Select
	str=str+zn+"_"+MonthName(CInt(month3),true)+CStr(year3)
	On Error Resume Next
'========================================================================	
 sXLS = path+""+str+".xls"
 appVerInt=Split(objExcel.Version, ".")(0)
 With objExcel
   .Application.DisplayAlerts = False
   .Visible = True
    If appVerInt>=12 Then
       .ActiveWorkbook.SaveAs(sXLS), 56  'office 2007
    Else
       .ActiveWorkbook.SaveAs(sXLS), 43  'office 2003
    End If
 End With
 objExcel.Application.DisplayAlerts = True
'========================================================================
 CloseXls()
 MsgBox "файл сохранен: "+sXLS
End Sub

'вода за сутки
Sub ToXls_6(table,n_form,pw_en,pics,num_day,date,zn,tp)
	If pw_en=1 then	 
		maxp=rowcount-14
	ElseIf pw_en=2 then	 
		maxp=rowcount-10
	Else
		maxp=rowcount+1
	End If	 
	With objExcel
		.Range("A1:H1").Merge
		.Range("A2:H2").Merge
		.Range("A3:H3").Merge
		.Range("A4:H4").Merge
		.Range("B5:H5").Merge
	    .Columns("A:H").AutoFit
	    .Columns("A:H").NumberFormat = "#,##0.000"
		.Range("A1").Select
	End With
	path=CreateFolder(folder)
	Select Case pw_en
	Case 1
		str="S_P_"+zn+"_"+CStr(date)
	Case 2
		str="S_E_"+zn+"_"+CStr(date)
	Case 3
		str="S_M_"+zn+"_"+CStr(date)
	End Select
	On Error Resume Next
'========================================================================	
 sXLS = path+""+str+".xls"
 appVerInt=Split(objExcel.Version, ".")(0)
 With objExcel
   .Application.DisplayAlerts = False
   .Visible = True
    If appVerInt>=12 Then
       .ActiveWorkbook.SaveAs(sXLS), 56  'office 2007
    Else
       .ActiveWorkbook.SaveAs(sXLS), 43  'office 2003
    End If
 End With
 objExcel.Application.DisplayAlerts = True
'========================================================================
 CloseXls()
 MsgBox "файл сохранен: "+sXLS
End Sub

Sub ToXls_7(table,n_form,pw_en,pics,num_day,date,zn,tp) 
	With objExcel
		.Range(.Cells(1,1),.Cells(1,tp)).Merge
		.Range(.Cells(2,1),.Cells(2,tp)).Merge
		.Range(.Cells(3,1),.Cells(3,tp)).Merge
		.Range(.Cells(4,2),.Cells(4,tp)).Merge
	    .Columns("A:Z").AutoFit
	    .Columns("A:Z").NumberFormat = "#,##0.000"
		.Range("A1").Select
	End With
	path=CreateFolder(folder)
	Select Case pw_en
	Case 1
		str="S_P_"+zn+"_"+CStr(date)
	Case 2
		str="S_E_"+zn+"_"+CStr(date)
	Case 3
		str="S_M_"+zn+"_"+CStr(date)
	End Select
	On Error Resume Next
'========================================================================	
 sXLS = path+""+str+".xls"
 appVerInt=Split(objExcel.Version, ".")(0)
 With objExcel
   .Application.DisplayAlerts = False
   .Visible = True
    If appVerInt>=12 Then
       .ActiveWorkbook.SaveAs(sXLS), 56  'office 2007
    Else
       .ActiveWorkbook.SaveAs(sXLS), 43  'office 2003
    End If
 End With
 objExcel.Application.DisplayAlerts = True
'========================================================================
 CloseXls()
 MsgBox "файл сохранен: "+sXLS
End Sub

Sub ToXls(table,n_form,pw_en,pics,num_day,date,zn,tp)
OpenXls()
	Set T = document.Body.CreateTextRange() 
	T.moveToElementText(document.all(table)) 
	T.execCommand "Copy" 
	Set T = Nothing 
	objExcel.ActiveSheet.Paste 
'основные
	IF n_form=0 then
		objExcel.Columns("A:A").ColumnWidth = 17
		objExcel.Columns("B:B").ColumnWidth = 12
	    objExcel.Columns("C:C").ColumnWidth = 12
	    objExcel.Columns("D:D").ColumnWidth = 10
	    objExcel.Columns("G:G").ColumnWidth = 10
	    objExcel.Columns("E:E").ColumnWidth = 12
	    objExcel.Columns("H:H").ColumnWidth = 12
	    objExcel.Selection.Rows.AutoFit
	    objExcel.Range("A1:M1").Select
	end if		
'архив УСПД
	IF n_form=5 then
		objExcel.Columns("B:B").ColumnWidth = 15
	    objExcel.Columns("C:C").ColumnWidth = 90
	    objExcel.Selection.Rows.AutoFit
	    objExcel.Columns("C:C").EntireColumn.AutoFit
	for i=1 To 2
		objExcel.ActiveSheet.Shapes("Picture "+CStr(i)).Select
		objExcel.Selection.Delete
	Next
	objExcel.Range("A1").Select
		objExcel.Range("A1").Select
	end if		
'архив счетчика
	IF n_form=6 then
		objExcel.Columns("B:B").ColumnWidth = 15
	    objExcel.Columns("B:B").ColumnWidth = 25
	    objExcel.Columns("C:C").ColumnWidth = 50
	    objExcel.Selection.Rows.AutoFit
		objExcel.Range("A1").Select
	end if			
'=======================================================================================================
path=CreateFolder(folder)
if n_form=0 Then 
str="M_CFG_"+zn
On Error Resume Next
end if	
if n_form=5 Then 
   str="AUSPD_"+CStr(pw_en)+"_"+CStr(pics)+"_"+num_day+"_"+date
end if	
if n_form=6 Then 
Select Case pw_en
Case 1
str="APH_"+zn
Case 2
str="AER_"+zn
Case 3
str="APK_"+zn
End Select
 On Error Resume Next
end if	
	On Error Resume Next
'========================================================================	
 sXLS = path+""+str+".xls"
 appVerInt=Split(objExcel.Version, ".")(0)
 With objExcel
   .Application.DisplayAlerts = False
   .Visible = True
    If appVerInt>=12 Then
       .ActiveWorkbook.SaveAs(sXLS), 56  'office 2007
    Else
       .ActiveWorkbook.SaveAs(sXLS), 43  'office 2003
    End If
 End With
 objExcel.Application.DisplayAlerts = True
'========================================================================
 CloseXls()
 MsgBox "файл сохранен: "+sXLS
End Sub


'if (navigator.userAgent.indexOf('MSIE')>-1) 
'{ 
'alert('Скопируйте какой-н кусок текста в ClipBoard и нажмите ок'); 
'document.write('<br><br><br>especially for IE users-- your clipboard data is:<br><br>----begin data-----<pre>'+window.clipboardData.getData('Text')+'</pre>------end data-----<br><br>check your clipboard now!<br>'); 
'window.clipboardData.setData('Text','вот и нету ваших данных в буфере '); 
'} 

 Function VersionMS()
    Dim FSO
    Set FSO = CreateObject("Scripting.FileSystemObject")
'    VersionMS = FSO.GetFileVersion(SysCmd(acSysCmdAccessDir) & "excel.exe")
'    VersionMS = FSO.GetFileVersion(Application.Path & "excel.exe")
    Set FSO = Nothing
End Function

Function Export(objToExport) 
        ON ERROR RESUME NEXT 
        DIM sHTML, oExcel, fso, filePath 
'        sHTML = document.all(objToExport).outerHTML 
        sHTML = document.all(objToExport).innerHTML 
        SET fso = CreateObject("Scripting.FileSystemObject") 
        filePath = fso.GetSpecialFolder(2) & "\MyExportedExcel.xls" 
        fso.CreateTextFile(filePath).Write(sHTML) 
        DIM i 
        SET i = 0 
        DO WHILE err.number > 0 
            err.Clear() 
            filePath = fso.GetSpecialFolder(2) & "\MyExportedExcel" & i & ".xls" 
            i = i + 1 
        LOOP 
        SET oExcel = CreateObject("Excel.Application") 
        IF err.number>0 OR oExcel =NULL THEN 
			msgbox("Проверьте, установлен ли MS Excel и разрешено выполнение ActiveX в браузере.") 
            EXIT FUNCTION 
        END IF 
        oExcel.Workbooks.open(filePath) 
        oExcel.Workbooks(1).WorkSheets(1).Name = "My Excel Data" 
        oExcel.Visible = true 
        Set fso = Nothing 
    End Function 

'	  These are the main file formats in Excel 2007:
'		51 = xlOpenXMLWorkbook (without macro's in 2007, .xlsx)
'		52 = xlOpenXMLWorkbookMacroEnabled (with or without macro's in 2007, .xlsm)
'		50 = xlExcel12 (Excel Binary Workbook in 2007 with or without macro's, .xlsb)
'		56 = xlExcel8 (97-2003 format in Excel 2007, .xls)
'	Note: I always use the FileFormat numbers instead of the defined constants
'	in my code so that it will compile OK when I copy the code into an Excel
'	97-2003 workbook. (For example, Excel 97-2003 won't know what the
'	xlOpenXMLWorkbookMacroEnabled constant is.)
'========================================================================	
'Const Excel2007 = 12
'sXLS = "C:\HR.xls"
'With objExcel
'   .Application.DisplayAlerts = False
'   .Visible = True
'   .Workbooks.Open(sXLS)
'    appVerInt = split(.Version, ".")(0)
'    If appVerInt-Excel2007 >=0 Then
'       .ActiveWorkbook.SaveAs(sXLS), 56  'office 2007
'    Else
'       .ActiveWorkbook.SaveAs(sXLS), 43  'office 2003
'    End If
'End With
'objExcel.Quit
'Set objExcel = Nothing
'MsgBox "файл сохранен: "+sXLS
'========================================================================
