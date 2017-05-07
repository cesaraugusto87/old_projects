<?php

import("libreria.nucleo.classes.DAL");
import("libreria.nucleo.classes.Utils");
import("libreria.nucleo.classes.FileManager");
//import("entidades.PacienteEntity");
//import("Paciente");
import("libreria.aplicacion.ModeloWeb");

class Modelo
{
		
	public $resultados;
	
	public $pacient;
	
	private $accion = false;
	
	public function __construct()
	{
		//Not implmented yet	
	}
	

#####################################################################

public function vermodelo()
	{	
	$web = new ModeloWeb();
		return $web->getFormModelo();
		
	}

#####################################################################
	
	
	
	
	public function agregar ($registro)
	{
		
		// si se presiono el boton de registrar y accion es agregar
		
			$this->accion = true;
			$respuesta = $this->validacionAgregar($registro);
			
				if (!Utils::strIsValidate($registro["Diagnostico"]))
		{
			$registro["errores"] = Pagina::getErrores("Es necesario agregar alguna observacion para realizar el registro");		
			
		}
				if (!$registro["errores"])
				{
				$IdReporte = DAL::cleanSQLParam($registro["IdReporte"]);
				$IdPaciente = DAL::cleanSQLParam($registro["IdPaciente"]);
				$diagnostico = DAL::cleanSQLParam($registro["Diagnostico"]);
			
				$sql = "INSERT INTO `reporte` (IdReporte, IdPaciente, Fecha, Diagnostico) VALUES ('', '$IdPaciente', NOW(), '$diagnostico')";
				
				$result = DAL::executeNonQuery($sql);
				
					if ($result["Error"] != true)
					{
						$registro["mensajes"] = Pagina::getErrores("se ingreso el registro exitosamente");
						//$this->resultados = $this->obtenerSolicitud(DAL::$lastID);
					}
					else
					{
						$registro["errores"] = Pagina::getErrores("No se ingreso el registro");
					}
				}
			
		
			$vars = $this->prepararFormularioAgregar($registro);
			$web = new RegistroWeb();
		
		return $web->getFormAgregar($vars);
		
	}

	
	
	
	public function prepararFormularioAgregar( $registro)
	{
		$datos = new Paciente();
			
		$FormVars["IdPaciente"]		=	$registro["IdPaciente"];
		$FormVars["Diagnostico"]	=	$registro["Diagnostico"];
		
		$FormVars["accion"]='agregar';
		$FormVars["errores"]=	$registro["errores"];
		$FormVars["mensajes"]=	$registro["mensajes"];
		return $FormVars;
		
	}
	
	
	
	
	
	public function validacionAgregar ( $registro)
	{
		$respuesta = new stdClass();
		
		$respuesta->exito = false;
		$respuesta->errores = array();
		$respuesta->mensajes = array();
		
		if (!Utils::strIsValidate($registro["Diagnostico"]))
		{
			$registro["errores"] = Pagina::getErrores("Es necesario agregar alguna observacion para realizar el registro");		
		}
		
		
		return $respuesta->errores;
	}
	
	
	public function buscar ($registro)
	{
		if (isset ($registro["buscarced"]))
		{
			$respuesta = $this->buscar_ci($registro["Cedula"]);
			$vars = mysql_fetch_array($respuesta);
			
			if ($respuesta->exito)
			{
				$IdPaciente = $registro[$_GET("paciente")];
				
				$sql = "SELECT * FROM ´reporte´ WHERE ´IdPaciente´=$IdPaciente";
				
				$result = DAL::executeNonQuery($sql);
			}
			
			else
			{
				
			}
			
			$this->resultados = DAL::createDataSet($sql);
			$this->accion = true;
		}

		$vars = $this->prepararFormularioBuscar($registro);
		$web = new SolicitudWeb();
		return $web->getFormBuscar($vars);
	}
	
	function buscar_ci($idpaciente)
	{
		$respuesta = new stdClass();
		
		$respuesta->exito = false;
		$respuesta->errores = array();
		$respuesta->mensajes = array();
		
		$sql = "SELECT * FROM `reporte` WHERE `IdPaciente` = $idpaciente LIMIT 1";
				
				$result = DAL::executeNonQuery($sql);
				
					if ($result["Error"] = true)
					{
						array_push($respuesta->errores, "El numero de cedula que ingreso no se encuentra registrado");
						
					}
					else 
					{
					
					$respuesta->exito = true;
					}
					
	return $respuesta;
	}
	
	
	function prepararFormularioBuscar($registro)
	{
		$registro["departamentos"] = DepartamentoWeb::getCBDepartamentos($registro["IdDepartamento"],true );
		$registro["estado_" . strtolower($registro["estado"])] = 'selected="selected"';
		
		return $registro;
	}
	
	
	public function atender ( $registro)
	{
		if (isset($registro["atender"])) 
		{
			$this->accion = true;
			$respuesta = $this->validacionAtender($registro);
			if (isset($registro["adjunto"]))
			{
				$f = new FileManager();
				$f->BaseFolder = "uploads/";
				
				$fileinfo	 = pathinfo($registro["adjunto"]["name"]);
				$nombreArchivo = $registro["adjunto"]["name"];
				$registro["adjunto"]["name"] = md5(mktime()) . "." . $fileinfo["extension"] ;
				$adjunto  = $registro["adjunto"]["name"];
				if (!$f->upload($registro["adjunto"]))
				{
					array_push($respuesta->errores, "No pudimos adjuntar el archivo.");
				}
			}
			else
			{
				$nombreArchivo = "";
				$adjunto  = "";
				
			}
			if (empty($respuesta->errores))
			{
				
				$c = new Credentials();
				$userData = $c->getCredentials();
				
				$usuario = $userData->IdUsuario;
				$idSolicitud = $registro["IdSolicitud"];
				$contenido = DAL::cleanSQLParam($registro["Contenido"]);
				$estado = DAL::cleanSQLParam($registro["estado"]);
				$nombreArchivo= DAL::cleanSQLParam($nombreArchivo);
				$sql[] = "INSERT INTO `seguimiento` (IdSeguimiento, IdSolicitud, IdUsuario, Contenido, Adjunto, Adjunto_Nombre, Fecha) VALUES ('', '$idSolicitud', '$usuario', '$contenido', '$adjunto','$nombreArchivo' ,NOW() )";
				$sql[] = "UPDATE `solicitud` SET `Estado` = '$estado' WHERE `IdSolicitud` = '$idSolicitud' LIMIT 1";
				$result = DAL::executeNonQuery($sql);
				if ($result["Error"] != true)
				{
					$registro["mensajes"] = Pagina::getErrores("Se ingreso el seguimiento");
					$this->resultados = $this->obtenerSolicitud(DAL::$lastID);
				}
				else
				{
					$registro["errores"] = Pagina::getErrores("no pudimos conectar a la base de datos");
				}
			}
			else
			{
				$registro["errores"] = Pagina::getErrores($respuesta->errores);
			}
			
		}
		$vars = $this->prepararFormularioAtender($registro);
		$web = new SolicitudWeb();
		
		return $web->getFormAtender($vars);
	}
	
	####################################
	
	public function atendido ( $registro)
	{
		
			$this->accion = true;
			$respuesta = $this->validacionAtender($registro);
			if (empty($respuesta->errores))
			{
				
				$c = new Credentials();
				$userData = $c->getCredentials();
				
				$usuario = $userData->IdUsuario;
				$idSolicitud = $registro["IdSolicitud"];
				$contenido = $registro["Contenido"];
				$estado = $registro["Estado"];
				$sql[] = "SELECT INTO `seguimiento` (IdSeguimiento, IdSolicitud, IdUsuario, Contenido, Adjunto,Estado) VALUES ('', '$idSolicitud', '$usuario', '$contenido', ' ','$estado')";
				$result = DAL::executeNonQuery($sql);
				
				if ($result["Error"] != true)
				{
					$this->resultados = $this->obtenerSolicitud(DAL::$lastID);
				}
				else
				{
					$registro["errores"] = Pagina::getErrores("no pudimos conectar a la base de datos");
				}
			}
			else
			{
				$registro["errores"] = Pagina::getErrores($respuesta->errores);
			}
			
		
		$vars = $this->prepararFormularioAtender($registro);
		$web = new SolicitudWeb();
		
		return $web->getFormAtendido($vars);
	}
	
	
	####################################
	
	
	public function validacionAtender($registro)
	{
		$respuesta = new stdClass();
		
		$respuesta->exito = false;
		$respuesta->errores = array();
		$respuesta->mensajes = array();
		
		if (!in_array($registro["estado"], self::$estados) or $registro["estado"] == "Nuevo")
		{
			array_push($respuesta->errores, "Estado de solicitud no es valida");
		}
		
		
		if (!Utils::strIsValidate($registro["Contenido"]))
		{
			array_push($respuesta->errores, "El campo contenido es obligatorio");
		}

		if (!self::esSolicitud($registro["IdSolicitud"]))
		{
			array_push($respuesta->errores, "Solicitud no valida");
		}
		
		if (!self::esNuevaSolicitud($registro["IdSolicitud"]))
		{
			array_push($respuesta->errores, "Solicitud no valida, ya fue atendida o rechazada");
		}
		
		return $respuesta;
	}
	
	
	public function verDetalle( $registro)
	{
				/*echo "<pre>";
				print_r($this->resultados);
				echo "</pre>";*/
				
			$paciente=$registro;
			$resource = $this->obtenerDatos($paciente);
			
			
			$web = new ModeloWeb();
			$vars = mysql_fetch_array($resource);

			
			setlocale(LC_TIME, 'es_ES');
			
			$vars["IdPaciente"] =	$paciente;
			
			
			$detalle = $web->getVerDetalle($vars);
		
	
		return $detalle;
	}
	
	
	public function obtenerDatos( $paciente)
	{

		if (Utils::isInteger($paciente))
		{
			$sql = "SELECT * FROM `pacientes` WHERE `IdPaciente` = '$paciente'";
			
			$result = DAL::createDataSet($sql);
			
			if ($result["Error"] != true)
			{
				return $result;
			}
		}
		return false;
	}
	

	
	
#####################################
		public function Detalle( $registro)
		{
		
			
				$resource = $this->obtenerRegistro($registro["IdPaciente"]);
				
				$vars = mysql_fetch_array($resource);
				//$vars = DAL::executeNonQuery($sql);
				
				
				
				$web = new RegistroWeb();
				
	
				setlocale(LC_TIME, 'es_ES');
				
				$IdPaciente = $vars["IdPaciente"];
				
				$detalle = $web->getVerDetalleusu($vars);
			
		
			return $detalle;
		}
################################################
		
		public function obtenerRegistro( $registro)
		{

			$sql = "SELECT * FROM `reporte` WHERE `IdReporte` = '$registro'";
			
		
			$result = DAL::createDataSet($sql);
			
			
			if ($result["Error"] != true)
			{
				return $result;
			}
		
		}


#####################################
	
	
	public function getResultados($cedula )
	{
		$web = new RegistroWeb();
		
		
			$this->resultados = $this->obtenerPaciente($cedula);
		
		
		return $web->getFormResultados($this->resultados);
	}
	
	public function obtenerPaciente ($cedula)
	{
	

		$sql = "SELECT 
								S.*,
								CONCAT(U.Nombre,' ',U.Apellido) AS NombreUsuario
						FROM `reporte` AS S
						INNER JOIN `pacientes` AS U ON S.Cedula = U.Cedula 
						WHERE S.Cedula = '$cedula' ";
		$result = DAL::createDataSet($sql);
		return $result;
	}
	########################################################
		
		public function getbuscar($registro)
		{
			
		$web = new RegistroWeb();
		
			if (isset ($registro["buscarced"]))
			{
			
				$this->resultados = $this->obtener($registro["Cedula"]);
			
			
				return $web->getFormResultados($this->resultados);
			}
			else
			{
			
			return $web->getFormbuscar($registro);
			
			}
			
		}
	
		public function obtener($cedula)
		{
		$respuesta = new stdClass();
		$respuesta->exito = false;
		$respuesta->errores = array();
		$respuesta->mensajes = array();

			$sql =  "SELECT * FROM `pacientes` WHERE `Cedula` = '$cedula'";
									
			$result = DAL::createDataSet($sql);
			
			if ($result["Error"] != true)
					{	
				
				$respuesta->exito = true;
				$respuesta->mensajes = $result;
				
					}
					
			
			return $respuesta;
		}




public function getbuscarh($registro ,$pagina)
		{
			
		$web = new RegistroWeb();
		
			if (isset ($registro["buscarced"]))
			{
			
				$this->resultados = $this->obtenerp($registro["Cedula"], $pagina);
			
			
			
				return $web->getFormResultadosh($this->resultados);
			}
			
			
		}
	
		public function obtenerp($cedula, $pagina)
		{
		

			$sql =  "SELECT * FROM `pacientes` WHERE `Cedula` = '$cedula'";
						
			if ($pagina == null)
			{
				$this->resultados = DAL::createDataSet($sql);
			}
			else
			{
				$this->resultados = DAL::createDataSetPage($sql, 10, $pagina);
				
			
			}
	
						
			//$result = DAL::createDataSet($sql);
			return $this->resultados;
		}		
	
	
	#############################################
	
	public function buscarh($IdPaciente ,$pagina)
		{
			
		$web = new RegistroWeb();
		
			
			
				$this->resultados = $this->obtenerh($IdPaciente,$pagina);
			
			
				return $web->getHistoriales($this->resultados);
			
			
		}
	
		public function obtenerh($IdPaciente,$pagina)
		{
		

			$sql =  "SELECT * FROM `reporte` WHERE `IdPaciente` = '$IdPaciente'";
					
			if ($pagina == null)
			{
				$this->resultados = DAL::createDataSet($sql);
			}
			else
			{
				$this->resultados = DAL::createDataSetPage($sql, 15, $pagina);
			}
			//$result = DAL::createDataSet($sql);
			
			return $this->resultados;
		}
	
	#############################################
	
	################################################################


	public function getPaciente()
	{
		$web = new RegistroWeb();
		
		
			$this->resultados = $this->obtener($registro["Cedula"]);
		
		
		return $web->getFormResultados($this->resultados);
	}
	
/*	public function obtener($IdDepartamento)
	{
	

		$sql = "SELECT 
								S.*,
								CONCAT(U.Nombre,' ',U.Apellido) AS NombreUsuario
						FROM `solicitud` AS S
						INNER JOIN `usuario` AS U ON S.IdUsuario = U.IdUsuario 
						WHERE S.IdDepartamento = '$IdDepartamento' ";
		$result = DAL::createDataSet($sql);
		return $result;
	}
	################################################################
	
	public function contarNuevas ()
	{
		$sql = "SELECT 
						COUNT(*) AS Total
						FROM `solicitud` AS S
						INNER JOIN `usuario` AS U ON S.IdUsuario = U.IdUsuario
						WHERE S.Estado = 'Nuevo' ";
		$result = DAL::createDataSet($sql);
		//$this->resultados = $result;
		$arrTotal = mysql_fetch_array($result);
		//$this->accion = true;
		
		return $arrTotal["Total"];
	}
	
	public function obtenerDatos( $paciente)
	{

		if (Utils::isInteger($paciente))
		{
			$sql = "SELECT * FROM `pacientes` WHERE `IdPaciente` = '$paciente'";
			$result = DAL::createDataSet($sql);
			
			if ($result["Error"] != true)
			{
				return $result;
			}
		}
		return false;
	}
	
	###########################################
	
	public function obtenerSeguimiento( $IdSolicitud)
	{

		if (Utils::isInteger($IdSolicitud))
		{
			$sql = "SELECT * FROM `seguimiento` WHERE IdSolicitud = '$IdSolicitud' LIMIT 1";
			$result = DAL::createDataSet($sql);
			
			if ($result["Error"] != true)
			{
				return $result;
			}
		}
		return false;
	}
	
	
	public function obtenerSeguimientoPorId( $IdSeguimiento)
	{

		if (Utils::isInteger($IdSeguimiento))
		{
			$sql = "SELECT * FROM `seguimiento` WHERE _rowid = '$IdSeguimiento' LIMIT 1";
			$result = DAL::createDataSet($sql);
			
			if ($result["Error"] != true)
			{
				return $result;
			}
		}
		return false;
	}
	
	
	
	###########################################
	
	
	public function modificar ( $registro)
	{
		$respuesta = new stdClass();
		
		$respuesta->exito = false;
		$respuesta->errores = array();
		$respuesta->mensajes = array();
		

		
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
			$usuario = DAL::cleanSQLParam($registro["IdUsuario"]);
			$asunto = DAL::cleanSQLParam($registro["Asunto"]);
			$contenido = DAL::cleanSQLParam($registro["Contenido"]);
			$fecha = DAL::cleanSQLParam($registro["Fecha"]);
			$IdSolicitud = $registro["IdSolicitud"];
			$sql = "UPDATE `solicitud` SET `IdUsuario` = '$usuario' and `Asunto` = '$asunto' and `Contenido` = '$contenido' WHERE `IdSolicitud` = '$IdSolicitud' LIMIT 1";
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
	
	
	public function consultar( $IdUsuario)
	{
		
		$respuesta = new stdClass();
		$respuesta->exito = false;
		$respuesta->errores = array();
		$respuesta->mensajes = array();
		
		
		$sql = "SELECT * FROM `solicitud` WHERE `IdUsuario` = '$IdUsuario'";
		$result = DAL::executeNonQuery($sql);
		
		if ($result["Error"] != true)
		{
				$respuesta->exito = true;
				$respuesta->mensajes = $result;
		
		}
		else
		{
			array_push($respuesta->errores, "no pudimos conectar a la base de datos");
		}
		return $respuesta;
	
	}
	
	
	
	
	
	
	
	public function consultar_sol( $IdUsuario)
	{
		
		$respuesta = new stdClass();
		$respuesta->exito = false;
		$respuesta->errores = array();
		$respuesta->mensajes = array();
		
		
		$sql = "SELECT * FROM `solicitud` WHERE `IdUsuario` = '$IdUsuario'";
		$result = DAL::executeNonQuery($sql);
		
		if ($result["Error"] != true)
		{
				$respuesta->exito = true;
				$dep = mysql_fetch_array($result);
				$respuesta->mensajes = $dep["IdSolicitud"];
		}
		else
		{
			array_push($respuesta->errores, "no pudimos conectar a la base de datos");
		}
		return $respuesta;
	
	}
	

	
		public function buscar_paciente($IdPaciente)
		{
			
			$respuesta = new stdClass();
			$respuesta->asunto = null;
			$respuesta->exito = false;
			$respuesta->errores = array();
			$respuesta->mensajes = array();
			
			
			
				$sql = "SELECT * FROM `pacientes` WHERE `IdPaciente` = '$IdPaciente' LIMIT 1";
				
				$result = DAL::executeNonQuery($sql);
				
				if ($result["Error"] != true)
				{
					$respuesta->exito = true;
					
					$respuesta->asunto = mysql_fetch_object($result, PacienteEntity);
					//$respuesta->mensajes = $result;
				}
				else
				{
					array_push($respuesta->errores, "El numero de cedula no se encuentra registrado");
				}
			
			/*echo "<pre>";
			print_r($respuesta->asunto);
			echo "</pre>";
			return $respuesta;*/
		//}

}

?>