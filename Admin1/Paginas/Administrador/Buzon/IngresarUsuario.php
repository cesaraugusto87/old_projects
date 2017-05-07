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
		 $cedula         =   $_POST['Cedula'];
		 $tipousuario    =   $_POST['tipousuario'];
		 
		 

		 if (isset($_POST['CampoLogin'])){
		    $login = $_POST['CampoLogin'];
		    $sql="select * from seguridad where (Login ='".$login."')"; 
            $resultado = pg_query($sql );
            $ifilas = pg_affected_rows ($resultado);
            if($ifilas > 0 ){
	           echo "<script>alert('El Usuario Ya Existe, Intente con Otro!!!!');</script>"; 
	           echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	           echo "window.location.href= 'IngresarUsuario.php?Cedula=$cedula'";	   
	           echo "</script>";	  
            }else{
               $clave         =   $_POST['CampoPassword'];
	           $tipo          =   $tipousuario;
	  	       $sql="insert into seguridad  values('".$login."','".$clave."','".$tipousuario."','".$cedula."')";
   	   	       $resultado_set =  pg_query($sql);
	           $filas_r = pg_affected_rows ($resultado_set);
		       if($filas_r > 0){
			      echo "<script>alert('Los datos se han INGRESADO correctamente');</script> "; 
			      echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
           		  echo "window.location.href= 'BuzonAdministrador.php'";
			      echo "</script>";
			      exit; 
	 	       }else{
      		      echo "<script>alert('No se pudo GUARDAR los Datos Intente Mas tarde...');</script>";	
                  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
			      echo "window.location.href= 'BuzonAdministrador.php'";
			      echo "</script>";
			      exit; 
		       }             
	        }
		 }
	  ?>
      <form name="formusuario" action="" method="post">
	  <table width="467" border="0" align="center">
         <input name="Cedula" type="hidden" value="$cedula">
         
         <tr>
            <td>
			   <table width="584" border="1">
                 <tr>
                   <td colspan="5"><table width="591" border="0">
                     <tr>
                       <td width="100"></td>
                       <td width="221">&nbsp;</td>
                       <td width="256"><div align="right"><span class="Estilo11">Bienvenido Sr(a) </span> <span class="Estilo13"> <?php echo $nombre," ",$apellido; ?></span></div></td>
                     </tr>
                   </table></td>
                 </tr>
                 <tr>
                   <td colspan="5"><div align="center"></div></td>
                 </tr>
                 <tr>
                   <td colspan="5"><div align="center" class="boton"><span class="Estilo16">Ingrese Datos de Usuario </span></div></td>
                 </tr>
                 <tr>
                   <td width="145" height="26" align="right" valign="middle" class="Estilo12">Login</td>
                   <td width="120">
			       <input name="CampoLogin" type="text" size="20" maxlength="15"/>				   </td>
                   <td width="62" align="right" valign="middle" class="Estilo12">Password</td>
                   <td width="156"><input name="CampoPassword" type="password" size="25" maxlength="20" /></td>
                   <td width="84"></td>
                 </tr>
                 <tr>
                   <td height="26" align="right" valign="middle" class="Estilo12">Tipo</td>
                   <td><select name="tipousuario">
                     <option value="1">Estudiante</option>
                     <option value="2">Profesor</option>
                     <option value="5">Administrador</option>
                   </select>
                   </td>
                   <td align="right" valign="middle" class="Estilo12">Cedula</td>
                   <td><input name="Cedula" type="text" size="25" maxlength="20" /></td>
                   <td></td>
                 </tr>
               </table>		    </td>
         </tr>
         <tr>
            <td>&nbsp;</td>
         </tr>
         
         <tr>
            <td><table width="600" border="0">
              <tr>
                <td width="231">&nbsp;</td>
                <td width="114">
				  <label>
                     <input name="Ingresar" type="submit" class="boton" value="Ingresar Usuario" />
                  </label>			    </td>
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
