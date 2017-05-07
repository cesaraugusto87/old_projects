<?php

import("libreria.nucleo.classes.Template");
import("Usuario");
import("DepartamentoWeb");
import("entidades.TipoUsuarioEntity");
class UsuarioWeb
{
	
	private $dirBase;
	private $dirMod = "mod_usuarios";
	
	public function __construct()
	{
		$this->dirBase = Config::getValue("TPL_PATH");
	}
	
	public function getFormAgregar( $FormVars = null)
	{
		$t = new Template();
		$t->setDir($this->dirBase . $this->dirMod);
		
		
		$t->setTemplate("agregar");
		$FormVars["tiposUsuario"] = self::getCBTipoUsuarios($FormVars["IdTipo"]);
		$FormVars["departamentos"] = DepartamentoWeb::getCBDepartamentos($FormVars["IdDepartamento"]);
		$t->setVars($FormVars);
		return $t;
	}
	
	public function getFormBuscar( $FormVars)
	{
		$t = new Template();
		$t->setDir($this->dirBase . $this->dirMod);
		$t->setTemplate("buscar");
		$FormVars["tiposUsuario"] = self::getCBTipoUsuarios($FormVars["IdTipo"], true);
		if (isset($FormVars["Nombre"]))
		{
			$FormVars["checked_nombre"] = 'checked="checked"';
		}
		
		if (isset($FormVars["Apellido"]))
		{
			$FormVars["checked_apellido"] = 'checked="checked"';
		}
		
		if (isset($FormVars["Login"]))
		{
			$FormVars["checked_login"] = 'checked="checked"';
		}
		
		
		$FormVars["departamentos"] = DepartamentoWeb::getCBDepartamentos($FormVars["IdDepartamento"], true);
				
		$t->setVars($FormVars);
		return $t;
	}
	
	public function getResultados( $resultados)
	{
			/*echo "<pre>";
				print_r($resultados);
				echo "</pre>";*/
		$t = new Template();
		$t->setDir($this->dirBase . $this->dirMod);
		
			if (isset($resultados["record"], $resultados["total"], $resultados["pages"]))
			{
				$total = $resultados["total"];
				$paginas = $resultados["pages"];
				$resultados = $resultados["record"];
					
					/*echo "<pre>";
				print_r();
				echo "</pre>";*/
				
			}

				
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
		return $t;
	}
	
	public static function getCBTipoUsuarios( $selected, $cualquiera = false)
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
	}
}


?>