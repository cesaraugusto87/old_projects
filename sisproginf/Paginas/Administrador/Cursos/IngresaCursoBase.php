<?php
   if($_POST['Ingresar']){
      $nombre       =  $_POST['CampoNombre'];
	  $descripcion  =  $_POST['CampoDescripcion'];
	  include('../../../funciones/conexion.php');
      $conexion = Conectarse();
	  $sql="insert into curso  values('','".$nombre."','".$descripcion."')";	   
	  $resultado_set =  mysql_query($sql, $conexion );
	  $filas_r = mysql_affected_rows ($conexion);
	  if($filas_r > 0){
         echo "<script>alert('Curso INGRESADO correctamente');</script> "; 
         echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
         echo "window.location.href= 'CursosBases.php'";
         echo "</script>";
         exit; 
	  }else{
         echo "<script>alert('No se pudo GUARDAR los Datos Intente Mas tarde...');</script>";	
            echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
			echo "window.location.href= 'AdminCursos.php'";
			echo "</script>";
			exit; 
		}   
   }
   if($_POST['Ingresar2']){
      $nombre       =  $_POST['CampoNombre'];
	  $descripcion  =  $_POST['CampoDescripcion'];
	  include('../../../funciones/conexion.php');
      $conexion = Conectarse();
	  $sql="insert into curso  values('','".$nombre."','".$descripcion."')";	   
	  $resultado_set =  mysql_query($sql, $conexion );
	  $filas_r = mysql_affected_rows ($conexion);
	  if($filas_r > 0){
	     $sql="Select * from curso where ((Nombre='".$nombre."')and(Descripcion='".$descripcion."'))";
		 $resultado =  mysql_query($sql, $conexion );
	     $filas_r = mysql_affected_rows ($conexion);
		 $row_curso = mysql_fetch_assoc($resultado);
		 $idcurso = $row_curso['IdCurso']; 
         echo "<script>alert('Curso INGRESADO correctamente');</script> "; 
         echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
         echo "window.location.href= 'Cargarequisitos2.php?Id=$idcurso'";
         echo "</script>";
         exit; 
	  }else{
         echo "<script>alert('No se pudo GUARDAR los Datos Intente Mas tarde...');</script>";	
            echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
			echo "window.location.href= 'AdminCursos.php'";
			echo "</script>";
			exit; 
		}   
   }
?>
<html>
<head>   
<title>Ingresando Curso Base...</title>
      <link href="../../../funciones/estilo.css" rel="stylesheet" type="text/css">
</head>
<body>
   <form name="form1" method="post" action="">
   <table width="545" border="1" align="center">
     <tr>
       <td><div align="center" class="Estilo16">Ingresando Curso Base Programa Informatica </div></td>
     </tr>
     <tr>
       <td>&nbsp;</td>
     </tr>
     <tr>
       <td><table width="537" border="1">
         <tr>
           <td width="115" class="Estilo19">Nombre Curso </td>
           <td width="360" class="Estilo4">
               <input name="CampoNombre" type="text" size="30" maxlength="150">           </td>
         </tr>
         <tr>
           <td class="Estilo19">Descripcion</td>
           <td class="Estilo4">
               <input name="CampoDescripcion" type="text" size="60" maxlength="150">           </td>
         </tr>
       </table></td>
     </tr>
     <tr>
       <td>&nbsp;</td>
     </tr>
     <tr>
       <td><table width="536" border="0">
         <tr>
           <td width="61">&nbsp;</td>
           <td width="104"><label>
             <input name="Ingresar" type="Submit" class="boton" value="Ingresar y Salir">
           </label></td>
           <td width="248"><input name="Ingresar2" type="Submit" class="boton" value="Ingresar y Reportar Requisitos del Curso"></td>
           <td width="54"><div align="center" class="boton"><a href="CursosBases.php">Regresar</a></div></td>
           <td width="47">&nbsp;</td>
         </tr>
       </table></td>
     </tr>
   </table>
   </form>
</body>
</html>
