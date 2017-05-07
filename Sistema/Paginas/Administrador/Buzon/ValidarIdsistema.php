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
   $nomenclatura   =   $_POST['nomenclatura'];
   $ambiente       =   $_POST['ambiente'];
   $sistema        =   $_POST['sistema'];
   $frecuencia     =   $_POST['frecuencia'];
   $estante        =   $_POST['estante'];
   $cuerpo		   =   $_POST['cuerpo'];
   $tramo		   =   $_POST['tramo'];
   
   
  
 
    if($ambiente == ""){
      echo "<script>alert('Debe Elejir el Ambiente!!!!');</script>"; 
	  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= 'IngresarDatosProfesor.php'";	   
	  echo "</script>";	 
	  exit;
   }
   
   if($sistema == ""){
      echo "<script>alert('Debe Especificar el SISTEMA....');</script>"; 
	  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= 'IngresarDatosProfesor.php'";	   
	  echo "</script>";	 
	  exit;
   }
   
   if($frecuencia == ""){
      echo "<script>alert('Debe Especificar la Frecuencia!!!!');</script>"; 
	  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= 'IngresarDatosProfesor.php'";	   
	  echo "</script>";	 
	  exit;
   }
  
   if($estante == ""){
      echo "<script>alert('El Campo ESTANTE no Puede estar Vacio!!!!');</script>"; 
	  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= 'IngresarDatosProfesor.php'";	   
	  echo "</script>";	 
	  exit;
   }
   
    if($cuerpo == ""){
      echo "<script>alert('El Campo CUERPO no Puede estar Vacio!!!!');</script>"; 
	  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= 'IngresarDatosProfesor.php'";	   
	  echo "</script>";	 
	  exit;
   }
   
   if($tramo == ""){
      echo "<script>alert('Debe Especificar El Tramo...!!!!');</script>"; 
	  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= 'IngresarDatosProfesor.php'";	   
	  echo "</script>";	 
	  exit;
   }

   $sql="select * from id_sistema where (idnomenclatura ='".$nomenclatura."')"; 
   $resultado = pg_query($sql);
   $ifilas = pg_num_rows($resultado);
   
   if($ifilas > 0 ){
	   echo "<script>alert('La Nomenclatura Ya Existe!!!!');</script>"; 
	   echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	   echo "window.location.href= 'IngresarCartucho.php'";	   
	   echo "</script>";
  }else{
		 $sql="INSERT INTO id_sistema (idnomenclatura,id_ambiente,id_sistema,id_frecuencia,estante,cuerpo,tramo) VALUES('".$nomenclatura."','".$ambiente."','".$sistema."','".$frecuencia."','".$estante."','".$cuerpo."','".$tramo."')";
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

