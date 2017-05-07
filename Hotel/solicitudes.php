<?php
include_once(dirname(__FILE__). "/libreria/nucleo/functions/import.php");
import("libreria.aplicacion.Pagina");
import("libreria.aplicacion.Credentials");
import("libreria.aplicacion.RegistroWeb");
import("libreria.aplicacion.Registro");

$sesion = new Credentials();
$datos = $sesion->getCredentials();

	
	
$Web = new Registro();

$formAgregar  	= 	$Web->preparar($_POST["Cedula"]);

$complemento 		= 	$Web->agregar($_POST);
$pagina= new Pagina();
$varsMenu["solicitudes_on"] = 'class = "on"';


$pagina->setMenu( $datos->IdTipo, $varsMenu);
//$pagina->setSubmenu("submenu_solicitudes_administrador");
$script = "<script>tab('formSearch', 'btnBuscar');</script>";

$varsTabs["tabs"] = $pagina->getSubmenu("submenu_registros");
$varsTabs["targets"] = $formAgregar ;
	
$tabs = $pagina->getTabs($varsTabs);

$pagina->setContenido( $tabs . $resultado . $script);
$pagina->render();

?>

