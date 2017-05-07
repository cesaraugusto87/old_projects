<?php
function Conectarse() 
{ 
	if (!($conexion=pg_connect("host=localhost user=postgres password=Passw0rd dbname=CAESYSTEM")))
	{
		echo "Error conectando a la base de datos."; 
        exit();
	}
	return $conexion; 
}
?>