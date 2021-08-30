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
			'link',
			[
				'label' => esc_html__( 'Link Video (Youtube)', 'sungarden' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'https://youtube.com/watch', 'sungarden' ),
				'label_block' => true
			]
		);

		$this->add_control(
			'select_type_image',
			[
				'label'   => esc_html__( 'Select type image', 'sungarden' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '1',
				'options' => [
					'1' => esc_html__( 'Youtube', 'sungarden' ),
					'2' => esc_html__( 'Choose Image', 'sungarden' ),
				],
			]
		);

		$this->add_control(
			'size_image',
			[
				'label'   => esc_html__( 'Size image', 'sungarden' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'hqdefault',
				'options' => [
					'default' => esc_html__( 'default', 'sungarden' ),
					'mqdefault' => esc_html__( 'mqdefault', 'sungarden' ),
					'hqdefault' => esc_html__( 'hqdefault', 'sungarden' ),
                    'sddefault' => esc_html__( 'sddefault', 'sungarden' ),
				],
				'condition' =>  [
					'select_type_image' => '1',
				],
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
				'condition' =>  [
					'select_type_image' => '2',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {

		$settings = $this->get_settings_for_display();
		$videoUrl = $settings['link'];
		$yt_id = sungarden_helpwp_youtube_id($videoUrl);

		?>

		<div class="element-video-popup">
            <div class="element-video-popup__warp">
	            <?php  if ( $settings['select_type_image'] == '1' ) : ?>
                    <img alt="<?php the_title(); ?>" src="https://img.youtube.com/vi/<?php echo esc_html( $yt_id ); ?>/<?php echo esc_attr( $settings['size_image'] ) ?>.jpg">
                <?php
                else:
	                echo wp_get_attachment_image( $settings['image']['id'], 'full' );
                endif;
                ?>

                <div class="play-video" data-fancybox="group" data-src="<?php echo esc_url( $videoUrl ); ?>">
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