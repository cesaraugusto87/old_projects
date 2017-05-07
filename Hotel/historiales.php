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

/*if (isset($_GET["logout"]))
{
	$u->logout();
}

if ($u->haveAccess(1))
{*/
		
	
		if (isset($_POST["buscarced"]))
		{
		
			$formBuscar = $registro->getbuscarh($_POST);
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