<?php	
	include('../../conexion/conexion.php');
	include('class.ezpdf.php');
	$conexion = Conectarse();
	$pdf= & new Cezpdf('a4');
	$pdf->addJpegFromFile('../../images/cae.jpg',25,750,250,'right');
	$pdf->addJpegFromFile('../../images/CAESYSTEM.jpg',100,300,400,'right');
	//$id_presupuesto = $HTTP_GET_VARS["id"];
	$id_presupuesto = 3;
	
	$pdf->addText(285,770,25,$texto);
	$id_orden='3';
	$id_proveedores='123456';
	$query_busqueda = "SELECT 
						orden_compra.id_orden,
						proveedores.id_proveedores,
						proveedores.descripcion,
						orden_compra.fecha_pedido,
						orden_compra.fecha_entrega,
						orden_impuesto.id_impuesto,
						orden_compra.status,
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
													AND proveedores.id_proveedores='$id_proveedores' 
													AND orden_compra.id_orden='$id_orden'
													AND ordenes_detalles.id_orden= '$id_orden'
													AND items.id_items=ordenes_detalles.id_item
													ORDER BY orden_compra.id_orden ASC;";
			
	
			
	$rs_busqueda=pg_query($query_busqueda);
$filas=pg_num_rows($rs_busqueda);
		
		        $id_ordenn=pg_fetch_result($rs_busqueda,$i,"id_orden");		
  	            $domicilio=pg_fetch_result($rs_busqueda,$i,"domicilio");
				$telefono=pg_fetch_result($rs_busqueda,$i,"tlf");
				$tipo_proveedor=pg_fetch_result($rs_busqueda,$i,"tipo");
				$id_proveedores=pg_fetch_result($rs_busqueda,$i,"id_proveedores");
				$n_proveedor=pg_fetch_result($rs_busqueda,$i,"descripcion");
				$fecha_pedido=pg_fetch_result($rs_busqueda,$i,"fecha_pedido");
				$fecha_entrega=pg_fetch_result($rs_busqueda,$i,"fecha_entrega"); 
				$estatus=pg_fetch_result($rs_busqueda,$i,"status");
				$impuesto=pg_fetch_result($rs_busqueda,$i,"monto");
	
	$id_ordenn = "numero orden: ";
	$domicilio = "direccion: ";
	
	
	
	
	$options = array(
                //'shadeCol'=>array(0.9,0.9,0.9),
				'fontSize' => 12,
		//		'colGap' => 100,
				'showHeadings'=>0,
                'xOrientation'=>'center',
                'width'=>500,
				'showLines'=> 0,
            );
	$pdf->ezTable($data,$titles,'',$options);

	$pdf->ezText("\n\n\n", 10);

	 $query_busqueda_items="SELECT ordenes_detalles.id_item,ordenes_detalles.cantidad,ordenes_detalles.costo, items.descripcion FROM ordenes_detalles, items,orden_compra 
WHERE ordenes_detalles.id_orden = '$id_orden' AND ordenes_detalles.id_item=items.id_items and ordenes_detalles.id_orden=orden_compra.id_orden ";
			 $rs_busqueda=pg_query($query_busqueda_items);
	
	
	for ($i = 0; $i < pg_num_rows($rs_busqueda); $i++) {
				
				$cantidad=pg_fetch_result($rs_busqueda,$i,"cantidad");
				$precio_unitario=pg_fetch_result($rs_busqueda,$i,"costo");
				$descripcion_items=pg_fetch_result($rs_busqueda,$i,"descripcion");	
	$titles = array(
                'id_item'=>'<b>Item</b>',
				'id_item'=>'<b>Codigo</b>',
                'descripcion_items'=>'<b>Descripcion</b>',
                'costo'=>'<b>Precio Unitario</b>',
				'cantidad'=>'<b>Cantidad</b>',
				'precio_unitario'=>'<b>Sub-Total</b>'
            );}
	$options = array(
                //'shadeCol'=>array(0.9,0.9,0.9),
                'xOrientation'=>'center',
				'shaded'=>0,
                'width'=>500
            );
	$pdf->ezTable($data,$titles,'',$options);
	
	$precio_total= $cantidad * $precio_unitario;
			   $sumatoria_de_precios=$sumatoria_de_precios + $precio_total;
			   
	$subtotal = "Sub-Total: ";
	$iva = "IVA(12%): ";
	$total = "TOTAL: ";
			
	
	
	$pdf->ezText("\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n", 10);
	$data = array(
				array('titulo'=>$subtotal)
				,array('titulo'=>$iva)
				,array('titulo'=>$total)
			);
	$titles = array(
                'titulo'=>'<b>Fecha:</b>',
            );	
	$options = array(
                'shadeCol'=>array(0.9,0.9,0.9),
				'fontSize' => 12,
				//'colGap' => 100,
				'showHeadings'=>0,
				'xPos'=>'center',
                'xOrientation'=>'center',
                'width'=>100,
				'showLines'=> 0,
            );
	$pdf->ezTable($data,$titles,'',$options);
	$pdf->ezStream();
?>