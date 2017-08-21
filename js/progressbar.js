var txt=''
txt+='	<div id="indicator" style="position:absolute;">';
txt+='		<font id="loadmsg">';
txt+=' 			»ƒ≈“ «¿√–”« ¿ —“–¿Õ»÷€<br>';
txt+=' 			œŒƒŒ∆ƒ»“≈ œŒ∆¿À”…—“¿';
txt+=' 		</font>';
txt+=' 		<p>';
txt+=' 		<table id="bar" align=center>';
txt+=' 			<tr>';
txt+=' 				<td id="bar0">&nbsp;</td><td id="bar1">&nbsp;</td><td id="bar2">&nbsp;</td><td id="bar3">&nbsp;</td><td id="bar4">&nbsp;</td>';
txt+=' 				<td id="bar5">&nbsp;</td><td id="bar6">&nbsp;</td><td id="bar7">&nbsp;</td><td id="bar8">&nbsp;</td><td id="bar9">&nbsp;</td>';
txt+=' 				<td id="bar10">&nbsp;</td><td id="bar11">&nbsp;</td><td id="bar12">&nbsp;</td><td id="bar13">&nbsp;</td><td id="bar14">&nbsp;</td>';
txt+=' 				<td id="bar15">&nbsp;</td><td id="bar16">&nbsp;</td><td id="bar17">&nbsp;</td><td id="bar18">&nbsp;</td><td id="bar19">&nbsp;</td>';
txt+=' 			</tr>';
txt+=' 		</table>';
txt+=' 	</div>';
document.write(txt);

var countIter = 20;
var indexBar = 0;
indicator.style.top=document.body.clientHeight/2-50;
indicator.style.left=parseInt(document.body.clientWidth/2.5);
var interval;

function incrementProgressBar() {
	try {	
		if (indexBar < countIter) {
			var oEl = document.getElementById("bar" + indexBar);
			oEl.style.backgroundColor = "#ffaaaa";
			indexBar++;
		}
		else {clearInterval(interval);indicator.style.display="none"; }
	} catch(exception) 
	{
	}
}
function decrementProgressBar() {
	try {	
		if (indexBar > countIter) {
			var oEl = document.getElementById("bar" + indexBar);
			oEl.style.backgroundColor = "#eeeeee";
			indexBar--;
		}
	} catch(exception) 
	{
	}
}

function startIncrement()
{
 interval=setInterval("incrementProgressBar()",20) 
}

function click() {
event.cancelBubble = true;
event.returnValue = false;
}
//document.oncontextmenu = click;
