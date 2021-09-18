<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class sungarden_widget_step_box extends Widget_Base {

	public function get_categories() {
		return array( 'sungarden_widgets' );
	}

	public function get_name() {
		return 'sungarden-step-box';
	}

	public function get_title() {
		return esc_html__( 'Step Box', 'sungarden' );
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
			'list_step', [
				'label' => esc_html__( 'Step', 'sungarden' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'List Step' , 'sungarden' ),
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
			'list_description',
			[
				'label'     =>  esc_html__( 'Description', 'sungarden' ),
				'type'      =>  Controls_Manager::WYSIWYG,
				'default'   =>  esc_html__( 'Default description', 'sungarden' ),
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
						'list_step' => __( 'Step #1', 'sungarden' ),
					],
					[
						'list_step' => __( 'Step #2', 'sungarden' ),
					],
					[
						'list_step' => __( 'Step #3', 'sungarden' ),
					],
				],
				'title_field' => '{{{ list_step }}}',
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

		$this->end_controls_section();

	}

	protected function render() {

		$settings = $this->get_settings_for_display();

	?>

		<div class="element-step-box">
			<div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-<?php echo esc_attr( $settings['column_number'] ) ?>">
				<?php foreach ( $settings['list'] as $item ) : ?>
                    <div class="col col-mt d-flex flex-column">
                        <div class="item d-flex flex-column flex-grow-1">
                            <span class="item__step">
                                <?php echo esc_html( $item['list_step'] ); ?>
                            </span>

                            <h5 class="item__title">
                                <?php echo esc_html( $item['list_title'] ); ?>
                            </h5>

                            <div class="item__desc">
	                            <?php echo wp_kses_post( $item['list_description'] ); ?>
                            </div>
                        </div>
                    </div>
				<?php endforeach; ?>
			</div>
		</div>

	<?php

	}

}

Plugin::instance()->widgets_manager->register_widget_type( new sungarden_widget_step_box );