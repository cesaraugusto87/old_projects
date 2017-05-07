<?php
   session_start();
   $cedula   =  $_SESSION['Usuario'];
   $Tipo     =  $_SESSION['TipoUsuario'];
   if (isset($_POST['Cerrar'])){      
	  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= '../Buzon/AdminCursos.php'";	   
	  echo "</script>";	  
   }else{  
      $ruta = $_POST['Ruta'];
	  if($ruta == ""){
	     echo "<script>alert('La RUTA del archivo no Puede estar Vacio...');</script>"; 
	     echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	     echo "window.location.href= '../Buzon/AdminCursos.php'";	   
	     echo "</script>";	  
	  }else{
         // abrir en modo solo lectura
         $db = dbase_open($ruta, 0);   
         $column_info = dbase_get_header_info($db);
         if ($db){
            $numero_registros = dbase_numrecords($db);
         }
         include('../../../Funciones/conexion.php');
         include('../../../Funciones/transformfecha.php');
         $status = 1;
         $conexion = Conectarse();  
         $sqlelim="Delete From curso";
         $resultadoelim =  mysql_query($sqlelim, $conexion);		  
      }   
   }
?> 
<html>
<head>
      <title>Transformando el Archivo *.DBF a MYSQL... "Archivo Que Conteiene Informacion de MAECURSO.DBF"</title>
      <link href="../funciones/estilo.css" rel="stylesheet" type="text/css">
      <style type="text/css">
<!--
.Estilo22 {color: #FF0000}
-->
      </style>
      <link href="../../../funciones/estilo.css" rel="stylesheet" type="text/css">
</head>
   <body>
   <table width="487" border="5" align="center">
     <tr>
       <td class="boton"><div align="center">Informacion Tabla &quot;MAECURSOS&quot;</div></td>
     </tr>
   </table>
   <table width="599" border="5" align="center">
      <tr>
        <td width="17" class="boton"><div align="center" class="Estilo22">No</div></td>
        <td width="74" class="boton"><div align="center" class="Estilo22">Codigo Curso</div></td>
        <td width="79" class="boton"><div align="center" class="Estilo22">
          <div align="center">Nombre Curso</div>
        </div></td>
     </tr>
     <tr>
       <?php if ($numero_registros > 0){?> 
          <?php for ($i = 1; $i <= $numero_registros; $i++) {?>   
             <?php $row = dbase_get_record_with_names($db, $i);?>  			 
<tr>
             <td class="Estilo12"><div align="center"><?php echo $i;?></div></td>
             <td class="Estilo12"><div align="center"><?php echo $row['CODCURSOS'];?></div></td>
             <td class="Estilo12"><div align="center"><?php echo $row['DESCURSOS'];?></div></td>    
	 </tr>
	    <?		  
	       $sql="insert into curso  values('".$row['CODCURSOS']."','".$row['DESCURSOS']."','')";
           $resultado_set =  mysql_query($sql, $conexion ); 
		   }         
       ?>
	   <?php 
          }else{
             echo"<span class='Estilo12'>No Fue Posible Importar los Datos....</span>";
          }
       ?>
     <tr>
       <td>       
       <td>       
     <td>     </tr>
   </table>
   <table width="245" border="0" align="center" class="boton">
     <tr>
       <td><div align="center"><a href="../Buzon/AdminCursos.php">Data Actualizada con ExitoRegresar... </a></div></td>
     </tr>
   </table>
   <p>&nbsp;</p>
   </body>
</html>