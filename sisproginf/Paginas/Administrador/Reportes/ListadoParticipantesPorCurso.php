<?php
   $id   = $_POST['CampoCurso'];
   $sec  = $_POST['CampoOferta'];
   if (($id == "0")or($sec == "0")or($id == "")or($sec == "")){
      echo "<script>alert('No se pudo Generar Reporte...');</script>";	
      echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
	  echo "window.location.href= '../Buzon/Reportes.php'";	   
	  echo "</script>";	
   }else{
      include('../../../funciones/conexion.php');
      include('../../../funciones/transformfecha.php');
      $conexion = Conectarse();
	  $sql_curso_base="select * from curso where (IdCurso='".$id."')"; 
      $resultado_curso_base = mysql_query($sql_curso_base, $conexion);
      $row_cursos_Base = mysql_fetch_assoc($resultado_curso_base);
      $sql_pre="select * from preinscripcion  where ((IdCurso='".$id."')and(Secuencia='".$sec."'))"; 
      $resultado_pre = mysql_query($sql_pre, $conexion);
      $row_pre = mysql_fetch_assoc($resultado_pre);
      $totalregistros = mysql_num_rows($resultado_pre);   
      $sql_oferta="select * from ofertacurso where ((IdCursos='".$id."')and(Secuencia='".$sec."'))"; 
      $resultado_oferta = mysql_query($sql_oferta, $conexion);
      $row_oferta_curso = mysql_fetch_assoc($resultado_oferta);
      $sql_par="select * from participantes where (Cedula='".$row_pre['CedulaUsuario']."')"; 
      $resultado_par = mysql_query($sql_par, $conexion);
      $row_par = mysql_fetch_assoc($resultado_par);
      $totalregistros = mysql_num_rows($resultado_par);      
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
	        $this->Text(20,36,'Curso'); 
	        $this->Text(20,39,'Descripcion');   
	        $this->Text(20,42,'Secuencia');   
			$this->Text(20,45,'Inicio');   
			$this->Text(20,48,'Fin');   
			$this->Text(20,51,'Duracion');   
			$this->Text(20,54,'Cupos');   
			$this->Text(20,57,'Inscritos');   
			
			$this->SetLineWidth(0.4);
	        $this->SetDrawColor(100,100,100);  
	        $this->Line(10,59,195,59);
			
 	        $this->Text(90,62,'Listado de Participantes');

	        $this->SetLineWidth(0.4);
	        $this->SetDrawColor(100,100,100);  
	        $this->Line(10,63,195,63);

            //Salto de línea
	        $this->Ln(60);
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
	  $pdf->Text(43,36,$row_cursos_Base['Nombre']);
  	  $pdf->Text(43,39,$row_cursos_Base['Descripcion']);
  	  $pdf->Text(43,42,$sec);
	  $pdf->Text(43,45,cambiaf_a_normal($row_oferta_curso['FechaIni']));
 	  $pdf->Text(43,48,cambiaf_a_normal($row_oferta_curso['FechaFin']));
  	  $pdf->Text(43,51,$row_oferta_curso['Duracion']);
	  $pdf->Text(43+$pdf->GetStringWidth($row_oferta_curso['Duracion']),51,' Horas');
   	  $pdf->Text(43,54,$row_oferta_curso['Cupos']);
      $pdf->Text(43,57,$totalregistros);         
      if ($totalregistros > 0){ 
         $i=1;
		 $pdf->SetFont('Times','',6);   
         $pdf->Cell(20);
         $pdf->Cell(8,7,'No',1,0,'C');
         $pdf->Cell(50,7,'Nombre',1,0,'C');
         $pdf->Cell(15,7,'Cedula',1,0,'C');
         $pdf->Cell(20,7,'Telefono',1,0,'C');
         $pdf->Cell(60,7,'E-mail',1,0,'C');
         $pdf->Ln();
	     do { 
	        $pdf->Cell(20);
            $pdf->Cell(8,7,$i,1,0,'C');
            $pdf->Cell(50,7,$row_par['Nombre'].' '.$row_par['Apellido'],1,0,'L');
            $pdf->Cell(15,7,$row_par['Cedula'],1,0,'C');
			$pdf->Cell(20,7,$row_par['Telf'],1,0,'C');
			$pdf->Cell(60,7,$row_par['Email'],1,0,'C');
	        $pdf->Ln();  
	        $i=$i+1;
	     }while ($row_par = mysql_fetch_assoc($resultado_par));
      }else{  
	    $pdf->SetFont('Times','',10);         
        $pdf->Text(20,70,'* Actualmente No Existen Estudiantes Pre-Inscritos para este Curso....');         
		$pdf->SetFont('Times','',6);   
      }		 
      $pdf->Output();   
   }	  
?>
