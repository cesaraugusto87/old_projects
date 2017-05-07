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
      echo "window.location.href= '../news[1].php'";
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
       <td colspan="2" class="boton"><div align="center" class="Estilo16">Detalle de la Noticia. </div>       </td>
       </tr>
     <tr>
       <td width="411" class="boton"><div align="center" class="Estilo25"><?php echo $row_noticias['Titulo']; ?></div></td>
       <td width="184" class="boton"><?php 
		     $directorio  = "../../images/Noticias/";
			 $aleatorio = rand (1,1000000); 
		  ?>         <img src=<?php echo ($directorio.$row_noticias['Foto']);?>?<? echo $aleatorio;?> width="130" height="100" align="middle"></td>
     </tr>
     
     <tr>
       <td colspan="2"><table width="601" border="1">
         <tr>
           <td class="boton"><div align="center" class="Estilo22"><br><? echo $row_noticias['Resumen']; ?>              <br><hr width='95%'><br></div>             <div align="justify" class="Estilo24">
               
               <blockquote>
                 <? echo $row_noticias['Cuerpo']; ?>               1               </blockquote>
			   <br><hr width='95%'><br>
           </div></td>
          </tr>
         
         
         
       </table></td>
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
