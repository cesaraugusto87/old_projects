<?php
session_start();
include("../conexion/conectar.php");
$nivel=$_SESSION['sesion']['nivel']['nivel'];
if(($nivel==0)){
?>

<?php
	echo "<h1>Ingresar Datos del Condominio</h1>";
	
	echo
	"<form name='formulario'>
		<table align='center'>
			<tr>
				<td class=estilocelda1>ID</td>
				<td class=estilocelda2><input type='text' id='id' value='' border='1' size='40' maxlength='12'></td>	
			</tr>
			<tr>
				<td class=estilocelda1>Descripción</td>
				<td class=estilocelda2><input type='text' id='descripcion' value='' border='1' size='40' maxlength='100'></td>
			</tr>
			<tr>
				<td align='center' colspan='2'>
					<input type='button' onclick=agregar_condominio(); id='registra' value='Agregar'>
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
