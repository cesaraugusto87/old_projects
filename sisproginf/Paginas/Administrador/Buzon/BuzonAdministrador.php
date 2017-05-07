<?php
   session_start();
   $cedula   =  $_SESSION['Usuario'];
   $Tipo     =  $_SESSION['TipoUsuario'];
   if (($Tipo == 1)or($Tipo == 2)or($Tipo == 5)){
      include('../../../Funciones/conexion.php');
      include('../../../Funciones/transformfecha.php');
      $conexion = Conectarse();   
      $sql            =   "select * from participantes where (Cedula ='".$cedula."')"; 
      $resultado      =   mysql_query($sql, $conexion);
      $row_usuario    =   mysql_fetch_assoc($resultado);
      $nombre         =   $row_usuario['Nombre'];
      $apellido       =   $row_usuario['Apellido']; 
   }else{      
	  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= '../../Usuarios/logearse.php'";	   
	  echo "</script>";	  
   }  
   if (isset($_POST['Cerrar'])){
      session_start();
      session_unset();
      session_destroy();
	  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= '../../Usuarios/logearse.php'";	   
	  echo "</script>";	  
   }
?> 
<html>
<head>
<title>Bandeja de Entrada para Administrador...</title>
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
<table width="311" height="299" border="8" align="center">
  <tr>
    <td height="25" align="center" valign="bottom" bordercolor="#999999"><div align="right"><span class="Estilo11"><img src="../../../images/LOGOTRANS.jpg" width="52" height="41" align="left">Bienvenido </span> <span class="Estilo13"> <?php echo $nombre," ",$apellido; ?> </span> </div></td>
  </tr>
  <tr>
    <td height="198" background="../../../images/fondo.jpg"><table width="228" border="1" align="center">
      <tr>
        <td height="27" class="boton"><div align="center" class="Estilo13"><a href="AdminUsuarios.php" class="Estilo22">Administrar Usuarios </a></div></td>
      </tr>
      <tr>
        <td height="27" class="boton"><div align="center"><a href="AdminCursos.php">Administrar Cursos </a></div></td>
      </tr>
      <tr>
        <td height="27" class="boton"><div align="center"><a href="../Noticias/MenuNoticia.php">Administrar Noticias</a> </div></td>
      </tr>
      <tr>
        <td height="27" class="boton"><div align="center"><a href="reportes.php">Generar Reportes </a></div></td>
      </tr>
      <tr>
        <td height="33" class="Estilo13">
            <div align="center">
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
