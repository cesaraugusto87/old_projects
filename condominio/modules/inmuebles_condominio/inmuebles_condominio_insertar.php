<?php
	include("../conexion/conectar.php");
?>

<?php
	if(isset($_POST['agregar'])){
		$id=$_REQUEST['id'];
		$id_inmueble=$_REQUEST['id_inmueble'];
		
		$result=pg_query("INSERT
							INTO inmuebles_condominio
							(id_condominio,id_inmueble)
							values ('$id','$id_inmueble')");
		

		
		if($result){
			echo "Inmueble Insertado Correctamente en el condominio";
		}
		else{
			echo "ERROR - El Inmueble no pudo ser insertado en el condominio";
		}
	}
	else{
		echo "ERROR - Al Realizar la Operación";
	}
?>
