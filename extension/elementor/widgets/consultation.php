<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class sungarden_widget_consultation extends Widget_Base {

	public function get_categories() {
		return array( 'sungarden_widgets' );
	}

	public function get_name() {
		return 'sungarden-consultation';
	}

	public function get_title() {
		return esc_html__( 'Consultation', 'sungarden' );
	}

	public function get_icon() {
		return 'eicon-email-field';
	}

	protected function _register_controls() {

		// Content
		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Content', 'sungarden' ),
			]
		);

		$this->add_control(
			'title',
			[
				'label'         =>  esc_html__( 'Title', 'sungarden' ),
				'type'          =>  Controls_Manager::TEXT,
				'default'       =>  esc_html__( 'Sun Garden giúp bạn xây dựng khu vườn trong mơ !', 'sungarden' ),
				'label_block'   =>  true
			]
		);

		$this->add_control(
			'description',
			[
				'label'     =>  esc_html__( 'Description', 'sungarden' ),
				'type'      =>  Controls_Manager::WYSIWYG,
				'default'   =>  esc_html__( 'Sun Garden mang đến cho khách hàng những công trình sân vườn chất lượng và uy tín. Những không gian sống thư giãn và an nhiên', 'sungarden' ),
			]
		);

		$this->end_controls_section();

		// Contact form
		$this->start_controls_section(
			'section_cf7',
			[
				'label' => esc_html__( 'Contact Form', 'sungarden' ),
			]
		);

		$this->add_control(
			'select_cf7',
			[
				'label'     =>  esc_html__( 'Select Contact Form CF7', 'sungarden' ),
				'type'      =>  Controls_Manager::SELECT,
				'default'   =>  'id',
				'label_block' =>  true,
				'options'   =>  sungarden_get_form_cf7(),
			]
		);

		$this->add_control(
			'text_btn_cf7',
			[
				'label'         =>  esc_html__( 'Text', 'sungarden' ),
				'type'          =>  Controls_Manager::TEXT,
				'default'       =>  esc_html__( 'Đăng ký tư vấn miễn phí', 'sungarden' ),
				'label_block'   =>  true
			]
		);

		$this->end_controls_section();

		// Contact us
		$this->start_controls_section(
			'section_contact_us',
			[
				'label' => esc_html__( 'Contact us', 'sungarden' ),
			]
		);

		$this->add_control(
			'text_phone',
			[
				'label'         =>  esc_html__( 'Text', 'sungarden' ),
				'type'          =>  Controls_Manager::TEXT,
				'default'       =>  esc_html__( 'Hoặc liên hệ:', 'sungarden' ),
				'label_block'   =>  true
			]
		);

		$this->add_control(
			'phone',
			[
				'label'         =>  esc_html__( 'Phone', 'sungarden' ),
				'type'          =>  Controls_Manager::TEXT,
				'default'       =>  '0123.456.789',
				'label_block'   =>  true
			]
		);

		$this->end_controls_section();

		// Style tab title
		$this->start_controls_section('style_title', array(
			'label' =>  esc_html__( 'Title', 'sungarden' ),
			'tab'   =>  Controls_Manager::TAB_STYLE,
		));

		$this->add_control(
			'title_color',
			[
				'label'     =>  __( 'Title Color', 'sungarden' ),
				'type'      =>  Controls_Manager::COLOR,
				'selectors' =>  [
					'{{WRAPPER}} .element-consultation .title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .element-consultation .title',
			]
		);

		$this->end_controls_section();

		// Style tab desc
		$this->start_controls_section('style_description', array(
			'label' =>  esc_html__( 'Description', 'sungarden' ),
			'tab'   =>  Controls_Manager::TAB_STYLE,
		));

		$this->add_control(
			'description_color',
			[
				'label'     =>  __( 'Title Color', 'sungarden' ),
				'type'      =>  Controls_Manager::COLOR,
				'selectors' =>  [
					'{{WRAPPER}} .element-consultation .desc' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'description_typography',
				'selector' => '{{WRAPPER}} .element-consultation .desc',
			]
		);

		$this->end_controls_section();

		// Style tab contact us
		$this->start_controls_section('style_contact us', array(
			'label' =>  esc_html__( 'Contact us', 'sungarden' ),
			'tab'   =>  Controls_Manager::TAB_STYLE,
		));

		$this->add_control(
			'contact_us_text_color',
			[
				'label'     =>  __( 'Text Color', 'sungarden' ),
				'type'      =>  Controls_Manager::COLOR,
				'selectors' =>  [
					'{{WRAPPER}} .element-consultation .contact-us span' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'contact_us_phone_color',
			[
				'label'     =>  __( 'Phone Color', 'sungarden' ),
				'type'      =>  Controls_Manager::COLOR,
				'selectors' =>  [
					'{{WRAPPER}} .element-consultation .contact-us a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'contact_us_typography',
				'selector' => '{{WRAPPER}} .element-consultation .contact-us',
			]
		);

		$this->end_controls_section();

	}

	protected function render() {

		$settings = $this->get_settings_for_display();
		?>

		<div class="element-consultation text-center">
            <h4 class="title">
                <?php echo esc_html( $settings['title'] ); ?>
            </h4>

            <div class="desc">
	            <?php echo wp_kses_post( $settings['description'] ); ?>
            </div>

            <div class="btn-registration">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".modal-cf7">
                    <?php echo esc_html( $settings['text_btn_cf7'] ); ?>
                </button>
            </div>

            <div class="contact-us">
                <span>
                    <?php echo esc_html( $settings['text_phone'] ); ?>
                </span>

                <a href="tel:<?php echo esc_attr( $settings['phone'] ); ?>">
	                <?php echo esc_html( $settings['phone'] ); ?>
                </a>
            </div>

            <!-- Modal contact form -->
            <div class="modal modal-cf7 fade" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">
                                <?php echo esc_html( $settings['text_btn_cf7'] ); ?>
                            </h5>

                            <button type="button" class="btn-close-modal" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>

                        <div class="modal-body">
                            <?php
                            if ( $settings['select_cf7'] ) :
                                echo do_shortcode( '[contact-form-7 id="'.esc_attr( $settings['select_cf7'] ).'"]' );
                            endif;
                            ?>
                        </div>

                        <div class="modal-footer">
                            <span>
                                <?php echo esc_html( $settings['text_phone'] ); ?>
                            </span>

                            <a href="tel:<?php echo esc_attr( $settings['phone'] ); ?>">
                                <?php echo esc_html( $settings['phone'] ); ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
		</div>

		<?php

	}

}

Plugin::instance()->widgets_manager->register_widget_type( new sungarden_widget_consultation );