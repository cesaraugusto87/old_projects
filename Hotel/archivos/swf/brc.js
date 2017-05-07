  if (window != window.top)
    top.location.href = location.href;
       
	    function closeWindow()
         {
         this.top.close()
        }
		
function positionWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}

function MM_reloadPage(init) {  //reloads the window if Nav4 resized
  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
    document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);

function openPictureWindow_Fever(imageName,imageWidth,imageHeight,alt,posLeft,posTop) {
	newWindow = window.open("","newWindow","width="+imageWidth+",height="+imageHeight+",left="+posLeft+",top="+posTop);
	newWindow.document.open();
	newWindow.document.write('<html><title>'+alt+'</title><body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginheight="0" marginwidth="0" onBlur="self.close()">'); 
	newWindow.document.write('<img src='+imageName+' width='+imageWidth+' height='+imageHeight+' alt='+alt+'>'); 
	newWindow.document.write('</body></html>');
	newWindow.document.close();
	newWindow.focus();
}
function MM_reloadPage(init) {  //reloads the window if Nav4 resized
  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
    document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);
// -->

function MM_findObj(n, d) { //v4.0
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && document.getElementById) x=document.getElementById(n); return x;
}

function BW_centerLayers() { //v4.1.1
	if (document.layers || document.all || document.getElementById){
		var winWidth, winHeight, i, horz, vert, width, height, offsetX, offsetY, negX, negY, group, x, y, args;
		args = BW_centerLayers.arguments;
		
		onresize = BW_reload;

				
		winWidth = (document.all)?document.body.clientWidth:window.innerWidth;
		winHeight = (document.all)?document.body.clientHeight:window.innerHeight;
				
		for (i=0; i<(args.length-9); i+=10) {
			horz    = args[i+1];
			vert    = args[i+2];
			width   = parseInt(args[i+3]);
			height  = parseInt(args[i+4]);
			offsetX = parseInt(args[i+5]);
			offsetY = parseInt(args[i+6]);
			negX    = args[i+7];
			negY    = args[i+8];
		
			x = ((winWidth - width)/2) + offsetX;
			y = ((winHeight - height)/2) + offsetY;
						
			x = (negX=='false' && (x < 0))?0:x;
			y = (negY=='false' && (y < 0))?0:y;
				
			layerObj = (document.getElementById)?document.getElementById(args[i]):MM_findObj(args[i]);
			
			if (layerObj!=null) {
				layerObj = (layerObj.style)?layerObj.style:layerObj;
				layerObj.left = (horz=="true")?x:layerObj.left;
				layerObj.top = (vert=="true")?y:layerObj.top;
			}
		}
	}
}

function BW_reload() {location.reload();}

function tmt_DivAlign(theDiv,h,v,hPx,vPx){
	var obj,fun,dw,dh,lw,lh,x,y;
	fun = (document.getElementById) ? "document.getElementById" : "MM_findObj";
	obj = (document.getElementById) ? document.getElementById(theDiv) : MM_findObj(theDiv);
	if(obj){if(document.all){
	dw = document.body.clientWidth;dh = document.body.clientHeight;}
	else{dw = innerWidth;dh = innerHeight;}
	if(document.layers){lw = obj.clip.width;lh = obj.clip.height;}else{
	lw = obj.style.width.replace("px","");lh = obj.style.height.replace("px","");}
	x = (document.layers) ? ".left" : ".style.left";
	y = (document.layers) ? ".top" : ".style.top";
	if(h == "l"){eval(fun+"('"+theDiv+"')"+x+"="+hPx);}
	if(h == "c"){eval(fun+"('"+theDiv+"')"+x+"="+dw+"/2-"+lw+"/2");}
	if(h == "r"){eval(fun+"('"+theDiv+"')"+x+"="+dw+"-"+lw+"-"+hPx);}
	if(v == "t"){eval(fun+"('"+theDiv+"')"+y+"="+vPx);}
	if(v == "m"){eval(fun+"('"+theDiv+"')"+y+"="+dh+"/2-"+lh+"/2");}
	if(v == "b"){eval(fun+"('"+theDiv+"')"+y+"="+dh+"-"+lh+"-"+vPx);}}
}
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
window.moveTo(0,0);
if (document.all) {
top.window.resizeTo(screen.availWidth,screen.availHeight);
}
else if (document.layers||document.getElementById) {
if (top.window.outerHeight<screen.availHeight||top.window.outerWidth<screen.availWidth){
top.window.outerHeight = screen.availHeight;
top.window.outerWidth = screen.availWidth;
}
}
window.moveTo(0,0);
if (document.all) {
top.window.resizeTo(screen.availWidth,screen.availHeight);
}
else if (document.layers||document.getElementById) {
if (top.window.outerHeight<screen.availHeight||top.window.outerWidth>screen.availWidth){
top.window.outerHeight = screen.availHeight;
top.window.outerWidth = screen.availWidth;
}
}