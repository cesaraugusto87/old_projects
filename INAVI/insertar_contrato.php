<?php
	//Codigo de Errores//
	error_reporting(E_ALL | E_NOTICE);
	ini_set('display_errors', true);
	ini_set('html_errors', true);

include_once('Connections/bd_inavi.php');
mysql_select_db($database_bd_inavi, $bd_inavi);
include('clases.php');


if (isset($_POST['entidad'])){
$entidad = $_POST['entidad']; 
}
if (isset($_POST['num_contrato'])){
$num_contrato = $_POST['num_contrato']; 
}
if (isset($_POST['f_firma'])){
$f_firma = $_POST['f_firma']; 
}
if (isset($_POST['objeto'])){
$objeto = $_POST['objeto']; 
}
if (isset($_POST['select'])){
$empresa = $_POST['select']; 
}

if (isset($_POST['monto'])){
$monto = $_POST['monto']; 
}
if (isset($_POST['limite'])){
$limite = $_POST['limite']; 
}
if (isset($_POST['inicio'])){
$inicio = $_POST['inicio']; 
}
if (isset($_POST['terminacion'])){
$terminacion = $_POST['terminacion']; 

};

	if (isset($_POST['Submit'])){
		if (($entidad!="") && ($num_contrato!="") && ($f_firma!="") && ($objeto!="") && ($empresa!="") && ($monto!="") && ($limite!="") && ($inicio!="") && ($terminacion!="")){

			$f_firma = cambiar_fecha($f_firma);
			$inicio = cambiar_fecha($inicio);
			$terminacion = cambiar_fecha($terminacion);
			//echo "Fecha Firma=".$f_firma.", Inicio=".$inicio.", Terminacion=".$terminacion;

			if ($f_firma <= $inicio){
				if ($inicio <= $terminacion){
					$insert = insertar_contrato($bd_inavi,$num_contrato,$f_firma,$empresa,$entidad,$objeto,$monto,$limite,$inicio,$terminacion);
					if ($insert==true)
						$mensaje = "Registro Ingresado Exitosamente!";
					else
						$mensaje = "Error al Ingresar!";
				}
				else
					$mensaje = "Fecha inicio mayor que fecha terminacion!";
			}
			else
				$mensaje="Fecha inicio menor que fecha firma!";

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

   <!--<link type="text/css" href="calendar-blue.css" rel="stylesheet" >-->
 <script language="javascript" src="calendario.js"></script>  
<script>

function nueva_empresa() {

window.open("insertar_empresa.php","Nueva Empresa","height=400,width=800,left=90,top=200,status=yes,toolbar=no,menubar=no,location=no");
}

function nueva_entidad() {

window.open("insertar_entidad.php","Nueva Entidad","height=300,width=680,left=200,top=200,status=yes,toolbar=no,menubar=no,location=no");
}


</script>
   
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"></head>


<body background="img/fondo_inavi.jpg">
<p>&nbsp;</p>
<form name="formulario" method="post">

<table width="750" height="277" border="0" align="center" cellpadding="2" cellspacing="2">
<tr>
<td>

  <table width="400" border="0" align="center" cellpadding="2" cellspacing="2">
    <tr>
    <td height="30" colspan="2" class="titulo_tabla">Introduzca los datos del nuevo contrato</td>
    </tr>

    <tr>
      <td width="160" class="cabecera">Empresa Contratista</td>
      <td width="240" class="ingresar_der"><select name="select" id="select" class="Forms">
        <option></option>

        <?php
			$result = select_empresas($bd_inavi,"");
			$reg = mysql_fetch_assoc($result);

		   do{ ?>
        <option value="<?php echo $reg['id_empresa'];?>"><?php echo $reg['nombre_e']; } while($reg=mysql_fetch_assoc($result)); ?> </option>
      </select>
      <a class="enlace" onclick="nueva_empresa();">Nueva</a></td>
    </tr>
	
    <tr>
      <td class="cabecera">Entidad Federal </td>
      <td class="ingresar_der"><select name="entidad" id="entidad" class="Forms">
        <option></option>
        <?php
			$result = select_entidades($bd_inavi);
			$reg = mysql_fetch_assoc($result);

		   do{ ?>
        <option value="<?php echo $reg['id_entidad'];?>"><?php echo $reg['descripcion_ent']; } while($reg=mysql_fetch_assoc($result)); ?> </option>
      </select>
      <a class="enlace" onclick="nueva_entidad();">Nueva</a></td>
    </tr>

    <tr>
      <td class="cabecera">N&ordm; del contrato </td>
      <td class="ingresar_der"><input name="num_contrato" type="text" id="num_contrato" class="Forms"></td>
    </tr>

    <tr>
      <td class="cabecera">Fecha de la firma </td>
      <td class="ingresar_der"><input name="f_firma" type="text" readonly="true" id="f_firma" class="Forms">
	  <a href= "javascript:void(0)" onclick="if(self.gfPop)gfPop.fPopCalendar(document.formulario.f_firma); return false;" HIDEFOCUS>
	  <img align="absmiddle" src="img/show-calendar.gif" width="20" height="20" border="0" alt=""></a>
		        <iframe width=154 height=180 name="gToday:normal:normal.js" id="gToday:normal:normal.js" src="HelloWorld/ipopeng.htm" 
				scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
                </iframe>
	  </td>
	  
    </tr>
 
    <tr>
      <td  class="cabecera">Objeto </td>
      <td class="ingresar_der"><textarea name="objeto" id="objeto" class="Forms"></textarea></td>
    </tr>
    <tr>
      <td class="cabecera">Monto Original </td>
      <td class="ingresar_der"><input name="monto" type="text" id="monto" class="Forms"></td>
    </tr>
    <tr>
      <td class="cabecera">Limite de contratacion </td>
      <td class="ingresar_der"><input name="limite" type="text" id="limite" class="Forms"></td>
    </tr>
    <tr>
      <td class="cabecera">Inicio </td>
      <td class="ingresar_der"><input name="inicio" readonly="true" type="text" id="inicio" class="Forms">
	  <a href= "javascript:void(0)" onclick="if(self.gfPop)gfPop.fPopCalendar(document.formulario.inicio); return false;" HIDEFOCUS>
	  <img align="absmiddle" src="img/show-calendar.gif" width="20" height="20" border="0" alt=""></a>
    </tr>
    <tr>
      <td class="cabecera">Terminacion </td>
      <td class="ingresar_der"><input name="terminacion" readonly="true" type="text" id="terminacion" class="Forms">
	  <a href= "javascript:void(0)" onclick="if(self.gfPop)gfPop.fPopCalendar(document.formulario.terminacion); return false;" HIDEFOCUS>
	  <img  align="absmiddle" src="img/show-calendar.gif" width="20" height="20" border="0" alt=""></a>
    </tr>
	<tr>
	<td colspan="2" class="ingresar_der" align="center"><input type="submit" name="Submit" value="Guardar"></td>
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