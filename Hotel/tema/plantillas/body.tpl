<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>Hotel</title>
		<link href="tema/estilos/clinica.css" rel="stylesheet" type="text/css" />
		<link type="text/css" rel="stylesheet" href="scripts/dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen"></LINK>
		<script type="text/javascript" src="scripts/dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>
	</head>
	<script type="text/javascript" language="JavaScript">
		function tab (divShow, btn)
		{
			var  formTab	=    document.getElementById("tabsTarget").getElementsByTagName("div");
			var  btnTab	=    document.getElementById("tabs").getElementsByTagName("a");
			var total = formTab.length;
			for ( i= 0; i< total ; i++ )
			{
				formCurrent = formTab[i];
				if (formCurrent.id.substr(0,4) == "form")
				{
				
					if (formCurrent.id == divShow)
					{
						
						document.getElementById(formCurrent.id).style.display= "block";
						
					}
					else
					{
						document.getElementById(formCurrent.id).style.display= "none";
						
					}
				}
				
				btnCurrent = btnTab[i];
				if (btnCurrent.id == btn)
				{
					document.getElementById(btnCurrent.id).className = "on";
				}
				else
				{
					document.getElementById(btnCurrent.id).className = "";
				}
			}

		}
	</script>
	<body>
			<div id="overall">
				<div id="top">
				
				</div>
				
				<div id="main">
					<div id="header">
						<h1><a href="#"><span></span></a></h1>
						<h2><a href="#"><object 
  <param name="movie" value="tema/imagenes/intro.swf" />
  <param name="quality" value="high" />
  <embed src="tema/imagenes/intro.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="510" height="180" ></embed>
</object></a></h2>
						<div class="clearit"></div>
					</div>
{menu}

					<div id="content">
						
						{contenido}
					</div>		
				</div>
				<div id="bottom">
					<div id="bottom_menu">
						<div class="clearit"></div>
					</div>
					<div id="copyright">
						Dra.Aaaaa Aaaaa - Todos los derechos reservados 2009 
					</div>
				</div>
			</div>
	</body>
</html>
