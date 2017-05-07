<?php
	session_start();
	$mensaje = array('titulo'=>'-','descripcion'=>'-');
	if(isset($_SESSION['mensaje']))
	{
		$mensaje['titulo']=$_SESSION['mensaje']['titulo'];
		$mensaje['descripcion']=$_SESSION['mensaje']['descripcion'];
		unset($_SESSION['mensaje']);
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>.: Sistema de Condominio</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

	<!-- CSS -->
	<link rel="stylesheet" type="text/css" media="screen" href="css/style.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="css/jquery.autocomplete.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="css/jquery.alerts.css" />
	
	<!-- Js -->
	<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
	<script type="text/javascript" src="js/jquery.autocomplete.pack.js"></script>
	<script type="text/javascript" src="js/jquery.alerts.js"></script>
	<script type="text/javascript" src='js/menu.js'></script>
	<script type="text/javascript" src='js/funciones.js'></script>
</head>
<body onload="notificar_mensaje('<?php echo $mensaje['titulo']; ?>','<?php echo $mensaje['descripcion']; ?>');">
<!-- Centrado del Contenido-->
<div align="center">

<!-- Válida si El Usuario esta Logueado para Acceder a esta Área -->
<?php
if (isset($_SESSION['sesion'])){
	$nivel=$_SESSION['sesion']['nivel']['nivel'];
	$login=$_SESSION['sesion']['usuario']['usuario'];
?>

	<!-- Banner/Logo Principal -->
	<div id="banner" align="center">
		<img src="images/condominio.gif" width="" height="" border="0" alt=""/>
	</div>

	<!-- Usuario Logueado -->
	<div class="espacio" align="right" style="background:#CCC;height:19px;">
		<b><img src="images/login.png" /> <?php echo $login; ?></b> | <a href="modules/acceso/salir.php">Cerrar Sesión</a></p>
	</div>

	<!-- Menu Principal -->
	<?php include 'menu.php' ?>

	<!-- Page -->
	<div id="page">
		<!-- Content -->
		<div id="content" align="center">
			<script type="text/javascript">$("#content").load("modules/inicio.html");</script>
		</div>
	</div>

	<!-- Pie de Pagina -->
	<div id="footer">
		<div class="footer_text">
			<b>Elaborado Por:</b> Administración de la Información I
		</div>
	</div>
<?php
}
else{
?>
	<!-- Banner/Logo Principal -->
	<div id="banner" align="center">
		<img src="images/condominio.gif" width="" height="" border="0" alt=""/>
	</div>

	<!-- Formulario de Login -->
	<form id="form_login" name="form_login" class="formulario" method='post' action='modules/acceso/loguea.php' style="width:50%;height:auto;margin-top:30px;margin-left:25%;">
	
	<table border="0" align="center" width="90%" cellspacing="10">
		<tr>
			<td align="center" colspan="2" style="background:#CCC;"><b>Acceso al</b> <strong style="color:red;">Sistema de Condominio</strong></p></td>
		</tr>
		<tr>
			<td class='celda1' align='right' width="42%"><strong>Usuario</strong></td>
			<td class='celda2' align='left'><input type='text' name='login' id='login' value='' autocomplete='off' border='1' size='12' maxlength='60'></td>
		</tr>
		<tr>
			<td class='celda1' align='right'><strong>Clave</strong></td>
			<td class='celda2' align='left'><input type='password' name='clave' id='clave' value='' autocomplete='off' border='1' size='12' maxlength='60'></td>
		</tr>
		<tr>
			<td align='center' colspan='2'><input type='submit' name='entrar' value='Entrar'/></td>
		</td>
	</table>
	</form>
<?php
}
?>
<!-- Fin Centrado del Contenido-->
</div>
</body>
</html>
