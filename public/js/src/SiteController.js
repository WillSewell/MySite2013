SiteController = {
    init: function() {
        require.config({
            urlArgs: "bust=" + Math.floor((Math.random()*100)+1) // CACHEBUSTER - REMOVE IN PROD
        });
        require(['lib/jquery', 'lib/html5'], function() {
            require(['lib/pagify'], function() {
                $(window).scroll(SiteController.sticky_nav_listener);
                $(window).resize(SiteController.sticky_nav_listener);
                $('#main').pagify({
                    pages: ['home', 'blog', 'contact'],
                    animation: 'fadeIn',
                    onChange: function(page) {
                        // check the page, and include the required files
                        if (page === 'blog') {
                            SiteController.append_stylesheet('../css/styles.css');
                            require(['BlogController'], function() {
                                BlogController.init();
                            });
                        } else if (page === 'contact') { 
                            SiteController.append_stylesheet('../css/contact.css');
                        }
                    }
                });
            });
        });
    },
    sticky_nav_listener: function() {
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
    },
    append_stylesheet: function(path) {
        if ($('head link[href="' + path + '"]').length === 0) { // is it already there?
            if (document.createStyleSheet) { // IE uses this
                document.createStyleSheet(path);
            } else {
                $('head').append('<link rel="stylesheet" href="' + path + '" type="text/css" />');
            }
        }
    }
};

SiteController.init();