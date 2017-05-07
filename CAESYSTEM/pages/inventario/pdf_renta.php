<?php	
	include('class.ezpdf.php');
	$pdf= & new Cezpdf('a4');
	$pdf->selectFont('fonts/Helvetica.afm');	
	$y=400;	
	$pdf->ezSetCmMargins(2,2,2.5,2.5);
	$pdf->addJpegFromFile('../../images/caesystem3.jpg',600, $y, 300, 'right');
	$pdf->ezText( "\n", 1);	
	include('../../conexion/conexion.php');
	$link = Conectarse();
	//$conexion = pg_connect("host=localhost user=postgres password=12345 dbname=proyecto");
	$atras3= date("d-m-Y", mktime(0,0,0,date("m")-(12),date("d"),date("Y"))); 
	$fecha_actual= date("d-m-Y");
$saldo=pg_query("select items.id_items as ref, items.descripcion as descrip, inventario.costo as costo, cantidades.cantidad as cantidad, cantidades.costo as venta
from items, inventario,
(select mercancia.id_items, count(mercancia.id_merca) as cantidad, sum((inventario.costo*(porcentajes.porcentaje)/100) + inventario.costo) as costo from
inventario, mercancia,
(select facturas_detalles.id_merca, precios.porcentaje from facturas, facturas_detalles, precios where facturas.fecha>= '$atras3' and facturas.fecha<='$fecha_actual' and facturas.id_estado='E-2' and facturas.id_facturas=facturas_detalles.id_facturas and facturas_detalles.id_precio= precios.id_precio) as porcentajes
where mercancia.id_merca=porcentajes.id_merca and mercancia.id_items=inventario.id_items
group by mercancia.id_items) as cantidades
where cantidades.id_items=items.id_items and items.id_items=inventario.id_items");

if(pg_num_rows($saldo)!=0){
	while($datos=pg_fetch_array($saldo)){
	$cost=$datos['costo']*$datos['cantidad'];
	$venta=$datos['venta']*$datos['cantidad'];
	$margen=(($venta-$cost)/$venta)*100;
	$dife=$venta-$cost;
    $data[] = array_merge($datos, array('total'=>$cost), array('venta'=>$venta), array('margen'=>$margen), array('dife'=>$dife));
}}
$titles = array(
                'ref'=>'<b>Ref.</b>',
                'descrip'=>'<b>Descripcion</b>',
				'cantidad'=>'<b>Cantidad</b>',
				'total'=>'<b>Costo</b>',
				'venta'=>'<b>Valor Venta</b>',
				'margen'=>'<b>Margen %</b>',
                'costo'=>'<b>Costo Unidad</b>',
				'dife'=>'<b>Diferencia</b>',
				
            );
$options = array(
                'shadeCol'=>array(0.9,0.9,0.9),
                'xOrientation'=>'center',
                'width'=>500
            ); 
$txttit = "<b>MODULO DE INVENTARIO</b>\n";
$txttit = "Margen de Rentabilidad\n";
 
$pdf->ezText($txttit, 12);
$pdf->ezTable($data, $titles, '', $options);
$pdf->ezText("\n\n\n", 10);
$pdf->ezText("<b>Fecha:</b> ".date("d/m/Y"), 10);
$pdf->ezText("<b>Hora:</b> ".date("H:i:s")."\n\n", 10);
$pdf->ezStream();
?>