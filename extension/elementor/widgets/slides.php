<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class sungarden_widget_slides extends Widget_Base {

    public function get_categories() {
        return array( 'sungarden_widgets' );
    }

    public function get_name() {
        return 'sungarden-slides';
    }

    public function get_title() {
        return esc_html__( 'Slides Theme', 'sungarden' );
    }

    public function get_icon() {
        return 'eicon-slideshow';
    }

    public function get_script_depends() {
        return ['sungarden-elementor-custom'];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__( 'Slides', 'sungarden' ),
            ]
        );

        $repeater = new Repeater();

        $repeater->start_controls_tabs( 'slides_repeater' );

        $repeater->start_controls_tab( 'background', [ 'label' => esc_html__( 'Background', 'sungarden' ) ] );

        $repeater->add_control(
            'slides_image',
            [
                'label'     =>  esc_html__( 'Image', 'sungarden' ),
                'type'      =>  Controls_Manager::MEDIA,
                'default'   =>  [
                    'url'   =>  Utils::get_placeholder_image_src(),
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .element-slides__item--bg' => 'background-image: url({{URL}})',
                ],
            ]
        );

        $repeater->add_control(
            'background_size',
            [
                'label'     =>  esc_html__( 'Size', 'sungarden' ),
                'type'      =>  Controls_Manager::SELECT,
                'default'   =>  'cover',
                'options'   =>  [
                    'cover'     =>  esc_html__( 'Cover', 'sungarden' ),
                    'contain'   =>  esc_html__( 'Contain', 'sungarden' ),
                    'auto'      =>  esc_html__( 'Auto', 'sungarden' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .element-slides__item--bg' => 'background-size: {{VALUE}}',
                ],
                'conditions' => [
                    'terms' => [
                        [
                            'name' => 'slides_image[url]',
                            'operator' => '!=',
                            'value' => '',
                        ],
                    ],
                ],
            ]
        );

        $repeater->add_control(
            'background_overlay',
            [
                'label' => esc_html__( 'Background Overlay', 'sungarden' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => '',
                'separator' => 'before',
                'conditions' => [
                    'terms' => [
                        [
                            'name' => 'slides_image[url]',
                            'operator' => '!=',
                            'value' => '',
                        ],
                    ],
                ],
            ]
        );

        $repeater->add_control(
            'background_overlay_color',
            [
                'label' => esc_html__( 'Color', 'sungarden' ),
                'type' => Controls_Manager::COLOR,
                'default' => 'rgba(0,0,0,0.5)',
                'conditions' => [
                    'terms' => [
                        [
                            'name' => 'background_overlay',
                            'value' => 'yes',
                        ],
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .element-slides__item--inner .element-slides__item--overlay' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $repeater->end_controls_tab();

        $repeater->start_controls_tab( 'content', [ 'label' => esc_html__( 'Content', 'sungarden' ) ] );

        $repeater->add_control(
            'heading',
            [
                'label' => esc_html__( 'Title & Description', 'sungarden' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Slide Heading', 'sungarden' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'description',
            [
                'label' => esc_html__( 'Description', 'sungarden' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__( 'Click edit button to change this text. Lorem ipsum dolor sit amet consectetur adipiscing elit dolor', 'sungarden' ),
                'show_label' => false,
            ]
        );

        $repeater->add_control(
            'button_text',
            [
                'label' => esc_html__( 'Button Text', 'sungarden' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Click Here', 'sungarden' ),
            ]
        );

        $repeater->add_control(
            'link',
            [
                'label'         =>  esc_html__( 'Link', 'sungarden' ),
                'type'          =>  Controls_Manager::URL,
                'label_block'   =>  true,
                'default'       =>  [
                    'is_external'   =>  false,
                ],
                'placeholder'   =>  esc_html__( 'https://your-link.com', 'sungarden' ),
            ]
        );

	    $repeater->add_control(
		    'show_content',
		    [
			    'label'         => esc_html__( 'Show Content', 'sungarden' ),
			    'type'          => Controls_Manager::SWITCHER,
			    'label_on'      => esc_html__( 'Show', 'sungarden' ),
			    'label_off'     => esc_html__( 'Hide', 'sungarden' ),
			    'return_value'  => 'yes',
			    'default'       => 'yes',
		    ]
	    );

        $repeater->end_controls_tab();

        $repeater->start_controls_tab( 'style', [ 'label' => esc_html__( 'Style', 'sungarden' ) ] );

        $repeater->add_control(
            'custom_style',
            [
                'label' => esc_html__( 'Custom', 'sungarden' ),
                'type' => Controls_Manager::SWITCHER,
                'description' => esc_html__( 'Set custom style that will only affect this specific slide.', 'sungarden' ),
            ]
        );

        $repeater->add_control(
            'horizontal_position',
            [
                'label' => esc_html__( 'Horizontal Position', 'sungarden' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'sungarden' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'sungarden' ),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'sungarden' ),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .element-slides__item--inner .element-slides__item--content' => '{{VALUE}}',
                ],
                'selectors_dictionary' => [
                    'left' => 'margin-right: auto',
                    'center' => 'margin: 0 auto',
                    'right' => 'margin-left: auto',
                ],
                'conditions' => [
                    'terms' => [
                        [
                            'name' => 'custom_style',
                            'value' => 'yes',
                        ],
                    ],
                ],
            ]
        );

        $repeater->add_control(
            'vertical_position',
            [
                'label' => esc_html__( 'Vertical Position', 'sungarden' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'top' => [
                        'title' => esc_html__( 'Top', 'sungarden' ),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'middle' => [
                        'title' => esc_html__( 'Middle', 'sungarden' ),
                        'icon' => 'eicon-v-align-middle',
                    ],
                    'bottom' => [
                        'title' => esc_html__( 'Bottom', 'sungarden' ),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .element-slides__item--inner' => 'align-items: {{VALUE}}; -webkit-align-items: {{VALUE}};',
                ],
                'selectors_dictionary' => [
                    'top' => 'flex-start',
                    'middle' => 'center',
                    'bottom' => 'flex-end',
                ],
                'conditions' => [
                    'terms' => [
                        [
                            'name' => 'custom_style',
                            'value' => 'yes',
                        ],
                    ],
                ],
            ]
        );

        $repeater->add_control(
            'text_align',
            [
                'label' => esc_html__( 'Text Align', 'sungarden' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'sungarden' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'sungarden' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'sungarden' ),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .element-slides__item--inner' => 'text-align: {{VALUE}}',
                ],
                'conditions' => [
                    'terms' => [
                        [
                            'name' => 'custom_style',
                            'value' => 'yes',
                        ],
                    ],
                ],
            ]
        );

        $repeater->end_controls_tab();

        $repeater->end_controls_tabs();

        $this->add_control(
            'slides_list',
            [
                'label'     =>  esc_html__( 'Slides', 'sungarden' ),
                'type'      =>  Controls_Manager::REPEATER,
                'fields'    => $repeater->get_controls(),
                'default'   =>  [
                    [
                        'heading' => esc_html__( 'Slider 1 Heading', 'sungarden' ),
                        'description' => esc_html__( 'Click edit button to change this text. Lorem ipsum dolor sit amet consectetur adipiscing elit dolor', 'sungarden' ),
                        'button_text' => esc_html__( 'Click Here', 'sungarden' ),
                        'link' => '#'
                    ],
                    [
                        'heading' => esc_html__( 'Slider 2 Heading', 'sungarden' ),
                        'description' => esc_html__( 'Click edit button to change this text. Lorem ipsum dolor sit amet consectetur adipiscing elit dolor', 'sungarden' ),
                        'button_text' => esc_html__( 'Click Here', 'sungarden' ),
                        'link' => '#'
                    ],
                ],
                'title_field'   =>  '{{{ heading }}}',
            ]
        );

        $this->add_responsive_control(
            'slides_height',
            [
                'label' => esc_html__( 'Height', 'sungarden' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 1000,
                    ],
                    'vh' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 400,
                ],
                'size_units' => [ 'px', 'vh', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .element-slides__item' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_slider_options',
            [
                'label' => esc_html__( 'Slider Options', 'sungarden' ),
                'tab' => Controls_Manager::SECTION
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
                'label'         => esc_html__('Autoplay?', 'sungarden'),
                'type'          => Controls_Manager::SWITCHER,
                'label_off'     => esc_html__('No', 'sungarden'),
                'label_on'      => esc_html__('Yes', 'sungarden'),
                'return_value'  => 'yes',
                'default'       => 'no',
            ]
        );

        $this->add_control(
            'nav',
            [
                'label'         => esc_html__('nav Slider', 'sungarden'),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => esc_html__('Yes', 'sungarden'),
                'label_off'     => esc_html__('No', 'sungarden'),
                'return_value'  => 'yes',
                'default'       => 'yes',
            ]
        );

        $this->add_control(
            'dots',
            [
                'label'         => esc_html__('Dots Slider', 'sungarden'),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => esc_html__('Yes', 'sungarden'),
                'label_off'     => esc_html__('No', 'sungarden'),
                'return_value'  => 'yes',
                'default'       => 'no',
            ]
        );

        $this->end_controls_section();

        // Project
	    $this->start_controls_section(
		    'section_project_options',
		    [
			    'label' => esc_html__( 'Project', 'sungarden' ),
			    'tab' => Controls_Manager::SECTION
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

	    $this->add_control(
		    'text_view_detail',
		    [
			    'label'         =>  esc_html__( 'Text', 'sungarden' ),
			    'type'          =>  Controls_Manager::TEXT,
			    'default'       =>  esc_html__( 'Click để xem thêm hình ảnh chi tiết', 'sungarden' ),
			    'label_block'   =>  true
		    ]
	    );

	    $this->end_controls_section();

        $this->start_controls_section(
            'section_style_slides',
            [
                'label' => esc_html__( 'Slides', 'sungarden' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'content_max_width',
            [
                'label' => esc_html__( 'Content Width', 'sungarden' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'size_units' => [ '%', 'px' ],
                'default' => [
                    'size' => '66',
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'selectors' => [
                    '{{WRAPPER}} .element-slides__item .element-slides__item--content' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'slides_padding',
            [
                'label' => esc_html__( 'Padding', 'sungarden' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .element-slides__item .element-slides__item--inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'slides_horizontal_position',
            [
                'label' => esc_html__( 'Horizontal Position', 'sungarden' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'default' => 'center',
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'sungarden' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'sungarden' ),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'sungarden' ),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'prefix_class' => 'element-slides--h-position-',
            ]
        );

        $this->add_control(
            'slides_vertical_position',
            [
                'label' => esc_html__( 'Vertical Position', 'sungarden' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'default' => 'middle',
                'options' => [
                    'top' => [
                        'title' => esc_html__( 'Top', 'sungarden' ),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'middle' => [
                        'title' => esc_html__( 'Middle', 'sungarden' ),
                        'icon' => 'eicon-v-align-middle',
                    ],
                    'bottom' => [
                        'title' => esc_html__( 'Bottom', 'sungarden' ),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'prefix_class' => 'element-slides--v-position-',
            ]
        );

        $this->add_control(
            'slides_text_align',
            [
                'label' => esc_html__( 'Text Align', 'sungarden' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'sungarden' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'sungarden' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'sungarden' ),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .element-slides__item--inner' => 'text-align: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_title',
            [
                'label' => esc_html__( 'Title', 'sungarden' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'heading_spacing',
            [
                'label' => esc_html__( 'Spacing', 'sungarden' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .element-slides__item .element-slides__item--heading' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
            'heading_color',
            [
                'label' => esc_html__( 'Text Color', 'sungarden' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .element-slides__item .element-slides__item--heading' => 'color: {{VALUE}}',

                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'heading_typography',
                'selector' => '{{WRAPPER}} .element-slides__item .element-slides__item--heading',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_description',
            [
                'label' => esc_html__( 'Description', 'sungarden' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'description_spacing',
            [
                'label' => esc_html__( 'Spacing', 'sungarden' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .element-slides__item .element-slides__item--description' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => esc_html__( 'Text Color', 'sungarden' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .element-slides__item .element-slides__item--description' => 'color: {{VALUE}}',

                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'selector' => '{{WRAPPER}} .element-slides__item .element-slides__item--description',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_button',
            [
                'label' => esc_html__( 'Button', 'sungarden' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control( 'button_color',
            [
                'label' => esc_html__( 'Text Color', 'sungarden' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .element-slides__item .element-slides__item--link, {{WRAPPER}} .element-slides__item .element-slides__item--link a' => 'color: {{VALUE}}; border-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'selector' => '{{WRAPPER}} .element-slides__item .element-slides__item--link',
            ]
        );

        $this->add_control(
            'button_border_width',
            [
                'label' => esc_html__( 'Border Width', 'sungarden' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 20,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .element-slides__item .element-slides__item--link' => 'border-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'button_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'sungarden' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .element-slides__item .element-slides__item--link' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'after',
            ]
        );

        $this->start_controls_tabs( 'button_tabs' );

        $this->start_controls_tab( 'normal', [ 'label' => esc_html__( 'Normal', 'sungarden' ) ] );

        $this->add_control(
            'button_text_color',
            [
                'label' => esc_html__( 'Text Color', 'sungarden' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .element-slides__item .element-slides__item--link, {{WRAPPER}} .element-slides__item .element-slides__item--link a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_background_color',
            [
                'label' => esc_html__( 'Background Color', 'sungarden' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .element-slides__item .element-slides__item--link' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_border_color',
            [
                'label' => esc_html__( 'Border Color', 'sungarden' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .element-slides__item .element-slides__item--link' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab( 'hover', [ 'label' => esc_html__( 'Hover', 'sungarden' ) ] );

        $this->add_control(
            'button_hover_text_color',
            [
                'label' => esc_html__( 'Text Color', 'sungarden' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .element-slides__item .element-slides__item--link:hover, {{WRAPPER}} .element-slides__item .element-slides__item--link a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_background_color',
            [
                'label' => esc_html__( 'Background Color', 'sungarden' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .element-slides__item .element-slides__item--link:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_border_color',
            [
                'label' => esc_html__( 'Border Color', 'sungarden' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .element-slides__item .element-slides__item--link:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_navigation',
            [
                'label' => esc_html__( 'Navigation', 'sungarden' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'nav',
                            'value' => 'yes',
                        ],
                        [
                            'name' => 'dots',
                            'value' => 'yes',
                        ],
                    ],
                ],
            ]
        );

        $this->add_control(
            'heading_style_arrows',
            [
                'label' => esc_html__( 'Arrows', 'sungarden' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'conditions' => [
                    'terms' => [
                        [
                            'name' => 'nav',
                            'value' => 'yes',
                        ],
                    ],
                ],
            ]
        );

        $this->add_control(
            'arrows_size',
            [
                'label' => esc_html__( 'Arrows Size', 'sungarden' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 60,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .element-slides.owl-carousel .owl-nav button i.fa' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'conditions' => [
                    'terms' => [
                        [
                            'name' => 'nav',
                            'value' => 'yes',
                        ],
                    ],
                ],
            ]
        );

        $this->add_control(
            'arrows_color',
            [
                'label' => esc_html__( 'Arrows Color', 'sungarden' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .element-slides.owl-carousel .owl-nav button i.fa' => 'color: {{VALUE}};',
                ],
                'conditions' => [
                    'terms' => [
                        [
                            'name' => 'nav',
                            'value' => 'yes',
                        ],
                    ],
                ],
            ]
        );

        $this->add_control(
            'arrows_color_hover',
            [
                'label' => esc_html__( 'Arrows Color Hover', 'sungarden' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .element-slides.owl-carousel .owl-nav button i.fa:hover' => 'color: {{VALUE}};',
                ],
                'conditions' => [
                    'terms' => [
                        [
                            'name' => 'nav',
                            'value' => 'yes',
                        ],
                    ],
                ],
            ]
        );

        $this->add_control(
            'heading_style_dots',
            [
                'label' => esc_html__( 'Dots', 'sungarden' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'conditions' => [
                    'terms' => [
                        [
                            'name' => 'dots',
                            'value' => 'yes',
                        ],
                    ],
                ],
            ]
        );

        $this->add_control(
            'dots_size',
            [
                'label' => esc_html__( 'Dots Size', 'sungarden' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 5,
                        'max' => 60,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .element-slides.owl-carousel .owl-dots .owl-dot span' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
                'conditions' => [
                    'terms' => [
                        [
                            'name' => 'dots',
                            'value' => 'yes',
                        ],
                    ],
                ],
            ]
        );

        $this->add_control(
            'dots_color',
            [
                'label' => esc_html__( 'Dots Color', 'sungarden' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .element-slides.owl-carousel .owl-dots .owl-dot span' => 'background-color: {{VALUE}};',
                ],
                'conditions' => [
                    'terms' => [
                        [
                            'name' => 'dots',
                            'value' => 'yes',
                        ],
                    ],
                ],
            ]
        );

        $this->add_control(
            'dots_color_hover',
            [
                'label' => esc_html__( 'Dots Color Hover', 'sungarden' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .element-slides.owl-carousel .owl-dots .owl-dot.active span, {{WRAPPER}} .element-slides.owl-carousel .owl-dots .owl-dot:hover span' => 'background-color: {{VALUE}};',
                ],
                'conditions' => [
                    'terms' => [
                        [
                            'name' => 'dots',
                            'value' => 'yes',
                        ],
                    ],
                ],
            ]
        );

        $this->end_controls_section();
        
    }

    protected function render() {

        $settings  =   $this->get_settings_for_display();

	    $data_settings_owl  =   [
		    'items'     =>  1,
		    'loop'      =>  ( 'yes' === $settings['loop'] ),
		    'autoplay'  =>  ( 'yes' === $settings['autoplay'] ),
		    'nav'       =>  ( 'yes' === $settings['nav'] ),
		    'dots'      =>  ( 'yes' === $settings['dots'] ),
	    ];

	    // project
	    $cat_post       =   $settings['select_cat'];
	    $limit_post     =   $settings['limit'];
	    $order_by_post  =   $settings['order_by'];
	    $order_post     =   $settings['order'];

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

    ?>

            <div class="element-slides">
                <div class="custom-owl-carousel owl-carousel owl-theme" data-settings-owl='<?php echo wp_json_encode( $data_settings_owl ); ?>'>

                    <?php

                    foreach ( $settings['slides_list'] as $item ) :
                        $sungarden_slides_link         =   $item['link'];

                    ?>

                        <div class="element-slides__item elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?>">
                            <div class="element-slides__item--bg"></div>

                            <div class="element-slides__item--inner">
                                <?php if ( $item['background_overlay'] == 'yes' ) : ?>
                                    <div class="element-slides__item--overlay"></div>
                                <?php
                                endif;

                                if ( $item['show_content'] == 'yes' ) :
                                ?>

                                    <div class="element-slides__item--content">
                                        <?php if ( !empty( $item['heading'] ) ) : ?>
                                            <div class="element-slides__item--heading">
                                                <?php echo esc_html( $item['heading'] ); ?>
                                            </div>
                                        <?php endif; ?>

                                        <?php if ( !empty( $item['description'] ) ) : ?>
                                            <div class="element-slides__item--description">
                                                <?php echo esc_html( $item['description'] ); ?>
                                            </div>
                                        <?php endif; ?>

                                        <?php if ( !empty( $item['button_text'] ) ) : ?>
                                            <div class="element-slides__item--link">
                                                <?php if ( !empty( $sungarden_slides_link['url'] ) ) : ?>
                                                    <a href="<?php echo esc_url( $sungarden_slides_link['url'] ); ?>" <?php echo ( $sungarden_slides_link['is_external'] ? 'target="_blank"' : '' ); ?>>
                                                        <?php echo esc_html( $item['button_text'] ); ?>
                                                    </a>
                                                <?php
                                                else:
                                                    echo esc_html( $item['button_text'] );
                                                endif;
                                                ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                <?php endif; ?>
                            </div>
                        </div>

                    <?php endforeach; ?>

                </div>

                <?php if ( $query->have_posts() ) : ?>

                <div class="element-slides__project">
                    <h4 class="title-project">
                        <?php echo esc_html( $settings['text_view_detail'] ); ?>
                    </h4>

                    <div class="icon topToBottom">
                        <img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/icon/arrow.png' ) ); ?>" alt="">
                    </div>

                    <div class="slider-quick-project project-gallery-popup">
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
                                <div class="item-post__thumbnail" data-mfp-src="<?php echo esc_url( $featured_img_url ); ?>" data-mfp-content='<?php echo wp_json_encode( $dataCaption ) ; ?>'>
                                    <?php
                                    if ( has_post_thumbnail() ) :
                                        the_post_thumbnail( 'medium' );
                                    else:
                                        ?>

                                        <img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/no-image.png' ) ) ?>" alt="<?php the_title(); ?>" />

                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endwhile; wp_reset_postdata(); ?>
                    </div>
                </div>

                <?php endif; ?>
            </div>

        <?php
    }

}

Plugin::instance()->widgets_manager->register_widget_type( new sungarden_widget_slides );