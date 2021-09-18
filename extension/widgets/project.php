<?php
/**
 * Widget Name: project
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class sungarden_project_widget extends WP_Widget {

	/**
	 * Widget setup.
	 */

	public function __construct() {

		$widget_ops = array(
			'classname'   => 'sungarden_project_widget',
			'description' => esc_html__( 'A widget show post', 'sungarden' ),
		);

		parent::__construct( 'sungarden_project_widget', 'Sungarden Theme: Dự Án', $widget_ops );

	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	function widget( $args, $instance ) {

		echo $args['before_widget'];

		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}

		$limit   = $instance['number'] ?? 4;
		$cat_ids = ! empty( $instance['select_cat'] ) ? $instance['select_cat'] : array( '0' );

		if ( in_array( 0, $cat_ids ) ) :
			$tax_query = '';
		else:
			$tax_query = array(
				array(
					'taxonomy' => 'sungarden_project_cat',
					'field'    => 'id',
					'terms'    => $cat_ids
				),
			);
		endif;

		$post_arg = array(
			'post_type'           => 'sungarden_project',
			'post__not_in'        => array( get_the_ID() ),
			'posts_per_page'      => $limit,
			'orderby'             => $instance['order_by'],
			'order'               => $instance['order'],
			'ignore_sticky_posts' => 1,
			'tax_query'           => $tax_query
		);

		$post_query = new WP_Query( $post_arg );

		if ( $post_query->have_posts() ) :

			?>

            <div class="post_widget_warp">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-1 custom-row">
                    <?php
                    while ( $post_query->have_posts() ) :
                        $post_query->the_post();

                        $place = rwmb_meta( 'metabox_project_place' );
                    ?>

                        <div class="col custom-col">
                            <div class="item">
                                <?php
                                if ( has_post_thumbnail() ):
                                    the_post_thumbnail( 'large' );
                                else:
                                ?>
                                    <img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/no-image.png' ) ); ?>" alt="post">
                                <?php endif; ?>

                                <div class="box-title">
                                    <div class="box-content">
                                        <a class="link-full" href="<?php the_permalink(); ?>" title="<?php the_title() ?>"></a>

                                        <h4 class="item-title">
                                            <?php the_title(); ?>
                                        </h4>

                                        <p class="item-place">
                                            <?php echo esc_html( $place ); ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </div>
            </div>

		<?php
		endif;

		echo $args['after_widget'];
	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	function form( $instance ) {

		$defaults = array(
			'title' => 'Dự án',
		);

		$instance = wp_parse_args( (array) $instance, $defaults );

		$number     = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		$select_cat = $instance['select_cat'] ?? array( '0' );
		$order      = $instance['order'] ?? 'ASC';
		$order_by   = $instance['order_by'] ?? 'ID';

		$terms = get_terms( array(
			'taxonomy' => 'sungarden_project_cat',
			'orderby'  => 'id'
		) );

		?>

        <!-- Widget Title: Text Input -->
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
				<?php esc_html_e( 'Title:', 'sungarden' ); ?>
            </label>

            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
                   name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>"/>
        </p>

        <!-- Start Select Event Cat -->
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'select_cat' ) ); ?>">
				<?php esc_attr_e( 'Select Categories:', 'sungarden' ); ?>
            </label>

            <select id="<?php echo esc_attr( $this->get_field_id( 'select_cat' ) ); ?>"
                    name="<?php echo esc_attr( $this->get_field_name( 'select_cat' ) ) . '[]'; ?>" class="widefat"
                    size="10" multiple>

                <option value="0" <?php echo( in_array( 0, $select_cat ) ? 'selected="selected"' : '' ); ?>>
					<?php esc_html_e( 'All Category', 'sungarden' ); ?>
                </option>

				<?php
				if ( ! empty( $terms ) ) :

					foreach ( $terms as $term_item ) :
						?>
                        <option value="<?php echo $term_item->term_id; ?>" <?php echo( in_array( $term_item->term_id, $select_cat ) ? 'selected="selected"' : '' ); ?>>
							<?php echo esc_html( $term_item->name ) . ' (' . esc_html( $term_item->count ) . ')'; ?>
                        </option>
					<?php
					endforeach;

				endif;
				?>

            </select>
        </p>

        <!-- Start Order -->
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>">
				<?php esc_html_e( 'Order:', 'sungarden' ); ?>
            </label>

            <select id="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>"
                    name="<?php echo $this->get_field_name( 'order' ) ?>" class="widefat">
                <option value="ASC" <?php echo ( $order == 'ASC' ) ? 'selected' : ''; ?>>
					<?php esc_html_e( 'ASC', 'sungarden' ); ?>
                </option>

                <option value="DESC" <?php echo ( $order == 'DESC' ) ? 'selected' : ''; ?>>
					<?php esc_html_e( 'DESC', 'sungarden' ); ?>
                </option>
            </select>
        </p>

        <!-- Start OrderBy -->
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'order_by' ) ); ?>">
				<?php esc_html_e( 'Order:', 'sungarden' ); ?>
            </label>

            <select id="<?php echo esc_attr( $this->get_field_id( 'order_by' ) ); ?>"
                    name="<?php echo $this->get_field_name( 'order_by' ) ?>" class="widefat">
                <option value="ID" <?php echo ( $order_by == 'ID' ) ? 'selected' : ''; ?>>
					<?php esc_html_e( 'ID', 'sungarden' ); ?>
                </option>

                <option value="date" <?php echo ( $order_by == 'date' ) ? 'selected' : ''; ?>>
					<?php esc_html_e( 'Date', 'sungarden' ); ?>
                </option>

                <option value="title" <?php echo ( $order_by == 'title' ) ? 'selected' : ''; ?>>
					<?php esc_html_e( 'Title', 'sungarden' ); ?>
                </option>

                <option value="rand" <?php echo ( $order_by == 'rand' ) ? 'selected' : ''; ?>>
					<?php esc_html_e( 'Rand', 'sungarden' ); ?>
                </option>
            </select>
        </p>

        <!-- Start Number Post Show -->
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>">
				<?php esc_html_e( 'Number of posts to show:', 'sungarden' ); ?>
            </label>

            <input id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" class="tiny-text"
                   name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="number" step="1" min="1"
                   value="<?php echo esc_attr( $number ); ?>" size="3"/>
        </p>

		<?php

	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 *
	 * @return array
	 */
	function update( $new_instance, $old_instance ) {
		$instance = array();

		$instance['title']      = strip_tags( $new_instance['title'] );
		$instance['select_cat'] = $new_instance['select_cat'];
		$instance['order']      = $new_instance['order'];
		$instance['order_by']   = $new_instance['order_by'];
		$instance['number']     = (int) $new_instance['number'];

		return $instance;
	}

}

// Register widget
function sungarden_project_widget_register() {
	register_widget( 'sungarden_project_widget' );
}

add_action( 'widgets_init', 'sungarden_project_widget_register' );