<?php
session_start();
?>
<?php
if($_SESSION["nivel"]!=1) {


header('Location: ../../logueoerror.php');
exit;

}
?>
<?php 
require ("../../conexion/conexion.php");



$proveedores=$_GET["proveedor"];
$fecha_pedido=$_GET["fecha_pedido"];$fecha_entrega=$_GET["fecha_entrega"];
$estatus=$_GET["estatus"];
$impuesto=$_GET["impuesto"];
Conectarse();

$query_operacion=pg_query("INSERT INTO orden_compra (id_proveedores, fecha_pedido,id_estado, id_impuesto, fecha_entrega) VALUES ('".$proveedores."', '".$fecha_pedido."',  '".$estatus."', '".$impuesto."', '".$fecha_entrega."')");	

$rs_busqueda=pg_query("SELECT MAX(id_orden)FROM orden_compra");
while($row = pg_fetch_array($rs_busqueda,NULL,PGSQL_ASSOC)) { $ultima = $row['max']; }	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>



<form action="agregar_articulo.php" name="form2" method="get" target="frame_rejilla" >
  <label>
  Articulo
  
  <?php $query_busqueda="SELECT * FROM items ORDER BY descripcion";
$rs_busqueda=pg_query($query_busqueda);
$filas=pg_num_rows($rs_busqueda);
		?>
  <select name="articulo" id="articulo">
  <option value="0">Seleccione Articulo</option>
  <?php for ($i = 0; $i < pg_num_rows($rs_busqueda); $i++) {?>
  <option value="<?php echo $items=pg_fetch_result($rs_busqueda,$i,"id_items")?>"><?php echo $items=pg_fetch_result($rs_busqueda,$i,"descripcion")?></option>
  <?php }?>
  </select>
  </label>
  <label>Cantidad
  <input name="cantidad" type="text" id="cantidad" />
  </label>
  <label>Costo
  <input name="costo" type="text" id="costo" />
  </label>
  <p><label></label>
  <label></label>
  <label>
  <input name="Agregar" type="submit" id="Agregar" value="Agregar" />
  </label>
  </p>
</form>


<iframe src="agregar_articulo.php" name="frame_rejilla" width="95%" height="200" frameborder="3" class="menu_lateral2" id="frame_rejilla"> </iframe>
</body>
</html>
