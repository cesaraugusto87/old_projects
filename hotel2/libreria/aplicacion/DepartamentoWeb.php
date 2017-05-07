<?php
import("libreria.nucleo.classes.Template");
import("Departamento");
import("entidades.DepartamentoEntity");
class DepartamentoWeb
{
	
	private $dirBase;
	private $dirMod = "mod_departamento";
	
	public function __construct()
	{
		$this->dirBase = Config::getValue("TPL_PATH");
	}
	
	public function getFormAgregar($FormVars)
	{
		$t = new Template();
		$t->setDir($this->dirBase . $this->dirMod);
		
		
		$t->setTemplate("agregar");
		$t->setVars($FormVars);
		return $t->show();
	}
	
	public function getResultados( $resultados)
	{
		$t = new Template();
		$t->setDir($this->dirBase . $this->dirMod);
		$html = "";
		if ( $resultados->exito== true)
		{
			//$t->setTemplate("resultados_filas");
			$i=1;
			$columnas  = "";
			while ( $row = mysql_fetch_array($resultados->mensajes))
			{
				
				
				$t->setTemplate("resultados_columna");
				$t->setVars($row);
				$columnas .= $t->show();
				if ($i%2 == 0)
				{
					$t->setTemplate("resultados_filas");
					$filas["columnas"] = $columnas;
					$columnas ="";
					$t->setVars($filas);
					$html.= $t->show();
				}
				$i++;
				//$html .= $t->show();
			}
			
			if ($columnas != "")
			{
				$t->setTemplate("resultados_filas");
				$filas["columnas"] = $columnas;
				$columnas ="";
				$t->setVars($filas);
				$html.= $t->show();
			}
		}
		
		
		$t->setTemplate("resultados");
		$Vars["filas"] = $html;
		$t->setVars($Vars);
		return $t;
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