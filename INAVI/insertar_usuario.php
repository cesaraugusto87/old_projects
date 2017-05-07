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
	if (isset($_POST['confirmacion'])){
		$confirmacion = $_POST['confirmacion']; 
	}


	if (isset($_POST['Submit'])){
		if (($usuario!="") && ($clave!="") && ($confirmacion!="")){
			if ($clave==$confirmacion){
				$insert=insertar_usuario($bd_inavi,$usuario,$clave);
				if ($insert==false)
					$mensaje="Error. No se pudo ingresar";
				else
					$mensaje="Usuario Ingresado Exitosamente!!";
			}
			else
				$mensaje="Las claves no coinciden!!";
		}
		else
			$mensaje="Ingrese todos los campos!!";
	}
	else
	
	if (isset($_POST['usuario'])){
		//echo "VErif";
		$v = ver_disponible($bd_inavi,$_POST['usuario']);
		if ($v == 1)
			$mensaje = "Nombre de Usuario ya existe. Ingrese otro";
		else
			$mensaje = "Login disponible!";
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

  <table width="400" border="0" align="center" cellpadding="2" cellspacing="2">
  <tr>
      <td colspan="3" class="titulo_tabla">Ingrese los datos del Nuevo Usuario</td>
    </tr>
    <tr>
      <td class="cabecera">Usuario </td>
      <td colspan="2" class="ingresar_der"><input name="usuario" type="text" id="usuario" class="Forms" value="<?php if (isset($_POST['usuario'])) echo $_POST['usuario'];?>">
	  <a class="enlace" onClick="javascript:document.form2.submit();">Verificar</a>
	  
	  </td>
    </tr>
    <tr>
      <td class="cabecera">Contrase&ntilde;a </td>
      <td colspan="2" class="ingresar_der"><input name="clave" type="password" id="clave" class="Forms"></td>
    </tr>
    <tr>
      <td class="cabecera">Confirme Contrase&ntilde;a </td>
    <td colspan="2" class="ingresar_der"><input name="confirmacion" type="password" id="confirmacion" class="Forms"></td>
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
