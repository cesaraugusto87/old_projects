<?php
   
      include('../../../funciones/conexion.php');
      include('../../../funciones/transformfecha.php');
      $conexion = Conectarse();
	  
   if (isset($_POST['Regresar'])){
      echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= 'BuzonAdministrador.php'";	   
	  echo "</script>";	 
	  exit;  }

?> 
<html>
<head>
<title>Bandeja de Entrada para Administracion...</title>
<link href="../../../funciones/estilo.css" rel="stylesheet" type="text/css">
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
    <td height="198" background="../../../images/fondo.jpg"><table width="228" border="1" align="center">
      <tr>
        <td height="27" class="boton"><div align="center" class="Estilo13"><a href="BuscarNomenclatura.php" class="Estilo22"> Listado
              Sistemas por Ubicacion</a></div></td>
      </tr>
      <tr>
        <td height="27" class="boton"><div align="center"><a href="BuscarInicializar.php">Listado
               Cartuchos en Uso</a></div></td>
      </tr>
      <tr>
        <td height="27" class="boton"><div align="center"><a href="BuscarReportes.php" target="_blank">Buscar
              Reportes</a></div>
        </td>
      </tr>
      <tr>
        <td height="27" class="boton"><div align="center"><a href="BuscarNome2.php">Busqueda
              Por Nomenclatura</a></div>
        </td>
      </tr>
      <tr>
        <td height="27" class="boton"><div align="center"><a href="BuscarXInicializar.php">Listar
              Cartuchos a Inicializar</a></div>
        </td>
      </tr>
      <tr>
        <td height="27" class="boton"><div align="center"><a href="BuscarModCart.php" >Totales de Cartuchos</a></div></td>
      </tr>
      <tr>
        <td height="27" class="boton"><div align="center"><a href="ListadoCursosActivos.php" target="_blank">Reporte
              de Cartuchos Prestados</a></div>
        </td>
      </tr>
      <tr>
        <td height="27" class="boton"><div align="center"><a href="ListadoExpirados.php" target="_blank">Reporte
              de Cartuchos Expirados</a></div>
        </td>
      </tr>
      <tr>
        <td height="27" class="boton"><div align="center"><a href="ListadoCA.php" target="_blank">Reporte
          de Cartuchos en Centro Alterno</a></div></td>
      </tr>
      <tr>
        <td height="27" class="boton"><div align="center"><a href="ListadoAV.php" target="_blank">Reporte
            de Cartuchos en Alta Vista</a></div></td>
      </tr>
	  <td height="27" class="boton"><div align="center"><a href="ListadoMod1.php">Reporte
            de Cartuchos por Modelo</a></div></td>
      </tr>
      <tr>
        <td height="33" class="Estilo13"><div align="center">
            <input name="Regresar" type="submit" class="boton" id="Regresar" value="Regresar">
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
