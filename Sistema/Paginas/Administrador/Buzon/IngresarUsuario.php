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
	
	//Variables Principales traidas por POST
		 $usuario  = $_POST['usuario'];
		 $tipo	   = $_POST['tipo'];
		 $pass1    = $_POST['password'];
		 $pass2    = $_POST['passwordconf'];
		 

	if (isset($_POST['Regresar'])){
    	  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  	  echo "window.location.href= 'BuzonUsuarios.php'";	   
	  	  echo "</script>";	 
	      exit;
        }
		
		 if (isset($_POST['crear'])){
		    $sql= "select * from usuarios where login ='".$usuario."'";
            $resultado = pg_query($sql);
            $filas = pg_num_rows($resultado);
			
         if($filas > 0 ){
	           echo "<script>alert('El Nombre de Usuario Ya Existe, Intente con uno Nuevo!!!!');</script>"; 
	           echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	           echo "window.location.href= 'IngresarUsuario.php'";	   
	           echo "</script>";	  
         }else{
			if ($usuario != ''){
				if ($pass1 == $pass2){
              		$clave   =   md5($_POST['password']);
	  	       		$sql     =   "INSERT INTO USUARIOS  VALUES('".$usuario."','".$clave."','".$tipo."')";
   	   	       		$resultado_set =  pg_query($sql);
	           		$filas_r = pg_affected_rows ($resultado_set);
		       if($filas_r > 0){
			      echo "<script>alert('Se ha creado el Usuario Correctamente');</script> "; 
			      echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
           		  echo "window.location.href= 'BuzonUsuarios.php'";
			      echo "</script>";
			      exit;}
			   else{
      		      echo "<script>alert('No se pudo GUARDAR los Datos Intente Mas tarde...');</script>";	
                  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
			      echo "window.location.href= 'BuzonUsuarios.php'";
			      echo "</script>";
			      exit;}
	        }
				else{
				  echo "<script>alert('Las Contraseñas No Coinciden Vuelva a intentar...');</script>";	
                  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
			      echo "window.location.href= 'IngresarUsuario.php'";
			      echo "</script>";
			      exit;}
			}else{
				  echo "<script>alert('El usuario no puede estar vacio...');</script>";	
                  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
			      echo "window.location.href= 'IngresarUsuario.php'";
			      echo "</script>";
			      exit; 
				  }
		 } }
	  ?>
      <form name="formusuario" action="" method="post">
	  <table width="467" border="0" align="center">
         <tr>
            <td>
			   <table width="467" border="1" align="center">
                 <tr>
                   <td colspan="5"><table width="467" border="0" align="center">
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
                   <td colspan="5"><div align="center" class="boton"><span class="Estilo16">Crear Usuario</span></div></td>
                 </tr>
                 <tr>
                   <tr>
                   <td align="right" valign="middle" class="Estilo12"><div align="right">Usuario</div></td> 
				   		<td width="156"><input name="usuario" type="text" size="25" maxlength="20" /></td></tr>
                   <td align="right" valign="middle" class="Estilo12"><div align="right">Password</div></td>
                   <td width="156"><input name="password" type="password" size="25" maxlength="20" /></td>
                 </tr>
                 <tr>
                   <td align="right" valign="middle" class="Estilo12"><div align="right">Confirmar Password</div></td>
                   <td><input name="passwordconf" type="password" size="25" maxlength="20" /></td>

                 </tr>
				 <tr>
                   <td align="right" valign="middle" class="Estilo12"><div align="right">Tipo de Usuario</div></td>
                   <td><select name="tipo">
                   <option value="1">Operador</option>
                   <option value="5">Administrador</option>
                   </select></td>
				 </tr>
               </table>		    </td>
         </tr>
         <tr>
            <td>&nbsp;</td>
         </tr>
         
         <tr>
            <td><table width="467" border="0" align="center">
              <tr>
                <td width="231">&nbsp;</td>
                <td width="114" align="center">
				  <label>
                     <input name="crear" type="submit" class="boton" value="Crear Usuario" />
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
