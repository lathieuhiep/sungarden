<?php
get_header();
?>

<div class="site-container site-single-product">
	<?php
	if ( have_posts() ) : while (have_posts()) : the_post();

		get_template_part( 'template-parts/product/content','single' );

	endwhile;
	endif;
	?>
</div>

<?php get_footer(); ?>
