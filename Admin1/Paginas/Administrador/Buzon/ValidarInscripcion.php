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
   $asignatura     =   $_POST['materia'];
   
   
   if($cedula == ""){
      echo "<script>alert('El Campo Cedula no Puede estar Vacio!!!!');</script>"; 
	  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= 'IngresarInscripcion.php'";	   
	  echo "</script>";	 
	  exit;
   }
   
    if($asignatura == ""){
      echo "<script>alert('El Campo Asignatura no Puede estar Vacio!!!!');</script>"; 
	  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= 'IngresarInscripcion.php'";	   
	  echo "</script>";	 
	  exit;
   }

   $sql="select * from reg_academico where (ci_est ='".$cedula."' AND cod_asignatura = '".$asignatura."')"; 
   $resultado = pg_query($sql);
   $ifilas = pg_num_rows($resultado);
   
   if($ifilas > 0 ){
	   echo "<script>alert('Esta Inscripcion Ya Existe!!!!');</script>"; 
	   echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	   echo "window.location.href= 'IngresarInscripcion.php'";	   
	   echo "</script>";
  }else{
  		$sql="SELECT * FROM profesores WHERE cod_asignatura = '".$asignatura."'";
	   $resultado_set =  pg_query($sql);
	   $row      =   pg_fetch_assoc($resultado_set); 
	   $ci_prof = $row['ci'];
	   
		 $sql="INSERT INTO reg_academico (ci_est,cod_asignatura,ci_prof,nota) VALUES('".$cedula."','".$asignatura."','".$ci_prof."',1)";
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

