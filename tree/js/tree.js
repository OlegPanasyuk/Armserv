
function E_Tree(c, i, e, p)
{
//c - caption
//i - image
//p - parent node ID
//e - expand
	if (!p) this.l=0; 
		else this.l=p.l+1;
	this.c=c?"&nbsp;"+c:"";
	this.i=i?i:'folder';
	this.p=p?p:null;
	this.e=e?e:false;
	this.items=[];
}
E_Tree.prototype.addItem=function(c, i, e)
{
//c - caption
//i - image
//e - expand
	var nI=new E_Tree(c, i, e, this);
	this.items[this.items.length]=nI;
	return nI;
}
E_Tree.prototype.addImgs=function()
{
	if (!this.p) return "";
	var res="", img;
	var ci=this.p;
	while (ci.p) 
	{
		img =(ci.last)?"spacer.gif":"bar.gif";
		res="<img hspace=0 width=18 height=30 align=left src="+tpath+img+">"+res;
		ci=ci.p;
	}
	return res;
}
E_Tree.prototype.elem = function()
{
	if (this.p) 
	{
		var img;
		this.last=this.p.items[this.p.items.length-1]==this;
		this.childs=false;
		for (var i=0; i<this.items.length;i++) 
		{
			if (this.items[i].items.length>=0) 
			{
				this.childs=true; break;
			}
		}
		if (this.last)
		{
			img=(this.childs)?"corner_p.gif":"corner.gif";
		}
		else 
		{
			img=(this.childs)?"tee_p.gif":"tee.gif";
		}
		this.p_hp=document.createElement("img");
		with (this.p_hp)
		{
			src=tpath+img;
			this.p_hp.onclick=function(){this.parentNode.o.act()};
			height=30;
			width=18;
			hspace=0;
			align='left';
		}
	}
	this.p_hi=document.createElement("img");
	with (this.p_hi)
	{
		src=tpath+((this.i=="folder")?((this.items.length)?'folder_c.gif':'link.gif'):this.i+"_c.gif");
		this.p_hi.onclick=function(){this.parentNode.o.act()}
		height=30;
		width=18;
		hspace=0;
		align='left';
	}
	this.p_sp=document.createElement("span");
	this.p_sp.onclick=function(){this.parentNode.o.act()}
	this.p_sp.className="dt";
	this.p_sp.style.marging="20px"
	this.first=true;
}
E_Tree.prototype.createHtml = function(i)
{
	var r=tbl.insertRow(i?i:tbl.rows.length);
	r.vAlign = "middle";
	var c=r.insertCell(0);
	if (!this.first) this.elem();
	c.innerHTML=this.addImgs();
	if (this.p_hp) this.hp=c.appendChild(this.p_hp);
	this.hi=c.appendChild(this.p_hi);
	c.appendChild(this.p_sp).innerHTML=this.c;
	c.noWrap=true;
	c.o=this;
	this.hr=r;
}
E_Tree.prototype.deleteHtml = function()
{
	var ix=this.hr.rowIndex;
	tbl.deleteRow(ix);
}

E_Tree.prototype.act = function()
{
	with(this)
	{
	 if (items.length==0) return;
	 e=!e;
	 e?expand():collaps();
    }
}

E_Tree.prototype.expand = function() 
{
	var ix=this.hr.rowIndex;
	this.hi.src=tpath+this.i+"_o.gif";
	var timg=(this.last)?"corner_m.gif":"tee_m.gif";
	if (this.childs) this.hp.src=tpath+timg;
	for (var i=this.items.length-1; i>=0; i--)
	{
		with  (this.items[i])
		{
			createHtml(ix+1);
			if (e) expand();
		}
	}
}
E_Tree.prototype.collaps = function() 
{
	for (var i=this.items.length-1; i>=0; i--)
	{
		with  (this.items[i])
		{
			if (e) collaps();
			deleteHtml();
		}
	}
	this.hi.src=tpath+this.i+"_c.gif";
	var timg=(this.last)?"corner_p.gif":"tee_p.gif";
	if (this.childs) this.hp.src=tpath+timg;
}

E_Tree.prototype.expandall = function() 
{
	for (ix=0;ix<this.items.length-1;ix++)
	{
//	var ix=this.hr.rowIndex;
	this.hi.src=tpath+this.i+"_o.gif";
	var timg=(this.last)?"corner_m.gif":"tee_m.gif";
	if (this.childs) this.hp.src=tpath+timg;
	for (var i=this.items.length-1; i>=0; i--)
	{
		with  (this.items[i])
		{
			createHtml(ix+1);
			if (e) expandall();
		}
	}
 }	
}
