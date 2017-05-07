<?php
include('../../permisos.php');
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Formulario modelo</title>
<link href="../../css/styles.css" rel="stylesheet"	type="text/css" />
<style type="text/css">
</style>
</head>

<body>
<form id="formDivisiones" name="formDivisiones" method="post">
<h2 class="Estilo1">Agregar Usuario</h2>
<hr/>
<table width="600" height="300" border="1" align="center" cellpadding="0" cellspacing="0" class="ReportDetails">
   <tr>
    <td height="250">
    <div id="ReportDetails">
      <table width="341" height="195" border="0" align="center">
        <tr>
          <td width="167" class="ReportDetailsEvenDataRow">Nombres: </td>
          <td width="164"><label> </label>
              
                <div align="left">
                  <input type="text" name="campo" id="campo" />
              </div></td>
        </tr>
        <tr>
          <td class="ReportDetailsOddDataRow">Apellidos:</td>
          <td>
              <div align="left">
                <input type="text" name="campo2" id="campo2" />
              </div></td>
        </tr>
        <tr>
          <td class="ReportDetailsEvenDataRow">C.I:</td>
          <td>
              <div align="left">
                <input type="text" name="campo3" id="campo3" />
              </div></td>
        </tr>
        <tr>
          <td class="ReportDetailsOddDataRow">Fecha de Nacimiento:</td>
          <td>
              <div align="left">
                <input type="text" name="campo4" id="campo4"/>
             </div></td>
        </tr>
        <tr>
          <td class="ReportDetailsEvenDataRow">Telefono:</td>
          <td>
              <div align="left">
                <input type="text" name="campo5" id="campo5" />
              </div></td>
        </tr>
        <tr>
          <td class="ReportDetailsOddDataRow">Dirección:</td>
          <td>
              <div align="left">
                <input type="text" name="campo6" id="campo6" />
              </div></td>
        </tr>
      </table>
      <p>
        <label>
        <div align="center">
          <div align="center">
            <input type="submit" name="enviar" id="enviar" value="Enviar" />
        </div>
      </label></td>
  </tr>
</table>
</form>
</body>
</html>
