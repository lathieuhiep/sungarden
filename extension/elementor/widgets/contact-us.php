<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class sungarden_widget_contact_us extends Widget_Base {

	public function get_categories() {
		return array( 'sungarden_widgets' );
	}

	public function get_name() {
		return 'sungarden-contact-us';
	}

	public function get_title() {
		return esc_html__( 'Contact us', 'sungarden' );
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
			'title',
			[
				'label'         =>  esc_html__( 'Title', 'sungarden' ),
				'type'          =>  Controls_Manager::TEXT,
				'default'       =>  esc_html__( 'Liên hệ ngay với', 'sungarden' ),
				'label_block'   =>  true
			]
		);

		$this->add_control(
			'sub_title',
			[
				'label'         =>  esc_html__( 'Sub Title', 'sungarden' ),
				'type'          =>  Controls_Manager::TEXT,
				'default'       =>  esc_html__( 'Sun Garden', 'sungarden' ),
				'label_block'   =>  true
			]
		);

		$this->add_control(
			'hotline',
			[
				'label'         =>  esc_html__( 'Hotline', 'sungarden' ),
				'type'          =>  Controls_Manager::TEXT,
				'default'       =>  esc_html__( '0911.312.300', 'sungarden' ),
				'label_block'   =>  true
			]
		);

		$this->add_control(
			'link',
			[
				'label' => esc_html__( 'Link Chat', 'sungarden' ),
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

		$this->end_controls_section();

		/*STYLE TAB*/
		$this->start_controls_section('style', array(
			'label' =>  esc_html__( 'Content', 'sungarden' ),
			'tab'   =>  Controls_Manager::TAB_STYLE,
		));

		$this->add_control(
			'background_content',
			[
				'label'     =>  __( 'Background', 'sungarden' ),
				'type'      =>  Controls_Manager::COLOR,
				'selectors' =>  [
					'{{WRAPPER}} .element-contact-us' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {

		$settings = $this->get_settings_for_display();
		$target = $settings['link']['is_external'] ? ' target=_blank' : '';
		$nofollow = $settings['link']['nofollow'] ? ' rel=nofollow' : '';

		?>

		<div class="element-contact-us text-center">
			<h5 class="title">
				<?php echo esc_html( $settings['title'] ); ?>
			</h5>

			<h4 class="sub-title">
				<?php echo esc_html( $settings['sub_title'] ); ?>
			</h4>

			<div class="action d-flex flex-column">
				<a class="hotline" href="tel:<?php echo esc_attr( $settings['hotline'] ); ?>">
					<?php esc_html_e('Hotline' , 'sungarden'); ?>:

					<b>
						<?php echo esc_html( $settings['hotline'] ); ?>
					</b>
				</a>

				<a class="chat" href="<?php echo esc_url( $settings['link']['url'] ); ?>"<?php echo esc_attr( $target . $nofollow ) ?>>
					<img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/icon/chat-mess.png' ) ); ?>" alt="">

					<?php esc_html_e('Chát với chúng tôi', 'sungarden'); ?>
				</a>
			</div>
		</div>

		<?php

	}

}

Plugin::instance()->widgets_manager->register_widget_type( new sungarden_widget_contact_us );