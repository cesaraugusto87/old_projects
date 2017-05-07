<?php
   session_start();
   $cedulausuario  = $_SESSION['usuario'];
   $tipousuario   = $_SESSION['tipo'];   
   if( isset($_POST['CampoClave']) ){
      $nuevaclave = $_POST['CampoClave'];
      if ($nuevaclave != ""){
	     include('../../../funciones/conexion.php');
         $conexion = Conectarse();   
		 $sql="UPDATE usuario SET Password='".$nuevaclave."' WHERE ((TipoUsuario = 5))"; 		
         $resultado = mysql_query($sql, $conexion);
		 $registros = mysql_affected_rows ($conexion);
	     if($registros > 0){
		    echo "<script>alert('Operacion realizada con Exito. Su Nueva Clave es: ".$nuevaclave."');</script>"; 
	        echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	        echo "window.location.href= '../Buzon/AdminUsuarios.php'";	   
	        echo "</script>";
		 }else{
		    echo "<script>alert('Operacion Incorrecta Intente de Nuevo...');</script>";
		    echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";	       
			echo "window.location.href= '../Buzon/AdminUsuarios.php'";	   
	        echo "</script>";
	        exit;
		 }			 		 
	  }else{
	     echo "<script>alert('La Nueva Clave no Puede estar Vacio...');</script>"; 
	     echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	     echo "window.location.href= 'CambiaClave.php'";	   
	     echo "</script>";
	  }
   }
?>
<html>
   <head>
      <title>Cambia Clave Webmaster</title>
      <link href="../../../funciones/estilo.css" rel="stylesheet" type="text/css" />
      <style type="text/css">
<!--
.Estilo22 {color: #FF0000}
-->
      </style>
</head>
   <body>
  <form name="form1" method="post" action="">
	  <p>&nbsp;</p>
	  <table width="311" height="299" border="8" align="center">
        <tr>
          <td height="25"><div align="right"><span class="Estilo11"><img src="../../../images/LOGOTRANS.jpg" alt="Bandeja  para Data de Usuarios" width="52" height="41" align="left">Cambiando Clave del <span class="Estilo22">WEBMASTER </span></span></div></td>
        </tr>
        <tr>
          <td height="198" background="../../../images/fondo.jpg"><p>&nbsp;</p>
          <table width="100" border="5" align="center">
            <tr>
              <td><table width="175" height="100" border="0" align="center" cellpadding="0" cellspacing="0" class="Estilo4">
                  <!--DWLayoutTable-->
                  <tr>
                    <th height="25" valign="middle"><div align="center">Ingrese Su Nuevo Password </div></th>
                  </tr>
                  <tr>
                    <th height="25" valign="middle"> <div align="center">
                        <input name="CampoClave" type="password" class="Estilo4" id="cedula7" size="20" maxlength="20" />
                    </div></th>
                  </tr>
                  <tr>
                    <th height="25" valign="middle"> <div align="center">
                        <input name="submit" type="submit" class="boton" value="Cambiar" />
                    </div></th>
                  </tr>
                  <tr>
                    <th width="217" height="25" valign="middle"> <table width="63" height="25" border="0" align="center" class="boton">
                        <tr>
                          <td><div align="center"> <a href="../Buzon/AdminUsuarios.php"> Atras </a> </div></td>
                        </tr>
                    </table></th>
                  </tr>
              </table></td>
            </tr>
          </table>
          <p>&nbsp;</p>
              <p>&nbsp;</p></td>
        </tr>
      </table>
   </form>
   </body>
</html>
