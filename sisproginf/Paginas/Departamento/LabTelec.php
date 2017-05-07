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
     <table width="610" border="1" align="center">
     <tr>
       <td colspan="2" class="boton"><div align="center" class="Estilo16">Laboratorio de Telecomunicaciones
           <hr width='95%' size="5">
       </div>       </td>
       </tr>
     <tr>
       <td width="294" class="boton"><div align="center"><img src="../../images/FOTOS INCE/S5032166.JPG" width="270" height="160"></div></td>
       <td width="301" class="boton"><div align="center"><img src="../../images/FOTOS INCE/yoly 118.jpg" width="270" height="160"></div></td>
     </tr>
     <tr>
       <td class="boton"><div align="center"><img src="../../images/FOTOS INCE/yoly 141.jpg" width="270" height="160"></div></td>
       <td class="boton"><div align="center"><img src="../../images/FOTOS INCE/yoly 146.jpg" width="270" height="160"></div></td>
     </tr>
     <tr>
       <td class="boton"><div align="center"><img src="../../images/FOTOS INCE/yoly 149.jpg" width="270" height="160"></div></td>
       <td class="boton"><div align="center"><img src="../../images/FOTOS INCE/yoly 152.jpg" width="270" height="160"></div></td>
     </tr>
     <tr>
       <td class="boton"><div align="center"><img src="../../images/FOTOS INCE/yoly 155.jpg" width="270" height="160"></div></td>
       <td class="boton"><div align="center"><img src="../../images/FOTOS INCE/yoly 156.jpg" width="270" height="160"></div></td>
     </tr>
     <tr>
       <td class="boton"><div align="center"><img src="../../images/FOTOS INCE/yoly 157.jpg" width="270" height="160"></div></td>
       <td class="boton"><div align="center"><img src="../../images/FOTOS INCE/yoly 158.jpg" width="270" height="160"></div></td>
     </tr>
     <tr>
       <td class="boton"><div align="center"><img src="../../images/FOTOS INCE/yoly 162.jpg" width="270" height="160"></div></td>
       <td class="boton"><div align="center"><img src="../../images/FOTOS INCE/yoly 163.jpg" width="270" height="160"></div></td>
     </tr>
     <tr>
       <td class="boton"><div align="center"><img src="../../images/FOTOS INCE/yoly 164.jpg" width="270" height="160"></div></td>
       <td class="boton"><div align="center"><img src="../../images/FOTOS INCE/yoly 169.jpg" width="270" height="160"></div></td>
     </tr>
     <tr>
       <td class="boton"><div align="center"><img src="../../images/FOTOS INCE/yoly 171.jpg" width="270" height="160"></div></td>
       <td class="boton"><div align="center"><img src="../../images/FOTOS INCE/yoly 172.jpg" width="270" height="160"></div></td>
     </tr>
     <tr>
       <td class="boton"><div align="center"><img src="../../images/FOTOS INCE/yoly 174.jpg" width="270" height="160"></div></td>
       <td class="boton"><div align="center"><img src="../../images/FOTOS INCE/yoly 177.jpg" width="270" height="160"></div></td>
     </tr>
     <tr>
       <td class="boton"><div align="center"></div></td>
       <td class="boton"><div align="center"></div></td>
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
