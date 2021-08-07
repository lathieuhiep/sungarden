<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 *constants
 */
if ( ! function_exists( 'sungarden_setup' ) ):

	function sungarden_setup() {

		/**
		 * Set the content width based on the theme's design and stylesheet.
		 */
		global $content_width;
		if ( ! isset( $content_width ) ) {
			$content_width = 900;
		}

		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 */
		load_theme_textdomain( 'sungarden', get_parent_theme_file_path( '/languages' ) );

		/**
		 * Set up theme defaults and registers support for various WordPress features.
		 *
		 * Note that this function is hooked into the after_setup_theme hook, which
		 * runs before the init hook. The init hook is too late for some features, such
		 * as indicating support post thumbnails.
		 *
		 */
		add_theme_support( 'custom-header' );

		add_theme_support( 'custom-background' );

		//Enable support for Post Thumbnails
		add_theme_support( 'post-thumbnails' );

		// Add RSS feed links to <head> for posts and comments.
		add_theme_support( 'automatic-feed-links' );

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menu( 'primary', 'Primary Menu' );

		// add theme support title-tag
		add_theme_support( 'title-tag' );

		/*  Post Type   */
		add_theme_support( 'post-formats', array( 'gallery', 'video', 'audio' ) );
	}

	add_action( 'after_setup_theme', 'sungarden_setup' );

endif;

/**
 * Required: Plugin Activation
 */
require get_parent_theme_file_path( '/includes/plugin-activation.php' );

/**
 * Required: include plugin theme scripts
 */
require get_parent_theme_file_path( '/extension/process-option.php' );

/**
 * Required: post type
 */
require get_parent_theme_file_path( '/extension/post-type/project.php' );
require get_parent_theme_file_path( '/extension/post-type/product.php' );

if ( class_exists( 'ReduxFramework' ) ) {
	/*
	 * Required: Redux Framework
	 */
	require get_parent_theme_file_path( '/extension/option-reudx/theme-options.php' );
}

if ( class_exists( 'RW_Meta_Box' ) ) {
	/*
	 * Required: Meta Box Framework
	 */
	require get_parent_theme_file_path( '/extension/meta-box/meta-box-options.php' );

}

if ( ! function_exists( 'rwmb_meta' ) ) {

	function rwmb_meta( $key, $args = '', $post_id = null ): bool {
		return false;
	}

}

if ( did_action( 'elementor/loaded' ) ) :
	/*
	 * Required: Elementor
	 */
	require get_parent_theme_file_path( '/extension/elementor/elementor.php' );

endif;

/* Require Widgets */
foreach ( glob( get_parent_theme_file_path( '/extension/widgets/*.php' ) ) as $sungarden_file_widgets ) {
	require $sungarden_file_widgets;
}

/**
 * Required: Register Sidebar
 */
require get_parent_theme_file_path( '/includes/register-sidebar.php' );

/**
 * Required: Theme Scripts
 */
require get_parent_theme_file_path( '/includes/theme-scripts.php' );

/* post formats */
function sungarden_post_formats() {

	if ( has_post_format( 'audio' ) || has_post_format( 'video' ) ):
		get_template_part( 'template-parts/post/content', 'video' );
    elseif ( has_post_format( 'gallery' ) ):
		get_template_part( 'template-parts/post/content', 'gallery' );
	else:
		get_template_part( 'template-parts/post/content', 'image' );
	endif;

}

/**
 * Show full editor
 */
if ( ! function_exists( 'sungarden_ilc_mce_buttons' ) ) :

	function sungarden_ilc_mce_buttons( $sungarden_buttons_TinyMCE ) {

		array_push( $sungarden_buttons_TinyMCE,
			"backcolor",
			"anchor",
			"hr",
			"sub",
			"sup",
			"fontselect",
			"fontsizeselect",
			"styleselect",
			"cleanup"
		);

		return $sungarden_buttons_TinyMCE;

	}

	add_filter( "mce_buttons_2", "sungarden_ilc_mce_buttons" );

endif;

// Start Customize mce editor font sizes
if ( ! function_exists( 'sungarden_mce_text_sizes' ) ) :

	function sungarden_mce_text_sizes( $sungarden_font_size_text ) {
		$sungarden_font_size_text['fontsize_formats'] = "9px 10px 12px 13px 14px 16px 17px 18px 19px 20px 21px 24px 28px 32px 36px";

		return $sungarden_font_size_text;
	}

	add_filter( 'tiny_mce_before_init', 'sungarden_mce_text_sizes' );

endif;
// End Customize mce editor font sizes

/* callback comment list */
function sungarden_comments( $sungarden_comment, $sungarden_comment_args, $sungarden_comment_depth ) {

	if ( 'div' === $sungarden_comment_args['style'] ) :

		$sungarden_comment_tag       = 'div';
		$sungarden_comment_add_below = 'comment';

	else :

		$sungarden_comment_tag       = 'li';
		$sungarden_comment_add_below = 'div-comment';

	endif;

	?>
    <<?php echo $sungarden_comment_tag ?><?php comment_class( empty( $sungarden_comment_args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">

	<?php if ( 'div' != $sungarden_comment_args['style'] ) : ?>

        <div id="div-comment-<?php comment_ID() ?>" class="comment-body">

	<?php endif; ?>

    <div class="comment-author vcard">
		<?php if ( $sungarden_comment_args['avatar_size'] != 0 ) {
			echo get_avatar( $sungarden_comment, $sungarden_comment_args['avatar_size'] );
		} ?>

    </div>

	<?php if ( $sungarden_comment->comment_approved == '0' ) : ?>
        <em class="comment-awaiting-moderation">
			<?php esc_html_e( 'Your comment is awaiting moderation.', 'sungarden' ); ?>
        </em>
	<?php endif; ?>

    <div class="comment-meta commentmetadata">
        <div class="comment-meta-box">
             <span class="name">
                <?php comment_author_link(); ?>
            </span>
            <span class="comment-metadata">
                <?php comment_date(); ?>
            </span>

			<?php edit_comment_link( esc_html__( 'Edit ', 'sungarden' ) ); ?>

			<?php comment_reply_link( array_merge( $sungarden_comment_args, array(
				'add_below' => $sungarden_comment_add_below,
				'depth'     => $sungarden_comment_depth,
				'max_depth' => $sungarden_comment_args['max_depth']
			) ) ); ?>

        </div>

        <div class="comment-text-box">
			<?php comment_text(); ?>
        </div>
    </div>

	<?php if ( 'div' != $sungarden_comment_args['style'] ) : ?>
        </div>
	<?php endif; ?>

	<?php
}

/* callback comment list */

/*
 * Content Nav
 */

if ( ! function_exists( 'sungarden_comment_nav' ) ) :

	function sungarden_comment_nav() {
		// Are there comments to navigate through?
		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :

			?>
            <nav class="navigation comment-navigation">
                <h2 class="screen-reader-text">
					<?php esc_html_e( 'Comment navigation', 'sungarden' ); ?>
                </h2>

                <div class="nav-links">
					<?php
					if ( $prev_link = get_previous_comments_link( esc_html__( 'Older Comments', 'sungarden' ) ) ) :
						printf( '<div class="nav-previous">%s</div>', $prev_link );
					endif;

					if ( $next_link = get_next_comments_link( esc_html__( 'Newer Comments', 'sungarden' ) ) ) :
						printf( '<div class="nav-next">%s</div>', $next_link );
					endif;
					?>
                </div><!-- .nav-links -->
            </nav><!-- .comment-navigation -->

		<?php
		endif;
	}

endif;

/* Start Social Network */
function sungarden_get_social_url() {

	global $sungarden_options;
	$sungarden_social_networks = sungarden_get_social_network();

	foreach ( $sungarden_social_networks as $sungarden_social ) :
		$sungarden_social_url = $sungarden_options[ 'sungarden_social_network_' . $sungarden_social['id'] ];

		if ( $sungarden_social_url ) :
			?>

            <div class="social-network-item item-<?php echo esc_attr( $sungarden_social['id'] ); ?>">
                <a href="<?php echo esc_url( $sungarden_social_url ); ?>">
                    <i class="<?php echo esc_attr( $sungarden_social['icon'] ); ?>" aria-hidden="true"></i>
                </a>
            </div>


		<?php
		endif;

	endforeach;
}

function sungarden_get_social_network(): array {
	return array(

		array( 'id' => 'facebook', 'icon' => 'fab fa-facebook-f' ),
		array( 'id' => 'youtube', 'icon' => 'fab fa-youtube' ),
		array( 'id' => 'twitter', 'icon' => 'fab fa-twitter' ),
		array( 'id' => 'instagram', 'icon' => 'fab fa-instagram' ),

	);
}

/* End Social Network */

/* Start pagination */
function sungarden_pagination() {

	the_posts_pagination( array(
		'type'               => 'list',
		'mid_size'           => 2,
		'prev_text'          => esc_html__( 'Previous', 'sungarden' ),
		'next_text'          => esc_html__( 'Next', 'sungarden' ),
		'screen_reader_text' => '&nbsp;',
	) );

}

// pagination nav query
function sungarden_paging_nav_query( $sungarden_querry ) {

	$sungarden_pagination_args = array(

		'prev_text' => '<i class="fa fa-angle-double-left"></i>' . esc_html__( ' Previous', 'sungarden' ),
		'next_text' => esc_html__( 'Next', 'sungarden' ) . '<i class="fa fa-angle-double-right"></i>',
		'current'   => max( 1, get_query_var( 'paged' ) ),
		'total'     => $sungarden_querry->max_num_pages,
		'type'      => 'list',

	);

	$sungarden_paginate_links = paginate_links( $sungarden_pagination_args );

	if ( $sungarden_paginate_links ) :

		?>
        <nav class="pagination">
			<?php echo $sungarden_paginate_links; ?>
        </nav>

	<?php

	endif;
}

/* End pagination */

// Sanitize Pagination
add_action( 'navigation_markup_template', 'sungarden_sanitize_pagination' );

function sungarden_sanitize_pagination( $sungarden_content ): string {
	// Remove role attribute
	$sungarden_content = str_replace( 'role="navigation"', '', $sungarden_content );

	// Remove h2 tag
	$sungarden_content = preg_replace( '#<h2.*?>(.*?)<\/h2>#si', '', $sungarden_content );

	return $sungarden_content;
}

/* Start Get col global */
function sungarden_col_use_sidebar( $option_sidebar, $active_sidebar ): string {

	if ( $option_sidebar != 'hide' && is_active_sidebar( $active_sidebar ) ):

		if ( $option_sidebar == 'left' ) :
			$class_position_sidebar = ' order-1 order-md-2';
		else:
			$class_position_sidebar = ' order-1';
		endif;

		$class_col_content = 'col-12 col-md-8 col-lg-9' . $class_position_sidebar;
	else:
		$class_col_content = 'col-md-12';
	endif;

	return $class_col_content;
}

function sungarden_col_sidebar(): string {
	$class_col_sidebar = 'col-12 col-md-4 col-lg-3';

	return $class_col_sidebar;
}

/* End Get col global */

/* Start Post Meta */
function sungarden_post_meta() {
	?>

    <div class="site-post-meta">
        <span class="site-post-author">
            <?php esc_html_e( 'Author:', 'sungarden' ); ?>

            <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
                <?php the_author(); ?>
            </a>
        </span>

        <span class="site-post-date">
            <?php esc_html_e( 'Post date: ', 'sungarden' );
            the_date(); ?>
        </span>

        <span class="site-post-comments">
            <?php
            comments_popup_link( '0 ' . esc_html__( 'Comment', 'sungarden' ), '1 ' . esc_html__( 'Comment', 'sungarden' ), '% ' . esc_html__( 'Comments', 'sungarden' ) );
            ?>
        </span>
    </div>

	<?php
}

/* End Post Meta */

/* Start Link Pages */
function sungarden_link_page() {

	wp_link_pages( array(
		'before'      => '<div class="page-links">' . esc_html__( 'Pages:', 'sungarden' ),
		'after'       => '</div>',
		'link_before' => '<span class="page-number">',
		'link_after'  => '</span>',
	) );

}

/* End Link Pages */

/* Start comment */
function sungarden_comment_form() {

	if ( comments_open() || get_comments_number() ) :
		?>
        <div class="site-comments">
			<?php comments_template( '', true ); ?>
        </div>
	<?php
	endif;
}

/* End comment */

/* Start get Category check box */
function sungarden_check_get_cat( $type_taxonomy ): array {
	$cat_check = array();
	$category  = get_terms(
		array(
			'taxonomy'   => $type_taxonomy,
			'hide_empty' => false
		)
	);

	if ( isset( $category ) && ! empty( $category ) ):
		foreach ( $category as $item ) {
			$cat_check[ $item->term_id ] = $item->name;
		}
	endif;

	return $cat_check;
}

/* End get Category check box */

/* Get Contact Form */
function sungarden_get_form_cf7(): array {

	$sungarden_contact_forms    =   array();
	$sungarden_cf7              =   get_posts('post_type="wpcf7_contact_form"&numberposts=-1');

	if ( $sungarden_cf7 ) :

		foreach ( $sungarden_cf7 as $item ) :

			$sungarden_contact_forms[$item->ID] = $item->post_title;

		endforeach;

	else :

		$sungarden_contact_forms[esc_html__( "No contact forms found", "tz-gustoso-restaurant" )] = 0;

	endif;

	return $sungarden_contact_forms;

}

/**
 *Start share
 */
function sungarden_post_share() {

	?>
    <div class="site-post-share">
        <div class="fb-like" data-href="<?php the_permalink(); ?>" data-width="" data-layout="button_count"
             data-share="true" data-action="like" data-size="small"></div>
    </div>
	<?php

}

/* Start opengraph */
function sungarden_doctype_opengraph( $output ): string {
	return $output . '
 xmlns:og="http://opengraphprotocol.org/schema/"
 xmlns:fb="http://www.facebook.com/2008/fbml"';
}

add_filter( 'language_attributes', 'sungarden_doctype_opengraph' );

function sungarden_opengraph() {
	global $post;

	if ( is_single() ) :

		if ( has_post_thumbnail( $post->ID ) ) :
			$img_src = get_the_post_thumbnail_url( get_the_ID(), 'full' );
		else :
			$img_src = get_theme_file_uri( '/images/no-image.png' );
		endif;

		if ( $excerpt = $post->post_excerpt ) :
			$excerpt = strip_tags( $post->post_excerpt );
			$excerpt = str_replace( "", "'", $excerpt );
		else :
			$excerpt = get_bloginfo( 'description' );
		endif;

		?>
        <meta property="og:title" content="<?php the_title(); ?>"/>
        <meta property="og:description" content="<?php echo esc_attr( $excerpt ); ?>"/>
        <meta property="og:type" content="article"/>
        <meta property="og:url" content="<?php the_permalink(); ?>"/>
        <meta property="og:site_name" content="<?php echo esc_attr( get_bloginfo() ); ?>"/>
        <meta property="og:image" content="<?php echo esc_url( $img_src ); ?>"/>

	<?php

	else :
		return;
	endif;
}

add_action( 'wp_head', 'sungarden_opengraph', 5 );
/* End opengraph */

/* Start Facebook SDK */
function sungarden_facebook_sdk() {
	if ( is_single() ) :
		?>
        <div id="fb-root"></div>

        <script async defer crossorigin="anonymous"
                src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v6.0"></script>
	<?php
	endif;
}

add_action( 'wp_footer', 'sungarden_facebook_sdk' );
/* End share */

/**
 * This function modifies the main WordPress query to include an array of
 * post types instead of the default 'post' post type.
 *
 * @param object $query The main WordPress query.
 */
function beecolor_include_custom_post_types_in_search_results( $query ) {
	if ( $query->is_main_query() && $query->is_search() && ! is_admin() ) {
		$query->set( 'post_type', array( 'post' ) );
	}
}
add_action( 'pre_get_posts', 'beecolor_include_custom_post_types_in_search_results' );
