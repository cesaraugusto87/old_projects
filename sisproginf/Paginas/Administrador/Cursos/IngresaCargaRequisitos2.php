<?php
   $id = $_GET['Id'];
   include('../../../funciones/conexion.php');
   $conexion = Conectarse();
   $sql="Select * from curso where (IdCurso='".$id."')";	   
   $resultado_set =  mysql_query($sql, $conexion );   
   $row_curso = mysql_fetch_assoc($resultado_set);
   if($_POST['Ingresar']){      
      $req = $_POST['CampoRequisito'];
	  $id  = $_POST['CampoId'];
	  echo $id;
	  if ($req != "$id"){
	     $sql="insert into requisitoscurso values('".$id."','".$req."')";	   
	     $resultado_set =  mysql_query($sql, $conexion );
	     $filas_r = mysql_affected_rows ($conexion);
	     if($filas_r > 0){
	        echo "<script>alert('Requisito Ingresado con Exito...');</script>"; 
	        echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	        echo "window.location.href= 'AdminCursos.php'";	   
	        echo "</script>";   
		 }else{
		    echo "<script>alert('No se pudo Ingresar Registro. Intente de Nuevo...');</script>"; 
	        echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	        echo "window.location.href= 'AdminCursos.php'";	   
	        echo "</script>";   
		 }
	  }else{
	     echo "<script>alert('El Campo no Puede estar Vacio...');</script>"; 
	     echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	     echo "window.location.href= 'CargaRequisitos2.php?Id=$id'";	   
	     echo "</script>";
	  }
   }
   if($_POST['Ingresar2']){      
      $req = $_POST['CampoRequisito'];
	  if ($req != ""){
	     $sql="insert into requisitoscurso values('".$id."','".$req."')";	   
	     $resultado_set =  mysql_query($sql, $conexion );
	     $filas_r = mysql_affected_rows ($conexion);
	     if($filas_r > 0){
	        echo "<script>alert('Requisito Ingresado con Exito...');</script>"; 
	        echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	        echo "window.location.href= 'CargaRequisitos2.php?Id=$id''";	   
	        echo "</script>";   
		 }else{
		    echo "<script>alert('No se pudo Ingresar Registro. Intente de Nuevo...');</script>"; 
	        echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	        echo "window.location.href= 'AdminCursos.php'";	   
	        echo "</script>";   
		 }
	  }else{
	     echo "<script>alert('El Campo no Puede estar Vacio...');</script>"; 
	     echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	     echo "window.location.href= 'CargaRequisitos2.php?Id=$id'";	   
	     echo "</script>";
	  }
   }
?>
<html>
<head>   
<title>Ingresando Curso Base...</title>
      <link href="../../../funciones/estilo.css" rel="stylesheet" type="text/css">
</head>
<body>
   <form name="form1" method="post" action="">
   <table width="566" border="1" align="center">
     <tr>
       <td><div align="center" class="Estilo16">Ingresando Requisitos para el Curso &quot;<?php echo $row_curso['Nombre'];?>&quot; </div></td>
     </tr>
     <tr>
       <td><input type="hidden" name="CampoId" id="CampoId"  value="<? echo $Id;?>"></td>
     </tr>
     <tr>
       <td><table width="558" border="1">
         <tr>
           <td width="71" class="Estilo19">Requisito</td>
           <td width="420" class="Estilo4">
            <input name="CampoRequisito" type="text" size="70" maxlength="150">           </td>
         </tr>
       </table></td>
     </tr>
     <tr>
       <td>&nbsp;</td>
     </tr>
     <tr>
       <td><table width="558" border="0">
         <tr>
           <td width="61">&nbsp;</td>
           <td width="104"><label>
             <input name="Ingresar" type="Submit" class="boton" value="Ingresar y Salir">
           </label></td>
           <td width="248"><input name="Ingresar2" type="Submit" class="boton" value="Ingresar y Reportar Otro Requisito Requisito"></td>
           <td width="54"><div align="center" class="boton"><a href="CursosBases.php">Regresar</a></div></td>
           <td width="47">&nbsp;</td>
         </tr>
       </table></td>
     </tr>
   </table>
   </form>
</body>
</html>
