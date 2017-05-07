<?php
   $cedula = $_POST['CampoCedula'];
    $enero          =   $_POST['enero'];
	  $febrero        =   $_POST['febrero'];
	  $marzo          =   $_POST['marzo'];
	  $abril          =   $_POST['abril'];
	  $mayo           =   $_POST['mayo'];
	  $junio          =   $_POST['junio'];
	  $julio          =   $_POST['julio'];
	  $agosto         =   $_POST['agosto'];
	  $septiembre     =   $_POST['septiembre'];
	  $octubre        =   $_POST['octubre'];
	  $noviembre      =   $_POST['noviembre'];
	  $diciembre      =   $_POST['diciembre'];
  	  $tipo           =   $_POST['tipo'];
	  
   if (isset($_POST['m1']) && ($cedula != "")){
	include('../../../funciones/conexion.php');
      $conexion = Conectarse();   
	  $sql2= "UPDATE pago SET enero = '" .$enero. "', febrero = '" .$febrero. "', marzo = '" .$marzo. "', abril = '" .$abril. "', mayo = '" .$mayo. "', junio = '" .$junio. "', julio = '" .$julio. "', agosto = '" .$agosto. "', septiembre = '" .$septiembre. "', octubre = '" .$octubre. "', noviembre = '" .$noviembre. "', diciembre = '" .$diciembre. "', tipo = '" .$tipo. "' WHERE idestudiante = '" .$cedula. "' ";
	  
      $resultado = mysql_query($sql2,$conexion);
      $registros2 = mysql_affected_rows ($conexion);
      if($registros2 > 0){		
 	     echo "<script>alert('Datos Actualizados Correctamente...');</script> "; 
         echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
         echo "window.location.href= 'BuzonAdministrador.php'";
		 echo "</script>";
		 exit; 
	  }else{
	     echo "<script>alert('Error no se Pudo Hacer el Pago...');</script>"; 
	     echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	     echo "window.location.href= 'BuzonAdministrador.php'";	   
	     echo "</script>";
		 exit;
	  }
	  }
   if ($cedula != ""){
       $regreso =1;
       include('../../../funciones/conexion.php');
       include('../../../funciones/transformfecha.php');
       $conexion = Conectarse();   
       $sql="select * from estudiantes where (ci ='".$cedula."')"; 
       $resultado = mysql_query($sql, $conexion);
       $row_usuario = mysql_fetch_assoc($resultado);
	   $ifilas = mysql_affected_rows ($conexion);
       if($ifilas > 0 ){	 
	      $sql2="select * from pago where idestudiante = '".$cedula."' "; 
          $resultado2 = mysql_query($sql2, $conexion);
          $row_usuario2 = mysql_fetch_assoc($resultado2);
	   }else{
	      echo "<script>alert('No Existe ese Alumno...');</script>"; 
	      echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	      echo "window.location.href= 'BuzonAdministrador.php'";
	      echo "</script>";
	   }	   	   
   }else{
      $cedula = $_GET['Cedula'];
	  if ($cedula == ""){
         echo "<script>alert('El Campo de la Cedula no Puede estar Vacio...');</script>"; 
	     echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	     echo "window.location.href= 'PideCedulaProfesor.php'";	   
	     echo "</script>";      
	  }else{
         $regreso =2;
	     include('../../../funciones/conexion.php');
         include('../../../funciones/transformfecha.php');
         $conexion = Conectarse();   
         $sql="select * from estudiantes where (ci ='".$cedula."')";
         $resultado = mysql_query($sql, $conexion);
         $row_usuario = mysql_fetch_assoc($resultado);
	     $ifilas = mysql_affected_rows ($conexion);
         if($ifilas > 0 ){	 
	        $sql2="select * from pago where  idestudiante = '".$cedula."'"; 
            $resultado2 = mysql_query($sql2, $conexion);
            $row_usuario2 = mysql_fetch_assoc($resultado2);
	     }else{
	        echo "<script>alert('No Existe ese Alumno...');</script>"; 
	        echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	        echo "window.location.href= 'PideCedulaProfesor.php'";	   
	        echo "</script>";      
	     }
	  }	 
   }
?>
<html>
   <head>
      <title>Formulario de Ingreso de Usuario</title>
	  <script language="JavaScript" src="../../Usuarios/calendario/javascripts.js"></script>
	  <script language="JavaScript" src="../../../../sisproginf/Paginas/funciones/validarEntrada.js"></script>
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
   </head>
   <body>  
    <form name="form1" method="post" action="">    
	  <table width="467" border="0" align="center" background="../../../images/fondo.jpg">
         
         
         

         <tr>
            <td>			  
			   <table width="583" border="1">
                 <tr>
                   <td colspan="4"><div align="center" class="Estilo16">Datos Personales Alumno</div></td>
                 </tr>
                 <tr>
                   <td width="117" align="right" valign="middle" class="Estilo7">Cedula</td>
                   <td width="86" class="Estilo12"> <input type="text" name="CampoCedula" value=<?php echo $row_usuario['ci'] ?> id="CampoCedula"></td>
                   <td width="61" align="right" valign="middle" class="Estilo7">Nacionalidad</td>
                   <td width="189" class="Estilo12"><?php echo $row_usuario['nacionalidad']?></td>
                 </tr>
                 <tr>
                   <td align="right" valign="middle" class="Estilo7">Genero</td>
                   <td class="Estilo12"><?php echo $row_usuario['genero'] ?></td>
                   <td align="right"  class="Estilo7">&nbsp;</td>
                   <td class="Estilo12">&nbsp;</td>
                 </tr>
                 <tr>
                   <td align="right" valign="middle" class="Estilo7">Nombres</td>
                   <td class="Estilo12"><?php echo $row_usuario['nombre'] ?></td>
                   <td align="right" valign="middle" class="Estilo7">Apellidos</td>
                   <td class="Estilo12"><?php echo $row_usuario['apellidos'] ?></td>
                 </tr>
                 <tr>
                   <td align="right" valign="middle" class="Estilo7">Telefono</td>
                   <td class="Estilo12"><?php echo $row_usuario['telefono'] ?></td>
                   <td align="right" valign="middle" class="Estilo7">Ci Represetante</td>
                   <td class="Estilo12"><?php echo $row_usuario['ci_representante'] ?></td>
                 </tr>
                 <tr>
                   <td align="right" valign="middle" class="Estilo7">Direccion</td>
                   <td colspan="3" class="Estilo12"><span class="Estilo4"><?php echo $row_usuario['direccion'] ?></span></td>
                 </tr>
                 <tr>
                   <td align="right" valign="middle" class="Estilo7">E-mail</td>
                   <td colspan="3" class="Estilo12"><span class="Estilo4"><?php echo $row_usuario['Email'] ?></span></td>
                 </tr>
                 <tr>
                   <td align="right" valign="middle" class="Estilo7">ALUMNO AL DIA</td>
                   <td colspan="3" class="Estilo12"><label>
                   <input type="text" name="tipo" value=<?php echo $row_usuario2['tipo'] ?> id="tipo">
                   </label></td>
                 </tr>
                 <tr>
                   <td align="right" valign="middle" class="Estilo7">Enero</td>
                   <td colspan="3" class="Estilo12"><label>
                  
                     <input type="text" name="enero" value=<?php echo $row_usuario2['enero'] ?> id="enero">
                   </label></td>
                 </tr>
                 <tr>
                   <td align="right" valign="middle" class="Estilo7">Febrero</td>
                   <td colspan="3" class="Estilo12"><label>
                     <input type="text" name="febrero" value=<?php echo $row_usuario2['febrero'] ?> id="febrero">
                   </label></td>
                 </tr>
                 <tr>
                   <td align="right" valign="middle" class="Estilo7">Marzo</td>
                   <td colspan="3" class="Estilo12"><label>
                     <input type="text" name="marzo" value=<?php echo $row_usuario2['marzo'] ?> id="marzo">
                   </label></td>
                 </tr>
                 <tr>
                   <td align="right" valign="middle" class="Estilo7">Abril</td>
                   <td colspan="3" class="Estilo12"><label>
                     <input type="text" name="abril" value=<?php echo $row_usuario2['abril'] ?> id="abril">
                   </label></td>
                 </tr>
                 <tr>
                   <td align="right" valign="middle" class="Estilo7">Mayo</td>
                   <td colspan="3" class="Estilo12"><label>
                     <input type="text" name="mayo" value=<?php echo $row_usuario2['mayo'] ?> id="mayo">
                   </label></td>
                 </tr>
                 <tr>
                   <td align="right" valign="middle" class="Estilo7">Junio</td>
                   <td colspan="3" class="Estilo12"><label>
                     <input type="text" name="junio" value=<?php echo $row_usuario2['junio'] ?> id="junio">
                   </label></td>
                 </tr>
                 <tr>
                   <td align="right" valign="middle" class="Estilo7">Julio</td>
                   <td colspan="3" class="Estilo12"><label>
                     <input type="text" name="julio" value=<?php echo $row_usuario2['julio'] ?> id="julio">
                   </label></td>
                 </tr>
                 <tr>
                   <td align="right" valign="middle" class="Estilo7">Agosto</td>
                   <td colspan="3" class="Estilo12"><label>
                     <input type="text" name="agosto" value=<?php echo $row_usuario2['agosto'] ?> id="agosto">
                   </label></td>
                 </tr>
                 <tr>
                   <td align="right" valign="middle" class="Estilo7">Septiembre</td>
                   <td colspan="3" class="Estilo12"><label>
                     <input type="text" name="septiembre" value=<?php echo $row_usuario2['septiembre'] ?> id="septiembre">
                   </label></td>
                 </tr>
                 <tr>
                   <td align="right" valign="middle" class="Estilo7">Octubre</td>
                   <td colspan="3" class="Estilo12"><label>
                     <input type="text" name="octubre" value=<?php echo $row_usuario2['octubre'] ?> id="octubre">
                   </label></td>
                 </tr>
                 <tr>
                   <td align="right" valign="middle" class="Estilo7">Noviembre</td>
                   <td colspan="3" class="Estilo12"><label>
                     <input type="text" name="noviembre" value=<?php echo $row_usuario2['noviembre'] ?> id="noviembre">
                   </label></td>
                 </tr>
                 <tr>
                   <td align="right" valign="middle" class="Estilo7">Diciembre</td>
                   <td colspan="3" class="Estilo12"><label>
                     <input type="text" name="diciembre" value=<?php echo $row_usuario2['diciembre'] ?> id="diciembre">
                   </label></td>
                 </tr>
           </table>			   </td>
         </tr>
         <tr>
            <td height="30"><table width="584" border="0">
              <tr>
                <td width="227" height="152">&nbsp;</td>
                <td width="111">
				  
			      <p align="center">
			        <input name="m1" type="submit" class="boton" id="m1" value="Hacer Pago">
			      </p>
                  </form>  
		        <div align="center" class="boton"><a href="BuzonAdministrador.php">Regresar</a></div>		        </td>
                <td width="232">&nbsp;</td>
              </tr>
           </table>            </td>
         </tr>
   </table>
      <table width="584" border="0">
        <tr>
          <td width="111">&nbsp;</td>
          <td width="232">&nbsp;</td>
        </tr>
      </table>
</body>
</html>
