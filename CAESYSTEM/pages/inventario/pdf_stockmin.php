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
	/*if($_POST['Consultar']){
		$minimo= $_POST['minimo'];
		if($minimo){*/
			$items=pg_query("select items.id_items as ref , items.nombre as nom, items.descripcion as descrip, items.unidad as unid, categoria_items.descripcion as categoria, inventario.cantidad as cant, inventario.costo as costo, estado.descripcion as estado from estado, items, categoria_items, inventario where inventario.cantidad<='20' and inventario.id_items= items.id_items and items.id_categoria_items= categoria_items.id_categoria_items and inventario.id_estado= estado.id_estado order by categoria");
			if(pg_num_rows($items)!=0){
				  while($datos=pg_fetch_array($items)){
						$data[]= array_merge($datos);
						
}}//}}
$titles = array(
                'categoria'=>'<b>Categoria</b>',
                'ref'=>'<b>Ref.</b>',
				'nom'=>'<b>Nombre</b>',
				'unid'=>'<b>Unidad</b>',
                'descrip'=>'<b>Descripcion</b>',
				'estado'=>'<b>Estado</b>',
				'cant'=>'<b>Cantidad</b>',
                'costo'=>'<b>Costo Unidad</b>',				
            );
$options = array(
                'shadeCol'=>array(0.9,0.9,0.9),
                'xOrientation'=>'center',
                'width'=>500
            ); 
$txttit = "<b>MODULO DE INVENTARIO</b>\n";
$txttit = "Stock Minimo\n";
 
$pdf->ezText($txttit, 12);
$pdf->ezTable($data, $titles, '', $options);
$pdf->ezText("\n\n\n", 10);
$pdf->ezText("<b>Fecha:</b> ".date("d/m/Y"), 10);
$pdf->ezText("<b>Hora:</b> ".date("H:i:s")."\n\n", 10);
$pdf->ezStream();
?>