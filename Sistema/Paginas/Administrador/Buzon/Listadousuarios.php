<?php
   include('../../../funciones/conexion.php');
   $conexion = Conectarse();  
   
   session_start();
   $cedula   =  $_SESSION['Usuario'];
   $Tipo     =  $_SESSION['tipo'];
   	
   $sql="SELECT * FROM usuarios "; 		
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


   <table width="373" border="1" align="center">
      <tr>
         <td colspan="4">
		    <div align="center" class="Estilo16">Listado de usuarios en el Sistema</div>		 </td>
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
                <div align="center" class="Estilo45"><span class="Estilo13"><font color="#990000"><strong>Usuario</strong></font></span></div>
              </div>
            </div></td>
            <td width="62"><div align="center"><font color="#990000">Tipo</font></div></td>
            
          </tr>
		  
             <?php do { ?>
             <tr>
                <td>
                   <div align="left">
				      <p><span class="Estilo4">
					          <font color="#000000">
						      <?php echo $row_cursos['login']; ?>                              </font></span></p>
                   </div>
				</td>
				<td class="Estilo4">
	               <div align="center">
	                   <?php 
					   $tipo = $row_cursos['tipo'];
					   if($tipo != 1){  
					   echo "Administrador";
					   }else{
	                      echo "Operador";
						  }?> 	               </div>
				</td>
             </tr>
          <?php }while ($row_cursos = pg_fetch_assoc($resultado)); ?>          
        </table>        
	  <?php }else{echo"<span class='Estilo12'>No existen Usuarios Registrador en el Sistema</span>";}?>      </tr>
      <tr>
         <td width="172" colspan="3"><table width="53" border="0" align="center" class="boton">
           <tr>
             <td width="172" ><div align="center"><a href="BuzonUsuarios.php">Regresar</a></div>
             </td>
           </tr>
        </table></td>
         
</table></td>
         <td width="172">&nbsp;</td>
         <td width="172">&nbsp;</td>
      </tr>
   </table>
</body>
</html>
