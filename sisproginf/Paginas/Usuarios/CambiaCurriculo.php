<? 
   session_start();
   $cedula   =  $_SESSION['Usuario'];
   $Tipo     =  $_SESSION['TipoUsuario'];
   if (($Tipo == 1)or($Tipo == 2)){
      if (isset($_POST['a'])){
         //datos que obtengo del campo foto
	     $directorio  = "../../Archivos/";
         $foto        = $cedula.".pdf";  
         $ruta        = $directorio.$foto; 
         $foto_tmp    = $_FILES["campofoto"]["tmp_name"]; 
         //compruebo de que se haya subido la foto a la carpeta temporal 
         //lu ego muevo la foto al directorio de destino 
         if(is_uploaded_file($foto_tmp)){
            move_uploaded_file($foto_tmp,$ruta);
			if ($Tipo == 1){
			   echo "<script>alert('Curriculo Cambiado con Exito...');</script>"; 
		       echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";	       
			   echo "window.location.href= 'PerfilDatosProfe.php'";	   
	           echo "</script>";
	           exit;		    
			}else{ 
	           echo "<script>alert('Imagen Cambiada con Exito...');</script>"; 
		       echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";	       
			   echo "window.location.href= 'PerfilDatosProfe.php'";	   
	           echo "</script>";
	           exit;		    
			}
         }
      }else{
         if (isset($_POST['Cerrar'])){            
	        echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	        echo "window.location.href= 'PerfilParticipante.php'";	   
	        echo "</script>";	  
         }
      }
   }else{
      echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
      echo "window.location.href= 'loguearse.php'";	   
      echo "</script>";	  
   }         
?>
<HTML> 
   <HEAD> 
      <TITLE>Cambia Imagen del Usuario...</TITLE> 
      <link href="../../funciones/estilo.css" rel="stylesheet" type="text/css">
   </HEAD> 
   <BODY> 
<FORM ENCTYPE="multipart/form-data" ACTION="" NAME="formulario" METHOD="POST">
  <p>&nbsp;</p>
  <table width="434" border="8" align="center" background="../../images/fondo.jpg">
          <tr>
            <td><table width="387" border="0">
              <tr>
                <td colspan="2" class="Estilo16"><div align="center">Especifica Ruta del Nuevo Curriculo </div></td>
              </tr>
              <tr>
                <td rowspan="4" class="Estilo12">&nbsp;</td>
                <td class="boton"><input name="campofoto" type="file" size="50"></td>
              </tr>
              <tr>
                <td><div align="center">
                  <input name="a" type="submit" class="boton" value="Env&iacute;a Archivo">
                </div></td>
              </tr>
              <tr>
                <td><label>
                  <div align="center">
                    <input name="Cerrar" type="submit" class="boton" value="Regresar">
                  </div>
                </label></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
            </table></td>
          </tr>
  </table>
  </FORM>	        
   </BODY> 
</HTML>
