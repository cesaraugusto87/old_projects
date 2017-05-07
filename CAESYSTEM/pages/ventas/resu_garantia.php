<?php
	 include('conexion.php');
	 include('../../permisos.php');
	 $dbh = Conectarse();	
	 $anio = "";
	 $anio = $_POST['select_anio'];
	 $stats = "";
	 $stats = $_POST['status'];	 
	 $sqlstr="SELECT 			  
			  c.id_clientes, 
			  f.id_facturas, 
			  f.id_clientes, 
			  f.id_garantia, 
			  f.id_precio, 
			  n.id_facturas, 
			  m.id_merca, 
			  i.id_items, 
			  g.id_garantia, 
			  p.id_precio,
			  g.descripcion,
			  m.fecha_entrada			  
			FROM 
			  facturas as f, 
			  facturas_detalles as n, 
			  garantia as g, 
			  mercancia as m, 
			  precios as p, 
			  clientes as c, 
			  items as i 
			WHERE
			  f.id_facturas = n.id_facturas AND			  
			  f.id_precio = p.id_precio AND
			  n.id_merca = m.id_merca AND
			  m.id_items = i.id_items AND
			  c.id_clientes = f.id_clientes AND
			  m.fecha_entrada between to_date('$anio/01/01','YYYY/mm/dd') and to_date('$anio/12/31','YYYY/mm/dd') AND
			  g.descripcion = '$stats';";
			  

			  
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////Resultados de la Cadena//////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////				

    	$queryresult=pg_query($dbh, $sqlstr);
	 	$filas = pg_num_rows($queryresult);
?>

<title>CaeSystem- Resumen de Garantias</title>
<link href="../../css/styles.css" rel="stylesheet"	type="text/css" />
<h2 class="Estilo1">Resumen de Garantias</h2>
<hr/>
<p>
    <div align="center">
    <table width="20%" height="10%" border="0" align="center" cellpadding="0" cellspacing="0" class="ReportDetails">
    <tr valign="top">
    <td>
    <div id="ReportDetails">
      <table width="20%" height="10%" align="center" cellpadding="0" border="1" cellspacing="0" class="ReportDetails">
        <tr>      
          	 <th class="ReportTableHeaderCell" width="20%"> c.id_clientes</th> 
			 <th class="ReportTableHeaderCell" width="20%"> f.id_facturas</th> 
			 <th class="ReportTableHeaderCell" width="20%"> f.id_garantia</th> 
			 <th class="ReportTableHeaderCell" width="20%"> f.id_precio</th>  
			 <th class="ReportTableHeaderCell" width="20%"> m.id_merca</th> 
			 <th class="ReportTableHeaderCell" width="20%"> g.descripcion</th>
             <th class="ReportTableHeaderCell" width="20%"> m.fecha_entrada</th>
	  </tr>
        
  <?php
///////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////Resumen Mostrado en una Tabla Dinamica///////////////////
/////////////////////////////////////////////////////////////////////////////////////// 
if ($filas > 0){
	while ($row = pg_fetch_array($queryresult)) {
		echo "<td>".$row[0]."</td>";
		echo "<td>".$row[1]."</td>";
		echo "<td>".$row[3]."</td>";
		echo "<td>".$row[4]."</td>";
		echo "<td>".$row[6]."</td>";
		echo "<td>".$row[10]."</td>";
		echo "<td>".$row[11]."</td>";
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