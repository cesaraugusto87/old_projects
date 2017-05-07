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
	if(n==1) alert("El cliente fué modifficado");
	else if (n==0) alert("El cliente no fué modificado");
	else if (n==2) alert("Debe llenar todos los campos");
	}
</script>
</head>
<?php include ("../../conexion/conexion.php");
$link= Conectarse();
if ($_POST['Modificar']){
	$ficha= $_POST['ficha'];
	$empleado=pg_query("select * from empleados where ficha='$ficha'");
	$empleado= pg_fetch_array($empleado);
	$cedula=$empleado['cedula'];
	$personal=pg_query("select * from personal where cedula='$cedula'");
	$personal=pg_fetch_array($personal);
}
?>
<body>
<form id="formDivisiones" name="formDivisiones" method="post">
<h2 class="Estilo1">Modificar Empleado</h2>
<hr/>
<table width="341" height="300" border="0" align="center" cellpadding="0" cellspacing="0" class="ReportDetails">
   <tr valign="top">
    <td height="250">
    <div id="ReportDetails">
      <table width="341" height="195" border="1" align="center">
        <tr>
          <td width="167" class="ReportTableHeaderCell">Ficha: </td>
          <td width="164" class="ReportDetailsOddDataRow"align="center"><input type="text" name="ficha" readonly="readonly" value="<?php echo($empleado['ficha']);?>"/></td>
        </tr>
        <tr>
          <td class="ReportTableHeaderCell">Cédula: </td>
			<td width="164" class="ReportDetailsOddDataRow"align="center"><input type="text" name="cedula" readonly="readonly" value="<?php echo($empleado['cedula']);?>"/></td>
        </tr>
        <tr>
          <td class="ReportTableHeaderCell">Nombres: </td>
      <td width="164" class="ReportDetailsOddDataRow"align="center"><input type="text" name="nombres" value="<?php echo($personal['nombres']);?>"/></td>
        </tr>
        <tr>
          <td class="ReportTableHeaderCell">Apellidos: </td>
         <td width="164" class="ReportDetailsOddDataRow"align="center"><input type="text" name="apellidos" value="<?php echo($personal['apellidos']);?>"/></td>
        </tr>
        <tr>
          <td class="ReportTableHeaderCell">Sexo: </td>
          <div align="center">
			  <td width="175" class="ReportDetailsEvenDataRow"align="center">
                  <select name="sexo">
                  	<?php if($personal['sexo']=='Femenino'){?>
                  	<option value="Femenino"> Femenino</option>
                    <option value="Masculino"> Masculino</option>
                    <?php }else{ ?>
                    <option value="Masculino"> Masculino</option>
                    <option value="Femenino"> Femenino</option>
                    <?php } ?>
                  </select>
              </td></div>
        </tr>
        <tr>
          <td class="ReportTableHeaderCell">Direccion: </td>
          <td width="164" class="ReportDetailsOddDataRow"align="center"><input type="text" name="direccion" value="<?php echo($personal['direccion']);?>"/></td>
        </tr>
        <tr>
          <td class="ReportTableHeaderCell">Telefono: </td>
          <td width="164" class="ReportDetailsOddDataRow"align="center"><input type="text" name="tlf" value="<?php echo($personal['tlf']);?>"/></td>
        </tr>
        <tr>
          <td class="ReportTableHeaderCell">Departamento: </td>
          <div align="center">
			  <td width="175" class="ReportDetailsEvenDataRow"align="center">
                  <select name="departamento">
                  	<?php
						$departamento=$empleado['id_departamento'];
						$departamento=pg_query("select * from departamento where id_departamento='$departamento'");
						$departamento=pg_fetch_array($departamento);
					?>
                    	<option value="<?php echo($departamento['id_departamento']);?>"> <?php echo($departamento['nombre']);?> </option>
                    <?php
						$dep=pg_query("select * from departamento");
						if(pg_num_rows($dep)!=0){
                   			while($datos=pg_fetch_array($dep)){
								if($datos['id_departamento']!=$departamento['id_departamento']){
							?>
                            		<option value="<?php echo($datos['id_departamento']);?>"><?php echo($datos['nombre']);?></option>
                            <?php
								}
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
						$cargo=$empleado['id_cargo'];
						$cargo=pg_query("select * from cargo where id_cargo='$cargo'");
						$cargo=pg_fetch_array($cargo);
					?>
                    	<option value="<?php echo($cargo['id_cargo']);?>"> <?php echo($cargo['descripcion']);?> </option>
                    <?php
						$cargos=pg_query("select * from cargo");
						if(pg_num_rows($cargos)!=0){ 
                   			while($datos=pg_fetch_array($cargos)){
								if($datos['id_cargo']!=$cargo['id_cargo']){
							?>
                            		<option value="<?php echo($datos['id_cargo']);?>"><?php echo($datos['descripcion']);?></option>
                            <?php
								}
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
						$nivel=$empleado['id_nivel'];
						$nivel=pg_query("select * from nivel where id_nivel='$nivel'");
						$nivel=pg_fetch_array($nivel);
					?>
                    	<option value="<?php echo($nivel['id_nivel']);?>"> <?php echo($nivel['descripcion'].'-'.$nivel['tipo']);?> </option>
                    <?php
						$niveles=pg_query("select * from nivel'");
						if(pg_num_rows($niveles)!=0){
                   			while($datos=pg_fetch_array($niveles)){
								if($datos['id_nivel']!=$nivel['id_nivel']){
							?>
                            		<option value="<?php echo($datos['id_nivel']);?>"><?php echo($datos['descripcion'].'-'.$datos['tipo']);?></option>
                            <?php
								}
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
						$horario=$empleado['id_horarios'];
						$horario=pg_query("select * from horarios where id_horarios='$horario'");
						$horario=pg_fetch_array($horario);
					?>
                    	<option value="<?php echo($horario['id_horarios']);?>"><?php echo($horario['hora_inicio'].' - '.$horario['hora_final']);?> </option>
                    <?php
						$horarios=pg_query("select * from horarios");
						if(pg_num_rows($horarios)!=0){
                   			while($datos=pg_fetch_array($horarios)){
								if($datos['id_horarios']!=$horario['id_horarios']){
							?>
                            		<option value="<?php echo($datos['id_horarios']);?>"><?php echo($datos['hora_inicio'].' - '.$datos['hora_final']);?></option>
                            <?php
								}
							}
						}
					?>
				</select>
               </td></div>
        </tr>
		
		
		 <tr>
        <td colspan="2" class="ReportDetailsEvenDataRow">
          <div align="center">
            <input type="submit" name="Guardar" id="Guardar" value="Guardar"/>
            </div></td>
        </tr>
		
      </table>
	  </div>
	</td>
	</tr>
</table>
</form>
<?php 
if ($_POST['Guardar']){
	$cedula= $_POST['cedula'];
	$ficha=$_POST['ficha'];
	$nombres= $_POST['nombres'];
	$apellidos= $_POST['apellidos'];
	$sexo= $_POST['sexo'];
	$direccion= $_POST['direccion'];
	$tlf= $_POST['tlf'];
	$departamento= $_POST['departamento'];
	$cargo= $_POST['cargos'];
	$nivel= $_POST['nivel'];
	$horario= $_POST['horarios'];
	
	if($nombres && $apellidos && $direccion && $tlf && $sexo && $cargo && $departamento && $nivel && $horario){
		$consulta=pg_query("update personal set nombres='$nombres', apellidos='$apellidos', sexo='$sexo', direccion='$direccion', tlf='$tlf' where cedula='$cedula'");
		if(pg_affected_rows($consulta)!= 0){
			$consulta=pg_query("update empleados set id_departamento='$departamento', id_cargo= '$cargo', id_nivel='$nivel', id_horarios='$horario' where ficha='$ficha'");
			if(pg_affected_rows($consulta)!= 0){
				echo"<script>guardar(1)</script>";
			}
			else{
				echo"<script>guardar(0)</script>";
				$consulta=pg_query("delete from personal where cedula='$cedula'");
			}
		}
		else{
			echo"<script>guardar(0)</script>";
		}	
	}
	else{
		echo"<script>guardar(2)</script>";
	}
}


?>
</body>
</html>
