<?php
import("libreria.nucleo.classes.Template");
import("Departamento");
import("Usuario");
import("Solicitud");
import("entidades.SolicitudEntity");
import("DepartamentoWeb");
import("entidades.TipoUsuarioEntity");
class SolicitudWeb
{
	
	private $dirBase;
	private $dirMod = "mod_solicitudes";
	
	public function __construct()
	{
		$this->dirBase = Config::getValue("TPL_PATH");
	}
	
	public function getFormAgregar($FormVars)
	{
		$t = new Template();
		$t->setDir($this->dirBase . $this->dirMod);
		
		$t->setTemplate("agregar");
		$FormVars["departamentos"] = DepartamentoWeb::getCBDepartamentos($FormVars["IdDepartamento"]);
		$t->setVars($FormVars);
		return $t->show();
		
	}
	
	public function getFormAtender($FormVars)
	{
		$t = new Template();
		$t->setDir($this->dirBase . $this->dirMod);
		$t->setTemplate("atender");
		$t->setVars($FormVars);
		return $t->show();
	}
	
	public function getFormAtendido($FormVars)
	{
		$t = new Template();
		$t->setDir($this->dirBase . $this->dirMod);
		$t->setTemplate("detalleusu");
		$a["atendido"]= $FormVars;
		$t->setVars($a);
		return $t->show();
	}
	
	public function getVerDetalle($Vars)
	{
		$t = new Template();
		$t->setDir($this->dirBase . $this->dirMod);
		$t->setTemplate("detalle");
		$t->setVars($Vars);
		return $t->show();
	}
	########################################
	public function getVerDetalleusu($Vars)
	{
		$t = new Template();
		$t->setDir($this->dirBase . $this->dirMod);
		$t->setTemplate("detalleusuario");
		$t->setVars($Vars);
		return $t->show();
	}
	
	########################################
	public function getFormResultados( $resultados)
	{
		$t = new Template();
		$t->setDir($this->dirBase . $this->dirMod);
		
		$sesion = new Credentials();
		$datos = $sesion->getCredentials();
		if (is_resource($resultados))
		{
			if ($datos->IdTipo==1)
			{
				$filas = "";
				$t->setTemplate("resultados_filas");
				while ( $row = mysql_fetch_array( $resultados))
				{
					$t->setVars($row);
					$filas .= $t->show();
				}
				
				$t->setTemplate("resultados");
				$Vars["filas"] = $filas;
				$t->setVars($Vars);
				return $t->show();
			}
			else
			{
				$filas = "";
				$t->setTemplate("resultadofilausu");
				while ( $row = mysql_fetch_array( $resultados))
				{
					$t->setVars($row);
					$filas .= $t->show();
				}
				$t->setTemplate("resultadosusu");
				$Vars["filas"] = $filas;
				$t->setVars($Vars);
				return $t->show();
			}
		}
	}
	
	
	public function getFormBuscar( $FormB)
	{
		$t = new Template();
		$t->setDir($this->dirBase . $this->dirMod);
		$t->setTemplate("buscar");

		if (isset($FormB["Asunto"]))
		{
			$FormB["checked_Asunto"] = 'checked="checked"';
		}
		
		if (isset($FormB["Contenido"]))
		{
			$FormB["checked_Contenido"] = 'checked="checked"';
		}
		
		if (isset($FormB["IdSolicitud"]))
		{
			$FormB["checked_Solicitud"] = 'checked="checked"';
		}
		
		
		$t->setVars($FormB);
		return $t;
	}
	
	
	public function getFormConsultar( $resultados)
	{
		$t = new Template();
		$t->setDir($this->dirBase . $this->dirMod);
		$filas = "";
		
		
		
			if ( $resultados->exito== true)
				{
					$t->setTemplate("resultados_fila_vacia");
			
					while($resultados->mensajes)
					{
						$t->setVars($resultados->mensajes);
						$filas .= $t->show();
					}
				}
		
		else{
			if ( $resultados->exito== true)
				{
				$t->setTemplate("resultados_filas");
			
					while($resultados->mensajes)
					{
						$t->setVars($resultados->mensajes);
						$filas .= $t->show();
					}
				}	
			}
			
		
		$t->setTemplate("resultados");
		$Vars["filas"] = $filas;
		$t->setVars($Vars);
		return $t->show();
			
	}
	
	
	
	public static function getCBDepartamentos( $selected, $cualquiera = false)
	{
		$deps = Departamento::getDepartamentos();
		$html = "<select name=\"IdDepartamento\">";
		if ($deps)
		{
			if ($cualquiera == true)
			{
				if ($selected == null or $selected == "-1")
				{
					$html .=  "<option value=\"-1\" selected=\"selected\">Indiferente</option>";
				}
				else
				{
					$html .=  "<option value=\"-1\">Indiferente</option>";
				}
			}
			
			while ($obj = mysql_fetch_object($deps, DepartamentoEntity))
			{
				
				if ($selected == $obj->IdDepartamento)
				{
					$html .=  "<option value=\"{$obj->IdDepartamento}\" selected=\"selected\">{$obj->Nombre}</option>";
				}
				else 
				{
					$html .=  "<option value=\"{$obj->IdDepartamento}\">{$obj->Nombre}</option>";
				}
			}
		}
		else 
		{
			$html .=  "<option value=\"-1\">Error a leer la BD</option>";
		}
		$html .= "</select>";
		return  $html;
	}
}


?>