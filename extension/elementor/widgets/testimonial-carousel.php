<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class sungarden_testimonial_carousel extends Widget_Base {

	public function get_categories() {
		return array( 'sungarden_widgets' );
	}

	public function get_name() {
		return 'sungarden-testimonial-carousel';
	}

	public function get_title() {
		return esc_html__( 'Testimonial Carousel', 'sungarden' );
	}

	public function get_icon() {
		return 'eicon-testimonial';
	}

	public function get_script_depends() {
		return ['sungarden-elementor-custom'];
	}

	protected function _register_controls() {

		/* Section Product */
		$this->start_controls_section(
			'section_content',
			[
				'label' =>  esc_html__( 'Testimonial Carousel', 'sungarden' )
			]
		);

		$this->add_control(
			'heading',
			[
				'label'         =>  esc_html__( 'Heading', 'sungarden' ),
				'type'          =>  Controls_Manager::TEXT,
				'default'       =>  esc_html__( 'Phản hồi từ Khách hàng của chúng tôi', 'sungarden' ),
				'label_block'   =>  true
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'list_title', [
				'label' => esc_html__( 'Name', 'sungarden' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'List Title' , 'sungarden' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'list_position',
			[
				'label'         =>  esc_html__( 'Position', 'sungarden' ),
				'type'          =>  Controls_Manager::TEXT,
				'default'       =>  esc_html__( 'Marketing', 'sungarden' ),
				'label_block'   =>  true
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
			'list_description',
			[
				'label' => esc_html__( 'Description', 'sungarden' ),
				'type' => Controls_Manager::TEXTAREA,
				'rows' => 10,
				'default' => esc_html__( 'Default description', 'sungarden' ),
				'placeholder' => esc_html__( 'Type your description here', 'sungarden' ),
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
				'default'   =>  3,
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
				'default'   =>  2,
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

	}

	protected function render() {

		$settings =   $this->get_settings_for_display();
		$data_settings_owl = [
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

		?>

		<div class="element-testimonial-carousel">
            <h3 class="heading text-center">
                <?php echo esc_html($settings['heading']); ?>
            </h3>

			<div class="custom-owl-carousel custom-equal-height-owl owl-carousel owl-theme" data-settings-owl='<?php echo wp_json_encode( $data_settings_owl ) ; ?>'>
				<?php foreach ( $settings['list'] as $item ) : ?>
					<div class="item">
						<div class="item-box">
							<div class="item-img">
								<?php echo wp_get_attachment_image( $item['list_image']['id'], 'full' ); ?>
							</div>

                            <div class="item-content">
                                <h4 class="name">
		                            <?php echo esc_html( $item['list_title'] ); ?>
                                </h4>

                                <p class="position">
                                    <?php echo esc_html( $item['list_position'] ); ?>
                                </p>

                                <p class="item-desc">
		                            <?php echo wp_kses_post( $item['list_description'] ) ?>
                                </p>
                            </div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>

		<?php


	}

	protected function _content_template() {}

}

Plugin::instance()->widgets_manager->register_widget_type( new sungarden_testimonial_carousel );