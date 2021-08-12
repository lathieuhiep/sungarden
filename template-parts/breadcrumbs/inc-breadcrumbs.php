<?php if(function_exists('bcn_display')) : ?>

	<div class="breadcrumbs breadcrumbs-type" typeof="BreadcrumbList" vocab="http://schema.org/">
		<div class="container">
            <h3 class="heading">
                <?php the_title(); ?>
            </h3>

            <div class="breadcrumbs-col">
	            <?php bcn_display(); ?>
            </div>
		</div>
	</div>

<?php endif; ?>