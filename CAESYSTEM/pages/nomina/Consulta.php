<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Solicitud</title>
</head>
     <p><?php 
/**********************************************************************************************/
		  		//include('conexion.php');
				//include('consulta/conexion.php');
				include('../../conexion/conexion.php');
				include('class.ezpdf.php');
		  		//$Conexion;
				$conn= Conectarse();
      			$FICHA =$_POST['ficha'];
				$MONTO =$_POST['Monto'];		
				$query="select p.nombres, p.apellidos from personal p, empleados e  
	  			where '$FICHA' = e.ficha and e.cedula= p.cedula";
				$result=pg_query($conn,$query);
				if(!$result)
					echo"No se Encontraron registros...\;";
				else{		
					echo"<div align=\"center\">";
					echo"\n<table  border=\"1\" cellpadding=\"2\" cellspacing=\"0\">";
					echo"\n<tr>";
					echo"\n <td align=>Nombre<font></td>
		 				<td align=>Apellido</td>
		        		<td align=>Ficha</td> 
						<td align=>Fecha de Solicitud</td>";	
					echo"\n</tr>";
					
					$var=pg_fetch_array($result);
		
					$nombre=$var[0];
					$apellido=$var[1];
					$Ficha = $FICHA;
					$Fecha_solicitud = date("d,m,y");
					echo"\n<tr>";
					echo"\n<td width=\"100\"align=<font>$nombre</font></td>
			       		<td width=\"150\"align=<font>$apellido</font></td>
				   		<td width=\"150\"align=<font>$Ficha</font></td>
						<td width=\"150\"align=<font>$Fecha_solicitud</font></td>";
					echo"\n</tr>";	
					}
/***********************************************************************************************/
					$query1="SELECT MAX(id_prestamo)
						FROM prestamos";		
	  			    $ultimo= pg_query($conn,$query1);
					if (!$ultimo){
					  echo"No pude allar la maxima cantidad  solicitada";
					}else{
					$var2=pg_fetch_array($ultimo);
					$ultimo3=$var2[0] + 1;
					}		
/***********************************************************************************************/
// Creo el registro  en prestamos para la solicitud
/*____*/
					$query2="INSERT INTO prestamos(
            				id_prestamo, id_ficha, tipo, monto, fecha, id_estado)
    					VALUES('$ultimo3','$FICHA','prestamos','$MONTO','$Fecha_solicitud','04');";
						$insertar=pg_query($conn, $query2);
/************************************************************************************************/					
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
					$data[] = array('Nombre'=>"$nombre", 'Apellido'=>"$apellido", 'Ficha'=>$_POST['ficha'], 'Monto solicitado'=>$_POST['Monto']);

					$pdf->ezText("<b>Solicitud de Prestamos</b>\n",16);
					$pdf->ezText("\n",12);
					$pdf->ezTable($data,$titles,'',$options );
					$pdf->ezText("\n\n\n",10);
					$pdf->ezText("<b>Fecha:</b> ".date("d/m/Y"),10);
					$pdf->ezText("<b>Hora:</b> ".date("H:i:s")."\n\n",10);
					$pdf->isFile($pdf->ezOutput());
/************************************************************************************************/
							
	  ?>
<body>
<div align="center">
<link href="../../css/styles.css" rel="stylesheet"	type="text/css" />
  <p align="center"><strong>Detalle del Prestamos</strong></p>
<form id="form1" name="form1" method="post" action="Envio_solicitud.php">
<div align="center"><strong>Solicitud registrada</strong><br />
          <br />
          <input type="submit" name="Aceptar" id="Aceptar" value="Aceptar" />
          <br />
          </p>
  </div>
</div> 
      </label>
    </p>
  </form>
<p>&nbsp;</p>
</div>
</body>

</html>
