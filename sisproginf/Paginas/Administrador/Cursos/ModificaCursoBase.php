<?php
   $id = $_GET['Id'];
   if($id != ""){
      include('../../../funciones/conexion.php');
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
   if (isset($_POST['Modificar'])){
      $nombre   =   $_POST['CampoNombre'];
	  $descrip  =   $_POST['CampoDescripcion'];
	  echo $descrip;
	  	  
      $sql="UPDATE curso SET Nombre='".$nombre."', Descripcion='".$descrip."' WHERE ((IdCurso = '".$id."'))"; 		
	    
      $resultado = mysql_query($sql, $conexion);
      $registros = mysql_affected_rows ($conexion);
   	  if($registros > 0){
	     echo "<script>alert('Operacion realizada con Exito. Su Nueva Clave es: ".$nuevaclave."');</script>"; 
	     echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	     echo "window.location.href= 'DetalleCursoBase.php?Id=".$id."'";	   
	     echo "</script>";
	  }else{
	     echo "<script>alert('Error no se Pudo Modificar Curso...');</script>"; 
	     echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	     echo "window.location.href= 'DetalleCursoBase.php?Id=".$id."'";	   
	     echo "</script>";
	  }
   }
?>
<html>
<head>   
<title>Modificar la Informacion de los Curso Base...</title>
      <link href="../../../funciones/estilo.css" rel="stylesheet" type="text/css">
</head>
<body> 
   <form name="form1" method="post" action="">  
   <table width="545" border="1" align="center">
     <tr>
       <td><div align="center" class="Estilo16">Modificando: Curso Base Programa Informatica </div></td>
     </tr>
     <tr>
       <td><input type="hidden" name="Id" value=<?php echo $id; ?>></td>
     </tr>
     <tr>
       <td><table width="537" border="1">
         <tr>
           <td width="115" class="Estilo19">Nombre Curso </td>
           <td width="360" class="Estilo4">
               <input name="CampoNombre" value="<?php echo $row_cursos['Nombre']; ?>" type="text" size="30" maxlength="150">		   </td>
         </tr>
         <tr>
           <td class="Estilo19">Descripcion</td>
           <td class="Estilo4">
               <input name="CampoDescripcion" value="<?php echo $row_cursos['Descripcion']; ?>" type="text" size="60" maxlength="150">		   </td>
         </tr>
       </table></td>
     </tr>
     <tr>
       <td><table width="536" border="0">
         <tr>
           <td width="235">&nbsp;</td>
           <td width="51">
             <label>
               <input type="submit" name="Modificar" value="Modificar">
              </label>           </td>
           <td width="236">&nbsp;</td>
         </tr>
       </table></td>
     </tr>
     <tr>
       <td>&nbsp;</td>
     </tr>
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
					 <td class="Estilo4">
				   <div align="center">
				      <font color="#000000">
					     <a href="EliminaRequisitosCursos.php?Id=<?php echo $row_cursos['IdCurso']; ?>&Desc=<?php echo $row_requisitos['Descripcion']; ?>">
						    Eliminar					 </a>				      </font>				   </div>
				</td>
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
       <td><table width="536" border="0">
         <tr>
           <td width="137">&nbsp;</td>
           <td width="260"><div align="center" class="boton"><a href="CargaRequisitos2.php?Id=<?php echo $row_cursos['IdCurso']; ?>">Ingresar un Nuevo Requisito para este Curso </a></div></td>
           <td width="125">&nbsp;</td>
         </tr>
       </table></td>
     </tr>
     <tr>
       <td><table width="536" border="0">
         <tr>
           <td width="196">&nbsp;</td>
           <td width="70"><div align="center" class="boton"><a href="CursosBases.php">Atras</a></div></td>
           <td width="188">&nbsp;</td>
         </tr>
       </table></td>
     </tr>
   </table>
   </form>
</body>
</html>