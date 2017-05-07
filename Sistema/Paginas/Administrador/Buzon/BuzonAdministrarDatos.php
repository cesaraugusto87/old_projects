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
	  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= 'BuzonAdministrador.php'";	   
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
    <td height="29" align="center" valign="middle" bordercolor="#999999"><div align="center"><span class="Estilo11">Menu de Administracion de Datos</span></div></td>
  </tr>
  <tr>
    <td height="198" background="../../../images/fondo.jpg"><table width="241" border="1" align="center">
      <tr>
        <td height="27" class="boton"><div align="center" class="Estilo13"><a href="IngresarFrec.php" class="Estilo22">Registrar Nueva Frecuencia</a></div></td>
      </tr>
      <tr>
        <td height="27" class="boton"><div align="center"><a href="IngresarSistema.php">Registrar Nuevo Sistema</a></div></td>
      </tr>
      <tr>
        <td height="27" class="boton"><div align="center"><a href="IngresarAmbiente.php">Registrar Nuevo Ambiente</a></div></td>
      </tr>
      <tr>
        <td height="27" class="boton"><div align="center"><a href="IngresarEstado.php">Registrar Nuevo Estado</a></div></td>
      </tr>
      <tr>
        <td height="27" class="boton"><div align="center"><a href="IngresarModCart.php">Registrar Modelo de Cartucho</a></div></td>
      </tr>
      <tr>
        <td height="27" class="boton"><div align="center"><a href="IngresarUbicacion.php">Registrar Nueva Ubicacion</a></div></td>
      </tr>
      <tr>
        <td height="27" class="boton"><div align="center"><a href="IngresarCiclo.php">Registrar Ciclo de Retencion</a></div></td>
      </tr>
	   <tr>
        <td height="27" class="boton"><div align="center"><a href="ModificarSistema.php">Modificar Sistema Existente</a></div></td>
      </tr>
       <tr>
        <td height="27" class="boton"><div align="center"><a href="ModificarContador.php">Modificar Contadores de Cintas</a></div></td>
      </tr>
      <tr>
        <td height="33" class="Estilo13"><div align="center">
          <input name="Cerrar" type="submit" class="boton" value="Regresar">
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
