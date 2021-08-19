<?php
$imageGallery = rwmb_meta( 'metabox_project_image' );

if ( $imageGallery ) :
?>

	<div class="project-detail-gallery">
		<h3 class="heading">
			<?php esc_html_e( 'Hình ảnh dự án', 'sungarden' ); ?>
		</h3>

		<div class="project-detail-gallery__grid">
            <div class="grid-sizer"></div>

			<?php foreach( $imageGallery as $item ) : ?>

				<div class="grid-item">
					<?php echo wp_get_attachment_image( $item['ID'], 'full' ); ?>
				</div>

			<?php endforeach; ?>
		</div>
	</div>

<?php
endif;