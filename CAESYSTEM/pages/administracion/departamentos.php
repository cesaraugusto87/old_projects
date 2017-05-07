<?php include('../../permisos.php');?>
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
	if(n==1) alert("El departamento fué eliminado");
	else alert("El departamento no fué eliminado");
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
<h2><h2 class="Estilo1">Administrar Departamentos</h2>
<hr/>
<br>
<br>
<form id="horario" name="horario" method="post">
  	<div align="center"><strong>Id Departamento</strong>
	  <td width="50"><input type="text" name="id_departamento"/></td>
	<input type="image" src="../../images/Search.ico" name="Buscar" onClick="Clear_Frame()" value="Buscar"/>
    </div>
<br><br>
</form>
<table width="578" border="0" align="center" cellpadding="0" cellspacing="0" class="ReportDetails">
<tr valign="top">
<td width="623">
    <div id="ReportDetails">
    	<table width="578" border="1" align="center">
			<tr>
				<td width="104" align="center" class="ReportTableHeaderCell">id_departamento</td>
                <td width="129" align="center" class="ReportTableHeaderCell">nombre</td>
                 <td width="129" align="center" class="ReportTableHeaderCell">descripcion</td>
                   <td colspan="2" align="center" class="ReportTableHeaderCell">Accion</td>
                
           	</tr>
<?php
$consulta= pg_query("select * from departamento");

if($_POST['Buscar']){
		$id_departamento= $_POST['id_departamento'];
		if($id_departamento || $consulta){
			
			if($id_departamento){
				$consulta= pg_query("select * from departamento where id_departamento='$id_departamento'");
			}else if($nombre){
				$consulta= pg_query("select * from departamento where id_departamento='$id_departamento'");
			}
		}
}
			if(pg_num_rows($consulta)!=0){
				while($datos=pg_fetch_array($consulta)){
?>
						<tr class="ReportDetailsEvenDataRow">
							<td  class="ReportTableValueCell"><?php printf($datos['id_departamento']);?></td>
                			<td  class="ReportTableValueCell"><?php printf($datos['nombre']);?></td>
                    		<td  class="ReportTableValueCell"><?php printf($datos['descripcion']);?></td>
                    	
                            <td width="91" align="center" class="ReportTableHeaderCell">
                             <form id="modificar" name="modificar" method="post" action="moddepartamento.php">
                                <input type="hidden" name="id_departamento" value="<?php printf($datos['id_departamento']);?>"/>
                               <input type="image" src="../../images/modificar.png" name="Modificar" value="M"/>
                             </form>
                            
                            </td>
                            <td width="91" align="center" class="ReportTableHeaderCell"><form id="eliminar" name="eliminar" method="post">
                            	<input type="hidden" name="id_departamento" value="<?php printf($datos['id_departamento']);?>"/>
                              <input type="image" src="../../images/eliminar.JPG" name="Eliminar" value="E"/>
                            </form>&nbsp;</td>
                		</tr>
<?php
				}
		    }
			
	if($_POST['Eliminar']){
		$id= $_POST['id_departamento'];
		if($id){
		$elim= pg_query("select * from empleados where id_departamento='$id'");
				if(pg_num_rows($elim)==0){
					$eliminado=pg_query("delete from departamento where id_departamento='$id'");
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
<form id="nuevo_departamento" name="nuevo_departamento" method="post" action="adddepartamento.php">
	<div align="center">
    	<input type="image" src="../../images/AgregarIcon.png" name="Nuevo" onclick="Clear_Frame()" value="N"/>
  	</div>
</form>
</body>
</html>