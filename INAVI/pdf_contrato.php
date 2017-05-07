<?php

	//Codigo de Errores//
	error_reporting(E_ALL | E_NOTICE);
	ini_set('display_errors', true);
	ini_set('html_errors', true);
	
	include_once('Connections/bd_inavi.php');
	mysql_select_db($database_bd_inavi, $bd_inavi);
	include_once('clases.php');
	
	include ('class.ezpdf.php');
	$pdf =& new Cezpdf('Letter');
	$pdf->selectFont('fonts/arial.afm');
	$pdf->ezSetCmMargins(3,2,3,2);
	
	
	/** DEFINICION DE OPCIONES PARA PINTAR LAS TABLAS Y LOS TEXTOS **/

	$tabla_hor = array('showHeadings'=>1, 'shaded'=>0, 'maxWidth'=>510, 'showLines'=>2, 'fontSize'=>11, 'xPos'=>'center', 'xOrientation'=>'center',
				'cols'=>array(
					'1'=>array('justification'=>'center'),
					'2'=>array('justification'=>'center'),
					'3'=>array('justification'=>'center'),
					'4'=>array('justification'=>'center'),
					'5'=>array('justification'=>'center')));
	
	$titulos = array('justification' => 'center');

	$tabla_vert2 = array('showHeadings'=>0, 'rowGap'=>0, 'shaded'=>0, 'maxWidth'=>450, 'showLines'=>0, 'fontSize'=>11, 'xPos'=>'center',
						'xOrientation'=>'center', 
						'cols'=>array(
							'1'=>array('justification'=>'left', 'width'=>200),
							'2'=>array('justification'=>'left', 'width'=>250)));
		
	$tabla_vert3 = array('showHeadings'=>0, 'rowGap'=>0,'shaded'=>0, 'maxWidth'=>450, 'showLines'=>0, 'fontSize'=>11, 'xPos'=>'center',
				'xOrientation'=>'center',
		 		'cols'=>array(
					'1'=>array('justification'=>'left', 'width'=>250),
					'2'=>array('justification'=>'left', 'width'=>50),
					'3'=>array('justification'=>'left', 'width'=>150)));


	
	/** ENCABEZADO DEL DOCUMENTO  **/	
	
	$pdf->rectangle(90,690,430,60);
	$pdf->addJpegFromFile('img/logo_inavi.jpg',95,695,60); //logo

	$pdf->ezSetY(730);
	$opciones=array('justification' => 'center');
	$pdf->ezText("<b>CORTE DE CUENTA<b>",16,$opciones);
	
	$pdf->ezSetY(720);
	$opciones=array('justification' => 'right', 'aright'=>10);
	$pdf->ezText("Fecha: ".date("d/m/Y"),8,$opciones);

	$pdf->ezSetY(710);
	$opciones=array('justification' => 'center');
	$pdf->ezText("Form. 03-10-0067 (Rev. 05/09/2000)",8,$opciones);

	$pdf->ezText("\n\n",12);


	/** CONSULTAS DE LA INFORMACION DEL CONTRATO  **/	

	$id_contrato=$_GET['contrato'];
	$contrato = consultar_contrato($bd_inavi,$id_contrato);
	$empresa = consultar_empresa($bd_inavi,$contrato['fk_idempresa']);
	$entidad = nombre_entidad($bd_inavi,$contrato['fk_identidad']);
	$cuenta_c = consultar_cuenta_c($bd_inavi,$id_contrato);
	$obra_v = consultar_obra_v($bd_inavi,$id_contrato);
	$garantias = consultar_garantias($bd_inavi,$id_contrato);
	$valuaciones = consultar_valuaciones($bd_inavi,$id_contrato);
	$valuaciones2 = consultar_valuaciones($bd_inavi,$id_contrato);
	$actas = consultar_actas_contrato($bd_inavi,$id_contrato);
	$ant_amort = sumar_anticipos($bd_inavi,$id_contrato);
	$saldo_cont = consultar_saldo_contr($bd_inavi,$id_contrato);
	$saldo_inst = consultar_saldo_instituto($cant,$bd_inavi,$id_contrato);
	$total_saldo_inst = 0;
	$anticipo_entregado = 0;

	// TABLA INFORMACION CONTRATO  


	$pdf->ezText("<b>CARACTERISTICAS GENERALES DEL CONTRATO<b>\n\n",12,$titulos);


	$data[] = array('1'=>'Entidad Federal: ', '2'=>$entidad);
	$data[] = array('1'=>'Nº. de Contrato: ', '2'=>$contrato['id_contrato']);
	$data[] = array('1'=>'Fecha de la Firma:', '2'=>mostrar_fecha($contrato['fecha']));
	$data[] = array('1'=>'Objeto:', '2'=>$contrato['objeto']);
	
	$pdf->ezTable($data,'','',$tabla_vert2);	


	// TABLA INFORMACION DE LA EMPRESA CONTRATISTA  
	
	$data = "";
	$pdf->ezText("\n\n",10);

	$data[] = array('1'=>'Empresa Contratista: ', '2'=>$empresa['nombre_e']);
	$data[] = array('1'=>'Representante Legal', '2'=>$empresa['representante']);
	$data[] = array('1'=>'C.I. Nº', '2'=>$empresa['ced_representant']);
	$data[] = array('1'=>'Monto Original Bs.F:', '2'=>$contrato['monto_original']);
	$data[] = array('1'=>'Limite de Contratacion Bs.F:', '2'=>$contrato['limite']);
	$data[] = array('1'=>'Inicio S/Contrato:', '2'=>mostrar_fecha($contrato['inicio']));
	$data[] = array('1'=>'Terminacion S/Contrato', '2'=>mostrar_fecha($contrato['terminacion']));
				

	$pdf->ezTable($data,'','',$tabla_vert2);


	// TABLA INFORMACION CUENTA CONTRATO  

	$data ="";
	$pdf->ezText("\n\n",12);
	
	$pdf->ezText("<b>CUENTA CONTRATO<b>\n\n",12,$titulos);
	
	$data[] = array('1'=>'Monto Original', '2'=>'Bs.', '3'=>$contrato['monto_original']);
	$data[] = array('1'=>'Disminuciones', '2'=>'Bs.', '3'=>$cuenta_c['disminuciones']);
	$data[] = array('1'=>'Aumentos', '2'=>'Bs.', '3'=>$cuenta_c['obrasextras']);
	$data[] = array('1'=>'Obras Extras', '2'=>'Bs.', '3'=>$cuenta_c['aumentos']);
	$data[] = array('1'=>'Monto Modificado', '2'=>'Bs.', '3'=>($contrato['monto_original']-($cuenta_c['disminuciones']+$cuenta_c['obrasextras']+$cuenta_c['aumentos'])));
	

	$pdf->ezTable($data,'','',$tabla_vert3);
	

	/** TABLA INFORMACION OBRA EJECUTADA  **/	

	$data ="";
	$pdf->ezText("\n\n",12);

	$pdf->ezText("<b>CUENTA PORCENTAJE OBRA EJECUTADA<b>\n\n",12,$titulos);
	
	$data[] = array('1'=>'Monto Original del Contrato', '2'=>'Bs.', '3'=>$contrato['monto_original']);
	$data[] = array('1'=>'Monto Obra Verificada', '2'=>'Bs.', '3'=>$obra_v['saldo']);
	$data[] = array('1'=>'Saldo Actual del Contrato', '2'=>'Bs.', '3'=>($contrato['monto_original']-$obra_v['saldo']));
	$data[] = array('1'=>'Porcentaje Obra Ejecutada', '2'=>'Bs.', '3'=>($obra_v['saldo']*100)/$contrato['monto_original']." %");
	
	$pdf->ezTable($data,'','',$tabla_vert3);
	

	// TABLA INFORMACION OBRA NO EJECUTADA  
 
	$data ="";
	$pdf->ezText("\n\n",12);

	$pdf->ezText("<b>CUENTA PORCENTAJE OBRA NO EJECUTADA<b>\n\n",12,$titulos);
	
	$data[] = array('1'=>'Monto Original del Contrato', '2'=>'Bs.', '3'=>$contrato['monto_original']);
	$data[] = array('1'=>'Monto Obra Verificada', '2'=>'Bs.', '3'=>$obra_v['saldo']);
	$data[] = array('1'=>'Obra por Ejecutar', '2'=>'Bs.', '3'=>($contrato['monto_original']-$obra_v['saldo']));
	
	$pdf->ezTable($data,'','',$tabla_vert3);

	
	// TABLA INFORMACION GARANTIAS A FAVOR DE INSTITUTO (FIANZAS)  

	$data ="";
	$pdf->ezText("\n\n",12);

	$pdf->ezText("<b>GARANTIAS CONSTITUIDAS A FAVOR DEL INSTITUTO<b>\n\n",12,$titulos);
	
	$titles = array('1'=>'Fianza', '2'=>'Emitida Por', '3'=>'Poliza N', '4'=>'Monto Bs.F.');
	
	while ($garantia = mysql_fetch_assoc($garantias)){ 
		if ($garantia['descripcionf']=="Anticipo")
			$anticipo_entregado=$garantia['monto'];
		$data[] = array('1'=> $garantia['descripcionf'], '2'=>$garantia['emitida_por'], '3'=>$garantia['numeropoliza'],
						'4'=>$garantia['monto']);
 	};
	
	$pdf->ezTable($data,$titles,'',$tabla_hor);


	// TABLA INFORMACION VALUACIONES  

	$data ="";
	$pdf->ezText("\n\n",12);

	$pdf->ezText("<b>CUENTA OBRA RELACIONADA SEGUN VALUACIONES<b>\n\n",12,$titulos);
	
	$titles = array('1'=>'', '2'=>'', '3'=>'DEDUCCIONES', '4'=>' ', '5'=>' ');
	$data[] = array('1'=>'VALUACIONES', '2'=>'MONTO', '3'=>'RETENCIONES', '4'=>'AMORTIZACIONES', '5'=>'MONTO');
	$data[] = array('1'=>'NRO  -  FECHA', '2'=>'BRUTO', '3'=>'FIEL C.', '4'=>'ANTICIPO', '5'=>'NETO');

	$totalbruto=0;	$totalant=0;	$totalneto=0;
	
	while ($val = mysql_fetch_assoc($valuaciones)){
		$data[] = array('1'=>$val['descripcion']."   -   ".mostrar_fecha($val['fecha']), '2'=>$val['monto_bruto'],
						'3'=>'', '4'=>$val['anticipo'], '5'=>$val['monto_bruto']-$val['anticipo']);
		$totalbruto=$totalbruto+$val['monto_bruto'];
		$totalant=$totalant+$val['anticipo'];
		$totalneto=$totalneto+($val['monto_bruto']-$val['anticipo']);
	}
	
	$totalneto=$totalneto+$anticipo_entregado;  // AAAAAAAAAAAQUIIIIIIIIIIIIIIIIIIIIIIIIII
			  
	$data[] = array('1'=>'TOTALES', '2'=>$totalbruto, '3'=>'', '4'=>$totalant, '5'=>$totalneto);
   	
	$pdf->ezTable($data,$titles,'',$tabla_hor);


	
	

	// TABLA INFORMACION VALUACIONES COBRADAS 	

	 
	$data ="";
	$pdf->ezText("\n\n",12);

	$pdf->ezText("<b>VALUACIONES COBRADAS<b>\n\n",12,$titulos);
	
	$total=0;
	while ($val = mysql_fetch_assoc($valuaciones2)){
		$neto= $val['monto_bruto']-$val['anticipo'];
		$total = $total + $neto;
		$data[] = array('1'=>$val['descripcion'], '2'=>'Bs.:', '3'=>$neto);
    }; 

	$data[] = array('1'=>'Total Valuaciones Cobradas', '2'=>'Bs.:', '3'=>$total);

	$pdf->ezTable($data,'','',$tabla_vert3);


	// TABLA INFORMACION VALUACIONES COBRADAS 	

	$data ="";
	$pdf->ezText("\n\n",12);
 
 	$pdf->ezText("<b>CUENTA ANTICIPO<b>\n\n",12,$titulos);
	
	$data[] = array('1'=>'Anticipo Entregado', '2'=>'Bs.', '3'=>$anticipo_entregado);
	$data[] = array('1'=>'Anticipo Amortizado', '2'=>'Bs.', '3'=>$ant_amort);
	$data[] = array('1'=>'Saldo Por Amortizar', '2'=>'Bs.', '3'=>$anticipo_entregado-$ant_amort);
	
	$pdf->ezTable($data,'','',$tabla_vert3);


	// TABLA INFORMACION VALUACIONES COBRADAS 	

	$data ="";
	$pdf->ezText("\n\n",12);

	$pdf->ezText("<b>SALDO A FAVOR DEL CONTRATISTA<b>\n\n",12,$titulos);
	
	$data[] = array('1'=>'Obra Ejecutada No Relacionada', '2'=>'Bs.', '3'=>$saldo_cont['oenr']);
	$data[] = array('1'=>'Retencion Fiel Cumplimiento', '2'=>'Bs.', '3'=>$saldo_cont['retencion']);
	$data[] = array('1'=>'Total Saldo a favor del Contratista', '2'=>'Bs.', '3'=>$saldo_cont['oenr'] - $saldo_cont['retencion']);
	
	$pdf->ezTable($data,'','',$tabla_vert3);
	
	  
	// TABLA INFORMACION VALUACIONES COBRADAS 	

	$data ="";
	$pdf->ezText("\n\n",12);
	
	$pdf->ezText("<b>SALDO A FAVOR DEL INSTITUTO<b>\n\n",12,$titulos);
	
	$data[] = array('1'=>'Indemnizacion', '2'=>'Bs.', '3'=>$saldo_inst['indemnizacion']);
	$data[] = array('1'=>'Multa por Atraso', '2'=>'Bs.', '3'=>$saldo_inst['multaatrasada']);
	$data[] = array('1'=>'Anticipo por Amortizar', '2'=>'Bs.', '3'=>$saldo_inst['anticipoporamortizar']);
	$data[] = array('1'=>'Obra Relacionada No Ejecutada', '2'=>'Bs.', '3'=>$saldo_inst['obrarelacionadanoejecutada']);
	$data[] = array('1'=>'Total Saldo a favor del Instituto', '2'=>'Bs.', '3'=>0);

	$pdf->ezTable($data,'','',$tabla_vert3);



	// TABLA INFORMACION VALUACIONES COBRADAS 

	
	
	$data ="";
	$pdf->ezText("\n\n",12);

	$pdf->ezText("<b>LIQUIDACION<b>\n\n",12,$titulos);
	
	$titles = array('1'=>'CONCEPTO', '2'=>'A FAVOR DE LA EMPRESA', '3'=>'A FAVOR DEL INSTITUTO');
	
	if ($cant != 0){
	
		$total_saldo_inst = $saldo_inst['indemnizacion']+$saldo_inst['multaatrasada']+$saldo_inst['obrarelacionadanoejecutada']+$saldo_inst['anticipoporamortizar'];


		$data[] = array('1'=>'Anticipo por Amortizar', '2'=>'', '3'=>$saldo_inst['anticipoporamortizar']);
		$data[] = array('1'=>'Indemnizacion', '2'=>'', '3'=>$saldo_inst['indemnizacion']);
		$data[] = array('1'=>'Obra Ejecutada no Relacionada', '2'=>$saldo_cont['oenr'], '3'=>'');
		$data[] = array('1'=>'Obra Relacionada no Ejecutada', '2'=>'', '3'=>$saldo_inst['obrarelacionadanoejecutada']);
		$data[] = array('1'=>'Multa por Atraso', '2'=>'', '3'=>$saldo_inst['multaatrasada']);
		$data[] = array('1'=>'Retencion Fiel Cumplimiento', '2'=>$saldo_cont['retencion'], '3'=>'');
		$data[] = array('1'=>'Total', '2'=>$saldo_cont['oenr'] - $saldo_cont['retencion'], '3'=>$total_saldo_inst);

		if ($total_saldo_inst > ($saldo_cont['oenr'] - $saldo_cont['retencion']))
			$data[] = array('1'=>'Total a Favor de INAVI', '2'=>'', '3'=>$total_saldo_inst-$saldo_cont['oenr'] - $saldo_cont['retencion']); 
		else
			$data[] = array('1'=>'Total a Favor de '.$empresa['nombre_e'], '2'=>($saldo_cont['oenr'] - $saldo_cont['retencion'])-$total_saldo_inst, '3'=>'');
	}
	else{
	
		$data[] = array('1'=>'Anticipo por Amortizar', '2'=>'', '3'=>0);
		$data[] = array('1'=>'Indemnizacion', '2'=>'', '3'=>0);
		$data[] = array('1'=>'Obra Ejecutada no Relacionada', '2'=>0, '3'=>'');
		$data[] = array('1'=>'Obra Relacionada no Ejecutada', '2'=>'', '3'=>0);
		$data[] = array('1'=>'Multa por Atraso', '2'=>'', '3'=>0);
		$data[] = array('1'=>'Retencion Fiel Cumplimiento', '2'=>0, '3'=>'');
		$data[] = array('1'=>'Total', '2'=>0, '3'=>0);

		$data[] = array('1'=>'Total a Favor de INAVI', '2'=>'', '3'=>0); 
	}
	
	$op_tabla = array('showHeadings'=>1, 'shaded'=>0, 'maxWidth'=>500, 'showLines'=>2, 'fontSize'=>10, 'xPos'=>'center', 
					  'xOrientation'=>'center',
					  'cols'=>array(
					  		'1'=>array('justification'=>'center', 'width'=>200),
							'2'=>array('justification'=>'center', 'width'=>150),
							'3'=>array('justification'=>'center', 'width'=>150)));

	
	$pdf->ezTable($data,$titles,'',$op_tabla);
	
	
	$pdf->Stream();

?>

