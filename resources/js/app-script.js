$(function(){

    let href = window.location.href;

    /* Highlighting admin navbar */
    $('.navbar-nav > li > a[href="'+href+'"]').parent().addClass('active');
    
    /* Highlighting admin navbar */
	$('.app-left-sidebar-ul > li > a[href="'+href+'"]').parent().addClass('active');

    /* Change the value of Choose file after the file has been chosen */
    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });

    /* For button back to top */
    $(window).scroll(function () {
		if ($(this).scrollTop() > 1000) {
			$('#back-to-top').fadeIn();
		} else {
			$('#back-to-top').fadeOut();
		}
	});
	
	// scroll body to 0px on click
	$('#back-to-top').click(function () {			
		$('body,html').animate({
			scrollTop: 0
		}, 800);
		return false;
    });

    /* For confirm plugin */
    $('.confirm-plugin-delete').jConfirmAction({
        question: 'Are you sure?',
        noText: 'Cancel'
    });



});

$(window).on('load', function() {

    /* In order a thumbnail of any size to be displayed normally */
    if ($(document).width() > 767) {

        var thumbnail = $('.app-thubnail-nav-link .app-thubnail-wrapper');

        if (thumbnail) {
            var thumbnailWidth = thumbnail.outerWidth();
            thumbnail.css('left', -thumbnailWidth);
        }
    }

});
