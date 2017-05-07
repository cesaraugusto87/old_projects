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
   $fecha          =   $_POST['CampoFecha'];   
   $direccion      =   $_POST['CampoDireccion'];   
   $telf           =   $_POST['CampoTelf'];
   $nacionalidad   =   $_POST['CampoNac'];
   $genero         =   $_POST['CampoGenero'];
   $nombre         =   $_POST['CampoNombre'];
   $representante  =   $_POST['representante'];
   $ci_rep		   =   $_POST['ci_representante'];
   $lugar_trab     =   $_POST['lugar_trab'];
   $apellido       =   $_POST['CampoApellido'];
   $email          =   $_POST['CampoEmail'];      
   
   
   if($cedula == ""){
      echo "<script>alert('El Campo Cedula no Puede estar Vacio!!!!');</script>"; 
	  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= 'IngresarDatosPersonales.php'";	   
	  echo "</script>";	 
	  exit;
   }
   	   
   if($nacionalidad == "0"){
      echo "<script>alert('El Campo Nacionalidad no Puede estar Vacio!!!!');</script>"; 
	  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= 'IngresarDatosPersonales.php'";	   
	  echo "</script>";	 
	  exit;
   }
   
   if($genero == ""){
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
      
   if($representante == ""){
      echo "<script>alert('El Campo REPRESENTANTE no Puede estar Vacio!!!!');</script>"; 
	  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= 'IngresarDatosPersonales.php'";
	  echo "</script>";	
	  exit;
   }
      
   if($ci_rep == ""){
      echo "<script>alert('El Campo CEDULA DE REPRESENTANTE no Puede estar Vacio!!!!');</script>"; 
	  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= 'IngresarDatosPersonales.php'";
	  echo "</script>";	
	  exit;
   }
   
   if($lugar_trab == ""){
      echo "<script>alert('El Campo LUGAR DE TRABAJO no Puede estar Vacio!!!!');</script>"; 
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
   
   if($telf == ""){
      echo "<script>alert('Debe Especificar Un Telefono...!!!!');</script>"; 
	  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= 'IngresarDatosPersonales.php'";	   
	  echo "</script>";	 
	  exit;
   }

   $sql="select * from estudiantes where (ci ='".$cedula."')"; 
   $resultado = mysql_query($sql, $conexion );
   $ifilas = mysql_affected_rows ($conexion);
   
   if($ifilas > 0 ){
	   echo "<script>alert('El Estudiante Ya Existe!!!!');</script>"; 
	   echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	   echo "window.location.href= 'IngresarDatosPersonales.php'";	   
	   echo "</script>";
  }else{
		 $sql="insert into pago (enero,febrero,marzo,abril,mayo,junio,julio,agosto,septiembre,octubre,noviembre,diciembre,tipo,ci_representante,idestudiante) values ('debe','debe','debe','debe','debe','debe','debe','debe','debe','debe','debe','debe','No','".$ci_rep."','".$cedula."')";
	   $resultado_set =  mysql_query($sql);
	   $filas_r = mysql_affected_rows ($conexion);
       
	   $sql="insert into estudiantes (idestudiante,nombre,apellidos,ci,direccion,telefono,nacionalidad,genero,email,representante,ci_representante,lugar_trab) values ('".$cedula."','".$nombre."','".$apellido."','".$cedula."','".$direccion."','".$telf."','".$nacionalidad."','".$genero."','".$email."','".$representante."','".$ci_rep."','".$lugar_trab."')";
	   $resultado_set =  mysql_query($sql);
	   $filas_r = mysql_affected_rows ($conexion);
	   
		
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

