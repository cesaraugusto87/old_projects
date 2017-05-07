<?php


include_once( dirname(dirname(dirname(__FILE__))). "/conf.php");

class Config
{
	
	public static $conf;
	
	
	
	public static function getValue( $name)
	{
		if (!isset(self::$conf))
		{
			global $conf;
			self::$conf = $conf;
		}
		
		if ( isset(self::$conf[$name]))
		{
			return  self::$conf[$name];
		}
		else
		{
			trigger_error("'$name' no esta en los parametros de configuracion");
			return false;
		}
	}
	
}

?>