<?php
   include('../funciones/conexion.php');
   include('../funciones/transformfecha.php');
   $conexion = Conectarse();  
   $sql="Select * from noticias order by Fecha,Titulo"; 		
   $resultado = mysql_query($sql, $conexion);
   $totalregistros = mysql_num_rows($resultado);
   $row_noticia = mysql_fetch_assoc($resultado);   
?>
<html>
   <head>
      <title>== Programa Informatica == INCES == Pto Ordaz == Estado Bolivar ==</title>
      <meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1'>
      <meta name='description' content='Somos un grupo dedicado a difundir y desarrollar la práctica, investigación y enseñanza'>
      <meta name='keywords' content='educacion, planificacion, didactica, metodologia, carta didactica, guion de clases, clase, profesor, maestro, escuela, primaria, secundaria, básica, recreacion, dinamica, carrera, impulsion, reglamento, tradicional, oriental, sistema de competencia, bay, llave'>
      
      <script type='text/javascript' src='file:///E|/includes/jscript.js'></script>
      <link href="../funciones/estilo.css" rel="stylesheet" type="text/css">
   </head>

<body bgcolor='#EDEEEC' text='#000000'>
   <table class='bodyline' border='0' cellspacing='0' width='100%' cellpadding='0'>
      <tr>
        <td>
		    <table width='99%'  border='0' cellspacing='0' cellpadding='0'>     
			   <tr>
			      <td class='shadow'>&nbsp;</td>
		          <td width='50%' class='shadow'>&nbsp;</td>
				  <td class='shadow'>&nbsp;</td>
			   </tr>
			   <tr>
			      <td height="26" class='logonav'>&nbsp;</td>
                  <td class='logonav'>
				     <h5>
					    <div style='margin: 0px; border-bottom: 1px solid #666666;'>
                           <div align="center" class="Estilo11">
						      <b>Bienvenidos al Sistema para la Reservacion de Cupos</b>						   </div>
                        </div>
						<b>
						<center>
						   <script type="text/javascript">
  	                          //Delay que Cambia el Mensaje (En Milisegundos)
							  var delay = 7000;
							  // number of steps to take to change from start color to endcolor
		                      var maxsteps=30; 
							  // time in miliseconds of a single step
		                      var stepdelay=40; 
		                      //**Note: maxsteps*stepdelay will be total time in miliseconds of fading effect
   	                          var startcolor= new Array(255,255,255); // start color (red, green, blue)
		                      var endcolor=new Array(0,0,0); // end color (red, green, blue)
		                      var fcontent=new Array();
		                         begintag='<div style="font: normal 10px Verdana; padding: 5px;">';                                 
								 //set opening tag, such as font declarations
		                         
								 fcontent[0]="<b>Participa Activamente de Nuestro Sitio!</b><br><br>Si eres invitado y aún no te has registrado. haz clic <a href='../Paginas/Usuarios/logearse.php'><font color='red'>aquí</a></font>";
		                         
								 fcontent[1]="<b>Nuestros Cursos...</b><br><br>Deseas saber que cursos Ofrecemos haz clic <a href='../Paginas/Usuarios/Tablero.php'><font color='red'>aquí</a></font>";
								 
								 fcontent[2]="<b>¿ Como Reservar un Cupo ? </b><br><br>Si aun no sabes como Reservar un Cupo para un Curso. responde a tus preguntas haciendo clic <a href='forum/index.php'><font color='red'>aquí</a></font>";
		                         
								 
								 fcontent[3]="<b>¿No has podido ver nuestras Instalaciones?</b><br><br>Mira las fotos en la <a href='../Paginas/Departamento/PGaleria.php' target='_top'><font color='red'>Galería de Fotos</a></font> de SISPROGINF.";
								 
		closetag='</div>';
		var fwidth='450px'; //set scroller width
		var fheight='61px'; //set scroller height
		var fadelinks=1;  //should links inside scroller content also fade like text? 0 for no, 1 for yes.
		var ie4=document.all&&!document.getElementById;
		var DOM2=document.getElementById;
		var faderdelay=0;
		var index=0;
	function changecontent(){
	if (index>=fcontent.length)
	index=0
	if (DOM2){
	document.getElementById("fscroller").style.color="rgb("+startcolor[0]+", "+startcolor[1]+", "+startcolor[2]+")"
	document.getElementById("fscroller").innerHTML=begintag+fcontent[index]+closetag
	if (fadelinks)
	linkcolorchange(1);
	colorfade(1, 15);
}
		else if (ie4)
	document.all.fscroller.innerHTML=begintag+fcontent[index]+closetag;
	index++
	}

	// colorfade() partially by Marcio Galli for Netscape Communications.  ////////////
	// Modified by Dynamicdrive.com

	function linkcolorchange(step){
		var obj=document.getElementById("fscroller").getElementsByTagName("A");
		if (obj.length>0){
		for (i=0;i<obj.length;i++)
		obj[i].style.color=getstepcolor(step);
	}
}

/*Rafael Raposo edited function*/
		var fadecounter;
		function colorfade(step) {
		if(step<=maxsteps) {	
	document.getElementById("fscroller").style.color=getstepcolor(step);
		if (fadelinks)
		linkcolorchange(step);
		step++;
	fadecounter=setTimeout("colorfade("+step+")",stepdelay);
	}else{
	clearTimeout(fadecounter);
	document.getElementById("fscroller").style.color="rgb("+endcolor[0]+", "+endcolor[1]+", "+endcolor[2]+")";
	setTimeout("changecontent()", delay);
	}   
}

/*Rafael Raposo's new function*/
	function getstepcolor(step) {
		var diff
		var newcolor=new Array(3);
		for(var i=0;i<3;i++) {
		diff = (startcolor[i]-endcolor[i]);
		if(diff > 0) {
		newcolor[i] = startcolor[i]-(Math.round((diff/maxsteps))*step);
	} else {
		newcolor[i] = startcolor[i]+(Math.round((Math.abs(diff)/maxsteps))*step);
}
	}
		return ("rgb(" + newcolor[0] + ", " + newcolor[1] + ", " + newcolor[2] + ")");
}

if (ie4||DOM2)
	document.write('<div id="fscroller" style="border:0px solid #c5c5c5;width:'+fwidth+';height:'+fheight+'"></div>');
		if (window.addEventListener)
	window.addEventListener("load", changecontent, false)
	else if (window.attachEvent)
	window.attachEvent("onload", changecontent)
	else if (document.getElementById)
	window.onload=changecontent
</script></center></td><td class='logonav'>&nbsp;</td></tr></table>
      <hr width='82%'><br><table width='100%' cellpadding='0' cellspacing='0' border='0' align='center'><tr valign='top'><td valign='middle' align='center'><table width='559' cellpadding='4' bgcolor='#EDEEEC' cellspacing='0' border='8'><td valign='top' class='side-border-left'><div align="center">
             <table border='0' style='border: 1px solid #C5CAD4' cellspacing='1' width='81%' cellpadding='3'>
             <tr>
                <td class='panel-header'>
                   <div align="center"><span class="Estilo16">Noticias de Interes..... </span><br>
                     <hr width='100%'>
                   </div>              
			    </td>
             </tr>
		     <tr>
			    <td class='side-body' width='100%'>
                   <marquee scrollAmount='2' width='100%' height='100' direction='up'>
				   <table cellpadding='0' cellspacing='0' width='100%'>
		              <?php 
		                 if ($totalregistros > 0){
		              ?>
					     <?php 
						    do{ 
						 ?>  
		                       <tr>
                                  <td width="77%" align='left' valign="middle" class='side-small'>
						             <a href='../Paginas/Noticias/DetalleNoticia.php?Id=<? echo $row_noticia['IdNoti']?>' title='Shimbad' class='side'>
						                <? echo $row_noticia['Titulo']?>	
							         </a>
							      </td>
				                  <td width="23%" rowspan="2" align='center' valign="middle" class='side-small'>
						             <? echo cambiaf_a_normal($row_noticia['Fecha']);?>
					              </td>
                               </tr>
		                       <tr>
		                          <td align='left' valign="middle" class='side-small'>
						             <? echo $row_noticia['Resumen']?>						 
							      </td>
		                       </tr>
							   <tr>
							      <td>&nbsp;</td>
							   </tr>
							   <tr>
							      <td>&nbsp;</td>
							   </tr>
				         <?php 
						    
						    }while($row_noticia = mysql_fetch_assoc($resultado));?>      	
		              <?php 
		                 }else{
			                echo"<span class='Estilo12'>No existen Noticias que Mostrar en el Sistema...</span>";
		                 }
	                  ?>                                                
                   </table>
				   </marquee>
				</td>
		     </tr>
          </table>
        
        <script type='text/javascript' src='file:///E|/infusions/shoutbox_panel/functions.js'></script>
      </div></td>
      </tr>
</table>
</td></tr></table>
<br>
<hr width='82%'>
<table width="465" border="0" align="center">
      <tr>
            <td width="90"><img src="../images/1siluetas3d-caminante-thumb.gif" width="90" height="75"></td>
        <td width="12" class="Estilo15">+</td>
          <td width="90"><img src="../images/expo_business_island_computers_show_md_wht.gif" width="90" height="75"></td>
          <td width="12"><span class="Estilo15">+</span></td>
          <td width="90"><img src="../images/cable_data_transfer_md_wht.gif" width="90" height="39"></td>
          <td width="12"><span class="Estilo15">+</span></td>
          <td width="129"><img src="../images/cg1.gif" width="90" height="75"></td>
      </tr>
        </table>
        </body>
</html>
