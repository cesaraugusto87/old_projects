<?php
include('class.ezpdf.php');
//include('consulta/conexion.php');
include('../../conexion/conexion.php');
$Conexion;
$pdf =& new Cezpdf('a4');
$pdf->selectFont('fonts/courier.afm');
$datacreator = array (
					'Title'=>'Nomina Prestamos',
					'Author'=>'jimresso',
					'Subject'=>'Prestamos',
					'Creator'=>'Prestamos',
					'Producer'=>'jimresso@gmail.com'
					);
$pdf->addInfo($datacreator);

$FICHA =$_POST['ficha'];
$MONTO =$_POST['Monto'];		
	  			$query="select p.nombres, p.apellidos from personal p, empleados e  
	  			where '$FICHA' = e.ficha and e.cedula= p.cedula";		
	  			$result=pg_query($query);
				if(!$result)
					echo"No se Encontraron registros...\;";
				else{		
					
					$var=pg_fetch_array($result);
		
					$nombre=$var[0];
					$apellido=$var[1];
					$Ficha = $FICHA;
					$Fecha_solicitud = date("d,m,y");
					echo"\n<tr>";		
					}	
	  
//-----------------------------------------------------------------------------------------------------------------
$data[] = array('Nombre'=>"'.$nombre.'", 'Apellido'=>'', 'Ficha'=>$_POST['ficha'], 'Monto solicitado'=>$_POST['Monto']);

$pdf->ezText("<b>Solicitud de Prestamos</b>\n",16);
$pdf->ezText("\n",12);
$pdf->ezTable($data,$titles,'',$options );
$pdf->ezText("\n\n\n",10);
$pdf->ezText("<b>Fecha:</b> ".date("d/m/Y"),10);
$pdf->ezText("<b>Hora:</b> ".date("H:i:s")."\n\n",10);
//$pdf->ezStream();
$pdf->isFile($pdf->ezOutput());
?>

