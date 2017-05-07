<?php
   session_start();
   $cedula   =  $_SESSION['Usuario'];
   $Tipo     =  $_SESSION['TipoUsuario'];
   if (($Tipo == 1)or($Tipo == 2)){
      include('../../Funciones/conexion.php');
      include('../../Funciones/transformfecha.php');
      $conexion = Conectarse();   
	  if ($Tipo == 1){
         $sql   =   "select * from participantes where (Cedula ='".$cedula."')"; 
	  }else{
	     $sql   =   "select * from profesor where (Cedula ='".$cedula."')"; 
	  }	 
      $resultado      =   mysql_query($sql, $conexion);
      $row_usuario    =   mysql_fetch_assoc($resultado);
      $nombre         =   $row_usuario['Nombre'];
      $apellido       =   $row_usuario['Apellido']; 
   }else{      
	  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= 'logearse.php'";	   
	  echo "</script>";	  
   }  
   if (isset($_POST['Cerrar'])){ 
      if ($Tipo == 1){
         echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	     echo "window.location.href= 'BandejaEntrada.php'";	   
	     echo "</script>";	  
	  }else{
	     echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	     echo "window.location.href= 'BandejaEntradaProfe.php'";	   
	     echo "</script>";	  
	  }	      	  
   }
?> 
<html>
<head>
<title>Bandeja de Entrada para Administrador...</title>
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
<table width="311" height="299" border="8" align="center">
  <tr>
    <td height="25" align="center" valign="bottom" bordercolor="#999999"><div align="right"><span class="Estilo11"><img src="../../images/LOGOTRANS.jpg" width="52" height="41" align="left">Bienvenido </span> <span class="Estilo13"> <?php echo $nombre," ",$apellido; ?> </span> </div></td>
  </tr>
  <tr>
    <td height="198" background="../../images/fondo.jpg"><table width="228" border="1" align="center">
      <tr>
        <td height="27" class="boton">
		<?php 
		   if($Tipo == 1){?>
		      <div align="center" class="Estilo13">
			     <a href="PerfilDatosParticipantes.php" class="Estilo22">
				    Ver Mis Datos Personales 
				 </a>
			  </div>   
		   <?php }else{?>
		      <div align="center" class="Estilo13">
			     <a href="PerfilDatosProfe.php" class="Estilo22">
				    Ver Mis Datos Personales 
				 </a>
			  </div>   
		   <?php }?>
		</td>
      </tr>
      <tr>
        <td height="27" class="boton"><div align="center"><a href="CambiaImagen.php">Cambiar mi Imagen </a></div></td>
      </tr>
      <tr>
        <td height="27" class="boton"><div align="center"><a href="CambiaLogin.php">Cambiar Mi Login </a></div></td>
      </tr>
      <tr>
        <td height="27" class="boton"><div align="center"><a href="CambiaClave.php">Cambiar Mi Password </a></div></td>
      </tr>
      <tr>
        <td height="33" class="Estilo13">
            <div align="center">
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
