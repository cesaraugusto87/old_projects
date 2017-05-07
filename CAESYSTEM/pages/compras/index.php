<?php
session_start();
?>
<?php include ("funciones.php");?>
<html>
	<head>
		<title>ORDENES</title>
		<link type="text/css" rel="stylesheet" href="../../css/dhtmlgoodies_calendar.css?random=20051112" media="screen"></LINK>

<link href="../../css/styles.css" rel="stylesheet"	type="text/css" />
<script src="../../js/date.js"></script>
  
<SCRIPT type="text/javascript" src="../../js/dhtmlgoodies_calendar.js?random=20060118"></script>

		
		
		<link href="../../css/styles.css" rel="stylesheet"	type="text/css" />
		<link href="calendario/calendar-blue.css" rel="stylesheet" type="text/css"><!--todo esto es para el calendario-->
		<script type="text/JavaScript" language="javascript" src="calendario/calendar.js"></script><!--todo esto es para el calendario-->
		<script type="text/JavaScript" language="javascript" src="calendario/lang/calendar-sp.js"></script><!--todo esto es para el calendario-->
		<script type="text/JavaScript" language="javascript" src="calendario/calendar-setup.js"></script><!--todo esto es para el calendario-->
		
		
	</head>
	
	<body>
					  <p class="Estilo1">Buscador Orden de Compra</p>
  <hr />

<form action="rejilla.php" method="GET" name="form_busqueda"  class="" id="form_busqueda" ><!--todo es enviado a la pagina rejilla por URL-->
				  <table width="480" border="0" align="center" cellpadding="0" cellspacing="0" class="ReportDetails">
                    <tr valign="top">
                      <td>
					  
					  <div id="ReportDetails">
                          <table width="480" border="1" align="center" class="ReportDetails">
                            <tr>
                              <td width="24%" class="ReportTableHeaderCell"><div align="left">Codigo de proveedor </div></td>
                              <td width="60%" class="ReportDetailsOddDataRow"><input id="id_proveedores" type="text"  name="id_proveedores" maxlength="10" value="<? echo $id_proveedores?>">                              </td>
                            </tr>
                            <tr>
                              <td class="ReportTableHeaderCell"><div align="left">Num. Orden </div></td>
                              <td class="ReportDetailsEvenDataRow"><input id="id_orden" type="text" name="id_orden" maxlength="15" value="<? echo $id_orden?>"></td>
                            </tr>
                            <tr>
                              <td class="ReportTableHeaderCell"><div align="left">Estatus</div></td>
                              <td class="ReportDetailsOddDataRow"><select id="cboEstatus" name="cboEstatus" >
                                  <option value="0" selected>Todos los estatus</option>
                                  <option value="despacho">Sin Despachar</option>
                                  <option value="sindespachar">Despachadas</option>
                              </select></td>
                            </tr>
                            <tr>
                              <td class="ReportTableHeaderCell"><div align="left">Fecha de  Pedido</div></td>
                              <td class="ReportDetailsEvenDataRow">
                                <input name="fechainicio" type="text"  id="fechainicio" value="<?/* php echo(fechaactual()); */ ?>" size="20" readonly>
                                  <img src="../../images/Calendar.gif" alt="calendario" width="16" height="16" onClick="displayCalendar(document.forms[0].fechainicio,'dd/mm/yyyy',this)" />                                                       </tr>
                            <tr>
                              <td class="ReportTableHeaderCell"><div align="left">Fecha de Entrega o Despacho</div></td>
                              <td class="ReportDetailsOddDataRow"><input id="fechafin" type="text"  name="fechafin"  value="" size="20" readonly>
                                  <img src="../../images/Calendar.gif" alt="calendario" width="16" height="16" onClick="displayCalendar(document.forms[0].fechafin,'dd/mm/yyyy',this)" />                           </td> 
                                 <tr>               
                                                <p>
                                                <td colspan="2" class="ReportDetailsEvenDataRow" >  <div align="center">
                                                  <input name="Buscar" type="submit" class="button" value="Buscar" />  
                                                  <input name="reset" type="reset" class="button" value="Borrar">
                                   </div></td>
                            </tr>
                        </table>
						</div>
					  </td>
                    </tr>
			      </table>
                </form>

			 	
    </body>
</html>
