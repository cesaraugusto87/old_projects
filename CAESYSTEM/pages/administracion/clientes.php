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
	if(n==1) alert("El cliente fué eliminado");
	else alert("El cliente no fué eliminado");
	}
</script>
</head>
<?php 
include('../../conexion/conexion.php');?>
<body>
<?php 
$link = Conectarse();
$fecha_actual= date("d-m-Y");
?>

<form id="formDivisiones" name="formDivisiones" method="post">
<h2 class="Estilo1">Administrar Clientes</h2>
<hr/>
<br>
<br>
<form id="cliente" name="cliente" method="post">
  	<div align="center"><strong class="negrita12"> Rif/C.I </strong><td width="50"><input type="text" name="rif"/></td>
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
				<td width="52" align="center" class="ReportTableHeaderCell">Rif/C.I</td>
                <td width="83" align="center" class="ReportTableHeaderCell">Nombres</td>
                 <td width="83" align="center" class="ReportTableHeaderCell">Apellidos</td>
                 <td width="40" align="center" class="ReportTableHeaderCell">Tipo</td>
                 <td width="60" align="center" class="ReportTableHeaderCell">Status</td>
                 <td width="78" align="center" class="ReportTableHeaderCell">Telefono</td>
                 <td width="86" align="center" class="ReportTableHeaderCell">Direccion</td>
                 <td colspan="2" align="center" class="ReportTableHeaderCell">Accion</td>
                        
        	</tr>
<?php
$consulta= pg_query("select * from clientes");

if($_POST['Buscar']){
		$rif= $_POST['rif'];
		if($rif || $consulta){
			
			if($rif){
				$consulta= pg_query("select * from clientes where rif='$rif'");
			}else if($nombre){
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
							<td  class="ReportTableValueCell"><?php printf($datos['rif']);?></td>
                			<td  class="ReportTableValueCell"><?php printf($datos['nombres']);?></td>
                    		<td  class="ReportTableValueCell"><?php printf($datos['apellidos']);?></td>
                    		<td  class="ReportTableValueCell"><?php printf($datos['tipo']);?></td>
                    		<td  class="ReportTableValueCell"><?php printf($estado['descripcion']);?></td>
                    		<td  class="ReportTableValueCell"><?php printf($datos['tlf']);?></td>
                			<td  class="ReportTableValueCell"><?php printf($datos['domicilio']);?></td>
							
                            <td width="66" align="center" class="ReportTableHeaderCell">
                             <form id="modificar" name="modificar" method="post" action="modcliente.php">
                                <input type="hidden" name="id_clientes" value="<?php printf($datos['id_clientes']);?>"/>
                                <input type="image" src="../../images/modificar.png" name="Modificar" value="M"/>
                             </form>
                            
                            </td>
                            <td width="91" align="center" class="ReportTableHeaderCell"><form id="eliminar" name="eliminar" method="post">
                            	<input type="hidden" name="id_clientes" value="<?php printf($datos['id_clientes']);?>"/>
                              <input type="image" src="../../images/eliminar.JPG" name="Eliminar" value="E"/>
                          </form>&nbsp;</td>
                		</tr>
<?php
					}
			}

	if($_POST['Eliminar']){
		$id= $_POST['id_clientes'];
		if($id){
			$elim= pg_query("select * from facturas where id_clientes='$id'");
			if(pg_num_rows($elim)==0){
				$elim= pg_query("select * from presupuestos where id_clientes='$id'");
				if(pg_num_rows($elim)==0){
					$eliminado=pg_query("delete from clientes where id_clientes='$id'");
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
		else{
			echo"<script>eliminar(0)</script>";
		}
	}	

?>
</table></div></td>
	</tr></table></form>
<form id="nuevo_cliente" name="nuevo_cliente" method="post" action="addcliente.php">
	<div align="center">
    	<input type="image" src="../../images/AgregarIcon.png" name="Nuevo" onclick="Clear_Frame()" value="N"/>
  	</div>
</form>
</body>
</html>