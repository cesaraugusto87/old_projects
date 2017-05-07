<?php
import("libreria.nucleo.classes.Template");
import("libreria.nucleo.classes.Config");
class PaginaImprimir
{
	private $tplVars;
	private $tpl;
	private $dirBase;
	private $dir;
	
	private $templateBase;
	public function __construct()
	{
		$this->tplVars = array();
		$this->dirBase = Config::getValue("TPL_PATH");
		$this->dir = "";
		$this->templateBase = "bodyImprimir";
	}
	
	public function setDir( $dir)
	{
		$this->dir =  $dir;
		
	}
	
	
	
	public static function getErrores($errores)
	{
		if (!is_array($errores))
		{
			$errores = array($errores);
		}
		
		$html = "<ul class=\"mensajes\">";
		foreach ($errores as $error)
		{
			$html .= "<li>$error</li>";
		}
		$html .= "</ul>";
		return $html;
	}
	
	public function setMenu( $tipo , $vars = null)
	{
		$tpl = new Template();
		$tpl->setDir($this->dirBase);
		
				
		switch ($tipo)
		{
			case 1:
				$template = "menu";
			break;
			case 2:
			default:
				$template = "menu_usuario";
			break;
		}
		$tpl->setTemplate($template);
		if (is_array($vars) ||  is_object($vars))
		{
			$tpl->setVars($vars);
		}
		$this->tplVars["menu"] = $tpl->show();
	}
	
	
	public function getLogin(  $vars)
	{
		$tpl = new Template();
		$tpl->setDir($this->dirBase);
		
				
		$tpl->setTemplate("login");
		$tpl->setVars($vars);
		return $tpl->show();
	}
	
	
	public function setContenido ( $contenido)
	{
		$this->tplVars["contenido"] = $contenido;
	}
	
	public function getTabs ( $vars)
	{
		
		$tpl = new Template();
		$tpl->setDir($this->dirBase);
		$tpl->setTemplate("tabs");
		$tpl->setVars($vars);
		return $tpl->show();
	}
	
	
	public function getSubmenu ( $submenuTplname)
	{
		
		$tpl = new Template();
		$tpl->setDir($this->dirBase);
		$tpl->setTemplate($submenuTplname);
		return $tpl->show();
	}
	
	
	
	public function addSeveralVars( $vars)
	{
		$this->tplVars = array_merge($this->tplVars, $vars);
	}
	
	public function addVar($name, $value)
	{
		$this->tplVars[$name] = $value;
	}
	
	public function render( $show = true )
	{
		$tpl = new Template();
		$dir = $this->dirBase . $this->dir;
		$tpl->setDir($dir);
		$tpl->setTemplate($this->templateBase);
		
		$c = new Credentials();
		if ($c->isLogged())
		{
			$n = $c->getCredentials();
			$this->tplVars["NombreUsuario"] = $n->Nombre . " ". $n->Apellido . " | <a href=\"?logout=true\">Cerrar Sesi&oacute;n</a>";
		}
		
		$tpl->setVars($this->tplVars);
		$content = $tpl->show();
		if ($show)
		{
			echo $content;
		}
		else
		{
			return $content;
		}
	}
}


?>