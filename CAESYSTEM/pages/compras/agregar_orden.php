<?php
session_start();
?>
<?php
if($_SESSION["nivel"]!=1) {


header('Location: ../../logueoerror.php');
exit;

}
?>
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



	<link type="text/css" rel="stylesheet" href="../../css/dhtmlgoodies_calendar.css?random=20051112" media="screen"></LINK>

<link href="../../css/styles.css" rel="stylesheet"	type="text/css" />
<script src="../../js/date.js"></script>
  
<SCRIPT type="text/javascript" src="../../js/dhtmlgoodies_calendar.js?random=20060118"></script>
<script language="javascript" type="text/javascript">

function vacio(q) {
        for ( i = 0; i < q.length; i++ ) {
                if ( q.charAt(i) != " " ) {
                        return true
                }
        }
        return false
}

//valida que el campo no este vacio y no tenga solo espacios en blanco
function valida(F) {
        
        if( vacio(F.proveedor.value) == false ) {
                alert("Introduzca un Proveedor por favor.")
                return false
        } 
         if( vacio(F.impuesto.value) == false ) {
                alert("Introduzca un Impuesto.")
                return false
        }
}




</script>
</head>
<body><p class="Estilo1">Nueva Orden de Compra</p>
<hr/>
<form action="rejilla_agregar_orden.php" onSubmit="return valida(this);" method="get" name="form1"  id="form1">

<p>
<table width="480" border="0" align="center" cellpadding="0" cellspacing="0" class="ReportDetails">
   <tr valign="top">
    <td>
    <div id="ReportDetails">
    <table width="480" border="1" align="center" class="ReportDetails">
    <tr>
      <td width="165" class="ReportTableHeaderCell">Proveedores</td>
      <td width="236" class="ReportDetailsOddDataRow"> <?php $query_busqueda="SELECT * FROM proveedores ORDER BY id_rif";
$rs_busqueda=pg_query($query_busqueda);
$filas=pg_num_rows($rs_busqueda);
		?>
  <select name= "proveedor" id="proveedor" >
  <option value="">Seleccione Proveedor</option>
  <?php for ($i = 0; $i < pg_num_rows($rs_busqueda); $i++) {?>
  <option value="<?php echo $proveedor=pg_fetch_result($rs_busqueda,$i,"id_rif"); $resul=$proveedor;?>"><?php echo $items=pg_fetch_result($rs_busqueda,$i,"descripcion")?></option>
  <?php }?>
 </select> </td>
    </tr>
    <tr>
      <td class="ReportTableHeaderCell">
          Fecha pedido
      </td>
      <td class="ReportDetailsEvenDataRow"> <input name="fecha_pedido" type="text" id="fecha_pedido" value="<?php echo(fechaactual()); ?>" size="15" readonly>
      <img src="../../images/Calendar.gif" alt="calendario" width="16" height="16" onclick="displayCalendar(document.forms[0].fecha_pedido,'dd/mm/yyyy',this)" />   </td>
    </tr>
    <tr>
      <td class="ReportTableHeaderCell">Fecha de entrega</td>
      <td class="ReportDetailsOddDataRow"><input name="fecha_entrega" type="text" id="fecha_entrega" value="<?php echo(fechaactual()); ?>" size="15" readonly>
      <img src="../../images/Calendar.gif" alt="calendario" width="16" height="16" onclick="displayCalendar(document.forms[0].fecha_entrega,'dd/mm/yyyy',this)" /></td>
    </tr>
    <tr>
      <td class="ReportTableHeaderCell">Estatus</td>
      <td class="ReportDetailsEvenDataRow"> <select name="estatus">
      <option value="despacho">Despachado</option>
      <option value="sindespachar">Sin Despachar</option>
    </select></td>
    </tr>
    <tr>
      <td class="ReportTableHeaderCell">Impuesto</td>
      <td class="ReportDetailsOddDataRow"> <select name="impuesto">
      <option value="">Elija impuesto</option>
      <option value="1">Iva</option>
      </select></td>
    </tr>
    <tr>
      <td colspan="2" class="ReportDetailsEvenDataRow"><div align="center">
        <input name="crear orden" type="submit" id="crear orden" value="Crear Orden" />
      </div></td>
    </tr>
  </table>
 </div>
 </td>
 </tr>
 </table>
</form>


</body>
</html>
