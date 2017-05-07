<?php 
include('../../conexion/conexion.php');

	function buscar_cliente($cliente){
		$objeto = new xajaxResponse();
		$conexion = Conectarse();
		if (strlen($cliente)>=6){
			$sql = "SELECT clientes.nombres,clientes.apellidos
					FROM public.clientes
					WHERE clientes.rif = '$cliente';";
			$consulta = pg_query($conexion,$sql); 
			$row= pg_fetch_array ($consulta);
			$objeto->addAssign("razon","value",$row["nombres"]." ".$row["apellidos"]);
		}
		pg_close($conexion);
		return $objeto;
	}

    function buscar_items($items){
		$objeto = new xajaxResponse();
		$conexion = Conectarse();
		if (strlen($items)>=3){
			$sql = "SELECT * from ITEMS WHERE descripcion LIKE '%".$items."%'"."OR nombre LIKE '%".$items."%'";
			$consulta = pg_query($conexion,$sql); 
			while ($row= pg_fetch_array ($consulta)){
				$id_items=$row["id_items"];
				$nombre.= "<option value=$id_items>".$row["nombre"]." - ".$row["descripcion"]."</option>";
				$objeto->addAssign("combo","innerHTML",$nombre); 			 
            }
        }
		pg_close($conexion);
		return $objeto;
	}
		
	function generar_tabla($id_items){
		$objeto_cod = new xajaxResponse();
		$conexion = Conectarse();
		$sql = "SELECT inventario.costo,items.descripcion,items.nombre,inventario.cantidad
				FROM public.inventario,public.items
				WHERE inventario.id_items = $id_items AND inventario.id_items = items.id_items;";
		$consulta = pg_query($conexion,$sql);
		if ($row= pg_fetch_array ($consulta)){
			$descripcion=$row["nombre"]." - ".$row["descripcion"];
			$precio=$row["costo"];
			$cantidad=$row["cantidad"];
			$objeto_cod->addAssign("codigo_i","value",$id_items);
			$objeto_cod->addAssign("descripcion_i","value",$descripcion);
			$objeto_cod->addAssign("precio_i","value",$precio);
			//$objeto_cod->addAssign("cantidad_i","value",0);
		    //$fila.= "<tr>"."<td width='85' class='ReportDetailsOddDataRow'>".$codigo."</td>"."<td width='650' id='descripcion' class='ReportDetailsOddDataRow'>".$nombre."</td>"."<td width='300' id='precio'class='ReportDetailsOddDataRow'>".$nombre."</td>"."<td width='60' id='cantidad'class='ReportDetailsOddDataRow'>".$nombre."</td>".
			"<td width='50' class='ReportDetailsEvenDataRow'><label><select name='select2'><option>1</option><option>2</option><option>3</option><option>4</option><option>5</option><option>6</option><option>7</option><option>8</option><option>9</option><option>10</option></select></label></td>"."<label>"."<input type='button' name='Submit' value='+' onclick='xajax_agregarFila(xajax.getFormValues(formDivisiones));'/>"."</label></tr>";
			//$objeto_cod->addAssign("tabla5","innerHTML",$fila); 
			//$comboCantidad = $cantidad."<label><select name='select2' onFocus='xajax_actualizarCantidad(this.value);' onChange='xajax_actualizarCantidad(this.value);'><option>0</option><option>1</option><option>2</option><option>3</option><option>4</option><option>5</option><option>6</option><option>7</option><option>8</option><option>9</option><option>10</option></select></label>"; 
			$botonAnadir = "<input type='button' name='Submit' value='+' onclick='xajax_agregarFila(xajax.getFormValues(formDivisiones));'/>"."</label>";
			$comboCantidad = $cantidad."<label><select name='select2' onChange='xajax_actualizarCantidad(this.value);'>";
			for($i=1; $i<=$cantidad;$i++){
				$comboCantidad .= "<option>$i</option>";
			}
			$comboCantidad .= "</select></label>";
			$idRow = "rowDetalle_$id_campos";
			$idTd = "tdDetalle_$id_campos";
 
			$objeto_cod->addAssign("Codigo_i", "innerHTML", $id_items);   //asignamos el contenido
			$objeto_cod->addAssign("Descripcion_i", "innerHTML", $descripcion);
			$objeto_cod->addAssign("Unitario_i", "innerHTML", $precio);
			$objeto_cod->addAssign("Cantidad_i", "innerHTML", $comboCantidad);
			$objeto_cod->addAssign("botonAnadir", "innerHTML", $botonAnadir);
		}		  		
		pg_close($conexion);
		return $objeto_cod;
	}
		
	function actualizarCantidad($seleccion){
		$obj = new xajaxResponse();
		$obj->addAssign("cantidad_i","value",$seleccion);
		return $obj;
	}
	
	function actualizarSubTotal($formulario){
		$obj = new xajaxResponse();
		extract($formulario);
		$Sub = $SubTotal_Tabla;
		$obj->addAssign("SubTotal_Tabla", "value", $Sub);
		$obj->addAssign("SubTotal", "innerHTML", "<div align='center' class='titulo1'>$Sub</div>");
		return $obj;
	}
		
	function eliminarFila($id_campo, $cant_campos){
		$respuesta = new xajaxResponse();
		$respuesta->addRemove("rowDetalle_$id_campo"); //borro el detalle que indica el parametro id_campo
		-- $cant_campos; //Resto uno al numero de campos y si es cero borro todo
		//$respuesta->addAssign("cant_campos" ,"value", $cant_campos);
		//$respuesta->addAssign("campo2233","value",$cant_campos);
		if($cant_campos == 0){
			$respuesta->addRemove("rowDetalle_0");
			$respuesta->addAssign("num_campos", "value", "0"); //dejo en cero la cantidad de campos para seguir agregando si asi lo desea el usuario
			$respuesta->addAssign("cant_campos", "value", "0");
			$respuesta->addAssign("SubTotal_Tabla", "value", 0);
			$respuesta->addAssign("Sub_Total", "value", 0);
			$respuesta->addAssign("IVA", "value", 0);
			$respuesta->addAssign("Total", "value", 0);
		}
		else if($cant_campos == 1){
			$respuesta->addScript("var suma = parseFloat(document.getElementById('tablaItems').rows[1].cells[4].innerHTML);
								   document.getElementById('SubTotal_Tabla').value = suma;
								   document.getElementById('Sub_Total').value = suma;
								   document.getElementById('IVA').value = suma*0.12;
								   document.getElementById('Total').value = suma + (suma*0.12);
								   //alert(suma);
								   ");
			//$respuesta->addAssign("SubTotal", "innerHTML", "<div align='center' class='titulo1'>'formDivisiones.SubTotal_Tabla.value'</div>");
			//actualizarSubTotal(xajax.getFormValues(formDivisiones));
		}
		else{
			$respuesta->addScript("
			var suma = 0;
			for (var i=1;i<document.getElementById('tablaItems').rows.length;i++){
				suma+=parseFloat(document.getElementById('tablaItems').rows[i].cells[4].innerHTML);
			}
			document.getElementById('SubTotal_Tabla').value = suma;
			document.getElementById('Sub_Total').value = suma;
			document.getElementById('IVA').value = suma*0.12;
			document.getElementById('Total').value = suma + (suma*0.12);
			//alert(suma);");
			//$respuesta->addAssign("SubTotal", "innerHTML", "<div align='center' class='titulo1'>'formDivisiones.SubTotal_Tabla.value'</div>");
			//actualizarSubTotal(xajax.getFormValues(formDivisiones));
		}
		$respuesta->addAssign("cant_campos", "value", $cant_campos);
		return $respuesta;
	}
		
	function agregarFila($formulario){
		$respuesta = new xajaxResponse();
		extract($formulario);
		$id_campos = $cant_campos = $num_campos+1;
		$str_html_td1 = $veousuario = $codigo_i;
		$str_html_td2 = $descripcion_i;
		$str_html_td3 = $precio_i;
		$str_html_td4 = $select2;
		$str_html_td5 = $select2*$precio_i;
		$str_html_td6 = '<img src="images/delete.png" width="16" height="16" alt="Eliminar" onclick="xajax_eliminarFila('. $id_campos .', formDivisiones.cant_campos.value);"/>';
		//$str_html_td6 = '<img src="../images/delete.png" width="16" height="16" alt="Eliminar" onclick="if(confirm(\'Realmente desea eliminar este detalle?\')){xajax_eliminarFila('. $id_campos .', formDivisiones.cant_campos.value);}"/>';
		$Sub = $SubTotal_Tabla + $str_html_td5;
		$respuesta->addAssign("SubTotal_Tabla", "value", $Sub);
		$respuesta->addAssign("Sub_Total", "value", $Sub);
		$respuesta->addAssign("IVA", "value", $Sub*0.12);
		$respuesta->addAssign("Total", "value", $Sub + ($Sub*0.12));
		/*<tr id='rowDetalle_$id_campos'>
		<td id='tdDetalle_$id_campos$i'></td>
		<td id='tdDetalle_$id_campos$i'></td>
		<td id='tdDetalle_$id_campos$i'></td>
		<td id='tdDetalle_$id_campos$i'></td>
		<td id='tdDetalle_$id_campos$i'></td>
		<td id='tdDetalle_$id_campos$i'></td>
		</tr>*/
		$idRow = "rowDetalle_$id_campos";
		$idTd = "tdDetalle_$id_campos";
		$respuesta->addCreate("tbDetalle", "tr", $idRow);
		$respuesta->addCreate($idRow, "td", $idTd."1");     //creamos los campos
		$respuesta->addCreate($idRow, "td", $idTd."2");
		$respuesta->addCreate($idRow, "td", $idTd."3");
		$respuesta->addCreate($idRow, "td", $idTd."4");
		$respuesta->addCreate($idRow, "td", $idTd."5");
		$respuesta->addCreate($idRow, "td", $idTd."6");
 
		$respuesta->addAssign($idTd."1", "innerHTML", $str_html_td1);   //asignamos el contenido
		$respuesta->addAssign($idTd."2", "innerHTML", $str_html_td2);
		$respuesta->addAssign($idTd."3", "innerHTML", $str_html_td3);
		$respuesta->addAssign($idTd."4", "innerHTML", $str_html_td4);
		$respuesta->addAssign($idTd."5", "innerHTML", $str_html_td5);
		$respuesta->addAssign($idTd."6", "innerHTML", $str_html_td6);
	 
		$respuesta->addAssign("num_campos","value", $id_campos);
		$respuesta->addAssign("cant_campos" ,"value", $id_campos);
		return $respuesta;
	}
	
	/* FUNCION LISTAR PRESUPUESTOS */		
    function listar_presupuesto($cliente,$inicio,$final){
	 $objeto = new xajaxResponse();
	 $conexion = Conectarse();
/* ------------------------------   CAMPO CLIENTE NO VACIO---------------------------------------------------*/	
	 if ($cliente){
	  if (($inicio) && ($final)){
		$ban=0;  
		  $sql = "SELECT presupuestos.id_presupuestos,clientes.nombres,clientes.apellidos,presupuestos.fecha,presupuestos.monto
				FROM public.presupuestos,public.clientes
				WHERE clientes.rif = '$cliente' 
				AND presupuestos.id_clientes = clientes.id_clientes 
				AND presupuestos.fecha >= '$inicio' 
				AND presupuestos.fecha <= '$final';";
		  $consulta = pg_query($conexion,$sql); 
		     while ($row= pg_fetch_array ($consulta)){
		     $codigo=$row[id_presupuesto];		 
			 $fila.="<tr>"."<td width='150' class='ReportDetailsEvenDataRow'>"."<div align='center' class='titulo1'>"."<Input type = 'Radio' Name ='id_presupuesto' value= ".$row[id_presupuestos].">".$row[id_presupuestos]."</div></td>"."<td width='179' class='ReportDetailsEvenDataRow'>"."<div align='center' class='titulo1'>".$row[nombres]." ".$row[apellidos]."</div></td>"."<td width='125' class='ReportDetailsEvenDataRow'>"."<div align='center' class='titulo1'>".$row[fecha]."</div></td>"."<td width='128' class='ReportDetailsEvenDataRow'>"."<div align='center' class='titulo1'>".$row[monto]."</div></td>"."</div></td></tr>";
			 $objeto->addAssign("mensaje" ,"innerHTML", "Resultados de la busqueda");
			 $objeto->addAssign("tabla_lis", "innerHTML", $fila);
			 $ban++;
			 }
			 
		  if ($ban==0){
				 
			  $objeto->addClear("tabla_lis","innerHTML"," ");
		      $objeto->addClear("mensaje","innerHTML"," ");
	          $objeto->addAssign("mensaje" ,"innerHTML", "No se obtuvieron resultados");
	        }
		}
	  if ((!$inicio) && (!$final)){
		  $sql = "SELECT presupuestos.id_presupuestos, clientes.nombres, clientes.apellidos, presupuestos.fecha, presupuestos.monto
				FROM public.presupuestos, public.clientes
				WHERE clientes.rif = '$cliente'
				AND clientes.id_clientes = presupuestos.id_clientes;";	  
 	      $consulta = pg_query($conexion,$sql);
		   $ban=0;
		     
			
		        while ($row= pg_fetch_array ($consulta)){
				  $codigo=$row[id_presupuestos];
			      $fila.="<tr>"."<td width='150' class='ReportDetailsEvenDataRow'>"."<div align='center' class='titulo1'>"."<Input type = 'Radio' Name ='id_presupuesto' value= ".$row[id_presupuestos].">".$row[id_presupuestos]."</div></td>"."<td width='179' class='ReportDetailsEvenDataRow'>"."<div align='center' class='titulo1'>".$row[nombres]." ".$row[apellidos]."</div></td>"."<td width='125' class='ReportDetailsEvenDataRow'>"."<div align='center' class='titulo1'>".$row[fecha]."</div></td>"."<td width='128' class='ReportDetailsEvenDataRow'>"."<div align='center' class='titulo1'>".$row[monto]."</div></td>"."</div></td></tr>";
			      $objeto->addAssign("mensaje" ,"innerHTML", "Resultados de la busqueda");
			      $objeto->addAssign("tabla_lis", "innerHTML", $fila);
			      $ban++; 
		       
			    }
			
		     if ($ban==0){
				 
			  $objeto->addClear("tabla_lis","innerHTML"," ");
		      $objeto->addClear("mensaje","innerHTML"," ");
	          $objeto->addAssign("mensaje" ,"innerHTML", "No se obtuvieron resultados");
	        }
	       
	    }
	  
	   if (($inicio) && (!$final)){
		  $sql = "SELECT presupuestos.id_presupuestos,clientes.nombres,clientes.apellidos,presupuestos.fecha,presupuestos.monto
				FROM public.presupuestos,public.clientes
				WHERE clientes.rif = '$cliente' 
				AND presupuestos.id_clientes = clientes.id_clientes 
				AND presupuestos.fecha = '$inicio'";
 	      $consulta = pg_query($conexion,$sql);
		   $ban=0;
		     
			
		        while ($row= pg_fetch_array ($consulta)){
				  $codigo=$row[id_presupuesto];
			      $fila.="<tr>"."<td width='150' class='ReportDetailsEvenDataRow'>"."<div align='center' class='titulo1'>"."<Input type = 'Radio' Name ='id_presupuesto' value= ".$row[id_presupuestos].">".$row[id_presupuestos]."</div></td>"."<td width='179' class='ReportDetailsEvenDataRow'>"."<div align='center' class='titulo1'>".$row[nombres]." ".$row[apellidos]."</div></td>"."<td width='125' class='ReportDetailsEvenDataRow'>"."<div align='center' class='titulo1'>".$row[fecha]."</div></td>"."<td width='128' class='ReportDetailsEvenDataRow'>"."<div align='center' class='titulo1'>".$row[monto]."</div></td>"."</div></td></tr>";
			      $objeto->addAssign("mensaje" ,"innerHTML", "Resultados de la busqueda");
			      $objeto->addAssign("tabla_lis", "innerHTML", $fila);
			      $ban++; 
		       
			    }
			
		     if ($ban==0){
				 
			  $objeto->addClear("tabla_lis","innerHTML"," ");
		      $objeto->addClear("mensaje","innerHTML"," ");
	          $objeto->addAssign("mensaje" ,"innerHTML", "No se obtuvieron resultados");
	        }   
	   } 
	    if ((!$inicio)&& ($final)){
		  $sql = "SELECT presupuestos.id_presupuestos,clientes.nombres,clientes.apellidos,presupuestos.fecha,presupuestos.monto
				FROM public.presupuestos,public.clientes
				WHERE clientes.rif = '$cliente'  
				AND presupuestos.id_clientes = clientes.id_clientes 
				AND presupuestos.fecha = '$final'";
 	      $consulta = pg_query($conexion,$sql);
		   $ban=0;
		     
			
		        while ($row= pg_fetch_array ($consulta)){
				  $codigo=$row[id_presupuesto];
			      $fila.="<tr>"."<td width='150' class='ReportDetailsEvenDataRow'>"."<div align='center' class='titulo1'>"."<Input type = 'Radio' Name ='id_presupuesto' value= ".$row[id_presupuestos].">".$row[id_presupuestos]."</div></td>"."<td width='179' class='ReportDetailsEvenDataRow'>"."<div align='center' class='titulo1'>".$row[nombres]." ".$row[apellidos]."</div></td>"."<td width='125' class='ReportDetailsEvenDataRow'>"."<div align='center' class='titulo1'>".$row[fecha]."</div></td>"."<td width='128' class='ReportDetailsEvenDataRow'>"."<div align='center' class='titulo1'>".$row[monto]."</div></td>"."</div></td></tr>";
			      $objeto->addAssign("mensaje" ,"innerHTML", "Resultados de la busqueda");
			      $objeto->addAssign("tabla_lis", "innerHTML", $fila);
			      $ban++; 
		       
			    }
			
		     if ($ban==0){
				 
			  $objeto->addClear("tabla_lis","innerHTML"," ");
		      $objeto->addClear("mensaje","innerHTML"," ");
	          $objeto->addAssign("mensaje" ,"innerHTML", "No se obtuvieron resultados");
	        } 
		}
	}
	/*---------------------------------- FIN DE CAMPO CLIENTE NO VACIO -------------------------------------------------------------------*/
	/*----------------------------------- CAMPO CLIENTE VACIO ----------------------------------------------------------------------------*/
	if (!$cliente){
	 
	    if (($inicio) && ($final)){
		$ban=0;  
		  $sql = "SELECT presupuestos.id_presupuestos,clientes.nombres,clientes.apellidos,presupuestos.fecha,presupuestos.monto
				FROM public.presupuestos,public.clientes
				WHERE presupuestos.id_clientes = clientes.id_clientes 
				AND presupuestos.fecha >= '$inicio' 
				AND presupuestos.fecha <= '$final';";
		  $consulta = pg_query($conexion,$sql); 
		     while ($row= pg_fetch_array ($consulta)){
			 $codigo=$row[id_presupuesto];
			 $fila.="<tr>"."<td width='150' class='ReportDetailsEvenDataRow'>"."<div align='center' class='titulo1'>"."<Input type = 'Radio' Name ='id_presupuesto' value= ".$row[id_presupuestos].">".$row[id_presupuestos]."</div></td>"."<td width='179' class='ReportDetailsEvenDataRow'>"."<div align='center' class='titulo1'>".$row[nombres]." ".$row[apellidos]."</div></td>"."<td width='125' class='ReportDetailsEvenDataRow'>"."<div align='center' class='titulo1'>".$row[fecha]."</div></td>"."<td width='128' class='ReportDetailsEvenDataRow'>"."<div align='center' class='titulo1'>".$row[monto]."</div></td>"."</div></td></tr>";
			 $objeto->addAssign("mensaje" ,"innerHTML", "Resultados de la busqueda");
			 $objeto->addAssign("tabla_lis", "innerHTML", $fila);
			 $ban++;
			 }
			 
		  if ($ban==0){
				 
			  $objeto->addClear("tabla_lis","innerHTML"," ");
		      $objeto->addClear("mensaje","innerHTML"," ");
	          $objeto->addAssign("mensaje" ,"innerHTML", "No se obtuvieron resultados");
	        }
		}
	    
		 if (($inicio) && (!$final)){
		  $sql = "SELECT presupuestos.id_presupuestos,clientes.nombres,clientes.apellidos,presupuestos.fecha,presupuestos.monto
				FROM public.presupuestos,public.clientes
				WHERE presupuestos.id_clientes = clientes.id_clientes 
				AND presupuestos.fecha = '$inicio'";
 	      $consulta = pg_query($conexion,$sql);
		   $ban=0;
		     
			
		        while ($row= pg_fetch_array ($consulta)){
				  $codigo=$row[id_presupuesto];
			      $fila.="<tr>"."<td width='150' class='ReportDetailsEvenDataRow'>"."<div align='center' class='titulo1'>"."<Input type = 'Radio' Name ='id_presupuesto' value= ".$row[id_presupuestos].">".$row[id_presupuestos]."</div></td>"."<td width='179' class='ReportDetailsEvenDataRow'>"."<div align='center' class='titulo1'>".$row[nombres]." ".$row[apellidos]."</div></td>"."<td width='125' class='ReportDetailsEvenDataRow'>"."<div align='center' class='titulo1'>".$row[fecha]."</div></td>"."<td width='128' class='ReportDetailsEvenDataRow'>"."<div align='center' class='titulo1'>".$row[monto]."</div></td>"."</div></td></tr>";
			      $objeto->addAssign("mensaje" ,"innerHTML", "Resultados de la busqueda");
			      $objeto->addAssign("tabla_lis", "innerHTML", $fila);
			      $ban++; 
		       
			    }
			
		     if ($ban==0){
				 
			  $objeto->addClear("tabla_lis","innerHTML"," ");
		      $objeto->addClear("mensaje","innerHTML"," ");
	          $objeto->addAssign("mensaje" ,"innerHTML", "No se obtuvieron resultados");
	        }   
	   } 
	    if ((!$inicio)&& ($final)){
		  $sql = "SELECT presupuestos.id_presupuestos,clientes.nombres,clientes.apellidos,presupuestos.fecha,presupuestos.monto
				FROM public.presupuestos,public.clientes
				WHERE presupuestos.id_clientes = clientes.id_clientes 
				AND presupuestos.fecha = '$final'";  
 	      $consulta = pg_query($conexion,$sql);
		   $ban=0;
		     
			
		        while ($row= pg_fetch_array ($consulta)){
				  $codigo=$row[id_presupuesto];
			      $fila.="<tr>"."<td width='150' class='ReportDetailsEvenDataRow'>"."<div align='center' class='titulo1'>"."<Input type = 'Radio' Name ='id_presupuesto' value= ".$row[id_presupuestos].">".$row[id_presupuestos]."</div></td>"."<td width='179' class='ReportDetailsEvenDataRow'>"."<div align='center' class='titulo1'>".$row[nombres]." ".$row[apellidos]."</div></td>"."<td width='125' class='ReportDetailsEvenDataRow'>"."<div align='center' class='titulo1'>".$row[fecha]."</div></td>"."<td width='128' class='ReportDetailsEvenDataRow'>"."<div align='center' class='titulo1'>".$row[monto]."</div></td>"."</div></td></tr>";
			      $objeto->addAssign("mensaje" ,"innerHTML", "Resultados de la busqueda");
			      $objeto->addAssign("tabla_lis", "innerHTML", $fila);
			      $ban++; 
		       
			    }
			
		     if ($ban==0){
				 
			  $objeto->addClear("tabla_lis","innerHTML"," ");
		      $objeto->addClear("mensaje","innerHTML"," ");
	          $objeto->addAssign("mensaje" ,"innerHTML", "No se obtuvieron resultados");
	        } 
		}
	
    }
	/* ----------------------------------------- FIN DE CAMPO CLIENTE VACIO -----------------------------------------------------------------------*/
      
		if ((!$cliente) && (!$inicio) && (!$final)) {
	      $objeto->addClear("tabla_lis","innerHTML"," ");
	      $objeto->addClear("mensaje","innerHTML"," ");
	      $objeto->addAssign("mensaje" ,"innerHTML", "No se obtuvieron resultados");
	
	    }
	
	  $objeto->addClear("inicio","innerHTML"," ");
	  $objeto->addClear("final","innerHTML"," ");
	 pg_close($conexion);
     return $objeto;	
	}
	/*--------------------------------------------------FIN DE LA FUNCTION LISTAR ----------------------------------------------------------------*/
		
$xajax = new xajax();
$xajax->registerFunction("buscar_cliente");
$xajax->registerFunction("buscar_items");
$xajax->registerFunction("anadirFila");
$xajax->registerFunction("agregarFila");
$xajax->registerFunction("eliminarFila");
$xajax->registerFunction("generar_tabla");
$xajax->registerFunction("actualizarCantidad");
$xajax->registerFunction("actualizarSubTotal");
$xajax->registerFunction("listar_presupuesto");
$xajax->processRequests();
?>