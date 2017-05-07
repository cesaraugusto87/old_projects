<?php
   session_start();
   $cedula   =  $_SESSION['Usuario'];
   $Tipo     =  $_SESSION['TipoUsuario'];
   if (($Tipo == 1)or($Tipo == 2)or($Tipo == 5)){
      include('../../Funciones/conexion.php');
      include('../../Funciones/transformfecha.php');
      $conexion = Conectarse();   
      if ($cedula == ""){
         echo "<script>alert('Primero Tiene que Registrarse como Usuario!!!!');</script>"; 
	     echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	     echo "window.location.href= 'logearse.php'";	   
	     echo "</script>";	  
      }else{
         $sql            =   "select * from participantes where (Cedula ='".$cedula."')"; 
         $resultado      =   mysql_query($sql, $conexion);
         $row_usuario    =   mysql_fetch_assoc($resultado);
         $nombre         =   $row_usuario['Nombre'];
	     $apellido       =   $row_usuario['Apellido']; 
	     $sql_pre        =   "select * from preinscripcion where (CedulaUsuario ='".$cedula."')"; 
         $resultado_pre  =   mysql_query($sql_pre, $conexion);
         $row_pre        =   mysql_fetch_assoc($resultado_pre);
	     $totalregistros =   mysql_num_rows($resultado_pre);
      }
   }else{      
	  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= 'logearse.php'";	   
	  echo "</script>";	  
   }   
   if (isset($_POST['Cerrar'])){
      session_start();
      session_unset();
      session_destroy();
	  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= 'logearse.php'";	   
	  echo "</script>";	  
   }
?>
<html>
   <head>
      <title>Bandeja de Entrada de Usuario</title>
      <link href="../../funciones/estilo.css" rel="stylesheet" type="text/css">
      <style type="text/css">
<!--
.Estilo22 {color: #990000}
body {
	background-image: url(../../images/fondo.jpg);
}
-->
      </style>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"></head>
   <body>
      <form name="formusuario" action="" method="post">
	     <table width="467" border="0" align="center">
            <input name="Cedula" type="hidden" value="$cedula">
            <tr>
               <td>
			      <table width="535" border="1">
                     <tr>
                        <td align="left" valign="middle">
						   
					       <div align="left"><span class="Estilo11">							     </span>
				              <table width="591" border="0">
                                <tr>
                                  <td width="100">
								  <?php 
								     if ($row_usuario['Foto'] != ""){ 
									    $directorio  = "../../images/";
										$aleatorio = rand (1,1000000); 
								  ?>
								      <img width="100" height="60" src=<?php echo ($directorio.$row_usuario['Foto']);?>?<? echo $aleatorio;?>>								  
							   	  <?php }?></td>
                                  <td width="221">&nbsp;</td>
                                  <td width="256"><div align="right"><span class="Estilo11">Bienvenido Sr(a) </span> <span class="Estilo13"> <?php echo $nombre," ",$apellido; ?></span></div></td>
                                </tr>
                                                                </table>
			           </div></td>
                     </tr>
                     <tr>
                        <td>&nbsp;</td>
                     </tr>
                     <tr>
                        <td><table width="200" border="5" align="center">
                          <tr>
                            <td class="Estilo13"><div align="center"><a href="perfilParticipante.php">Editar Mi Cuenta </a></div></td>
                          </tr>
                          
                          <tr>
                            <td class="Estilo13"><div align="center"><a href="BuzonEntrada.php">Preinscribirme</a></div></td>
                          </tr>
                          <tr>
                            <td><div align="center" >
                              <label>
                              <input name="Cerrar" type="submit" class="boton" value="Cerrar Sesion">
                              </label>
                            </div></td>
                          </tr>
                        </table></td>
                     </tr>
                     <tr>
                       <td height="26" align="right" valign="middle" class="Estilo12">&nbsp;</td>
                     </tr>
                     <tr>
                       <td height="26" align="right" valign="middle" class="Estilo12"><div align="left" class="Estilo11">
                         <div align="center">Datos de Pre-Inscripcion </div>
                       </div></td>
                     </tr>
                     <tr>
                       <td height="26" align="right" valign="middle" class="Estilo12">
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
					   <table width="631" border="1" align="left">
                         <tr>
                           <td width="192" class="boton"><div align="center" class="Estilo22">Curso</div></td>
                           <td width="5" class="boton"><div align="center" class="Estilo22">Sec</div></td>
                           <td width="8" class="boton"><div align="center" class="Estilo22">Turno</div></td>
                           <td width="12" class="boton"><div align="center"><span class="Estilo22"> Inicio </span></div></td>
                           <td width="12" class="boton"><div align="center"><span class="Estilo22">Fin</span></div></td>
                           <td width="46" class="boton"><div align="center" class="Estilo22">Eliminar</div></td>
                         </tr>
                         
                         <tr>
                           <td class="Estilo12"><div align="left"><?php echo $row_maestro['Nombre'];?></div></td>
                           <td class="Estilo12"><div align="center"><?php echo $row_curso['Secuencia'];?></div></td>
                           <td class="Estilo12"><div align="center"><?php echo $row_curso['Turno'];?></div></td>
                           <td width="8" class="Estilo12"><div align="center"><?php echo cambiaf_a_normal($row_curso['FechaIni']);?></div></td>
                           <td width="8" class="Estilo12"><div align="center"><?php echo cambiaf_a_normal($row_curso['FechaFin']);?></div></td>
                           <td class="Estilo12"><div align="center"><a href="Eliminapreinscripcion.php?Cedula=<?php echo $row_pre['CedulaUsuario'];?>"><img src="../../images/Eliminar_II.jpg" width="34" height="18" border="0"></a></div></td>
                         </tr>
                         </table>                    </tr>
                     <tr>
                       <td height="26" align="right" valign="middle" class="Estilo12"><div align="center">Recuerde pasar por Nuestras Oficinas Para FORMALIZAR la INSCRIPCION <br>
                       Recomendablemente Una o Dos Semanas Antes de la Fecha de Inicio del Curso.                      </div>
                    </tr>
                     <tr>
                       <td height="26" align="right" valign="middle" class="Estilo12"><p align="center"><strong class="Estilo4"><br>
                       </strong><span class="Estilo4"><strong> CFS Manuel Piar (INCES) -Calle Universidad Frente al Palacio de Justicia<br>
Altavista - Pto Ordaz - Estado Bolivar - Venezuela<br>
Telf: 02869611710</strong></span></p>                         </tr>
				<?php }while ($row_pre = mysql_fetch_assoc($resultado_pre)); ?>
                         <?php 
			                }else{
			                   echo"<span class='Estilo12'>No existen Pre-Inscripciones Registrados...</span>";
			                }
			             ?>	   
                 </table>			   </td>
            </tr>
        </table>
      </form>
   </body>
</html>
