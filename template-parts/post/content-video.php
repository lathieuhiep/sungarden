<?php

$sungarden_video_post = get_post_meta(  get_the_ID() , 'sungarden_video_post', true );

if ( !empty( $sungarden_video_post ) ):

?>

    <div class="site-post-video">
        <?php echo wp_oembed_get( $sungarden_video_post ); ?>
    </div>

<?php endif;?>