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
	  
	  $this->Cell(60);
	  //Título
	  $this->Text(78,36,'Estadistica General del Sistema SISPROGINF');

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
$pdf->SetFont('Times','',7);
   include('../../../funciones/conexion.php');
   include('../../../funciones/transformfecha.php');
   $conexion = Conectarse();
   
   $sql_ParcicipanteRegistradoM       =  "select * from participantes where (Genero='M')"; 
   $resultado_ParcicipanteRegistradoM =  mysql_query($sql_ParcicipanteRegistradoM,$conexion);
   $ParcicipanteRegistradoM           =  mysql_affected_rows ($conexion);
   if($ParcicipanteRegistradoM < 0){
      $ParcicipanteRegistradoM=0;
   }
   $sql_ParcicipanteRegistradoF       =  "select * from participantes where (Genero='F')"; 
   $resultado_ParcicipanteRegistradoF =  mysql_query($sql_ParcicipanteRegistradoF, $conexion);
   $ParcicipanteRegistradoF           =  mysql_affected_rows ($conexion);
   if($ParcicipanteRegistradoF < 0){
      $ParcicipanteRegistradoF=0;
   }
   
    $sql_participantes ="SELECT Cedula FROM participantes where (Genero='M')"; 
    $resultado_participantes  = mysql_query($sql_participantes , $conexion);
    $row_participantes  = mysql_fetch_assoc($resultado_participantes );
    $totalregistros = mysql_num_rows($resultado_participantes);  	  
    if ($totalregistros > 0){	   
	   $ParcicipantesInsM=0;
	   do{
          $sql_pre ="SELECT * FROM preinscripcion where (CedulaUsuario = '".$row_participantes['Cedula']."')"; 
          $resultado_pre  = mysql_query($sql_pre , $conexion);
          $row_pre  = mysql_fetch_assoc($resultado_pre );
          $totalregistros_pre = mysql_num_rows($resultado_pre);  	  
          if($totalregistros_pre > 0){
		     $ParcicipantesInsM=$ParcicipantesInsM+1;
		  }
	   }while ($row_participantes  = mysql_fetch_assoc($resultado_participantes));     
	}   
	
	
	$sql_participantes ="SELECT Cedula FROM participantes where (Genero='F')"; 
    $resultado_participantes  = mysql_query($sql_participantes , $conexion);
    $row_participantes  = mysql_fetch_assoc($resultado_participantes );
    $totalregistros = mysql_num_rows($resultado_participantes);  	  
    if ($totalregistros > 0){	   
	   $ParcicipantesInsF=0;
	   do{
          $sql_pre ="SELECT * FROM preinscripcion where (CedulaUsuario = '".$row_participantes['Cedula']."')"; 
          $resultado_pre  = mysql_query($sql_pre , $conexion);
          $row_pre  = mysql_fetch_assoc($resultado_pre );
          $totalregistros_pre = mysql_num_rows($resultado_pre);  	  
          if($totalregistros_pre > 0){
		     $ParcicipantesInsF=$ParcicipantesInsF+1;
		  }
	   }while ($row_participantes  = mysql_fetch_assoc($resultado_participantes));     
	}   
   
   $pdf->Cell(50);
   $pdf->Cell(105,7,'Estadistica General Participantes',1,0,'C');
   $pdf->Ln();
   $pdf->Cell(50);
   $pdf->Cell(15,7,'GENERO',1,0,'C');
   $pdf->Cell(40,7,'PARTICIPANTES REGISTRADOS',1,0,'C');
   $pdf->Cell(50,7,'PARTICIPANTES INSCRITOS EN CURSOS',1,0,'C');
   $pdf->Ln();
   $pdf->Cell(50);
   $pdf->Cell(15,7,'Masculino',1,0,'C');
   $pdf->Cell(40,7,$ParcicipanteRegistradoM,1,0,'C');
   $pdf->Cell(50,7,$ParcicipantesInsM,1,0,'C');
   $pdf->Ln();
   $pdf->Cell(50);
   $pdf->Cell(15,7,'Femenino',1,0,'C');
   $pdf->Cell(40,7,$ParcicipanteRegistradoF,1,0,'C');
   $pdf->Cell(50,7,$ParcicipantesInsF,1,0,'C');
   $pdf->Ln(); 
   $pdf->Cell(50);
   $pdf->Cell(15,7,'TOTAL',1,0,'C');
   $pdf->Cell(40,7,$ParcicipanteRegistradoF+$ParcicipanteRegistradoM,1,0,'C');
   $pdf->Cell(50,7,$ParcicipantesInsF+$ParcicipantesInsM,1,0,'C');
   $pdf->Ln();    
   $pdf->Ln(); 
   
   $sql_ProfesoresRegistradoM       =  "select * from profesor where ((Genero='M')or(Genero='Masculino'))"; 
   $resultado_ProfesoresRegistradoM =  mysql_query($sql_ProfesoresRegistradoM,$conexion);
   $ProfesoresRegistradoM           =  mysql_affected_rows ($conexion);
   if(ProfesoresRegistradoM < 0){
      $ProfesoresRegistradoM = 0;
   }
   $sql_ProfesoresRegistradoF       =  "select * from profesor where ((Genero='F')or(Genero='Femenino'))"; 
   $resultado_ProfesoresRegistradoF =  mysql_query($sql_ProfesoresRegistradoF,$conexion);
   $ProfesoresRegistradoF           =  mysql_affected_rows ($conexion);
   if(ProfesoresRegistradoF < 0){
      $ProfesoresRegistradoF=0;
   }
   $pdf->Cell(70);
   $pdf->Cell(55,7,'Estadistica General Aspirantes a Facilitador',1,0,'C');
   $pdf->Ln();
   $pdf->Cell(70);
   $pdf->Cell(15,7,'GENERO',1,0,'C');
   $pdf->Cell(40,7,'ASPIRANTES REGISTRADOS',1,0,'C');
   $pdf->Ln();
   $pdf->Cell(70);
   $pdf->Cell(15,7,'Masculino',1,0,'C');
   $pdf->Cell(40,7,$ProfesoresRegistradoM,1,0,'C');
   $pdf->Ln();
   $pdf->Cell(70);
   $pdf->Cell(15,7,'Femenino',1,0,'C');
   $pdf->Cell(40,7,$ProfesoresRegistradoF,1,0,'C');
   $pdf->Ln(); 
   $pdf->Cell(70);
   $pdf->Cell(15,7,'TOTAL',1,0,'C');
   $pdf->Cell(40,7,$ProfesoresRegistradoM+$ProfesoresRegistradoF,1,0,'C');
   $pdf->Output();   
?>
<html>
   <head>
      <title>
	      Reporte: -- Programacion Docente Programa Informatica -- CFS. MANUEL PIAR -- PTO ORDAZ.
	  </title>
   </head>
   <body>
   </body> 
</html>