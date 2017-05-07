<?php
   $id  = $_GET['Id'];
   $sec = $_GET['Sec'];
   include('../../../funciones/conexion.php');
   include('../../../funciones/transformfecha.php');
   $conexion = Conectarse();
	  
	  $sql_curso_base="select * from curso where (IdCurso='".$id."')"; 
      $resultado_curso_base = mysql_query($sql_curso_base, $conexion);
      $row_cursos_Base = mysql_fetch_assoc($resultado_curso_base);

	  $sql_oferta="select * from ofertacurso where ((IdCursos='".$id."')and(Secuencia='".$sec."'))"; 
      $resultado_oferta = mysql_query($sql_oferta, $conexion);
      $row_oferta_curso = mysql_fetch_assoc($resultado_oferta);
	  
	  $sql_Requisitos="select * from requisitoscurso where (IdCurso='".$id."')"; 
      $resultado_Requisitos = mysql_query($sql_Requisitos, $conexion);
      $row_requisitos = mysql_fetch_assoc($resultado_Requisitos);
	  $totalregistros = mysql_num_rows($resultado_Requisitos);

?>
<html>
<head>   
<title>Ingresando Curso Base...</title>
      <link href="../../../funciones/estilo.css" rel="stylesheet" type="text/css">
</head>
<body>   
   <table width="545" border="1" align="center">
     <tr>
       <td><div align="center" class="Estilo16">Consulta: Curso Base Programa Informatica </div></td>
     </tr>
     <tr>
       <td>&nbsp;</td>
     </tr>
     <tr>
       <td><table width="537" border="1">
         <tr>
           <td width="115" class="Estilo19">Nombre Curso </td>
           <td width="360" class="Estilo12">
               <?php echo $row_cursos_Base['Nombre']; ?>		   </td>
         </tr>
         <tr>
           <td class="Estilo19">Secuencia</td>
           <td class="Estilo12"><?php echo $sec ?></td>
         </tr>
         <tr>
           <td class="Estilo19">Fecha Inicio </td>
           <td class="Estilo12"><?php echo cambiaf_a_normal($row_oferta_curso['FechaIni']); ?></td>
         </tr>
         <tr>
           <td class="Estilo19">Fecha Finalizacion </td>
           <td class="Estilo12"><?php echo cambiaf_a_normal($row_oferta_curso['FechaFin']); ?></td>
         </tr>
         <tr>
           <td class="Estilo19">Duracion</td>
           <td class="Estilo12"><?php echo $row_oferta_curso['Duracion']; ?></td>
         </tr>
         <tr>
           <td class="Estilo19">Cupos</td>
           <td class="Estilo12"><?php echo $row_oferta_curso['Cupos']; ?></td>
         </tr>
         <tr>
           <td class="Estilo19">Turno</td>
           <td class="Estilo12"><?php echo $row_oferta_curso['Turno']; ?></td>
         </tr>
       </table></td>
     </tr>
     
       <tr>
         <td><div align="center"><span class="Estilo16">Requisitos Para Curso</span></div></td>
        
       <tr>
         <td><table width="537" border="1">
         <tr>
		    <?php if ($totalregistros > 0){?> 
			   <?php do { ?>   
			      <tr>
                     <td class="Estilo12"><li><?php echo $row_requisitos['Descripcion'];?></li></td>
		          </tr>
			   <?php }while ($row_requisitos = mysql_fetch_assoc($resultado_Requisitos)); ?>      		  
			<?php 
			   }else{
			      echo"<span class='Estilo12'>No existen Requisitos Para este Curso</span>";
			   }
			?>
         </tr>
       </table></td>
       </tr>
     
     <tr>
       <td><table width="536" border="0">
         <tr>
           <td width="235">&nbsp;</td>
           <td width="69"><div align="center" class="boton"><a href="../Buzon/Tablero.php">Regresar</a></div></td>
           <td width="218">&nbsp;</td>
         </tr>
       </table></td>
     </tr>
   </table>
</body>
</html>