<?php
include ("../../conexion/conexion.php");
include ("fechas.php");
Conectarse();
$id_proveedores=$_GET["id_proveedores"];
$id_orden=$_GET["id_orden"];
		
		
		
$query_busqueda="SELECT 
						orden_compra.id_orden,
						proveedores.id_rif,
						proveedores.descripcion,
						orden_compra.fecha_pedido,
						orden_compra.fecha_entrega,
						orden_impuesto.id_impuesto,
						orden_compra.id_estado,
						orden_impuesto.monto,
						proveedores.domicilio,
						proveedores.tlf,
						proveedores.tipo,
						ordenes_detalles.id_orden,
						ordenes_detalles.id_detalle,
						ordenes_detalles.id_item,
						ordenes_detalles.cantidad,
						ordenes_detalles.costo,
						items.id_items,
						items.descripcion
						

								FROM 
									orden_compra,proveedores,orden_impuesto,ordenes_detalles,items
								
											WHERE   
													orden_impuesto.id_impuesto=orden_compra.id_impuesto 
													AND orden_compra.id_proveedores= '$id_proveedores' 
													AND proveedores.id_rif='$id_proveedores' 
													AND orden_compra.id_orden='$id_orden'
													AND ordenes_detalles.id_orden= '$id_orden'
													AND items.id_items=ordenes_detalles.id_item
													ORDER BY orden_compra.id_orden ASC;";
$rs_busqueda=pg_query($query_busqueda);
$filas=pg_num_rows($rs_busqueda);
		
		
		?>



<html>
<head>
<title>Resultado de la Busqueda</title>
<link href="../../css/styles.css" rel="stylesheet"	type="text/css" />	   
<script language="javascript">
		
	var cursor;
		if (document.all) {
		// Está utilizando EXPLORER
		cursor='hand';
		} else {
		// Está utilizando MOZILLA/NETSCAPE
		cursor='pointer';
		}
		
		function imprimir(ultima,id_proveedores) {
			location.href="imprimir_orden_proveedor.php?codalbaran="+codalbaran+"&codproveedor="+codproveedor;
		}
		
		</script>
<style type="text/css">
<!--
.style1 {font-size: 12px}
-->
</style>
</head>

<body>	
<p class="Estilo1">Detalle de Orden de Compra </p>
    <hr />

  <?php
 
  $id_ordenn=pg_fetch_result($rs_busqueda,$i,"id_orden");		
  	$domicilio=pg_fetch_result($rs_busqueda,$i,"domicilio");
				$telefono=pg_fetch_result($rs_busqueda,$i,"tlf");
				$tipo_proveedor=pg_fetch_result($rs_busqueda,$i,"tipo");
				$id_proveedores=pg_fetch_result($rs_busqueda,$i,"id_rif");
				$n_proveedor=pg_fetch_result($rs_busqueda,$i,"descripcion");
				$fecha_pedido=pg_fetch_result($rs_busqueda,$i,"fecha_pedido");
				$fecha_entrega=pg_fetch_result($rs_busqueda,$i,"fecha_entrega"); 
				$estatus=pg_fetch_result($rs_busqueda,$i,"id_estado");
				$impuesto=pg_fetch_result($rs_busqueda,$i,"monto");
  ?>
  <table width="600"border="0" align="center" class="ReportDetails">
   <tr valign="">
    <td>
	 <div id="ReportDetails">
  <table width="600" border="1" align="center">
    <tr>
      <th width="62" valign="top" class="ReportTableHeaderCell"><div align="center">Nombre Proveedor </div></th>
      <th width="57" valign="top" class="ReportDetailsEvenDataRow"><div align="center"><?php echo $n_proveedor;?></div></th>
      <th width="53" valign="top" class="ReportTableHeaderCell"><div align="center">N&ordm; orden de Compra </div></th>
      <th width="91" valign="top" class="ReportDetailsEvenDataRow"><div align="center"><?php echo $id_ordenn;?></div></th>
      <th width="87" valign="top" class="ReportTableHeaderCell"><div align="center"><strong>Tipo</strong></div></th>
      <th width="210" valign="top" class="ReportDetailsEvenDataRow"><div align="center"><?php echo $tipo_proveedor;?></div></th>
    </tr>
    <tr>
      <th class="ReportTableHeaderCell"width="62"><div align="center">Domicilio</div></th>
      <td width="57" class="ReportDetailsEvenDataRow"><div align="center"><?php echo $domicilio;?></div></td>
      <th width="53" valign="top" class="ReportTableHeaderCell"><div align="center">Fecha Pedido </div></th>
      <th width="91" valign="top" class="ReportDetailsEvenDataRow"><div align="center"><?php echo $fecha_pedido;?></div></th>
      <th width="87" valign="top" class="ReportTableHeaderCell"><div align="center">Fecha Despacho </div></th>
      <th width="210" valign="top" class="ReportDetailsEvenDataRow"><div align="center"><?php echo $fecha_entrega;?></div></th>
    </tr>
    <tr>
      <th valign="top" class="ReportTableHeaderCell"><div align="center">Telefono</div></th>
      <th valign="top" class="ReportDetailsEvenDataRow"><div align="center"><?php echo $telefono;?></div></th>
      <th width="53" valign="top" class="ReportTableHeaderCell"><div align="center">Status</div></th>
      <th colspan="3" valign="top" class="ReportDetailsEvenDataRow">
          <div align="center">
            <?php if ($estatus=='sindespachar'){echo 'Sin Despachar';}else echo 'Despachado';?>
              </div></th>
	  </tr>
  </table>
  </div>	</tr>
     </td>
	</table>

<table width="600"border="0" align="center" class="ReportDetails">
   <tr valign="top">
    <td>
	 <div id="ReportDetails">

			
			<table width="600" border="1" align="center">
             
			  <tr> 
                <th class="ReportTableHeaderCell"width="10%"><div align="center">N&ordm;. Articulo</div></td>
                <th class="ReportTableHeaderCell" width="6%"><div align="center">Items</p>
                </div></td>
                <th class="ReportTableHeaderCell" width="20%"><div align="center">Cantidad</div></td>
			    
				<th class="ReportTableHeaderCell" width="10%"><div align="center">Precio Unitario</div></td>
				<th class="ReportTableHeaderCell" width="11%"><div align="center">Precio Total</div></td>
			</tr>
			
			<? if ($filas>0) { $contador=0;?>
			
			<tr valign="top">
    <td>	
			  <?php
			  
		//	  $rs_busqueda=pg_query("SELECT MAX(id_orden)FROM orden_compra");
//while($row = pg_fetch_array($rs_busqueda,NULL,PGSQL_ASSOC)) { $ultima = $row['max']; }	
			  
			  $query_busqueda_items="SELECT ordenes_detalles.id_item,ordenes_detalles.cantidad,ordenes_detalles.costo, items.descripcion FROM ordenes_detalles, items,orden_compra 
WHERE ordenes_detalles.id_orden = '$id_orden' AND ordenes_detalles.id_item=items.id_items and ordenes_detalles.id_orden=orden_compra.id_orden ";
			  $rs_busqueda=pg_query($query_busqueda_items);
			  $band=false;
			for ($i = 0; $i < pg_num_rows($rs_busqueda); $i++) {
				
				$cantidad=pg_fetch_result($rs_busqueda,$i,"cantidad");
				$precio_unitario=pg_fetch_result($rs_busqueda,$i,"costo");
				$descripcion_items=pg_fetch_result($rs_busqueda,$i,"descripcion");	
						
				 if($band){
								?>
        <tr class="ReportDetailsEvenDataRow"><?php } else {?>
	    <tr class="ReportDetailsOddDataRow"><?php }
		 $band=!$band;?>
					
                <td><div align="center"><?php $contador=$contador+1 ; echo $contador;?></div></td>
                <td><div align="center"><?php echo $descripcion_items;?></div></td>
				<td><div align="center"><?php echo $cantidad;?></div></td>
                <!--no tenemos campo factura necesitamos saber donde se guardara la factura que emite el proveedor-->
                
                <!--todavia no calculamos impuesto-->
                <td><div align="center"><?php echo $precio_unitario;?></div></td>
               
			   <?php
			   $precio_total= $cantidad * $precio_unitario;
			   $sumatoria_de_precios=$sumatoria_de_precios + $precio_total;
			   ?>
			   
			    <td><div align="center"><?php echo $precio_total;?></div></td>
				
				<!--aun no calculamos total de orden orden no sabemos a que campos-->
              </tr>
			  
              <?php 
	          }
		      ?>
            </tr></td>
			  <?php 
		      }  
		      ?>
<tr> 
                
          <td width="15%"><div align="center"></div></td>
				<td width="11%"><div align="center"></div></td>
				<td width="17%">&nbsp;</td>
				<td width="17%"><b>IVA  (<?php echo $impuesto;?>)%</b></td>
				<td width="17%">
			    <div align="center"><?php
				$impuestos=$sumatoria_de_precios*($impuesto/100);
				
				
				 echo $impuestos;?></div></td>
			  </tr>
			  <tr> 
                <td width="15%"><div align="center"></div></td>
				<td width="11%"><div align="center"></div></td>
				<td width="17%">&nbsp;</td>
				<td width="17%"><b>TOTAL</b></td>
				<td width="17%"><div align="center"><?php echo $sumatoria_de_precios;?></div></td>
			  </tr>
</table>
 </div>	
    </td></tr> 
</table><div align="center">
            <img src="img/botonimprimir.jpg" width="79" height="22" border="1" onClick="imprimir('<? echo $ultima?>','<? echo $$id_proveedores?>')" onMouseOver="style.cursor=cursor"></div>				
</div>		  </div>
</div>			

</body>
</html>
