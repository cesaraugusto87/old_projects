<?php include ('../../conexion/conexion.php');
include('../../permisos.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="../../css/styles.css" rel="stylesheet"	type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

</head>
<body>
<form action="libreria_resumen.php" method="get" >
 <h2 class="Estilo1">Resumen Nomina</h2>
 <hr/>
 <div align="center">
<fieldset style="height:120px; width:480px; border: 2px solid #2E9AFE; -moz-border-radius: 15px; -webkit-border-radius: 15px;">
<legend class="titulo2 Estilo2 Estilo3">Resumen Nomina</legend>
  <table width="321" height="63" border="0" align="center">
   <tr>
     <th width="27" class="negrita12" scope="col">Mes:</th>
     <th width="104" scope="col"><select name="mes" size="1" id="mes">
       <option value="01">Enero</option>
       <option value="02">Febrero</option>
       <option value="03">Marzo</option>
       <option value="04">Abril</option>
       <option value="05">Mayo</option>
       <option value="06">Junio</option>
       <option value="07">Julio</option>
       <option value="08">Agosto</option>
       <option value="09">Septiembre</option>
       <option value="10">Octubre</option>
       <option value="11">Noviembre</option>
       <option value="12">Diciembre</option>
     </select></th>
     <th width="25" class="negrita12" scope="col">Año:</th>
     <th width="82" scope="col"><select name="ayo" size="1" id="ayo">
       <option value="2009">2009</option>
       <option value="2010">2010</option>
       <option value="2011">2011</option>
     </select></th>
   </tr>
   <tr>
     <td colspan="4"><div align="center">
       <input type="submit" name="consultar" id="consultar" value="Consultar" />
     </div></td>
    </tr>
 </table>
 </fieldset>
</div>
</form>
</body>
</html>
