$(function(){

    let href = window.location.href;

    /* Highlighting navbar */

	$('.navbar-nav > li > a[href="'+href+'"]').parent().addClass('active');

});