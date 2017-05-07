<?php
   include('../../funciones/conexion.php');
   $conexion = Conectarse();  
   
   session_start();
   $cedula   =  $_SESSION['Usuario'];
   $Tipo     =  $_SESSION['tipo'];
   	
   $sql="Select * from cartuchos "; 		
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
		    <div align="center" class="Estilo16">		       Listado de cartuchos en
		      uso</div>		 </td>
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
                <td>
                   <div align="left">
				      <p><span class="Estilo4">
					          <font color="#000000">
						      <strong>ID</strong> <strong>=</strong> <?php echo $row_cursos['idinicializacion']; ?>                              <strong>Cartucho N&ordm;=</strong> <?php echo $row_cursos['numero_cartuchos']; ?> <strong>de</strong>
							  <?php echo $row_cursos['num_cartucho2']; ?></font></span></p>
				      <p><span class="Estilo4"><font color="#000000"><strong>Fec Inicio =</strong> 
			          <?php echo $row_cursos['fecha_ini']; ?><strong> Fecha Fin =</strong> </font>
			  		        <?php echo $row_cursos['fecha_fin']; ?> </font>
					        <strong><font color="#000000">Ubicacion =</font></strong> <?php echo $row_cursos['id_ubicacion']; ?> </font>			         </span> </p>
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
	  <?php }else{echo"<span class='Estilo12'>No existen Cursos Registrador en el Sistema</span>";}?>      </tr>
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
