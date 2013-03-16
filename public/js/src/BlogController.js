BlogController = {
    init: function() {
        $(window).scroll(function () {
            // if scrolled to the bottom, requests more posts
            if ($(window).scrollTop() >= $(document).height() - $(window).height() - 10) {
                $.get('blog/getMorePosts/' + $('#posts div').length, function(posts) {
                    $('#posts').append(posts);
                });
            }
        });
    }
}