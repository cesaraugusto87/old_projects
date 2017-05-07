<?php
include('../../permisos.php');
?>
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
	if(n==1) alert("El item fué eliminado");
	else alert("El item no fué eliminado");
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
<h2><h2 class="Estilo1">Administrar Items</h2>
<hr/>
<br>
<br>
<form id="item" name="item" method="post">
  	<div align="center"><strong>Id Item</strong>
	  <td width="50"><input type="text" name="id_items"/></td>
	<input type="image" src="../../images/Search.ico" name="Buscar" onClick="Clear_Frame()" value="Buscar"/>
    </div>
<br><br>
</form>
<table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="ReportDetails">
<tr valign="top">
<td>
    <div id="ReportDetails">
    	<table width="560" border="1" align="center">
			<tr>
				<td width="62" align="center" class="ReportTableHeaderCell">Id Item</td>
                <td width="91" align="center" class="ReportTableHeaderCell">Id de Categoria de Item</td>
                <td width="84" align="center" class="ReportTableHeaderCell">Nombre</td>
                <td width="96" align="center" class="ReportTableHeaderCell">Descripción</td>
                <td width="81" align="center" class="ReportTableHeaderCell">Unidad</td>
				<td colspan="2" align="center" class="ReportTableHeaderCell">Accion</td>

           	</tr>
<?php
$consulta= pg_query("select * from items");

if($_POST['Buscar']){
		$id_items= $_POST['id_items'];
		if($id_items || $consulta){
			
			if($id_items){
				$consulta= pg_query("select * from items where id_items='$id_items'");
			}else if($nombre){
				$consulta= pg_query("select * from items where id_items='$id_items'");
			}
		}
}
			if(pg_num_rows($consulta)!=0){
				while($datos=pg_fetch_array($consulta)){
?>
						<tr class="ReportDetailsEvenDataRow">
							<td  class="ReportTableValueCell"><?php printf($datos['id_items']);?></td>
                			<td  class="ReportTableValueCell"><?php printf($datos['id_categoria_items']);?></td>
                    		<td  class="ReportTableValueCell"><?php printf($datos['nombre']);?></td>
                            <td  class="ReportTableValueCell"><?php printf($datos['descripcion']);?></td>
                    	     <td  class="ReportTableValueCell"><?php printf($datos['unidad']);?></td>
							 
                                            	
                            <td width="58" align="center" class="ReportTableHeaderCell">
                             <form id="modificar" name="modificar" method="post" action="moditem.php">
                                <input type="hidden" name="id_items" value="<?php printf($datos['id_items']);?>"/>
                               <input type="image" src="../../images/modificar.png" name="Modificar" value="M"/>
                             </form>
                            
                          </td>
                            <td width="42" align="center" class="ReportTableHeaderCell"><form id="eliminar" name="eliminar" method="post">
                            	<input type="hidden" name="id_items" value="<?php printf($datos['id_items']);?>"/>
                              <input type="image" src="../../images/eliminar.JPG" name="Eliminar" value="E"/>
                          </form>&nbsp;</td>
                		</tr>
<?php
				}
		    }
			
	if($_POST['Eliminar']){
		$id= $_POST['id_items'];
		if($id){
			$elim= pg_query("select * from inventario where id_items='$id'");
					if(pg_num_rows($elim)==0){
						$elim= pg_query("select * from mercancia where id_items='$id'");
						if(pg_num_rows($elim)==0){
							$elim= pg_query("select * from ordenes_detalles where id_item='$id'");
							if(pg_num_rows($elim)==0){
								$eliminado=pg_query("delete from items where id_items='$id'");
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
<form id="nuevo_item" name="nuevo_item" method="post" action="additems.php">
	<div align="center">
    	<input type="image" src="../../images/AgregarIcon.png" name="Nuevo" onclick="Clear_Frame()" value="N"/>
  	</div>
</form>
</body>
</html>