<?php 
   include('../../../funciones/conexion.php');

   $conexion = Conectarse();      
   if (isset($_POST['Regresar'])){
      echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= 'BuzonAdministrador.php'";	   
	  echo "</script>";	 
	  exit;
   }
   	$mod_cart    =   $_POST['mod_cart'];
    $cantidad    =   $_POST['cantidad'];
   
   if($cantidad == ""){
      echo "<script>alert('El Campo Cantidad no Puede estar Vacio!!!!');</script>"; 
	  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= 'IngresarAmbiente.php'";	   
	  echo "</script>";	 
	  exit;
   }
   
   $sql="Select * from mod_cartucho where (idmod ='".$mod_cart."')"; 
   $resultado 			=   pg_query($sql);
   $row_resultado       =   pg_fetch_assoc($resultado);
   
   $cant= $row_resultado['cantidad'] + $cantidad;

		 $sql="UPDATE mod_cartucho SET cantidad = '".$cant."' WHERE idmod = '".$mod_cart."' ";
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
	   
?>

