<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php 
	 //include('consulta/conexion.php');
	 include('../../conexion/conexion.php');
	 $conn= Conectarse();				 
     $query="select p.nombres, p.apellidos, e.ficha,a.fecha from personal p, empleados e, prestamos a  
where a.id_ficha = e.ficha and e.cedula= p.cedula and a.id_estado= '04'";
				$result=pg_query($conn,$query);
				if(!$result)
					echo"No se Encontraron registros...\;";
				else{		
					echo"<div align=\"center\">";
					echo"\n<table  border=\"1\" cellpadding=\"2\" cellspacing=\"0\">";
					echo"\n<tr>";
					echo"\n <td align=>Nombre<font></td>
		 				<td align=>Apellido</td>
		        		<td align=>Ficha</td> 
						<td align=>Fecha de Solicitud</td>";	
					echo"\n</tr>";
					
					$var=pg_fetch_array($result);
		
					$nombre=$var[0];
					$apellido=$var[1];
					$Ficha = $var[2];
					$Fecha_solicitud = date("d,m,y");
					echo"\n<tr>";
					echo"\n<td width=\"100\"align=<font>$nombre</font></td>
			       		<td width=\"150\"align=<font>$apellido</font></td>
				   		<td width=\"150\"align=<font>$Ficha</font></td>
						<td width=\"150\"align=<font>$Fecha_solicitud</font></td>";
					echo"\n</tr>";	
					}
                    
	?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Prestamos</title></head>
<body>
<div align="center"><strong>Buscar Empleados</strong></div>
<form id="form1" name="form1" method="post" action="aprobado.php">
	
  <p align="left">
    <label>
    <div align="center">
    Ficha del empleado a aprobar
    <input name="ficha" type="text" id="ficha" value=""/>
    </div>
  </label>
    <p align="center">
      <label>
      <input type="submit" name="Consultar" id="Consultar" value="consultar" />
      </label> 
  </p>
  <p>&nbsp;</p>
    <p>&nbsp;</p>
</form>
<p>&nbsp;</p>
</body>
</html>
