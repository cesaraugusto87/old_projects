<?php
include('../../funciones/calendario/calendario.php');

?>
<html>
   <head>
      <title>Formulario de Ingreso de Usuario</title>
	  <script language="JavaScript" src="calendario/javascripts.js"></script>
	  <script language="JavaScript" src="../funciones/validarEntrada.js"></script>
      <style type="text/css">
      <!--
         .Estilo3 {
	        font-size: 10px;
	        font-weight: bold;
         }
         .Estilo4 {font-size: 10}
      -->
      </style>
      <link href="../../funciones/estilo.css" rel="stylesheet" type="text/css">
      <style type="text/css">
<!--
.Estilo23 {FONT-FAMILY: Arial, Helvetica, sans-serif; font-size: 12px;}
body {
	background-image: url();
}
.Estilo24 {color: #000066}
-->
      </style>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"></head>
   <body>
      <form name="formusuario" ENCTYPE="multipart/form-data" action="ValidarDatosProfesor.php" method="post">
	  <table width="540" border="0" align="center" background="../../images/fondo.jpg">
         
         
         

         <tr>
            <td align="center"><table width="48" border="0">
                 <tr>
                   <td><div align="center"><img src="../../images/von.gif" alt="a" width="42" height="42" align="left"></div></td>
                 </tr>
               </table>
			   <table width="530" border="1">
                 <tr>
                   <td colspan="6"><div align="center"><span class="Estilo16">Ingresar Datos Personales del Usuario Profesor </span></div></td>
                 </tr>
                 <tr>
                   <td width="68" align="right" valign="middle" class="Estilo7"><div align="right" class="Estilo24">Nacionalidad</div></td>
                   <td width="151" class="Estilo4"><strong>
                     <select name="CampoNac">
                       <option value="0">-- Seleccione --</option>
                       <option value="V">V</option>
                       <option value="E">E</option>
                       </select>
                   </strong></td>
                   <td width="50" align="right" valign="middle" class="Estilo7"><div align="right" class="Estilo24">Cedula</div></td>
                   <td width="125" class="Estilo4"><input name="CampoCedula" type="text" class="Estilo4" onKeyPress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" size="10" maxlength="8" /></td>
                   <td width="30" rowspan="2" class="Estilo7"><span class="Estilo23">
                     <label class="Estilo7">
                     <div align="center" class="Estilo7 Estilo24">Gerero</div>
                     </label>
                   </span></td>
                   <td width="46" rowspan="2" align="center" valign="middle">
                   
                   <select name="CampoGenero" class="Estilo4">
                     <option value="Masculino">M</option>
                     <option value="Femenino">F</option>
                   </select>                  </td>
                 </tr>
                 <tr>
                   <td align="right" valign="middle" class="Estilo7"><div align="right" class="Estilo24">Nombres</div></td>
                   <td class="Estilo4"><input name="CampoNombre" type="text" class="Estilo4" onKeyPress="return validar(event)" size="20" maxlength="20" /></td>
                   <td align="right" valign="middle" class="Estilo7"><div align="right" class="Estilo24">Apellidos</div></td>
                   <td class="Estilo4"><input name="CampoApellido" type="text" class="Estilo4" size="25" maxlength="25" /></td>
                 </tr>
                 <tr>
                   <td align="right" valign="middle" class="Estilo7"><div align="right" class="Estilo24">F.Nacimiento</div></td>
                   <td align="left" valign="middle"><? escribe_formulario_fecha_vacio("CampoFecha","formusuario");
	
		               ?>				   </td>
                   <td align="center" valign="middle" class="Estilo7"><div align="right" class="Estilo24">Telefono</div></td>
                   <td colspan="3"><input name="CampoTelf" type="text" class="Estilo4" onKeyPress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" size="12" maxlength="11" /></td>
                 </tr>
                 <tr>
                   <td align="right" valign="middle" class="Estilo7"><div align="right" class="Estilo24">Direccion</div></td>
                   <td colspan="5"><textarea name="CampoDireccion" cols="60" rows="2" class="Estilo4"></textarea></td>
                 </tr>
                 <tr>
                   <td align="right" valign="middle" class="Estilo7"><div align="right" class="Estilo24">E-mail</div></td>
                   <td colspan="5"><span class="Estilo3">
                     <input name="CampoEmail" type="text" class="Estilo4" size="40" maxlength="50" value="@" />
                   </span></td>
                 </tr>
                 <tr>
                   <td align="right" valign="middle" class="Estilo7 Estilo24"><div align="right" class="Estilo24">Aspiracion de Sueldo </div></td>
                   <td><input name="AspiSueldo" type="text" class="Estilo4" onKeyPress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" size="12" maxlength="11" /></td>
                   <td align="right" valign="middle" class="Estilo7 Estilo24">Grado de Instrruccion </td>
                   <td colspan="3">
				    
			         <table width="223" border="0">
                       <tr>
                         <td><? 
                      include('../../funciones/conexion.php');
                      $conexion = Conectarse();  
			          $sql="SELECT * FROM titulo order by Descripcion";
		              $resultado_set = mysql_query ($sql, $conexion);
				      $ifilas = mysql_num_rows ($resultado_set);
				   ?>
                           <select name="titulo" class="Estilo4"  maxlength="50">
                           <option value="0">-- Seleccione --</option>
                           <?php
					for ($ij=0; $ij < $ifilas; $ij++) {
						$titulos = mysql_result($resultado_set, $ij, 1);  						
						$id = mysql_result($resultado_set, $ij, 0);  						
				?>
                           <option value="<?php echo $id; ?>"><?php echo $titulos; }?></option>
                         </select></td>
                       </tr>
                       <tr>
                         <td class="Estilo11">Si no Aparece en la Lista Ingrese aqui</td>
                       </tr>
                       <tr>
                         <td>
                           <input name="CampoTituloNuevo" type="text" class="Estilo12" id="CampoTituloNuevo" size="35">
                         </td>
                       </tr>
                     </table>
		           </td>
                 </tr>
                 <tr>
                   <td align="right" valign="middle" class="Estilo7"><div align="right" class="Estilo24">Curriculo</div></td>
                   <td colspan="5"><input name="CampoCurriculo" type=file class="Estilo4" value="Curriculo" size="45" maxlength="35" /></td>
                 </tr>
                 <tr>
                   <td align="right" valign="middle" class="Estilo7"><div align="right" class="Estilo24">Foto</div></td>
                   <td colspan="5"><input name="CampoFoto" type=file class="Estilo4" value="Foto" size="45" maxlength="35" /></td>
                 </tr>
              </table>			   </td>
         </tr>
         <tr>
           <td><div align="center">
             <p>
               <input name="Ingresar2" type="submit" class="boton" value="Ingresar y Reportar Habilidades y Destrezas" />
             </p>
             </div></td>
         </tr>
         <tr>
           <td><div align="center">
             <input name="Ingresar1" type="submit" class="boton" id="Ingresar1" value="Ingresar y Salir" />
           </div></td>
         </tr>
         <tr>
            <td><div align="center"><br>
            </div>              <div align="center">
              <input name="Regresar" type="submit" class="boton" id="Regresar" value="Regresar">
            </div></td>
         </tr>
      </table>
    </form>
</body>
</html>
