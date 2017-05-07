<?php
   include('calendario/calendario.php');
   include('../../../funciones/conexion.php');
   $conexion = Conectarse(); 
?>
<html>
   <head>
      <title>Formulario de Ingreso de Usuario</title>
	  <script language="JavaScript" src="../../usuarios/calendario/javascripts.js"></script>
	  <script language="JavaScript" src="../../../funciones/validarEntrada.js"></script>
      <style type="text/css">
      <!--
         .Estilo1 {
	        font-size: 18px;
	        font-weight: bold;
         }
         .Estilo2 {
	        font-size: 14px;
	        color: #666666;
	        font-weight: bold;
         }
         .Estilo3 {
	        font-size: 10px;
	        font-weight: bold;
         }
         .Estilo4 {font-size: 10}
      -->
   </style>
      <link href="../../../funciones/estilo.css" rel="stylesheet" type="text/css">
   <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><style type="text/css">
<!--
body {
	background-image: url(../../../images/fondo.jpg);
}
-->
   </style></head>
   <body>
      <form name="formusuario" ENCTYPE="multipart/form-data" action="ValidarIdsistema.php" method="post">
	    <p>&nbsp;</p>
	    <table width="467" border="0" align="center">
            

         <tr>
           <td>
			   <p align="center">&nbsp;</p>
			   <br><br><br><table width="497" border="1">
                 <tr>
                   <td colspan="4" align="center" valign="middle"><div align="center"><span class="Estilo16">Ingresar Datos de Identificacion de Sistema</span></div></td>
                 </tr>
                 <tr>
                   <td width="45" align="right" valign="middle" class="Estilo7"> Nomenclatura</td>
                   <td width="150" class="Estilo12"><input name="nomenclatura" type="text" size="25" maxlength="50" /></td>
                   <td width="35" align="right" valign="middle" class="Estilo7">Ambiente</td>
                   <td width="156" class="Estilo12"><select name="ambiente" class="Estilo4">
				    <?php 
				   $sql_maestro       =   "SELECT * FROM ambiente "; 
                   $resultado_maestro =   pg_query($sql_maestro);
                   $row_maestro       =   pg_fetch_assoc($resultado_maestro);
					   do { 
						echo "<option value=";
						echo $row_maestro['idambiente'];
						echo ">";
						echo $row_maestro['descripcion']; 
						echo "</option>";
					 }while ($row_maestro = pg_fetch_assoc($resultado_maestro)); ?>
                     </select>
                   </td>
                 </tr>
                 <tr>
                   <td align="right" valign="middle" class="Estilo7">Sistema</td>
                   <td class="Estilo12"><select name="sistema" class="Estilo4">
                     <?php 
				   $sql_maestro       =   "SELECT * FROM sistema "; 
                   $resultado_maestro =   pg_query($sql_maestro);
                   $row_maestro       =   pg_fetch_assoc($resultado_maestro);
					   do { 
						echo "<option value=";
						echo $row_maestro['idsistema'];
						echo ">";
						echo $row_maestro['descripcion']; 
						echo "</option>";
					 }while ($row_maestro = pg_fetch_assoc($resultado_maestro)); ?>
                   </select></td>
                   <td align="right" valign="middle" class="Estilo7">Frecuencia</td>
                   <td class="Estilo12"><select name="frecuencia" class="Estilo4">
                     <?php 
				   $sql_maestro       =   "SELECT * FROM frecuencia "; 
                   $resultado_maestro =   pg_query($sql_maestro);
                   $row_maestro       =   pg_fetch_assoc($resultado_maestro);
					   do { 
						echo "<option value=";
						echo $row_maestro['idfrecuencia'];
						echo ">";
						echo $row_maestro['frecuencia']; 
						echo "</option>";
					 }while ($row_maestro = pg_fetch_assoc($resultado_maestro)); ?>
                   </select></td>
                 </tr>
                 <tr>
                   <td align="right" valign="middle" class="Estilo7">Estante</td>
                   <td class="Estilo12"><input name="estante" onKeyPress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" type="text" size="20" maxlength="50" /></td>
                   <td align="right" valign="middle" class="Estilo7">Cuerpo</td>
                   <td class="Estilo12"><input name="cuerpo" type="text" size="25" maxlength="50" /></td>
                 </tr>
                 <tr>
                   <td align="right" valign="middle" class="Estilo7">Tramo</td>
                   <td><input name="tramo" type="text" class="Estilo12" onKeyPress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" size="12" maxlength="11" /></td>
                   <td align="right" valign="middle" class="Estilo7">&nbsp;</td>
				   <td>&nbsp;</td>
                 </tr>
           </table>			   </td>
         </tr>
         <tr>
            <td><p align="center">
              <input name="Ingresar" type="submit" class="boton" value="Ingresar Informacion" /><br>
              <input name="Regresar" type="submit" class="boton" id="Regresar" value="Regresar">
                </p>
              <p align="center">&nbsp;</p></td>
         </tr>
      </table>
    </form>
</body>
</html>
