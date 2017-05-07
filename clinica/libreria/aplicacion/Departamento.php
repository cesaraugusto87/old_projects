<?php

import("libreria.nucleo.classes.DAL");
import("libreria.nucleo.classes.Utils");

class Departamento
{
		
	public function __construct()
	{
		//Not implmented yet	
	}
	
	public function agregar ( $registro)
	{
		
		$respuesta = new stdClass();
		
		$respuesta->exito = false;
		$respuesta->errores = array();
		$respuesta->mensajes = array();
		if (Utils::strIsValidate($registro["Nombre"]))
		{
			$nombre = DAL::cleanSQLParam($registro["Nombre"]);
			$sql = "INSERT INTO `departamento` (IdDepartamento, Nombre) VALUES ('', '$nombre')";
			$result = DAL::executeNonQuery($sql);
			if ($result["Error"] != true)
			{
				$respuesta->exito = true;
				array_push($respuesta->mensajes, "Se ingreso el nuevo departamento exitosamente");
			}
			else
			{
				array_push($respuesta->errores, "no pudimos conectar a la base de datos");
			}
		}
		else
		{
			array_push($respuesta->errores, "El campo nombre es obligatorio");
		}
		return $respuesta;
		
		
	}
	
	public function modificar ( $registro)
	{
		$respuesta = new stdClass();
		
		$respuesta->exito = false;
		$respuesta->errores = array();
		$respuesta->mensajes = array();
		
//		Utils::isEmail($asunto);
		
		if (!Utils::isInteger($registro["IdDepartamento"]))
		{
			$asunto = $registro["IdDepartamento"];
			array_push($respuesta->errores, "'$asunto' no es un departamento valido");
		}
		
		if (!Utils::strIsValidate($registro["Nombre"]))
		{
			array_push($respuesta->errores, "El campo Nombre es obligatorio.");
		}

		if (empty($respuesta->errores))
		{
			$nombre = DAL::cleanSQLParam($registro["Nombre"]);
			$IdDepartamento = $registro["IdDepartamento"];
			$sql = "UPDATE `departamento` SET `Nombre` = '$nombre' WHERE `IdDepartamento` = '$IdDepartamento' LIMIT 1";
			$result = DAL::executeNonQuery($sql);
			if ($result["Error"] != true)
			{
				$respuesta->exito = true;
				array_push($respuesta->mensajes, "Se actualizo el departamento exitosamente");
			}
			else
			{
				array_push($respuesta->errores, "no pudimos conectar a la base de datos");
			}
		}
		return $respuesta;
	}
	
	public function eliminar ( $IdDepartamento)
	{
		$respuesta = new stdClass();
		$respuesta->exito = false;
		$respuesta->errores = array();
		$respuesta->mensajes = array();
		
		if (!Utils::isInteger($IdDepartamento))
		{
			array_push($respuesta->errores, "'$IdDepartamento' no es un departamento valido");
		}
		
		if (empty($respuesta->errores))
		{
			$sql = "DELETE FROM `departamento` WHERE `IdDepartamento` = '$IdDepartamento' LIMIT 1";
			$result = DAL::executeNonQuery($sql);
			if ($result["Error"] != true)
			{
				$respuesta->exito = true;
				array_push($respuesta->mensajes, "El departamento se elimino exitosamente");
			}
			else
			{
				array_push($respuesta->errores, "no pudimos conectar a la base de datos");
			}
		}
		return $respuesta;
	}
	
	public function consultar ()
	{
		
		$respuesta = new stdClass();
		$respuesta->exito = false;
		$respuesta->errores = array();
		$respuesta->mensajes = array();
		$sql = "SELECT * FROM `departamento` ORDER BY Nombre ASC";
		$result = DAL::createDataSet($sql);
		if ($result["Error"] != true)
		{
			$respuesta->exito = true;
			$respuesta->mensajes = $result;
			//array_push($respuesta->mensajes, $result);
		}
		else
		{
			array_push($respuesta->errores, "no pudimos conectar a la base de datos");
		}
		return $respuesta;
	}
	
	
		public function consultar_id ( $IdDepartamento)
	{
		
		if (!Utils::isInteger($IdDepartamento))
		{
			return  false;
		
		}
		
		$sql = "SELECT * FROM `departamento` WHERE IdDepartamento = '$IdDepartamento' LIMIT 1";
		$result = DAL::createDataSet($sql);
		if ($result["Error"] != true)
		{
			if ( mysql_num_rows( $result))
			{
				return mysql_fetch_array( $result);
			}
		}
		return false;
	}

	
	public static function getDepartamentos()
	{
		$sql = "SELECT * FROM `departamento` ORDER BY Nombre ASC";
		$result = DAL::createDataSet($sql);
		if ($result["Error"]!= true)
		{
			return $result;
		}
		return  false;
	}
	
	public static  function esDepartamento( $id)
	{
		if ( !Utils::isInteger($id))
		{
			return  false;
		}
		$sql = "SELECT * FROM `departamento` WHERE _rowid = '$id' LIMIT 1";
		$result = DAL::createDataSet($sql);
		if ($result["Error"] != true)
		{
			return mysql_num_rows($result) ==1;
		}
		return false;
	}
	
	
}


?>