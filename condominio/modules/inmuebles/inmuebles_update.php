<?php
	include("../conexion/conectar.php");
?>

<?php
	if(isset($_POST['agregar'])){
			
		$id=$_REQUEST['id'];
		$id_cliente=$_REQUEST['id_cliente'];
		$tipo=$_REQUEST['tipo'];
		
		$result=pg_query("UPDATE inmuebles
							SET id='$id', id_cliente='$id_cliente', tipo='$tipo'
							WHERE id='$id'");
		
		if($result){
			echo "Inmueble Actualizado";
		}
		else{
			echo "ERROR - El Inmueble no pudo ser modificado";
		}
	}
	else{
		echo "ERROR - Al Realizar la Operación";
	}
?>
