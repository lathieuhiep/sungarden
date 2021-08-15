<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class sungarden_widget_about_text extends Widget_Base {

    public function get_categories() {
        return array( 'sungarden_widgets' );
    }

    public function get_name() {
        return 'sungarden-about-text';
    }

    public function get_title() {
        return esc_html__( 'About Text', 'sungarden' );
    }

	public function get_icon() {
		return 'eicon-text-area';
	}

    protected function _register_controls() {

        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__( 'Text', 'sungarden' ),
            ]
        );

        $this->add_control(
            'widget_title',
            [
                'label'         =>  esc_html__( 'Title', 'sungarden' ),
                'type'          =>  Controls_Manager::TEXT,
                'default'       =>  esc_html__( 'Title About Text', 'sungarden' ),
                'label_block'   =>  true
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_text_editor',
            [
                'label' => esc_html__( 'Text Editor', 'sungarden' ),
            ]
        );

	    $this->add_control(
		    'image',
		    [
			    'label' => esc_html__( 'Choose Image', 'sungarden' ),
			    'type' => Controls_Manager::MEDIA,
			    'default' => [
				    'url' => Utils::get_placeholder_image_src(),
			    ],
		    ]
	    );

        $this->add_control(
            'widget_description',
            [
                'label'     =>  esc_html__( 'Description', 'sungarden' ),
                'type'      =>  Controls_Manager::WYSIWYG,
                'default'   =>  esc_html__( 'Default description', 'sungarden' ),
            ]
        );

        $this->end_controls_section();

        /*STYLE TAB*/
        $this->start_controls_section('style', array(
            'label' =>  esc_html__( 'Text', 'sungarden' ),
            'tab'   =>  Controls_Manager::TAB_STYLE,
        ));

        $this->add_control(
            'title_color',
            [
                'label'     =>  __( 'Title Color', 'sungarden' ),
                'type'      =>  Controls_Manager::COLOR,
                'selectors' =>  [
                    '{{WRAPPER}} .element-about-text__title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'text_editor_color',
            [
                'label'     =>  __( 'Text Editor Color', 'sungarden' ),
                'type'      =>  Controls_Manager::COLOR,
                'selectors' =>  [
                    '{{WRAPPER}} .element-about-text__description' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {

        $settings = $this->get_settings_for_display();
        ?>

        <div class="element-about-text">
            <div class="element-about-text__top">
                <h2 class="element-about-text__title">
		            <?php echo wp_kses_post( $settings['widget_title'] ); ?>
                </h2>

                <span class="element-about-text__line">&nbsp;</span>
            </div>

            <?php if ( !empty( $settings['widget_description'] ) ) : ?>

                <div class="element-about-text__description d-flex">
                    <?php if ( $settings['image']['url'] ) : ?>
                        <div class="image-text flex-lg-shrink-0 flex-grow-0 flex-fill">
	                        <?php echo wp_get_attachment_image( $settings['image']['id'], 'full' ); ?>
                        </div>
                    <?php endif; ?>

                    <div class="box-content flex-grow-1">
	                    <?php echo wp_kses_post( $settings['widget_description'] ); ?>
                    </div>
                </div>

            <?php endif; ?>
        </div>

        <?php

    }

}

Plugin::instance()->widgets_manager->register_widget_type( new sungarden_widget_about_text );