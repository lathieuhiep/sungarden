<?php
get_header();

get_template_part('template-parts/breadcrumbs/inc','breadcrumbs');
?>

<div class="site-container site-single-project">
	<?php
	if ( have_posts() ) : while (have_posts()) : the_post();

		the_content();

		sungarden_link_page();

	endwhile;

		get_template_part('template-parts/project/related','project');
	endif;
	?>
</div>

<?php get_footer(); ?>
