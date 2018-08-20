$(document).ready(function () {
    $("#owl-demo").owlCarousel({
        navigation: true,
        navigationText: ['&lsaquo;','&rsaquo;'],
        slideSpeed: 300,
		autoPlay:true,
        paginationSpeed: 400,
        singleItem: true,
        afterInit: makePages,
        afterUpdate: makePages
    });
    function makePages() {
        $.each(this.owl.userItems, function(i) {
            $('.owl-controls .owl-page').eq(i)
                .css({
                    'background': 'url(' + $(this).find('img').attr('src') + ')',
                    'background-size': 'cover'
                })
        });
    }
});