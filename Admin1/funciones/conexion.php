<?php
   function Conectarse()
   {
	 if (!$link=pg_connect("host=localhost dbname=admon1 user=postgres password= Passw0rd " ))	  
	  {
	     echo "Error Conectando al servidor de la Base de Datos";
		 exit();
	  }
	  return $link;
   } 
?>
