<?php
	//Codigo de Errores//
	error_reporting(E_ALL | E_NOTICE);
	ini_set('display_errors', true);
	ini_set('html_errors', true);

	include_once('Connections/bd_inavi.php');
	mysql_select_db($database_bd_inavi, $bd_inavi);
	include_once('clases.php');
	session_start();
	
	if (isset($_POST['usuario'])){
		$usuario = $_POST['usuario']; 
	}
	if (isset($_POST['clave'])){
		$clave = $_POST['clave']; 
	}
	if (isset($_POST['nueva'])){
		$nueva = $_POST['nueva']; 
	}
	if (isset($_POST['nueva2'])){
		$nueva2 = $_POST['nueva2']; 
	}


	if (isset($_POST['Submit'])){
		if (($usuario!="") && ($nueva!="") && ($nueva2!="")){
			if ($nueva==$nueva2){
				$update=cambiar_clave($bd_inavi,$usuario,$nueva);
				if ($update==false)
					$mensaje="Error. No se pudo modificar";
				else
					$mensaje="Su password fue cambiada correctamente!!";
			}
			else
				$mensaje="Las claves no coinciden!!";
		}
		else
			$mensaje="Ingrese ambos campos!!";
	}
	
//	$login = ;
	$login = $_SESSION['USUARIO'];





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

  <table width="400" border="0" align="center" cellpadding="2" cellspacing="2">
  <tr>
      <td colspan="3" class="titulo_tabla">CAMBIAR PASSWORD</td>
    </tr>
    <tr>
      <td class="cabecera">Usuario </td>
      <td colspan="2" class="ingresar_der"><input name="usuario" type="text" id="usuario" class="Forms" value="<?php echo $login;?>"></td>
    </tr>
    <tr>
      <td class="cabecera">Nueva Contrase&ntilde;a </td>
      <td colspan="2" class="ingresar_der"><input name="nueva" type="password" id="nueva" class="Forms"></td>
    </tr>
    <tr>
      <td class="cabecera">Confirme Contrase&ntilde;a </td>
    <td colspan="2" class="ingresar_der"><input name="nueva2" type="password" id="nueva2" class="Forms"></td>
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
