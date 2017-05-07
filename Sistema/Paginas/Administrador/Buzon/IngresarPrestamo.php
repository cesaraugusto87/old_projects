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
	background-image: url(../../../images/Copia%20de%20fondo.jpg);
}
-->
   </style></head>
   <body>
      <form name="formusuario" ENCTYPE="multipart/form-data" action="ValidarPrestamo.php" method="post">
	    <p>&nbsp;</p>
	    <table width="467" border="0" align="center">
            

         <tr>
           <td>
			   <p align="center">&nbsp;</p>
			   <br><br><br><table width="497" border="1">
                 <tr>
                   <td colspan="4" align="center" valign="middle"><div align="center"><span class="Estilo16">Ingresar Datos de Prestamo</span></div></td>
                 </tr>
                 <tr>
                   <td align="right" valign="middle" class="Estilo7">N&ordm; de Cartucho</td>
                   <td class="Estilo12"><input name="num_cartucho" onKeyPress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" type="text" size="4" maxlength="8" id="num_cartucho" /></td>
                   <td align="right" valign="middle" class="Estilo7">Nomenclatura</td>
                   <td class="Estilo12"><input name="id_ini" type="text" size="25" maxlength="10" id="id_ini" /></td>
                 </tr>
                 <tr>
                   <td width="70" align="right" valign="middle" class="Estilo7">Plomo</td>
                   <td width="150" class="Estilo12"><input name="plomo" onKeyPress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" type="text" size="25" maxlength="8" /></td>
                   <td width="77" align="right" valign="middle" class="Estilo7">Ubicacion</td>
                   <td width="172" class="Estilo12"><select name="ubicacion" class="Estilo4" id="ubicacion">
                     <?php 
				   $sql_maestro       =   "SELECT * FROM ubicaciones "; 
                   $resultado_maestro =   pg_query($sql_maestro);
                   $row_maestro       =   pg_fetch_assoc($resultado_maestro);
					   do { 
						echo "<option value=";
						echo $row_maestro['idubicacion'];
						echo ">";
						echo $row_maestro['descripcion']; 
						echo "</option>";
					 }while ($row_maestro = pg_fetch_assoc($resultado_maestro)); ?>
                   </select></td>
                 </tr>
                 <tr>
                   <td align="right" valign="middle" class="Estilo7">N&ordm; Planilla</td>
                   <td class="Estilo12"><input name="planilla" onKeyPress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" type="text" size="20" maxlength="50" /></td>
                   <td align="right" valign="middle" class="Estilo7">Hora</td>
                   <td class="Estilo12"><input name="hora" type="text" size="25" maxlength="50" /></td>
                 </tr>
                 <tr>
                   <td align="right" valign="middle" class="Estilo7"><p>Fecha Retiro</p>
                   <p>MM/DD/AAAA</p></td>
                   <td class="Estilo12"><? 
				          escribe_formulario_fecha_vacio("fecharet","formusuario");
	                   ?>				   </td>
                   <td align="right" valign="middle" class="Estilo7"><p>Fecha Envio</p>
                   <p>MM/DD/AAAA</p></td>
                   <td class="Estilo12"><? 
				          escribe_formulario_fecha_vacio("fechaenv","formusuario");
	                   ?></td>
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
