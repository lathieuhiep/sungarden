<?php

add_filter( 'rwmb_meta_boxes', 'sungarden_register_meta_box_product' );

function sungarden_register_meta_box_product( $sungarden_meta_boxes ) {

	$sungarden_meta_boxes[] = array(
		'id'         => 'meta_box_product_option',
		'title'      => esc_html__( 'Thông tin sản phẩm', 'sungarden' ),
		'post_types' => array( 'sungarden_product' ),
		'context'    => 'normal',
		'priority'   => 'high',
		'fields'     => array(
			array(
				'id'   => 'metabox_product_country',
				'name' => 'Xuất xứ',
				'type' => 'text',
				'size' => 30,
			),

			array(
				'id'               => 'metabox_product_gallery',
				'name'             => 'Gallery',
				'type'             => 'image_advanced',
				'force_delete'     => false,
				'max_status'       => false,
				'image_size'       => 'thumbnail',
			),
		)
	);

	return $sungarden_meta_boxes;
}