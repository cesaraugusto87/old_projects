<?php
include_once(dirname(__FILE__). "/libreria/nucleo/functions/import.php");
import("libreria.aplicacion.Pagina");
import("libreria.aplicacion.Credentials");
import("libreria.aplicacion.DepartamentoWeb");
import("libreria.aplicacion.Departamento");
import("libreria.aplicacion.Solicitud");

$sesion = new Credentials();
$datos = $sesion->getCredentials();


if (isset($_GET["logout"]))	
{
	$sesion->logout();
}

// Si no es administrador entra al if 
if (!$sesion->haveAccess(3))
{
	header("Location: slogin.php");
	exit;
}
$enviar= new Departamento();

if (isset($_GET["eliminar"]))
{
	$enviar->eliminar($_GET["eliminar"]);
}

 
if (isset ($_GET["editar"])  && !isset($_POST["registrar"]))
{
	$editar= $enviar->consultar_id( $_GET["editar"]);
	
	/*echo "<pre>";
	print_r($editar);
	echo "<pre>";*/
	if ($editar != false)
	{
		$_POST = $editar;
		$_POST["accion"] = "editar";
	}
}

if (isset($_POST["registrar"]))
{
	
	
	if ($_POST["accion"]  == "editar")
	{
		$r=$enviar->modificar($_POST);
	}
	else
	{
		$r=$enviar->agregar($_POST);
	}
	
	if ( $r->exito== true)
	{
		$mensajes= $r->mensajes;
		$_POST["accion"] = "agregar";
	}
	else
	{
		$mensajes= $r->errores;
	}
	$_POST["mensajes"] = Pagina::getErrores($mensajes);	

}
else
{
	if (!isset($_POST["accion"]))
	{
		$_POST["accion"] = "agregar";
	}
}


$ver= $enviar->consultar();
$Web= new DepartamentoWeb();
$Solicitud = new Solicitud();
$formAgregar= $Web->getFormAgregar($_POST);
$Resultados= $Web->getResultados( $ver);


$pagina= new Pagina();
$varsMenu["departamentos_on"] = 'class = "on"';
$varsMenu["num"] = $Solicitud->contarNuevas($datos->IdDepartamento);
$pagina->setMenu( $datos->IdTipo, $varsMenu);

$script = "<script>tab('formAgregar', 'btnAgregar');</script>";


$varsTabs["tabs"] = $pagina->getSubmenu("submenu_departamentos");
$varsTabs["targets"] = $formAgregar;
$tabs = $pagina->getTabs($varsTabs);
$pagina->setContenido($tabs. $Resultados . $script);
$pagina->render();
?>