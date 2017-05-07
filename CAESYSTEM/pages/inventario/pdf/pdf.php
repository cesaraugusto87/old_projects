<?php	
	include('class.ezpdf.php');
	$pdf= & new Cezpdf();
	$pdf->selectFont('fonts/Helvetica.afm');	
	$y=400;	
	$pdf->addJpegFromFile('imagen/2.jpeg',10,$y,100,60);
	$pdf->ezText( "\n", 1);
	$pdf->addJpegFromFile('imagen/3.jpeg',200,$y,100,60);	
	$pdf->ezText( "\n", 10);	
	$host="host=localhost";
	$dbname="dbname=prueba";
	$user="user=postgres";
	$password="password=123456";
	$sql="select * from pdf";
	$result=pg_query(pg_connect("$host $dbname $user $password"), $sql);	
	$pdf->ezText('Esta es una Prueba con EZPDF', 15);
	$pdf->ezText( "\n", 10);	
	$titles = array('id'=>'<b>ID</b>', 'dato'=>'<b>Descripcion</b>');	
	$pdf->ezText("\n",10);	
	$data="";
	while($row = pg_fetch_array ($result)){		
		$data[] = array('id'=>$row['id'],'dato'=>$row['dato']);
	}
	$pdf->ezTable($data,$titles,'',$options);
	$sql="select * from producto";
	$result=pg_query(pg_connect("$host $dbname $user $password"), $sql);
	$titles = array('id'=>'<b>ID</b>', 'pro'=>'<b>Producto</b>', 'cant'=>'<b>Cantidad</b>');
	$data="";
	$pdf->ezText( "\n",1);
	while($row = pg_fetch_array ($result)){		
		$data[] = array('id'=>$row['id'],'pro'=>$row['nombre'],'cant'=>$row['cant']);
	}
    $pdf->ezTable($data,$titles,'',$options );
	$pdf->ezText('Y asi las imagenes...', 15);
	$pdf->ezStream();
?>
