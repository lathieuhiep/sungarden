<?php
/*
*---------------------------------------------------------------------
* This file create and contains the template post_type meta elements
*---------------------------------------------------------------------
*/

add_action('init', 'sungarden_create_service', 10);

function sungarden_create_service() {

    /* Start post type template */
    $labels = array(   
        'name'                  =>  _x( 'Dịch vụ', 'post type general name', 'sungarden' ),
        'singular_name'         =>  _x( 'Dịch vụ', 'post type singular name', 'sungarden' ),
        'menu_name'             =>  _x( 'Dịch vụ', 'admin menu', 'sungarden' ),
        'name_admin_bar'        =>  _x( 'Danh sách Dịch vụ', 'add new on admin bar', 'sungarden' ),
        'add_new'               =>  _x( 'Thêm mới', 'Dịch vụ', 'sungarden' ),
        'add_new_item'          =>  esc_html__( 'Thêm Dịch vụ', 'sungarden' ),
        'edit_item'             =>  esc_html__( 'Sửa Dịch vụ', 'sungarden' ),
        'new_item'              =>  esc_html__( 'Dịch vụ mới', 'sungarden' ),
        'view_item'             =>  esc_html__( 'Xem Dịch vụ', 'sungarden' ),
        'all_items'             =>  esc_html__( 'Tất cả dịch vụ', 'sungarden' ),
        'search_items'          =>  esc_html__( 'Tìm kiếm Dịch vụ', 'sungarden' ),
        'not_found'             =>  esc_html__( 'Không tìm thấy', 'sungarden' ),
        'not_found_in_trash'    =>  esc_html__( 'Không tìm thấy trong thùng rác', 'sungarden' ),
        'parent_item_colon'     =>  ''
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'menu_icon'          => 'dashicons-cloud',
        'capability_type'    => 'post',
        'rewrite'            => array('slug' => 'dich-vu' ),
        'has_archive'        => true,
        'hierarchical'       => true,
        'menu_position'      => 5,
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
    );

    register_post_type('sungarden_service', $args );
    /* End post type template */

    /* Start taxonomy */
    $taxonomy_labels = array(
        'name'              => _x( 'Danh mục Dịch vụ', 'taxonomy general name', 'sungarden' ),
        'singular_name'     => _x( 'Danh mục Dịch vụ', 'taxonomy singular name', 'sungarden' ),
        'search_items'      => __( 'Tìm kiếm danh mục', 'sungarden' ),
        'all_items'         => __( 'Tất cả danh mục', 'sungarden' ),
        'parent_item'       => __( 'Danh mục cha', 'sungarden' ),
        'parent_item_colon' => __( 'Danh mục cha:', 'sungarden' ),
        'edit_item'         => __( 'Sửa', 'sungarden' ),
        'update_item'       => __( 'Cập nhật', 'sungarden' ),
        'add_new_item'      => __( 'Thêm mới', 'sungarden' ),
        'new_item_name'     => __( 'Tên mới', 'sungarden' ),
        'menu_name'         => __( 'Danh mục', 'sungarden' ),
    );

    $taxonomy_args = array(

        'labels'            => $taxonomy_labels,
        'hierarchical'      => true,
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'danh-muc-dich-vu' ),
    );

    register_taxonomy( 'sungarden_service_cat', array( 'sungarden_service' ), $taxonomy_args );
    /* End taxonomy */

	// Filter posts by taxonomy in admin
	add_action('restrict_manage_posts', 'sungarden_filter_service_by_taxonomy');
	function sungarden_filter_service_by_taxonomy() {
		global $typenow;
		$post_type = 'sungarden_service'; // change to your post type
		$taxonomy  = 'sungarden_service_cat'; // change to your taxonomy
		if ($typenow == $post_type) {
			$selected      = $_GET[ $taxonomy ] ?? '';
			$info_taxonomy = get_taxonomy($taxonomy);
			wp_dropdown_categories(array(
				'show_option_all' => __("{$info_taxonomy->label}"),
				'taxonomy'        => $taxonomy,
				'name'            => $taxonomy,
				'orderby'         => 'name',
				'selected'        => $selected,
				'show_count'      => true,
				'hide_empty'      => true,
			));
		};
	}

	add_filter('parse_query', 'sungarden_convert_id_to_term_service_in_query');
	function sungarden_convert_id_to_term_service_in_query($query) {
		global $pagenow;
		$post_type = 'sungarden_service'; // change to your post type
		$taxonomy  = 'sungarden_service_cat'; // change to your taxonomy
		$q_vars    = &$query->query_vars;
		if ( $pagenow == 'edit.php' && isset($q_vars['post_type']) && $q_vars['post_type'] == $post_type && isset($q_vars[$taxonomy]) && is_numeric($q_vars[$taxonomy]) && $q_vars[$taxonomy] != 0 ) {
			$term = get_term_by('id', $q_vars[$taxonomy], $taxonomy);
			$q_vars[$taxonomy] = $term->slug;
		}
	}

}