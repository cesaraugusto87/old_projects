<?php
session_start();
include('../../conexion/conexion.php');
// conectamos con la base de datos
$link= Conectarse();

// se guardan los usuarios en variables
$login=$_POST["username"];
$clave=$_POST["password"];

// se busca el usuario en la bd
$SQL="SELECT login, clave, usuarios.id_nivel as id, nivel.descripcion as desc FROM usuarios, nivel WHERE nivel.id_nivel=usuarios.id_nivel and login='".$login."' and clave='".$clave."'";
$result = pg_query($link,$SQL);
$compara=pg_fetch_array($result);

// comparacion
if (($compara["login"]==$login && $compara["clave"]==$clave)&&($login!=""&& $clave!=""))
{
$_SESSION["login"] = $login;
$_SESSION["clave"] = $clave;
$_SESSION["nivel"] = $compara[2];
$_SESSION["aceptado"] = "si";
$_SESSION["tipo"] = $compara[3];
session_name($usuarios_sesion);
header ('Location: principal.php');
exit;
}
else
{
header ('Location: ../../logueoerror.php');
exit;
}
?> 

