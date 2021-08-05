<?php
    /*
     * Method process option
     * # option 1: config font
     * # option 2: process config theme
    */
    if( !is_admin() ):

        add_action( 'wp_head','sungarden_config_theme' );

        function sungarden_config_theme() {

            if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) :

                    global $sungarden_options;
                    $sungarden_favicon = $sungarden_options['sungarden_favicon_upload']['url'];

                    if( $sungarden_favicon != '' ) :

                        echo '<link rel="shortcut icon" href="' . esc_url( $sungarden_favicon ) . '" type="image/x-icon" />';

                    endif;

            endif;
        }

        // Method add custom css, Css custom add here
        // Inline css add here
        /**
         * Enqueues front-end CSS for the custom css.
         *
         * @see wp_add_inline_style()
         */

        add_action( 'wp_enqueue_scripts', 'sungarden_custom_css', 99 );

        function sungarden_custom_css() {

            global $sungarden_options;

            $sungarden_typo_selecter_1   =   $sungarden_options['sungarden_custom_typography_1_selector'];

            $sungarden_typo1_font_family   =   $sungarden_options['sungarden_custom_typography_1']['font-family'] == '' ? '' : $sungarden_options['sungarden_custom_typography_1']['font-family'];

            $sungarden_css_style = '';

            if ( $sungarden_typo1_font_family != '' ) :
                $sungarden_css_style .= ' '.esc_attr( $sungarden_typo_selecter_1 ).' { font-family: '.balanceTags( $sungarden_typo1_font_family, true ).' }';
            endif;

            if ( $sungarden_css_style != '' ) :
                wp_add_inline_style( 'sungarden-style', $sungarden_css_style );
            endif;

        }

    endif;
