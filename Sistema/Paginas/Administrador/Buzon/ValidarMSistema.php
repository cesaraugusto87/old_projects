<?php 
   include('../../../funciones/conexion.php');
   include('../../../funciones/transformfecha.php');
   $conexion = Conectarse();      
   if (isset($_POST['Regresar'])){
      echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= 'BuzonAdministrador.php'";	   
	  echo "</script>";	 
	  exit;
   }
   	$cod_sis    =   $_POST['Cod_sis'];
   	$nombre     =   $_POST['Nom_sis'];
   
   if($nombre == ""){
      echo "<script>alert('El Campo NOMBRE DE SISTEMA no Puede estar Vacio!!!!');</script>"; 
	  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= 'IngresarSistema.php'";	   
	  echo "</script>";	 
	  exit;
   }
   

   $sql="select * from sistema where (idsistema ='".$cod_sis."')"; 
   $resultado = pg_query($sql);
   $ifilas = pg_num_rows($resultado);
   
   if($ifilas > 0 ){
		 $sql2= "UPDATE sistema 
	  		  SET descripcion = '".$nombre."'
			  WHERE  idsistema = '".$cod_sis."'";
	   	 $resultado_set =  pg_query($sql2);
	   	 $filas_r = pg_affected_rows ($resultado_set);
   	
		if($filas_r > 0){
			echo "<script>alert('Los datos se han INGRESADO correctamente');</script> "; 
			echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
			echo "window.location.href= 'BuzonAdministrador.php'";
			echo "</script>";
			exit;
	 	}else{
			echo "<script>alert('No se pudo GUARDAR los Datos Intente Mas tarde...');</script>";	
            echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
			echo "window.location.href= 'BuzonAdministrador.php'";
			echo "</script>";
			exit;
		}        
	}
?>

