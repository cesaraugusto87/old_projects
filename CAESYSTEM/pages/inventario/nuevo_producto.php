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
<h2 class="Estilo1">Nuevo Producto</h2>
<hr/>
<br>
<br>
<div align="center">
<?php
		echo ('<FROM Method="post" Action="ingresar_producto.php" <strong class="negrita12"><align="center">Cod. Categoria </strong>');
		$ref=pg_query("SELECT categoria_items.id_categoria_items as items from categoria_items");
		echo '<select name="codigo">';
		echo '<option>   </option>';
		if(pg_num_rows($ref)!=0){
		while($datos=pg_fetch_array($ref)){
		$id_it=$datos['items'];
		echo '<option>'.$id_it;
		}} 
		$consul= pg_query("select max(id_items) as itm from items");
		if(pg_num_rows($consul)!=0){
		while($datos4=pg_fetch_array($consul)){
		$id_itm= $datos4['itm'] +1;
		}}
		?> </select>
		</div>
		<br>
		<br>

<table width="320" border="0" align="center" cellpadding="0" cellspacing="0" class="ReportDetails">
   <tr valign="top">
    <td>
    <div id="ReportDetails">
    <table width="320" border="1" align="center">
		<tr> 
		<td class="ReportTableHeaderCell">Cod. Items:</td>
		<td class="ReportDetailsOddDataRow" align="center"><?php printf($id_itm);?></td>
		</tr>
		<tr> 
		<td class="ReportTableHeaderCell"> Nombre Producto:</td>
		<td class="ReportDetailsOddDataRow"  align="center"><input type="text" name="nombr"/></td>
		</tr>
		<tr> 
		<td class="ReportTableHeaderCell">Descripcion:</td>
		<td class="ReportDetailsOddDataRow" align="center"><input type="text" name="descrip"/></td>
		</tr>
		<tr> 
		<td class="ReportTableHeaderCell">Unidad:</td>
		<td class="ReportDetailsOddDataRow" align="center"><input type="text" name="unidad"/></td>
		</tr>
		 <tr>
  <td colspan="2" class="ReportDetailsOddDataRow">
    <div align="center" class="ReportDetailsEvenDataRow">
      <input type="submit" name="Guardar" onClick= "Valida(this.form)" value="Guardar" />
    </div></td>
  </tr>
</table></td>
	</tr></table>
	
		<?php
		if($_POST['Guardar']){
		$items= $_POST['codigo'];	
	    $nombr= $_POST['nombr'];
		$descrip= $_POST['descrip'];
		$unidad= $_POST['unidad'];}
		if($items && $nombr && $descrip && $unidad){
		$consu= pg_query("select max(id_inventario) as ma from inventario");
		if(pg_num_rows($consu)!=0){
		while($datos3=pg_fetch_array($consu)){
		$id= $datos3['ma'] +1;
		}}
		//insertar mercancia
		$inse_mer= pg_query("insert into items (id_items, nombre, descripcion, unidad, id_categoria_items) values ('$id_itm', '$nombr', '$descrip', '$unidad', '$items')");
		$inse_inv=pg_query("insert into inventario (costo, cantidad, id_estado, id_inventario, id_items) values ('0', '0', 'E-1', '$id', '$id_itm')");
	}
		
		if($items){
			$consult=pg_query("SELECT categoria_items.descripcion as nombre from categoria_items where categoria_items.id_categoria_items='$items'");
			if(pg_num_rows($consult)!=0){?>
			
			<br>
			<br>
			<br>
					
   <table width="320" border="0" align="center" cellpadding="0" cellspacing="0" class="ReportDetails">
   <tr valign="top">
    <td>
	<div id="ReportDetails">
    <table width= "320" border="1" align="center">
    <tr> 
		<th class="ReportTableHeaderCell" colspan="1" scope="col"><div align="center">ID Inventario</div></th>
        <th class="ReportTableHeaderCell" colspan="1" scope="col"><div align="center">Nombre Categoria</div></th>
		
		 </tr><?
	  while($datos2=pg_fetch_array($consult)){?>
		<tr center class="ReportDetailsEvenDataRow">
						<td class="ReportTableValueCell" colspan="1"><div align="center"><?php printf($id);?></div></td>
						<td class="ReportTableValueCell" colspan="1"><div align="center"><?php printf($datos2['nombre']);?></div></td>
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
 if (form.nombr.value.length == " ") {
    alert('Ingrese el nombre del producto');
    form.nombr.focus();
    return (false);
  }
   if (form.descrip.value.length == " ") {
    alert('Ingrese la descripcion');
    form.descrip.focus();
    return (false);
  }
   if (form.unidad.value.length == " ") {
    alert('Ingrese las unidades');
    form.unidad.focus();
    return (false);
  }
   form.submit();
}
 
</SCRIPT>

 