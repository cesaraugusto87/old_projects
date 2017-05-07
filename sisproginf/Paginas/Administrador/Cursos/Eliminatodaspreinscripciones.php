<?php
   include('../../../funciones/conexion.php');
   $conexion = Conectarse();      
   $cedula       = $_GET['Cedula'];
   $sql="Delete from preinscripcion')"; 
   $resultado = mysql_query($sql, $conexion);   
   $ifilas = mysql_affected_rows ($conexion);
   if($ifilas > 0 ){  
      echo "<script>alert('PreInscripciones Eliminadas...');</script>";
      echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= '../Usuarios/PideCedula.php'"; 
   	  echo "</script>";
	  exit; 		 
   }else{
      echo "<script>alert('No se Pudo Eliminar Registro. Intente de Nuevo');</script>";	
      echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
      echo "window.location.href= '../Usuarios/PideCedula.php'";
	  echo "</script>";
	  exit; 
   }        	   
?>

