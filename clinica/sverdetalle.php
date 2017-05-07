<?php
include_once(dirname(__FILE__). "/libreria/nucleo/functions/import.php");
import("libreria.aplicacion.Pagina");
import("libreria.aplicacion.Credentials");
import("libreria.aplicacion.SolicitudWeb");
import("libreria.aplicacion.Solicitud");

$sesion = new Credentials();
$datos = $sesion->getCredentials();
$Web = new Solicitud();
	
if (isset($_GET["logout"]))
{
	$sesion->logout();
}

if (!$sesion->isLogged(3))
{
	header("Location: slogin.php");
	exit;
}



	
if ($sesion->haveAccess(3))
{

	$_POST["IdSolicitud"] = $_GET["idsolicitud"];

	$detalle = $Web->verDetalle($_POST);	
}

if ($sesion->haveAccess(2))
	{
	$_POST["IdSolicitud"] = $_GET["idsolicitud"];

	$detalle = $Web->verDetalleusu($_POST);
	}

if ($sesion->haveAccess(1))
	{
	$_POST["IdSolicitud"] = $_GET["idsolicitud"];

	$detalle = $Web->verDetalle($_POST);
	}

$pagina= new Pagina();
$varsMenu["solicitudes_on"] = 'class = "on"';
$varsMenu["num"] = $Web->contarNuevas($datos->IdDepartamento);
$pagina->setMenu( $datos->IdTipo, $varsMenu);
$pagina->setContenido( $detalle);
$pagina->render();

?>