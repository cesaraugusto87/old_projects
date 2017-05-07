<?php
/* MySQL
*****************************************************************************
@  Copyright (c) 2006 Duxpoint 

Autor(es):  Dano (www.danonino.org) y Maik (www.escasala.com)
Propósito: clase para facilitar el uso de MySQL con php
Version:  0.9.1 
Fecha: 19 Mar 2006
Actualizada: 14 Ene 2007
Requirimientos:
	Interface IDatabase
	PHP Version >= 5
*****************************************************************************
*/

class MySQL 
{
	const MSG_WRN_NOT_VALID_RESOURCE	=	"Warning: Supplied argument is not a valid MySQL result resource";
	const MSG_WRN_DATA_CORRUPTED		=	"Warning: Data must be array with keys values [USER][PASSWORD][SERVER][DATABASE]. [REMOTING] is optional for AMF Services";
	const MSG_ERR_NO_SQL_STATEMENT		=	"No Sql Statement";
	const MSG_WRN_NO_SUBJECT			=	"No Subject";
	const MSG_WRN_NO_MESSAGE			=	"No Subject";
	const MSG_WRN_NO_NUMBER				=	"No Number";
	const errorTypeMySQL 				=	"MySQL";
	const errorTypeLuser 				=	"Luser";
	public $configFolder 				=	"config/";
	public $configFile					=	"data_connection.php";
	public $tplError 					=	"error_mysql";
	public $tplWrn	 					=	"warning_mysql";
	public $debugMode 					=	false;
	public $errorsStore;
	public $errorType;
	public $warningsStore;
	public $resource;
	public $lastID;
	public $data;
	
	public function __construct( )
	{
		$this->errorsStore 		=	array();
		$this->warningsStore 	=	array();
	}
	
	public function doQUERY( $saSql = NULL ){
		$noErrors = true;
		if ( !isset($saSql) )
		{
			$this->errorHandler( );
			return false;
		}
		if ( !is_array($saSql))
		{
			$saSql		=	array($saSql);
		}
		if (!$this->connect( ))
		{
			return false;
		} 
		else
		{
			foreach($saSql as $key => $slSql)
			{
				$resources[$key]=  @mysql_query( $slSql );
				if( !end($resources))
				{
					$this->errorType = self::errorTypeMySQL;
		  			$this->errorHandler( $slSql );
					$noErrors = false;
				}
			}
		}
		$this->lastID	=	@mysql_insert_id();
		$this->close();
		if ($this->isResource())
		{
			$this->freeResult();
		}
		reset($resources);
		$this->resource=(count($resources)==1)?current($resources):$resources;
		return $noErrors;
	}
	
	private function isResource()
	{
		if (!is_array($this->resource))
		{
			$this->resource		=	array($this->resource);
		}
		foreach ($this->resource as $resource)
		{
			if (!is_resource($resource))
			{
				return false;
			}
		}
		return true;
	}
	
	public function setData ( $data = NULL )
	{
		if ((!is_array($data)) && (is_file($this->configFolder.$this->configFile))) 
		{
			include_once($this->configFolder.$this->configFile);
			$this->data = getConnectionData($data);
		} 
		else
		{
			$this->data = $data;
		}
		return $this->validateData( );
	}
	
	public function getData(  )
	{
		return $this->data;
	}
	
	private function validateData (  )
	{
		$valid = isset($this->data["USER"],$this->data["PASSWORD"],$this->data["SERVER"],$this->data["DATABASE"]);
		if (!$valid)
		{
			$this->errorType = self::errorTypeLuser;
			if (is_array($this->data))
			{
				$keys =	array_keys($this->data);
				foreach($keys as $key)
				{
					$wrnData.= "[".$key."]";
				}
			} 
			else
			{
				$wrnData = $this->data;
			}
			$this->warningHandler(self::MSG_WRN_DATA_CORRUPTED, $wrnData);
		}
		return $valid;
	}
	
	public function freeResult(  )
	{
		if (!is_array($this->resource))
		{
			$this->resource		=	array($this->resource);
		}  
		foreach ($this->resource as $resource)
		{
			if (!@mysql_free_result($resource))
			{
					$this->errorType	=	self::errorTypeMySQL;
					$this->warningHandler(self::MSG_WRN_NOT_VALID_RESOURCE,$resource);
			}
		}
		$this->resource	=	NULL;
	}
	
	public function connect(  )
	{
		if ( !$this->validateData(  ) )
		{
			return false;
		}
		$USER 				=	$this->data["USER"];
		$PASSWORD 			=	$this->data["PASSWORD"];
		$SERVER 			=	$this->data["SERVER"];
		$DATABASE 			=	$this->data["DATABASE"];
		$connection 		= 	@mysql_connect($SERVER, $USER, $PASSWORD);
		$this->errorType 	=	self::errorTypeMySQL;
		if( !$connection )
		{
			$this->errorHandler("Any");
			return false;
		}
		if( !@mysql_select_db( $DATABASE , $connection) )
		{
			$this->errorHandler("Any");
			return false;
		}
		return true;
	}
	
	public function close( )
	{
		@mysql_close( );
	}
	
	private function errorHandler(  )
	{
		$Arguments = func_get_args();
		switch ($this->errorType)
		{
				case self::errorTypeMySQL: 
					$ErrorSta = ( !$this->isEmpty($Arguments[0])) ? $Arguments[0] : self::MSG_ERR_NO_SQL_STATEMENT;
					$ErrorMsg = mysql_error();
					$ErrorNum = mysql_errno();
				break;
				case self::errorTypeLuser:
					$ErrorSta = ( !$this->isEmpty($Arguments[0])) ? $Arguments[0] : self::MSG_WRN_NO_SUBJECT;
					$ErrorMsg = ( !$this->isEmpty($Arguments[1])) ? $Arguments[1] : self::MSG_WRN_NO_MESSAGE;
					$ErrorNum =( !$this->isEmpty($Arguments[2])) ? $Arguments[2] : self::MSG_WRN_NO_NUMBER;
				break;
		}
		$this->addError($ErrorMsg, $ErrorNum, $ErrorSta, $this->errorType);
		if($this->debugMode)
		{
			$this->showErrors($this->errorsStore);
		}
	}
	
	private function warningHandler(  )
	{
		$Arguments 		=	func_get_args();
		$WarningMsg 	=	(!$this->isEmpty($Arguments[0])) ? $Arguments[0] : self::MSG_WRN_NO_MESSAGE;
		$WarningSubject =	(!$this->isEmpty($Arguments[1])) ? $Arguments[1] : self::MSG_WRN_NO_NUMBER;
		$this->addWarning($WarningMsg, $WarningSubject, $this->errorType);
		if($this->debugMode)
		{
			$this->showWarnings($this->warningsStore);
		}
	}
	
	private function addError($saErrorMsg, $saErrorNum, $saSub, $saType)
	{
		$mlError	=	array(
								"ERROR_MSG"	=>	$saErrorMsg,
								"ERROR_NUM" => 	$saErrorNum,
								"ERROR_SUB"	=>	$saSub, 
								"ERROR_TYPE" => $saType 
							);
		array_push($this->errorsStore, $mlError );
	}
	
	private function addWarning($saWarningMsg, $saWarningSubject, $saType )
	{
		$mlWarning	=	array(
								"WARNING_MSG"=>$saWarningMsg, 
								"WARNING_SUB"=>$saWarningSubject, 
								"WARNING_TYPE" => $saType 
							);
		array_push($this->warningsStore, $mlWarning );
	}
	
	private function showErrors(  )
	{
		$msgErrors = "";	
		if (!is_array($this->errorsStore))
		{
			return false;
		}
		if ($tpl = $this->getTemplate($this->tplError, $this->configFolder)){
			foreach ($this->errorsStore as $error)
			{
				$tpl->setVars($error);
				$msgErrors.=$tpl->show();
			}
		} 
		else 
		{
			foreach ($this->errorsStore as $error)
			{
				foreach ($error as $title => $value)
				{
					$msgErrors.= $title.": ". $value."<br />";

				}		
				$msgErrors.= "<hr>";
			}
		}
		if (!$this->data["REMOTING"])
		{
			echo $msgErrors;
		} 
		else
		{
			return $this->errorsStore;
		}

	}
	
	private function showWarnings(  )
	{
		if (!is_array($this->warningsStore))
		{
			return false;
		}
		$msgWarnings = "";		
		if ($tpl = $this->getTemplate($this->tplWrn, $this->configFolder))
		{
			foreach ($this->warningsStore as $warning)
			{
				$tpl->setVars($warning);
				$msgWarnings.= $tpl->show();
			}
		} 
		else
		{
			foreach ($this->warningsStore as $warning)
			{
				foreach ($warning as $title => $value)
				{
					$msgWarnings.= $title.": ". $value."<br />";

				}		
				$msgWarnings.= "<hr>";
			}
		}
		
		if (!$this->data["REMOTING"])
		{
			echo $msgWarnings;
		} 
		else
		{
			return $this->warningsStore;
		}		
	}
	
	private function getTemplate( $tplName , $tplPATH )
	{
		$templateUrl	=	dirname(__FILE__) ."/Template.php";
		if (is_file($templateUrl))
		{
			include_once($templateUrl);
			if (class_exists("Template"))
			{
				$myTemplate = new Template();
				$myTemplate->PATH = $tplPATH;
				if (!$myTemplate->setTemplate($tplName))
				{
					return false; //tpl or directory folder missed!!
				}
			} 
			else
			{
				return false; // class Template isn´t defined!!
			}
		}
		else
		{
			return false; //Template.php missed!!
		}
		return $myTemplate;
	}
	
	public static function cleanSQLParam( $Value )
	{
		$Value = str_replace("\'", "'", $Value);
		return str_replace("'", "\'", $Value);
	}
	
	private function isEmpty ( $Value ){
		return (preg_replace('/\s/S',"",$Value)=="");	
	}
}
?>