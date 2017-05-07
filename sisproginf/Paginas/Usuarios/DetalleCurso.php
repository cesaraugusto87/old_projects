<?php
   $id = $_GET['Id'];
   if($id != ""){
      include('../../funciones/conexion.php');
      $conexion = Conectarse();
      $sql="select * from curso where (IdCurso='".$id."')"; 
      $resultado = mysql_query($sql, $conexion);
      $row_cursos = mysql_fetch_assoc($resultado);
	  $sql2="select * from requisitoscurso where (IdCurso='".$id."')"; 
      $resultado2 = mysql_query($sql2, $conexion);
      $row_requisitos = mysql_fetch_assoc($resultado2);
	  $totalregistros = mysql_num_rows($resultado2);
   }else{
      echo "<script>alert('No se Encontraron Cursos en el Sistema');</script>";
	  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";	       
	  echo "window.location.href= 'AdminCursos.php'";	   
	  echo "</script>";
	  exit;
   }
?>
<html>
<head>   
<title>Ingresando Curso Base...</title>
      <link href="../../funciones/estilo.css" rel="stylesheet" type="text/css">
</head>
<body>   
   <table width="545" border="1" align="center">
     <tr>
       <td><div align="center"><span class="Estilo16">Requisitos Para Este  Curso</span></div></td>
     </tr>
     
     <tr>
       <td><table width="537" border="1">
         <tr>
		    <?php if ($totalregistros > 0){?> 
			   <?php do { ?>   
			      <tr>
                     <td class="Estilo12"><li><?php echo $row_requisitos['Descripcion'];?></li></td>
		          </tr>
			   <?php }while ($row_requisitos = mysql_fetch_assoc($resultado2)); ?>      		  
			<?php 
			   }else{
			      echo"<span class='Estilo12'>No existen Requisitos Para este Curso</span>";
			   }
			?>
         </tr>
       </table></td>
     </tr>
     
     
     <tr>
       <td>&nbsp;</td>
     </tr>
     <tr>
       <td><table width="536" border="0">
         <tr>
           <td width="235">&nbsp;</td>
           <td width="69"><div align="center" class="boton"><a href="BuzonEntrada.php">Regresar</a></div></td>
           <td width="218">&nbsp;</td>
         </tr>
       </table></td>
     </tr>
   </table>
</body>
</html>