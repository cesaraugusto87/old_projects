
	
	<script type="text/javascript">
	
	
	function alerta(div){
		
		$(function() {
		$("#"+div).dialog({
			bgiframe: true,
			width: 500,
			modal: true,
			buttons: {
				Ok: function() {
					$(this).dialog('close');
				}
			}
		});
	});
	
		
		}
	
		function confirmar(div){
		
		$(function() {
		$("#"+div).dialog({
			bgiframe: true,
			resizable: false,
			width: 500,
			modal: true,
			overlay: {
				backgroundColor: '#000',
				opacity: 0.5
			},
			buttons: {
				'Aceptar': function() {
					$(this).dialog('close');
				return true;
				},
				'Cancelar': function() {
					$(this).dialog('close');
					return false;
				}
			}
		});
	});
	
		
		}
	
	confirmar("dialog");
	</script>




<!-- End demo -->

