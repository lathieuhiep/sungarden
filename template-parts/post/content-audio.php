<?php

    $sungarden_audio = get_post_meta(  get_the_ID() , '_format_audio_embed', true );
    if( $sungarden_audio != '' ):

?>
        <div class="site-post-audio">

            <?php if( wp_oembed_get( $sungarden_audio ) ) : ?>

                <?php echo wp_oembed_get( $sungarden_audio ); ?>

            <?php else : ?>

                <?php echo balanceTags( $sungarden_audio ); ?>

            <?php endif; ?>

        </div>

<?php endif;?>