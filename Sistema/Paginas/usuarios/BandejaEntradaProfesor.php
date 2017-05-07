<?php
   session_start();
   $cedula   =  $_SESSION['usuario'];
   $Tipo     =  $_SESSION['tipo'];
   $nota1    =  $_POST['nota1'];
   if ($Tipo == 2){
      include("../../funciones/conexion.php");
      include("../../funciones/transformfecha.php");
      $conexion = Conectarse();   
      if ($cedula == ""){
         echo "<script>alert('Usuario No Existe!!!!!);</script>"; 
	     echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	     echo "window.location.href= 'logearse.php'";
	     echo "</script>";
      }else{
         $sql            =   "SELECT * FROM profesores WHERE (ci ='".$cedula."')";
         $resultado      =   pg_query($sql);
         $row_usuario    =   pg_fetch_assoc($resultado);
         $nombre         =   $row_usuario['nombre'];
	     $apellido       =   $row_usuario['apellido'];
		 $sql_pre        =   "SELECT * FROM reg_academico a, profesores b, asignaturas c where (b.ci ='".$cedula."' AND a.cod_asignatura = c.cod_asignatura)"; 

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
      <script languaje="javascript">
function pasaValor(form)
{form1.recep_pro.value = form1.proyecto.value
alert(form1.recep_pro.value);
}
</script> 
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
                        <td>&nbsp;</td>
                     </tr>
                     <tr>
                       <td height="26" align="right" valign="middle" class="Estilo12"><div align="left" class="Estilo11">
                         <div align="center">Sus Estudiantes</div>
                       </div></td>
                     </tr>
                     <tr>
                       <td height="26" align="right" valign="middle" class="Estilo12">
					   <table width="631" border="1" align="left">
                         <tr>
                           <td width="188" class="boton"><div align="center" class="Estilo22">Materia</div></td>
                           <td width="282" class="boton"><div align="center" class="Estilo22">Estudiante</div></td>
                           <td width="46" bgcolor="#F3F3F3" class="boton"><div align="center" class="Estilo22">Nota</div></td>
                         </tr>
                           <?php
						   if ($totalregistros > 0) {
							$sql_maestro ="SELECT * FROM reg_academico a, profesores b, asignaturas c, alumnos d where (b.ci ='".$cedula."' AND a.cod_asignatura = c.cod_asignatura  AND b.cod_asignatura = a.cod_asignatura AND d.ci = a.ci_est)"; 
                                  $resultado_maestro =   pg_query($sql_maestro);
                                  $row_maestro       =   pg_fetch_assoc($resultado_maestro); 
								  
						    do { ?>
                         <tr>
                           <td class="Estilo12"><div align="left"><?php echo $row_maestro['descripcion'];?></div></td>
                           <td class="Estilo12"><div align="left"><?php echo $row_maestro['nombre'],"  ",$row_maestro['apellido'];?></div></td>
						   <td class="Estilo12"><div align="left"><?php echo $row_maestro['nota'];?></div></td>
						   </td><td class="Estilo4"><div align="center"> <font color="#000000">
                         </tr>
						 <?php }while ($row_maestro = pg_fetch_assoc($resultado_maestro)); ?>
                         <?php 
			                }else{
			                   echo"<span class='Estilo12'>No existen Notas Registrados...</span>";
			                }
			             ?>	 
                         </table>                    </tr>
                     <tr>
                       <td><table width="200" border="5" align="center">
                           <tr>
                             <td><div align="center" >
                               <label></label>
                                 <label>
                                 <input name="Cerrar" type="submit" class="boton" value="Cerrar Sesion">
                               </label>
                             </div></td>
                           </tr>
                       </table></td>
                     </tr>
                     <tr>
                       <td height="26" align="right" valign="middle" class="Estilo12"><p align="center"><strong class="Estilo4"><br>
                       </strong><span class="Estilo4"><strong> Universidad Nacional Experimental de Guayana <br>
 Pto Ordaz - Estado Bolivar - Venezuela
                       </strong></span></p>                         </tr>
                 </table>			   </td>
            </tr>
        </table>
      </form>
   </body>
</html>
