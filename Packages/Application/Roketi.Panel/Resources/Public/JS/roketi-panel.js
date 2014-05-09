$(document).ready(function() {

	// roll over effect on the login page
	$('body.roketi-loginform .input-group input').hover(
		function() {
			$(this).parent().find('span').addClass('rollover');
			$(this).addClass('rollover');
		},
		function() {
			$(this).parent().find('.rollover').removeClass('rollover');
		}
	);

});
