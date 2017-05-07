<?
$cod_material   = $_POST['cod_material'];
$desc_material  = $_POST['desc_material'];
$unidad         = $_POST['unidad'];
$cantidad       = $_POST['cantidad'];
$cod_tipo       = $_POST['cod_tipo'];
$stock_min      = $_POST['stock_min'];

include('../../conexion/conexion.php');
// conectamos con la base de datos
$link= Conectarse();

if (isset($_POST['Agregar'])){


	
   $sql="Select * from material where (Cod_Material ='".$cod_material."')"; 
   $resultado = mssql_query($sql);
   $ifilas = mssql_num_rows($resultado);
   
   if($ifilas > 0 ){
	   echo "<script>alert('Disculpe el Codigo de Material que esta intentado registrar ya existe!!!!');</script>"; 
  }else{
		 $sql = "INSERT INTO Material VALUES ('". $cod_material  ."','". $desc_material ."','". $unidad . "','". $cantidad . "', '". $cod_tipo . "', 0, '" .$stock_min. "'  )";
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
    <title>Productos</title>


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
				<li><a href="proveedores.php">Proveedores</a></li>
				<li><a href="productos.php" class="active">Productos</a></li>
			</ul>
		</li>	
		<li><a href="../materiales.html"><span class="l"></span><span class="r"></span><span class="t">Material/Equipos/Herramientas</span></a>
			<ul>
				<li><a href="../materiales/ingresar.php">Ingresar</a></li>
				<li><a href="../materiales/agregar.php">Agregar</a></li>
			</ul>
		</li>	
		<li><a href="../prestamo.html"><span class="l"></span><span class="r"></span><span class="t">Prestamo</span></a>
			<ul>
				<li><a href="../prestamo/prestar-o-entregar.php">Prestar o Entregar</a></li>
				<li><a href="../prestamo/devolver.php">Devolver</a></li>
			</ul>
		</li>	
		<li><a href="../reportes.html"><span class="l"></span><span class="r"></span><span class="t">Reportes</span></a>
			<ul>
				<li><a href="../reportes/prestamos.html">Prestamos</a></li>
				<li><a href="../reportes/consumos.html">Consumos</a></li>
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
                Productos
                                </h2>
                <div class="cleared"></div>
                                <div class="Webpostcontent">
								
<form name="formusuario" ENCTYPE="multipart/form-data" action="" method="post">
<table>
<tr><td><p>Codigo Material</p></td><td><input type="text" name="cod_material" id="cod_material" /></td> </tr>
<tr><td><p>Descripcion Material</p></td><td><input type="text" name="desc_material" id="desc_material" /></td></tr>
<tr><td><p>Unidad Medida</p></td><td><input type="text" name="unidad" id="unidad" /></td></tr>
<tr><td><p>Cantidad</p></td><td><input type="text" name="cantidad" id="cantidad" /></td></tr>
<tr><td><p>Tipo de Material</p></td><td><select name="cod_tipo" class="Estilo4">
				    <?php 
				   $sql_2       =   "SELECT * FROM tipo_material "; 
                   $resultado =   mssql_query($sql_2);
                   $row       =   mssql_fetch_assoc($resultado);
					   do { 
						echo "<option value=";
						echo $row['Cod_Tipo'];
						echo ">";
						echo $row['Descripcion_Tipo']; 
						echo "</option>";
					 }while ($row = mssql_fetch_assoc($resultado)); ?>
                     </select></td></tr>
<tr>
<td><p>Stock Minimo</p></td><td><input type="text" name="stock_min" id="stock_min" /></td></tr>
<td colspan="2" align="center"><input type="submit" name="Agregar" id="Agregar" value="Agregar Producto" /></td>
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
