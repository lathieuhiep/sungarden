<?php
/**
 * ReduxFramework Config File
 */
if ( ! class_exists( 'Redux' ) ) {
    return;
}


// This is your option name where all the Redux data is stored.
$sungarden_opt_name = "sungarden_options";

/**
 * ---> SET ARGUMENTS
 * All the possible arguments for Redux.
 * */

$sungarden_theme = wp_get_theme(); // For use with some settings. Not necessary.

$sungarden_opt_args = array(

    'opt_name'             => $sungarden_opt_name,
    // This is where your data is stored in the database and also becomes your global variable name.
    'display_name'         => $sungarden_theme->get( 'Name' ),
    // Name that appears at the top of your panel
    'display_version'      => $sungarden_theme->get( 'Version' ),
    // Version that appears at the top of your panel
    'menu_type'            => 'menu',
    //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
    'allow_sub_menu'       => false,
    // Show the sections below the admin menu item or not
    'menu_title'           => $sungarden_theme->get( 'Name' ) . esc_html__(' Options', 'sungarden'),
    'page_title'           => $sungarden_theme->get( 'Name' ) . esc_html__(' Options', 'sungarden'),
    // You will need to generate a Google API key to use this feature.
    // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
    'google_api_key'       => '',
    // Set it you want google fonts to update weekly. A google_api_key value is required.
    'google_update_weekly' => false,
    // Must be defined to add google fonts to the typography module
    'async_typography'     => true,
    // Use a asynchronous font on the front end or font string
    //'disable_google_fonts_link' => true,
    'admin_bar'            => true,
    // Show the panel pages on the admin bar
    'admin_bar_icon'       => 'dashicons-portfolio',
    // Choose an icon for the admin bar menu
    'admin_bar_priority'   => 50,
    // Choose an priority for the admin bar menu
    'global_variable'      => '',
    // Set a different name for your global variable other than the opt_name
    'dev_mode'             => false,
    // Show the time the page took to load, etc
    'update_notice'        => false,
    // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
    'customizer'           => true,

    // OPTIONAL -> Give you extra features
    'page_priority'        => 2,
    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
    'page_parent'          => 'themes.php',
    // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
    'page_permissions'     => 'manage_options',
    // Permissions needed to access the options panel.
    'menu_icon'            => '',
    // Specify a custom URL to an icon
    'last_tab'             => '',
    // Force your panel to always open to a specific tab (by id)
    'page_icon'            => 'icon-themes',
    // Icon displayed in the admin panel next to your menu_title
    'page_slug'            => '',
    // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
    'save_defaults'        => true,
    // On load save the defaults to DB before user clicks save or not
    'default_show'         => false,
    // If true, shows the default value next to each field that is not the default value.
    'default_mark'         => '',
    // What to print by the field's title if the value shown is default. Suggested: *
    'show_import_export'   => true,
    // Shows the Import/Export panel when not used as a field.

    // CAREFUL -> These options are for advanced use only
    'transient_time'       => 60 * MINUTE_IN_SECONDS,
    'output'               => true,
    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
    'output_tag'           => true,
    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
    // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

    // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
    'database'             => '',
    // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
    'use_cdn'              => true,
    // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

    // HINTS
    'hints'             =>  array(
        'icon'          => 'el el-question-sign',
        'icon_position' => 'right',
        'icon_color'    => 'lightgray',
        'icon_size'     => 'normal',
        'tip_style'     =>  array(
            'color'     => 'red',
            'shadow'    =>  true,
            'rounded'   =>  false,
            'style'     =>  '',
        ),
        'tip_position'  =>  array(
            'my'        =>  'top left',
            'at'        =>  'bottom right',
        ),
        'tip_effect'    =>  array(
            'show'      =>  array(
                'effect'    =>  'slide',
                'duration'  =>  '500',
                'event'     =>  'mouseover',
            ),
            'hide'  =>  array(
                'effect'    =>  'slide',
                'duration'  =>  '500',
                'event'     =>  'click mouseleave',
            ),
        ),
    )
);
Redux::set_args( $sungarden_opt_name, $sungarden_opt_args );
/*
 * ---> END ARGUMENTS
 */

/*
 * ---> START HELP TABS
 */

$sungarden_opt_tabs = array(
    array(
        'id'        =>  'redux-help-tab-1',
        'title'     =>  esc_html__( 'Theme Information 1', 'sungarden' ),
        'content'   =>  esc_html__( '<p>This is the tab content, HTML is allowed.</p>', 'sungarden' )
    ),
    array(
        'id'        =>  'redux-help-tab-2',
        'title'     =>  esc_html__( 'Theme Information 2', 'sungarden' ),
        'content'   =>  esc_html__( '<p>This is the tab content, HTML is allowed.</p>', 'sungarden' )
    )
);
Redux::set_help_tab( $sungarden_opt_name, $sungarden_opt_tabs );

// Set the help sidebar
$sungarden_opt_content = esc_html__( '<p>This is the sidebar content, HTML is allowed.</p>', 'sungarden' );
Redux::set_help_sidebar( $sungarden_opt_name, $sungarden_opt_content );


/*
 * <--- END HELP TABS
 */

/*
 *
 * ---> START SECTIONS
 *
 */

// -> START option background

Redux::set_section( $sungarden_opt_name, array(
    'id'                =>   'sungarden_theme_option',
    'title'             =>   $sungarden_theme->get( 'Name' ).' '.$sungarden_theme->get( 'Version' ),
    'customizer_width'  =>   '400px',
    'icon'              =>   '',
));

// -> END option background

/* Start General Options */

Redux::set_section( $sungarden_opt_name, array(
    'title'             =>  esc_html__( 'General Options', 'sungarden' ),
    'id'                =>  'sungarden_general',
    'desc'              =>  esc_html__( 'General all config', 'sungarden' ),
    'customizer_width'  =>  '400px',
    'icon'              =>  'el el-th-large',
));

// Favicon Config
Redux::set_section( $sungarden_opt_name, array(
    'title'         =>  esc_html__( 'Favicon', 'sungarden' ),
    'id'            =>  'sungarden_favicon_config',
    'desc'          =>  esc_html__( '', 'sungarden' ),
    'subsection'    =>  true,
    'fields'        =>  array(
        array(
            'id'        =>  'sungarden_favicon_upload',
            'type'      =>  'media',
            'url'       =>  true,
            'title'     =>  esc_html__( 'Upload Favicon Image', 'sungarden' ),
            'subtitle'  =>  esc_html__( 'Favicon image for your website', 'sungarden' ),
            'desc'      =>  esc_html__( '', 'sungarden' ),
            'default'   =>  false,
        ),
    )
));

//Loading config
Redux::set_section( $sungarden_opt_name, array(
    'title'         =>  esc_html__( 'Loading config', 'sungarden' ),
    'id'            =>  'sungarden_general_loading',
    'desc'          =>  esc_html__( '', 'sungarden' ),
    'subsection'    =>  true,
    'fields'        =>  array(
        array(
            'id'        =>  'sungarden_general_show_loading',
            'type'      =>  'switch',
            'title'     =>  esc_html__( 'Loading On/Off', 'sungarden' ),
            'default'   =>  false,
        ),
        array(
            'id'        =>  'sungarden_general_image_loading',
            'type'      =>  'media',
            'url'       =>  true,
            'title'     =>  esc_html__( 'Upload image loading', 'sungarden' ),
            'subtitle'  =>  esc_html__( 'Upload image .gif', 'sungarden' ),
            'default'   =>  '',
            'required'  =>  array( 'sungarden_general_show_loading', '=', true ),
        ),
    )
));

//Background Options
Redux::set_section( $sungarden_opt_name, array(
    'title'             =>  esc_html__( 'Background', 'sungarden' ),
    'id'                =>  'sungarden_background',
    'desc'              =>  esc_html__( 'Background all config', 'sungarden' ),
    'customizer_width'  =>  '400px',
    'subsection'        => true,
    'fields'            => array(
        array(
            'id'        =>  'sungarden_background_body',
            'output'    =>  'body',
            'type'      =>  'background',
            'clone'     =>  'true',
            'title'     =>  esc_html__( 'Body background', 'sungarden' ),
            'subtitle'  =>  esc_html__( 'Body background with image, color, etc.', 'sungarden' ),
            'hint'      =>  array(
                'content'   =>  'This is a <b>hint</b> tool-tip for the text field.<br/><br/>Add any HTML based text you like here.',
            )
        ),
    ),
));

/* End General Options */

/* Start Header Options */
Redux::set_section( $sungarden_opt_name, array(
    'title'             =>  esc_html__( 'Header Options', 'sungarden' ),
    'id'                =>  'sungarden_header',
    'desc'              =>  esc_html__( 'Header all config', 'sungarden' ),
    'customizer_width'  =>  '400px',
    'icon'              =>  'el el-arrow-up',
));

//Logo Config
Redux::set_section( $sungarden_opt_name, array(
    'title'         =>  esc_html__( 'Logo', 'sungarden' ),
    'id'            =>  'sungarden_logo_config',
    'desc'          =>  esc_html__( '', 'sungarden' ),
    'subsection'    =>  true,
    'fields'        =>  array(

        array(
            'id'        =>  'sungarden_logo_image',
            'type'      =>  'media',
            'url'       =>  true,
            'title'     =>  esc_html__( 'Upload logo', 'sungarden' ),
            'subtitle'  =>  esc_html__( 'logo image for your website', 'sungarden' ),
            'desc'      =>  esc_html__( '', 'sungarden' ),
            'default'   =>  false,
        ),

        array(
            'id'                => 'sungarden_logo_images_size',
            'type'              => 'dimensions',
            'units'             => array( 'em', 'px', '%' ),
            'title'             => esc_html__( 'Set width/height for logo', 'sungarden' ),
            'subtitle'          => esc_html__( '', 'sungarden' ),
            'units_extended'    => 'true',
            'default'           => array(
                'width'     =>  '',
                'height'    =>  '',
            ),
            'output'         => array('.site-logo img'),
        ),

        array(
            'id'        =>  'sungarden_nav_top_sticky',
            'type'      =>  'select',
            'title'     =>  esc_html__( 'Sticky Menu', 'sungarden' ),
            'default'   =>  1,
            'options'   =>  array(
                1   =>  esc_html__( 'Yes', 'sungarden' ),
                2   =>  esc_html__( 'No', 'sungarden' )
            )
        ),

    )
));

// information
Redux::set_section( $sungarden_opt_name, array(
    'title'         =>  esc_html__( 'Information', 'sungarden' ),
    'id'            =>  'sungarden_information_config',
    'desc'          =>  esc_html__( '', 'sungarden' ),
    'subsection'    =>  true,
    'fields'        =>  array(

        array(
            'id'        =>  'sungarden_information_phone',
            'type'      =>  'text',
            'title'     =>  esc_html__( 'Phone', 'sungarden' ),
            'default'   =>  '+1 234 567 186',
        ),

	    array(
            'id'        =>  'sungarden_information_messenger',
            'type'      =>  'textarea',
            'title'     =>  esc_html__( 'Messenger', 'sungarden' ),
            'default'   =>  '',
        ),

    )
));

/* End Header Options */

/* Start Blog Option */
Redux::set_section( $sungarden_opt_name, array(
    'title'             =>  esc_html__( 'Blog Options', 'sungarden' ),
    'id'                =>  'sungarden_blog_option',
    'customizer_width'  =>  '400px',
    'icon'              =>  'el el-blogger',
    'fields'            =>  array(

        array(
            'id'        =>  'sungarden_blog_sidebar_archive',
            'type'      =>  'image_select',
            'title'     =>  esc_html__( 'Sidebar Archive', 'sungarden' ),
            'desc'      =>  esc_html__( 'Use for archive, index, page search', 'sungarden' ),
            'default'   =>  'right',
            'options'   =>  array(
                'hide' =>  array(
                    'alt'   =>  'None Sidebar',
                    'img'   =>  ReduxFramework::$_url . 'assets/img/1col.png'
                ),

                'left' =>  array(
                    'alt'   =>  'Sidebar Left',
                    'img'   =>  ReduxFramework::$_url . 'assets/img/2cl.png'
                ),

                'right' =>  array(
                    'alt'   =>  'Sidebar Right',
                    'img'   =>  ReduxFramework::$_url . 'assets/img/2cr.png'
                ),

            ),
        ),

	    array(
		    'id'        =>  'sungarden_blog_per_row',
		    'type'      =>  'select',
		    'title'     =>  esc_html__( 'Blog Per Row', 'sungarden' ),
		    'default'   =>  2,
		    'options'   =>  array(
			    2   =>  '2 Column',
			    3   =>  '3 Column',
			    4   =>  '4 Column',
		    )
	    ),

    )
));

Redux::set_section( $sungarden_opt_name, array(
	'title'         =>  esc_html__( 'Single Post', 'sungarden' ),
	'id'            =>  'sungarden_single_post_option',
	'desc'          =>  esc_html__( '', 'sungarden' ),
	'subsection'    =>  true,
	'fields'        =>  array(

		array(
			'id'        =>  'sungarden_blog_sidebar_single',
			'type'      =>  'image_select',
			'title'     =>  esc_html__( 'Sidebar Single', 'sungarden' ),
			'default'   =>  'right',
			'options'   =>  array(
				'hide' =>  array(
					'alt'   =>  'None Sidebar',
					'img'   =>  ReduxFramework::$_url . 'assets/img/1col.png'
				),

				'left' =>  array(
					'alt'   =>  'Sidebar Left',
					'img'   =>  ReduxFramework::$_url . 'assets/img/2cl.png'
				),

				'right' =>  array(
					'alt'   =>  'Sidebar Right',
					'img'   =>  ReduxFramework::$_url . 'assets/img/2cr.png'
				),

			),
		),

		array(
			'id'        =>  'sungarden_on_off_share_single',
			'type'      =>  'switch',
			'title'     =>  esc_html__( 'On/Off Share Post Single', 'sungarden' ),
			'default'   =>  true,
		),

		array(
			'id'            =>  'sungarden_related_post_limit',
			'type'          =>  'slider',
			'title'         =>  esc_html__( 'Related Post Limit', 'sungarden' ),
			'min'           =>  1,
			'step'          =>  1,
			'max'           =>  250,
			'default'       =>  3,
			'display_value' => 'text'
		),

	)
));
/* End Blog Option */

/* Start Social Network */
Redux::set_section( $sungarden_opt_name, array(
    'title'             =>  esc_html__( 'Social Network', 'sungarden' ),
    'id'                =>  'sungarden_social_network',
    'customizer_width'  =>  '400px',
    'icon'              =>  'el el-globe-alt',
    'fields'            =>  array(

        array(
            'id'        =>  'sungarden_social_network_facebook',
            'type'      =>  'text',
            'title'     =>  esc_html__( 'Facebook', 'sungarden' ),
            'default'   =>  '#',
        ),

        array(
            'id'        =>  'sungarden_social_network_youtube',
            'type'      =>  'text',
            'title'     =>  esc_html__( 'Youtube', 'sungarden' ),
            'default'   =>  '#',
        ),

        array(
            'id'        =>  'sungarden_social_network_twitter',
            'type'      =>  'text',
            'title'     =>  esc_html__( 'Twitter', 'sungarden' ),
            'default'   =>  '#',
        ),

        array(
            'id'        =>  'sungarden_social_network_instagram',
            'type'      =>  'text',
            'title'     =>  esc_html__( 'Instagram', 'sungarden' ),
            'default'   =>  '#',
        ),

    )
));
/* End Social Network */

/* Start Typography Options */
Redux::set_section( $sungarden_opt_name, array(
    'title'             =>  esc_html__( 'Typography', 'sungarden' ),
    'id'                =>  'sungarden_typography',
    'desc'              =>  esc_html__( 'Typography all config', 'sungarden' ),
    'customizer_width'  =>  '400px',
    'icon'              =>  'el el-fontsize'
));

// Body font
Redux::set_section( $sungarden_opt_name, array(
    'title'         =>  esc_html__( 'Body Typography', 'sungarden' ),
    'id'            =>  'sungarden_body_typography',
    'desc'          =>  esc_html__( '', 'sungarden' ),
    'subsection'    =>  true,
    'fields'        =>  array(

        array(
            'id'        =>  'sungarden_body_typography_font',
            'type'      =>  'typography',
            'output'    =>  array( 'body' ),
            'title'     =>  esc_html__( 'Body Font', 'sungarden' ),
            'subtitle'  =>  esc_html__( 'Specify the body font properties.', 'sungarden' ),
            'google'    =>  true,
            'default'   =>  array(
                'color'         =>  '',
                'font-size'     =>  '',
                'font-family'   =>  '',
                'font-weight'   =>  '',
            ),
        ),

        array(
            'id'        =>  'sungarden_link_color',
            'type'      =>  'link_color',
            'output'    =>  array( 'a' ),
            'title'     =>  esc_html__( 'Link Color', 'sungarden' ),
            'subtitle'  =>  esc_html__( 'Controls the color of all text links.', 'sungarden' ),
            'default'   =>  ''
        ),
    )
));

// Header font
Redux::set_section( $sungarden_opt_name, array(
    'title'         =>  esc_html__( 'Custom Typography', 'sungarden' ),
    'id'            =>  'sungarden_custom_typography',
    'desc'          =>  esc_html__( '', 'sungarden' ),
    'subsection'    =>  true,
    'fields'        =>  array(

        array(
            'id'        =>  'sungarden_custom_typography_1',
            'type'      =>  'typography',
            'title'     =>  esc_html__( 'Custom 1 Typography', 'sungarden' ),
            'subtitle'  =>  esc_html__( 'These settings control the typography for all Custom 1.', 'sungarden' ),
            'google'    =>  true,
            'default'   =>  array(
                'font-size'     =>  '',
                'font-family'   =>  '',
                'font-weight'   =>  '',
                'color'         =>  '',
            ),
        ),

        //selector custom typo 1
        array(
            'id'        =>  'sungarden_custom_typography_1_selector',
            'type'      =>  'textarea',
            'title'     =>  esc_html__( 'Selectors 1', 'sungarden' ),
            'desc'      =>  esc_html__( 'Import selectors. You can import one or multi selector.Example: #selector1,#selector2,.selector3', 'sungarden' ),
            'default'   =>  ''
        ),

        array(
            'id'        =>  'sungarden_custom_typography_2',
            'type'      =>  'typography',
            'title'     =>  esc_html__( 'Custom 2 Typography', 'sungarden' ),
            'subtitle'  =>  esc_html__( 'These settings control the typography for all Custom 2.', 'sungarden' ),
            'google'    =>  true,
            'default'   =>  array(
                'font-size'     =>  '',
                'font-family'   =>  '',
                'font-weight'   =>  '',
                'color'         =>  '',
            ),
        ),

        //selector custom typo 2
        array(
            'id'        => 'sungarden_custom_typography_2_selector',
            'type'      => 'textarea',
            'title'     => esc_html__( 'Selectors 2', 'sungarden' ),
            'desc'      => esc_html__( 'Import selectors. You can import one or multi selector.Example: #selector1,#selector2,.selector3', 'sungarden' ),
            'default'   => ''
        ),

        array(
            'id'        =>  'sungarden_custom_typography_3',
            'type'      =>  'typography',
            'title'     =>  esc_html__( 'Custom 3 Typography', 'sungarden' ),
            'subtitle'  =>  esc_html__( 'These settings control the typography for all Custom 3.', 'sungarden' ),
            'google'    =>  true,
            'default'   =>  array(
                'font-size'     =>  '',
                'font-family'   =>  '',
                'font-weight'   =>  '',
                'color'         =>  '',
            ),
            'output'    =>  '',
        ),

        //selector custom typo 3
        array(
            'id'        =>  'sungarden_custom_typography_3_selector',
            'type'      =>  'textarea',
            'title'     =>  esc_html__( 'Selectors 3', 'sungarden' ),
            'desc'      =>  esc_html__( 'Import selectors. You can import one or multi selector.Example: #selector1,#selector2,.selector3', 'sungarden' ),
            'default'   =>  ''
        ),

    )
));

/* End Typography Options */

/* Start 404 Options */
Redux::set_section( $sungarden_opt_name, array(
    'title'             =>  esc_html__( '404 Options', 'sungarden' ),
    'id'                =>  'sungarden_404',
    'desc'              =>  esc_html__( '404 page all config', 'sungarden' ),
    'customizer_width'  =>  '400px',
    'icon'              =>  'el el-warning-sign',
    'fields'            =>  array(

        array(
            'id'        =>  'sungarden_404_background',
            'type'      =>  'media',
            'url'       =>  true,
            'title'     =>  esc_html__( '404 Background', 'sungarden' ),
            'default'   =>  false,
        ),

        array(
            'id'        =>  'sungarden_404_title',
            'type'      =>  'text',
            'title'     =>  esc_html__( '404 Title', 'sungarden' ),
            'default'   =>  'Awww...Do Not Cry',
        ),

        array(
            'id'        =>  'sungarden_404_editor',
            'type'      =>  'editor',
            'title'     =>  esc_html__( '404 Content', 'sungarden' ),
            'default'   =>  esc_html__( 'It is just a 404 Error! What you are looking for may have been misplaced in Long Term Memory.', 'sungarden' ),
            'args'          =>  array(
                'wpautop'       => false,
                'media_buttons' => false,
                'textarea_rows' => 10,
                'teeny'         => false,
                'quicktags'     => true,
            )
        ),

    )
));
/* End 404 Options */

/* Start Footer Options */
Redux::set_section( $sungarden_opt_name, array(
    'title'             =>  esc_html__( 'Footer Options', 'sungarden' ),
    'id'                =>  'sungarden_footer',
    'desc'              =>  esc_html__( 'Footer all config', 'sungarden' ),
    'customizer_width'  =>  '400px',
    'icon'              =>  'el el-arrow-down'
));

// Footer Sidebar Multi Column
Redux::set_section( $sungarden_opt_name, array(
    'title'         =>  esc_html__( 'Sidebar Footer Multi Column', 'sungarden' ),
    'id'            =>  'sungarden_footer_sidebar_multi_column',
    'subsection'    =>  true,
    'fields'        =>  array(
        array(
            'id'        =>  'sungarden_footer_multi_column',
            'type'      =>  'image_select',
            'title'     =>  esc_html__( 'Number of Footer Columns', 'sungarden' ),
            'subtitle'  =>  esc_html__( 'Controls the number of columns in the footer', 'sungarden' ),
            'default'   =>  4,
            'options'   =>  array(
                0 =>  array(
                    'alt'   =>  'No Footer',
                    'img'   =>  get_theme_file_uri( '/extension/assets/images/no-footer.png' )
                ),

                1 =>  array(
                    'alt'   =>  '1 Columnn',
                    'img'   =>  get_theme_file_uri(  '/extension/assets/images/1column.png' )
                ),

                2 =>  array(
                    'alt'   =>  '2 Columnn',
                    'img'   =>  get_theme_file_uri( '/extension/assets/images/2column.png' )
                ),
                3 =>  array(
                    'alt'   =>  '3 Columnn',
                    'img'   =>  get_theme_file_uri(   '/extension/assets/images/3column.png' )
                ),
                4 =>  array(
                    'alt'   =>  '4 Columnn',
                    'img'   =>  get_theme_file_uri( '/extension/assets/images/4column.png' )
                ),
            ),
        ),

        array(
            'id'            =>  'sungarden_footer_multi_column_1',
            'type'          =>  'slider',
            'title'         =>  esc_html__( 'Column width 1', 'sungarden' ),
            'subtitle'      =>  esc_html__( 'Select the number of columns to display in the footer', 'sungarden' ),
            'desc'          =>  esc_html__( 'Min: 1, max: 12, default value: 1', 'sungarden' ),
            'default'       =>  3,
            'min'           =>  1,
            'step'          =>  1,
            'max'           =>  12,
            'display_value' =>  'label',
            'required'      =>  array(
                array( 'sungarden_footer_multi_column', 'equals','1', '2', '3', '4' ),
                array( 'sungarden_footer_multi_column', '!=', '0' ),
            )
        ),

        array(
            'id'            =>  'sungarden_footer_multi_column_2',
            'type'          =>  'slider',
            'title'         =>  esc_html__( 'Column width 2', 'sungarden' ),
            'subtitle'      =>  esc_html__( 'Select the number of columns to display in the footer', 'sungarden' ),
            'desc'          =>  esc_html__( 'Min: 1, max: 12, default value: 1', 'sungarden' ),
            'default'       =>  3,
            'min'           =>  1,
            'step'          =>  1,
            'max'           =>  12,
            'display_value' =>  'label',
            'required'      =>  array(
                array( 'sungarden_footer_multi_column', 'equals', '2', '3', '4' ),
                array( 'sungarden_footer_multi_column', '!=', '1' ),
                array( 'sungarden_footer_multi_column', '!=', '0' ),
            )
        ),

        array(
            'id'            =>  'sungarden_footer_multi_column_3',
            'type'          =>  'slider',
            'title'         =>  esc_html__( 'Column width 3', 'sungarden' ),
            'subtitle'      =>  esc_html__( 'Select the number of columns to display in the footer', 'sungarden' ),
            'desc'          =>  esc_html__( 'Min: 1, max: 12, default value: 1', 'sungarden' ),
            'default'       =>  3,
            'min'           =>  1,
            'step'          =>  1,
            'max'           =>  12,
            'display_value' =>  'label',
            'required'      =>  array(
                array( 'sungarden_footer_multi_column', 'equals', '3', '4' ),
                array( 'sungarden_footer_multi_column', '!=', '1' ),
                array( 'sungarden_footer_multi_column', '!=', '2' ),
                array( 'sungarden_footer_multi_column', '!=', '0' ),
            )
        ),

        array(
            'id'            =>  'sungarden_footer_multi_column_4',
            'type'          =>  'slider',
            'title'         =>  esc_html__( 'Column width 4', 'sungarden' ),
            'subtitle'      =>  esc_html__( 'Select the number of columns to display in the footer', 'sungarden' ),
            'desc'          =>  esc_html__( 'Min: 1, max: 12, default value: 1', 'sungarden' ),
            'default'       =>  3,
            'min'           =>  1,
            'step'          =>  1,
            'max'           =>  12,
            'display_value' =>  'label',
            'required'      =>  array(
                array( 'sungarden_footer_multi_column',  'equals', '4' ),
                array( 'sungarden_footer_multi_column', '!=', '1' ),
                array( 'sungarden_footer_multi_column', '!=', '2' ),
                array( 'sungarden_footer_multi_column', '!=', '3' ),
                array( 'sungarden_footer_multi_column', '!=', '0' ),
            )
        ),
    )

));

/* End Footer Options */


/*
 * <--- END SECTIONS
 */

/**
 * This is a test function that will let you see when the compiler hook occurs.
 * It only runs if a field    set with compiler=>true is changed.
 * */
if ( ! function_exists( 'compiler_action' ) ) {
    function compiler_action( $options, $css, $changed_values ) {
        echo '<h1>The compiler hook has run!</h1>';
        echo "<pre>";
        print_r( $changed_values ); // Values that have changed since the last save
        echo "</pre>";
        print_r($options); //Option values
        print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )
    }
}
