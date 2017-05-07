<?php
	include("../conexion/conectar.php");
?>

<?php
	if(isset($_POST['agregar'])){
			
		$id=$_REQUEST['id'];
		$id_inmueble=$_REQUEST['id_inmueble'];
		
		$result=pg_query("UPDATE inmuebles_condominio
							SET id_condominio='$id', id_inmueble='$id_inmueble'
							WHERE id_condominio='$id'
							AND id_inmueble='$id_inmueble'");
		
		if($result){
			echo "Inmueble Actualizado en el condominio";
		}
		else{
			echo "ERROR - El Inmueble no pudo ser modificado en el condominio";
		}
	}
	else{
		echo "ERROR - Al Realizar la Operación";
	}
?>
