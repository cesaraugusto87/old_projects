<?php

include_once( dirname (__FILE__) . "/import.php");
import("nucleo.classes.DAL");
import("nucleo.classes.Utils");
import("entidades.ReporteEntity");

class Reporte
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
		
			if (!Utils::isInteger($registro["Cedula"]))
		{
			array_push($respuesta->errores, "El numero de cedula es  incorrecto.");
		}	
		
		if (!Utils::isDate($registro["Fecha"]))
		{
			array_push($respuesta->errores, "La fecha no es valida.");
		}	
		if (empty($respuesta->errores))
		{
			$reporte = DAL::cleanSQLParam($registro["IdReporte"]);
			$cedula = DAL::cleanSQLParam($registro["Cedula"]);
			$fecha	= DAL::cleanSQLParam($registro["Fecha"]);
			$observaciones	= DAL::cleanSQLParam($registro["Observaciones"]);
			
			$sql = "INSERT INTO `reporte` (IdReporte, Cedula, Fecha, Observaciones) VALUES ('$reporte','$cedula', '$fecha', '$observaciones')";
			
			$result = DAL::executeNonQuery($sql);
			
			if ($result["Error"] != true)
			{
				$respuesta->exito = true;
				$respuesta->asunto = DAL::$lastID;
				array_push($respuesta->mensajes, "Se ingreso el registro exitosamente");
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
	
	
	
	
	
	public function consultar ( $IdReporte)
	{
		
		$respuesta = new stdClass();
		$respuesta->asunto = null;
		$respuesta->exito = false;
		$respuesta->errores = array();
		$respuesta->mensajes = array();
		
		if (!Utils::isInteger($IdReporte))
		{
			array_push($respuesta->errores, "El numero de reporte no existe");
		}
		
		if (empty($respuesta->errores))
		{
		
			$sql = "SELECT * FROM `reporte` WHERE `IdReporte` = '$IdReporte' LIMIT 1";
			
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
			
			if (isset($FormVars["IdReporte"]))
			{
				$sqlCriterio .= " AND R.IdReporte LIKE '%$criterio%'";
			}
			
			if (isset($FormVars["Cedula"]))
			{
				$sqlCriterio .= " AND R.Cedula LIKE '%$criterio%'";
			}
			
			if (isset($FormVars["Fecha"]))
			{
				$sqlCriterio .= " AND R.Fecha LIKE '%$criterio%'";
			}
			
		}
			
		$sql = "SELECT 
						R.IdReporte,
						R.Cedula,
						R.Fecha, 
				FROM `reporte` R 

				WHERE $sqlCriterio ORDER BY R.IdReporte ASC";
				
		$result = DAL::createDataSet($sql);
		
		if ($result["Error"]!= true)
		{
			return $result;
		}
		return false;
	}
	
	
	public function consultar_f ( $Fecha)
	{
		
		$respuesta = new stdClass();
		$respuesta->exito = false;
		$respuesta->errores = array();
		$respuesta->mensajes = array();
		
		
		if (empty($respuesta->errores))
		{
		
		$sql = "SELECT * FROM `` WHERE `Nombre` = '$Nombre'";
		
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