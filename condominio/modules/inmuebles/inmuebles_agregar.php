<?php
session_start();
include("../conexion/conectar.php");
$nivel=$_SESSION['sesion']['nivel']['nivel'];
if(($nivel==0)){
?>

<?php
	echo "<h1>Ingresar Datos del Inmueble</h1>";
	
	echo
	"<form name='formulario'>
		<table align='center'>
			<tr>
				<td class=estilocelda1>ID</td>
				<td class=estilocelda2><input type='text' id='id' value='' border='1' size='40' maxlength='12'></td>	
			</tr>
			<tr>
				<td class=estilocelda1>ID Cliente</td>
				<td class=estilocelda2><input type='text' id='id_cliente' value='' border='1' size='40' maxlength='100'></td>
			</tr>
			<tr>
				<td class=estilocelda1>Tipo Inmueble</td>
				<td class=estilocelda2><input type='text' id='tipo' value='' border='1' size='40' maxlength='100'></td>
			</tr>
			<tr>
				<td align='center' colspan='2'>
					<input type='button' onclick=agregar_inmuebles(); id='registra' value='Agregar'>
				</td>
			</tr>
		</table>
	</form>";
?>
<?php
}
else{
	echo '<h1>No Posee Permisos</h1>';
}
?>
