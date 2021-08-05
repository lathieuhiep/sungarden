<?php
get_header();

global $sungarden_options;

$sungarden_title = $sungarden_options['sungarden_404_title'];
$sungarden_content = $sungarden_options['sungarden_404_editor'];
$sungarden_background = $sungarden_options['sungarden_404_background']['id'];

?>

<div class="site-error text-center">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-md-6">
                <figure class="site-error__image404">
                    <?php
                    if( !empty( $sungarden_background ) ):
                        echo wp_get_attachment_image( $sungarden_background, 'full' );
                    else:
                        echo'<img src="'.esc_url( get_theme_file_uri( '/assets/images/404.jpg' ) ).'" alt="'.get_bloginfo('title').'" />';
                    endif;
                    ?>
                </figure>
            </div>

            <div class="col-md-6">
                <h1 class="site-title-404">
                    <?php
                    if ( $sungarden_title != '' ):
                        echo esc_html( $sungarden_title );
                    else:
                        esc_html_e( 'Awww...Do Not Cry', 'sungarden' );
                    endif;
                    ?>
                </h1>

                <div id="site-error-content">
                    <?php
                    if ( $sungarden_content != '' ) :
                        echo wp_kses_post( $sungarden_content );
                    else:
                    ?>
                        <p>
                            <?php esc_html_e( 'It is just a 404 Error!', 'sungarden' ); ?>
                            <br />
                            <?php esc_html_e( 'What you are looking for may have been misplaced', 'sungarden' ); ?>
                            <br />
                            <?php esc_html_e( 'in Long Term Memory.', 'sungarden' ); ?>
                        </p>
                    <?php endif; ?>
                </div>

                <div id="site-error-back-home">
                    <a href="<?php echo esc_url( get_home_url('/') ); ?>" title="<?php echo esc_html__('Go to the Home Page', 'sungarden'); ?>">
                        <?php esc_html_e('Go to the Home Page', 'sungarden'); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>