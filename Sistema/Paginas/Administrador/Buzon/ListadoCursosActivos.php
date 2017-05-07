<?php

include('../../../fpdf/fpdf.php');
class PDF extends FPDF{
   //Cabecera de página
   function Header(){
      //Logo
	  $this->Image('../../../images/logo.jpg',27,12,20);
	  //Arial bold 15
	  $this->SetFont('Arial','B',8);
	  //Movernos a la derecha
	  $this->Cell(70);
	  //Título
	  $this->Text(82,18,'Banco Guayana, C.A.');
  	  $this->Text(67,21,'');
   	  $this->Text(76,24,'Gerencia de Infraestructura Tecnologica');

	  $this->SetLineWidth(0.4);
	  $this->SetDrawColor(100,100,100);  
	  $this->Line(10,32,195,32);
	  
	  $this->Cell(70);
	  //Título
	  $this->Text(78,36,'Listado de Cartuchos Prestados a Centro Alterno.');

	  $this->SetLineWidth(0.4);
	  $this->SetDrawColor(100,100,100);  
	  $this->Line(10,38,195,38);

	  //Salto de línea
	  $this->Ln(35);
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
$pdf->SetFont('Times','',10);  
   include('../../../funciones/conexion.php');
   include('../../../funciones/transformfecha.php');
   $conexion = Conectarse();
   
   $sql_oferta=" select  * from cartuchos_prestamo "; 
   
   $resultado_oferta = pg_query($sql_oferta);
   $row_oferta_curso = pg_fetch_assoc($resultado_oferta);
   $totalregistros   = pg_num_rows($resultado_oferta);     
   if ($totalregistros > 0){ 
      $i=1;
      $pdf->Cell(8);
      $pdf->Cell(50,7,'Nº Cartuchos',1,0,'C');
      $pdf->Cell(50,7,'Id Inicializacion',1,0,'C');
      $pdf->Cell(22,7,'Plomo',1,0,'C');
      $pdf->Cell(30,7,'Ubicacion Original',1,0,'C');
      $pdf->Ln();
	  do { 
	     if (($i ==31)or($i ==61)or($i ==91)or($i ==121)or($i ==151)or($i ==181)or($i ==211)or($i ==241)or($i ==271)){
		    $pdf->AddPage();
            $pdf->SetFont('Times','',7); 
			$pdf->Cell(8);
     	 	$pdf->Cell(50,7,'Nº Cartuchos',1,0,'C');
      		$pdf->Cell(50,7,'Id Inicializacion',1,0,'C');
      		$pdf->Cell(22,7,'Plomo',1,0,'C');
      		$pdf->Cell(30,7,'Ubicacion Original',1,0,'C');
            $pdf->Ln();
		 }
		 $sqlPre="Select * from cartuchos_prestamo "; 		
         $resultadopre = pg_query($sqlPre);
		 $data = pg_fetch_assoc($resultadopre);

         $pdf->Cell(8);
		 $pdf->SetFont('Times','',7);
	     $pdf->Cell(50,7,$data['numero_cartuchos'],1,0,'C');
		 $pdf->Cell(50,7,$data['id_inicializacion'],1,0,'C');
		 $pdf->Cell(22,7,$data['id_plomo'],1,0,'C');
		 $pdf->Cell(30,7,$data['id_ubicacion'],1,0,'C');
	     $pdf->Ln();  
	     $i=$i+1;
	  }while($row_oferta_curso = pg_fetch_assoc($resultado_oferta));
   }else{
      $pdf->SetFont('Times','',10);         
      $pdf->Text(20,40,'* Actualmente No Existen Cartuchos Prestados en el Sistema....');
	  $pdf->SetFont('Times','',6);   
   }		 
$pdf->Output();   
?>
