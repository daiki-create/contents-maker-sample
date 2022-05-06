(function( $ ) {
	
	$( '.date' ).datetimepicker({
		lang: 'ja',
		timepicker: false,
		format: 'Y/m/d',
		closeOnDateSelect: true,
		scrollMonth: false
	});
	
	$( '.reserve-date' ).datetimepicker({
		lang: 'ja'
	});
	
})( jQuery );