<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class sungarden_widget_service extends Widget_Base {

	public function get_categories() {
		return array( 'sungarden_widgets' );
	}

	public function get_name() {
		return 'sungarden-service';
	}

	public function get_title() {
		return esc_html__( 'Service', 'sungarden' );
	}

	public function get_icon() {
		return 'eicon-cloud-check';
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Content', 'sungarden' ),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'list_heading', [
				'label' => esc_html__( 'Heading', 'sungarden' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'List Heading' , 'sungarden' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'list_title', [
				'label' => esc_html__( 'Title', 'sungarden' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'List Title' , 'sungarden' ),
				'label_block' => true,
			]
		);

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

		$repeater->add_control(
			'list_link',
			[
				'label' => esc_html__( 'Link', 'sungarden' ),
				'type' => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'sungarden' ),
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				],
			]
		);

		$this->add_control(
			'list',
			[
				'label' => esc_html__( 'List', 'sungarden' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'list_title' => __( 'Title #1', 'sungarden' ),
					],
					[
						'list_title' => __( 'Title #2', 'sungarden' ),
					],
				],
				'title_field' => '{{{ list_title }}}',
			]
		);

		$this->add_control(
			'text_link', [
				'label' => esc_html__( 'Text Link', 'sungarden' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Xem chi tiết' , 'sungarden' ),
				'label_block' => true,
			]
		);

		$this->end_controls_section();

		/* Section Layout */
		$this->start_controls_section(
			'section_layout',
			[
				'label' => esc_html__( 'Layout Settings', 'sungarden' )
			]
		);

		$this->add_control(
			'column_number',
			[
				'label'   => esc_html__( 'Column', 'sungarden' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 3,
				'options' => [
					6 => esc_html__( '6 Column', 'sungarden' ),
					5 => esc_html__( '5 Column', 'sungarden' ),
					4 => esc_html__( '4 Column', 'sungarden' ),
					3 => esc_html__( '3 Column', 'sungarden' ),
					2 => esc_html__( '2 Column', 'sungarden' ),
					1 => esc_html__( '1 Column', 'sungarden' ),
				],
			]
		);

		$this->add_responsive_control(
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
					'size' => '230',
				],
				'selectors' => [
					'{{WRAPPER}} .element-service__item .box-image a' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {

		$settings = $this->get_settings_for_display();

		?>

		<div class="element-service">
			<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-<?php echo esc_attr( $settings['column_number'] ) ?> custom-row">
				<?php
				foreach ( $settings['list'] as $item ) :
					$target = $item['list_link']['is_external'] ? ' target=_blank' : '';
					$nofollow = $item['list_link']['nofollow'] ? ' rel=nofollow' : '';
				?>

				<div class="col custom-col d-flex flex-column">
					<div class="element-service__item text-center d-flex flex-column flex-grow-1">
						<div class="top flex-grow-1">
							<p class="sub-title">
								<?php echo esc_html( $item['list_heading'] ); ?>
							</p>

							<h6 class="title">
								<?php echo esc_html( $item['list_title'] ); ?>
							</h6>
						</div>

						<div class="box-image">
							<a class="link-item" href="<?php echo esc_url( $item['list_link']['url'] ); ?>"<?php echo esc_attr( $target . $nofollow ) ?>>
								<?php echo wp_get_attachment_image( $item['list_image']['id'], 'large' ); ?>
							</a>
						</div>

						<a class="link-item" href="<?php echo esc_url( $item['list_link']['url'] ); ?>"<?php echo esc_attr( $target . $nofollow ) ?>>
							<?php echo esc_html( $settings['text_link'] ); ?>
						</a>
					</div>
				</div>

				<?php endforeach; ?>
			</div>
		</div>

		<?php

	}

}

Plugin::instance()->widgets_manager->register_widget_type( new sungarden_widget_service );