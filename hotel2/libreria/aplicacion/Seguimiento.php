<?php


import("libreria.nucleo.classes.DAL");
import("libreria.nucleo.classes.Utils");

class Seguimiento
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
		
		if ((Utils::strIsValidate($registro["Estado"]))&&(Utils::isDate($registro["Fecha"])))
		{
		
			$solicitud = DAL::cleanSQLParam($registro["IdSolicitud"]);
			$usuario = DAL::cleanSQLParam($registro["IdUsuario"]);
			$contenido = DAL::cleanSQLParam($registro["Contenido"]);
			$fecha = DAL::cleanSQLParam($registro["Fecha"]);
			$estado = DAL::cleanSQLParam($registro["Estado"]);
			$sql = "INSERT INTO `seguimiento` (IdSeguimiento, IdSolicitud, IdUsuario,  Contenido, Fecha, Estado) VALUES ('','$solicitud', '$usuario', '$contenido', '$fecha', '$estado')";
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
	
	
	
	
	public function consultar ( $IdSeguimiento)
	{
		
		$respuesta = new stdClass();
		$respuesta->exito = false;
		$respuesta->errores = array();
		$respuesta->mensajes = array();
		
		if (!Utils::isInteger($IdSeguimiento))
		{
			array_push($respuesta->errores, "'$IdSolicitud' no es una solicitud valida");
		}
		
		if (empty($respuesta->errores))
		{
		
		$sql = "SELECT * FROM `seguimiento` WHERE `IdSeguimiento` = '$IdSeguimiento' LIMIT 1";
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
	
	/*public function consultar ( $Fecha)
	{
		
		$respuesta = new stdClass();
		$respuesta->exito = false;
		$respuesta->errores = array();
		$respuesta->mensajes = array();
		$sql = "SELECT * FROM `solicitud` WHERE `Fecha` = '$Fecha' ";
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
	}*/
}

?>