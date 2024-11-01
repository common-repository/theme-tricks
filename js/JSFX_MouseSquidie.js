/*******************************************************************
*
* File    : JSFX_MouseSquidie.js
*
* Created : 2001/05/17
*
* Author  : Roy Whittle  (Roy@Whittle.com) www.Roy.Whittle.com
*
* Purpose : To create a Squidie or eel animation that follows the mouse
*
* History
* Date         Version        Description
* 2001-05-17	1.0		Converted for JavaScript-FX
* 2003-02-11	1.1		Add mouse tracking code
***********************************************************************/
if(!window.JSFX)
	JSFX = new Object();
/*
 * Class MouseSquidieMass extends Layer
 */
JSFX.MouseSquidieMass = function(htmlStr, x, y, z)
{
	if(!htmlStr)
		return;

	//Call the super constructor
	this.superC = JSFX.Layer;
	this.superC(htmlStr);

	this.x=x;
	this.y=y;
	this.show();
	this.setzIndex(z);
	this.setOpacity(6*z);
	this.addEventHandler("onmousedown", this.destroy);
}
JSFX.MouseSquidieMass.prototype = new JSFX.Layer;

JSFX.MouseSquidieMass.prototype.destroy = function(el, ev)
{
	el.hide();
}

JSFX.MouseSquidie = function(args)
{
	if(args==null) return;

	var n  = args[0];
	this.followers = new Array();
	this.followers[0] = new JSFX.MouseSquidieMass (args[1], 200, -200, n );

	for(i=1 ; i<n ; i++)
	{
		var img
		if(args.length == 2)
			img = args[1];
		else
			img = args[(i%(args.length-2)) + 2];

		this.followers[i] = new JSFX.MouseSquidieMass (img, 200, -200, n-i );
	}

	this.targetX	= 200;
	this.targetY	= 200;
	this.x		= -100;
	this.y		= -100;
	this.dx		= 0;
	this.dy		= 0;
}
JSFX.MouseSquidie.prototype.animate = function()
{
	var m;
	for(i=this.followers.length-1; i>0 ; i--)
	{
		m = this.followers[i];
		m.x = this.followers[i-1].x+0;
		m.y = this.followers[i-1].y-2;
		m.moveTo(m.x, m.y);
	}
	m = this.followers[0];
	var X = (this.targetX - m.x);
	var Y = (this.targetY - m.y);
	var len = Math.sqrt(X*X+Y*Y);
	var dx = 20 * (X/len);
	var dy = 20 * (Y/len);
	var ddx = (dx - this.dx)/10;
	var ddy = (dy - this.dy)/10;
	this.dx += ddx;
	this.dy += ddy;
	m.x += this.dx;
	m.y += this.dy;
	m.moveTo(m.x, m.y);

	this.targetX = JSFX.Browser.mouseX-(m.getWidth())/2;
	this.targetY = JSFX.Browser.mouseY-m.getHeight()-5;
}

JSFX.MakeMouseSquidie = function()
{
	var squidie = new JSFX.MouseSquidie(JSFX.MakeMouseSquidie.arguments);
	JSFX.MakeMouseSquidie.squidies[JSFX.MakeMouseSquidie.squidies.length] = squidie;

	if(!JSFX.MakeMouseSquidie.theTimer)
		JSFX.MakeMouseSquidie.theTimer = setInterval("JSFX.MakeMouseSquidie.animate()", 40);

	return(squidie);
}
JSFX.MakeMouseSquidie.squidies = new Array();
JSFX.MakeMouseSquidie.animate = function()
{
	var i;
	for(i=0 ; i<JSFX.MakeMouseSquidie.squidies.length ; i++)
		JSFX.MakeMouseSquidie.squidies[i].animate();
}
/*** If no other script has added it yet, add the ns resize fix ***/
if(navigator.appName.indexOf("Netscape") != -1 && !document.getElementById)
{
	if(!JSFX.ns_resize)
	{
		JSFX.ow = outerWidth;
		JSFX.oh = outerHeight;
		JSFX.ns_resize = function()
		{
			if(outerWidth != JSFX.ow || outerHeight != JSFX.oh )
				location.reload();
		}
	}
	window.onresize=JSFX.ns_resize;
}

