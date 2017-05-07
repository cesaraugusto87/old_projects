<?php
   include('../../../funciones/conexion.php');
   include('../../../funciones/transformfecha.php');
   $conexion = Conectarse();
   $sql_profesor ="select * from profesor Order by Nombre"; 
   $resultado_profesor  = mysql_query($sql_profesor , $conexion);
   $row_profesor  = mysql_fetch_assoc($resultado_profesor );
   $totalregistros = mysql_num_rows($resultado_profesor);  
   include('../../../fpdf/fpdf.php');
   class PDF extends FPDF{
      //Cabecera de página
      function Header(){
          //Logo
	        $this->Image('../../../images/LOGOTRANS.jpg',27,12,20);
	        //Arial bold 15
	        $this->SetFont('Arial','B',8);
	        //Movernos a la derecha
	        $this->Cell(70);
	        //Título
	        $this->Text(82,18,'Republica Bolivariana de Venezuela');
  	        $this->Text(67,21,'Instituto Nacional de Capacitacion Educativa y Socialista.');
   	        $this->Text(76,24,'Centro de Formacion Socialista Manuel Piar');
	        $this->Text(89,27,'" Programa Informatica "');

            $this->SetLineWidth(0.4);
	        $this->SetDrawColor(100,100,100);  
	        $this->Line(10,32,195,32);
	        $this->Cell(70);
            //Título
			$this->SetFont('Times','',10); 
	        $this->Text(83,36,'Listado Aspirantes a Profesores');

	        $this->SetLineWidth(0.4);
	        $this->SetDrawColor(100,100,100);  
	        $this->Line(10,38,195,38);

            //Salto de línea
	        $this->Ln(33);
         }
      
	     //Pie de página
         function Footer(){
            $this->SetLineWidth(0.4);
	        $this->SetDrawColor(100,100,100);  
	        $this->Line(10,283,195,283);
            //Posición: a 1,5 cm del final
	        $this->SetY(-15);
	        //Arial italic 8
	        $this->SetFont('Arial','I',8);
	        //Número de página
	        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'R');
         }
      }
      
	  //Creación del objeto de la clase heredada
      $pdf=new PDF();
      $pdf->AliasNbPages();
      $pdf->AddPage();
      $pdf->SetFont('Times','',6);        	  
      if ($totalregistros > 0){         
		 $pdf->SetFont('Times','',10);   
		 $i=1;
		 $pdf->Cell(10);
         $pdf->Cell(5,7,'No',1,0,'C');
         $pdf->Cell(45,7,'Nombre',1,0,'C');
         $pdf->Cell(14,7,'Cedula',1,0,'C');
         $pdf->Cell(18,7,'Telefono',1,0,'C');
		 $pdf->Cell(45,7,'Profesion',1,0,'C');
         $pdf->Cell(40,7,'E-mail',1,0,'C');
         $pdf->Ln();
	     do { 
		    if (($i ==31)or($i ==61)or($i ==91)or($i ==121)or($i ==151)or($i ==181)or($i ==211)or($i ==241)or($i ==271)){
		       $pdf->AddPage();
               $pdf->Cell(10);
               $pdf->SetFont('Times','',10);   
               $pdf->Cell(5,7,'No',1,0,'C');
               $pdf->Cell(45,7,'Nombre',1,0,'C');
               $pdf->Cell(14,7,'Cedula',1,0,'C');
               $pdf->Cell(18,7,'Telefono',1,0,'C');
		       $pdf->Cell(45,7,'Profesion',1,0,'C');
               $pdf->Cell(40,7,'E-mail',1,0,'C');
               $pdf->Ln();
		    }
            $pdf->SetFont('Times','',8);   
            $pdf->Cell(10);
            $pdf->Cell(5,7,$i,1,0,'C');
            $pdf->Cell(45,7,$row_profesor['Nombre'].' '.$row_profesor['Apellido'],1,0,'L');
            $pdf->Cell(14,7,$row_profesor['Cedula'],1,0,'C');
			$pdf->Cell(18,7,$row_profesor['Telf'],1,0,'C');		    
			$sql_profesion="SELECT * FROM titulo where (IdTitulo='".$row_profesor['Titulo']."')";
            $resultado_profesion = mysql_query ($sql_profesion, $conexion);
			$row_profesion  = mysql_fetch_assoc($resultado_profesion);
			$pdf->Cell(45,7,$row_profesion['Descripcion'],1,0,'C');
			$pdf->Cell(40,7,$row_profesor['Email'],1,0,'C');
	        $pdf->Ln();  
	        $i=$i+1;
	     }while ($row_profesor  = mysql_fetch_assoc($resultado_profesor));
      }else{  
	    $pdf->SetFont('Times','',10);         
        $pdf->Text(20,50,'* Actualmente No Existen Profesores Registrados en el Sistema.......');         
		$pdf->SetFont('Times','',6);   
      }		 
      $pdf->Output();   
   	  
?>
