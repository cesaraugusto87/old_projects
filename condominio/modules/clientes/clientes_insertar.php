<?php
	include("../conexion/conectar.php");
?>

<?php
	if(isset($_POST['agregar'])){
		$id=$_REQUEST['id'];
		$nombre=$_REQUEST['nombre'];
		
		$result=pg_query("INSERT INTO clientes
							(id,nombre)
							values ('$id','$nombre')");
		

		
		if($result){
			echo "Cliente Insertado Correctamente";
		}
		else{
			echo "ERROR - El Cliente no pudo ser insertado";
		}
	}
	else{
		echo "ERROR - Al Realizar la Operación";
	}
?>
