<?php include('../../permisos.php');?>
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
	$id=$_POST['numero'];
	$consulta="SELECT * FROM usuarios WHERE numero = '$id'";
	$result=pg_query($link,$consulta);	
	$row=pg_fetch_row($result);
}
?>

<body>
<form id="formDivisiones" name="formDivisiones" method="post" action="">
<h2 class="Estilo1">Modificar Usuario</h2>
<hr/>
<br>
<br>
<table width="341"  border="0" align="center" cellpadding="0" cellspacing="0" class="ReportDetails">
   <tr>
    <td height="250">
    <div id="ReportDetails">
      <table width="341"  border="1" align="center" class="ReportDetails">
        <tr>
          <td width="167" class="ReportTableHeaderCell">Numero: </td>
          <td width="164" class="ReportDetailsOddDataRow"align="center">
          	<input type="text" name="campo0" id="campo0"  readonly="readonly" value="<?php echo $row[0]; ?>"/>          </td>
        </tr>
                <tr>
          <td width="167" class="ReportTableHeaderCell">Login: </td>
          <td width="164" class="ReportDetailsOddDataRow"align="center">
            <input type="text" name="campo1" id="campo1" value="<?php echo $row[1]; ?>"/>          </td>
        </tr>
        <tr>
          <td width="167" class="ReportTableHeaderCell">clave: </td>
          <td width="164" class="ReportDetailsOddDataRow"align="center">
            <input type="text" name="campo2" id="campo2" value="<?php echo $row[2]; ?>"/>          </td>
        </tr>
        <tr>
          <td width="167" class="ReportTableHeaderCell">Id Nivel: </td>
              <div align="center">
			  <td width="175" class="ReportDetailsEvenDataRow"align="center">
				<select name="campo4">
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
		   </select></td>
        </td>
		</div>
        </tr>
        
        <tr>
        <td colspan="2" class="ReportDetailsEvenDataRow">
          <div align="center">
            <input type="submit" name="update" id="update" value="Modificar" />
            </div></td>
        </tr>
      </table>
      
      <?php
	  $numero = $_POST["campo0"];
	  $descripcion1 = $_POST["campo1"];
	  $clave1 = $_POST["campo2"];
	  $id_nivel1 = $_POST["campo4"];
	 
	 	  	  
if($_POST['update']){
		  	  
	$mod="UPDATE usuarios SET login='$descripcion1', clave='$clave1', id_nivel='$id_nivel1' WHERE numero='$numero'";
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
