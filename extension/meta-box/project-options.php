<?php

add_filter( 'rwmb_meta_boxes', 'sungarden_register_meta_box_project' );

function sungarden_register_meta_box_project( $sungarden_meta_boxes ) {

	$sungarden_meta_boxes[] = array(
		'id'         => 'meta_box_project_info',
		'title'      => esc_html__( 'Thông tin dự án', 'sungarden' ),
		'post_types' => array( 'sungarden_project' ),
		'context'    => 'normal',
		'priority'   => 'high',
		'fields'     => array(

			array(
				'id'   => 'metabox_project_categories',
				'name' => 'Hạng mục',
				'type' => 'text',
				'size' => 30,
			),

			array(
				'id'   => 'metabox_project_customer',
				'name' => 'Khách hàng',
				'type' => 'text',
				'size' => 30,
			),

			array(
				'id'   => 'metabox_project_place',
				'name' => 'Địa điểm',
				'type' => 'text',
				'size' => 30,
			),

			array(
				'id'   => 'metabox_project_area',
				'name' => 'Diện tích (m2)',
				'type' => 'number',
				'min'  => 1,
				'size' => 30,
			),

			array(
				'id'   => 'metabox_project_style',
				'name' => 'Phong cách',
				'type' => 'text',
				'size' => 30,
			),

			array(
				'id'         => 'metabox_project_date',
				'name'       => 'Năm thực hiện',
				'type'       => 'date',
				'inline'     => false,
				'timestamp'  => false,
				'js_options' => array(
					'dateFormat'      => 'dd/mm/yy',
					'showButtonPanel' => false,
				),
			),

			array(
				'id'               => 'metabox_project_image',
				'name'             => 'Hình ảnh dự án',
				'type'             => 'image_advanced',
				'force_delete'     => false,
				'max_status'       => false,
				'image_size'       => 'thumbnail',
			),


		)
	);

	return $sungarden_meta_boxes;
}