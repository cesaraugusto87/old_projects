<?php
include('../../conexion/conexion.php');
$conn= Conectarse();

$gente=$_GET['gente'];
$ini=$_GET['ini'];
$final=$_GET['final'];
$desi=$_GET['desi'];


switch ($desi) {
    case 0:
       	$paque2="UPDATE empleados SET id_estado='02' WHERE (empleados.ficha='".$gente."')";
		$paque="INSERT INTO vacaciones (id_ficha, fecha_inicio,fecha_final) VALUES ('".$gente."', '".$ini."','".$final."')";
		pg_query($conn,$paque);
		pg_query($conn,$paque2);
		break;
    case 1:
        $paque3="UPDATE empleados SET id_estado='01' WHERE (empleados.ficha='".$gente."')";
		pg_query($conn,$paque3);
        break;
    case 2:
        $paque4="UPDATE vacaciones SET fecha_final='".$final."' WHERE (vacaciones.id_fecha='".$gente."' and vacaciones.fecha_inicio='".$ini."')";
		pg_query($conn,$paque4);
        break;
	case 3:
	    $paque5="UPDATE empleados SET id_estado='01' WHERE (empleados.ficha='".$gente."')";
		$paque6="UPDATE vacaciones SET fecha_final='".$final."' WHERE ( vacaciones.id_ficha='".$gente."' and vacaciones.fecha_inicio='".$ini."')";
		pg_query($conn,$paque5);
		pg_query($conn,$paque6);
}

?>