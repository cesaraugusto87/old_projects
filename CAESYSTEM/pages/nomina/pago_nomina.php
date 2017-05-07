<?php require('../../conexion/conexion.php');
include('../../permisos.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>
<link type="text/css" rel="stylesheet" href="../../css/dhtmlgoodies_calendar.css?random=20051112" media="screen"></LINK>

<link href="../../css/styles.css" rel="stylesheet"	type="text/css" />
</head>

<body>
<form id="form1" name="form1" method="POST" action="Imprimir_listin.php">
  <h2 class="Estilo1">Pago de Nomina</h2>
<hr/>
<div align="center">
<fieldset style="height:150px; width:480px; border: 2px solid #2E9AFE; -moz-border-radius: 15px; -webkit-border-radius: 15px;">
<legend class="titulo2 Estilo2 Estilo3">Ejecutar Nomina</legend>

  <label>
  <div align="center">
    <p>&nbsp;</p>
    <table width="432" border="0" align="center">
      <tr>
        <td height="39" class="negrita12">
        Corte        </td>
        <td>
          <select name="corte" id="corte">
            <option value="15">Primer Corte</option>
            <option value="30">Segundo Corte</option>
          </select>        </td>
        <td class="negrita12">
        Bono        </td>
        <td>        
          <label>
          <input type="text" name="bono" id="bono" />
        </label></td>
      </tr>
      <tr>
      <td colspan="4">
        <div align="center">
          <input type="submit" name="Pagar Nomina" id="Pagar Nomina" value="Pagar Nomina" />      
        </div></td>
      </tr>
    </table>
</fieldset>
</div>
</form>
<?php 
if ($_POST['corte']){
$link = Conectarse();
if (date("m")==02)
	$dia=28;
else
	$dia=30;
$fechaActual = date ("m/Y");
$fechaActual1 = date ("d/m/Y");
$consulta = "SELECT fecha FROM sueldo_detalle where (fecha >='01/".$fechaActual."' and fecha <= '".$dia."/".$fechaActual."') and corte = '".$_POST['corte']."'";
$result = pg_query($link,$consulta);
$row = pg_fetch_row($result);
$consulta = "SELECT fecha FROM sueldo_detalle where fecha ='".$fechaActual1."'";
$result2 = pg_query($link,$consulta);
$row2 = pg_fetch_row($result2);
if (!$row && !$row2){
$consulta = "select sueldos.monto_hora, empleados.ficha from   personal, empleados, sueldos where personal.cedula = empleados.cedula and empleados.id_nivel = sueldos.id_nivel;";
$result1 = pg_query($link,$consulta);

while ($row1 = pg_fetch_row($result1)){
$monto = $row1[0];
$ficha = $row1[1];
$result = pg_query($link, "select porcentaje from bonos_y_debitos");
if ($result)
$i=0;
	while($row = pg_fetch_row($result))
	{
		$w[$i]=$monto * $row[0]; 
		$i++;
	}
$fecha = date("d/m/Y");
if ($_POST['corte']==30)
$consulta = "select monto from prestamos where id_ficha ='".$ficha."' and fecha >='16/".$fechaActual."' and fecha <= '".$dia."/".$fechaActual."'";
else
$consulta = "select monto from prestamos where id_ficha ='".$ficha."' and fecha >='01/".$fechaActual."' and fecha <= '15/".$fechaActual."'";
$result = pg_query($link, $consulta);
$prestamo=0;
while($row = pg_fetch_row($result))
{
		$prestamo=$prestamo + $row[0]; 
}
$monto1 = $monto - $w[0] - $w[1] - $w[2] - $prestamo + $_POST['bono'];
$consulta = "INSERT INTO sueldo_detalle(
            ficha, fecha, monto, bonos, prestamos, corte)
    VALUES ('".$ficha."', '".$fecha."', '".$monto1."','".$_POST['bono']."','".$prestamo."','".$_POST['corte']."');";
pg_query($link,$consulta);

$consulta = "select personal.nombres, personal.apellidos, cargo.id_cargo, sueldo_detalle.monto 
from   personal, empleados, cargo, sueldo_detalle
where personal.cedula = empleados.cedula and empleados.id_cargo = cargo.id_cargo and empleados.ficha = sueldo_detalle.ficha and empleados.ficha = '".$ficha."'";
$result = pg_query($link,$consulta);
$row = pg_fetch_row($result);
?>
<h2 class="Estilo1">Recibo de Nomina, Nro de Ficha: <?php echo $ficha; ?></h2>
<hr/>

<table width="600" height="300" border="1" align="center" cellpadding="0" cellspacing="0" class="ReportDetails">
   <tr>

    <td height="250" valign="top">
    <div id="ReportDetails">
    <p>
    <table width="331" border="0" align="center">
          <tr>
                    <td class="ReportTableHeaderCell" colspan="2"><div align="center">Asignaciones</div></td>
            <td  class="ReportTableHeaderCell" colspan="2"><div align="center">Deducciones</div></td>
          </tr>
          <tr>
            <td>Sueldo:</td>
            <td><label><?php echo $monto; ?></label></td>
            <td>Seguro Social</td>
            <td><label><?php echo $w[0];?></label>&nbsp;</td>
          </tr>
          <tr>
            <td>Bono:</td>
            <td><label><?php echo $_POST['bono']; ?></label></td>
            <td>Ley de Politica Habitacional</td>
            <td><label><?php echo $w[1];?></label>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>Seguro de Paro Forzoso</td>
            <td><label><?php echo $w[2];?></label>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>Prestamos</td>
            <td><label></label><?php echo $prestamo; ?></td>
          </tr>
        </table>
      <div align="center"></div>
        <div align="center"></div>
  <div align="center">
            <p>
              <input type="submit" name="enviar" id="enviar" value="Enviar" />
            </p>
        <div id="ReportDetails">
             <?php if ($row[0]){?>
<table width="259" border="1">
              <tr>
                <td width="51"><div align="center">Nombre</div></td>
                <td width="51"><div align="center">Apellido</div></td>
                <td width="42">Cargo </td>
                <td width="87">Neto a Pagar</td>
              </tr>
              <tr class="ReportDetailsOddDataRow">
                <td><?php echo  $row[0];?></td>
                <td><?php echo  $row[1];?></td>
                <td><?php echo  $row[2];?></td>
                <td><?php echo  $monto1;?></td>
              </tr>
          </table>
            <?php }?>
          <p>&nbsp;    </p>
  </div>
      </label></td>
  </tr>
</table>
<?php }}}?>
</body>
</html>
