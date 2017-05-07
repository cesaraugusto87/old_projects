<?php
include('../../permisos.php');
include('funciones.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Modulo Inventario</title>
<link href="../../css/styles.css" rel="stylesheet"	type="text/css" />
<style type="text/css">
#formDivisiones .ReportDetails tr td table {
	text-align: center;
}
</style>


<link type="text/css" rel="stylesheet" href="../../css/dhtmlgoodies_calendar.css?random=20051112" media="screen"></LINK>

<link href="../../css/styles.css" rel="stylesheet"	type="text/css" />
<script src="../../js/date.js"></script>
  
<SCRIPT type="text/javascript" src="../../js/dhtmlgoodies_calendar.js?random=20060118"></script>

<style type="text/css">
</style>

<script language="JavaScript" type="text/JavaScript"> 
function enviar()
{
		var fecha1=(String(document.getElementById("theDate1").value));
		var fecha2=(String(document.getElementById("theDate2").value));
		if (fecha1==null || fecha2==null || fecha1=="" || fecha2=="")
		{
			alert("Error:: Campos vacios");
			return false;
		}
		else
		{
			if ((compareDates(fecha1,"dd/MM/yyyy",fecha2,"dd/MM/yyyy"))==0)
				document.formDemo.submit();
			else
			{
				alert("Error::rango de fechas invalido");
				return false;
			}
		}
}

</script>


</head>
<?php 
include('../../conexion/conexion.php');?>
<body>
<?php 
$link = Conectarse();
$fecha_actual= date("d-m-Y");

?>

<form id="formDivisiones" name="formDivisiones" method="post">
<h2 class="Estilo1"> Margen de Rentabilidad</h2>
<hr/>



<div align="right">
 
  
  
  <a href='pdf_renta.php'><IMG SRC="../../images/guardar1.jpg" onClick="pdf_renta.php"></a><br>  
  <h4 align="rigth"> 
  Reporte del  
  <? $atras3= date("d-m-Y", mktime(0,0,0,date("m")-(12),date("d"),date("Y")));echo($atras3);?>  
  al <?echo($fecha_actual);?> 
  
  <?
$saldo=pg_query("select items.id_items as ref, items.nombre as nom, inventario.costo as costo, cantidades.cantidad as cantidad, cantidades.costo as venta
from items, inventario,
(select mercancia.id_items, count(mercancia.id_merca) as cantidad, sum((inventario.costo*(porcentajes.porcentaje)/100) + inventario.costo) as costo from
inventario, mercancia,
(select facturas_detalles.id_merca, precios.porcentaje from facturas, facturas_detalles, precios where facturas.fecha>= '$atras3' and facturas.fecha<='$fecha_actual' and facturas.id_estado='E-2' and facturas.id_facturas=facturas_detalles.id_facturas and facturas_detalles.id_precio= precios.id_precio) as porcentajes
where mercancia.id_merca=porcentajes.id_merca and mercancia.id_items=inventario.id_items
group by mercancia.id_items) as cantidades
where cantidades.id_items=items.id_items and items.id_items=inventario.id_items");

if(pg_num_rows($saldo)!=0){
?>
  
</div>
<table width="600" border="0" align="center">
   <tr valign="top">
    <td>
    <div id="ReportDetails">
    <table width="600" border="1" align="center">
					<tr>
						<td width="26" align="center" class="ReportTableHeaderCell" scope="col">Ref.</td>
                    	<td width="98" align="center" class="ReportTableHeaderCell" scope="col">Nombre</td>
                        <td width="54" align="center" class="ReportTableHeaderCell" scope="col">Cantidad</td>
                        <td width="59" align="center" class="ReportTableHeaderCell" scope="col">Costo</td>
                        <td width="78" align="center" class="ReportTableHeaderCell" scope="col">Valor Ventas</td>
						<td width="61" align="center" class="ReportTableHeaderCell" scope="col">Margen</td>
                        <td width="85" align="center" class="ReportTableHeaderCell" scope="col">Costo Unidad</td>
						<td width="112" align="center" class="ReportTableHeaderCell" scope="col">Diferencia</td>
                    </tr>
                        
                    
			<?php

			while($datos=pg_fetch_array($saldo)){
			?>
						    <tr class="ReportDetailsEvenDataRow">
							<td class="ReportTableValueCell"><div align="center"><?php echo($datos['ref']);?></div></td>
                			<td class="ReportTableValueCell"><div align="center"><?php echo($datos['nom']);?></div></td>
                    		<td class="ReportTableValueCell"><div align="center"><?php echo($datos['cantidad']);?></div></td>
                    		<td class="ReportTableValueCell"><div align="center"><?php $costo=$datos['cantidad']*$datos['costo']; echo($costo);?></div></td>
                    		<td class="ReportTableValueCell"><div align="center"><?php $venta=$datos['venta']*$datos['cantidad'];echo($venta);?></div></td>
							<td class="ReportTableValueCell"><div align="center"><?php $margen=(($venta-$costo)/$venta)*100; 
																			$float_redondeado=round($margen * 100) / 100; 														
																			echo($float_redondeado.'%');?></div></td>
							<td class="ReportTableValueCell"><div align="center"><?php echo($datos['costo']);?></div></td>
                    		<td class="ReportTableValueCell"><div align="center"> <?php $dife=$venta-$costo; echo($dife);?>
                  		  </div></td>
                		</tr>
						
	<?php
}}
?> </table></div></label></td>
	</tr></table></form>
	</body>
</html>