<?php
   include('../../funciones/conexion.php');
   include('../../funciones/transformfecha.php');
   $conexion = Conectarse();   
   $sql="Select * from ofertacurso"; 		
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
-->
      </style>
</head>
<body>
   <table width="485" border="1" align="center">
      <tr>
         <td colspan="3">
		    <div align="center" class="Estilo16">
		       Cursos Programa Informatica </div>		 </td>
      </tr>
      <tr>
         <td colspan="3">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="3">
		<?php if ($totalregistros > 0){ $i=1;?>		   
		<table width="646" border="1" align="center">
          <tr bgcolor="#F3F3F3" class="boton">
            <td width="17"><span class="Estilo22">No</span></td>
            <td width="169"><div align="center" class="Estilo45">
              <div align="center">
                <div align="center" class="Estilo45"><span class="Estilo13"><font color="#990000"><strong>Curso</strong></font></span></div>
              </div>
            </div></td>
            <td width="8"><div align="center"><span class="Estilo22">Turno </span></div></td>
            <td width="12"><div align="center" class="Estilo22">Inicio</div></td>
            <td width="12"><div align="center" class="Estilo22">Fin</div></td>
            <td width="59"><div align="center"><span class="Estilo22">Requisitos</span></div></td>
            <td width="65"><div align="center"><font color="#990000">Preinscribir</font></div></td>
          </tr> 
             <?php do { ?>
			 <?php 
			    $a = $row_cursos['IdCursos'];
			   	$b = $row_cursos['Secuencia'];
				$c = $row_cursos['Status']; 				
			 ?>
             <tr>
               <td><div align="center" class="Estilo12"><?php echo $i; ?></div></td>
                <td>
                   <div align="left">
				      <a href="../Administrador/modificarconocimiento.php?=&cedula=<?php echo $a; ?>"></a>
				      <span class="Estilo12">
					     <font color="#000000">
						    <?php 
							      $sqlcurso="Select * from curso where (IdCurso = '".$row_cursos['IdCursos']."')"; 		
                                  $resultadocurso = mysql_query($sqlcurso, $conexion);
                                  $row_curso = mysql_fetch_assoc($resultadocurso);   
							      echo $row_curso['Nombre']; 
							
							?>						 </font>				      </span>				   </div>				</td>
				<td class="Estilo4">
				   <div align="center" class="Estilo12">
		       <?php echo $row_cursos['Turno']; ?></div>                </td>
               <td class="Estilo4"><div align="center"><span class="Estilo12"><?php echo cambiaf_a_normal($row_cursos['FechaIni']); ?></span></div></td>
               <td class="Estilo4"><div align="center"><span class="Estilo12"><?php echo cambiaf_a_normal($row_cursos['FechaFin']); ?></span></div></td>
                <td class="Estilo4"><div align="center"><img src="../../images/ojo2.gif" width="20" height="17"></div></td>
                <td class="Estilo4">
				   <div align="center" class="Estilo12"><img src="../../images/feather.gif" width="22" height="16"></div>				</td>
             </tr>
          <?php $i=$i+1;}while ($row_cursos = mysql_fetch_assoc($resultado)); ?>          
        </table>        
	  <?php }else{echo"<span class='Estilo12'>No existen Cursos Registrador en el Sistema</span>";}?>      </tr>
      <tr>
         <td width="282">&nbsp;</td>
         <td width="53"><table width="53" border="0" align="right" class="boton">
           <tr>
             <td width="45"><div align="center"><a href="../Administrador/Buzon/AdminCursos.php">Regresar</a></div></td>
           </tr>
        </table></td>
        <td width="244">&nbsp;</td>
      </tr>
</table>
</body>
</html>
