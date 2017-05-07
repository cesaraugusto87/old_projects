<?php 
		
		
include_once(dirname(__FILE__). "/libreria/aplicacion/Empleado.php");

	$funcionc = new Empleado();
	
//////////////////////////////////////////// 
#Prueba de Agregar
		
	$result = $funcionc->insertar();
	
		if ($result) // si se ejecuto exitosamente 
       
			echo ("inserto"); 
		else 
			echo ("no inserto");
/////////////////////////////////////////////
	

?>
