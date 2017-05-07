<?php

include_once(dirname(__FILE__). "/libreria/nucleo/functions/import.php");
import("libreria.aplicacion.Solicitud");
import("libreria.nucleo.classes.Cezpdf");
import("libreria.aplicacion.Credentials");

$c = new Credentials();
$datos = $c->getCredentials();


if (isset($_GET["logout"]))	
{
	$sesion->logout();
}
	



	if (isset($_GET["idsolicitud"]))
	{
		$pdf =& new Cezpdf("LETTER");
		$solicitud = new Solicitud();
		//$pdf->openObject();
		$pdf->ezSetCmMargins(2,1,2,2);
		//$pdf->ezSetY();
		//$pdf->ezSetY(0);
		$pdf->addPngFromFile('tema/imagenes/logo_chilemex.png',$pdf->x+60,$pdf->y-25,100,41); 

		$pdf->saveState();
		//$pdf->saveState();
		$data = $solicitud->obtenerSolicitud($_GET["idsolicitud"]);
		$data = mysql_fetch_array($data);
		$pdf->selectFont(dirname(__FILE__) .  "/libreria/nucleo/classes/fonts/Courier.afm");
		$options["justification"] = "right";
		$options["right"] = 0;
		$numero = $data["IdSolicitud"];
		$pdf->ezText("\n\n<b>Solicitud #$numero</b>", 12, $options);
		
		$options["justification"] = "center";
		$asunto = $data["Asunto"];
		$pdf->ezText("\n<b>$asunto</b>", 26, $options);
		
		$options = null;
		$pdf->ezText("\n",12);
		$nombre = $data["NombreUsuario"];
		$pdf->ezText("<b>Usuario</b>: $nombre.", 12, $options);
		
		$options = null;
		$fecha = date("d/m/Y", strtotime($data["Fecha"]));
		$pdf->ezText("<b>Fecha</b>: $fecha.", 12, $options);
		
		$options["justification"] = "full";
		$contenido = $data["Contenido"];
		$pdf->ezText("\n\n$contenido", 12, $options);
		
		
		$options["justification"] = "center";
		$pdf->ezText("\n\n\n -----------------", 12, $options);
		
		$options["justification"] = "center";
		$pdf->ezText(" Firma Autorizada", 12, $options);
		
		$options["justification"] = "right";
		$pdf->ezText("\n\n\n Clinica Chilemex - Todos los derechos reservados 2008", 10, $options);
		
		$pdf->output();
		$pdf->ezStream();
		
	}







?>