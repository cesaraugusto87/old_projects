<?php
	include('conexion.php');
	include('../../permisos.php');
	$dbh = Conectarse();
	$anio = $_POST['theDate1'];	
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
					fecha= '$anio'";
				
    $queryresult = pg_query($dbh,$sqlstr);
	$filas = pg_num_rows($queryresult);	
?>
<title>CaeSystem - Resumen Diario</title>
<link href="../../css/styles.css" rel="stylesheet" type="text/css" />
<h2 class="Estilo1">Resumen</h2>
<hr/>
<p>

	<div align="center">
    
        
        
  <?php
	if ($filas > 0){
	?>
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
		  <th class="ReportTableHeaderCell"><div align="center">Monto_fact</div></th>
		  <th class="ReportTableHeaderCell"><div align="center">Monto_Impu</div></th>
		  <th class="ReportTableHeaderCell"><div align="center">Total</div></th>
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
	echo "<td> Sumatoria: ",$sumatoria,"</td>";
	echo "<td> Promedio: ",$promedio,"</td>";
	?>
    
    		
</table>
</div>
</td>
</tr>
</table>
<?php
	
	}
else{
?>
	<label class="titulo1">	<?php echo "No hay Ventas registradas para este dia";?> </label>
    <?php
	}
?>
</div>