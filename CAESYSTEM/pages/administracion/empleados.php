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
	if(n==1) alert("El empleado fué eliminado");
	else alert("El empleado no fué eliminado");
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
<h2 class="Estilo1"> Administrar Empleados</h2>
<hr/>
<form id="empleado" name="empleado" method="post">
<p>&nbsp;</p>
<table width="364" border="0" align="center" cellpadding="0" cellspacing="0" class="ReportDetails">
  <tr valign="top">
 	<tr> 
      <td>
   <div id="ReportDetails">
    <table width="349" border="1" align="center">
  <tr>
		<td class="ReportTableHeaderCell"> Ficha:</td>
	  <td class="ReportDetailsEvenDataRow"><input type="text" border="5" name="ficha"/></td>
	</tr>
	<tr>
		<td class="ReportTableHeaderCell" >C.I:</td>
			<td class="ReportDetailsOddDataRow" ><input type="text" border="5" name="ci"/></td>
	<tr>
	<td class="ReportTableHeaderCell">
	Cargo:   </td>
    <td class="ReportDetailsEvenDataRow">
    <select name="cargo">
    <option value="null">-</option>
		<?php
			$cargos=pg_query("select * from cargo");
				if(pg_num_rows($cargos)!=0){
                   	while($car=pg_fetch_array($cargos)){
					?>
                         <option value="<?php echo($car['id_cargo']);?>"><?php echo($car['descripcion']);?></option>
                    <?php
					}
				}
					?>
	</select>    </td>
	</tr>
	<tr>
	<td class="ReportTableHeaderCell">
	Departamento:    </td>
    <td class="ReportDetailsOddDataRow">
    <select name="departamento">
    	<option value="null">-</option>
		<?php
			$departamentos=pg_query("select * from departamento");
				if(pg_num_rows($departamentos)!=0){
                   	while($dep=pg_fetch_array($departamentos)){
					?>
                         <option value="<?php echo($dep['id_departamento']);?>"><?php echo($dep['nombre']);?></option>
                    <?php
					}
				}
					?>
	</select>    </td>
	</tr>
 <tr>
 <td colspan="2" class="ReportDetailsEvenDataRow">
   <div align="center">
     <input type="submit" name="Buscar" onClick="Clear_Frame()" value="Buscar"/> 
   </div></td>
 </tr>
</table>
       </div>
    </td>
  </tr>
</table>
</form>

<table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="ReportDetails">
  <tr valign="top">
  <tr> 
      <td>
   <div id="ReportDetails">
<table width="600" border="1" align="center">
			<tr>
				 <td align="center" class="ReportTableHeaderCell">Ficha</td>
                 <td align="center" class="ReportTableHeaderCell">C.I</td>
                 <td align="center" class="ReportTableHeaderCell">Nombres</td>
                 <td align="center" class="ReportTableHeaderCell">Apellidos</td>
                 <td align="center" class="ReportTableHeaderCell">Cargo</td>
                 <td align="center" class="ReportTableHeaderCell">Nivel</td>
                 <td align="center" class="ReportTableHeaderCell">Departamento</td>
                 <td align="center" class="ReportTableHeaderCell">Estado</td>
                        
        	</tr>
<?php
$consulta= pg_query("select empleados.ficha, empleados.cedula, departamento.nombre as departamento, cargo.descripcion as cargo, nivel.tipo as nivel, personal.nombres, personal.apellidos
from empleados, departamento, cargo, nivel, personal where empleados.cedula= personal.cedula and empleados.id_cargo= cargo.id_cargo and
empleados.id_departamento= departamento.id_departamento and empleados.id_nivel=nivel.id_nivel");

if($_POST['Buscar']){
		$ficha= $_POST['ficha'];
		$ci=$_POST['ci'];
		$cargo= $_POST['cargo'];
		$departamento=$_POST['departamento'];
		
		if($ficha || $ci || $cargo!='null' || $departamento!='null'){
			if($ficha){
				$consulta= pg_query("select empleados.ficha, empleados.cedula, departamento.nombre as departamento, cargo.descripcion as cargo,nivel.tipo as nivel, personal.nombres, personal.apellidos
from empleados, departamento, cargo, nivel, personal where empleados.cedula= personal.cedula and empleados.id_cargo= cargo.id_cargo and
empleados.id_departamento= departamento.id_departamento and empleados.ficha= '$ficha' and empleados.id_nivel=nivel.id_nivel");
			}
			if($ci){
				$consulta= pg_query("select * from empleados where ci='$ci'");
			}
			if($cargo!='null'){
				$consulta= pg_query("select empleados.ficha, empleados.cedula, departamento.nombre as departamento, cargo.descripcion as cargo,nivel.tipo as nivel, personal.nombres, personal.apellidos
from empleados, departamento, cargo, nivel, personal where empleados.cedula= personal.cedula and empleados.id_cargo= cargo.id_cargo and
empleados.id_departamento= departamento.id_departamento and empleados.id_nivel=nivel.id_nivel and empleados.id_cargo='$cargo'");
			}
			if($departamento!='null'){
				$consulta= pg_query("select empleados.ficha, empleados.cedula, departamento.nombre as departamento, cargo.descripcion as cargo,nivel.tipo as nivel, personal.nombres, personal.apellidos
from empleados, departamento, cargo, nivel, personal where empleados.cedula= personal.cedula and empleados.id_cargo= cargo.id_cargo and
empleados.id_departamento= departamento.id_departamento and empleados.id_nivel=nivel.id_nivel and empleados.id_departamento='$departamento'");
			}
			if($cargo!='null' && $departamento!='null'){
				$consulta= pg_query("select empleados.ficha, empleados.cedula, departamento.nombre as departamento, cargo.descripcion as cargo,nivel.tipo as nivel, personal.nombres, personal.apellidos
from empleados, departamento, cargo, nivel, personal where empleados.cedula= personal.cedula and empleados.id_cargo= cargo.id_cargo and
empleados.id_departamento= departamento.id_departamento and empleados.id_nivel=nivel.id_nivel and empleados.id_departamento='$departamento' and empleados.id_cargo='$cargo'");	
			}
		}
}
			if(pg_num_rows($consulta)!=0){

                    while($datos=pg_fetch_array($consulta)){
				?>
						<tr class="ReportDetailsEvenDataRow">
						  <td ><div align="center"><?php printf($datos['ficha']);?></div></td>
                			<td > <div align="center"><?php printf($datos['cedula']);?></div></td>
                    		<td > <div align="center"><?php printf($datos['nombres']);?></div></td>
                    		<td > <div align="center"><?php printf($datos['apellidos']);?></div></td>
                    		<td > <div align="center"><?php printf($datos['cargo']);?></div></td>
                    		<td > <div align="center"><?php printf($datos['nivel']);?></div></td>
                			<td > <div align="center"><?php printf($datos['departamento']);?></div></td>
                            <td align="center" class="ReportTableHeaderCell">
                            <form id="modificar" name="modificar" method="post" action="modempleado.php">
                            	<input type="hidden" name="ficha" value="<?php printf($datos['ficha']);?>"/>
                            	<input type="submit" name="Modificar" onClick="Clear_Frame()" value="M"/>
                            </form>
                            <form id="eliminar" name="eliminar" method="post">
                            	<input type="hidden" name="ficha" value="<?php printf($datos['ficha']);?>"/>
                            	<input type="submit" name="Eliminar" value="E"/>
                            </form>                            </td>
                		</tr>
<?php
					}
			}

	if($_POST['Eliminar']){
		$id= $_POST['ficha'];
		$cedula=pg_query("select cedula from empleados where ficha='$id'");
		$cedula=pg_fetch_array($cedula);
		$cedula= $cedula['cedula'];
		if($id){
			$eliminado=pg_query("delete from empleados where empleados.ficha='$id'");
			if(pg_affected_rows($eliminado)!= 0){
				$eliminado1=pg_query("delete from personal where personal.cedula='$cedula'");
				if(pg_affected_rows($eliminado1)!= 0){
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
}	

?>


		
</table>
       </div>
    </td>
  </tr>
</table>        </form>


<form id="nuevo_empleado" name="nuevo_empleado" method="post" action="addempleado.php">
	<div align="center">
    	<input type="image" src="../../images/AgregarIcon.png" name="Nuevo" onclick="Clear_Frame()" value="N"/>
  	</div>
</form>

</body>
</html>