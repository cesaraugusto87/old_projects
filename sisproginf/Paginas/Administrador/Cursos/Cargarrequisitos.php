<html>
<head>
<title>SIGASP -CONOCIMIENTOS</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript" src="../../js/menu.js" type="text/JavaScript"></script>
<link href="../../funciones/estilo.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="../../Templates/calendario/javascripts.js"></script>
<style type="text/css">
<!--
.Estilo1 {
	color: #990000;
	font-weight: bold;
	font-size: 18px;
}
.Estilo4 {color: #000000; font-weight: bold; font-size: 12px; }
-->
</style>
<link href="../../../funciones/estilo.css" rel="stylesheet" type="text/css">
</head>
<body>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  
 
  <tr> 
   
    <td width="87%">
   <div align="center">
     <?php 
include('../../funciones/conexionMySQL.php');
include('../../js/validar.js');
include('../../js/validarentrada.js');
include ("../../Templates/calendario/calendario.php");

$opcion=$_GET['opcion']; 
$cedula=$_GET['Cedula']; 
$ingresar=$_POST['butSubmit'];
$ingresar2=$_POST['butSubmit2'];
$conexion = Conectarse();

//-----------  INGRESAR CONOCIMIENTO-------------//


if ($ingresar == "Ingresar"){	
	  
	 $cedula=$_POST['Cedula'];
	 $conocimiento=$_POST['conocimiento'];
     
	 $prueba ="select * from aspirante where Cedula ='".$cedula."'";
	 $resultado = mysql_query ($prueba, $conexion) or die(mysql_error()); 
	 $filas_a = mysql_affected_rows ($conexion);
	 if ($filas_a == 0){
	   echo "<script>alert('debe ingresar primero los datos personales');    </script>";
	   echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	   echo "window.location.href= '../paginas/Cargarconocimientos.php?Cedula=$cedula'";
	   echo "</script>";	} 
    else {
	 
	 $prueba ="select * from conocimientos where ((Cedula ='".$cedula."')and (Conocimiento ='".$conocimento."')) ";    
	 $resultado = mysql_query ($prueba, $conexion) or die(mysql_error());
	 $filas_a = mysql_affected_rows ($conexion);
	  if ($filas_a == 1){
	   echo "<script>alert('Conocimiento ya registrado');    </script>";
	   echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	   echo "window.location.href= '../paginas/Cargarconocimientos.php?Cedula=$cedula'";
	   echo "</script>";	}
      else{	 
          $sql="insert into conocimientos values('".$cedula."','".$conocimiento."')";     
		$resultado_set =  mysql_query($sql, $conexion );
	    $filas_r = mysql_affected_rows ($conexion);
		
		if($filas_r > 0){
			echo "<script>alert('Los datos se han INGRESADO correctamente Ver curriculo');</script> "; 
			echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
			echo "window.location.href= '../Paginas/DisenoCurriculo.php?Cedula=$cedula'";
			
			
			echo "</script>";
			exit; 
	 	}
    	else{
      		echo "<script>alert('No se pudo GUARDAR los Datos');</script>";	
           echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
			 echo "window.location.href= '../paginas/Cargarconocimientos.php?Cedula=$cedula'";
			echo "</script>";
			exit; 
		}  
     } 	
 }
}

//-----------  INGRESAR CONOCIMIENTO y CARGAR OTRO-------------//


if ($ingresar2 == "Ingresar y Guardar otro"){	
	  
	 $cedula=$_POST['Cedula'];
	 $conocimiento=$_POST['conocimiento'];
     
	 $prueba ="select * from aspirante where Cedula ='".$cedula."'";
	 $resultado = mysql_query ($prueba, $conexion) or die(mysql_error()); 
	 $filas_a = mysql_affected_rows ($conexion);
	 if ($filas_a == 0){
	   echo "<script>alert('debe ingresar primero los datos personales');    </script>";
	   echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	    echo "window.location.href= '../paginas/Cargarconocimientos.php?Cedula=$cedula'";
	   echo "</script>";	} 
    else {
	 
	 $prueba ="select * from conocimientos where ((Cedula ='".$cedula."')and (Conocimiento ='".$conocimento."')) ";    
	 $resultado = mysql_query ($prueba, $conexion) or die(mysql_error());
	 $filas_a = mysql_affected_rows ($conexion);
	  if ($filas_a == 1){
	   echo "<script>alert('Conocimiento ya registrado');    </script>";
	   echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	   echo "window.location.href= '../paginas/Cargarconocimientos.php?Cedula=$cedula'";
	   echo "</script>";	}
      else{	 
          $sql="insert into conocimientos values('".$cedula."','".$conocimiento."')";     
		$resultado_set =  mysql_query($sql, $conexion );
	    $filas_r = mysql_affected_rows ($conexion);
		
		if($filas_r > 0){
			echo "<script>alert('Los datos se han INGRESADO correctamente');</script> "; 
			echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
			echo "window.location.href= '../paginas/Cargarconocimientos.php?Cedula=$cedula'";
			echo "</script>";
			exit; 
	 	}
    	else{
      		echo "<script>alert('No se pudo GUARDAR los Datos');</script>";	
           echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
			echo "window.location.href= '../paginas/Cargarconocimientos.php?Cedula=$cedula'";
			echo "</script>";
			exit; 
		}  
     } 	
 }
}


?>
     
     <span class="Estilo16">Ingresando Requisitos para el Curso &quot;&quot;  </span>
   </div>
   <div id="Cuerpo"> 
          <div align="center"></div>
          <form action="../../paginas/Cargarconocimientos.php" method="post" name="frmConocimiento" id="Formulario"  onsubmit="return validarconocimiento(this)">
            <table width="100%" border="0"align="center">
             <input  type="hidden"  name="Cedula" value="<?php echo $cedula; ?>">
	   <tr> 
              <td width="40%" valign="top"> <div align="right" id="Cuerpo"><strong>Conocimiento o Habilidad</strong></div></td>
              <td> 
         		 <input name="conocimiento" type="text"  maxlength="30" size="50" onKeyPress="return validar(event)">        </td>    
            </tr>
	  	   
	  <tr> 
                 <td width="40%"> 
                  <div  align="right"> 
       
            <input type="submit" name="butSubmit" value="Ingresar">
			<input type="submit" name="butSubmit2" value="Ingresar y Guardar otro">
            <input type="reset" name="butSubmit5" value="Borrar">
          </div></td>
      </tr>
    </table>
  </form>
  </div>
</table>
</body>
</html>
