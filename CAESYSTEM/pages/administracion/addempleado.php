<?php include('../../permisos.php');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Formulario modelo</title>
<link href="../../css/styles.css" rel="stylesheet"	type="text/css" />
<style type="text/css">
</style>
<script type="text/javascript">
function guardar(n){
	if(n==1) alert("El cliente fué guardado");
	else alert("El cliente no fué guardado");
	}
</script>
</head>
<?php include ("../../conexion/conexion.php");
$link= Conectarse();
?>
<body>
<form id="formDivisiones" name="formDivisiones" method="post" action="empleados.php">
<h2 class="Estilo1">Agregar Empleado</h2>
<hr/>
<table width="341" height="300" border="0" align="center" cellpadding="0" cellspacing="0" class="ReportDetails">
   <tr valign="top">
    <td>
    <div id="ReportDetails">
      <table width="341" border="1" align="center">
        <tr>
          <td width="167" class="ReportTableHeaderCell">Ficha: </td>
          <td class="ReportDetailsOddDataRow" align="center"><input type="text" name="ficha" value="<?php echo($empleado['ficha']);?>"/></td>
        </tr>
        <tr>
          <td class="ReportTableHeaderCell">Cédula: </td>
          <td class="ReportDetailsOddDataRow" align="center"><input type="text" name="cedula" value="<?php echo($empleado['cedula']);?>"/></td>
        </tr>
        <tr>
          <td class="ReportTableHeaderCell">Nombres: </td>
          <td class="ReportDetailsOddDataRow" align="center"><input type="text" name="nombres" value="<?php echo($personal['nombres']);?>"/></td>
        </tr>
        <tr>
          <td class="ReportTableHeaderCell">Apellidos: </td>
          <td class="ReportDetailsOddDataRow" align="center"><input type="text" name="apellidos" value="<?php echo($personal['apellidos']);?>"/></td>
        </tr>
        <tr>
          <td class="ReportTableHeaderCell">Sexo: </td>
          <div align="center">
			  <td width="175" class="ReportDetailsEvenDataRow"align="center">
                  <select name="sexo">
                  	<option value="-"> -</option>
                  	<option value="Femenino"> Femenino</option>
                    <option value="Masculino"> Masculino</option>
                  </select>
              </td></div>
        </tr>
        <tr>
          <td class="ReportTableHeaderCell">Direccion: </td>
          <td class="ReportDetailsOddDataRow" align="center"><input type="text" name="direccion" value="<?php echo($personal['direccion']);?>"/></td>
        </tr>
        <tr>
          <td class="ReportTableHeaderCell">Telefono: </td>
		<td class="ReportDetailsOddDataRow" align="center"><input type="text" name="tlf" value="<?php echo($personal['tlf']);?>"/></td>
        </tr>
        <tr>
          <td class="ReportTableHeaderCell">Departamento: </td>
          <div align="center">
			  <td width="175" class="ReportDetailsEvenDataRow"align="center">
                  <select name="departamento">
					<?php
						$dep=pg_query("select * from departamento");
						if(pg_num_rows($dep)!=0){
                   			while($datos=pg_fetch_array($dep)){
							?>
                            	<option value="<?php echo($datos['id_departamento']);?>"><?php echo($datos['nombre']);?></option>
                            <?php
							}
						}
					?>
				</select>
                </td></div>
        </tr>
        <tr>
          <td class="ReportTableHeaderCell">Cargos: </td>
          <div align="center">
			  <td width="175" class="ReportDetailsEvenDataRow"align="center">
                  <select name="cargos">
					<?php
						$cargo=pg_query("select * from cargo");
						if(pg_num_rows($cargo)!=0){
                   			while($datos=pg_fetch_array($cargo)){
							?>
                            	<option value="<?php echo($datos['id_cargo']);?>"><?php echo($datos['descripcion']);?></option>
                            <?php
							}
						}
					?>
				</select>
                </td></div>
        </tr>
        <tr>
          <td class="ReportTableHeaderCell">Nivel: </td>
          <div align="center">
			  <td width="175" class="ReportDetailsEvenDataRow"align="center">
                  <select name="nivel">
					<?php
						$nivel=pg_query("select * from nivel");
						if(pg_num_rows($nivel)!=0){
                   			while($datos=pg_fetch_array($nivel)){
							?>
                            	<option value="<?php echo($datos['id_nivel']);?>"><?php echo($datos['descripcion'].'-'.$datos['tipo']);?></option>
                            <?php
							}
						}
					?>
				</select>
                </td></div>
        </tr>
        <tr>
          <td class="ReportTableHeaderCell">Horario: </td>
          <div align="center">
			  <td width="175" class="ReportDetailsEvenDataRow"align="center">
                  <select name="horarios">
					<?php
						$estados=pg_query("select * from horarios");
						if(pg_num_rows($estados)!=0){
                   			while($datos=pg_fetch_array($estados)){
							?>
                            	<option value="<?php echo($datos['id_horarios']);?>"><?php echo($datos['hora_inicio'].' - '.$datos['hora_final']);?></option>
                            <?php
							}
						}
					?>
				</select>
                </td></div>
				
	  <tr>
		<td colspan="2" class="ReportDetailsOddDataRow">
		<div align="center" class="ReportDetailsEvenDataRow">
		 <input type="submit" name="Guardar" id="Guardar" value="Guardar"/>
		</div></td>
	  </tr>
						
        </tr>
      </table>
	  </div>
	  </td>
  </tr>
</table>
</form>
<?php 
if ($_POST['Guardar']){
	$ficha= $_POST['ficha'];
	$cedula= $_POST['cedula'];
	$nombres= $_POST['nombres'];
	$apellidos= $_POST['apellidos'];
	$sexo= $_POST['sexo'];
	$direccion= $_POST['direccion'];
	$tlf= $_POST['tlf'];
	$departamento= $_POST['departamento'];
	$cargo= $_POST['cargos'];
	$nivel= $_POST['nivel'];
	$horario= $_POST['horarios'];
	$fecha=getdate();
	$fecha= $fecha['mday']."/".$fecha['mon']."/".$fecha['year'];
	
	if($ficha && $cedula && $nombres && $apellidos && $direccion && $tlf && $sexo && $cargo && $departamento && $nivel && $horario && $fecha){
		$consulta=pg_query("insert into personal(cedula, nombres, apellidos, sexo, direccion, tlf, condicion) values('$cedula', '$nombres', '$apellidos', '$sexo', '$direccion', '$tlf', 'Activo')");
		if(pg_affected_rows($consulta)!= 0){
			$estados=pg_query("select * from estado where id_estado='01'");
			if(pg_num_rows($estados)!=0){
				$consulta=pg_query("insert into empleados(ficha, cedula, id_departamento, id_cargo, id_nivel, fecha_inicio, id_horarios, id_estado) values('$ficha', '$cedula', '$departamento', '$cargo', '$nivel', '$fecha', '$horario', '01')");
				if(pg_affected_rows($consulta)!= 0){
					echo"<script>guardar(1)</script>";
				}
				else{
					echo"<script>guardar(0)</script>";
					$consulta=pg_query("delete from personal where cedula='$cedula'");
				}
			}
		}
		else{
			echo"<script>guardar(0)</script>";
		}	
	}
}


?>
</body>
</html>
