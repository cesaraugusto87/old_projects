<?php
	//Codigo de Errores//
	error_reporting(E_ALL | E_NOTICE);
	ini_set('display_errors', true);
	ini_set('html_errors', true);
	
	include_once('Connections/bd_inavi.php');
	mysql_select_db($database_bd_inavi, $bd_inavi);
	include_once('clases.php');
	
	if (isset($_GET['elim'])){
		$band = validar_fk_empresa($bd_inavi,$_GET['selecc']);
		if ($band==0){
			$sql=eliminar_empresa($bd_inavi,$_GET['selecc']);
			if ($sql==false)
				$mensaje =  "ERROR! No se puedo eliminar!";
			else
				$mensaje = "Registro Eliminado Exitosamente!!";
		}
		else
			$mensaje = "La empresa no puede ser eliminada!!";
		
	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<link rel="StyleSheet" href="estilos.css" type="text/css" media="all">
  <script type="text/javascript" src="calendar.js" charset="ISO-8859-15"></script>
  
     <link type="text/css" href="calendar-blue.css" rel="stylesheet" >

</head>

<body background="img/fondo_inavi.jpg">
<MM:EndLock>
<form id="formulario" name="formulario" method="get">

   <table width="750" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td align="center" class="Textos">EMPRESAS</td>
    </tr>
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>

    <tr align="center">
      <td>
	  <table width="700" border="0" cellpadding="1" cellspacing="2">
	  <thead class="cabecera_c">
        <tr height="35">
          <td width="260">Empresa</td>
          <td width="100">RIF</td>
          <td width="200">Representante Legal</td>
          <td width="80">C.I / RIF</td>
          <td width="60">Acciones</td>
        </tr>
		</thead>
		<?php
			if (isset($_GET['page']))
				$page = $_GET['page'];
			else
				$page = 1;
			$cantidad = 10;

			$sql = "select * from empresa";
			if (isset($condicion) && $condicion!="")
				$sql = $sql." WHERE ".$condicion;
				
			$sql = $sql." ORDER BY nombre_e"; // consulta completa
			
			$query = mysql_query($sql,$bd_inavi);
			$total=mysql_num_rows($query);
			$total_pages = ceil($total/$cantidad);

			$inicial = ($page-1)*$cantidad;
		
			$sql = $sql." LIMIT ".$cantidad." OFFSET ".$inicial;
			$query = mysql_query($sql,$bd_inavi);
			$cant=mysql_num_rows($query);
			
		   	while ($consulta=mysql_fetch_assoc($query)){ 
			?>
	
        <tr height="30" class="contenido">
          <td><?php echo $consulta['nombre_e'];?></td>
          <td><?php echo $consulta['id_empresa'];?></td>
          <td><?php echo $consulta['representante'];?></td>
          <td><?php echo $consulta['ced_representant'];?></td>
		  <td>
		  <a href="modificar_empresa.php?rif=<?php echo $consulta['id_empresa']; ?>&page=<?php echo $page;?>">
		   <img src="img/button_edit.png" border="0" width="13" height="13" title="Modificar Empresa"></a>
		  | <a href="consultar_empresa.php?elim=1&selecc=<?php echo $consulta['id_empresa'];?>"
		   onClick="if(!confirm('Confirma eliminar Empresa&#063;\nSE BORRARA TODA LA INFORMACION DE LA MISMA.\nEsta Operacion no puede Deshacerse!')) return false">
		<img src="img/eliminar.png" border="0" width="13" height="13" title="Eliminar"></a>
		
		  </td>
        </tr>
		<?php }; ?>
		</tbody>

		<tr><td colspan="7" align="center" class="enlace"><?php paginacion($page,$total_pages,"consultar_empresa.php");?></td></tr>
		
		
      </table></td>
    </tr>
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
  </table>
  
   <?php if (isset($mensaje)){ ?>
    		<p class="Mensajes"><?php echo $mensaje; ?></p>
	<?php };	?>

</form>
</body>
</html>
