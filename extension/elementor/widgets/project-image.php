<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class sungarden_widget_project_image extends Widget_Base {

	public function get_categories() {
		return array( 'sungarden_widgets' );
	}

	public function get_name() {
		return 'sungarden-project-image';
	}

	public function get_title() {
		return esc_html__( 'Project Images', 'sungarden' );
	}

	public function get_icon() {
		return 'eicon-text-area';
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Description', 'sungarden' ),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'list_image',
			[
				'label' => esc_html__( 'Choose Image', 'sungarden' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater->add_responsive_control(
			'width',
			[
				'label' => __( 'Width', 'sungarden' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 50,
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}.grid-item' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$repeater->add_responsive_control(
			'height',
			[
				'label' => __( 'Height', 'sungarden' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 2000,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => '606',
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}.grid-item' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'list',
			[
				'label' => esc_html__( 'Images', 'sungarden' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
			]
		);

		$this->end_controls_section();

	}

	protected function render() {

		$settings = $this->get_settings_for_display();
		
	?>

		<div class="element-project-gallery d-flex flex-wrap">
			<?php foreach ( $settings['list'] as $item ) : ?>
				<div class="grid-item elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?>" data-fancybox="gallery" data-src="<?php echo esc_url( $item['list_image']['url'] ); ?>">
					<?php echo wp_get_attachment_image( $item['list_image']['id'], 'full' ); ?>
				</div>
			<?php endforeach; ?>
		</div>

	<?php

	}

}

Plugin::instance()->widgets_manager->register_widget_type( new sungarden_widget_project_image );