<?php
/*
*---------------------------------------------------------------------
* This file create and contains the template post_type meta elements
*---------------------------------------------------------------------
*/

add_action('init', 'sungarden_create_faq', 10);

function sungarden_create_faq() {

    /* Start post type template */
    $labels = array(   
        'name'                  =>  _x( 'Faq', 'post type general name', 'sungarden' ),
        'singular_name'         =>  _x( 'Faq', 'post type singular name', 'sungarden' ),
        'menu_name'             =>  _x( 'Faq', 'admin menu', 'sungarden' ),
        'name_admin_bar'        =>  _x( 'Danh sách faq', 'add new on admin bar', 'sungarden' ),
        'add_new'               =>  _x( 'Thêm mới', 'faq', 'sungarden' ),
        'add_new_item'          =>  esc_html__( 'Thêm faq', 'sungarden' ),
        'edit_item'             =>  esc_html__( 'Sửa faq', 'sungarden' ),
        'new_item'              =>  esc_html__( 'Faq mới', 'sungarden' ),
        'view_item'             =>  esc_html__( 'Xem faq', 'sungarden' ),
        'all_items'             =>  esc_html__( 'Tất cả faq', 'sungarden' ),
        'search_items'          =>  esc_html__( 'Tìm kiếm Faq', 'sungarden' ),
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
        'menu_icon'          => 'dashicons-admin-customizer',
        'capability_type'    => 'post',
        'rewrite'            => array('slug' => 'faq' ),
        'has_archive'        => true,
        'hierarchical'       => true,
        'menu_position'      => 5,
        'supports'           => array('title', 'editor'),
    );

    register_post_type('sungarden_faq', $args );
    /* End post type template */

}