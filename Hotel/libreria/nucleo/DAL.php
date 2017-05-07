<?php
/* DAL
*****************************************************************************
@  Copyright (c) 2006-2007 Duxpoint 

Autores: Dano (www.danonino.org) y Maik (www.escasala.com)
Propósito:    Clase para.abstraer el uso de la clase MySQL.
Version:  0.3.1
Fecha: 12/11/2006
Actualizada: 25/01/2006
Requerimientos:
	Clase MySQL
	PHP Version >=5
*****************************************************************************
*/


include_once(dirname (__FILE__) . "/MySQL.php");
include_once(dirname (__FILE__) . "/Utils.php");
include_once(dirname (__FILE__) . "/Config.php");
abstract class DAL
{
	public static $isConnected	=	false;
	public static $lastID		=	0;
	public static $resource		=	0;
	
	public static function connect( )
	{
		$ConLayer					=	new MySQL();
		$ConLayer->debugMode		=	true;
		$data["USER"] 			=	Config::getValue("DB_USER");
		$data["PASSWORD"] 		=	Config::getValue("DB_PASSWORD");
		$data["SERVER"] 		=	Config::getValue("DB_SERVER");
		$data["DATABASE"]		=	Config::getValue("DB_NAME");
		self::$isConnected		=	$ConLayer->setData($data);
		return $ConLayer;
	}
	
	public static function createDataSet($saSql)
	{
		$ConLayer = self::connect( );
		if ( self::$isConnected )
		{
			if (  $ConLayer->doQUERY($saSql)  )
			{
				self::$resource = $ConLayer->resource;
				return $ConLayer->resource;
			}
		}
		$ErrorObj["Error"] 			= 	true;
		$ErrorObj["ErrorsStore"] 	=	$ConLayer->errorsStore;
		return $ErrorObj;		
	}
	
	public static function executeNonQuery ( $saSql )
	{
		$ConLayer	=	self::connect( );
		if ( self::$isConnected )
		{
			if ( $ConLayer->doQUERY( $saSql ))
			{
				self::$lastID	=	$ConLayer->lastID;
				return $ConLayer->resource;
			}
		}
		$ErrorObj["Error"] 			=	true;
		$ErrorObj["ErrorsStore"] 	=	$ConLayer->errorsStore;
		return $ErrorObj;		
	}
	
	public static function cleanSQLParam ( $saSql = "" )
	{
		return MySQL::cleanSQLParam( $saSql );
	}
	
	public static function freeResult ()
	{
		$ConLayer			=	self::connect( );
		$ConLayer->resource	=	self::$resource;
		$ConLayer->freeResult();
	}
	
	public static function open()
	{
		return self::connect();
	}
	
	public static function close()
	{
		MySQL::close();
	}
	
	public static function createDataSetPage($saSql, $iaLimit , $iaPage =1 , $time=false)
	{
		
		if ( (!Utils::isInteger($iaLimit)) or ($iaLimit < 1) )
		{
			trigger_error("Max isn't number valid/Maximo no es un numero válido");
			return null;
		}
		if ( (!Utils::isInteger($iaPage)) or ($iaPage < 1) )
		{
			trigger_error("Page isn't number valid/Pagina no es un numero válido");
			return null;
		}
		if (is_array($saSql) && $time)
		{
			$Sql = $saSql[1];
			$mlSqls["time"] =  $saSql[0];
		}
		else
		{
			$Sql = $saSql;
		}
		
		$mlSqls["record"]	=	self::makeSQLPager($Sql, $iaPage, $iaLimit);
		if (!isset($mlSqls["record"]))
		{
			return null;
		}
		
		$mlSqls["total"]	=	"SELECT FOUND_ROWS();";
		$rsPager			=	self::createDataSet($mlSqls);
		if ($rsPager["Error"]==true)
		{
			trigger_error("Error in your SQL was found, please verify");
			return null;
		}
		$rsPager["total"]	=	@mysql_result($rsPager["total"],0);
		$rsPager["pages"]	=	ceil($rsPager["total"]/$iaLimit);
		return $rsPager;
	}	
	
	private static function extractFields($saSql)
	{
		
		return  "SELECT SQL_CALC_FOUND_ROWS * FROM ($saSql) AS DALPager";

	}

	private static function makeSQLPager ( $saSql , $iaPage, $iaLimit)
	{
		$slFields	=	self::extractFields($saSql);
		if (isset($slFields))
		{
			
			return	$slFields . " LIMIT " . ($iaPage-1)*$iaLimit . "," . $iaLimit;
		}
		else
		{
			return null;
		}
	}	
}
?>