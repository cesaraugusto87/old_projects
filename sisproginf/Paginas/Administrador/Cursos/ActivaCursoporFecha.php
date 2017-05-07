<?php 
   if (isset($_POST['Cerrar'])){      
	  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= '../Buzon/AdminCursos.php'";	   
	  echo "</script>";	  
   }else{  
      $sql = "UPDATE ofertacurso SET Status = 0"; 		
	  $resultado = mysql_query($sql, $conexion);
      $registros = mysql_affected_rows ($conexion);
      include('../../../funciones/calendario/calendario.php');
      if(isset($_POST['Actualiza'])){
         include('../../../Funciones/conexion.php');
         include('../../../Funciones/transformfecha.php');
	     $conexion = Conectarse();   
		 $sql = "UPDATE ofertacurso SET Status = 0"; 		
	     $resultado = mysql_query($sql, $conexion);
         $registros = mysql_affected_rows ($conexion);
         $fechaini    =   cambiaf_a_mysql($_POST['CampoFI']);
         $fechafin    =   cambiaf_a_mysql($_POST['CampoFF']);;
	     $sql = "UPDATE ofertacurso SET Status = 1 WHERE ((FechaIni >='".$fechaini."')and(FechaIni <='".$fechafin."'))"; 		
	     $resultado = mysql_query($sql, $conexion);
         $registros = mysql_affected_rows ($conexion);
   	     if($registros > 0){	       
	        echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	        echo "window.location.href= 'Tablero.php'";	   
	        echo "</script>";
	     }
      }
   }
?>
<html>
   <head>     
      <title>Activa cursos por Rango de Fechas...</title>
      <link href="../../../funciones/estilo.css" rel="stylesheet" type="text/css">
	  <script language="JavaScript" src="../calendario/javascripts.js"></script>
   </head>

<body>
<form name="formulario" method="post" action="">
  <table width="311" height="306" border="8" align="center">
    <tr>
      <td height="25"><div align="right"><span class="Estilo11"><img src="../../../images/LOGOTRANS.jpg" alt="Bandeja  para Data de Usuarios" width="52" height="41" align="left">Activa los CURSOS por Rango de Fechas  </span><span class="Estilo13"> </span> </div></td>
    </tr>
    <tr>
      <td height="198" background="../../../images/fondo.jpg"><p>&nbsp;</p>
      <table width="399" border="5" align="center">
        <tr>
          <td class="Estilo16"><div align="center">Indique Rango de Fechas para Actializar Cursos </div></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><table width="217" border="1" align="center">
              <tr>
                <td align="center" valign="middle" class="Estilo7">Fecha Inicial </td>
                <td class="Estilo4"><span class="Estilo12">
                  <?php
			     escribe_formulario_fecha_vacio("CampoFI","formulario");
	      ?>
                </span></td>
              </tr>
              <tr>
                <td width="85" align="center" valign="middle" class="Estilo7">Fecha Final </td>
                <td width="209" class="Estilo4"><span class="Estilo12">
                  <?php
			     escribe_formulario_fecha_vacio("CampoFF","formulario");
	          ?>
                </span></td>
              </tr>
          </table></td>
        </tr>
        <tr>
          <td><div align="center">
            <input name="Actualiza" type="submit" class="boton" value="Actualizar">
          </div></td>
        </tr>
        <tr>
          <td><div align="center">
            <input name="Cerrar" type="submit" class="boton" value="Regresar">
          </div></td>
        </tr>
      </table>
      <p>&nbsp;</p></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  </form>        
</body>
</html>
