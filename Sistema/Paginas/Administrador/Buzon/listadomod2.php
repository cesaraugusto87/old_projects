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
   	  $this->Text(70,24,'Gerencia de Infraestructura Tecnologica');

	  $this->SetLineWidth(0.4);
	  $this->SetDrawColor(100,100,100);  
	  $this->Line(10,32,195,32);
	  
	  $this->Cell(70);
	  //Título
	  $this->Text(70,36,'Listado de Cartuchos');

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
   include('../../../funciones/conexion.php');
   include('../../../funciones/transformfecha.php');
   $conexion = Conectarse();
   
   $mod = $_POST['mod_cart'];
   
   $sql_oferta = "Select operador,reporte_secuencia,id_mod,idinicializacion,observaciones,id_ubicacion,numero_cartuchos,num_cartucho2,id_nomenclatura,fecha_ini,fecha_fin,fecha_exp,idnomenclatura,estante,id_frecuencia,cuerpo,tramo,boveda,gaveta,consecutivo from cartuchos, id_sistema where id_nomenclatura = idnomenclatura And id_mod = '".$mod. "' order by id_mod,fecha_ini,estante,cuerpo,tramo,boveda,gaveta"; 	
   
   $resultado_oferta = pg_query($sql_oferta);
   $row_oferta_curso = pg_fetch_assoc($resultado_oferta);
   $totalregistros   = pg_num_rows($resultado_oferta);   
   if ($totalregistros > 0){ 
      $i=1;
	  $pdf->SetFont('Times','',7);
      $pdf->Cell(1);
      $pdf->Cell(27,5,'Id Inicializacion',1,0,'C');
      $pdf->Cell(8,5,'Nº',1,0,'C');
      $pdf->Cell(20,5,'Fec Inicio',1,0,'C');
	  $pdf->Cell(20,5,'Fec Fin',1,0,'C');
	  $pdf->Cell(16,5,'Modelo',1,0,'C');
	  $pdf->Cell(30,5,'Ubicacion',1,0,'C');
	  $pdf->Cell(45,5,'Observacion',1,0,'C');
	  $pdf->Cell(12,5,'Lugar',1,0,'C');
	  $pdf->Cell(12,5,'Cons',1,0,'C');
      $pdf->Ln();
	  do { 
	     if (($i ==46)or($i ==92)or($i ==138)or($i ==184)or($i ==230)or($i ==276)or($i ==322)or($i ==368)or($i ==414)){
		    $pdf->AddPage();
            $pdf->SetFont('Times','',7); 
			$pdf->Cell(1);
     	 	$pdf->Cell(27,5,'Id Inicializacion',1,0,'C');
      		$pdf->Cell(8,5,'Nº',1,0,'C');      
      		$pdf->Cell(20,5,'Fec Inicio',1,0,'C');
      		$pdf->Cell(20,5,'Fec Fin',1,0,'C');
			$pdf->Cell(16,5,'Modelo',1,0,'C');
      		$pdf->Cell(30,5,'Ubicacion',1,0,'C');
      		$pdf->Cell(45,5,'Observacion',1,0,'C');
      		$pdf->Cell(12,5,'Lugar',1,0,'C');
			$pdf->Cell(12,5,'Cons',1,0,'C');			
            $pdf->Ln();
		 }
		 
		  
         $pdf->Cell(1);
		 $pdf->SetFont('Times','',7);
	     $pdf->Cell(27,5,$row_oferta_curso['idinicializacion'],1,0,'C');
		 $pdf->Cell(8,5,$row_oferta_curso['numero_cartuchos'],1,0,'C');
		 $pdf->Cell(20,5,$row_oferta_curso['fecha_ini'],1,0,'C');
		 $pdf->Cell(20,5,$row_oferta_curso['fecha_fin'],1,0,'C');
 		 $pdf->Cell(16,5,$row_oferta_curso['id_mod'],1,0,'C');
		 if ($row_oferta_curso['cuerpo']<> "")
		 $pdf->Cell(30,5,"Cuerpo:". $row_oferta_curso['cuerpo']. " Tramo:". $row_oferta_curso['tramo']. "Estante: ".$row_oferta_curso['estante'] ,1,0,'C');
 		 else
		 $pdf->Cell(30,5,"Boveda:". $row_oferta_curso['boveda']. " Gaveta:". $row_oferta_curso['gaveta'] ,1,0,'C');
		 $pdf->Cell(45,5,$row_oferta_curso['observaciones'],1,0,'C');
 		 $pdf->Cell(12,5,$row_oferta_curso['id_ubicacion'],1,0,'C');
		 $pdf->Cell(12,5,$row_oferta_curso['consecutivo'],1,0,'C');
	     $pdf->Ln();  
	     $i=$i+1;
	  }while($row_oferta_curso = pg_fetch_assoc($resultado_oferta));
   }else{
      $pdf->SetFont('Times','',10);         
      $pdf->Text(20,40,'* Actualmente No Existen Cartuchos bajo ese parametro Registrados en el Sistema....');
	  $pdf->SetFont('Times','',6);   
   }		 
$pdf->Output();   
?>
