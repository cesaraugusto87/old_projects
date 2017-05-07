<?php
   include('../../../funciones/conexion.php');
   $conexion = Conectarse();  
   
   session_start();
   $cedula   =  $_SESSION['Usuario'];
   $Tipo     =  $_SESSION['tipo'];
   
   $fecha_act = 	date('m/d/Y');
   $sql="Select * from cartuchos where fecha_exp >= '".$fecha_act."' "; 		
   $resultado = pg_query($sql);
   $totalregistros = pg_num_rows($resultado);
   $row_cartuchos = pg_fetch_assoc($resultado);
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
		    <div align="center" class="Estilo16">		       Listado de Cartuchos A
		      Inicializar</div>		 </td>
      </tr>
      <tr>
         <td colspan="4">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="4">
		<?php if ($totalregistros > 0){ ?>
		<table width="501" border="1" align="center">
          <tr bgcolor="#F3F3F3" class="boton">
            <td width="287"><div align="center" class="Estilo45">
              <div align="center">
                <div align="center" class="Estilo45"><span class="Estilo13"><font color="#990000"><strong>Nomenclatura</strong></font></span></div>
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
				      <p><span class="Estilo4">
				         <font color="#000000">
					        <?php echo $row_cartuchos['id_nomenclatura']; ?>  </font></span></p> 
				      <?php if ($row_cartuchos['id_frecuencia']<> 'M')  {?>
				      <p><span><font color="#000000" size="2"><strong>Estante	=</strong> <?php echo $row_cartuchos['estante']; ?>
				          <strong>Cuerpo =</strong> <?php echo $row_cartuchos['cuerpo']; ?> 
                          <strong>Tramo =</strong> <?php echo $row_cartuchos['tramo']; ?> </font>
		              </span>
				             </p>
                      <font size="2"><?php }else { ?>
                      </font><p><font size="2"><strong>Boveda =</strong> <span class="Estilo4"><font color="#000000"><?php echo $row_cartuchos['boveda']; ?></font></span> <strong>Gaveta =</strong> <span class="Estilo4"><font color="#000000"><?php echo $row_cartuchos['gaveta']; ?></font></span></font></p>
                   <?php } ?>			
				   </div>
				</td>
				<td class="Estilo4">
	               <div align="center">
	                  <a href="Detalle.php?cartucho=<?php echo $row_cartuchos['idnomenclatura']; ?>">
	                     <img src="../../images/ojo.gif" width="22" height="16" border="0">	                  </a>	               </div>
				</td>
                <td class="Estilo4">
	               <div align="center">
	                  <a href="Modifica.php?cartucho=<?php echo $row_cartuchos['idnomenclatura']; ?>">
	                     <img src="../../images/feather.gif" width="21" height="16" border="0">	                  </a>	               </div>
				</td>
                <td class="Estilo4">
				   <div align="center">
				      <font color="#000000">
					     <a href="Elimina.php?cartucho=<?php echo $row_cartuchos['idnomenclatura']; ?>">
						    <img src="../../images/encontrado.gif" alt="Eliminar Curso" width="15" height="12" border="0">						 </a>				      </font>				   </div>
				</td>
             </tr>
          <?php }while ($row_cartuchos = pg_fetch_assoc($resultado)); ?>          
        </table>        
	  <?php } else { echo"<span class='Estilo12'>No existen Cartuchos Registrador en el Sistema</span>"; } ?>      </tr>
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
