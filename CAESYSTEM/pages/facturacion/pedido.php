<?php
include('../../permisos.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Facturaci&oacute;n</title>
<link href="../../css/styles.css" rel="stylesheet"	type="text/css" />
<style type="text/css">
.Estilo2 {color: #0000FF}
.Estilo3 {font-size: 14px}
</style>
</head>

<?php require('../../conexion/conexion.php');
$link = Conectarse();

if($_POST['Nuevo']){
	$rif=$_POST['hrif'];
	$impuesto=$_POST['himpuesto'];
	$precio=$_POST['hprecio'];
}

if($_POST['Buscar']){
	$rif=$_POST['hrif'];
	$impuesto=$_POST['himpuesto'];
	$precio=$_POST['hprecio'];
}

if($_POST['Aceptar']){
	$rif=$_POST['hrif'];
	$impuesto=$_POST['himpuesto'];
	$precio=$_POST['hprecio'];
}

if($_POST['Eliminar']){
	$rif=$_POST['hrif'];
	$impuesto=$_POST['himpuesto'];
	$precio=$_POST['hprecio'];
}
?>
<body>
<div>
<form id="Pedido" name="Pedido" method="post">
	<input type="hidden" name="hrif" value="<?php echo($rif);?>"/>
	<input type="hidden" name="himpuesto" value="<?php echo($impuesto);?>"/>
	<input type="hidden" name="hprecio" value="<?php echo($precio);?>"/>
	<p class="Estilo1">Facturar</p>
  <hr />
<div>
<fieldset style="border: 2px solid #2E9AFE; -moz-border-radius: 15px; -webkit-border-radius: 15px;">
<legend class="titulo2 Estilo2 Estilo3">Buscar Producto</legend>
<table width = "63%"  align = "center" class = "ReportDetails">
	<tr>
		<th> Referencia:</th>
		<td>
		  <?php 
/*************Llenado del combo cbo_items con los codigos de los items*******************/
		  $query_busqueda="SELECT * FROM items ORDER BY id_items";
			$rs_busqueda=pg_query($query_busqueda);
			$filas=pg_num_rows($rs_busqueda);
		  ?>
		  <select name= "cbo_items" class="campo" id="cbo_items" style="width:100%">
			  <option value = "0">-- SELECCIONE --</option>
			  <?php for ($i = 0; $i < pg_num_rows($rs_busqueda); $i++) {?>
			    <option value="<?php echo $items=pg_fetch_result($rs_busqueda,$i,"id_items"); $resul=$items;?>"><?php echo $items=pg_fetch_result($rs_busqueda,$i,"id_items")?></option>
  <?php }?>
		  </select>
		</td>
		<td align = "center">
			<input type="image" src="../../images/Search.ico" name="Buscar" onClick="Clear_Frame()" value="Buscar" />
		</td>
	</tr>
</table>
<?php
$cbo_items= $_POST['cbo_items'];
//Busca datos del producto por su codigo
if ($_POST['Buscar'] == "Buscar")
{
	if($cbo_items){	
	$bus = pg_query("select distinct i.id_items, i.nombre, i.descripcion, inv.cantidad, inv.costo from items i, inventario inv where i.id_items= '$cbo_items' and i.id_items= inv.id_items"); 
	$cam =pg_fetch_array($bus);
	$disponible=$cam['cantidad'];
	}
	else
		echo "<script>alert('Seleccione una Referencia');</script>";
};
?>
<br>

<table class="ReportDetails" border "1" align="center">
	<tr>
		<th width="25">C&oacute;digo:</th>
		<td>
			<input class="" title="" readonly="1" type="text" width="100%" id= "codigo" name = "codigo" value="<?php printf($cam['id_items']);?>" style="width:99%"/>
		</td>
		<th width="5">Nombre:</th>
		<td>
			<input class="" title="" readonly="1" type="text" width="100%" id= "nombre" name = "nombre" value= "<?php printf($cam['nombre']);?>" style="width:99%"/>
		</td>
		<th width="5">Descripci&oacute;n:</th>
		<td>
			<input class="" title="" readonly="1"  type="text" width="100%" id= "descripcion" name = "descripcion" value= "<?php printf($cam['descripcion']);?>" style="width:99%"/>
		</td>				
	</tr>
	<tr>
		<th width="80">Costo Unidad:</th>
		<td>
			<input class="" title="" readonly="1"  type="text" width="100%" id= "costo_unid" name = "costo_unid" value= "<?php printf($cam['costo']);?>" style="width:99%"/>
		</td>
		<th>Disponible:</th>
		<td>
			<input readonly="1"  type="text" id= "disponible" name = "disponible" value= "<?php printf($cam['cantidad']);?>" style="width:99%"/>
		</td>		
		<th>Cantidad:</th>
		<td>
			<input class="" title="" type="text" width="100%" id= "cantidad" name = "cantidad" value= "" style="width:99%"/>
		</td>
	</tr>
</table>
<table width = "20%"  align = "center" class = "ReportDetails">
	<tr>
		<th><input type="submit" name="Aceptar" onClick="Clear_Frame()" value="Aceptar" /></th>
	</tr>
</table>
</fieldset>
</div>
<div>
<?php
$codigo=$_POST["codigo"];
$nombre=$_POST["nombre"];
$descripcion=$_POST["descripcion"];
$costo_unid=$_POST["costo_unid"];
$cantidad=$_POST["cantidad"];

//Agrega el producto a la tabla de pedido
if($_POST['Aceptar']){
   if($_POST["cantidad"]<>''){
		if (($_POST["cantidad"])<=($_POST["disponible"])){
				$ins_pedido=pg_query("insert into tabla_pedido (ref, nombre, descripcion, costo_unidad, cantidad) values ('".$codigo."', '".$nombre."', '".$descripcion."', '".$costo_unid."', '".$cantidad."')");
		}
		else
			echo "<script>alert('Ha ingresado una cantidad mayor a la disponible');</script>";		
   }
   else
	 echo "<script>alert('Ingrese cantidad');</script>";

}

if($_POST['Eliminar']){

		$elim_items=pg_query("delete from tabla_pedido where ref='".$_POST["txt_ref"]."'");
}

$pedido=pg_query("select * from tabla_pedido");	
?>
<fieldset style="border: 2px solid #2E9AFE; -moz-border-radius: 15px; -webkit-border-radius: 15px;">
<legend class="titulo2 Estilo2 Estilo3">Pedido</legend>
    <table border="1" align="center">
		<tr>
			<td width="25"align="center" class="ReportTableHeaderCell">Ref. Item</td>
			<td align="center" class="ReportTableHeaderCell">Nombre</td>
			<td align="center" class="ReportTableHeaderCell">Descripcion</td>
			<td align="center" class="ReportTableHeaderCell">Costo Unitario</td>
			<td align="center" class="ReportTableHeaderCell">Cantidad</td>	
			<td align="center" class="ReportTableHeaderCell">Eliminar</td>					
		</tr>
		<?php
		while($datos=pg_fetch_array($pedido)){
		?>
		<tr class="ReportDetailsEvenDataRow">
		<td width="25"align="center" class="ReportTableValueCell">
			<input class="ReportDetailsEvenDataRow" readonly="1" type="text" align="center" width="100%" id= "txt_ref" name = "txt_ref" value="<?php echo($datos['ref']);?>" style="width:100%"/>
		</td>
		<td align="center" class="ReportTableValueCell"><?php echo($datos['nombre']);?></td>
		<td align="center" class="ReportTableValueCell"><?php echo($datos['descripcion']);?></td>
		<td align="center" class="ReportTableValueCell"><?php echo($datos['costo_unidad']);?></td>							
		<td align="center" class="ReportTableValueCell"><?php echo($datos['cantidad']);?></td>
		<td align = "center">
			<input type="image" src="../../images/eliminar.jpg" name="Eliminar" value="Eliminar" />
		</td>
		</tr>
<?php
}
?>
</table>
<br>
</fieldset>
</div>
 </form>
</div>
<div>
<form action="fac_cliente.php" method="post" name="enviar">
	<input type="hidden" name="hrif" value="<?php echo($rif);?>"/>
	<input type="hidden" name="himpuesto" value="<?php echo($impuesto);?>"/>
	<input type="hidden" name="hprecio" value="<?php echo($precio);?>"/>
<table width = "20%"  align = "center" class = "ReportDetails">
	<tr>
		<th><input type="image" src="../../images/b_enviar.gif" width="50" height="35" border="2" name="Enviar" value="Enviar"/></th>
	</tr>
</table>
</form>
</div>

</body>
</html>
