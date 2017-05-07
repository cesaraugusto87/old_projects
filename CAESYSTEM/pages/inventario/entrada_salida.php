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
<h2><h2 class="Estilo1">Entradas/Salidas de Inventario</h2>
<hr/>
<fieldset style="border: 2px solid #2E9AFE; -moz-border-radius: 15px; -webkit-border-radius: 15px;">
<legend class="titulo2 Estilo2 Estilo3">Entrada y Salidas</legend>

<table width="626" height="121" border="0" align="center">
  <tr>
    <td colspan="3">&nbsp;</td>
    <td colspan="3">&nbsp;</td>
    </tr>
  <tr>
 <div align="center">
<td width="85" height="43"><strong class="negrita12">Fecha inicio:</strong></td>
    <td width="142">
    <div align="left"><input name="theDate1" type="text" id="theDate1" value="<?php echo (fechaactual());?>" size="15"/>
      <img src="../../images/Calendar.gif" alt="calendario" width="16" height="16" onclick="displayCalendar(document.forms[0].theDate1,'dd/mm/yyyy',this)" /></div></td>
    <td width="82"><span class="campoR">(dd/mm/aaaa)</span></td>
    <td width="69"><strong class="negrita12">Fecha fin:</strong></td>
<td width="145"><div align="left">
  <input name="theDate2" type="text" id="theDate2" value="<?php echo (fechaactual());?>" size="15" />
  <img src="../../images/Calendar.gif" alt="calendario" width="16" height="16" onclick="displayCalendar(document.forms[0].theDate2,'dd/mm/yyyy',this)" /></div></td>
    <td width="77" valign="middle"><span class="campoR">(dd/mm/aaaa)</span></td>
  </tr>
    <tr>
    <td colspan="6"><div align="center">
      <input type="submit" name="Consultar" onClick="Clear_Frame()" value="Consultar"/>
    </div></td>
  </tr>
  </div>
</table>


<?php 
 	if($_POST['Consultar']){
		$fecini= $_POST['theDate1'];
		$fecfin= $_POST['theDate2'];
		if(($fecini) && ($fecfin)){
			$items=pg_query("select inventario.id_items, items.descripcion, items.nombre, items.unidad, inventario.cantidad as cant_actual, inventario.costo
from inventario, items, 
(select distinct mercancia.id_items from mercancia where mercancia.id_merca in
(select salidas.id_merca from salidas where salidas.fecha_salida>='$fecini' and salidas.fecha_salida<='$fecfin') group by mercancia.id_items
UNION
select distinct mercancia.id_items from mercancia where mercancia.fecha_entrada>='$fecini' and mercancia.fecha_entrada<='$fecfin' group by mercancia.id_items) as mercancia
where inventario.id_items = items.id_items and inventario.id_items=mercancia.id_items");
			
			if(pg_num_rows($items)!=0){?>
	<table width="600" border="0" align="center">
    <tr valign="top">
    <td>
    <div id="ReportDetails">
    <table width="600" border="1" align="center">
					<tr>
                    	<td align="center"  class="ReportTableHeaderCell" colspan="2"></td>
                    	<td align="center"  class="ReportTableHeaderCell">Saldo Anterior</td>
                    	<td align="center"  class="ReportTableHeaderCell">Entradas</td>
                    	<td align="center"  class="ReportTableHeaderCell">Salidas</td>
                        <td align="center"  class="ReportTableHeaderCell">Saldo Actual</td>
                 	</tr>
                    <tr>
                    	<td align="center"  class="ReportTableHeaderCell">Codigo</td>
                        <td align="center"  class="ReportTableHeaderCell">Unidad</td>
                    	<td align="center"  class="ReportTableHeaderCell">Cantidad</td>
                    	<td align="center"  class="ReportTableHeaderCell">Cantidad</td>
                    	<td align="center"  class="ReportTableHeaderCell">Cantidad</td>
                        <td align="center"  class="ReportTableHeaderCell">Cantidad</td>
                 	</tr>
                    <tr>
                    	<td align="center" class="ReportTableHeaderCell" colspan="2">Nombre</td>
                    	<td align="center" class="ReportTableHeaderCell">Costo Uni.</td>
                    	<td align="center" class="ReportTableHeaderCell">Costo Uni.</td>
                    	<td align="center" class="ReportTableHeaderCell">Costo Uni.</td>
                        <td align="center" class="ReportTableHeaderCell">Costo Uni.</td>
                 	</tr>
                    <tr>
                    	<td align="center" class="ReportTableHeaderCell" colspan="2">Descripcion</td>
                    	<td align="center" class="ReportTableHeaderCell">Costo</td>
                    	<td align="center" class="ReportTableHeaderCell">Costo</td>
                    	<td align="center" class="ReportTableHeaderCell">Costo</td>
                        <td align="center" class="ReportTableHeaderCell">Costo</td>
                 	</tr>
                 	<?php
                    while($datos=pg_fetch_array($items)){
						$id_item=$datos['id_items'];
						$entradas=pg_query("select mercancia.id_items as entrada, count(mercancia.id_merca) as cantentrada from mercancia where mercancia.id_items='$id_item' and mercancia.fecha_entrada>='$fecini' and mercancia.fecha_entrada<='$fecfin' group by mercancia.id_items");
						$salidas= pg_query("select mercancia.id_items as salida, count(mercancia.id_merca) as cantsalida from mercancia where mercancia.id_merca in (select salidas.id_merca from salidas where salidas.fecha_salida>='$fecini' and salidas.fecha_salida<='$fecfin') and mercancia.id_items='$id_item' group by mercancia.id_items");
						$entradas=pg_fetch_array($entradas);
						$salidas=pg_fetch_array($salidas);
						$acumentradas1=$acumentradas1+$entradas['cantentrada'];
						$acumsalidas1=$acumsalidas1+$salidas['cantsalida'];
						$acumactual1=$acumactual1+$datos['cant_actual'];
						$acumentradas2=$acumentradas2 + ($entradas['cantentrada']*$datos['costo']);
						$acumsalidas2=$acumsalidas2 + ($salidas['cantsalida']*$datos['costo']);
						$acumactual2=$acumactual2 + ($datos['cant_actual']*$datos['costo']);
                    	?>
                    	<tr class="ReportDetailsEvenDataRow">
                    	<td class="ReportTableValueCell" align="center"><?php printf($datos['id_items']);?></td>
                        <td class="ReportTableValueCell" align="center"><?php printf($datos['unidad']);?></td>
                    	<td class="ReportTableValueCell" align="center"><?php printf($datos['cant_actual']-$entradas['cantentrada']+$salidas['cantsalida']);?></td>
                    	<td class="ReportTableValueCell" align="center"><?php if($entradas['cantentrada']=='') printf("-"); else printf($entradas['cantentrada']);?></td>
                    	<td class="ReportTableValueCell" align="center"><?php if($salidas['cantsalida']=='') printf("-"); else printf($salidas['cantsalida']);?></td>
                        <td class="ReportTableValueCell" align="center"><?php printf($datos['cant_actual']);?></td>
                 	</tr>
                    <tr class="ReportDetailsEvenDataRow">
                    	<td class="ReportTableValueCell" align="center" colspan="2"><?php printf($datos['nombre']);?></td>
                    	<td class="ReportTableValueCell" align="center"><?php printf($datos['costo']);?></td>
                    	<td class="ReportTableValueCell" align="center"><?php if($entradas['cantentrada']=='') printf("-"); else printf($datos['costo']);?></td>
                    	<td class="ReportTableValueCell" align="center"><?php if($salidas['cantsalida']=='') printf("-"); else printf($datos['costo']);?></td>
                        <td class="ReportTableValueCell" align="center"><?php printf($datos['costo']);?></td>
                 	</tr>
                    <tr class="ReportDetailsEvenDataRow">
                    	<td class="ReportTableValueCell" align="center" colspan="2"><?php printf($datos['descripcion']);?></td>
                    	<td class="ReportTableValueCell" align="center"><?php printf(($datos['cant_actual']-$entradas['cantentrada']+$salidas['cantsalida'])*$datos['costo']);?></td>
                    	<td class="ReportTableValueCell" align="center"><?php if($entradas['cantentrada']=='') printf("-"); else printf($datos['costo']*$entradas['cantentrada']);?></td>
                    	<td class="ReportTableValueCell" align="center"><?php if($salidas['cantsalida']=='') printf("-"); else printf($datos['costo']*$salidas['cantsalida']);?></td>
                        <td class="ReportTableValueCell" align="center"><?php printf($datos['costo']*$datos['cant_actual']);?></td>
                 	</tr>
		
 <?php
					}
		    }
?>
				<tr class="ReportDetailsEvenDataRow">
                    	<td align="center" colspan="2"class="ReportTableHeaderCell">Total de Cantidades</td>
                    	<td align="center" class="ReportTableValueCell"><?php printf($acumactual1+$acumsalidas1-$acumentradas1);?></td>
                    	<td align="center" class="ReportTableValueCell"><?php printf($acumentradas1);?></td>
                    	<td align="center" class="ReportTableValueCell"><?php printf($acumsalidas1);?></td>
                        <td align="center" class="ReportTableValueCell"><?php printf($acumactual1);?></td>
                 	</tr>
                    <tr class="ReportDetailsEvenDataRow">
                    	<td align="center" class="ReportTableHeaderCell" colspan="2">Total de Costos</td>
                    	<td align="center" class="ReportTableValueCell"><?php printf($acumactual2+$acumsalidas2-$acumentradas2);?></td>
                    	<td align="center" class="ReportTableValueCell"><?php printf($acumentradas2);?></td>
                    	<td align="center" class="ReportTableValueCell"><?php printf($acumsalidas2);?></td>
                        <td align="center" class="ReportTableValueCell"><?php printf($acumactual2);?></td>
                 	</tr>
 			</table>
<?php
		}else{
		}
		
	}
 ?>

</table></div></label></td>
</tr></table>
</fieldset>
</form>
</body>
</html>