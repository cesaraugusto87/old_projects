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
   $plomo      	    =   $_POST['plomo'];
   $planilla        =   $_POST['planilla'];
   $hora            =   $_POST['hora'];
   $ubicacion       =   $_POST['ubicacion'];
   $fecharet        =   $_POST['fecharet'];
   $fechaenv        =   $_POST['fechaenv'];
   $num_cartucho    =   $_POST['num_cartucho'];
   $id_ini          =   $_POST['id_ini'];

   
   
   if($plomo == ""){
      echo "<script>alert('El Campo Plomo no Puede estar Vacio!!!!');</script>"; 
	  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= 'IngresarPrestamo.php'";	   
	  echo "</script>";	 
	  exit;
   }
   
   if($planilla == ""){
      echo "<script>alert('El Nº de Planilla No puede estar vacio....');</script>"; 
	  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= 'IngresarPrestamo.php'";	   
	  echo "</script>";	 
	  exit;
   }
   
   if($hora == ""){
      echo "<script>alert('Debe Colocar la Hora!!!!');</script>"; 
	  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= 'IngresarPrestamo.php'";	   
	  echo "</script>";	 
	  exit;
   }
  
   if($fecharet == ""){
      echo "<script>alert('La Fecha de Retiro no Puede estar Vacia!!!!');</script>"; 
	  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= 'IngresarPrestamo.php'";	   
	  echo "</script>";	 
	  exit;
   }
   
    if($fechaenv == ""){
      echo "<script>alert('La Fecha de Envio no Puede estar Vacia!!!!');</script>"; 
	  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= 'IngresarPrestamo.php'";	   
	  echo "</script>";	 
	  exit;
   }
   
    if($num_cartucho == ""){
      echo "<script>alert('El Numero de Cartucho no Puede estar Vacio!!!!');</script>"; 
	  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= 'IngresarPrestamo.php'";	   
	  echo "</script>";	 
	  exit;
   }
   
    if($ubicacion == ""){
      echo "<script>alert('Debe elegir una Ubicacion!!!!');</script>"; 
	  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= 'IngresarPrestamo.php'";	   
	  echo "</script>";	 
	  exit;
   }
   
    if($id_ini == ""){
      echo "<script>alert('El Id de inicializacion no Puede estar Vacio!!!!');</script>"; 
	  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= 'IngresarPrestamo.php'";	   
	  echo "</script>";	 
	  exit;
   }
   
   $sql="select * from prestamo where (idplomo ='".$plomo."')"; 
   $resultado = pg_query($sql);
   $ifilas = pg_num_rows($resultado);
   
   if($ifilas > 0 ){
	   echo "<script>alert('El plomo que esta tratando de registrar ya existe!!!!');</script>"; 
	   echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	   echo "window.location.href= 'IngresarPrestamo.php'";	   
	   echo "</script>";
  }else{
	   
	   $sql="INSERT INTO prestamo (idplomo,n_planilla,fecha_retiro,hora,fecha_envio) VALUES('".$plomo."','".$planilla."','".$fecharet."','".$hora."','".$fechaenv."')";
	   $resultado_set =  pg_query($sql);
	   $filas_r = pg_affected_rows ($resultado_set);
   	
	   $sql1="INSERT INTO cartuchos_prestamo (numero_cartuchos,id_inicializacion,id_plomo,id_ubicacion,id_estado) VALUES('".$num_cartucho."','".$id_ini."','".$plomo."','".$ubicacion."',1)";
	   $resultado_set1 =  pg_query($sql1);
	   $filas_r1 = pg_affected_rows ($resultado_set1);
	 
	   $sql2="UPDATE CARTUCHOS SET id_estado = 1 where idinicializacion = '".$id_ini."' AND numero_cartuchos = '".$num_cartucho."' ";
	   $resultado_set2 =  pg_query($sql2);
	   $filas_r2 = pg_affected_rows ($resultado_set2);
	
		if($filas_r > 0 && $filas_r1 > 0){
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

