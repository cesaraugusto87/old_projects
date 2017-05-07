<?php
 include('../../permisos.php');
 ?>
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>RESUMEN MENSUAL</title>
<link href="../../css/styles.css" rel="stylesheet" type="text/css" />
</head>

<body>
<form name="form1" method="post" action="resu_mes.php">
<h2 class="Estilo1">Resumen de Ventas Mensuales</h2>
<hr/>

 <div align="center">
<fieldset style="height:120px; width:210px; border: 2px solid #2E9AFE; -moz-border-radius: 15px; -webkit-border-radius: 15px;">
<legend class="titulo2 Estilo2 Estilo3">Ventas Mensuales</legend>
<p>
  <table width="321" height="63" border="0" align="center">
   <tr>
     <th width="27" class="negrita12" scope="col">Mes:</th>
     <th width="104" scope="col"> <select name="select_mes1" id="select_mes1">
            <option selected="selected">Enero</option>
            <option>Febrero</option>
            <option>Marzo</option>
            <option>Abril</option>
            <option>Mayo</option>
            <option>Junio</option>
            <option>Julio</option>
            <option>Agosto</option>
            <option>Septiembre</option>
            <option>Octubre</option>
            <option>Noviembre</option>
            <option>Diciembre</option>
          </select></th>
     <th width="25" class="negrita12" scope="col">Año:</th>
     <th width="82" scope="col">  <select name="select_anio2" id="select_anio2">
            <option> 2000 </option>
            <option> 2001 </option>
            <option> 2002 </option>
            <option> 2003 </option>
            <option> 2004 </option>
            <option> 2005 </option>
            <option> 2006 </option>
            <option> 2007 </option>
            <option> 2008 </option>
            <option> 2009 </option>
            <option> 2010 </option>
            <option> 2011 </option>
          </select></th>
   </tr>
   <tr>
     <td colspan="4"><div align="center">
       <input type="submit" name="button" id="button" value="Consultar" />
     </div></td>
    </tr>
 </table>
   </fieldset> 
   </div>
</form>
</body>
</html>
