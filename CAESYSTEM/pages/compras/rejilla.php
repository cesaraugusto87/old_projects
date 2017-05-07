<?php
session_start();
?>
<?php
require ("../../conexion/conexion.php");
include ("fechas.php");

$id_proveedores=$_GET["id_proveedores"];

$id_orden=$_GET["id_orden"];
$estatus=$_GET["cboEstatus"];
$fechainicio=$_GET["fechainicio"];
if ($fechainicio<>"") { $fechainicio=explota($fechainicio); }
$fechafin=$_GET["fechafin"];
if ($fechafin<>"") { $fechafin=explota($fechafin); }


Conectarse();

if ($estatus<>0 and $id_proveedores==NULL and $id_orden==NULL and $fechainicio==NULL and $fechafin==NULL) { 

$query_busqueda="SELECT orden_compra.id_orden,proveedores.id_rif,proveedores.descripcion,orden_compra.fecha_pedido,orden_compra.fecha_entrega,orden_impuesto.id_impuesto,orden_compra.id_estado,orden_impuesto.monto FROM orden_compra,proveedores,orden_impuesto 
WHERE orden_compra.id_estado= '$estatus'
AND orden_impuesto.id_impuesto=orden_compra.id_impuesto 
AND orden_compra.id_proveedores=proveedores.id_rif
ORDER BY orden_compra.id_orden ASC;";
$rs_busqueda=pg_query($query_busqueda);
$filas=pg_num_rows($rs_busqueda);
} else 
if ($estatus==0 and $id_proveedores==NULL and $id_orden==NULL and $fechainicio==NULL and $fechafin==NULL)
{ 

$query_busqueda="SELECT orden_compra.id_orden,proveedores.id_rif,proveedores.descripcion,orden_compra.fecha_pedido,orden_compra.fecha_entrega,orden_impuesto.id_impuesto,orden_compra.id_estado,orden_impuesto.monto 
FROM orden_compra,proveedores,orden_impuesto WHERE orden_impuesto.id_impuesto=orden_compra.id_impuesto AND orden_compra.id_proveedores=proveedores.id_rif ORDER BY orden_compra.id_orden ASC;";
$rs_busqueda=pg_query($query_busqueda);
$filas=pg_num_rows($rs_busqueda);
} else
	if ($estatus<>0 and $id_proveedores<>NULL and $id_orden==NULL and $fechainicio==NULL and $fechafin==NULL) { 
// busqueda por proveedor y compara el estatus de las ordenes si quiere solo las sin facturar o no facturadas
$query_busqueda="SELECT orden_compra.id_orden,proveedores.id_rif,proveedores.descripcion,orden_compra.fecha_pedido,orden_compra.fecha_entrega,orden_impuesto.id_impuesto,orden_compra.id_estado,orden_impuesto.monto 

FROM orden_compra,proveedores,orden_impuesto 

WHERE orden_compra.id_estado= '$estatus' AND orden_impuesto.id_impuesto=orden_compra.id_impuesto AND orden_compra.id_proveedores= '$id_proveedores' AND proveedores.id_rif='$id_proveedores' ORDER BY orden_compra.id_orden ASC;";
$rs_busqueda=pg_query($query_busqueda);
$filas=pg_num_rows($rs_busqueda);
} else
	if ($estatus==0 and $id_proveedores<>NULL and $id_orden==NULL and $fechainicio==NULL and $fechafin==NULL)
{ 
// busqueda por proveedor y todas las ordenes de ese proveedor
$query_busqueda="SELECT orden_compra.id_orden,proveedores.id_rif,proveedores.descripcion,orden_compra.fecha_pedido,orden_compra.fecha_entrega,orden_impuesto.id_impuesto,orden_compra.id_estado,orden_impuesto.monto 

FROM orden_compra,proveedores,orden_impuesto 

WHERE  orden_impuesto.id_impuesto=orden_compra.id_impuesto AND orden_compra.id_proveedores= '$id_proveedores' AND proveedores.id_rif='$id_proveedores' ORDER BY orden_compra.id_orden ASC;";


$rs_busqueda=pg_query($query_busqueda);
$filas=pg_num_rows($rs_busqueda);
} else
	if ($estatus==0 and $id_proveedores<>NULL and $id_orden<>NULL and $fechainicio==NULL and $fechafin==NULL)
{ 
// busqueda por proveedor y numero de orden
$query_busqueda="SELECT orden_compra.id_orden,proveedores.id_rif,proveedores.descripcion,orden_compra.fecha_pedido,orden_compra.fecha_entrega,orden_impuesto.id_impuesto,
orden_compra.id_estado,orden_impuesto.monto 

FROM orden_compra,proveedores,orden_impuesto 

WHERE  orden_impuesto.id_impuesto=orden_compra.id_impuesto 
AND orden_compra.id_proveedores= '$id_proveedores' 
AND proveedores.id_rif='$id_proveedores' 
AND orden_compra.id_orden='$id_orden' 
ORDER BY orden_compra.id_orden ASC;";
$rs_busqueda=pg_query($query_busqueda);
$filas=pg_num_rows($rs_busqueda);
} else
	if ($estatus==0 and $id_proveedores<>NULL and $id_orden==NULL and $fechainicio<>NULL and $fechafin==NULL)
{ 
//todos busqueda por proveedor y fecha dada
$query_busqueda="SELECT orden_compra.id_orden,proveedores.id_rif,proveedores.descripcion,orden_compra.fecha_pedido,orden_compra.fecha_entrega,orden_impuesto.id_impuesto,orden_compra.id_estado,orden_impuesto.monto 

FROM orden_compra,proveedores,orden_impuesto 

WHERE  orden_impuesto.id_impuesto=orden_compra.id_impuesto 
AND orden_compra.id_proveedores= '$id_proveedores' 
AND proveedores.id_rif='$id_proveedores'  
AND orden_compra.fecha_pedido='$fechainicio' 
ORDER BY orden_compra.id_orden ASC;";


$rs_busqueda=pg_query($query_busqueda);
$filas=pg_num_rows($rs_busqueda);
} else
	if ($estatus<>0 and $id_proveedores<>NULL and $id_orden==NULL and $fechainicio<>NULL and $fechafin==NULL)
{ 
//segun status busqueda por proveedor y fecha dada
$query_busqueda="SELECT orden_compra.id_orden,proveedores.id_rif,proveedores.descripcion,orden_compra.fecha_pedido,orden_compra.fecha_entrega,orden_impuesto.id_impuesto,orden_compra.id_estado,orden_impuesto.monto 

FROM orden_compra,proveedores,orden_impuesto 
WHERE  orden_impuesto.id_impuesto=orden_compra.id_impuesto 
AND orden_compra.id_proveedores= '$id_proveedores' 
AND proveedores.id_rif='$id_proveedores'  
AND orden_compra.fecha_pedido='$fechainicio' 
AND orden_compra.id_estado= '$estatus'

ORDER BY orden_compra.id_orden ASC;";

$rs_busqueda=pg_query($query_busqueda);
$filas=pg_num_rows($rs_busqueda);
}else
	if ($estatus<>0 and $id_proveedores==NULL and $id_orden==NULL and $fechainicio<>NULL and $fechafin==NULL)
{ 
// todos segun status y fecha dada
$query_busqueda="SELECT orden_compra.id_orden,proveedores.id_rif,proveedores.descripcion,orden_compra.fecha_pedido,orden_compra.fecha_entrega,orden_impuesto.id_impuesto,orden_compra.id_estado,orden_impuesto.monto 

FROM orden_compra,proveedores,orden_impuesto 
WHERE  orden_impuesto.id_impuesto=orden_compra.id_impuesto 
AND orden_compra.id_proveedores=proveedores.id_rif
AND orden_compra.fecha_pedido='$fechainicio' 
AND orden_compra.id_estado= '$estatus'
ORDER BY orden_compra.id_orden ASC;";

$rs_busqueda=pg_query($query_busqueda);
$filas=pg_num_rows($rs_busqueda);
}else
	if ($estatus==0 and $id_proveedores==NULL and $id_orden==NULL and $fechainicio<>NULL and $fechafin==NULL)
{ 
//segun status y fecha dada
$query_busqueda="SELECT orden_compra.id_orden,proveedores.id_rif,proveedores.descripcion,orden_compra.fecha_pedido,orden_compra.fecha_entrega,orden_impuesto.id_impuesto,orden_compra.id_estado,orden_impuesto.monto 

FROM orden_compra,proveedores,orden_impuesto 
WHERE  orden_impuesto.id_impuesto=orden_compra.id_impuesto 
AND orden_compra.id_proveedores=proveedores.id_rif
AND orden_compra.fecha_pedido='$fechainicio' 
ORDER BY orden_compra.id_orden ASC;";



$rs_busqueda=pg_query($query_busqueda);
$filas=pg_num_rows($rs_busqueda);
}else
	if ($estatus==0 and $id_proveedores<>NULL and $id_orden==NULL and $fechainicio<>NULL and $fechafin<>NULL)
{ 
//todos busqueda por proveedor y fecha dada inicio y fecha fin
$query_busqueda="SELECT orden_compra.id_orden,proveedores.id_rif,proveedores.descripcion,orden_compra.fecha_pedido,orden_compra.fecha_entrega,orden_impuesto.id_impuesto,orden_compra.id_estado,orden_impuesto.monto 

FROM orden_compra,proveedores,orden_impuesto 
WHERE  orden_impuesto.id_impuesto=orden_compra.id_impuesto 
AND orden_compra.id_proveedores= '$id_proveedores' 
AND orden_compra.id_proveedores=proveedores.id_rif
AND orden_compra.fecha_pedido>='$fechainicio' 
AND orden_compra.fecha_entrega<='$fechafin'
ORDER BY orden_compra.id_orden ASC;";


$rs_busqueda=pg_query($query_busqueda);
$filas=pg_num_rows($rs_busqueda);
} else
	if ($estatus<>0 and $id_proveedores<>NULL and $id_orden==NULL and $fechainicio<>NULL and $fechafin<>NULL)
{ 
//segun status busqueda por proveedor y fecha dada inicio y fecha fin
$query_busqueda="SELECT orden_compra.id_orden,proveedores.id_rif,proveedores.descripcion,orden_compra.fecha_pedido,orden_compra.fecha_entrega,orden_impuesto.id_impuesto,orden_compra.id_estado,orden_impuesto.monto 

FROM orden_compra,proveedores,orden_impuesto 
WHERE  orden_impuesto.id_impuesto=orden_compra.id_impuesto 
AND orden_compra.id_proveedores= '$id_proveedores' 
AND orden_compra.id_proveedores=proveedores.id_rif
AND orden_compra.fecha_pedido>='$fechainicio' 
AND orden_compra.fecha_entrega<='$fechafin'
AND orden_compra.id_estado= '$estatus'
ORDER BY orden_compra.id_orden ASC;";


$rs_busqueda=pg_query($query_busqueda);
$filas=pg_num_rows($rs_busqueda);
} else
	if ($estatus==0 and $id_proveedores==NULL and $id_orden==NULL and $fechainicio<>NULL and $fechafin<>NULL)
{ 

// todos segun status busqueda fecha dada inicio y fecha fin 
$query_busqueda="SELECT orden_compra.id_orden,proveedores.id_rif,proveedores.descripcion,orden_compra.fecha_pedido,orden_compra.fecha_entrega,orden_impuesto.id_impuesto,orden_compra.id_estado,orden_impuesto.monto 

FROM orden_compra,proveedores,orden_impuesto 
WHERE  orden_impuesto.id_impuesto=orden_compra.id_impuesto 
AND orden_compra.id_proveedores=proveedores.id_rif
AND orden_compra.fecha_pedido>='$fechainicio' 
AND orden_compra.fecha_entrega<='$fechafin'
ORDER BY orden_compra.id_orden ASC;";


$rs_busqueda=pg_query($query_busqueda);
$filas=pg_num_rows($rs_busqueda);
} else
	if ($estatus<>0 and $id_proveedores==NULL and $id_orden==NULL and $fechainicio<>NULL and $fechafin<>NULL)
{ 

// segun status busqueda fecha dada inicio y fecha fin 
$query_busqueda="SELECT orden_compra.id_orden,proveedores.id_rif,proveedores.descripcion,orden_compra.fecha_pedido,orden_compra.fecha_entrega,orden_impuesto.id_impuesto,orden_compra.id_estado,orden_impuesto.monto 

FROM orden_compra,proveedores,orden_impuesto 
WHERE  orden_impuesto.id_impuesto=orden_compra.id_impuesto 
AND orden_compra.id_proveedores=proveedores.id_rif
AND orden_compra.fecha_pedido>='$fechainicio' 
AND orden_compra.fecha_entrega<='$fechafin'
AND orden_compra.id_estado= '$estatus'
ORDER BY orden_compra.id_orden ASC;";
$rs_busqueda=pg_query($query_busqueda);
$filas=pg_num_rows($rs_busqueda);
} 


?>
<link type="text/css" rel="stylesheet" href="../../css/dhtmlgoodies_calendar.css?random=20051112" media="screen" />
		<link href="../../css/styles.css" rel="stylesheet"	type="text/css" />
<script language="javascript">
		
		function ver_detalle(id_orden,id_proveedores) {
			location="rejilla2.php?id_orden=" + id_orden + "&id_proveedores=" + id_proveedores +"";
		}
		
		
		</script>

<html>

	<head>
		<title>Resultado de la Busqueda</title>
		
	</head>
	<body>	<p class="Estilo1">Relacion Ordenes de Compras </p>
    <hr />
	<table width="600"border="0" align="center" class="ReportDetails">
   <tr valign="top">
    <td>
	 <div id="ReportDetails">
	<table width="600" border="1" align="center" >
		
                <th class="ReportTableHeaderCell" width="4%"><div align="center"><b>Cod. Orden </b><strong> </strong></div></td>
                <th class="ReportTableHeaderCell"width="7%"><div align="center">
                  Cod. Proveedor
                </div></td>
                <th class="ReportTableHeaderCell" width="29%" ><div align="center"><b>Nombre Proveedor </b></div></th>
			    <th class="ReportTableHeaderCell" width="10%" ><div align="center"><b>Fecha Pedido  </b></div></th>
                <th class="ReportTableHeaderCell" width="10%" ><div align="center"><strong>Fecha de Entrega  </strong></div></th>
				<th class="ReportTableHeaderCell" width="7%" ><div align="center"><b>IVA</b></div></th>
				<th class="ReportTableHeaderCell" width="16%"><div align="center"><b>STATUS</b></div></th>
				<th class="ReportTableHeaderCell" width="17%"><div align="center"><b>Ver Detalle </b></div></th>
           

		
					<? if ($filas>0) { ?>
					
					
   <tr valign="top">
    <td>	
							
			 
            
			  <?php
			  $band=false;
			for ($i = 0; $i < pg_num_rows($rs_busqueda); $i++) {
				
				$id_ordenn=pg_fetch_result($rs_busqueda,$i,"id_orden");				
				$id_proveedores=pg_fetch_result($rs_busqueda,$i,"id_rif");
				$n_proveedor=pg_fetch_result($rs_busqueda,$i,"descripcion");
				$fecha_pedido=pg_fetch_result($rs_busqueda,$i,"fecha_pedido");
				$fecha_entrega=pg_fetch_result($rs_busqueda,$i,"fecha_entrega"); 
				$impuesto=pg_fetch_result($rs_busqueda,$i,"monto");
				$estatus=pg_fetch_result($rs_busqueda,$i,"id_estado");
				if($band){
								?>
        <tr class="ReportDetailsEvenDataRow"><?php } else {?>
	    <tr class="ReportDetailsOddDataRow"><?php }
		 $band=!$band;?>
		 
          <td width="6%"><div align="left"><?php echo $id_ordenn;?></div></td>
                <td width="10%" ><div align="left"><?php echo $id_proveedores;?></div></td>
				<td width="28%" ><div align="left"><?php echo $n_proveedor;?></div></td>
                <td width="9%"  ><div align="left"><?php echo $fecha_pedido;?></div></td>
                <td width="10%"  ><div align="left"><?php echo $fecha_entrega;?></div></td>
                <td width="6%" ><div align="left"><?php echo $impuesto;?>%</div></td>
                <td width="15%" ><div align="left"><?php echo $estatus;?></div></td>
				
<?php if($_SESSION["nivel"]==1) {?>

				<td width="16%" ><div align="center"><a href="#"><img src="img/ver.png" width="16" height="16" border="0" onClick="ver_detalle('<?php echo  pg_fetch_result($rs_busqueda,$i,"id_orden")?>',<?php echo pg_fetch_result($rs_busqueda,$i,"id_rif")?>)" ></a></div></td>
				<?php  } //fin si session?>
        </tr>
              <?php }  ?>
      </table></div>	</tr>
     </td>
	</tr></table>
			  <?php }  ?>		
	</body>
</html>
