<?php
include('../../conexion/conexion.php');

$tipo=$_GET['tipo'];
	
if ($tipo=="1"){
	$conn1= Conectarse();
	$resultado = pg_query($conn1, "SELECT p.nombres, p.apellidos, p.cedula, e.ficha FROM personal as p, empleados as e WHERE p.cedula = e.cedula and e.id_estado<>'02';");
	?>
<table width="70%"  border="1" align="center" style="font-size:12px"  >
<tr class="ReportTableHeaderCell" align="center">
<td width="12%" >Nombre</td>
<td width="12%" >Apellido</td>
<td width="10%" >Cedula</td>
<td width="10%" >Ficha</td>
<td width="10%" >Vacaciones</td>
</tr>

<?php
$par=0;
  for ($i=0;$i<pg_num_rows($resultado);$i++){
	          if ($par==0){
			 	$row = pg_fetch_row($resultado);
				echo "<tr bgcolor='#999999' align='center'>";
				echo "<td>".$row[0]."</td>";
				echo "<td>".$row[1]."</td>";
				echo "<td>".$row[2]."</td>";
				echo "<td>".$row[3]."</td>";
				echo "<td><input type='checkbox'  value='$row[3]' id='$i' onclick='apunta(this)'></td>";
				echo "</tr>";
                $par=1;
  			}else{
				$row = pg_fetch_row($resultado);
				echo "<tr bgcolor='#CCCCCC' align='center'>";
				echo "<td>".$row[0]."</td>";
				echo "<td>".$row[1]."</td>";
				echo "<td>".$row[2]."</td>";
				echo "<td>".$row[3]."</td>";
				echo "<td><input type='checkbox'  value='$row[3]' id='$i ' onclick='apunta(this)'></td>";
				echo "</tr>";
                $par=0;
				}//para el alternado
			}//final del for
	if ($i==0){//letrero de no encontre nada
	echo "<tr class='ReportDetailsOddDataRow' align='center'><td colspan='5'>No se encontraron registros.</td></tr>";
	} 
		
?>
</table>

<?php
}//final tipo 1
?>
<!-- separacion para no volverse loco-->
<?php
if ($tipo=="2"){
	$conn= Conectarse();
	$resultado1 = pg_query($conn, "SELECT p.nombres, p.apellidos, p.cedula, e.ficha FROM personal as p, empleados as e WHERE p.cedula = e.cedula and e.id_estado='02';");
	?>
    <table width="70%"  border="1" align="center" style="font-size:12px"  >
	<tr class="ReportTableHeaderCell" align="center">
	<td width="12%" >Nombre</td>
	<td width="12%" >Apellido</td>
	<td width="10%" >Cedula</td>
	<td width="10%" >Ficha</td>
	<td width="10%" >Vacaciones Ini</td>
    <td width="10%" >Vacaciones Fin</td>
	</tr>

<?php
	$par=0;
  for ($i=0;$i<pg_num_rows($resultado1);$i++){
	          if ($par==0){
			 	$row = pg_fetch_row($resultado1);
				echo "<tr bgcolor='#999999' align='center'>";
				echo "<td>".$row[0]."</td>";
				echo "<td>".$row[1]."</td>";
				echo "<td>".$row[2]."</td>";
				echo "<td>".$row[3]."</td>";
				$resultado3 = pg_query($conn,"SELECT  va.fecha_inicio, va.fecha_final FROM  vacaciones as va WHERE  va.id_ficha='".$row[3]."' order by va.fecha_inicio DESC;" );
				$row1 = pg_fetch_row($resultado3);
				echo "<td>".$row1[0]."</td>";
				echo "<td>".$row1[1]."</td>";
				echo "</tr>";
                $par=1;
  			}else{
				$row = pg_fetch_row($resultado1);
				echo "<tr bgcolor='#CCCCCC' align='center'>";
				echo "<td>".$row[0]."</td>";
				echo "<td>".$row[1]."</td>";
				echo "<td>".$row[2]."</td>";
				echo "<td>".$row[3]."</td>";
				$resultado4 = pg_query($conn,"SELECT  va.fecha_inicio, va.fecha_final FROM  vacaciones as va WHERE  va.id_ficha='".$row[3]."' order by va.fecha_inicio DESC;" );
				$row2 = pg_fetch_row($resultado4);
				echo "<td>".$row2[0]."</td>";
				echo "<td>".$row2[1]."</td>";
				echo "</tr>";
                $par=0;
				}
			}//final del for
	if ($i==0){//letrero de no encontre nada
	echo "<tr class='ReportDetailsOddDataRow' align='center'><td colspan='6'>No se encontraron registros.</td></tr>";
	} 
	?>
    </table>
	<?php
	}
?>
<!--tipo 3-->
<?php
if ($tipo=="3"){
	$conn= Conectarse();
	$resultado1 = pg_query($conn, "SELECT p.nombres, p.apellidos, p.cedula, e.ficha FROM personal as p, empleados as e WHERE p.cedula = e.cedula and e.id_estado='02';");
	?>
    <table width="70%"  border="1" align="center" style="font-size:12px">
	<tr class="ReportTableHeaderCell" align="center">
	<td width="12%" >Nombre</td>
	<td width="12%" >Apellido</td>
	<td width="10%" >Cedula</td>
	<td width="10%" >Ficha</td>
	<td width="10%" >Vacaciones Ini</td>
    <td width="10%" >Vacaciones Fin</td>
    <td width="10%" >Reincorporado</td>
 	</tr>
<?php
	$par=0;
  for ($i=0;$i<pg_num_rows($resultado1);$i++){
	          if ($par==0){
			 	$row = pg_fetch_row($resultado1);
				echo "<tr bgcolor='#999999' align='center'>";
				echo "<td>".$row[0]."</td>";
				echo "<td>".$row[1]."</td>";
				echo "<td>".$row[2]."</td>";
				echo "<td>".$row[3]."</td>";
				$resultado3 = pg_query($conn,"SELECT  va.fecha_inicio, va.fecha_final FROM  vacaciones as va WHERE  va.id_ficha='".$row[3]."' order by va.fecha_inicio DESC;" );
				$row1 = pg_fetch_row($resultado3);
				echo "<td>".$row1[0]."</td>";
				echo "<td>".$row1[1]."</td>";
				echo "<td><input type='checkbox'  value='$row[3]' id='$i ' onclick='apunta(this)'></td>";
				echo "</tr>";
                $par=1;
  			}else{
				$row = pg_fetch_row($resultado1);
				echo "<tr bgcolor='#CCCCCC' align='center'>";
				echo "<td>".$row[0]."</td>";
				echo "<td>".$row[1]."</td>";
				echo "<td>".$row[2]."</td>";
				echo "<td>".$row[3]."</td>";
				$resultado4 = pg_query($conn,"SELECT  va.fecha_inicio, va.fecha_final FROM  vacaciones as va WHERE  va.id_ficha='".$row[3]."' order by va.fecha_inicio DESC;" );
				$row2 = pg_fetch_row($resultado4);
				echo "<td>".$row2[0]."</td>";
				echo "<td>".$row2[1]."</td>";
				echo "<td><input type='checkbox'  value='$row[3]' id='$i ' onclick='apunta(this)'></td>";
				echo "</tr>";
                $par=0;
				}
			}//final del for
	if ($i==0){//letrero de no encontre nada
	echo "<tr class='ReportDetailsOddDataRow' align='center'><td colspan='7'>No se encontraron registros.</td></tr>";
	} 
	?>
    </table>
	<?php
	}
?>