<?php
/**
 *Template Class
 * Author: Maikel Salazar
 * Version: 0.1
 * Date:  18 Jul 2008
 * Requirements: php 5 or higher
*/

class Template
{
	const EXT = ".tpl";
	private $dir;
	private $tplGross;
	private $tplProcessed ;
	private $filename;
	private $tplVars;
	public function __construct()
	{
		$this->dir = "";
		$this->tplGross = "";
		$this->tplProcessed = "";
		$this->filename = "";
		$this->tplVars = array();		
	}
	
	// :::: SETTERS ::::

	// alias of setPath
	public function setDir( $dirname)
	{
		return $this->setPath($dirname);
	}
	// Set the directory from templates file will be read
	public function setPath($dirname)
	{
		$setted	= false;
		if (is_dir($dirname))
		{
			
			$this->dir = rtrim($dirname,"/") . "/";
			$setted = true;
		}
		else
		{
			$trace = debug_backtrace();
			$this->setData("[Error Found in: File: ". $trace[0]["file"] .". line: ". $trace[0]["line"]. ". Subject: $dirname missed ]");
		}
		return $setted;
	}
	
	// alias of setTemplate
	public function setFile($filename, $isTPLFile = true)
	{
		return $this->setTemplate($filename, $isTPLFile);
	}

	// Set template file to process
	public function setTemplate($filename,$isTPLFile = true)
	{
		$setted	= false;
		
		$filename = $this->dir . $filename;
		if ($isTPLFile)
		{
			$filename .=  self::EXT;
		}
		
		
		if (is_file($filename))
		{
			$contents =  file_get_contents($filename);
			if ($contents !== FALSE)
			{
				$this->tplGross =  $contents;
				$this->tplVars = $this->getTemplateVars();
				$this->setVars($this->tplVars);
				$this->filename = $filename;
				$setted	= true;
			}
		}
		
		if (!$setted)
		{
			$trace = debug_backtrace();
			$this->setData("[Error Found in: File: ". $trace[0]["file"] .". line: ". $trace[0]["line"]. ". Subject: $filename missed ]");
			
		}
		
		return $setted;
	}
	
	public function loadTPLDataFromFile ( $filename)
	{
		
	}
	
	// alias of setData
	public function setString ( $string)
	{
		return $this->setData($string);
	}
	
	// set a string as tpl
	public function setData ( $string)
	{
		$this->tplGross = $string;
		$this->tplVars 	= $this->getTemplateVars();
		$this->setVars($this->tplVars);
		$this->filename = "";
		return true;
	}
	
	public function setVars($vars)
	{
		$setted	= false;
		if (is_object($vars) or is_array($vars))
		{
			$vars = (array) $vars;
			$vars = array_merge($this->tplVars, $vars);
			$gross = $this->tplGross;
			foreach ($vars as $varname => $value)
			{
				$gross = str_replace("{". $varname. "}", "$value", $gross);
			}
			$this->tplProcessed = $gross;
			$setted	= true;
		}
		return $setted;
	}
	
	// :::: GETTERS ::::
	
	// alias of getTemplateVars
	public function getVars($values = false)
	{
		return $this->getTemplateVars($values);
	}
	
	// returns all variables of the current template 
	public function getTemplateVars( $values = false)
	{
		$matches = array(); //initialize
		preg_match_all("/\{([^\s]+)\}/is", $this->tplGross, $matches);
		if (!empty($matches[1]))
		{
			$matches[1] = array_unique($matches[1]);
			if (!$values)
			{
				$nullValues = array();
				$nullValues  = array_pad( $nullValues  , count($matches[1]), null);
				return array_combine(array_values($matches[1]),$nullValues );
			}
			else
			{
				return $matches[1];
			}
		}
		return array();
	}

	public function getFileName()
	{
		return $this->filename;
	}
	
	// returns tpl as looks like
	public function getGross()
	{
		return $this->tplGross;
	}

	// alias of show()
	public function getProcessed()
	{
		return $this->show();
	}
	
	public function getDir()
	{
		return $this->dir;
	}

	// returns tpl processed
	public function show()
	{
		return $this->tplProcessed;
	}
	
	public function __toString()
	{
		return $this->show();
	}
}
?>