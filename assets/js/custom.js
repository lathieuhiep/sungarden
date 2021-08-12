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
                resizeSensor: true
            });
        }

        // custom fancybox
        let projectGallery = $('.project-gallery');
        if ( projectGallery.length ) {
            projectGallery.fancybox({
                transitionEffect: "slide",
                slideClass: "abc",
                baseClass: "projec-fancybox-custom",
                clickContent: false,
                hash : false,
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
                }
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

    });

    // loading
    $( window ).on( "load", function() {

        $( '#site-loadding' ).remove();

    });

    // scroll event
    $( window ).scroll( function() {

        if ( timer_clear ) clearTimeout(timer_clear);

        timer_clear = setTimeout( function() {

            /* Start scroll back top */
            let $scrollTop = $(this).scrollTop();

            if ( $scrollTop > 200 ) {
                $('#back-top').addClass('active_top');
            }else {
                $('#back-top').removeClass('active_top');
            }
            /* End scroll back top */

        }, 100 );

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

} )( jQuery );