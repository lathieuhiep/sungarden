<?php
get_header();

get_template_part('template-parts/breadcrumbs/inc','breadcrumbs');
?>

<div class="site-container site-single-project">
	<?php
	if ( have_posts() ) : while (have_posts()) : the_post();

		get_template_part( 'template-parts/project/content','single' );

	endwhile;
	endif;
	?>
</div>

<?php get_footer(); ?>
