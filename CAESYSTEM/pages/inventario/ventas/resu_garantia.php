<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../../../../css/styles.css" rel="stylesheet"	type="text/css" />

<title>CaeSystem- Resumen de Garantias</title>
</head>
<h2 align="center" class="titulos"> Resumen de Garantias </h2>
<hr/>
<?php
	 include('conexion/conexion.php');
	 include('../../permisos.php');
	 $dbh = Conectarse();	
	 $anio = "";
	 $anio = $_POST['select_anio'];
	 $stats = "";
	 $stats = $_POST['status'];	 
	 $sqlstr="SELECT 
			  clientes.id_clientes, 
			  facturas.id_facturas, 
			  facturas.id_clientes, 
			  facturas.id_garantia, 
			  facturas.id_precio, 
			  facturas_detalles.id_facturas, 
			  mercancia.id_merca, 
			  items.id_items, 
			  garantia.id_garantia, 
			  precios.id_precio
			FROM 
			  public.facturas, 
			  public.facturas_detalles, 
			  public.garantia, 
			  public.mercancia, 
			  public.precios, 
			  public.clientes, 
			  public.items
			WHERE 
			  facturas.id_facturas = facturas_detalles.id_facturas AND
						  facturas.id_garantia = garantia.id_garantia AND
						  facturas.id_precio = precios.id_precio AND
						  facturas_detalles.id_merca = mercancia.id_merca AND
						  mercancia.id_items = items.id_items AND
						  clientes.id_clientes = facturas.id_clientes AND 
						  mercancia.fecha_entrada between to_date('$anio/01/01','YYYY/mm/dd') and to_date('$anio/12/31','YYYY/mm/dd') AND
						  garantia.descripcion = 'stats'";

			  
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////Resultados de la Cadena//////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////				

    	$queryresult=pg_query($dbh, $sqlstr);
	 	$filas = pg_num_rows($queryresult);
?>
<table width="700" border="0" align="center" cellpadding="0" cellspacing="0" class="ReportDetails">
    <tr valign="top">
    <td>
    <table border="1" align="center">
      <tr>
          	<th class="ReportTableHeaderCell" width="20%"> Nº Clientes</th>
			<th class="ReportTableHeaderCell" width="20%"> Nombre</th>
			<th class="ReportTableHeaderCell" width="20%"> Apellidos</th>
			<th class="ReportTableHeaderCell" width="20%"> Fecha De Entrada</th>
			<th class="ReportTableHeaderCell" width="20%">> Id Estado</th>
			<th class="ReportTableHeaderCell" width="20%"> Descripción</th>
			<th class="ReportTableHeaderCell" width="20%"> Id Garantía</th>
			<th class="ReportTableHeaderCell" width="20%"> Descripción Garantía</th>
			<th class="ReportTableHeaderCell" width="20%"> Id Estado Mercancía</th>
			<th class="ReportTableHeaderCell" width="20%"> Id Ítems</th>
			<th class="ReportTableHeaderCell" width="20%"> Descripción</th>
			<th class="ReportTableHeaderCell" width="20%"> Nº factura</th>
	  </tr>
        
  <?php
///////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////Resumen Mostrado en una Tabla Dinamica///////////////////
/////////////////////////////////////////////////////////////////////////////////////// 
if ($filas > 0){
	while ($row = pg_fetch_array($queryresult)) {
		echo "<tr>";
		echo "<td>".$row["clientes.id_clientes"]."</td>";
		echo "<td>".$row["clientes.nombres"]."</td>";
		echo "<td>".$row["clientes.apellidos"]."</td>";
		echo "<td>".$row["mercancia.fecha_entrada"]."</td>";
		echo "<td>".$row["estado.id_estado"]."</td>";
		echo "<td>".$row["estado.descripcion"]."</td>";
		echo "<td>".$row["garantia.id_garantia"]."</td>";
		echo "<td>".$row["garantia.descripcion"]."</td>";
		echo "<td>".$row["facturas_detalles.id_merca"]."</td>";
		echo "<td>".$row["items.id_items"]."</td>";
		echo "<td>".$row["items.descripcion"]."</td>";
		echo "<td>".$row["facturas.id_facturas"]."</td>";
		echo "</tr>";
		
				
				
		}
}
else
		{
			echo "No hay objetos en la base de datos";
		
		}
?>
</table>	
</table>

