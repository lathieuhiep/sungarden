<?php
get_header();

$sungarden_check_elementor =   get_post_meta( get_the_ID(), '_elementor_edit_mode', true );

$sungarden_class_elementor =   '';

if ( $sungarden_check_elementor ) :
    $sungarden_class_elementor =   ' site-container-elementor';
endif;

?>

    <main class="site-container<?php echo esc_attr( $sungarden_class_elementor ); ?>">

        <?php
        if ( $sungarden_check_elementor ) :
            get_template_part('template-parts/page/content','page-elementor');
        else:
            get_template_part('template-parts/page/content','page');
        endif;
        ?>

    </main>

<?php 

get_footer();