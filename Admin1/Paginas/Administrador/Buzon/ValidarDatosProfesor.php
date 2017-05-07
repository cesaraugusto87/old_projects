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
   $asignatura     =   $_POST['materia'];
   
   
   if($cedula == ""){
      echo "<script>alert('El Campo Cedula no Puede estar Vacio!!!!');</script>"; 
	  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= 'IngresarDatosProfesor.php'";	   
	  echo "</script>";	 
	  exit;
   }
   
    if($asignatura == ""){
      echo "<script>alert('El Campo Asignatura no Puede estar Vacio!!!!');</script>"; 
	  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= 'IngresarDatosProfesor.php'";	   
	  echo "</script>";	 
	  exit;
   }
   
   if($sexo == ""){
      echo "<script>alert('Especifique GENERO....');</script>"; 
	  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= 'IngresarDatosProfesor.php'";	   
	  echo "</script>";	 
	  exit;
   }
   
   if($nombre == ""){
      echo "<script>alert('El Campo NOMBRE no Puede estar Vacio!!!!');</script>"; 
	  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= 'IngresarDatosProfesor.php'";	   
	  echo "</script>";	 
	  exit;
   }
  
   if($apellido == ""){
      echo "<script>alert('El Campo APELLIDO no Puede estar Vacio!!!!');</script>"; 
	  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= 'IngresarDatosProfesor.php'";	   
	  echo "</script>";	 
	  exit;
   }
   
    if($carrera == ""){
      echo "<script>alert('El Campo CARRERA no Puede estar Vacio!!!!');</script>"; 
	  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= 'IngresarDatosProfesor.php'";	   
	  echo "</script>";	 
	  exit;
   }
   
   if($telf == ""){
      echo "<script>alert('Debe Especificar Un Telefono...!!!!');</script>"; 
	  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= 'IngresarDatosProfesor.php'";	   
	  echo "</script>";	 
	  exit;
   }

   $sql="select * from profesores where (ci ='".$cedula."')"; 
   $resultado = pg_query($sql);
   $ifilas = pg_num_rows($resultado);
   
   if($ifilas > 0 ){
	   echo "<script>alert('El Profesor Ya Existe!!!!');</script>"; 
	   echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	   echo "window.location.href= 'IngresarDatosProfesor.php'";	   
	   echo "</script>";
  }else{
		 $sql="INSERT INTO profesores (ci,cod_asignatura,cod_carrera,nombre,apellido,fecha_nac,sexo,telefono) VALUES('".$cedula."','".$asignatura."','".$carrera."','".$nombre."','".$apellido."','".$fec_nac."','".$sexo."','".$telf."')";
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

