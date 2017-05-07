<?php

include_once( dirname (__FILE__) . "/libreria/aplicacion/Paciente.php");

$usu = new Paciente();

//////////////////////////////////////////// 
#Prueba de Agregar

$registro = array();
$registro["Cedula"] = 18960431;
$registro["Nombre"] = "susana";
$registro["Apellido"] = "leon rivero";
$registro["Sexo"] = 0;
$registro["FechaNac"] = "1111-11-11";

$resultado = $usu->agregar($registro);

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

#Prueba de Modificar
/*
$registro["Cedula"] = 18960426;
$registro["Nombre"] = "susana elibeth";
$registro["Apellido"] = "leon rivero";
$registro["Sexo"] = 0;
$registro["FechaNac"] = 1111-11-11;
$resultado = $usu->modificar($registro);

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
*/
//////////////////////////////////////////// 


//////////////////////////////////////////// 
#Prueba de Eliminar


/*$resultado = $usu->eliminar(1);

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
*/
//////////////////////////////////////////// 


//////////////////////////////////////////// 
#Consultar por id
/*
$consulta = $usu->consultar(18960427);
$row=array();

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

//////////////////////////////////////////// 
#Consultar por nombre

$consulta = $usu->consultar_n(susana);

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

	?>