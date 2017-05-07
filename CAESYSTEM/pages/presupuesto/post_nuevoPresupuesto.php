<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Nuevo Presupuesto</title>
<link href="../../css/styles.css" rel="stylesheet" type="text/css" />
</head>
<script type="text/javascript">
	function redireccionar(){
		document.location.href="nuevo_presupuesto.php"; 
	}
</script>
<?php 
	include('../../conexion/conexion.php');
?>
<body>
	<?php
		$link = Conectarse();
		//Conectado a la BD
		$id_presupuesto = 0;
		$Codigo_Cliente = $_POST['cliente'];
		$Fecha = $_POST['Fecha'];
		$Monto = $_POST['Total'];
		$estado = 0;
		$query = "SELECT clientes.id_clientes
				FROM clientes
				WHERE clientes.rif = '$Codigo_Cliente'";
		$resultado = pg_exec($link,$query);
		$Codigo_Cliente = pg_result($resultado,$i,0);
		while(!$estado){
			$query = "SELECT max(id_presupuestos)FROM presupuestos;";
			if ($resultado = pg_exec($link,$query)){
				$filas = pg_NumRows($resultado);
				for ($i=0; $i < $filas; $i++) {
					$campo1=pg_result($resultado,$i,0);
					$id_presupuesto = $campo1+1;
				}
			}
			$query = "INSERT INTO presupuestos(id_presupuestos,id_clientes, fecha, monto) VALUES ($id_presupuesto,$Codigo_Cliente, '$Fecha', $Monto)";
			if (pg_exec($link,$query)){
				$estado = 1;
			}
		}		

		$Tabla = $_POST['tablaitems'];
		$tok = strtok($Tabla, ",");
		$i=0;
		if ($estado){
			while ($tok !== false) {
				$i++;
				$id_item = $tok;
				$tok = strtok(",");
				$precio = $tok;
				$tok = strtok(",");
				$cantidad = $tok;
				$tok = strtok(",");
				$query = "SELECT mercancia.id_merca 
				FROM public.mercancia
				WHERE mercancia.id_items = '$id_item'";
				if ($resultado = pg_exec($link,$query)){
					$id_item=pg_result($resultado,0,0);
				}
				$query = "INSERT INTO presupuestos_detalles(id_presupuesto, id_detalle_presupuesto, id_merca, cantidad, id_precio) VALUES ($id_presupuesto, $i, $id_item, $cantidad,$precio);";
				if (pg_exec($link,$query)){
					//echo "Detalle Presupuesto!!!<br><br>";
				}
				else{
					$estado = 0;
				}
			}
		}
		
		if ($estado){
			mostrarMensaje("Presupuesto Registrado Satisfactoriamente");
		}
		else{
			mostrarMensaje("Error Al Crear el Presupuesto");
			//Borrar de la tabla presupuesto;
		}
		pg_close($link);	

		function mostrarMensaje($mensaje){
			print "<table width='600' height='300' border='0' align='center' cellpadding='0' cellspacing='0' class='ReportDetails'>";
			print "<tr>";
			print "<td width='596' height='250'><div id='ReportDetails'>";
			print "<p>&nbsp;</p>";
			print "<p>&nbsp;</p>";
			print "<table width='400' height='25' border='0' align='center'>";
			print "<tr align='center' valign='middle'>";
			print "<td height='21' class='ReportDetailsEvenDataRow'><div align='center'>";
			print "<p>$mensaje</p>";
			print "<p>";
			print "<input type='submit' name='Submit' value='Aceptar' onclick='redireccionar()'/>";
			print "</p>";
			print "</div>            </td>";
			print "</tr>";
			print "</table>";
			print "<p>&nbsp;</p>";
			print "<p>&nbsp;</p></td>";
			print "</tr>";
			print "</table>";
		}
	?>
</body>
</html>