<?php
   include('calendario/calendario.php');
   $cedula         =   $_POST['CampoCedula'];
   $nombre         =   $_POST['CampoNombre'];
   $apellido       =   $_POST['CampoApellido'];
   $telf           =   $_POST['CampoTelf'];
   $carrera        =   $_POST['Carrera'];
   $fec_nac		   =   $_POST['CampoFecha'];
   $sexo		   =   $_POST['CampoGenero'];
   $asignatura	   =   $_POST['materia'];
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
      <form name="formusuario" ENCTYPE="multipart/form-data" action="ValidarDatosProfesor.php" method="post">
	    <p>&nbsp;</p>
	    <table width="467" border="0" align="center">
            

         <tr>
           <td>
			   <p align="center"><span class="Estilo16"><img src="../../../images/1siluetas3d-caminante-thumb.gif" width="91" height="52" align="right"></span></p>
			   <br><br><br><table width="497" border="1">
                 <tr>
                   <td colspan="4" align="center" valign="middle"><div align="center"><span class="Estilo16">Ingresar Datos Profesor </span></div></td>
                 </tr>
                 <tr>
                   <td width="45" align="right" valign="middle" class="Estilo7"> Cedula</td>
                   <td width="150" class="Estilo12"><input name="CampoCedula" onKeyPress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" type="text" size="25" maxlength="8" /></td>
                   <td width="35" align="right" valign="middle" class="Estilo7">Materia</td>
                   <td width="156" class="Estilo12"><select name="materia" class="Estilo4">
				    <?php 
				   $sql_maestro       =   "SELECT * FROM asignaturas "; 
                   $resultado_maestro =   pg_query($sql_maestro);
                   $row_maestro       =   pg_fetch_assoc($resultado_maestro);
					   do { 
						echo "<option value=";
						echo $row_maestro['cod_asignatura'];
						echo ">";
						echo $row_maestro['descripcion']; 
						echo "</option>";
					 }while ($row_maestro = pg_fetch_assoc($resultado_maestro)); ?>
                     </select>
                   </td>
                 </tr>
                 <tr>
                   <td align="right" valign="middle" class="Estilo7">Nombres</td>
                   <td class="Estilo12"><input name="CampoNombre" onKeyPress="return validar(event)" type="text" size="20" maxlength="50" /></td>
                   <td align="right" valign="middle" class="Estilo7">Apellidos</td>
                   <td class="Estilo12"><input name="CampoApellido" type="text" size="25" maxlength="50" /></td>
                 </tr>
                 <tr>
                   <td align="right" valign="middle" class="Estilo7">F. Nacimiento</td>
                   <td class="Estilo12"><? 
				          escribe_formulario_fecha_vacio("CampoFecha","formusuario");
	                   ?>				   </td>
                   <td align="right" valign="middle" class="Estilo7">Genero</td>
                   <td class="Estilo12"><select name="CampoGenero" class="Estilo4">
                     <option value="Masculino">M</option>
                     <option value="Femenino">F</option>
                   </select></td>
                 </tr>
                 <tr>
                   <td align="right" valign="middle" class="Estilo7">Telefono</td>
                   <td><input name="CampoTelf" type="text" class="Estilo12" onKeyPress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" size="12" maxlength="11" /></td>
                   <td align="right" valign="middle" class="Estilo7">Carreral</td>
				   <td><select name="Carrera" class="Estilo4">
				    <?php 
				   $sql_maestro       =   "SELECT * FROM carreras "; 
                   $resultado_maestro =   pg_query($sql_maestro);
                   $row_maestro       =   pg_fetch_assoc($resultado_maestro);
					   do { 
						echo "<option value=";
						echo $row_maestro['cod_carrera'];
						echo ">";
						echo $row_maestro['descripcion']; 
						echo "</option>";
					 }while ($row_maestro = pg_fetch_assoc($resultado_maestro)); ?>
                     </select>                   </td>
                 </tr>
           </table>			   </td>
         </tr>
         <tr>
            <td><p align="center">
              <input name="Ingresar" type="submit" class="boton" value="Ingresar Informacion" /><br>
              <input name="Regresar" type="submit" class="boton" id="Regresar" value="Regresar">
                </p>
              <p align="center"><img src="../../../images/von.gif" alt="a" width="42" height="42" align="left"></p></td>
         </tr>
      </table>
    </form>
</body>
</html>
