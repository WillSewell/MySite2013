BlogController = {
    areMorePosts: true,
    waitingForPosts: false,
    init: function() {
        $(window).scroll(function () {
            // if scrolled to the bottom, requests more posts
            if ($(window).scrollTop() >= $(document).height() - $(window).height() - 10
                && BlogController.areMorePosts
                && !BlogController.waitingForPosts
            ) {
                console.log($('#posts div').length);
                BlogController.waitingForPosts = true;
                $.get('blog/getMorePosts/' + $('#posts div').length, function(posts) {
                    if (posts) {
                        $('#posts').append(posts);
                    } else {
                        BlogController.areMorePosts = false;
                    }
                    BlogController.waitingForPosts = false;
                });
            }
        });
    }
}