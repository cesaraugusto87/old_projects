<?php
include_once(dirname(__FILE__). "/libreria/nucleo/functions/import.php");
import("libreria.aplicacion.PaginaImprimir");
import("libreria.aplicacion.Credentials");
import("libreria.nucleo.SessionManager");
import("libreria.aplicacion.SolicitudWeb");
import("libreria.aplicacion.Solicitud");
$sesion = new Credentials();
$datos = $sesion->getCredentials();
$sesionManager = new SessionManager();




$_POST = $sesionManager->getVar("solicitudes_buscars");


if(!isset($_GET["pagina"]))
{
$_GET["pagina"] = 1;
}




if ($_GET["pagina"] < 1)
{
	$_GET["pagina"] =1;
}

$Web = new Solicitud();
$Web->buscarSU($_POST, $_GET["pagina"]);
$resultado 		= 	$Web->getImprimir();

$pagina= new PaginaImprimir();

$pagina->setContenido($resultado);
$pagina->render();
###########enviar por la url el resultado que se va imprimir#################
?>