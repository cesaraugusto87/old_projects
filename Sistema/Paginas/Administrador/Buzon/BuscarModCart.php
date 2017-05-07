<?php
   include('../../../funciones/conexion.php');
   $conexion = Conectarse(); 
   	
   $sql="Select COUNT(id_mod) as TOTAL, id_mod from cartuchos group by id_mod"; 
   $resultado = pg_query($sql);
   $totalregistros = pg_num_rows($resultado);
   $row_cursos = pg_fetch_assoc($resultado);
   
   $sql2="Select COUNT(*) as total_todo from cartuchos "; 
   $resultado2 = pg_query($sql2);
   $totalregistros2 = pg_num_rows($resultado2);
   $row_cursos2 = pg_fetch_assoc($resultado2);
   
   $sql3="Select COUNT(id_mod) as total, id_mod, id_ubicacion from cartuchos where id_ubicacion = 'AV' group by id_mod,id_ubicacion "; 
   $resultado3 = pg_query($sql3);
   $totalregistros3 = pg_num_rows($resultado3);
   $row_av = pg_fetch_assoc($resultado3);
   
   $sql4="Select COUNT(*) as total_todo from cartuchos where id_ubicacion = 'AV' "; 
   $resultado4 = pg_query($sql4);
   $totalregistros4 = pg_num_rows($resultado4);
   $row_av2 = pg_fetch_assoc($resultado4);
   
   $sql5="Select COUNT(id_mod) as total, id_mod, id_ubicacion from cartuchos where id_ubicacion = 'CA' group by id_mod,id_ubicacion "; 
   $resultado5 = pg_query($sql5);
   $totalregistros5 = pg_num_rows($resultado5);
   $row_ca = pg_fetch_assoc($resultado5);
   
   $sql6="Select COUNT(*) as total_todo from cartuchos where id_ubicacion = 'CA' "; 
   $resultado6 = pg_query($sql6);
   $totalregistros6 = pg_num_rows($resultado6);
   $row_ca2 = pg_fetch_assoc($resultado6);
   
   $sql7="Select COUNT(id_mod) as total, id_mod, id_ubicacion from cartuchos where id_ubicacion = '321' group by id_mod,id_ubicacion "; 
   $resultado7 = pg_query($sql7);
   $totalregistros7 = pg_num_rows($resultado7);
   $row_321 = pg_fetch_assoc($resultado7);
   
   $sql8="Select COUNT(*) as total_todo from cartuchos where id_ubicacion = '321' "; 
   $resultado8 = pg_query($sql8);
   $totalregistros8 = pg_num_rows($resultado8);
   $row_321a = pg_fetch_assoc($resultado8);
   
   $sql10="Select idmod,cantidad from mod_cartucho order by cantidad"; 
   $resultado10 = pg_query($sql10);
   $totalregistros10 = pg_num_rows($resultado10);
   $row_vacios = pg_fetch_assoc($resultado10);
   
   $sql9="Select Sum(cantidad) as total_vacio from mod_cartucho"; 
   $resultado9 = pg_query($sql9);
   $totalregistros9 = pg_num_rows($resultado9);
   $row_vacios2 = pg_fetch_assoc($resultado9);
   
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
		    <div align="center" class="Estilo16">		       Totales de Cartuchos</div>		 </td>
      </tr>
      <tr>
         <td colspan="4">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="4">
		<?php if ($totalregistros > 0){?>
		<table width="297" border="1" align="center">
          <tr bgcolor="#F3F3F3" class="boton">
            <td width="287"><div align="center" class="Estilo45">
              <div align="center">
                <div align="center" class="Estilo45"><span class="Estilo13"><font color="#990000"><strong>Cartuchos
                        Totales</strong></font></span></div>
              </div>
            </div></td>
          </tr>
		  <td>  <strong>Total de Cartuchos</strong> <strong>=</strong> <?php echo $row_cursos2['total_todo']; ?>   </font></span></p></td>
             <?php do { ?>
          <tr>
                <td>
                   <div align="left">
				      <p><span class="Estilo4">
					          <font color="#000000">
			        
				      <p><span class="Estilo4"><font color="#000000"><strong>Cartucho Modelo  <?php echo $row_cursos['id_mod']; ?></strong> = <?php echo $row_cursos['total']; ?> </font></span></p>
				      
	                  <strong></strong></span> </p>
                   </div>
				</td>
		  </tr>
          <?php }while ($row_cursos = pg_fetch_assoc($resultado)); ?>          
        </table>        
	  <?php }else{echo"<span class='Estilo12'>No existen Cursos Registrador en el Sistema</span>";}?>      <p>&nbsp;</p>
	  <table width="297" border="1" align="center">
        <tr bgcolor="#F3F3F3" class="boton">
          <td width="287"><div align="center" class="Estilo45">
              <div align="center">
                <div align="center" class="Estilo45"><span class="Estilo13"><font color="#990000"><strong>Centro
                        Alterno</strong></font></span></div>
              </div>
            </div>
          </td>
        </tr>
  <td> <strong>Total de Cartuchos</strong> <strong>=</strong> <?php echo $row_ca2['total_todo']; ?>
          <p></p>
    </td>
      <?php do { ?>
  <tr>
    <td>
      <div align="left">
        <p>
        <span class="Estilo4"> </span>
        <p><span class="Estilo4"><font color="#000000"><strong>Cartucho Modelo <?php echo $row_ca['id_mod']; ?></strong> = <?php echo $row_ca['total']; ?> </font></span></p>
        <p></p>
      </div>
    </td>
  </tr>
  <?php }while ($row_ca = pg_fetch_assoc($resultado5)); ?>
      </table>	  
	  <p>&nbsp;</p>
	  <table width="297" border="1" align="center">
        <tr bgcolor="#F3F3F3" class="boton">
          <td width="287"><div align="center" class="Estilo45">
              <div align="center">
                <div align="center" class="Estilo45"><span class="Estilo13"><font color="#990000"><strong>Alta
                Vista</strong></font></span></div>
              </div>
            </div>
          </td>
        </tr>
  <td> <strong>Total de Cartuchos</strong> <strong>=</strong> <?php echo $row_av2['total_todo']; ?>
          <p></p>
    </td>
      <?php do { ?>
  <tr>
    <td>
      <div align="left">
        <p>
        <span class="Estilo4"> </span>
        <p><span class="Estilo4"><font color="#000000"><strong>Cartucho Modelo <?php echo $row_av['id_mod']; ?></strong> = <?php echo $row_av['total']; ?> </font></span></p>
        <p></p>
      </div>
    </td>
  </tr>
  <?php }while ($row_av = pg_fetch_assoc($resultado3)); ?>
      </table>	  
	  <p>&nbsp;</p>
	  <table width="297" border="1" align="center">
        <tr bgcolor="#F3F3F3" class="boton">
          <td width="287"><div align="center" class="Estilo45">
              <div align="center">
                <div align="center" class="Estilo45"><span class="Estilo13"><font color="#990000"><strong>321</strong></font></span></div>
              </div>
            </div>
          </td>
        </tr>
  <td> <strong>Total de Cartuchos</strong> <strong>=</strong> <?php echo $row_321a['total_todo']; ?>
          <p></p>
    </td>
      <?php do { ?>
  <tr>
    <td>
      <div align="left">
        <p>
        <span class="Estilo4"> </span>
        <p><span class="Estilo4"><font color="#000000"><strong>Cartucho Modelo <?php echo $row_321['id_mod']; ?></strong> = <?php echo $row_321['total']; ?> </font></span></p>
        <p></p>
      </div>
    </td>
  </tr>
  <?php }while ($row_321 = pg_fetch_assoc($resultado7)); ?>
      </table>	  
	  <p>&nbsp;</p>
	  <table width="297" border="1" align="center">
        <tr bgcolor="#F3F3F3" class="boton">
          <td width="287"><div align="center" class="Estilo45">
              <div align="center">
                <div align="center" class="Estilo45"><span class="Estilo13"><font color="#990000"><strong>Cartuchos
                        Vacios</strong></font></span></div>
              </div>
            </div>
          </td>
        </tr>
  <td> <strong>Total de Cartuchos</strong> <strong>=</strong> <?php echo $row_vacios2['total_vacio']; ?>
          <p></p>
    </td>
      <?php do { ?>
  <tr>
    <td>
      <div align="left">
        <p> <span class="Estilo4"> </span>
        <p><span class="Estilo4"><font color="#000000"><strong>Cartucho Modelo <?php echo $row_vacios['idmod']; ?></strong> = <?php echo $row_vacios['cantidad']; ?> </font></span></p>
        <p></p>
      </div>
    </td>
  </tr>
  <?php }while ($row_vacios = pg_fetch_assoc($resultado10)); ?>
      </table>
	  <p>&nbsp;</p>
	  <p>&nbsp;</p>	  <p>&nbsp;</p>
	  <p>&nbsp;</p>
        </tr>
      <tr>
         <td width="172" colspan="2"><table width="53" border="0" align="center" class="boton">
           <tr>
             <td width="45"><div align="center"><a href=../Buzon/BuzonBusqueda.php>Regresar</a></div>
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
