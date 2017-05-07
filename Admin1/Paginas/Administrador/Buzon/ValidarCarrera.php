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
   	$cod_carrera    =   $_POST['Cod_carrera'];
    $nombre         =   $_POST['Nom_carrera'];
   
   
   if($cod_carrera == ""){
      echo "<script>alert('El Campo CODIGO DE CARRERA no Puede estar Vacio!!!!');</script>"; 
	  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= 'IngresarCarrera.php'";	   
	  echo "</script>";	 
	  exit;
   }
   
   if($nombre == ""){
      echo "<script>alert('El Campo NOMBRE DE CARRERA no Puede estar Vacio!!!!');</script>"; 
	  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= 'IngresarCarrera.php'";	   
	  echo "</script>";	 
	  exit;
   }
   

   $sql="select * from carreras where (cod_carrera ='".$cod_carrera."')"; 
   $resultado = pg_query($sql);
   $ifilas = pg_num_rows($resultado);
   
   if($ifilas > 0 ){
	   echo "<script>alert('El Codigo de Carrera Ya Existe!!!!');</script>"; 
	   echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	   echo "window.location.href= 'IngresarCarrera.php'";	   
	   echo "</script>";
  }else{
		 $sql="INSERT INTO carreras (cod_carrera,descripcion) VALUES('".$cod_carrera."','".$nombre."')";
	   	 $resultado_set =  pg_query($sql);
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

