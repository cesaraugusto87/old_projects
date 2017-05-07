<?php
   session_start();
   $cedula   =  $_SESSION['Usuario'];
   $Tipo     =  $_SESSION['TipoUsuario'];
   if (($Tipo == 1)or($Tipo == 2)or($Tipo == 5)){
      include('../../funciones/conexion.php');
	  include('../../funciones/transformfecha.php');
      $conexion = Conectarse();   	  
	  if (isset($_POST['m1'])){	  
	     session_start();
         $cedula   =  $_SESSION['Usuario'];
         $Tipo     =  $_SESSION['TipoUsuario'];
	     $nombre         =   $_POST['CampoNombre'];
         $apellido       =   $_POST['CampoApellido'];
         $direccion      =   $_POST['CampoDireccion']; 
         $telf           =   $_POST['CampoTelf'];
         $email          =   $_POST['CampoEmail'];   
	     $edad           =   $_POST['CampoEdad']; 
		 $sql2= "UPDATE participantes SET Nombre='".$nombre."', Apellido='".$apellido."', Direccion='".$direccion."', Telf='".$telf."', Email='".$email."', Edad='".$edad."' WHERE (Cedula='".$cedula."')";
   	     $resultado = mysql_query($sql2,$conexion); 		
         $registros2 = mysql_affected_rows ($conexion);
   	     if($registros2 > 0){		 
	        echo "<script>alert('Operacion realizada con Exito.');</script>"; 
	        echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	        echo "window.location.href= 'PerfilParticipante.php'";	   
	        echo "</script>";
	     }else{
	        echo "<script>alert('Error no se Pudo Modificar...');</script>"; 
	        echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	        echo "window.location.href= 'PerfilParticipante.php'";	   
	        echo "</script>";
	     }
	  }else{
	     session_start();
         $cedula   =  $_SESSION['Usuario'];
         $Tipo     =  $_SESSION['TipoUsuario'];
         $sql="select * from participantes where (Cedula ='".$cedula."')"; 
         $resultado = mysql_query($sql, $conexion);
         $row_usuario = mysql_fetch_assoc($resultado);
	     $ifilas = mysql_affected_rows ($conexion);         
      }		 		 
   }else{      
	  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= '../../Usuarios/logearse.php'";	   
	  echo "</script>";	  
   }     	  
?>
<html>
   <head>
      <title>Formulario de Ingreso de Usuario</title>
	  <script language="JavaScript" src="calendario/javascripts.js"></script>
	  <script language="JavaScript" src="../funciones/validarEntrada.js"></script>
	  <link href="../../funciones/estilo.css" rel="stylesheet" type="text/css">
      <style type="text/css">
<!--
.Estilo23 {color: #FF0000}
-->
      </style>
   </head>
   <body>   <form name="form1" method="post" action="">  
	  <table width="467" border="0" align="center">
         <tr>
            <td>			  
			   <table width="554" border="1" background="../../images/fondo.jpg">
                 <tr>
                    <td colspan="5">
					   <div align="center">
					      <span class="Estilo16">
						     Datos Personales						  </span>					   </div>					</td>
                 </tr>
                 <tr>
                    <td width="38" align="right" valign="middle" class="Estilo7">Cedula</td>
                    <td width="147" class="boton">
                      <?php echo $row_usuario['Cedula'] ?>
				   <input type="hidden" name="CampoCedula" value=<?php echo $row_usuario['Cedula'] ?>></td>
                    <td width="55" align="right" valign="middle" class="Estilo7">Nacionalidad</td>
                    <td width="169" class="boton"><?php echo $row_usuario['Nacionalidad']?></td>
                    <td width="111" rowspan="4">
				       <?php 
								     if ($row_usuario['Foto'] != ""){ 
									    $directorio  = "../../images/";
										$aleatorio = rand (1,1000000); 
								  ?>
								      <img width="100" height="60" src=<?php echo ($directorio.$row_usuario['Foto']);?>?<? echo $aleatorio;?>>								  
							   	  <?php }?>			    </td>
                 </tr>
                 <tr>
                    <td align="right" valign="middle" class="Estilo7">Genero</td>
                    <td class="boton"><?php echo $row_usuario['Genero'] ?></td>
                    <td align="right"  class="Estilo7">F. Nacimiento</td>
                    <td class="boton">
				       <?php echo cambiaf_a_normal($row_usuario['Fecha_Nac']);?>				    </td>
                 </tr>
                 <tr>
                    <td align="right" valign="middle" class="Estilo7">Nombres</td>
                    <td class="boton">
                   <input name="CampoNombre" type="text" class="Estilo11" value=<?php echo $row_usuario['Nombre'] ?> size="20" maxlength="50" />
                   *                    </td>
                    <td align="right" valign="middle" class="Estilo7">Apellidos</td>
                    <td class="boton">
                      <input name="CampoApellido" type="text" class="Estilo11" value =<?php echo $row_usuario['Apellido'] ?> size="25" maxlength="50" />
                      *                    </td>
                 </tr>
                 <tr>
                    <td align="right" valign="middle" class="Estilo7">Telefono</td>
                   <td class="boton"><input name="CampoTelf" type="text" class="Estilo11"  onKeyPress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" value=<?php echo $row_usuario['Telf'] ?> size="12" maxlength="11" />
                   *                    </td>
                    <td align="right" valign="middle" class="Estilo7">Edad</td>
                    <td class="boton">
                      <input name="CampoEdad" type="text" class="Estilo11" onKeyPress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" value =<?php echo $row_usuario['Edad'] ?> size="4" maxlength="2" />
                      *                    </td>
                 </tr>
                 <tr>
                    <td align="right" valign="middle" class="Estilo7">Direccion</td>
                    <td colspan="4" class="boton">
					   <textarea name="CampoDireccion" cols="60" class="Estilo11"><?php echo $row_usuario['Direccion'] ?></textarea>
					   *					</td>
                 </tr>
                 <tr>
                    <td align="right" valign="middle" class="Estilo7">E-mail</td>
                    <td colspan="4" class="boton">
					   <input name="CampoEmail" value=<?php echo $row_usuario['Email'] ?> type="text" class="Estilo11" size="40" maxlength="50" />
					   *					</td>					
                 </tr>
                 <tr>
                   <td colspan="5" align="right" valign="middle" class="Estilo7"><label>
                     <div align="center">
                       <input name="m1" type="submit" class="boton" id="m1" value="Modificar Datos Personales">
                     </div>
                   </label></td>
                 </tr>
              </table>
			</td>
         </tr>
         <tr>
            <td height="35">
			   <table width="584" border="0">
                  <tr>
                     <td width="227">&nbsp;</td>
                     <td width="111">
				        <div align="center" class="boton"><a href="perfilParticipante.php">Regresar</a></div>
				     </td>
                     <td width="232">&nbsp;</td>
                  </tr>
               </table>
		       <p align="center" class="Estilo11"><img src="../../images/von.gif" width="27" height="26">* Solo Puede Modificar los Campos con Asteriscos y color NARANJA. </p></td>
         </tr>
      </table></form>      
   </body>
</html>
