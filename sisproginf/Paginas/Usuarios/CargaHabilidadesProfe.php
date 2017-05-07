<?php
   $cedula = $_GET['Cedula'];   
   $tipo = $_GET['Tipo'];  
   include('../../funciones/conexion.php');
   $conexion = Conectarse();
   $sql="Select * from profesor where (Cedula='".$cedula."')";	   
   $resultado_set =  mysql_query($sql, $conexion );   
   $row_profe = mysql_fetch_assoc($resultado_set);      
   if((isset($_POST['Ingresar']))or(isset($_POST['Ingresar2']))){      
      $habilidad = $_POST['CampoHabilidad'];
	  $cedula    = $_POST['Cedula'];
	  $tipo    = $_POST['tipo'];
	  if ($habilidad != ""){	  
	     $sql="insert into habilidades values('".$cedula."','".$habilidad."')";	   
	     $resultado_set =  mysql_query($sql, $conexion );
	     $filas_r = mysql_affected_rows ($conexion);
	     if($filas_r > 0){		 
	        echo "<script>alert('Habilidad Ingresada...');</script>"; 
			if(isset($_POST['Ingresar'])){
			   if($tipo == 1){
			      echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	              echo "window.location.href= 'PerfilDatosProfe.php'";	   
	              echo "</script>";   
			   }else{
	              echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	              echo "window.location.href= 'IngresarUsuario.php?Cedula=$cedula&Tipo=2'";	   
	              echo "</script>";   
			   }	 
			}else{
			   echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	           echo "window.location.href= 'CargaHabilidadesProfe.php?Cedula=$cedula'";	   
	           echo "</script>";   			   
			}   
		 }else{
		    echo "<script>alert('No se pudo Ingresar Registro. Intente de Nuevo...');</script>"; 
	        echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	        echo "window.location.href= 'IngresarUsuario.php?Cedula=$cedula&Tipo=2'";	   
	        echo "</script>";   
		 }
	  }else{
	     echo "<script>alert('El Campo no Puede estar Vacio...');</script>"; 
	     echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	     echo "window.location.href= 'CargaHabilidadesProfe.php?Cedula=$cedula'";	   
	     echo "</script>";
	  }
   }
?>
<html>
<head>   
<title>Ingresando Curso Base...</title>
      <link href="../../funciones/estilo.css" rel="stylesheet" type="text/css">
      <style type="text/css">
<!--
.Estilo22 {color: #FFFFFF}
-->
      </style>
</head>
<body>
   <form name="form1" method="post" action="">
     <p>&nbsp;</p>
     <table width="464" border="1" align="center" background="../../images/fondo.jpg">
     <tr>
       <td><div align="center" class="Estilo16">
         <p>Ingresando Habilidades y Destrezas  </p>
         </div></td>
     </tr>
     <tr>
       <td><input type="hidden" name="Cedula" id="Cedula"  value="<? echo $cedula;?>">
       <input type="hidden" name="tipo" id="tipo"  value="<? echo $tipo;?>"></td>
     </tr>
     <tr>
       <td class="boton"><table width="455" border="1">
         <tr>
           <td width="72" class="Estilo11"><div align="center">Habilidad</div></td>
           <td width="367" class="Estilo4">
             <textarea name="CampoHabilidad" cols="80" class="Estilo4" id="CampoHabilidad"></textarea>           </td>
         </tr>
       </table></td>
     </tr>
     <tr>
       <td>&nbsp;</td>
     </tr>
     <tr>
       <td><div align="center">
         <input name="Ingresar2" type="Submit" class="boton" value="Ingresar y Reportar Otra Habilidad">
       </div></td>
     </tr>
     <tr>
       <td><div align="center">
         <input name="Ingresar" type="Submit" class="boton" value="Ingresar y Salir">
       </div></td>
     </tr>
   </table>
   </form>
</body>
</html>
