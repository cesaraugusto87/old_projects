<?php



class SessionManager
{
	public function __construct()
	{
		@session_start();
	}
	
	public function register( $name, $value)
	{
		$_SESSION[$name]= $value;
	}
	
	public function setVar($name, $value)
	{
		$this->register($name, $value);
	}
	
	public function getVar($name)
	{
		return $_SESSION[$name];
	}
	public function unsetVar($name)
	{
		if (isset($_SESSION[$name]))
		{
			$_SESSION[$name] = null;
		}
	}
	
	public function clean()
	{
		$_SESSION = array();
	}

}
?>