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


if(!isset($_GET["pagina"]))
{
$_GET["pagina"] = 1;
}



	$_POST = $sesionManager->getVar("solicitudes_buscar");



if ($_GET["pagina"] < 1)
{
	$_GET["pagina"] =1;
}

$Web = new Solicitud();
$Web->buscar($_POST, $_GET["pagina"],$datos->IdDepartamento);
$resultado 		= 	$Web->getImprimirAdministrador($datos->IdDepartamento);

$pagina= new PaginaImprimir();

$pagina->setContenido($resultado);
$pagina->render();
###########enviar por la url el resultado que se va imprimir#################
?>