﻿
<?php global $themetricks_plugindir; ?>
<script language="JavaScript">
<!--//--><![CDATA[//><!--

pic0=new Image();
pic0.src="<?php echo $themetricks_plugindir; ?>/theme-tricks/images/eye.gif";
pic1=new Image();
pic1.src="<?php echo $themetricks_plugindir; ?>/theme-tricks/images/pupils.gif";

var n4=(document.layers);
var n6=(document.getElementById&&!document.all);
var ie=(document.all);
var O=(navigator.appName.indexOf("Opera") != -1)?true:false;
var _d=(n4||ie)?'document.':'document.getElementById("';
var _a=(n4||n6)?'':'all.';
var _r=(n6)?'")':'';
var _s=(n4)?'':'.style';
if (n4){
document.write('<layer name="eyeball" top=0 left=0 width="69" height="34"><img src="<?php echo $themetricks_plugindir; ?>/theme-tricks/images/eye.gif" width="69" height="34"></layer>');
document.write('<layer name="pupil1" top=0 left=0 width="13" height="13"><img src="<?php echo $themetricks_plugindir; ?>/theme-tricks/images/pupils.gif" width="13" height="13"></layer>');
document.write('<layer name="pupil2" top:0 left=0 width="13" height="13"><img src="<?php echo $themetricks_plugindir; ?>/theme-tricks/images/pupils.gif" width="13" height="13"></layer>');
}
else{
if (ie)
document.write('<div id="ic" style="position:absolute;top:0;left:0"><div style="position:relative">');
document.write('<div id="eyeball" style="position:absolute;top:100px;left:100px;width:69px;height:34px"><img src="<?php echo $themetricks_plugindir; ?>/theme-tricks/images/eye.gif" width="69" height="34"></div>');
document.write('<div id="pupil1" style="position:absolute;top:0px;left:0px;width:12px;height:13px"><img src="<?php echo $themetricks_plugindir; ?>/theme-tricks/images/pupils.gif" width="13" height="13"></div>');
document.write('<div id="pupil2" style="position:absolute;top:0px;left:0px;width:12px;height:13px"><img src="<?php echo $themetricks_plugindir; ?>/theme-tricks/images/pupils.gif" width="13" height="13"></div>');
if (ie)
document.write('</div></div>');
}
var ym=0;
var xm=0;
if (n4||n6){
 window.captureEvents(Event.MOUSEMOVE);
 function mouseNS(e){
 ym = e.pageY-window.pageYOffset;
 xm = e.pageX;
 }
if (n4)window.onMouseMove=mouseNS;
if (n6)document.onmousemove=mouseNS;
}
if (ie||O){
 function mouseIEO(){
 ym = (ie)?event.clientY:event.clientY-window.pageYOffset;
 xm = event.clientX;
 }
document.onmousemove=mouseIEO;
}
var etemp=eval(_d+_a+"eyeball"+_r+_s); 
var p1temp=eval(_d+_a+"pupil1"+_r+_s);
var p2temp=eval(_d+_a+"pupil2"+_r+_s);
dy=0;
dx=0;
fy=0;
fx=0;
angle1=0;
angle2=0;
d1=0;
d2=0;
function makefollow(){
sy=(!ie)?window.pageYOffset:0;
wy=(ie)?document.body.clientHeight:window.innerHeight;
wx=(ie)?document.body.clientWidth:window.innerWidth;
//Keep eyes on screen. Netscape 6 plays up otherwise!
var chy=Math.floor(fy-34);
if (chy <= 0) chy = 0;
if (chy >= wy-34) chy = wy-34;
var chx=Math.floor(fx-34);
if (chx <= 0) chx = 0;
if (chx >= wx-69) chx = wx-69;
etemp.top=chy+sy;
etemp.left=chx;
//eyeball1 centre.
c1y=parseInt(etemp.top)+17;
c1x=parseInt(etemp.left)+17;
//eyeball2 centre.
c2y=parseInt(etemp.top)+17;
c2x=parseInt(etemp.left)+52;
dy1 = ym+sy - c1y;
dx1 = xm - c1x;
d1 = Math.sqrt(dy1*dy1 + dx1*dx1);
dy2 = ym+sy - c2y;
dx2 = xm - c2x;
d2 = Math.sqrt(dy2*dy2 + dx2*dx2);
ay1 = ym+sy - c1y;
ax1 = xm - c1x;
angle1 = Math.atan2(ay1,ax1)*180/Math.PI;
ay2 = ym+sy - c2y;
ax2 = xm - c2x;
angle2 = Math.atan2(ay2,ax2)*180/Math.PI;
dv=1.7;
p1temp.top=(d1 < 17)?(c1y-6+d1/dv*Math.sin(angle1*Math.PI/180)):(c1y-6+10*Math.sin(angle1*Math.PI/180));
p1temp.left=(d1 < 17)?(c1x-6+d1/dv*Math.cos(angle1*Math.PI/180)):(c1x-6+10*Math.cos(angle1*Math.PI/180));
p2temp.top=(d2 < 17)?(c2y-6+d2/dv*Math.sin(angle2*Math.PI/180)):(c2y-6+10*Math.sin(angle2*Math.PI/180));
p2temp.left=(d2 < 17)?(c2x-6+d2/dv*Math.cos(angle2*Math.PI/180)):(c2x-6+10*Math.cos(angle2*Math.PI/180));
}
function move(){
if (ie)ic.style.top=document.body.scrollTop;
dy=fy+=(ym-fy)*0.12-2;
dx=fx+=(xm-fx)*0.12;
makefollow();
setTimeout('move()',10);
}
window.onload=move;
//--><!]]>
</script>
