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
         $status = 0;
         $conexion = Conectarse();  
         $sqlelim="Delete From ofertacurso";
         $resultadoelim =  mysql_query($sqlelim, $conexion);		   
      }   
   }
?> 
<html>
<head>
      <title>Transformando el Archivo *.DBF a MYSQL...</title>
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
       <td class="boton"><div align="center">Informacion Tabla DBF </div></td>
     </tr>
   </table>
   <table width="599" border="5" align="center">
      <tr>
        <td width="17" class="boton Estilo22"><div align="center" class="Estilo22">No</div></td>
        <td width="74" class="boton Estilo22"><div align="center" class="Estilo22">Dependencia</div></td>
        <td width="79" class="boton"><div align="center" class="Estilo22">
          <div align="center">Codigo Curso </div>
        </div></td>
	    <td width="57" class="boton Estilo22"><div align="center" class="Estilo22">Secuencia</div></td>
	    <td width="71" class="boton Estilo22"><div align="center" class="Estilo22">Fecha Inicio </div></td>
	    <td width="113" class="boton Estilo22"><div align="center" class="Estilo22">Fecha Finalizacion</div></td>
	    <td width="54" class="boton Estilo22"><div align="center" class="Estilo22">Duracion </div></td>
	    <td width="34" class="boton Estilo22"><div align="center" class="Estilo22">Cupos</div></td>
	    <td width="34" class="boton Estilo22"><div align="center" class="Estilo22">Turno</div></td>
     </tr>
     <tr>
       <?php if ($numero_registros > 0){?> 
          <?php for ($i = 1; $i <= $numero_registros; $i++) {?>   
             <?php $row = dbase_get_record_with_names($db, $i);?>  			 
<tr>
             <td class="Estilo12"><div align="center"><?php echo $i;?></div></td>
             <td class="Estilo12"><div align="center"><?php echo $row['DEPENDENC'];?></div></td>
             <td class="Estilo12"><div align="center"><?php echo $row['CODIGO'];?></div></td>
             <td class="Estilo12"><div align="center"><?php echo $row['SECUEN'];?></div></td>
             <td class="Estilo12"><div align="center"><?php echo $row['INICIO'];?></div></td>
             <td class="Estilo12"><div align="center"><?php echo $row['FINAL'];?></div></td>
             <td class="Estilo12"><div align="center"><?php echo $row['HORASDURAC'];?></div></td>
             <td class="Estilo12"><div align="center"><?php echo $row['CUPO'];?></div></td>
             <td class="Estilo12"><div align="center"><?php echo $row['TURNO'];?></div></td>
	 </tr>
	    <?
		   $sqlconsul="Select * from ofertacurso where ((IdCursos='".$row['CODIGO']."')and(Secuencia ='".$row['SECUEN']."'))";
           $resultadoconsul =  mysql_query($sqlconsul, $conexion );		   
		   $totalconsul    =  mysql_num_rows($resultadoconsul);
		   if($totalconsul > 0){
		      $fechaini=$row['INICIO'];
	          $fechafin=$row['FINAL'];
			   
			   $sql="UPDATE ofertacurso SET FechaIni='".cambiaf_a_mysql($fechaini)."', FechaFin='".cambiaf_a_mysql($fechafin)."', Duracion='".$row['HORASDURAC']."', Cupos='".$row['CUPO']."', Turno='".$row['TURNO']."', Status=0 where ((IdCursos='".$row['CODIGO']."')and(Secuencia ='".$row['SECUEN']."'))"; 
		       $resultado_set =  mysql_query($sql, $conexion );
		   }else{
	          $fechaini=$row['INICIO'];
	          $fechafin=$row['FINAL'];
	          $sql="insert into ofertacurso  values('".$row['CODIGO']."','".$row['SECUEN']."','".cambiaf_a_mysql($fechaini)."','".cambiaf_a_mysql($row['FINAL'])."','".$row['HORASDURAC']."','".$row['CUPO']."','".$row['TURNO']."','".$status."')";
              $resultado_set =  mysql_query($sql, $conexion );
           }
        }?>      		  
	    <?php 
          }else{
             echo"<span class='Estilo12'>No existen Requisitos Para este Curso</span>";
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