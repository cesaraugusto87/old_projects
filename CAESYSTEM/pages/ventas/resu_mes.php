<?php
	include('conexion.php');
	include('../../permisos.php');
	 $dbh = Conectarse();
	 $mes = "";
	 $mes = $_POST['select_mes1'];
	 $anio = "";
	 $anio = $_POST['select_anio2'];
	 $fec = "";
	 	 
		if ($mes == 'Enero') {$fec = "01";}
		if ($mes == 'Febrero') {$fec = "02";}
		if ($mes == 'Marzo') {$fec = "03";}
		if ($mes == 'Abril') {$fec = "04";}
		if ($mes == 'Mayo') {$fec = "05";}
		if ($mes == 'Junio') {$fec = "06";}
		if ($mes == 'Julio') {$fec = "07";}
		if ($mes == 'Agosto') {$fec = "08";}
		if ($mes == 'Septiembre') {$fec = "09";}
		if ($mes == 'Octubre') {$fec = "10";}
		if ($mes == 'Noviembre') {$fec = "11";}
		if ($mes == 'Diciembre') {$fec = "12";}
		$mes = "";	
		$mes = $anio."/".$fec;

		  
	 $sqlstr="SELECT 
				facturas.id_facturas, 
				facturas.id_clientes, 
				facturas.fecha, 
				facturas.id_estado, 
				facturas.monto,
				factura_impuesto.id_impuesto,
				factura_impuesto.monto_im
				FROM 
					facturas 
				JOIN
					factura_impuesto on factura_impuesto.id_factura = facturas.id_facturas
				WHERE
					facturas.fecha between to_date('$mes/01','YYYY/mm/dd') and to_date('$mes/31','YYYY/mm/dd')";
				
     $queryresult=pg_query($dbh,$sqlstr);
	 $filas = pg_num_rows($queryresult);
?>
<title>CaeSystem- Resumen Mensual</title>
<link href="../../css/styles.css" rel="stylesheet"	type="text/css" />

	<h2 class="Estilo1">Resumen Mensual</h2>
<hr/>
<p>
    <div align="center">
    <table width="20%" height="10%" border="0" align="center" cellpadding="0" cellspacing="0" class="ReportDetails">
    <tr valign="top">
    <td>
    <div id="ReportDetails">
      <table width="20%" height="10%" align="center" cellpadding="0" border="1" cellspacing="0" class="ReportDetails">
        <tr>
          <th class="ReportTableHeaderCell"><div align="center">Id_Factura</div></th>
		  <th class="ReportTableHeaderCell"><div align="center">Id_Cliente</div></th>
		  <th class="ReportTableHeaderCell"><div align="center">Fecha</div></th>
  		  <th class="ReportTableHeaderCell"><div align="center">Status</div></th>
		  <th class="ReportTableHeaderCell"><div align="center">Id_Impuestos</div></th>
		  <th class="ReportTableHeaderCell"><div align="center">Cantidad</div></th>
		  <th class="ReportTableHeaderCell"><div align="center">Montos</div></th>
		  <th class="ReportTableHeaderCell"><div align="center">Id_Items</div></th>
	  </tr>
        
  <?php
	$sumatoria = 0;	
	$listado = $queryresult;
	$band=false;
	   
	while ($row = pg_fetch_array($listado)) {
	
	if ($band){
	?>
         <tr class="ReportDetailsOddDataRow">	      
    <?php }
	else{ ?>
         <tr class="ReportDetailsEvenDataRow">
   <?php } $band=!$band;   
	
		echo "<td>".$row["id_facturas"]."</td>";
		echo "<td>".$row["id_clientes"]."</td>";	
		echo "<td>".$row["fecha"]."</td>";		
		echo "<td>".$row["status"]."</td>";
		echo "<td>".$row["id_impuesto"]."</td>";	
		echo "<td>".$row["monto"]."</td>";
		echo "<td>".$row["monto_im"]."</td>";
		$total = $row["monto"] + $row["monto_im"];
		echo "<td>".$total."</td>";
		echo "</tr>";
			
	$sumatoria = $sumatoria + $total;
	$promedio = $sumatoria/$filas;
	}
	echo "<tr>";
?>
<td colspan="8">
<?php
		echo "</td>";
		echo "</tr>";
	echo "<tr>";
	?>
    <th class="ReportTableHeaderCell">Sumatoria: </td>
    <td class="ReportDetailsOddDataRow"> <?php echo $sumatoria; ?> </td>
    <th class="ReportTableHeaderCell">Promedio: </td>
    <td class="ReportDetailsEvenDataRow"> <?php echo $promedio; ?> </td>
	<?php echo "</tr>";
?>		
</table>
</div>
</td>
</tr>
</table>
</div>