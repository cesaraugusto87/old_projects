<?php
   session_start();
   $cedula   =  $_SESSION['Usuario'];
   $Tipo     =  $_SESSION['TipoUsuario'];
   if (($Tipo == 1)or($Tipo == 2)or($Tipo == 5)){
      include('../../Funciones/conexion.php');
      include('../../Funciones/transformfecha.php');
      $conexion = Conectarse();   
      if ($cedula == ""){
         echo "<script>alert('Primero Tiene que Registrarse como Usuario!!!!');</script>"; 
	     echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	     echo "window.location.href= 'logearse.php'";	   
	     echo "</script>";	  
      }else{
         $sql            =   "select * from profesor  where (Cedula ='".$cedula."')"; 
         $resultado      =   mysql_query($sql, $conexion);
         $row_usuario    =   mysql_fetch_assoc($resultado);
         $nombre         =   $row_usuario['Nombre'];
	     $apellido       =   $row_usuario['Apellido']; 	     
      }
   }else{      
	  echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= 'logearse.php'";	   
	  echo "</script>";	  
   }   
?>
<html>
   <head>
      <title>Bandeja de Entrada de Usuario</title>
      <link href="../../funciones/estilo.css" rel="stylesheet" type="text/css">
      <style type="text/css">
<!--
.Estilo22 {color: #990000}
body {
	background-image: url();
}
-->
      </style>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"></head>
   <body>
      <form name="formusuario" action="" method="post">
	     <p>&nbsp;</p>
	     <table width="467" border="0" align="center">
            <input name="Cedula" type="hidden" value="$cedula">
            <tr>
               <td>
			      <table width="535" border="1" background="../../images/fondo.jpg">
                     <tr>
                        <td align="left" valign="middle">
						   
					       <div align="left"><span class="Estilo11">							     </span>
				              <table width="591" border="0">
                                <tr>
                                  <td width="100">
								 <?php 
								     if ($row_usuario['Foto'] != ""){ 
									    $directorio  = "../../images/";
										$aleatorio = rand (1,1000000); 
								  ?>
								      <img width="100" height="90" src=<?php echo ($directorio.$row_usuario['Foto']);?>?<? echo $aleatorio;?>>								  
							   	  <?php }?></td>
                                  <td width="221">&nbsp;</td>
                                  <td width="256"><div align="right"><span class="Estilo11">Bienvenido Sr(a) </span> <span class="Estilo13"> <?php echo $nombre," ",$apellido; ?></span></div></td>
                                </tr>
                             </table>
			           </div></td>
                     </tr>
                     <tr>
                        <td>&nbsp;</td>
                     </tr>
                     <tr>
                        <td><table width="200" border="5" align="center">
                          <tr>
                            <td class="Estilo13"><div align="center"><a href="perfilParticipante.php">Editar Mi Cuenta </a></div></td>
                          </tr>
                          
                          <tr>
                            <td><div align="center" class="boton"> <a href="logearse.php">Cerrar Sesion </a></div></td>
                          </tr>
                        </table></td>
                     </tr>
                     <tr>
                       <td height="26" align="right" valign="middle" class="Estilo12">&nbsp;</td>
                     </tr>
                 </table>
		      </td>
            </tr>
        </table>
      </form>
   </body>
</html>
