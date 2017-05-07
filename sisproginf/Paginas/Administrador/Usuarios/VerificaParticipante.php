<?php
   include('../../../funciones/conexion.php');
   $conexion = Conectarse();   
   $autorizado = false; // Estado que indica que el usuario no est&aacute; autenficado 
   $cedula         =   $_POST['CampoCedula'];
   $tipousuario    =   $_POST['TipoUsuario'];
   $sql="select * from usuario where (CedulaUsuario ='".$cedula."')"; 
   $resultado = mysql_query($sql, $conexion);
   $row_usuario = mysql_fetch_assoc($resultado);
   $totalRows_usuario    =  mysql_num_rows($resultado);
   $ifilas = mysql_affected_rows ($conexion);
   if($ifilas > 0 ){  
      if ($tipousuario == 1){
	     Header("Location: MuestraDatosPersonales.php?Cedula=$cedula");
	  }
	  if ($tipousuario == 2){
	     Header("Location: Muestra.php?Cedula=$cedula");
	  }  
   }else{
        echo "<script>alert('No Existe Usuario...');</script>";	
        echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	    echo "window.location.href= 'logearse.php'";
	    echo "</script>";
	    exit; 
   }        	   
?>

