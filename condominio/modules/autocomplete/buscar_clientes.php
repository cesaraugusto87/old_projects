<?php
	include("../conexion/conectar.php");
?>

<?php
	if(isset($_REQUEST['q'])){
		$queryString = $_REQUEST['q'];
		if(strlen($queryString) >0){
			$query = pg_query("SELECT * FROM clientes WHERE id LIKE '%$queryString%' OR nombre LIKE '%$queryString%' LIMIT 10");
			if($query){
				while ($result = pg_fetch_array($query)){
					$id = $result['id'];
					$nombre = $result['nombre'];
	        		echo "$id- $nombre\n";
	       		}
			}
			else {
				echo 'ERROR: Problemas con la Conexion';
			}
		}
	}
	else{
		echo 'ERROR: No Existen Parametros de Busqueda';
	}
?>
