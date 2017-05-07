<?php
include('../../permisos.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Modulo Inventario</title>
<link href="../../css/styles.css" rel="stylesheet"	type="text/css" />
<style type="text/css">
</style>
</head>
<?php include('../../conexion/conexion.php');?>
<body>
<?php 
$link = Conectarse();
$fecha_actual= date("d-m-Y");
?>
<form id="formDivisiones" name="formDivisiones" method="post">
<h2 class="Estilo1">Ingresar Producto</h2>
<hr/>
<br>
<br>
<div align="center">
<?
		echo ('<FROM Method="post" Action="ingresar_producto.php" <strong class="negrita12"><align="center">Cod. Producto </strong>');
		$ref=pg_query("SELECT items.id_items as items from items");
		echo '<select name="codigo">';
		echo '<option>   </option>';
		if(pg_num_rows($ref)!=0){
		while($datos=pg_fetch_array($ref)){
		$id_it=$datos['items'];
		echo '<option>'.$id_it;
		}} 
		$consul= pg_query("select max(id_merca) as idm from mercancia");
		if(pg_num_rows($consul)!=0){
		while($datos4=pg_fetch_array($consul)){
		$id_itm= $datos4['idm'] +1;
		}}
		?>	
		</select>
</div>
		<br>
		<br>

		
<table width="320" border="0" align="center" cellpadding="0" cellspacing="0" class="ReportDetails">
   <tr valign="top">
    <td>
    <div id="ReportDetails">
    <table width="320" border="1" align="center">
		<tr> 
		<td class="ReportTableHeaderCell">Cod. Mercancia:</td>
		<td class="ReportDetailsOddDataRow" align="center"><?php printf($id_itm);?></td>
		</tr>
		<tr> 
		<td class="ReportTableHeaderCell">Serial:</td>
		<td class="ReportDetailsOddDataRow" align="center"><input type="text" name="serie"/></td>
		</tr>
		<tr> 
		<td class="ReportTableHeaderCell">Costo:</td>
		<td class="ReportDetailsOddDataRow" align="center"><input type="text" name="costo"/></td>
		</tr>
		<tr>
		 <td colspan="2" class="ReportDetailsOddDataRow">
    <div align="center" class="ReportDetailsEvenDataRow">
	<input type="submit" name="Guardar" onClick="Valida(this.form)" value="Guardar" /> 
    </div></td>
		</tr>
</table></td>
	</tr></table>
		
		<?php
		
		if($_POST['Guardar']){
		$items= $_POST['codigo'];
		$serial= $_POST['serie'];
		$cost= $_POST['costo'];
	    $cost;
		$serial;
		}
		$cons=pg_query("SELECT inventario.cantidad as cant, inventario.id_inventario as id from inventario, items where items.id_items='$items' and inventario.id_items='$items'");
			if(pg_num_rows($cons)!=0){
				 while($datos3=pg_fetch_array($cons)){
				  $cant= $datos3['cant'];
				  $id= $datos3['id'];
		if( $serial && $cost){		
		$id;
		$cant;
		$items;
		$fecha_actual;	
		//insertar mercancia
		$inse_mer= pg_query("insert into mercancia (id_items, serial, fecha_entrada, id_merca, id_estado) values ('$items', '$serial', '$fecha_actual', '$id_itm', 'E-1')");
		//actualizar el inventario
		$cant=$cant+1;
		$act_inv= pg_query("update inventario set cantidad='$cant', id_estado='E-1', costo='$cost' where id_items='$items' and id_inventario='$id'");			
		}}}
		if($items){
			$consult=pg_query("SELECT items.nombre as nombre, inventario.cantidad as cant, inventario.id_inventario as id from inventario, items where items.id_items='$items' and inventario.id_items='$items'");
			if(pg_num_rows($consult)!=0){
			?>
			<br>
			<br>
			<br>
		<table width="320" border="0" align="center" cellpadding="0" cellspacing="0" class="ReportDetails">
   <tr valign="top">
    <td>
    <div id="ReportDetails">
    <table width="320" border="1" align="center">
    <tr> 
        <th class="ReportTableHeaderCell">Nombre:</th>
        <th class="ReportTableHeaderCell">Stock Actual:</th>
      </tr><?
	  while($datos2=pg_fetch_array($consult)){
	 ?>
	  <tr center class="ReportDetailsEvenDataRow">

							<td class="ReportTableValueCell" align="center"><?php printf($datos2['nombre']);?></td>
                			<td class="ReportTableValueCell" align="center"><?php printf($datos2['cant']);?></td>
		</tr>
		<?
		}}}
			
		?>
		
	</form></form></table></table>	 
<br>
</body>
</html>

<SCRIPT LANGUAGE="JavaScript">

function upperMe(field) {
    field.value = field.value.toLowerCase();
}
</SCRIPT>
<SCRIPT>
function Valida(form){
if (form.costo.value.length == " ") {
    alert('Ingrese el costo del producto');
    form.costo.focus();
    return (false);
  }
  var checkOK = "1234567890";
  var checkStr = form.costo.value;
 var allValid = true;
  for (i = 0; i < checkStr.length; i++) {
    ch = checkStr.charAt(i);
    for (j = 0; j < checkOK.length; j++)
      if (ch == checkOK.charAt(j))
        break;
    if (j == checkOK.length) {
      allValid = false;
      break;
    }
	   allNum += ch;
  if (!allValid) {
    alert('Escriba Numeros en el campo \Costo\'.');
    form.costo.focus();
    return (false);
  }
}
if (form.serie.value.length == " ") {
    alert('Ingrese el serial del producto');
    form.serie.focus();
    return (false);
  }
  var checkOK = "1234567890";
  var checkStr = form.serie.value;
 var allValid = true;
  for (i = 0; i < checkStr.length; i++) {
    ch = checkStr.charAt(i);
    for (j = 0; j < checkOK.length; j++)
      if (ch == checkOK.charAt(j))
        break;
    if (j == checkOK.length) {
      allValid = false;
      break;
    }
	   allNum += ch;
  if (!allValid) {
    alert('Escriba Numero en el campo \'Serial\'.');
    form.serie.focus();
    return (false);
  }
  } 
    form.submit();
}
 
</SCRIPT>
 