<?php   
   session_start();
   $cedula   =  $_SESSION['Usuario'];
   $Tipo     =  $_SESSION['TipoUsuario'];
   if (($Tipo == 1)or($Tipo == 2)or($Tipo == 5)){
      include('../../../Funciones/conexion.php');
      include('../../../Funciones/transformfecha.php');
      $conexion = Conectarse();   
      $sql            =   "select * from participantes where (Cedula ='".$cedula."')"; 
      $resultado      =   mysql_query($sql, $conexion);
      $row_usuario    =   mysql_fetch_assoc($resultado);
      $nombre         =   $row_usuario['Nombre'];
      $apellido       =   $row_usuario['Apellido']; 
   }else{      
	  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= '../Usuarios/logearse.php'";	   
	  echo "</script>";	  
   }
   if (isset($_POST['Cerrar'])){
      echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= 'BuzonAdministrador.php'";	   
	  echo "</script>";	 
   }  
?>
<html>
   <head>
      <title>Administrar Cursos...</title>
      <link href="../../../funciones/estilo.css" rel="stylesheet" type="text/css">
   </head>
   <body><form name="form1" method="post" action=""><br><br>
     <table width="311" height="299" border="8" align="center">
     <tr>
       <td height="25"><div align="right"><span class="Estilo11"><img src="../../../images/LOGOTRANS.jpg" alt="Bandeja  para Data de Usuarios" width="52" height="41" align="left">Programar Informacion de Cursos </span></div></td>
     </tr>
     <tr>
       <td height="198" background="../../../images/fondo.jpg"><table width="221" border="1" align="center">
         <tr>
           <td height="27" class="boton"><div align="center"><a href="../Cursos/ActualizaDataCur.php" >Actualiza Data Para Cursos Bases </a></div></td>
         </tr>
         <tr>
           <td height="27" class="boton"><div align="center"><a href="../Cursos/ActualizaDataPro.php">Actualizar Data Para la Programacion </a></div></td>
         </tr>
         <tr>
           <td height="27" class="boton"><div align="center"><a href="../Cursos/CursosBases.php">Listado Cursos Bases </a></div></td>
         </tr>
         <tr>
           <td height="27" class="boton"><div align="center"><a href="../Cursos/NuevaProgramacion.php">Nueva Oferta de Curso </a></div></td>
         </tr>
         <tr>
           <td height="27" class="boton"><div align="center"><a href="../Cursos/ActivaCursoporFecha.php">Activar Cursos por Rango de Fechas </a></div></td>
         </tr>
         <tr>
           <td height="27" class="boton"><div align="center"><a href="Tablero.php" target="_top">Programar Tablero de Cursos </a></div></td>
         </tr>
         <tr>
           <td class="boton"><div align="center"><a href="../Cursos/Eliminatodaspreinscripciones.php">Eliminar Todas las Preinscripciones</a> </div></td>
         </tr>
         <tr>
           <td class="Estilo13"><div align="center">
               <input name="Cerrar" type="submit" class="boton" value="Regresar">
           </div></td>
         </tr>
       </table>
       </td>
     </tr>
   </table>
   </form>
   </body>
</html>
