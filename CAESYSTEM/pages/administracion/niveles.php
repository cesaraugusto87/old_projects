<?php include('../../permisos.php');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Administracion del Sistema</title>
<link href="../../css/styles.css" rel="stylesheet"	type="text/css" />
<style type="text/css">
</style>
<script type="text/javascript">
function eliminar(n){
	if(n==1) alert("El nivel fué eliminado");
	else alert("El nivel no fué eliminado");
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
<h2 class="Estilo1">Administrar Niveles</h2>
<hr/>
<br>
<br>
<form id="nivel" name="nivel" method="post">
  	<div align="center"><strong>Id nivel</strong>
	  <td width="50"><input type="text" name="id_nivel"/></td>
	<input type="image" src="../../images/Search.ico" name="Buscar" onClick="Clear_Frame()" value="Buscar"/>
    </div>
<br><br>
</form>
<table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="ReportDetails">
<tr valign="top">
<td width="600">
    <div id="ReportDetails">
    	<table width="600" border="1" align="center">
			<tr>
				<td width="104" align="center" class="ReportTableHeaderCell">Id Nivel</td>
                <td width="129" align="center" class="ReportTableHeaderCell">Descripción</td>
                <td width="129" align="center" class="ReportTableHeaderCell">Tipo</td>
				 <td colspan="2" align="center" class="ReportTableHeaderCell">Accion</td>
           	</tr>
<?php
$consulta= pg_query("select * from nivel");

if($_POST['Buscar']){
		$id_nivel= $_POST['id_nivel'];
		if($id_nivel || $consulta){
			
			if($id_nivel){
				$consulta= pg_query("select * from nivel where id_nivel='$id_nivel'");
			}else if($nombre){
				$consulta= pg_query("select * from nivel where id_nivel='$id_nivel'");
			}
		}
}
			if(pg_num_rows($consulta)!=0){
				while($datos=pg_fetch_array($consulta)){
?>
						<tr class="ReportDetailsEvenDataRow">
							<td  class="ReportTableValueCell"><?php printf($datos['id_nivel']);?></td>
                		    <td  class="ReportTableValueCell"><?php printf($datos['descripcion']);?></td>
                    	    <td  class="ReportTableValueCell"><?php printf($datos['tipo']);?></td>
                                            	
                            <td width="91" align="center" class="ReportTableHeaderCell">
                             <form id="modificar" name="modificar" method="post" action="modnivel.php">
                                <input type="hidden" name="id_nivel" value="<?php printf($datos['id_nivel']);?>"/>
                               <input type="image" src="../../images/modificar.png" name="Modificar" value="M"/>
                             </form>
                            
                            </td>
                            <td width="91" align="center" class="ReportTableHeaderCell"><form id="eliminar" name="eliminar" method="post">
                            	<input type="hidden" name="id_nivel" value="<?php printf($datos['id_nivel']);?>"/>
                              <input type="image" src="../../images/eliminar.JPG" name="Eliminar" value="E"/>
                            </form>&nbsp;</td>
                		</tr>
<?php
				}
		    }
			
	if($_POST['Eliminar']){
		$id= $_POST['id_nivel'];
		if($id){
			$elim= pg_query("select * from usuarios where id_nivel='$id'");
					if(pg_num_rows($elim)==0){
						$elim= pg_query("select * from sueldos where id_nivel='$id'");
						if(pg_num_rows($elim)==0){
							$elim= pg_query("select * from empleados where id_nivel='$id'");
							if(pg_num_rows($elim)==0){
								$eliminado=pg_query("delete from nivel where id_nivel='$id'");
								if(pg_affected_rows($eliminado)!= 0){
									echo"<script>eliminar(1)</script>";
								}
								else{
									echo"<script>eliminar(0)</script>";
							    }
					        }
					   		else{
					   			echo"<script>eliminar(0)</script>";
					   		}
						}
						else{
							echo"<script>eliminar(0)</script>";
						}
					}
					else{
						echo"<script>eliminar(0)</script>";
					}	
		}
		else{
			echo"<script>eliminar(0)</script>";
		}
	}

?>
</table></div></td>
	</tr></table></form>
</body>
</html>