<?php

include_once( dirname (__FILE__) . "/libreria/aplicacion/Reporte.php");

$reporte = new Reporte();

//////////////////////////////////////////// 
#Prueba de Agregar

$registro = array();
$registro["IdReporte"] = 1;
$registro["Cedula"] = 11111111;
$registro["Fecha"] = "1111-11-11";
$registro["Diagnostico"] = "No se que es";
$resultado = $reporte->agregar($registro);

if ($resultado->exito) // si se ejecuto exitosamente
{
	echo "<pre>";
	print_r($resultado->mensajes);
	echo "</pre>";
}
else
{	
	echo "<pre>";
	print_r($resultado->errores);
	echo "</pre>";
	}	
/////////////////////////////////////////////


//////////////////////////////////////////// 
#Las solicitudes no pueden ser modificadas
#Prueba de Modificar

/*$registro = array();
$registro["IdSolicitud"] = "2";
$registro["IdUsuario"] = 2;
$registro["Asunto"] = "modificado1";
$registro["Contenido"] = "contenido4";
$registro["Fecha"] = "1111-11-14";
$registro["Estado"] = "N";
$resultado = $solic->modificar($registro);

if ($resultado->exito) // si se ejecuto exitosamente
{
	echo "<pre>";
	print_r($resultado->mensajes);
	echo "</pre>";
}
else
{	
	echo "<pre>";
	print_r($resultado->errores);
	echo "</pre>";
}*/

//////////////////////////////////////////// 


//////////////////////////////////////////// 
#Prueba de Eliminar


/*$resultado = $solic->eliminar(25);

if ($resultado->exito) // si se ejecuto exitosamente
{
	echo "<pre>";
	print_r($resultado->mensajes);
	echo "</pre>";
}
else
{	
	echo "<pre>";
	print_r($resultado->errores);
	echo "</pre>";
}*/

//////////////////////////////////////////// 


//////////////////////////////////////////// 
#Consultar por nro. solicitud

$consulta = $solic->consultar(1);

if ($consulta->exito)
{
	while ($row = mysql_fetch_array($consulta->mensajes))
	{
		echo "<pre>";
		print_r($row);
		echo "</pre>";
	}
}
else
{
	echo "Errores<pre>";
	print_r($consulta->errores);
	echo "</pre>";
}

//////////////////////////////////////////// 

//////////////////////////////////////////// 
#Consultar por Fecha

/*$consulta = $solic->consultar(1111-11-11);

if ($consulta->exito)
{
	while ($row = mysql_fetch_array($consulta->mensajes))
	{
		echo "<pre>";
		print_r($row);
		echo "</pre>";
	}
}
else
{
	echo "Errores<pre>";
	print_r($consulta->errores);
	echo "</pre>";
}*/

//////////////////////////////////////////// 
	?>