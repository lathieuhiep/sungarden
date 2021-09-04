<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class sungarden_widget_grid_even_odd extends Widget_Base {

	public function get_categories() {
		return array( 'sungarden_widgets' );
	}

	public function get_name() {
		return 'sungarden-grid-even-odd';
	}

	public function get_title() {
		return esc_html__( 'Grid Even Odd', 'sungarden' );
	}

	public function get_icon() {
		return 'eicon-posts-grid';
	}

	protected function _register_controls() {
		/* Section content */
		$this->start_controls_section(
			'section_content',
			[
				'label' =>  esc_html__( 'Content', 'sungarden' )
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
			'list_sub_title',
			[
				'label'         =>  esc_html__( 'Sub Title', 'sungarden' ),
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

		$repeater->add_control(
			'list_link',
			[
				'label' => esc_html__( 'Link', 'sungarden' ),
				'type' => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'sungarden' ),
				'show_external' => true,
				'default' => [
					'url' => '#',
					'is_external' => false,
					'nofollow' => false,
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

		/* Section content view all */
		$this->start_controls_section(
			'section_content_view_all',
			[
				'label' =>  esc_html__( 'View All', 'sungarden' )
			]
		);

		$this->add_control(
			'link',
			[
				'label' => esc_html__( 'Link', 'sungarden' ),
				'type' => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'sungarden' ),
				'show_external' => true,
				'default' => [
					'url' => '#',
					'is_external' => false,
					'nofollow' => false,
				],
			]
		);

		$this->add_control(
			'text_link_view_all', [
				'label' => esc_html__( 'Text Link', 'sungarden' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Xem toàn bộ dự án' , 'sungarden' ),
				'label_block' => true,
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings      = $this->get_settings_for_display();
		$target = $settings['link']['is_external'] ? ' target=_blank' : '';
		$nofollow = $settings['link']['nofollow'] ? ' rel=nofollow' : '';
	?>

		<div class="element-grid-even-odd element-project-box">
            <div class="d-flex flex-wrap row-cols-1 row-cols-sm-2 row-cols-lg-1">
                <?php
                foreach ( $settings['list'] as $item ) :
	                $target = $item['list_link']['is_external'] ? ' target=_blank' : '';
	                $nofollow = $item['list_link']['nofollow'] ? ' rel=nofollow' : '';
                ?>
                    <div class="item-post d-flex flex-wrap row-cols-1 row-cols-lg-2">
                        <div class="item-post__left">
                            <h5 class="title">
		                        <?php echo esc_html( $item['list_title'] ); ?>
                            </h5>

                            <p class="place">
		                        <?php echo esc_html( $item['list_sub_title'] ); ?>
                            </p>

                            <div class="desc">
                                <p>
	                                <?php echo wp_kses_post( $item['list_description'] ) ?>
                                </p>
                            </div>

                            <a class="link-item" href="<?php echo esc_url( $item['list_link']['url'] ); ?>"<?php echo esc_attr( $target . $nofollow ) ?>>
	                            <?php echo esc_html( $settings['text_link'] ); ?>
                            </a>
                        </div>

                        <div class="item-post__right">
	                        <?php echo wp_get_attachment_image( $item['list_image']['id'], 'large' ); ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="box-link-all text-center">
                <a href="<?php echo esc_url( $settings['link']['url'] ); ?>"<?php echo esc_attr( $target . $nofollow ) ?>>
					<?php esc_html_e('Xem toàn bộ dự án', 'sungarden'); ?>
                </a>
            </div>
		</div>

	<?php
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new sungarden_widget_grid_even_odd );