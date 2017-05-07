<?php
   include('../../funciones/conexion.php');
   $conexion = Conectarse();  
    
   $nomenclatura = $_POST['nomenclatura'];
   $sql="Select a.operador,a.id_mod,a.idinicializacion,a.observaciones,a.id_ubicacion,a.numero_cartuchos,a.num_cartucho2,a.id_nomenclatura,a.fecha_ini,a.fecha_fin,a.fecha_exp,a.tipo,b.idnomenclatura,b.estante,b.id_frecuencia,b.cuerpo,b.tramo,b.boveda,b.gaveta from cartuchos As a, id_sistema As B where a.idinicializacion = upper('".$nomenclatura."') AND a.id_nomenclatura = b.idnomenclatura";
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
		    <div align="center" class="Estilo16">		       Resultados de la busqueda</div>		 </td>
      </tr>
      <tr>
         <td colspan="4">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="4">
		<?php if ($totalregistros > 0){?>
		<table width="365" border="1" align="center">
          <tr bgcolor="#F3F3F3" class="boton">
            <td width="287"><div align="center" class="Estilo45">
              <div align="center">
                <div align="center" class="Estilo45"><span class="Estilo13"><font color="#990000"><strong>Cartuchos</strong></font></span></div>
              </div>
            </div></td>
            <td width="62"><div align="center"><font color="#990000">Rep Secuencia</font></div></td>
          </tr>
		  
             <?php do { ?>
             <tr>
                <td height="250">                  <div align="left"> 
                  <p><span class="Estilo4">
			              <font color="#000000">
				          <strong><font size="2">ID</font></strong><font size="2"> <strong>=</strong> <?php echo $row_cursos['idinicializacion']; ?>                              </font></font></span></p>
                  <p><span class="Estilo4"><font color="#000000"><font size="2"><strong>Cartucho
                            N&ordm;=</strong> <?php echo $row_cursos['numero_cartuchos']; ?> <strong>de</strong>
		          <?php echo $row_cursos['num_cartucho2']; ?></font></font></span></p>
                  <p><font size="2"><span class="Estilo4"><font color="#000000"><strong>Fec Inicio =</strong> 
                  <?php echo $row_cursos['fecha_ini']; ?><strong> Fecha Fin =</strong> </font>
	                  <?php echo $row_cursos['fecha_fin']; ?></span></font></p>
                  <p><font size="2"><span class="Estilo4"><strong><font color="#000000">Ubicacion =</font></strong> </span><?php echo $row_cursos['id_ubicacion']; ?> </font></font></p>
                  <p><font size="2"><span class="Estilo4"><strong><font color="#000000">Operador</font> =</strong></span> <span class="Estilo4"><?php echo $row_cursos['operador']; ?> </span></font></p>
                  <p><font size="2"><strong>Modelo de cartucho = </strong><span class="Estilo4"><?php echo $row_cursos['id_mod']; ?></span></font></p>
                  <p><font size="2"><strong>Fecha de Expiracion =</strong> <span class="Estilo4"><?php echo $row_cursos['fecha_exp']; ?></span></font></p>
                  <p><font size="2">
                  <?php if ($row_cursos['id_frecuencia']<> 'M')  {?>
                        <strong>Estante =</strong> <span class="Estilo4"><font color="#000000"><?php echo $row_cursos['estante']; ?></font></span> <strong>Cuerpo =</strong> <span class="Estilo4"><font color="#000000"><?php echo $row_cursos['cuerpo']; ?></font></span> <strong>Tramo =</strong> <span class="Estilo4"><font color="#000000"><?php echo $row_cursos['tramo']; ?></font></span>
                  </font></p>
                  <p><font size="2">
                  <?php }else { ?>
                  </font>			       <strong><font size="2">Boveda</font> =</strong> <span class="Estilo4"><font color="#000000"><?php echo $row_cursos['boveda']; ?></font></span> <strong><font size="2">Gaveta</font> =</strong> <span class="Estilo4"><font color="#000000"><?php echo $row_cursos['gaveta']; ?></font></span>
                  <?php } ?>			
                  </font></p>
                  <p><font size="2"><strong>Observaciones =</strong> <span class="Estilo4"><?php echo $row_cursos['observaciones']; ?></span></font></p>
                </div>
			   </td>
				<td class="Estilo4">
	               <div align="center">
				   	   <?php 
					   $archivo = "../../images/rep_sec/".$row_cursos['reporte_secuencia'];
					   if(file_exists($archivo)){  ?>
						  <a target="_blank" href="../../images/rep_sec/<?php echo $row_cursos['reporte_secuencia']; ?>">
						  <img src="../../images/ojo.gif" width="22" height="16" border="0"> </a>
					    <?php }else{
	                      echo "No Cargado";
						  }?>

						  </div>
				</td>
             </tr>
          <?php }while ($row_cursos = pg_fetch_assoc($resultado)); ?>          
        </table>        
	  <?php }else{echo"<span class='Estilo12'>No existen el cartucho indicado en el Sistema</span>";}?>      </tr>
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
