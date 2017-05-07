<?php 
include ("conectar.php");


$proveedores=$_GET["proveedor"];
$fecha_pedido=$_GET["fecha_pedido"];$fecha_entrega=$_GET["fecha_entrega"];
$estatus=$_GET["estatus"];
$impuesto=$_GET["impuesto"];


$query_operacion=pg_query("INSERT INTO orden_compra (id_proveedores, fecha_pedido, status, id_impuesto, fecha_entrega) VALUES ('".$proveedores."', '".$fecha_pedido."',  '".$estatus."', '".$impuesto."', '".$fecha_entrega."')");	

echo 'codido de proveedor',$proveedores;
echo 'codido de impuesto',$impuesto;



?>