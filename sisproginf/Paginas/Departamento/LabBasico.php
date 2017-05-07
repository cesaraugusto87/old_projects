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
       <td colspan="2" class="boton"><div align="center" class="Estilo16">Laboratorio Basico 
         <hr width='95%' size="5">
       </div>       </td>
       </tr>
     <tr>
       <td width="294" class="boton"><div align="center"><img src="../../images/FOTOS INCE/S5032159.JPG" width="270" height="160"></div></td>
       <td width="301" class="boton"><div align="center"><img src="../../images/FOTOS INCE/S5032155.JPG" width="270" height="160"></div></td>
     </tr>
     <tr>
       <td class="boton"><div align="center"><img src="../../images/FOTOS INCE/S5032149.JPG" width="270" height="160"></div></td>
       <td class="boton"><div align="center"><img src="../../images/FOTOS INCE/S5032150.JPG" width="270" height="160"></div></td>
     </tr>
     <tr>
       <td class="boton"><div align="center"><img src="../../images/FOTOS INCE/S5032151.JPG" width="270" height="160"></div></td>
       <td class="boton"><div align="center"><img src="../../images/FOTOS INCE/S5032153.JPG" width="270" height="160"></div></td>
     </tr>
     <tr>
       <td class="boton"><div align="center"><img src="../../images/FOTOS INCE/yoly 209.jpg" width="270" height="160"></div></td>
       <td class="boton"><div align="center"><img src="../../images/FOTOS INCE/yoly 210.jpg" width="270" height="160"></div></td>
     </tr>
     <tr>
       <td class="boton"><div align="center"><img src="../../images/FOTOS INCE/S5032131.JPG" width="270" height="160"></div></td>
       <td class="boton"><div align="center"><img src="../../images/FOTOS INCE/S5032148.JPG" width="270" height="160"></div></td>
     </tr>
     <tr>
       <td class="boton"><div align="center"><img src="../../images/FOTOS INCE/S5032154.JPG" width="270" height="160"></div></td>
       <td class="boton"><div align="center"><img src="../../images/FOTOS INCE/S5032145.JPG" width="270" height="160"></div></td>
     </tr>
     <tr>
       <td class="boton"><div align="center"><img src="../../images/FOTOS INCE/S5032146.JPG" width="270" height="160"></div></td>
       <td class="boton"><div align="center"><img src="../../images/FOTOS INCE/S5032163.JPG" width="270" height="160"></div></td>
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
