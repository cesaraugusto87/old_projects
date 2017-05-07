<?php
$bd_servidor="localhost";
$bd_puerto="5432";
$bd_nombre="condominio";
$bd_usuario="postgres";
$bd_clave="scaspc8740.";

$bd_conexion = @pg_connect("host='".$bd_servidor."' port='".$bd_puerto."' user='".$bd_usuario."' password='".$bd_clave."' dbname='".$bd_nombre ."'")
or die ("No se pudo establecer la conexion con el sistema.");
?>
