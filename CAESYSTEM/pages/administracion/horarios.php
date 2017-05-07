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
	if(n==1) alert("El horario fué eliminado");
	else alert("El horario no fué eliminado");
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
<h2><h2 class="Estilo1">Administrar Horarios</h2>
<hr/>
<br>
<br>
<form id="horario" name="horario" method="post">
  	<div align="center"><strong>Id Horario</strong>
	  <td width="50"><input type="text" name="id_horarios"/></td>
	<input type="image" src="../../images/Search.ico" name="Buscar" onClick="Clear_Frame()" value="Buscar"/>
    </div>
<br><br>
</form>
<table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="ReportDetails">
<tr valign="top">
<td>
    <div id="ReportDetails">
    	<table width="600" border="1" align="center">
			<tr>
				<td width="104" align="center" class="ReportTableHeaderCell">Id</td>
                <td width="129" align="center" class="ReportTableHeaderCell">Hora Inicio</td>
                 <td width="129" align="center" class="ReportTableHeaderCell">Hora Final</td>
				  <td colspan="2" align="center" class="ReportTableHeaderCell">Accion</td>
           	</tr>
<?php
$consulta= pg_query("select * from horarios");

if($_POST['Buscar']){
		$id_horarios= $_POST['id_horarios'];
		if($id_horarios || $consulta){
			
			if($id_horarios){
				$consulta= pg_query("select * from horarios where id_horarios='$id_horarios'");
			}else if($nombre){
				$consulta= pg_query("select * from horarios where id_horarios='$id_horarios'");
			}
		}
}
			if(pg_num_rows($consulta)!=0){
				while($datos=pg_fetch_array($consulta)){
?>
						<tr class="ReportDetailsEvenDataRow">
							<td  class="ReportTableValueCell"><?php printf($datos['id_horarios']);?></td>
                			<td  class="ReportTableValueCell"><?php printf($datos['hora_inicio']);?></td>
                    		<td  class="ReportTableValueCell"><?php printf($datos['hora_final']);?></td>
                    	
                            <td width="91" align="center" class="ReportTableHeaderCell">
                             <form id="modificar" name="modificar" method="post" action="modhorario.php">
                                <input type="hidden" name="id_horarios" value="<?php printf($datos['id_horarios']);?>"/>
                               <input type="image" src="../../images/modificar.png" name="Modificar" value="M"/>
                             </form>
                  
                            </td>
                            <td width="91" align="center" class="ReportTableHeaderCell"><form id="eliminar" name="eliminar" method="post">
                            	<input type="hidden" name="id_horarios" value="<?php printf($datos['id_horarios']);?>"/>
                              <input type="image" src="../../images/eliminar.JPG" name="Eliminar" value="E"/>
                            </form>&nbsp;</td>
                		</tr>
<?php
				}
		    }
			
	if($_POST['Eliminar']){
		$id= $_POST['id_horarios'];
		if($id){
			$elim= pg_query("select * from empleados where id_horarios='$id'");
				if(pg_num_rows($elim)==0){
					$eliminado=pg_query("delete from horarios where id_horarios='$id'");
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
<form id="nuevo_horario" name="nuevo_horario" method="post" action="addhorarios.php">
	<div align="center">
    	<input type="image" src="../../images/AgregarIcon.png" name="Nuevo" onclick="Clear_Frame()" value="N"/>
  	</div>
</form>
</body>
</html>