<?php
session_start();
include("../conexion/conectar.php");

if( !empty($_POST['login']) and !empty($_POST['clave'])){

	$parametro['usuario'] = array('usuario'=>$_POST['login'],'clave'=>$_POST['clave']);

	$result=pg_query("SELECT *
							FROM usuarios
							where (login='".$parametro['usuario']['usuario']."' and passwd='".$parametro['usuario']['clave']."')");
	$fila = pg_fetch_array($result);

	if ($fila!=NULL){
		
		// Si están en la base de datos registra la id de usuario
		$parametro['nivel'] = array('nivel'=>$fila['nivel']);

		// Variables de Sesion
		$_SESSION['sesion'] = $parametro;

		header('Location:../../index.php');
	}
	// Usuario o Contraseña Inválida
	else{
		$mensaje = array('titulo'=>'Error: Fallo de Autenticacion',
					'descripcion'=>'Usuario o clave no validos');
		
		$_SESSION['mensaje'] = $mensaje;
		
		header('Location:../../index.php');
	}
}
else{
	$mensaje = array('titulo'=>'Error: Fallo de Autenticacion',
				'descripcion'=>'Debe insertar un usuario y clave validos');
		
	$_SESSION['mensaje'] = $mensaje;

	header('Location:../../index.php');
}
?>
