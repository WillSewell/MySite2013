BlogController = {
    init: function() {
        $(window).scroll(function () { 
            if ($(window).scrollTop() >= $(document).height() - $(window).height() - 10) {
                console.log('here');
                $.post('blog/getMorePosts', function(posts){
                    $('#posts').append(posts);
                });
            }
        });
    }
}