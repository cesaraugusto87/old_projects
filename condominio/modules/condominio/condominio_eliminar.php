<?php
include("../conexion/conectar.php");
?>

<?php
	if(isset($_POST['id'])){
			
		$id=$_REQUEST['id'];

		$result=pg_query("DELETE
							FROM condominio
							WHERE id='$id'");
		
		if($result){
			echo "Condominio Eliminado";
		}
		else{
			echo "ERROR - El Condominio no pudo ser eliminado";
		}
	}
	else{
		echo "ERROR - Al Realizar la Operación";
	}
?>
