<?
$rif 	   = $_POST['rif'];
$nombre    = $_POST['nombre'];
$telefono  = $_POST['telefono'];
$direccion = $_POST['direccion'];

if (isset($_POST['Agregar'])){

include('../../conexion/conexion.php');
// conectamos con la base de datos
$link= Conectarse();
	
   $sql="Select * from proveedores where (rif ='".$rif."')"; 
   $resultado = mssql_query($sql);
   $ifilas = mssql_num_rows($resultado);
   
   if($ifilas > 0 ){
	   echo "<script>alert('Disculpe el RIF que esta intentado registrar ya existe!!!!');</script>"; 
  }else{
		 $sql = "INSERT INTO proveedores VALUES ('". $rif ."','". $nombre ."','". $direccion . "','". $telefono . "')";
	   	 $result =  mssql_query($sql);
	   	 $filas_r = mssql_rows_affected ($link);
   	
		if($filas_r > 0){
			echo "<script>alert('Los datos se han INGRESADO correctamente');</script> "; 
	 	}else{
			echo "<script>alert('No se pudo GUARDAR los Datos Intente Mas tarde...');</script>";	
		}        
	}
	
	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"[]>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Proveedores</title>
    <meta name="description" content="Description" />
    <meta name="keywords" content="Keywords" />


    <link rel="stylesheet" href="../../css/style.css" type="text/css" media="screen" />
    <!--[if IE 6]><link rel="stylesheet" href="../../css/style.ie6.css" type="text/css" media="screen" /><![endif]-->
    <!--[if IE 7]><link rel="stylesheet" href="../../css/style.ie7.css" type="text/css" media="screen" /><![endif]-->

    <script type="text/javascript" src="../../js/jquery.js"></script>
    <script type="text/javascript" src="../../js/script.js"></script>
</head>
<body>
<div id="Webpage-background-glare">
    <div id="Webpage-background-glare-image"> </div>
</div>
<div id="Webmain">
    <div class="cleared reset-box"></div>
    <div class="Websheet">
        <div class="Websheet-tl"></div>
        <div class="Websheet-tr"></div>
        <div class="Websheet-bl"></div>
        <div class="Websheet-br"></div>
        <div class="Websheet-tc"></div>
        <div class="Websheet-bc"></div>
        <div class="Websheet-cl"></div>
        <div class="Websheet-cr"></div>
        <div class="Websheet-cc"></div>
        <div class="Websheet-body">
            <div class="Webheader">
                <div class="Webheader-clip">
                <div class="Webheader-center">
                    <div class="Webheader-png"></div>
                    <div class="Webheader-jpeg"></div>
                </div>
                </div>
                <div class="Weblogo">
                                 <h1 class="Weblogo-name"><a href="../../index.html">Sistema de Inventario</a></h1>
                                                 <h2 class="Weblogo-text">Jardines el Cercado</h2>
                                </div>
            </div>
            <div class="cleared reset-box"></div>
<div class="Webnav">
	<div class="Webnav-l"></div>
	<div class="Webnav-r"></div>
<div class="Webnav-outer">
	<ul class="Webhmenu">
		<li><a href="../../Index.html"><span class="l"></span><span class="r"></span><span class="t">Principal</span></a>
			<ul>
				<li><a href="proveedores.php" class="active">Proveedores</a></li>
				<li><a href="productos.php">Productos</a></li>
			</ul>
		</li>	
		<li><a href="../materiales.php"><span class="l"></span><span class="r"></span><span class="t">Material/Equipos/Herramientas</span></a>
			<ul>
				<li><a href="../materiales/ingresar.php">Ingresar</a></li>
				<li><a href="../materiales/agregar.php">Agregar</a></li>
			</ul>
		</li>	
		<li><a href="../prestamo.php"><span class="l"></span><span class="r"></span><span class="t">Prestamo</span></a>
			<ul>
				<li><a href="../prestamo/prestar-o-entregar.php">Prestar o Entregar</a></li>
				<li><a href="../prestamo/devolver.php">Devolver</a></li>
			</ul>
		</li>	
		<li><a href="../reportes.php"><span class="l"></span><span class="r"></span><span class="t">Reportes</span></a>
			<ul>
				<li><a href="../reportes/prestamos.php">Prestamos</a></li>
				<li><a href="../reportes/consumos.php">Consumos</a></li>
			</ul>
		</li>	
	</ul>
</div>
</div>
<div class="cleared reset-box"></div>
<div class="Webcontent-layout">
                <div class="Webcontent-layout-row">
                    <div class="Weblayout-cell Webcontent">
<div class="Webpost">
    <div class="Webpost-body">
<div class="Webpost-inner Webarticle">
                                <h2 class="Webpostheader">
                Agregar Proveedor
                                </h2>
                <div class="cleared"></div>
                                <div class="Webpostcontent">

<form name="formusuario" ENCTYPE="multipart/form-data" action="" method="post">
<table>
<tr>
<td><p>RIF</p></td><td><input type="text" name="rif" id="rif" /></td> </tr>
<tr>
<td><p>Nombre</p></td><td><input type="text" name="nombre" id="nombre" /></td></tr>
<tr>
<td><p>Direccion</p></td><td><input type="text" name="direccion" id="direccion" /></td></tr>
<tr>
<td><p>Telefono</p></td><td><input type="text" name="telefono" id="telefono" /></td></tr>
<td colspan="2" align="center"><input type="submit" name="Agregar" id="Agregar" value="Agregar Proveedor" /></td>
</table>
</form>


                </div>
                <div class="cleared"></div>
                </div>

		<div class="cleared"></div>
    </div>
</div>

                      <div class="cleared"></div>
                    </div>
                </div>
            </div>
            <div class="cleared"></div>
            <div class="Webfooter">
                <div class="Webfooter-t"></div>
                <div class="Webfooter-l"></div>
                <div class="Webfooter-b"></div>
                <div class="Webfooter-r"></div>
                <div class="Webfooter-body">
                            <div class="Webfooter-text">
                                
<p>Jardines el Cercado, C.A.</p>
<p>Copyright © 2012. Todos los Derechos Reservados.</p>
                                                            </div>
                    <div class="cleared"></div>
                </div>
            </div>
    		<div class="cleared"></div>
        </div>
    </div>
</div>

</body>
</html>
