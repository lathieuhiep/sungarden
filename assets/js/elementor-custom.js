(function ($) {

    /* Start carousel slider */
    const ElementCarouselSlider   =   function( $scope, $ ) {

        let element_slides = $scope.find( '.custom-owl-carousel' );

        $( document ).general_owlCarousel_custom( element_slides );

    };

    // Element carousel custom event
    const ElementCarouselCustomEvent = function ($scope, $) {
        let element_slides = $scope.find( '.custom-owl-event' );

        $( document ).general_owlCarousel_custom_event( element_slides );
    }

    // Element service detail content
    const ElementServiceDetailContent = function ($scope, $) {
        let text = $scope.find('.element-service-detail-content .content-desc'),
            readMoreService = $scope.find('.read-more-service'),
            h = text[0].scrollHeight;

        readMoreService.on('click', function () {
            $(this).addClass('d-none');
            text.animate({'height': h});
        });
    }

    // Element slider quick project
    const ElementSliderQuickProject = function ($scope) {

        let elementSlidesProject = $scope.find('.slider-quick-project');

        if ( elementSlidesProject ) {
            elementSlidesProject.slick({
                infinite: true,
                slidesToShow: 5,
                slidesToScroll: 1,
                prevArrow: '<button type="button" class="slick-prev"><i class="fas fa-chevron-left"></i></button>',
                nextArrow: '<button type="button" class="slick-next"><i class="fas fa-chevron-right"></i></button>',
                responsive: [
                    {
                        breakpoint: 767,
                        settings: {
                            slidesToShow: 4,
                            slidesToScroll: 4
                        }
                    },
                    {
                        breakpoint: 575,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3
                        }
                    }
                ]
            });
        }
    }

    $( window ).on( 'elementor/frontend/init', function() {

        /* Element slider */
        elementorFrontend.hooks.addAction( 'frontend/element_ready/sungarden-slides.default', ElementCarouselSlider );

        /* Element post carousel */
        elementorFrontend.hooks.addAction( 'frontend/element_ready/sungarden-post-carousel.default', ElementCarouselSlider );

        /* Element project carousel */
        elementorFrontend.hooks.addAction( 'frontend/element_ready/sungarden-project-carousel.default', ElementCarouselSlider );

        /* Element testimonial carousel */
        elementorFrontend.hooks.addAction( 'frontend/element_ready/sungarden-testimonial-carousel.default', ElementCarouselSlider );

        /* Element project slider */
        elementorFrontend.hooks.addAction( 'frontend/element_ready/sungarden-project-slider.default', ElementCarouselCustomEvent );

        /* Element video slider */
        elementorFrontend.hooks.addAction( 'frontend/element_ready/sungarden-video-slider.default', ElementCarouselCustomEvent );

        /* Element post slider */
        elementorFrontend.hooks.addAction( 'frontend/element_ready/sungarden-post-slider.default', ElementCarouselCustomEvent );

        /* Element quick view slider */
        elementorFrontend.hooks.addAction( 'frontend/element_ready/sungarden-quickview-slider.default', ElementCarouselSlider );

        /* Element service detail content */
        elementorFrontend.hooks.addAction( 'frontend/element_ready/sungarden-service-detail-content.default', ElementServiceDetailContent );

        /* Element slider quick project */
        elementorFrontend.hooks.addAction( 'frontend/element_ready/sungarden-slides.default', ElementSliderQuickProject );

    } );

})( jQuery );