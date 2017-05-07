<?php
   $id    = $_GET['Id'];
   $estado   = $_GET['Estado'];   
   if($estado == 0){
      $nuevoestado =1;
   }else{
      $nuevoestado =0;
   }
   include('../../../funciones/conexion.php');
   $conexion = Conectarse(); 
   $sql="UPDATE noticias SET Status='".$nuevoestado."' where (IdNoti='".$id."')"; 		
   $resultado = mysql_query($sql, $conexion);
   $registros = mysql_affected_rows ($conexion);
   if($registros > 0){
      echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= 'TableroNoticias.php'";
	  echo "</script>";
	  exit;    
   }else{
      echo "<script>alert('No se Pudo Cambiar estado Intete de Nuevo.....');</script>";	
      echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= 'TableroNoticias.php'";
	  echo "</script>";
	  exit; 
   }        	   
?>

