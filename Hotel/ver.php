<?php 

include_once(dirname(__FILE__). "/libreria/nucleo/functions/import.php");
import("libreria.aplicacion.Pagina");

$pagina->setContenido( $tabs . $resultado . $script);
$pagina->render();

?>