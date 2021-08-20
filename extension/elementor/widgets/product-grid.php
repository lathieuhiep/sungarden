<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class sungarden_widget_product_grid extends Widget_Base {

	public function get_categories() {
		return array( 'sungarden_widgets' );
	}

	public function get_name() {
		return 'sungarden-product-grid';
	}

	public function get_title() {
		return esc_html__( 'Product Grid', 'sungarden' );
	}

	public function get_icon() {
		return 'eicon-posts-grid';
	}

	public function get_script_depends() {
		return ['sungarden-elementor-custom'];
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
				'options'     => sungarden_check_get_cat( 'sungarden_product_cat' ),
				'multiple'    => true,
				'label_block' => true
			]
		);

		$this->add_control(
			'limit',
			[
				'label'   => esc_html__( 'Number of Posts', 'sungarden' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 12,
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
	}

	protected function render() {

		$settings      = $this->get_settings_for_display();
		$cat_post      = $settings['select_cat'];
		$limit_post    = $settings['limit'];
		$order_by_post = $settings['order_by'];
		$order_post    = $settings['order'];
		$paged         = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
		$data_options  = [
			'limit' => $limit_post,
            'orderBy' => $order_by_post,
            'order' => $order_post
        ];

		if ( ! empty( $cat_post ) ) :
			$data_options['termId'] = $cat_post[0];
            $data_options_nav = $data_options;

            $get_terms = get_terms( array(
				'taxonomy'   => 'sungarden_product_cat',
				'include'    => $cat_post,
				'hide_empty' => false,
			) );

			$tax_query = array(
				array(
					'taxonomy' => 'sungarden_product_cat',
					'field'    => 'term_id',
					'terms'    => $cat_post[0]
				),
			);
		else:
			$data_options_nav = $data_options;
			$get_terms = $tax_query = '';
		endif;

		$args = array(
			'post_type'           => 'sungarden_product',
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

            <div class="element-product-grid">
                <div class="load-data d-flex align-items-center justify-content-center">
                    <div class="loader"></div>
                </div>

                <?php  if ( $get_terms ) : ?>

                <nav class="element-product-grid__nav text-center">
                    <ul>
	                    <?php
                        foreach ( $get_terms as $item_term ) :
	                        $data_options['termId'] = $item_term->term_id;
                        ?>
                        <li class="product-nav-cat__item<?php echo esc_attr( $cat_post[0] == $item_term->term_id ? ' active' : '' ); ?>" data-options='<?php echo wp_json_encode( $data_options ) ; ?>'>
                            <?php echo esc_html( $item_term->name ); ?>
                        </li>
	                    <?php endforeach; ?>
                    </ul>
                </nav>

                <?php endif; ?>

                <div class="container warp-product">
                    <?php sungarden_content_filter_product_cat( $query, $paged, $data_options_nav ); ?>
                </div>
            </div>

		<?php

		endif;
	}

	protected function _content_template() {
	}

}

Plugin::instance()->widgets_manager->register_widget_type( new sungarden_widget_product_grid );