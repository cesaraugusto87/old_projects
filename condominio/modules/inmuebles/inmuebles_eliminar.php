<?php
include("../conexion/conectar.php");
?>

<?php
	if(isset($_POST['id'])){
			
		$id=$_REQUEST['id'];

		$result=pg_query("DELETE
							FROM inmuebles
							WHERE id='$id'");
		
		if($result){
			echo "Inmueble Eliminado";
		}
		else{
			echo "ERROR - El Inmueble no pudo ser eliminado";
		}
	}
	else{
		echo "ERROR - Al Realizar la Operación";
	}
?>
