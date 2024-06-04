$(function () {

    // init feather icons
    feather.replace();

    // init tooltip & popovers
    $('[data-toggle="tooltip"]').tooltip();
    $('[data-toggle="popover"]').popover();

    //page scroll
    $('a.page-scroll').bind('click', function (event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top - 50
        }, 1000);
        event.preventDefault();
    });

    //toggle scroll menu
    $(window).scroll(function () {
        var scroll = $(window).scrollTop();
        //adjust menu background
        if (scroll >= 100) {
            $('.sticky-navigation').addClass('navbar-shadow');
        } else {
            $('.sticky-navigation').removeClass('navbar-shadow');
        }
        
        // adjust scroll to top
        if (scroll >= 600) {
            $('.scroll-top').addClass('active');
        } else {
            $('.scroll-top').removeClass('active');
        }
        return false;
    });

    // scroll top top
    $('.scroll-top').click(function () {
        $('html, body').stop().animate({
            scrollTop: 0
        }, 1000);
    });

    
    // $('.switcher-trigger').click(function () {
    //     $('.switcher-wrap').toggleClass('active');
    // });
    // $('.color-switcher ul li').click(function () {
    //     var color = $(this).attr('data-color');
    //     $('#theme-color').attr("href", "css/" + color + ".css");
    //     $('.color-switcher ul li').removeClass('active');
    //     $(this).addClass('active');
    // });
});
/**Theme switcher - DEMO PURPOSE ONLY */
document.querySelector('.switcher-trigger').addEventListener('click', function() {
    document.querySelector('.switcher-wrap').classList.toggle('active');
});

// Change theme color
document.querySelectorAll('.color-switcher ul li').forEach(function(element) {
    element.addEventListener('click', function() {
        var color = this.getAttribute('data-color');
        document.querySelector('#theme-color').setAttribute('href', 'css/' + color + '.css');
        document.querySelectorAll('.color-switcher ul li').forEach(function(item) {
            item.classList.remove('active');
        });
        this.classList.add('active');
    });
});