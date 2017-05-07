<?php
   
      include('../../../funciones/conexion.php');
      $conexion = Conectarse();
	  
   if (isset($_POST['cerrar'])){
      echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.close()";	   
	  echo "</script>";	 
	  exit;  }

?> 

<html>
<head>
<title>Listado de Reportes...</title>
<link href="../../../funciones/estilo.css" rel="stylesheet" type="text/css">
<form name="form1" method="post" action="">
<table width="311" height="254" border="8" align="center">
  <tr>
    <td height="28" align="center" valign="bottom" bordercolor="#999999"><div align="center"><span class="Estilo11">Listado
          de Reportes</span></div>
    </td>
  </tr>
  <tr>
    <td height="198" background="../../../images/fondo.jpg"><?php

$dir = "../../../images/Rep_Sec/";
$directorio=opendir($dir); 
while ($archivo = readdir($directorio)) { 
  if($archivo == '.')
    echo "<a href=\"?dir=.\">$archivo</a><br>"; 
  elseif($archivo == '..'){ 
    if($dir != '.'){ 
      $carpetas = split("/",$dir); 
      array_pop($carpetas); 
      $dir2 = join("/",$carpetas); 
      echo "<a href=\"?dir=$dir2\">$archivo</a><br>"; 
    } 
  }
  elseif(is_dir("$dir/$archivo"))
    echo "<a href=\"?dir=$dir/$archivo\">$archivo</a><br>"; 
  else echo "<a href=\"../../../images/Rep_Sec/$archivo\">$archivo</a><br>"; 
} 
closedir($directorio); 
?>
    <p align="center">
      <input name="cerrar" type="submit" class="boton" id="cerrar" value="Cerrar">
    </p></td>
	
  </tr>
</table>
</form>

