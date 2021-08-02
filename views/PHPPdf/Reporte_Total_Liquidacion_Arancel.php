<?php 
session_start(); 
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
			$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'R';
			//Save the current position
			$x=$this->GetX();
			$y=$this->GetY();
			//Draw the border
			
			//CIERRO ESTA LINEA PARA QUE NO SAQUE BORDES EN LA TABLA
			$this->Rect($x,$y,$w,$h);
	
			$this->MultiCell($w,5,$data[$i],1,$a,'true');
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
	
		$this->Ln(30);
		$this->Image('encabezado.jpg' , 8 ,20,200,30,'JPG', '');

	}
	
	function Footer()
	{
		//$this->SetY(-15);
		//$this->Image('piepagina2.jpg' , 45 ,245, 0 , 0,'JPG', '');
		
		$this->SetY(-15);
		$this->SetFont('Arial','B',8);
		$this->Cell(100,10,"Imprime: ".$_SESSION['nombre'],0,0,'L');
		$this->SetY(-12);
		$this->Cell(100,15,"Código: F-FA-01                                                                                           Versión: 01",0,0,'L');
		
	
	}
	
}

//GENERAR PDF	
$con = new DB;

//$idusuario = $_SESSION['idUsuario'];
	
/*$datos     = trim($_GET['datos']);

$datosreporte = explode("******",$datos);

$idl          = $datosreporte[0]; 
$numl         = $datosreporte[1]; */

$tfiltro = trim($_GET['tfiltro']);

$fechad    = trim($_GET['dato_1']);
$fechah    = trim($_GET['dato_2']);
			
$datox1    = trim($_GET['datox1']);
$datox2    = trim($_GET['datox2']);

//-----------------------------------DATOS GENERALES---------------------------------------
//ME PERMITE CARGAR DATOS COMO MENSAJES

/*$canalsql = $con->conectar();	

				
$strConsulta = "SELECT al.id,al.numl,al.fechal,ap.radicado,ap.juzgadoorigen,al.observacionl,pj.nombre
				FROM ((arancel_liquidacion al INNER JOIN arancel_proceso ap ON al.idradicadol = ap.id)
                INNER JOIN pa_juzgado pj ON ap.juzgadoorigen = pj.id)
                WHERE al.numl = '$numl'";
                
				
$canalsql = mysql_query($strConsulta);
$fila     = mysql_fetch_array($canalsql);

$idliqui     = $fila['id'];
$numero      = $fila['numl'];
$fechal      = $fila['fechal'];
$radicado    = $fila['radicado'];
$juzgado     = $fila['nombre'];
$observacion = $fila['observacionl'];*/

//-----------------------------------------------------------------------------------------

$pdf=new PDF('P','mm','letter');
$pdf->Open();
$pdf->AddPage();
$pdf->SetMargins(20,20,20);
$pdf->Ln(20);

//TAMAÑO DE LA LETRA
$tamletra = 9;

//FECHA
date_default_timezone_set('America/Bogota'); 
$fechaactual=date('Y-m-d');
setlocale(LC_TIME, "Spanish");
$fecha = strftime('%d de %B del %Y', strtotime($fechaactual));  
$pdf->SetFont('Arial','',$tamletra);
$pdf->Cell(0,6,'Manizales, '.$fecha,0,1);
$pdf->Ln(5);

$pdf->Cell(0,6,"DETALLE LIQUIDACIONES",0,1);

$pdf->SetWidths(array(10, 45, 20, 25, 16, 18, 20, 21));
$pdf->SetFont('Arial','B',$tamletra);
$pdf->SetFillColor(200,202,205);
$pdf->SetTextColor(0);

for($i=0;$i<1;$i++){
	
	$pdf->Row(array('NUM', 'RADICADO','FECHA','ARANCEL','VALOR','PAGINAS','SUBTOTAL','REGISTRA'));
}

$canalsql = $con->conectar();	

if($tfiltro == 1){
				
$strConsulta = "SELECT al.numl AS num,ubi.radicado,al.fechal AS fecha,ai.nombrearancel AS arancel,
				TRUNCATE(adl.cantidadde / adl.paginasde,0) AS valor,adl.paginasde AS paginas,adl.cantidadde AS subtotal,pu.empleado AS registra
                FROM
                ((((arancel_detalle_liquidacion adl INNER JOIN arancel_liquidacion al ON adl.numlde = al.numl)
                INNER JOIN ubicacion_expediente ubi ON al.idradicadol = ubi.id)
                INNER JOIN arancel_pa_item ai ON adl.idarancelde = ai.id)
                INNER JOIN pa_usuario pu ON al.idusuario = pu.id)
				ORDER BY al.numl DESC";
                //ORDER BY ubi.radicado,al.fechal DESC";		
}

if($tfiltro == 2){

	$filtrox;
			
	$filtrof;
	$filtro1;
	$filtro2;
			
	if ( !empty($fechad) && !empty($fechah) ) {
		
		$filtrof = " AND (al.fechal >= '$fechad' AND al.fechal <= '$fechah') ";
			
	}
			
	if ( !empty($datox1) ) {
			
		$filtro1 = " AND ubi.radicado LIKE '%$datox1%' ";
			
	}
			
	if ( !empty($datox2) ) {
			
		$filtro2 = " AND pu.id = '$datox2' ";
			
	}
			
		
	$filtrox = $filtro1." ".$filtro2." ".$filtrof;
				
	
	$strConsulta = "SELECT al.numl AS num,ubi.radicado,al.fechal AS fecha,ai.nombrearancel AS arancel,
					TRUNCATE(adl.cantidadde / adl.paginasde,0) AS valor,adl.paginasde AS paginas,adl.cantidadde AS subtotal,pu.empleado AS registra
                	FROM
                	((((arancel_detalle_liquidacion adl INNER JOIN arancel_liquidacion al ON adl.numlde = al.numl)
                	INNER JOIN ubicacion_expediente ubi ON al.idradicadol = ubi.id)
                	INNER JOIN arancel_pa_item ai ON adl.idarancelde = ai.id)
                	INNER JOIN pa_usuario pu ON al.idusuario = pu.id)
					WHERE al.id >= 1 " .$filtrox. "
					ORDER BY al.numl DESC";
                	//ORDER BY ubi.radicado,al.fechal DESC";		
}
				
					
$canalsql = mysql_query($strConsulta);
$numfilas = mysql_num_rows($canalsql);
	
for ($i=0; $i<$numfilas; $i++){
	
	$pdf->SetWidths(array(10, 45, 20, 25, 16, 18, 20, 21));
	
	$fila = mysql_fetch_array($canalsql);
	$pdf->SetFont('Arial','',$tamletra);

	$pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(0);
	
	$pdf->SetAligns('L');
	
	$pdf->Row( array( $fila['num'],$fila['radicado'],$fila['fecha'],$fila['arancel'],number_format($fila['valor'], 0, ',', '.'),$fila['paginas'], number_format($fila['subtotal'], 0, ',', '.'),$fila['registra'] ) );	
	
	
}

//TOTAL ARANCELES
$pdf->SetWidths(array(10, 45, 20, 25, 16, 18, 20, 21));
$pdf->SetFont('Arial','B',$tamletra);
$pdf->SetFillColor(23,94,186);
$pdf->SetTextColor(255);

$canalsql = $con->conectar();	

if($tfiltro == 1){
			
$strConsulta = "SELECT SUM(adl.cantidadde) AS TOTAL FROM
				(arancel_detalle_liquidacion adl INNER JOIN arancel_liquidacion al ON adl.numlde = al.numl)";		
}				

if($tfiltro == 2){


	$filtrox;
			
	$filtrof;
	$filtro1;
	$filtro2;
			
	if ( !empty($fechad) && !empty($fechah) ) {
		
		$filtrof = " AND (al.fechal >= '$fechad' AND al.fechal <= '$fechah') ";
			
	}
			
	if ( !empty($datox1) ) {
			
		$filtro1 = " AND ubi.radicado LIKE '%$datox1%' ";
			
	}
			
	if ( !empty($datox2) ) {
			
		$filtro2 = " AND pu.id = '$datox2' ";
			
	}
			
		
	$filtrox = $filtro1." ".$filtro2." ".$filtrof;
			
	/*$strConsulta = "SELECT SUM(adl.cantidadde) AS TOTAL FROM
					(arancel_detalle_liquidacion adl INNER JOIN arancel_liquidacion al ON adl.numlde = al.numl)
					WHERE (al.fechal >= '$fi' AND al.fechal <= '$ff')";*/


	$strConsulta = "SELECT SUM(adl.cantidadde) AS TOTAL
                	FROM
                	((((arancel_detalle_liquidacion adl INNER JOIN arancel_liquidacion al ON adl.numlde = al.numl)
                	INNER JOIN ubicacion_expediente ubi ON al.idradicadol = ubi.id)
                	INNER JOIN arancel_pa_item ai ON adl.idarancelde = ai.id)
                	INNER JOIN pa_usuario pu ON al.idusuario = pu.id)
					WHERE al.id >= 1 " .$filtrox. "
                	ORDER BY ubi.radicado,al.fechal DESC";		
}				
					
$canalsql = mysql_query($strConsulta);
$numfilas = mysql_num_rows($canalsql);
	
for ($i=0; $i<$numfilas; $i++){
	
	$pdf->SetWidths(array(10, 45, 20, 25, 16, 18, 20, 21));
	
	$fila = mysql_fetch_array($canalsql);
	$pdf->SetFont('Arial','B',$tamletra);

	$pdf->SetFillColor(200,202,205);
    $pdf->SetTextColor(0);
	
	$pdf->Row(array('', '', '', '', '', 'TOTAL', number_format($fila['TOTAL'], 0, ',', '.'),''));	
	
	
}

$pdf->Output();

?>




