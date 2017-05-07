<?php
   include('calendario/calendario.php');
   include('../../../funciones/conexion.php');
   $conexion = Conectarse(); 
   session_start();
   $cedula   =  $_SESSION['Usuario'];
   $Tipo     =  $_SESSION['tipo'];
?>
<html>
   <head>
      <title>Indique Nomenclatura Para Mostrar Datos...</title>
      
      <link href="../../../funciones/estilo.css" rel="stylesheet" type="text/css">
      <style type="text/css">
<!--
.Estilo22 {color: #FF0000}
-->
      </style>
</head>
   <body>
   <form action="listadomod2.php" target="_blank" method="post" name="formulario">
      <p>&nbsp;</p>
      <table width="311" height="299" border="8" align="center">
        <tr>
          <td height="25"><div align="center"><span class="Estilo11">Buscar Por Modelo de Cartucho</span></div></td>
        </tr>
        <tr>
          <td height="163" background="../../../images/fondo.jpg"><p>&nbsp;</p>
          <table width="163" border="5" align="center">
            <tr>
              <td><table width="163" height="100" border="0" align="center" cellpadding="0" cellspacing="0" class="Estilo4">
                  <!--DWLayoutTable-->
                  <tr>
                    <th height="25" valign="center"><div align="center" class="boton">Indique Modelo de Cartucho</div></th>
                  </tr>
                  <tr>
                    <th height="25" valign="center"><div align="center">
                        <select name="mod_cart" class="Estilo4" id="mod_cart">
                     <?php 
				   $sql_maestro       =   "SELECT * FROM mod_cartucho "; 
                   $resultado_maestro =   pg_query($sql_maestro);
                   $row_maestro       =   pg_fetch_assoc($resultado_maestro);
					   do { 
						echo "<option value=";
						echo $row_maestro['idmod'];
						echo ">";
						echo $row_maestro['unidad_resp']; 
						echo "</option>";
					 }while ($row_maestro = pg_fetch_assoc($resultado_maestro)); ?>
                   </select>
                    </div></th>
                  </tr>
                  <tr>
                    <th height="25" valign="center"><div align="center">
                        <input name="submit2" type="submit" class="boton" value="Buscar">
                    </div></th>
                  </tr>
                  <tr>
                    <th width="163" height="25" valign="center">
					<table width="59" height="25" border="0" align="center">
                        <tr>
                          <td width="53"><div align="center" class="boton"><a href="BuzonBusqueda.php">Atras</a></div></td>
                        </tr>
                      </table>
                        <div align="center"></div>
                        <div align="center"></div>
                      <div align="center"></div></th>
                  </tr>
              </table></td>
            </tr>
          </table>
          <p>&nbsp;</p>
              <p>&nbsp;</p></td>
        </tr>
      </table>
      <p>&nbsp;</p>
      </form>
   </body>
</html>