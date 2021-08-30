<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class sungarden_widget_project_box extends Widget_Base {

	public function get_categories() {
		return array( 'sungarden_widgets' );
	}

	public function get_name() {
		return 'sungarden-project-box';
	}

	public function get_title() {
		return esc_html__( 'Project Box', 'sungarden' );
	}

	public function get_icon() {
		return 'eicon-posts-grid';
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
			'select_cat',
			[
				'label'       => esc_html__( 'Select Category', 'sungarden' ),
				'type'        => Controls_Manager::SELECT,
				'options'     => sungarden_check_get_cat( 'sungarden_project_cat' ),
				'multiple'    => true,
				'label_block' => true
			]
		);

		$this->add_control(
			'limit',
			[
				'label'   => esc_html__( 'Number of Posts', 'sungarden' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 3,
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
					'is_external' => false,
					'nofollow' => false,
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {

		$settings      = $this->get_settings_for_display();
		$cat_post      = $settings['select_cat'];
		$limit_post    = $settings['limit'];
		$order_by_post = $settings['order_by'];
		$order_post    = $settings['order'];
		$target = $settings['link']['is_external'] ? ' target=_blank' : '';
		$nofollow = $settings['link']['nofollow'] ? ' rel=nofollow' : '';

		if ( ! empty( $cat_post ) ) :
			$tax_query = array(
				array(
					'taxonomy' => 'sungarden_project_cat',
					'field'    => 'term_id',
					'terms'    => $cat_post
				),
			);
		else:
			$tax_query = '';
		endif;

		$args = array(
			'post_type'           => 'sungarden_project',
			'posts_per_page'      => $limit_post,
			'orderby'             => $order_by_post,
			'order'               => $order_post,
			'ignore_sticky_posts' => 1,
			'tax_query'           => $tax_query
		);

		$query = new \WP_Query( $args );

		if ( $query->have_posts() ) :

			?>

            <div class="element-project-box">
                <div class="d-flex flex-wrap row-cols-1 row-cols-sm-2 row-cols-lg-1">
                    <?php
                    while ( $query->have_posts() ):
                        $query->the_post();

                        $place = rwmb_meta( 'metabox_project_place' );
                    ?>

                        <div class="item-post d-flex flex-wrap row-cols-1 row-cols-lg-2">
                            <div class="item-post__left">
                                <h5 class="title">
                                    <?php the_title(); ?>
                                </h5>

                                <p class="place">
                                    <?php echo esc_html( $place ); ?>
                                </p>

                                <div class="desc">
                                    <p>
                                        <?php
                                        if ( has_excerpt() ) :
                                            echo esc_html( get_the_excerpt() );
                                        else:
                                            echo wp_trim_words( get_the_content(), 35, '...' );
                                        endif;
                                        ?>
                                    </p>
                                </div>

                                <a class="link-item" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                    <?php esc_html_e('Xem chi tiết', 'sungarden'); ?>
                                </a>
                            </div>

                            <div class="item-post__right">
                                <?php
                                if ( has_post_thumbnail() ) :
                                    the_post_thumbnail( 'large' );
                                else:
                                    ?>
                                    <img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/no-image.png' ) ) ?>" alt="<?php the_title(); ?>"/>
                                <?php endif; ?>
                            </div>
                        </div>

                    <?php
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </div>

                <div class="box-link-all text-center">
                    <a href="<?php echo esc_url( $settings['link']['url'] ); ?>"<?php echo esc_attr( $target . $nofollow ) ?>>
		                <?php esc_html_e('Xem toàn bộ dự án', 'sungarden'); ?>
                    </a>
                </div>
            </div>

		<?php

		endif;
	}

	protected function _content_template() {
	}

}

Plugin::instance()->widgets_manager->register_widget_type( new sungarden_widget_project_box );