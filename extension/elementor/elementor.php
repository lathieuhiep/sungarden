<?php

namespace Elementor;

final class sungarden_plugin_elementor_widgets {

    private static $_instance = null;

    public static function instance() {

        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;

    }

    /**
     * Plugin constructor.
     */
    public function __construct() {

        $this->init();

    }

    public function init() {

        add_action( 'elementor/elements/categories_registered', [ $this, 'init_category' ] );

        add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );

        add_action( 'elementor/frontend/after_enqueue_styles', [$this, 'init_script'] );

    }

    public function init_category() {

        Plugin::instance()->elements_manager->add_category(
            'sungarden_widgets',
            [
                'title' => esc_html__( 'Sungarden Theme Widgets', 'sungarden' ),
                'icon'  => 'icon-goes-here'
            ]
        );

    }

    public function init_widgets() {

        $build_widgets_filename = [
        	'breadcrumb-navxt',
            'slides',
            'post-grid',
            'post-carousel',
	        'post-slider',
            'about-text',
	        'contact-cf7',
	        'product-grid',
	        'service',
	        'service-detail-info',
	        'service-detail-content',
	        'project-carousel',
	        'project-grid',
	        'project-slider',
	        'project-detail-info',
	        'project-image',
	        'videos',
	        'video-popup',
	        'video-slider',
	        'testimonial-carousel',
	        'consultation',
	        'quickview-slider',
	        'project-box',
	        'faq',
	        'contact-us'
        ];
        
        foreach ( $build_widgets_filename as $widget_filename ) :

            // Include Widget files
            require get_parent_theme_file_path( '/extension/elementor/widgets/'. $widget_filename .'.php' );

        endforeach;

    }

    public function init_script() {
        wp_register_script( 'sungarden-elementor-custom', get_theme_file_uri( '/assets/js/elementor-custom.js' ), array(), '1.0.0', true );

        // filter product cat
	    wp_enqueue_script( 'filter-product-cat', get_theme_file_uri( '/assets/js/filter-product-cat.js' ), array(), '', true );

	    $sungarden_filter_product_cat_admin_url    =   admin_url( 'admin-ajax.php' );
	    $sungarden_filter_product_cat_ajax         =   array( 'url' => $sungarden_filter_product_cat_admin_url );
	    wp_localize_script( 'filter-product-cat', 'filter_product_cat_product', $sungarden_filter_product_cat_ajax );
    }

}

sungarden_plugin_elementor_widgets::instance();