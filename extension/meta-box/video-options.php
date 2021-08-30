<?php

add_filter( 'rwmb_meta_boxes', 'sungarden_register_meta_box_video' );

function sungarden_register_meta_box_video( $sungarden_meta_boxes ) {

	$sungarden_meta_boxes[] = array(
		'id'         => 'meta_box_video_info',
		'title'      => esc_html__( 'Thông tin video', 'sungarden' ),
		'post_types' => array( 'sungarden_video' ),
		'context'    => 'normal',
		'priority'   => 'high',
		'fields'     => array(

			array(
				'id'    => 'metabox_video_url',
				'name'  => 'oEmbed(s)',
				'type'  => 'oembed',
				'size'  => 30,
			),

			array(
				'name'            => 'Select',
				'id'              => 'meta_box_video_select_image',
				'type'            => 'select',
				'options'         => array(
					'1' => esc_html__( 'Youtube', 'sungarden' ),
					'2' => esc_html__( 'Featured image', 'sungarden' ),
				),
			),

			array(
				'name'            => 'Size image Youtube',
				'id'              => 'meta_box_video_size_image',
				'type'            => 'select',
				'options'         => array(
					'sddefault' => esc_html__( 'sddefault', 'sungarden' ),
					'hqdefault' => esc_html__( 'hqdefault', 'sungarden' ),
					'mqdefault' => esc_html__( 'mqdefault', 'sungarden' ),
					'default' => esc_html__( 'default', 'sungarden' ),
				),
			),

			array(
				'id'   => 'metabox_video_place',
				'name' => 'Địa điểm',
				'type' => 'text',
				'size' => 30,
			),

		)
	);

	return $sungarden_meta_boxes;
}