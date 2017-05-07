<?php 
   include('../../../funciones/conexion.php');
   include('../../../funciones/transformfecha.php');
   $conexion = Conectarse();
   
   session_start();
   $cedula   =  $_SESSION['Usuario'];
   $Tipo     =  $_SESSION['tipo'];
   
   if (isset($_POST['Regresar'])){
      echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= 'BuzonAdministrador.php'";	   
	  echo "</script>";	 
	  exit;
   }
   $id_ini        =   $_POST['nomenclatura'].$_POST['consecutivo'];
   $num_car       =   $_POST['num_car'];
   $num_car2      =   $_POST['num_car2'];
   $estado        =   $_POST['estado'];
   $ubicacion     =   $_POST['ubicacion'];
   $nomenclatura  =   $_POST['nomenclatura'];
   $consecutivo   =   $_POST['consecutivo'];
   $mod_cart      =   $_POST['mod_cart'];
   $ciclo_ret     =   $_POST['ciclo_ret'];
   $fechaini      =   $_POST['fechaini'];
   $fechafin      =   $_POST['fechafin'];
   $fechaexp      =   $_POST['fechaexp'];
   $operador      =   $_POST['operador'];
   $observacion	  =   $_POST['observaciones'];
   $tipo	      =   $_POST['tipo'];
   $directorio    =   "../../../images/Rep_sec/".$nomenclatura."/";
   $foto          =   $id_ini.$num_car.$fechaini.$tipo.".jpg"; 
   $ruta          =   $directorio.$foto; 
   $foto_tmp      =   $_FILES["rep_sec"]["tmp_name"]; 
   

   
   if($id_ini == ""){
      echo "<script>alert('El Campo Id Inicializacion no Puede estar Vacio!!!!');</script>"; 
	  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= 'IngresarCartucho.php'";	   
	  echo "</script>";	 
	  exit;
   }
   
   if($num_car == ""){
      echo "<script>alert('El Numero de Cartucho No puede estar vacio....');</script>"; 
	  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= 'IngresarCartucho.php'";	   
	  echo "</script>";	 
	  exit;
   }
   
   if($num_car2 == ""){
      echo "<script>alert('El Numero de Cartucho No puede estar vacio....');</script>"; 
	  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= 'IngresarCartucho.php'";	   
	  echo "</script>";	 
	  exit;
   }
   
   if($estado == ""){
      echo "<script>alert('Debe Elegir un estado!!!!');</script>"; 
	  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= 'IngresarCartucho.php'";	   
	  echo "</script>";	 
	  exit;
   }
  
   if($ubicacion == ""){
      echo "<script>alert('Debe elegir una ubicacion!!!!');</script>"; 
	  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= 'IngresarCartucho.php'";	   
	  echo "</script>";	 
	  exit;
   }
   
    if($nomenclatura == ""){
      echo "<script>alert('Debe elegir una nomenclatura!!!!');</script>"; 
	  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= 'IngresarCartucho.php'";	   
	  echo "</script>";	 
	  exit;
   }
   
   if($consecutivo == ""){
      echo "<script>alert('El consecutivo dno puede estar vacio!!!!');</script>"; 
	  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= 'IngresarCartucho.php'";	   
	  echo "</script>";	 
	  exit;
   }
   
   if($mod_cart == ""){
      echo "<script>alert('Debe elegir un Mod Cartucho!!!!');</script>"; 
	  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= 'IngresarCartucho.php'";	   
	  echo "</script>";	 
	  exit;
   }
   
   if($ciclo_ret == ""){
      echo "<script>alert('Debe elegir un Ciclo de Retencion!!!!');</script>"; 
	  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= 'IngresarCartucho.php'";	   
	  echo "</script>";	 
	  exit;
   }
   
   if($fechaini == ""){
      echo "<script>alert('Debe colocar la Fecha de Inicio!!!!');</script>"; 
	  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= 'IngresarCartucho.php'";	   
	  echo "</script>";	 
	  exit;
   }
   
   if($fechaexp == ""){
      echo "<script>alert('Debe Colocar la fecha de Expiracion!!!!');</script>"; 
	  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= 'IngresarCartucho.php'";	   
	  echo "</script>";	 
	  exit;
   }
   
   if($operador == ""){
      echo "<script>alert('Debe especificar el Operador!!!!');</script>"; 
	  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= 'IngresarCartucho.php'";	   
	  echo "</script>";	 
	  exit;
   }
     
   if(is_uploaded_file($foto_tmp)){
         move_uploaded_file($foto_tmp,$ruta); 
      }
   
   $status        =  1;
   
   $sql="select * from cartuchos where (idinicializacion ='".$id_ini."' AND numero_cartuchos ='".$num_car."' AND fecha_ini ='".$fechaini."' AND tipo = '".$tipo."')"; 
   $resultado = pg_query($sql);
   $ifilas = pg_num_rows($resultado);
   
   if($ifilas > 0 ){
	   echo "<script>alert('El Cartucho que esta tratando de inicializar ya existe!!!!');</script>"; 
	   echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	   echo "window.location.href= 'IngresarCartucho.php'";	   
	   echo "</script>";
  }else{
  	if($fechafin == ""){
	   $sql="INSERT INTO cartuchos (idinicializacion,numero_cartuchos,id_estado,id_nomenclatura,consecutivo,id_mod,id_ciclo,fecha_ini,fecha_exp,operador,reporte_secuencia,id_ubicacion,num_cartucho2,observaciones,tipo) VALUES('".$id_ini."','".$num_car."','".$estado."','".$nomenclatura."','".$consecutivo."','".$mod_cart."','".$ciclo_ret."','".$fechaini."','".$fechaexp."','".$operador."','".$foto."','".$ubicacion."','".$num_car2."','".$observacion."','".$tipo."')";
	   $resultado_set =  pg_query($sql);
	   $filas_r = pg_affected_rows ($resultado_set);
	}else{
	   $sql="INSERT INTO cartuchos (idinicializacion,numero_cartuchos,id_estado,id_nomenclatura,consecutivo,id_mod,id_ciclo,fecha_ini,fecha_fin,fecha_exp,operador,reporte_secuencia,id_ubicacion,num_cartucho2,observaciones,tipo) VALUES('".$id_ini."','".$num_car."','".$estado."','".$nomenclatura."','".$consecutivo."','".$mod_cart."','".$ciclo_ret."','".$fechaini."','".$fechafin."','".$fechaexp."','".$operador."','".$foto."','".$ubicacion."','".$num_car2."','".$observacion."','".$tipo."')";
	   $resultado_set =  pg_query($sql);
	   $filas_r = pg_affected_rows ($resultado_set);
	   }
	   $sql2="Select * from mod_cartucho where (idmod ='".$mod_cart."')"; 
	   $resultado 			=   pg_query($sql2);
   	   $row_resultado       =   pg_fetch_assoc($resultado);
       
	   $cant= $row_resultado['cantidad'] - 1;
	   
  	   $sql3="UPDATE mod_cartucho SET cantidad = '".$cant."' WHERE idmod = '".$mod_cart."' ";
	   $resultado_2 =  pg_query($sql3);
	   $filas_r = pg_affected_rows ($resultado_2);
   	
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

