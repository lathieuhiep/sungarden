/**
 * Custom js v1.0.0
 * Copyright 2017-2020
 * Licensed under  ()
 */

( function( $ ) {

    "use strict";

    let timer_clear;

    $( document ).ready( function () {

        /* Start back top */
        $('#back-top').on( 'click', function (e) {

            e.preventDefault();
            $( 'html, body' ).animate( {
                scrollTop: 0
            }, 700 );

        } );
        /* End back top */

        /* btn mobile Start*/
        let menu_item_has_children  =   $( '.site-menu .menu-item-has-children' ),
            navbar_toggler          =   $( '.site-navbar .navbar-toggler' );

        if ( menu_item_has_children.length ) {

            $('.site-menu .menu-item-has-children > a').after( "<span class='icon_menu_item_mobile'></span>" );

            let icon_menu_item_mobile  =   $('.icon_menu_item_mobile');

            icon_menu_item_mobile.each(function () {

                $(this).on( 'click', function () {

                    $(this).toggleClass('icon_menu_item_mobile_active');
                    $(this).parents( '.menu-item-has-children' ).siblings().find( '.icon_menu_item_mobile' ).removeClass( 'icon_menu_item_mobile_active' );
                    $(this).parent().children( '.sub-menu' ).slideToggle();
                    $(this).parents( '.menu-item-has-children' ).siblings().find( '.sub-menu' ).slideUp();

                } )

            })

        }
        /* btn mobile End */

        /* Start Gallery Single */
        $( document ).general_owlCarousel_custom( '.site-post-slides' );
        /* End Gallery Single */

        // Sticky sidebar
        let sidebar = $('.sidebar');

        if ( sidebar.length ) {
            sidebar.stickySidebar({
                topSpacing: 60,
                bottomSpacing: 0,
                innerWrapperSelector: '.sidebar__inner',
                containerSelector: '.container',
                resizeSensor: false
            });
        }

        // custom fancybox
        let projectGallery = $('.project-gallery');
        if ( projectGallery.length ) {
            projectGallery.fancybox({
                transitionEffect: "slide",
                baseClass: "projec-fancybox-custom",
                clickContent: false,
                hash : false,
                idleTime: false,
                caption : function( instance, item ) {
                    let caption = $(this).data('caption') || '';

                    if ( item.type === 'image' ) {
                        caption = '<div class="project-caption-item">' +
                            '<h4 class="title-item">'+ caption.title +'</h4>' +
                            '<a href="'+ caption.link +'">'+ caption.textLink +'</a>' +
                            '</div>';
                    }

                    return caption;
                },
                afterShow: function (instance, item) {
                    if (instance.$caption) {
                        const dataCaption = instance.$caption;

                        item.$content.append(dataCaption);
                        $('.project-caption-item').fadeIn();
                    }
                },
            });
        }

        // popup video
        let playVideo = $('.play-video');
        if ( playVideo.length ) {
            playVideo.fancybox({
                youtube : {
                    controls : 1,
                    showinfo : 1
                },
                vimeo : {
                    color : 'f00'
                }
            });
        }

        let wow = new WOW(
            {
                boxClass:     'wow',      // animated element css class (default is wow)
                animateClass: 'animated', // animation css class (default is animated)
                offset:       10,          // distance to the element when triggering the animation (default is 0)
                mobile:       true,       // trigger animations on mobile devices (default is true)
                live:         true,       // act on asynchronously loaded content (default is true)
                scrollContainer: null,    // optional scroll container selector, otherwise use window,
                resetAnimation: true,     // reset animation on end (default is true)
            }
        );
        wow.init();

        // slick product detail
        let productThubnailSlick = $('.product-thubnail-slick');

        if ( productThubnailSlick ) {
            productThubnailSlick.slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: false,
                fade: true,
                adaptiveHeight: true,
                asNavFor: '.product-thubnail-nav',
            });

            $('.product-thubnail-nav').slick({
                slidesToShow: 3,
                slidesToScroll: 1,
                asNavFor: productThubnailSlick,
                dots: false,
                centerMode: false,
                focusOnSelect: true,
                prevArrow: '<button type="button" class="slick-prev"><i class="fas fa-chevron-left"></i></button>',
                nextArrow: '<button type="button" class="slick-next"><i class="fas fa-chevron-right"></i></button>'
            });

        }

        // related product
        $( document ).general_owlCarousel_custom_event( '.related-product__owl' );


        $('.project-gallery-popup').magnificPopup({
            delegate: '.item-post__thumbnail',
            type: 'image',
            gallery: {
                enabled:true
            },
            mainClass: 'mfp-with-zoom',
            removalDelay: 500,
            zoom: {
                enabled: true,
                duration: 300,
                easing: 'ease-in-out',
                opener: function(openerElement) {
                    return openerElement.is('img') ? openerElement : openerElement.find('img');
                }
            },
            image: {
                titleSrc: function(item) {
                    let caption = JSON.parse( item.el.attr('data-mfp-content') ) || '' ;

                    return '<h4 class="title-item">'+ caption.title +'</h4>' + '<a href="'+ caption.link +'">'+ caption.textLink +'</a>';
                }
            }
        });

    });

    // loading
    $( window ).on( "load", function() {

        $( '#site-loadding' ).remove();

    });

    // function call owlCarousel
    $.fn.general_owlCarousel_custom = function ( class_item ) {

        let class_item_owlCarousel   =   $( class_item );

        if ( class_item_owlCarousel.length ) {

            class_item_owlCarousel.each( function () {

                let slider = $(this);

                if ( !slider.hasClass('owl-carousel-init') ) {

                    let defaults = {
                        autoplaySpeed: 800,
                        navSpeed: 800,
                        dotsSpeed: 800,
                        autoHeight: false,
                        navText: ['<i class="fas fa-chevron-left"></i>','<i class="fas fa-chevron-right"></i>'],
                    };

                    let config = $.extend( defaults, slider.data( 'settings-owl') );

                    slider.owlCarousel( config ).addClass( 'owl-carousel-init' );

                }

            } )

        }

    }

    // function call owlCarousel event
    $.fn.general_owlCarousel_custom_event = function ( class_item ) {

        let class_item_owlCarousel   =   $( class_item );

        if ( class_item_owlCarousel.length ) {

            class_item_owlCarousel.each( function () {

                let slider = $(this),
                    defaults = {
                    autoplaySpeed: 800,
                    navSpeed: 800,
                    dotsSpeed: 800,
                    autoHeight: false,
                    navText: ['<i class="fas fa-chevron-left"></i>','<i class="fas fa-chevron-right"></i>'],
                },
                    config = $.extend( defaults, slider.data( 'settings-owl') );

                slider.owlCarousel( config );

                // Go to the next item
                $('.custom-next-btn').each( function () {
                    $(this).on('click', function () {
                        $(this).closest('.owl-event-style').find('.custom-owl-event').trigger('next.owl.carousel', [800]);
                    })
                } )

                // Go to the previous item
                $('.custom-prev-btn').each( function () {
                    $(this).on('click', function () {
                        $(this).closest('.owl-event-style').find('.custom-owl-event').trigger('prev.owl.carousel', [800]);
                    })
                } )

            } )

        }

    }

} )( jQuery );