BlogController = {
    init: function() {
        $(window).scroll(function () { 
            if ($(window).scrollTop() >= $(document).height() - $(window).height() - 10) {
                $.post(window.location.hostname + '/blog/getMorePosts', function(posts){
                    $('#posts').append(posts);
                });
            }
        });
    }
}