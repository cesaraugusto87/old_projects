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
<h2 class="Estilo1">Agregar Items</h2>
<hr/>
<table width="341"  border="0" align="center" cellpadding="0" cellspacing="0" class="ReportDetails">
   <tr>
    <td>
    <div id="ReportDetails">
      <table width="341"  border="1" align="center" class="ReportDetails">
        <tr>
          <td width="167" class="ReportTableHeaderCell">Id Items: </td>
          <td width="164" class="ReportDetailsEvenDataRow"><label> </label>
              
                <div align="left">
                  <input type="text" name="campo1" id="campo1" />
              </div></td>
        </tr>
        <tr>
          <td class="ReportTableHeaderCell">Descripción: </td>
          <td class="ReportDetailsOddDataRow"><label> </label>
              
                <div align="left">
                  <input type="text" name="campo2" id="campo2" />
              </div></td>
        </tr>
        <tr>
          <td class="ReportTableHeaderCell">Id Categoría:</td>
              <div align="center">
			  <td width="175" class="ReportDetailsEvenDataRow"align="center">
			   <select name="campo3">
					<?php
						$categorias=$categoria=pg_query("select * from categoria_items");
						if(pg_num_rows($categorias)!=0){
                   			while($datos=pg_fetch_array($categorias)){
							?>
                            	<option value="<?php echo($datos['id_categoria_items']);?>"><?php echo($datos['id_categoria_items']);?></option>
                            <?php
							}
						}
					?>
				</select>
              </td></div>
        </tr>
         <tr>
          <td class="ReportTableHeaderCell">Nombre:</td>
          <td class="ReportDetailsEvenDataRow"><label> </label>
              
                <div align="left">
                  <input type="text" name="campo4" id="campo4" />
              </div></td>
        </tr>
         <tr>
          <td class="ReportTableHeaderCell">Unidad:</td>
          <td class="ReportDetailsOddDataRow"><label> </label>
              
                <div align="left">
                  <input type="text" name="campo5" id="campo5" />
              </div></td>
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
if ($_POST['campo1'] && $_POST['campo2']&& $_POST['campo3']&& $_POST['campo4']&& $_POST['campo5'])
	{
		$consulta="INSERT INTO items(
            id_items, descripcion, id_categoria_items, nombre, unidad)

    		VALUES ('".$_POST['campo1']."', '".$_POST['campo2']."','".$_POST['campo3']."','".$_POST['campo4']."','".$_POST['campo5']."');";
		pg_query($link,$consulta);
	} 
?>
</body>
</html>
