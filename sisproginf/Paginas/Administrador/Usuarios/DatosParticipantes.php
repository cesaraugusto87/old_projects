<?php
   if (isset($_POST['m1'])){
      $cedula         =   $_POST['CampoCedula'];
      $nombre         =   $_POST['CampoNombre'];
      $apellido       =   $_POST['CampoApellido'];
      $direccion      =   $_POST['CampoDireccion']; 
      $telf           =   $_POST['CampoTelf'];
      $email          =   $_POST['CampoEmail'];   
	  $edad           =   $_POST['CampoEdad'];   
      include('../../../funciones/conexion.php');
      $conexion = Conectarse();   
	  $sql2= "UPDATE participantes SET Nombre='".$nombre."', Apellido='".$apellido."', Direccion='".$direccion."', Telf='".$telf."', Email='".$email."', Edad='".$edad."' WHERE (Cedula='".$cedula."')";
      $resultado = mysql_query($sql2,$conexion); 		
      $registros2 = mysql_affected_rows ($conexion);
      if($registros2 > 0){		
 	     echo "<script>alert('Datos Actualizados Correctamente...');</script> "; 
         echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
         echo "window.location.href= 'PideCedula.php'";
		 echo "</script>";
		 exit; 
	  }else{
	     echo "<script>alert('Error no se Pudo Modificar Datos Personales...');</script>"; 
	     echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	     echo "window.location.href= 'PideCedula.php'";	   
	     echo "</script>";
		 exit;
	  }	  	  
   }else{
      if (isset($_POST['m2'])){
	     $login = $_POST['CampoLogin'];
		 $clave = $_POST['CampoClave'];
	     $cedula = $_POST['CampoCedula'];
		 include('../../../funciones/conexion.php');
         $conexion = Conectarse();   		 
		 $sql= "UPDATE usuario SET Login='".$login."', Password='".$clave."' WHERE (CedulaUsuario='".$cedula."')"; 		
	     $resultado = mysql_query($sql, $conexion);
         $registros = mysql_affected_rows ($conexion);
   	     if($registros > 0){
 	        echo "<script>alert('Datos de Usuarios Modificado co Exito.....');</script>"; 
	        echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	        echo "window.location.href= 'PideCedula.php'";	   
	        echo "</script>";      
			exit;
	     }else{
	        echo "<script>alert('Error no se Pudo Modificar Datos de Usuarios...');</script>"; 
	        echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	        echo "window.location.href= 'PideCedula.php'";	   
	        echo "</script>";
			exit;
	     }	  	   		 	  
	  }else{
	     $cedula = $_POST['CampoCedula'];
         if ($cedula != ""){
            include('../../../funciones/conexion.php');
	        include('../../../funciones/transformfecha.php');
            $conexion = Conectarse();   
            $sql="select * from participantes where (Cedula ='".$cedula."')"; 
            $resultado = mysql_query($sql, $conexion);
            $row_usuario = mysql_fetch_assoc($resultado);
	        $ifilas = mysql_affected_rows ($conexion);
            if($ifilas > 0 ){	
	           $sql2="select * from usuario where (CedulaUsuario ='".$cedula."')"; 
               $resultado2 = mysql_query($sql2, $conexion);
               $row_usuario2 = mysql_fetch_assoc($resultado2);
		       $sql_pre        =   "select * from preinscripcion where (CedulaUsuario ='".$cedula."')";             
			   $resultado_pre  =   mysql_query($sql_pre, $conexion);
               $row_pre        =   mysql_fetch_assoc($resultado_pre);
	           $totalregistros =   mysql_num_rows($resultado_pre);
	        }else{
	           echo "<script>alert('No Existe Usuario...');</script>"; 
	           echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	           echo "window.location.href= 'PideCedula.php'";	   
	           echo "</script>";      
	        }
         }else{
            echo "<script>alert('El Campo de la Cedula no Puede estar Vacio...');</script>"; 
	        echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	        echo "window.location.href= 'PideCedula.php'";	   
	        echo "</script>";      
         }             
      }
   }	  	  
?>
<html>
   <head>
      <title>Formulario de Ingreso de Usuario</title>
	  <script language="JavaScript" src="../../Usuarios/calendario/javascripts.js"></script>
	  <script language="JavaScript" src="../../funciones/validarEntrada.js"></script>
      <style type="text/css">
      <!--
         .Estilo1 {
	        font-size: 18px;
	        font-weight: bold;
         }
         .Estilo2 {
	        font-size: 14px;
	        color: #666666;
	        font-weight: bold;
         }
         .Estilo3 {
	        font-size: 10px;
	        font-weight: bold;
         }
         .Estilo4 {font-size: 10}
      -->
   </style>
      <link href="../../../funciones/estilo.css" rel="stylesheet" type="text/css">
   </head>
   <body>   <form name="form1" method="post" action="">  
	  <table width="467" border="0" align="center">
         <tr>
            <td>			  
			   <table width="554" border="1">
                 <tr>
                    <td colspan="5">
					   <div align="center">
					      <span class="Estilo16">
						     Datos Personales						  </span>					   </div>					</td>
                 </tr>
                 <tr>
                    <td width="50" align="right" valign="middle" class="Estilo7">Cedula</td>
                    <td width="110" class="Estilo12">
                      <?php echo $row_usuario['Cedula'] ?>
					  <input type="hidden" name="CampoCedula" value=<?php echo $row_usuario['Cedula'] ?>></td>
                    <td width="62" align="right" valign="middle" class="Estilo7">Nacionalidad</td>
                    <td width="194" class="Estilo12"><?php echo $row_usuario['Nacionalidad']?></td>
                    <td width="96" rowspan="4">
				       <?php 
								     if ($row_usuario['Foto'] != ""){ 
									    $directorio  = "../../../images/";
										$aleatorio = rand (1,1000000); 
								  ?>
								      <img width="100" height="60" src=<?php echo ($directorio.$row_usuario['Foto']);?>?<? echo $aleatorio;?>>								  
							   	  <?php }?>
				    </td>
                 </tr>
                 <tr>
                    <td align="right" valign="middle" class="Estilo7">Genero</td>
                    <td class="Estilo12"><?php echo $row_usuario['Genero'] ?></td>
                    <td align="right"  class="Estilo7">F. Nacimiento</td>
                    <td class="Estilo12">
				       <?php echo cambiaf_a_normal($row_usuario['Fecha_Nac']);?>				    </td>
                 </tr>
                 <tr>
                    <td align="right" valign="middle" class="Estilo7">Nombres</td>
                    <td class="Estilo4">
                      <input name="CampoNombre" type="text" class="Estilo12" value=<?php echo $row_usuario['Nombre'] ?> size="20" maxlength="50" />                    </td>
                    <td align="right" valign="middle" class="Estilo7">Apellidos</td>
                    <td class="Estilo12">
                      <input name="CampoApellido" type="text" class="Estilo12" value =<?php echo $row_usuario['Apellido'] ?> size="25" maxlength="50" />                    </td>
                 </tr>
                 <tr>
                    <td align="right" valign="middle" class="Estilo7">Telefono</td>
                    <td class="Estilo4"><input name="CampoTelf" value=<?php echo $row_usuario['Telf'] ?> type="text" class="Estilo12" onKeyPress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" size="12" maxlength="11" />                    </td>
                    <td align="right" valign="middle" class="Estilo7">Edad</td>
                    <td>
                      <input name="CampoEdad" type="text" class="Estilo12" onKeyPress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" value =<?php echo $row_usuario['Edad'] ?> size="4" maxlength="2" />                    </td>
                 </tr>
                 <tr>
                    <td align="right" valign="middle" class="Estilo7">Direccion</td>
                    <td colspan="4" class="Estilo12">
					   <textarea name="CampoDireccion" cols="60" class="Estilo12"><?php echo $row_usuario['Direccion'] ?></textarea>					</td>
                 </tr>
                 <tr>
                    <td align="right" valign="middle" class="Estilo7">E-mail</td>
                    <td colspan="4" class="Estilo12">
					   <input name="CampoEmail" value=<?php echo $row_usuario['Email'] ?> type="text" class="Estilo12" size="40" maxlength="50" />					</td>					
                 </tr>
                 <tr>
                   <td colspan="5" align="right" valign="middle" class="Estilo7"><label>
                     <div align="center">
                       <input name="m1" type="submit" class="boton" id="m1" value="Modificar Datos Personales">
                       </div>
                   </label></td>
                 </tr>
                 <tr>
                    <td colspan="5" align="right" valign="middle" class="Estilo7">&nbsp;</td>
                 </tr>
                 <tr>
                    <td colspan="5" align="right" valign="middle" class="Estilo7">
					   <div align="center">
					      <span class="Estilo16">
						     Datos de Usuario						  </span>					   </div>					</td>
                 </tr>
                 <tr>
                    <td colspan="5" align="right" valign="middle" class="Estilo7">
					   <table width="265" border="1" align="center">
                          <tr>
                             <td width="38" class="Estilo7"><div align="right">Login</div></td>
                             <td width="211" class="Estilo4">
							    <input name="CampoLogin" type="text" class="Estilo12" value=<?php echo $row_usuario2['Login'];?> size="20" maxlength="50" />							 </td>
                          </tr>
                          <tr>
                             <td class="Estilo7"><div align="right">Password</div></td>
                             <td class="Estilo4">
							    <input name="CampoClave" type="text" class="Estilo12" value=<?php echo $row_usuario2['Password'];?> size="20" maxlength="50" />                             </td>
                          </tr>
                       </table>					</td>
                 </tr>
                 <tr>
                   <td colspan="5" align="right" valign="middle" class="Estilo7"><div align="center">
                     <input name="m2" type="submit" class="boton" id="m2" value="Modificar Datos Usuario">
                   </div></td>
                 </tr>
                 <tr>
                    <td colspan="5" align="right" valign="middle" class="Estilo7">&nbsp;</td>
                 </tr>
                 <tr>
                    <td colspan="5" align="left" valign="middle" class="Estilo7">
					   <div align="center" class="Estilo16">
					      Datos de Pre-Inscripcion					   </div>					</td>
                 </tr>
                 <tr>
                    <td colspan="5" align="left" valign="middle" class="Estilo7">
					   <?php if ($totalregistros > 0){?>
                          <?php do { ?>
                             <?php
							    $sql_curso ="select * from ofertacurso 
where ((IdCursos ='".$row_pre['IdCurso']."')and(Secuencia='".$row_pre['Secuencia']."'))"; 
                                $resultado_curso  =   mysql_query($sql_curso, $conexion);
                                $row_curso        =   mysql_fetch_assoc($resultado_curso);
								$sql_maestro ="select * from curso 
where (IdCurso ='".$row_pre['IdCurso']."')"; 
                                $resultado_maestro =   mysql_query($sql_maestro, $conexion);
                                $row_maestro         =   mysql_fetch_assoc($resultado_maestro);
						     ?>
					         <table width="549" border="1" align="left">
                                <tr>
                                   <td width="125" class="boton"><div align="center" class="Estilo22">Curso</div></td>
                                   <td width="83" class="boton"><div align="center" class="Estilo22">Sec</div></td>
                                   <td width="61" class="boton"><div align="center" class="Estilo22">Turno</div></td>
                                   <td width="74" class="boton">
								      <div align="center">
									     <span class="Estilo22">
										    Inicio										 </span>									  </div>								   </td>
                                   <td width="77" class="boton"><div align="center">Fin</div></td>
                                   <td width="46" class="boton"><div align="center" class="Estilo22">Eliminar</div></td>
                                </tr>
                                <tr>
                                   <td class="Estilo6"><div align="left"><?php echo $row_maestro['Nombre'];?></div></td>
                                   <td class="Estilo6"><div align="center"><?php echo $row_curso['Secuencia'];?></div></td>
                                   <td class="Estilo6"><div align="center"><?php echo $row_curso['Turno'];?></div></td>
                                   <td class="Estilo6">
								      <div align="center">
									     <?php echo cambiaf_a_normal($row_curso['FechaIni']);?>									  </div>								   </td>
                                   <td class="Estilo6"><div align="center"><?php echo cambiaf_a_normal($row_curso['FechaFin']);?></div></td>
                                   <td class="Estilo6">
								      <div align="center">
								         <a href="../Cursos/Eliminapreinscripcion.php?Cedula=<?php echo $row_pre['CedulaUsuario'];?>"><img src="../../../images/Eliminar_II.jpg" width="34" height="18" border="0">									     </a>								       </div>								   </td>
                                </tr>
                          </table>					                                        
				          <?php }while ($row_pre = mysql_fetch_assoc($resultado_pre)); ?>
                       <?php }else{
			                   echo"<span class='Estilo12'>No existen Pre-Inscripciones Registrados...</span>";
			                 }
			           ?>					</td>
                 </tr>
              </table>
			</td>
         </tr>
         <tr>
            <td height="30">
			   <table width="584" border="0">
                  <tr>
                     <td width="227">&nbsp;</td>
                     <td width="111">
				        <div align="center" class="boton"><a href="../Buzon/AdminUsuarios.php">Regresar</a></div>
				     </td>
                     <td width="232">&nbsp;</td>
                  </tr>
               </table>
			</td>
         </tr>
      </table></form>      
   </body>
</html>
