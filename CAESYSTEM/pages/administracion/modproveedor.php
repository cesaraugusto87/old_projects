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
	if(n==1) alert("Los cambios han sido registrados");
	else alert("Ha ocurrido un error. No se ha actualizado");
	}
</script>
</head>
<?php include ("../../conexion/conexion.php");
$link= Conectarse();
if ($_POST['Modificar']){
$consulta="SELECT id_rif, descripcion, domicilio, tlf, tipo, id_estado FROM proveedores WHERE id_rif = '".$_POST['id_proveedor']."'";
$result=pg_query($link,$consulta);	
$row=pg_fetch_row($result);}
?>
<body>
<form id="formDivisiones" name="formDivisiones" method="post">
<h2 class="Estilo1"> Modificar/Eliminar Proveedor</h2>
<hr/>
<table width="600" height="300" border="1" align="center" cellpadding="0" cellspacing="0" class="ReportDetails">
   <tr>
    <td height="250">
    <div id="ReportDetails">
      <table width="341" height="195" border="0" align="center">
        <tr>
          <td width="167" class="ReportTableHeaderCell">Id Proveedor: </td>
          <td width="164" class="ReportTableValueCell"><label> </label>
              <input type="text" name="campo1" id="campo1" value="<?php echo $row[0]; ?>"/>
          </td>
        </tr>
        <tr>
          <td class="ReportTableHeaderCell">Descripción: </td>
          <td class="ReportTableValueCell"><label> </label>
              <input type="text" name="campo2" id="campo2" value="<?php echo $row[1]; ?>" />
          </td>
        </tr>
        <tr>
          <td class="ReportTableHeaderCell">Domicilio:</td>
          <td class="ReportTableValueCell">
             <input type="text" name="campo3" id="campo3" value="<?php echo $row[2]; ?>" />
          </td>
        </tr>
        <tr>
          <td class="ReportTableHeaderCell">Teléfono:</td>
          <td class="ReportTableValueCell">
              <input type="text" name="campo4" id="campo4" value="<?php echo $row[3]; ?>"/>
          </td>
        </tr>
        <tr>
          <td class="ReportTableHeaderCell">Tipo:</td>
          <td class="ReportTableValueCell">
              <input type="text" name="campo5" id="campo5" value="<?php echo $row[4]; ?>" />
          </td>
        </tr>
        <tr>
        <td class="ReportTableHeaderCell">Estatus:</td>
          <td>
              <div align="left">
                <select name="campo6">
					<?php
						$estado=$row[5];
						$estados=pg_query("select * from estado where id_estado='$estado'");
						$estados=pg_fetch_array($estados);
					?>
                    	<option value="<?php echo($estados['id_estado']);?>"><?php echo($estados['descripcion']);?></option>
                    <?php
						if(pg_num_rows($estados)!=0){
                   			while($datos=pg_fetch_array($estados)){
								if($datos['id_estado']!= $estados['id_estado']){
							?>
                            		<option value="<?php echo($datos['id_estado']);?>"><?php echo($datos['descripcion']);?></option>
                            <?php
								}
							}
						}
					?>
				</select>
              </div></td>
        </tr>
      </table>
      <p>
         <label>
        <div align="center">
          <div align="center">
           <input type="submit" name="modificar" id="modificar" value="Modificar" />
        </div>
      </label></td>
  </tr>
</table>
</form>
<?php
if ($_POST['campo1'] && $_POST['campo2'] && $_POST['campo3'] && $_POST['campo4'] && $_POST['campo5'] && $_POST['modificar']){
		$consulta="UPDATE proveedores SET descripcion='".$_POST['campo2']."', domicilio='".$_POST['campo3']."', tlf='".$_POST['campo4']."', tipo='".$_POST['campo5']."', id_estado='".$_POST['campo6']."' WHERE id_rif = '".$_POST['campo1']."';";
		$mod1=pg_query($link,$consulta);
		if(pg_affected_rows($mod1)!= 0){
			echo"<script>guardar(1)</script>";
		}
		else{
			echo"<script>guardar(0)</script>";
		}
}
		
?>
</body>
</html>
