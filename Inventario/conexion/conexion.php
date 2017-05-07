<?php

function Conectarse() 
{ 

$myServer = "192.168.5.6";
$myDB = "Almacen"; 
$myUser = "Web";
$myPass = "galacticaml";
	
	$conexion=mssql_connect($myServer, $myUser, $myPass)
		or die("No se puede conectar a $myServer"); 
	$selected = mssql_select_db($myDB, $conexion)
		or die("No se pudo seleccionar la BD: $myDB"); 
	
	return $conexion; 
}
?>