<?php
include("../conexion/conectar.php");
?>

<?php
	if(isset($_POST['id'])){
			
		$id=$_REQUEST['id'];
		$id_inmueble=$_REQUEST['id_inmueble'];

		$result=pg_query("DELETE
							FROM inmuebles_condominio
							WHERE id_condominio='$id'
							AND id_inmueble='$id_inmueble'");
		
		if($result){
			echo "Inmueble Eliminado del Condominio";
		}
		else{
			echo "ERROR - El Inmueble no pudo ser eliminado del Condominio";
		}
	}
	else{
		echo "ERROR - Al Realizar la Operación";
	}
?>
