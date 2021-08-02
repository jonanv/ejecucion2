<?php 
set_time_limit (240000000);
require('fpdf.php');
require('conexion.php');


class PDF extends FPDF
{
	var $widths;
	var $aligns;
	
	
	function SetWidths($w)
	{
		//Set the array of column widths
		$this->widths=$w;
	}
	
	function SetAligns($a)
	{
		//Set the array of column alignments
		$this->aligns=$a;
	}
	
	function Row($data)
	{
		//Calculate the height of the row
		$nb=0;
		for($i=0;$i<count($data);$i++)
			$nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
		$h=5*$nb;
		//Issue a page break first if needed
		$this->CheckPageBreak($h);
		//Draw the cells of the row
		for($i=0;$i<count($data);$i++)
		{
			$w=$this->widths[$i];
			$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
			//Save the current position
			$x=$this->GetX();
			$y=$this->GetY();
			//Draw the border
			
			//CIERRO ESTA LINEA PARA QUE NO SAQUE BORDES EN LA TABLA
			//$this->Rect($x,$y,$w,$h);
	
			$this->MultiCell($w,5,$data[$i],0,$a,'true');
			//Put the position to the right of the cell
			$this->SetXY($x+$w,$y);
		}
		//Go to the next line
		$this->Ln($h);
	}
	
	function CheckPageBreak($h)
	{
		//If the height h would cause an overflow, add a new page immediately
		if($this->GetY()+$h>$this->PageBreakTrigger)
			$this->AddPage($this->CurOrientation);
	}
	
	function NbLines($w,$txt)
	{
		//Computes the number of lines a MultiCell of width w will take
		$cw=&$this->CurrentFont['cw'];
		if($w==0)
			$w=$this->w-$this->rMargin-$this->x;
		$wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
		$s=str_replace("\r",'',$txt);
		$nb=strlen($s);
		if($nb>0 and $s[$nb-1]=="\n")
			$nb--;
		$sep=-1;
		$i=0;
		$j=0;
		$l=0;
		$nl=1;
		while($i<$nb)
		{
			$c=$s[$i];
			if($c=="\n")
			{
				$i++;
				$sep=-1;
				$j=$i;
				$l=0;
				$nl++;
				continue;
			}
			if($c==' ')
				$sep=$i;
			$l+=$cw[$c];
			if($l>$wmax)
			{
				if($sep==-1)
				{
					if($i==$j)
						$i++;
				}
				else
					$i=$sep+1;
				$sep=-1;
				$j=$i;
				$l=0;
				$nl++;
			}
			else
				$i++;
		}
		return $nl;
	}
	
	function Header()
	{
	
		
		//$this->SetFont('Arial','',10);
		//$this->Text(110,14,'REPÚBLICA DE COLOMBIA',0,'C', 0);
		//$this->Ln(20);
		//$this->Image('escudo.jpg' , 20 ,20, 0 , 0,'JPG', '');
		//$this->Text(110,24,'OFICINA DE EJECUCIÓN CIVIL MUNICIPAL',0,'C', 0);
		//$this->Text(120,54,'MANIZALES - CALDAS',0,'C', 0);
	}
	
	function Footer()
	{
	
		/*$this->SetY(-60);
		$this->SetFont('Arial','B',8);
		$this->Image('nfirmasecre.jpg' ,null,null,50 ,15,'JPG','');
		$this->Cell(0,6,'ANDRES GRAJALES DELGADO',0,1,'C');
		$this->Cell(0,6,'SECRETARIO',0,1,'C');*/
		
		
		
		$this->SetY(-15);
		$this->SetFont('Arial','B',8);
		$this->Cell(100,10,'Código: F-TLC-01                                                                           Versión: 01',0,1,'L',0,0,'L');
	
	}
	
	

}

//GENERAR PDF	
$con = new DB;

$pdf=new PDF('P','mm','letter');
$pdf->Open();


$datospartes_m110 = explode("******",trim($_GET['datospartes_m110']));
$longtras110      = count($datospartes_m110);
$x                = 1;

/*$pdf->AddPage();
$pdf->SetMargins(20,20,20);
$pdf->Ln(10);
$pdf->SetFont('Arial','',7);
$pdf->Cell(0,6,trim($_GET['datospartes_m110']),0,1,'C');
$pdf->Ln(10);
$pdf->Cell(0,6,$longtras110,0,1,'C');*/

setlocale(LC_TIME, "Spanish");

while($x < $longtras110){

	$datospartes_m110_B = explode("//////",$datospartes_m110[$x]);
	
	$id                 = trim($datospartes_m110_B[1]);
	$fechafijacion      = trim($datospartes_m110_B[2]);
	$fechainicial       = trim($datospartes_m110_B[3]);			
	$fechafinal         = trim($datospartes_m110_B[4]);
	
	
	$pdf->AddPage();
	$pdf->SetMargins(20,20,20);
	
	//SE REALIZA ESTA PREGUNTA PARA QUE EL ESCUDO NO SE
	//DESUBIQUE EN LAS PAGINAS SIGUIENTES A LA PAGINA 1
	if($x == 1){
		$pdf->Ln(10);
	}
	
	$pdf->SetFont('Arial','',12);

	$pdf->Cell(0,6,'REPÚBLICA DE COLOMBIA',0,1,'C');
	$pdf->Image('escudo.jpg' , 95 ,30, 0 , 0,'JPG', '');
	$pdf->Ln(30);
	$pdf->Cell(0,6,'OFICINA DE EJECUCIÓN CIVIL MUNICIPAL',0,1,'C');
	$pdf->Cell(0,6,'MANIZALES - CALDAS',0,1,'C');
	$pdf->Ln(2);
	
	$pdf->Cell(0,6,'TRASLADO EN LISTA 110',0,1,'C');
	$pdf->Ln(10);
	
	
	$canalsql = $con->conectar();	
					
	$strConsulta = "SELECT cp.nombre,ubi.demandante,ubi.demandado,ubi.radicado
					FROM (ubicacion_expediente ubi LEFT JOIN pa_clase_proceso cp ON ubi.idclase_proceso = cp.id)
					WHERE ubi.id = '$id'";				
		
	$canalsql = mysql_query($strConsulta);
	$numfilas = mysql_num_rows($canalsql);
		
	for ($i=0; $i<$numfilas; $i++){
		
		
		$pdf->SetWidths(array(60, 70, 15, 35, 16, 20, 16, 21, 21, 20, 20, 10));
		
		$fila = mysql_fetch_array($canalsql);
		$pdf->SetFont('Arial','',10);
		
		$pdf->SetFillColor(255,255,255);
		$pdf->SetTextColor(0);
		
		
	
		$pdf->Row(array('PROCESO: ', $fila['nombre']));	
		$pdf->Ln(10);
		$pdf->Row(array('DEMANDANTE: ' , $fila['demandante']));
		$pdf->Ln(10);	
		$pdf->Row(array('DEMANDADO: ' , $fila['demandado']));
		$pdf->Ln(10);
		$pdf->Row(array('RADICADO: ' , $fila['radicado']));	
		$pdf->Ln(10);
		$pdf->Row(array('ASUNTO: ' , 'LIQUIDACIÓN DEL CRÉDITO'));
		$pdf->Ln(10);
		
		$fecha = strftime('%d de %B del %Y', strtotime($fechafijacion));  
		$pdf->Row(array('FIJACÓN: ' , $fecha));	
		
		$pdf->Ln(10);
		$pdf->Row(array('TRASLADO: ' , 'TRES(3) DÍAS'));
		$pdf->Ln(5);
		
		$fecha  = strftime('%d de %B del %Y', strtotime($fechainicial));
		$fechab = strftime('%d de %B del %Y', strtotime($fechafinal));
		$pdf->Row(array('', 'Término que empieza a correr el '.$fecha.' a las 8:00 a.m. y vence el '.$fechab.', a las 6:00 p.m.'));
		
		$pdf->Ln(20);
		
		//$pdf->Image('escudo.jpg' , X ,Y, LARGO , ANCHO,'JPG', '');
		//$pdf->Image('nfirmasecre.jpg' , 82 ,202, 50 , 20,'JPG', '');
		
		$pdf->Cell(0,6,'ANDRES GRAJALES DELGADO',0,1,'C');
		$pdf->Cell(0,6,'SECRETARIO',0,1,'C');
		
		
		
		
		
	}
	
	$x = $x + 1;
	
}
	

$pdf->Output();

?>




