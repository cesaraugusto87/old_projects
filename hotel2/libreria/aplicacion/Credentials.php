<?php


import("libreria.nucleo.classes.SessionManager");
import("libreria.nucleo.classes.DAL");
import("libreria.aplicacion.entidades.UsuarioEntity");

class Credentials
{
	private $sm;
	public function __construct()
	{
		$this->sm =  new SessionManager();
	}
	
	public function login( $user, $password )
	{
		$password = md5($password);
		$user = DAL::cleanSQLParam($user);
		
		$sql = "SELECT * FROM `usuario` WHERE `Login` = '$user' AND `Password` = '$password' LIMIT 1";
		
		$result = DAL::createDataSet($sql);
		
		if ($result["Error"] != true)
		{
			if (mysql_num_rows($result)==1)
			{
				$user = new UsuarioEntity();
				$obj = mysql_fetch_object($result, UsuarioEntity);
				$this->sm->register(__CLASS__, $obj);
				return true;
			}
		}
		return false;
	}
	
	public function getCredentials()
	{
		return $this->sm->getVar(__CLASS__);
	}
	
	function haveAccess( $IdTipo )
	{
		$credentials = $this->sm->getVar(__CLASS__);
		if($credentials instanceof UsuarioEntity)
		{
			return $credentials->IdTipo <= $IdTipo;
		}
		return false;
	}	
	function islogged()
	{
		$credentials = $this->sm->getVar(__CLASS__);
		return isset($credentials);
	}	
	
	public function logout()
	{
		$this->sm->unsetVar(__CLASS__);
	}

}

?>