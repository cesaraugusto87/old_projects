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
   
   	<STYLE TYPE="text/css">
	<!--
		@page { margin: 2cm }
		P { margin-bottom: 0.21cm }
	-->
	</STYLE>
	
      <link href="../../../funciones/estilo.css" rel="stylesheet" type="text/css">
   <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><style type="text/css">
<!--
body {
	background-image: url(../../../images/Copia%20de%20fondo.jpg);
}
-->
   </style></head>
   <body>
      <form name="formusuario" ENCTYPE="multipart/form-data" action="ValidarCartucho.php" method="post">
	    <p>&nbsp;</p>
	    <table width="512" border="0" align="center">
            

         <tr>
           <td width="566"><table width="497" border="1">
                 <tr>
                   <td colspan="4" align="center" valign="middle"><div align="center"><span class="Estilo16">Ingresar Datos de Inicializacion de Cartucho</span></div></td>
                 </tr>
                 <tr>
                   <td align="right" valign="middle" class="Estilo7">N&ordm; de
                     Cartucho</td>
                   <td class="Estilo12"><input name="num_car" type="text" size="3" maxlength="3" id="num_car" />
                     <font color="#CC0000" size="1">De</font>                     <input name="num_car2" type="text" size="3" maxlength="3" id="num_car2" />
                   </td>
                   <td height="46" align="right" valign="middle" class="Estilo7"><p>Reporte
                       Secuencia</p>
                   </td>
                   <td class="Estilo12"><span class="boton">
                     <input name="rep_sec" type=file class="Estilo12" id="rep_sec" value="" size="14" maxlength="35" />
                   </span></td>
                 </tr>
                 <tr>
                   <td width="70" align="right" valign="middle" class="Estilo7">Estado</td>
                   <td width="171" class="Estilo12"><select name="estado" class="Estilo4" id="estado">
                     <?php 
				   $sql_maestro       =   "SELECT * FROM estado_cartucho ORDER BY IDESTADO DESC"; 
                   $resultado_maestro =   pg_query($sql_maestro);
                   $row_maestro       =   pg_fetch_assoc($resultado_maestro);
					   do { 
						echo "<option value=";
						echo $row_maestro['idestado'];
						echo ">";
						echo $row_maestro['descripcion']; 
						echo "</option>";
					 }while ($row_maestro = pg_fetch_assoc($resultado_maestro)); ?>
                   </select></td>
                   <td width="58" align="right" valign="middle" class="Estilo7">Ubicacion</td>
                   <td width="170" class="Estilo12"><select name="ubicacion" class="Estilo4" id="ubicacion">
                     <?php 
				   $sql_maestro       =   "SELECT * FROM ubicaciones"; 
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
                   <td height="28" align="right" valign="middle" class="Estilo7">Nomenclatura</td>
                   <td class="Estilo12"><select name="nomenclatura" class="Estilo4" id="nomenclatura">
                     <?php 
				   $sql_maestro       =   "SELECT * FROM id_sistema "; 
                   $resultado_maestro =   pg_query($sql_maestro);
                   $row_maestro       =   pg_fetch_assoc($resultado_maestro);
					   do { 
						echo "<option value=";
						echo $row_maestro['idnomenclatura'];
						echo ">";
						echo $row_maestro['idnomenclatura'];
						echo "</option>";
					 }while ($row_maestro = pg_fetch_assoc($resultado_maestro)); ?>
                   </select>                     <select name="tipo" class="Estilo4">
                     <option value="N">N
                     <option value="DM">DM
                     <option value="AM">AM
                     <option value="AD">AD
                     <option value="DD">DD
                     <option value="AD-DM">AD-DM
                     <option value="DD-AM">DD-AM
                   </select></td>
                   <td align="right" valign="middle" class="Estilo7">Consecutivo</td>
                   <td class="Estilo12"><input name="consecutivo" type="text" size="25" maxlength="50" id="consecutivo" /></td>
                 </tr>
                 <tr>
                   <td align="right" valign="middle" class="Estilo7">Mod Cartucho</td>
                   <td class="Estilo12"><select name="mod_cart" class="Estilo4" id="mod_cart">
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
                   </select></td>
                   <td align="right" valign="middle" class="Estilo7">Ciclo de Retencion</td>
                   <td class="Estilo12"><select name="ciclo_ret" class="Estilo4" id="ciclo_ret">
                     <?php 
				   $sql_maestro       =   "SELECT * FROM ciclo_retencion "; 
                   $resultado_maestro =   pg_query($sql_maestro);
                   $row_maestro       =   pg_fetch_assoc($resultado_maestro);
					   do { 
						echo "<option value=";
						echo $row_maestro['idciclo'];
						echo ">";
						echo $row_maestro['ciclo_reten']; 
						echo "</option>";
					 }while ($row_maestro = pg_fetch_assoc($resultado_maestro)); ?>
                   </select></td>
                 </tr>
                 <tr>
                   <td align="right" valign="middle" class="Estilo7"><p>Fecha
                       Ini</p>
                     <p>DD/MM/AAAA</p></td>
                   <td class="Estilo12"><? 
				          escribe_formulario_fecha_vacio("fechaini","formusuario");
	                   ?></td>
                   <td align="right" valign="middle" class="Estilo7"><p>Fecha
                       Fin</p>
                     <p>DD/MM/AAAA</p></td>
                   <td class="Estilo12"><? 
				          escribe_formulario_fecha_vacio("fechafin","formusuario");
	                   ?></td>
                 </tr>
                 <tr>
                   <td align="right" valign="middle" class="Estilo7"><p style='line-height:100%'>Fecha                        Exp</p>
                     <P STYLE='line-height:150%'>MM/DD/AAAA</P></td>
                   <td class="Estilo12"><? 
				          escribe_formulario_fecha_vacio("fechaexp","formusuario");
	                   ?></td>
					 
                   <td align="right" valign="middle" class="Estilo7">Operador</td>
				
                   <td class="Estilo12"><input name="operador" type="text" size="25" maxlength="50" id="operador" /></td>
                 </tr>
                 <tr>
                 </tr>
				 <td class="Estilo7"><div align="right"><strong>Observaciones</strong> </div></td>
				 <td colspan="3"> <input name="observaciones" type="text" size="65" maxlength="50" id="observaciones" /> </td>
				 
           </table>			   </td>
         </tr>
         <tr>
            <td><p align="center">
              <input name="Ingresar" type="submit" class="boton" value="Ingresar Informacion" /><br>
              <input name="Regresar" type="submit" class="boton" id="Regresar" value="Regresar">
                </p>
           </td>
         </tr>
      </table>
    </form>
</body>
</html>
