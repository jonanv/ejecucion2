
$(document).ready(function(){ //cuando el html fue cargado iniciar

    
	 $('#new').click( function(){
							   
		
		params={};

		 //alert(params.eveasunto);
		$('#popupbox').load('views/popupbox/permisos.php',params,function(){
			//alert(2);
			$('#block').show();
			//alert(3);
			$('#popupbox').show();
			//alert(4);
		})
		 
		
    });
	 
	$('#cancel').click( function(){
        $('#block').hide();
        $('#popupbox').hide();
		
    });
	
	
})//FIN $(document).ready(function(){


