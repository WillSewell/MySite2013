function sticky_nav_listener() {
    if ($(window).scrollTop() > 0) {
        $('#header').addClass('fixed').css({
            'top'  : '0',
            'width': $('#page').width()
        });
        //$('#main').css('padding-top','3em');
    } else {

        $('#header').removeClass('fixed');
        //$('#main').css('padding-top','0em');
    }
}

function append_stylesheet(path) {
    if ($('head link[href="' + path + '"]').length === 0) { // is it already there?
        if (document.createStyleSheet) { // IE uses this
            document.createStyleSheet(path);
        } else {
            $('head').append('<link rel="stylesheet" href="' + path + '" type="text/css" />');
        }
    }
}