<?php
include('../../permisos.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Facturaci&oacute;n</title>
<link href="../../css/styles.css" rel="stylesheet"	type="text/css" />
<style type="text/css">
.Estilo2 {color: #0000FF}
.Estilo3 {font-size: 14px}
.Estilo4 {font-size: 14px}
</style>
</head>
<?php require('../../conexion/conexion.php');
$link = Conectarse();

if ($_POST['Enviar']){
	$clientes=$_POST["hrif"];
	$cclientes= pg_query("select * from clientes where rif='$clientes'");
	$cclientes=pg_fetch_array($cclientes);
	$impuesto=$_POST["himpuesto"];
	$porcentaje=$_POST["hprecio"];	
}

if ($_POST['Vender']){
	$clientes=$_POST["hrif"];
	$cclientes= pg_query("select * from clientes where rif='$clientes'");
	$cclientes=pg_fetch_array($cclientes);
	$impuesto=$_POST["himpuesto"];
	$porcentaje=$_POST["hprecio"];	
}
?>
<script type="text/javascript">
//Funcion que trae los datos del cliente al ingresar el/la rif/cedula
function cargar(objeto){
<?php
$cargar= pg_query("select * from clientes");
if(pg_num_rows($cargar)!=0){
	while($datos3=pg_fetch_array($cargar)){
?>
		if(objeto.value== '<?php echo($datos3['rif']);?>'){
			
			document.getElementsByName("nombre")[0].value= "<?php print($datos3['nombres'].", ".$datos3['apellidos']);?>";
			document.getElementsByName("telefono")[0].value="<?php printf($datos3['tlf']);?>";
			document.getElementsByName("direccion")[0].value="<?php printf($datos3['domicilio']);?>";
			document.getElementsByName("tipo")[0].value= "<?php printf($datos3['tipo']);?>";
		}
<?php
	}
}
?>
}
function guardar(){
	rif= document.getElementsByName("rif")[0].value;
	document.getElementsByName("hrif")[0].value= rif;
	indice=document.getElementsByName("impuesto")[0].selectedIndex;
	indiceg=document.getElementsByName("ganancia")[0].selectedIndex;
	document.getElementsByName("hprecio")[0].value= indice;
	document.getElementsByName("himpuesto")[0].value= indiceg;
}

function colocar(){
	p="<?php echo($porcentaje)?>";
	i="<?php echo($impuesto)?>";
	document.getElementsByName("ganancia")[0].selectedIndex=p;
	document.getElementsByName("impuesto")[0].selectedIndex=i;
}

</script>
<body onload="colocar()">
<div>
<form name="cliente" method="post">
  <p class="Estilo1">Facturar</p>
  <hr/>
<div style="float:left;">
<fieldset style="height:150px; width:250px; border: 2px solid #2E9AFE; -moz-border-radius: 15px; -webkit-border-radius: 15px;">
<legend class="titulo2 Estilo2 Estilo3"><strong>Datos del Cliente</strong></legend>
<table class="ReportDetails">
	<tr>
		<th width="25">Rif/CI:</th>
		<td>
			<input type="text" name="rif" value="<?php echo($cclientes['rif']);?>" onkeyup="cargar(this)">
		</td>
	</tr>
		<th width="5">Nombre:</th>
		<td>
			<input type="text" name="nombre" value="<?php echo($cclientes['nombres'].", ".$cclientes['apellidos']);?>">
		</td>
	<tr>
		<th width="5">Telefono:</th>
		<td>
			<input type="text" name="telefono" value="<?php echo($cclientes['tlf']);?>">
		</td>
	</tr>	
	<tr>
		<th width="80">Direccion:</th>
		<td>
			<input type="text" name="direccion" value="<?php echo($cclientes['domicilio']);?>">
		</td>
	</tr>
	<tr>
		<th>Tipo:</th>
		<td>
			<input type="text" name="tipo" value="<?php echo($cclientes['tipo']);?>">
		</td>		
	</tr>
</table>
<br>
</fieldset>
</div>

<div style="float:right;margin-right:90px;">
<fieldset style="height:100px; width:170px; border: 2px solid #2E9AFE; -moz-border-radius: 15px; -webkit-border-radius: 15px;">
<legend class="titulo2 Estilo2 Estilo3"><strong>Cargos y Deducciones</strong></legend>
<strong>Impuesto: </strong>
<select name="impuesto">
	<option value="null">-</option>
    <?php
		$impuestos= pg_query("select * from impuestos");
		if(pg_num_rows($impuestos)!=0){
			while($datos1=pg_fetch_array($impuestos)){
	?>
    			<option value="<?php echo($datos1['nombre']); ?>"><?php echo($datos1['nombre']); ?> </option>
    <?php
			}
		}
	?>
</select>
<br>
<br>
<strong>Ganancia: </strong>
<select name="ganancia">
	<option value="null">-</option>
    <?php
		$ganacias= pg_query("select * from precios");
		if(pg_num_rows($ganacias)!=0){
			while($datos2=pg_fetch_array($ganacias)){
	?>
    			<option value="<?php echo($datos2['porcentaje']); ?>"><?php echo($datos2['porcentaje']); ?> </option>
    <?php
			}
		}
	?>
</select>
</fieldset>
</div>
<div>
</div>
<br>
</form>
</div>
<div>
<br>
<form name="nuevo" action="pedido.php" method="post">
<div>
<br><br><br><br><br>
<table width = "20%"  align = "center" class = "ReportDetails">
	<tr>
		<th><input align="center" type="submit" name="Nuevo" onclick="guardar()" value="Nuevo" /></th>
	</tr>
</table>
	<input type="hidden" id="hrif" name="hrif" value=""/>
	<input type="hidden" id="himpuesto" name="himpuesto" value=""/>
	<input type="hidden" id="hprecio" name="hprecio" value=""/>
</div>
<br>
<?php
$impuesto=$_POST["himpuesto"];
$porcentaje=$_POST["hprecio"];	
if ($_POST['Enviar']){
$neto=0;
?>
<div>
<fieldset style="border: 2px solid #2E9AFE; -moz-border-radius: 15px; -webkit-border-radius: 15px;">
<table width="708" align="center">
  <tr>
    <td class="titulo1 Estilo4" align="center">C&oacute;digo</td>
    <td class="titulo1 Estilo4" align="center">Nombre</td>
    <td class="titulo1 Estilo4" align="center">Descripci&oacute;n</td>
    <td class="titulo1 Estilo4" align="center">Cantidad</td>	
    <td class="titulo1 Estilo4" align="center">Precio Unitario</td>
    <td class="titulo1 Estilo4" align="center">Subtotal</td>	
    <td class="titulo1 Estilo4" align="center">%Impuesto</td>	
    <td class="titulo1 Estilo4" align="center">Total</td>		  
  </tr>
		<?php
		$pedido=pg_query("select * from tabla_pedido");	
		$i=pg_query("select * from impuestos where id_impuestos='$impuesto'");
		$imp=pg_fetch_array($i);
		while($datos=pg_fetch_array($pedido)){
			$unidad=$datos['costo_unidad'];
			$impuesto=$imp['porcentaje'];
			$c_imp=$unidad*($impuesto/100);
			$cant=$datos['cantidad'];
			$sub_total=$unidad*$cant;
			$total=$sub_total+$c_imp;
			//se calcula el total neto
			$neto=$neto+$total;
		?>
  <tr>
    <td align="center"><?php echo($datos['ref']);?></td>
    <td align="center"><?php echo($datos['nombre']);?></td>
    <td align="center"><?php echo($datos['descripcion']);?></td>
    <td align="center"><?php echo($datos['cantidad']);?></td>	
	<td align="center"><?php echo($datos['costo_unidad']);?></td>
	<td align="center"><?php echo($sub_total);?></td>	
	<td align="center"><?php echo($c_imp);?></td>	
    <td align="center"><?php echo($total);?></td>	
  </tr>
   <?php 
  }
  	//se calcula el iva
  	$iva=($neto*12)/100;
	//total de la facura con iva
	$total_fact=$iva+$neto;
  ?>
</table>
</fieldset>
<br>
<table width="708" align="center">
	<tr>
		<th>Total Neto:</th>
		<td><input type="text" readonly="1" name="total_neto" value="<?php echo($neto);?>"></td>	
		<th>I.V.A 12%:</th>
		<td><input type="text" readonly="1" name="total_neto" value="<?php echo($iva);?>"></td>		
		<th>Total Factura:</th>
		<td><input type="text" readonly="1" name="total_neto" value="<?php echo($total_fact);?>"></td>				
	</tr>
</table>
</div>
</form>
</div>
<br>
<div>
<form name="vende" method="post" action="factura.php">
	<input type="hidden" id="hrif" name="hrif" value=""/>
	<input type="hidden" id="himpuesto" name="himpuesto" value=""/>
	<input type="hidden" id="hprecio" name="hprecio" value=""/>
<table width = "20%"  align = "center" class = "ReportDetails">
	<tr>
		<th><input align="center" type="submit" name="Vender" value="Vender"/></th>
	</tr>
</table>
</form>
</div>
<?php
}
?>
</body>
</html>
