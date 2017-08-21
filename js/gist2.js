var rectTags = document.all.tags("rect")
var extrTags = document.all.tags("extrusion")
var divTags = document.all.tags("div")
 label_down = new Array(t1,t2,t3,t4,t5,t6,t7,t8,t9,t10,t11,t12,t13,t14,t15,t16,t17,t18,t19,t20,t21,t22,t23,t24,t25,t26,t27,t28,t29,t30,t31)
 label_down1 = new Array(d1,d2,d3,d4,d5,d6,d7,d8,d9,d10,d11,d12,d13,d14,d15,d16,d17,d18,d19,d20,d21,d22,d23,d24,d25,d26,d27,d28,d29,d30,d31)
var maxind=document.myform1.maxind.value;
var active=document.myform1.active.value;
var dec=((document.myform1.format.value.split(".")[1]).split("f")[0])
if(isNaN(dec)) dec=2; 
function summa(item)
{
var res=0;
for (i=4;i<=item;i++)
res+=Number(divTags[i].title);
return res.toFixed(dec);
}
function summa2(item)
{
var res=0;
for (i=1;i<=item;i++)
res+=Number(rectTags[i].title);
return res.toFixed(dec);
}

var firsttime=0;
function selected(item)
{
 if (active>0)
 {
  label_down[active-1].style.backgroundColor="transparent";  
  if (label_down1[item-1].style.backgroundColor!="red")  label_down[item-1].style.backgroundColor="yellow";
  if (rectTags[item])
   rectTags[item].fillcolor="yellow";  
   if (item==active) activeColor="yellow"; else activeColor="blue";
  if (rectTags[active])
   rectTags[active].fill.color=activeColor;	
  if (document.myform1.isPower.value==1) 
  {
   document.stat.currmax.value=rectTags[item].title;
   //alert(item)
   document.stat.currday.value=divTags[item+5].title;
   document.stat.oncurrday.value=summa(item+5);
  }
  else
  {
   document.stat.currmax.value=divTags[item+5].title;
   document.stat.currday.value=rectTags[item].title;
   document.stat.oncurrday.value=summa2(item); 
  }
 } 
active=item;
}

function go_printer()
{
document.all.comment.style.visibility="hidden";
window.parent.print();
document.all.comment.style.visibility="visible";
}
