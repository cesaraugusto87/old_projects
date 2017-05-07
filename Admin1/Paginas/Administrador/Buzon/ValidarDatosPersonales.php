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
   $cedula         =   $_POST['CampoCedula'];
   $nombre         =   $_POST['CampoNombre'];
   $apellido       =   $_POST['CampoApellido'];
   $telf           =   $_POST['CampoTelf'];
   $carrera        =   $_POST['Carrera'];
   $fec_nac		   =   $_POST['CampoFecha'];
   $sexo		   =   $_POST['CampoGenero'];
   
   
   if($cedula == ""){
      echo "<script>alert('El Campo Cedula no Puede estar Vacio!!!!');</script>"; 
	  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= 'IngresarDatosPersonales.php'";	   
	  echo "</script>";	 
	  exit;
   }
   
   if($sexo == ""){
      echo "<script>alert('Especifique GENERO....');</script>"; 
	  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= 'IngresarDatosPersonales.php'";	   
	  echo "</script>";	 
	  exit;
   }
   
   if($nombre == ""){
      echo "<script>alert('El Campo NOMBRE no Puede estar Vacio!!!!');</script>"; 
	  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= 'IngresarDatosPersonales.php'";	   
	  echo "</script>";	 
	  exit;
   }
  
   if($apellido == ""){
      echo "<script>alert('El Campo APELLIDO no Puede estar Vacio!!!!');</script>"; 
	  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= 'IngresarDatosPersonales.php'";	   
	  echo "</script>";	 
	  exit;
   }
   
    if($carrera == ""){
      echo "<script>alert('El Campo CARRERA no Puede estar Vacio!!!!');</script>"; 
	  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= 'IngresarDatosPersonales.php'";	   
	  echo "</script>";	 
	  exit;
   }
   
   if($telf == ""){
      echo "<script>alert('Debe Especificar Un Telefono...!!!!');</script>"; 
	  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= 'IngresarDatosPersonales.php'";	   
	  echo "</script>";	 
	  exit;
   }

   $sql="select * from alumnos where (ci ='".$cedula."')"; 
   $resultado = pg_query($sql);
   $ifilas = pg_num_rows($resultado);
   
   if($ifilas > 0 ){
	   echo "<script>alert('El Estudiante Ya Existe!!!!');</script>"; 
	   echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	   echo "window.location.href= 'IngresarDatosPersonales.php'";	   
	   echo "</script>";
  }else{
		 $sql="INSERT INTO alumnos (ci,nombre,apellido,fecha_nac,sexo,telefono,cod_carrera) VALUES('".$cedula."','".$nombre."','".$apellido."','".$fec_nac."','".$sexo."','".$telf."','".$carrera."')";
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

