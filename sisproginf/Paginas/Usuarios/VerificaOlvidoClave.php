<?php
   include('../../funciones/conexion.php');
   $conexion = Conectarse();   
   $autorizado = false; // Estado que indica que el usuario no est&aacute; autenficado 
   $cedula         =   $_POST['CampoCedula'];
   $tipo           =   $_POST['Tipo'];
   $sql="select * from usuario where ((CedulaUsuario ='".$cedula."')and(TipoUsuario='".$tipo."'))"; 
   $resultado = mysql_query($sql, $conexion);
   $row_usuario = mysql_fetch_assoc($resultado);
   $totalRows_usuario    =  mysql_num_rows($resultado);
   $ifilas = mysql_affected_rows ($conexion);
   if($ifilas > 0 ){	 
	 $clave    =  $row_usuario['Password'];	 
	 $login    =  $row_usuario['Login'];	 
	 Header("Location: ver.php?Clave=$clave&Login=$login");
  }else{
     echo "<script>alert('No Existe ese Usuario...');</script>";	
     echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	 echo "window.location.href= 'logearse.php'";
	 echo "</script>";
	 exit; 
  }        	   
?>

