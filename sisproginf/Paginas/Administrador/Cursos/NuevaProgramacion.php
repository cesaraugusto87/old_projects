<?php     
   if(isset($_POST['Ingresar'])){
      $curso = $_POST['CampoCurso'];
	  if ($curso == 0){
	     echo "<script>alert('Debe Seleccionar un Curso...');</script> "; 
		 echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
         echo "window.location.href= 'NuevaProgramacion.php'";
		 echo "</script>";
		 exit; 
	  }
	  $CampoSec = $_POST['CampoSec'];
	  if ($CampoSec == 0){
	     echo "<script>alert('Debe Seleccionar una Secuencia para el Curso...');</script> "; 
		 echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
         echo "window.location.href= 'NuevaProgramacion.php'";
		 echo "</script>";
		 exit; 
	  }
	  $FechaIni = $_POST['CampoFI'];
	  if ($FechaIni == ""){
	     echo "<script>alert('Debe Indicar Fecha de Inicio del Curso...');</script> "; 
		 echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
         echo "window.location.href= 'NuevaProgramacion.php'";
		 echo "</script>";
		 exit; 
	  }
	  $FechaFin = $_POST['CampoFF'];
	  if ($FechaFin == ""){
	     echo "<script>alert('Debe Indicar Fecha de Culminacion del Curso...');</script> "; 
		 echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
         echo "window.location.href= 'NuevaProgramacion.php'";
		 echo "</script>";
		 exit; 
	  }
	  $duracion = $_POST['CampoDuracion'];
	  if ($duracion == ""){
	     echo "<script>alert('Debe Indicar Duracion del Curso...');</script> "; 
		 echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
         echo "window.location.href= 'NuevaProgramacion.php'";
		 echo "</script>";
		 exit; 
	  }
	  $cupos = $_POST['CampoCupos'];
	  if ($cupos == ""){
	     echo "<script>alert('Debe Indicar Cantidad de Cupos Disponibles para este Curso...');</script> "; 
		 echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
         echo "window.location.href= 'NuevaProgramacion.php'";
		 echo "</script>";
		 exit; 
	  }
	   $CampoTurno = $_POST['CampoTurno'];
	  if ($CampoTurno == ""){
	     echo "<script>alert('Debe Seleccionar un turno para el Curso...');</script> "; 
		 echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
         echo "window.location.href= 'NuevaProgramacion.php'";
		 echo "</script>";
		 exit; 
	  }
	  include('../../../Funciones/conexion.php');
      include('../../../Funciones/transformfecha.php');
	  $status = 1;
      $conexion = Conectarse();   
      $sql="insert into ofertacurso  values('".$curso."','".$CampoSec."','".cambiaf_a_mysql($FechaIni)."','".cambiaf_a_mysql($FechaFin)."','".$duracion."','".$cupos."','".$CampoTurno."','".$status."')";
      $resultado_set =  mysql_query($sql, $conexion );
      $filas_r = mysql_affected_rows ($conexion);
      if($filas_r > 0){
         echo "<script>alert('Curso INGRESADO y Activo');</script> "; 
	     echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
         echo "window.location.href= 'AdminCursos.php'";
	     echo "</script>";
	     exit; 
      }else{
         echo "<script>alert('No se pudo GUARDAR los Datos Intente Mas tarde...');</script>";	
         echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	     echo "window.location.href= 'AdminCursos.php'";
	     echo "</script>";
	     exit; 
      }
   }   
?>
<html>
   <head>
      <script language="JavaScript" src="../calendario/javascripts.js"></script>
	  <script language="JavaScript" src="../../funciones/validarEntrada.js"></script>
      <title>Administrar Cursos...</title>
      <link href="../../../funciones/estilo.css" rel="stylesheet" type="text/css">	
	  <script language="JavaScript" type="text/JavaScript">
      <!--
         function cambiafechamysqlini($fecha_nom){ 
            ereg( "([0-9]{1,2})/([0-9]{1,2})/([0-9]{2,4})", $fecha_nom, $mifechauno); 
            $fechana=$mifechauno[3]."-".$mifechauno[2]."-".$mi fechauno[1]; 
            return $fechana; 
         } 
      </script>  
   </head>
   <body>
   <form name="formulario" method="post" action="">
     <table width="200" border="10" align="center">
     <tr>
       <td><table width="431" border="1" align="center">
         <tr>
           <td colspan="4" class="Estilo13"><div align="center" class="Estilo16">Nuevo Curso Para la Programacion Ordinaria </div></td>
         </tr>
         <tr>
           <td colspan="4" class="Estilo13">&nbsp;</td>
         </tr>
         <tr>
           <td colspan="4" class="Estilo13"><table width="270" border="1" align="center">
               <tr>
                 <td width="110" class="Estilo19">Curso</td>
                 <td width="146"><?php 
			      //Libreria que permite conectarse a la base de datos 
                  include('../../../funciones/conexion.php');
				  include('../../../funciones/calendario/calendario.php');
                  $conex = Conectarse(); 							   
               	  $sql="SELECT * FROM curso order by Nombre";
			   	  $resultado_set = mysql_query ($sql, $conex);
			      $ifilas = mysql_num_rows ($resultado_set);
		   	   ?>
                     <select name="CampoCurso" class="Estilo12"  maxlength="50">
                       <option value="0">-- Seleccione --</option>
                       <?php
					    for ($ij=0; $ij < $ifilas; $ij++) {
					       $nombrecurso = mysql_result($resultado_set, $ij, 1); 
						   $id = mysql_result($resultado_set, $ij, 0);  						
				     ?>
                       <option value="<?php echo $id ; ?>"><?php echo $nombrecurso; }?></option>
                     </select>
                 </td>
               </tr>
           </table></td>
         </tr>
         <tr>
           <td colspan="4" class="Estilo13"><table width="270" border="1" align="center">
               <tr>
                 <td class="Estilo19">Secuencia</td>
                 <td><select name="CampoSec" class="Estilo12">
                     <option value="0">- - Selecione - -</option>
                     <option value="1">1</option>
                     <option value="2">2</option>
                     <option value="3">3</option>
                     <option value="4">4</option>
                     <option value="5">5</option>
                     <option value="6">6</option>
                     <option value="7">7</option>
                     <option value="8">8</option>
                     <option value="9">9</option>
                     <option value="10">10</option>
                   </select>
                 </td>
               </tr>
               <tr>
                 <td class="Estilo19">Fecha Inicio </td>
                 <td class="Estilo12"><?php
			     escribe_formulario_fecha_vacio("CampoFI","formulario");
	          ?>
                 </td>
               </tr>
               <tr>
                 <td class="Estilo19">Fecha Finalizacion</td>
                 <td class="Estilo12"><?php
			     escribe_formulario_fecha_vacio("CampoFF","formulario");
	          ?></td>
               </tr>
               <tr>
                 <td class="Estilo19">Duracion</td>
                 <td class="Estilo12"><input name="CampoDuracion" type="text" class="Estilo12">
                 </td>
               </tr>
               <tr>
                 <td class="Estilo19">Cupos</td>
                 <td class="Estilo12"><input name="CampoCupos" type="Text" class="Estilo12" onKeyPress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" size="2" maxlength="3"></td>
               </tr>
               <tr>
                 <td width="110" class="Estilo19">Turno</td>
                 <td width="144" class="Estilo12"><?php 
			      $conex = Conectarse(); 							   
               	  $sql="SELECT * FROM turno";
			   	  $resultado_set = mysql_query ($sql, $conex);
			      $ifilas = mysql_num_rows ($resultado_set);
		   ?>
                     <select name="CampoTurno" class="Estilo12"  maxlength="50">
                       <option value="0">-- Seleccione --</option>
                       <?php
					    for ($ij=0; $ij < $ifilas; $ij++) {
					       $nombre = mysql_result($resultado_set, $ij, 0); 
						   $id = mysql_result($resultado_set, $ij, 0);  						
				     ?>
                       <option value="<?php echo $id ; ?>"><?php echo $nombre; }?></option>
                   </select></td>
               </tr>
           </table></td>
         </tr>
         <tr>
           <td colspan="4" class="Estilo13">&nbsp;</td>
         </tr>
         <tr>
           <td width="134" class="Estilo13">&nbsp;</td>
           <td width="68" class="Estilo13"><label>
             <input name="Ingresar" type="submit" class="boton" value="Ingresar">
           </label></td>
           <td width="76" class="boton"><div align="center" class="Estilo10"><a href="../Buzon/AdminCursos.php" class="Estilo3">Regresar</a></div></td>
           <td width="125" class="Estilo13">&nbsp;</td>
         </tr>
       </table></td>
     </tr>
   </table>
   </form>
   </body>
</html>
