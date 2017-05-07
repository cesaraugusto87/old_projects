<?php
   $cedula = $_POST['CampoCedula'];
   if ($cedula != ""){
       $regreso =1;
       include('../../../funciones/conexion.php');
       include('../../../funciones/transformfecha.php');
       $conexion = Conectarse();   
       $sql="select * from profesor where (Cedula ='".$cedula."')"; 
       $resultado = mysql_query($sql, $conexion);
       $row_usuario = mysql_fetch_assoc($resultado);
	   $ifilas = mysql_affected_rows ($conexion);
       if($ifilas > 0 ){	 
	      $sql2="select * from usuario where (CedulaUsuario ='".$cedula."')"; 
          $resultado2 = mysql_query($sql2, $conexion);
          $row_usuario2 = mysql_fetch_assoc($resultado2);
	   }else{
	      echo "<script>alert('No Existe ese Profesor...');</script>"; 
	      echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	      echo "window.location.href= 'PideCedulaProfesor.php'";	   
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
         $sql="select * from profesor where (Cedula ='".$cedula."')"; 
         $resultado = mysql_query($sql, $conexion);
         $row_usuario = mysql_fetch_assoc($resultado);
	     $ifilas = mysql_affected_rows ($conexion);
         if($ifilas > 0 ){	 
	        $sql2="select * from usuario where (CedulaUsuario ='".$cedula."')"; 
            $resultado2 = mysql_query($sql2, $conexion);
            $row_usuario2 = mysql_fetch_assoc($resultado2);
	     }else{
	        echo "<script>alert('No Existe ese Profesor...');</script>"; 
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
	  <script language="JavaScript" src="../../funciones/validarEntrada.js"></script>
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
	  <table width="467" border="0" align="center" background="../../../images/fondo.jpg">
         
         
         

         <tr>
            <td>			  
			   <table width="583" border="1">
                 <tr>
                   <td colspan="5"><div align="center" class="Estilo16">Datos Personales Profesor</div></td>
                 </tr>
                 <tr>
                   <td width="117" align="right" valign="middle" class="Estilo7">Cedula</td>
                   <td width="86" class="Estilo12"><?php echo $row_usuario['Cedula'] ?></td>
                   <td width="61" align="right" valign="middle" class="Estilo7">Nacionalidad</td>
                   <td width="189" class="Estilo12"><?php echo $row_usuario['Nacionalidad']?></td>
                   <td width="96" rowspan="4">
				   <?php if ($row_usuario['Foto'] != ""){
				      $directorio  = "../../../images/";
				   ?>
			          <img width="100" height="85" src=<?php echo $directorio.$row_usuario['Foto']; ?>>								 				   <?php }?>				   </td>
                 </tr>
                 <tr>
                   <td align="right" valign="middle" class="Estilo7">Genero</td>
                   <td class="Estilo12"><?php echo $row_usuario['Genero'] ?></td>
                   <td align="right"  class="Estilo7">F. Nacimiento</td>
                   <td class="Estilo12"><?php echo cambiaf_a_normal($row_usuario['FechaNacimiento']); ?></td>
                 </tr>
                 <tr>
                   <td align="right" valign="middle" class="Estilo7">Nombres</td>
                   <td class="Estilo12"><?php echo $row_usuario['Nombre'] ?></td>
                   <td align="right" valign="middle" class="Estilo7">Apellidos</td>
                   <td class="Estilo12"><?php echo $row_usuario['Apellido'] ?></td>
                 </tr>
                 <tr>
                   <td align="right" valign="middle" class="Estilo7">Telefono</td>
                   <td class="Estilo12"><?php echo $row_usuario['Telf'] ?></td>
                   <td align="right" valign="middle" class="Estilo7">Grado Instruccion </td>
                   <td class="Estilo12">
				      <?php 
				         $sql_profesion="SELECT * FROM titulo where (IdTitulo='".$row_usuario['Titulo']."')";
                         $resultado_profesion = mysql_query ($sql_profesion, $conexion);
			             $row_profesion  = mysql_fetch_assoc($resultado_profesion);
       			         echo $row_profesion['Descripcion'] 
				      ?>
				   </td>
                 </tr>
                 <tr>
                   <td align="right" valign="middle" class="Estilo7">Direccion</td>
                   <td colspan="4" class="Estilo12"><span class="Estilo4"><?php echo $row_usuario['Direccion'] ?></span></td>
                 </tr>
                 <tr>
                   <td align="right" valign="middle" class="Estilo7">Aspiraciones de Sueldo </td>
                   <td colspan="4" class="Estilo12"><span class="Estilo4"><?php echo $row_usuario['AspiraSueldo'] ?></span></td>
                 </tr>
                 <tr>
                   <td align="right" valign="middle" class="Estilo7">E-mail</td>
                   <td colspan="4" class="Estilo12"><span class="Estilo4"><?php echo $row_usuario['Email'] ?></span></td>
                 </tr>
                 <tr>
                   <td align="right" valign="middle" class="Estilo7">Curriculo</td>
                   <td colspan="4" ><table width="68" border="1">
                     <tr>
                       <td class="boton">
					   <a href="<?php $directorio ="../../../Archivos/"; echo $directorio.$row_usuario['Curriculo'] ?>"  target="_blank">Descargar</a></td>
                     </tr>
                   </table>                   </td>
                 </tr>
                 <tr>
                   <td colspan="5" align="right" valign="middle" class="Estilo7">&nbsp;</td>
                 </tr>
                 <tr>
                   <td colspan="5" align="right" valign="middle" class="Estilo7"><div align="center"><span class="Estilo16">Habilidades y Destrezas </span></div></td>
                 </tr>
				 <? 
				    $sql2="select * from habilidades where (CedulaProfe='".$cedula."') order by Descripcion"; 
                    $resultado2 = mysql_query($sql2, $conexion);
                    $row_habilidad = mysql_fetch_assoc($resultado2);
	                $totalregistros = mysql_num_rows($resultado2);
				 ?>
                 <?php if ($totalregistros > 0){?> 
			        <?php do { ?>   
					   <tr>
			              <td colspan="5" class="Estilo12">
						     <li>
							    <?php echo $row_habilidad['Descripcion'];?></li>
						     </td>
					   </tr>	
		            <?php }while ($row_habilidad = mysql_fetch_assoc($resultado2)); ?>      		        		 <?php 
			        }else{					   
			           echo"<tr><span class='Estilo12'>No Registro Ninguna Habilidad...</span></tr>";
			        }
			     ?>				 
                 <tr>
                   <td colspan="5" align="right" valign="middle" class="Estilo7"><div align="left"></div></td>
                 </tr>
                 <tr>
                   <td colspan="5" align="right" valign="middle" class="Estilo7"><div align="center"><span class="Estilo16">Datos de Usuario </span></div></td>
                 </tr>
                 <tr>
                   <td colspan="5" align="right" valign="middle" class="Estilo7"><table width="265" border="1" align="center">
                       <tr>
                         <td width="38" class="Estilo7"><div align="right">Login</div></td>
                         <td width="211" class="Estilo12"><?php echo $row_usuario2['Login'];?></td>
                       </tr>
                       <tr>
                         <td class="Estilo7"><div align="right">Password</div></td>
                         <td class="Estilo12"><?php echo $row_usuario2['Password'];?></td>
                       </tr>
                     </table>                   </td>
                 </tr>
              </table>			   </td>
         </tr>
         <tr>
            <td height="30"><table width="584" border="0">
              <tr>
                <td width="227">&nbsp;</td>
                <td width="111">
				  <? if($regreso == 1){?>
				     <div align="center" class="boton">
					    <a href="../Buzon/AdminUsuarios.php">
						   Regresar
						</a>
					 </div>
 				  <? }else{?>
				     <div align="center" class="boton">
					    <a href="../Reportes/ListadoProfe.php">
						   Regresar
						</a>
					 </div>
				  <? }?>	 
			    </td>
                  <td width="232">&nbsp;</td>
              </tr>
           </table>            </td>
         </tr>
   </table>
</body>
</html>
