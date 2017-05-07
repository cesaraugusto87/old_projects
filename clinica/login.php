<?php

include_once(dirname(__FILE__). "/libreria/nucleo/functions/import.php");
import("libreria.aplicacion.Pagina");
import("libreria.aplicacion.Credentials");
import("libreria.nucleo.classes.Utils");

$pagina= new Pagina();


$contenido = $pagina->getLogin($_POST);
$c = new Credentials();


if (isset($_GET["logout"]))
{
	$c->logout();
}

if ($c->login($_POST["nombre"], $_POST["pswd"]))
{
	if ($c->haveAccess(1))
	{
		header("Location: solicitudes_nuevas.php");
		exit;
	}
	
	if ($c->haveAccess(2))
	{
		header("Location: solicitudes_usuarios.php");
		exit;
	}
	if ($c->haveAccess(3))
	{
		header("Location: ssolicitudes_nuevas.php");
		exit;
	}
	
	
}
else
{

	if (isset($_POST["nombre"]))
	{
	echo "<script> alert('Error! Nombre de Usuario o Contraseña invalido'); </script>";
	}
}

$pagina->setContenido($contenido);
$pagina->render();

?>