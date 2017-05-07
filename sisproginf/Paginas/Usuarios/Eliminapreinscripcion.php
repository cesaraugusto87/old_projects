<?php
   include('../../funciones/conexion.php');
   $conexion = Conectarse();      
   $cedula       = $_GET['Cedula'];
   $sql="Delete from preinscripcion where (CedulaUsuario='".$cedula."')"; 
   $resultado = mysql_query($sql, $conexion);   
   $ifilas = mysql_affected_rows ($conexion);
   if($ifilas > 0 ){  
      echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= 'BandejaEntrada.php'"; 
   	  echo "</script>";
	  exit; 		 
   }else{
      echo "<script>alert('No se Pudo Eliminar Registro. Intente de Nuevo');</script>";	
      echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
      echo "window.location.href= 'BandejaEntrada.php'";
	  echo "</script>";
	  exit; 
   }        	   
?>

