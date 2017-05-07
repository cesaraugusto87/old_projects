<?php
include('../../permisos.php');
include('funciones.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Listado Nomina por fechas</title>

<link type="text/css" rel="stylesheet" href="../../css/dhtmlgoodies_calendar.css?random=20051112" media="screen"></LINK>

<link href="../../css/styles.css" rel="stylesheet"	type="text/css" />
<script src="../../js/date.js"></script>
  
<SCRIPT type="text/javascript" src="../../js/dhtmlgoodies_calendar.js?random=20060118"></script>

<style type="text/css">
</style>


<script language="JavaScript" type="text/JavaScript"> 
function enviar()
{
		var fecha1=(String(document.getElementById("theDate1").value));
		var fecha2=(String(document.getElementById("theDate2").value));
		if (fecha1==null || fecha2==null || fecha1=="" || fecha2=="")
		{
			alert("Error:: Campos vacios");
			return false;
		}
		else
		{
			if ((compareDates(fecha1,"dd/MM/yyyy",fecha2,"dd/MM/yyyy"))==0)
				document.formDemo.submit();
			else
			{
				alert("Error::rango de fechas invalido");
				return false;
			}
		}
}

</script>


</head>
<body>
<form id="formDemo" name="formDemo" method="get" onsubmit="return enviar();" action="rpta_porfecha.php">
<h2 class="Estilo1">Listado de Nomina</h2>
<hr/>
<fieldset style="border: 2px solid #2E9AFE; -moz-border-radius: 15px; -webkit-border-radius: 15px;">
<legend class="titulo2 Estilo2 Estilo3">Listado de Nomina</legend>

<table width="626" height="121" border="0" align="center">
  <tr>
    <td colspan="3">&nbsp;</td>
    <td colspan="3">&nbsp;</td>
    </tr>
  <tr>
    <td width="85" height="43"><strong class="negrita12">Fecha inicio:</strong></td>
    <td width="142">
    <div align="left"><input name="theDate1" type="text" id="theDate1" value="<?php echo (fechaactual());?>" size="15"/>
      <img src="../../images/Calendar.gif" alt="calendario" width="16" height="16" onclick="displayCalendar(document.forms[0].theDate1,'dd/mm/yyyy',this)" /></div></td>
    <td width="82"><span class="campoR">(dd/mm/aaaa)</span></td>
    <td width="69"><strong class="negrita12">Fecha fin:</strong></td>
<td width="145"><div align="left">
  <input name="theDate2" type="text" id="theDate2" value="<?php echo (fechaactual());?>" size="15" />
  <img src="../../images/Calendar.gif" alt="calendario" width="16" height="16" onclick="displayCalendar(document.forms[0].theDate2,'dd/mm/yyyy',this)" /></div></td>
    <td width="77" valign="middle"><span class="campoR">(dd/mm/aaaa)</span></td>
  </tr>
  <tr>
    <td class="negrita12">Estado</td>
    <td><label>
      <select name="estado_empleado" id="estado_empleado">
        <option value="01" selected="selected">Activos</option>
        <option value="02">Vacaciones</option>
        <option value="03">Todos</option>
      </select>
    </label></td>
    <td>&nbsp;</td>
    <td colspan="3">&nbsp;</td>
    </tr>
  <tr>
    <td colspan="6"><div align="center">
      <input name="button" type="submit" id="button" value="Consultar"/>
    </div></td>
  </tr>
</table>
</fieldset>
</form>
</body>
</html>