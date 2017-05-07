<?php
include("../conexion/conectar.php");
?>

<?php
	if(isset($_POST['id'])){
			
		$id=$_REQUEST['id'];

		$result=pg_query("DELETE
							FROM clientes
							WHERE id='$id'");
		
		if($result){
			echo "Cliente Eliminado";
		}
		else{
			echo "ERROR - El Cliente no pudo ser eliminado";
		}
	}
	else{
		echo "ERROR - Al Realizar la Operación";
	}
?>
