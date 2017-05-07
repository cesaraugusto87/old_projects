<?php
include('../../permisos.php');
include('funciones.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>RESUMEN DIARIO</title>
<link href="../../css/styles.css" rel="stylesheet" type="text/css" />
</head>


<link type="text/css" rel="stylesheet" href="../../css/dhtmlgoodies_calendar.css?random=20051112" media="screen"></LINK>


<script src="../../js/date.js"></script>
  
<SCRIPT type="text/javascript" src="../../js/dhtmlgoodies_calendar.js?random=20060118"></script>
<style type="text/css">
</style>



<body>
<form name="form1" method="post" action="resp_dia.php">
<h2 class="Estilo1">Resumen de Ventas Diarias</h2>
<hr/>
<p>
 <table height="63" border="0" align="center">
   <tr>
     <th class="negrita12" scope="col">Indique una fecha:</th>
     <th   scope="col"><input name="theDate1" type="text" id="theDate1" value="<?php echo (fechaactual());?>" size="19"/>
      <img src="../../images/Calendar.gif" alt="calendario" width="16" height="16" onclick="displayCalendar(document.forms[0].theDate1,'dd/mm/yyyy',this)" /></th>
   </tr>
   <tr>
     <td colspan="2"> <div align="center">
       <input type="submit" name="anio" id="anio" value="Enviar" />
     </div></td>
    </tr>
 </table>

 <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
</form>
</body>
</html>
