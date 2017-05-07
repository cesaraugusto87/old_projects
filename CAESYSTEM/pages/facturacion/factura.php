<?php	
	include('class.ezpdf.php');
	$pdf= & new Cezpdf('a4');
	$pdf->selectFont('fonts/Helvetica.afm');	
	$y=400;	
	$pdf->ezSetCmMargins(2,2,2.5,2.5);
	$pdf->addJpegFromFile('../../images/caesystem3.jpg',50, $y, 100, 'right');
	$pdf->ezText( "\n", 1);	
	include('../../conexion/conexion.php');
	$link = Conectarse();
	$pedido=pg_query("select * from tabla_pedido");	
	
if(pg_num_rows($pedido)!=0){
		while($datos=pg_fetch_array($pedido)){
			$unidad=$datos['costo_unidad'];
			$impuesto=$imp['porcentaje'];
			$c_imp=$unidad*($impuesto/100);
			$cant=$datos['cantidad'];
			$sub_total=$unidad*$cant;
			$total=$sub_total+$c_imp;
			$neto=$neto+$total;
     $data[] = array_merge($datos, array('total'=>$total));
}}
$titles = array(
                'ref'=>'<b>Ref.</b>',
                'nombre'=>'<b>Nombre</b>',
                'descripcion'=>'<b>Descripcion</b>',				
				'cantidad'=>'<b>Cantidad</b>',
                'costo_unidad'=>'<b>Precio Unitario</b>',
			//	'subtotal'=>'<b>Subtotal</b>',	
			//	'imp'=>'<b>Impuesto</b>',							
				'total'=>'<b>Total</b>',
            );
$options = array(
                'shadeCol'=>array(0.9,0.9,0.9),
                'xOrientation'=>'center',
                'width'=>500
            ); 
$txttit = "<b>MODULO DE FACTURACION</b>\n";
$txttit = "factura\n";
 
$pdf->ezText($txttit, 12);
$pdf->ezTable($data, $titles, '', $options);
$pdf->ezText("<b>Total Costo</b>".$acumcant, 11);
$pdf->ezText("<b>Total Cantidad</b>".$acumcost, 11);
$pdf->ezText("\n\n\n", 10);
$pdf->ezText("<b>Fecha:</b> ".date("d/m/Y"), 10);
$pdf->ezText("<b>Hora:</b> ".date("H:i:s")."\n\n", 10);
$pdf->ezStream();
?>