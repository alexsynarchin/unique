$(document).ready(function(){
    var processCar = $('.mp-process__list'),
        mpAdvantagesCar=$('.mp-advantages'),
        mpReviewsCar=$('.mp-reviews-list'),
        processOptions = {
            dots:false,
            margin:10,
            stagePadding:10,
            autoplay:false,
            responsiveClass:true,
            nav:false,

            responsive:{
                0:{

                    items:1,
                },
                768:{
                    margin:20,
                    items:2,
                },
            },
            autoplayTimeout:10000,
        },
        mpAdvantagesOptions = {
            dots:false,
            margin:10,
            stagePadding:30,
            autoplay:false,
            responsiveClass:true,
            nav:false,

            responsive:{
                0:{

                    items:1,
                },
                768:{
                    margin:20,
                    items:2,
                },
            },
            autoplayTimeout:10000,
        },
        mpReviewsOptions = {
            dots:false,
            margin:10,
            stagePadding:10,
            autoplay:false,
            responsiveClass:true,
            nav:false,

            responsive:{
                0:{
                    stagePadding:10,
                    items:1,
                },
                768:{
                    margin:20,
                    items:2,
                },
                1024: {
                    stagePadding:30,
                }
            },
            autoplayTimeout:10000,
        }
    ;
    function owlInitialize() {

        if (window.matchMedia('(max-width: 1023px)').matches) {
            processCar.owlCarousel(processOptions);
            processCar.addClass('owl-carousel owl-theme');
            processCar.removeClass('row');
            mpAdvantagesCar.owlCarousel(mpAdvantagesOptions);
            mpAdvantagesCar.addClass('owl-carousel owl-theme');
            mpAdvantagesCar.removeClass('row');
        } else {
            processCar.owlCarousel('destroy');
            processCar.removeClass('owl-carousel owl-theme');
            processCar.addClass('row');

            mpAdvantagesCar.owlCarousel('destroy');
            mpAdvantagesCar.removeClass('owl-carousel owl-theme');
            mpAdvantagesCar.addClass('row');

        }
    }
    $(document).ready(function(e) {
        owlInitialize();
    });

    $(window).resize(function() {
        owlInitialize();

    });
    $(".mp-reviews-list").owlCarousel({
        dots:false,
        margin:30,
        autoplay:false,
        responsiveClass:true,
        navText:['<i aria-hidden="true" class="fas fa-chevron-left"></i>','<i aria-hidden="true" class="fas fa-chevron-right"></i>' ],
        responsive:{
            0:{
                loop:true,
                items:1,
                nav:true,
                navContainer:'.landing-reviews__nav',
                autoHeight:true,
                stagePadding: 50
            },
            768:{
                items:2,
                nav:false,
                loop:false
            },
            1000:{
                items:2,
                nav:false,
                loop:false
            }
        },
        autoplayTimeout:10000,
    });
});
