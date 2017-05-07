<?php

import("libreria.nucleo.classes.Template");
import("Paciente");
import("entidades.PacienteEntity");

class PacienteWeb
{
	
	private $dirBase;
	private $dirMod = "mod_pacientes";
	
	public function __construct()
	{
		$this->dirBase = Config::getValue("TPL_PATH");
	}
	
	public function getFormAgregar( $FormVars = null)
	{
		$t = new Template();
		$t->setDir($this->dirBase . $this->dirMod);
		
		
		$t->setTemplate("agregar");
		$t->setVars($FormVars);
		return $t;
	}
	
	public function getFormBuscar( $FormVars = null)
	{
		$t = new Template();
		$t->setDir($this->dirBase . $this->dirMod);
		$t->setTemplate("buscar");
		
		if (isset($FormVars["Nombre"]))
		{
			$FormVars["checked_nombre"] = 'checked="checked"';
		}
		
		if (isset($FormVars["Apellido"]))
		{
			$FormVars["checked_apellido"] = 'checked="checked"';
		}
		
		$t->setVars($FormVars);
		return $t;
	}
	
	public function getResultados( $resultados)
	{
		$t = new Template();
		$t->setDir($this->dirBase . $this->dirMod);
		
		$filas = "";
		if (is_resource($resultados))
		{
			$t->setTemplate("resultados_fila");
			$i = 1;
			while($row = mysql_fetch_array($resultados))
			{
				if ($i%2 == 0)
				{
					$row["even"] = ' class="even"';
				}
				else
				{
					$row["even"] = "";
				}
				$t->setVars($row);
				
				$filas .= $t->show();
				$i++;
			}
		}
		else
		{
			$t->setTemplate("resultados_fila_vacia");
			$filas = $t->show();
		}
		$Vars["filas"] = $filas;
		$t->setTemplate("resultados");
		$t->setVars($Vars);
		return $t;
	}
	
	/*public static function getCBTipoUsuarios( $selected, $cualquiera = false)
	{
		$tipos = Usuario::getTipoUsuarios();
		$html = "<select name=\"IdTipo\">";
		if ($tipos)
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
			
			while ($tipoUsuario = mysql_fetch_object($tipos, TipoUsuarioEntity))
			{
				
				if ($selected == $tipoUsuario->IdTipo)
				{
					$html .=  "<option value=\"{$tipoUsuario->IdTipo}\" selected=\"selected\">{$tipoUsuario->Nombre}</option>";
				}
				else 
				{
					$html .=  "<option value=\"{$tipoUsuario->IdTipo}\">{$tipoUsuario->Nombre}</option>";
				}
			}
		}
		else 
		{
			$html .=  "<option value=\"-1\">Error a leer la BD</option>";
		}
		$html .= "</select>";
		return  $html;
	}*/
}


?>