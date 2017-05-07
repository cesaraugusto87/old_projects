<?php

	//Codigo de Errores//
	error_reporting(E_ALL | E_NOTICE);
	ini_set('display_errors', true);
	ini_set('html_errors', true);
	
	include_once('Connections/bd_inavi.php');
	mysql_select_db($database_bd_inavi, $bd_inavi);
	include_once('clases.php');

	$id_contrato=$_GET['contrato'];
		
	$contrato = consultar_contrato($bd_inavi,$id_contrato);
	$empresa = consultar_empresa($bd_inavi,$contrato['fk_idempresa']);
	$entidad = nombre_entidad($bd_inavi,$contrato['fk_identidad']);
	$cuenta_c = consultar_cuenta_c($bd_inavi,$id_contrato);

	//$monto_modif=$contrato['monto_original']-($cuenta_c);

	$obra_v = consultar_obra_v($bd_inavi,$id_contrato);
	$garantias = consultar_garantias($bd_inavi,$id_contrato);
	$valuaciones = consultar_valuaciones($bd_inavi,$id_contrato);
	$valuaciones2 = consultar_valuaciones($bd_inavi,$id_contrato);
	
	$actas = consultar_actas_contrato($bd_inavi,$id_contrato);
	
	$ant_amort = sumar_anticipos($bd_inavi,$id_contrato);

	$saldo_cont = consultar_saldo_contr($bd_inavi,$id_contrato);
	$saldo_inst = consultar_saldo_instituto($cant,$bd_inavi,$id_contrato);
	$total_saldo_inst = 0;
	if ($cant>0)
		$total_saldo_inst =($saldo_inst['indemnizacion']+$saldo_inst['multaatrasada']+$saldo_inst['obrarelacionadanoejecutada']+$saldo_inst['anticipoporamortizar']);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<link rel="StyleSheet" href="estilos.css" type="text/css" media="all">
  <script type="text/javascript" src="calendar.js" charset="ISO-8859-15"></script>
  
     <link type="text/css" href="calendar-blue.css" rel="stylesheet" >

<style type="text/css">
<!--
body {
	background-image: url(img/fondo_inavi.jpg);
}
-->
</style></head>

<body>
<form id="form1" name="form1" method="get">

  <table width="730" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td class="Textos">DETALLE CONTRATO</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
     
 
 				<!--  Primera tabla: DETALLES DEL CONTRATO  -->
    
	<tr >
      <TD align="center">
	  
	  <table width="700" border="0" cellspacing="2" cellpadding="2">
      <tr class="titulo_tabla">
          <td colspan="9" >Caracteristicas Generales del Contrato</td>
        </tr>
 		<tbody class="cabecera_c">
        <tr>
          <td>Contrato</td>
          <td>Entidad</td>
		 <td>Fecha Firma</td>
		 <td>Objeto</td>
		 <td>Monto BsF.</td>
		 <td>Limite BsF.</td>
		 <td>Inicio</td>
		 <td>Terminacion</td>
		 <td>&nbsp;</td>
  		</tr>
		</tbody>
		
		<tbody>
		<tr class="contenido">		  

         <td><?php echo $contrato['id_contrato'];?></td>
          <td><?php echo $entidad;?></td>
          <td><?php echo mostrar_fecha($contrato['fecha']);?></td>
          <td><?php echo $contrato['objeto'];?></td>
          <td><?php echo $contrato['monto_original'];?></td>
          <td><?php echo $contrato['limite'];?></td>
          <td><?php echo mostrar_fecha($contrato['inicio']);?></td>
          <td><?php echo mostrar_fecha($contrato['terminacion']);?></td>
		  <td><a href="modificar_contrato.php?contrato=<?php echo $contrato['id_contrato']; ?>">
		  <img src="img/button_edit.png" border="0" width="15" height="15" title="Modificar Contrato"></a></td>

		 </tr>
		 </tbody>
     </table>
	  </td>
    </tr>

    
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>

 				<!--  Segunda tabla: DETALLES DE LA EMPRESA CONTRATISTA  -->


	<tr>
      <TD align="center">
	  
	  <table width="700" border="0" cellspacing="2" cellpadding="2">
      <tr class="titulo_tabla">
          <td colspan="4">Caracteristicas Generales de la Empresa Contratista</td>
        </tr>
 		<tbody class="cabecera_c">
        <tr>
          <td>Nombre</td>
          <td>RIF</td>
		 <td >Representante Legal</td>
		 <td>C.I / RIF</td>
		 </tr>
		</tbody>
		
		<tbody class="contenido">
		<tr>		  

         <td><?php echo $empresa['nombre_e'];?></td>
          <td><?php echo $empresa['id_empresa'];?></td>
          <td><?php echo $empresa['representante'];?></td>
          <td><?php echo $empresa['ced_representant'];?></td>

		 </tr>
		 </tbody>
     </table>
	  </td>
    </tr>
	
	
	   <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>



				<!--  Segunda tabla: OBSERVACIONES : ACTAS  -->


	<tr>
      <TD align="center">
	  
	  <table width="700" border="0" cellspacing="2" cellpadding="2">
      <tr class="titulo_tabla">
          <td colspan="6">Actas</td>
        </tr>
 		<tbody class="cabecera_c">
        <tr>
          <td>Nombre</td>
          <td>Fecha</td>
		 <td>Descripcion</td>
		 <td>Desde</td>
		 <td>Hasta</td>
		 <td>&nbsp;</td>
		</tr>
		</tbody>
		
		<?php while ($acta = mysql_fetch_assoc($actas)){ ?>
		<tr class="contenido">		  

         <td><?php echo $acta['descripcion_actas'];?></td>
          <td><?php echo mostrar_fecha($acta['fecha_actas']);?></td>
          <td><?php echo $acta['descripcion'];?></td>
          <td><?php if ($acta['desde']=="0000-00-00") echo "No aplica"; else echo mostrar_fecha($acta['desde']);?></td>
          <td><?php if ($acta['hasta']=="0000-00-00") echo "No aplica"; else echo mostrar_fecha($acta['hasta']);?></td>
		  <td><a href="modificar_acta.php?contrato=<?php echo $id_contrato; ?>&id_acta=<?php echo $acta['id_actas_contrato'];?>">
		  <img src="img/button_edit.png" border="0" width="15" height="15" title="Modificar Acta"></a></td>

		 </tr>
		 <?php }?>
     </table>
	  </td>
    </tr>
	
	
	   <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>





				<!--  Tercera tabla: DETALLES DE LA CUENTA CONTRATO  -->


	<tr>
      <TD align="center">
	  
	  <table width="700" border="0" cellspacing="2" cellpadding="2">
      <tr class="titulo_tabla">
          <td colspan="6">Caracteristicas Generales de la Cuenta Contrato</td>
        </tr>
 		<tbody class="cabecera_c">
        <tr>
          <td>Monto Original</td>
          <td>Disminuciones</td>
		 <td>Aumentos</td>
		 <td>Obras Extras</td>
		 <td>Monto Modificado</td>
  		</tr>
		</tbody>
		
		<tr class="contenido">		  

         <td><?php echo $contrato['monto_original'];?></td>
          <td><?php echo $cuenta_c['disminuciones'];?></td>
          <td><?php echo $cuenta_c['obrasextras'];?></td>
          <td><?php echo $cuenta_c['aumentos'];?></td>
          <td><?php echo ($contrato['monto_original']-($cuenta_c['disminuciones']+$cuenta_c['obrasextras']+$cuenta_c['aumentos']));?></td>

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



				<!--  Cuarta tabla: DETALLES DEL PORCENTAJE DE OBRA EJECUTADA  -->


	<tr>
      <TD align="center">
	  
	  <table width="700" border="0" cellspacing="2" cellpadding="2">
      <tr class="titulo_tabla">
          <td colspan="5">Cuenta Porcentaje de Obra Ejecutada</td>
        </tr>
 		<tbody class="cabecera_c">
        <tr>
          <td>Fecha</td>
          <td>Monto Original del Contrato</td>
          <td>Monto Obra Verificada</td>
          <td>Saldo Actual del Contrato</td>
          <td>Porcentaje Obra Ejecutada</td>
  		</tr>
		</tbody>
		
		<tr class="contenido">		  
         <td><?php echo mostrar_fecha($obra_v['fechaoverificada']);?></td>
          <td><?php echo $contrato['monto_original'];?></td>
         <td><?php echo $obra_v['saldo'];?></td>
          <td><?php echo ($contrato['monto_original']-$obra_v['saldo']);?></td>
          <td><?php echo ($obra_v['saldo']*100)/$contrato['monto_original']." %";?></td>
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



				<!--  Quinta tabla: DETALLES DEL PORCENTAJE DE OBRA NO  EJECUTADA  -->


	<tr>
      <TD align="center">
	  
	  <table width="700" border="0" cellspacing="2" cellpadding="2">
      <tr class="titulo_tabla">
          <td colspan="3">Cuenta Porcentaje de Obra No Ejecutada</td>
        </tr>
 		<tbody class="cabecera_c">
        <tr>
         <td>Monto Original del Contrato</td>
          <td>Monto Obra Verificada</td>
          <td>Obra por Ejecutar</td>
  		</tr>
		</tbody>
		
		<tr class="contenido">		  
         <td><?php echo $contrato['monto_original'];?></td>
          <td><?php echo $obra_v['saldo'];?></td>
          <td><?php echo ($contrato['monto_original']-$obra_v['saldo']);?></td>

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



				<!--  Sexta tabla: GARANTIAS CONSTITUIDAS A FAVOR DEL INSTITUTO -->


	<tr>
      <TD align="center">
	  
	  <table width="700" border="0" cellspacing="2" cellpadding="2">
      <tr class="titulo_tabla">
          <td colspan="5">Garantias a favor de INAVI</td>
        </tr>
 		<tbody class="cabecera_c">
        <tr>
          <td>Fianza</td>
          <td>Emitida Por</td>
          <td>Poliza N&ordm;</td>
          <td>Monto BsF.</td>
		  <td>&nbsp;</td>
  		</tr>
		</tbody>
		
		<?php 
				$anticipo_entregado=0;
				while ($garantia = mysql_fetch_assoc($garantias)){ 
					if ($garantia['descripcionf']=="Anticipo")
						$anticipo_entregado=$garantia['monto'];
			?>
		<tr class="contenido">		  
         <td><?php echo $garantia['descripcionf'];?></td>
         <td><?php echo $garantia['emitida_por'];?></td>
          <td><?php echo $garantia['numeropoliza'];?></td>
          <td><?php echo $garantia['monto'];?></td>
		  <td><a href="modificar_fianza.php?contrato=<?php echo $id_contrato;?>&id_fianza=<?php echo $garantia['id_fianzacontrato'];?>">
		  <img src="img/button_edit.png" border="0" width="15" height="15" title="Modificar Fianza"></a></td>

		 </tr>
		 <?php }; ?>
     </table>
	  </td>
    </tr>

    
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>



			<!--  Sexta tabla: CUENTA OBRA RELACIONADA SEGUN VALUACIONES -->


	<tr>
      <TD align="center">
	  
	  <table width="700" border="0" cellspacing="2" cellpadding="2">
      <tr class="titulo_tabla">
          <td colspan="8">Obra Relacionada segun Valuaciones</td>
        </tr>
 		<tbody class="cabecera_c">
        <tr>
          <td rowspan="2" colspan="2">Valuaciones</td>
          <td rowspan="2">Monto</td>
          <td>Deducciones</td>
          <td colspan="3">&nbsp;</td>
		</tr>
		<tr>
          <td>Retenciones</td>
          <td>Amortizaciones</td>
          <td colspan="2">Monto</td>
  		</tr>
		<tr>
          <td >Num</td>
          <td >Fecha</td>
          <td >Bruto</td>
          <td >Fiel Cump</td>
          <td >Anticipo</td>
          <td >Neto</td>
		  <td>&nbsp;</td>
		
		
		</tr>
		</tbody>
		
		<?php while ($val = mysql_fetch_assoc($valuaciones)){ ?>
		<tr class="contenido">		  
         <td><?php echo $val['descripcion'];?></td>
         <td><?php echo mostrar_fecha($val['fecha']);?></td>
          <td><?php echo $val['monto_bruto'];?></td>
          <td><?php echo "Nada";?></td>
         <td><?php echo $val['anticipo'];?></td>
         <td><?php echo $val['monto_bruto']-$val['anticipo'];?></td>
		  <td><a href="modificar_valuacion.php?contrato=<?php echo $id_contrato;?>&id_val=<?php echo $val['id_cuentavaluaciones'];?>">
		  <img src="img/button_edit.png" border="0" width="15" height="15" title="Modificar Valuacion"></a></td>

		 </tr>
		 <?php }; ?>
     </table>
	  </td>
    </tr>

    
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>


				<!--  Sexta tabla: VALUACIONES COBRADAS -->


	<tr>
      <TD>
	  
	  <table width="450" border="0" cellspacing="2" cellpadding="2" align="center">
      <tr class="titulo_tabla">
          <td colspan="8">Valuaciones Cobradas</td>
        </tr>
		<?php $total=0;
			while ($val = mysql_fetch_assoc($valuaciones2)){
				$neto= $val['monto_bruto']-$val['anticipo'];
				$total = $total + $neto;?>
		<tr class="contenido">		  
         <td width="250"><?php echo $val['descripcion'];?></td>
         <td width="100"><?php echo "Bs.F.";?></td>
          <td width="100"><?php echo $neto;?></td>
		 </tr>
		 <?php }; ?>
		<tr class="contenido">		  
         <td width="150"><?php echo "Total Valuaciones Cobradas";?></td>
         <td width="150"><?php echo "Bs.F.";?></td>
          <td width="150"><?php echo $total;?></td>
		 </tr>
		 </tbody>
     </table>
	  </td>
    </tr>

    
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>



				<!--  Sexta tabla: CUENTA ANTICIPO   -->


	<tr>
      <TD>
	  
	  <table width="450" border="0" cellspacing="2" cellpadding="2" align="center">
      <tr class="titulo_tabla">
          <td colspan="8">Cuenta Anticipo</td>
        </tr>
		<tr class="contenido">		  
         <td width="250"><?php echo "Anticipo Entregado";?></td>
         <td width="100"><?php echo $anticipo_entregado;?></td>
		 </tr>
		<tr class="contenido">		  
         <td width="150"><?php echo "Anticipo Amortizado";?></td>
         <td width="150"><?php echo $ant_amort;?></td>
		 </tr>
		<tr class="contenido">		  
         <td width="150"><?php echo "Saldo por Amortizar";?></td>
         <td width="150"><?php echo $anticipo_entregado-$ant_amort;?></td>
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


			<!--  Sexta tabla: SALDO A FAVOR DEL CONTRATISTA   -->


	<tr>
      <TD>
	  
	  <table width="450" border="0" cellspacing="2" cellpadding="2" align="center">
      <tr class="titulo_tabla">
          <td colspan="8">Saldo a Favor del Contratista</td>
        </tr>
		<tbody >
		<tr class="contenido">		  
         <td width="250"><?php echo "Obra Ejecutada No Relacionada";?></td>
         <td width="100"><?php echo $saldo_cont['oenr'];?></td>
		 </tr>
		<tr class="contenido">		  
         <td width="150"><?php echo "Retencion de Fiel Cumplimiento";?></td>
         <td width="150"><?php echo $saldo_cont['retencion'];?></td>
		 </tr>
		<tr class="contenido">		  
         <td width="150"><?php echo "Total Saldo a favor del Contratista";?></td>
         <td width="150"><?php echo $saldo_cont['oenr'] - $saldo_cont['retencion'];?></td>
		 </tr>
		 </tbody>
     </table>
	  </td>
    </tr>

    
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>


		<!--  Sexta tabla: SALDO A FAVOR DEL INSTITUTO   -->


	<tr>
      <TD>
	  
	  <table width="450" border="0" cellspacing="2" cellpadding="2" align="center">
      <tr class="titulo_tabla">
          <td colspan="8">Saldo a Favor del Instituto</td>
        </tr>
		<tbody >
		<tr class="contenido">		  
         <td width="250"><?php echo "Indemnizacion";?></td>
         <td width="100"><?php echo $saldo_inst['indemnizacion'];?></td>
		 </tr>
		<tr class="contenido">		  
         <td width="150"><?php echo "Multa Por Atraso";?></td>
         <td width="150"><?php echo $saldo_inst['multaatrasada'];?></td>
		 </tr>
		<tr class="contenido">		  
         <td width="150"><?php echo "Anticipo Por Amortizar";?></td>
         <td width="150"><?php echo $saldo_inst['anticipoporamortizar'];?></td>
		 </tr>
		<tr class="contenido">		  
         <td width="150"><?php echo "Obra Relacionada No Ejecutada";?></td>
         <td width="150"><?php echo $saldo_inst['obrarelacionadanoejecutada'];?></td>
		 </tr>
		<tr class="contenido">		  
         <td width="150"><?php echo "Total Saldo a Favor del Instituto";?></td>
         <td width="150"><?php echo $total_saldo_inst;?></td>
		 </tr>
		 </tbody>
     </table>
	  </td>
    </tr>

    
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>


	<!--  Sexta tabla: LIQUIDACION   -->


	<tr>
      <TD>
	  
	  <table width="450" border="0" cellspacing="2" cellpadding="2" align="center">
      <tr class="titulo_tabla">
          <td colspan="8">LIQUIDACION</td>
        </tr>
		<tbody class="cabecera_c">
        <tr>
          <td width="150">CONCEPTO</td>
          <td width="150">A FAVOR DE LA EMPRESA</td>
          <td width="150">A FAVOR DEL INSTITUTO</td>
  		</tr>
		</tbody>
		<tbody >
		<tr class="contenido">		  
         <td width="150"><?php echo "Anticipo Por Amortizar";?></td>
         <td width="150">&nbsp;</td>
         <td width="150"><?php echo $saldo_inst['anticipoporamortizar'];?></td>
		 </tr>
		<tr class="contenido">		  
         <td width="250"><?php echo "Indemnizacion";?></td>
         <td width="150">&nbsp;</td>
         <td width="100"><?php echo $saldo_inst['indemnizacion'];?></td>
		 </tr>
		<tr class="contenido">		  
         <td width="150"><?php echo "Obra Ejecutada No Relacionada";?></td>
         <td width="150"><?php echo $saldo_cont['oenr'];?></td>
         <td width="150">&nbsp;</td>
		 </tr>
		<tr class="contenido">		  
         <td width="150"><?php echo "Obra Relacionada No Ejecutada";?></td>
         <td width="150">&nbsp;</td>
         <td width="150"><?php echo $saldo_inst['obrarelacionadanoejecutada'];?></td>
		 </tr>
		<tr class="contenido">		  
         <td width="150"><?php echo "Multa Por Atraso";?></td>
         <td width="150">&nbsp;</td>
         <td width="150"><?php echo $saldo_inst['multaatrasada'];?></td>
		 </tr>
		<tr class="contenido">		  
         <td width="150"><?php echo "Retencion Fiel Cumplimiento";?></td>
         <td width="150">&nbsp;</td>
         <td width="150">&nbsp;</td>
		 </tr>
		<tr class="contenido">		  
         <td width="150"><?php echo "Total";?></td>
         <td width="150"><?php $saldo_c=$saldo_cont['oenr'] - $saldo_cont['retencion']; echo $saldo_c;?></td>
         <td width="150"><?php echo $total_saldo_inst;?></td>
		 </tr>
		<tr class="contenido">		  
         <td width="150"><?php echo "Saldo a favor de "; 
		 						if ($total_saldo_inst > $saldo_c) echo "INAVI";
								else echo "CONTRATISTA";
		 ?></td>
		 <?php
			if ($total_saldo_inst > $saldo_c){
		 ?>
         <td width="150">&nbsp;</td>
         <td width="150"><?php echo $total_saldo_inst-$saldo_c;?></td>
		 <?php
		 	}
			else{
		 ?>
         <td width="150"><?php echo $saldo_c - $total_saldo_inst;?></td>
         <td width="150">&nbsp;</td>
		 <?php
		 	}
		 ?>
		 
		 
		 </tr>
		 </tbody>
     </table>
	  </td>
    </tr>

    
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2" align="center"><a href="pdf_contrato.php?contrato=<?php echo $id_contrato;?>"><img src="img/pdf.png" border="0" title="Generar Doc PDF"></a></td>
    </tr>
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>

  </table>

</form>
</body>
</html>