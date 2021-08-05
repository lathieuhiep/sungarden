<?php

global $sungarden_options;

$sungarden_blog_sidebar_archive    =   $sungarden_options['sungarden_blog_sidebar_archive'] ? : 'right';
$sungarden_class_col_content       =   sungarden_col_use_sidebar( $sungarden_blog_sidebar_archive, 'sungarden-sidebar-main' );
$sungarden_blog_per_row            =   $sungarden_options['sungarden_blog_per_row'] ? : 3;

?>

<div class="site-container site-blog">
    <div class="container">
        <div class="row">
            <div class="<?php echo esc_attr( $sungarden_class_col_content ); ?>">
                <div class="site-post-content">
                    <?php if ( have_posts() ) : ?>

                        <div class="row">

                            <?php while ( have_posts() ) : the_post(); ?>

                                <div id="post-<?php the_ID(); ?>" class="site-post-item col-12 col-md-6 col-lg-<?php echo esc_attr( 12 / $sungarden_blog_per_row ); ?>">
                                    <div class="site-post-content">
                                        <h2 class="site-post-title">
                                            <a href="<?php the_permalink();?>" title="<?php the_title(); ?>">
				                                <?php if ( is_sticky() && is_home() ) : ?>
                                                    <i class="fa fa-thumb-tack" aria-hidden="true"></i>
				                                <?php
				                                endif;

				                                the_title();
				                                ?>
                                            </a>
                                        </h2>

		                                <?php
		                                sungarden_post_formats();

		                                sungarden_post_meta();
		                                ?>

                                        <div class="site-post-excerpt">
                                            <p>
				                                <?php
				                                if ( has_excerpt() ) :
					                                echo esc_html( get_the_excerpt() );
				                                else:
					                                echo wp_trim_words( get_the_content(), 30, '...' );
				                                endif;
				                                ?>
                                            </p>

                                            <a href="<?php the_permalink();?>" class="text-read-more">
				                                <?php esc_html_e(  'Read more','sungarden' ); ?>
                                            </a>

			                                <?php sungarden_link_page(); ?>
                                        </div>
                                    </div>
                                </div>

                            <?php endwhile; wp_reset_postdata(); ?>
                        </div>

                    <?php
	                    sungarden_pagination();

	                    else:

                        if ( is_search() ) :
	                        get_template_part( 'template-parts/search/content', 'no-data' );
                        endif;

                    endif;
                    ?>
                </div>
            </div>

            <?php
            if ( $sungarden_blog_sidebar_archive !== 'hide' ) :
                get_sidebar();
            endif;
            ?>
        </div>
    </div>
</div>