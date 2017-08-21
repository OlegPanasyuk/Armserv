var rectTags = document.all.tags("rect");
var extrTags = document.all.tags("extrusion");
var divTags = document.all.tags("div");
label_down = new Array(t1,t2,t3,t4,t5,t6,t7,t8,t9,t10,t11,t12,t13,t14,t15,t16,t17,t18,t19,t20,t21,t22,t23,t24,t25,t26,t27,t28,t29,t30,t31,t32,t33,t34,t35,t36,t37,t38,t39,t40,t41,t42,t43,t44,t45,t46,t47,t48)
var barColor=new Array(49);
str=''
for (i=1;i<=48;i++)
str+=','+rectTags[i].fill.color;
barColor=str.split(",")
var maxind=document.myform1.maxind.value;
var active=document.myform1.active.value;
var dec=((document.myform1.format.value.split(".")[1]).split("f")[0])
if(isNaN(dec)) dec=2; 
function summa(item)
{
var res=0;
for (i=4;i<=item;i++)
res+=Number(divTags[i].title)/2;
return res.toFixed(dec);
}
function summa2(item)
{
var res=0;
for (i=4;i<=item;i++)
res+=Number(divTags[i].title);
return res.toFixed(dec);
}

function selected(item)
{
var activeColor;
if (active>0)
{
 label_down[active-1].style.backgroundColor="transparent";
 label_down[item-1].style.backgroundColor="yellow";
 rectTags[item].fillcolor="yellow";
 if (document.myform1.isPower.value==1) //мощность
 {
  document.stat.itogona.value=divTags[item+5].title;
  document.stat.itogona2.value=Number(document.stat.itogona.value/2).toFixed(dec);
  document.stat.itogodo.value=summa(item+5);
  if (item!=active)
  {
	rectTags[active].fill.color=barColor[active];
  }
	document.stat.zona.style.backgroundColor=barColor[item];
  hour=(item%2?(((item-item%2)/2)):(item/2)); minute=(item%2?30:0+"0");
  if (hour<10) hpad="0"; else hpad="";
  document.stat.time.value=hpad+hour+":"+minute;
 }
 else//энергия
 {
  document.stat.itogona.value=divTags[item+5].title;
  document.stat.itogodo.value=summa2(item+5);
  if (item!=active)
  {
	rectTags[active].fill.color=barColor[active];
  }
	document.stat.zona.style.backgroundColor=barColor[item];
  hour=(item%2?(((item-item%2)/2)):(item/2)); minute=(item%2?30:0+"0");
  if (hour<10) hpad="0"; else hpad="";
  document.stat.time.value=hpad+hour+":"+minute; 
 }
 timer.innerHTML= document.stat.time.value;
} 
active=item;
return;
}

function go_printer()
{
document.all.comment.style.visibility="hidden";
window.parent.print();
document.all.comment.style.visibility="visible";
}
