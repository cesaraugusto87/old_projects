<?php
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {


  $ubicacion="imagenes/".$image_name;
  $nombre=$image_name;
  copy ($image,"../../imagenes/".$image_name);
  $insertSQL = sprintf("INSERT INTO imagen (ubicacion, nombre) VALUES (%s, %s)",
                       GetSQLValueString($ubicacion, "text"),
                       GetSQLValueString($nombre, "text"));
					   
					   

  mysql_select_db($database_afel, $afel);
  $Result1 = mysql_query($insertSQL, $afel) or die(mysql_error());

  $insertGoTo = "main_imagen.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
<?php 
   include('../../funciones/conexion.php');
   $conexion = Conectarse();   
   $rif            =   $_POST['CampoRif'];
   $nombre         =   $_POST['CampoNombre'];
   $direccion      =   $_POST['CampoDireccion'];
   $telf           =   $_POST['CampoTelf'];
   $email          =   $_POST['CampoEmail'];
   $logo           =   $_POST['CampoLogo'];	   
   $url           =   $_POST['CampoUrl'];	   
   $status         =   1;   
   $sql="select * from empresa  where (Rif ='".$rif."')"; 
   $resultado = mysql_query($sql, $conexion );
   $ifilas = mysql_affected_rows ($conexion);
   
   if($ifilas > 0 ){
	   echo "<script>alert('Ya Existe esa Empresa o Usuario!!!!');</script>"; 
	   echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	   echo "window.location.href= 'logearse.php'";	   
	   echo "</script>";	  
  }else{
       $ubicacion="imagenes/".$foto;
       copy($foto,"../imagenes/");
	   $sql="insert into empresa values('','".$nombre."','".$direccion."','".$rif."','".$telf."','".$email."','".$url."','".$logo."','".$status."')";
	   $resultado_set =  mysql_query($sql, $conexion );
	   $filas_r = mysql_affected_rows ($conexion);
		if($filas_r > 0){
			echo "<script>alert('Los datos se han INGRESADO correctamente');</script> "; 
			echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
			echo "window.location.href= 'IngresarUsuario.php?Cedula=$rif'";
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

