<?php 
require ("../../conexion/conexion.php");
Conectarse();

$articulo=$_GET["articulo"];
$cantidad=$_GET["cantidad"];$costo=$_GET["costo"];
//echo 'articulo           ',$articulo;
$rs_busqueda=pg_query("SELECT MAX(id_orden)FROM orden_compra");
while($row = pg_fetch_array($rs_busqueda,NULL,PGSQL_ASSOC)) { $ultima = $row['max']; }	
//echo 'ultima posicion          ',$ultima;

if ($articulo<>NULL){

$query_operacion=pg_query("INSERT INTO ordenes_detalles (id_orden, id_item, cantidad, costo) VALUES ('$ultima', '$articulo', '$cantidad', '$costo')");	
}

?>
<html>
<body>

<table width="708" border="0">
  <tr>
    <td>N°</td>
    <td>Articulo</td>
    <td>Cantidad</td>
    <td>Costo</td>
	  
  </tr>
   <?
			$contador=0;
			
			
			  
			  $query_busqueda_items="SELECT ordenes_detalles.id_item,ordenes_detalles.cantidad,ordenes_detalles.costo, items.descripcion FROM ordenes_detalles, items,orden_compra 
WHERE ordenes_detalles.id_orden = '$ultima' AND ordenes_detalles.id_item=items.id_items and ordenes_detalles.id_orden=orden_compra.id_orden";
			  $rs_busqueda=pg_query($query_busqueda_items);
			  
			for ($i = 0; $i < pg_num_rows($rs_busqueda); $i++) {
				$articulo=pg_fetch_result($rs_busqueda,$i,"descripcion");
				$cantidad=pg_fetch_result($rs_busqueda,$i,"cantidad");
				$costo=pg_fetch_result($rs_busqueda,$i,"costo");	
						
							
				?>
  <tr>
    <td><?php $contador=$contador+1 ; echo $contador;?></td>
    <td><?php  echo $articulo?></td>
    <td><?php  echo $cantidad;?></td>
	<td><?php  echo $costo;?></td>
  </tr>
  
  
    <?php 
			  }
		  
		     
		      ?>
</table>


</body>
</html>


