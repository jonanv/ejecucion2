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
		
		$this->Ln(40);
		$this->Image('encabezado.jpg' , 8 ,20,200,30,'JPG', '');
	}
	
	function Footer()
	{
		/*$this->SetY(-15);
		$this->SetFont('Arial','B',8);
		$this->Cell(100,10,'x',0,0,'L');*/
		
	}
	
	
	public function Obtener_Datos_Documento($iddoc){
	
		$con = new DB;
	
		$canalsql = $con->conectar();	
				
		$strConsulta = "SELECT rds.id,rds.idradicado,td.nombre_tipo_documento,td.id AS iddocumento,rds.numero,d.nombre_dirigido,
										  rds.nombre,rds.direccion,rds.ciudad,rds.fechageneracion,rds.asunto,rds.contenido,rds.partes,
										  do.id AS iddoc,do.nombre_documento
										  FROM (((documentos_internos rds LEFT JOIN pa_tipodocumento td ON rds.idtipodocumento = td.id)
										  LEFT JOIN pa_documento do ON td.iddocumento = do.id)
										  LEFT JOIN pa_dirigido d ON rds.dirigidoa = d.id)
										  WHERE rds.id = '$iddoc'";				
	
		$canalsql = mysql_query($strConsulta);
		$numfilas = mysql_num_rows($canalsql);
		
		/*$listar     = $this->db->prepare("SELECT rds.id,rds.idradicado,td.nombre_tipo_documento,td.id AS iddocumento,rds.numero,d.nombre_dirigido,
										  rds.nombre,rds.direccion,rds.ciudad,rds.fechageneracion,rds.asunto,rds.contenido,rds.partes,
										  do.id AS iddoc,do.nombre_documento
										  FROM (((documentos_internos rds LEFT JOIN pa_tipodocumento td ON rds.idtipodocumento = td.id)
										  LEFT JOIN pa_documento do ON td.iddocumento = do.id)
										  LEFT JOIN pa_dirigido d ON rds.dirigidoa = d.id)
										  WHERE rds.id = '$iddoc'");
										  
		
	
		$listar->execute();
			  
		return $listar; */
		
		return $canalsql;
	
   }  	
   
   public function Obtener_Datos_Oficina(){
   
   		$con = new DB;
   
   		$canalsql = $con->conectar();	
				
		$strConsulta = "SELECT * FROM pa_datos_oficina";				
	
		$canalsql = mysql_query($strConsulta);
		$numfilas = mysql_num_rows($canalsql);
	
			  
		
		/*$listar     = $this->db->prepare("SELECT * FROM pa_datos_oficina");
		
		$listar->execute();
			  
		return $listar;*/ 
		
		return $canalsql;
   }  	
   
   public function Obtener_Datos_Radicado($idradicado){
   
   	
		$con = new DB;
   
   		$canalsql = $con->conectar();	
				
		$strConsulta = "SELECT ubi.id,ubi.radicado,ubi.cedula_demandante,ubi.demandante,ubi.cedula_demandado,ubi.demandado,pc.nombre AS claseproceso,
										  pj.nombre AS jo,pr.nombre AS jd,pr.nombre_juez AS juez
										  FROM (((ubicacion_expediente ubi LEFT JOIN pa_clase_proceso pc ON ubi.idclase_proceso = pc.id)
										  LEFT JOIN pa_juzgado pj ON ubi.idjuzgado = pj.id)
										  LEFT JOIN juzgado_destino pr ON ubi.idjuzgado_reparto = pr.id)
										  WHERE ubi.id = '$idradicado'";				
	
		$canalsql = mysql_query($strConsulta);
		$numfilas = mysql_num_rows($canalsql);
   
   		/*$listar     = $this->db->prepare("SELECT ubi.id,ubi.radicado,ubi.cedula_demandante,ubi.demandante,ubi.cedula_demandado,ubi.demandado,pc.nombre AS claseproceso,
										  pj.nombre AS jo,pr.nombre AS jd,pr.nombre_juez AS juez
										  FROM (((ubicacion_expediente ubi LEFT JOIN pa_clase_proceso pc ON ubi.idclase_proceso = pc.id)
										  LEFT JOIN pa_juzgado pj ON ubi.idjuzgado = pj.id)
										  LEFT JOIN juzgado_destino pr ON ubi.idjuzgado_reparto = pr.id)
										  WHERE ubi.id = '$idradicado'");
		
		$listar->execute();
			  
		return $listar; */
		
		return $canalsql;
   
   }
	
	

}

//GENERAR PDF	
//$con = new DB;
	
$iddoc  = $_GET['id'];

//CREAMOS EL OBJETO DATA PARA DAR USO DE LAS FUNCIONES DEL MODELO wordModel()
$data         = new PDF();
	
$datosoficina = $data->Obtener_Datos_Oficina();
	
//OBTENEMOS LOS DATOS DE LA OFICINA, PARA SER UTILIZADOS EN EL DOCUMENTO
//COMO NOMBRE DE LA OFICINA, SECRETARIO ETC...
//while( $filao = $datosoficina->fetch() ){
while( $filao = mysql_fetch_array($datosoficina) ){
	
	$datoofi1  = $filao['nombre'];
	$datoofi2  = $filao['sigla'];
	$datoofi3  = $filao['direccion'];
	$datoofi4  = $filao['telefono'];
	$datoofi5  = $filao['secretario'];
	$datoofi6  = $filao['coordinadora'];
}

$vector_datos = $data->Obtener_Datos_Documento($iddoc);
//OBTENEMOS LOS DATOS DE LA CONSULTA ANTERIOR
//while( $field = $vector_datos->fetch() ){
while( $field = mysql_fetch_array($vector_datos) ){
			
	$datos0   = $field['nombre_tipo_documento'];
	$datos0b  = $field['iddoc'];//ID DOCUMENTO
	$datos0b2 = $field['nombre_documento'];//NOMBRE DOCUMENTO
	$datos0c  = $field['iddocumento'];//ID TIPO DOCUMENTO
			
	$datos1  = $field['numero'];
	$datos2  = $field['nombre_dirigido'];
	$datos3  = $field['nombre'];
	$datos4  = $field['direccion'];
	$datos5  = $field['ciudad'];
	$datos6  = $field['asunto'];
	$datos7  = $field['contenido'];
	$datos8  = $field['fechageneracion'];
			
	$datosir = $field['idradicado'];
			
	$datospartes = $field['partes'];

}

$idradicado = $datosir;
//OBTENEMOS LOS DATOS DEL RADICADO
$datosradicado = $data->Obtener_Datos_Radicado($idradicado);
	
//while( $filar = $datosradicado->fetch() ){
while( $filar = mysql_fetch_array($datosradicado) ){
	
	$dator1  = $filar['id'];
	$dator2  = $filar['cedula_demandante'];
	$dator3  = $filar['demandante'];
	$dator4  = $filar['cedula_demandado'];
	$dator5  = $filar['demandado'];
	$dator6  = $filar['claseproceso'];
	$dator7  = $filar['jo'];
	$dator8  = $filar['jd'];
	$dator9  = $filar['radicado'];
	$dator10 = $filar['juez'];
}

//setlocale(LC_TIME, "Spanish");

	
$pdf=new PDF('P','mm','letter');
$pdf->Open();
$pdf->AddPage();
$pdf->SetMargins(20,20,20);
$pdf->Ln(20);

$pdf->SetFont('Arial','',12);
//$pdf->Cell(0,6,'Total: '.$numfilas,0,1);

//*************************************************************************************************************************************

//************************************************CARTEL DE REMATE (Inmueble,Mueble,Vehiculo)*********************************************************************
	
	//SI ES TIPO CARTEL DE REMATE INMUEBLE
	if($datos0c == 20){
	
		$datospartesB = explode("//////",$datospartes);
		$parte0 = $datospartesB[1];
		$parte1 = $datospartesB[2];
		$parte2 = $datospartesB[3];
		$parte3 = $datospartesB[4];
		$parte4 = $datospartesB[5];
		$parte5 = $datospartesB[6];
		$parte6 = $datospartesB[7];
		
		//$pdf->Ln(2);
		$pdf->Cell(0,6,'REPÚBLICA DE COLOMBIA',0,1,'C');
		//$pdf->Image('escudo.jpg' , 95 ,30, 0 , 0,'JPG', '');
		$pdf->Image('escudo.jpg' , 95 ,85, 0 , 0,'JPG', '');
		$pdf->Ln(30);
		
		setlocale(LC_TIME, "Spanish");
		//$fecha = strftime('%B %d de %Y', strtotime($datos8));  
		$fechaauto  = strftime('%d %B de %Y', strtotime($parte0));
		
		$pdf->Cell(0,6,'AVISO DE REMATE',0,1,'C');
		$pdf->Ln(10);
		
		$pdf->Cell(0,6,$dator8,0,1,'C');
		$pdf->Ln(10);
		$pdf->Cell(0,6,'AVISA:',0,1,'C');
		
		$pdf->Ln(10);
		
		//$pdf->Cell(0,6,"Que dentro del proceso que se relaciona a continuación, se llevará a cabo la diligencia de remate sobre los bienes embargados, secuestrados y avaluados:",0,1,'L');
		$pdf->SetWidths(array(200, 70));
		$pdf->SetFont('Arial','',10);
		$pdf->SetFillColor(255,255,255);
		$pdf->SetTextColor(0);
		$pdf->Row(array("Que dentro del proceso que se relaciona a continuación, se llevará a cabo la diligencia de remate sobre los bienes embargados, secuestrados y avaluados:"));
		
		$pdf->Ln(10);
		
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 15){
	
				if($conttabla == 0){$campofila = "RADICADO: ";   $campofila2 =$dator9;}
				if($conttabla == 1){$campofila = "PROCESO: ";    $campofila2 = $dator6;}
				if($conttabla == 2){$campofila = "DEMANDANTE: "; $campofila2 =$dator3;}
				if($conttabla == 3){$campofila = "NIT/CEDULA: "; $campofila2 =$dator2;}
				if($conttabla == 4){$campofila = "DEMANDADOS: "; $campofila2 =$dator5;}
				if($conttabla == 5){$campofila = "NIT/CEDULA: "; $campofila2 =$dator4;}
				if($conttabla == 6){$campofila = "FECHA DEL REMATE: "; $campofila2 =$fechaauto;}
				if($conttabla == 7){$campofila = "HORA: "; $campofila2 =$parte1;}
				
				if($conttabla == 8){
					
					$campofila = "BASE DEL REMATE: "; 
					
					if($dator6 == "Divisorios"){
					
						$campofila2 ="100% DEL AVALUO DEL BIEN";
					}
					else{
						$campofila2 ="70% DEL AVALUO DEL BIEN";
					}
					
					
					//$campofila2 ="70% DEL AVALUO DEL BIEN";
				}
				
				//if($conttabla == 8){$campofila = "BASE DEL REMATE: "; $campofila2 ="70% DEL AVALUO DEL BIEN";}
				
				if($conttabla == 9){$campofila = "POSTOR HÁBIL: "; $campofila2 ="QUIEN CONSIGNE PREVIAMENTE EL 40% DEL VALOR  TOTAL DEL AVALUO";}
				if($conttabla == 10){$campofila = "DURACIÓN: "; $campofila2 ="UNA HORA";}
				if($conttabla == 11){$campofila = "AVALUO DEL BIEN: "; $campofila2 =$parte2;}
				if($conttabla == 12){$campofila = "MATRICULA INMOBILIARIA: "; $campofila2 =$parte3;}
				//if($conttabla == 13){$campofila = "DESCRIPCIÓN DEL BIEN OBJETO DE REMATE: "; $campofila2 =$parte4." Inmueble identificado con el folio de matrícula inmobiliaria N° ".$parte3." adscrito a la Oficina De Registro de Instrumentos Públicos de Manizales, y cuyas demás especificaciones se encuentran detalladas en la diligencia de secuestro y certificado de tradición.";}
				if($conttabla == 13){$campofila = "DESCRIPCIÓN DEL BIEN OBJETO DE REMATE: "; $campofila2 =$parte4;}
				if($conttabla == 14){$campofila = "SECUESTRE: "; $campofila2 =$parte5;}
				
			
				$pdf->SetWidths(array(60, 70, 15));
				
				$pdf->SetFont('Arial','',10);
				
				$pdf->SetFillColor(255,255,255);
				$pdf->SetTextColor(0);
				
					
				$pdf->Row(array($campofila,$campofila2));	
				$pdf->Ln(3);
				
		
				$conttabla = $conttabla + 1;
				
				
		}
		
		$pdf->SetWidths(array(190, 70));
		$pdf->SetFont('Arial','',10);
		$pdf->SetFillColor(255,255,255);
		$pdf->SetTextColor(0);
		
		$pdf->Ln(5);
		//$pdf->Cell(0,6,"Se informa a los interesados en participar en la subasta, que la consignación para hacer postura se procurara hacerla en efectivo con el fin de allegar el título el día de la diligencia, quien pretenda consignar en cheque  debe hacerlo con antelación a la diligencia de remate con el fin de que el titulo sea remitido a tiempo por el banco Agrario, consignación que deberá efectuarse en la cuenta de depósitos judiciales N° 170012041701",0,1,'L');
		$pdf->Row(array("Se informa a los interesados en participar en la subasta, que la consignación para hacer postura se procurara hacerla en efectivo con el fin de allegar el título el día de la diligencia, quien pretenda consignar en cheque  debe hacerlo con antelación a la diligencia de remate con el fin de que el titulo sea remitido a tiempo por el banco Agrario, consignación que deberá efectuarse en la cuenta de depósitos judiciales N° 170012041800"));
		$pdf->Ln(5);
		
		//$pdf->Cell(0,6,"Llegado el día y la hora, los interesados deberán presentar en sobre cerrado sus ofertas, para adquirir en este caso el bien objeto de remate por el que pretenda postularse y el depósito previsto en el Art. 526 del C. de P. Civil (consignación para hacer postura).",0,1,'L');
		$pdf->Row(array("Los interesados podrán hacer postura dentro de los cinco (5) días anteriores al remate o Llegado el día y la hora, los interesados deberán presentar en sobre cerrado sus ofertas, para adquirir en este caso el bien objeto de remate por el que pretenda postularse y el depósito previsto en el Art. 451 del Código General del Proceso (consignación para hacer postura)."));
		$pdf->Ln(5);
		
		//$pdf->Cell(0,6,"Para los efectos indicados en el Art. 525 del C. de P. Civil,  modificado por el Art. 55 de la ley 794 de 2003, este aviso se publicará por una sola vez, con antelación no inferior a 10 días, en uno de los periódicos de más amplia circulación en la ciudad y en una radiodifusora local.",0,1,'L');
		$pdf->Row(array("Para los efectos indicados en el Art. 450 del Código General del Proceso, este aviso se publicará por una sola vez, con antelación no inferior a 10 días, en uno de los periódicos de más amplia circulación en la ciudad. ".$parte6));
		
		$pdf->Ln(10);
		
		$pdf->Cell(0,6,"Cordialmente,",0,1,'L');
		
		$pdf->Ln(5);
		
		/*$pdf->Cell(0,6,$datoofi5,0,1,'L');
		$pdf->Cell(0,6,"Secretario",0,1,'L');*/
		
		//Image($file, $x=null, $y=null, $w=0, $h=0, $type='', $link='')
		$pdf->Cell(0,6,$pdf->Image('firmasecre.png',80,null,50,40,'PNG',''),0,1,'C');
	
	}//FIN IF CARTEL DE REMATE
	
	//SI ES TIPO CARTEL DE REMATE VEHICULO
	if($datos0c == 35){
	
		$datospartesB = explode("//////",$datospartes);
		$parte0 = $datospartesB[1];
		$parte1 = $datospartesB[2];
		$parte2 = $datospartesB[3];
		$parte3 = $datospartesB[4];
		$parte4 = $datospartesB[5];
		$parte5 = $datospartesB[6];
		$parte6 = $datospartesB[7];
		
		
		//$pdf->Ln(2);
		$pdf->Cell(0,6,'REPÚBLICA DE COLOMBIA',0,1,'C');
		//$pdf->Image('escudo.jpg' , 95 ,30, 0 , 0,'JPG', '');
		$pdf->Image('escudo.jpg' , 95 ,85, 0 , 0,'JPG', '');
		$pdf->Ln(30);
		
		setlocale(LC_TIME, "Spanish");
		//$fecha = strftime('%B %d de %Y', strtotime($datos8));  
		$fechaauto  = strftime('%d %B de %Y', strtotime($parte0));
		
		$pdf->Cell(0,6,'AVISO DE REMATE',0,1,'C');
		$pdf->Ln(10);
		
		$pdf->Cell(0,6,$dator8,0,1,'C');
		$pdf->Ln(10);
		$pdf->Cell(0,6,'AVISA:',0,1,'C');
		
		$pdf->Ln(10);
		
		//$pdf->Cell(0,6,"Que dentro del proceso que se relaciona a continuación, se llevará a cabo la diligencia de remate sobre los bienes embargados, secuestrados y avaluados:",0,1,'L');
		$pdf->SetWidths(array(200, 70));
		$pdf->SetFont('Arial','',10);
		$pdf->SetFillColor(255,255,255);
		$pdf->SetTextColor(0);
		$pdf->Row(array("Que dentro del proceso que se relaciona a continuación, se llevará a cabo la diligencia de remate sobre los bienes embargados, secuestrados y avaluados:"));
		
		$pdf->Ln(10);
		
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 15){
	
				if($conttabla == 0){$campofila = "RADICADO: ";   $campofila2 =$dator9;}
				if($conttabla == 1){$campofila = "PROCESO: ";    $campofila2 = $dator6;}
				if($conttabla == 2){$campofila = "DEMANDANTE: "; $campofila2 =$dator3;}
				if($conttabla == 3){$campofila = "NIT/CEDULA: "; $campofila2 =$dator2;}
				if($conttabla == 4){$campofila = "DEMANDADOS: "; $campofila2 =$dator5;}
				if($conttabla == 5){$campofila = "NIT/CEDULA: "; $campofila2 =$dator4;}
				if($conttabla == 6){$campofila = "FECHA DEL REMATE: "; $campofila2 =$fechaauto;}
				if($conttabla == 7){$campofila = "HORA: "; $campofila2 =$parte1;}
				if($conttabla == 8){$campofila = "BASE DEL REMATE: "; $campofila2 ="70% DEL AVALUO DEL BIEN";}
				if($conttabla == 9){$campofila = "POSTOR HÁBIL: "; $campofila2 ="QUIEN CONSIGNE PREVIAMENTE EL 40% DEL VALOR  TOTAL DEL AVALUO";}
				if($conttabla == 10){$campofila = "DURACIÓN: "; $campofila2 ="UNA HORA";}
				if($conttabla == 11){$campofila = "AVALUO DEL BIEN: "; $campofila2 =$parte2;}
				if($conttabla == 12){$campofila = "PLACA(S): "; $campofila2 =$parte3;}
				//if($conttabla == 13){$campofila = "DESCRIPCIÓN DEL BIEN OBJETO DE REMATE: "; $campofila2 =$parte4." Inmueble identificado con el folio de matrícula inmobiliaria N° ".$parte3." adscrito a la Oficina De Registro de Instrumentos Públicos de Manizales, y cuyas demás especificaciones se encuentran detalladas en la diligencia de secuestro y certificado de tradición.";}
				if($conttabla == 13){$campofila = "DESCRIPCIÓN DEL BIEN OBJETO DE REMATE: "; $campofila2 =$parte4;}
				if($conttabla == 14){$campofila = "SECUESTRE: "; $campofila2 =$parte5;}
				
			
				$pdf->SetWidths(array(60, 70, 15));
				
				$pdf->SetFont('Arial','',10);
				
				$pdf->SetFillColor(255,255,255);
				$pdf->SetTextColor(0);
				
					
				$pdf->Row(array($campofila,$campofila2));	
				$pdf->Ln(3);
				
		
				$conttabla = $conttabla + 1;
				
				
		}
		
		$pdf->SetWidths(array(190, 70));
		$pdf->SetFont('Arial','',10);
		$pdf->SetFillColor(255,255,255);
		$pdf->SetTextColor(0);
		
		$pdf->Ln(5);
		//$pdf->Cell(0,6,"Se informa a los interesados en participar en la subasta, que la consignación para hacer postura se procurara hacerla en efectivo con el fin de allegar el título el día de la diligencia, quien pretenda consignar en cheque  debe hacerlo con antelación a la diligencia de remate con el fin de que el titulo sea remitido a tiempo por el banco Agrario, consignación que deberá efectuarse en la cuenta de depósitos judiciales N° 170012041701",0,1,'L');
		$pdf->Row(array("Se informa a los interesados en participar en la subasta, que la consignación para hacer postura se procurara hacerla en efectivo con el fin de allegar el título el día de la diligencia, quien pretenda consignar en cheque  debe hacerlo con antelación a la diligencia de remate con el fin de que el titulo sea remitido a tiempo por el banco Agrario, consignación que deberá efectuarse en la cuenta de depósitos judiciales N° 170012041800"));
		$pdf->Ln(5);
		
		//$pdf->Cell(0,6,"Llegado el día y la hora, los interesados deberán presentar en sobre cerrado sus ofertas, para adquirir en este caso el bien objeto de remate por el que pretenda postularse y el depósito previsto en el Art. 526 del C. de P. Civil (consignación para hacer postura).",0,1,'L');
		$pdf->Row(array("Los interesados podrán hacer postura dentro de los cinco (5) días anteriores al remate o Llegado el día y la hora, los interesados deberán presentar en sobre cerrado sus ofertas, para adquirir en este caso el bien objeto de remate por el que pretenda postularse y el depósito previsto en el Art. 451 del Código General del Proceso (consignación para hacer postura)."));
		$pdf->Ln(5);
		
		//$pdf->Cell(0,6,"Para los efectos indicados en el Art. 525 del C. de P. Civil,  modificado por el Art. 55 de la ley 794 de 2003, este aviso se publicará por una sola vez, con antelación no inferior a 10 días, en uno de los periódicos de más amplia circulación en la ciudad y en una radiodifusora local.",0,1,'L');
		$pdf->Row(array("Para los efectos indicados en el Art. 450 del Código General del Proceso, este aviso se publicará por una sola vez, con antelación no inferior a 10 días, en uno de los periódicos de más amplia circulación en la ciudad. ".$parte6));
		
		$pdf->Ln(10);
		
		$pdf->Cell(0,6,"Cordialmente,",0,1,'L');
		
		$pdf->Ln(5);
		
		/*$pdf->Cell(0,6,$datoofi5,0,1,'L');
		$pdf->Cell(0,6,"Secretario",0,1,'L');*/
		
		//Image($file, $x=null, $y=null, $w=0, $h=0, $type='', $link='')
		$pdf->Cell(0,6,$pdf->Image('firmasecre.png',80,null,50,40,'PNG',''),0,1,'C');
	
	}//FIN IF CARTEL DE REMATE
	
	//SI ES TIPO CARTEL DE REMATE MUEBLE
	if($datos0c == 36){
	
		$datospartesB = explode("//////",$datospartes);
		$parte0 = $datospartesB[1];
		$parte1 = $datospartesB[2];
		$parte2 = $datospartesB[3];
		//$parte3 = $datospartesB[4];
		$parte4 = $datospartesB[4];
		$parte5 = $datospartesB[5];
		$parte6 = $datospartesB[6];
		
		//$pdf->Ln(2);
		$pdf->Cell(0,6,'REPÚBLICA DE COLOMBIA',0,1,'C');
		//$pdf->Image('escudo.jpg' , 95 ,30, 0 , 0,'JPG', '');
		$pdf->Image('escudo.jpg' , 95 ,85, 0 , 0,'JPG', '');
		$pdf->Ln(30);
		
		setlocale(LC_TIME, "Spanish");
		//$fecha = strftime('%B %d de %Y', strtotime($datos8));  
		$fechaauto  = strftime('%d %B de %Y', strtotime($parte0));
		
		$pdf->Cell(0,6,'AVISO DE REMATE',0,1,'C');
		$pdf->Ln(10);
		
		$pdf->Cell(0,6,$dator8,0,1,'C');
		$pdf->Ln(10);
		$pdf->Cell(0,6,'AVISA:',0,1,'C');
		
		$pdf->Ln(10);
		
		//$pdf->Cell(0,6,"Que dentro del proceso que se relaciona a continuación, se llevará a cabo la diligencia de remate sobre los bienes embargados, secuestrados y avaluados:",0,1,'L');
		$pdf->SetWidths(array(200, 70));
		$pdf->SetFont('Arial','',10);
		$pdf->SetFillColor(255,255,255);
		$pdf->SetTextColor(0);
		$pdf->Row(array("Que dentro del proceso que se relaciona a continuación, se llevará a cabo la diligencia de remate sobre los bienes embargados, secuestrados y avaluados:"));
		
		$pdf->Ln(10);
		
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 14){
	
				if($conttabla == 0){$campofila = "RADICADO: ";   $campofila2 =$dator9;}
				if($conttabla == 1){$campofila = "PROCESO: ";    $campofila2 = $dator6;}
				if($conttabla == 2){$campofila = "DEMANDANTE: "; $campofila2 =$dator3;}
				if($conttabla == 3){$campofila = "NIT/CEDULA: "; $campofila2 =$dator2;}
				if($conttabla == 4){$campofila = "DEMANDADOS: "; $campofila2 =$dator5;}
				if($conttabla == 5){$campofila = "NIT/CEDULA: "; $campofila2 =$dator4;}
				if($conttabla == 6){$campofila = "FECHA DEL REMATE: "; $campofila2 =$fechaauto;}
				if($conttabla == 7){$campofila = "HORA: "; $campofila2 =$parte1;}
				if($conttabla == 8){$campofila = "BASE DEL REMATE: "; $campofila2 ="70% DEL AVALUO DEL BIEN";}
				if($conttabla == 9){$campofila = "POSTOR HÁBIL: "; $campofila2 ="QUIEN CONSIGNE PREVIAMENTE EL 40% DEL VALOR  TOTAL DEL AVALUO";}
				if($conttabla == 10){$campofila = "DURACIÓN: "; $campofila2 ="UNA HORA";}
				if($conttabla == 11){$campofila = "AVALUO DEL BIEN: "; $campofila2 =$parte2;}
				if($conttabla == 12){$campofila = "DESCRIPCIÓN DEL BIEN OBJETO DE REMATE: "; $campofila2 =$parte4;}
				if($conttabla == 13){$campofila = "SECUESTRE: "; $campofila2 =$parte5;}
				
			
				$pdf->SetWidths(array(60, 70, 15));
				
				$pdf->SetFont('Arial','',10);
				
				$pdf->SetFillColor(255,255,255);
				$pdf->SetTextColor(0);
				
					
				$pdf->Row(array($campofila,$campofila2));	
				$pdf->Ln(3);
				
		
				$conttabla = $conttabla + 1;
				
				
		}
		
		$pdf->SetWidths(array(190, 70));
		$pdf->SetFont('Arial','',10);
		$pdf->SetFillColor(255,255,255);
		$pdf->SetTextColor(0);
		
		$pdf->Ln(5);
		//$pdf->Cell(0,6,"Se informa a los interesados en participar en la subasta, que la consignación para hacer postura se procurara hacerla en efectivo con el fin de allegar el título el día de la diligencia, quien pretenda consignar en cheque  debe hacerlo con antelación a la diligencia de remate con el fin de que el titulo sea remitido a tiempo por el banco Agrario, consignación que deberá efectuarse en la cuenta de depósitos judiciales N° 170012041701",0,1,'L');
		$pdf->Row(array("Se informa a los interesados en participar en la subasta, que la consignación para hacer postura se procurara hacerla en efectivo con el fin de allegar el título el día de la diligencia, quien pretenda consignar en cheque  debe hacerlo con antelación a la diligencia de remate con el fin de que el titulo sea remitido a tiempo por el banco Agrario, consignación que deberá efectuarse en la cuenta de depósitos judiciales N° 170012041800"));
		$pdf->Ln(5);
		
		//$pdf->Cell(0,6,"Llegado el día y la hora, los interesados deberán presentar en sobre cerrado sus ofertas, para adquirir en este caso el bien objeto de remate por el que pretenda postularse y el depósito previsto en el Art. 526 del C. de P. Civil (consignación para hacer postura).",0,1,'L');
		$pdf->Row(array("Los interesados podrán hacer postura dentro de los cinco (5) días anteriores al remate o Llegado el día y la hora, los interesados deberán presentar en sobre cerrado sus ofertas, para adquirir en este caso el bien objeto de remate por el que pretenda postularse y el depósito previsto en el Art. 451 del Código General del Proceso (consignación para hacer postura)."));
		$pdf->Ln(5);
		
		//$pdf->Cell(0,6,"Para los efectos indicados en el Art. 525 del C. de P. Civil,  modificado por el Art. 55 de la ley 794 de 2003, este aviso se publicará por una sola vez, con antelación no inferior a 10 días, en uno de los periódicos de más amplia circulación en la ciudad y en una radiodifusora local.",0,1,'L');
		$pdf->Row(array("Para los efectos indicados en el Art. 450 del Código General del Proceso, este aviso se publicará por una sola vez, con antelación no inferior a 10 días, en uno de los periódicos de más amplia circulación en la ciudad. ".$parte6));
		
		$pdf->Ln(10);
		
		$pdf->Cell(0,6,"Cordialmente,",0,1,'L');
		
		$pdf->Ln(5);
		
		/*$pdf->Cell(0,6,$datoofi5,0,1,'L');
		$pdf->Cell(0,6,"Secretario",0,1,'L');*/
		
		//Image($file, $x=null, $y=null, $w=0, $h=0, $type='', $link='')
		$pdf->Cell(0,6,$pdf->Image('firmasecre.png',80,null,50,40,'PNG',''),0,1,'C');
	
	}//FIN IF CARTEL DE REMATE
	
	//SI ES TIPO (Traslado Mediante Fijacion en Lista)
	if($datos0c == 22){
	
		$datospartesB = explode("//////",$datospartes);
		$parte0       = $datospartesB[1];
		$parte1       = $datospartesB[2];
		$parte2       = $datospartesB[3];
		$parte3       = $datospartesB[4];
		$parte4       = $datospartesB[5];
		$parte5       = $datospartesB[6];
		$parte6       = $datospartesB[7];
		
		//$pdf->Ln(2);
		$pdf->Cell(0,6,$datoofi1,0,1,'C');
		//$pdf->Image('escudo.jpg' , 95 ,30, 0 , 0,'JPG', '');
		$pdf->Image('escudo.jpg' , 95 ,85, 0 , 0,'JPG', '');
		$pdf->Ln(30);
		
		setlocale(LC_TIME, "Spanish");
		//$fecha = strftime('%B %d de %Y', strtotime($datos8));  
		$fechaauto  = strftime('%d %B de %Y', strtotime($parte0));
		
		
		$pdf->Cell(0,6,$dator8,0,1,'C');
		$pdf->Ln(10);
		
		$pdf->Cell(0,6,'TRASLADO MEDIANTE FIJACION EN LISTA',0,1,'C');
		//$pdf->Ln(10);
		//$pdf->Cell(0,6,'AVISA:',0,1,'C');
		
		$pdf->Ln(10);
		
		//$pdf->Cell(0,6,"Que dentro del proceso que se relaciona a continuación, se llevará a cabo la diligencia de remate sobre los bienes embargados, secuestrados y avaluados:",0,1,'L');
		$pdf->SetWidths(array(200, 70));
		$pdf->SetFont('Arial','',10);
		$pdf->SetFillColor(255,255,255);
		$pdf->SetTextColor(0);
		//$pdf->Row(array("Que dentro del proceso que se relaciona a continuación, se llevará a cabo la diligencia de remate sobre los bienes embargados, secuestrados y avaluados:"));
		
		$pdf->Ln(10);
		
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 8){
	
				if($conttabla == 0){$campofila = "RADICADO: ";      $campofila2 = $dator9;}
				if($conttabla == 1){$campofila = "PROCESO: ";       $campofila2 = $dator6;}
				if($conttabla == 2){$campofila = "DEMANDANTE: ";    $campofila2 = $dator3;}
				if($conttabla == 3){$campofila = "NIT/CEDULA: ";    $campofila2 = $dator2;}
				if($conttabla == 4){$campofila = "DEMANDADOS: ";    $campofila2 = $dator5;}
				if($conttabla == 5){$campofila = "NIT/CEDULA: ";    $campofila2 = $dator4;}
				if($conttabla == 6){$campofila = "FECHA ESCRITO: "; $campofila2 = $fechaauto;}
				/*if($conttabla == 7){$campofila = "TRASLADO 	: ";    $campofila2 = "DOS (2) DIAS Art. 349 Y 108 DEL C.P.C. ".$parte1;}*/
				if($conttabla == 7){$campofila = "TRASLADO 	: ";    $campofila2 = "TRES (3) DIAS Art. 319 Y 110 DEL CODIGO GENERAL DEL PROCESO. ".$parte1;}
				
				$pdf->SetWidths(array(60, 70, 15));
				
				$pdf->SetFont('Arial','',10);
				
				$pdf->SetFillColor(255,255,255);
				$pdf->SetTextColor(0);
				
					
				$pdf->Row(array($campofila,$campofila2));	
				$pdf->Ln(3);
				
		
				$conttabla = $conttabla + 1;
				
				
		}
		
		$pdf->SetWidths(array(190, 70));
		$pdf->SetFont('Arial','',10);
		$pdf->SetFillColor(255,255,255);
		$pdf->SetTextColor(0);
		
		$pdf->Ln(5);
		
		$pdf->Row(array("A LA PARTE ".$parte2." EN EL PRESENTE PROCESO SE LE CORRE TRASLADO DEL ANTERIOR ESCRITO PRESENTADO POR EL SEÑOR ".$parte3." MEDIANTE EL CUAL PRESENTA RECURSO DE REPÓSICION ".$parte5));
		$pdf->Ln(5);
		
		
		$pdf->Row(array("FECHA FIJACION: ".$parte4."   HORA: ".$parte6));
		
		$pdf->Ln(10);
		
		$pdf->Cell(0,6,"Cordialmente,",0,1,'L');
		
		$pdf->Ln(10);
		
		$pdf->Cell(0,6,$datoofi5,0,1,'L');
		$pdf->Cell(0,6,"Secretario",0,1,'L');
		
		
	
	}
	
	
//*************************************************************************************************************************************

$pdf->Output();

?>




