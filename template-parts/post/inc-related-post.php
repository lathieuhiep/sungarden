<?php
global $sungarden_options;

$sungarden_related_post_limit  =   $sungarden_options ['sungarden_related_post_limit'];
$sungarden_term_cat_post       =   get_the_terms( get_the_ID(), 'category' );

if ( !empty( $sungarden_term_cat_post ) ):

    $sungarden_term_cat_post_ids = array();

    foreach( $sungarden_term_cat_post as $item_cat_post_id ) $sungarden_term_cat_post_ids[] = $item_cat_post_id->term_id;

    $sungarden_post_related_arg = array(
        'post_type'         =>  'post',
        'cat'               =>  $sungarden_term_cat_post_ids,
        'post__not_in'      =>  array( get_the_ID() ),
        'posts_per_page'    =>  $sungarden_related_post_limit,
    );

    $sungarden_post_related_query = new WP_Query( $sungarden_post_related_arg );

    if ( $sungarden_post_related_query->have_posts() ) :
?>

    <div class="site-single-post-related">
        <h3 class="title">
            <?php esc_html_e( 'Các tin tức khác', 'sungarden' ); ?>
        </h3>

        <div class="row">
            <?php
            while ( $sungarden_post_related_query->have_posts() ) :
                $sungarden_post_related_query->the_post();
            ?>

                <div class="col-12 col-sm-6 col-md-4 item">
                    <div class="related-post-item">
                        <figure class="post-image">
                            <?php the_post_thumbnail( 'large' ); ?>
                        </figure>

                        <?php sungarden_post_meta(); ?>

                        <h6 class="title-post">
                            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h6>
                    </div>
                </div>

            <?php
            endwhile;
            wp_reset_postdata();
            ?>
        </div>
    </div>

<?php
    endif;
endif;