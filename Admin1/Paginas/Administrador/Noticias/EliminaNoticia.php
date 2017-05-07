<?php
   include('../../../funciones/conexion.php');
   $conexion = Conectarse();      
   $id       = $_GET['Id'];
   $sql="Delete from noticias where (idnoti ='".$id."')"; 
   $resultado = pg_query($sql);   
   $ifilas = pg_affected_rows ($resultado);
   if($ifilas > 0 ){  
      echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= 'TableroNoticias.php'"; 
   	  echo "</script>";
	  exit; 
   }else{
      echo "<script>alert('No se Pudo Eliminar Registro. Intente de Nuevo');</script>";	
      echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= 'TableroNoticias.php'";
	  echo "</script>";
	  exit; 
   }            	   
?>

