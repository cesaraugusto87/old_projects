<?php

include_once( dirname (__FILE__) . "/import.php");
import("nucleo.classes.DAL");
import("nucleo.classes.Utils");
import("entidades.ReporteEntity");


class Reportes
{
		
	public $resultados;
	
	private $accion = false;
	
	public function __construct()
	{
		//Not implmented yet	
	}
	
	
	public function agregar ($registro)
	{
		
		
		// si se presiono el boton de registrar y accion es agregar
		if (isset($registro["registrar"]) and $registro["accion"]=="agregar") 
		{
			$this->accion = true;
			$respuesta = $this->validacionAgregar($registro);
			
			
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

			
		}
		
		$vars = $this->prepararFormularioAgregar($registro);
		$web = new SolicitudWeb();
		
		return $web->getFormAgregar($vars);
		
	}
	
	
	
	
	public function prepararFormularioAgregar( $registro)
	{
		
		$ver = $this->buscar_ver($registro["Cedula"]);
		
		$credentials = new Credentials();
		if (isset($ver))
		{
		$FormVars["Cedula"]		=	$ver->IdUsuario;
		$FormVars["Nombre"]			=	$UsuarioRegistro->Nombre;
		$FormVars["Apellido"]		=	$UsuarioRegistro->Apellido;
		$d= $this->consultar_dep($UsuarioRegistro->IdDepartamento);
		$FormVars["departamentos"]	=	$d->mensajes;
		$FormVars["Estado"]='Nuevo';
		$FormVars["accion"]='agregar';
		$FormVars["errores"]=	$registro["errores"];
		$FormVars["mensajes"]=	$registro["mensajes"];
		}
		
		return $FormVars;
	}
	
	public function validacionAgregar ( $registro)
	{
		$respuesta = new stdClass();
		
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
		

		return $respuesta->errores;
	}
	
	
	 function buscar_ver ($cedula)
	{
	echo "<pre>";
	print_r($cedula);
	echo "</pre>";
		
		$respuesta = new stdClass();
		
		$respuesta->exito = false;
		$respuesta->errores = array();
		$respuesta->mensajes = array();
		
	
	
	$sql = "SELECT * FROM `pacientes` WHERE `Cedula` = '$cedula' LIMIT 1";
				$result = DAL::executeNonQuery($sql);
			
			if ($result["Error"] != true)
			{
				$respuesta->exito = true;
				
				$respuesta->asunto = mysql_fetch_object($result, PacienteEntity);
				//$respuesta->asunto = $result;
			}
			else
			{
				array_push($respuesta->errores, "no pudimos conectar a la base de datos");
			}
		/*echo "<pre>";
	print_r($result);
	echo "</pre>";*/
	}
		//return $respuesta
	
	}
	
	
	
	public function buscar ($registro)
	{
		if (isset($registro["buscar"]))
		{
			$this->validacionBuscar($registro);
			if (isset($registro["solicitud"]))
			{
				$id = $registro["solicitud"];
				$sql = "SELECT 
								S.*,
								CONCAT(U.Nombre,' ',U.Apellido) AS NombreUsuario
						FROM `solicitud` AS S
						LEFT JOIN `usuario` AS U ON S.IdUsuario = U.IdUsuario
						WHERE S.
						_rowid = '$id' LIMIT 1";
			}
			else
			{
				if (isset($registro["estado"]))
				{
					$estado = $registro["estado"];
					$sqlEstado = "AND S.Estado = '$estado'";
				}
				else
				{
					$sqlEstado = "AND 1";
				}
				
				if (isset($registro["fecha_inicio"],$registro["fecha_fin"]))
				{
					$fechaIni = $registro["fecha_inicio"];
					$fechaFin = $registro["fecha_fin"];
					$sqlFecha = "AND S.`Fecha` BETWEEN '$fechaIni' AND '$fechaFin'";
					
				}
				else
				{
					$sqlFecha = "AND 1";
				}
				
				if (isset($registro["IdDepartamento"]))
				{
					$IdDepartamento = $registro["IdDepartamento"];
					$sqlDep = "AND D.IdDepartamento = '$IdDepartamento'";
				}
				else
				{
					$sqlDep = "AND 1";
				}
				
				$sql = "SELECT 
								S.*,
								CONCAT(U.Nombre,' ',U.Apellido) AS NombreUsuario
						FROM `solicitud` AS S
						LEFT JOIN `usuario` AS U ON S.IdUsuario = U.IdUsuario
						LEFT JOIN `departamento` AS D ON D.IdDepartamento = U.IdDepartamento
						WHERE 1 $sqlEstado $sqlFecha $sqlDep";
				
			}
			$this->resultados = DAL::createDataSet($sql);
			$this->accion = true;
		}

		$vars = $this->prepararFormularioBuscar($registro);
		$web = new SolicitudWeb();
		return $web->getFormBuscar($vars);
	}
	
	public function validacionBuscar(&$registro)
	{
		$respuesta = new stdClass();
		
		$respuesta->exito = false;
		$respuesta->errores = array();
		$respuesta->mensajes = array();
		
		if (!Utils::isInteger($registro["solicitud"]))
		{
			unset($registro["solicitud"]);
		}
		
		if (!in_array($registro["estado"], self::$estados))
		{
			unset($registro["estado"]);
		}
		
		if (Utils::isDate($registro["fecha_inicio"]))
		{
			if (!Utils::isDate($registro["fecha_fin"]))
			{
				$registro["fecha_fin"] = date("Y-m-d"); // Dia de hoy!
			}
		}
		else
		{
			unset($registro["fecha_inicio"]);
			unset($registro["fecha_fin"]);
		}
		
		if (!Departamento::esDepartamento($registro["IdDepartamento"]))
		{
			unset($registro["IdDepartamento"]);
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
		if (self::esSolicitud($registro["IdSolicitud"]))
		{
			$resource = $this->obtenerSolicitud($registro["IdSolicitud"]);
			$web = new SolicitudWeb();
			$vars = mysql_fetch_array($resource);
			setlocale(LC_TIME, 'es_ES');
			$vars["Fecha"] = date("d/m/Y", strtotime($vars["Fecha"]));
			$vars["Contenido"] = nl2br($vars["Contenido"]);
			$d = $this->consultar_depsol($vars["IdUsuario"]);
			$dep = $this->consultar_dep($d->mensajes);
			$vars["departamento"] = $dep->mensajes;
			$idsolicitud = $vars["IdSolicitud"];
			if ($registro["Adjunto"] == null)
			{
			
				$vars["archivo_adjunto"] = "<div class=\"datos\"><b>Archivo Adjunto:</b> <a href=\"descarga.php?idsolicitud=$idsolicitud\">Descargar Archivo</a></div>" ;
			}
			$detalle = $web->getVerDetalle($vars);
		}
		else
		{
			$detalle = "Solicitud no valida";
		}
		return $detalle;
	}
	
	
	
	public function prepararFormularioAtender( $registro)
	{
		$registro["estado_" . strtolower($registro["estado"])] = 'selected="selected"';
		return $registro;
	}
#####################################

public function verDetalleusu( $registro)
	{
		if (self::esSolicitud($registro["IdSolicitud"]))
		{
			$seguimiento = $this->obtenerSeguimiento($registro["IdSolicitud"]);
			$resource = $this->obtenerSolicitud($registro["IdSolicitud"]);
			$web = new SolicitudWeb();
			$vars = mysql_fetch_array($resource);
			setlocale(LC_TIME, 'es_ES');
			$vars["Fecha"] = date("d/m/Y", strtotime($vars["Fecha"]));
			$vars["Contenido"] = nl2br($vars["Contenido"]);
			$vars["Estado"] = $vars["Estado"];
			$dep = $this->consultar_dep($vars["IdDepartamento"]);
			$vars["departamento"] = $dep->mensajes;
			$seg = mysql_fetch_array($seguimiento);
			$vars["atendido"] = $seg["Contenido"];
	
			if (Utils::strIsValidate($vars["Adjunto"]))
			{
			
				$idsolicitud = $vars["IdSolicitud"];
				$vars["archivo_adjunto"] = "<div class=\"datos\"><b>Archivo Adjunto:</b> <a href=\"descarga.php?idsolicitud=$idsolicitud\">Descargar Archivo</a></div>" ;
			}
			
			if (Utils::strIsValidate($seg["Adjunto"]))
			{
			
				$IdSeguimiento = $seg["IdSeguimiento"];
				$vars["respuesta_archivo_adjunto"] = "<div class=\"datos\"><b>Archivo Adjunto:</b> <a href=\"descarga.php?idseguimiento=$IdSeguimiento\">Descargar Archivo</a></div>" ;
			}
	
			$detalle = $web->getVerDetalleusu($vars);
		}
		else
		{
			$detalle = "Solicitud no valida";
		}
		return $detalle;
	}
	
	


#####################################
	
	
	public function getResultados($IdUsuario )
	{
		$web = new SolicitudWeb();
		
		if (!$this->accion)
		{
			$this->resultados = $this->obtenerTodos($IdUsuario);
		}
		
		return $web->getFormResultados($this->resultados);
	}
	
	public function obtenerTodos ($IdUsuario)
	{
	

		$sql = "SELECT 
								S.*,
								CONCAT(U.Nombre,' ',U.Apellido) AS NombreUsuario
						FROM `solicitud` AS S
						INNER JOIN `usuario` AS U ON S.IdUsuario = U.IdUsuario 
						WHERE S.IdUsuario = '$IdUsuario' ";
		$result = DAL::createDataSet($sql);
		return $result;
	}
	
	################################################################
	public function getResultadosAdministrador($IdDepartamento)
	{
		$web = new SolicitudWeb();
		
		if (!$this->accion)
		{
			$this->resultados = $this->obtenerTodosAdministrador($IdDepartamento);
		}
		
		return $web->getFormResultados($this->resultados);
	}
	
	public function obtenerTodosAdministrador ($IdDepartamento)
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
	
	public function obtenerNuevas ($IdDepartamento)
	{
		$sql = "SELECT 
								S.*,
								CONCAT(U.Nombre,' ',U.Apellido) AS NombreUsuario
						FROM `solicitud` AS S
						INNER JOIN `usuario` AS U ON S.IdUsuario = U.IdUsuario
						WHERE S.Estado = 'Nuevo' and S.IdDepartamento = '$IdDepartamento' ";
		$result = DAL::createDataSet($sql);
		$this->resultados = $result;
		$this->accion = true;
		return @mysql_num_rows($result);
	}
	
	
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
	
	public function obtenerSolicitud( $IdSolicitud)
	{

		if (Utils::isInteger($IdSolicitud))
		{
			$sql = "SELECT 
								S.*,
								CONCAT(U.Nombre,' ',U.Apellido) AS NombreUsuario
						FROM `solicitud` AS S
						LEFT JOIN `usuario` AS U ON S.IdUsuario = U.IdUsuario
						WHERE S.IdSolicitud = '$IdSolicitud' LIMIT 1";
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
	
	
	
	public function consultar_tipo ( $IdTipo)
	{
		
		$respuesta = new stdClass();
		$respuesta->exito = false;
		$respuesta->errores = array();
		$respuesta->mensajes = array();
		
		if (!Usuario::esTipoUsuario($IdTipo))
		{
			array_push($respuesta->errores, "'$Idtipo' no es un tipo de usuario  valido");
		}
		
		if (empty($respuesta->errores))
		{
			$sql = "SELECT Nombre FROM `tipo_usuario` WHERE `IdTipo` = '$IdTipo' LIMIT 1";
			$result = DAL::executeNonQuery($sql);
			if ($result["Error"] != true)
			{
				$respuesta->exito = true;
				$arrTipo = mysql_fetch_array($result);
				$respuesta->mensajes = $arrTipo["Nombre"];
			}
			else
			{
				array_push($respuesta->errores, "no pudimos conectar a la base de datos");
			}
		}
		return $respuesta;
	}
	
	public function Ver_fecha ( $IdSolicitud)
	{
		
		$respuesta = new stdClass();
		$respuesta->exito = false;
		$respuesta->errores = array();
		$respuesta->mensajes = array();
		$sql = "SELECT * FROM `solicitud` WHERE `IdSolicitud` = '$IdSolicitud' LIMIT 1";
		$result = DAL::executeNonQuery($sql);
	
		if ($result["Error"] != true)
			{
				$respuesta->exito = true;
				$arrFecha = mysql_fetch_array($result);
				$respuesta->mensajes = $arrFecha["Fecha"];
			}
			else
			{
				array_push($respuesta->errores, "no pudimos conectar a la base de datos");
			}
		return $respuesta;
	}
	
	
	
	public static  function esNuevaSolicitud( $id)
	{
		if ( !Utils::isInteger($id))
		{
			return  false;
		}
		$sql = "SELECT 'true' FROM `solicitud` WHERE _rowid = '$id' AND `Estado` = 'Nuevo' LIMIT 1";
		$result = DAL::createDataSet($sql);
		if ($result["Error"] != true)
		{
			return mysql_num_rows($result) ==1;
		}
		return false;
	}
	
	
	public static  function esSolicitud( $id)
	{
		if ( !Utils::isInteger($id))
		{
			return  false;
		}
		$sql = "SELECT 'true' FROM `solicitud` WHERE _rowid = '$id' LIMIT 1";
		$result = DAL::createDataSet($sql);
		if ($result["Error"] != true)
		{
			return mysql_num_rows($result) ==1;
		}
		return false;
	}
	
	
	public function consultar_dep ( $IdDepartamento)
	{
	
		$respuesta = new stdClass();
		$respuesta->exito = false;
		$respuesta->errores = array();
		$respuesta->mensajes = array();
		
		if (!Utils::isInteger($IdDepartamento))
		{
			return  false;
		
		}
		
		$sql = "SELECT * FROM `departamento` WHERE IdDepartamento = '$IdDepartamento' LIMIT 1";
		$result = DAL::createDataSet($sql);
		
		if ($result["Error"] != true)
		{
		
				$respuesta->exito = true;
				$dep = mysql_fetch_array($result);
				$respuesta->mensajes = $dep["Nombre"];
			
		}
		
		else
		{
		
		array_push($respuesta->errores, "no pudimos conectar a la base de datos");
		
		}
		return $respuesta;
	}
	
	
	public function consultar_depsol ( $IdUsuario)
	{
	
		$respuesta = new stdClass();
		$respuesta->exito = false;
		$respuesta->errores = array();
		$respuesta->mensajes = array();
		
		
		
		$sql = "SELECT * FROM `usuario` WHERE IdUsuario = '$IdUsuario' LIMIT 1";
		$result = DAL::createDataSet($sql);
		
		if ($result["Error"] != true)
		{
		
				$respuesta->exito = true;
				$dep = mysql_fetch_array($result);
				$respuesta->mensajes = $dep["IdDepartamento"];
			
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
	
	
}

?>