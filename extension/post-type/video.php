<?php
/*
*---------------------------------------------------------------------
* This file create and contains the template post_type meta elements
*---------------------------------------------------------------------
*/

add_action('init', 'sungarden_create_video', 10);

function sungarden_create_video() {

    /* Start post type template */
    $labels = array(   
        'name'                  =>  _x( 'Video', 'post type general name', 'sungarden' ),
        'singular_name'         =>  _x( 'Video', 'post type singular name', 'sungarden' ),
        'menu_name'             =>  _x( 'Video', 'admin menu', 'sungarden' ),
        'name_admin_bar'        =>  _x( 'Danh sách video', 'add new on admin bar', 'sungarden' ),
        'add_new'               =>  _x( 'Thêm mới', 'video', 'sungarden' ),
        'add_new_item'          =>  esc_html__( 'Thêm video', 'sungarden' ),
        'edit_item'             =>  esc_html__( 'Sửa video', 'sungarden' ),
        'new_item'              =>  esc_html__( 'Video mới', 'sungarden' ),
        'view_item'             =>  esc_html__( 'Xem video', 'sungarden' ),
        'all_items'             =>  esc_html__( 'Tất cả video', 'sungarden' ),
        'search_items'          =>  esc_html__( 'Tìm kiếm Video', 'sungarden' ),
        'not_found'             =>  esc_html__( 'Không tìm thấy', 'sungarden' ),
        'not_found_in_trash'    =>  esc_html__( 'Không tìm thấy trong thùng rác', 'sungarden' ),
        'parent_item_colon'     =>  ''
    );

    $args = array(
        'labels'             => $labels,
        'public'             => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'menu_icon'          => 'dashicons-media-video',
        'capability_type'    => 'post',
        'rewrite'            => array('slug' => 'videos' ),
        'has_archive'        => true,
        'hierarchical'       => true,
        'menu_position'      => 5,
        'supports'           => array('title', 'thumbnail'),
    );

    register_post_type('sungarden_video', $args );
    /* End post type template */

    /* Start taxonomy */
    $taxonomy_labels = array(
        'name'              => _x( 'Danh mục video', 'taxonomy general name', 'sungarden' ),
        'singular_name'     => _x( 'Danh mục video', 'taxonomy singular name', 'sungarden' ),
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
        'rewrite'           => array( 'slug' => 'danh-muc-video' ),
    );

    register_taxonomy( 'sungarden_video_cat', array( 'sungarden_video' ), $taxonomy_args );
    /* End taxonomy */

}