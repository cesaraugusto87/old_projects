<?php
   include('../../funciones/conexion.php');
   include('../../funciones/transformfecha.php');
   $conexion = Conectarse();   
   $sql="Select * from ofertacurso where (Status=1) ORDER BY IdCursos,Secuencia ASC"; 		
   $resultado = mysql_query($sql, $conexion);
   $totalregistros = mysql_num_rows($resultado);
   $row_cursos = mysql_fetch_assoc($resultado);      
?>
<html>
   <head>
      <title>Cursos Bases de la Programacion</title>
      <link href="../../funciones/estilo.css" rel="stylesheet" type="text/css" />
      <style type="text/css">
<!--
.Estilo22 {color: #990000}
.Estilo23 {color: #666666}
.Estilo24 {color: #0000CC}
-->
      </style>
</head>
<body>
   <table width="690" border="8" align="center" background="../../images/fondo.jpg">
      <tr>
         <td colspan="3">
		    <div align="center" class="Estilo16">
		       Programacion Programa Informatica </div>		 </td>
      </tr>
      <tr>
         <td colspan="3">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="3">
		<?php if ($totalregistros > 0){?>
		<table width="675" border="1" align="center">
          <tr bgcolor="#F3F3F3" class="boton">
            <td width="17"><div align="center"><span class="Estilo22">No</span></div></td>
            <td width="160"><div align="center" class="Estilo45">
              <div align="center">
                <div align="center" class="Estilo45"><span class="Estilo13"><font color="#990000"><strong>Curso</strong></font></span></div>
              </div>
            </div></td>
            <td width="10"><div align="center"><font color="#990000"><strong>Secuencia</strong></font></div></td>
            <td width="12" align="center"><div align="center"><span class="Estilo22">Inicio</span></div></td>
            <td width="12"><div align="center"><span class="Estilo22">Fin</span></div></td>
            <td width="6"><div align="center" class="Estilo22">Cupos </div></td>
            <td width="50"><div align="center"><span class="Estilo22">Ver Detalles </span></div></td>
          </tr> 
             <?php $i=1;do { ?>
			 <?php 
			    $a = $row_cursos['IdCursos'];
			   	$b = $row_cursos['Secuencia'];
				$c = $row_cursos['Status']; 
			 ?>
             <tr>
               <td class="boton"><div align="center" class="Estilo24"><? echo $i; ?></div></td>
                <td>
                   <div align="left">
				      <a href="../Administrador/modificarconocimiento.php?=&cedula=<?php echo $a; ?>"></a>
				      <span class="Estilo12 Estilo23">
					     
					     <?php 
							      $sqlcurso="Select * from curso where (IdCurso = '".$row_cursos['IdCursos']."')"; 		
                                  $resultadocurso = mysql_query($sqlcurso, $conexion);
                                  $row_curso = mysql_fetch_assoc($resultadocurso);   
							      echo $row_curso['Nombre']; 
							
							?>						 
			         </span>				   </div>				</td>
			   <td class="Estilo12"><div align="center"><?php echo $row_cursos['Secuencia']; ?></div></td>
               <td class="Estilo4"><div align="center"><strong><?php echo cambiaf_a_normal($row_cursos['FechaIni']); ?></strong></div></td>
               <td class="Estilo4"><div align="center"><strong><?php echo cambiaf_a_normal($row_cursos['FechaFin']); ?></strong></div></td>
               <td class="Estilo12"><div align="center"><?php echo $row_cursos['Cupos']; ?></div></td>
               <td width="50" class="Estilo4">
			      <div align="center">
			         <a href="DetalleProgramado.php?Sec=<?php echo $b; ?>&Id=<?php echo $row_cursos['IdCursos']; ?>">
               <img src="../../images/ojo.gif" alt="Ojo" width="22" height="16" border="0">                      </a>                   </div>                </td>
             </tr>
          <?php $i=$i+1;}while ($row_cursos = mysql_fetch_assoc($resultado)); ?>          
        </table>        
	  <?php }else{echo"<span class='Estilo12'>No existen Cursos Registrador en el Sistema</span>";}?>      </tr>
      <tr>
        <td><p align="center" class="entradas">* Para Reservar un Cupo Debe Registrarse como Usuario. <br>
          * En el Menu Elija la Opcion Registrarse</p>
        </td>
      </tr>
      <tr>         
         <td>
		    <table width="53" border="0" align="center" class="boton">
               <tr>
                  <td width="45"><a href="../news[1].php">Regresar</a></td>
               </tr>
            </table>         </td>        
      </tr>
</table>
 </body>
</html>
