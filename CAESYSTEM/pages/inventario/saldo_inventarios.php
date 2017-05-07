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
<h2><h2 class="Estilo1">Saldo de Inventario</h2>
<hr/>
<div align="right">
<style type="text/css">

</style>
<a href='pdf_saldo.php'><IMG SRC="../../images/guardar1.jpg" onClick="pdf_saldo.php"></a><br>
<h4 align="rigth"> <?php ?>Saldo Hasta: <?echo($fecha_actual);
$categ=pg_query("select distinct(categoria_items.id_categoria_items) as categoria, categoria_items.descripcion as descrip from categoria_items, items where categoria_items.id_categoria_items=items.id_categoria_items order by categoria_items.descripcion");
if(pg_num_rows($categ)!=0){
?>

<table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="ReportDetails">
   <tr valign="top">
    <td>
    <div id="ReportDetails">
    <table border="1" align="center">
    <tr>
	
<table width="600" border="1" align="center">	
						<td align="center" colspan="5" class="ReportTableHeaderCell">Categoria</td>
		</tr>				
				<?php
			while($datos=pg_fetch_array($categ)){
				$id_cate=$datos['categoria'];
				$saldo=pg_query("select inventario.id_items as ref, items.nombre as nom, categoria_items.descripcion as cate, categoria_items.id_categoria_items, inventario.cantidad as cant, inventario.costo as costo from inventario, items, categoria_items where inventario.id_items=items.id_items and categoria_items.id_categoria_items=items.id_categoria_items and categoria_items.id_categoria_items='$id_cate'");
				
			?>
						  
							<td align="center" class="ReportTableHeaderCell" colspan="5"><?php printf($datos['descrip']);?></td>
									
                    	
                        <div align="center"></div>
	<?php
		if(pg_num_rows($saldo)!=0){
		?>
						<tr>
						<td width="60" class="ReportTableHeaderCell" scope="col"><div align="center">Ref.</div></td>
                    	<td width="200" class="ReportTableHeaderCell" scope="col"><div align="center">Nombre</div></td>
                        <td width="100" class="ReportTableHeaderCell" scope="col"><div align="center">Cantidad<div></td>
						<td width="100" class="ReportTableHeaderCell" scope="col"><div align="center">Costo Unidad</div></td>
                        <td width="100" class="ReportTableHeaderCell" scope="col"><div align="center">Costo</div></td>
						</tr>
			
	<?php
			while($datos2=pg_fetch_array($saldo)){
				$total2= $datos2['costo'];
				$cantidad= $datos2['cant'];
				$total2= $total2* $cantidad;
				$acumcant=$acumcant+$cantidad;
				$acumcost=$acumcost+$total2;

			?>
				<tr class="ReportDetailsEvenDataRow">					
							<td class="ReportTableValueCell"><?php echo($datos2['ref']);?></td>
                    		<td class="ReportTableValueCell"><?php echo($datos2['nom']);?></td>
                    		<td class="ReportTableValueCell"><?php echo($datos2['cant']);?></td>
							<td class="ReportTableValueCell"><?php echo($datos2['costo']);?></td>
							<td class="ReportTableValueCell"><?php $total=$datos2['costo']*$datos2['cant']; echo($total);?></td>
							
                		</tr>
						    
			
<?php
}}}}
?>
					<tr class="ReportDetailsEvenDataRow">
                        <td align="right" colspan="2" class="ReportTableHeaderCell"> Total Cantidad: <?php echo($acumcant);?></td>
						<td align="right" colspan="4" class="ReportTableHeaderCell"> Total Costo (Bs.F): <?php echo($acumcost);?></td>

						</tr> 
</table></label></td>
	</tr></table></form>


</body>
</html>