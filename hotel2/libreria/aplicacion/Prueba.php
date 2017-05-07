<?php

include_once(dirname(__FILE__). "\conex.php");

class Cliente
{
		
	public $result;
	
	public $modelo;
	
	private $accion = false;
	
	public function __construct()
	{
		//Not implmented yet	
	}

	public function insertar()
		{
		
		//echo("entro insertar");
		
		$_REQUEST['idcliente'] = 3;
		$_REQUEST['nombre'] = susana;
		$_REQUEST['apellido'] = leon;
		$_REQUEST['domicilio'] = prueba;
		$_REQUEST['telefono'] = 1234;
		$_REQUEST['nacionalidad'] = 'v';

		/*echo "<pre>";
		print_r($_REQUEST['nacionalidad']);
		echo "</pre>";*/
		
		$query = "INSERT INTO cliente (idcliente, nombre, apellido, domicilio, telefono, nacionalidad) VALUES ( '" . $_REQUEST['idcliente'] . "','" . $_REQUEST['nombre'] . "','" . $_REQUEST['apellido'] . "', '" . $_REQUEST['domicilio'] . "','" . $_REQUEST['telefono'] . "','" . $_REQUEST['nacionalidad'] . "')";
		
		 $result = pg_query($query); 
		 
		 return $result;
	   } 
	
}
	
?>