jQuery(document).ready(function($){
    
    if( $('.our-projects .col').length > 0 ){
        $('.text-holder').each(function(){ 
            new PerfectScrollbar($(this)[0]); 
        });
    }

    //mobile-menu
    $('.menu-opener').on( 'click', function() {
        $('body').addClass('menu-open');
        $('.mobile-menu .primary-navigation').addClass('toggled');
    });

    $('.overlay').on( 'click', function() {
        $('body').removeClass('menu-open');
        $('.mobile-menu .primary-navigation').removeClass('toggled');
    });

    $('.close-mobile-menu').on( 'click', function() {
        $('.mobile-menu .primary-navigation').removeClass('toggled');
        $('body').removeClass('menu-open');
    });

    $('<button class="open-submenu "></button>').insertAfter($('.mobile-menu ul .menu-item-has-children > a'));
    $('.mobile-menu ul li .open-submenu ').on( 'click', function() {
        $(this).next().slideToggle();
        $(this).toggleClass('active');
    });

    //accessible menu for edge
    $("#site-navigation ul li a").on( 'focus', function() {
       $(this).parents("li").addClass("focus");
    }).on( 'blur', function() {
       $(this).parents("li").removeClass("focus");
    });
});
