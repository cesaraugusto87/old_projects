<?php
   $id = $_GET['Id'];
   include('../../../funciones/conexion.php');
   include('../../../funciones/transformfecha.php');
   $conexion = Conectarse();  
   $sql="Select * from noticias where (IdNoti = '".$id."')"; 		
   $resultado = mysql_query($sql, $conexion);
   $totalregistros = mysql_num_rows($resultado);
   $row_noticias = mysql_fetch_assoc($resultado);
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
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><style type="text/css">
<!--
body {
	background-image: url(../../../images/fondo.jpg);
}
-->
</style></head>
<body>
   <form name="form1" method="post" action="">
     <p>&nbsp;</p>
     <table width="447" border="1" align="center">
     <tr>
       <td class="boton"><div align="center" class="Estilo16">Detalle de la Noticia. </div></td>
     </tr>
     <tr>
       <td bgcolor="#FFFFFF">&nbsp;</td>
     </tr>
     <tr>
       <td><table width="439" border="1">
         <tr>
           <td width="106" class="boton"><div align="right" class="Estilo7">Titulo </div></td>
           <td width="317" class="boton">
            <input name="CampoTitulo" value=<?php echo $row_noticias['Titulo']; ?> type="text" class="Estilo4" size="30" maxlength="150">           </td>
         </tr>
         <tr>
           <td class="boton"><div align="right" class="Estilo7">Resumen</div></td>
           <td class="boton">
		   <input name="CampoResumen" value= <? echo $row_noticias['Resumen']; ?> type="text" class="Estilo4" size="60">           </td>
         </tr>
         <tr>
           <td class="boton"><div align="right" class="Estilo7">Cuerpo de la Noticia</div></td>
           <td class="boton"><textarea name="CampoResumen" cols="60" rows="3" class="Estilo4"><? echo $row_noticias['Cuerpo']; ?></textarea></td>
         </tr>
         
         
       </table></td>
     </tr>
     <tr>
       <td bgcolor="#FFFFFF">&nbsp;</td>
     </tr>
     <tr>
       <td class="boton"><table width="438" border="0">
         <tr>
           <td width="180"><label></label></td>
           <td width="248"><input name="Regresar" type="Submit" class="boton" value="Regresar"></td>
         </tr>
       </table></td>
     </tr>
   </table>
   </form>
</body>
</html>
