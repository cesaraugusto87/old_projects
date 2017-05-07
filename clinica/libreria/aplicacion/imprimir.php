<?php
//include_once(dirname(__FILE__). "/libreria/nucleo/functions/import.php");

/*import("libreria.aplicacion.Pagina");
import("libreria.aplicacion.Credentials");
import("libreria.nucleo.SessionManager");
import("libreria.aplicacion.SolicitudWeb");
import("libreria.aplicacion.Solicitud");
//$sesionManager = new SessionManager();

//$_POST = $sesionManager->getVar("imprimir");


//$Web = new solicitudWeb();

//$formBuscar  	= 	$Web->buscar($_POST, $_GET["pagina"]);
//$resultado 		= 	$Web->getFormResultados($resultados);


//echo $resultado;*/
###########enviar por la url el resultado que se va imprimir#################
import("libreria.nucleo.classes.Template");
import("Departamento");
import("Usuario");
import("Solicitud");
import("entidades.SolicitudEntity");
import("DepartamentoWeb");
import("entidades.TipoUsuarioEntity");

//$resultados = $_GET[$resultados];

//$row = mysql_fetch_array( $resultados);
		/*echo "<pre>";
				print_r($row);
				echo "</pre>";*/
class Imprimir
{				
 public function Resultados($resultados)
	{
		$t = new Template();
		$t->setDir($this->dirBase . $this->dirMod);
		if (isset($resultados["record"], $resultados["total"], $resultados["pages"]))
		{
			$total = $resultados["total"];
			$paginas = $resultados["pages"];
			$resultados = $resultados["record"];
		}
		
		$sesion = new Credentials();
		$datos = $sesion->getCredentials();
		
		if (is_resource($resultados))
		{
			if ($datos->IdTipo==1)
			{
				$filas = "";
				$t->setTemplate("filas_imprimir");
				while ( $row = mysql_fetch_array( $resultados))
				{
			
					$t->setVars($row);
					$filas .= $t->show();
					/*	echo "<pre>";
				print_r($row);
				echo "</pre>";*/
				}
				
				$t->setTemplate("imprimir");
				$Vars["filas"] = $filas;
				if (isset($paginas))
				{
					$paginasHTML = "<tfoot><tr><td colspan=\"6\">";
					for ( $i = 0; $i++<$paginas; )
					{
						if ($_GET["pagina"] == $i)
						{
							$paginasHTML .= "<a href=\"?pagina=$i\" class=\"on\">$i</a> ";
						}
						else
						{
							$paginasHTML .= "<a href=\"?pagina=$i\">$i</a> ";
						}
					}
					$paginasHTML .= "</td></tr></tfoot>";
					$Vars["paginas"] = $paginasHTML;
				}
				
				
				$t->setVars($Vars);
				return $t->show();
			}
			
			
		}
	}
	

}





?>