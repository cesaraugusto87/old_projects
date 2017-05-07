<?php

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
	  $this->Text(78,36,'Programacion Ordinaria Programa Informatica.');

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
   
   $sql_oferta="select * from ofertacurso where (Status=1) order by IdCursos,Secuencia Asc"; 
   $resultado_oferta = mysql_query($sql_oferta, $conexion);
   $row_oferta_curso = mysql_fetch_assoc($resultado_oferta);
   $totalregistros   = mysql_num_rows($resultado_oferta);     
   if ($totalregistros > 0){ 
      $i=1;
      $pdf->Cell(8);
      $pdf->Cell(8,7,'No',1,0,'C');
      $pdf->Cell(93,7,'Curso',1,0,'C');
      $pdf->Cell(15,7,'Secuencia',1,0,'C');
      $pdf->Cell(13,7,'Inicio',1,0,'C');
      $pdf->Cell(13,7,'Fin',1,0,'C');
      $pdf->Cell(12,7,'Cupos',1,0,'C');
      $pdf->Cell(15,7,'Inscritos',1,0,'C');
      $pdf->Ln();
	  do { 
	     if (($i ==31)or($i ==61)or($i ==91)or($i ==121)or($i ==151)or($i ==181)or($i ==211)or($i ==241)or($i ==271)){
		    $pdf->AddPage();
            $pdf->SetFont('Times','',7); 
			$pdf->Cell(8);
            $pdf->Cell(8,7,'No',1,0,'C');
            $pdf->Cell(93,7,'Curso',1,0,'C');
            $pdf->Cell(15,7,'Secuencia',1,0,'C');
            $pdf->Cell(13,7,'Inicio',1,0,'C');
            $pdf->Cell(13,7,'Fin',1,0,'C');
            $pdf->Cell(12,7,'Cupos',1,0,'C');
            $pdf->Cell(15,7,'Inscritos',1,0,'C');
            $pdf->Ln();
		 }
	     //Para sacar el Nombre del Curso
	     $sql = "select * from curso where (IdCurso='".$row_oferta_curso['IdCursos']."')"; 
         $resultado = mysql_query($sql, $conexion);
         $row_curso = mysql_fetch_assoc($resultado);
		 //Para Calcular Cuantos Inscritos existen para Esta Curso
		 $sqlPre="Select * from preinscripcion Where ((IdCurso='".$row_oferta_curso['IdCursos']."')and(Secuencia='".$row_oferta_curso['Secuencia']."'))"; 		
         $resultadopre = mysql_query($sqlPre, $conexion);
         $totalregistrospre = mysql_num_rows($resultadopre); 
         $pdf->Cell(8);
		 $pdf->Cell(8,7,$i,1,0,'C');
		 $pdf->SetFont('Times','',7);
	     $pdf->Cell(93,7,$row_curso['Nombre'],1,0,'L');
		 $pdf->Cell(15,7,$row_oferta_curso['Secuencia'],1,0,'C');
		 $pdf->Cell(13,7,cambiaf_a_normal($row_oferta_curso['FechaIni']),1,0,'C');
		 $pdf->Cell(13,7,cambiaf_a_normal($row_oferta_curso['FechaFin']),1,0,'C');
		 $pdf->Cell(12,7,$row_oferta_curso['Cupos'],1,0,'C');
         $pdf->Cell(15,7,$totalregistrospre,1,0,'C');
	     $pdf->Ln();  
	     $i=$i+1;
	  }while($row_oferta_curso = mysql_fetch_assoc($resultado_oferta));
   }else{
      $pdf->SetFont('Times','',10);         
      $pdf->Text(20,40,'* Actualmente No Existen Cursos Activos en el Sistema....');
	  $pdf->SetFont('Times','',6);   
   }		 
$pdf->Output();   
?>
