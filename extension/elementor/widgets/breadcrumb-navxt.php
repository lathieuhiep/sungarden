<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class sungarden_widget_breadcrumb_navxt extends Widget_Base {

	public function get_categories(): array {
		return array( 'sungarden_widgets' );
	}

	public function get_name(): string {
		return 'sungarden-breadcrumb-navxt';
	}

	public function get_title(): string {
		return esc_html__( 'Breadcrumb Navxt', 'sungarden' );
	}

	public function get_icon() {
		return 'eicon-product-breadcrumbs';
	}

	protected function _register_controls() {

	    // content
		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Content', 'sungarden' ),
			]
		);

		$this->add_control(
			'heading',
			[
				'label'       => esc_html__( 'Heading', 'sungarden' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Heading', 'sungarden' ),
				'label_block' => true
			]
		);

		$this->end_controls_section();

		// style heading
		$this->start_controls_section('style_heading', array(
			'label' =>  esc_html__( 'Heading', 'sungarden' ),
			'tab'   =>  Controls_Manager::TAB_STYLE,
		));

		$this->add_control(
			'heading_color',
			[
				'label'     =>  __( 'Color', 'sungarden' ),
				'type'      =>  Controls_Manager::COLOR,
				'selectors' =>  [
					'{{WRAPPER}} .element-breadcrumbs .heading' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		// style breadcrumbs
		$this->start_controls_section('style_breadcrumbs', array(
			'label' =>  esc_html__( 'Breadcrumbs', 'sungarden' ),
			'tab'   =>  Controls_Manager::TAB_STYLE,
		));

		$this->add_control(
			'breadcrumbs_color',
			[
				'label'     =>  __( 'Color', 'sungarden' ),
				'type'      =>  Controls_Manager::COLOR,
				'selectors' =>  [
					'{{WRAPPER}} .element-breadcrumbs .breadcrumbs-col, .element-breadcrumbs .breadcrumbs-col span a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();


	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( function_exists( 'bcn_display' ) ) :
			?>

            <div class="element-breadcrumbs breadcrumbs" typeof="BreadcrumbList" vocab="http://schema.org/">
                <h3 class="heading">
					<?php echo wp_kses_post( $settings['heading'] ); ?>
                </h3>

                <div class="breadcrumbs-col">
					<?php bcn_display(); ?>
                </div>
            </div>

		<?php
		endif;
	}

}

Plugin::instance()->widgets_manager->register_widget_type( new sungarden_widget_breadcrumb_navxt );