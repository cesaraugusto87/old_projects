<?php
include('../../permisos.php');
?>
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
	if(n==1) alert("El proveedor fué guardado");
	else alert("El proveedor no fué guardado");
	}
</script>
</head>
<?php include ("../../conexion/conexion.php");
$link= Conectarse();
?>
<body>
<form id="formDivisiones" name="formDivisiones" method="post">
<h2 class="Estilo1">Agregar Proveedor</h2>
<hr/>
<br>
<br>
<table width="341" height="300" border="0" align="center" cellpadding="0" cellspacing="0" class="ReportDetails">
   <tr valign="top">
    <td>
    <div id="ReportDetails">
      <table width="341" border="1" align="center">
        <tr>
        <td class="ReportTableHeaderCell">RIF: </td>
        <td class="ReportDetailsOddDataRow" align="center"><input type="text" name="campo1" id="campo1" /></td>
        </tr>
        <tr>
          <td class="ReportTableHeaderCell">Descripción: </td>
		  <td class="ReportDetailsOddDataRow" align="center"><input type="text" name="campo2" id="campo2" /></td>
        </tr>
        <tr>
          <td class="ReportTableHeaderCell">Domicilio:</td>
          <td class="ReportDetailsOddDataRow" align="center"><input type="text" name="campo3" id="campo3" /></td>
        </tr>
        <tr>
          <td class="ReportTableHeaderCell">Teléfono:</td>
         <td class="ReportDetailsOddDataRow" align="center"> <input type="text" name="campo4" id="campo4" /></td>
        </tr>
        <tr>
          <td class="ReportTableHeaderCell">Tipo:</td>
          <td class="ReportDetailsOddDataRow" align="center"><input type="text" name="campo5" id="campo5"/></td>
        </tr>
        <tr>
        <td class="ReportTableHeaderCell">Estatus:</td>
              <div align="center">
			  <td width="175" class="ReportDetailsEvenDataRow"align="center">
                <select name="campo6">
                <option value="">-</option>
					<?php
						$estados=pg_query("select * from estado where id_estado like 'Pr-%'");
						if(pg_num_rows($estados)!=0){
                   			while($datos=pg_fetch_array($estados)){
							?>
                            	<option value="<?php echo($datos['id_estado']);?>"><?php echo($datos['descripcion']);?></option>
                            <?php
							}
						}
					?>
				</select>
              </div></td>
        </tr>
  
     <tr>
		<td colspan="2" class="ReportDetailsOddDataRow">
		<div align="center" class="ReportDetailsEvenDataRow">
		<input type="submit" name="enviar" id="enviar" value="Enviar" />
		</div></td>
	  </tr>
	  </table>
  </tr>
</table>
</form>
<?php 
if ($_POST['campo1'] && $_POST['campo2'] && $_POST['campo3'] && $_POST['campo4'] && $_POST['campo5']
	&& $_POST['campo6'])
	{
		$consulta="INSERT INTO proveedores(
            id_rif, descripcion, domicilio, tlf, tipo, id_estado)
    		VALUES ('".$_POST['campo1']."', '".$_POST['campo2']."', '".$_POST['campo3']."', 
			'".$_POST['campo4']."', '".$_POST['campo5']."', '".$_POST['campo6']."');";
		$consulta=pg_query($link,$consulta);
		if(pg_affected_rows($consulta)!= 0){
				echo"<script>guardar(1)</script>";
			}
			else{
				echo"<script>guardar(0)</script>";
			}
	} 
?>
</body>
</html>
