<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>

<?php
if (isset($_SESSION['sesion'])){
	$nivel=$_SESSION['sesion']['nivel']['nivel'];
	$login=$_SESSION['sesion']['usuario']['usuario'];
?>

<!-- Menu Administrador -->
<div id="menu">
	<ul id="nav">
		<li><a href='#' onClick="$('#content').load('modules/inicio.html');">Inicio</a></li>
		
		<!-- Gestion de los Sistemas -->
		<?php
		if (($nivel==0))
		{
		?>
			<li><a href='#' onClick="$('#content').load('modules/clientes/clientes.php');">Clientes</a></li>
			<li><a href='#' onClick="$('#content').load('modules/inmuebles/inmuebles.php');">Inmuebles</a></li>
			<li><a href='#' onClick="$('#content').load('modules/condominio/condominio.php');">Condominio</a></li>
			<li><a href='#' onClick="$('#content').load('modules/inmuebles_condominio/inmuebles_condominio.php');">Inmuebles por Condominio</a></li>
		<?php 
		}
		?>
	</ul>
</div>
<!-- /menu -->

<?php 
}
?>

</body>
</html>

