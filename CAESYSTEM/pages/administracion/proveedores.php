<?php
include('../../permisos.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Administracion del Sistema</title>
<link href="../../css/styles.css" rel="stylesheet"	type="text/css" />
<style type="text/css">
</style>
<script type="text/javascript">
function eliminar(n){
	if(n==1) alert("El proveedor fué eliminado");
	else alert("El proveedor no fué eliminado");
	}
</script>
</head>
<?php 
include('../../conexion/conexion.php');?>
<body onload="cargar()">
<?php 
$link = Conectarse();
$fecha_actual= date("d-m-Y");
?>

<form id="formDivisiones" name="formDivisiones" method="post">
<h2 class="Estilo1">Administrar Clientes</h2>
<hr/>
<br>
<br>
<form id="proveedor" name="proveedor" method="post">
  	<div align="center"><strong class="negrita12"> Rif </strong><td width="50"><input type="text" border="5" name="rif"/></td>
	<input type="image" src="../../images/Search.ico" name="Buscar" onClick="Clear_Frame()" value="Buscar"/>
    </div>
<br><br>
</form>
<table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="ReportDetails">
<tr valign="top">
<td width="741">
    <div id="ReportDetails">
    	<table width="600" border="1" align="center">
			<tr>
				<td align="center" class="ReportTableHeaderCell">Rif</td>
                <td align="center" class="ReportTableHeaderCell">Descrippcion</td>
                 <td align="center" class="ReportTableHeaderCell">Telefono</td>
                 <td align="center" class="ReportTableHeaderCell">Domicilio</td>
                 <td align="center" class="ReportTableHeaderCell">Tipo</td>
                 <td align="center" class="ReportTableHeaderCell">Estatus</td>
                 <td align="center" class="ReportTableHeaderCell">Accion</td>
                        
        	</tr>
<?php
$consulta= pg_query("select * from proveedores");

if($_POST['Buscar']){
		$rif= $_POST['rif'];
		if($rif || $consulta){
			
			if($rif){
				$consulta= pg_query("select * from clientes where rif='$rif'");
			}
		}
}
			if(pg_num_rows($consulta)!=0){

                    while($datos=pg_fetch_array($consulta)){
						$id_estado=$datos['id_estado'];
						$estado=pg_query("select * from estado where id_estado='$id_estado'");
						$estado=pg_fetch_array($estado);
				?>
						<tr class="ReportDetailsEvenDataRow">
							<td  class="ReportTableValueCell"><?php printf($datos['id_rif']);?></td>
                			<td  class="ReportTableValueCell"><?php printf($datos['descripcion']);?></td>
                    		<td  class="ReportTableValueCell"><?php printf($datos['tlf']);?></td>
                    		<td  class="ReportTableValueCell"><?php printf($datos['domicilio']);?></td>
                    		<td  class="ReportTableValueCell"><?php printf($datos['tipo']);?></td>
                			<td  class="ReportTableValueCell"><?php printf($estado['descripcion']);?></td>
                            <td align="center" class="ReportTableHeaderCell">
                            <form id="modificar" name="modificar" method="post" action="modproveedor.php">
                            	<input type="hidden" name="id_proveedor" value="<?php printf($datos['id_rif']);?>"/>
                            	<input type="image" src="../../images/modificar.png" name="Modificar" value="M"/>
                            </form>
                            <form id="eliminar" name="eliminar" method="post">
                            	<input type="hidden" name="id_proveedor" value="<?php printf($datos['id_rif']);?>"/>
                            	<input type="image" src="../../images/eliminar.JPG" name="Eliminar" value="E"/>
                            </form>
                            </td>
                		</tr>
<?php
					}
			}

	if($_POST['Eliminar']){
		$id= $_POST['id_proveedor'];
		if($id){
			$elim= pg_query("select * from orden_compra where id_proveedores='$id'");
			if(pg_num_rows($elim)==0){
				$eliminado=pg_query("delete from proveedores where id_rif='$id'");
				if(pg_affected_rows($eliminado)!= 0){
					echo"<script>eliminar(1)</script>";
				}
				else{
					echo"<script>eliminar(0)</script>";
				}
			}
			else{
				echo"<script>eliminar(0)</script>";
			}
		}
		else{
			echo"<script>eliminar(0)</script>";
		}
	}	

?>


	</table></div></td>
	</tr></table></form>

	
<form id="nuevo_proveedor" name="nuevo_proveedor" method="post" action="addproveedor.php">
	<div align="center">
    	<input type="image" src="../../images/AgregarIcon.png" name="Nuevo" onclick="Clear_Frame()" value="N"/>
  	</div>
</form>
	
</body>
</html>