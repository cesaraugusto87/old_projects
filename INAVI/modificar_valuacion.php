<?php
	//Codigo de Errores//
	error_reporting(E_ALL | E_NOTICE);
	ini_set('display_errors', true);
	ini_set('html_errors', true);

	include_once('Connections/bd_inavi.php');
	mysql_select_db($database_bd_inavi, $bd_inavi);
	include_once('clases.php');


	if (isset($_POST['valuacion'])){
	$valuacion = $_POST['valuacion']; 
	}
	if (isset($_POST['fecha'])){
	$fecha = $_POST['fecha']; 
	}
	if (isset($_POST['monto_bruto'])){
	$monto = $_POST['monto_bruto']; 
	}
	if (isset($_POST['anticipo_amort'])){
	$anticipoa = $_POST['anticipo_amort']; 
	}

	if (isset($_POST['Submit'])){
		if (($valuacion!="") && ($fecha!="") && ($monto!="") && ($anticipoa!="") ){
			$fecha = cambiar_fecha($fecha);
			$insert = modificar_valuacion_contrato($bd_inavi,$_GET['id_val'],$valuacion,$fecha,$monto,$anticipoa);
				
			if ($insert==false)
				$mensaje="Error, no se pudo insertar!";
			else
				$mensaje="Registro Ingresado Exitosamente!";
		}
		else
			$error="Debe ingresar todos los campos!!";	
	}


	if (isset($_GET['contrato'])){
		$contrato = $_GET['contrato']; 
	}

	if (isset($_GET['id_val'])){
		$id_val = $_GET['id_val']; 
	}
	
	if ($contrato!=""){
		$valuaciones = consultar_valuaciones($bd_inavi,$contrato);
		$c = mysql_fetch_assoc($valuaciones);
		while ($c['id_cuentavaluaciones']!=$id_val)
			$c = mysql_fetch_assoc($valuaciones);
	}
	
	if (isset($_POST['regresar']))
			header ("Location:detalle_contrato.php?contrato=".$contrato);	







?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Ingresar Contrato</title>

<link rel="StyleSheet" href="estilos.css" type="text/css" media="screen">
  <script type="text/javascript" src="calendar.js" charset="ISO-8859-15"></script>
   <link type="text/css" href="calendar-blue.css" rel="stylesheet" >
   
</head>

<body background="img/fondo_inavi.jpg">
<p>&nbsp;</p>

<form name="formulario" method="post">

  <table width="750" height="277" border="0" align="center" cellpadding="2" cellspacing="2">
    <tr>
      <td>

  <table width="350"  align="center">
    <tr>
      <td colspan="2" class="titulo_tabla">Modificar Valuaciones</td>
    </tr>

	<tr>
      <td class="cabecera">Valuacion </td>
      <td class="ingresar_der"><select name="valuacion" id="valuacion" class="Forms">
        <option></option>
        <?php
			$result = select_valuaciones($bd_inavi);
			while ($reg = mysql_fetch_assoc($result)){
				$sel = "";
				if ($reg['id_valuaciones'] == $c['fk_idvaluaciones'])
						$sel = "selected='selected'";
					else
						$sel = "";
	
		?>
        <option <?php echo $sel;?> value="<?php echo $reg['id_valuaciones'];?>"><?php echo $reg['descripcion']; } while($reg=mysql_fetch_assoc($result)); ?> </option>
      </select></td>
    </tr>

    <tr>
      <td class="cabecera">Fecha </td>
      <td bgcolor="#C2CEDE"><input name="fecha" type="text" readonly="true" id="fecha" class="Forms" value="<?php echo mostrar_fecha($c['fecha']);?>">
	  <a href= "javascript:void(0)" onclick="if(self.gfPop)gfPop.fPopCalendar(document.formulario.fecha); return false;" HIDEFOCUS>
	  <img id="cal_hasta" align="absmiddle" src="img/show-calendar.gif" width="20" height="20" border="0" alt=""></a>

		<iframe width=154 height=180 name="gToday:normal:normal.js" id="gToday:normal:normal.js" src="HelloWorld/ipopeng.htm" 
				scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
                </iframe>	  
	  </td>
    </tr>

    <tr>
      <td class="cabecera">Monto Bruto </td>
      <td bgcolor="#C2CEDE"><input name="monto_bruto" type="text" id="monto_bruto" class="Forms" value="<?php echo $c['monto_bruto'];?>"></td>
    </tr>

    <tr>
      <td class="cabecera">Anticipo (Amortizacion) </td>
      <td bgcolor="#C2CEDE"><input name="anticipo_amort" type="text" id="anticipo_amort" class="Forms" value="<?php echo $c['anticipo'];?>"></td>
    </tr>

    <tr>
      <td colspan="2" class="ingresar_der" align="center"><input type="submit" name="Submit" value="Enviar">
	  <input type="submit" name="regresar" value="Regresar"></td>
    </tr>

  </table>
  
  </td>
    </tr>
  </table>


     <?php if (isset($mensaje)){ ?>
    		<p class="Mensajes"><?php echo $mensaje;?></p>
	<?php }; ?>
	
</form>
</body>
</html>