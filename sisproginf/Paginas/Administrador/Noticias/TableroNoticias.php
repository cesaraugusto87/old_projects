<?php
   include('../../../funciones/conexion.php');
   include('../../../funciones/transformfecha.php');
   $conexion = Conectarse();  
    
   $sql="Select * from noticias order by Fecha"; 		
   $resultado = mysql_query($sql, $conexion);
   $totalregistros = mysql_num_rows($resultado);
   $row_noticias = mysql_fetch_assoc($resultado);
   
?>
<html>
   <head>
      <title>Cursos Bases de la Programacion</title>
      <link href="../../../funciones/estilo.css" rel="stylesheet" type="text/css" />
      <style type="text/css">
<!--
.Estilo22 {color: #990000}
body {
	background-image: url(../../../images/fondo.jpg);
}
-->
      </style>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"></head>
<body>
   <table width="373" border="1" align="center" bgcolor="#CCCCCC">
      <tr>
         <td colspan="3" class="boton">
		    <div align="center" class="Estilo16">
		       Tablero de Noticias</div>		 </td>
      </tr>
      
      <tr>
        <td colspan="3">
		<?php if ($totalregistros > 0){?>
		<table width="618" border="1" align="center">
          <tr bgcolor="#F3F3F3" class="boton">
            <td width="178"><div align="center"><font color="#990000">Titulo</font></div></td>
            <td width="208"><div align="center"><span class="Estilo22">Resumen</span></div></td>
            <td width="47"><div align="center" class="Estilo22">Fecha Publicacion </div></td>
            <td width="47"><div align="center"><font color="#990000">Detalles</font></div></td>
            <td width="52"><div align="center"><font color="#990000">Estado</font></div></td>
            <td width="46"><div align="center" class="Estilo45"><font color="#990000"><strong>Eliminar</strong></font></div></td>
          </tr>
		  
             <?php do { ?>
             <tr>
                <td>
                   <div align="left">
				      <a href="../modificarconocimiento.php?=&cedula=<?php echo $row_noticias['IdCursos']; ?>"></a>
				      <span class="Estilo4">
					     <font color="#000000">
						    <?php echo $row_noticias['Titulo']; ?>						 </font>				      </span>				   </div>				</td>
				<td class="Estilo4"><div align="left"><font color="#000000"><?php echo $row_noticias['Resumen']; ?></font></div></td>
				<td class="Estilo4"><div align="center"><font color="#000000"><?php echo cambiaf_a_normal($row_noticias['Fecha']); ?></font></div></td>
				<td class="Estilo4">
	               <div align="center">
	                  <a href="DetalleNoticia.php?Id=<?php echo $row_noticias['IdNoti']; ?>">
	                     <img src="../../../images/ojo.gif" width="22" height="16" border="0">	                  </a>	               </div>				</td>
                <td class="Estilo4">
	               <div align="center">
				      <? if($row_noticias['Status'] == 1){?>
					     <a href="Activa-DesactivaNoticia.php?Id=<?php echo $row_noticias['IdNoti']; ?>&Estado=<?php echo $row_noticias['Status']; ?>">
	                        Activo   
					     </a>	
                      <? }else{?>
					     <a href="Activa-DesactivaNoticia.php?Id=<?php echo $row_noticias['IdNoti']; ?>&Estado=<?php echo $row_noticias['Status']; ?>">
	                        Oculto   
					     </a>	
					  <? }?>
	                                 </div>				</td>
                <td class="Estilo4">
				   <div align="center">
				      <font color="#000000">
					     <a href="EliminaNoticia.php?Id=<?php echo $row_noticias['IdNoti']; ?>">
						    <img src="../../../images/encontrado.gif" alt="Eliminar Curso" width="15" height="12" border="0">						 </a>				      </font>				   </div>				</td>
             </tr>
          <?php }while ($row_noticias = mysql_fetch_assoc($resultado)); ?>          
        </table>        
	  <?php }else{echo"<span class='Estilo12'>No existen Noticias Registrador en el Sistema</span>";}?>      </tr>
      <tr>
         <td width="277">&nbsp;</td>
         <td width="53"><table width="53" border="0" align="right" class="boton">
           <tr>
             <td width="45"><div align="center"><a href="MenuNoticia.php">Regresar</a></div></td>
           </tr>
        </table></td>
        <td width="276">&nbsp;</td>
      </tr>
</table>
</body>
</html>
