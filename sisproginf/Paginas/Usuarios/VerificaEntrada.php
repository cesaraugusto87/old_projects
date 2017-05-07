<?php
   include('../../funciones/conexion.php');
   $conexion = Conectarse();   
   $autorizado = false; // Estado que indica que el usuario no est&aacute; autenficado 
   $login         =   $_POST['CampoLogin'];
   $clave         =   $_POST['CampoClave'];
   $sql="select * from usuario where (Login ='".$login."')"; 
   $resultado = mysql_query($sql, $conexion);
   $row_usuario = mysql_fetch_assoc($resultado);
   $totalRows_usuario    =  mysql_num_rows($resultado);
   $ifilas = mysql_affected_rows ($conexion);
   if($ifilas > 0 ){
     if($row_usuario['Password'] != $clave){
	    echo "<script>alert('Error CLave Incorrecta Intente de Nuevo...');</script>";	
        echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	    echo "window.location.href= 'logearse.php'";
	    echo "</script>";
	    exit; 
	 }else{  
        session_start();	    
	    //inicializamos las dos variables de sesión
        $_SESSION['Usuario']     = $row_usuario['CedulaUsuario'];	
		$_SESSION['TipoUsuario'] = $row_usuario['TipoUsuario'];	 
        if ($row_usuario['TipoUsuario'] == 5){
		   Header("Location: ../Administrador/Buzon/BuzonAdministrador.php");
		}else{
		   if ($row_usuario['TipoUsuario'] == 1){
		      Header("Location: ../Usuarios/BandejaEntrada.php");
		   }else{
		      Header("Location: ../Usuarios/BandejaEntradaProfe.php");
		   }
		}
	 }
  }else{
     echo "<script>alert('No Existe Usuario Registrese como Nuevo...');</script>";	
     echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	 echo "window.location.href= 'logearse.php'";
	 echo "</script>";
	 exit; 
  }        	   
?>