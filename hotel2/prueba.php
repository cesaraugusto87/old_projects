<script>
function exito(){
 alert("Registro Agregado");
}
function error(){
alert("Imposible Agregar");
}
</script>
<?php 
		
		
include_once(dirname(__FILE__). "/libreria/aplicacion/Prueba.php");

	$funcionc = new Cliente();
	
//////////////////////////////////////////// 
#Prueba de Agregar
		
	$result = $funcionc->insertar();
	
		if ($result) // si se ejecuto exitosamente 
       
			echo ("inserto"); 
		else 
			echo ("no inserto");
/////////////////////////////////////////////
	

?>