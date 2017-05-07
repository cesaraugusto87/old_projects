<html>
   <head>
      <title>Formulario de Ingreso de Usuario</title>
      <link href="../../../funciones/estilo.css" rel="stylesheet" type="text/css">
   <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><style type="text/css">
<!--
body {
	background-image: url(../../../images/fondo.jpg);
}
-->
</style></head>
   <body>
      <?php
         include("../../../funciones/conexion.php");
         $conexion = Conectarse();
		 
		 $usuario = $_POST['usuario'];
		 $pass    = $_POST['passwordant'];
		 $pass1   = $_POST['password'];
		 $pass2   = $_POST['passwordconf'];
		 
	if (isset($_POST['Regresar'])){
    	  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  	  echo "window.location.href= 'BuzonUsuarios.php'";	   
	  	  echo "</script>";	 
	      exit;
        }
		 if (isset($_POST['cambiar'])){
		    
				if ( $pass1 == $pass2 && $pass != $pass1){
              		$clave   		=   md5($_POST['password']);
	  	       		$sql     		=   "UPDATE usuarios SET password = '".$clave."' WHERE login = '".$usuario."' ";
   	   	       		$resultado_set  =   pg_query($sql);
	           		$filas_r        =   pg_affected_rows ($resultado_set);
		       if($filas_r > 0){
			      echo "<script>alert('La contraseña para el usuario se ha MODIFICADO correctamente');</script> "; 
			      echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
           		  echo "window.location.href= 'BuzonUsuarios.php'";
			      echo "</script>";
			      exit; 
	 	       }else{
      		      echo "<script>alert('No se pudo GUARDAR los Datos Intente Mas tarde...');</script>";	
                  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
			      echo "window.location.href= 'BuzonUsuarios.php'";
			      echo "</script>";
			      exit; 
		       }             
	        }
			else{
				  echo "<script>alert('Las Contraseñas No Coinciden Vuelva a intentar...');</script>";	
                  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
			      echo "window.location.href= 'CambiaPassword.php'";
			      echo "</script>";
			      exit; 
		       }
		 }
	  ?>
      <form name="formusuario" action="" method="post">
	  <table width="467" border="0" align="center">        
         <tr>
            <td>
			   <table width="467" border="1">
                 <tr>
                   <td colspan="5"><table width="467" border="0">
                     <tr>
                       <td width="100"></td>
                       <td width="221">&nbsp;</td> 
                     </tr>
                   </table></td>
                 </tr>
                 <tr>
                   <td colspan="5"><div align="center"></div></td>
                 </tr>
                 <tr>
                   <td colspan="5"><div align="center" class="boton"><span class="Estilo16">Cambio de Password</span></div></td>
                 </tr>
                 <tr>
                   <tr>
                     <td align="right" valign="middle" class="Estilo12"><div align="right">Usuario</div></td>
                     <td><input name="usuario" type="text" size="25" maxlength="20" />
                     </td>
                   </tr>
				   
                   <td align="right" valign="middle" class="Estilo12"><div align="right">Nueva
                       Contrase&ntilde;a</div></td>
                     <td width="156"><input name="password" type="password" size="25" maxlength="20" /></td>
                 </tr>
                 <tr>
                   <td align="right" valign="middle" class="Estilo12"><div align="right">Confirmar
                     Contrase&ntilde;a</div></td>
                   <td><input name="passwordconf" type="password" size="25" maxlength="20" /></td>

                 </tr>
               </table>		    </td>
         </tr>
         <tr>
            <td>&nbsp;</td>
         </tr>
         
         <tr>
            <td><table width="467" border="0">
              <tr>
                <td width="231">&nbsp;</td>
                <td width="114" align="center">
				  <label>
                     <input name="cambiar" type="submit" class="boton" value="Cambiar Clave" />
                  </label>			    <input name="Regresar" type="submit" class="boton" id="Regresar" value="Regresar"></td>
                  <td width="241">&nbsp;</td>
              </tr>
               </table>            </td>
         </tr>
         <tr>
            <td>&nbsp;</td>
         </tr>
      </table>
    </form>
</body>
</html>
