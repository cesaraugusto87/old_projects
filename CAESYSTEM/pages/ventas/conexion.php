<?php
function Conectarse() 
{ 
	if (!($conexion=pg_connect("host=localhost port=5432  user=postgres password=12345 dbname=proyecto")))
	{
		echo "Error conectando a la base de datos."; 
        exit();
	}
	return $conexion; 
}
?>