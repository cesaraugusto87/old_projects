<?php
include_once(dirname(__FILE__). "/libreria/nucleo/functions/import.php");
import("libreria.aplicacion.Pagina");
import("libreria.aplicacion.Credentials");
import("libreria.aplicacion.PacienteWeb");
import("libreria.aplicacion.RegistroWeb");
import("libreria.aplicacion.Paciente");
import("libreria.aplicacion.Registro");


$registro = new Registro();
$paciente = new Paciente();
$web = new RegistroWeb();
$sesionManager = new SessionManager();
$sesionManager->setVar("pacientes_buscar", $_POST);	
	
		if (isset($_POST["buscarced"]))
		{
		
		$sesionManager->setVar("pacientes_buscar", $_POST);
		
		if(!isset($_GET["pagina"]))
		{
		$_GET["pagina"] = 1;
		}
		
		if(isset($_GET["pagina"])) 
		{
			$_POST = $sesionManager->getVar("pacientes_buscar");
		}


		if ($_GET["pagina"] < 1)
		{
			$_GET["pagina"] =1;
		}
			
		
			$formBuscar = $registro->getbuscarh($_POST,$_GET["pagina"]);
			$page = new Pagina();
			$page->setDir("");
			$varsMenu["usuarios_on"] = 'class = "on"';
			$page->setMenu( $credentials->IdTipo, $varsMenu);
			$page->setMenu($credentials->IdTipo);
			
			$script = "<script>tab('formSearch', 'btnBuscar');</script>";
			
			$varsTabs["tabs"] = $page->getSubmenu("submenu_buscar");
			$varsTabs["targets"] =   $formHistorial.$formBuscar;

		
			
			//$page->setForms();
			$tabs = $page->getTabs($varsTabs);
			$page->setContenido( $tabs .$resultados. $script);
			$page->render();
			
		}
		else
		{
			
			
			$formBuscar = $web->getFormBuscar($_POST);
			$page = new Pagina();
			$page->setDir("");
			$varsMenu["usuarios_on"] = 'class = "on"';
			$page->setMenu( $credentials->IdTipo, $varsMenu);
			$page->setMenu($credentials->IdTipo);
			
			$script = "<script>tab('formSearch', 'btnBuscar');</script>";
			
			$varsTabs["tabs"] = $page->getSubmenu("submenu_buscar");
			$varsTabs["targets"] =   $formBuscar;

			//echo "entro";
			
			//$page->setForms();
			$tabs = $page->getTabs($varsTabs);
			$page->setContenido( $tabs . $script);
			$page->render();
				
		}

/*}
else
{
	
	header("Location: login.php");
	exit;
}*/
?>