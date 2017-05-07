<?php
   session_start();
   $cedula   =  $_SESSION['ci'];
   $Tipo     =  $_SESSION['tipo'];
   if (($Tipo == 5)){
      include('../../../funciones/conexion.php');
      include('../../../funciones/transformfecha.php');
      $conexion = Conectarse();
      $nombre         =   $cedula;
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
<p>&nbsp;</p>
<form name="form1" method="post" action="">
<table width="311" height="287" border="8" align="center">
  <tr>
    <td height="61" align="center" valign="bottom" bordercolor="#999999"><div align="right"><span class="Estilo11">Bienvenido </span> <span class="Estilo13"> </span> </div></td>
  </tr>
  <tr>
    <td height="198" background="../../../images/fondo.jpg"><table width="241" border="1" align="center">
      <tr>
        <td height="27" class="boton"><div align="center" class="Estilo13"><a href="IngresarCarrera.php" class="Estilo22">Registrar Nueva Carrera </a></div></td>
      </tr>
      <tr>
        <td height="27" class="boton"><div align="center"><a href="IngresarMateria.php">Registrar Nueva Asignatura </a></div></td>
      </tr>
      <tr>
        <td height="27" class="boton"><div align="center"><a href="IngresarDatosPersonales.php">Registrar Nuevo Estudiante</a></div></td>
      </tr>
      <tr>
        <td height="27" class="boton"><div align="center"><a href="IngresarDatosProfesor.php">Registrar Nuevo Profesor </a></div></td>
      </tr>
      <tr>
        <td height="27" class="boton"><div align="center"><a href="IngresarInscripcion.php">Inscribir Estudiante </a></div></td>
      </tr>
      <tr>
        <td height="27" class="boton"><div align="center"><a href="../Noticias/MenuNoticia.php">Administrar Noticias </a></div></td>
      </tr>
      <tr>
        <td height="27" class="boton"><div align="center"><a href="IngresarUsuario.php">Crear Nuevo Usuario </a></div></td>
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
