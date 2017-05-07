<?php
	include("../conexion/conectar.php");
?>

<?php
	if(isset($_POST['agregar'])){
		$id=$_REQUEST['id'];
		$nombre=$_REQUEST['nombre'];
		
		$result=pg_query("INSERT INTO condominio
							(id,descripcion)
							values ('$id','$descripcion')");
		

		
		if($result){
			echo "Condominio Insertado Correctamente";
		}
		else{
			echo "ERROR - El Condominio no pudo ser insertado";
		}
	}
	else{
		echo "ERROR - Al Realizar la Operación";
	}
?>
