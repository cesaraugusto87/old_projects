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
   	$cod_est    =   $_POST['Cod_est'];
    $nombre         =   $_POST['Nom_est'];
   
   
   if($cod_est == ""){
      echo "<script>alert('El Campo CODIGO DE ESTADO no Puede estar Vacio!!!!');</script>"; 
	  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= 'IngresarEstado.php'";	   
	  echo "</script>";	 
	  exit;
   }
   
   if($nombre == ""){
      echo "<script>alert('El Campo ESTADO no Puede estar Vacio!!!!');</script>"; 
	  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= 'IngresarEstado.php'";	   
	  echo "</script>";	 
	  exit;
   }
   

   $sql="Select * from estado_cartucho where (idestado ='".$cod_est."')"; 
   $resultado = pg_query($sql);
   $ifilas = pg_num_rows($resultado);
   
   if($ifilas > 0 ){
	   echo "<script>alert('El Codigo de Estado Ya Existe!!!!');</script>"; 
	   echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	   echo "window.location.href= 'IngresarEstado.php'";	   
	   echo "</script>";
  }else{
		 $sql="INSERT INTO estado_cartucho (idestado,descripcion) VALUES('".$cod_est."','".$nombre."')";
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

