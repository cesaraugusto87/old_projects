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
	//$conexion = pg_connect("host=localhost user=postgres password=12345 dbname=ultimo");
$saldo=pg_query("select inventario.id_items as ref, items.nombre as nom, categoria_items.descripcion as cate, categoria_items.id_categoria_items as id, inventario.cantidad as cant, inventario.costo as costo from inventario, items, categoria_items where ((inventario.id_items=items.id_items) and (categoria_items.id_categoria_items=items.id_categoria_items)) order by categoria_items.descripcion");
if(pg_num_rows($saldo)!=0){
	while($datos=pg_fetch_array($saldo)){
	$total2= $datos['costo'];
				$cantidad= $datos['cant'];
				$total2= $total2* $cantidad;
				$acumcant=$acumcant+$cantidad;
				$acumcost=$acumcost+$total2;
	$cost=$datos['costo']*$datos['cant'];
    $data[] = array_merge($datos, array('total'=>$cost));
}}
$titles = array(
                'cate'=>'<b>Categoria</b>',
                'ref'=>'<b>Ref.</b>',
                'nom'=>'<b>Nombre</b>',
				'cant'=>'<b>Cantidad</b>',
                'costo'=>'<b>Costo Unidad</b>',
				'total'=>'<b>Costo</b>',
            );
$options = array(
                'shadeCol'=>array(0.9,0.9,0.9),
                'xOrientation'=>'center',
                'width'=>500
            ); 
$txttit = "<b>MODULO DE INVENTARIO</b>\n";
$txttit = "Saldo de Inventario\n";
 
$pdf->ezText($txttit, 12);
$pdf->ezTable($data, $titles, '', $options);
$pdf->ezText("<b>Total Costo</b>".$acumcant, 11);
$pdf->ezText("<b>Total Cantidad</b>".$acumcost, 11);
$pdf->ezText("\n\n\n", 10);
$pdf->ezText("<b>Fecha:</b> ".date("d/m/Y"), 10);
$pdf->ezText("<b>Hora:</b> ".date("H:i:s")."\n\n", 10);
$pdf->ezStream();
?>