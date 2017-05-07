<?
$cedula   = $_POST['cedula'];
$flag = 0;
include('../../conexion/conexion.php');
// conectamos con la base de datos
$link= Conectarse();

if (isset($_POST['Buscar'])){

   $sql="Select * from RotacionMaterial where (ced_empSolicita ='".$cedula."')"; 
   $resultado = mssql_query($sql);
   $ifilas = mssql_num_rows($resultado);
   $row = mssql_fetch_array($resultado);
   
   if($ifilas == 0 ){
	   echo "<script>alert('Disculpe la cedula que esta buscando no tiene prestamos existentes!!!!');</script>"; 
  }else{
		 $flag = 1;
	
   $sql="Select * from empleados where (ced_emp ='".$row["ced_empAutoriza"]."')"; 
   $resultado = mssql_query($sql);
   $row1 = mssql_fetch_array($resultado);

   $sql="Select * from empleados where (ced_emp ='".$row["ced_empSalida"]."')"; 
   $resultado = mssql_query($sql);
   $row2 = mssql_fetch_array($resultado);
}   }

if (isset($_POST['devolver'])){
		$flag = 0;
		 $sql = "UPDATE RotacionMaterial SET cantidad = '". $cantidad . "' fec_retorno = '". $fec_retorno ."' WHERE ced_empSolicita = '".$cedula."' AND cod_material = '".$cod_material "' AND SERIAL0
	  	 $result =  mssql_query($sql);
		 $filas_r = mssql_rows_affected ($link);
   	
	if($filas_r > 0){
		echo "<script>alert('Los datos se han INGRESADO correctamente');</script> "; 
	}else{
		echo "<script>alert('No se pudo GUARDAR los Datos Intente Mas tarde...');</script>";	
	}        

}	
	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"[]>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Devolver</title>
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
				<li><a href="../Principal/proveedores.php">Proveedores</a></li>
				<li><a href="../Principal/productos.php">Productos</a></li>
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
				<li><a href="prestar-o-entregar.php">Prestar o Entregar</a></li>
				<li><a href="devolver.php" class="active">Devolver</a></li>
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
                Devolver
                                </h2>
                <div class="cleared"></div>
                                <div class="Webpostcontent">
<? if ($flag == 0){ ?>
<form name="formusuario" ENCTYPE="multipart/form-data" action="" method="post">
<table>
<tr><td><p>Cedula del Trabajador</p></td><td><input type="text" name="cedula" id="cedula" /></td></tr>
<td colspan="2" align="center"><input type="submit" name="Buscar" id="Buscar" value="Buscar Prestamo" /></td>
</table>
</form>
<? } ?>

<? if ($flag == 1){ ?>

<form name="formusuario" ENCTYPE="multipart/form-data" action="" method="post">
<table>
<tr><td><p>Cedula del Trabajador</p></td><td><p><? echo utf8_encode($row["ced_empSolicita"]); ?></p></td></tr>
<tr><td><p>Fecha de Salida</p></td><td><p><? echo date("d-m-Y",strtotime($row["Fecha_Salida"])); ?></p></td></tr>
<tr><td><p>Codigo de Material</p></td><td><p><? echo utf8_encode($row["Cod_Material"]); ?></p></td></tr>
<tr><td><p>Serial</p></td><td><p><? echo utf8_encode($row["Serial"]); ?></p></td></tr>
<tr><td><p>Persona que Autoriza</p></td><td><p><? echo utf8_encode($row1["nom_emp"]); ?></p></td></tr>
<tr><td><p>Persona que Entrega</p></td><td><p><? echo utf8_encode($row2["nom_emp"]); ?></p></td></tr>
<tr><td><p>Cantidad Prestada</p></td><td><p><? echo $row["Cantidad"]; ?></p></td></tr>
<tr><td><p>Cantidad Retornada</p></td><td><p><input type="text" name="cantidad" id="cantidad" /></p></td> </tr>
<tr><td><p>Fecha de Retorno</p></td><td><p><input type="text" name="fec_retorno" id="fec_retorno" /></p></td> </tr>
<td colspan="2" align="center"><input type="submit" name="devolver" id="devolver" value="Devolver Material" /></td>
<input type="hidden" name = "cedula" id="tipo" value = <? echo $row["ced_empSolicita"]; ?> />
<input type="hidden" name = "cedula" id="tipo" value = <? echo $row["Cod_Material"]; ?> />
</table>
</form>

<? } ?>

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
