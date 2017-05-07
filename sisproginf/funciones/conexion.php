<?php
   function Conectarse()
   {
	 if (!$link=mysql_connect("localhost","root","scaspc"))	  
	  {
	     echo "Error Conectando al servidor de la Base de Datos";
		 exit();
	  }
	  if(!mysql_select_db("sisproginf",$link))
	  {
	    echo "Error seleccionando la Base de Datos";
		exit();
	  }
	  return $link;
   } 
?>
