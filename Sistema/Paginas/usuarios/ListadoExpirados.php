<?php

include('../../fpdf/fpdf.php');
class PDF extends FPDF{
   //Cabecera de página
   function Header(){
      //Logo
	  $this->Image('../../images/logo.jpg',27,12,20);
	  //Arial bold 15
	  $this->SetFont('Arial','B',8);
	  //Movernos a la derecha
	  $this->Cell(70);
	  //Título
	  $this->Text(82,18,'Banco Guayana, C.A.');
  	  $this->Text(67,21,'');
   	  $this->Text(70,24,'Gerencia de Infraestructura Tecnologica');

	  $this->SetLineWidth(0.4);
	  $this->SetDrawColor(100,100,100);  
	  $this->Line(10,32,195,32);
	  
	  $this->Cell(70);
	  //Título
	  $this->Text(78,36,'Listado de Cartuchos Expirados.');

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
	  $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'R');
   }   
}

//Creación del objeto de la clase heredada
$pdf=new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',10);  
   include('../../funciones/conexion.php');
   include('../../funciones/transformfecha.php');
   $conexion = Conectarse();
   
   $fecha_act = date(d."/".m."/".Y);
   $sql = " select  * from cartuchos where fecha_exp <= '".$fecha_act."' "; 
   
   $resultado = pg_query($sql);
   $row_listado = pg_fetch_assoc($resultado);
   $totalregistros   = pg_num_rows($resultado);     
   if ($totalregistros > 0){ 
      $i=1;
      $pdf->Cell(1);
      $pdf->Cell(30,5,'Id Inicializacion',1,0,'C');
      $pdf->Cell(10,5,'Nº',1,0,'C');
      $pdf->Cell(16,5,'Modelo',1,0,'C');
      $pdf->Cell(22,5,'Fecha Inicio',1,0,'C');
	  $pdf->Cell(22,5,'Fecha Fin',1,0,'C');
	  $pdf->Cell(20,5,'Ubicacion',1,0,'C');
	  $pdf->Cell(50,5,'Observaciones',1,0,'C');
	  $pdf->Cell(12,5,'Tipo',1,0,'C');
      $pdf->Ln();
	  do { 
	     if (($i ==31)or($i ==61)or($i ==91)or($i ==121)or($i ==151)or($i ==181)or($i ==211)or($i ==241)or($i ==271)){
		    $pdf->AddPage();
            $pdf->SetFont('Times','',7); 
			$pdf->Cell(1);
     	 	$pdf->Cell(30,5,'Id Inicializacion',1,0,'C');
      		$pdf->Cell(10,5,'Nº',1,0,'C');
      		$pdf->Cell(16,5,'Modelo',1,0,'C');
      		$pdf->Cell(22,5,'Fecha Inicio',1,0,'C');
      		$pdf->Cell(22,5,'Fecha Fin',1,0,'C');
      		$pdf->Cell(20,5,'Ubicacion',1,0,'C');
      		$pdf->Cell(50,5,'Fecha Observaciones',1,0,'C');
      		$pdf->Cell(12,5,'Tipo',1,0,'C');			
            $pdf->Ln();
		 }
		 $sqlPre=" select  * from cartuchos where fecha_exp <= '".$fecha_act."' "; 		
         $resultadopre = pg_query($sqlPre);
		 $data = pg_fetch_assoc($resultadopre);

         $pdf->Cell(1);
		 $pdf->SetFont('Times','',7);
	     $pdf->Cell(30,5,$data['idinicializacion'],1,0,'C');
		 $pdf->Cell(10,5,$data['numero_cartuchos'],1,0,'C');
		 $pdf->Cell(16,5,$data['id_mod'],1,0,'C');
		 $pdf->Cell(22,5,$data['fecha_ini'],1,0,'C');
		 $pdf->Cell(22,5,$data['fecha_fin'],1,0,'C');
		 $pdf->Cell(20,5,$data['id_ubicacion'],1,0,'C');
 		 $pdf->Cell(50,5,$data['observaciones'],1,0,'C');
 		 $pdf->Cell(12,5,$data['tipo'],1,0,'C');
	     $pdf->Ln();  
	     $i=$i+1;
	  }while($row_listado = pg_fetch_assoc($resultado));
   }else{
      $pdf->SetFont('Times','',10);         
      $pdf->Text(20,40,'* Actualmente No Existen Cartuchos Expirados en el Sistema....');
	  $pdf->SetFont('Times','',6);   
   }		 
$pdf->Output();   
?>
