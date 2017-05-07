<?php
include('../../permisos.php');
include('funciones.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link type="text/css" rel="stylesheet" href="../../css/dhtmlgoodies_calendar.css?random=20051112" media="screen"></LINK>

<link href="../../css/styles.css" rel="stylesheet"	type="text/css" />
<script src="../../js/date.js"></script>
  
<SCRIPT type="text/javascript" src="../../js/dhtmlgoodies_calendar.js?random=20060118"></script>

<style type="text/css">
</style>

<script language="JavaScript" type="text/JavaScript"> 
function enviar()
{
		var fecha1=(String(document.getElementById("ci").value));
		if (fecha1==null || fecha1=="" )
		{
			alert("Debe introducir un nro Cedula");
			return false;
		}
		else
		{
			document.formDivisiones.submit();
		}
}

</script>
</head>
<?php require('../../conexion/conexion.php');?>

<body>
<?php $link = Conectarse();
if ($_GET["ci"])
{
$consulta = "select sueldos.monto_hora, empleados.ficha from   personal, empleados, sueldos where personal.cedula = empleados.cedula and empleados.id_nivel = sueldos.id_nivel and personal.cedula = '".$_GET["ci"]."'";
$result = pg_query($link,$consulta);

$row = pg_fetch_row($result);
$monto = $row[0];
$ficha = $row[1];
$result = pg_query($link, "select porcentaje from bonos_y_debitos");
if ($result)
$i=0;
	while($row = pg_fetch_row($result))
	{
		$w[$i]=$monto * $row[0]; 
		$i++;
	}
$fecha = date("d/m/Y");
$monto1 = $monto - $w[0] - $w[1] - $w[2];
$fecha1 = substr ($_GET['theDate'],6,8)."/".substr ($_GET['theDate'],3,3);
if (substr ($_GET['theDate'],3,4)==02)
	$dia=28;
else
	$dia=30;
$consulta = "select personal.nombres, personal.apellidos, cargo.id_cargo, sueldo_detalle.monto, sueldo_detalle.bonos, sueldo_detalle.prestamos
from   personal, empleados, cargo, sueldo_detalle
where personal.cedula = empleados.cedula and empleados.id_cargo = cargo.id_cargo and empleados.ficha = sueldo_detalle.ficha and empleados.ficha = '".$ficha."' and sueldo_detalle.fecha >= '".$fecha1."01' and sueldo_detalle.fecha <= '".$fecha1.$dia."' and 
sueldo_detalle.corte = '".$_GET['corte']."'";
//echo $consulta;
$result = pg_query($link,$consulta);
$row = pg_fetch_row($result);
}
?>

<form id="formDivisiones" name="formDivisiones" method="get" onsubmit="return enviar();" action="recibo_nomina.php">
<h2 class="Estilo1">Recibo de Nomina</h2>
<hr/>
<p>&nbsp;</p>
<table width="320" border="0" align="center" cellpadding="0" cellspacing="0" class="ReportDetails">
   <tr valign="top">
    <td>
    <div id="ReportDetails">
	<table width="320" height="54" border="0" align="center">
  <tr>
    <td height="24" class="ReportTableHeaderCell"><strong class="negrita12">Fecha:</strong></td>
    <td class="ReportDetailsOddDataRow"><div align="center">
      <input name="theDate" type="text" id="theDate1" value="<?php echo (fechaactual());?>" size="15"/>
      <img src="../../images/Calendar.gif" alt="calendario" width="16" height="16" onclick="displayCalendar(document.forms[0].theDate1,'dd/mm/yyyy',this)" /></div></td>
  </tr>
  <tr>
    <td width="135" height="24" class="ReportTableHeaderCell">Periodo:</td>
    <td width="175" class="ReportDetailsEvenDataRow"align="center"><select name="corte" id="corte">
        <option value="15" selected="selected">Primer Corte</option>
        <option value="30">Segundo Corte</option>
      </select></td>
  </tr>
  <tr>
  <td class="ReportTableHeaderCell">Ingrese Nro de Cedula:</td>
  <td class="ReportDetailsOddDataRow"align="center"><input type="text" name="ci" id="ci" /></td>
  </tr>
  <tr>
  <td colspan="2" class="ReportDetailsOddDataRow">
    <div align="center" class="ReportDetailsEvenDataRow">
      <input type="submit" name="boton" id="boton" value="Enviar"/>
    </div></td>
  </tr>
</table>
   </div>
   </td>
   </tr>
  </table>
<?php if ($_GET['ci']) {?>
    <table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="ReportDetails">
   <tr>
    <td valign="top">
    <div id="ReportDetails">
    <p>
        <label>
        <div align="center">
        <table width="600" border="1" align="center">
        <div id="ReportDetails">
          <tr>
        
            <th class="ReportTableHeaderCell" colspan="2"><div align="center">Asignaciones</div></td>
            <th  class="ReportTableHeaderCell" colspan="2"><div align="center">Deducciones</div></td>
          </tr>
          <tr>
            <td class="ReportTableHeaderCell" >Sueldo:</td>
            <td class="ReportDetailsEvenDataRow" align="center"><label><?php echo $monto/2; ?></label></td>
            <td class="ReportTableHeaderCell" >Seguro Social</td>
            <td class="ReportDetailsEvenDataRow" align="center"><label><?php echo $w[0];?></label>&nbsp;</td>
          </tr>
          <tr>
            <td class="ReportTableHeaderCell" >Bono:</td>
            <td class="ReportDetailsEvenDataRow"align="center"><label><?php echo  $row[4];?></label></td>
            <td class="ReportTableHeaderCell" >Ley de Politica Habitacional</td>
            <td class="ReportDetailsEvenDataRow"align="center"><label><?php echo $w[1];?></label>&nbsp;</td>
          </tr>
          <tr>
          <td class="ReportDetailsEvenDataRow" colspan="2" rowspan="3">
            <td class="ReportTableHeaderCell" >Seguro de Paro Forzoso</td>
            <td class="ReportDetailsEvenDataRow"align="center"><?php echo $w[2];?></td>
          </tr>
          <tr>
            <td class="ReportTableHeaderCell" >Impuesto Sobre la Renta</td>
            <td class="ReportDetailsEvenDataRow"align="center">&nbsp;<?php echo  $row[5];?></td>
          </tr>
          <tr>
          
            <td class="ReportTableHeaderCell" >Prestamos</td>
            <td class="ReportDetailsEvenDataRow"></td>
          </tr>
          <tr>
          
             <?php if ($row[0]){?>
<table width="600" border="1" align="center">
              <tr>
                <th class="ReportTableHeaderCell" width="51"><div align="center">Nombre</div></td>
                <th class="ReportTableHeaderCell" width="51"><div align="center">Apellido</div></td>
                <th class="ReportTableHeaderCell" width="42">Cargo </td>
                <th class="ReportTableHeaderCell" width="87">Neto a Pagar</td>
              </tr>
              <tr class="ReportDetailsEvenDataRow">
                <td><?php echo  $row[0];?></td>
                <td><?php echo  $row[1];?></td>
                <td><?php echo  $row[2];?></td>
                <td><?php echo  $row[3];?></td>
              </tr>
          </table>
            <?php }?>
          </tr>
        </table>
        <div align="center"></div>
        
      </label></td>
  </tr>
</table>
<?php }?>
</form>

</body>
</html>
