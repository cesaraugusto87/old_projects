<?php

   include('conexion.php');
   $conexion = Conectarse();
   $autorizado = false; // Estado que indica que el usuario no est&aacute; autenficado
   $login         =   $_POST['CampoLogin'];
   $clave         =   $_POST['CampoClave'];
   $sql="SELECT * FROM seguridad WHERE (login = '".$login."')"; 
   
   $resultado = pg_query($sql);
   $row_usuario = pg_fetch_assoc($resultado);
   $totalRows_usuario    =  pg_num_rows($resultado);
	
   if($totalRows_usuario > 0 ){

     if($row_usuario['password'] != $clave){
	    echo "<script>alert('Error CLave Incorrecta Intente de Nuevo...');</script>";	
        echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	    echo "window.location.href= '../Paginas/logearse.php'";
	    echo "</script>";
	    exit; 
	 }else{  
        session_start();
	    //inicializamos las dos variables de sesi�n
        $_SESSION['usuario']     = $row_usuario['ci'];
		$_SESSION['tipo'] = $row_usuario['tipo'];
        if ($row_usuario['tipo'] == 5){
		   Header("Location: ../Paginas/Administrador/Buzon/BuzonAdministrador.php");
		}else{
		   if ($row_usuario['tipo'] == 1){
		      Header("Location: ../Paginas/usuarios/BandejaEntrada.php");
		   }else{
		   if ($row_usuario['tipo'] == 2){
		      Header("Location: ../Paginas/usuarios/BandejaEntradaProfesor.php");
		   }}
		}
	 }
  }else{
     echo "<script>alert('No Existe Usuario Registrese como Nuevo...');</script>";	
     echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	 echo "window.location.href= '../paginas/logearse.php'";
	 echo "</script>";

	 exit; 

  }        	   

?>