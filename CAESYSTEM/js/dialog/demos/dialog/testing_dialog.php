<html lang="en">
<head>
	<title>Dialog - Prueba	</title>
	<link type="text/css" href="../../themes/base/ui.all.css" rel="stylesheet" />
	<script type="text/javascript" src="../../jquery-1.3.2.js"></script>
	<script type="text/javascript" src="../../ui/ui.core.js"></script>
	<script type="text/javascript" src="../../ui/ui.draggable.js"></script>

	<script type="text/javascript" src="../../ui/ui.resizable.js"></script>
	<script type="text/javascript" src="../../ui/ui.dialog.js"></script>
	<script type="text/javascript" src="../../external/bgiframe/jquery.bgiframe.js"></script>
	<link type="text/css" href="../demos.css" rel="stylesheet" />
	<script type="text/javascript">
	$(function() {
		$("#dialog").dialog({
			bgiframe: true,
			modal: true,
			buttons: {
				Ok: function() {
					$(this).dialog('close');
				}
			}
		});
	});
	</script>
</head>
<body>

<div class="demo">

<div id="dialog" title="Descarga Completa">
	<p>
		<span class="ui-icon ui-icon-circle-check" style="float:left; margin:0 7px 50px 0;"></span>
		Comunicado
	</p>
	<p>
		esto es una <b>PRUEBA</b>.
	</p>

</div>



</div><!-- End demo -->

</body>
</html>
