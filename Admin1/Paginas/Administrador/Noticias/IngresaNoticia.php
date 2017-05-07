<?php
   if($_POST['Ingresar']){
      $titulo       =  $_POST['CampoTitulo'];
	  $resumen      =  $_POST['CampoResumen'];
	  $noticia      =  $_POST['CampoNoticia'];
	  $directorio  = "../../../images/Noticias/";
      $foto        = $titulo.".jpg";  
      $ruta        = $directorio.$foto; 
      $foto_tmp    = $_FILES["CampoImagen"]["tmp_name"]; 
      //compruebo de que se haya subido la foto a la carpeta temporal 
      //luego muevo la foto al directorio de destino 
      if(is_uploaded_file($foto_tmp)){
         move_uploaded_file($foto_tmp,$ruta); 
         //este upload de archivos es muy básico dejo en tus manos en investigar sobre el tema 
         //para hacer upload mas restringidos 
      }
	  $status        =  1;
	  
	  include('../../../funciones/conexion.php');
	  include('../../../funciones/transformfecha.php');
      $conexion = Conectarse();
	  
	  $sql_2 = "SELECT MAX(idnoti) FROM noticias";
	  $result = pg_query($sql_2);
	  $row = pg_fetch_assoc($result);
	  $num = $row['max'] + 1;
	  
	  $ahora = getdate();

	  $fecha_actual = $ahora["mday"] . "/" . $ahora["mon"] . "/" . $ahora["year"];
	  
	  $sql="insert into noticias values('".$num."','".$titulo."','".$resumen."','".$noticia."','".$foto."','".$fecha_actual."','".$status."')";	   
	  $resultado_set =  pg_query($sql);
	  $filas_r = pg_affected_rows ($resultado_set);
	  
	  if($filas_r > 0){
         echo "<script>alert('Noticia INGRESADO correctamente');</script> "; 
         echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
         echo "window.location.href= 'MenuNoticia.php'";
         echo "</script>";
         exit; 
	  }else{
         echo "<script>alert('No se pudo GUARDAR los Datos Intente Mas tarde...');</script>";	
            echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
			echo "window.location.href= 'MenuNoticia.php'";
			echo "</script>";
			exit; 
		}   
   }
   if($_POST['Regresar']){
      echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
      echo "window.location.href= 'MenuNoticia.php'";
      echo "</script>";
      exit; 	  
   }
?>
<html>
<head>   
<title>Ingresando Curso Base...</title>
      <link href="../../../funciones/estilo.css" rel="stylesheet" type="text/css">
</head>
<body  bgcolor='#EDEEEC' text='#000000'>
   <form name="form1" ENCTYPE="multipart/form-data" method="post" action="">
   <table width="447" border="1" align="center" background="../../../images/fondo.jpg">
     <tr>
       <td class="boton"><div align="center" class="Estilo16">Ingresando Nueva Noticia. </div></td>
     </tr>
     <tr>
       <td>&nbsp;</td>
     </tr>
     <tr>
       <td><table width="439" border="1">
         <tr>
           <td width="106" class="boton"><div align="right" class="Estilo7">Titulo </div></td>
           <td width="317" class="boton">
            <input name="CampoTitulo" type="text" class="Estilo4" size="30" maxlength="150">           </td>
         </tr>
         <tr>
           <td class="boton"><div align="right" class="Estilo7">Resumen</div></td>
           <td class="boton"><input name="CampoResumen" type="text" class="Estilo4" value="" size="60">           </td>
         </tr>
         <tr>
           <td class="boton"><div align="right"><span class="Estilo7">Cuerpo de la Noticia</span></div></td>
           <td class="boton"><textarea name="CampoNoticia" cols="60" rows="3" class="Estilo4"></textarea></td>
         </tr>
         
         
       </table></td>
     </tr>
     <tr>
       <td>&nbsp;</td>
     </tr>
     <tr>
       <td class="boton"><table width="438" border="0">
         <tr>
           <td width="193">&nbsp;</td>
           <td width="68"><label>
             <input name="Ingresar" type="Submit" class="boton" value="Ingresar">
           </label></td>
           <td width="261"><input name="Regresar" type="Submit" class="boton" value="Regresar"></td>
         </tr>
       </table></td>
     </tr>
   </table>
   </form>
</body>
</html>
