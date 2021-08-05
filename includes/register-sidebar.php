<?php
/**
 * Register Sidebar
 */
add_action( 'widgets_init', 'sungarden_widgets_init');

function sungarden_widgets_init() {

	$sungarden_widgets_arr  =   array(

		'sungarden-sidebar-main'    =>  array(
			'name'              =>  esc_html__( 'Sidebar Main', 'sungarden' ),
			'description'       =>  esc_html__( 'Display sidebar right or left on all page.', 'sungarden' )
		),

		'sungarden-sidebar-footer-multi-column-1'   =>  array(
			'name'              =>  esc_html__( 'Sidebar Footer Multi Column 1', 'sungarden' ),
			'description'       =>  esc_html__('Display footer column 1 on all page.', 'sungarden' )
		),

		'sungarden-sidebar-footer-multi-column-2'   =>  array(
			'name'              =>  esc_html__( 'Sidebar Footer Multi Column 2', 'sungarden' ),
			'description'       =>  esc_html__('Display footer column 2 on all page.', 'sungarden' )
		),

		'sungarden-sidebar-footer-multi-column-3'   =>  array(
			'name'              =>  esc_html__( 'Sidebar Footer Multi Column 3', 'sungarden' ),
			'description'       =>  esc_html__('Display footer column 3 on all page.', 'sungarden' )
		),

		'sungarden-sidebar-footer-multi-column-4'   =>  array(
			'name'              =>  esc_html__( 'Sidebar Footer Multi Column 4', 'sungarden' ),
			'description'       =>  esc_html__('Display footer column 4 on all page.', 'sungarden' )
		)

	);

	foreach ( $sungarden_widgets_arr as $sungarden_widgets_id => $sungarden_widgets_value ) :

		register_sidebar( array(
			'name'          =>  esc_attr( $sungarden_widgets_value['name'] ),
			'id'            =>  esc_attr( $sungarden_widgets_id ),
			'description'   =>  esc_attr( $sungarden_widgets_value['description'] ),
			'before_widget' =>  '<section id="%1$s" class="widget %2$s">',
			'after_widget'  =>  '</section>',
			'before_title'  =>  '<h2 class="widget-title">',
			'after_title'   =>  '</h2>'
		));

	endforeach;

}