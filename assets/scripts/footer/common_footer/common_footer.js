

$(document).ready( function() {
	$('.FooterUpperColumn').on('click', function() {
		if ($(this).hasClass('FooterUpperColumn-inactive')) {
			$(this).removeClass('FooterUpperColumn-inactive');
		}
		else {
			$(this).addClass('FooterUpperColumn-inactive');
		}
	});
});
