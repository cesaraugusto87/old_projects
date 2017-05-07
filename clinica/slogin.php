<?php

include_once(dirname(__FILE__). "/libreria/nucleo/functions/import.php");
import("libreria.aplicacion.Pagina");
import("libreria.aplicacion.Credentials");
import("libreria.nucleo.classes.Utils");

$pagina= new Pagina();


$contenido = $pagina->getLogin($_POST);
$c = new Credentials();

if ($c->login($_POST["nombre"], $_POST["pswd"]))
{
	if ($c->haveAccess(3))
	{
		header("Location: ssolicitudes_nuevas.php");
		
	}

	
}
else
{

	if (isset($_POST["nombre"]))
	{
	echo "<script> alert('Error! Usted no es un Administrador del Sistema'); </script>";
		echo "<head><meta http-equiv=\"refresh\" content=\"0;URL=../../../clinica/login.php\"></head>";
	}
}

$pagina->setContenido($contenido);
$pagina->render();

?>