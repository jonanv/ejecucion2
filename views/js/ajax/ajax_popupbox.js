
$(document).ready(function(){ //cuando el html fue cargado iniciar

    
	 $('#new').click( function(){
							   
		
		params={};
		params.everadicado=$('#radicado').val();
		
		if (params.everadicado != "") {
		
			 //alert(params.eveasunto);
			 $('#popupbox').load('views/popupbox/accionesForm.php',params,function(){
				//alert(2);
				$('#block').show();
				//alert(3);
				$('#popupbox').show();
				//alert(4);
			})
		 
		}
		else{
			alert("Defina Radicado");
		}
		 
		
    });
	 
	$('#cancel').click( function(){
        $('#block').hide();
        $('#popupbox').hide();
		
    });
	
	
})//FIN $(document).ready(function(){


