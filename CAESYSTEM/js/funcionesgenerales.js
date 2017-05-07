// JavaScript Document

		
		function esentero(numero){
			return((/^[0-9]+$/.test(numero)));
	     }
		
		function parpadeo(div){
			 $('#'+div).effect("pulsate", { times:3 }, 2000);
			}
		
		//Función que carga los divs con ajax de jquery
		function enviardiv (url, div)				
		{
			$.get( url, {},
					function(data){
					$("#"+div).html(data);	
			           				});	
		}
		
		
		function alerta(msj, div, url, divd){
		$('#'+div).html(msj);
		
		$(function() {
		$("#"+div).dialog({
			bgiframe: true,
			width: 500,
			modal: true,
			buttons: {
				Ok: function() {
					if(divd=="0"){
					window.location=url;
					$('#'+div).dialog('destroy');
					}else{
					enviardiv(url,div);
					$('#'+div).dialog('destroy');
					}
					$('#'+div).dialog('close');
				}
			}
		});
	});
	$('#'+div).dialog('open');
		}
		
		

		
		
		function aviso(msj){
		$('#dialog1').html(msj);
		
				
		
		$(function() {
		$("#dialog1").dialog({
			autoOpen: false,
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
	

	
	$('#dialog1').dialog('open');
		}
	


function ponercalendarios(){
	$(".date").datepicker();
		$(".date").datepicker($.datepicker.regional['es']);
		$(".date").datepicker("option", {dateFormat: "dd/mm/yy", changeMonth: true,	changeYear: true });
	}
	
	
	
	