<?php	
	include('class.ezpdf.php');
	$pdf= & new Cezpdf('a4');
	$pdf->selectFont('fonts/Helvetica.afm');	
	$y=400;	
	$pdf->ezSetCmMargins(2,2,2.5,2.5);
	$pdf->addJpegFromFile('../../images/caesystem3.jpg',100,$y,400,'right');
	$pdf->ezText( "\n", 1);
	include('../../conexion/conexion.php');
	$link = Conectarse();	
	for($i=1; $i<=12; $i++){
$atras= date("d-m-Y", mktime(0,0,0,date("m")-$i,date("d"),date("Y")));
$atras2=  date("d-m-Y", mktime(0,0,0,date("m")-($i+1),date("d"),date("Y")));
	//$conexion = pg_connect("host=localhost user=postgres password=12345 dbname=proyecto");
$final2= pg_query ("(SELECT items.id_items as ref, items.nombre as nom, inventario.cantidad as cant, mercancia.fecha_entrada as fech FROM items, inventario, mercancia WHERE ((items.id_items = inventario.id_items) and (items.id_items = mercancia.id_items) and ((mercancia.fecha_entrada >= '$atras2') and (mercancia.fecha_entrada <= '$atras'))))order by items.id_items");
if(pg_num_rows($final2)!=0){
 while($datos=pg_fetch_array($final2)){
    $data[] = array_merge($datos);
}}}
$titles = array(
                'ref'=>'<b>Ref.</b>',
                'nom'=>'<b>Nombre</b>',
                'fech'=>'<b>Fecha</b>'
            );
$options = array(
                'shadeCol'=>array(0.9,0.9,0.9),
                'xOrientation'=>'center',
                'width'=>500
            ); 
$txttit = "<b>MODULO DE INVENTARIO</b>\n";
$txttit = "Rotacion de Productos\n";
 
$pdf->ezText($txttit, 12);
$pdf->ezTable($data, $titles, '', $options);
$pdf->ezText("\n\n\n", 10);

$total2= pg_query("select (count(mercancia.id_items)) as total, items.nombre as nomb, items.id_items as cod, inventario.cantidad as cant from items, mercancia, inventario group by  mercancia.id_items, items.nombre, inventario.cantidad, items.id_items, inventario.id_items having mercancia.id_items=items.id_items and mercancia.id_items=inventario.id_items");
if(pg_num_rows($total2)!=0){
 $ixx = 0;
 while($total3=pg_fetch_array($total2)){
    $ixx = $ixx+1;
	$tot=$total3['total']/12;
    $data2[] = array_merge($total3, array('num'=>$ixx), array('prom'=>$tot));
}}

$titles2 = array(
				'num'=>'<b>Nº</b>',
                'cod'=>'<b>Ref.</b>',
                'nomb'=>'<b>Nombre</b>',
                'total'=>'<b>Total</b>',
				'prom'=>'<b>Promedio</b>',
                'cant'=>'<b>Stock Actual</b>',
            );
$options2 = array(
                'shadeCol'=>array(0.9,0.9,0.9),
                'xOrientation'=>'center',
                'width'=>500
            ); 


$pdf->ezTable($data2, $titles2, '', $options2);
$pdf->ezText("\n\n\n", 10);

$pdf->ezText("<b>Fecha:</b> ".date("d/m/Y"), 10);
$pdf->ezText("<b>Hora:</b> ".date("H:i:s")."\n\n", 10);
$pdf->ezStream();
?>