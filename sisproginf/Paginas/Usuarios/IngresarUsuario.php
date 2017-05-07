<html>
   <head>
      <title>Formulario de Ingreso de Usuario</title>
      <link href="../../funciones/estilo.css" rel="stylesheet" type="text/css">
   <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><style type="text/css">
<!--
body {
	background-image: url(../../images/fondo.jpg);
}
-->
</style></head>
   <body>
      <?php
         include('../../Funciones/conexion.php');
         $conexion = Conectarse();   
		 $cedula         =   $_GET['Cedula'];
		 $tipousuario    =   $_GET['Tipo'];
		 if (isset($_POST['CampoLogin'])){
		    $login = $_POST['CampoLogin'];
		    $sql="select * from usuario where (Login ='".$login."')"; 
            $resultado = mysql_query($sql, $conexion );
            $ifilas = mysql_affected_rows ($conexion);
            if($ifilas > 0 ){
	           echo "<script>alert('El Usuario Ya Existe, Intente con Otro!!!!');</script>"; 
	           echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	           echo "window.location.href= 'IngresarUsuario.php?Cedula=$cedula'";	   
	           echo "</script>";	  
            }else{
               $clave         =   $_POST['CampoPassword'];	   	   
	           $status        =   1;
	           $tipo          =   $tipousuario;
	  	       $sql="insert into usuario  values('".$login."','".$clave."','".$status."','".$tipousuario."','".$cedula."')";
   	   	       $resultado_set =  mysql_query($sql, $conexion );
	           $filas_r = mysql_affected_rows ($conexion);
		       if($filas_r > 0){
			      echo "<script>alert('Los datos se han INGRESADO correctamente');</script> "; 
			      echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
           		  echo "window.location.href= 'logearse.php'";
			      echo "</script>";
			      exit; 
	 	       }else{
      		      echo "<script>alert('No se pudo GUARDAR los Datos Intente Mas tarde...');</script>";	
                  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
			      echo "window.location.href= 'logearse.php'";
			      echo "</script>";
			      exit; 
		       }             
	        }
		 }
		 if ($tipousuario == 1){
  	        $query_usuario = "select * from participantes where (Cedula = '".$cedula."')";
		 }else{
		    if ($tipousuario == 2){
  	           $query_usuario = "select * from profesor where (Cedula = '".$cedula."')";
		    }
		 }	
         $usuario = mysql_query($query_usuario, $conexion) or die(mysql_error());

         $row_usuario = mysql_fetch_assoc($usuario);
         $totalRows_usuario = mysql_num_rows($usuario);
         $nombre   =  $row_usuario['Nombre'];
		 $apellido =  $row_usuario['Apellido'];
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
                       <td width="100"><img src=<?php echo "../../images/".$row_usuario['Foto']; ?> alt="1" width="100" height="60"></td>
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
