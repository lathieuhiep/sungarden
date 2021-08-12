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
				'id'   => 'metabox_video_place',
				'name' => 'Địa điểm',
				'type' => 'text',
				'size' => 30,
			),

		)
	);

	return $sungarden_meta_boxes;
}