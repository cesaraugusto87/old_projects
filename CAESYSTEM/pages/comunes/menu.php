<?php
session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<TITLE>- Menu</TITLE>
<link href="../../css/styles.css" rel="stylesheet"
	type="text/css" />
<script language="JavaScript" type="text/JavaScript">

function redirect(page,param) 
{
 	
	document.formMenu.action=page;
	document.formMenu.target="iframecenter";
	document.formMenu.submit();
}

function resaltar(obj,op)
{
	
	if (op==1)
	{
		document.getElementById("oldColor").value=obj.style.color;
		document.getElementById("oldBackground").value=obj.style.background;
		var oldcolor=obj.style.color;
		obj.style.background="#666666";
		obj.style.color="#FFFFFF";
	}
	if (op==2)
	{
		if (obj.className=="pulsar2")
		{
			obj.style.background="#CCCCCC";
			obj.style.color = "#000000";
		}
		else
		{		
			obj.style.background="";
			obj.style.color ="#000000";
			
		}
		
	}
}

function menu(valor,obj)
{
	var divs = document.getElementsByTagName("div");
	var menu1, menu2;
	if (document.getElementById(valor).style.display=="none")
	{
		document.getElementById(valor).style.display="";
		if (valor.split("_")[0]=="menu2")
		{
			document.getElementById("menu_"+valor.split("_")[2]).style.display="";
			document.getElementById(valor.split("_")[2]).className="botonMenos";
		}
		
		if (obj.className=="botonMas")
			obj.className="botonMenos";
		if (obj.className=="boton2Mas")
			obj.className="boton2Menos";
	}
	else if (document.getElementById(valor).style.display=="")
	{
		document.getElementById(valor).style.display="none";
		if (valor.split("_")[0]=="menu2")
		{
			document.getElementById("menu_"+valor.split("_")[2]).style.display="";
			document.getElementById(valor.split("_")[2]).className="botonMenos";
		}
		if (obj.className=="botonMenos")
			obj.className="botonMas";
		if (obj.className=="boton2Menos")
			obj.className="boton2Mas";
	}
	
	
}
</script>
 
</HEAD>
<body>
<?php
include('../../permisos.php');
?>
<form id="formMenu" name="formMenu" action="" target="">
<table border="0" cellpadding="0" cellspacing="0" height="400" >
<tr>
		<td valign="top" width="120" bgcolor="#FFFFFF">
        <!-- *************************** menu Administracion del sistema ********************************************-->
        <?php if (Administrador()) { ?>
		<div  id="Admin" class="botonMas" onclick="menu('menu_Admin',this)">Usuarios</div>
			<div id="menu_Admin" style="display:none">
					<div id="itemAdmin1"><a
						onclick="redirect('../admin_sistema/registro_usuarios.php', null);" class="pulsar"
						onmouseover="resaltar(this,1)" onmouseout="resaltar(this,2)">Registrar un Nuevo Usuario</a><!-- nivel 1 -->
					</div>
					
			</div>
            <?php } ?>
		<!-- *************************** Fin menu Administracion del sistema ********************************************-->
		
		<!-- *************************** menu Modulo de administrativo ********************************************-->
         <?php if (Administrador()) { ?>
        <div id="Administrativo" class="botonMas" onclick="menu('menu_administrativo',this)">Administración</div><!-- nivel 0 -->
			<div id="menu_administrativo" style="display:none">
					<div id="itemOp4a"><a
							onclick="redirect('../administracion/clientes.php', null);" class="pulsar2"
							onmouseover="resaltar(this,1)" onmouseout="resaltar(this,2)">
							Clientes</a><!-- nivel 2 -->
					</div>
                    <div id="itemOp4b"><a
							onclick="redirect('../administracion/proveedores.php', null);" class="pulsar2"
							onmouseover="resaltar(this,1)" onmouseout="resaltar(this,2)">
							Proveedores</a><!-- nivel 2 -->
					</div>
                    <div id="itemOp4c"><a
							onclick="redirect('../administracion/cargos.php', null);" class="pulsar2"
							onmouseover="resaltar(this,1)" onmouseout="resaltar(this,2)">
							Cargos</a><!-- nivel 2 -->
					</div>
					 <div id="itemOp4d"><a
							onclick="redirect('../administracion/empleados.php', null);" class="pulsar2"
							onmouseover="resaltar(this,1)" onmouseout="resaltar(this,2)">
							Empleados</a><!-- nivel 2 -->
					</div>
                    <div id="itemOp4e"><a
							onclick="redirect('../administracion/departamentos.php', null);" class="pulsar2"
							onmouseover="resaltar(this,1)" onmouseout="resaltar(this,2)">
							Departamentos</a><!-- nivel 2 -->
					</div>
					 <div id="itemOp4f"><a
							onclick="redirect('../administracion/items.php', null);" class="pulsar2"
							onmouseover="resaltar(this,1)" onmouseout="resaltar(this,2)">
							Items</a><!-- nivel 2 -->
					</div>
					<div id="itemOp4g"><a
							onclick="redirect('../administracion/horarios.php', null);" class="pulsar2"
							onmouseover="resaltar(this,1)" onmouseout="resaltar(this,2)">
							Horarios</a><!-- nivel 2 -->
					</div>
					<div id="itemOp4h"><a
							onclick="redirect('../administracion/niveles.php', null);" class="pulsar2"
							onmouseover="resaltar(this,1)" onmouseout="resaltar(this,2)">
							Nivel</a><!-- nivel 2 -->
					</div>
					<div id="itemOp4i"><a
							onclick="redirect('../administracion/usuarios.php', null);" class="pulsar2"
							onmouseover="resaltar(this,1)" onmouseout="resaltar(this,2)">
							Usuarios</a><!-- nivel 2 -->
					</div>
					
   			</div>
    
                <?php } ?>
    	<!-- *************************** Fin menu administrativo ********************************************-->
		
		 <!-- *************************** menu Modulo de compras ********************************************-->
        <div id="Compras" class="botonMas" onclick="menu('menu_compras',this)">Compras</div><!-- nivel 0 -->
			<div id="menu_compras" style="display:none">
			       <div id="itemOp5b"><a
							onclick="redirect('../compras/agregar_orden.php', null);" class="pulsar2"
							onmouseover="resaltar(this,1)" onmouseout="resaltar(this,2)">
							Agregar Nueva Orden</a><!-- nivel 2 -->
					</div>
					<div id="itemOp5a"><a
							onclick="redirect('../compras/index.php', null);" class="pulsar2"
							onmouseover="resaltar(this,1)" onmouseout="resaltar(this,2)">
							Buscar Orden</a><!-- nivel 2 -->
					</div>
                    
   			</div>
    
    	<!-- *************************** Fin menu compras ********************************************-->
		
		 <!-- *************************** menu Modulo de facturacion ********************************************-->
			<div id="Facturacion" class="botonMas" onclick="menu('menu_facturacion',this)">Facturación</div><!-- nivel 0 -->
				<div id="menu_facturacion" style="display:none">
                    <div id="itemOp3b"><a
							onclick="redirect('../facturacion/fac_cliente.php', null);" class="pulsar2"
							onmouseover="resaltar(this,1)" onmouseout="resaltar(this,2)">
						Facturar</a><!-- nivel 2 -->
					</div>			
                    <div id="itemOp3b"><a
							onclick="redirect('../facturacion/mostrar_reporte.php', null);" class="pulsar2"
							onmouseover="resaltar(this,1)" onmouseout="resaltar(this,2)">
							Reporte Facturas</a><!-- nivel 2 -->
					</div>
			
   			</div>    
    	<!-- *************************** Fin menu facturacion ********************************************-->
		
		<!-- *************************** menu Modulo de inventario ********************************************-->
        <div id="Inventario" class="botonMas" onclick="menu('menu_inventario',this)">Inventario</div><!-- nivel 0 -->
			<div id="menu_inventario" style="display:none">
					 
					 <div id="itemOp2g"><a
							onclick="redirect('../inventario/nuevo_producto.php', null);" class="pulsar2"
							onmouseover="resaltar(this,1)" onmouseout="resaltar(this,2)">
							Nuevo Producto</a><!-- nivel 2 -->
					</div>
					<div id="itemOp2h"><a
							onclick="redirect('../inventario/ingresar_producto.php', null);" class="pulsar2"
							onmouseover="resaltar(this,1)" onmouseout="resaltar(this,2)">
							Ingresar Nuevo Producto</a><!-- nivel 2 -->
					</div>
					 
					 <div id="itemOp2d"><a
							onclick="redirect('../inventario/entradas_inventario.php', null);" class="pulsar2"
							onmouseover="resaltar(this,1)" onmouseout="resaltar(this,2)">
							Entrada a Inventario</a><!-- nivel 2 -->
					</div>
					<div id="itemOp2a"><a
							onclick="redirect('../inventario/saldo_inventarios.php', null);" class="pulsar2"
							onmouseover="resaltar(this,1)" onmouseout="resaltar(this,2)">
							Saldo de Inventario</a><!-- nivel 2 -->
					</div>
                    <div id="itemOp2b"><a
							onclick="redirect('../inventario/producto_rota.php', null);" class="pulsar2"
							onmouseover="resaltar(this,1)" onmouseout="resaltar(this,2)">
							Rotacion de Productos</a><!-- nivel 2 -->
					</div>
                    <div id="itemOp2c"><a
							onclick="redirect('../inventario/margen_rent.php', null);" class="pulsar2"
							onmouseover="resaltar(this,1)" onmouseout="resaltar(this,2)">
							Margen de Rentabilidad de Producto</a><!-- nivel 2 -->
					</div>
                    <div id="itemOp2e"><a
							onclick="redirect('../inventario/salidas_inventario.php', null);" class="pulsar2"
							onmouseover="resaltar(this,1)" onmouseout="resaltar(this,2)">
							Salida de Inventario</a><!-- nivel 2 -->
					</div>
					 <div id="itemOp2f"><a
							onclick="redirect('../inventario/stock_minimo.php', null);" class="pulsar2"
							onmouseover="resaltar(this,1)" onmouseout="resaltar(this,2)">
							Stock Minimo</a><!-- nivel 2 -->
					</div>
					<div id="itemOp2g"><a
							onclick="redirect('../inventario/entrada_salida.php', null);" class="pulsar2"
							onmouseover="resaltar(this,1)" onmouseout="resaltar(this,2)">
							Entradas y Salidas</a><!-- nivel 2 -->
					</div>
   			</div>
    
    	<!-- *************************** Fin menu Inventario ********************************************-->
		
		
		<!-- *************************** menu Modulo de Nomina ********************************************-->
	
    	<div id="Comun" class="botonMas" onclick="menu('menu_comun',this)">Nomina</div><!-- nivel 0 -->
			<div id="menu_comun" style="display:none">
					<div id="itemOp1"><a
							onclick="redirect('../nomina/listado_porfecha.php', null);" class="pulsar2"
							onmouseover="resaltar(this,1)" onmouseout="resaltar(this,2)">
							Listado de Nomina</a><!-- nivel 2 -->
					</div>
                    <div id="itemOp1c"><a
							onclick="redirect('../nomina/listado_total.php', null);" class="pulsar2"
							onmouseover="resaltar(this,1)" onmouseout="resaltar(this,2)">
							Listado Total</a><!-- nivel 2 -->
					</div>
                    <div id="itemOp1a"><a
							onclick="redirect('../nomina/pago_nomina.php', null);" class="pulsar2"
							onmouseover="resaltar(this,1)" onmouseout="resaltar(this,2)">
							Ejecutar Nomina</a><!-- nivel 2 -->
					</div>
                    <div id="itemOp1b"><a
							onclick="redirect('../nomina/recibo_nomina.php', null);" class="pulsar2"
							onmouseover="resaltar(this,1)" onmouseout="resaltar(this,2)">
							Recibo de Nómina</a><!-- nivel 2 -->
					</div>
					<div id="itemOp1d"><a
							onclick="redirect('../nomina/fecha_resumen.php', null);" class="pulsar2"
							onmouseover="resaltar(this,1)" onmouseout="resaltar(this,2)">
							Resumen de Nomina</a><!-- nivel 2 -->
					</div>
					<div id="itemOp1e"><a
							onclick="redirect('../nomina/vacacionesm.php', null);" class="pulsar2"
							onmouseover="resaltar(this,1)" onmouseout="resaltar(this,2)">
							Vacaciones</a><!-- nivel 2 -->
					</div>
                    <div id="itemOp1f"><a
							onclick="redirect('../nomina/Solicitud_prestamos.php', null);" class="pulsar2"
							onmouseover="resaltar(this,1)" onmouseout="resaltar(this,2)">
							Solicitud de Prestamos</a><!-- nivel 2 -->
					</div>
					<div id="itemOp1g"><a
							onclick="redirect('../nomina/Buscar_prestamos_empleados.php', null);" class="pulsar2"
							onmouseover="resaltar(this,1)" onmouseout="resaltar(this,2)">
							Buscar Prestamos Empleados</a><!-- nivel 2 -->
					</div>
   			</div>
    	<!-- *************************** Fin menu Nomina ********************************************-->
		
        
		<!-- *************************** menu Modulo de presupuesto ********************************************-->
        <div id="Presupuesto" class="botonMas" onclick="menu('menu_presupuesto',this)">Presupuesto</div><!-- nivel 0 -->
			<div id="menu_presupuesto" style="display:none">
					<div id="itemOp7a"><a
							onclick="redirect('../presupuesto/nuevo_presupuesto.php', null);" class="pulsar2"
							onmouseover="resaltar(this,1)" onmouseout="resaltar(this,2)">
							Nuevo Presupuesto</a><!-- nivel 2 -->
					</div>
                    <div id="itemOp7b"><a
							onclick="redirect('../presupuesto/listar_presupuesto.php', null);" class="pulsar2"
							onmouseover="resaltar(this,1)" onmouseout="resaltar(this,2)">
							Listar Presupuesto</a><!-- nivel 2 -->
					</div>
                    </div>
    
    	<!-- *************************** Fin menu presupuesto ********************************************-->
        
       

         
	 
      
     
		<!-- *************************** menu Modulo de ventas ********************************************-->
       <div id="Ventas" class="botonMas" onclick="menu('menu_ventas',this)">Ventas</div><!-- nivel 0 -->
			<div id="menu_ventas" style="display:none">
					<div id="itemOp6a"><a
							onclick="redirect('../ventas/anio.php', null);" class="pulsar2"
							onmouseover="resaltar(this,1)" onmouseout="resaltar(this,2)">
							Resumen Ventas Anuales</a><!-- nivel 2 -->
					</div>
                    <div id="itemOp6b"><a
							onclick="redirect('../ventas/mes.php', null);" class="pulsar2"
							onmouseover="resaltar(this,1)" onmouseout="resaltar(this,2)">
							Resumen de Ventas Mensuales</a><!-- nivel 2 -->
					</div>
                    <div id="itemOp6c"><a
							onclick="redirect('../ventas/diario.php', null);" class="pulsar2"
							onmouseover="resaltar(this,1)" onmouseout="resaltar(this,2)">
							Resumen de Ventas Diarias</a><!-- nivel 2 -->
					</div>
					
   			</div>
    
    	<!-- *************************** Fin menu ventas ********************************************-->

	  
	  		<div class="boton"><a href="../../salir.php"
			style="text-decoration:none; color:#FFFFFF" target="_top"> Salir</a>
        </div>
	  </p></td>
	  <td width="10">&nbsp;</td>
	</tr>
</table>
</form>
</body>
</html>
