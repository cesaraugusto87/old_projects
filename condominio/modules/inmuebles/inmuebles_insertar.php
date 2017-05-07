<?php
	include("../conexion/conectar.php");
?>

<?php
	if(isset($_POST['agregar'])){
		$id=$_REQUEST['id'];
		$id_cliente=$_REQUEST['id_cliente'];
		$tipo=$_REQUEST['tipo'];
		
		$result=pg_query("INSERT
							INTO inmuebles
							(id,id_cliente,tipo)
							values ('$id','$id_cliente','$tipo')");
		

		
		if($result){
			echo "Inmueble Insertado Correctamente";
		}
		else{
			echo "ERROR - El Inmueble no pudo ser insertado";
		}
	}
	else{
		echo "ERROR - Al Realizar la Operación";
	}
?>
