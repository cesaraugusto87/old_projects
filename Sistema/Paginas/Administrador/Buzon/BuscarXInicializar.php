<?php
   include('../../../funciones/conexion.php');
   $conexion = Conectarse();  
   
   session_start();
   $cedula   =  $_SESSION['Usuario'];
   $Tipo     =  $_SESSION['tipo'];
   
   $fecha_act = 	date('d/m/Y');
   $sql="Select a.idinicializacion,a.numero_cartuchos,a.num_cartucho2,a.id_nomenclatura,a.fecha_ini,a.fecha_fin,a.fecha_exp,a.tipo,
   		 b.idnomenclatura,b.estante,b.cuerpo,b.tramo,b.boveda,b.gaveta,b.id_frecuencia from cartuchos as a,id_sistema as b 
   		 where fecha_exp >= '".$fecha_act."' AND b.idnomenclatura = a.id_nomenclatura  "; 
   $resultado = pg_query($sql);
   $totalregistros = pg_num_rows($resultado);
   $row_cartuchos = pg_fetch_assoc($resultado);
?>
<html>
   <head>
      <title>Reporte</title>
      <link href="../../../funciones/estilo.css" rel="stylesheet" type="text/css" />
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
		<table width="365" border="1" align="center">
          <tr bgcolor="#F3F3F3" class="boton">
            <td width="287"><div align="center" class="Estilo45">
              <div align="center">
                <div align="center" class="Estilo45"><span class="Estilo13"><font color="#990000"><strong>Nomenclatura</strong></font></span></div>
              </div>
            </div></td>
            <td width="62"><div align="center" class="Estilo45"><font color="#990000"><strong>Eliminar</strong></font></div></td>
          </tr>
		  
             <?php do { ?>
             <tr>
                <td>
                   <div align="left">
				      <p><span class="Estilo4">
				         <font color="#000000">
			          <?php echo $row_cartuchos['id_nomenclatura']; ?> <strong>Fecha Ini =</strong> <?php echo $row_cartuchos['fecha_ini']; ?><strong>Fecha Fin = </strong><?php echo $row_cartuchos['fecha_fin']; ?></font></span></p>
				      <p><strong><font size="2">Cartucho =</font></strong> <span class="Estilo4"><font color="#000000"><?php echo $row_cartuchos['numero_cartuchos']; ?></font></span><font size="2"> de</font> <span class="Estilo4"><font color="#000000"><?php echo $row_cartuchos['num_cartucho2']; ?> <strong>Tipo = </strong><?php echo $row_cartuchos['tipo']; ?></font></span></p>
				      <p>
		                <?php if ($row_cartuchos['id_frecuencia']<> 'M')  {?>
			            </p>
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
				      <font color="#000000">
					      <a target="_self" href="FuncionesTodas.php?cartucho=<?php echo $row_cartuchos['idinicializacion']; ?>&num=<?php echo $row_cartuchos['numero_cartuchos'] ?>&fecha=<?php echo $row_cartuchos['fecha_ini'] ?>&tipo=<?php echo $row_cartuchos['tipo'] ?>&act=A ">
						   <img src="../../../images/encontrado.gif" alt="Eliminar" width="15" height="12" border="0">						 </a>				      </font>				   </div>
				</td>
             </tr>
          <?php }while ($row_cartuchos = pg_fetch_assoc($resultado)); ?>          
        </table>        
	  <?php } else { echo"<span class='Estilo12'>No existen Cartuchos Registrador en el Sistema</span>"; } ?>      </tr>
      <tr>
         <td width="172"><table width="53" border="0" align="center" class="boton">
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
