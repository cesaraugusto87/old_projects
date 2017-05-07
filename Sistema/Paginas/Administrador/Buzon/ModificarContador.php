<?php
    session_start();
   $Tipo     =  $_SESSION['tipo'];
   if (($Tipo == 5)){
      include('../../../funciones/conexion.php');

      $conexion = Conectarse();
   }else{      
	  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= '../../logearse.php'";	   
	  echo "</script>";	  
   }  
   
?>
<html>
   <head>
      <title>Formulario de Ingreso de asignatura</title>
	  <script language="JavaScript" src="../../usuarios/calendario/javascripts.js"></script>
	  <script language="JavaScript" src="../../../funciones/validarEntrada.js"></script>
      <style type="text/css">
      <!--
         .Estilo1 {
	        font-size: 18px;
	        font-weight: bold;
         }
         .Estilo2 {
	        font-size: 14px;
	        color: #666666;
	        font-weight: bold;
         }
         .Estilo3 {
	        font-size: 10px;
	        font-weight: bold;
         }
         .Estilo4 {font-size: 10}
      -->
   </style>
      <link href="../../../funciones/estilo.css" rel="stylesheet" type="text/css">
   <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><style type="text/css">
<!--
body {
	background-image: url(../../../images/Copia%20de%20fondo.jpg);
}
-->
   </style></head>
   <body>
      <form name="formusuario" ENCTYPE="multipart/form-data" action="ValidarCart.php" method="post">
	    <p>&nbsp;</p>
	    <table width="467" border="0" align="center">
            

         <tr>
           <td>
			   <p align="center">&nbsp;</p>
			   <br><br><br><table width="497" border="1">
                 <tr>
                   <td colspan="4" align="center" valign="middle"><div align="center"><span class="Estilo16">Ingresar
                         Cartuchos Vacios</span></div></td>
                 </tr>
                 <tr>
                   <td width="45" align="right" valign="middle" class="Estilo7">Modelo</td>
                   <td width="150" class="Estilo12"><select name="mod_cart" class="Estilo4" id="mod_cart">
                     <?php 
				   $sql_maestro       =   "SELECT * FROM mod_cartucho "; 
                   $resultado_maestro =   pg_query($sql_maestro);
                   $row_maestro       =   pg_fetch_assoc($resultado_maestro);
					   do { 
						echo "<option value=";
						echo $row_maestro['idmod'];
						echo ">";
						echo $row_maestro['idmod']; 
						echo "</option>";
					 }while ($row_maestro = pg_fetch_assoc($resultado_maestro)); ?>
                   </select></td>
                   <td width="35" align="right" valign="middle" class="Estilo7">Cantidad</td>
                   <td width="156" class="Estilo12"><input name="cantidad" onKeyPress="return validar(event)" type="text" size="20" maxlength="50" /></td>
                 </tr>
           </table>			   </td>
         </tr>
         <tr>
            <td><p align="center">
              <input name="Ingresar" type="submit" class="boton" value="Ingresar Informacion" /><br>
              <input name="Regresar" type="submit" class="boton" id="Regresar" value="Regresar">
                </p>
              <p align="center">&nbsp;</p></td>
         </tr>
      </table>
    </form>
</body>
</html>
