<?php
/*
*---------------------------------------------------------------------
* This file create and contains the template post_type meta elements
*---------------------------------------------------------------------
*/

add_action('init', 'sungarden_create_project', 10);

function sungarden_create_project() {

    /* Start post type template */
    $labels = array(   
        'name'                  =>  _x( 'Dự án', 'post type general name', 'sungarden' ),
        'singular_name'         =>  _x( 'Dự án', 'post type singular name', 'sungarden' ),
        'menu_name'             =>  _x( 'Dự án', 'admin menu', 'sungarden' ),
        'name_admin_bar'        =>  _x( 'Danh sách Dự án', 'add new on admin bar', 'sungarden' ),
        'add_new'               =>  _x( 'Thêm mới', 'Dự án', 'sungarden' ),
        'add_new_item'          =>  esc_html__( 'Thêm Dự án', 'sungarden' ),
        'edit_item'             =>  esc_html__( 'Sửa Dự án', 'sungarden' ),
        'new_item'              =>  esc_html__( 'Dự án mới', 'sungarden' ),
        'view_item'             =>  esc_html__( 'Xem dự án', 'sungarden' ),
        'all_items'             =>  esc_html__( 'Tất cả dự án', 'sungarden' ),
        'search_items'          =>  esc_html__( 'Tìm kiếm dự án', 'sungarden' ),
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
        'menu_icon'          => 'dashicons-open-folder',
        'capability_type'    => 'post',
        'rewrite'            => array('slug' => 'du-an' ),
        'has_archive'        => true,
        'hierarchical'       => true,
        'menu_position'      => 5,
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
    );

    register_post_type('sungarden_project', $args );
    /* End post type template */

    /* Start taxonomy */
    $taxonomy_labels = array(
        'name'              => _x( 'Danh mục dự án', 'taxonomy general name', 'sungarden' ),
        'singular_name'     => _x( 'Danh mục dự án', 'taxonomy singular name', 'sungarden' ),
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
        'rewrite'           => array( 'slug' => 'danh-muc-du-an' ),
    );

    register_taxonomy( 'sungarden_project_cat', array( 'sungarden_project' ), $taxonomy_args );
    /* End taxonomy */

	// Filter posts by taxonomy in admin
	add_action('restrict_manage_posts', 'sungarden_filter_project_by_taxonomy');
	function sungarden_filter_project_by_taxonomy() {
		global $typenow;
		$post_type = 'sungarden_project'; // change to your post type
		$taxonomy  = 'sungarden_project_cat'; // change to your taxonomy
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

	add_filter('parse_query', 'sungarden_convert_id_to_term_project_in_query');
	function sungarden_convert_id_to_term_project_in_query($query) {
		global $pagenow;
		$post_type = 'sungarden_project'; // change to your post type
		$taxonomy  = 'sungarden_project_cat'; // change to your taxonomy
		$q_vars    = &$query->query_vars;
		if ( $pagenow == 'edit.php' && isset($q_vars['post_type']) && $q_vars['post_type'] == $post_type && isset($q_vars[$taxonomy]) && is_numeric($q_vars[$taxonomy]) && $q_vars[$taxonomy] != 0 ) {
			$term = get_term_by('id', $q_vars[$taxonomy], $taxonomy);
			$q_vars[$taxonomy] = $term->slug;
		}
	}

}