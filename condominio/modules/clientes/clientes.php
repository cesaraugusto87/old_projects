<?php
session_start();
include("../conexion/conectar.php");
$nivel=$_SESSION['sesion']['nivel']['nivel'];
if(($nivel==0)){
?>

<!-- Automplete de Clientes-->
<script type="text/javascript">
	 $().ready(function(){
	  
	  	$("#id").autocomplete("modules/autocomplete/buscar_clientes.php", {
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

		echo "<h1>Edite los Datos del Cliente</h1>";
			
		// Recibe la Variable
		$id=$_REQUEST['id'];

		$result=pg_query("SELECT *
							FROM clientes
							WHERE id='$id'");
							
		$fila = pg_fetch_array($result);
		
		echo
		"<form name='formulario'>
			<table align='center'>
				<tr>
					<td class=estilocelda1>ID</td>
					<td class=estilocelda2><input type='text' id='id' readonly='yes' value='".$fila[0]."' border='1' size='40' maxlength='12'></td>
				</tr>
				<tr>
					<td class=estilocelda1>Nombre</td>
					<td class=estilocelda2><input type='text' id='nombre' value='".$fila[1]."' border='1' size='40' maxlength='100'></td>
				</tr>
				<tr>
					<td align='center' colspan='2'>
						<input type='button' onclick=editar_clientes(); id='registra' value='Modificar'>
					</td>
				</tr>
			</table>
		</form>";
	}
	// Muestra el Listado del Cliente
	else{
		echo "<h1>Gestion de Clientes</h1>";

		// Busqueda de Clientes
		echo
		"<!--<form>
			<input type='text' size='30' value='' name='id' id='id' />
			<input type='button' name='buscar' onclick='buscar_clientes()' value='ID' />
		</form>-->";
		
		if(isset($_REQUEST['id'])){
			$id=$_REQUEST['id'];
			$result=pg_query("SELECT *
									FROM clientes
									WHERE id='$id'
									ORDER BY nombre");
		}
		else{
			$result=pg_query("SELECT *
								FROM clientes
								ORDER BY nombre");
		}

		echo
		"<table align='center' class='listado' height='auto' overflow='scroll'>
			<tr>
				<td class=estilocelda1><a onclick=$('#content').load('modules/clientes/clientes_agregar.php');><img src='images/add.png'/></a></td>
				<td class=estilocelda1>ID</td>
				<td class=estilocelda1>Nombre</td>
			</tr>";

		while($fila = pg_fetch_array($result)){
				
			echo
			"<tr>
				<td align='center' class='estilocelda2'>
					<a onclick=$('#content').load('modules/clientes/clientes.php?id=".$fila['id']."');><img src='images/edit.png'/></a>
					<a onClick=eliminar_clientes('".$fila['id']."');><img src='images/delete.png'/></a>
				</td>
				<td class=estilocelda2>".$fila['id']."</td>
				<td class=estilocelda2>".$fila['nombre']."</td>
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
