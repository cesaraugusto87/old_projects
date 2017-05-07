<?php
	//Codigo de Errores//
	error_reporting(E_ALL | E_NOTICE);
	ini_set('display_errors', true);
	ini_set('html_errors', true);

	include_once('Connections/bd_inavi.php');
	mysql_select_db($database_bd_inavi, $bd_inavi);
	include_once('clases.php');


	if (isset($_POST['Submit']))
		if ($_POST['nombreacta']!="")
			if (verificar_existente($bd_inavi,"actas","descripcion_actas",$_POST['nombreacta'])==0){
				$insert=insertar_acta($bd_inavi,$_POST['nombreacta']);
				if ($insert==false)
					$mensaje="Error, se pudo insertar!";
				else
					$mensaje="Registro Ingresado Exitosamente!";
			}
			else
				$mensaje="Tipo de Acta Ya Registrada!";
		else
			$mensaje="Debe Ingresar El Nombre del Acta!!";


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title></title>

<link rel="StyleSheet" href="estilos.css" type="text/css" media="all">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>


<body background="img/fondo_inavi.jpg">

<form name="form2" method="post">
  <table width="750" height="277" border="0" align="center" cellpadding="2" cellspacing="2">
    <tr>
      <td>
	  
	  <table width="400" align="center" cellpadding="2" cellspacing="2">
          <tr>
            <td colspan="2" class="titulo_tabla">Ingrese los datos de la nueva acta</td>
          </tr>
          <tr>
            <td width="119" class="cabecera">Nombre Del Acta </td>
            <td width="211" class="ingresar_der"><input name="nombreacta" type="text" id="nombre_empresa" size="25" class="Forms"></td>
          </tr>
          <tr>
            <td colspan="2" class="ingresar_der" align="center"><input type="submit" name="Submit" value="Enviar"></td>
          </tr>
      </table>        
     </td>
    </tr>
  </table>

  <p align="center">&nbsp;</p>
  <?php if (isset($mensaje)) { ?>
    		<p class="Mensajes"><?php echo $mensaje;?></p>
	<?php };  ?>


  
  		
  
</form>
</body>
</html>
