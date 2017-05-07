<?php
   session_start();
   $Tipo     =  $_SESSION['tipo'];
   if (($Tipo == 5)){
      include('../../../funciones/conexion.php');
      include('../../../funciones/transformfecha.php');
      $conexion = Conectarse();
   }else{      
	  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= '../../logearse.php'";	   
	  echo "</script>";	  
   }  
   if (isset($_POST['Cerrar'])){
      session_start();
      session_unset();
      session_destroy();
	  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= '../../logearse.php'";	   
	  echo "</script>";
   }
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
<form name="form1" method="post" action="">
  <table width="311" height="355" border="8" align="center">
  <tr>
    <td height="29" align="center" valign="middle" bordercolor="#999999"><div align="center"><span class="Estilo11">Bienvenido </span> <span class="Estilo13"> </span> </div></td>
  </tr>
  <tr>
    <td height="198" background="../../../images/fondo.jpg"><table width="241" border="1" align="center">
      <tr>
        <td height="27" class="boton"><div align="center" class="Estilo13"><a href="BuzonAdministrarDatos.php" class="Estilo22">Administrar Datos</a></div></td>
      </tr>
      <tr>
        <td height="27" class="boton"><div align="center" class="Estilo13"><a href="../Noticias/MenuNoticia.php" class="Estilo22">Administrar Noticias</a></div></td>
      </tr>
      <tr>
        <td height="27" class="boton"><div align="center" class="Estilo13"><a href="BuzonUsuarios.php" class="Estilo22">Administrar Usuarios</a></div></td>
      </tr>
      <tr>
        <td height="27" class="boton"><div align="center"><a href="IngresarPrestamo.php"> Nuevo Prestamo</a></div></td>
      </tr>
      <tr>
        <td height="27" class="boton"><div align="center"><a href="IngresarCartVacio.php"> Nuevo
              Registro de Cintas Vacias</a></div>
        </td>
      </tr>
      <tr>
        <td height="27" class="boton"><div align="center"><a href="IngresarHistorico.php"> Nueva Identificacion de Historico</a></div>
        </td>
      </tr>
      <tr>
        <td height="27" class="boton"><div align="center"><a href="IngresarIdsistema.php">Nueva Identificacion de Sistema</a></div></td>
      </tr>
      <tr>
        <td height="27" class="boton"><div align="center"><a href="IngresarCartucho.php"> Nueva Inicializacion de Cartucho</a></div>
        </td>
      </tr>
      <tr>
        <td height="27" class="boton"><div align="center"><a href="BuzonBusqueda.php">Menu de Listados de  Cartuchos</a></div></td>
      </tr>
      <tr>
        <td height="33" class="Estilo13"><div align="center">
          <input name="Cerrar" type="submit" class="boton" value="Cerrar Sesion">
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
