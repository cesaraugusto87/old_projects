<?php

include('../../../fpdf/fpdf.php');
class PDF extends FPDF{
   //Cabecera de página
   function Header(){
      //Logo
	  $this->Image('../../../Archivos/logo.jpg',27,12,20);
	  //Arial bold 15
	  $this->SetFont('Arial','B',8);
	  //Movernos a la derecha
	  $this->Cell(70);
	  //Título
	  $this->Text(82,18,'Republica Bolivariana de Venezuela');
  	  $this->Text(67,21,'Ministerio Para el Poder Popular de la educacion');
   	  $this->Text(76,24,'Colegio Nuestra Señora de Lourdes');

	  $this->SetLineWidth(0.4);
	  $this->SetDrawColor(100,100,100);  
	  $this->Line(10,32,195,32);
	  
	  $this->Cell(70);
	  //Título
	  $this->Text(78,36,'Listado Estudiantes Con Deuda.');

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
   
   $sql_oferta=" select idestudiante from pago where tipo = 'No' "; 
   
   $resultado_oferta = mysql_query($sql_oferta);
   $row_oferta_curso = mysql_fetch_assoc($resultado_oferta);
   $totalregistros   = mysql_num_rows($resultado_oferta);     
   if ($totalregistros > 0){ 
      $i=1;
      $pdf->Cell(8);
      $pdf->Cell(50,7,'Nombre',1,0,'C');
      $pdf->Cell(50,7,'Apellido',1,0,'C');
      $pdf->Cell(22,7,'Telefono',1,0,'C');
      $pdf->Cell(18,7,'Cedula',1,0,'C');
      $pdf->Cell(30,7,'CI Representante',1,0,'C');
      $pdf->Ln();
	  do { 
	     if (($i ==31)or($i ==61)or($i ==91)or($i ==121)or($i ==151)or($i ==181)or($i ==211)or($i ==241)or($i ==271)){
		    $pdf->AddPage();
            $pdf->SetFont('Times','',7); 
			$pdf->Cell(8);
     	 	$pdf->Cell(50,7,'Nombre',1,0,'C');
      		$pdf->Cell(50,7,'Apellido',1,0,'C');
      		$pdf->Cell(22,7,'Telefono',1,0,'C');
      		$pdf->Cell(18,7,'Cedula',1,0,'C');
      		$pdf->Cell(30,7,'CI Representante',1,0,'C');
            $pdf->Ln();
		 }
		 $sqlPre="Select * from estudiantes Where (Idestudiante='".$row_oferta_curso['idestudiante']."')"; 		
         $resultadopre = mysql_query($sqlPre, $conexion);
		 $data = mysql_fetch_assoc($resultadopre);

         $pdf->Cell(8);
		 $pdf->SetFont('Times','',7);
	     $pdf->Cell(50,7,$data['nombre'],1,0,'C');
		 $pdf->Cell(50,7,$data['apellidos'],1,0,'C');
		 $pdf->Cell(22,7,$data['telefono'],1,0,'C');
		 $pdf->Cell(18,7,$data['ci'],1,0,'C');
		 $pdf->Cell(30,7,$data['ci_representante'],1,0,'C');
	     $pdf->Ln();  
	     $i=$i+1;
	  }while($row_oferta_curso = mysql_fetch_assoc($resultado_oferta));
   }else{
      $pdf->SetFont('Times','',10);         
      $pdf->Text(20,40,'* Actualmente No Existen Deudas en el Sistema....');
	  $pdf->SetFont('Times','',6);   
   }		 
$pdf->Output();   
?>
