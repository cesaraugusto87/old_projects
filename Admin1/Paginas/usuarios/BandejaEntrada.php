<?php
   session_start();
   $cedula   =  $_SESSION['usuario'];
   $Tipo     =  $_SESSION['tipo'];
   if (($Tipo == 1)){
      include("../../funciones/conexion.php");
      include("../../funciones/transformfecha.php");
      $conexion = Conectarse();   
      if ($cedula == ""){
         echo "<script>alert('Usuario No Existe!!!!!);</script>"; 
	     echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	     echo "window.location.href= 'logearse.php'";
	     echo "</script>";
      }else{
         $sql            =   "SELECT * FROM alumnos WHERE (ci ='".$cedula."')";
         $resultado      =   pg_query($sql);
         $row_usuario    =   pg_fetch_assoc($resultado);
         $nombre         =   $row_usuario['nombre'];
	     $apellido       =   $row_usuario['apellido'];
		 $sql_pre        =   "SELECT * FROM reg_academico a, profesores b, asignaturas c, carreras d where (a.ci_est ='".$cedula."' AND a.cod_asignatura = c.cod_asignatura AND a.ci_prof = b.ci AND b.cod_carrera = d.cod_carrera)"; 
         $resultado_pre  =   pg_query($sql_pre);
         $row_pre        =   pg_fetch_assoc($resultado_pre);
	     $totalregistros =   pg_num_rows($resultado_pre);
      }
   }else{      
	  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= '../logearse.php'";
	  echo "</script>";
   }   
   if (isset($_POST['Cerrar'])){
      session_start();
      session_unset();
      session_destroy();
	  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= '../logearse.php'";	   
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
.Estilo27 {color: #990000; font-weight: bold; }
.Estilo28 {
	font-size: 12px;
	font-weight: bold;
}
.Estilo30 {color: #990000; font-size: 12px; }
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
                                  <td width="221">&nbsp;</td>
                                  <td width="256"><div align="right"><span class="Estilo11">Bienvenido Sr(a) </span> <span class="Estilo13"> <?php echo $nombre," ",$apellido; ?></span></div></td>
                                </tr>
                             </table>
			           </div></td>
                     </tr>
                     <tr>
                        <td><span class="Estilo16">Datos Personales Estudiante </span></td>
                     </tr>
                     <tr>
                        <td><span class="Estilo30"><strong class="Estilo22">Nombre:</strong></span><span class="Estilo12"><?php echo $row_usuario['nombre'] ?> <?php echo $row_usuario['apellido'] ?></span></td>
                     </tr>
                     <tr>
                       <td class="Estilo7"><span class="Estilo22"><span class="Estilo28">Cedula</span>:</span> <span class="Estilo12"><?php echo $row_pre['ci_est'] ?></span></td>
                     </tr>
                     <tr>
                       <td height="26" align="right" valign="middle" class="Estilo12"><div align="left" class="Estilo27"><span class="Estilo22">Carrera:</span><span class="Estilo12"><?php echo $row_pre['descripcion']?></span></div></td>
                     </tr>
                     <tr>
                       <td height="26" align="right" valign="middle" class="Estilo12"><div align="left" class="Estilo11">
                         <div align="center" class="Estilo16">Sus Notas</div>
                       </div></td>
                     </tr>
                     <tr>
                       <td height="26" align="right" valign="middle" class="Estilo12">
					   <table width="631" border="1" align="left">
                         <tr>
                           <td width="192" class="boton"><div align="center" class="Estilo22">Materia</div></td>
                           <td width="5" class="boton"><div align="center" class="Estilo22">Profesor</div></td>
                           <td width="8" class="boton"><div align="center" class="Estilo22">Nota</div></td>
                         </tr>
                           <?php
						   if ($totalregistros > 0) {
							$sql_maestro ="select * from reg_academico a, profesores b, asignaturas c where (a.ci_est ='".$cedula."' AND a.cod_asignatura = c.cod_asignatura AND a.ci_prof = b.ci)"; 
                                  $resultado_maestro =   pg_query($sql_maestro);
                                  $row_maestro       =   pg_fetch_assoc($resultado_maestro); 
						    do { ?>
                         <tr>
                           <td class="Estilo12"><div align="left"><?php echo $row_maestro['descripcion'];?></div></td>
                           <td class="Estilo12"><div align="left"><?php echo $row_maestro['nombre'],"  ",$row_maestro['apellido'];?></div></td>
                           <td class="Estilo12"><div align="left"><?php echo $row_maestro['nota'];?></div></td>
                         </tr>
						 <?php }while ($row_maestro = pg_fetch_assoc($resultado_maestro)); ?>
                         <?php 
			                }else{
			                   echo"<span class='Estilo12'>No existen Notas Registrados...</span>";
			                }
			             ?>	 
                         </table>                    </tr>
                     <tr>
                       <td height="26" align="right" valign="middle" class="Estilo12"><table width="200" border="5" align="center">
                         <tr>
                           <td><div align="center" >
                               <label>
                               <input name="Cerrar" type="submit" class="boton" value="Cerrar Sesion">
                               </label>
                           </div></td>
                         </tr>
                       </table>
                       <p align="center"><strong class="Estilo4"><br>
                       </strong><span class="Estilo4"><strong> Universidad Nacional Experimental de Guayana <br>
 Pto Ordaz - Estado Bolivar - Venezuela
                       </strong></span></p>                         </tr>
                 </table>			   </td>
            </tr>
        </table>
      </form>
   </body>
</html>
