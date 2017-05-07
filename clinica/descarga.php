<?php
    include_once(dirname(__FILE__). "/libreria/nucleo/functions/import.php");
import("libreria.aplicacion.Solicitud");
import("libreria.nucleo.classes.Cezpdf");
import("libreria.aplicacion.Credentials");

$c = new Credentials();

if ($c->isLogged())
{
    if (isset($_GET["idsolicitud"]))
	{
		
		//$pdf->saveState();
		$solicitud = new Solicitud();
		$data = $solicitud->obtenerSolicitud($_GET["idsolicitud"]);
		$data = mysql_fetch_array($data, MYSQL_ASSOC);
		
		
		
		
		$f = "uploads/". $data["Adjunto"];
		if (is_file($f))
		{
			header("Content-type: application/octet-stream");
			$filename = $data["Adjunto_Nombre"];
			header("Content-Disposition: attachment; filename=\"$filename\"\n");
			$fp=fopen("$f", "r");
			fpassthru($fp);
		}
		else
		{
			echo "No Existen archivos Adjuntos a esta Solicitud!";
		}
	
	}elseif (isset($_GET["idseguimiento"]))
	{
		
		//$pdf->saveState();
		$solicitud = new Solicitud();
		$data = $solicitud->obtenerSeguimientoPorId($_GET["idseguimiento"]);
		$data = mysql_fetch_array($data, MYSQL_ASSOC);
		
		
		
		
		$f = "uploads/". $data["Adjunto"];
		if (is_file($f))
		{
			header("Content-type: application/octet-stream");
			$filename = $data["Adjunto_Nombre"];
			header("Content-Disposition: attachment; filename=\"$filename\"\n");
			$fp=fopen("$f", "r");
			fpassthru($fp);
		}
		else
		{
			echo "No existen archivos Adjuntos!";
		}
	
	}
	
}
?>