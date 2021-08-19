<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class sungarden_widget_service_detail_content extends Widget_Base {

	public function get_categories() {
		return array( 'sungarden_widgets' );
	}

	public function get_name() {
		return 'sungarden-service-detail-content';
	}

	public function get_title() {
		return esc_html__( 'Service Detail Content', 'sungarden' );
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
			'description',
			[
				'label'     =>  esc_html__( 'Description', 'sungarden' ),
				'type'      =>  Controls_Manager::WYSIWYG,
				'default'   =>  esc_html__( 'Default description', 'sungarden' ),
			]
		);

		$this->end_controls_section();

	}

	protected function render() {

		$settings = $this->get_settings_for_display();
	?>

		<div class="element-service-detail-content">
			<h1 class="title">
				<?php the_title(); ?>
			</h1>

			<?php sungarden_post_share(); ?>

			<div class="detail-content">
				<div class="content-desc">
					<?php echo wp_kses_post( $settings['description'] ); ?>
				</div>

				<div class="read-more-service d-flex flex-column align-items-center justify-content-end">
                    <?php esc_html_e('Xem thêm', 'sungarden'); ?>

                    <img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/icon/arrow-down.png' ) ); ?>" alt="">
				</div>
			</div>
		</div>

	<?php

	}

}

Plugin::instance()->widgets_manager->register_widget_type( new sungarden_widget_service_detail_content );