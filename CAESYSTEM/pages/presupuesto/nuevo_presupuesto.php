<?
 include('../../permisos.php');
 
 //include('../../conexion/conexion.php');
 include('xajax/xajax.php');
 include('control_nuevo_presupuesto.php'); // Aquí es donde esta la función xajax
 $xajax->printJavascript('xajax');
// $conexion = Conectarse();
 ?>
 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Nuevo Presupuesto</title>
<link href="../../css/styles.css" rel="stylesheet" type="text/css" />
</head>

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
	function Valida(form){
	/*if document.getElementById('cliente').value.length == " "){
		alert('Ingrese la C.I/RiF del Cliente');
		return false;
	}*/
 if (form.cliente.value.length == " ") {
    alert('Ingrese la C.I/RiF del Cliente');
    form.cliente.focus();
    return (false);
  }
 mostrarOrdenado();
form.submit();
}
</script>

<body>

<p class="Estilo1">Nuevo Presupuesto</p>

<form action="post_nuevoPresupuesto.php" method=post name=formDivisiones>
<input type="hidden" id="num_campos" name="num_campos" value="0" />
<input type="hidden" id="cant_campos" name="cant_campos" value="0" />
<input type="hidden" id="codigo_i" name="codigo_i" value="0" />
<input type="hidden" id="descripcion_i" name="descripcion_i" value="0" />
<input type="hidden" id="precio_i" name="precio_i" value="0" />
<input type="hidden" id="cantidad_i" name="cantidad_i" value="0" />
<input name="tablaitems" type="hidden"/>
<input name="SubTotal_Tabla" id="SubTotal_Tabla" type="hidden" value="0"/>

  <hr/>
  <table width="600" height="300" border="1" align="center" cellpadding="0" cellspacing="0" class="ReportDetails">
    <tr>
      <td width="596" height="250"><div id="ReportDetails">
        <table width="206" height="70" border="0" align="center">
          <tr align="center" valign="middle">
            <td width="200" height="21" align="center" valign="middle" class="ReportTableHeaderCell"><label> </label>
              <div align="center">Fecha</div></td>
          </tr>
          <tr>
            <td width="200" height="43" align="center" valign="middle" class="ReportDetailsEvenDataRow">              <input type="text" name="Fecha" id="Fecha" readonly value= <?php echo date(d.'/'.m.'/'.Y);?>>            </td>
          </tr>
        </table>
        <p align="center" class="tituloTabla">Datos del Cliente </p>
          <table width="500" border="0" align="center">
            <tr>
              <td width="164" class="ReportTableHeaderCell"><div align="center">C.I. / RiF </div></td>
              <td width="276" class="ReportDetailsEvenDataRow"><label> </label>
                <div align="center">
                  <input type="text" name="cliente" id="cliente" onkeyup="xajax_buscar_cliente(this.value);" onBlur="xajax_buscar_cliente(this.value);"/>
              </div></td>
            </tr>
            <tr>
              <td class="ReportTableHeaderCell"><div align="center">Raz&oacute;n Social </div></td>
              <td class="ReportDetailsOddDataRow"><div align="center"><span class="ReportDetailsEvenDataRow">
                <input type="text" name="razon" id="razon" />
              </span></div></td>
            </tr>
        </table>
        <p>
          <label>
          <div align="center">
          <p align="center" class="tituloTabla">A&ntilde;adir Items</p>
          <table width="500" border="0" align="center">
            <tr>
              <td width="150" class="ReportTableHeaderCell"><div align="center">Busqueda</div></td>
			  <td class="ReportTableHeaderCell"><div align="center">Nombre</div></td>
            </tr>
            <tr class="ReportDetailsEvenDataRow">
              <td width="150"><div align="center">
                <label>
                <input type="text" name="text" onkeyup="xajax_buscar_items(this.value);" />         
                </label>
              </div></td>
			  <td id = "Nombre"><div align="center">
                <label>
                <select name="select2" id="combo" Onchange="xajax_generar_tabla(this.value,'formDivisiones');" OnFocus="xajax_generar_tabla(this.value,'formDivisiones');">
                </select>
                </label>
              </div></td>
            </tr>
			
        </table>
		  <div align="center" id="marcos" class="titulo1">
			
		</div>
          <br />
		  
          <table width="500" border="0""align="center">
            <tr>
              <td width="100" id="Codigo" class="ReportTableHeaderCell"><div align="center">Codigo</div></td>
			  <td width="300" id="Descripcion" class="ReportTableHeaderCell"><div align="center">Descripcion</div></td>
			  <td width="300" id="Unitario" class="ReportTableHeaderCell"><div align="center">P.Unitario</div></td>
			  <td width="120" id="Cantidad"class="ReportTableHeaderCell"><div align="center">Cantidad</div></td>
			  <td width="50" class="ReportTableHeaderCell"><div align="center">-</div></td>
            </tr>
            <tr>
              <td width="100" class="ReportDetailsEvenDataRow" id="Codigo_i">&nbsp;</td>
              <td id="Descripcion_i" class="ReportDetailsEvenDataRow">&nbsp;</td>
              <td id="Unitario_i" class="ReportDetailsEvenDataRow">&nbsp;</td>
              <td width="120"class="ReportDetailsEvenDataRow" id="Cantidad_i">&nbsp;</td>
              <td width="50" class="ReportDetailsEvenDataRow" id="botonAnadir">&nbsp;</td>
            </tr>
			<tbody id="bodyTabla"></tbody>
          </table>
		  <table id="tabla5" width="450" border="0""align="center">
		  </table>
          <p align="center" class="tituloTabla">Detalle Items </p>
        <div align="center">
          <table  width="600" border="0" id="tablaItems" class="ReportDetails">
              <tr>
                <td width="85" class="ReportTableHeaderCell"><div align="center">Codigo</div></td>
                <td width="155" class="ReportTableHeaderCell"><div align="center">Descripcion</div></td>
                <td width="100" class="ReportTableHeaderCell"><div align="center">P.Unitario</div></td>
                <td width="50" class="ReportTableHeaderCell"><div align="center">Cantidad</div></td>
                <td width="100" class="ReportTableHeaderCell"><div align="center">Sub-Total</div></td>
                <td width="20" class="ReportTableHeaderCell"><div align="center">-</div></td>
              </tr>
              
			<tbody id="tbDetalle"></tbody>
          </table>           
            <div align="right"><br />
            </div>
            <table width="260" border="0" align="right">
              <tr>
                <td width="105" class="ReportTableHeaderCell"><div align="center">Sub - Total </div></td>
                <td id="SubTotal" width="135" class="ReportDetailsEvenDataRow"><div id="Sub_Div "align="center" class="titulo1">
                  <input type="text" name="campo2222" id="Sub_Total" readonly="readonly"/>
                </div></td>
              </tr>
              <tr>
                <td class="ReportTableHeaderCell"><div align="center">IVA (12%) </div></td>
                <td class="ReportTableHeaderCell"><div id="Sub_Div "align="center">
                  <input type="text" name="campo2222" id="IVA" readonly="readonly"/>
                </div></td>
              </tr>
              <tr>
                <td class="ReportTableHeaderCell"><div align="center">Total</div></td>
                <td class="ReportDetailsEvenDataRow"><div id="Sub_Div "align="center" class="titulo1">
                  <input type="text" name="Total" id="Total" readonly="readonly"/>
                </div></td>
              </tr>
            </table>
            <p>&nbsp;            </p>
            <p>&nbsp;</p>
        </div>
      </label>
      <div align="center">
        <input type="button" value="Confirmar" onclick="Valida(this.form)"/>
      </div></td>
    </tr>
  </table>
  
</form>
<p class="Estilo1">&nbsp;</p>
</body>
</html>
