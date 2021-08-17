<?php
global $sungarden_options;

$sungarden_nav_top_sticky   =   $sungarden_options['sungarden_nav_top_sticky'] ? : 1;

$menuFixed = rwmb_meta( 'metabox_page_nav' );

if ( $menuFixed == 1 ) {
    $classPostion = ' active-absolute-nav';
} elseif ( $sungarden_nav_top_sticky == 1 ) {
	$classPostion = ' active-sticky-nav';
} else {
	$classPostion = '';
}
?>

<header id="home" class="site-header<?php echo esc_attr( $classPostion ); ?>">
    <?php get_template_part( 'template-parts/header/inc', 'nav' ); ?>
</header>