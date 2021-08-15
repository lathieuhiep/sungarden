/**
 * Quick view product
 */

(function ($) {
    "use strict";

    // filter cate product
    let elementProductGrid = $('.element-product-grid'),
        contentProduct = $('.warp-product'),
        navFilter = $('.element-product-grid__nav'),
        productCatItem = $('.product-nav-cat__item'),
        warpProduct = elementProductGrid.find('.warp-product'),
        heightProductGrid = warpProduct.innerHeight();

    productCatItem.on('click', function () {
        let options = $(this).data('options'),
            hasActive = $(this).hasClass('active');

        if ( !hasActive ) {
            let productBoxGrid = $(this).closest('.element-product-grid'),
                heightContent = productBoxGrid.innerHeight();

            elementProductGrid.addClass('active-load');
            navFilter.find('li').removeClass('active');
            $(this).addClass('active');

            $.ajax({
                url: filter_product_cat_product.url,
                type: 'POST',
                data: ({
                    action: 'sungarden_filter_product_cat',
                    options: options
                }),

                beforeSend: function () {
                    productBoxGrid.css('height', heightContent);
                },

                success: function (data) {
                    if (data) {
                        contentProduct.empty().append(data);
                        productBoxGrid.css('height', 'auto');
                    }
                },

                complete: function () {
                    setTimeout(function() {
                        elementProductGrid.removeClass('active-load');
                        }, 1000
                    );
                }
            });
        }
    });

    // paging product
    $('body').on('click', '.pagination-ajax a' , function (e) {
        e.preventDefault();


        let productBoxGrid = $(this).closest('.element-product-grid'),
            heightContent = productBoxGrid.innerHeight(),
            options = $(this).closest('.pagination-ajax').data('options'),
            hrefThis = $(this).attr('href'),
            paged = hrefThis.match(/\/\d+\//)[0];

        paged = paged.match(/\d+/)[0];
        if(!paged) paged = 1;
        elementProductGrid.addClass('active-load');

        $.ajax({
            url: filter_product_cat_product.url,
            type: 'POST',
            data: ({
                action: 'sungarden_filter_product_cat',
                options: options,
                ajax_paged : paged,
            }),

            beforeSend: function () {
                productBoxGrid.css('height', heightContent);
            },

            success: function (data) {
                if (data) {
                    contentProduct.empty().append(data);
                    productBoxGrid.css('height', 'auto');
                }
            },

            complete: function () {
                setTimeout(function() {
                    elementProductGrid.removeClass('active-load');
                    }, 1000
                );
            }
        });
    });

})(jQuery);