<?php
include('../../permisos.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Administracion del Sistema</title>
<link href="../../css/styles.css" rel="stylesheet"	type="text/css" />

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
	$id=$_POST['id_items'];
	$consulta="SELECT * FROM items WHERE id_items = '$id'";
	$result=pg_query($link,$consulta);	
	$row=pg_fetch_row($result);
}
?>

<body>
<form id="formDivisiones" name="formDivisiones" method="post" action="">
<h2 class="Estilo1">Modificar Item</h2>
<hr/>
<br>
<br>
<table width="341"  border="0" align="center" cellpadding="0" cellspacing="0" class="ReportDetails">
   <tr>
    <td height="250">
    <div id="ReportDetails">
      <table width="341"  border="1" align="center" class="ReportDetails">
        <tr>
          <td width="167" class="ReportTableHeaderCell">Id Item: </td>
          <td width="164" class="ReportDetailsOddDataRow"align="center">
          	<input type="text" name="campo0" id="campo0"  readonly="readonly" value="<?php echo $row[0]; ?>"/>          </td>
        </tr>
          <tr>
          <td width="167" class="ReportTableHeaderCell">Id de Categoria de Item: </td>
			 <div align="center">
			 <td width="175" class="ReportDetailsEvenDataRow"align="center">
			<select name="campo5">
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
			</td>
          </div>
        </tr>
        <tr>
          <td class="ReportTableHeaderCell">Nombre: </td>
          <td class="ReportDetailsEvenDataRow"align="center">
              <input type="text" name="campo2" id="campo2" value="<?php echo $row[3]; ?>"/>          </td>
        </tr>
        <tr>
          <td class="ReportTableHeaderCell">Descripción: </td>
          <td class="ReportDetailsEvenDataRow"align="center">
              <input type="text" name="campo3" id="campo3" value="<?php echo $row[1]; ?>"/>          </td>
        </tr>
        <tr>
          <td class="ReportTableHeaderCell">Unidad: </td>
          <td class="ReportDetailsEvenDataRow"align="center">
              <input type="text" name="campo4" id="campo4" value="<?php echo $row[4]; ?>"/>          </td>
        </tr>
        <tr>
        <td colspan="2" class="ReportDetailsEvenDataRow">
          <div align="center">
            <input type="submit" name="update" id="update" value="Modificar" />
            </div></td>
        </tr>
      </table>
      
      <?php
	  $id = $_POST["campo0"];
	  $id_categoria = $_POST["campo1"];
	  $nombre = $_POST["campo2"];
	  $descripcion = $_POST["campo3"];
	  $unidad = $_POST["campo4"];
			  
if($_POST['update']){
		  	  
	$mod="UPDATE items SET descripcion='$descripcion', id_categoria_items='$id_categoria', nombre='$nombre', unidad='$unidad' WHERE id_items='$id'";
		$mod1=pg_query($link,$mod);
		if(pg_affected_rows($mod1)!= 0){
			echo"<script>guardar(1)</script>";
		}
		else{
			echo"<script>guardar(0)</script>";
		}
			
}
	  ?>
     
     </div></td>
  </tr>
</table>
</form>
</body>
</html>
