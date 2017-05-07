<?php
   $id = $_GET['Id'];
   include('../../funciones/conexion.php');
   include('../../funciones/transformfecha.php');
   $conexion = Conectarse();  
   $sql="Select * from noticias where (IdNoti = '".$id."')"; 		
   $resultado = mysql_query($sql, $conexion);
   $totalregistros = mysql_num_rows($resultado);
   $row_noticias = mysql_fetch_assoc($resultado);
   if($_POST['Regresar']){
      echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
      echo "window.location.href= '../../Paginas/news[1].php'";
      echo "</script>";
      exit; 	  
   }
?>
<html>
<head>   
<title>Ingresando Curso Base...</title>
      <link href="../../funciones/estilo.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><style type="text/css">
<!--
body {
	background-image: url(../../images/fondo.jpg);
}
.Estilo22 {color: #FF0000}
.Estilo24 {color: #0099FF}
.Estilo25 {color: #0033CC}
-->
</style></head>
<body>
   <form name="form1" method="post" action="">
     <p>&nbsp;</p>
     <table width="624" border="1" align="center">
     <tr>
       <td colspan="2" class="boton"><div align="center" class="Estilo16">Laboratorio de Asistencia Tecnica
           <hr width='95%' size="5">
       </div>       </td>
       </tr>
     <tr>
       <td width="316" class="boton"><div align="center"><img src="../../images/FOTOS INCE/yoly 181.jpg" width="270" height="160"></div></td>
       <td width="292" class="boton"><div align="center"><img src="../../images/FOTOS INCE/yoly 182.jpg" width="270" height="160"></div></td>
     </tr>
     <tr>
       <td class="boton"><div align="center"><img src="../../images/FOTOS INCE/yoly 183.jpg" width="270" height="160"></div></td>
       <td class="boton"><div align="center"><img src="../../images/FOTOS INCE/yoly 184.jpg" width="270" height="160"></div></td>
     </tr>
     <tr>
       <td class="boton"><div align="center"><img src="../../images/FOTOS INCE/yoly 185.jpg" width="270" height="160"></div></td>
       <td class="boton"><div align="center"><img src="../../images/FOTOS INCE/yoly 186.jpg" width="270" height="160"></div></td>
     </tr>
     <tr>
       <td class="boton"><div align="center"><img src="../../images/FOTOS INCE/yoly 188.jpg" width="270" height="160"></div></td>
       <td class="boton"><div align="center"><img src="../../images/FOTOS INCE/yoly 191.jpg" width="270" height="160"></div></td>
     </tr>
     <tr>
       <td class="boton"><div align="center"><img src="../../images/FOTOS INCE/yoly 193.jpg" width="270" height="160"></div></td>
       <td class="boton"><div align="center"><img src="../../images/FOTOS INCE/yoly 200.jpg" width="270" height="160"></div></td>
     </tr>
     <tr>
       <td class="boton"><div align="center"><img src="../../images/FOTOS INCE/yoly 201.jpg" width="270" height="160"></div></td>
       <td class="boton"><div align="center"><img src="../../images/FOTOS INCE/yoly 202.jpg" width="270" height="160"></div></td>
     </tr>
     <tr>
       <td class="boton"><div align="center"><img src="../../images/FOTOS INCE/S5032164.JPG" width="270" height="160"></div></td>
       <td class="boton"><div align="center"><img src="../../images/FOTOS INCE/S5032171.JPG" width="270" height="160"></div></td>
     </tr>
     

     <tr>
       <td colspan="2" class="boton"><table width="600" border="0">
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
