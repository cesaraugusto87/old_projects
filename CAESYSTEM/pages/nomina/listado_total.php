<?php
include('../../conexion/conexion.php');
include('funciones.php');
include('../../permisos.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Formulario modelo</title>
<link href="../../css/styles.css" rel="stylesheet"	type="text/css" />
<?php
function Consulta()
{
	$consulta= "select empleados.ficha, personal.nombres, personal.apellidos, personal.cedula, empleados.fecha_inicio, cargo.descripcion, estado.descripcion, 
sueldo_detalle.monto, sueldo_detalle.fecha from  personal, empleados, cargo, sueldo_detalle, estado
where personal.cedula = empleados.cedula and empleados.id_cargo = cargo.id_cargo and empleados.ficha = sueldo_detalle.ficha and empleados.id_estado=estado.id_estado
order by sueldo_detalle.fecha, empleados.ficha";
	return $consulta;
}

  function Listado()
  {
	$link= Conectarse();
	$result = pg_query($link,Consulta());
	$band=false;
	if ($result)
	while($row = pg_fetch_row($result))
	{
	if ($band){
	?>
         <tr class="ReportDetailsOddDataRow">	      
    <?php }
	else{ ?>
         <tr class="ReportDetailsEvenDataRow">
   <?php } $band=!$band; ?>  
          <td class="ReportTableValueCell"><?php echo($row[0]) ?></td>
          <td class="ReportTableValueCell"><?php echo($row[1]) ?></td>
          <td class="ReportTableValueCell"><?php echo($row[2]) ?></td>
          <td class="ReportTableValueCell"><?php echo($row[3]) ?></td>
          <td class="ReportTableValueCell"><?php echo($row[4]) ?></td>
          <td class="ReportTableValueCell"><?php echo($row[5]) ?></td>
          <td class="ReportTableValueCell"><?php echo($row[6]) ?></td>
   		 <td class="ReportTableValueCell"><?php echo(fechas($row[4]))?></td>
          <td class="ReportTableValueCell"><?php echo($row[7]) ?></td>
          <td class="ReportTableValueCell"><?php echo($row[8]) ?></td>
      </tr>
	<?php  
	}
	}
	
	?>  




<style type="text/css">
</style>
</head>
<body>
<form id="formDivisiones" name="formDivisiones" method="get" action="libreria.php">
<h2 class="Estilo1">Listado Total de Nomina</h2>
<hr/>
<p>
<table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="ReportDetails">
   <tr valign="top">
    <td>
    <div id="ReportDetails">
    <table border="1" align="center">
    <tr>
    	   <th class="ReportTableHeaderCell" width="14.5%">Ficha</th>
          <th class="ReportTableHeaderCell" width="14.5%">Nombre</th>
          <th class="ReportTableHeaderCell" width="14.5%">Apellido</th>
          <th class="ReportTableHeaderCell" width="14.5%">Cédula</th>
          <th class="ReportTableHeaderCell" width="14.5%">Fecha Inicio</th>
          <th class="ReportTableHeaderCell" width="14.5%">Cargo</th>
          <th class="ReportTableHeaderCell" width="14.5%">Activo</th>
	      <th class="ReportTableHeaderCell" width="14.5%"><div align="center">A. antiguedad</div></th>
          <th class="ReportTableHeaderCell" width="14.5%">Sueldo</th>
          <th class="ReportTableHeaderCell" width="14.5%">Fecha</th>

        </tr>
	<?php Listado() ?>
            </table>
      <p>
        <label>
        <div align="center">
          <div align="center"></div>
      </label></td>
  </tr>
</table>
<div align="center">
  <input type="submit" name="enviar" id="enviar" value="Imprimir"/>
</div>
<input name="consulta" id="consulta" type="hidden" value="<?php echo Consulta(); ?>"/>
</form>
</body>
</html>
