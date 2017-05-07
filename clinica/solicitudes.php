<?php
include_once(dirname(__FILE__). "/libreria/nucleo/functions/import.php");
import("libreria.aplicacion.Pagina");
import("libreria.aplicacion.Credentials");
import("libreria.nucleo.SessionManager");
import("libreria.aplicacion.SolicitudWeb");
import("libreria.aplicacion.Solicitud");

$sesion = new Credentials();
$datos = $sesion->getCredentials();




if (isset($_GET["logout"]))	
{
	$sesion->logout();
}
	
if ((!$sesion->haveAccess(1))or(!$sesion->haveAccess(3)))
{
	header("Location: login.php");
	exit;
}

	
	
$Web = new Solicitud();

$sesionManager = new SessionManager();
$sesionManager->setVar("solicitudes_buscar", $_POST);

if (isset($_POST["buscar"]))
{
	$sesionManager->setVar("solicitudes_buscar", $_POST);
	
	if(!isset($_GET["pagina"]))
	{
	$_GET["pagina"] = 1;
	}
}

if(isset($_GET["pagina"])) 
{
	$_POST = $sesionManager->getVar("solicitudes_buscar");
}


if ($_GET["pagina"] < 1)
{
	$_GET["pagina"] =1;
}




$formBuscar  	= 	$Web->buscar($_POST, $_GET["pagina"],$datos->IdDepartamento);
$resultado 		= 	$Web->getResultadosAdministrador($datos->IdDepartamento);
$pagina= new Pagina();
$varsMenu["solicitudes_on"] = 'class = "on"';
$varsMenu["num"] = $Web->contarNuevas($datos->IdDepartamento);

$pagina->setMenu( $datos->IdTipo, $varsMenu);
//$pagina->setSubmenu("submenu_solicitudes_administrador");
$script = "<script>tab('formSearch', 'btnBuscar');</script>";

$varsTabs["tabs"] = $pagina->getSubmenu("submenu_solicitudes_administrador");
$varsTabs["targets"] = $formBuscar;
	
$tabs = $pagina->getTabs($varsTabs);

$pagina->setContenido( $tabs . $resultado . $script);
$pagina->render();

?>
