<?php	
	include('../../conexion/conexion.php');
	include('class.ezpdf.php');
	session_start();
	session_register('id_presupuesto');
	$id_presupuesto = $_SESSION['id_presupuesto'];
	$conexion = Conectarse();
	$pdf= & new Cezpdf('a4');
	$pdf->addJpegFromFile('../../images/cae.jpg',25,750,250,'right');
	$pdf->addJpegFromFile('../../images/CAESYSTEM.jpg',100,300,400,'right');
	$texto = "Presupuesto Nº ".$id_presupuesto;
	$pdf->addText(285,770,25,$texto);
	
	$query = "SELECT presupuestos.fecha, clientes.nombres, clientes.apellidos, clientes.domicilio
			FROM public.clientes, public.presupuestos
			WHERE presupuestos.id_presupuestos = $id_presupuesto 
			AND presupuestos.id_clientes = clientes.id_clientes;";
			
	$fecha = "Fecha: ";
	$nombre = "Nombre: ";
	$direccion = "Direccion: ";
			
	if ($resultado = pg_exec($conexion,$query)){
				$fecha .= pg_result($resultado,0,0);
				$nombre .= pg_result($resultado,0,1)." ".pg_result($resultado,0,2);
				$direccion .= pg_result($resultado,0,3);				
			}
	
	$pdf->ezText("\n\n\n\n\n\n\n", 10);
	$data = array(
				array('titulo'=>$fecha)
				,array('titulo'=>$nombre)
				,array('titulo'=>$direccion)
				//array('titulo'=>'Fecha:')
				//,array('titulo'=>'Nombre:')
				//,array('titulo'=>'Direccion')
			);
	$titles = array(
                'titulo'=>'<b>Fecha:</b>',
            );	
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

	$resultado = pg_query("SELECT presupuestos_detalles.id_detalle_presupuesto,mercancia.id_items,presupuestos_detalles.cantidad,inventario.costo,presupuestos_detalles.id_precio,items.nombre
				FROM public.presupuestos,public.presupuestos_detalles,public.mercancia,public.inventario,public.items
				WHERE presupuestos.id_presupuestos = presupuestos_detalles.id_presupuesto 
				AND presupuestos.id_presupuestos = $id_presupuesto 
				AND presupuestos_detalles.id_merca = mercancia.id_merca 
				AND mercancia.id_items = inventario.id_items 
				AND inventario.id_items = items.id_items
				ORDER BY presupuestos_detalles.id_detalle_presupuesto ASC");
	if(pg_num_rows($resultado)!=0){
		while($datos=pg_fetch_array($resultado)){
			$data[] = array_merge($datos);
		}
	}
	$titles = array(
                'id_detalle_presupuesto'=>'<b>Item</b>',
				'id_items'=>'<b>Codigo</b>',
                'nombre'=>'<b>Descripcion</b>',
                'costo'=>'<b>Precio Unitario</b>',
				'cantidad'=>'<b>Cantidad</b>',
				'id_precio'=>'<b>Sub-Total</b>'
            );
	$options = array(
                //'shadeCol'=>array(0.9,0.9,0.9),
                'xOrientation'=>'center',
				'shaded'=>0,
                'width'=>500
            );
	$pdf->ezTable($data,$titles,'',$options);
	
	$query = "SELECT sum(presupuestos_detalles.id_precio)
			FROM public.presupuestos, public.presupuestos_detalles
			WHERE presupuestos.id_presupuestos = $id_presupuesto 
			AND presupuestos.id_presupuestos = presupuestos_detalles.id_presupuesto;";
			
	$subtotal = "Sub-Total:      ";
	$iva = "IVA(12%):      ";
	$total = "TOTAL:          ";
			
	if ($resultado = pg_exec($conexion,$query)){
				$sub = pg_result($resultado,0,0);
				$subtotal .= $sub;
				$i = $sub*0.12;
				$iva .= $i;
				$t = $sub + $i;
				$total .= $t;
			}
	
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
                'width'=>150,
				'showLines'=> 0,
            );
	$pdf->ezTable($data,$titles,'',$options);
	$pdf->ezStream();
?>