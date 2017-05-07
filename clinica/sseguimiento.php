<?php
include_once(dirname(__FILE__). "/libreria/nucleo/functions/import.php");
import("libreria.aplicacion.Pagina");
import("libreria.aplicacion.Credentials");
import("libreria.aplicacion.SolicitudWeb");
import("libreria.aplicacion.Solicitud");

$sesion = new Credentials();
$datos = $sesion->getCredentials();
	

	
if (isset($_GET["logout"]))	
{
	$sesion->logout();
}
	
	
if (!$sesion->haveAccess(3))
{
	header("Location: slogin.php");
	exit;
}

	
	
$Web = new Solicitud();




$pagina= new Pagina();
$varsMenu["solicitudes_on"] = 'class = "on"';
$varsMenu["num"] = $Web->contarNuevas($datos->IdDepartamento);
$pagina->setMenu( $datos->IdTipo, $varsMenu);
//$pagina->setMenu( $datos->IdTipo);

$_POST["IdSolicitud"] = $_GET["idsolicitud"];
$_POST["adjunto"] = $_FILES["adjunto"];
$formAtender 	= 	$Web->atender($_POST);

if (Solicitud::esNuevaSolicitud($_GET["idsolicitud"]))
{
	
	
	
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
	
	$varsTabs["tabs"] = $pagina->getSubmenu("submenu_seguimiento");
	$varsTabs["targets"] = $formAtender;
	$tabs = $pagina->getTabs($varsTabs);
}
else
{
	//$_POST["IdSolicitud"] = $_GET["Idsolicitud"];
	$tabs = $Web->verDetalleusu($_POST);
}

$pagina->setContenido( $detalle. $tabs);
$pagina->render();

?>