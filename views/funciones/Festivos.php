<?php
class Festivos
{

	private $hoy;
	private $festivos;
	private $ano;
	private $pascua_mes;
	private $pascua_dia;
	
	public function getFestivos($ano=''){
		$this->festivos($ano);
		return $this->festivos;
	}
	
	public function festivos($ano='')
	{
		$this->hoy=date('d/m/Y');
		
		if($ano=='')
			$ano=date('Y');
			
		$this->ano=$ano;
		
		$this->pascua_mes=date("m", easter_date($this->ano));
		$this->pascua_dia=date("d", easter_date($this->ano));
				
		$this->festivos[$ano][1][1]   = true;		// Primero de Enero
		$this->festivos[$ano][5][1]   = true;		// Dia del Trabajo 1 de Mayo
		$this->festivos[$ano][7][20]  = true;		// Independencia 20 de Julio
		$this->festivos[$ano][8][7]   = true;		// Batalla de Boyacá 7 de Agosto
		$this->festivos[$ano][12][8]  = true;		// Maria Inmaculada 8 diciembre (religiosa)
		$this->festivos[$ano][12][25] = true;		// Navidad 25 de diciembre
		
		//**************SE AGREGAN ESTOS DIAS YA QUE TAMPOCO SE DEBEN TENER ENCUENTA********************
		//**************POR QUE SON VACACIONES EN LA RAMA JUDICIAL**************************************
		//**************CAMBIO REALIZADO EL 14 DE DICIEMBRE 2015****************************************
		//**************ESTO NO LO TRAE EL ALGORITMO ORIGINAL*******************************************
	
		$this->festivos[$ano][12][17] = true;		// Dia de la Rama Judicial
		//---------------------------VACACIONES 2017------------------------------------------
		/*$this->festivos[$ano][12][20] = true;		
		$this->festivos[$ano][12][21] = true;
		$this->festivos[$ano][12][22] = true;		
		$this->festivos[$ano][12][23] = true;
		$this->festivos[$ano][12][26] = true;
		$this->festivos[$ano][12][27] = true;
		$this->festivos[$ano][12][28] = true;
		$this->festivos[$ano][12][29] = true;
		$this->festivos[$ano][12][30] = true;
		
		
		//FERIAS 2018
		$this->festivos[$ano][1][2] = true;
		$this->festivos[$ano][1][3] = true;
		$this->festivos[$ano][1][4] = true;
		$this->festivos[$ano][1][5] = true;
		$this->festivos[$ano][1][9] = true;
		$this->festivos[$ano][1][10] = true;*/
		
		
		//---------------------------VACACIONES 2018------------------------------------------
		/*$this->festivos[$ano][12][20] = true;		
		$this->festivos[$ano][12][21] = true;
		$this->festivos[$ano][12][22] = true;		
		$this->festivos[$ano][12][24] = true;
		$this->festivos[$ano][12][26] = true;
		$this->festivos[$ano][12][27] = true;
		$this->festivos[$ano][12][28] = true;
		$this->festivos[$ano][12][29] = true;
		$this->festivos[$ano][12][31] = true;
		
		
		//FERIAS 2019
		$this->festivos[$ano][1][2] = true;
		$this->festivos[$ano][1][3] = true;
		$this->festivos[$ano][1][4] = true;
		$this->festivos[$ano][1][8] = true;
		$this->festivos[$ano][1][9] = true;
		$this->festivos[$ano][1][10] = true;*/
		
		
		
		//---------------------------VACACIONES 2019------------------------------------------
		/*$this->festivos[$ano][12][20] = true;		
		$this->festivos[$ano][12][21] = true;
		$this->festivos[$ano][12][23] = true;		
		$this->festivos[$ano][12][24] = true;
		$this->festivos[$ano][12][25] = true;
		$this->festivos[$ano][12][26] = true;
		$this->festivos[$ano][12][27] = true;
		$this->festivos[$ano][12][28] = true;
		$this->festivos[$ano][12][30] = true;
		$this->festivos[$ano][12][31] = true;
		
		
		//FERIAS 2020
		$this->festivos[$ano][1][2] = true;
		$this->festivos[$ano][1][3] = true;
		$this->festivos[$ano][1][4] = true;
		$this->festivos[$ano][1][7] = true;
		$this->festivos[$ano][1][8] = true;
		$this->festivos[$ano][1][9] = true;
		$this->festivos[$ano][1][10] = true;*/
		
		
		
		//---------------------------VACACIONES 2020------------------------------------------
		//$this->festivos[$ano][12][19] = true;
		//$this->festivos[$ano][12][20] = true;
		$this->festivos[$ano][12][21] = true;		
		$this->festivos[$ano][12][22] = true;
		$this->festivos[$ano][12][23] = true;		
		$this->festivos[$ano][12][24] = true;
		$this->festivos[$ano][12][25] = true;
		//$this->festivos[$ano][12][26] = true;
		//$this->festivos[$ano][12][27] = true;
		$this->festivos[$ano][12][28] = true;
		$this->festivos[$ano][12][29] = true;
		$this->festivos[$ano][12][30] = true;
		$this->festivos[$ano][12][31] = true;
		
		
		//FERIAS 2021
		//$this->festivos[$ano][1][1] = true;
		//$this->festivos[$ano][1][2] = true;
		//$this->festivos[$ano][1][3] = true;
		$this->festivos[$ano][1][4] = true;
		$this->festivos[$ano][1][5] = true;
		$this->festivos[$ano][1][6] = true;
		$this->festivos[$ano][1][7] = true;
		$this->festivos[$ano][1][8] = true;
		//$this->festivos[$ano][1][9] = true;
		//$this->festivos[$ano][1][10] = true;
		//$this->festivos[$ano][1][11] = true;
		
		
		
		//SEMANA SANTA 2016, CAMBIO REALIZADO EL 14 DE MARZO DEL 2016
		/*$this->festivos[$ano][3][22] = true;
		$this->festivos[$ano][3][23] = true;	*/
		
		//SEMANA SANTA 2017, CAMBIO REALIZADO EL 09 DE DICIEMBRE DEL 2016
		/*$this->festivos[$ano][4][10] = true;
		$this->festivos[$ano][4][11] = true;	
		$this->festivos[$ano][4][12] = true;*/
		
		//SEMANA SANTA 2018, CAMBIO REALIZADO EL 23 DE NOVIEMBRE DEL 2017
		/*$this->festivos[$ano][3][26] = true;
		$this->festivos[$ano][3][27] = true;	
		$this->festivos[$ano][3][28] = true;*/
		
		//SEMANA SANTA 2019, CAMBIO REALIZADO EL 27 DE NOVIEMBRE DEL 2018
		/*$this->festivos[$ano][4][15] = true;
		$this->festivos[$ano][4][16] = true;	
		$this->festivos[$ano][4][17] = true;*/
		
		
		//SEMANA SANTA 2020, CAMBIO REALIZADO EL 26 DE NOVIEMBRE DEL 2019
		/*$this->festivos[$ano][4][6] = true;
		$this->festivos[$ano][4][7] = true;	
		$this->festivos[$ano][4][8] = true;*/
		
		
		//SEMANA SANTA 2021, CAMBIO REALIZADO EL 20 DE NOVIEMBRE DEL 2020
		$this->festivos[$ano][3][29] = true;
		$this->festivos[$ano][3][30] = true;	
		$this->festivos[$ano][3][31] = true;
		//-------------------------------------------------------------------------------
		
		//**********************************************************************************************
		
		$this->calcula_emiliani(1, 6);				// Reyes Magos Enero 6
		$this->calcula_emiliani(3, 19);				// San Jose Marzo 19
		$this->calcula_emiliani(6, 29);				// San Pedro y San Pablo Junio 29
		$this->calcula_emiliani(8, 15);				// Asunción Agosto 15
		$this->calcula_emiliani(10, 12);			// Descubrimiento de América Oct 12
		$this->calcula_emiliani(11, 1);				// Todos los santos Nov 1
		$this->calcula_emiliani(11, 11);			// Independencia de Cartagena Nov 11
		
		
		
		//otras fechas calculadas a partir de la pascua.
		
		$this->otrasFechasCalculadas(-3);			//jueves santo
		$this->otrasFechasCalculadas(-2);			//viernes santo
		
		$this->otrasFechasCalculadas(43,true);		//Ascención el Señor pascua
		$this->otrasFechasCalculadas(64,true);		//Corpus Cristi
		$this->otrasFechasCalculadas(71,true);		//Sagrado Corazón
		
		// otras fechas importantes que no son festivos

		// $this->otrasFechasCalculadas(-46);		// Miércoles de Ceniza
		// $this->otrasFechasCalculadas(-46);		// Miércoles de Ceniza
		// $this->otrasFechasCalculadas(-48);		// Lunes de Carnaval Barranquilla
		// $this->otrasFechasCalculadas(-47);		// Martes de Carnaval Barranquilla
	}
	protected function calcula_emiliani($mes_festivo,$dia_festivo) 
	{
		// funcion que mueve una fecha diferente a lunes al siguiente lunes en el
		// calendario y se aplica a fechas que estan bajo la ley emiliani
		//global  $y,$dia_festivo,$mes_festivo,$festivo;
		// Extrae el dia de la semana
		// 0 Domingo ? 6 Sábado
		$dd = date("w",mktime(0,0,0,$mes_festivo,$dia_festivo,$this->ano));
		switch ($dd) {
		case 0:                                    // Domingo
		$dia_festivo = $dia_festivo + 1;
		break;
		case 2:                                    // Martes.
		$dia_festivo = $dia_festivo + 6;
		break;
		case 3:                                    // Miércoles
		$dia_festivo = $dia_festivo + 5;
		break;
		case 4:                                     // Jueves
		$dia_festivo = $dia_festivo + 4;
		break;
		case 5:                                     // Viernes
		$dia_festivo = $dia_festivo + 3;
		break;
		case 6:                                     // Sábado
		$dia_festivo = $dia_festivo + 2;
		break;
		}
		$mes = date("n", mktime(0,0,0,$mes_festivo,$dia_festivo,$this->ano))+0;
		$dia = date("d", mktime(0,0,0,$mes_festivo,$dia_festivo,$this->ano))+0;
		$this->festivos[$this->ano][$mes][$dia] = true;
	}	
	protected function otrasFechasCalculadas($cantidadDias=0,$siguienteLunes=false)
	{
		$mes_festivo = date("n", mktime(0,0,0,$this->pascua_mes,$this->pascua_dia+$cantidadDias,$this->ano));
		$dia_festivo = date("d", mktime(0,0,0,$this->pascua_mes,$this->pascua_dia+$cantidadDias,$this->ano));
		
		if ($siguienteLunes)
		{
			$this->calcula_emiliani($mes_festivo, $dia_festivo);
		}	
		else
		{	
			$this->festivos[$this->ano][$mes_festivo+0][$dia_festivo+0] = true;
		}
	}	
	public function esFestivo($dia,$mes)
	{
		//echo (int)$mes;
		if($dia=='' or $mes=='')
		{
			return false;
		}
		
		if (isset($this->festivos[$this->ano][(int)$mes][(int)$dia]))
		{
			return true;
		}
		else 
		{
			return FALSE;
		}
	
	}	
}
?>
