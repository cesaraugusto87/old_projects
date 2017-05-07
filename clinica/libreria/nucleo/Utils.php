<?php
/*****************************************
@  Copyright (c) 2006 Duxpoint			
								
Clase: 		Utils.
Comentarios:	Clase Abstracta; innecesario
			crear objeto a partir de ella
Autor(es):		Maikel Salazar
Versión: 		0.2					
Fechas:		Creacion: 03-Julio-2006
			Modificado: 06-Agosto-2006	
Propietario: 	danmaik.com			
*****************************************/
	class Utils{
		
		function foundBot ()
		{
		
			$botlist = array(   
		                "Teoma",                   
		                "alexa",
		                "froogle",
		                "inktomi",
		                "looksmart",
		                "URL_Spider_SQL",
		                "Firefly",
		                "NationalDirectory",
		                "Ask Jeeves",
		                "TECNOSEEK",
		                "InfoSeek",
		                "WebFindBot",
		                "girafabot",
		                "crawler",
		                "www.galaxy.com",
		                "Googlebot",
		                "Scooter",
		                "Slurp",
		                "appie",
		                "FAST",
		                "WebBug",
		                "Spade",
		                "ZyBorg",
		                "rabaz"); 

			$key = array_search($_SERVER["HTTP_USER_AGENT"],$botlist);
			if ($key === false)
			{
				return false;
			}
			
			return $botlist[$key];
	    
		}
		
		
		function getIP()
		{
			if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) { $ip = $_SERVER['HTTP_X_FORWARDED_FOR']; }  
			elseif (isset($_SERVER['HTTP_VIA'])) { $ip = $_SERVER['HTTP_VIA']; }  
			elseif (isset($_SERVER['REMOTE_ADDR'])) { $ip = $_SERVER['REMOTE_ADDR']; }
			else { $ip = "Desconocido"; }
			return $ip;
		}
		function isDate( $Subject = "" )
		{
			return (preg_match("/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/", $Subject)==1);
		}
		function isDateTime( $Subject = "")
		{
			return (preg_match("/^[0-9]{4}-[0-9]{2}-[0-9]{2} [0-9]{2}:[0-9]{2}:[0-9]{2}$/", $Subject)==1);
		}
		/*********************************************************************************************************************************
			Method Name: strRandom
			Type: Public  Method. 
			Param(s): max, opcionales: min y sStr
			Description: Genera un cadena aleatoria desde min a max
					Si min no esta definida es 0, en caso de que este definida sera ese el valor de comienzo
					Si Sstr esta definida la cadena aleatoria sera a partir de ella
			Return Value:  - una cadena aleatoria.
		**********************************************************************************************************************************/		
		function strRandom ($max,$min= 0, $str = NULL){
			// Validaciones contra Luser´s
			if (isset($str) || (!is_string($str))){
				$String = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz234567890";
			} else{
				$String = $str;
			}
			$min = abs(round($min));
			$max = abs(round($max));
			$carac = explode("\xff" , chunk_split( $String, 1, "\xff" )); 
			srand (time());
			shuffle($carac);
			$random="";
			$carac = implode("",$carac);
			$random = substr($carac, $min, $max-$min);
			return $random;
		}
		/*********************************************************************************************************************************
			Method Name: strCleanSpaces
			Type: Public  Method. 
			Param(s): sStr
			Description: Elimina todos los espacios en blanco de la cadena que recibe por el argumento
			Return Value:  - Una cadena sin espacios en blanco
		**********************************************************************************************************************************/
		function strCleanSpaces( $string = "" ){
			return (preg_replace( '/\s/S' , "" , $string ));	
		}
		/*********************************************************************************************************************************
			Method Name: strIsEmpty
			Type: Public  Method. 
			Param(s): sStr
			Description: verifica si la cadena pasada por el argumento esta vacia, se considera vacia si solo tiene espacions en blanco, retorno de carro, etc.
			Return Value:  - True si la cadena esta vacia
			                         - False si la cadena al menos tiene un caracter que no sea espacio en blanco.
		**********************************************************************************************************************************/
		function strIsEmpty( $string = "" ){
			return (Utils::strCleanSpaces( $string ) == "");
		}
		/*********************************************************************************************************************************
			Method Name: strIsValidate
			Type: Public  Method. 
			Param(s): cualquier cantidad de cadenas
			Description: verifica si los argumentos es de tipo cadena y adicionalmente que la misma no este vacia, se considerara vacia segun los criterios del 
			                     metodo str_is_empty.
			Return Value:  - True si sStr es de tipo cadena y no esta vacia.
			                         - False si sStr no es una cadena o esta vacia.
		**********************************************************************************************************************************/		
		function strIsValidate ( ){
			if (!$Arguments = func_get_args()){
				return false; //No Arguments
			}
			foreach ($Arguments as $String){
				if ((!is_string($String)) || (Utils::strIsEmpty($String))){
					return false;
				}
			}
			return true;
		}
		
		/*********************************************************************************************************************************
			Method Name: strIsEmail
			Type: Public  Method. 
			Param(s): sEmail
			Description: verifica si el argumento es de tipo cadena y adicionalmente que la misma no este vacia, se considerara vacia segun los criterios del 
			                     metodo str_is_empty.
			Return Value:  - True si sStr es de tipo cadena y no esta vacia.
			                         - False si sStr no es una cadena o esta vacia.
		**********************************************************************************************************************************/
		function isEmail( $Email = "" ) {
			return (preg_match("/^[\w.%-]+@[\w.%-]+\.[[:alpha:]]{2,6}$/", $Email)==1);
		}
		function strCleanWord( $subject = "" ){
			$regex =  array ( 
					'/\s+/',      // Cualquier espacio entre letras
       				'/^\s+/',      // Cualquier espacio al principio 
       				'/\s+$/s');		// Cualquier espacio al final
			$replacement = array (" ", // sustituye a un espacio
		                      "",  // elimina el espacio
							  ""); // elimina el espacio
			return preg_replace( $regex, $replacement, $subject );
		}
		/*********************************************************************************************************************************
			Method Name: isInteger
			Type: Public  Method. 
			Param(s): subject
			Description: Verifica si los argumentos son numeros enteros, el argumento puede ser una cadena, valido para verificar los datos recibidos por los 
			metodos POST y GET :D ^^
			Return Value:  
					- True:  
						> Si todos los argumentos son numeros enteros, considerando numero entero a: ####
					- False: 
						>Si alguno de los argumentos no es numero, considerando un numero NO entero a : ####.# o algo mas
					(*)  NULL se considera que NO es un numero, por lo tanto, retornará false si mSubject es NULL.	     
		**********************************************************************************************************************************/		

		function isInteger(   )
		{
			if (!$Arguments = func_get_args())
			{
				return false; //No Arguments
			}
			foreach ($Arguments as $subject)
			{
				if (!preg_match("/^[\d]+$/",$subject) or is_bool($subject))
				{
					return false;
				}
			}		
			return true;
		}
		function isNumber(  )
		{
			if (!$Arguments = func_get_args())
			{
				return false; //No Arguments
			}
			foreach ($Arguments as $subject)
			{
				if (  ( !Utils::isFloat( $subject ) )  )
				{
					return false;
				}
			}		
			return true;
		}
		/*********************************************************************************************************************************
			Method Name: IsFloat
			Type: Public  Method. 
			Param(s):  	- subject: String or Number
					- restrict Boolean
			Description:  Verifica si el argumento es un numero punto flotante, el argumento puede ser una cadena, valido para verificar los datos recibidos 
			por los metodos POST y GET :D ^^
			Return Value:  
					- True: 
						> Si  restrict es false(por defecto) se verificara como entero o punto flotante.
						> Si restrict es true se verificara que el argumento este expresado como punto flotante.
						(*)  Considerando Punto Flotante: ##.#
					- False: 
						> Si no es numero punto flotante, dependiendo el valor de restrict, segun lo expuesto anteriormente.
					(*)  NULL se considera que NO es un numero, por lo tanto, retornará false si subject es NULL.
		**********************************************************************************************************************************/		
		function isFloat( $subject = NULL , $restrict = false)
		{
			if ($restrict)
			{
				$regex = "/^[\d]+\.[\d]+$/";
			} 
			else
			{
				$regex = "/(^[\d]+\.[\d]+$)|(^[\d]+$)/";
			}
			return (preg_match($regex,$subject)==1) and (!is_bool($subject));//retorna un booleano literal!
		}
		
		public static function fixFloat($iaNumber)
		{
			$ilInteger = ceil($iaNumber);
			return ($ilInteger==$iaNumber)?$ilInteger:$iaNumber;
		}
		
		function concatArray( $fields, $separator , $mode=-1)
		{
			$set = array();
			switch ( $mode )
			{
				case 0: // key(s) and value(s)
						foreach( $fields as $field => $value )
						{
							array_push($set,"`$field` = '$value'");
						}
						break;
				case 1: // key(s)
						$set =  array_keys( $fields );
						break;
				case 2: //value(s) and key(s)
						foreach( $fields as $field => $value )
						{
							array_push($set,"$value = 'field'");
						}
						break;
				default: //value(s)
						foreach( $fields as $value )
						{
							array_push( $set , "$value");
						}
						break;
						
			}
			return implode( $separator , $set );
		}
		
		/*
			Esta funcion pertenece a  http://www.ilovejackdaniels.com/php/php-datediff-function/
		*/
		
		function datediff($interval, $datefrom, $dateto, $using_timestamps = false) 
		{
			 /*
			 $interval can be:
			 yyyy - Number of full years
			 q - Number of full quarters
			 m - Number of full months
			 y - Difference between day numbers
			 (eg 1st Jan 2004 is "1", the first day. 2nd Feb 2003 is "33". The datediff is "-32".)
			 d - Number of full days
			 w - Number of full weekdays
			 ww - Number of full weeks
			 h - Number of full hours
			 n - Number of full minutes
			 s - Number of full seconds (default)
			 */
			  if (!$using_timestamps) {
			 $datefrom = strtotime($datefrom, 0);
			 $dateto = strtotime($dateto, 0);
			 }
			 $difference = $dateto - $datefrom; // Difference in seconds

			 switch($interval) {

			 case 'yyyy': // Number of full years
			  
			 $years_difference = floor($difference / 31536000);
			 if (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom), date("j", $datefrom), date("Y", $datefrom)+$years_difference) > $dateto) {
			 $years_difference--;
			 }
			 if (mktime(date("H", $dateto), date("i", $dateto), date("s", $dateto), date("n", $dateto), date("j", $dateto), date("Y", $dateto)-($years_difference+1)) > $datefrom) {
			 $years_difference++;
			 }
			 $datediff = $years_difference;
			 break;
			  
			 case "q": // Number of full quarters
			  
			 $quarters_difference = floor($difference / 8035200);
			 while (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom)+($quarters_difference*3), date("j", $dateto), date("Y", $datefrom)) < $dateto) {
			 $months_difference++;
			 }
			 $quarters_difference--;
			 $datediff = $quarters_difference;
			 break;
			  
			 case "m": // Number of full months
			  
			 $months_difference = floor($difference / 2678400);
			 while (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom)+($months_difference), date("j", $dateto), date("Y", $datefrom)) < $dateto) {
			 $months_difference++;
			 }
			 $months_difference--;
			 $datediff = $months_difference;
			 break;
			  
			 case 'y': // Difference between day numbers
			  
			 $datediff = date("z", $dateto) - date("z", $datefrom);
			  break;
			   
			  case "d": // Number of full days
			   
			  $datediff = floor($difference / 86400);
			  break;
			   
			  case "w": // Number of full weekdays
			   
			  $days_difference = floor($difference / 86400);
			  $weeks_difference = floor($days_difference / 7); // Complete weeks
			  $first_day = date("w", $datefrom);
			  $days_remainder = floor($days_difference % 7);
			  $odd_days = $first_day + $days_remainder; // Do we have a Saturday or Sunday in the remainder?
			  if ($odd_days > 7) { // Sunday
			  $days_remainder--;
			  }
			  if ($odd_days > 6) { // Saturday
			  $days_remainder--;
			  }
			  $datediff = ($weeks_difference * 5) + $days_remainder;
			  break;
			   
			  case "ww": // Number of full weeks
			   
			  $datediff = floor($difference / 604800);
			  break;
			   
			  case "h": // Number of full hours
			   
			  $datediff = floor($difference / 3600);
			  break;
			   
			  case "n": // Number of full minutes
			   
			  $datediff = floor($difference / 60);
			  break;
			   
			  default: // Number of full seconds (default)
			   
			  $datediff = $difference;
			  break;
			  }
			  return $datediff;
		}
	}
?>