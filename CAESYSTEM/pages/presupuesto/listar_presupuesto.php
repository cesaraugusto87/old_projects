<?php 
 include('../../permisos.php');
 include('funciones.php');
 include('xajax/xajax.php');
 include('control_nuevo_presupuesto.php'); // Aquí es donde esta la función xajax
 $xajax->printJavascript('xajax');
 ?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link href="../../../css/styles.css" rel="stylesheet" type="text/css" />
<link href="../../../css/calendar-brown.css" rel="StyleSheet" type="text/css">
<link type="text/css" rel="stylesheet" href="../../css/dhtmlgoodies_calendar.css?random=20051112" media="screen"></LINK>

<link href="../../css/styles.css" rel="stylesheet"	type="text/css" />
<script src="../../js/date.js"></script>
  
<SCRIPT type="text/javascript" src="../../js/dhtmlgoodies_calendar.js?random=20060118"></script>
<p class="Estilo1">Lista De Presupuestos</p>
<form id="formDivisiones" name="formListar" method="post" action="post_listarPresupuesto.php">
  <input type="hidden" id="id_presupuesto" name="id_presupuesto" value="0" />
  <hr/>
  <table height="300" border="1" align="center" cellpadding="0" cellspacing="0" class="ReportDetails">
    <tr>
      <td height="250">
      <div id="ReportDetails">
        <table width="502" height="70" border="0" align="center" class="ReportDetails">
          <tr align="center" valign="middle">
            <td width="144" height="21" class="ReportTableHeaderCell"><div align="center">Cliente </div></td>
            <td width="173" align="center" valign="middle" class="ReportTableHeaderCell"><label> </label>
              <div align="center">Fecha 1</div></td>
		    <td width="171" align="center" valign="middle" class="ReportTableHeaderCell"><label> </label>
              <div align="center">Fecha 2</div></td>
          </tr>
          <tr>
            <td align="center" valign="middle" class="ReportDetailsEvenDataRow"><input type="text" name="cliente" id="cliente" /></td>
            <td align="center" valign="middle" class="ReportDetailsEvenDataRow">
              <input type="text" name="inicio" id="inicio"/><img src="../../images/Calendar.gif" alt="calendario" width="16" height="16" onclick="displayCalendar(document.forms[0].inicio,'dd/mm/yyyy',this)" /></td>
			  <td width="171" height="43" align="center" valign="middle" class="ReportDetailsEvenDataRow">
              <input type="text" name="final" id="final" />
              <img src="../../images/Calendar.gif" alt="calendario" width="16" height="16" onclick="displayCalendar(document.forms[0].final,'dd/mm/yyyy',this)" /></td>
          </tr>
          <br />
		  <tr>
           <td colspan="3" align="center" valign="middle" class="ReportDetailsEvenDataRow">
		  <input type="button"  name="enviar" id="enviar" onclick="xajax_listar_presupuesto(document.formListar.cliente.value,document.formListar.inicio.value,document.formListar.final.value);"  value="Buscar" /></td>
		 </tr>
	    </table>
		  
        <p align="center" id="mensaje" class="tituloTabla"></p>
        <div align="center">
          <div align="center">
            <table  width="600" border="0" id="detallePresupuesto" class="ReportDetails">
              <tr>
                <td width="200" class="ReportTableHeaderCell"><div align="center">Nro. presupuesto</div></td>
                <td width="300" class="ReportTableHeaderCell"><div align="center">cliente</div></td>
                <td width="200" class="ReportTableHeaderCell"><div align="center">fecha</div></td>
                <td width="200" class="ReportTableHeaderCell"><div align="center">Monto</div></td>
              </tr>
              
              
              <tbody id="tbDetallePresupuesto"></tbody>
              </table>
          </div>
		  <div align="center">
          <table  width="600" border="0" id="tabla_lis" class="ReportDetails">
		  </table>
		  </div>
		   <div align="center">	 
		   
		     <p align="left" id="mensaje_id" class="tituloTabla"></p>
		
	        <table  width="600" border="0" id="tabla_muestra" class="ReportDetails">
	        </table>
        </div>	 
		<div align="center" id="a">		</div>	  
      
        <div align="center">
          <input type="submit" name="enviar2" id="enviar2" value="Ver" />
        </div>
      </table>
</form>	


