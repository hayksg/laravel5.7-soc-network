$(function(){

    let href = window.location.href;

    /* Highlighting navbar */

	$('.navbar-nav > li > a[href="'+href+'"]').parent().addClass('active');

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
 












});

$(window).on('load', function() {

    let pathname = window.location.pathname;

    /*  */
    var thumbnail = $('.app-thubnail-nav-link .app-thubnail-wrapper');

    if (thumbnail) {
        var thumbnailWidth = thumbnail.outerWidth();
        thumbnail.css('left', -thumbnailWidth);
    }

    /*  */



    var i = 0;
    var txt = $('.app-message').data('message');
    var txtLength = txt.length;
    var speed = 50;
    var output = '';

    function typeWriter() {
      if (txt && i < txtLength) {
        output += txt.charAt(i);
        $('.app-message').text(output);
        i++;
        setTimeout(typeWriter, speed);
      }
    }

    if (pathname.search('profiles') === 1) {
        typeWriter();
    }


});

