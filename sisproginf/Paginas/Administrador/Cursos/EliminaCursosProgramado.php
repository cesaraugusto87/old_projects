<?php
   include('../../../funciones/conexion.php');
   $conexion = Conectarse();      
   $id       = $_GET['Id'];
   $Sec      = $_GET['Sec'];
   $sql="Delete from ofertacurso where ((IdCursos='".$id."')and(Secuencia='".$Sec."'))"; 
   $resultado = mysql_query($sql, $conexion);   
   $ifilas = mysql_affected_rows ($conexion);
   if($ifilas > 0 ){  
      echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= '../../Administrador/Buzon/Tablero.php'"; 
   	  echo "</script>";
	  exit; 		 
   }else{
      echo "<script>alert('No se Pudo Eliminar Registro. Intente de Nuevo');</script>";	
      echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
      echo "window.location.href= '../../Administrador/Buzon/Tablero.php'";
	  echo "</script>";
	  exit; 
   }        	   
?>

