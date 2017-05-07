<?php
session_start();
//parte que verifica si es un usuario aceptado en el sistema
//automaticamente muestra un error si no es aceptado
if ($_SESSION["aceptado"]!="si")
{
header ('Location: ../../logueoerror.php');
exit;
}

//segun la tabla nivel el id_nivel=1 es para administrador
function Administrador()
{
 if ($_SESSION["nivel"]==1) {
 return 1;
 }
 else
 	return 0;
}

//segun la tabla nivel el id_nivel=2 es para usuario comun
function Usuario()
{
 if ($_SESSION["nivel"]==2) {
 return 1;
 }
 else
 	return 0;
}



?>