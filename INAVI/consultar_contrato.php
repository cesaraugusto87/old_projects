<?php
	//Codigo de Errores//
	session_start();
	error_reporting(E_ALL | E_NOTICE);
	ini_set('display_errors', true);
	ini_set('html_errors', true);
	
	include_once('Connections/bd_inavi.php');
	mysql_select_db($database_bd_inavi, $bd_inavi);
	include_once('clases.php');
	
	//echo "usuario= ".$_SESSION['USUARIO'];

	$contrato="";
	$empr="";
	$fecha1="";
	$fecha2="";
	
	if (isset($_GET['contrato']) && isset($_GET['contrato'])!="")
		$contrato=$_GET['contrato'];
	if (isset($_GET['empresa']) && isset($_GET['empresa'])!="")
		$empr=$_GET['empresa'];
	if (isset($_GET['fecha_1']) && isset($_GET['fecha_1'])!="")
		$fecha1=$_GET['fecha_1'];
	if (isset($_GET['fecha_2']) && isset($_GET['fecha_2'])!="")
		$fecha2=$_GET['fecha_2'];
	
	if (isset($_GET['elim'])){
		$sql=eliminar_contrato($bd_inavi,$_GET['selecc']);
		if ($sql==false)
			$mensaje =  "ERROR! No se puedo eliminar!";
		else
			$mensaje = "Regisro Eliminado Exitosamente!!";
	}
	//echo $contrato;
	if (isset($_GET['buscar']) || isset($_GET['elim'])){
		if (($contrato!="") || ($empr!="") || ($fecha1!="") || ($fecha2!=""))
			if ((($fecha1!="") && ($fecha2=="")) || (($fecha1=="") && ($fecha2!="")))
				$mensaje="Busqueda Incorrecta! Debe ingresar ambas fechas!!";
			else
				$condicion = construir_consulta($contrato,$empr,cambiar_fecha($fecha1),cambiar_fecha($fecha2));
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
<form id="formulario" name="formulario" method="get">

  <table width="750" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td class="Textos">CONSULTAR CONTRATO</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
     
    
	<tr>
      <td><table width="750" border="0" cellspacing="2" cellpadding="2">
        
        <tr class="titulo_tabla">
          <td colspan="8">Ingrese los campos de busqueda</td>
        </tr>
 		<tbody class="cabecera_c">
        <tr>
          <td width="220">Empresa</td>
          <td width="180">Numero de Contrato</td>
		 <td width="350" colspan="2">Firma del Contrato Entre</td>
  
		</tr>
		</tbody>
		
		<tbody class="contenido">
	<tr>		  

 	  <td><select name="empresa" class="Forms">
		  <option></option>
		 <?php
			$result = select_empresas($bd_inavi,"");
			$reg = mysql_fetch_assoc($result);
		   do{
			?>
        		<option value="<?php echo $reg['id_empresa'];?>">
				<?php echo $reg['nombre_e']; }
			while($reg=mysql_fetch_assoc($result));
			?> </option>
		
		</select>
		 </td>

          <td><input type="text" name="contrato" id="contrato" class="Forms">
	     </td>

 	   <td><input name="fecha_1" readonly="true" type="text" id="fecha_1" size="10" class="Forms">
	  <a href= "javascript:void(0)" onclick="if(self.gfPop)gfPop.fPopCalendar(document.formulario.fecha_1); return false;" HIDEFOCUS>
	  <img id="cal_hasta" align="absmiddle" src="img/show-calendar.gif" width="20" height="20" border="0" alt=""></a>

		<iframe width=154 height=180 name="gToday:normal:normal.js" id="gToday:normal:normal.js" src="HelloWorld/ipopeng.htm" 
				scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
                </iframe>
		</td>		
 	   <td><input name="fecha_2" readonly="true" type="text" id="fecha_2" size="10" class="Forms">
	  <a href= "javascript:void(0)" onclick="if(self.gfPop)gfPop.fPopCalendar(document.formulario.fecha_2); return false;" HIDEFOCUS>
	  <img id="cal_hasta" align="absmiddle" src="img/show-calendar.gif" width="20" height="20" border="0" alt=""></a>

		</tr>
		</tbody>

		<tr class="contenido">
          <td height="30" colspan="4"><input type="submit" name="buscar" value="Buscar">
		  </td>
		</tr>
        
      </table>
	  </td>
    </tr>
    
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
  </table>
  
 



  <table width="750" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td><div align="center" class="Textos">RESULTADOS ENCONTRADOS</div></td>
    </tr>
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2">
	  <table width="750" border="0" cellpadding="1" cellspacing="2">
	  <thead class="cabecera_c">
        <tr height="35">
          <td width="90">Contrato</td>
          <td width="230">Empresa Titular</td>
          <td width="80">Fecha Firma</td>
          <td width="80">Monto Original</td>
          <td width="80">Inicio</td>
          <td width="90">Terminacion</td>
          <td width="100">Acciones</td>
        </tr>
		</thead>
		<?php
			if (isset($_GET['page']))
				$page = $_GET['page'];
			else
				$page = 1;
			
			$cantidad = 10;  // NUMERO DE CONTRATOS A LISTAR X PAGINA

			$sql = "select * from contrato";
			if (isset($condicion) && $condicion!="")
				$sql = $sql." WHERE ".$condicion;
				
			$sql = $sql." ORDER BY id_contrato"; // consulta completa
			
			$query = mysql_query($sql,$bd_inavi);
			$total=mysql_num_rows($query);
			$total_pages = ceil($total/$cantidad);

			$inicial = ($page-1)*$cantidad;
		
			$sql = $sql." LIMIT ".$cantidad." OFFSET ".$inicial;
			$query = mysql_query($sql,$bd_inavi);
			$cant=mysql_num_rows($query);
			
		   	while ($consulta=mysql_fetch_assoc($query)){ 
				$empresa = buscar_nombre_e($bd_inavi,$consulta['fk_idempresa']);
			?>
	
		<tbody align="center" class="contenido" bgcolor="#CCCCCC">
        <tr height="30">
          <td><?php echo $consulta['id_contrato'];?></td>
          <td><?php echo $empresa;?></td>
          <td><?php echo mostrar_fecha($consulta['fecha']);?></td>
          <td><?php echo $consulta['monto_original'];?></td>
          <td><?php echo mostrar_fecha($consulta['inicio']);?></td>
          <td><?php echo mostrar_fecha($consulta['terminacion']);?></td>
		  <td>
		  <a class="enlace" href="detalle_contrato.php?contrato=<?php echo $consulta['id_contrato']; ?>">
		  <img src="img/ver.png" border="0" width="15" height="15" title="Ver Detalles"></a>
		  
		   | <a href="consultar_contrato.php?elim=1&selecc=<?php echo $consulta['id_contrato'];?>
		   &contrato=<?php echo $contrato;?>&empresa=<?php echo $empr;?>&fecha_1=<?php echo $fecha1;?>&fecha_2=<?php echo $fecha2;?>"
		    onClick="if(!confirm('Confirma eliminar Contrato&#063;\nSE BORRARA TODA LA INFORMACION DEL MISMO.\nEsta Operacion no puede Deshacerse!')) return false">
			<img src="img/eliminar.png" border="0" width="15" height="15" title="Eliminar"></a>
		
		  </td>
        </tr>
		<?php }; ?>
		</tbody>
		
		<?php 
		if ($cant==0){
		?>
		<tr><td colspan="4">No se encontraron registros</td><td colspan="3" align="right">Ingresar Nuevo</td></tr>
		<?php }
		else {	?>
		<tr><td colspan="7" align="center" class="enlace"><?php paginacion($page,$total_pages,"consultar_contrato.php",$contrato,$empr,$fecha1,$fecha2);?></td></tr>
		<?php } ?>
		
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
    		<p class="Mensajes"><?php echo $mensaje;?></p>
	<?php };	?>
  

</form>
</body>
</html>
