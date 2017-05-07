<?php
	include("../conexion/conectar.php");

	if(isset($_REQUEST['q'])){
		$queryString = $_REQUEST['q'];
		if(strlen($queryString) >0){
			$query = mysql_query("SELECT * FROM planchas WHERE descripcion LIKE '%$queryString%' LIMIT 10");
			if($query){
				while ($result = mysql_fetch_array($query)){
					$descripcion = utf8_encode($result['descripcion']);
	        		echo "$descripcion\n";
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
