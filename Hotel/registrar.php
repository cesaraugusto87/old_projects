<?php
include_once(dirname(__FILE__). "/libreria/nucleo/functions/import.php");
import("libreria.aplicacion.Pagina");
import("libreria.aplicacion.Credentials");
import("libreria.aplicacion.RegistroWeb");
import("libreria.aplicacion.Registro");
	
$sesion = new Credentials();
$datos = $sesion->getCredentials();


	
$Web = new Registro();
$ver = new RegistroWeb();


$pagina= new Pagina();

$varsMenu["solicitudes_on"] = 'class = "on"';

//$pagina->setMenu( $datos->IdTipo);

	$_POST["IdPaciente"] = $_GET["paciente"];

		if (isset($_POST["Registrar"]))
		{
			
			$formRegistrar 	= 	$Web->agregar($_POST);
			$ver = $Web->verDetalle($_GET["paciente"]);
			
			$pagina->setMenu( $datos->IdTipo, $varsMenu);
			
			$varsTabs["tabs"] = $pagina->getSubmenu("submenu_registros");
			$varsTabs["targets"] = $formRegistrar;
			$tabs = $pagina->getTabs($varsTabs);
			$pagina->setContenido($ver. $tabs);
			$pagina->render();
		
		}
		else 
		{
			/*echo "<pre>";
			print_r($_POST);
			echo "</pre>";*/
			
			$formAgregar = $ver->getFormAgregar($_POST);
			$ver = $Web->verDetalle($_GET["paciente"]);
			
			$pagina->setMenu( $datos->IdTipo, $varsMenu);
			
			$varsTabs["tabs"] = $pagina->getSubmenu("submenu_registros");
			$varsTabs["targets"] = $formAgregar;
			$tabs = $pagina->getTabs($varsTabs);
			$pagina->setContenido( $ver . $tabs);
			$pagina->render();
			
			
		}



?>