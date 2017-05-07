<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="../../css/styles.css" rel="stylesheet"	type="text/css" />
<style type="text/css">
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CaeSystem- Resumen de Garantias</title>
</head>
<h2 align="center" class="titulos"> Resumen de Garantias </h2>
<hr/>
<body>
  
<form name="form1" method="POST" action="resu_garantia.php">
 <h2 class="Estilo1">Resumen de Garantias</h2>
 <hr/>
  <table width="300" height="60" border="0" align="center">
   <tr>
       	<th width="30" class="negrita12" scope="col">Año:</th>
     	<th width="30" scope="col">
	        <select name="select_anio" size="1" id="select_anio">
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
		<th width="30" class="negrita12" scope="col">Estatus:</th>
     	<th width="30" scope="col">
			<select name="status" size="1" id="status">
			  <option>vencida </option>
			  <option>vigente</option>
			           			
                  </select></tr>
   <tr>
     <td colspan="6"><div align="center">
	   <input type="submit" name="enviar" id="enviar" value="Enviar" />
     </div></td>
    </tr>
 </table>
</form>
</body>
</html>
