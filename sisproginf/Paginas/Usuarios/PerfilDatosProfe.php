<?php
   include('../../funciones/conexion.php');
   include('../../funciones/transformfecha.php');
   $conexion = Conectarse();   
   session_start();
   $cedula   =  $_SESSION['Usuario'];
   $Tipo     =  $_SESSION['TipoUsuario'];
   $sql="select * from profesor where (Cedula ='".$cedula."')"; 
   $resultado = mysql_query($sql, $conexion);
   $row_usuario = mysql_fetch_assoc($resultado);
   $ifilas = mysql_affected_rows ($conexion);
   if (isset($_POST['NuevaHab'])){ 
      echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
      echo "window.location.href= 'CargaHabilidadesProfe.php?Cedula=$cedula&Tipo=1'";
	  echo "</script>";
	  exit;  	   
   }
   if (isset($_POST['Regresar'])){ 
     echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	 echo "window.location.href= 'BandejaEntradaProfe.php'";	   
	 echo "</script>";	  	   
   }
   if (isset($_POST['Modifica'])){      
      session_start();
      $cedula         =   $_SESSION['Usuario'];
      $Tipo           =   $_SESSION['TipoUsuario'];
      $fecha          =   $_POST['CampoFechaNac'];   	  
	  $nombre         =   $_POST['CampoNombre'];
      $apellido       =   $_POST['CampoApellido'];
      $telf           =   $_POST['CampoTelf'];	  
      $direccion      =   $_POST['CampoDireccion']; 	  
	  $sueldo         =   $_POST['CampoAspSueldo'];    
      $email          =   $_POST['CampoEmail'];   
      $sexo          =   $_POST['CampoSexo'];   
	  $sql2= "UPDATE profesor SET Nombre='".$nombre."', Apellido='".$apellido."', Genero='".$sexo."',	Direccion='".$direccion."', Telf='".$telf."', Email='".$email."', FechaNacimiento='".cambiaf_a_mysql($fecha)."', AspiraSueldo='".$sueldo."' WHERE (Cedula='".$cedula."')";

   	  $resultado = mysql_query($sql2,$conexion); 		
      $registros2 = mysql_affected_rows ($conexion);
   	  if($registros2 > 0){		 
	     echo "<script>alert('Operacion realizada con Exito.');</script>"; 
	     echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	     echo "window.location.href= 'PerfilDatosProfe.php'";	   
	     echo "</script>";
	  }else{
	     echo "<script>alert('Error no se Pudo Modificar...');</script>"; 
	     echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	     echo "window.location.href= 'PerfilDatosProfe.php'";	   
	     echo "</script>";
	  }
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
.Estilo22 {color: #FF0000}
-->
      </style>
</head>
   <body>   <form name="form1" method="post" action="">  
	  <table width="467" border="0" align="center" background="../../images/fondo.jpg">
         
         
         

         <tr>
            <td>			  
			   <table width="583" border="1">
                 <tr>
                   <td colspan="5"><div align="center" class="Estilo16">Datos Personales Profesor</div></td>
                 </tr>
                 <tr>
                   <td width="117" align="right" valign="middle" class="Estilo7">Cedula</td>
                   <td width="86" class="Estilo12"><?php echo $row_usuario['Cedula'] ?></td>
                   <td width="61" align="right" valign="middle" class="Estilo7">Nacionalidad</td>
                   <td width="189" class="Estilo12"><?php echo $row_usuario['Nacionalidad']?></td>
                   <td width="96" rowspan="4">
				   <?php if ($row_usuario['Foto'] != ""){
				      $directorio  = "../../images/";
				   ?>
			          <img width="100" height="85" src=<?php echo $directorio.$row_usuario['Foto']; ?>>								 				   <?php }?>				   </td>
                 </tr>
                 <tr>
                   <td align="right" valign="middle" class="Estilo7">Genero</td>
                   <td class="Estilo12"><input name="CampoSexo" type="text" class="Estilo12" id="CampoSexo" value="<?  echo $row_usuario['Genero']; ?>">
                   </td>
                   <td align="right"  class="Estilo7">F. Nacimiento</td>
                   <td class="Estilo12">
				      <input name="CampoFechaNac" type="text" class="Estilo12" id="CampoFechaNac" value="<?  echo cambiaf_a_normal($row_usuario['FechaNacimiento']); ?>">
                   </td>
                 </tr>
                 <tr>
                   <td align="right" valign="middle" class="Estilo7">Nombres</td>
                   <td class="Estilo12"><input name="CampoNombre" type="text" class="Estilo12" id="CampoNombre" value="<?  echo $row_usuario['Nombre']; ?>">
                   </td>
                   <td align="right" valign="middle" class="Estilo7">Apellidos</td>
                   <td class="Estilo12"><input name="CampoApellido" type="text" class="Estilo12" id="CampoApellido" value="<?  echo $row_usuario['Apellido']; ?>">
                   </td>
                 </tr>
                 <tr>
                   <td align="right" valign="middle" class="Estilo7">Telefono</td>
                   <td class="Estilo12"><input name="CampoTelf" nKeyPress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;"  type="text" class="Estilo12" id="CampoTelf" value="<?  echo $row_usuario['Telf']; ?>">
                   </td>
                   <td align="right" valign="middle" class="Estilo7">Grado Instruccion </td>
                   <td class="Estilo12">
				   <?php 
				      $sql_profesion="SELECT * FROM titulo where (IdTitulo='".$row_usuario['Titulo']."')";
                      $resultado_profesion = mysql_query ($sql_profesion, $conexion);
			          $row_profesion  = mysql_fetch_assoc($resultado_profesion);
       			      echo $row_profesion['Descripcion'] ?>
				   
				   </td>
                 </tr>
                 <tr>
                   <td align="right" valign="middle" class="Estilo7">Direccion</td>
                   <td colspan="4" class="Estilo12">
                     <textarea name="CampoDireccion" cols="77" class="Estilo12" id="CampoDireccion"><?  echo $row_usuario['Direccion']; ?>
                     </textarea>
				   </td>
                 </tr>
                 <tr>
                   <td align="right" valign="middle" class="Estilo7">Aspiraciones de Sueldo </td>
                   <td colspan="4" class="Estilo12">
                     <input name="CampoAspSueldo" type="text" onKeyPress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" class="Estilo12" id="CampoAspSueldo" value="<?  echo $row_usuario['AspiraSueldo']; ?>">
                   </td>
                 </tr>
                 <tr>
                   <td align="right" valign="middle" class="Estilo7">E-mail</td>
                   <td colspan="4" class="Estilo12">
                     <input name="CampoEmail" type="text" class="Estilo12" id="CampoEmail" value="<?  echo $row_usuario['Email']; ?>" size="50">
                   </td>
                 </tr>
                 <tr>
                   <td colspan="5" align="right" valign="middle" class="Estilo7"><div align="center">
                     <input name="Modifica" type="submit" class="boton" id="Modifica" value="Modificar Datos Personales">
                   </div></td>
                 </tr>
                 <tr>
                   <td align="right" valign="middle" class="Estilo7">Curriculo</td>
                   <td colspan="4" ><table width="132" border="1">
                       <tr>
                         <td width="58" class="boton"><div align="center"><a href="<?php $directorio ="../../Archivos/"; echo $directorio.$row_usuario['Curriculo'] ?>"  target="_blank">Descargar</a></div></td>
                         <td width="58" class="boton"><div align="center"><a href="CambiaCurriculo.php?>"  target="_self">Actualizar</a></div></td>
                       </tr>
                   </table>                     
                     <span class="Estilo11 Estilo22">* Solo Archivos PDF</span> </td>
                 </tr>
                 <tr>
                   <td colspan="5" align="right" valign="middle" class="Estilo7">&nbsp;</td>
                 </tr>
                 <tr>
                   <td colspan="5" align="right" valign="middle" class="Estilo7"><div align="center"><span class="Estilo16">Habilidades y Destrezas </span></div></td>
                 </tr>
				 <? 
				    $sql2="select * from habilidades where (CedulaProfe='".$cedula."') order by Descripcion"; 
                    $resultado2 = mysql_query($sql2, $conexion);
                    $row_habilidad = mysql_fetch_assoc($resultado2);
	                $totalregistros = mysql_num_rows($resultado2);
				 ?>
                 <?php if ($totalregistros > 0){?> 
			        <?php do { ?>   
					   <tr>
			              <td colspan="4" class="Estilo12">
						     <li>
							    <?php echo $row_habilidad['Descripcion'];?>							                             </li>						  </td>
						  <td align="Center" class="boton">
						     <a href="EliminaHabilidadProfe.php?Hab=<?php echo $row_habilidad['Descripcion'];?>">Eliminar						  </a></td>
					   </tr>	
		            <?php }while ($row_habilidad = mysql_fetch_assoc($resultado2)); ?>      		        		 <?php 
			        }else{					   
			           echo"<tr><span class='Estilo12'>No Registro Ninguna Habilidad...</span></tr>";
			        }
			     ?>				 
                    <tr>
                      <td colspan="5" align="right" valign="middle" class="Estilo7"><label>
                        <div align="center">
                          <input name="NuevaHab" type="submit" class="boton" id="NuevaHab" value="Ingresar Nueva Habilidad">
                        </div>
                      </label></td>
                    </tr>
                 <tr>
                   <td colspan="5" align="right" valign="middle" class="Estilo7"><div align="left"></div></td>
                 </tr>
              </table>			   </td>
         </tr>
         <tr>
            <td height="30">
              
                <div align="center">
                  <input name="Regresar" type="submit" class="boton" id="Regresar" value="Regresar">
                  
                </div></td>
         </tr>
   </table></form> 
</body>
</html>
