<?php
global $sungarden_options;

$sungarden_information_show_hide = $sungarden_options['sungarden_information_show_hide'] == '' ? 1 : $sungarden_options['sungarden_information_show_hide'];

if ( $sungarden_information_show_hide == 1 ) :

$sungarden_information_address   =   $sungarden_options['sungarden_information_address'];
$sungarden_information_mail      =   $sungarden_options['sungarden_information_mail'];
$sungarden_information_phone     =   $sungarden_options['sungarden_information_phone'];

?>

<div class="information">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-7">
                <?php if ( $sungarden_information_address != '' ) : ?>

                    <span>
                        <i class="fas fa-map-marker" aria-hidden="true"></i>
                        <?php echo esc_html( $sungarden_information_address ); ?>
                    </span>

                <?php
                endif;

                if ( $sungarden_information_mail != '' ) :
                ?>

                    <span>
                        <i class="fas fa-envelope"></i>
                        <?php echo esc_html( $sungarden_information_mail ); ?>
                    </span>

                <?php
                endif;

                if ( $sungarden_information_phone != '' ) :
                ?>

                    <span>
                        <i class="fas fa-mobile-alt"></i>
                        <?php echo esc_html( $sungarden_information_phone ); ?>
                    </span>

                <?php endif; ?>
            </div>

            <div class="col-12 col-md-12 col-lg-5 d-none d-lg-block">
                <div class="information__social-network social-network-toTopFromBottom d-lg-flex justify-content-lg-end">
                    <?php sungarden_get_social_url(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

endif;