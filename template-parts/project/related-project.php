<?php
global $sungarden_options;

$limit   = $sungarden_options ['sungarden_opt_single_project_related_limit'] ?? 15;
$orderBy = $sungarden_options ['sungarden_opt_single_project_related_orderby'] ?? 'id';
$order   = $sungarden_options ['sungarden_opt_single_project_related_order'] ?? 'DESC';

$terms = get_the_terms( get_the_ID(), 'sungarden_project_cat' );

$data_settings_owl = [
	'loop'       => true,
	'nav'        => false,
	'dots'       => false,
	'margin'     => 8,
	'responsive' => [
		'0'   => array(
			'items'  => 2,
			'margin' => 2
		),

		'576' => array(
			'items'  => 3,
		),

		'768' => array(
			'items' => 4
		),
	],
];

if ( ! empty( $terms ) ):

	$term_ids = array();

	foreach ( $terms as $item_cat_post_id ) {
		$term_ids[] = $item_cat_post_id->term_id;
	}

	$args = array(
		'post_type'      => 'sungarden_project',
		'post__not_in'   => array( get_the_ID() ),
		'posts_per_page' => $limit,
		'orderby'        => $orderBy,
		'order'          => $order,
		'tax_query'      => array(
			array(
				'taxonomy' => 'sungarden_project_cat',
				'field'    => 'term_id',
				'terms'    => $term_ids
			),
		)
	);

	$query = new WP_Query( $args );

	if ( $query->have_posts() ) :
	?>

        <div class="element-project-slider element-project-style owl-event-style pt-5 pb-5">
            <div class="container-fluid">
                <div class="top-box top-box-style d-flex align-items-center">
                    <h3 class="heading flex-grow-0">
                        <?php esc_html_e( 'Những dự án khác', 'sungarden' ); ?>
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

                    <a class="link d-flex align-items-center" href="<?php echo esc_url( get_term_link( $term_ids[0], 'sungarden_project_cat' ) ); ?>">
                        <span class="link__text">
                            <?php esc_html_e( 'Xem thêm những dự án khác', 'sungarden' ); ?>
                        </span>

                        <span class="link__icon d-flex align-items-center justify-content-center">
                            <i class="fas fa-long-arrow-alt-right"></i>
                        </span>
                    </a>
                </div>

                <div class="related-product__owl custom-owl-event owl-carousel owl-theme" data-settings-owl='<?php echo wp_json_encode( $data_settings_owl ) ; ?>'>
                    <?php
                    while ( $query->have_posts() ):
                        $query->the_post();
                        $place = rwmb_meta( 'metabox_project_place' );
                        ?>
                        <div class="item-post">
                            <?php
                            if ( has_post_thumbnail() ) :
                                the_post_thumbnail( 'large' );
                            else:
                                ?>
                                <img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/no-image.png' ) ) ?>" alt="<?php the_title(); ?>"/>
                            <?php endif; ?>

                            <div class="content">
                                <h5 class="title">
                                    <?php the_title(); ?>
                                </h5>

                                <p class="place">
                                    <?php echo esc_html( $place ); ?>
                                </p>
                            </div>

                            <a class="link-item" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"></a>
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