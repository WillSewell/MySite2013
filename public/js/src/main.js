require(['lib/jquery', 'lib/html5', 'lib/less'], function() {
    require(['lib/pagify', 'site_listeners'], function() {
        $(window).scroll(sticky_nav_listener);
        $(window).resize(sticky_nav_listener);
        
        NAME_DEFAULT_VAL = 'Your name'; // refactor into class, make these fields?
        EMAIL_DEFAULT_VAL = 'Your email';
        MSG_DEFAULT_VAL = 'And your message';
        
        $('#main').pagify({
            pages: ['home', 'blog', 'contact'],
            animation: 'fadeIn',
            onChange: function(page) {
                // check if we are on the contact page
                if (page === 'contact') { 
                    append_stylesheet('../css/contact.css');
                    require(['contact_listeners'], function() {
                        $('#contact_submit_button').click(contact_submit_listener);
                        $('.text_box').focus(text_box_focus_on);
                        $('#name_text_box').val(NAME_DEFAULT_VAL);
                        $('#name_text_box').blur(function(event) {
                            text_box_focus_out(NAME_DEFAULT_VAL, $(event.target));
                        });
                        $('#email_text_box').val(EMAIL_DEFAULT_VAL);
                        $('#email_text_box').blur(function(event) {
                            text_box_focus_out(EMAIL_DEFAULT_VAL, $(event.target));
                        });
                        $('#msg_text_area').val(MSG_DEFAULT_VAL);
                        $('#msg_text_area').blur(function(event) {
                            text_box_focus_out(MSG_DEFAULT_VAL, $(event.target));
                        });
                    });
                } else if (page === 'blog') {
                    append_stylesheet('../css/blog.css');
                }
            }
        });
        
        $('#contact_link').click(function() {
            append_stylesheet('../css/contact.css');
        });
        
        
    });
});