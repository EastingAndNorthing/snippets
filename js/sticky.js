$(document).ready(function($) {

    var $wrapper   = $('.sidebar');
    var $stickyBox = $('.sidebar .contactPersonsOverview');
    
    var stickyBoxOffsetTop = $stickyBox.offset().top;

    $(window).scroll(function() {
        var scrollPos = $(window).scrollTop();
        var stickyPosition = 0;

        if(scrollPos >= $('.page-content').offset().top) {
            stickyPosition = scrollPos - stickyBoxOffsetTop;
        }

        if(scrollPos + $stickyBox.outerHeight(true) >= $wrapper.offset().top + $wrapper.outerHeight(true)) {
            stickyPosition = $wrapper.outerHeight(true) - $stickyBox.outerHeight(true);
        }

        $stickyBox.css({
            '-webkit-transform' : 'translateY(' + stickyPosition + 'px)',
            '-moz-transform'    : 'translateY(' + stickyPosition + 'px)',
            '-ms-transform'     : 'translateY(' + stickyPosition + 'px)',
            '-o-transform'      : 'translateY(' + stickyPosition + 'px)',
            'transform'         : 'translateY(' + stickyPosition + 'px)'
        });

    });
});
