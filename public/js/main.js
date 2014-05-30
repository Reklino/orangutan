$(document).ready(function(){


	$('#clicks').click( function(){

		alert('hmm...');

		$($(this).data("target")).slideToggle();

	});


});