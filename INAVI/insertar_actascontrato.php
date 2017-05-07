<?php
	//Codigo de Errores//
	error_reporting(E_ALL | E_NOTICE);
	ini_set('display_errors', true);
	ini_set('html_errors', true);

	include_once('Connections/bd_inavi.php');
	mysql_select_db($database_bd_inavi, $bd_inavi);
	include_once('clases.php');




	if (isset($_POST['tipoactas'])){
	$acta = $_POST['tipoactas']; 
	}
	if (isset($_POST['numerocontrato'])){
	$contrato = $_POST['numerocontrato']; 
	}
	if (isset($_POST['fechaactas'])){
	$fecha = $_POST['fechaactas']; 
	}
	if (isset($_POST['descripcion'])){
	$descripcion = $_POST['descripcion']; 
	}

	if (isset($_POST['Submit'])){
		if (($acta!="") && ($contrato!="") && ($fecha!="") && ($descripcion!="") ){
			if ($acta==3)
				if (($_POST['desde']!="") && ($_POST['hasta']!="")){
					$fecha=cambiar_fecha($fecha);
					$fechad=cambiar_fecha($_POST['desde']);
					$fechah=cambiar_fecha($_POST['hasta']);
					$insert = insertar_actas_contrato($bd_inavi,$acta,$contrato,$fecha,$descripcion,$fechad,$fechah);
				}
				else
					$mensaje="Debe ingresar todos los campos!!";
			else{
					$fecha=cambiar_fecha($fecha);
					$insert = insertar_actas_contrato($bd_inavi,$acta,$contrato,$fecha,$descripcion,NULL,NULL);
			}
			if ($insert==false)
				$mensaje="Error, no se pudo insertar!";
			else
				$mensaje="Registro Ingresado Exitosamente!";
		}
		else
			$mensaje="Debe ingresar todos los campos!!";
	}
	

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Ingresar Contrato</title>

<link rel="StyleSheet" href="estilos.css" type="text/css" media="screen">
  <script type="text/javascript" src="calendar.js" charset="ISO-8859-15"></script>
   <link type="text/css" href="calendar-blue.css" rel="stylesheet" >
   
<script>

function nueva_empresa() {

window.open("insertar_acta.php","Nueva", "height=250, width=600, left=200, top=200, status=yes, toolbar=no, menubar=no, location=no");
}

function cargar_calendario(){
	campo = document.formulario.tipoactas.value;
	if (campo=='3'){
		document.getElementById('cal_desde').style.visibility="visible";
		document.getElementById('cal_hasta').style.visibility="visible";
		document.getElementById('desde').value="";
		document.getElementById('hasta').value="";
	}
	else{
		document.getElementById('cal_desde').style.visibility="hidden";
		document.getElementById('cal_hasta').style.visibility="hidden";
		document.getElementById('desde').value="-- No aplica --";
		document.getElementById('hasta').value="-- No aplica --";
		//document.getElementById('cal_hasta').style.visibility="visible";

	}

}
</script>

</head>


<body background="img/fondo_inavi.jpg">
<p>&nbsp;</p>

<form name="formulario" method="post">
  <table width="750" height="277" border="0" align="center" cellpadding="2" cellspacing="2">
    <tr>
      <td>


  <table width="346" border="0" align="center">
    <tr>
      <td colspan="2" class="titulo_tabla">Introduzca los datos de la acta contrato </td>
    </tr>
    <tr>
      <td class="cabecera">N&ordm; Contrato </td>
      <td class="ingresar_der"><select name="numerocontrato" id="numerocontrato" class="Forms">
          <option></option>
          <?php
			$result = select_contratos($bd_inavi);
			$reg = mysql_fetch_assoc($result);

		   do{ ?>
          <option><?php echo $reg['id_contrato']; } while($reg=mysql_fetch_assoc($result)); ?> </option>
      </select></td>
    </tr>
    <tr>
      <td class="cabecera">Tipo De Acta </td>
      <td class="ingresar_der">
        <select name="tipoactas" id="tipoactas" class="Forms" onChange="cargar_calendario();">
          <option></option>
          <?php
			$result = select_actas($bd_inavi);
			$reg = mysql_fetch_assoc($result);

		   do{ ?>
          <option value="<?php echo $reg['id_actas'];?>"><?php echo $reg['descripcion_actas']; } while($reg=mysql_fetch_assoc($result)); ?> </option>
        </select>
        <a class="enlace" onClick="nueva_empresa();">Nueva</a></td>
    </tr>

    <tr>
      <td class="cabecera">Desde</td>
      <td class="ingresar_der"><input name="desde" type="text" readonly="true" id="desde" class="Forms">
	  <a href= "javascript:void(0)" onclick="if(self.gfPop)gfPop.fPopCalendar(document.formulario.desde); return false;" HIDEFOCUS>
	  <img id="cal_desde" align="absmiddle" src="img/show-calendar.gif" width="20" height="20" border="0" alt=""></a>
		        
    </tr>
    <tr>
      <td class="cabecera">Hasta</td>
      <td class="ingresar_der"><input name="hasta" type="text" readonly="true" id="hasta" class="Forms">
	  <a href= "javascript:void(0)" onclick="if(self.gfPop)gfPop.fPopCalendar(document.formulario.hasta); return false;" HIDEFOCUS>
	  <img id="cal_hasta" align="absmiddle" src="img/show-calendar.gif" width="20" height="20" border="0" alt=""></a>

		<iframe width=154 height=180 name="gToday:normal:normal.js" id="gToday:normal:normal.js" src="HelloWorld/ipopeng.htm" 
				scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
                </iframe>

    </tr>
    <tr>
      <td class="cabecera">Fecha del Acta </td>
      <td class="ingresar_der"><input name="fechaactas" type="text" readonly="true" id="fechaactas" class="Forms" value="<?php echo date('d-m-Y');?>">
	  <a href= "javascript:void(0)" onclick="if(self.gfPop)gfPop.fPopCalendar(document.formulario.fechaactas); return false;" HIDEFOCUS>
	  <img align="absmiddle" src="img/show-calendar.gif" width="20" height="20" border="0" alt=""></a>

    </tr>
    <tr>
      <td class="cabecera">Descripcion (Motivo) </td>
      <td class="ingresar_der"><textarea name="descripcion" id="objeto" class="Forms"></textarea></td>
    </tr>
    <tr>
      <td colspan="2" align="center" class="ingresar_der"><input type="submit" name="Submit" value="Enviar"></td>
    </tr>
  </table>
    </td>
    </tr>
  </table>

    <?php if (isset($mensaje)){ ?>
    		<p class="Mensajes"><?php echo $mensaje;?></p>
	<?php };	?>
  
</form>
</body>
</html>