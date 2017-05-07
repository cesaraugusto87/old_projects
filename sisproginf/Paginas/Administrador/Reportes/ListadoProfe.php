<?php
    include('../../../funciones/conexion.php');
    include('../../../funciones/transformfecha.php');
    $conexion = Conectarse();
    $sql_profesor ="select * from profesor Order by Nombre"; 
    $resultado_profesor  = mysql_query($sql_profesor , $conexion);
    $row_profesor  = mysql_fetch_assoc($resultado_profesor );
    $totalregistros = mysql_num_rows($resultado_profesor);  	  
?>
<html>
<head>   
<title>Documento sin t&iacute;tulo</title>
<link href="../../../funciones/estilo.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.Estilo22 {color: #FF0000}
.Estilo24 {BORDER-TOP: #51688d 1px solid; BORDER-LEFT: #51688d 1px solid; BORDER-BOTTOM: #51688d 1px solid; FONT-SIZE:10px; COLOR: #FF0000; FONT-FAMILY: Verdana, Arial, Helvetica, sans-serif; VERTICAL-ALIGN: middle; background-color: #EEEEEE; border-right: #51688d 1px solid;}
-->
</style>
</head>
<body>
<table width="731" border="5" align="center">
     
     <tr>
       <td colspan="4"><table width="688" border="0">
         <tr>
           <td width="102"><div align="center"><img src="../../../images/LOGOTRANS.jpg" alt="Logo" width="53" height="47"></div></td>
           <td width="440"><p align="center" class="Estilo11"><strong>Republica Bolivariana de Venezuela</strong><br>
                   <strong>Instituto Nacional de Capacitacion Educativa y  Socialista.<br>
                     Programa Informatica </strong><br>
           </p></td>
           <td width="132"><img src="../../../images/Sin t&iacute;tulo-1.png" alt="Sispro" width="132" height="31"></td>
         </tr>
       </table>
       </td>
     </tr>
     <tr>
       <td colspan="4"><div align="center" class="Estilo24 Estilo22">Listado de Profesores </div></td>
     </tr>
     <tr>
       <td colspan="4"><?php if ($totalregistros > 0){ $i=1;?>
	   <table width="656" border="1">
         <tr>
           <td width="2" class="boton Estilo22"><div align="center">No</div></td>
           <td width="30" class="boton Estilo22"><div align="center">Nombre</div></td>
           <td width="30" class="boton Estilo22"><div align="center">Apellido</div></td>
           <td width="10" class="boton Estilo22"><div align="center">Cedula</div></td>
           <td width="15" class="boton Estilo22"><div align="center">Telefono</div></td>
           <td width="50" class="boton Estilo22"><div align="center">E-mail</div></td>
           <td width="71" class="boton Estilo22"><div align="center">Curriculo</div></td>
           <td width="71" class="boton Estilo22"><div align="center">Ver Detalle </div></td>
         </tr>
         
           
           <?php do { ?>
		      <tr>
                 <td width="17" class="Estilo12"><div align="center"><? echo $i;?></div></td>
                 <td><div align="center"><? echo $row_profesor['Nombre'];?></div></td>
                 <td><div align="center"><? echo $row_profesor['Apellido'];?></div></td>
                 <td><div align="center"><? echo $row_profesor['Cedula'];?></div></td>
                 <td><div align="center"><? echo $row_profesor['Telf'];?></div></td>
                 <td><div align="center"><? echo $row_profesor['Email'];?></div></td>
                 <td class="Estilo3"><table width="68" border="1">
                   <tr>
                     <td class="boton"><a href="<?php $directorio ="../../../Archivos/"; echo $directorio.$row_profesor['Curriculo'] ?>"  target="_blank">Descargar</a></td>
                   </tr>
                 </table></td>
                 <td>
				    <div align="center">
					   <a href="../Usuarios/MuestraDatos2.php?Cedula=<? echo $row_profesor['Cedula']; ?>"><img src="../../../images/ojo.gif" width="26" height="16" border="0"></a> </div>		         </td>
			  </tr> 
           <?php $i=$i+1;}while ($row_profesor  = mysql_fetch_assoc($resultado_profesor )); ?>
       </table>
	   <?php 
			   }else{
			      echo"<span class='Estilo12'>No existen Profesores Registrados en el Sistema...</span>";
			   }
			?></td>
     </tr>
     <tr>
       <td colspan="4">&nbsp;</td>
     </tr>
     <tr>
       <td width="262">&nbsp;</td>
       <td width="79" class="boton"><div align="center"><a href="ListadoAspirantesProfe.php" target="_blank">Generar PDF</a> </div></td>
       <td width="57"><div align="center" class="boton"><a href="../Buzon/reportes.php">Regresar</a></div></td>
       <td width="308">&nbsp;</td>
     </tr>
</table>
</body>
</html>
