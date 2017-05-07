<?php

include_once(dirname(dirname(__FILE__)) . "/nucleo/Utils.php");
include_once(dirname(dirname(__FILE__)) . "/nucleo/DAL.php");

class Solicitud
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
		if (Utils::strIsValidate($registro["Asunto"]))
		{
			$asunto = DAL::cleanSQLParam($registro["Asunto"]);
			$contenido = DAL::cleanSQLParam($registro["Contenido"]);
			$sql = "INSERT INTO `solicitud` (IdSolicitud, Asunto, Contenido) VALUES ('', '$asunto', '$contenido')";
			$result = DAL::executeNonQuery($sql);
			if ($result["Error"] != true)
			{
				$respuesta->exito = true;
				array_push($respuesta->mensajes, "Se ingreso la solicitud exitosamente");
			}
			else
			{
				array_push($respuesta->errores, "no pudimos conectar a la base de datos");
			}
		}
		else
		{
			array_push($respuesta->errores, "Todos los campos son obligatorios ");
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
		
		if (!Utils::isInteger($registro["IdSolicitud"]))
		{
			$sol = $registro["IdSolicitud"];
			array_push($respuesta->errores, "'$sol' no es una solicitud valida");
		}
		
		if (!Utils::strIsValidate($registro["Asunto"]))
		{
			array_push($respuesta->errores, "El campo Asunto es obligatorio.");
		}
		
		if (!Utils::strIsValidate($registro["Contenido"]))
		{
			array_push($respuesta->errores, "El campo Contenido es obligatorio.");
		}

		if (empty($respuesta->errores))
		{
			$asunto = DAL::cleanSQLParam($registro["Asunto"]);
			$asunto2 = DAL::cleanSQLParam($registro["Contenido"]);
			$IdSolicitud = $registro["IdSolicitud"];
			$sql = "UPDATE `solicitud` SET `Asunto` = '$asunto' and `Contenido` = '$asunto2' WHERE `IdSolicitud` = '$IdSolicitud' LIMIT 1";
			$result = DAL::executeNonQuery($sql);
			if ($result["Error"] != true)
			{
				$respuesta->exito = true;
				array_push($respuesta->mensajes, "Se actualizo la solicitud exitosamente");
			}
			else
			{
				array_push($respuesta->errores, "no pudimos conectar a la base de datos");
			}
		}
		return $respuesta;
	}
	
	public function eliminar ( $IdSolicitud)
	{
		$respuesta = new stdClass();
		$respuesta->exito = false;
		$respuesta->errores = array();
		$respuesta->mensajes = array();
		
		if (!Utils::isInteger($IdSolicitud))
		{
			array_push($respuesta->errores, "'$IdSolicitud' no es una solicitud valida");
		}
		
		if (empty($respuesta->errores))
		{
			$sql = "DELETE FROM `solicitud` WHERE `IdSolicitud` = '$IdSolicitud' LIMIT 1";
			$result = DAL::executeNonQuery($sql);
			if ($result["Error"] != true)
			{
				$respuesta->exito = true;
				array_push($respuesta->mensajes, "la solicitud se elimino exitosamente");
			}
			else
			{
				array_push($respuesta->errores, "no pudimos conectar a la base de datos");
			}
		}
		return $respuesta;
	}
	
	public function consultar ( $criterio)
	{
		
		$respuesta = new stdClass();
		$respuesta->exito = false;
		$respuesta->errores = array();
		$respuesta->mensajes = array();
		$asunto = DAL::cleanSQLParam ($criterio["Asunto"]);
		$asunto2 = DAL::cleanSQLParam ($criterio["Contenido"]);
		$sql = "SELECT * FROM `solicitud` WHERE `Asunto` LIKE '%$asunto%' and `Contenido` LIKE '%$asunto2%'";
		$result = DAL::executeNonQuery($sql);
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
	
	
}

?>