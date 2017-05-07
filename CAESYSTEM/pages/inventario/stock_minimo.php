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
<?php 
include('../../conexion/conexion.php');?>
<body>
<?php 
$link = Conectarse();
$fecha_actual= date("d-m-Y");
?>

<form id="formDivisiones" name="formDivisiones" method="post">
<h2><h2 class="Estilo1">Stock Minimo de Inventario</h2>
<hr/>

<form id="rango" name="rango" method="post"> 
<div align="center">
<fieldset style="height:120px; width:500px; border: 2px solid #2E9AFE; -moz-border-radius: 15px; -webkit-border-radius: 15px;">
<legend class="titulo2 Estilo2 Estilo3">Stock Mínimo</legend>

 <br>
 <br>
	&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <strong class="letras"> Stock Minimo: </strong>
	<input type="text" border="5" name="minimo">
	&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <input type="submit" name="Consultar" onClick="Clear_Frame()" value="Consultar" />
 <br><br>
  </fieldset>   </div>

<?php
 	if($_POST['Consultar']){
		$minimo= $_POST['minimo'];
		if($minimo){
			$items=pg_query("select items.id_items, items.nombre, items.descripcion, items.unidad, categoria_items.descripcion as categoria, inventario.cantidad, inventario.costo, estado.descripcion as estado from estado, items, categoria_items, inventario where inventario.cantidad<='$minimo' and inventario.id_items= items.id_items and items.id_categoria_items= categoria_items.id_categoria_items and inventario.id_estado= estado.id_estado order by categoria");
			if(pg_num_rows($items)!=0){?>
			
	<table width="600" border="0" align="center">
    <tr valign="top">
    <td>
    <div id="ReportDetails">
    <table width="600" border="1" align="center">
					<tr>
                    	<td align="center" class="ReportTableHeaderCell">Nro. Item</td>
                    	<td align="center" class="ReportTableHeaderCell">Nombre</td>
                    	<td align="center" class="ReportTableHeaderCell">Unidad</td>
                    	<td align="center" class="ReportTableHeaderCell">Descripcion</td>
                        <td align="center" class="ReportTableHeaderCell">Estado</td>
                        <td align="center" class="ReportTableHeaderCell">Cantidad</td>
                        <td align="center" class="ReportTableHeaderCell">Costo</td>
                 	</tr>
                 	<?php
                    while($datos=pg_fetch_array($items)){
						$categoria= $datos['categoria'];
						if($categoria!=$categoriault){
					?>
                    	<tr>
                    		<td align="center" colspan="7" class="ReportTableHeaderCell">Categoria: <?php printf($categoria);?></td>
                 		</tr>
                    <?php
						}
					?>
						<tr class="ReportDetailsEvenDataRow">
                    		<td align="center" class="ReportTableValueCell"><?php printf($datos['id_items']);?></td>
                    		<td align="center" class="ReportTableValueCell"><?php printf($datos['nombre']);?></td>
                    		<td align="center" class="ReportTableValueCell"><?php printf($datos['unidad']);?></td>
                    		<td align="center" class="ReportTableValueCell"><?php printf($datos['descripcion']);?></td>
                        	<td align="center" class="ReportTableValueCell"><?php printf($datos['estado']);?></td>
                        	<td align="center" class="ReportTableValueCell"><?php printf($datos['cantidad']);?></td>
                        	<td align="center" class="ReportTableValueCell"><?php printf($datos['costo']);?></td>
                 		</tr>
 <?php
 						$categoriault=$categoria;
					}
		    }
?>
 			</table>
<?php
		}else{
		}
		
	}
 ?>	
</table></div></label></td>
</tr></table>
</form>
</body>
</html>