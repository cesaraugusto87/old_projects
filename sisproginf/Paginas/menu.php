<html>
   <head>
      <title>Prueba menu</title>
      <!-- Consigue este JavaScript y otros muchos en MundoJavaScript.com -->	  
      <style>
         <!--
            .menuskin{
               position:absolute;
               width:100px;
               background-color:menu;
               border:1px solid green;
               font:normal 12px Courier;
               line-height:18px;
               z-index:100;
               visibility:hidden;
            }
            .menuskin a{
               text-decoration:none;
               color:#0033CC;
               padding-left:5px;
               padding-right:5px;
            }
            #mouseoverstyle{
               background-color:#666666;
            }
            #mouseoverstyle a{
               color:#00FF99;
            }
         -->
      </style>
      <script language="JavaScript1.2">
      var linkset=new Array()
      //Menu Para El Item 1.
	  linkset[0]='<div class="menuitems"><a href="../Paginas/Departamento/PMision.php#Cuerpo" target="_top" >Mision</a></div>'
      linkset[0]+='<div class="menuitems"><a href="../Paginas/Departamento/PVision.php#Cuerpo" target="_top" >Vision</a></div>'
      linkset[0]+='<div class="menuitems"><a href="../Paginas/Departamento/Pobjetivos.php#Cuerpo" target="_top">Objetivos</a></div>'
	  linkset[0]+='<div class="menuitems"><a href="../Paginas/Departamento/Porganigrama.php#Cuerpo" target="_top">Organigrama</div>'	  
      //Menu Para El Item 2.
	  linkset[1]='<div class="menuitems"><a href="http://msnbc.com">Reservar Cupo</a></div>'
      linkset[1]+='<div class="menuitems"><a href="http://cnn.com">Oferta Cursos</a></div>'
	  
	  linkset[2]='<div class="menuitems"><a href="http://www.google.com">Google</a></div>'
      linkset[2]+='<div class="menuitems"><a href="http://www.yahoo.com">Yahoo</a></div>'
	  linkset[2]+='<div class="menuitems"><a href="http://www.altavista.com">Alta Vista</a></div>'
	  
	  linkset[3]='<div class="menuitems"><a href="../Paginas/Departamento/PGaleriaBasico.php#Cuerpo" target="_top">Basico</a></div>'
      linkset[3]+='<div class="menuitems"><a href="../Paginas/Departamento/PGaleriaTele.php#Cuerpo" target="_top">Telecomunicaciones</a></div>'
	  linkset[3]+='<div class="menuitems"><a href="../Paginas/Departamento/PGaleria.php#Cuerpo" target="_top">Virtual</a></div>'
	        
	  ////No need to edit beyond here
      var ie4=document.all&&navigator.userAgent.indexOf("Opera")==-1
      var ns6=document.getElementById&&!document.all
      var ns4=document.layers
      
	  function showmenu(e,which){
         if (!document.all&&!document.getElementById&&!document.layers)
            return
         clearhidemenu()
         menuobj=ie4? document.all.popmenu : ns6? document.getElementById("popmenu") : ns4? document.popmenu : ""
         menuobj.thestyle=(ie4||ns6)? menuobj.style : menuobj
         if (ie4||ns6)
		    menuobj.innerHTML=which
         else{
            menuobj.document.write('<layer name=gui bgColor=#E6E6E6 width=165 onmouseover="clearhidemenu()" onmouseout="hidemenu()">'+which+'</layer>')
menuobj.document.close()
         }
         menuobj.contentwidth=(ie4||ns6)? menuobj.offsetWidth : menuobj.document.gui.document.width
         menuobj.contentheight=(ie4||ns6)? menuobj.offsetHeight : menuobj.document.gui.document.height
         eventX=ie4? event.clientX : ns6? e.clientX : (e.x)
         eventY=ie4? event.clientY : ns6? e.clientY : (e.y)
         
		 //Find out how close the mouse is to the corner of the window
         var rightedge=ie4? document.body.clientWidth-eventX : window.innerWidth-eventX
         var bottomedge=ie4? document.body.clientHeight-eventY : window.innerHeight-eventY
         
		 //if the horizontal distance isn't enough to accomodate the width of the context menu
         if (rightedge<menuobj.contentwidth)
            //move the horizontal position of the menu to the left by it's width
            menuobj.thestyle.left=ie4? document.body.scrollLeft+eventX-menuobj.contentwidth : ns6? window.pageXOffset+eventX-menuobj.contentwidth : eventX-menuobj.contentwidth
         else
            //position the horizontal position of the menu where the mouse was clicked
            menuobj.thestyle.left=ie4? document.body.scrollLeft+eventX : ns6? window.pageXOffset+eventX : eventX
         //same concept with the vertical position
         if (bottomedge<menuobj.contentheight)
            menuobj.thestyle.top=ie4? document.body.scrollTop+eventY-menuobj.contentheight : ns6? window.pageYOffset+eventY-menuobj.contentheight : eventY-menuobj.contentheight
         else
            menuobj.thestyle.top=ie4? document.body.scrollTop+event.clientY : ns6? window.pageYOffset+eventY : eventY
         menuobj.thestyle.visibility="visible"
         return false
      }
      function contains_ns6(a, b) {
         //Determines if 1 element in contained in another- by Brainjar.com
         while (b.parentNode)
            if ((b = b.parentNode) == a)
               return true;
         return false;
      }
      function hidemenu(){
         if (window.menuobj)
            menuobj.thestyle.visibility=(ie4||ns6)? "hidden" : "hide"
      }
      function dynamichide(e){
         if (ie4&&!menuobj.contains(e.toElement))
            hidemenu()
         else 
	        if (ns6&&e.currentTarget!= e.relatedTarget&& !contains_ns6(e.currentTarget, e.relatedTarget))
               hidemenu()
      }
      function delayhidemenu(){
         if (ie4||ns6||ns4)
            delayhide=setTimeout("hidemenu()",500)
      }
      function clearhidemenu(){
         if (window.delayhide)
            clearTimeout(delayhide)
      }
      function highlightmenu(e,state){
         if (document.all)
            source_el=event.srcElement
         else 
		    if (document.getElementById)
               source_el=e.target
         if (source_el.className=="menuitems"){
            source_el.id=(state=="on")? "mouseoverstyle" : ""
         }else{
            while(source_el.id!="popmenu"){
               source_el=document.getElementById? source_el.parentNode : source_el.parentElement
               if (source_el.className=="menuitems"){
                  source_el.id=(state=="on")? "mouseoverstyle" : ""
               }
            }
         }
      }
      if (ie4||ns6)
         document.onclick=100
   </script>
      <link href="../funciones/estilo.css" rel="stylesheet" type="text/css">
      <style type="text/css">
<!--
.Estilo25 {font-family: "Courier New", Courier, monospace}
-->
      </style>
</head>

<body onload=songticker()>

<table width="158" height="153" border="8" align="left">
  <tr>
    <td class="boton"><div align="center"><a href="../index.php" target="_top" class="Estilo12">Inicio</a></div></td>
  </tr>
  <tr>
  <div id="popmenu" class="menuskin" onMouseover="clearhidemenu();highlightmenu(event,'on')" onMouseout="highlightmenu(event,'off');dynamichide(event)"></div>
    <td class="boton"><a href="#" class="Estilo12" onMouseover="showmenu(event,linkset[0])" onMouseout="delayhidemenu()">&iquest; Quienes_Somos ?</a> </td>
  </tr>
  <tr>
    <td class="boton"><a href="Usuarios/Ptablero.php" target="_top" class="Estilo12" >Cursos</a></td>
  </tr>
  <tr>
    <td class="boton"><a href="#" class="Estilo12" onMouseover="showmenu(event,linkset[3])" onMouseout="delayhidemenu()">Galerias </a></td>
  </tr>
  <tr>
    <td class="boton"><a href="registrarse.php" target="_top" class="Estilo12">Registrarse</a></td>
  </tr>
  <tr>
    <td bordercolor="#00FFCC" class="boton"><a href="#" class="Estilo12" onMouseover="showmenu(event,linkset[2])" onMouseout="delayhidemenu()">Links </a> </td>
  </tr>
</table>
<h4 class="Estilo25"><a href="Departamento/Untitled-2.php" target="_parent"></a></h4>
</body>
</html>
