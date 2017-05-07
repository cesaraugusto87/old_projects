<?php include('../../permisos.php');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Formulario modelo</title>
<link href="../../css/styles.css" rel="stylesheet"	type="text/css" />
<style type="text/css">
</style>
</head>
<?php include ("../../conexion/conexion.php");
$link= Conectarse();
?>
<body>
<form id="formDivisiones" name="formDivisiones" method="post">
<h2 class="Estilo1">Agregar Usuario</h2>
<hr/>
<br>
<br>
<table  width="341"   border="0" align="center" cellpadding="0" cellspacing="0" class="ReportDetails">
   <tr>
    <td>
    <div id="ReportDetails">
      <table width="341"  border="1" align="center"class="ReportDetails">
        <tr>
          <td width="167" class="ReportTableHeaderCell">Número: </td>
        <td width="164" class="ReportDetailsEvenDataRow"><label> </label>
              
                <div align="left">
                  <input type="text" name="campo1" id="campo1" />
              </div></td>
        </tr>
        <tr>
          <td class="ReportTableHeaderCell">Login: </td>
          <td class="ReportDetailsOddDataRow"><label> </label>
              
                <div align="left">
                  <input type="text" name="campo2" id="campo2" />
              </div></td>
        </tr>
        <tr>
          <td class="ReportTableHeaderCell">Password:</td>
          <td class="ReportDetailsEvenDataRow">
              <div align="left">
                <input type="text" name="campo3" id="campo3" />
              </div></td>
        </tr>
        <tr>
          <td class="ReportTableHeaderCell">Id Nivel:</td>
			<div align="center">
			<td width="175" class="ReportDetailsEvenDataRow"align="center">
		  
           <select name="campo3">
					<?php
						$niveles=$nivel=pg_query("select * from nivel");
						if(pg_num_rows($niveles)!=0){
                   			while($datos=pg_fetch_array($niveles)){
							?>
                            	<option value="<?php echo($datos['id_nivel']);?>"><?php echo($datos['id_nivel']);?></option>
                            <?php
							}
						}
					?>
		   </select>
          </td>
		  </div>
        </tr>
        <tr>
        <td colspan="2" class="ReportDetailsEvenDataRow">
          <div align="center">
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
if ($_POST['campo1'] && $_POST['campo2'] && $_POST['campo3'] && $_POST['campo4'])
	{
		$consulta="INSERT INTO usuarios(
            numero, login, clave, id_nivel)
    		VALUES ('".$_POST['campo1']."', '".$_POST['campo2']."', '".$_POST['campo3']."', 
			'".$_POST['campo4']."');";
		pg_query($link,$consulta);
	} 
?>
</body>
</html>
