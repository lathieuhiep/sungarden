<?php
get_header();

$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );

sungarden_breadcrumbs( $term->name );
?>

	<div class="site-container site-cat-service">
		<?php if ( have_posts() ) : ?>

            <div class="container warp-product">
                <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 custom-row">
	                <?php while (have_posts()) : the_post(); ?>

                        <div class="col item-col custom-col d-flex">
                            <div class="d-flex flex-grow-1">
                                <div class="item-post d-flex flex-column flex-grow-1">
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

                                        <a class="item-link" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
		                                    <?php esc_html_e('Xem chi tiết', 'sungarden'); ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

	                <?php endwhile; ?>
                </div>

                <?php sungarden_pagination(); ?>
            </div>

        <?php endif; ?>
	</div>

<?php get_footer(); ?>