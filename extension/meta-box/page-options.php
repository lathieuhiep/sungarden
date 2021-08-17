<?php

add_filter( 'rwmb_meta_boxes', 'sungarden_register_meta_boxes_page' );

function sungarden_register_meta_boxes_page( $sungarden_meta_boxes ) {

	$sungarden_meta_boxes[] = array(
		'id'         => 'meta_box_page_option',
		'title'      => esc_html__( 'Page Options', 'sungarden' ),
		'post_types' => array( 'page' ),
		'context'    => 'normal',
		'priority'   => 'high',
		'fields'     => array(

			array(
				'id'      => 'metabox_page_nav',
				'name'    => 'Menu Postion Absolute',
				'type'    => 'select',
				'options' => array(
					0 => 'No',
					1 => 'Yes',
				)
			),

			array(
				'id'               => 'metabox_page_logo',
				'name'             => 'Logo',
				'type'             => 'image_advanced',
				'force_delete'     => false,
				'max_status'       => false,
				'image_size'       => 'thumbnail',
				'max_file_uploads' => 1,
			),

		)
	);

	return $sungarden_meta_boxes;
}