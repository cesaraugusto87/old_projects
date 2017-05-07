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
	header("Location: login.php");
	exit;
}

	


$Web = new Solicitud();

$sesionManager = new SessionManager();


	$sesionManager->setVar("solicitudes_usuarios", $_POST);
	
	if(!isset($_GET["pagina"]))
	{
	$_GET["pagina"] = 1;
	}


if(isset($_GET["pagina"])) 
{
	$_POST = $sesionManager->getVar("solicitudes_usuarios");
}


if ($_GET["pagina"] < 1)
{
	$_GET["pagina"] =1;
}

$_POST["adjunto"] = $_FILES["adjunto"];

$formAgregar 	= 	$Web->agregar($_POST);
$usuario = $datos->IdUsuario;
$formBuscar  	= 	$Web->buscarSolicitudesUsuario($_POST,$_GET["pagina"],$usuario);
$resultado 		= 	$Web->getResultados($usuario);
$pagina= new Pagina();
$varsMenu["CrearSolicitudes_on"] = 'class = "on"';
$varsMenu["num"] = $Web->contarNuevas($datos->IdDepartamento);
$pagina->setMenu( $datos->IdTipo,$varsMenu);
//$pagina->setSubmenu( "submenu_solicitudes_usuario");

$script = "<script>tab('formAgregar', 'btnAgregar');</script>";

$varsTabs["tabs"] = $pagina->getSubmenu("submenu_solicitudes_usuario");
$varsTabs["targets"] = $formAgregar . $formBuscar;
$tabs = $pagina->getTabs($varsTabs);

$pagina->setContenido($tabs . $resultado . $script);
$pagina->render();


?>

