<?php

import("libreria.nucleo.classes.DAL");
import("libreria.nucleo.classes.Utils");
import("entidades.UsuarioEntity");

class Usuario
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
		
		
			
		if (!Departamento::esDepartamento($registro["IdDepartamento"]))
		{
			array_push($respuesta->errores, "El campo Departamento es incorrecto.");
		}
		
		if (!self::esTipoUsuario($registro["IdTipo"]))
		{
			array_push($respuesta->errores, "El Tipo de usuario es incorrecto.");
		}
			
		if (!Utils::strIsValidate($registro["Nombre"]))
		{
			array_push($respuesta->errores, "El campo Nombre es incorrecto.");
		}
			
		if (!Utils::strIsValidate($registro["Apellido"]))
		{
			array_push($respuesta->errores, "El campo Apellido es incorrecto.");
		}
		
		if (!Utils::isEmail($registro["Email"]))
		{
			array_push($respuesta->errores, "La direccion de correo es incorrecta.");
		}
		
		if (!Utils::strIsValidate($registro["Login"]))
		{
			array_push($respuesta->errores, "El campo Login es obligatorio");
		}
		
		if (self::loginExiste($registro["Login"]))
		{
			array_push($respuesta->errores, "Este login ya se encuentra registrado");
		}
		
		if (!Utils::strIsValidate($registro["Password"]))
		{
			array_push($respuesta->errores, "Falta Password");
		}
		
		if ($registro["Password"] != $registro["ConfirmPassword"])
		{
			array_push($respuesta->errores, "Las contraseñas no coinciden, revise.");
		}
		
		
		
		if (empty($respuesta->errores))
		{
			$dep = DAL::cleanSQLParam($registro["IdDepartamento"]);
			$tipo = DAL::cleanSQLParam($registro["IdTipo"]);
			$nombre = DAL::cleanSQLParam($registro["Nombre"]);
			$apellido = DAL::cleanSQLParam($registro["Apellido"]);
			$login = DAL::cleanSQLParam($registro["Login"]);
			$clave = md5($registro["Password"]);
			$email = DAL::cleanSQLParam($registro["Email"]);
			$sql = "INSERT INTO `usuario` (IdUsuario, IdDepartamento, Idtipo, Nombre, Apellido, Login, Password, Email) VALUES ('', '$dep', '$tipo', '$nombre', '$apellido', '$login', '$clave', '$email')";
			$result = DAL::executeNonQuery($sql);
			
			if ($result["Error"] != true)
			{
				$respuesta->exito = true;
				$respuesta->asunto = DAL::$lastID;
				array_push($respuesta->mensajes, "Se ingreso el usuario exitosamente");
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
	
	public static function loginExiste( $login)
	{
		$login = DAL::cleanSQLParam($login);
		$sql  = "SELECT 'true' FROM `usuario` WHERE Login ='$login' LIMIT 1";
		$result = DAL::createDataSet($sql);
		if ($result["Error"] != true)
		{
			return @mysql_num_rows($result) == 1;
		}
		return true;

	}
	
	public function modificar ( $registro)
	{
		$respuesta = new stdClass();
		
		$respuesta->exito = false;
		$respuesta->errores = array();
		$respuesta->mensajes = array();
		

		
		if (!self::esUsuario($registro["IdUsuario"]))
		{
			$sol = $registro["IdUsuario"];
			array_push($respuesta->errores, "'$sol' no un nro. de usuario  valido");
			
		}
		if (!Departamento::esDepartamento($registro["IdDepartamento"]))
		{
			array_push($respuesta->errores, "El campo Departamento es incorrecto.");
		}
		
		if (!self::esTipoUsuario($registro["IdTipo"]))
		{
			array_push($respuesta->errores, "El Tipo de usuario es incorrecto.");
		}
		
		if (!Utils::strIsValidate($registro["Nombre"]))
		{
			array_push($respuesta->errores, "El campo Nombre es obligatorio.");
		}
		
		if (!Utils::strIsValidate($registro["Apellido"]))
		{
			array_push($respuesta->errores, "El campo Apellido es obligatorio.");
		}
		
		if (!Utils::isEmail($registro["Email"]))
		{
			array_push($respuesta->errores, "La direccion de correo es incorrecta.");
		}
		
		if (!Utils::strIsValidate($registro["Login"]))
		{
			array_push($respuesta->errores, "El campo Login es obligatorio");
		}
		
		if (self::loginExiste($registro["Login"]))
		{
			$propietario = $this->consultar($registro["IdUsuario"]);
			
			if ($propietario->exito)
			{
				if ($registro["Login"] != $propietario->asunto->Login)
				{
					array_push($respuesta->errores, "Este login ya se encuentra registrado");
				}
			}
		}
		
		$cambiarPassword = false;
		if (Utils::strIsValidate($registro["Password"]) || Utils::strIsValidate($registro["ConfirmPassword"]))
		{
			if ($registro["Password"] != $registro["ConfirmPassword"])
			{
				array_push($respuesta->errores, "Las contraseñas no coinciden, revise.");
			}
			else 
			{
				$cambiarPassword = true;
			}
		}
		

		if (empty($respuesta->errores))
		{
			$IdUsuario = $registro["IdUsuario"];
			$dep = DAL::cleanSQLParam($registro["IdDepartamento"]);
			$tipo = DAL::cleanSQLParam($registro["IdTipo"]);
			$nombre = DAL::cleanSQLParam($registro["Nombre"]);
			$apellido = DAL::cleanSQLParam($registro["Apellido"]);
			$email= DAL::cleanSQLParam($registro["Email"]);
			$login = DAL::cleanSQLParam($registro["Login"]);
			if ($cambiarPassword)
			{
				$clave = md5($registro["Password"]);
				 $clave = ", `Password` = '$clave'";
			}
			else 
			{
				$clave= '';
			}
			$email = DAL::cleanSQLParam($registro["Email"]);
			$sql = "UPDATE `usuario` SET `IdDepartamento` = '$dep', `IdTipo` = '$tipo', `Nombre` = '$nombre', `Apellido` = '$apellido', `Login` = '$login', `Email` = '$email' $clave WHERE `IdUsuario` = '$IdUsuario' LIMIT 1";
			$result = DAL::executeNonQuery($sql);
			if ($result["Error"] != true)
			{
				$respuesta->exito = true;
				array_push($respuesta->mensajes, "Se actualizo el usuario exitosamente");
			}
			else
			{
				array_push($respuesta->errores, "no pudimos conectar a la base de datos");
			}
			
		
		}
		return $respuesta;
	}
	
	public function eliminar ( $IdUsuario)
	{
		$respuesta = new stdClass();
		$respuesta->exito = false;
		$respuesta->errores = array();
		$respuesta->mensajes = array();
		
		if (!Utils::isInteger($IdUsuario))
		{
			array_push($respuesta->errores, "'$IdUsuario' no es  una solicitud valida");
		}
		
		if (empty($respuesta->errores))
		{
			$sql = "DELETE FROM `usuario` WHERE `IdUsuario` = '$IdUsuario' LIMIT 1";
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
	
	
	public function consultar ( $IdUsuario)
	{
		
		$respuesta = new stdClass();
		$respuesta->asunto = null;
		$respuesta->exito = false;
		$respuesta->errores = array();
		$respuesta->mensajes = array();
		
		if (!self::esUsuario($IdUsuario))
		{
			array_push($respuesta->errores, "Usuario no existe");
		}
		
		if (empty($respuesta->errores))
		{
		
			$sql = "SELECT * FROM `usuario` WHERE `IdUsuario` = '$IdUsuario' LIMIT 1";
			$result = DAL::executeNonQuery($sql);
			if ($result["Error"] != true)
			{
				$respuesta->exito = true;
				//$respuesta->mensajes = $result;
				$respuesta->asunto = mysql_fetch_object($result, UsuarioEntity);
			}
			else
			{
				array_push($respuesta->errores, "no pudimos conectar a la base de datos");
			}
		
		}
		return $respuesta;
	}
	
	public function buscar( $FormVars,$pagina = null)
	{
		
		$sqlCriterio = "1";
		if (Utils::strIsValidate($FormVars["criterio"]))
		{
			$criterio = DAL::cleanSQLParam($FormVars["criterio"]);
			
			
			if (isset($FormVars["Nombre"]))
			{
				$sqlCriterio .= " AND U.Nombre LIKE '%$criterio%'";
			}
			
			if (isset($FormVars["Apellido"]))
			{
				$sqlCriterio .= " AND U.Apellido LIKE '%$criterio%'";
			}
			
			if (isset($FormVars["Login"]))
			{
				$sqlCriterio .= " AND U.Login LIKE '%$criterio%'";
			}
		}
		
		if (Departamento::esDepartamento($FormVars["IdDepartamento"]))
		{
			$sqlDepartamento = " AND U.IdDepartamento = '".$FormVars["IdDepartamento"]."' ";
		}
		else
		{
			$sqlDepartamento = " AND 1 ";
		}
		
		if (self::esTipoUsuario($FormVars["IdTipo"]))
		{
			$sqlTipo = " AND U.IdTipo = '".$FormVars["IdTipo"]."' ";
		}
		else
		{
			$sqlTipo = " AND 1 ";
		}
		
		$sql = "SELECT 
						U.IdUsuario,
						U.Nombre,
						U.Apellido,
						U.Login,
						U.Email,
						D.Nombre AS `Departamento`,
						T.Nombre AS `Tipo` 
				FROM `usuario` U 
				INNER JOIN `departamento` D ON D.IdDepartamento = U.IdDepartamento
				INNER JOIN `tipo_usuario` T ON T.IdTipo = U.IdTipo
				WHERE $sqlCriterio  $sqlDepartamento $sqlTipo ORDER BY U.Nombre ASC";
				
				
			if ($pagina == null)
			{
				$result = DAL::createDataSet($sql);
				
			}
			else
			{
				$result = DAL::createDataSetPage($sql, 10, $pagina);
			}
			$this->accion = true;
			
			//$result = DAL::createDataSet($sql);
			/*echo "<pre>";
			print_r($result);
			echo "<pre>";*/
		
			return $result;
			
			//return false;
	}
	
	public function consultar_n ( $Nombre)
	{
		
		$respuesta = new stdClass();
		$respuesta->exito = false;
		$respuesta->errores = array();
		$respuesta->mensajes = array();
		
		if (!Utils::strIsValidate($Nombre))
		{
			array_push($respuesta->errores, "'$Nombre' no es un nombre de usuario valido");
		}
		
		if (empty($respuesta->errores))
		{
		
		$sql = "SELECT * FROM `usuario` WHERE `Nombre` = '$Nombre'";
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
	
	public function consultar_l ( $Login)
	{
		
		$respuesta = new stdClass();
		$respuesta->exito = false;
		$respuesta->errores = array();
		$respuesta->mensajes = array();
		
		if (!Utils::strIsValidate($Login))
		{
			array_push($respuesta->errores, "'$Login' login no Registrado");
		}
		
		if (empty($respuesta->errores))
		{
		
			$sql = "SELECT * FROM `usuario` WHERE `Login` = '$Login'";
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
	
	public static  function esUsuario( $id)
	{
		if ( !Utils::isInteger($id))
		{
			return  false;
		}
		$sql = "SELECT * FROM `usuario` WHERE _rowid = '$id' LIMIT 1";
		$result = DAL::createDataSet($sql);
		if ($result["Error"] != true)
		{
			return mysql_num_rows($result) ==1;
		}
		return false;
	}
	
	public static  function esTipoUsuario( $id)
	{
		if ( !Utils::isInteger($id))
		{
			return  false;
		}
		$sql = "SELECT * FROM `tipo_usuario` WHERE _rowid = '$id' LIMIT 1";
		$result = DAL::createDataSet($sql);
		if ($result["Error"] != true)
		{
			return mysql_num_rows($result) ==1;
		}
		return false;
	}
	
	public static function getTipoUsuarios()
	{
		$sql = "SELECT * FROM `tipo_usuario` ORDER BY Nombre ASC";
		$result = DAL::createDataSet($sql);
		if ($result["Error"]!= true)
		{
			return $result;
		}
		return  false;
	}
	
	
	
	
}

?>