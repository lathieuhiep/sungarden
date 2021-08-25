<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class sungarden_widget_page_content extends Widget_Base {

	public function get_categories() {
		return array( 'sungarden_widgets' );
	}

	public function get_name() {
		return 'sungarden-page-content';
	}

	public function get_title() {
		return esc_html__( 'Page Content', 'sungarden' );
	}

	public function get_icon() {
		return 'eicon-posts-grid';
	}

	protected function _register_controls() {

		/* Section Query */
		$this->start_controls_section(
			'section_query',
			[
				'label' => esc_html__( 'Query', 'sungarden' )
			]
		);

		$this->add_control(
			'select_page',
			[
				'label'       => esc_html__( 'Select Page', 'sungarden' ),
				'type'        => Controls_Manager::SELECT,
				'options'     => sungarden_get_list_page(),
				'multiple'    => true,
				'label_block' => true
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$select_page = $settings['select_page'];

		if ( $select_page ) :
			echo  \Elementor\Plugin::$instance->frontend->get_builder_content( $select_page, true );
		endif;
	}

}

Plugin::instance()->widgets_manager->register_widget_type( new sungarden_widget_page_content );