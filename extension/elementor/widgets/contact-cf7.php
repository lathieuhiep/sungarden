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
		return 'eicon-text-area';
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Content', 'sungarden' ),
			]
		);

		$this->add_control(
			'heading',
			[
				'label'         =>  esc_html__( 'Heading', 'sungarden' ),
				'type'          =>  Controls_Manager::TEXT,
				'default'       =>  esc_html__( 'Heading', 'sungarden' ),
				'label_block'   =>  true
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