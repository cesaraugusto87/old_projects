<?php
   session_start();
   $cedula    =  $_SESSION['Usuario'];
   $curso     =   $_GET['Curso'];
   $Sec       =   $_GET['Sec'];
   include('../../Funciones/conexion.php');
   $conexion = Conectarse();   
   
   
   $sql_pre        =   "select * from curso where (IdCurso ='".$curso."')"; 
   $resultado_pre  =   mysql_query($sql_pre, $conexion);
   $row_pre        =   mysql_fetch_assoc($resultado_pre);
    $totalregistros = mysql_num_rows($resultado_pre);
?>
<html>
<head>
<title>Requisitos Del Curso a Preinscribir......</title>
      <link href="../../funciones/estilo.css" rel="stylesheet" type="text/css">
      <style type="text/css">
<!--
.Estilo22 {color: #990000}
-->
      </style>
</head>
<body>
   <table width="456" border="5" align="center">
     <tr>
       <td><table width="441" border="0">
         <tr>
           <td><div align="center" class="boton Estilo22">Requisitos Para El Curso &quot;<?php echo $row_pre['Nombre'];?>&quot; </div></td>
         </tr>
         <tr>
           <td>&nbsp;</td>
         </tr>
         <tr>
           <td>
		   <table width="436" border="1">
              <?php if ($totalregistros > 0){?> 
			     <?php do { ?>   
			        <tr>
                      <td class="Estilo12"><li><?php echo $row_requisitos['Descripcion'];?></li></td>
   		            </tr>
			     <?php }while ($row_pre = mysql_fetch_assoc($resultado_pre)); ?>      		  
			      <?php 
			   }else{
			      echo"<span class='Estilo12'>No existen Requisitos Para este Curso</span>";
			   }
			?>
             
           </table></td>
         </tr>
         <tr>
           <td></td>
         </tr>
         <tr>
           <td>&nbsp;</td>
         </tr>
       </table></td>
     </tr>
   </table>
</body>
</html>
