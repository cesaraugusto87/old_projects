<?php

class SolicitudEntity
{
	public $IdSolicitud;
	public $IdUsuario;
	public $Asunto;
	public $Contenido;
	public $Adjunto;
	public $Fecha;
	public $Estado;
	
	public function __construct()
	{
		// let it blank intentionally
	}
}

?>