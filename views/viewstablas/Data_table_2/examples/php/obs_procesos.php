<?php

/*
 * Example PHP implementation used for the index.html example
 */

// DataTables PHP library
include( "../../php/DataTables.php" );

$idvalor  = trim($_GET['dato_radicado']);

//$idvalor = 20731;

/*foreach ($_POST as $clave=>$valor){
   	//echo "El valor de $clave es: $valor";
	utf8_decode($valor);
}*/

// Alias Editor classes so they are easy to use
use
	DataTables\Editor,
	DataTables\Editor\Field,
	DataTables\Editor\Format,
	DataTables\Editor\Mjoin,
	DataTables\Editor\Options,
	DataTables\Editor\Upload,
	DataTables\Editor\Validate,
	DataTables\Editor\ValidateOptions;

// Build our Editor instance and process the data coming from _POST
Editor::inst( $db, 'detalle_correspondencia')
	->fields(
		/*Field::inst( 'id' )
			->validator( Validate::notEmpty( ValidateOptions::inst()
				->message( 'Defina id' )	
			) ),*/
		
		
		
			
		Field::inst( 'idcorrespondencia' )
			->validator( Validate::notEmpty( ValidateOptions::inst()
				->message( 'A radicado name is required'." ID: ".$idvalor )	
			) ),
			
		
		/*Field::inst( 'fecha' )
			->validator( Validate::dateFormat( 'Y-m-d' ) )
			->getFormatter( Format::dateSqlToFormat( 'Y-m-d' ) )
			->setFormatter( Format::dateFormatToSql('Y-m-d' ) ),*/
			
		
		
		Field::inst( 'fecha' )
            ->validator( Validate::dateFormat(
                'Y-m-d g:i A',
                ValidateOptions::inst()
                    ->allowEmpty( false )
            ) )
            ->getFormatter( Format::datetime(
                'Y-m-d H:i:s',
                'Y-m-d g:i A'
            ) )
            ->setFormatter( Format::datetime(
                'Y-m-d g:i A',
                'Y-m-d H:i:s'
            ) ),
		
		
					
		Field::inst( 'observacion' )
			->validator( Validate::notEmpty( ValidateOptions::inst()
				->message( 'Defina Observacion' )	
			) ),
			
			
			
		Field::inst( 'idusuario' )
			->validator( Validate::notEmpty( ValidateOptions::inst()
				->message( 'A idusuario name is required' )	
			) )	
		
		
		
	)
	//->where( 'detalle_correspondencia.idcorrespondencia', $idvalor )
	
	
	
	
	->process( $_POST )
	->json();
	
?>	
