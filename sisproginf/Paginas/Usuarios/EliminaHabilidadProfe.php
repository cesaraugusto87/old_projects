<?php
   include('../../funciones/conexion.php');
   include('../../funciones/transformfecha.php');
   $conexion = Conectarse();   
   session_start();
   $cedula   =  $_SESSION['Usuario'];
   $Tipo     =  $_SESSION['TipoUsuario'];
   if ($Tipo == 5){
      $cedula      =  $_GET['Cedula'];
   }
   $hab      =  $_GET['Hab'];
   $sql="Delete from habilidades where ((CedulaProfe='".$cedula."')and(Descripcion='".$hab."'))"; 
   $resultado = mysql_query($sql, $conexion);   
   $ifilas = mysql_affected_rows ($conexion);
   if($ifilas > 0 ){  
      if ($Tipo == 5){
         echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	     echo "window.location.href= '../Administrador/Usuarios/MuestraDatos2.php'"; 
   	     echo "</script>";
	     exit; 		 
      }else{   
         echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	     echo "window.location.href= 'PerfilDatosProfe.php'"; 
   	     echo "</script>";
	     exit; 		 
	  }	 
   }else{
      if ($Tipo == 5){
         echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	     echo "window.location.href= '../Administrador/MuestraDatos2.php'"; 
   	     echo "</script>";
	     exit; 		 
      }else{   
         echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	     echo "window.location.href= 'PerfilDatosProfe.php'"; 
   	     echo "</script>";
	     exit; 		 
	  }
   }        	   
?>

