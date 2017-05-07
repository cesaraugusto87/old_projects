<?php

include_once( dirname (__FILE__) . "/import.php");
import("nucleo.classes.DAL");
import("nucleo.classes.Utils");
import("entidades.PacienteEntity");
import("libreria.aplicacion.RegistroWeb");


class Paciente
{
		
	public function __construct()
	{
		//Not implmented yet	
	}
	
	
	public function agregar ( $registro)
	{
		
		$respuesta = new stdClass();
		$respuesta->asunto = null;		
		$respuesta->exito = false;
		$respuesta->errores = array();
		$respuesta->mensajes = array();
		
			
		if (!Utils::strIsValidate($registro["Nombre"]))
		{
			array_push($respuesta->errores, "El campo Nombre es incorrecto.");
		}
			
		if (!Utils::strIsValidate($registro["Apellido"]))
		{
			array_push($respuesta->errores, "El campo Apellido es incorrecto.");
		}
		
		/*if (!Utils::isEmail($registro["Email"]))
		{
			array_push($respuesta->errores, "La direccion de correo es incorrecta.");
		}*/
			
		
		
		if (empty($respuesta->errores))
		{
			$IdPaciente = DAL::cleanSQLParam($registro["IdPaciente"]);
			$cedula = DAL::cleanSQLParam($registro["Cedula"]);
			$nombre = DAL::cleanSQLParam($registro["Nombre"]);
			$apellido = DAL::cleanSQLParam($registro["Apellido"]);
			$edad = DAL::cleanSQLParam($registro["Edad"]);
			
			
			$sql = "INSERT INTO `pacientes` (IdPaciente, Cedula, Nombre, Apellido, Edad) VALUES ('','$cedula','$nombre', '$apellido', '$edad')";
			
			$result = DAL::executeNonQuery($sql);
			
			if ($result["Error"] != true)
			{
				$respuesta->exito = true;
				$respuesta->asunto = DAL::$lastID;
				array_push($respuesta->mensajes, "Se registro el paciente exitosamente");
			}
			else
			{
				array_push($respuesta->errores, "No se pudo registrar el paciente!!! por favor, verifique los datos <br />Quiza el paciente ya se encuentra registrado");
			}
		}
		else
		{
			array_push($respuesta->errores, "Algunos datos, son obligatorios ");
		}

		
		
		return $respuesta;
	}
	
	
	public function modificar ( $registro)
	{
		$respuesta = new stdClass();
		
		$respuesta->exito = false;
		$respuesta->errores = array();
		$respuesta->mensajes = array();
		

		
		if (!self::esUsuario($registro["Cedula"]))
		{
			$ci = $registro["Cedula"];
			array_push($respuesta->errores, "El numero de cedula:'$ci' no es parte del registro de pacientes");
			
		}
		
		if (!Utils::strIsValidate($registro["Nombre"]))
		{
			array_push($respuesta->errores, "El campo Nombre es obligatorio.");
		}
		
		if (!Utils::strIsValidate($registro["Apellido"]))
		{
			array_push($respuesta->errores, "El campo Apellido es obligatorio.");
		}
		
		

		if (empty($respuesta->errores))
		{
			//$IdPaciente = $registro["IdPaciente"];
			$cedula = $registro["Cedula"];
			$nombre = DAL::cleanSQLParam($registro["Nombre"]);
			$apellido = DAL::cleanSQLParam($registro["Apellido"]);
			$edad = DAL::cleanSQLParam($registro["Edad"]);
			
			$sql = "UPDATE `pacientes` SET `Nombre` = '$nombre', `Apellido` = '$apellido', `Edad` = '$edad',  WHERE `Cedula` = '$cedula' LIMIT 1";
			
			$result = DAL::executeNonQuery($sql);
			
			if ($result["Error"] != true)
			{
				$respuesta->exito = true;
				array_push($respuesta->mensajes, "Se actualizo el registro del paciente exitosamente");
			}
			else
			{
				array_push($respuesta->errores, "Verifique que los datos, esten correctos!!");
			}
			
		
		}
		return $respuesta;
	}
	
	public function eliminar ( $Cedula)
	{
		$respuesta = new stdClass();
		$respuesta->exito = false;
		$respuesta->errores = array();
		$respuesta->mensajes = array();
		
		if (!Utils::isInteger($Cedula))
		{
			array_push($respuesta->errores, "'$Cedula' no es un numero de cedula valido");
		}
		
		if (empty($respuesta->errores))
		{
			$sql = "DELETE FROM `pacientes` WHERE `Cedula` = '$Cedula' LIMIT 1";
			$result = DAL::executeNonQuery($sql);
			
			if ($result["Error"] != true)
			{
				$respuesta->exito = true;
				array_push($respuesta->mensajes, "el registro se elimino exitosamente");
			}
			else
			{
				array_push($respuesta->errores, "no pudimos conectar a la base de datos");
			}
		}
		return $respuesta;
	}
	
	
	public function consultar ( $registro)
	{
		
		$respuesta = new stdClass();
		$respuesta->asunto = null;
		$respuesta->exito = false;
		$respuesta->errores = array();
		$respuesta->mensajes = array();
		$Cedula = $registro["Cedula"];
		
		if (!self::esUsuario($Cedula))
		{
			array_push($respuesta->errores, "El paciente no se encuentra registrado");
		}
		
		if (empty($respuesta->errores))
		{
		
			$sql = "SELECT * FROM `pacientes` WHERE `Cedula` = '$Cedula' LIMIT 1";
			
			$result = DAL::executeNonQuery($sql);
			
			if ($result["Error"] != true)
			{
				$respuesta->exito = true;
				
				//$respuesta->asunto = mysql_fetch_object($result, PacienteEntity);
				$respuesta->mensajes = $result;
			}
			else
			{
				array_push($respuesta->errores, "no pudimos conectar a la base de datos");
			}
		
		}
		return $respuesta;
	}
	
	
	

	
	
	
	public function buscar( $FormVars)
	{
		
		$sqlCriterio = "1";
		if (Utils::strIsValidate($FormVars["criterio"]))
		{
			$criterio = DAL::cleanSQLParam($FormVars["criterio"]);
			
			if (isset($FormVars["Cedula"]))
			{
				$sqlCriterio .= " AND Cedula LIKE '%$criterio%'";
			}
			
			if (isset($FormVars["Nombre"]))
			{
				$sqlCriterio .= " AND Nombre LIKE '%$criterio%'";
			}
			
			if (isset($FormVars["Apellido"]))
			{
				$sqlCriterio .= " AND Apellido LIKE '%$criterio%'";
			}
			
		}
		
		
		$sql = "SELECT *FROM `pacientes`  WHERE $sqlCriterio";
				
		$result = DAL::executeNonQuery($sql);
		
		$web = new RegistroWeb();
		return $web->getFormBuscar($result);
		
	}
	
	
	public function consultar_n ( $Nombre)
	{
		
		$respuesta = new stdClass();
		$respuesta->exito = false;
		$respuesta->errores = array();
		$respuesta->mensajes = array();
		
		if (!Utils::strIsValidate($Nombre))
		{
			array_push($respuesta->errores, "'$Nombre' no es un nombre de paciente valido");
		}
		
		if (empty($respuesta->errores))
		{
		
		$sql = "SELECT * FROM `pacientes` WHERE `Nombre` = '$Nombre'";
		
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
	
	public function consultar_a ( $Apellido)
	{
		
		$respuesta = new stdClass();
		$respuesta->exito = false;
		$respuesta->errores = array();
		$respuesta->mensajes = array();
		
		if (!Utils::strIsValidate($Apellido))
		{
			array_push($respuesta->errores, " El apellido'$Apellido' no se encuentra en el registro ");
		}
		
		if (empty($respuesta->errores))
		{
		
			$sql = "SELECT * FROM `pacientes` WHERE `Apellido` = '$Apellido'";
			
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
	
	public static  function esUsuario( $Cedula)
	{
		if ( !Utils::isInteger($Cedula))
		{
			return  false;
		}
		$sql = "SELECT * FROM `pacientes` WHERE _rowid = '$Cedula' LIMIT 1";
		
		$result = DAL::createDataSet($sql);
		
		if ($result["Error"] != true)
		{
			return mysql_num_rows($result) ==1;
		}
		return false;
	}
	
	
	
	
}

?>