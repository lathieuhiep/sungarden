<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class sungarden_widget_video_popup extends Widget_Base {

	public function get_categories() {
		return array( 'sungarden_widgets' );
	}

	public function get_name() {
		return 'sungarden-video-popup';
	}

	public function get_title() {
		return esc_html__( 'Video Popup', 'sungarden' );
	}

	public function get_icon() {
		return 'eicon-video-camera';
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Content', 'sungarden' ),
			]
		);

		$this->add_control(
			'title', [
				'label' => esc_html__( 'Title', 'sungarden' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'VILLA RIVERSIDE DONG NAI' , 'sungarden' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'sub_title', [
				'label' => esc_html__( 'Sub Title', 'sungarden' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Đống Đa, Hà Nội' , 'sungarden' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'image',
			[
				'label' => esc_html__( 'Choose Image', 'sungarden' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_control(
			'link',
			[
				'label' => esc_html__( 'Link Video (Youtube)', 'sungarden' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'https://youtube.com/watch', 'sungarden' ),
				'label_block' => true
			]
		);

		$this->end_controls_section();

	}

	protected function render() {

		$settings = $this->get_settings_for_display();

		?>

		<div class="element-video-popup">
            <div class="element-video-popup__warp">
	            <?php
                if ( $settings['image']['url'] ) :
	                echo wp_get_attachment_image( $settings['image']['id'], 'full' );
                else:
                ?>
                    <img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/no-image.png' ) ) ?>" alt="<?php echo esc_attr( $settings['title'] ); ?>"/>
                <?php endif; ?>

                <div class="play-video" data-fancybox="group" data-src="<?php echo esc_url( $settings['link'] ); ?>">
                    <i class="fas fa-play"></i>
                </div>

                <div class="content">
                    <h5 class="title">
			            <?php echo esc_html( $settings['title'] ); ?>
                    </h5>

                    <p class="place">
	                    <?php echo esc_html( $settings['sub_title'] ); ?>
                    </p>
                </div>
            </div>
		</div>

		<?php

	}

}

Plugin::instance()->widgets_manager->register_widget_type( new sungarden_widget_video_popup );