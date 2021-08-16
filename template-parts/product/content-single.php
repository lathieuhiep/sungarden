<?php
global $sungarden_options;
$phone = $sungarden_options['sungarden_information_phone'] ? : '';

$contry = rwmb_meta( 'metabox_product_country' );
$imageGallery = rwmb_meta( 'metabox_product_gallery' );
$brand = get_the_terms( get_the_ID(), 'sungarden_product_brand' );
$terms_string = join(', ', wp_list_pluck($brand, 'name'));
?>

<div id="product-<?php the_ID() ?>" <?php post_class( 'site-product-single-item' ); ?>>
    <div class="top-box">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="product-thubnail-slick">
	                    <?php
	                    if ( has_post_thumbnail() ) :
		                    the_post_thumbnail( 'large' );
	                    else:
		                    ?>
                            <img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/no-image.png' ) ) ?>" alt="<?php the_title(); ?>"/>
	                    <?php
                        endif;

                        if ( $imageGallery ) :
                            foreach ( $imageGallery as $item ) :
                                echo wp_get_attachment_image( $item['ID'], 'large' );
                            endforeach;
                        endif;
                        ?>

                    </div>

                    <div class="product-thubnail-nav">
		                <?php
		                if ( has_post_thumbnail() ) :
			                the_post_thumbnail( 'large' );
		                else:
			                ?>
                            <img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/no-image.png' ) ) ?>" alt="<?php the_title(); ?>"/>
		                <?php
		                endif;

		                if ( $imageGallery ) :
			                foreach ( $imageGallery as $item ) :
				                echo wp_get_attachment_image( $item['ID'], 'large' );
			                endforeach;
		                endif;
		                ?>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="box-right">
                        <h1 class="title">
                            <?php the_title(); ?>
                        </h1>

                        <div class="product-info d-flex">
                            <div class="product-info__item">
                                <span>
                                    <?php esc_html_e('Xuất xứ', 'sungarden'); ?>:&nbsp;&nbsp;<b><?php echo esc_html( $contry ); ?></b>
                                </span>
                            </div>

                            <div class="product-info__item">
                                <span>
                                    <?php esc_html_e('Thương hiệu', 'sungarden'); ?>:&nbsp;&nbsp;<b><?php echo esc_html( $terms_string ); ?></b>
                                </span>
                            </div>
                        </div>

                        <div class="product-bottom d-flex align-items-center">
                            <span class="price">
                                <?php esc_html_e('Giá', 'sungarden'); ?>:&nbsp;&nbsp<b><?php esc_html_e( 'Liên hệ' ); ?></b>
                            </span>

                            <span class="phone">
                                <?php echo esc_html( $phone ); ?>
                            </span>
                        </div>

                        <div class="desc">
                            <h5 class="desc__title">
                                <?php esc_html_e('Thông tin sản phẩm', 'sungarden'); ?>:
                            </h5>

                            <div class="desc_content">
	                            <?php
	                            the_content();

	                            sungarden_link_page();
	                            ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>