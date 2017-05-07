<?php
session_start();
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
<h2><h2 class="Estilo1">Rotacion de Producto</h2>
<hr/>
<div align="right">
<p>
  <style type="text/css">
</style>
  <a href='pdf_rota.php'><IMG SRC="../../images/guardar1.jpg" onClick="pdf_rota.php"></a><br>
  <h4 align="rigth"> 
  Reporte del  
  <? $atras3= date("d-m-Y", mktime(0,0,0,date("m")-(12),date("d"),date("Y")));echo($atras3);?>  
  al <?echo($fecha_actual);?></p>
<p>
<table width="600" border="0" align="center" >
   <tr valign="top">
    <td>
    <div id="ReportDetails">
    <table width="600" border="1" align="center">
    <tr>
        <th width="60" class="ReportTableHeaderCell" rowspan="2" scope="col"><div align="center">Ref.</div></th>
        <th width="104" class="ReportTableHeaderCell" rowspan="2" scope="col"><div align="center">Nombre</div></th>
        <th class="ReportTableHeaderCell" colspan="12" scope="col"><div align="center">Meses</div></th>
      </tr>
      <tr>
        <th width="30" class="ReportTableHeaderCell" scope="col"><?echo(ene);?></th>
        <th width="30" class="ReportTableHeaderCell" scope="col"><?echo(feb);?></th>
        <th width="30" class="ReportTableHeaderCell" scope="col"><?echo(mar);?></th>
        <th width="30" class="ReportTableHeaderCell" scope="col"><?echo(abr);?></th>
        <th width="30" class="ReportTableHeaderCell" scope="col"><?echo(may);?></th>
        <th width="30" class="ReportTableHeaderCell" scope="col"><?echo(jun);?></th>
        <th width="30" class="ReportTableHeaderCell" scope="col"><?echo(jul);?></th>
        <th width="30" class="ReportTableHeaderCell" scope="col"><?echo(ago);?></th>
        <th width="30" class="ReportTableHeaderCell" scope="col"><?echo(sep);?></th>
        <th width="30" class="ReportTableHeaderCell" scope="col"><?echo(oct);?></th>
        <th width="30" class="ReportTableHeaderCell" scope="col"><?echo(nov);?></th>
        <th width="30" class="ReportTableHeaderCell" scope="col"><?echo(dic);?></th>
</tr>
    <div align="center"></div>

    <div align="center"></div>

<?php 
for($i=1; $i<=12; $i++){
$atras= date("d-m-Y", mktime(0,0,0,date("m")-$i,date("d"),date("Y")));
$atras2=  date("d-m-Y", mktime(0,0,0,date("m")-($i+1),date("d"),date("Y")));

$final2= pg_query ("(SELECT items.id_items as ref, items.nombre as nom, inventario.cantidad as cant, mercancia.fecha_entrada as fech FROM items, inventario, mercancia WHERE ((items.id_items = inventario.id_items) and (items.id_items = mercancia.id_items) and ((mercancia.fecha_entrada >= '$atras2') and (mercancia.fecha_entrada <= '$atras'))))order by items.id_items");
$cant_ent= pg_query ("select (count(mercancia.id_items)) as cantmer from mercancia group by mercancia.id_items, mercancia.fecha_entrada having ((mercancia.fecha_entrada >='$atras2')and (mercancia.fecha_entrada<='$atras')and (mercancia.id_items=mercancia.id_items))");
if(pg_num_rows($final2)!=0){?>
 
      <?php 
			
				
			while($datos=pg_fetch_array($final2)){
				    while($canti=pg_fetch_array($cant_ent)){
						?>	
      <tr class="ReportDetailsEvenDataRow">
        <td class="ReportTableValueCell"><?php echo($datos['ref']);?>&nbsp;</td>
        <td class="ReportTableValueCell"><?php echo($datos['nom']);?>&nbsp;</td>
        <td class="ReportTableValueCell"><?php $extra = substr($datos['fech'],5,2); if($extra=='01'){echo($canti['cantmer']);$can[1]= $canti['cantmer'];}?>&nbsp;</td>
        <td class="ReportTableValueCell"><?php $extra = substr($datos['fech'],5,2); if($extra=='02'){echo($canti['cantmer']);$can[2]= $canti['cantmer'];}?>&nbsp;</td>
        <td class="ReportTableValueCell"><?php $extra = substr($datos['fech'],5,2); if($extra=='03'){echo($canti['cantmer']); $can[3]= $canti['cantmer'];}?>&nbsp;</td>
        <td class="ReportTableValueCell"><?php $extra = substr($datos['fech'],5,2); if($extra=='04'){echo($canti['cantmer']);$can[4]= $canti['cantmer'];}?>&nbsp;</td>
        <td class="ReportTableValueCell"><?php $extra = substr($datos['fech'],5,2); if($extra=='05'){echo($canti['cantmer']);$can[5]= $canti['cantmer'];}?>&nbsp;</td>
        <td class="ReportTableValueCell"><?php $extra = substr($datos['fech'],5,2); if($extra=='06'){echo($canti['cantmer']);$can[6]= $canti['cantmer'];}?>&nbsp;</td>
        <td class="ReportTableValueCell"><?php $extra = substr($datos['fech'],5,2); if($extra=='07'){echo($canti['cantmer']);$can[7]= $canti['cantmer'];}?>&nbsp;</td>
        <td class="ReportTableValueCell"><?php $extra = substr($datos['fech'],5,2); if($extra=='08'){echo($canti['cantmer']);$can[8]= $canti['cantmer'];}?>&nbsp;</td>
        <td class="ReportTableValueCell"><?php $extra = substr($datos['fech'],5,2); if($extra=='09'){echo($canti['cantmer']);$can[9]= $canti['cantmer'];}?>&nbsp;</td>
        <td class="ReportTableValueCell"><?php $extra = substr($datos['fech'],5,2); if($extra=='10'){echo($canti['cantmer']);$can[10]= $canti['cantmer'];}?>&nbsp;</td>
        <td class="ReportTableValueCell"><?php $extra = substr($datos['fech'],5,2); if($extra=='11'){echo($canti['cantmer']);$can[11]= $canti['cantmer'];}?>&nbsp;</td>
        <td class="ReportTableValueCell"><?php $extra = substr($datos['fech'],5,2); if($extra=='12'){echo($canti['cantmer']);$can[12]= $canti['cantmer'];}?>&nbsp;</td>
       
      </tr>
	  <?//for($t=1;$t<=12;$t++) {$can[$t]=0;}
	 
}}}}
?> <div align="center"></table></div></label></td>
	</tr></table><br>
<?
$total2= pg_query("select (count(mercancia.id_items)) as total, items.nombre as nomb, items.id_items as cod, inventario.cantidad as cant from items, mercancia, inventario group by  mercancia.id_items, items.nombre, inventario.cantidad, items.id_items, inventario.id_items having mercancia.id_items=items.id_items and mercancia.id_items=inventario.id_items");

?>	
   <table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="ReportDetails">
   <tr valign="top">
    <td>
    <div id="ReportDetails">
    <table width="600" border="1" align="center">
      <tr>
        <th width="58" height="34" class="ReportTableHeaderCell" scope="col"><div align="center">Ref.</div></th>
        <th width="169"class="ReportTableHeaderCell" scope="col"><div align="center">Nombre</div></th>
        <th width="74" class="ReportTableHeaderCell" scope="col"><div align="center">Total</div></th>
        <th width="103"class="ReportTableHeaderCell" scope="col"><div align="center">Promedio</div></th>
        <th width="134"class="ReportTableHeaderCell" scope="col"><div align="center">Stock Actual </div></th>
        
      </tr>
	<!--  <div align="center"></div>
	  <div align="center"></div>-->
	  
	  
  <?php if(pg_num_rows($total2)!=0){  
		while($total3=pg_fetch_array($total2)){
			?>
  <tr class="ReportDetailsEvenDataRow">
        <td height="29" class="ReportTableValueCell"><div align="center"><?php echo($total3['cod']);?>&nbsp;</div></td>
        <td class="ReportTableValueCell"><div align="center"><?php echo($total3['nomb']);?>&nbsp;</div></td>
		<td class="ReportTableValueCell"><div align="center"><?php echo($total3['total']);?>&nbsp;</div></td>
        <td class="ReportTableValueCell"><div align="center">
          <?php $promed= $total3['total']/12; $float_redondeado=round($promed * 100) / 100; echo($float_redondeado);?>
          &nbsp;</div></td>	 
		<td class="ReportTableValueCell"><div align="center"><?php echo($total3['cant']);?>&nbsp;</div></td>
      </tr>
	  <?
	 
}}
?>
    </table></div></label></td>
</tr></table></form> 
</body>
</html>
