<?php
get_header();
?>

<div class="site-container site-single-service">
	<?php
	if ( have_posts() ) :
        while ( have_posts() ) : the_post();
            the_content();
            sungarden_link_page();
        endwhile;

		get_template_part('template-parts/service/related','service');
	endif;
	?>
</div>

<?php get_footer(); ?>
