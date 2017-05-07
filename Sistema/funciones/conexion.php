<?php
   function Conectarse()
   {
	 if (!$link=pg_connect("host=localhost dbname=sistema user=postgres password= Passw0rd " ))	  
	  {
	     echo "Error Conectando al Servidor de la Base de Datos";
		 exit();
	  }
	  return $link;
   } 
?>
