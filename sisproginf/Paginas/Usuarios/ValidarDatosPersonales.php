<?php 
   include('../../funciones/conexion.php');
   include('../../funciones/transformfecha.php');
   $conexion = Conectarse();      
   if (isset($_POST['Regresar'])){
      echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= 'logearse.php'";	   
	  echo "</script>";	 
	  exit;
   }
   $cedula =   $_POST['CampoCedula'];
   if($cedula == ""){
      echo "<script>alert('El Campo Cedula no Puede estar Vacio!!!!');</script>"; 
	  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= 'IngresarDatosPersonales.php'";	   
	  echo "</script>";	 
	  exit;
   }
   $directorio  = "../../images/";
   $foto        = $cedula.".jpg";  
   $ruta        = $directorio.$foto; 
   $foto_tmp    = $_FILES["CampoFoto"]["tmp_name"]; 
   //compruebo de que se haya subido la foto a la carpeta temporal 
   //luego muevo la foto al directorio de destino 
   if(is_uploaded_file($foto_tmp)){
      move_uploaded_file($foto_tmp,$ruta); 
      //este upload de archivos es muy b�sico dejo en tus manos en investigar sobre el tema 
      //para hacer upload mas restringidos 
   }
   $nacionalidad   =   $_POST['CampoNac'];	   	   
   if($nacionalidad == "0"){
      echo "<script>alert('El Campo Nacionalidad no Puede estar Vacio!!!!');</script>"; 
	  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= 'IngresarDatosPersonales.php'";	   
	  echo "</script>";	 
	  exit;
   }
   $genero         =   $_POST['CampoGenero'];
   if($genero == ""){
      echo "<script>alert('Especifique GENERO....');</script>"; 
	  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= 'IngresarDatosPersonales.php'";	   
	  echo "</script>";	 
	  exit;
   }
   $nombre         =   $_POST['CampoNombre'];
   if($nombre == ""){
      echo "<script>alert('El Campo NOMBRE no Puede estar Vacio!!!!');</script>"; 
	  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= 'IngresarDatosPersonales.php'";	   
	  echo "</script>";	 
	  exit;
   }
   $apellido       =   $_POST['CampoApellido'];
   if($apellido == ""){
      echo "<script>alert('El Campo APELLIDO no Puede estar Vacio!!!!');</script>"; 
	  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= 'IngresarDatosPersonales.php'";	   
	  echo "</script>";	 
	  exit;
   }
   $fecha          =   $_POST['CampoFecha'];   
   $edad           =   $_POST['CampoEdad'];
   $direccion      =   $_POST['CampoDireccion'];   
   $telf           =   $_POST['CampoTelf'];
   if($telf == ""){
      echo "<script>alert('Debe Especificar Un Telefono...!!!!');</script>"; 
	  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= 'IngresarDatosPersonales.php'";	   
	  echo "</script>";	 
	  exit;
   }
   $email          =   $_POST['CampoEmail'];      
   $status         =   1;   
   $sql="select * from participantes where (Cedula ='".$cedula."')"; 
   $resultado = mysql_query($sql, $conexion );
   $ifilas = mysql_affected_rows ($conexion);
   
   if($ifilas > 0 ){
	   echo "<script>alert('El Usuario Ya Existe!!!!');</script>"; 
	   echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	   echo "window.location.href= 'logearse.php'";	   
	   echo "</script>";	  
  }else{
       $sql="insert into participantes values('','".$cedula."','".$nombre."','".$apellido."','".$direccion."','".$telf."','".$foto."','".$nacionalidad."','".$genero."','".$email."','".$status."','".cambiaf_a_mysql($fecha)."','".$edad."')";
	   $resultado_set =  mysql_query($sql, $conexion );
	   $filas_r = mysql_affected_rows ($conexion);
		if($filas_r > 0){
			echo "<script>alert('Los datos se han INGRESADO correctamente');</script> "; 
			echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
			echo "window.location.href= 'IngresarUsuario.php?Cedula=$cedula&Tipo=1'";
			echo "</script>";
			exit; 
	 	}else{
      		echo "<script>alert('No se pudo GUARDAR los Datos Intente Mas tarde...');</script>";	
            echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
			echo "window.location.href= 'logearse.php'";
			echo "</script>";
			exit; 
		}        
	}	   
?>

