<?php 
	session_start();
	session_unset();
	session_destroy();
?>
<html>
   <head>
      <title>Cerrando Secion....</title>
   </head>
<body onLoad="parent.window.location.href='index.php'">
</body>
</html>