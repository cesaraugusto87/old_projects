<?php
include('../../fpdf/fpdf.php');
include('../../conexion/conexion.php');
include('funciones.php');

class PDF extends FPDF
{
//Tabla coloreada
function FancyTable($monto, $w1, $w2, $w3, $prestamo, $row1, $row2, $row3, $monto1, $ficha)
{
	//Colores, ancho de línea y fuente en negrita
	$this->SetFillColor(221,221,221);
    $this->SetTextColor(0);
    $this->SetDrawColor(128,0,0);
	$this->SetLineWidth(.3);
	$this->SetFont('','B');
	//Cabecera
	$this->Ln();
	$this->Cell(120,7,"Listin de Pago, Nro de Ficha: ".$ficha,0,0,'C',false);
	$this->Ln();
	$this->Ln();
	$this->Cell(60,7,"Asignacion (Bsf.)",1,0,'C',1);
	$this->Cell(80,7,"Deducciones  (Bsf.)",1,0,'C',1);
	$this->Ln();
	//Restauración de colores y fuentes
	$this->SetFillColor(224,235,255);
	$this->SetTextColor(0);
	$this->SetFont('');
	//Datos
	$fill=false;
	$this->Cell(30,7,"Sueldo: ",1,0,'R',$fill);
	$this->Cell(30,7,number_format($monto),1,0,'R',$fill);
	$this->Cell(70,7,'Seguro Social: ',1,0,'R',$fill);
	$this->Cell(10,7,number_format($w1),1,0,'R',$fill);
	$this->Ln();
	$this->Cell(30,7,"Bono: ",1,0,'R',$fill);
	$this->Cell(30,7,number_format($bono),1,0,'R',$fill);
	$this->Cell(70,7,"Ley de Politica Habitacional: ",1,0,'R',$fill);
	$this->Cell(10,7,number_format($w2),1,0,'R',$fill);
	$this->Ln();
	$this->Cell(30,7,"",0,0,'R',$fill);
	$this->Cell(30,7,"",0,0,'R',$fill);
	$this->Cell(70,7,"Paro Forsozo: ",1,0,'R',$fill);
	$this->Cell(10,7,number_format($w3),1,0,'R',$fill);
	$this->Ln();
	$this->Cell(30,7,"",0,0,'R',$fill);
	$this->Cell(30,7,"",0,0,'R',$fill);
	$this->Cell(70,7,"Prestamos: ",1,0,'R',$fill);
	$this->Cell(10,7,number_format($prestamo),1,1,'R',$fill);
	$this->Ln();
	$fill=!$fill;
	$this->Cell(30,7,"Nombre ",1,0,'C',1);
	$this->Cell(30,7,"Apellido",1,0,'C',1);
	$this->Cell(30,7,"Cargo",1,0,'C',1);
	$this->Cell(30,7,"Neto a Pagar",1,0,'C',1);
	$this->Ln();
	$this->Cell(30,7,$row1,1,0,'R',$fill);
	$this->Cell(30,7,$row2,1,0,'R',$fill);
	$this->Cell(30,7,$row3,1,0,'R',$fill);
	$this->Cell(30,7,number_format($monto1),1,0,'R',$fill);
	$this->Ln();
}
}
$pdf=new PDF();
$pdf->SetFont('Arial','',12);
$pdf->AddPage();
if ($_POST['corte']){
if ($_POST['bono'])
$bono=$_POST['bono'];
else
$bono=0;
$link = Conectarse();
if (date("m")==02)
	$dia=28;
else
	$dia=30;
$fechaActual = date ("m/Y");
$fechaActual1 = date ("d/m/Y");
$consulta = "SELECT fecha FROM sueldo_detalle where (fecha >='01/".$fechaActual."' and fecha <= '".$dia."/".$fechaActual."') and corte = '".$_POST['corte']."'";
$result = pg_query($link,$consulta);
$row = pg_fetch_row($result);
$consulta = "SELECT fecha FROM sueldo_detalle where fecha ='".$fechaActual1."'";
$result2 = pg_query($link,$consulta);
$row2 = pg_fetch_row($result2);
if (!$row && !$row2){
$consulta = "select sueldos.monto_hora, empleados.ficha from   personal, empleados, sueldos where personal.cedula = empleados.cedula and empleados.id_nivel = sueldos.id_nivel;";
$result1 = pg_query($link,$consulta);
$add=0;
while ($row1 = pg_fetch_row($result1)){
$add++;
if ($add==4){
$pdf->AddPage();
$add=0;
}
$monto = $row1[0]/2;
$ficha = $row1[1];
$result = pg_query($link, "select porcentaje from bonos_y_debitos");
if ($result)
$i=0;
	while($row = pg_fetch_row($result))
	{
		$w[$i]=$monto * $row[0]; 
		$i++;
	}
$fecha = date("d/m/Y");
if ($_POST['corte']==30)
$consulta = "select monto from prestamos where id_ficha ='".$ficha."' and fecha >='16/".$fechaActual."' and fecha <= '".$dia."/".$fechaActual."'";
else
$consulta = "select monto from prestamos where id_ficha ='".$ficha."' and fecha >='01/".$fechaActual."' and fecha <= '15/".$fechaActual."'";
$result = pg_query($link, $consulta);
$prestamo=0;
while($row = pg_fetch_row($result))
{
		$prestamo=$prestamo + $row[0]; 
}
$monto1 = $monto - $w[0] - $w[1] - $w[2] - $prestamo + $bono;
$consulta = "INSERT INTO sueldo_detalle(
            ficha, fecha, monto, bonos, prestamos, corte)
    VALUES ('".$ficha."', '".$fecha."', '".$monto1."','".$bono."','".$prestamo."','".$_POST['corte']."');";
pg_query($link,$consulta);

$consulta = "select personal.nombres, personal.apellidos, cargo.descripcion, sueldo_detalle.monto 
from   personal, empleados, cargo, sueldo_detalle
where personal.cedula = empleados.cedula and empleados.id_cargo = cargo.id_cargo and empleados.ficha = sueldo_detalle.ficha and empleados.ficha = '".$ficha."'";
$result = pg_query($link,$consulta);
$row = pg_fetch_row($result);
$pdf->FancyTable($monto,$w[0],$w[1],$w[2], $prestamo, $row[0], $row[1], $row[2], $monto1, $ficha);
}}}
$pdf->Output();
?>
