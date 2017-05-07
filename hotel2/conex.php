<?php

	$conexion_bd = pg_connect("host=192.168.0.198 dbname=Hotel user=postgres password=scaspc")
    or die('No pudo conectarse: ' . pg_last_error());
	
	if ($conexion_bd)
	{
		echo ("se conecto");
	}
	else 
	{
		echo (" No se conecto");
		
	}

	return $conexion_bd;
	
?>