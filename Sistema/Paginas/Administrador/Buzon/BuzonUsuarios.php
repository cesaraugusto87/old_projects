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
    <td height="29" align="center" valign="middle" bordercolor="#999999"><div align="center"><span class="Estilo11">Menu Administracion de Usuarios</span></div></td>
  </tr>
  <tr>
    <td height="198" background="../../../images/fondo.jpg"><table width="241" border="1" align="center">
      <tr>
        <td height="27" class="boton"><div align="center"><a href="IngresarUsuario.php">Crear
          Nuevo Usuario </a></div>
          </td>
      </tr>
	  <tr>
        <td height="27" class="boton"><div align="center"><a href="EliminaUsuario.php">Eliminar Usuario </a></div>
          </td>
      </tr>
	  <tr>
        <td height="27" class="boton"><div align="center"><a href="ListadoUsuarios.php">Listado de Usuarios </a></div>
          </td>
      </tr>
      <tr>
        <td height="27" class="boton"><div align="center"><a href="CambiaPassword.php">Restablecer
            Contrase&ntilde;a</a></div></td>
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
