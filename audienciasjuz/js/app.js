/*SE ADICIONA ESTA PARTE, PARA ENVIAR LA FECHA ACTUAL EN LA VARIABLE day: fecha_actual

26 DE JULIO 2019

JORGE ANDRES VALENCIA OROZCO

*/
var date  = new Date();
var year  = date.getFullYear();
var month = date.getMonth() + 1;//SE SUMA YA QUE CARGA EL MES ACTUA MENOS 1, ES DECIR SI ES JULIO (7) CARGA JUNIO (6)
if(month >= 1 && month <= 9){
	month = "0"+month;	
}
var day   = date.getDate();
if(day >= 1 && day <= 9){
	day = "0"+day;	
}
		
//alert(year+"-"+month+"-"+day);

var fecha_actual = year+"-"+month+"-"+day;
		
(function($) {

	"use strict";

	var options = {
		//events_source: 'events.json.php',
		events_source: 'events.json_2.php',
		view: 'month',
		tmpl_path: 'tmpls/',
		tmpl_cache: false,
		//day: '2013-03-12',
		day: fecha_actual,
		//day: '2019-07-26',
		language: 'es-CO',//SE ADICIONA LINEA, PARA QUE EL IDIOMA DEL CALENDARIO SEA EN ESPAÑOL COLOMBIA, 30 DE JULIO 2019
		first_day:'1',//SE ADICIONA LINEA, PARA QUE EN EL CALENDARIO EL LUNES SEA EL PRIMER DIA
		onAfterEventsLoad: function(events) {
			if(!events) {
				return;
			}
			var list = $('#eventlist');
			list.html('');

			$.each(events, function(key, val) {
				$(document.createElement('li'))
					.html('<a href="' + val.url + '">' + val.title + '</a>')
					.appendTo(list);
			});
		},
		onAfterViewLoad: function(view) {
			$('.page-header h3').text(this.getTitle());
			$('.btn-group button').removeClass('active');
			$('button[data-calendar-view="' + view + '"]').addClass('active');
		},
		classes: {
			months: {
				general: 'label'
			}
		}
	};

	var calendar = $('#calendar').calendar(options);

	$('.btn-group button[data-calendar-nav]').each(function() {
		var $this = $(this);
		$this.click(function() {
			calendar.navigate($this.data('calendar-nav'));
		});
	});

	$('.btn-group button[data-calendar-view]').each(function() {
		var $this = $(this);
		$this.click(function() {
			calendar.view($this.data('calendar-view'));
		});
	});

	$('#first_day').change(function(){
		var value = $(this).val();
		value = value.length ? parseInt(value) : null;
		calendar.setOptions({first_day: value});
		calendar.view();
	});

	$('#language').change(function(){
								   
		calendar.setLanguage($(this).val());
		calendar.view();
	});

	$('#events-in-modal').change(function(){
		var val = $(this).is(':checked') ? $(this).val() : null;
		calendar.setOptions({modal: val});
	});
	$('#format-12-hours').change(function(){
		var val = $(this).is(':checked') ? true : false;
		calendar.setOptions({format12: val});
		calendar.view();
	});
	$('#show_wbn').change(function(){
		var val = $(this).is(':checked') ? true : false;
		calendar.setOptions({display_week_numbers: val});
		calendar.view();
	});
	$('#show_wb').change(function(){
		var val = $(this).is(':checked') ? true : false;
		calendar.setOptions({weekbox: val});
		calendar.view();
	});
	$('#events-modal .modal-header, #events-modal .modal-footer').click(function(e){
		//e.preventDefault();
		//e.stopPropagation();
	});
}(jQuery));

