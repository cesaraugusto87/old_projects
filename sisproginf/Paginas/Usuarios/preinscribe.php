<?php
   session_start();
   $cedula   =  $_SESSION['Usuario'];
   $curso     =   $_GET['Curso'];
   $Sec     =   $_GET['Sec'];
   include('../../Funciones/conexion.php');
   $conexion = Conectarse();   
   $sql_pre        =   "select * from preinscripcion where (CedulaUsuario ='".$cedula."')"; 
   $resultado_pre  =   mysql_query($sql_pre, $conexion);
   $row_pre        =   mysql_fetch_assoc($resultado_pre);
   $totalregistros =   mysql_num_rows($resultado_pre);
   if($totalregistros > 0){   
      echo "<script>alert('Ya Usted Se Encuentra Pre-Inscrito para un Curso en el Sistema......');</script>"; 
	  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= 'BandejaEntrada.php'";	   
	  echo "</script>";	
   }else{
      $sql_curso="Select * from ofertacurso where (IdCursos='".$curso."')";
	  $resultado_curso =  mysql_query($sql_curso, $conexion );
	  $row_curso        =   mysql_fetch_assoc($resultado_curso);	  
      $sql_ins       =   "select * from preinscripcion where (IdCurso ='".$curso."')"; 
      $resultado_ins  =   mysql_query($sql_ins, $conexion);
      $totalregistros_ins =   mysql_num_rows($resultado_ins);
	  if (($row_curso['Cupos'] + 5) == $totalregistros_ins){
	     echo "<script>alert('Seccion Llena... Dirijase  a Nuestras Oficina o Llame: Telf (02869611710)');</script> "; 
		 echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
		 echo "window.location.href= 'BandejaEntrada.php'";
		 echo "</script>";
		 exit; 
	  }else{
	     $sql="insert into preinscripcion  values('".$curso."','".$Sec."','".$cedula."')";
	     $resultado_set =  mysql_query($sql, $conexion );
	     $filas_r = mysql_affected_rows ($conexion);
	     if($filas_r > 0){
		    echo "<script>alert('PreInscripcion Realizada Con Exito... ');</script> "; 
		    echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
		    echo "window.location.href= 'BandejaEntrada.php'";
		    echo "</script>";
		    exit; 
	     }else{
      	    echo "<script>alert('No se pudo GUARDAR los Datos Intente Mas tarde...');</script>";	
            echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
		    echo "window.location.href= 'BandejaEntrada.php'";
		    echo "</script>";
		    exit; 
	     }
      }		 
   }
?> 
