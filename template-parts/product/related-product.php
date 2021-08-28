<?php
global $sungarden_options;

$limit = 12;
$terms = get_the_terms( get_the_ID(), 'sungarden_product_cat' );

$data_settings_owl = [
	'loop'       => true,
	'nav'        => false,
	'dots'       => false,
	'margin'     => 18,
	'responsive' => [
		'0'   => array(
			'items'  => 2,
			'margin' => 2
		),
		'576' => array(
			'items'  => 3,
			'margin' => 12
		),
		'768' => array(
			'items' => 4
		),
		'992' => array(
			'items' => 6
		)
	],
];

if ( ! empty( $terms ) ):

	$termIds = array();

	foreach ( $terms as $item ) {
		$termIds[] = $item->term_id;
	}

	$args = array(
		'post_type'      => 'sungarden_product',
		'post__not_in'   => array( get_the_ID() ),
		'posts_per_page' => $limit,
		'tax_query'      => array(
			array(
				'taxonomy' => 'sungarden_product_cat',
				'field'    => 'term_id',
				'terms'    => $termIds
			),
		)
	);

	$query = new WP_Query( $args );

	if ( $query->have_posts() ) :
    ?>

        <div class="related-product owl-event-style">
            <div class="container">
                <div class="top-box top-box-style d-flex align-items-center">
                    <h3 class="heading flex-grow-0">
                        <?php esc_html_e('Xem các sản phẩm khác', 'sungarden'); ?>
                    </h3>

                    <div class="owl-nav-custom d-flex align-items-center">
                        <button type="button" class="custom-prev-btn">
                            <i class="fas fa-chevron-left"></i>
                        </button>

                        <span class="nav-line"></span>

                        <button type="button" class="custom-next-btn">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>

                    <span class="line flex-grow-1"></span>

                    <a class="link" href="<?php echo esc_url( get_term_link($termIds[0], 'sungarden_product_cat') ); ?>" target="_blank">
                        <span class="link__text">
                            <?php esc_html_e('Xem thêm sản phẩm', 'sungarden'); ?>
                        </span>

                        <span class="link__icon">
                            <i class="fas fa-long-arrow-alt-right"></i>
                        </span>
                    </a>
                </div>

                <div class="related-product__owl custom-owl-event owl-carousel owl-theme" data-settings-owl='<?php echo wp_json_encode( $data_settings_owl ) ; ?>'>
                    <?php
                    while ( $query->have_posts() ):
                        $query->the_post();
                    ?>
                        <div class="item-post">
                            <div class="item-post__thumbnail">
                                <?php
                                if ( has_post_thumbnail() ) :
                                    the_post_thumbnail( 'large' );
                                else:
                                    ?>
                                    <img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/no-image.png' ) ) ?>" alt="<?php the_title(); ?>"/>
                                <?php endif; ?>
                            </div>

                            <div class="item-post__content d-flex justify-content-center flex-column">
                                <h4 class="title-post">
                                    <a class="item-link" href="<?php the_permalink(); ?>" target="_blank" title="<?php the_title(); ?>">
                                        <?php the_title(); ?>
                                    </a>
                                </h4>

                                <p class="price">
                                    <?php esc_html_e('Giá', 'sungarden'); ?>:&nbsp;&nbsp<span><?php esc_html_e( 'Liên hệ' ); ?></span>
                                </p>
                            </div>


                        </div>
                    <?php
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
        </div>

	<?php
	endif;
endif;