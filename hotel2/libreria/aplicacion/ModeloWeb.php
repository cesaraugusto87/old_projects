<?php
import("libreria.nucleo.classes.Template");
//import("Paciente");
//import("Registro");
import("entidades.ModeloEntity");


class ModeloWeb
{
	
	private $dirBase;
	private $dirMod = "mod_modelo";
	
	public function __construct()
	{
		$this->dirBase = Config::getValue("TPL_PATH");
	}
	
########################################################

public function getFormModelo()
	{
		$t = new Template();
		$t->setDir($this->dirBase . $this->dirMod);
		
		$t->setTemplate("platModelo");
		$t->setVars($FormVars);
		return $t->show();
		
	}

########################################################
	
	public function getFormAgregar($FormVars)
	{
		$t = new Template();
		$t->setDir($this->dirBase . $this->dirMod);
		
		$t->setTemplate("agregar");
		$t->setVars($FormVars);
		return $t->show();
		
	}
	
	public function getFormPreparar($FormVars)
	{
		$t = new Template();
		$t->setDir($this->dirBase . $this->dirMod);
		
		$t->setTemplate("buscar");
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
		$t->setTemplate("detalleusu");
		$t->setVars($Vars);
		return $t->show();
	}
	
	########################################
	public function getFormResultados( $resultados)
	{
		$t = new Template();
		$t->setDir($this->dirBase . $this->dirMod);
		
		if ($resultados->exito = true)
		{
			if (is_resource($resultados->mensajes))
			{
				
					$filas = "";
					$t->setTemplate("resultados_filas");
					while ( $row = mysql_fetch_array( $resultados->mensajes))
					{
						$t->setVars($row);
						$filas .= $t->show();
					}
					
					$t->setTemplate("resultados");
					$Vars["filas"] = $filas;
					$t->setVars($Vars);
					return $t->show();
				
			}
		}	
		else 
		{
			$filas = "";
				$t->setTemplate("resultados_fila_vacia");
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
		
	}
	
##################################################
	
	public function getFormResultadosh($resultados)
	{
	
		$this->resultados =  $resultados;
		
			/*echo "<pre>";
			print_r($this->resultados);
			echo "</pre>";*/
		
		$t = new Template();
		$t->setDir($this->dirBase . $this->dirMod);
		
		if (isset($resultados["record"], $resultados["total"], $resultados["pages"]))
		{
			$total = $resultados["total"];
			$paginas = $resultados["pages"];
			$resultados = $resultados["record"];
		}
		
		if (is_resource($resultados))
		{
			
				$filas = "";
				$t->setTemplate("resultados_filasp");
				while ( $row = mysql_fetch_array( $resultados))
				{
					$t->setVars($row);
					$filas .= $t->show();
				}
				
				$t->setTemplate("resultadosh");
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
		/*else 
		{
			$filas = "";
				$t->setTemplate("resultados_fila_vacia");
				while ( $row = mysql_fetch_array( $resultados))
				{
					$t->setVars($row);
					$filas .= $t->show();
				}
				
				$t->setTemplate("resultadosh");
				$Vars["filas"] = $filas;
				$t->setVars($Vars);
				return $t->show();
			
			
		}*/
	}


##################################################
/* es nacesario realizar la paginacion de historiales*/

##################################################

public function getHistoriales( $resultados)
	{
	
		$this->resultados =  $resultados;
		
			/*echo "<pre>";
			print_r($this->resultados);
			echo "</pre>";*/
			
			
		$t = new Template();
		$t->setDir($this->dirBase . $this->dirMod);
		
		if (isset($resultados["record"], $resultados["total"], $resultados["pages"]))
		{
			$total = $resultados["total"];
			$paginas = $resultados["pages"];
			$resultados = $resultados["record"];
		}
		
		if (is_resource($resultados))
		{
			
				$filas = "";
				$t->setTemplate("historiales_filas");
				while ( $row = mysql_fetch_array( $resultados))
				{
					$t->setVars($row);
					$filas .= $t->show();
				}
				
				$t->setTemplate("historiales");
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



################################################	
	public function getFormBuscar( $FormB)
	{
		$t = new Template();
		$t->setDir($this->dirBase . $this->dirMod);
		$t->setTemplate("buscar");

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