<?php
session_start();
include("../conexion/conectar.php");
$nivel=$_SESSION['sesion']['nivel']['nivel'];
if(($nivel==0)){
?>

<!-- Automplete de Clientes-->
<script type="text/javascript">
	 $().ready(function(){
	  
	  	$("#id").autocomplete("modules/autocomplete/buscar_inmuebles_condominio.php", {
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
		$id_inmueble=$_REQUEST['id_inmueble'];
		
		$result=pg_query("SELECT *
							FROM inmuebles_condominio,condominio,inmuebles
							WHERE condominio.id=inmuebles_condominio.id_condominio
							AND inmuebles.id=inmuebles_condominio.id_inmueble
							ORDER BY inmuebles_condominio.id_condominio");
						
		$fila = pg_fetch_array($result);
		
		echo
		"<form name='formulario'>
			<table align='center'>
				<tr>
					<td class=estilocelda1>ID Condominio</td>
					<td class=estilocelda2><input type='text' id='id' readonly='yes' value='".$fila['id_condominio']."' border='1' size='40' maxlength='12'></td>
				</tr>
				<tr>
					<td class=estilocelda1>ID Inmueble</td>
					<td class=estilocelda2><input type='text' id='id_inmueble' value='".$fila['id_inmueble']."' border='1' size='40' maxlength='100'></td>
				</tr>
				<tr>
					<td align='center' colspan='2'>
						<input type='button' onclick=editar_inmuebles_condominio(); id='registra' value='Modificar'>
					</td>
				</tr>
			</table>
		</form>";
	}
	// Muestra el Listado del Inmueble por condominio
	else{
		echo "<h1>Gestion de Inmuebles por Condominio</h1>";
		
		// Consulta de Inmuebles por condominio
		$result=pg_query("SELECT *
							FROM inmuebles_condominio,condominio,inmuebles
							WHERE condominio.id=inmuebles_condominio.id_condominio
							AND inmuebles.id=inmuebles_condominio.id_inmueble
							ORDER BY inmuebles_condominio.id_condominio");
		
		echo
		"<table align='center' class='listado' height='auto' overflow='scroll'>
			<tr>
				<td class=estilocelda1><a onclick=$('#content').load('modules/inmuebles_condominio/inmuebles_condominio_agregar.php');><img src='images/add.png'/></a></td>
				<td class=estilocelda1>ID Condominio</td>
				<td class=estilocelda1>Descripción Condominio</td>
				<td class=estilocelda1>Id Inmueble</td>
				<td class=estilocelda1>Id Cliente</td>
			</tr>";

		while($fila = pg_fetch_array($result)){
				
			echo
			"<tr>
				<td align='center' class='estilocelda2'>
					<a onclick=$('#content').load('modules/inmuebles_condominio/inmuebles_condominio.php?id=".$fila['id_condominio']."&id_inmueble=".$fila['id_inmueble']."');><img src='images/edit.png'/></a>
					<a onClick=eliminar_inmuebles_condominio('".$fila['id_condominio']."','".$fila['id_inmueble']."');><img src='images/delete.png'/></a>
				</td>
				<td class=estilocelda2>".$fila['id_condominio']."</td>
				<td class=estilocelda2>".$fila['descripcion']."</td>
				<td class=estilocelda2>".$fila['id_inmueble']."</td>
				<td class=estilocelda2>".$fila['id_cliente']."</td>
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
