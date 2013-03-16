BlogController = {
    areMorePosts: true,
    init: function() {
        $(window).scroll(function () {
            // if scrolled to the bottom, requests more posts
            if ($(window).scrollTop() >= $(document).height() - $(window).height() - 10
                && BlogController.areMorePosts
            ) {
                $.get('blog/getMorePosts/' + $('#posts div').length, function(posts) {
                    if (posts) {
                        $('#posts').append(posts);
                    } else {
                        BlogController.areMorePosts = false;
                    }
                });
            }
        });
    }
}