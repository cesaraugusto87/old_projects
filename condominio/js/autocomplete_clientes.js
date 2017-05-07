$(function() 
{
	$("#autocomplete_clientes").result(function(event, data, formatted) {
		if (data)
		{
			$('#autocomplete_clientes').val(data[1]);
		}
	});
});
