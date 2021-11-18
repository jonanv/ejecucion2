$().ready(function() 
{
	/*-----------------------------------( Validar )-----------------------------------------*/
	$("#frmLogin").validate();
	var validator = $("#frmLogin").validate({meta: "validate"});
	$("#botonenviar").click(function() 
	{
		if($("#frmLogin").valid() == false)
		{
			$('#msg_error').modal({onOpen: statusOpen,onClose: statusClose});
			return false;
		}
	});
	
		function statusOpen(dialog) {
			dialog.overlay.fadeIn('slow', function () {
			dialog.container.slideDown('fast', function () {
			dialog.data.fadeIn('slow');
		});
		});
		}
		
		function statusClose(dialog) {
			dialog.data.fadeOut('slow', function () {
			dialog.container.slideUp('fast', function () {});
			dialog.overlay.fadeOut('slow', function () {
			$.modal.close();
		});
		});
		}
		
	/*------------------------------( Recuperar Password )------------------------------------*/		
	
	$("#getPass").click(function()
	{
		$("#panel").slideToggle("slow");
		$(this).toggleClass("active"); return false;
	});
		
	$(".cerrarp").click(function()
	{
		$("#panel").slideToggle("slow");
		$(this).toggleClass("active"); return false;
	});

});