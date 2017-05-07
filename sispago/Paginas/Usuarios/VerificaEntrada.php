<?php
   include('../../funciones/conexion.php');
   $conexion = Conectarse();   
   $autorizado = false; // Estado que indica que el usuario no est&aacute; autenficado 
   $login         =   $_POST['CampoLogin'];
   $clave         =   $_POST['CampoClave'];
   $sql="select * from seguridad where (login ='".$login."')";
   $resultado = mysql_query($sql, $conexion);
   $row_usuario = mysql_fetch_assoc($resultado);
   $totalRows_usuario    =  mysql_num_rows($resultado);
   $ifilas = mysql_affected_rows ($conexion);
   if($ifilas > 0 ){
     if($row_usuario['password'] != $clave){
	    echo "<script>alert('Error CLave Incorrecta Intente de Nuevo...');</script>";	
        echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	    echo "window.location.href= 'logearse.php'";
	    echo "</script>";
	    exit; 
	 }else{  
        session_start();	    
	    //inicializamos las dos variables de sesión
        $_SESSION['Usuario']     = $row_usuario['login'];	
		$_SESSION['tipo'] = $row_usuario['tipo']; 
        if ($row_usuario['tipo'] == 5){
		   Header("Location: ../Administrador/Buzon/BuzonAdministrador.php");
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