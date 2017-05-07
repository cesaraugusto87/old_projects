<?php
   include('../../../funciones/conexion.php');
   include('../../../funciones/transformfecha.php');
   $conexion = Conectarse();   
   $sql="Select * from ofertacurso ORDER BY FechaIni,Secuencia ASC"; 		
   $resultado = mysql_query($sql, $conexion);
   $totalregistros = mysql_num_rows($resultado);
   $row_cursos = mysql_fetch_assoc($resultado);      
?>
<html>
   <head>
      <title>Cursos Bases de la Programacion</title>
      <link href="../../../funciones/estilo.css" rel="stylesheet" type="text/css" />
      <style type="text/css">
<!--
.Estilo22 {color: #990000}
.Estilo23 {color: #666666}
.Estilo24 {color: #0000CC}
-->
      </style>
</head>
<body>
   <table width="599" border="8" align="center">
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
		<table width="951" border="1" align="center">
          <tr bgcolor="#F3F3F3" class="boton">
            <td width="17"><div align="center"><span class="Estilo22">No</span></div></td>
            <td width="318"><div align="center" class="Estilo45">
              <div align="center">
                <div align="center" class="Estilo45"><span class="Estilo13"><font color="#990000"><strong>Curso</strong></font></span></div>
              </div>
            </div></td>
            <td width="80"><div align="center"><font color="#990000"><strong>Secuencia</strong></font></div></td>
            <td width="80" align="center"><div align="center"><span class="Estilo22">Inicio</span></div></td>
            <td width="80"><div align="center"><span class="Estilo22">Fin</span></div></td>
            <td width="50"><div align="center" class="Estilo22">Total Cupos </div></td>
            <td width="51"><div align="center" class="Estilo22">Inscritos</div></td>
            <td width="60"><div align="center" class="Estilo22">Disponibles </div></td>
            <td width="60"><div align="center"><span class="Estilo22">Ver Detalles </span></div></td>
            <td width="60"><div align="center"><font color="#990000">Activar / Desactivar </font></div></td>
            <td width="45"><div align="center" class="Estilo45"><font color="#990000"><strong>Eliminar</strong></font></div></td>
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
				      <a href="../modificarconocimiento.php?=&cedula=<?php echo $a; ?>"></a>
				      <span class="Estilo12 Estilo23">
					     
					     <?php 
							      $sqlcurso="Select * from curso where (IdCurso = '".$row_cursos['IdCursos']."')"; 		
                                  $resultadocurso = mysql_query($sqlcurso, $conexion);
                                  $row_curso = mysql_fetch_assoc($resultadocurso);   
							      echo $row_curso['Nombre']; 
							
							?>						 
			         </span>				   </div>				</td>
			   <td width="80" class="Estilo12"><div align="center"><?php echo $row_cursos['Secuencia']; ?></div></td>
                <td width="80" class="Estilo4"><div align="center"><strong><?php echo cambiaf_a_normal($row_cursos['FechaIni']); ?></strong></div></td>
                <td width="80" class="Estilo4"><div align="center"><strong><?php echo cambiaf_a_normal($row_cursos['FechaFin']); ?></strong></div></td>
                <td width="50" class="Estilo12"><div align="center"><?php echo $row_cursos['Cupos']; ?></div></td>
                <td class="Estilo12">
				   <div align="center">
				     <?php
				      $sqlPre="Select * from preinscripcion Where ((IdCurso='".$row_cursos['IdCursos']."')and(Secuencia='".$row_cursos['Secuencia']."'))"; 		
                      $resultadopre = mysql_query($sqlPre, $conexion);
                      $totalregistrospre = mysql_num_rows($resultadopre);                      
					  echo $totalregistrospre;
				   ?>
		           </div></td>
                <td width="60" class="Estilo12"><div align="center"><?php echo ($row_cursos['Cupos'] - $totalregistrospre);?></div></td>
                <td width="60" class="Estilo4">
				   <div align="center">
				      <a href="../Cursos/DetalleProgramado.php?Sec=<?php echo $b; ?>&Id=<?php echo $row_cursos['IdCursos']; ?>">
                         <img src="../../../images/ojo.gif" alt="Ojo" width="22" height="16" border="0">                      </a>                   </div>                </td>
                <td class="Estilo4">
				   <div align="center" class="Estilo12">
				      <?php
					     
					     if ($c == 0){?>
						    <div align="center">
				              <font color="#000000">
					             <a href="../../Administrador/Cursos/Activa-DesactivaCursos.php?IdCurso=<?php echo $a; ?>&Sec=<?php echo $b; ?>&Est=<?php echo $c; ?>">
						    <img src="../../../images/LuzRoja.jpg" alt="Activo Curso" width="15" height="14" border="0">						 </a>				      </font>				   </div>
						 <? }else{?>
						    <div align="center">
				              <font color="#000000">
					             <a href="../../Administrador/Cursos/Activa-DesactivaCursos.php?IdCurso=<?php echo $a; ?>&Sec=<?php echo $b; ?>&Est=<?php echo $c; ?>">
						    <img src="../../../images/LuzVerde.jpg" alt="Activo Curso" width="15" height="14" border="0">						 </a>				      </font>				   </div>
						<? }
					  ?>
				   </div>
				</td>
                <td class="Estilo4">
				   <div align="center">
				      <font color="#000000">
					     <a href="../../Administrador/Cursos/EliminaCursosProgramado.php?Sec=<?php echo $b; ?>&Id=<?php echo $row_cursos['IdCursos']; ?>">
						    <img src="../../../images/Eliminar_II.jpg" alt="Eliminar Curso" width="15" height="14" border="0">						 </a>				      </font>				   </div>				</td>
             </tr>
          <?php $i=$i+1;}while ($row_cursos = mysql_fetch_assoc($resultado)); ?>          
        </table>        
	  <?php }else{echo"<span class='Estilo12'>No existen Cursos Registrador en el Sistema</span>";}?>      </tr>
      <tr>
         <td width="575">&nbsp;</td>
         <td width="53"><table width="53" border="0" align="right" class="boton">
           <tr>
             <td width="45"><a href="PadminCursos.php">Regresar</a></td>
           </tr>
        </table></td>
        <td width="533">&nbsp;</td>
      </tr>
</table>
</body>
</html>
