<?php
	include("../conexion/conectar.php");
?>

<?php
	if(isset($_POST['agregar'])){
			
		$id=$_REQUEST['id'];
		$nombre=$_REQUEST['nombre'];
		
		$result=pg_query("UPDATE clientes
							SET id='$id', nombre='$nombre' where id='$id'");
		
		if($result){
			echo "Cliente Actualizado";
		}
		else{
			echo "ERROR - El Cliente no pudo ser modificado";
		}
	}
	else{
		echo "ERROR - Al Realizar la Operación";
	}
?>
