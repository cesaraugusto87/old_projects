<?php
	//Codigo de Errores//
	error_reporting(E_ALL | E_NOTICE);
	ini_set('display_errors', true);
	ini_set('html_errors', true);
	session_start();

include_once('Connections/bd_inavi.php');


if (isset($_POST['Aceptar'])){
	$usuario = $_POST['usuario'];
	$clave = $_POST['clave'];

	mysql_select_db($database_bd_inavi, $bd_inavi);
	$sql = "select * from usuario where Usuario='$usuario'";

	$result = mysql_query($sql,$bd_inavi);
	$cant=mysql_num_rows($result);
	
	if ($cant>0){
		$info=mysql_fetch_array($result);

		if ($info['Clave']!=$clave)
			$mensaje="Contraseña Incorrecta!";
		else{
			$_SESSION['USUARIO']=$usuario;
			header("Location: crear_frames.php"); 
		}
	}
	else
			$mensaje="Usuario No Registrado!";
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Administracion de Contratos INAVI</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="StyleSheet" href="estilos.css" type="text/css" media="all">

</head>
<script>

function color(){
//alert('gfg');
	document.getElementById('tabla').style.background.background-color="#99FFFF";
}

</script>

<body background="img/f1.png">
<form method="post">

<table width="820" align="center" frame="border" cellpadding="0" cellspacing="0" background="img/fondo_inavi.jpg" bordercolor="White">
	<TR>
	  <TD>
		<table  align="center" >
			<tr>
   				<td height="102"><img src="img/encabezado.jpg" width="800" height="100"></td>
			</tr>
	  </TABLE>
	  </TD>
	</TR> 
  	<tr>
    	<td height="80">&nbsp;</td>
  	</tr>
  	<tr>
    	<td height="21" class="titulos">SISTEMA DE CONTROL DE OBRAS INAVI</td>
  	</tr>
  	<tr>
    	<td height="40">&nbsp;</td>
  	</tr>
  	<tr>
    	<td height="21">
			<table width="300" height="165"  align="center" cellpadding="0" cellspacing="0">
      			<tr>
        			<td class="titulo_tabla" colspan="2">ACCESO AL SISTEMA</td>
				</tr>
 				<tr>
       				<td width="100" class="cabecera">Usuario&nbsp;&nbsp;</td>
       				<td bgcolor="#F1B587"><input type="text" name="usuario" id="usuario" class="Forms" onFocus="color();"></td>
				</tr>
				<tr >
   					<td class="cabecera">Clave&nbsp;&nbsp;</td>
   					<td bgcolor="#F1B587"><input type="password" name="clave" id="clave" class="Forms"></td>
				</tr>
				<TR>
					<TD colspan="2" bgcolor="#F1B587" align="center"><input type="submit" name="Aceptar" value="Aceptar" class="boton"></TD>
				<tr>
			</table>
	</td>
	</tr>
	<tr>
    	<td height="120">&nbsp;</td>
  	</tr>
	<tr>
	<td class="Mensajes"><?php if (isset($mensaje)) echo $mensaje;?></td>
	</tr>
	<tr>
	<td class="direccion">Av. Estados Unidos cruce con México,<br>frente al Centro Comercial Chilemex<br>Urb. Villa Brasil, Puerto Ordaz, Estado Bolívar</td>
	</tr>
	
	<tr>
    	<td height="30">&nbsp;</td>
  	</tr>
      
   </table>

</form>
</body>
</html>

