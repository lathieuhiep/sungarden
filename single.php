<?php
get_header();

global $sungarden_options;

$sungarden_blog_sidebar_single = !empty( $sungarden_options['sungarden_blog_sidebar_single'] ) ? $sungarden_options['sungarden_blog_sidebar_single'] : 'right';

$sungarden_class_col_content = sungarden_col_use_sidebar( $sungarden_blog_sidebar_single, 'sungarden-sidebar-main' );
?>

<div class="site-container site-single">
    <div class="container">
        <div class="row">
            <div class="<?php echo esc_attr( $sungarden_class_col_content ); ?>">

                <?php
                if ( have_posts() ) : while (have_posts()) : the_post();

                    get_template_part( 'template-parts/post/content','single' );

                    endwhile;
                endif;
                ?>

            </div>

            <?php
            if ( $sungarden_blog_sidebar_single !== 'hide' ) :
	            get_sidebar();
            endif;
            ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>

