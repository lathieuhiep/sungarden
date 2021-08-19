<div id="project-<?php the_ID() ?>" <?php post_class( 'site-project-single-item' ); ?>>
    <?php
    get_template_part('template-parts/project/content','info');

    get_template_part('template-parts/project/content','gallery');
    ?>
</div>