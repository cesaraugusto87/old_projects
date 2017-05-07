<?php
	//Codigo de Errores//
	error_reporting(E_ALL | E_NOTICE);
	ini_set('display_errors', true);
	ini_set('html_errors', true);

	include_once('Connections/bd_inavi.php');
	mysql_select_db($database_bd_inavi, $bd_inavi);
	include_once('clases.php');

	
	if (isset($_POST['nombre_empresa'])){
		$empresa = $_POST['nombre_empresa']; 
	}
	if (isset($_POST['rif'])){
		$rif = $_POST['rif']; 
	}
	if (isset($_POST['nombre_represent'])){
		$represent = $_POST['nombre_represent']; 
	}
	if (isset($_POST['ci_represent'])){
		$ci_represent = $_POST['ci_represent'];
	}
		$nac="";
	if (isset($_POST['nac'])){
		$nac = $_POST['nac'];
	}


	if (isset($_POST['Submit'])){
		if (($empresa!="") && ($rif!="") && ($represent!="") && ($ci_represent!="") && ($nac!="")){
			$cedula= $nac.$ci_represent;
			$insert=insertar_empresa($bd_inavi,$empresa,$rif,$represent,$cedula);
			if ($insert==false)
				$mensaje="Error. No se pudo insertar";
			else
				$mensaje="Registro Ingresado Exitosamente..";
		}
		else
			$mensaje="Debe ingresar todos los campos!!";
	}





?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title></title>

<link rel="StyleSheet" href="estilos.css" type="text/css" media="all">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>


<body background="img/fondo_inavi.jpg">
<form name="form2" method="post">

<table width="750" height="277" border="0" align="center" cellpadding="2" cellspacing="2">
<tr>
<td>

  <table width="498" border="0" align="center" cellpadding="2" cellspacing="2">
  <tr>
      <td colspan="3" class="titulo_tabla">Introduzca los datos de la empresa </td>
    </tr>
    <tr>
      <td class="cabecera">Nombre Fiscal de la Empresa </td>
      <td colspan="2" class="ingresar_der"><input name="nombre_empresa" type="text" id="nombre_empresa" size="38" class="Forms"></td>
    </tr>
    <tr>
      <td class="cabecera">R.I.F (J-XXXXXXXX-X) </td>
      <td colspan="2" class="ingresar_der"><input name="rif" type="text" id="rif" size="38" class="Forms"></td>
    </tr>
    <tr>
      <td class="cabecera">Nombre Representante Legal </td>
      <td colspan="2" class="ingresar_der"><input name="nombre_represent" type="text" id="nombre_represent" size="38" class="Forms"></td>
    </tr>
    <tr>
      <td class="cabecera">C.I. del Representante Legal </td>
	  <td class="ingresar_der"><input type="radio" name="nac" value="V">V<input type="radio" name="nac" value="E">E</td>
      <td class="ingresar_der"><input name="ci_represent" type="text" id="ci_represent" size="15" maxlength="15" class="Forms"></td>
    </tr>
	<tr><td class="ingresar_der" colspan="3" align="center"><input type="submit" name="Submit" value="Enviar" ></td></tr>
	
  </table>
  
 </td>
 </tr>
</table>
  <?php if (isset($mensaje)){ ?>
    		<p class="Mensajes"><?php echo $mensaje; ?></p>
	<?php };	?>
  
  		
  
</form>
</body>
</html>
