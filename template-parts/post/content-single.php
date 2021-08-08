<?php

global $sungarden_options;

$sungarden_on_off_share_single = $sungarden_options['sungarden_on_off_share_single'];

?>

<div id="post-<?php the_ID() ?>" <?php post_class( 'site-post-single-item' ); ?>>
    <div class="site-post-content">
        <h1 class="site-post-title">
            <?php the_title(); ?>
        </h1>

        <?php
        sungarden_post_meta();

        if ( $sungarden_on_off_share_single == 1 || $sungarden_on_off_share_single == null ) :

	        sungarden_post_share();

        endif;
        ?>

        <div class="site-post-excerpt">
            <?php
            the_content();

            sungarden_link_page();
            ?>
        </div>
    </div>
</div>

<?php
get_template_part( 'template-parts/post/inc','related-post' );




