<?php
   if(isset($_POST['Ingresar'])){
      $CampoNombre      =$_POST['CampoNombre'];
	  $CampoDescripcion =$_POST['CampoDescripcion'];
      include('../../../Funciones/conexion.php');
      $conexion = Conectarse();   
	  $sql="insert into curso  values('','".$CampoNombre."','".$CampoDescripcion."')";
   	  $resultado_set =  mysql_query($sql, $conexion );
	  $filas_r = mysql_affected_rows ($conexion);
	  if($filas_r > 0){
	     echo "<script>alert('Los datos se han INGRESADO correctamente');</script> "; 
		 echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
         echo "window.location.href= 'logearse.php'";
		 echo "</script>";
		 exit; 
	  }else{
         echo "<script>alert('No se pudo GUARDAR los Datos Intente Mas tarde...');</script>";	
         echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
		 echo "window.location.href= 'logearse.php'";
		 echo "</script>";
		 exit; 
	  } 
   }
?>
<html>
   <head>
      <title>Documento sin t&iacute;tulo</title>
      <link href="../../../funciones/estilo.css" rel="stylesheet" type="text/css" />
   </head>
   <body>
      <form id="form1" name="form1" method="post" action="">
         <table width="368" border="1" align="center">
            <tr>
               <td width="358">
			      <div align="center">
				     <span class="Estilo11">
					    Ingresando Nuevo Curso 
				     </span>
				  </div>
			   </td>
            </tr>
            <tr>
               <td>&nbsp;</td>
            </tr>
            <tr>
               <td>
			      <table width="360" border="1">
                     <tr>
                        <td width="128" class="Estilo19">Nombre Curso </td>
                        <td width="210">
						   <input name="CampoNombre" type="text" size="25" maxlength="25" />
						</td>
                     </tr>
                     <tr>
                        <td class="Estilo19">Descripcion</td>
                        <td>
						   <input name="CampoDescripcion" type="text" size="35" maxlength="35" />
						</td>
                     </tr>
                  </table>
			   </td>
            </tr>
            <tr>
               <td>&nbsp;</td>
            </tr>
            <tr>
               <td>
			      <table width="359" border="0">
                     <tr>
                        <td width="153">&nbsp;</td>
                        <td width="64">
						   <label>
                              <input type="submit" name="Ingresar" value="Ingresar" />
                           </label>
						</td>
                        <td width="128">&nbsp;</td>
                     </tr>
                  </table>
			   </td>
            </tr>
         </table>
      </form>
   </body>
</html>
