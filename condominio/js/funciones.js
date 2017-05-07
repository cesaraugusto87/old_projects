// ---------------------------------------------------------------------------------
// - Noticiar Mensaje
// ---------------------------------------------------------------------------------
$(function() 
{
	notificar_mensaje = function(titulo,mensaje)
	{
		if( titulo != '-')
		{
			jAlert(mensaje,titulo);
		}
	}
});

// ---------------------------------------------------------------------------------
// - Clientes
// ---------------------------------------------------------------------------------

function validar_clientes(){
	if(!($('#id').val()&&$('#nombre').val())){
		jAlert("Debe Llenar Todos los Datos");
		return false;
	}

	var er_id = /^[jvegJVEG]\d{7}/
	
	if(!er_id.test(document.formulario.id.value)){
		jAlert('ID No Valido')
		return false
	}
	
	return true;
}

function editar_clientes(){
	res=validar_clientes();
	if (res==true){
		var postvars='agregar=true&id='+$('#id').val()
		+'&nombre='+$('#nombre').val();	

		$.post('modules/clientes/clientes_update.php',postvars,function(d){
			jAlert(d);
		});
	
		$.post('modules/clientes/clientes.php',function(res){
			$('#content').html(res);
		});
	}
}

function buscar_clientes(){
	
	if(!($('#id').val())){
		jAlert("Debe Seleccionar un Cliente para realizar la Busqueda");
		return false;
	}
	
	var arreglo = $('#id').val().split("-");
	var id = arreglo[0];
	var postvars='id='+id;

	$.post('modules/clientes/clientes.php',postvars,function(res){
		$('#content').html(res);
	});
}

function agregar_clientes(){
	res=validar_clientes();
	if (res==true){
		var postvars='agregar=true&id='+$('#id').val()
		+'&nombre='+$('#nombre').val()
		+'&apellido='+$('#apellido').val();	

		$.post('modules/clientes/clientes_insertar.php',postvars,function(d){
			jAlert(d);
		});
		
		$.post('modules/clientes/clientes.php',function(res){
			$('#content').html(res);
		});
	}
}

function eliminar_clientes(id){
	var respuesta = confirm("Desea eliminar el Cliente?");

	if (respuesta){
		
		$.post('modules/clientes/clientes_eliminar.php','id='+id,function(d){
			jAlert(d);
		});
		
		$.post('modules/clientes/clientes.php',function(res){
			$('#content').html(res);
		});
		
	}
}

// ---------------------------------------------------------------------------------
// - Inmuebles
// ---------------------------------------------------------------------------------

function validar_inmuebles(){
	if(!($('#id').val() && $('#id_cliente').val() && $('#tipo').val() )){
		jAlert("Debe Llenar Todos los Datos");
		return false;
	}

	return true;
}

function editar_inmuebles(){
	res=validar_inmuebles();
	if (res==true){
		var postvars='agregar=true&id='+$('#id').val()
		+'&id_cliente='+$('#id_cliente').val()
		+'&tipo='+$('#tipo').val();	

		$.post('modules/inmuebles/inmuebles_update.php',postvars,function(d){
			jAlert(d);
		});
	
		$.post('modules/inmuebles/inmuebles.php',function(res){
			$('#content').html(res);
		});
	}
}

function buscar_inmuebles(){
	
	if(!($('#id').val())){
		jAlert("Debe Seleccionar un Inmueble para realizar la Busqueda");
		return false;
	}
	
	var arreglo = $('#id').val().split("-");
	var id = arreglo[0];
	var postvars='id='+id;

	$.post('modules/inmuebles/inmuebles.php',postvars,function(res){
		$('#content').html(res);
	});
}

function agregar_inmuebles(){
	res=validar_inmuebles();
	if (res==true){
		var postvars='agregar=true&id='+$('#id').val()
		+'&id_cliente='+$('#id_cliente').val()
		+'&tipo='+$('#tipo').val();	

		$.post('modules/inmuebles/inmuebles_insertar.php',postvars,function(d){
			jAlert(d);
		});
		
		$.post('modules/inmuebles/inmuebles.php',function(res){
			$('#content').html(res);
		});
	}
}

function eliminar_inmuebles(id){
	var respuesta = confirm("Desea eliminar el Inmueble?");

	if (respuesta){
		
		$.post('modules/inmuebles/inmuebles_eliminar.php','id='+id,function(d){
			jAlert(d);
		});
		
		$.post('modules/inmuebles/inmuebles.php',function(res){
			$('#content').html(res);
		});
		
	}
}

// ---------------------------------------------------------------------------------
// - Condominio
// ---------------------------------------------------------------------------------

function validar_condominio(){
	if(!($('#id').val() && $('#descripcion').val() )){
		jAlert("Debe Llenar Todos los Datos");
		return false;
	}

	return true;
}

function editar_condominio(){
	res=validar_condominio();
	if (res==true){
		var postvars='agregar=true&id='+$('#id').val()
		+'&descripcion='+$('#descripcion').val();	

		$.post('modules/condominio/condominio_update.php',postvars,function(d){
			jAlert(d);
		});
	
		$.post('modules/condominio/condominio.php',function(res){
			$('#content').html(res);
		});
	}
}

function buscar_condominio(){
	
	if(!($('#id').val())){
		jAlert("Debe Seleccionar un condominio para realizar la Busqueda");
		return false;
	}
	
	var arreglo = $('#id').val().split("-");
	var id = arreglo[0];
	var postvars='id='+id;

	$.post('modules/condominio/condominio.php',postvars,function(res){
		$('#content').html(res);
	});
}

function agregar_condominio(){
	res=validar_condominio();
	if (res==true){
		var postvars='agregar=true&id='+$('#id').val()
		+'&descripcion='+$('#descripcion').val();	

		$.post('modules/condominio/condominio_insertar.php',postvars,function(d){
			jAlert(d);
		});
		
		$.post('modules/condominio/condominio.php',function(res){
			$('#content').html(res);
		});
	}
}

function eliminar_condominio(id){
	var respuesta = confirm("Desea eliminar el condominio?");

	if (respuesta){
		
		$.post('modules/condominio/condominio_eliminar.php','id='+id,function(d){
			jAlert(d);
		});
		
		$.post('modules/condominio/condominio.php',function(res){
			$('#content').html(res);
		});
		
	}
}

// ---------------------------------------------------------------------------------
// - Inmueble por condominio
// ---------------------------------------------------------------------------------

function validar_inmuebles_condominio(){
	if(!($('#id').val() && $('#id_inmueble').val() )){
		jAlert("Debe Llenar Todos los Datos");
		return false;
	}

	return true;
}

function editar_inmuebles_condominio(){
	res=validar_inmuebles_condominio();
	if (res==true){
		var postvars='agregar=true&id='+$('#id').val()
		+'&id_inmueble='+$('#id_inmueble').val();	

		$.post('modules/inmuebles_condominio/inmuebles_condominio_update.php',postvars,function(d){
			jAlert(d);
		});
	
		$.post('modules/inmuebles_condominio/inmuebles_condominio.php',function(res){
			$('#content').html(res);
		});
	}
}

function agregar_inmuebles_condominio(){
	res=validar_inmuebles_condominio();
	if (res==true){
		var postvars='agregar=true&id='+$('#id').val()
		+'&id_inmueble='+$('#id_inmueble').val();	

		$.post('modules/inmuebles_condominio/inmuebles_condominio_insertar.php',postvars,function(d){
			jAlert(d);
		});
		
		$.post('modules/inmuebles_condominio/inmuebles_condominio.php',function(res){
			$('#content').html(res);
		});
	}
}

function eliminar_inmuebles_condominio(id,id_inmueble){
	var respuesta = confirm("Desea eliminar el Inmueble del condominio?");

	if (respuesta){
		
		var postvars='eliminar=true&id='+id
		+'&id_inmueble='+id_inmueble;	
		
		$.post('modules/inmuebles_condominio/inmuebles_condominio_eliminar.php',postvars,function(d){
			jAlert(d);
		});
		
		$.post('modules/inmuebles_condominio/inmuebles_condominio.php',function(res){
			$('#content').html(res);
		});
		
	}
}
