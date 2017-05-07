<?php
   include('../../../funciones/conexion.php');
   $conexion = Conectarse();  
   
   session_start();
   $cedula   =  $_SESSION['Usuario'];
   $Tipo     =  $_SESSION['tipo'];
   	
   $sql="Select * from cartuchos_prestamo "; 		
   $resultado = pg_query($sql);
   $totalregistros = pg_num_rows($resultado);
   $row_cursos = pg_fetch_assoc($resultado);
?>
<html>
   <head>
      <title>Reporte</title>
      <link href="../../funciones/estilo.css" rel="stylesheet" type="text/css" />
   </head>
<body>
   <table width="373" border="1" align="center">
      <tr>
         <td colspan="4">
		    <div align="center" class="Estilo16">		       Listado de cartuchos Prestados</div>		 </td>
      </tr>
      <tr>
         <td colspan="4">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="4">
		<?php if ($totalregistros > 0){?>
		<table width="433" border="1" align="center">
          <tr bgcolor="#F3F3F3" class="boton">
            <td width="287"><div align="center" class="Estilo45">
              <div align="center">
                <div align="center" class="Estilo45"><span class="Estilo13"><font color="#990000"><strong>Cartuchos</strong></font></span></div>
              </div>
            </div></td>
            <td width="62"><div align="center"><font color="#990000">Modificar</font></div></td>
            <td width="62"><div align="center" class="Estilo45"><font color="#990000"><strong>Eliminar</strong></font></div></td>
          </tr>
		  
             <?php do { ?>
             <tr>
                <td>
                   <div align="left">
				      <p><span class="Estilo4">
					          <font color="#000000">
						      <strong>ID</strong> <strong>=</strong> <?php echo $row_cursos['id_inicializacion']; ?>                              <strong>Plomo =</strong>							  <?php echo $row_cursos['id_plomo']; ?></font></span></p>
				      <p><span class="Estilo4"><font color="#000000"><strong>Ubicacion =</strong> 
			          <?php echo $row_cursos['id_ubicacion']; ?><strong> </strong></font> </font>			         </span> </p>
                   </div>
				</td>
				<td class="Estilo4">
	               <div align="center">
	                  <a href="<?php  $sql="UPDATE cartuchos_prestamo "; 		
   $resultado = pg_query($sql);
   $totalregistros = pg_num_rows($resultado);
   $row_cursos = pg_fetch_assoc($resultado);?>">
	                     <img src="../../images/feather.gif" width="21" height="16" border="0">	                  </a>	               </div>
				</td>
                <td class="Estilo4">
				   <div align="center">
				      <font color="#000000">
					     <a href="Elimina.php?cartucho=<?php echo $row_cursos['idnomenclatura']; ?>">
						    <img src="../../images/encontrado.gif" alt="Eliminar Curso" width="15" height="12" border="0">						 </a>				      </font>				   </div>
				</td>
             </tr>
          <?php }while ($row_cursos = pg_fetch_assoc($resultado)); ?>          
        </table>        
	  <?php }else{echo"<span class='Estilo12'>No existen Cursos Registrador en el Sistema</span>";}?>      </tr>
      <tr>
         <td width="172"><table width="53" border="0" align="right" class="boton">
           <tr>
             <td width="45"><div align="center"><a href="BuzonBusqueda.php">Regresar</a></div>
             </td>
           </tr>
         </table></td>
         
</table></td>
         <td width="75">&nbsp;</td>
         <td width="150">&nbsp;</td>
      </tr>
   </table>
</body>
</html>
