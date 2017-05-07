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
	if(n==1) alert("El Nivel fué guardado");
	else alert("El Nivel no fué guardado");
	}
</script>
</head>
<?php include ("../../conexion/conexion.php");
$link= Conectarse();
$fecha_actual= date("d-m-Y");
?>
<body>
<form id="formDivisiones" name="formDivisiones" method="post">
<h2 class="Estilo1">Agregar Nivel</h2>
<hr/>
<table  width="341"   border="0" align="center" cellpadding="0" cellspacing="0" class="ReportDetails">
	<tr valign="top">
   <tr>
    <td>
    <div id="ReportDetails">
      <table width="341"  border="1" align="center">
        <tr>
          <td width="167" class="ReportTableHeaderCell">Id Nivel: </td>
          <td width="164" class="ReportDetailsEvenDataRow" align="center"><input type="text" name="campo1" id="campo1" /></td>
        </tr>
        <tr>
          <td class="ReportTableHeaderCell">Descripción: </td>
          <td class="ReportDetailsOddDataRow" align="center"><input type="text" name="campo2" id="campo2" /></td>
        </tr>
        <tr>
          <td class="ReportTableHeaderCell">Tipo: </td>
          <td class="ReportDetailsEvenDataRow" align="center"><input type="text" name="campo3" id="campo3" /></td>
        </tr>
        <tr>
        <td colspan="2" class="ReportDetailsOddDataRow">
          <div align="center" class="ReportDetailsEvenDataRow">
            <input type="submit" name="enviar" id="enviar" value="Enviar" />
            </div></td>
        </tr> 
      </table>
      </div>
      </td>
  </tr>
  
</table>
</form>
<?php 
if ($_POST['campo1'] && $_POST['campo2'] && $_POST['campo3'])
	{
		$consulta=pg_query("INSERT INTO nivel(
            id_nivel, descripcion, tipo)
    		VALUES ('".$_POST['campo1']."', '".$_POST['campo2']."', '".$_POST['campo3']."');");
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
