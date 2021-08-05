<?php

global $sungarden_options;

$sungarden_show_loading = $sungarden_options['sungarden_general_show_loading'] == '' ? '0' : $sungarden_options['sungarden_general_show_loading'];

if(  $sungarden_show_loading == 1 ) :

    $sungarden_loading_url  = $sungarden_options['sungarden_general_image_loading']['url'];
?>

    <div id="site-loadding" class="d-flex align-items-center justify-content-center">

        <?php  if( $sungarden_loading_url !='' ): ?>

            <img class="loading_img" src="<?php echo esc_url( $sungarden_loading_url ); ?>" alt="<?php esc_attr_e('loading...','sungarden') ?>"  >

        <?php else: ?>

            <img class="loading_img" src="<?php echo esc_url(get_theme_file_uri( '/assets/images/loading.gif' )); ?>" alt="<?php esc_attr_e('loading...','sungarden') ?>">

        <?php endif; ?>

    </div>

<?php endif; ?>