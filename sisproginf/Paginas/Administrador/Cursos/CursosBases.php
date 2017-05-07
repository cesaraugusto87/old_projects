<?php
   include('../../../funciones/conexion.php');
   $conexion = Conectarse();  
    
   $sql="Select * from ofertacurso,curso where (ofertacurso.IdCursos=curso.IdCurso) group by curso.IdCurso order by curso.Nombre"; 		
   $resultado = mysql_query($sql, $conexion);
   $totalregistros = mysql_num_rows($resultado);
   $row_cursos = mysql_fetch_assoc($resultado);
   
?>
<html>
   <head>
      <title>Cursos Bases de la Programacion</title>
      <link href="../../../funciones/estilo.css" rel="stylesheet" type="text/css" />
   </head>
<body>
   <table width="373" border="1" align="center">
      <tr>
         <td colspan="4">
		    <div align="center" class="Estilo16">
		       Cursos Base Programa Informatica </div>		 </td>
      </tr>
      <tr>
         <td colspan="4">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="4">
		<?php if ($totalregistros > 0){?>
		<table width="501" border="1" align="center">
          <tr bgcolor="#F3F3F3" class="boton">
            <td width="287"><div align="center" class="Estilo45">
              <div align="center">
                <div align="center" class="Estilo45"><span class="Estilo13"><font color="#990000"><strong>Curso</strong></font></span></div>
              </div>
            </div></td>
            <td width="62"><div align="center"><font color="#990000">Detalles</font></div></td>
            <td width="62"><div align="center"><font color="#990000">Modificar</font></div></td>
            <td width="62"><div align="center" class="Estilo45"><font color="#990000"><strong>Eliminar</strong></font></div></td>
          </tr>
		  
             <?php do { ?>
             <tr>
                <td>
                   <div align="left">
				      <a href="../modificarconocimiento.php?=&cedula=<?php echo $row_cursos['IdCursos']; ?>"></a>
				      <span class="Estilo4">
					     <font color="#000000">
						    <?php echo $row_cursos['Nombre']; ?>
						 </font>
				      </span>
				   </div>
				</td>
				<td class="Estilo4">
	               <div align="center">
	                  <a href="DetalleCursoBase.php?Id=<?php echo $row_cursos['IdCurso']; ?>">
	                     <img src="../../../images/ojo.gif" width="22" height="16" border="0">	                  </a>	               </div>
				</td>
                <td class="Estilo4">
	               <div align="center">
	                  <a href="ModificaCursoBase.php?Id=<?php echo $row_cursos['IdCurso']; ?>">
	                     <img src="../../../images/feather.gif" width="21" height="16" border="0">	                  </a>	               </div>
				</td>
                <td class="Estilo4">
				   <div align="center">
				      <font color="#000000">
					     <a href="EliminaCursosBases.php?Id=<?php echo $row_cursos['IdCurso']; ?>">
						    <img src="../../../images/encontrado.gif" alt="Eliminar Curso" width="15" height="12" border="0">						 </a>				      </font>				   </div>
				</td>
             </tr>
          <?php }while ($row_cursos = mysql_fetch_assoc($resultado)); ?>          
        </table>        
	  <?php }else{echo"<span class='Estilo12'>No existen Cursos Registrador en el Sistema</span>";}?>      </tr>
      <tr>
         <td width="172">&nbsp;</td>
         <td width="86"><table width="86" border="0" align="left" class="boton">
           <tr>
             <td><div align="center"><a href="IngresaCursoBase.php">Nuevo Curso </a></div></td>
           </tr>
        </table></td>
         <td width="75"><table width="53" border="0" align="right" class="boton">
           <tr>
             <td width="45"><div align="center"><a href="../Buzon/AdminCursos.php">Regresar</a></div></td>
           </tr>
        </table></td>
        <td width="150">&nbsp;</td>
      </tr>
   </table>
</body>
</html>
