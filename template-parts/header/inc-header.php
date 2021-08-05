<?php
global $sungarden_options;

$sungarden_nav_top_sticky   =   $sungarden_options['sungarden_nav_top_sticky'] ? : 1;
?>

<header id="home" class="site-header<?php echo esc_attr( $sungarden_nav_top_sticky == 1 ? ' active-sticky-nav' : '' ); ?>">
    <?php get_template_part( 'template-parts/header/inc', 'nav' ); ?>
</header>