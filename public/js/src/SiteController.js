SiteController = {
    init: function() {
        require.config({
            urlArgs: "bust=" + Math.floor((Math.random()*100)+1) // CACHEBUSTER - REMOVE IN PROD
        });
        require(['lib/jquery', 'lib/html5', 'lib/less'], function() {
            require(['lib/pagify', 'site_listeners'], function() {
                $(window).scroll(sticky_nav_listener);
                $(window).resize(sticky_nav_listener);

                $('#main').pagify({
                    pages: ['home', 'blog', 'contact'],
                    animation: 'fadeIn',
                    onChange: function(page) {
                        // check the page, and include the required files
                        if (page === 'blog') {
                            append_stylesheet('../css/styles.css');
                            require(['BlogController'], function() {
                                BlogController.init();
                            });
                        } else if (page === 'contact') { 
                            append_stylesheet('../css/contact.css');
                            require(['ContactController'], function() {
                                ContactController.init();
                            });
                        }
                    }
                });

                $('#contact_link').click(function() {
                    append_stylesheet('../css/contact.css');
                })
            });
        });
    }
};

SiteController.init();