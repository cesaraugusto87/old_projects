<?php
	//Codigo de Errores//
	error_reporting(E_ALL | E_NOTICE);
	ini_set('display_errors', true);
	ini_set('html_errors', true);
	
	include_once('Connections/bd_inavi.php');
	mysql_select_db($database_bd_inavi, $bd_inavi);
	include_once('clases.php');

	if (isset($_POST['fianza'])){
		$fianza = $_POST['fianza']; 
	}
	if (isset($_POST['emitida_por'])){
		$emitida_por = $_POST['emitida_por']; 
	}
	if (isset($_POST['poliza'])){
		$poliza = $_POST['poliza']; 
	}
	if (isset($_POST['monto'])){
		$monto = $_POST['monto']; 
	}

	if (isset($_POST['Submit'])){
		if (($fianza!="") && ($emitida_por!="") && ($poliza!="")  && ($monto!="")){
			$insert = modificar_fianza_contrato($bd_inavi,$_GET['id_fianza'],$fianza,$emitida_por,$poliza,$monto);
			if ($insert==false)
				$mensaje="Error, no se pudo modificar!";
			else
				$mensaje="Registro Modificado Exitosamente!";
		}
		else
			$error="Debe ingresar todos los campos!!";
	}
	
	if (isset($_GET['contrato'])){
		$contrato = $_GET['contrato']; 
	}

	if (isset($_GET['id_fianza'])){
		$id_fianza = $_GET['id_fianza']; 
	}
	
	if ($contrato!=""){
		$fianzas = consultar_garantias($bd_inavi,$contrato);
		$c = mysql_fetch_assoc($fianzas);
		while ($c['id_fianzacontrato']!=$id_fianza)
			$c = mysql_fetch_assoc($fianzas);
	}
	
	if (isset($_POST['regresar']))
			header ("Location:detalle_contrato.php?contrato=".$contrato);	


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Ingresar Contrato</title>

<link rel="StyleSheet" href="estilos.css" type="text/css" media="screen">
  <script type="text/javascript" src="calendar.js" charset="ISO-8859-15"></script>
   <link type="text/css" href="calendar-blue.css" rel="stylesheet" >
</head>

<body background="img/fondo_inavi.jpg">
<p>&nbsp;</p>

<form name="formulario" method="post">
 <table width="750" height="277" border="0" align="center" cellpadding="2" cellspacing="2">
    <tr>
      <td>
	  
  <table width="400" border="0" align="center" cellpadding="2" cellspacing="2">
    <tr>
      <td colspan="2" class="titulo_tabla">Modificar Fianza</div></td>
    </tr>

    <tr>
      <td class="cabecera">Fianza  </td>
      <td class="ingresar_der">
	  	<select name="fianza" id="fianza" class="Forms" >
        <option></option>
        <?php
		$result = select_fianzas($bd_inavi);
		while ($reg=mysql_fetch_assoc($result)){
				$sel = "";
				if ($reg['id_fianza'] == $c['fk_idfianza'])
						$sel = "selected='selected'";
					else
						$sel = "";
	
		?>
        <option <?php echo $sel;?> value="<?php echo $reg['id_fianza'];?>"><?php echo $reg['descripcionf']; } ?> </option>
      </select></td>
    </tr>
    <tr>
      <td class="cabecera">Emitida Por </td>
      <td class="ingresar_der"><input name="emitida_por" type="text" id="emitida_por" class="Forms" value="<?php echo $c['emitida_por'];?>"></td>
    </tr>
    <tr>
      <td class="cabecera">N&ordm; Poliza </td>
      <td class="ingresar_der"><input name="poliza" type="text" id="poliza" class="Forms" value="<?php echo $c['numeropoliza'];?>"></td>
    </tr>
    <tr>
      <td class="cabecera">Monto BsF. </td>
      <td class="ingresar_der"><input name="monto" type="text" id="monto" class="Forms" value="<?php echo $c['monto'];?>"></td>
    </tr>
    <tr>
      <td colspan="2" class="ingresar_der" align="center"><input type="submit" name="Submit" value="Enviar">
	  <input type="submit" name="regresar" value="Regresar"></td>
    </tr>
  </table>
    </td>
    </tr>
  </table>
 
    <?php if (isset($mensaje)){ ?>
    		<p class="Mensajes"><?php echo $mensaje;?></p>
	<?php }; ?>
  
</form>
</body>
</html>
