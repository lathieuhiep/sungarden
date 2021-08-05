/**
 * Quick view product
 */

(function ($) {
    "use strict";

    // quick view product
    let mode_quick_view_product = $('.mode-quick-view-product'),
        btn_quick_view_product = $('.btn-quick-view-product'),
        loading_body = $('.loading-body'),
        quick_view_product_body = $('.quick-view-product-body');

    btn_quick_view_product.on('click', function (e) {
        e.preventDefault();

        let product_id = $(this).data('id-product');

        $.ajax({
            url: woo_quick_view_product.url,
            type: 'POST',
            data: ({

                action: 'basictheme_get_quick_view_product',
                product_id: product_id

            }),

            success: function (data) {
                if (data) {
                    quick_view_product_body.empty().append(data);
                    loading_body.fadeOut();
                }
            },

            complete: function(){
                a(product_id);
            },
        });
    });

    let a = function (product_id) {
        let n = $("#et-quickview"),
            e = n.children("#product-" + product_id),
            t = e.find("form.cart"),
            hasProductVariable = e.hasClass("product-type-variable"),
            i = $("#et-quickview-slider");

        e.find('.et-quickview-owl').owlCarousel({
            items: 1,
            loop: true,
            nav: false,
            autoplaySpeed: 800,
            navSpeed: 800,
            dotsSpeed: 800,
        });

        if ( hasProductVariable ) {
            t.wc_variation_form().find(".variations select:eq(0)").change();

            if ( i.length ) {
                if ( i.hasClass("owl-carousel") ) {
                    i = $(".owl-item:not(.cloned)", i).eq(0);
                }

                a = $(".woocommerce-product-gallery__image", i).eq(0).find("img");
                e = a.attr("src");

                if ( a.attr("data-src") ) {
                    e = a.attr("data-src");
                }

                t.on("show_variation", function (e, t) {
                    t.hasOwnProperty("image") && t.image.src && t.image.src != a.attr("src") && (a.attr("src", t.image.src).attr("srcset", ""),
                    i.hasClass("slick-initialized") && i.slick("slickGoTo", 0))
                }).on("reset_image", function () {
                    a.attr("src", e).attr("srcset", "")
                })
            }
        }
    }

    mode_quick_view_product.on('hidden.bs.modal', function () {

        loading_body.fadeIn();
        quick_view_product_body.empty();

    })

    // add product quick view
    quick_view_product_body.on('click', '.single_add_to_cart_button', function (e) {
        e.preventDefault();

        let $form = $(this).closest('form.cart'),
            id = $(this).val(),
            product_qty = $form.find('input[name=quantity]').val() || 1,
            product_id = $form.find('input[name=product_id]').val() || id,
            variation_id = $form.find('input[name=variation_id]').val() || 0;

        console.log( {
            id: id,
            product_qty: product_qty,
            product_id: product_id,
            variation_id: variation_id
        } )
    })

})(jQuery);