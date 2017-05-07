<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>
</head>
<?php
//include('consulta/conexion.php');
include('../../conexion/conexion.php');
//$Conexion;
$conn= Conectarse();
$FICHA =$_POST['ficha'];
$query="UPDATE prestamos SET id_estado='01' WHERE (prestamos.id_ficha='".$FICHA."')";
$result=pg_query($conn,$query);
?>
<body>
<div align="center"><strong>CAMBIOS REALIZADOS CON EXITO</strong></div>
</body>

</html>
