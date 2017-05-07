<?php
/* FileManager
*****************************************************************************
@  Copyright (c) 2006 danmaik 

Autor(es):  Dano(www.danonino.org) y Maik (www.escasala.com)
Propósito: controlador de archivos(subir y bajar) y directorios(lectura)
Version:  0.21 
Fecha: 06 Jul 2006
Actualizada: 17 Ago  2006
Requirimientos:
	PHP Version >= 5
	Plantillas text.tpl, flash.tpl, image.tpl
*****************************************************************************
*/
class FileManager
{
	//Propiedades Privadas
	private $Icons = array ("tpl","fla", "txt","pdf","php","png","zip","as","ppt","xls","doc","swf");
	
	//extensiones permitidas - allowed extensions
	private $Extensions; 

	//Propiedades Publicas
	public $BaseFolder;
	public $PATH;
	
	public function __construct()
	{
		$this->Extensions = array();
	}
	
	public function upload( $File )
	{
		if ( $this->allowedExtension( $File['name'] ) )
		{
			$newFile = $this->BaseFolder . $this->PATH . "/" . basename($File['name']);
			return ( @move_uploaded_file($File['tmp_name'], $newFile) );			
		}
		return false;
	}
	
	public function removeFile ( $filename)
	{
		if ( $this->allowedExtension( $filename ) )
		{
			$newFile = $this->BaseFolder . $this->PATH . "/" . basename($filename);
			if ($this->fileExists($filename))
			{
				return ( @unlink($newFile) );			
			}
			else
			{
				return -1;
			}
		}
		return 0;
	}
	
	
	public function fileExists(	$filename)
	{
		$path = $this->BaseFolder . $this->PATH . "/" . $filename;
		return is_file($path);
	}
	
	public function download( $File )
	{
		if ($this->allowedExtension( $File ) )
		{
			$filename = basename($File);
			$File = $this->BaseFolder . $this->PATH . "/" . $filename;
			if ( file_exists( $File )  )
			{
				header("Pragma: public");
				header('Expires: '.gmdate('D, d M Y H:i:s').' GMT');
				header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
				header("Cache-Control: private",false);
				header("Content-Type: application/force-download");
				header('Content-Disposition: attachment; filename="'. $filename .'"');
				header("Content-Transfer-Encoding: binary");
				header('Content-Length: '.filesize( $File ));
				set_time_limit(0);
				readfile( $File );
				exit;
			}
		}
		return false;
	}		
	
	public function addExtension ( $Extension = NULL )
	{
		if ( !is_array($this->Extensions) )
		{
			return false;
		}		
		
		if ( is_array( $Extension ) )
		{
			$this->Extensions = array_merge($this->Extensions, $Extension);
		} 
		else
		{
			array_push($this->Extensions, $Extension);
		}
		//$this->Extension = array_walk($this->Extensions, "strtolower");
		return true;
	}
	
	
	
	public function removeExtension( $RemExtension= NULL)
	{
		if ( !is_array( $this->Extensions ) )
		{
			return false;
		}
		$newExt = array();
		if (!is_array($RemExtension))
		{
			$RemExtension = array($RemExtension);
		}
		foreach($this->Extensions as $extension )
		{
			if (!in_array($extension, $RemExtension))
			{
				array_push($newExt,$extension);
			}
		}
		$this->Extensions = $newExt;
		return true;
	}

	public function setExtension ( $Extension )
	{
		if (!is_array( $Extension ) )
		{
			$Extension = array($Extension);
			
		}
		//$Extension = array_walk($Extension, "strtolower");
		$this->Extensions = $Extension;
	}
	
	public function allowedExtension ( $File )
	{
		if (!is_array($this->Extensions))
		{
			$this->Extensions = array( );
		}
		$path = pathinfo( $File );
		$Extension = $path["extension"];
		if (count($this->Extensions)>0)
		{
			$Extension = strtolower($Extension);
			return in_array($Extension, $this->Extensions );
		}
		return true;
	}
		
		//$rDir=3  listara  todo el arbol de directorio
		//$rDir=2 solo archivos y directorios de raiz
		//$rDir=1  solo archivos de archivos
		//$rDir=0 solo directorios de raiz
	public function readDir($dir, $rDir = 0, $realName = false ){
		if (!is_dir($dir)){
			return false;
		}
		$cDir = dir ($dir); //cDir = current dir;
		if (!$realName)
		{
			$dirname = " ".self::dirName($dir);
		} 
		else
		{
			$dirname = $dir;
		}
		$carpeta[$dirname] = array();
		while (false !== ($file = $cDir->read()))
		{
			if ( ($file != ".") and ($file != "..") )
			{
				$isDir = is_dir($dir."/".$file);
				if ( ( $isDir ) and ($rDir == 3) )
				{
					$carpeta[$dirname] = array_merge( $carpeta[$dirname],self::readDir( $dir . "/" .$file, $rDir) );
				} 
				else if ( ( $isDir ) and ( $rDir > 1 ) )
				{
					$carpeta[$dirname][$file] = array();
				} 
				else if ( ( $isDir ) and ( $rDir == 0 ) )
				{
					$carpeta[$dirname][$file] = array();
				} 
				else if ( (!$isDir)  and ($this->allowedExtension($file) )  and ($rDir != 0))
				{
					$carpeta[$dirname][] = $file;
				}
				
			}
		}
		$cDir->close();
		return $carpeta;
	}
	
	private function dirName ( $dir )
	{
		$dir = realpath( $dir );
		$pos = strrpos( $dir , "\\" ); //Windows
		if ($pos === false)
		{
			$pos = strrpos( $dir ,"/"); //Linux :)
		}
		$dir = substr( $dir,$pos+1,strlen($dir)-$pos );
		return $dir;
	}
	
	public function saveFile($filename, $content)
	{
		//$filename = "records-" . date("Y-m-d-h-i-s") . "." . self::EXT;
		$File = $this->BaseFolder . $this->PATH . "/" . $filename;
		//chdir()
		$gestor = @fopen($File, "w");
		if ($gestor!==false)
		{
			fwrite($gestor, $content);
			fclose($gestor);
			return true;
		}
		return false;
		
	}

	public function showTree( $dir , $path = NULL)
	{
		if (!is_array($dir))
		{
			return false;
		}

		$var= "<ul>\n";
		foreach ($dir as $key => $value)
		{
			if (is_array($value))
			{
				$dirName = substr( $key , 1 , strlen( $key ) );
				$var.="\t<li class=\"dir\">$dirName</li>\n";
				$var.=self::showTree($value,$path."/".$dirName);
			} 
			else
			{
				$path= str_replace($this->BaseFolder . $this->PATH,"",$path);
					$icon = $this->setIcon($value);
				$var.="\t<li class=\"$icon\"><a href=\"".$_SERVER['PHP_SELF']."?file=".htmlentities($path."/".$value)."\">".$value."</a></li>\n";
			}
		}
		$var.= "</ul>\n";
		return $var;
	}
	
	public function setIcon ( $file )
	{
		if ( !is_array($this->Icons ) )
		{
			return false;
		}		
		$path = pathinfo( $file );
		if (in_array($path["extension"],$this->Icons))
		{
			return $path["extension"];
		}
		return "unknown";
	}
}
?>