<?php
class Config
{
	
	public static $conf;
	public static function getValue( $name)
	{
		if (!isset(self::$conf))
		{
			
			self::$conf = include_once( dirname(dirname(dirname(dirname(__FILE__)))). "/conf.php");
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