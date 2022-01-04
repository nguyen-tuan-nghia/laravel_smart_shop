$(window).load(function() {
    $('#preload').delay(100).fadeOut('fast', function() {
        $('body').removeClass('preloading');
    });
});