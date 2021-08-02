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
	
$datos     = trim($_GET['datos']);

$datosreporte = explode("******",$datos);

$idl          = $datosreporte[0]; 
$numl         = $datosreporte[1]; 

//-----------------------------------DATOS GENERALES---------------------------------------
//ME PERMITE CARGAR DATOS COMO MENSAJES

$canalsql = $con->conectar();	

				
$strConsulta = "SELECT al.id,al.numl,al.fechal,ap.radicado,ap.idjuzgado,al.observacionl,pj.nombre
			    FROM ((arancel_liquidacion al INNER JOIN ubicacion_expediente ap ON al.idradicadol = ap.id)
                INNER JOIN pa_juzgado pj ON ap.idjuzgado = pj.id)
                WHERE al.numl = '$numl'";
                
				
$canalsql = mysql_query($strConsulta);
$fila     = mysql_fetch_array($canalsql);

$idliqui     = $fila['id'];
$numero      = $fila['numl'];
$fechal      = $fila['fechal'];
$radicado    = $fila['radicado'];
$juzgado     = $fila['nombre'];
$observacion = $fila['observacionl'];

//-----------------------------------------------------------------------------------------

$pdf=new PDF('P','mm','letter');
$pdf->Open();
$pdf->AddPage();
$pdf->SetMargins(20,20,20);
$pdf->Ln(30);

//TAMAÑO DE LA LETRA
$tamletra = 10;

//PARA SABER QUE DATOS TRAIGO PARA GENERAR EL REPORTE
//SOLO SE ACTIVA PARA PRUBAS
/*$pdf->Ln(5);

$pdf->SetFont('Arial','',$tamletra);
$pdf->Cell(0,6,$datos."   ".$idusuario,0,1);*/

//NIT RAMA
//$nitrama = "800.093.816-3";
$nitrama = "800.165.850-4";
$pdf->SetFont('Arial','',$tamletra);
$pdf->Cell(0,6,"NIT RAMA JUDICIAL: ".$nitrama,0,1);
$pdf->Ln(1);

//FECHA
date_default_timezone_set('America/Bogota'); 
$fechaactual=date('Y-m-d');
setlocale(LC_TIME, "Spanish");
$fecha = strftime('%d de %B del %Y', strtotime($fechaactual));  

//$fecha = strftime('%d de %B del %Y', strtotime('2015-11-06'));  

$pdf->SetFont('Arial','',$tamletra);
$pdf->Cell(0,6,'Manizales, '.$fecha,0,1);
$pdf->Ln(5);

$pdf->SetFont('Arial','',$tamletra);
$pdf->Cell(0,6,"id: ".$idliqui,0,1);

$pdf->SetFont('Arial','',$tamletra);
$pdf->Cell(0,6,"Numero Liquidacion: ".$numero,0,1);

$pdf->SetFont('Arial','',$tamletra);
$pdf->Cell(0,6,"Fecha: ".$fechal,0,1);

$pdf->SetFont('Arial','',$tamletra);
$pdf->Cell(0,6,"Radicado",0,1);

$pdf->SetFont('Arial','',$tamletra);
$pdf->Cell(0,6,$radicado,0,1);

$pdf->SetFont('Arial','',$tamletra);
$pdf->Cell(0,6,"Juzgado",0,1);

$pdf->SetFont('Arial','',$tamletra);
$pdf->Cell(0,6,$juzgado,0,1);


$pdf->Ln(3);

$pdf->SetWidths(array(100, 85));
$pdf->SetFont('Arial','B',$tamletra);
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0);
$pdf->SetAligns('L');

for($i=0;$i<1;$i++){
	
	$pdf->Row(array('Observación'));
}

for ($i=0; $i<1; $i++){
	
	$pdf->SetWidths(array(100, 85));
	$pdf->SetFont('Arial','',$tamletra);
	
	$pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(0);
	
	$pdf->SetAligns('L');
	
	$pdf->Row(array($observacion));	

}

$pdf->Ln(5);

$pdf->Cell(0,6,"DETALLE LIQUIDACION",0,1);

$pdf->SetWidths(array(55, 19, 20, 35, 21, 20, 16, 21));
$pdf->SetFont('Arial','B',$tamletra);
$pdf->SetFillColor(200,202,205);
$pdf->SetTextColor(0);

for($i=0;$i<1;$i++){
	
	$pdf->Row(array('ARANCEL', 'PAGINAS','VALOR','SUBTOTAL'));
}

$canalsql = $con->conectar();	
				
$strConsulta = "SELECT ald.numlde,ali.nombrearancel,TRUNCATE(ald.cantidadde / ald.paginasde,0) AS valor,ald.paginasde,ald.cantidadde,ald.idarancelde
			    FROM (arancel_detalle_liquidacion ald INNER JOIN arancel_pa_item ali ON ald.idarancelde = ali.id)
                WHERE ald.numlde = '$numero'";		
				
					
$canalsql = mysql_query($strConsulta);
$numfilas = mysql_num_rows($canalsql);
	
for ($i=0; $i<$numfilas; $i++){
	
	$pdf->SetWidths(array(55, 19, 20, 35, 21, 20, 16, 21));
	
	$fila = mysql_fetch_array($canalsql);
	$pdf->SetFont('Arial','',$tamletra);

	$pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(0);
	
	$pdf->SetAligns('L');
	
	if($fila['idarancelde'] == 8){
		$na = "Desgloses";
	}
	else{
		$na =  $fila['nombrearancel'];
	}
	$pdf->Row( array( $na,$fila['paginasde'],number_format($fila['valor'], 0, ',', '.'), number_format($fila['cantidadde'], 0, ',', '.') ) );	
	
	
}

//TOTAL ARANCELES
$pdf->SetWidths(array(55, 19, 20, 35, 21, 20, 16, 21));
$pdf->SetFont('Arial','B',$tamletra);
$pdf->SetFillColor(23,94,186);
$pdf->SetTextColor(255);

$canalsql = $con->conectar();	
				
$strConsulta = "SELECT SUM(ald.cantidadde) AS TOTAL
			    FROM (arancel_detalle_liquidacion ald INNER JOIN arancel_pa_item ali ON ald.idarancelde = ali.id)
                WHERE ald.numlde = '$numero'";		
				
					
$canalsql = mysql_query($strConsulta);
$numfilas = mysql_num_rows($canalsql);
	
for ($i=0; $i<$numfilas; $i++){
	
	$pdf->SetWidths(array(55, 19, 20, 35, 21, 20, 16, 21));
	
	$fila = mysql_fetch_array($canalsql);
	$pdf->SetFont('Arial','B',$tamletra);

	$pdf->SetFillColor(200,202,205);
    $pdf->SetTextColor(0);
	
	$pdf->Row(array('', '', 'TOTAL', number_format($fila['TOTAL'], 0, ',', '.')));	
	
	
}




/*$pdf->Ln(20);

for ($i=0; $i<1; $i++){
	
	$pdf->SetWidths(array(100, 85, 15));
	$pdf->SetFont('Arial','',$tamletra);
	
	$pdf->SetFillColor(200,202,205);
    $pdf->SetTextColor(0);
	
	$pdf->Row(array($_SESSION['nombre'],''));	

}

$pdf->SetWidths(array(100, 85, 15));
$pdf->SetFont('Arial','B',$tamletra);
$pdf->SetFillColor(23,94,186);
$pdf->SetTextColor(255);

for($i=0;$i<1;$i++){
	
	$pdf->Row(array('Nombre Empleado que Entrega del CCSSJJC-F', 'Nombre Empleado Juzgado que Recibe'));
}*/

//PARA CONOCER COMO SE CONSTITUYE LA SQL
//SOLO SE ACTIVA PARA PRUEBAS

/*$sql = "SELECT de.id,de.fecha,de.hora,pu.empleado,de.remitente,td.nombre_tipo_documento,de.numero,de.nfc,pj.nombre,de.rutaarchivo
				FROM (((sidoju_documentos_entrantes_juzgados de INNER JOIN pa_usuario pu ON de.idusuario = pu.id)
				INNER JOIN sigdoc_pa_tipodocumento td ON de.idtipodocumento = td.id)
				INNER JOIN pa_juzgado pj ON de.idjuzgadodestino = pj.id)
				WHERE de.chk = 1 
				AND de.idjuzgadodestino IN(SELECT id FROM pa_juzgado WHERE idusuariojuzgado = '$idusuario')
				AND de.idjuzgadodestino = '$juzgadodestino' 
				AND (de.fecha >= '$fechai' AND de.fecha <= '$fechaf')
				AND (de.hora >= '$horai' AND de.hora <= '$horaf')
				ORDER BY de.id DESC";		
for ($i=0; $i<1; $i++){
	
	$pdf->SetWidths(array(90,90));
	
	$pdf->SetFont('Arial','',$tamletra);

	$pdf->SetFillColor(200,202,205);
    $pdf->SetTextColor(0);
	
	$pdf->Row(array($sql));	
	
	
}*/



$pdf->Output();

?>




