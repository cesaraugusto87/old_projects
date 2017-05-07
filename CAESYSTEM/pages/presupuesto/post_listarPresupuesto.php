<?
 //include('../../conexion/conexion.php');
 session_start();
 session_register('id_presupuesto');
 $_SESSION['id_presupuesto'] = $_POST['id_presupuesto'];
 include('xajax/xajax.php');
 include('control_nuevo_presupuesto.php');
 $xajax->printJavascript('xajax');
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Ver Presupuesto</title>
<link href="../../css/styles.css" rel="stylesheet" type="text/css" />
</head>
<script type="text/javascript">
	function atras_listarPresupuesto(){
		history.back();
	}
</script>
<script>
	function mostrarOrdenado() {
	var textos = ''; 
	datos = new Array();
	for (var i=1;i<document.getElementById('tablaItems').rows.length;i++){
		aux = new Array();
		//for (var j=0;j<5;j++){
			aux[0] = document.getElementById('tablaItems').rows[i].cells[0].innerHTML;
			aux[1] = document.getElementById('tablaItems').rows[i].cells[4].innerHTML;
			aux[2] = document.getElementById('tablaItems').rows[i].cells[3].innerHTML;
		//}
		datos[i-1] = aux;
	}
	var tablaitems = datos.toString();
	document.formDivisiones.tablaitems.defaultValue = tablaitems; 
}
</script>
<body>
	<?			
		$id_presupuesto = $_POST['id_presupuesto'];
		if ($id_presupuesto == 0){
			mostrarMensaje("Debe seleccionar un Presupuesto");
		}
		$link = Conectarse();
		//$query = "SELECT fecha FROM presupuesto WHERE presupuesto.id_presupuesto = $id_presupuesto;";
		/*$query = "SELECT presupuestos.fecha
				FROM public.presupuestos
				WHERE presupuestos.id_presupuestos = $id_presupuesto;";
		if ($resultado = pg_exec($link,$query)){
			$fecha=pg_result($resultado,0,0);
		}*/
		$fecha = date(d.'/'.m.'/'.Y);
		$query = "SELECT clientes.rif,clientes.nombres,clientes.apellidos
				FROM public.presupuestos, public.clientes
				WHERE presupuestos.id_presupuestos = $id_presupuesto
				AND clientes.id_clientes = presupuestos.id_clientes";
		$cliente = "";
		if ($resultado = pg_exec($link,$query)){
			$id_cliente = pg_result($resultado,0,0);
			$cliente = pg_result($resultado,0,1)." ".pg_result($resultado,0,2);
		}else mostrarMensaje("Error al Conectar con la Base de Datos");
		
		print "<p class='Estilo1'>Consultar Presupuesto</p>";
		print "<p align='right'><a href='nuevoPresupuesto_pdf.php'?id=$id_presupuesto><IMG SRC='images/pdf.png' onClick='nuevoPresupuesto_pdf.php'></a></p>";
		print "<form action='post_nuevoPresupuesto.php' method=post name=formDivisiones onSubmit=mostrarOrdenado()>";
		print "<input type='hidden' id='codigo_i' name='codigo_i' value='0' />";
		print "<input type='hidden' id='descripcion_i' name='descripcion_i' value='0' />";
		print "<input type='hidden' id='precio_i' name='precio_i' value='0' />";
		print "<input type='hidden' id='cantidad_i' name='cantidad_i' value='0' />";
		print "<input name='tablaitems' type='hidden'/>";
		print "";
		print "<hr/>";
		print "<table width='600' height='300' border='1' align='center' cellpadding='0' cellspacing='0' class='ReportDetails'>";
		print "<tr>";
		print "<td width='596' height='250'><div id='ReportDetails'>";		
		print "<table width='400' height='70' border='0' align='center'>";
		print "<tr align='center' valign='middle'>";
		print "<td width='200' height='21' class='ReportDetailsEvenDataRow'><div align='center'>N&deg; Presupuesto </div></td>";
		print "<td width='200' align='center' valign='middle' class='ReportDetailsOddDataRow'><label> </label>";
		print "<div align='center'>Fecha</div></td>";
		print "</tr>";
		print "<tr>";
		print "<td width='200' height='43' align='center' valign='middle' class='ReportDetailsEvenDataRow'><input type='text' name='campo22' id='campo22' value=$id_presupuesto readonly></td>";
		print "<td width='200' align='center' valign='middle' class='ReportDetailsOddDataRow'><span class='ReportDetailsEvenDataRow'>";
		print "<input type='text' name='Fecha' id='Fecha' value=$fecha readonly>";
		print "</span></td>";
		print "</tr>";
		print "</table>";
		print "<p align='center' class='tituloTabla'>Datos del Cliente </p>";
		print "<table width='500' height='113' border='0' align='center'>";
		print "<tr>";
		print "<td width='164' class='ReportDetailsEvenDataRow'><div align='center'>C.I. / RiF </div></td>";
		print "<td width='276' class='ReportDetailsEvenDataRow'><label> </label>";
		print "<div align='center'>";
		print "<input type='text' name='Codigo_Cliente' id='Codigo_Cliente' value=$id_cliente readonly>";
		print "</div></td>";
		print "</tr>";
		print "<tr>";
		print "<td class='ReportDetailsOddDataRow'><div align='center'>Raz&oacute;n Social </div></td>";
		print "<td class='ReportDetailsOddDataRow'><div align='center'><span class='ReportDetailsEvenDataRow'>";
		print "<input type='text' name='razon' id='razon' value=$cliente readonly>";
		print "</span></div></td>";
		print "</tr>";
		print "</table>";
		print "<p>";
		print "<label>";
		print "<div align='center'>";
		print "<p align='center' class='tituloTabla'>A&ntilde;adir Items</p>";
		print "<table width='500' border='0' align='center'>";
		print "<tr class='ReportDetailsEvenDataRow'>";
		print "<td width='150'><div align='center' class='titulo1'>Busqueda</div></td>";
		print "<td><div align='center' class='titulo1'>Nombre</div></td>";
		print "</tr>";
		print "<tr class='ReportDetailsOddDataRow'>";
		print "<td width='150'><div align='center'>";
		print "<label>";
		print "<input type='text' name='text' onkeyup='xajax_buscar_items(this.value);' />";
		print "</label>";
		print "</div></td>";
		print "<td id = 'Nombre'><div align='center'>";
		print "<label>";
		print "<select name='select2' id='combo' Onchange='xajax_generar_tabla(this.value);' OnFocus='xajax_generar_tabla(this.value);'>";
		print "";
		print "</select>";
		print "</label>";
		print "</div></td>";
		print "</tr>";
		print "";
		print "</table>";
		print "<div align='center' id='marcos' class='titulo1'>";
		print "";
		print "</div>";
		print "<br />";
		print "";
		print "<table width='500' border='0''align='center'>";
		print "<tr>";
		print "<td width='100' id='Codigo' class='ReportDetailsEvenDataRow'><div align='center' class='titulo1'>Codigo</div></td>";
		print "<td width='300' id='Descripcion' class='ReportDetailsEvenDataRow'><div align='center' class='titulo1'>Descripcion</div></td>";
		print "<td width='300' id='Unitario' class='ReportDetailsEvenDataRow'><div align='center' class='titulo1'>P.Unitario</div></td>";
		print "<td width='120' id='Cantidad'class='ReportDetailsEvenDataRow'><div align='center' class='titulo1'>Cantidad</div></td>";
		print "<td width='50' class='ReportDetailsEvenDataRow'><div align='center' class='titulo1'>-</div></td>";
		print "</tr>";
		print "<tr>";
		print "<td width='100' class='ReportDetailsOddDataRow' id='Codigo_i'>&nbsp;</td>";
		print "<td id='Descripcion_i' class='ReportDetailsOddDataRow'>&nbsp;</td>";
		print "<td id='Unitario_i' class='ReportDetailsOddDataRow'>&nbsp;</td>";
		print "<td width='120'class='ReportDetailsOddDataRow' id='Cantidad_i'>&nbsp;</td>";
		print "<td width='50' class='ReportDetailsOddDataRow' id='botonAnadir'>&nbsp;</td>";
		print "</tr>";
		print "<tbody id='bodyTabla'></tbody>";
		print "</table>";
		print "<table id='tabla5' width='450' border='0''align='center'>";
		print "</table>";
		print "<p align='center' class='tituloTabla'>Detalle Items </p>";
		print "<div align='center'>";
		print "<table  width='600' border='0' id='tablaItems' class='ReportDetailsOddDataRow'>";
		print "<tr>";
		print "<td width='85' class='ReportDetailsEvenDataRow'><div align='center' class='titulo1'>Codigo</div></td>";
		print "<td width='155' class='ReportDetailsEvenDataRow'><div align='center' class='titulo1'>Descripcion</div></td>";
		print "<td width='100' class='ReportDetailsEvenDataRow'><div align='center' class='titulo1'>P.Unitario</div></td>";
		print "<td width='50' class='ReportDetailsEvenDataRow'><div align='center' class='titulo1'>Cantidad</div></td>";
		print "<td width='100' class='ReportDetailsEvenDataRow'><div align='center' class='titulo1'>Sub-Total</div></td>";
		print "<td width='20' class='ReportDetailsEvenDataRow'><div align='center' class='titulo1'>-</div></td>";
		print "</tr>";
		print "";
		print "<tbody id='tbDetalle'>";
		//Aki creo la tabla
		$subtotal_ = 0;
		$iva = 0.12;
		$filas = 0;
		//$query = "SELECT det_presupuesto.id_items,det_presupuesto.cantidad,items.precio,det_presupuesto.precio,items.descripcion
		//		FROM public.det_presupuesto, public.items
		//		WHERE det_presupuesto.id_presupuesto = $id_presupuesto
		//		AND det_presupuesto.id_items = items.id_items";
		$query = "SELECT mercancia.id_items,presupuestos_detalles.cantidad,inventario.costo,presupuestos_detalles.id_precio,items.nombre,items.descripcion
				FROM public.presupuestos,public.presupuestos_detalles,public.mercancia,public.inventario,public.items
				WHERE presupuestos.id_presupuestos = presupuestos_detalles.id_presupuesto 
				AND presupuestos.id_presupuestos = $id_presupuesto 
				AND presupuestos_detalles.id_merca = mercancia.id_merca 
				AND mercancia.id_items = inventario.id_items 
				AND inventario.id_items = items.id_items;";
		if ($resultado = pg_exec($link,$query)){
			$filas = pg_NumRows($resultado);
			$id_campos = 0;
			for ($i=0; $i < $filas; $i++) {
				$j=1;
				$id_campos++;
				$id_item=pg_result($resultado,$i,0);
				$cantidad=pg_result($resultado,$i,1);
				$precio_unitario=pg_result($resultado,$i,2);
				$subtotal_ += $subtotal=pg_result($resultado,$i,3);
				$descripcion=pg_result($resultado,$i,4).pg_result($resultado,$i,5);
				print "<tr id='rowDetalle_$id_campos'>";
				print "<td id='tdDetalle_$id_campos$j'>$id_item</td>";$j++;
				print "<td id='tdDetalle_$id_campos$j'>$descripcion</td>";$j++;
				print "<td id='tdDetalle_$id_campos$j'>$precio_unitario</td>";$j++;
				print "<td id='tdDetalle_$id_campos$j'>$cantidad</td>";$j++;
				print "<td id='tdDetalle_$id_campos$j'>$subtotal</td>";$j++;
				print "<td id='tdDetalle_$id_campos$j'><img src='images/delete.png' width='16' height='16' alt='Eliminar' onclick='xajax_eliminarFila($id_campos,$filas);'/></td>";
				print "</tr>";
			}
		}
		$iva *= $subtotal_;
		$total = $iva + $subtotal_;
		print "<input type='hidden' id='num_campos' name='num_campos' value=$filas />";
		print "<input type='hidden' id='cant_campos' name='cant_campos' value=$filas />";
		print "<input name='SubTotal_Tabla' id='SubTotal_Tabla' type='hidden' value=$subtotal_/>";
		print "</tbody>";			
		print "</table>";
		print "<div align='right'><br />";
		print "</div>";
		print "<table width='260' border='0' align='right'>";
		print "<tr>";
		print "<td width='105' class='ReportDetailsEvenDataRow'><div align='center' class='titulo1'>Sub - Total </div></td>";
		print "<td id='SubTotal' width='135' class='ReportDetailsEvenDataRow'><div id='Sub_Div 'align='center' class='titulo1'>";
		print "<input type='text' name='campo2222' id='Sub_Total' value=$subtotal_ readonly='readonly'/>";
		print "</div></td>";
		print "</tr>";
		print "<tr>";
		print "<td class='ReportDetailsOddDataRow'><div align='center' class='titulo1'>IVA (12%) </div></td>";
		print "<td class='ReportDetailsOddDataRow'><div id='Sub_Div 'align='center' class='titulo1'>";
		print "<input type='text' name='campo2222' id='IVA' value=$iva readonly='readonly'/>";
		print "</div></td>";
		print "</tr>";
		print "<tr>";
		print "<td class='ReportDetailsEvenDataRow'><div align='center' class='titulo1' >Total</div></td>";
		print "<td class='ReportDetailsEvenDataRow'><div id='Sub_Div 'align='center' class='titulo1'>";
		print "<input type='text' name='Total' id='Total' value=$total readonly='readonly'/>";
		print "</div></td>";
		print "</tr>";
		print "</table>";
		print "<p>&nbsp;            </p>";
		print "<p>&nbsp;</p>";
		print "</div>";
		print "</label>";
		print "<div align='center'>";
		print "<input type='submit' value='Confirmar'/>";
		print "</div></td>";
		print "</tr>";
		print "</table>";
		print "";
		print "</form>";
		
	
	//Libreria
		function mostrarMensaje($mensaje){
			print "<table width='600' height='300' border='0' align='center' cellpadding='0' cellspacing='0' class='ReportDetails'>";
			print "<tr>";
			print "<td width='596' height='250'><div id='ReportDetails'>";
			print "<p>&nbsp;</p>";
			print "<p>&nbsp;</p>";
			print "<table width='400' height='25' border='0' align='center'>";
			print "<tr align='center' valign='middle'>";
			print "<td height='21' class='ReportDetailsEvenDataRow'><div align='center'>";
			print "<p>$mensaje</p>";
			print "<p>";
			print "<input type='submit' name='Submit' value='Aceptar' onclick='atras_listarPresupuesto()'/>";
			print "</p>";
			print "</div>            </td>";
			print "</tr>";
			print "</table>";
			print "<p>&nbsp;</p>";
			print "<p>&nbsp;</p></td>";
			print "</tr>";
			print "</table>";
		}
	?>
</body>
</html>