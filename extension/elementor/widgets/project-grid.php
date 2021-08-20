<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class sungarden_widget_project_grid extends Widget_Base {

	public function get_categories() {
		return array( 'sungarden_widgets' );
	}

	public function get_name() {
		return 'sungarden-project-grid';
	}

	public function get_title() {
		return esc_html__( 'Project Grid', 'sungarden' );
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
				'type'        => Controls_Manager::SELECT2,
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
				'default' => 6,
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
					4 => esc_html__( '4 Column', 'sungarden' ),
					3 => esc_html__( '3 Column', 'sungarden' ),
					2 => esc_html__( '2 Column', 'sungarden' ),
					1 => esc_html__( '1 Column', 'sungarden' ),
				],
			]
		);

		$this->end_controls_section();

		/* Section style post */
		$this->start_controls_section(
			'section_style_post',
			[
				'label' => esc_html__( 'Color & Typography', 'sungarden' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		// Style title post
		$this->add_control(
			'title_post_options',
			[
				'label'     => esc_html__( 'Title Post', 'sungarden' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'title_post_color',
			[
				'label'     => esc_html__( 'Color', 'sungarden' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .element-project-grid .item-post__title a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_post_color_hover',
			[
				'label'     => esc_html__( 'Color Hover', 'sungarden' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .element-project-grid .item-post__title a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_post_typography',
				'selector' => '{{WRAPPER}} .element-project-grid .item-post .item-post__title',
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
		$paged         = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

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
			'paged'               => $paged,
			'orderby'             => $order_by_post,
			'order'               => $order_post,
			'ignore_sticky_posts' => 1,
			'tax_query'           => $tax_query
		);

		$query = new \WP_Query( $args );

		if ( $query->have_posts() ) :

			?>

            <div class="element-project-grid element-project-style">
                <div class="row custom-row">
					<?php
                    while ( $query->have_posts() ):
                        $query->the_post();

	                    $place = rwmb_meta( 'metabox_project_place' );
                    ?>

                        <div class="col-12 col-sm-6 col-md-4 col-lg-<?php echo esc_attr( 12 / $settings['column_number'] ); ?> item-col custom-col">
                            <div class="item-post">
	                            <?php
	                            if ( has_post_thumbnail() ) :
		                            the_post_thumbnail( 'large' );
	                            else:
                                ?>
                                    <img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/no-image.png' ) ) ?>" alt="<?php the_title(); ?>"/>
	                            <?php endif; ?>

                                <div class="content">
                                    <h5 class="title">
                                        <?php the_title(); ?>
                                    </h5>

                                    <p class="place">
		                                <?php echo esc_html( $place ); ?>
                                    </p>
                                </div>

                                <a class="link-item" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"></a>
                            </div>
                        </div>

					<?php endwhile;
					wp_reset_postdata(); ?>
                </div>

				<?php sungarden_paging_nav_query( $query ); ?>
            </div>

		<?php

		endif;
	}

	protected function _content_template() {
	}

}

Plugin::instance()->widgets_manager->register_widget_type( new sungarden_widget_project_grid );