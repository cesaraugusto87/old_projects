<?php
include('../../fpdf/fpdf.php');
include('../../conexion/conexion.php');
include('funciones.php');

function Consulta($x, $y, $z)
{
	if ($z==03)
	{
	$consulta= "select empleados.ficha, personal.nombres, personal.apellidos, personal.cedula, empleados.fecha_inicio, cargo.descripcion, estado.descripcion, 
sueldo_detalle.monto, sueldo_detalle.fecha from  personal, empleados, cargo, sueldo_detalle, estado
where (sueldo_detalle.fecha between '".$x."' and '".$y."') and personal.cedula = empleados.cedula and empleados.id_cargo = cargo.id_cargo and empleados.ficha = sueldo_detalle.ficha and empleados.id_estado=estado.id_estado
order by sueldo_detalle.fecha, empleados.ficha";
}
else
	{
	
	$consulta= "select empleados.ficha, personal.nombres, personal.apellidos, personal.cedula, empleados.fecha_inicio, cargo.descripcion, estado.descripcion, 
sueldo_detalle.monto, sueldo_detalle.fecha from  personal, empleados, cargo, sueldo_detalle, estado
where (sueldo_detalle.fecha between '".$x."' and '".$y."') and empleados.id_estado='".$z."' and personal.cedula = empleados.cedula and empleados.id_cargo = cargo.id_cargo and empleados.ficha = sueldo_detalle.ficha and empleados.id_estado=estado.id_estado
order by sueldo_detalle.fecha, empleados.ficha";

}

return $consulta;
}


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
	$w=array(15,30,25,25,70,20,20,20,20);
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
		$this->Cell($w[0],8,$row[0],'LR',0,'L',$fill);
		$this->Cell($w[1],8,$row[1],'LR',0,'L',$fill);
		$this->Cell($w[2],8,($row[2]),'LR',0,'L',$fill);
		$this->Cell($w[3],8,number_format($row[3]),'LR',0,'R',$fill);
		$this->Cell($w[4],8,($row[5]),'LR',0,'R',$fill);
		$this->Cell($w[5],8,($row[6]),'LR',0,'R',$fill);
		$this->Cell($w[6],8,(fechas($row[4])),'LR',0,'R',$fill);
		$this->Cell($w[7],8,($row[7]),'LR',0,'R',$fill);
		$this->Cell($w[8],8,($row[8]),'LR',0,'R',$fill);
		$this->Ln();
		$fill=!$fill;
	}
	$this->Cell(array_sum($w),0,'','T');
}
}

$link = Conectarse();
$inicio= $_GET['inicio'];
$fin= $_GET['fin'];
$estado= $_GET['estado'];
$consulta=Consulta($inicio, $fin, $estado);
$result = pg_query($link, $consulta);
$pdf=new PDF();
$header=array('Ficha','Nombre','Apellido','Cedula','Cargo','Activo','A. Antig.','Sueldo','Fecha');

$title='Listado Total de Nomina, Desde: '.$inicio.' Hasta: '.$fin;
$pdf->SetTitle($title);
$pdf->SetFont('Arial','',10);
$pdf->AddPage('L');
$pdf->FancyTable($header,$result);
$pdf->Output();


?>
