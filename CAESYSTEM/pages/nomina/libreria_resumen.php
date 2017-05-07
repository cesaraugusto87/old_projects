<?php
include('../../fpdf/fpdf.php');
include('../../conexion/conexion.php');
include('funciones.php');

class PDF extends FPDF
{

function Header()
{
	//Cabacera
	global $title;


	$this->SetFont('Arial','B',15);
	$w=$this->GetStringWidth($title)+6;
	$this->SetX((210-$w)/2);
	$this->SetDrawColor(0,80,180);
	$this->SetFillColor(230,230,0);
	$this->SetTextColor(220,50,50);
	$this->SetLineWidth(1);
	$this->Cell($w,9,$title,0,1,'C',false);
	$this->Ln(10);
	//Guardar ordenada
	$this->y0=$this->GetY();
}

function Footer()
{
    //Posición a 1,5 cm del final
    $this->SetY(-15);
    //Arial itálica 8
    $this->SetFont('Arial','I',8);
    //Color del texto en gris
    $this->SetTextColor(128);
    //Número de página
    $this->Cell(0,10,'Página '.$this->PageNo(),0,0,'C');
}
//Tabla coloreada
function FancyTable($header,$result)
{
	//Colores, ancho de línea y fuente en negrita
$this->SetFillColor(221,221,221);
       $this->SetTextColor(0);
       $this->SetDrawColor(128,0,0);
	   	$this->SetLineWidth(.3); 
	$this->SetFont('','B');
	//Cabecera
	$w=array(35,35,35);
	for($i=0;$i<count($header);$i++)
		$this->Cell($w[$i],7,$header[$i],1,0,'C',1);
	$this->Ln();
	//Restauración de colores y fuentes
	$this->SetFillColor(224,235,255);
	$this->SetTextColor(0);
	$this->SetFont('');
	//Datos
	$fill=false;
	if ($result)
	while($row = pg_fetch_row($result))
	{
		$this->Cell($w[0],7,$row[0],'LR',0,'L',$fill);
		$this->Cell($w[1],7,$row[1],'LR',0,'L',$fill);
		$this->Cell($w[2],7,($row[2]),'LR',0,'R',$fill);
		$this->Ln();
		$fill=!$fill;
	}
	$this->Cell(array_sum($w),0,'','T');
}
}

$link = Conectarse();

$dia1="01";
if ($_GET['mes']== "01" or $_GET['mes']== "03" or $_GET['mes']== "05" or $_GET['mes']== "07" or $_GET['mes']== "08" or $_GET['mes']== "10" or $_GET['mes']== "12"){
$dia2="31";
$dia2="30";} 
else{
$dia2="28";}
$inicial= $dia1."/".$_GET['mes']."/".$_GET['ayo'];
$fin= $dia2."/".$_GET['mes']."/".$_GET['ayo'];
$query="select sum(monto),sum(bonos),sum(prestamos) from sueldo_detalle where fecha between '".$inicial."' and '".$fin."'";
$result = pg_query($link,$query);
//$result = pg_query ( $link , "SELECT * FROM personal" ); 
$pdf=new PDF();
//Títulos de las columnas
$header=array('Total Neto','Total Asignaciones','Total Deducciones');
//Carga de datos
$title='Resumen de Nomina';
$pdf->SetTitle($title);
$pdf->SetFont('Arial','',10);
$pdf->AddPage();
$pdf->FancyTable($header,$result);
$pdf->Output();


?>
