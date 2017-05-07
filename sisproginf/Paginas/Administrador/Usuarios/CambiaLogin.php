<?php
   session_start();
   $cedulausuario  = $_SESSION['usuario'];
   $tipousuario    = $_SESSION['tipo'];   
   if( isset($_POST['CampoLogin']) ){
      $nuevologin = $_POST['CampoLogin'];
      if ($nuevologin != ""){
	     include('../../../funciones/conexion.php');
         $conexion = Conectarse();   
		 $sql="Select * from usuario WHERE (Login = '".$nuevologin."')";
		 $resultado = mysql_query($sql,$conexion);
		 $registros = mysql_affected_rows ($conexion);
		 if ($registros > 0){
	        echo "<script>alert('Disculpa Ya EXISTE un USUARIO con ese Login...');</script>"; 
	        echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	        echo "window.location.href= 'CambiaLogin.php'";	   
	        echo "</script>";		 
		 }else{		 
		    $sql2="UPDATE usuario SET Login='".$nuevologin."' WHERE ((TipoUsuario = 5) )"; 		
            $resultado2 = mysql_query($sql2,$conexion);
		    $registros2 = mysql_affected_rows($conexion);
	        if($registros2 > 0){
		       echo "<script>alert('Su Nuevo Login es: ".$nuevologin."');</script>"; 
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
         }   						 		 
	  }else{
	     echo "<script>alert('El Campo no Puede estar Vacio......');</script>"; 
	     echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	     echo "window.location.href= 'CambiaLogin.php'";	   
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
          <td height="25"><div align="right"><span class="Estilo11"><img src="../../../images/LOGOTRANS.jpg" alt="Bandeja  para Data de Usuarios" width="52" height="41" align="left">Cambiando Login del <span class="Estilo22">Webmaster</span>  </span><span class="Estilo13"> </span> </div></td>
        </tr>
        <tr>
          <td height="198" background="../../../images/fondo.jpg"><p>&nbsp;</p>
          <table width="100" border="5" align="center">
            <tr>
              <td><table width="175" height="100" border="0" align="center" cellpadding="0" cellspacing="0" class="Estilo4">
                  <!--DWLayoutTable-->
                  <tr>
                    <th height="25" valign="middle"><div align="center">Ingrese Su Nuevo Login </div></th>
                  </tr>
                  <tr>
                    <th height="25" valign="middle"> <div align="center">
                        <input name="CampoLogin" type="text" class="Estilo4" id="cedula7" size="20" maxlength="20" />
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
