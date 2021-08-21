<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class sungarden_widget_contact_cf7 extends Widget_Base {

	public function get_categories() {
		return array( 'sungarden_widgets' );
	}

	public function get_name() {
		return 'sungarden-contact-cf7';
	}

	public function get_title() {
		return esc_html__( 'Contact cf7', 'sungarden' );
	}

	public function get_icon() {
		return 'eicon-email-field';
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Content', 'sungarden' ),
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

		$this->end_controls_section();

		/* STYLE TAB */
		$this->start_controls_section('style', array(
			'label' =>  esc_html__( 'Button', 'sungarden' ),
			'tab'   =>  Controls_Manager::TAB_STYLE,
		));

		$this->add_control(
			'btn_color',
			[
				'label'     =>  __( 'Color', 'sungarden' ),
				'type'      =>  Controls_Manager::COLOR,
				'selectors' =>  [
					'{{WRAPPER}} form.wpcf7-form .wpcf7-submit' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'btn_background_color',
			[
				'label'     =>  __( 'Background Color', 'sungarden' ),
				'type'      =>  Controls_Manager::COLOR,
				'selectors' =>  [
					'{{WRAPPER}} form.wpcf7-form .wpcf7-submit' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'margin_bottom',
			[
				'label' => __( 'Margin bottom input', 'plugin-domain' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => '',
				],
				'selectors' => [
					'{{WRAPPER}} form.wpcf7-form .wpcf7-form-control-wrap' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'height_textarea',
			[
				'label' => __( 'Height Textarea', 'plugin-domain' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => '',
				],
				'selectors' => [
					'{{WRAPPER}} form.wpcf7-form .wpcf7-form-control-wrap textarea' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {

		$settings = $this->get_settings_for_display();

		?>

		<div class="element-contact-cf7">
			<?php echo do_shortcode( '[contact-form-7 id="'.esc_attr( $settings['select_cf7'] ).'"]' ); ?>
        </div>

		<?php

	}

}

Plugin::instance()->widgets_manager->register_widget_type( new sungarden_widget_contact_cf7 );