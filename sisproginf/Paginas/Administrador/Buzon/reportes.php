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
      <title>Administrar Usuarios...</title>
      <link href="../../../funciones/estilo.css" rel="stylesheet" type="text/css">
      <style type="text/css">
<!--
.Estilo22 {color: #990000}
-->
      </style>
</head>
   <body><form name="form1" method="post" action="">
     <p>&nbsp;</p>
   <table width="311" height="299" border="8" align="center">
     <tr>
       <td height="25"><div align="right"><span class="Estilo11"><img src="../../../images/LOGOTRANS.jpg" alt="Bandeja  para Data de Usuarios" width="52" height="41" align="left">Reportes Impresos y por Pantallas </span></div></td>
     </tr>
     <tr>
       <td height="198" background="../../../images/fondo.jpg"><p>&nbsp;</p>
           <table width="243" border="1" align="center">
             <tr>
               <td height="27" class="boton"><div align="center"><a href="../Reportes/IndicaCursoParaListado.php">Listados de Estudiantes por Cursos</a><a href="../Usuarios/TipoUsuario.php"></a></div></td>
             </tr>
             <tr>
               <td height="27" class="boton"><div align="center"><a href="../Reportes/ListadoCursosActivos.php" target="_blank">Listados de Cursos Activos </a></div></td>
             </tr>
             <tr>
               <td height="27" class="boton">                 <div align="center"><a href="../Reportes/ListadosCursosProgramados.php" target="_blank">Programacion Docente </a></div></td>
             </tr>
             
             <tr>
               <td height="27" class="boton"><div align="center"><a href="../Reportes/ListadosCursosProgramados.php" target="_blank"></a><a href="../Reportes/ListadoProfe.php" target="_self" class="Estilo22">Listados Aspirante a Profesores</a></div></td>
             </tr>
             <tr>
               <td height="27" class="boton"><div align="left"><a href="../Reportes/ListadoProfe.php"></a>Estadistica de Participantes  </div></td>
             </tr>
             <tr>
               <td class="Estilo13"><div align="center">
                   <input name="Cerrar" type="submit" class="boton" value="Regresar">
               </div></td>
             </tr>
           </table>
         <p>&nbsp;</p></td>
     </tr>
   </table></form>
   </body>
</html>
