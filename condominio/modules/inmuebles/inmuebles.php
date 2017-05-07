<?php
session_start();
include("../conexion/conectar.php");
$nivel=$_SESSION['sesion']['nivel']['nivel'];
if(($nivel==0)){
?>

<!-- Automplete de Clientes-->
<script type="text/javascript">
	 $().ready(function(){
	  
	  	$("#id").autocomplete("modules/autocomplete/buscar_inmuebles.php", {
			width: 349,
			selectFirst: false
	    });

		$("#id").result(function(event, data, formatted) {
			if (data)
				$(this).parent().next().find("input").val(data[1]);
		});
      });
</script>

	<?php
	if(isset($_REQUEST['id'])){

		echo "<h1>Edite los Datos del Inmueble</h1>";
			
		// Recibe la Variable
		$id=$_REQUEST['id'];

		$result=pg_query("SELECT *
							FROM inmuebles
							WHERE id='$id'");
							
		$fila = pg_fetch_array($result);
		
		echo
		"<form name='formulario'>
			<table align='center'>
				<tr>
					<td class=estilocelda1>ID</td>
					<td class=estilocelda2><input type='text' id='id' readonly='yes' value='".$fila['id']."' border='1' size='40' maxlength='12'></td>
				</tr>
				<tr>
					<td class=estilocelda1>ID Cliente</td>
					<td class=estilocelda2><input type='text' id='id_cliente' value='".$fila['id_cliente']."' border='1' size='40' maxlength='100'></td>
				</tr>
				<tr>
					<td class=estilocelda1>Tipo Inmueble</td>
					<td class=estilocelda2><input type='text' id='tipo' value='".$fila['tipo']."' border='1' size='40' maxlength='100'></td>
				</tr>
				<tr>
					<td align='center' colspan='2'>
						<input type='button' onclick=editar_inmuebles(); id='registra' value='Modificar'>
					</td>
				</tr>
			</table>
		</form>";
	}
	// Muestra el Listado del Inmueble
	else{
		echo "<h1>Gestion de Inmuebles</h1>";

		// Busqueda de Clientes
		echo
		"<!--<form>
			<input type='text' size='30' value='' name='id' id='id' />
			<input type='button' name='buscar' onclick='buscar_inmuebles()' value='ID' />
		</form>-->";
		
		if(isset($_REQUEST['id'])){
			$id=$_REQUEST['id'];
			$result=pg_query("SELECT *
									FROM inmuebles
									WHERE id='$id'
									ORDER BY id");
		}
		else{
			$result=pg_query("SELECT *
								FROM inmuebles
								ORDER BY id");
		}

		echo
		"<table align='center' class='listado' height='auto' overflow='scroll'>
			<tr>
				<td class=estilocelda1><a onclick=$('#content').load('modules/inmuebles/inmuebles_agregar.php');><img src='images/add.png'/></a></td>
				<td class=estilocelda1>ID</td>
				<td class=estilocelda1>Id Cliente</td>
				<td class=estilocelda1>Tipo Inmueble</td>
			</tr>";

		while($fila = pg_fetch_array($result)){
				
			echo
			"<tr>
				<td align='center' class='estilocelda2'>
					<a onclick=$('#content').load('modules/inmuebles/inmuebles.php?id=".$fila['id']."');><img src='images/edit.png'/></a>
					<a onClick=eliminar_inmuebles('".$fila['id']."');><img src='images/delete.png'/></a>
				</td>
				<td class=estilocelda2>".$fila['id']."</td>
				<td class=estilocelda2>".$fila['id_cliente']."</td>
				<td class=estilocelda2>".$fila['tipo']."</td>
			</tr>";
		}
		echo 
		"</table>";
	}
	?>
<?php
}
else{
	echo '<h1>No Posee Permisos</h1>';
}
?>
