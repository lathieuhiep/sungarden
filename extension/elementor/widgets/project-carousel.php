<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

use Elementor\Core\Schemes;

class sungarden_widget_project_carousel extends Widget_Base {

    public function get_categories() {
        return array( 'sungarden_widgets' );
    }

    public function get_name() {
        return 'sungarden-project-carousel';
    }

    public function get_title() {
        return esc_html__( 'Project Carousel', 'sungarden' );
    }

    public function get_icon() {
        return 'eicon-post-slider';
    }

    public function get_script_depends() {
        return ['sungarden-elementor-custom'];
    }

    protected function _register_controls() {

	    /* Section Heading */
	    $this->start_controls_section(
		    'section_heading',
		    [
			    'label' =>  esc_html__( 'Heading', 'sungarden' )
		    ]
	    );

	    $this->add_control(
		    'heading',
		    [
			    'label'       => esc_html__( 'Heading', 'sungarden' ),
			    'type'        => Controls_Manager::TEXT,
			    'default'     => esc_html__( 'Xem nhanh dự án', 'sungarden' ),
			    'label_block' => true
		    ]
	    );

	    $this->end_controls_section();

        /* Section Query */
        $this->start_controls_section(
            'section_query',
            [
                'label' =>  esc_html__( 'Query', 'sungarden' )
            ]
        );

        $this->add_control(
            'select_cat',
            [
                'label'         =>  esc_html__( 'Select Category', 'sungarden' ),
                'type'          =>  Controls_Manager::SELECT2,
                'options'       =>  sungarden_check_get_cat( 'sungarden_project_cat' ),
                'multiple'      =>  true,
                'label_block'   =>  true
            ]
        );

        $this->add_control(
            'limit',
            [
                'label'     =>  esc_html__( 'Number of Posts', 'sungarden' ),
                'type'      =>  Controls_Manager::NUMBER,
                'default'   =>  6,
                'min'       =>  1,
                'max'       =>  100,
                'step'      =>  1,
            ]
        );

        $this->add_control(
            'order_by',
            [
                'label'     =>  esc_html__( 'Order By', 'sungarden' ),
                'type'      =>  Controls_Manager::SELECT,
                'default'   =>  'id',
                'options'   =>  [
                    'id'    =>  esc_html__( 'Post ID', 'sungarden' ),
                    'title' =>  esc_html__( 'Title', 'sungarden' ),
                    'date'  =>  esc_html__( 'Date', 'sungarden' ),
                    'rand'  =>  esc_html__( 'Random', 'sungarden' ),
                ],
            ]
        );

        $this->add_control(
            'order',
            [
                'label'     =>  esc_html__( 'Order', 'sungarden' ),
                'type'      =>  Controls_Manager::SELECT,
                'default'   =>  'ASC',
                'options'   =>  [
                    'ASC'   =>  esc_html__( 'Ascending', 'sungarden' ),
                    'DESC'  =>  esc_html__( 'Descending', 'sungarden' ),
                ],
            ]
        );

        $this->end_controls_section();

        /* Section Layout */
        $this->start_controls_section(
            'section_layout',
            [
                'label' =>  esc_html__( 'Layout Settings', 'sungarden' )
            ]
        );

	    $this->add_control(
		    'loop',
		    [
			    'type'          =>  Controls_Manager::SWITCHER,
			    'label'         =>  esc_html__('Loop Slider ?', 'sungarden'),
			    'label_off'     =>  esc_html__('No', 'sungarden'),
			    'label_on'      =>  esc_html__('Yes', 'sungarden'),
			    'return_value'  =>  'yes',
			    'default'       =>  'yes',
		    ]
	    );

	    $this->add_control(
		    'autoplay',
		    [
			    'label'         =>  esc_html__('Autoplay?', 'sungarden'),
			    'type'          =>  Controls_Manager::SWITCHER,
			    'label_off'     =>  esc_html__('No', 'sungarden'),
			    'label_on'      =>  esc_html__('Yes', 'sungarden'),
			    'return_value'  =>  'yes',
			    'default'       =>  'no',
		    ]
	    );

	    $this->add_control(
		    'nav',
		    [
			    'label'         =>  esc_html__('Nav Slider', 'sungarden'),
			    'type'          =>  Controls_Manager::SWITCHER,
			    'label_on'      =>  esc_html__('Yes', 'sungarden'),
			    'label_off'     =>  esc_html__('No', 'sungarden'),
			    'return_value'  =>  'yes',
			    'default'       =>  'yes',
		    ]
	    );

	    $this->add_control(
		    'dots',
		    [
			    'label'         =>  esc_html__('Dots Slider', 'sungarden'),
			    'type'          =>  Controls_Manager::SWITCHER,
			    'label_on'      =>  esc_html__('Yes', 'sungarden'),
			    'label_off'     =>  esc_html__('No', 'sungarden'),
			    'return_value'  =>  'yes',
			    'default'       =>  'yes',
		    ]
	    );

	    $this->add_control(
		    'margin_item',
		    [
			    'label'     =>  esc_html__( 'Space Between Item', 'sungarden' ),
			    'type'      =>  Controls_Manager::NUMBER,
			    'default'   =>  30,
			    'min'       =>  0,
			    'max'       =>  100,
			    'step'      =>  1,
		    ]
	    );

	    $this->add_control(
		    'min_width_1200',
		    [
			    'label'     =>  esc_html__( 'Min Width 1200px', 'sungarden' ),
			    'type'      =>  Controls_Manager::HEADING,
			    'separator' =>  'before',
		    ]
	    );

	    $this->add_control(
		    'item',
		    [
			    'label'     =>  esc_html__( 'Number of Item', 'sungarden' ),
			    'type'      =>  Controls_Manager::NUMBER,
			    'default'   =>  4,
			    'min'       =>  1,
			    'max'       =>  100,
			    'step'      =>  1,
		    ]
	    );

	    $this->add_control(
		    'min_width_992',
		    [
			    'label'     =>  esc_html__( 'Min Width 992px', 'sungarden' ),
			    'type'      =>  Controls_Manager::HEADING,
			    'separator' =>  'before',
		    ]
	    );

	    $this->add_control(
		    'item_992',
		    [
			    'label'     =>  esc_html__( 'Number of Item', 'sungarden' ),
			    'type'      =>  Controls_Manager::NUMBER,
			    'default'   =>  3,
			    'min'       =>  1,
			    'max'       =>  100,
			    'step'      =>  1,
		    ]
	    );

	    $this->add_control(
		    'min_width_768',
		    [
			    'label'     =>  esc_html__( 'Min Width 768px', 'sungarden' ),
			    'type'      =>  Controls_Manager::HEADING,
			    'separator' =>  'before',
		    ]
	    );

	    $this->add_control(
		    'item_768',
		    [
			    'label'     =>  esc_html__( 'Number of Item', 'sungarden' ),
			    'type'      =>  Controls_Manager::NUMBER,
			    'default'   =>  2,
			    'min'       =>  1,
			    'max'       =>  100,
			    'step'      =>  1,
		    ]
	    );

	    $this->add_control(
		    'min_width_568',
		    [
			    'label'     =>  esc_html__( 'Min Width 568px', 'sungarden' ),
			    'type'      =>  Controls_Manager::HEADING,
			    'separator' =>  'before',
		    ]
	    );

	    $this->add_control(
		    'item_568',
		    [
			    'label'     =>  esc_html__( 'Number of Item', 'sungarden' ),
			    'type'      =>  Controls_Manager::NUMBER,
			    'default'   =>  2,
			    'min'       =>  1,
			    'max'       =>  100,
			    'step'      =>  1,
		    ]
	    );

	    $this->add_control(
		    'margin_item_568',
		    [
			    'label'     =>  esc_html__( 'Space Between Item', 'sungarden' ),
			    'type'      =>  Controls_Manager::NUMBER,
			    'default'   =>  15,
			    'min'       =>  0,
			    'max'       =>  100,
			    'step'      =>  1,
		    ]
	    );

	    $this->add_control(
		    'max_width_567',
		    [
			    'label'     =>  esc_html__( 'Max Width 567px', 'sungarden' ),
			    'type'      =>  Controls_Manager::HEADING,
			    'separator' =>  'before',
		    ]
	    );

	    $this->add_control(
		    'item_567',
		    [
			    'label'     =>  esc_html__( 'Number of Item', 'sungarden' ),
			    'type'      =>  Controls_Manager::NUMBER,
			    'default'   =>  1,
			    'min'       =>  1,
			    'max'       =>  100,
			    'step'      =>  1,
		    ]
	    );

	    $this->add_control(
		    'margin_item_567',
		    [
			    'label'     =>  esc_html__( 'Space Between Item', 'sungarden' ),
			    'type'      =>  Controls_Manager::NUMBER,
			    'default'   =>  0,
			    'min'       =>  0,
			    'max'       =>  100,
			    'step'      =>  1,
		    ]
	    );

        $this->end_controls_section();

        /* Section style post */
        $this->start_controls_section(
            'section_style_post',
            [
                'label' => esc_html__( 'Color & Typography', 'sungarden' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        // Style title post
        $this->add_control(
            'title_post_options',
            [
                'label'     =>  esc_html__( 'Title Post', 'sungarden' ),
                'type'      =>  Controls_Manager::HEADING,
                'separator' =>  'before',
            ]
        );

        $this->add_control(
            'title_post_color',
            [
                'label'     =>  esc_html__( 'Color', 'sungarden' ),
                'type'      =>  Controls_Manager::COLOR,
                'default'   =>  '',
                'selectors' =>  [
                    '{{WRAPPER}} .element-post-carousel .item-post__title a'   =>  'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_post_color_hover',
            [
                'label'     =>  esc_html__( 'Color Hover', 'sungarden' ),
                'type'      =>  Controls_Manager::COLOR,
                'default'   =>  '',
                'selectors' =>  [
                    '{{WRAPPER}} .element-post-carousel .item-post__title a:hover'   =>  'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_post_typography',
                'selector' => '{{WRAPPER}} .element-post-carousel .item-post .item-post__title',
            ]
        );

        $this->add_control(
            'title_post_alignment',
            [
                'label'     =>  esc_html__( 'Title Alignment', 'sungarden' ),
                'type'      =>  Controls_Manager::CHOOSE,
                'options'   =>  [
                    'left'  =>  [
                        'title' =>  esc_html__( 'Left', 'sungarden' ),
                        'icon'  =>  'fa fa-align-left',
                    ],
                    'center' => [
                        'title' =>  esc_html__( 'Center', 'sungarden' ),
                        'icon'  =>  'fa fa-align-center',
                    ],
                    'right' => [
                        'title' =>  esc_html__( 'Right', 'sungarden' ),
                        'icon'  =>  'fa fa-align-right',
                    ],
                    'justify'=> [
                        'title' =>  esc_html__( 'Justified', 'sungarden' ),
                        'icon'  =>  'fa fa-align-justify',
                    ],
                ],
                'toggle'    =>  true,
                'selectors' =>  [
                    '{{WRAPPER}} .element-post-carousel .item-post .item-post__title'   =>  'text-align: {{VALUE}};',
                ]
            ]
        );

        // Style excerpt post
        $this->add_control(
            'excerpt_post_options',
            [
                'label'     =>  esc_html__( 'Excerpt Post', 'sungarden' ),
                'type'      =>  Controls_Manager::HEADING,
                'separator' =>  'before',
            ]
        );

        $this->add_control(
            'excerpt_color',
            [
                'label'     =>  esc_html__( 'Color', 'sungarden' ),
                'type'      =>  Controls_Manager::COLOR,
                'default'   =>  '',
                'selectors' =>  [
                    '{{WRAPPER}} .element-post-carousel .item-post .item-post__content p'   =>  'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'excerpt_typography',
                'selector' => '{{WRAPPER}} .element-post-carousel .item-post .item-post__content p',
            ]
        );

        $this->add_control(
            'excerpt_alignment',
            [
                'label'     =>  esc_html__( 'Excerpt Alignment', 'sungarden' ),
                'type'      =>  Controls_Manager::CHOOSE,
                'options'   =>  [
                    'left'  =>  [
                        'title' =>  esc_html__( 'Left', 'sungarden' ),
                        'icon'  =>  'fa fa-align-left',
                    ],
                    'center' => [
                        'title' =>  esc_html__( 'Center', 'sungarden' ),
                        'icon'  =>  'fa fa-align-center',
                    ],
                    'right' => [
                        'title' =>  esc_html__( 'Right', 'sungarden' ),
                        'icon'  =>  'fa fa-align-right',
                    ],
                    'justify'=> [
                        'title' =>  esc_html__( 'Justified', 'sungarden' ),
                        'icon'  =>  'fa fa-align-justify',
                    ],
                ],
                'toggle'    =>  true,
                'selectors' =>  [
                    '{{WRAPPER}} .element-post-carousel .item-post .item-post__content p'   =>  'text-align: {{VALUE}};',
                ]
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {

        $settings       =   $this->get_settings_for_display();
        $cat_post       =   $settings['select_cat'];
        $limit_post     =   $settings['limit'];
        $order_by_post  =   $settings['order_by'];
        $order_post     =   $settings['order'];

	    $data_settings_owl  =   [
		    'loop'          =>  ( 'yes' === $settings['loop'] ),
		    'nav'           =>  ( 'yes' === $settings['nav'] ),
		    'dots'          =>  ( 'yes' === $settings['dots'] ),
		    'margin'        =>  $settings['margin_item'],
		    'autoplay'      =>  ( 'yes' === $settings['autoplay'] ),
		    'responsive'    => [
			    '0' => array(
				    'items'     =>  $settings['item_567'],
				    'margin'    =>  $settings['margin_item_567']
			    ),
			    '576' => array(
				    'items'     =>  $settings['item_568'],
				    'margin'    =>  $settings['margin_item_568']
			    ),
			    '768' => array(
				    'items'     =>  $settings['item_768']
			    ),
			    '992' => array(
				    'items'     =>  $settings['item_992']
			    ),
			    '1200' => array(
				    'items'     =>  $settings['item']
			    ),
		    ],
	    ];

	    if ( ! empty( $cat_post ) ) :
		    $tax_query = array(
			    array(
				    'taxonomy' => 'sungarden_project_cat',
				    'field'    => 'term_id',
				    'terms'    => $cat_post
			    ),
		    );
	    else:
		    $tax_query = '';
	    endif;

	    $args = array(
		    'post_type'           => 'sungarden_project',
		    'posts_per_page'      => $limit_post,
		    'orderby'             => $order_by_post,
		    'order'               => $order_post,
		    'ignore_sticky_posts' => 1,
		    'tax_query'           => $tax_query
	    );

        $query = new \WP_Query( $args );

        if ( $query->have_posts() ) :

    ?>

        <div class="element-project-carousel">
            <div class="top-box d-flex align-items-center">
                <h3 class="heading flex-grow-0">
		            <?php echo esc_html( $settings['heading'] ); ?>
                </h3>

                <span class="line flex-grow-1"></span>
            </div>

            <div class="custom-owl-carousel custom-equal-height-owl owl-carousel owl-theme" data-settings-owl='<?php echo wp_json_encode( $data_settings_owl ) ; ?>'>
                <?php
                while ( $query->have_posts() ): $query->the_post();
	                if (  has_post_thumbnail() ) :
		                $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full');
	                else:
		                $featured_img_url = get_theme_file_uri( '/assets/images/no-image.png' );
	                endif;

	                $dataCaption = [
                        'title' => get_the_title(),
                        'link' => get_the_permalink(),
                        'textLink' => esc_html__('Chi tiết dự án', 'sungarden')
                    ];
                ?>
                    <div class="item-post">
                        <div class="item-post__thumbnail project-gallery" data-src="<?php echo esc_url( $featured_img_url ); ?>" data-fancybox="gallery" data-caption='<?php echo wp_json_encode( $dataCaption ) ; ?>'>
	                        <?php
	                        if ( has_post_thumbnail() ) :
		                        the_post_thumbnail( 'large' );
	                        else:
		                        ?>

                                <img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/no-image.png' ) ) ?>" alt="<?php the_title(); ?>" />

	                        <?php endif; ?>
                        </div>
                    </div>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        </div>

    <?php
        endif;
    }

    protected function _content_template() {}

}

Plugin::instance()->widgets_manager->register_widget_type( new sungarden_widget_project_carousel );