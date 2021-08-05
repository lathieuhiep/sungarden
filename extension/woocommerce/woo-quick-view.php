<?php

/*
* Quick view product
*/
function basictheme_button_quick_view() {

?>

    <a class="btn-quick-view-product" href="#" title="<?php esc_attr_e( 'Quick view product', 'basictheme' ); ?>" data-id-product="<?php echo esc_attr( get_the_ID() ); ?>" data-bs-toggle="modal" data-bs-target="#mode-quick-view-product">
        <?php esc_html_e('Xem nhanh'); ?>
    </a>

<?php

}

function basictheme_popup_quick_view_product() {

?>

    <div class="modal fade mode-quick-view-product" id="mode-quick-view-product" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="loading-body">
                        <div class="icon-loading"></div>
                    </div>
                    <div class="quick-view-product-body"></div>
                </div>
            </div>
        </div>
    </div>

<?php

}

/* Ajax quick view product */
add_action( 'wp_ajax_nopriv_basictheme_get_quick_view_product', 'basictheme_get_quick_view_product' );
add_action( 'wp_ajax_basictheme_get_quick_view_product', 'basictheme_get_quick_view_product' );

function basictheme_get_quick_view_product() {

    $product_id   =   $_POST['product_id'];

    $args = array(
	    'post_type' =>  'product',
        'post__in'  =>  array( $product_id )
    );

	$query = new WP_Query( $args );

	while ( $query->have_posts() ): $query->the_post();

        get_template_part( 'extension/woocommerce/quickview/content', 'quickview' );

	endwhile; wp_reset_postdata();
    wp_die();
}

/* Quick view product image */
function basictheme_quick_view_product_image() {
    get_template_part( 'extension/woocommerce/quickview/product', 'image' );
}