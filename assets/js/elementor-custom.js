(function ($) {

    /* Start carousel slider */
    let ElementCarouselSlider   =   function( $scope, $ ) {

        let element_slides = $scope.find( '.custom-owl-carousel' );

        $( document ).general_owlCarousel_custom( element_slides );

    };

    // Element carousel custom event
    let ElementCarouselCustomEvent = function ($scope, $) {
        let element_slides = $scope.find( '.custom-owl-event' );

        $( document ).general_owlCarousel_custom_event( element_slides );
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

    } );

})( jQuery );