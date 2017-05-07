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
   $sql="UPDATE noticias SET status='".$nuevoestado."' where (idnoti='".$id."')"; 		
   $resultado = pg_query($sql);
   $registros = pg_affected_rows ($resultado);
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

