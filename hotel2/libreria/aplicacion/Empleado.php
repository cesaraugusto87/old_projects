<?php

include_once(dirname(__FILE__). "\conex.php");

class Empleado
{
		
	public $result;
	
	public $modelo;
	
	private $accion = false;

	public function insertar()
		{
		
		$_REQUEST['idempleado'] = 1;
		$_REQUEST['servicio_idservicio'] = 1;
		$_REQUEST['empresa_idempresa'] = 1;
		$_REQUEST['nombre'] = Cesar;
		$_REQUEST['apellido'] = Sanchez ;
		$_REQUEST['domicilio'] = Prueba;
		$_REQUEST['telefono'] = 12345;
		$_REQUEST['fecha_inicio'] = '1990-01-12';

		/*echo "<pre>";
		print_r($_REQUEST['nacionalidad']);
		echo "</pre>";*/
		
		$query = "INSERT INTO empleado (idempleado, servicio_idservicio, empresa_idempresa, nombre, apellido, domicilio, telefono, fecha_inicio) VALUES ( '" . $_REQUEST['idempleado'] . "','" . $_REQUEST['servicio_idservicio'] . "','" . $_REQUEST['empresa_idempresa'] . "','" . $_REQUEST['nombre'] . "','" . $_REQUEST['apellido'] . "', '" . $_REQUEST['domicilio'] . "','" . $_REQUEST['telefono'] . "','" . $_REQUEST['fecha_inicio'] . "')";
	
		 $result = pg_query($query); 
		 
		 return $result;
	   } 
	
}
	
?>
