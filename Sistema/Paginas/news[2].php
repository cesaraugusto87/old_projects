<?php
   include('../funciones/conexion.php');
   include('../funciones/transformfecha.php');
   $conexion = Conectarse();  
   $sql="Select * from noticias order by Fecha,Titulo"; 		
   $resultado = pg_query($sql);
   $totalregistros = pg_num_rows($resultado);
   $row_noticia = pg_fetch_assoc($resultado);   
?>
<html>
   <head>
      <title>=== Sistema de Cintoteca - Banco Guayana, C.A. ===</title>
      <meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1'>
      <meta name='description' content='universidad nacional experimental de guayana'>
      <meta name='keywords' content='educacion, planificacion, didactica, metodologia, carta didactica, guion de clases, clase, profesor, maestro, escuela, primaria, secundaria, básica, recreacion, dinamica, carrera, impulsion, reglamento, tradicional, oriental, sistema de competencia, bay, llave'>
      
      <script type='text/javascript' src='file:///E|/includes/jscript.js'></script>
      <link href="../funciones/estilo.css" rel="stylesheet" type="text/css">
   </head>

<body bgcolor='#EDEEEC' text='#000000'>
   <table class='bodyline' border='0' cellspacing='0' width='100%' cellpadding='0'>
      <tr>
        <td><table width='100%' cellpadding='0' cellspacing='0' border='0' align='center'><tr valign='top'><td valign='middle' align='center'><table width='559' cellpadding='4' bgcolor='#EDEEEC' cellspacing='0' border='8'>
          <td valign='top' class='side-border-left'><div align="center">
             <table border='0' style='border: 1px solid #C5CAD4' cellspacing='1' width='81%' cellpadding='3'>
             <tr>
                <td class='panel-header'>
                   <div align="center"><span class="Estilo16">Novedades del Sistema..... </span><br>
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
						             <a href='Noticias/DetalleNoticia.php?Id=<? echo $row_noticia['idnoti']?>' title='Shimbad' class='side'>
						                <? echo $row_noticia['titulo']?>	
							         </a>
							      </td>
				                  <td width="23%" rowspan="2" align='center' valign="middle" class='side-small'>
						             <? echo cambiaf_a_normal($row_noticia['fecha']);?>
					              </td>
                               </tr>
		                       <tr>
		                          <td align='left' valign="middle" class='side-small'>
						             <? echo $row_noticia['resumen']?>						 
							      </td>
		                       </tr>
							   <tr>
							      <td>&nbsp;</td>
							   </tr>
							   <tr>
							      <td>&nbsp;</td>
							   </tr>
				         <?php 
						    
						    }while($row_noticia = pg_fetch_assoc($resultado));?>      	
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
      </div></td>
      </tr>
</table>
</td></tr></table>
</body>
</html>
