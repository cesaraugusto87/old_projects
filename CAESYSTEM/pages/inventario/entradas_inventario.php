<?php
include('../../permisos.php');
include('funciones.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Modulo Inventario</title>
<link href="../../css/styles.css" rel="stylesheet"	type="text/css" />
<style type="text/css">
</style>


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
<?php 
include('../../conexion/conexion.php');?>
<body>
<?php 
$link = Conectarse();
$fecha_actual= date("d-m-Y");
?>

<form id="formDivisiones" name="formDivisiones" method="post">
<h2 class="Estilo1">Entradas a Inventario </h2>
<hr/>

<fieldset style="border: 2px solid #2E9AFE; -moz-border-radius: 15px; -webkit-border-radius: 15px;">
<legend class="titulo2 Estilo2 Estilo3">Entradas</legend>


<table width="626" height="121" border="0" align="center">
  <tr>
    <td colspan="3">&nbsp;</td>
    <td colspan="3">&nbsp;</td>
    </tr>
  <tr>
 <div align="center">
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
    <td colspan="6"><div align="center">
      <input type="submit" name="Consultar" onClick="Clear_Frame()" value="Consultar"/>
    </div></td>
	  </tr>
	</div>
</table>



 <!-- <div align="center"><strong class="letras"> Rengo de Fecha-Inicial: </strong><td width="50"><input type="text" border="5" name="fec_ini"/></td>
  <strong class="letras"> Rango de Fecha-Final: </strong>
  
<td width="50"><input type="text" border="5" name="fec_fin"/></td><input type="submit" name="Consultar" onClick="Clear_Frame()" value="Consultar" />
    </div>
<br><br>-->



<?php
 	if($_POST['Consultar']){
		$fecini= $_POST['theDate1'];
		$fecfin= $_POST['theDate2'];
		if(($fecini) && ($fecfin)){
			$items=pg_query("select items.id_items, items.nombre, items.descripcion, items.unidad, inventario.costo, consulta.cantidad from items, inventario, (select mercancia.id_items, count(mercancia.id_merca) as cantidad from mercancia where mercancia.fecha_entrada>= '$fecini' and mercancia.fecha_entrada<= '$fecfin' group by mercancia.id_items) as consulta where consulta.id_items=items.id_items and consulta.id_items=inventario.id_items");
			
			if(pg_num_rows($items)!=0){?>
	<table width="600" border="0" align="center">
	<tr valign="top">
    <td>
    <div id="ReportDetails">
    <table border="1" align="center" width="100%">
		<tr>
						<td width="30%" align="center" class="ReportTableHeaderCell">Nro. Item</td>
                    	<td width="29%" align="center" class="ReportTableHeaderCell">Nombre</td>
                    	<td width="21%" align="center" class="ReportTableHeaderCell">Unidad</td>
                    	<td width="20%" align="center" class="ReportTableHeaderCell">Descripcion</td>
        </tr>
          
                    <div align="center"></div>
	<?php
                    while($datos=pg_fetch_array($items)){
						$id_item=$datos['id_items'];
						$mercancia=pg_query("select mercancia.id_merca, mercancia.fecha_entrada, mercancia.serial, estado.descripcion from mercancia, estado where mercancia.id_items='$id_item' and mercancia.fecha_entrada>='$fecini' and mercancia.fecha_entrada<='$fecfin' and mercancia.id_estado= estado.id_estado");
						$cantidad= $datos['cantidad'];
						$total= $datos['costo'];
						$total= $total* $cantidad;
						$acumcant=$acumcant+$cantidad;
						$acumcost=$acumcost+$total;
			?>
			<table border="1" align="center" width="100%" >
						<tr class="tabla1">

							<td bgcolor="white"><div align="center"><?php printf($datos['id_items']);?></div></td>
                			<td bgcolor="white"> <div align="center"><?php printf($datos['nombre']);?></div></td>
                    		<td bgcolor="white"> <div align="center"><?php printf($datos['unidad']);?></div></td>
                    		<td bgcolor="white"> <div align="center"><?php printf($datos['descripcion']);?></div></td>
                		</tr>
						
			<?php if(pg_num_rows($mercancia)!=0){?>
								<tr>
                                	<td align="center" colspan="4" class="ReportTableHeaderCell">Mercancia</td>
                                </tr>
						<tr>
						<td width="58" class="ReportTableHeaderCell" scope="col"><div align="center">Nro. Mercancia</div></td>
                    	<td width="58" class="ReportTableHeaderCell" scope="col"><div align="center">Fecha Entrada</div></td>
                        <td width="72" class="ReportTableHeaderCell" scope="col"><div align="center">Serial<div></td>
                        <td width="55" class="ReportTableHeaderCell" scope="col"><div align="center">Estado</div></td>
						</tr>
			<?php
                    while($datos1=pg_fetch_array($mercancia)){
			?>
                    		<tr class="tabla1">					
							<td bgcolor="white"align="center"><?php printf($datos1['id_merca']);?></td>
                    		<td bgcolor="white"align="center"><?php printf($datos1['fecha_entrada']);?></td>
                    		<td bgcolor="white"align="center"><?php printf($datos1['serial']);?></td>
							<td bgcolor="white"align="center"><?php printf($datos1['descripcion']);?></td>
                		</tr>
					<?php
							}
					}
					?>
					 <tr class="tabla1">
                    	<td align="right"colspan="2" bgcolor="#DFDFDF"> Total Cantidad: <?php printf($cantidad);?></td>
                        <td align="right" colspan="2" bgcolor="#DFDFDF"> Total Costo (Bs.F): <?php printf($total);?></td>
                    </tr>
					
 <?php
					}
		?>
				<tr class="tabla">
                	<td align="right"colspan="2" class="ReportTableHeaderCell"> Total Cantidad: <?php printf($acumcant);?></td>
                    <td align="right" colspan="2" class="ReportTableHeaderCell"> Total Costo (Bs.F): <?php printf($acumcost);?></td>
                </tr>
 			</table>
<?php

			}
		}else{
		}
		
	}
 ?>	
	 </table>

	</table></div></label></td>
	</tr></table>
  </fieldset>
    </form>

</body>
</html>