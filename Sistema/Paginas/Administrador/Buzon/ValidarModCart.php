<?php 
   include('../../../funciones/conexion.php');

   $conexion = Conectarse();      
   if (isset($_POST['Regresar'])){
      echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= 'BuzonAdministrador.php'";	   
	  echo "</script>";	 
	  exit;
   }
   	$Id_mod   =   $_POST['Id_mod'];
    $Uni_resp    =   $_POST['Uni_resp'];
   
   if($Id_mod == ""){
      echo "<script>alert('El Campo Id Mod  no Puede estar Vacio!!!!');</script>"; 
	  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= 'IngresarAmbiente.php'";	   
	  echo "</script>";	 
	  exit;
   }
   

   $sql="Select * from mod_cartucho where (idmod ='".$Id_mod."')"; 
   $resultado = pg_query($sql);
   $ifilas = pg_num_rows($resultado);
   
   if($ifilas > 0 ){
	   echo "<script>alert('El Id del modelo Ya Existe!!!!');</script>"; 
	   echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	   echo "window.location.href= 'IngresarModCart.php'";	   
	   echo "</script>";
  }else{
		 $sql="INSERT INTO mod_cartucho (idmod,unidad_resp) VALUES('".$Id_mod."','".$Uni_resp."')";
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

