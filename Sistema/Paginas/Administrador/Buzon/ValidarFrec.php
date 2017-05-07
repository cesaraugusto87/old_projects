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
   	$cod_frec    =   $_POST['Cod_frec'];
    $nombre         =   $_POST['Nom_frec'];
   
   
   if($cod_frec == ""){
      echo "<script>alert('El Campo CODIGO DE FRECUENCIA no Puede estar Vacio!!!!');</script>"; 
	  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= 'IngresarFrec.php'";	   
	  echo "</script>";	 
	  exit;
   }
   
   if($nombre == ""){
      echo "<script>alert('El Campo FRECUENCIA no Puede estar Vacio!!!!');</script>"; 
	  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= 'IngresarFrec.php'";	   
	  echo "</script>";	 
	  exit;
   }
   

   $sql="Select * from frecuencia where (idfrecuencia ='".$cod_frec."')"; 
   $resultado = pg_query($sql);
   $ifilas = pg_num_rows($resultado);
   
   if($ifilas > 0 ){
	   echo "<script>alert('El Codigo de Frecuencia Ya Existe!!!!');</script>"; 
	   echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	   echo "window.location.href= 'IngresarFrec.php'";	   
	   echo "</script>";
  }else{
		 $sql="INSERT INTO Frecuencia (idfrecuencia,frecuencia) VALUES('".$cod_frec."','".$nombre."')";
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

