<?php
   include('calendario/calendario.php');
   include('../../../funciones/conexion.php');
   $conexion = Conectarse(); 
   session_start();
   $cedula   =  $_SESSION['Usuario'];
   $Tipo     =  $_SESSION['tipo'];
   
   //VARIABLES PARA EL GET
   $idinicializacion = $_GET['cartucho'];
   $num              = $_GET['num'];
   $fecha            = $_GET['fecha'];
   $tipo             = $_GET['tipo'];
  
   $sql = "Select * from cartuchos where idinicializacion = '".$idinicializacion."' And numero_cartuchos = '".$num."' And fecha_ini = '".$fecha."' And tipo = '".$tipo."' ";
   $resultado         =   pg_query($sql);
   $row_cartuchos     =   pg_fetch_assoc($resultado);
   
	if (isset($_POST['modificar'])){
	   //VARIABLES PARA ACTUALIZACION POST
	  $idinicializacion2 = $_POST['idinicializacion'];
	  $numero_cartuchos  = $_POST['num_car'];
   	  $num_cartucho2     = $_POST['num_car2'];
      $id_estado         = $_POST['estado'];
      $id_mod		     = $_POST['mod_cart'];
      $id_ciclo          = $_POST['ciclo_ret'];
      $fecha_ini		 = $_POST['fechaini'];
	  $fecha             = $_POST['fecha'];
      $fecha_fin		 = $_POST['fecha_fin'];
      $fecha_exp		 = $_POST['fechaexp'];
      $operador		     = $_POST['operador'];
      $reporte_secuencia = $_POST['rep_sec'];
      $id_ubicacion      = $_POST['ubicacion'];
      $observaciones     = $_POST['observaciones'];
      $tipo              = $_POST['tipo'];
	  $directorio    =   "../../../images/Rep_sec/";
   	  $foto          =   $idinicializacion2.$numero_cartuchos.$fecha.$tipo.".jpg";  
      $ruta          =   $directorio.$foto; 
      $foto_tmp      =   $_FILES["rep_sec"]["tmp_name"]; 


	  $sql2= "UPDATE cartuchos 
	  		  SET numero_cartuchos = '".$numero_cartuchos."', num_cartucho2 = '".$num_cartucho2."', id_estado = '".$id_estado."', 
			  id_mod = '".$id_mod."', id_ciclo = '".$id_ciclo."', operador = '".$operador."', id_ubicacion = '".$id_ubicacion."', 
			  observaciones = '".$observaciones."', fecha_fin = '".$fecha_fin."', reporte_secuencia = '".$foto."' WHERE  idinicializacion = '".$idinicializacion2."' 
			  And numero_cartuchos = '".$numero_cartuchos."' And fecha_ini = '".$fecha."' And tipo = '".$tipo."'";
	  $resultado = pg_query($sql2);
      $registros = pg_affected_rows ($resultado);
	  
	  if(is_uploaded_file($foto_tmp)){
         move_uploaded_file($foto_tmp,$ruta); 
      }
   $status  =  1;
	  
      if($registros > 0){		
 	     echo "<script>alert('Datos Actualizados Correctamente... Actualice la Pagina para ver los cambios');</script> "; 
         echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
         echo "window.close()";
		 echo "</script>";
		 exit; 
	  }else{
	     echo "<script>alert('Error no se Pudo Actualizar...');</script>"; 
	     echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
		 echo "window.close()";
	     echo "</script>";
		 exit;
	  }
	  } 
	  
	  if (isset($_POST['salir'])){
	     echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	     echo "window.close()";	   
	     echo "</script>";
		 exit;
		 }
?>
<html>
   <head>
      <title>Formulario de Modificacion</title>
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
      <form name="formusuario" ENCTYPE="multipart/form-data" action="" method="post">
	    <p>&nbsp;</p>
	    <table width="512" border="0" align="center">
            

         <tr>
           <td width="566"><table width="513" border="1">
                 <tr>
                   <td colspan="4" align="center" valign="middle"><div align="center"><span class="Estilo16">Modificar
                         Datos de Inicializacion de Cartucho</span></div></td>
                 </tr>
                 <tr>
                   <td align="right" valign="middle" class="Estilo7">N&ordm; de
                     Cartucho</td>
                   <td class="Estilo12"><input name="num_car" type="text" size="3" maxlength="3" id="num_car" value=<?php echo $row_cartuchos['numero_cartuchos']?> >
                     <font color="#CC0000" size="1">De</font><input name="num_car2" type="text" size="3" maxlength="3" id="num_car2" value=<?php echo $row_cartuchos['num_cartucho2']?>>
                   </td>
                   <td height="46" align="right" valign="middle" class="Estilo7"><p>Reporte
                       Secuencia</p>
                   </td>
                   <td class="Estilo12"><span class="boton">
                     <input name="rep_sec" type=file class="Estilo12" id="rep_sec" value=<?php echo $row_cartuchos['reporte_secuencia']?> size="14" maxlength="35" />
                   </span></td>
                 </tr>
                 <tr>
                   <td width="70" align="right" valign="middle" class="Estilo7">Estado</td>
                   <td width="180" class="Estilo12"><select name="estado" class="Estilo4" id="estado">
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
                   <td height="28" align="right" valign="middle" class="Estilo7">Nomenclatura</td>
                   <td class="Estilo12"><?php echo $row_cartuchos['idinicializacion']?> </td>
                   <td align="right" valign="middle" class="Estilo7">Consecutivo</td>
                   <td class="Estilo12"><?php echo $row_cartuchos['consecutivo']?> </td>
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
                     <p>MM/DD/AAAA</p></td>
                   <td class="Estilo12"><?php echo $row_cartuchos['fecha_ini']?></td>
                   <td align="right" valign="middle" class="Estilo7"><p>Fecha
                       Fin</p>
                     <p>MM/DD/AAAA</p></td>
                   <td class="Estilo12"><input name="fecha_fin" type="text" class="Estilo12" id="fecha_fin" value="<?  echo $row_cartuchos['fecha_fin']; ?>"></td>
                 </tr>
                 <tr>
                   <td align="right" valign="middle" class="Estilo7"><p style='line-height:100%'>Fecha                        Exp</p>
                     <P STYLE='line-height:150%'>MM/DD/AAAA</P></td>
                   <td class="Estilo12"><?php echo $row_cartuchos['fecha_exp']?></td>
					 
                   <td align="right" valign="middle" class="Estilo7">Operador</td>
				
                   <td class="Estilo12"><input name="operador" type="text" class="Estilo12" id="operador" value="<?  echo $row_cartuchos['operador']; ?>"></td>
                 </tr>
                 <tr>
                 </tr>
				 <td class="Estilo7"><div align="right"><strong>Observaciones</strong> </div></td>
				 <td colspan="3"> <input name="observaciones" type="text" class="Estilo12" size=65 id="observaciones" value="<?  echo $row_cartuchos['observaciones']; ?>">
				   <input type="hidden" name="idinicializacion" value=<?php echo $row_cartuchos['idinicializacion']?> >
				   <input type="hidden" name="tipo" value =<?php echo $row_cartuchos['tipo']?> > 
				   <input type="hidden" name="fecha" value =<?php echo $fecha; ?> >
				   </td>
           			</table></td>
         </tr>
         <tr>
            <td height="50"><p align="center">
              <input name="modificar" type="submit" class="boton" value="Modificar Informacion" /><br>
              <input name="salir" type="submit" class="boton" id="Regresar" value="Salir">
</p>
           </td>
         </tr>
      </table>
    </form>
</body>
</html>
