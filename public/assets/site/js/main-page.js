$(document).ready(function(){
    var processCar = $('.mp-process__list'),
        mpAdvantagesCar=$('.mp-advantages'),
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
});
