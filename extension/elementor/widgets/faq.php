<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class sungarden_widget_faq extends Widget_Base {

	public function get_categories() {
		return array( 'sungarden_widgets' );
	}

	public function get_name() {
		return 'sungarden-faq';
	}

	public function get_title() {
		return esc_html__( 'Faq', 'sungarden' );
	}

	public function get_icon() {
		return 'eicon-help-o';
	}

	protected function _register_controls() {

		/* Section Query */
		$this->start_controls_section(
			'section_query',
			[
				'label' => esc_html__( 'Query', 'sungarden' )
			]
		);

		$this->add_control(
			'limit',
			[
				'label'   => esc_html__( 'Number of Posts', 'sungarden' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 5,
				'min'     => 1,
				'max'     => 100,
				'step'    => 1,
			]
		);

		$this->add_control(
			'order_by',
			[
				'label'   => esc_html__( 'Order By', 'sungarden' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'id',
				'options' => [
					'id'     => esc_html__( 'Post ID', 'sungarden' ),
					'author' => esc_html__( 'Post Author', 'sungarden' ),
					'title'  => esc_html__( 'Title', 'sungarden' ),
					'date'   => esc_html__( 'Date', 'sungarden' ),
					'rand'   => esc_html__( 'Random', 'sungarden' ),
				],
			]
		);

		$this->add_control(
			'order',
			[
				'label'   => esc_html__( 'Order', 'sungarden' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'ASC',
				'options' => [
					'ASC'  => esc_html__( 'Ascending', 'sungarden' ),
					'DESC' => esc_html__( 'Descending', 'sungarden' ),
				],
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
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {

		$settings      = $this->get_settings_for_display();
		$limit_post    = $settings['limit'];
		$order_by_post = $settings['order_by'];
		$order_post    = $settings['order'];
		$target = $settings['link']['is_external'] ? ' target=_blank' : '';
		$nofollow = $settings['link']['nofollow'] ? ' rel=nofollow' : '';

		$args = array(
			'post_type'           => 'sungarden_faq',
			'posts_per_page'      => $limit_post,
			'orderby'             => $order_by_post,
			'order'               => $order_post,
			'ignore_sticky_posts' => 1,
		);

		$query = new \WP_Query( $args );

		if ( $query->have_posts() ) :
            $loop = 1;
	?>

		<div class="element-faq">
            <div class="accordion" id="accordionExample">
                <?php while ( $query->have_posts() ): $query->the_post(); ?>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingFaq-<?php the_ID(); ?>">
                            <button class="accordion-button<?php echo esc_attr( $loop != 1 ? ' collapsed' : '' )?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFaq-<?php the_ID(); ?>" aria-expanded="true" aria-controls="collapseOne">
                                <?php the_title() ?>
                            </button>
                        </h2>

                        <div id="collapseFaq-<?php the_ID(); ?>" class="accordion-collapse collapse<?php echo esc_attr( $loop == 1 ? ' show' : '' )?>" aria-labelledby="headingFaq-<?php the_ID(); ?>" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <?php the_content(); ?>
                            </div>
                        </div>
                    </div>

                <?php $loop++; endwhile; wp_reset_postdata(); ?>
            </div>

            <div class="box-link-all text-center">
                <a href="<?php echo esc_url( $settings['link']['url'] ); ?>"<?php echo esc_attr( $target . $nofollow ) ?>>
					<?php esc_html_e('Xem thêm câu hỏi', 'sungarden'); ?>
                </a>
            </div>
		</div>
	<?php

		endif;
	}

	protected function _content_template() {
	}

}

Plugin::instance()->widgets_manager->register_widget_type( new sungarden_widget_faq );