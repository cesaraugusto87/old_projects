<?php 
require ("../../conexion/conexion.php");
include ("funciones.php");
Conectarse();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>


<link href="../../css/styles.css" rel="stylesheet"	type="text/css" />
	<link type="text/css" rel="stylesheet" href="../../css/dhtmlgoodies_calendar.css?random=20051112" media="screen"></LINK>

<link href="../../css/styles.css" rel="stylesheet"	type="text/css" />
<script src="../../js/date.js"></script>
  
<SCRIPT type="text/javascript" src="../../js/dhtmlgoodies_calendar.js?random=20060118"></script>

    
    </head>

<body>
<form action="rejilla_agregar_orden.php" onSubmit="alert('Has pulsado enviar.'); return true;" method="get" name="form1" class="ReportDetailsOddDataRow" id="form1">
  <label>proveedoes
  <?php $query_busqueda="SELECT * FROM proveedores ORDER BY id_proveedores";
$rs_busqueda=pg_query($query_busqueda);
$filas=pg_num_rows($rs_busqueda);
		?>
  <select name= "proveedor" id="proveedor" >
  <option value="0">Seleccione Proveedor</option>
  <?php for ($i = 0; $i < pg_num_rows($rs_busqueda); $i++) {?>
  <option value="<?php echo $proveedor=pg_fetch_result($rs_busqueda,$i,"id_proveedores"); $resul=$proveedor;?>"><?php echo $items=pg_fetch_result($rs_busqueda,$i,"descripcion")?></option>
  <?php }?>
    </label>
  <p>
  
  
    <label>Fecha pedido 
    <input name="fecha_pedido" type="text" id="fecha_pedido" value="<?php echo(fechaactual()); ?>" size="15"/>
      <img src="../../images/Calendar.gif" alt="calendario" width="16" height="16" onclick="displayCalendar(document.forms[0].fecha_pedido,'dd/mm/yyyy',this)" />
    						   
						  </label>
  </p>
  <p>
    <label>Fecha de entrega
<input name="fecha_entrega" type="text" id="fecha_entrega" value="<?php echo(fechaactual()); ?>" size="15"/>
      <img src="../../images/Calendar.gif" alt="calendario" width="16" height="16" onclick="displayCalendar(document.forms[0].fecha_entrega,'dd/mm/yyyy',this)" />


      </label>
  </p>
  <p>
    <label>Estatus
    <select name="estatus">
      <option value="1">Despachado</option>
      <option value="2">Sin Despachar</option>
    </select>
    </label>
  </p>
  <p>
    <label>Impuesto
    <select name="impuesto">
      <option value="0">Elija impuesto</option>
      <option value="1">Iva</option>
      <option value="2">Aduana</option>
      <option value="3">Otros</option>
    </select>
    </label></p>
  <p>
    <label>
    <input name="crear orden" type="submit" id="crear orden" value="crear orden" />
    </label>
  </p>
</form>


</body>
</html>
