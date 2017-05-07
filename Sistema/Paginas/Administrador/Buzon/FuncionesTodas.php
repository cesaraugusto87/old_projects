<?php 

include('../../../funciones/conexion.php');

$conexion = Conectarse();

$act = $_GET['act'];
$cartucho = $_GET['cartucho'];
$num = $_GET['num'];
$fecha = $_GET['fecha'];
$tipo = $_GET['tipo'];
$mod_cart = $_GET['mod_car'];


if ($act == 'E'){

$sql = "DELETE FROM cartuchos WHERE idinicializacion = '".$cartucho."' AND numero_cartuchos = '".$num."' AND fecha_ini = '".$fecha."' AND tipo = '".$tipo."'";
$resultado_set =  pg_query($sql);
$filas_r = pg_affected_rows ($resultado_set);
 
$sql2="Select * from mod_cartucho where (idmod ='".$mod_cart."')"; 

$resultado           =   pg_query($sql2);
$row_resultado       =   pg_fetch_assoc($resultado);
       
$cant= $row_resultado['cantidad'] + 1;

$sql3="UPDATE mod_cartucho SET cantidad = '".$cant."' WHERE idmod = '".$mod_cart."' ";
$resultado_2 =  pg_query($sql3);
$filas_r1 = pg_affected_rows ($resultado_2); 
   	
		if($filas_r > 0 || filas_r1 > 0 ){
			echo "<script>alert('Se ha Eliminado correctamente');</script> "; 
			echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
			echo "window.location.href= 'BuscarInicializar.php'";
			echo "</script>";
			exit;
	 	}else{
			echo "<script>alert('No se pudo Eliminar los Datos Intente Mas tarde...');</script>";	
            echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
			echo "window.location.href= 'BuscarInicializar.php'";
			echo "</script>";
			exit;
		}        
	}	   

if ($act == 'A'){

$sql = "DELETE FROM id_sistema WHERE idnomenclatura = '".$cartucho."' ";
$resultado_set =  pg_query($sql);
$filas_r = pg_affected_rows ($resultado_set);
   	
		if($filas_r > 0){
			echo "<script>alert('Se ha Eliminado correctamente');</script> "; 
			echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
			echo "window.location.href= 'BuscarNomenclatura.php'";
			echo "</script>";
			exit;
	 	}else{
			echo "<script>alert('No se pudo Eliminar los Datos Intente Mas tarde...');</script>";	
            echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
			echo "window.location.href= 'BuscarNomenclatura.php'";
			echo "</script>";
			exit;
		}        
	}	   


?>