<?php
   
   include('../../../funciones/conexion.php');
   $conexion = Conectarse();  
		
   $sql="Select * from id_sistema, sistema where idsistema = id_sistema "; 		
   $resultado = pg_query($sql);
   $totalregistros = pg_num_rows($resultado);
   $row_cursos = pg_fetch_assoc($resultado);
?>
<html>
   <head>
      <title>Reporte</title>
      <link href="../../../funciones/estilo.css" rel="stylesheet" type="text/css" />
   </head>
<body>

<script language="Javascript">
function preguntar(nomenclatura){
eliminar=confirm("¿Deseas eliminar este registro?");
if (eliminar)
	window.location.href = "FuncionesTodas.php?cartucho=" + nomenclatura+"&act=A "; 
else
	alert('No se ha eliminado el registro...')
}
</script>


   <table width="373" border="1" align="center">
      <tr>
         <td colspan="4">
		    <div align="center" class="Estilo16">		       Listado de Ubicacion por
		      Sistemas</div>		 </td>
      </tr>
      <tr>
         <td colspan="4">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="4">
		<?php if ($totalregistros > 0){ ?>
		<table width="433" border="1" align="center">
          <tr bgcolor="#F3F3F3" class="boton">
            <td width="287"><div align="center" class="Estilo45">
              <div align="center">
                <div align="center" class="Estilo45"><span class="Estilo13"><font color="#990000"><strong>Nomenclatura</strong></font></span></div>
              </div>
            </div></td>
            <td width="62"><div align="center"><font color="#990000">Modificar</font></div></td>
            <td width="62"><div align="center" class="Estilo45"><font color="#990000"><strong>Eliminar</strong></font></div></td>
          </tr>
		  
             <?php do { ?>
             <tr>
                <td>
                   <div align="left">
				      <p><span class="Estilo4"><font color="#000000"><strong>Descripcion
		              =</strong> <?php echo $row_cursos['descripcion']; ?></font></span></p>
				      <p><span class="Estilo4"><font color="#000000"><strong>Nomenclatura =</strong> <?php echo $row_cursos['idnomenclatura']; ?></font></span></p>
				      <?php if ($row_cursos['id_frecuencia']<> 'M')  {?>
				      <p><span><font color="#000000" size="2"><strong>Estante	=</strong> <?php echo $row_cursos['estante']; ?>
				          <strong>Cuerpo =</strong> <?php echo $row_cursos['cuerpo']; ?> 
                          <strong>Tramo =</strong> <?php echo $row_cursos['tramo']; ?> </font>
		              </span>
		             </p>
                      <font size="2"><?php }else { ?>
                      </font><p><font size="2"><strong>Boveda =</strong> <span class="Estilo4"><font color="#000000"><?php echo $row_cursos['boveda']; ?></font></span> <strong>Gaveta =</strong> <span class="Estilo4"><font color="#000000"><?php echo $row_cursos['gaveta']; ?></font></span></font></p>
                   <?php } ?>			
			      </div>
				</td>
				<td class="Estilo4">
	               <div align="center">
	                  <a target="_blank" href="ModificarIdsistema.php?cartucho=<?php echo $row_cursos['idnomenclatura']; ?>">
	                     <img src="../../../images/feather.gif" width="21" height="16" border="0">	                  </a>	               </div>
				</td>
                <td class="Estilo4">
				   <div align="center">
				      <font color="#000000">
					     <a target="_self" href="javascript:preguntar('<?php echo $row_cursos['idnomenclatura']; ?>')">
						   <img src="../../../images/encontrado.gif" alt="Eliminar" width="15" height="12" border="0">						 </a>				      </font>				   </div>
				</td>
             </tr>
          <?php }while ($row_cursos = pg_fetch_assoc($resultado)); ?>          
        </table>        
	  <?php } else { echo"<span class='Estilo12'>No existen Nomenclaturas Registradas en el Sistema</span>"; } ?>      </tr>
      <tr>
         <td colspan="3" width="172"><table width="53" border="0" align="center" class="boton">
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
