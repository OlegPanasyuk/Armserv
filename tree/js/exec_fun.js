
var selback='';
function setName(t)
{
 if ((cur_id.value!='')&&(cur_id.value!='undefined'))
 {
	cur=document.getElementById(cur_id.value);
	if (cur.className=='sel') cur.className='selback';
 } 
 cur_id.value=t;
// item_name.value=t.innerText;
 selectItem(t);
 cur=document.getElementById(cur_id.value);
}

function selectItem(t)
{
	//=================================
	if(selback!='') 
		{ 
		if(document.all[selback]) 
		document.all[selback].className='selback';
	}
	selback=t; 
	document.getElementById(t).className='sel'; 
	//================================
}

function defineID(i_id,p_id,lvl,node,obj,addr,i_name,znum)
{
	parent.testFn(node,obj,addr,lvl);
	try {
		parent.frSheet.document.getElementById("content").style.display="none";
	}
	catch (e) {
		
	}
	item_id.value=i_id; par_id.value=p_id;
	level.value=lvl;   	nobj.value=obj;
	adr.value=addr;		nzavod.value=znum;
	ntype.value=node; item_name.value=i_name;
	param_str="?id="+item_id.value+"&pid="+par_id.value+"&level="+level.value+"&name="+item_name.value+"&node="+ntype.value+"&nobj="+nobj.value+"&adr="+adr.value;
//===========================================================
 var whatFrame='#';
 try
	 {
	whatFrame=window.parent.frSheet.document.topmenu.frameName.value;
	 }
 catch(e)
	{
	 whatFrame='#';
	}
 switch (whatFrame)
 {
	case 'momentval' : 
	 {
		if (node<1) {
	 		window.parent.frSheet.legenda.innerHTML='<span style="color:black;font-size:10px;">вывод данных по объекту:</span> ';
	 		window.parent.frSheet.formatData.style.display='inline';
		}
		else {
			window.parent.frSheet.legenda.innerHTML=' <span style="color:black;font-size:10px;">(выберите другой объект)</span>';
			window.parent.frSheet.formatData.style.display='none';
			window.parent.frSheet.content.innerHTML='';
		}
	}
	break;
	case 'meterarh' : 
	{
		if (node<1) {
	 		window.parent.frSheet.legenda.innerHTML='<span style="color:black;font-size:10px;">вывод данных по объекту:</span> ';
	 		window.parent.frSheet.formatData.style.display='inline';
		}
		else {
			window.parent.frSheet.legenda.innerHTML=' <span style="color:black;font-size:10px;">(выберите другой объект)</span>';
			window.parent.frSheet.formatData.style.display='none';
			window.parent.frSheet.content.innerHTML='';
		}
	 }
	break;
	case 'form1' : 
	 {
		if (node<2) {
	 		window.parent.frSheet.legenda.innerHTML='<span style="color:black;font-size:10px;">вывод данных по объекту:</span> ';
	 		window.parent.frSheet.formatData.style.display='inline';
		}
		else {
			window.parent.frSheet.legenda.innerHTML=' <span style="color:black;font-size:10px;">(выберите другой объект)</span>';
			window.parent.frSheet.formatData.style.display='none';
			window.parent.frSheet.content.innerHTML='';
		}
	 }
	break;
	case 'form2' : 
	 {
		if (node<2) {
	 		window.parent.frSheet.legenda.innerHTML='<span style="color:black;font-size:10px;">вывод данных по объекту:</span> ';
	 		window.parent.frSheet.formatData.style.display='inline';
		}
		else {
			window.parent.frSheet.legenda.innerHTML=' <span style="color:black;font-size:10px;">(выберите другой объект)</span>';
			window.parent.frSheet.formatData.style.display='none';
			window.parent.frSheet.content.innerHTML='';
		}
	 }
	break;
	case 'form3' : 
	 {
		if (node<2) {
	 		window.parent.frSheet.legenda.innerHTML='<span style="color:black;font-size:10px;">вывод данных по объекту:</span> ';
	 		window.parent.frSheet.formatData.style.display='inline';
		}
		else {
			window.parent.frSheet.legenda.innerHTML=' <span style="color:black;font-size:10px;">(выберите другой объект)</span>';
			window.parent.frSheet.formatData.style.display='none';
			window.parent.frSheet.content.innerHTML='&nbsp;';
		}
	 }
	break;
	case 'form4' : 
	 {
		if (node<1) {
	 		window.parent.frSheet.legenda.innerHTML='<span style="color:black;font-size:10px;">вывод данных по объекту:</span> ';
	 		window.parent.frSheet.formatData.style.display='inline';
		}
		else {
			window.parent.frSheet.legenda.innerHTML=' <span style="color:black;font-size:10px;">(выберите другой объект)</span>';
			window.parent.frSheet.formatData.style.display='none';
			window.parent.frSheet.content.innerHTML='&nbsp;';
		}
	}
	break;
	case 'form5' : 
	 {
		if (node==2) {
	 		window.parent.frSheet.legenda.innerHTML='<span style="color:black;font-size:10px;">вывод данных по объекту:</span> ';
	 		window.parent.frSheet.formatData.style.display='inline';
		}
		else {
			window.parent.frSheet.legenda.innerHTML=' <span style="color:black;font-size:10px;">(выберите другой объект)</span>';
			window.parent.frSheet.formatData.style.display='none';
			window.parent.frSheet.content.innerHTML='&nbsp;';
		}
	 }
	break;
	case '3min_p' : 
	 {
		if (node<2) {
	 		window.parent.frSheet.legenda.innerHTML='<span style="color:black;font-size:10px;">вывод данных по объекту:</span> ';
	 		window.parent.frSheet.formatData.style.display='inline';
		}
		else {
			window.parent.frSheet.legenda.innerHTML=' <span style="color:black;font-size:10px;">(выберите другой объект)</span>';
			window.parent.frSheet.formatData.style.display='none';
			window.parent.frSheet.content.innerHTML='&nbsp;';
		}
	 }
	break;
	case 'gist1' : 
	 {
		if (node<2) {
	 		window.parent.frSheet.legenda.innerHTML='<span style="color:black;font-size:10px;">вывод данных по объекту:</span> ';
	 		window.parent.frSheet.formatData.style.display='inline';
		}
		else {
			window.parent.frSheet.legenda.innerHTML=' <span style="color:black;font-size:10px;">(выберите другой объект)</span>';
			window.parent.frSheet.formatData.style.display='none';
			window.parent.frSheet.content.innerHTML='&nbsp;';
		}
	 }
	break;
	case 'gist2' : 
	 {
		if (node<2) {
	 		window.parent.frSheet.legenda.innerHTML='<span style="color:black;font-size:10px;">вывод данных по объекту:</span> ';
	 		window.parent.frSheet.formatData.style.display='inline';
		}
		else {
			window.parent.frSheet.legenda.innerHTML=' <span style="color:black;font-size:10px;">(выберите другой объект)</span>';
			window.parent.frSheet.formatData.style.display='none';
			window.parent.frSheet.content.innerHTML='&nbsp;';
		}
	 }
	break;
	case 'gist3' : 
	 {
		if (node<2) {
	 		window.parent.frSheet.legenda.innerHTML='<span style="color:black;font-size:10px;">вывод данных по объекту:</span> ';
	 		window.parent.frSheet.formatData.style.display='inline';
		}
		else {
			window.parent.frSheet.legenda.innerHTML=' <span style="color:black;font-size:10px;">(выберите другой объект)</span>';
			window.parent.frSheet.formatData.style.display='none';
			window.parent.frSheet.content.innerHTML='&nbsp;';
		}
	 }
	break;
 
	 case 'form8' : 
	 {
	if (node==2 || node==3) {
	 		window.parent.frSheet.legenda.innerHTML='<span style="color:black;font-size:10px;">вывод данных по объекту:</span> ';
	 		window.parent.frSheet.formatData.style.display='inline';
		}
		else {
			window.parent.frSheet.legenda.innerHTML=' <span style="color:black;font-size:10px;">(выберите другой объект)</span>';
			window.parent.frSheet.formatData.style.display='none';
			window.parent.frSheet.content.innerHTML='&nbsp;';
		}
	 }
	break;
	
	case 'form9' : 
	 {
	if (node==2 || node==3) {
	 		window.parent.frSheet.legenda.innerHTML='<span style="color:black;font-size:10px;">вывод данных по объекту:</span> ';
	 		window.parent.frSheet.formatData.style.display='inline';
		}
		else {
			window.parent.frSheet.legenda.innerHTML=' <span style="color:black;font-size:10px;">(выберите другой объект)</span>';
			window.parent.frSheet.formatData.style.display='none';
			window.parent.frSheet.content.innerHTML='';
		}
	 }
	break;

	case 'form10' : 
	 {
	if (node==4 || node==5 || node ==6 || node == 7 || node == 9) {
	 		window.parent.frSheet.legenda.innerHTML='<span style="color:black;font-size:10px;">вывод данных по объекту:</span> ';
	 		window.parent.frSheet.formatData.style.display='inline';
		}
		else {
			window.parent.frSheet.legenda.innerHTML=' <span style="color:black;font-size:10px;">(выберите другой объект)</span>';
			window.parent.frSheet.formatData.style.display='none';
			window.parent.frSheet.content.innerHTML='';
		}
	 }
	break;

	case 'form11' :
	 {
	if (node==4 || node==5 || node ==6 ||  node == 7 || node == 9) {
	 		window.parent.frSheet.legenda.innerHTML='<span style="color:black;font-size:10px;">вывод данных по объекту:</span> ';
	 		window.parent.frSheet.formatData.style.display='inline';
		}
		else {
			window.parent.frSheet.legenda.innerHTML=' <span style="color:black;font-size:10px;">(выберите другой объект)</span>';
			window.parent.frSheet.formatData.style.display='none';
			window.parent.frSheet.content.innerHTML='';
		}
	 }
	break;
	default:
	{
	return;
	}
	 break
	}
 //=============================================================
}

