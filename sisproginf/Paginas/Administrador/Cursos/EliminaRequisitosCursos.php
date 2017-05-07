<?php
   include('../../../funciones/conexion.php');
   $conexion = Conectarse();      
   $id       = $_GET['Id'];
   $desc     = $_GET['Desc'];
   $sql="Delete from requisitoscurso where ((IdCurso ='".$id."')and(Descripcion='".$desc."'))"; 
   $resultado = mysql_query($sql, $conexion);   
   $ifilas = mysql_affected_rows ($conexion);
   if($ifilas > 0 ){  
      echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= 'CursosBases.php'"; 
   	  echo "</script>";
	  exit; 
   }else{
        echo "<script>alert('No se Pudo Eliminar Registro. Intente de Nuevo');</script>";	
        echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	    echo "window.location.href= 'CursosBases.php'";
	    echo "</script>";
	    exit; 
   }        	   
?>

