<?php
   session_start();
   $cedula   =  $_SESSION['Usuario'];
   $Tipo     =  $_SESSION['tipo'];
   if (($Tipo == 5 || $Tipo == 1)){
      include('../../funciones/conexion.php');
      include('../../funciones/transformfecha.php');
      $conexion = Conectarse();
      $nombre         =   $cedula;
   }
   if (isset($_POST['Regresar'])){
      echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= '../logearse.php'";	   
	  echo "</script>";	 
	  exit;  
   }
?> 
<html>
<head>
<title>Bandeja de Entrada para Administracion...</title>
<link href="../../funciones/estilo.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.Estilo22 {font-size: 10pt}
-->
</style>
</head>
<body>
<p>&nbsp;</p>
<form name="form1" method="post" action="">
<table width="311" height="254" border="8" align="center">
  <tr>
    <td height="28" align="center" valign="bottom" bordercolor="#999999"><div align="center"><span class="Estilo11">Bienvenido</span></div></td>
  </tr>
  <tr>
    <td height="198" background="../../images/fondo.jpg"><table width="228" border="1" align="center">
      <tr>
        <td height="27" class="boton"><div align="center" class="Estilo13"><a href="BuscarNomenclatura.php" class="Estilo22"> Listado
              Cartuchos por Nomenclatura</a></div></td>
      </tr>
      <tr>
        <td height="27" class="boton"><div align="center"><a href="BuscarInicializar.php">Listado
               Cartuchos en Uso</a></div></td>
      </tr>
      <tr>
        <td height="27" class="boton"><div align="center"><a href="BuscarNome2.php">Busqueda
              Por Nomenclatura</a></div>
        </td>
      </tr>
      <tr>
        <td height="27" class="boton"><div align="center"><a href="BuscarModCart.php">Totales de Cartuchos</a></div></td>
      </tr>
      <tr>
        <td height="27" class="boton"><div align="center"><a href="ListadoCursosActivos.php">Reporte
              de Cartuchos Prestados</a></div>
        </td>
      </tr>
      <tr>
        <td height="27" class="boton"><div align="center"><a href="ListadoExpirados.php">Reporte
            de Cartuchos Expirados</a></div></td>
      </tr>
      <tr>
        <td height="33" class="Estilo13"><div align="center">
            <input name="Regresar" type="submit" class="boton" id="Regresar" value="Cerrar Sesion">
        </div></td>
      </tr>
    </table></td>
  </tr>
</table>
</form>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
