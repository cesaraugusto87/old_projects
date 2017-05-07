<?php
	include("../conexion/conectar.php");
?>

<?php
	if(isset($_POST['agregar'])){
			
		$id=$_REQUEST['id'];
		$descripcion=$_REQUEST['descripcion'];
		
		$result=pg_query("UPDATE condominio
							SET id='$id', descripcion='$descripcion' where id='$id'");
		
		if($result){
			echo "Condominio Actualizado";
		}
		else{
			echo "ERROR - El Condominio no pudo ser modificado";
		}
	}
	else{
		echo "ERROR - Al Realizar la Operación";
	}
?>
