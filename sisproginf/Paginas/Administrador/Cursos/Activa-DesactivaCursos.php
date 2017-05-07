<?php
   $curso    = $_GET['IdCurso'];
   $sec      = $_GET['Sec'];
   $estado   = $_GET['Est'];   
   if($estado == 0){
      $nuevoestado =1;
   }else{
      $nuevoestado =0;
   }
   include('../../../funciones/conexion.php');
   $conexion = Conectarse(); 
   mysql_query("UPDATE ofertacurso SET Status='".$nuevoestado."' where ((IdCursos='".$curso."')and(Secuencia='".$sec."'))",$conexion);
   $registros = mysql_affected_rows ($conexion);
   if($registros == 1){
      echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= '../../Administrador/Buzon/Tablero.php'";
	  echo "</script>";
	  exit;    
   }else{
      echo "<script>alert('No se Pudo Cambiar estado Intete de Nuevo.....');</script>";	
      echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= '../../Administrador/Buzon/Tablero.php'";
	  echo "</script>";
	  exit; 
   }        	   
?>

