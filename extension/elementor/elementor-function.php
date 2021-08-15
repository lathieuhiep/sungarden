<?php
// content filter product cat


function sungarden_content_filter_product_cat( $query, $paged, $options) {
	?>

    <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 row-cols-xl-6 custom-row">
		<?php
		while ( $query->have_posts() ):
			$query->the_post();
			?>

            <div class="col item-col custom-col d-flex">
                <div class="d-flex wow animate fadeInUp" data-wow-duration="2s">
                    <div class="item-post d-flex flex-column">
                        <div class="item-post__thumbnail">
                            <?php
                            if ( has_post_thumbnail() ) :
                                the_post_thumbnail( 'large' );
                            else:
                                ?>
                                <img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/no-image.png' ) ); ?>"
                                     alt="<?php the_title(); ?>"/>
                            <?php endif; ?>
                        </div>

                        <div class="item-post__content d-flex flex-column flex-grow-1">
                            <h5 class="title flex-grow-1">
                                <a href="<?php the_permalink(); ?>">
	                                <?php the_title(); ?>
                                </a>
                            </h5>

                            <p class="price">
                                <span>
                                    <?php esc_html_e( 'Giá', 'sungarden' ); ?>:
                                </span>

                                <span>
                                    <?php esc_html_e( 'Liên hệ', 'sungarden' ); ?>
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

		<?php
        endwhile;
		wp_reset_postdata();
		?>
    </div>

	<?php sungarden_paging_nav_query_ajax($query, $paged, $options); ?>

	<?php
}

/* Start ajax filter cat product */
add_action( 'wp_ajax_nopriv_sungarden_filter_product_cat', 'sungarden_filter_product_cat' );
add_action( 'wp_ajax_sungarden_filter_product_cat', 'sungarden_filter_product_cat' );

function sungarden_filter_product_cat() {

	$options = $_POST['options'];
	$pageAjax = $_POST['ajax_paged'];
	$paged = isset ( $pageAjax ) ? intval( $pageAjax ) : '';

	if ( !empty( $options['termId'] ) ) :
        $tax_query = array(
			array(
				'taxonomy' => 'sungarden_product_cat',
				'field'    => 'term_id',
				'terms'    => $options['termId']
			),
		);
	else:
		$tax_query = '';
	endif;

	$args = array(
		'post_type'           => 'sungarden_product',
		'posts_per_page'      => $options['limit'],
		'paged'               => $paged,
		'orderby'             => $options['orderBy'],
		'order'               => $options['order'],
		'ignore_sticky_posts' => 1,
		'tax_query'           => $tax_query
	);

	$query = new WP_Query( $args );

	sungarden_content_filter_product_cat($query, $paged, $options);

	wp_die();
}