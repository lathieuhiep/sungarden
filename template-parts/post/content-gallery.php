<?php

$sungarden_gallery_post = get_post_meta( get_the_ID(),'sungarden_gallery_post', false );

if( !empty( $sungarden_gallery_post ) ) :

    $sungarden_slider_settings =   [
	    'items'         =>  1,
        'loop'          =>  true,
        'nav'           =>  true,
        'dots'          =>  true,
        'autoHeight'    =>  true
    ];

?>

    <div class="site-post-slides owl-carousel owl-theme" data-settings-owl='<?php echo wp_json_encode( $sungarden_slider_settings ); ?>'>

        <?php foreach( $sungarden_gallery_post as $item ) : ?>

            <div class="site-post-slides__item">
                <?php echo wp_get_attachment_image( $item, 'full' ); ?>
            </div>

        <?php endforeach; ?>

    </div>

<?php endif; ?>