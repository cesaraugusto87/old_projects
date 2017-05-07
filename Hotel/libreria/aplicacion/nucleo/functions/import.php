<?php
/**
 * import function
 * Author: Maikel Salazar
 * Version: 0.2
 * Date:  10 Oct 2008
 * Requirements: php 5 or higher
*/
if( !defined( 'PFW_Version' ) )
{
	define('PFW_Version', '0.2' );
	define('APPLICATION_PATH', dirname(dirname(dirname(dirname(__FILE__)))) );
	define('DELIMITER_PACKAGE', '.' );
	define('DELIMITER_PATH', '/' );
	define('PHP_EXT', 'php' );
	define('WILDCART', '*' );
	$trace = array();
	function import( $path)
	{
		$dirname = getDir($path);
		$file = str_replace(DELIMITER_PACKAGE, DELIMITER_PATH, $path);
		$classname = basename($file);
		$packageReturn = false;		
		if ($classname == WILDCART)
		{
			$gd = opendir($dirname); 
			while (($filename = readdir($gd)) !== false) {

				$info = pathinfo($dirname . $filename);
				if ($info["extension"] == PHP_EXT)
				{
					
					$included = includeClass( $dirname .$filename, $info["filename"]);
					$packageReturn = $packageReturn || $included;
				}
			}
		}
		else
		{
			$packageReturn = includeClass( $dirname .$classname . "." . PHP_EXT, $classname);
		}
		return $packageReturn;		
	}
	
	function includeClass( $path, $classname)
	{
		$included = true;
		if (!imported($classname))
		{
			$catchError = include_once( $path);
			$included = imported($classname) ;
			if (!$included)
			{
				printError($path, $classname, !$catchError);
			}
		}
		return $included;
	}
	
	function printError ( $path)
	{
		
		global $trace;
		
		echo "$classname class can't be loaded. Error detected in: 
			File:". $trace["file"] . ". 
			Line:" . $trace["line"] . ". 
			Function: import('". $trace["args"][0]."') <br />" ;
	}
	
	function getDir ( $path)
	{
		global $trace;
		$file = str_replace(DELIMITER_PACKAGE, DELIMITER_PATH, $path);
		$dirname = dirname($file);
		$trace = debug_backtrace();
		$trace = $trace[1];
		if ( $path == $file) // relative and same directory
		{
			$dirname = dirname($trace["file"]) . DELIMITER_PATH;
		}
		else
		{
			// relative and different directory
			$dirname = dirname($trace["file"]) . DELIMITER_PATH . dirname($file) . DELIMITER_PATH;
		}
		if (!is_dir($dirname)) // is it not relative directory?
		{
			$dirname =  APPLICATION_PATH . DELIMITER_PATH .  dirname($file) . DELIMITER_PATH;
		}
		return $dirname;
	}
	
	function imported( $Classname)
	{
		return class_exists($Classname) or interface_exists($Classname);
	}
}
?>