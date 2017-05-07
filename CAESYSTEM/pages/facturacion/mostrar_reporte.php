<?php
include('../../permisos.php');
 include('funciones.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Reporte Facturas</title>
<link href="../../css/styles.css" rel="stylesheet"	type="text/css" />
<style type="text/css">
.Estilo2 {color: #0000FF}
.Estilo3 {font-size: 14px}
</style>
<link href="../../../css/calendar-brown.css" rel="StyleSheet" type="text/css">
<link type="text/css" rel="stylesheet" href="../../css/dhtmlgoodies_calendar.css?random=20051112" media="screen"></LINK>
<script src="../../js/date.js"></script>
 <SCRIPT type="text/javascript" src="../../js/dhtmlgoodies_calendar.js?random=20060118"></script>

<link href="../../css/dhtmlgoodies_calendar.css" rel="stylesheet" type="text/css" />
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

<?php require('../../conexion/conexion.php');
$link = Conectarse();
?>
<body>
<form id="Reporte" name="Reporte" method="post" action="">
  <p class="Estilo1">Reporte Facturas</p>
  <hr />
<fieldset style="border: 2px solid #2E9AFE; -moz-border-radius: 15px; -webkit-border-radius: 15px;">
<legend class="titulo2 Estilo2 Estilo3">Reporte de Facturas</legend>
<br>
<div>
<table align="center">
  <tr>
    <td width="85" height="43"><strong class="negrita12">Fecha inicio:</strong></td>
    <td width="142">
    <div align="left"><input name="theDate1" type="text" id="theDate1" value="<?php echo (fechaactual());?>" size="15"/>
      <img src="../../images/Calendar.gif" alt="calendario" width="16" height="16" onclick="displayCalendar(document.forms[0].theDate1,'dd/mm/yyyy',this)" /></div></td>

   <td width="69"><strong class="negrita12">Fecha fin:</strong></td>
	<td width="145"><div align="left">
  		<input name="theDate2" type="text" id="theDate2" value="<?php echo (fechaactual());?>" size="15" />
  		<img src="../../images/Calendar.gif" alt="calendario" width="16" height="16" onclick="displayCalendar(document.forms[0].theDate2,'dd/mm/yyyy',this)" /></div></td>
  	<td><input type="submit" name="Consultar" onClick="Clear_Frame()" value="Consultar" /></td>
  </tr>
</table>
</div>
	<br><br>
<?php
	if($_POST['Consultar']){
		$fecini= $_POST['theDate1'];
		$fecfin= $_POST['theDate2'];
		$consulta=pg_query("SELECT facturas.id_facturas as num_fact, facturas.fecha as fecha, facturas.id_clientes as cliente, facturas.monto as monto, clientes.nombres as nombre, clientes.apellidos as apellido, clientes.rif as rif, factura_impuesto.monto_im as impuesto FROM facturas, clientes, factura_impuesto WHERE facturas.id_clientes= clientes.id_clientes and facturas.id_facturas= factura_impuesto.id_factura and facturas.fecha>='$fecini' and facturas.fecha<='$fecfin' order by facturas.fecha");

?>
<table border="1" align="center">
					<tr>
                    	<td align="center" class="ReportTableHeaderCell">Fecha</td>
                    	<td align="center" class="ReportTableHeaderCell">Nro. Factura</td>
                    	<td align="center" class="ReportTableHeaderCell">Cliente</td>
                        <td align="center" class="ReportTableHeaderCell">Monto</td>
                        <td align="center" class="ReportTableHeaderCell">Impuesto</td>	
						<td align="center" class="ReportTableHeaderCell">Total</td>					
                 	</tr>
                 	<?php
                    while($datos=pg_fetch_array($consulta)){
						$monto=$datos['monto'];
						$impuesto=$datos['impuesto'];
						$total=$monto+$impuesto;			
					?>
					<tr class="ReportDetailsEvenDataRow">
                    	<td align="center" class="ReportTableValueCell"><?php echo($datos['fecha']);?></td>
                    	<td align="center" class="ReportTableValueCell"><?php echo($datos['num_fact']);?></td>
                    	<td align="center" class="ReportTableValueCell"><?php echo($datos['rif']." - ".$datos['nombre'].",".$datos['apellido']);?></td>
                        <td align="center" class="ReportTableValueCell"><?php echo($datos['monto']);?></td>							
                        <td align="center" class="ReportTableValueCell"><?php echo($datos['impuesto']);?></td>
						<td align="center" class="ReportTableValueCell"><?php echo($total);?></td>
                 	</tr>
 <?php
		    }
?>
  </table>
<?php
}
?>
<br>
</fieldset>

</form>
</body>
</html>
