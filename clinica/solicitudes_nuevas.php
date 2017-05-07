<?php
include_once(dirname(__FILE__). "/libreria/nucleo/functions/import.php");
import("libreria.aplicacion.Pagina");
import("libreria.aplicacion.Credentials");
import("libreria.aplicacion.SolicitudWeb");
import("libreria.nucleo.SessionManager");
import("libreria.aplicacion.Solicitud");

$sesion = new Credentials();
$datos = $sesion->getCredentials();

if (isset($_GET["logout"]))	
{
	$sesion->logout();
}
	
if (!$sesion->haveAccess(1))
{
	header("Location: login.php");
	exit;
}


	$Web = new Solicitud();
	$sesionManager = new SessionManager();



	$sesionManager->setVar("solicitudes_n", $_POST);
	if(!isset($_GET["pagina"]))
	{
	$_GET["pagina"] = 1;
	}

if(isset($_GET["pagina"])) 
{
	$_POST = $sesionManager->getVar("solicitudes_n");
}


if ($_GET["pagina"] < 1)
{
	$_GET["pagina"] =1;
}

############ SE MUESTRAN LAS SOLICITUDES Y LOS NUMERO DE PAG. PERO NO PAGINA########
//$Web->obtenerNuevas($_GET["pagina"]);		
$resultado 		= 	$Web->getResultadosNuevas($datos->IdDepartamento);
$pagina= new Pagina();
$varsMenu["solicitudes_nuevas_on"] = 'class = "on"';
$varsMenu["num"] = $Web->contarNuevas($datos->IdDepartamento);
$pagina->setMenu( $datos->IdTipo, $varsMenu);
$pagina->setContenido( $tabs . $resultado . $script);
$pagina->render();

?>

