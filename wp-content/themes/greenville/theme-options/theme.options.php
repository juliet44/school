<?php
/**
 * Default Theme Options and Internal Theme Settings
 *
 * @package WordPress
 * @subpackage GREENVILLE
 * @since GREENVILLE 1.0
 */

// Theme init priorities:
// 1 - register filters to add/remove lists items in the Theme Options
// 2 - create Theme Options
// 3 - add/remove Theme Options elements
// 5 - load Theme Options
// 9 - register other filters (for installer, etc.)
//10 - standard Theme init procedures (not ordered)

if ( !function_exists('greenville_options_theme_setup1') ) {
	add_action( 'after_setup_theme', 'greenville_options_theme_setup1', 1 );
	function greenville_options_theme_setup1() {
		
		// -----------------------------------------------------------------
		// -- ONLY FOR PROGRAMMERS, NOT FOR CUSTOMER
		// -- Internal theme settings
		// -----------------------------------------------------------------
		greenville_storage_set('settings', array(
			
			'disable_jquery_ui'		=> false,		// Prevent loading custom jQuery UI libraries in the third-party plugins
		
			'max_load_fonts'		=> 3,			// Max fonts number to load from Google fonts or from uploaded fonts
		
			'use_mediaelements'		=> true,		// Load script "Media Elements" to play video and audio
		
			'max_excerpt_length'	=> 40,			// Max words number for the excerpt in the blog style 'Excerpt'.
													// For style 'Classic' - get half from this value
			'comment_maxlength'		=> 1000,		// Max length of the message from contact form

			'comment_after_name'	=> true			// Place 'comment' field before the 'name' and 'email'
			
		));
	}
}


// -----------------------------------------------------------------
// -- Theme options for customizer
// -----------------------------------------------------------------
if (!function_exists('greenville_options_create')) {

	function greenville_options_create() {

		greenville_storage_set('options', array(
		
			// Section 'Title & Tagline' - add theme options in the standard WP section
			'title_tagline' => array(
				"title" => esc_html__('Title, Tagline & Site icon', 'greenville'),
				"desc" => wp_kses_data( __('Specify site title and tagline (if need) and upload the site icon', 'greenville') ),
				"type" => "section"
				),
		
		
			// Section 'Header' - add theme options in the standard WP section
			'header_image' => array(
				"title" => esc_html__('Header', 'greenville'),
				"desc" => wp_kses_data( __('Select or upload logo images, select header type and widgets set for the header', 'greenville') )
							. '<br>'
							. wp_kses_data( __('<b>Attention!</b> Some of these options can be overridden in the following sections (Homepage, Blog archive, Shop, Events, etc.) or in the settings of individual pages', 'greenville') ),
				"type" => "section"
				),
			'header_image_override' => array(
				"title" => esc_html__('Header image override', 'greenville'),
				"desc" => wp_kses_data( __("Allow override the header image with the page's/post's/product's/etc. featured image", 'greenville') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'greenville')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			'header_style' => array(
				"title" => esc_html__('Header style', 'greenville'),
				"desc" => wp_kses_data( __('Select style to display the site header', 'greenville') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'greenville')
				),
				"std" => 'header-default',
				"options" => array(),
				"type" => "select"
				),
			'header_position' => array(
				"title" => esc_html__('Header position', 'greenville'),
				"desc" => wp_kses_data( __('Select position to display the site header', 'greenville') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'greenville')
				),
				"std" => 'default',
				"options" => array(),
				"type" => "select"
				),
			'header_widgets' => array(
				"title" => esc_html__('Header widgets', 'greenville'),
				"desc" => wp_kses_data( __('Select set of widgets to show in the header on each page', 'greenville') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'greenville'),
					"desc" => wp_kses_data( __('Select set of widgets to show in the header on this page', 'greenville') ),
				),
				"std" => 'hide',
				"options" => array(),
				"type" => "select"
				),
			'header_columns' => array(
				"title" => esc_html__('Header columns', 'greenville'),
				"desc" => wp_kses_data( __('Select number columns to show widgets in the Header. If 0 - autodetect by the widgets count', 'greenville') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'greenville')
				),
				"dependency" => array(
					'header_style' => array('header-default'),
					'header_widgets' => array('^hide')
				),
				"std" => 0,
				"options" => greenville_get_list_range(0,6),
				"type" => "select"
				),
			'header_scheme' => array(
				"title" => esc_html__('Header Color Scheme', 'greenville'),
				"desc" => wp_kses_data( __('Select color scheme to decorate header area', 'greenville') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'greenville')
				),
				"std" => 'inherit',
				"options" => array(),
				"refresh" => false,
				"type" => "select"
				),
			'header_fullheight' => array(
				"title" => esc_html__('Header fullheight', 'greenville'),
				"desc" => wp_kses_data( __("Enlarge header area to fill whole screen. Used only if header have a background image", 'greenville') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'greenville')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			'header_wide' => array(
				"title" => esc_html__('Header fullwide', 'greenville'),
				"desc" => wp_kses_data( __('Do you want to stretch the header widgets area to the entire window width?', 'greenville') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'greenville')
				),
				"dependency" => array(
					'header_style' => array('header-default')
				),
				"std" => 1,
				"type" => "checkbox"
				),

			'menu_info' => array(
				"title" => esc_html__('Menu settings', 'greenville'),
				"desc" => wp_kses_data( __('Select main menu style, position, color scheme and other parameters', 'greenville') ),
				"type" => "info"
				),
			'menu_style' => array(
				"title" => esc_html__('Menu position', 'greenville'),
				"desc" => wp_kses_data( __('Select position of the main menu', 'greenville') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'greenville')
				),
				"std" => 'top',
				"options" => array(
					'top'	=> esc_html__('Top',	'greenville'),
					'left'	=> esc_html__('Left',	'greenville'),
					'right'	=> esc_html__('Right',	'greenville')
				),
				"type" => "switch"
				),
			'menu_scheme' => array(
				"title" => esc_html__('Menu Color Scheme', 'greenville'),
				"desc" => wp_kses_data( __('Select color scheme to decorate main menu area', 'greenville') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'greenville')
				),
				"std" => 'inherit',
				"options" => array(),
				"refresh" => false,
				"type" => "select"
				),
			'menu_side_stretch' => array(
				"title" => esc_html__('Stretch sidemenu', 'greenville'),
				"desc" => wp_kses_data( __('Stretch sidemenu to window height (if menu items number >= 5)', 'greenville') ),
				"dependency" => array(
					'menu_style' => array('left', 'right')
				),
				"std" => 1,
				"type" => "checkbox"
				),
			'menu_side_icons' => array(
				"title" => esc_html__('Iconed sidemenu', 'greenville'),
				"desc" => wp_kses_data( __('Get icons from anchors and display it in the sidemenu or mark sidemenu items with simple dots', 'greenville') ),
				"dependency" => array(
					'menu_style' => array('left', 'right')
				),
				"std" => 1,
				"type" => "checkbox"
				),
			'menu_mobile_fullscreen' => array(
				"title" => esc_html__('Mobile menu fullscreen', 'greenville'),
				"desc" => wp_kses_data( __('Display mobile and side menus on full screen (if checked) or slide narrow menu from the left or from the right side (if not checked)', 'greenville') ),
				"dependency" => array(
					'menu_style' => array('left', 'right')
				),
				"std" => 1,
				"type" => "checkbox"
				),
			'logo_info' => array(
				"title" => esc_html__('Logo settings', 'greenville'),
				"desc" => wp_kses_data( __('Select logo images for the normal and Retina displays', 'greenville') ),
				"type" => "info"
				),
			'logo' => array(
				"title" => esc_html__('Logo', 'greenville'),
				"desc" => wp_kses_data( __('Select or upload site logo', 'greenville') ),
				"std" => '',
				"type" => "image"
				),
			'logo_retina' => array(
				"title" => esc_html__('Logo for Retina', 'greenville'),
				"desc" => wp_kses_data( __('Select or upload site logo used on Retina displays (if empty - use default logo from the field above)', 'greenville') ),
				"std" => '',
				"type" => "image"
				),
			'logo_inverse' => array(
				"title" => esc_html__('Logo inverse', 'greenville'),
				"desc" => wp_kses_data( __('Select or upload site logo to display it on the dark background', 'greenville') ),
				"std" => '',
				"type" => "image"
				),
			'logo_inverse_retina' => array(
				"title" => esc_html__('Logo inverse for Retina', 'greenville'),
				"desc" => wp_kses_data( __('Select or upload site logo used on Retina displays (if empty - use default logo from the field above)', 'greenville') ),
				"std" => '',
				"type" => "image"
				),
			'logo_side' => array(
				"title" => esc_html__('Logo side', 'greenville'),
				"desc" => wp_kses_data( __('Select or upload site logo (with vertical orientation) to display it in the side menu', 'greenville') ),
				"std" => '',
				"type" => "image"
				),
			'logo_side_retina' => array(
				"title" => esc_html__('Logo side for Retina', 'greenville'),
				"desc" => wp_kses_data( __('Select or upload site logo (with vertical orientation) to display it in the side menu on Retina displays (if empty - use default logo from the field above)', 'greenville') ),
				"std" => '',
				"type" => "image"
				),
			'logo_text' => array(
				"title" => esc_html__('Logo from Site name', 'greenville'),
				"desc" => wp_kses_data( __('Do you want use Site name and description as Logo if images above are not selected?', 'greenville') ),
				"std" => 1,
				"type" => "checkbox"
				),
			
		
		
			// Section 'Content'
			'content' => array(
				"title" => esc_html__('Content', 'greenville'),
				"desc" => wp_kses_data( __('Options for the content area.', 'greenville') )
							. '<br>'
							. wp_kses_data( __('<b>Attention!</b> Some of these options can be overridden in the following sections (Homepage, Blog archive, Shop, Events, etc.) or in the settings of individual pages', 'greenville') ),
				"type" => "section",
				),
			'body_style' => array(
				"title" => esc_html__('Body style', 'greenville'),
				"desc" => wp_kses_data( __('Select width of the body content', 'greenville') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'greenville')
				),
				"refresh" => false,
				"std" => 'wide',
				"options" => array(
					'boxed'		=> esc_html__('Boxed',		'greenville'),
					'wide'		=> esc_html__('Wide',		'greenville'),
					'fullwide'	=> esc_html__('Fullwide',	'greenville'),
					'fullscreen'=> esc_html__('Fullscreen',	'greenville')
				),
				"type" => "select"
				),
			'color_scheme' => array(
				"title" => esc_html__('Site Color Scheme', 'greenville'),
				"desc" => wp_kses_data( __('Select color scheme to decorate whole site. Attention! Case "Inherit" can be used only for custom pages, not for root site content in the Appearance - Customize', 'greenville') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'greenville')
				),
				"std" => 'default',
				"options" => array(),
				"refresh" => false,
				"type" => "select"
				),
			'expand_content' => array(
				"title" => esc_html__('Expand content', 'greenville'),
				"desc" => wp_kses_data( __('Expand the content width if the sidebar is hidden', 'greenville') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Content', 'greenville')
				),
				"refresh" => false,
				"std" => 1,
				"type" => "checkbox"
				),
			'remove_margins' => array(
				"title" => esc_html__('Remove margins', 'greenville'),
				"desc" => wp_kses_data( __('Remove margins above and below the content area', 'greenville') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Content', 'greenville')
				),
				"refresh" => false,
				"std" => 0,
				"type" => "checkbox"
				),
			'seo_snippets' => array(
				"title" => esc_html__('SEO snippets', 'greenville'),
				"desc" => wp_kses_data( __('Add structured data markup to the single posts and pages', 'greenville') ),
				"std" => 0,
				"type" => "checkbox"
				),
			'privacy_text' => array(
				"title" => esc_html__("Text with Privacy Policy link", 'greenville'),
				"desc"  => wp_kses_data( __("Specify text with Privacy Policy link for the checkbox 'I agree ...'", 'greenville') ),
				"std"   => wp_kses_post( __( 'I agree that my submitted data is being collected and stored.', 'greenville') ),
				"type"  => "text"
			),
			'border_radius' => array(
				"title" => esc_html__('Border radius', 'greenville'),
				"desc" => wp_kses_data( __('Specify the border radius of the form fields and buttons in pixels or other valid CSS units', 'greenville') ),
				"std" => 0,
				"type" => "text"
				),
			'boxed_bg_image' => array(
				"title" => esc_html__('Boxed bg image', 'greenville'),
				"desc" => wp_kses_data( __('Select or upload image, used as background in the boxed body', 'greenville') ),
				"dependency" => array(
					'body_style' => array('boxed')
				),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'greenville')
				),
				"std" => '',
				"type" => "image"
				),
			'no_image' => array(
				"title" => esc_html__('No image placeholder', 'greenville'),
				"desc" => wp_kses_data( __('Select or upload image, used as placeholder for the posts without featured image', 'greenville') ),
				"std" => '',
				"type" => "image"
				),
			'sidebar_widgets' => array(
				"title" => esc_html__('Sidebar widgets', 'greenville'),
				"desc" => wp_kses_data( __('Select default widgets to show in the sidebar', 'greenville') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'greenville')
				),
				"std" => 'sidebar_widgets',
				"options" => array(),
				"type" => "select"
				),
			'sidebar_scheme' => array(
				"title" => esc_html__('Sidebar Color Scheme', 'greenville'),
				"desc" => wp_kses_data( __('Select color scheme to decorate sidebar', 'greenville') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'greenville')
				),
				"std" => 'inherit',
				"options" => array(),
				"refresh" => false,
				"type" => "select"
				),
			'sidebar_position' => array(
				"title" => esc_html__('Sidebar position', 'greenville'),
				"desc" => wp_kses_data( __('Select position to show sidebar', 'greenville') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'greenville')
				),
				"refresh" => false,
				"std" => 'right',
				"options" => array(),
				"type" => "select"
				),
			'hide_sidebar_on_single' => array(
				"title" => esc_html__('Hide sidebar on the single post', 'greenville'),
				"desc" => wp_kses_data( __("Hide sidebar on the single post's pages", 'greenville') ),
				"std" => 0,
				"type" => "checkbox"
				),
			'widgets_above_page' => array(
				"title" => esc_html__('Widgets above the page', 'greenville'),
				"desc" => wp_kses_data( __('Select widgets to show above page (content and sidebar)', 'greenville') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Widgets', 'greenville')
				),
				"std" => 'hide',
				"options" => array(),
				"type" => "select"
				),
			'widgets_above_content' => array(
				"title" => esc_html__('Widgets above the content', 'greenville'),
				"desc" => wp_kses_data( __('Select widgets to show at the beginning of the content area', 'greenville') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Widgets', 'greenville')
				),
				"std" => 'hide',
				"options" => array(),
				"type" => "select"
				),
			'widgets_below_content' => array(
				"title" => esc_html__('Widgets below the content', 'greenville'),
				"desc" => wp_kses_data( __('Select widgets to show at the ending of the content area', 'greenville') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Widgets', 'greenville')
				),
				"std" => 'hide',
				"options" => array(),
				"type" => "select"
				),
			'widgets_below_page' => array(
				"title" => esc_html__('Widgets below the page', 'greenville'),
				"desc" => wp_kses_data( __('Select widgets to show below the page (content and sidebar)', 'greenville') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Widgets', 'greenville')
				),
				"std" => 'hide',
				"options" => array(),
				"type" => "select"
				),
		
		
		
			// Section 'Footer'
			'footer' => array(
				"title" => esc_html__('Footer', 'greenville'),
				"desc" => wp_kses_data( __('Select set of widgets and columns number for the site footer', 'greenville') )
							. '<br>'
							. wp_kses_data( __('<b>Attention!</b> Some of these options can be overridden in the following sections (Homepage, Blog archive, Shop, Events, etc.) or in the settings of individual pages', 'greenville') ),
				"type" => "section"
				),
			'footer_style' => array(
				"title" => esc_html__('Footer style', 'greenville'),
				"desc" => wp_kses_data( __('Select style to display the site footer', 'greenville') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Footer', 'greenville')
				),
				"std" => 'footer-default',
				"options" => array(),
				"type" => "select"
				),
			'footer_scheme' => array(
				"title" => esc_html__('Footer Color Scheme', 'greenville'),
				"desc" => wp_kses_data( __('Select color scheme to decorate footer area', 'greenville') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'greenville')
				),
				"std" => 'dark',
				"options" => array(),
				"refresh" => false,
				"type" => "select"
				),
			'footer_widgets' => array(
				"title" => esc_html__('Footer widgets', 'greenville'),
				"desc" => wp_kses_data( __('Select set of widgets to show in the footer', 'greenville') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'greenville')
				),
				"dependency" => array(
					'footer_style' => array('footer-default')
				),
				"std" => 'footer_widgets',
				"options" => array(),
				"type" => "select"
				),
			'footer_columns' => array(
				"title" => esc_html__('Footer columns', 'greenville'),
				"desc" => wp_kses_data( __('Select number columns to show widgets in the footer. If 0 - autodetect by the widgets count', 'greenville') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'greenville')
				),
				"dependency" => array(
					'footer_style' => array('footer-default'),
					'footer_widgets' => array('^hide')
				),
				"std" => 3,
				"options" => greenville_get_list_range(0,6),
				"type" => "select"
				),
			'footer_wide' => array(
				"title" => esc_html__('Footer fullwide', 'greenville'),
				"desc" => wp_kses_data( __('Do you want to stretch the footer to the entire window width?', 'greenville') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'greenville')
				),
				"dependency" => array(
					'footer_style' => array('footer-default')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			'logo_in_footer' => array(
				"title" => esc_html__('Show logo', 'greenville'),
				"desc" => wp_kses_data( __('Show logo in the footer', 'greenville') ),
				'refresh' => false,
				"dependency" => array(
					'footer_style' => array('footer-default')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			'logo_footer' => array(
				"title" => esc_html__('Logo for footer', 'greenville'),
				"desc" => wp_kses_data( __('Select or upload site logo to display it in the footer', 'greenville') ),
				"dependency" => array(
					'footer_style' => array('footer-default'),
					'logo_in_footer' => array('1')
				),
				"std" => '',
				"type" => "image"
				),
			'logo_footer_retina' => array(
				"title" => esc_html__('Logo for footer (Retina)', 'greenville'),
				"desc" => wp_kses_data( __('Select or upload logo for the footer area used on Retina displays (if empty - use default logo from the field above)', 'greenville') ),
				"dependency" => array(
					'footer_style' => array('footer-default'),
					'logo_in_footer' => array('1')
				),
				"std" => '',
				"type" => "image"
				),
			'socials_in_footer' => array(
				"title" => esc_html__('Show social icons', 'greenville'),
				"desc" => wp_kses_data( __('Show social icons in the footer (under logo or footer widgets)', 'greenville') ),
				"dependency" => array(
					'footer_style' => array('footer-default')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			'copyright' => array(
				"title" => esc_html__('Copyright', 'greenville'),
				"desc" => wp_kses_data( __('Copyright text in the footer. Use {Y} to insert current year and press "Enter" to create a new line', 'greenville') ),
				"std" => esc_html__('AncoraThemes &copy; {Y}. All rights reserved.', 'greenville'),
				"dependency" => array(
					'footer_style' => array('footer-default')
				),
				"refresh" => false,
				"type" => "textarea"
				),
		
		
		
			// Section 'Homepage' - settings for home page
			'homepage' => array(
				"title" => esc_html__('Homepage', 'greenville'),
				"desc" => wp_kses_data( __('Select blog style and widgets to display on the homepage', 'greenville') ),
				"type" => "section"
				),
			'expand_content_home' => array(
				"title" => esc_html__('Expand content', 'greenville'),
				"desc" => wp_kses_data( __('Expand the content width if the sidebar is hidden on the Homepage', 'greenville') ),
				"refresh" => false,
				"std" => 1,
				"type" => "checkbox"
				),
			'blog_style_home' => array(
				"title" => esc_html__('Blog style', 'greenville'),
				"desc" => wp_kses_data( __('Select posts style for the homepage', 'greenville') ),
				"std" => 'excerpt',
				"options" => array(),
				"type" => "select"
				),
			'first_post_large_home' => array(
				"title" => esc_html__('First post large', 'greenville'),
				"desc" => wp_kses_data( __('Make first post large (with Excerpt layout) on the Classic layout of the Homepage', 'greenville') ),
				"dependency" => array(
					'blog_style_home' => array('classic')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			'header_style_home' => array(
				"title" => esc_html__('Header style', 'greenville'),
				"desc" => wp_kses_data( __('Select style to display the site header on the homepage', 'greenville') ),
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			'header_position_home' => array(
				"title" => esc_html__('Header position', 'greenville'),
				"desc" => wp_kses_data( __('Select position to display the site header on the homepage', 'greenville') ),
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			'header_widgets_home' => array(
				"title" => esc_html__('Header widgets', 'greenville'),
				"desc" => wp_kses_data( __('Select set of widgets to show in the header on the homepage', 'greenville') ),
				"std" => 'header_widgets',
				"options" => array(),
				"type" => "select"
				),
			'sidebar_widgets_home' => array(
				"title" => esc_html__('Sidebar widgets', 'greenville'),
				"desc" => wp_kses_data( __('Select sidebar to show on the homepage', 'greenville') ),
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			'sidebar_position_home' => array(
				"title" => esc_html__('Sidebar position', 'greenville'),
				"desc" => wp_kses_data( __('Select position to show sidebar on the homepage', 'greenville') ),
				"refresh" => false,
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			'widgets_above_page_home' => array(
				"title" => esc_html__('Widgets above the page', 'greenville'),
				"desc" => wp_kses_data( __('Select widgets to show above page (content and sidebar)', 'greenville') ),
				"std" => 'hide',
				"options" => array(),
				"type" => "select"
				),
			'widgets_above_content_home' => array(
				"title" => esc_html__('Widgets above the content', 'greenville'),
				"desc" => wp_kses_data( __('Select widgets to show at the beginning of the content area', 'greenville') ),
				"std" => 'hide',
				"options" => array(),
				"type" => "select"
				),
			'widgets_below_content_home' => array(
				"title" => esc_html__('Widgets below the content', 'greenville'),
				"desc" => wp_kses_data( __('Select widgets to show at the ending of the content area', 'greenville') ),
				"std" => 'hide',
				"options" => array(),
				"type" => "select"
				),
			'widgets_below_page_home' => array(
				"title" => esc_html__('Widgets below the page', 'greenville'),
				"desc" => wp_kses_data( __('Select widgets to show below the page (content and sidebar)', 'greenville') ),
				"std" => 'hide',
				"options" => array(),
				"type" => "select"
				),
			
		
		
			// Section 'Blog archive'
			'blog' => array(
				"title" => esc_html__('Blog archive', 'greenville'),
				"desc" => wp_kses_data( __('Options for the blog archive', 'greenville') ),
				"type" => "section",
				),
			'expand_content_blog' => array(
				"title" => esc_html__('Expand content', 'greenville'),
				"desc" => wp_kses_data( __('Expand the content width if the sidebar is hidden on the blog archive', 'greenville') ),
				"refresh" => false,
				"std" => 1,
				"type" => "checkbox"
				),
			'blog_style' => array(
				"title" => esc_html__('Blog style', 'greenville'),
				"desc" => wp_kses_data( __('Select posts style for the blog archive', 'greenville') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'greenville')
				),
				"dependency" => array(
					'#page_template' => array( 'blog.php' ),
					'.editor-page-attributes__template select' => array( 'blog.php' ),
				),
				"std" => 'excerpt',
				"options" => array(),
				"type" => "select"
				),
			'blog_columns' => array(
				"title" => esc_html__('Blog columns', 'greenville'),
				"desc" => wp_kses_data( __('How many columns should be used in the blog archive (from 2 to 4)?', 'greenville') ),
				"std" => 2,
				"options" => greenville_get_list_range(2,4),
				"type" => "hidden"
				),
			'post_type' => array(
				"title" => esc_html__('Post type', 'greenville'),
				"desc" => wp_kses_data( __('Select post type to show in the blog archive', 'greenville') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'greenville')
				),
				"dependency" => array(
					'#page_template' => array( 'blog.php' ),
					'.editor-page-attributes__template select' => array( 'blog.php' ),
				),
				"linked" => 'parent_cat',
				"refresh" => false,
				"hidden" => true,
				"std" => 'post',
				"options" => array(),
				"type" => "select"
				),
			'parent_cat' => array(
				"title" => esc_html__('Category to show', 'greenville'),
				"desc" => wp_kses_data( __('Select category to show in the blog archive', 'greenville') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'greenville')
				),
				"dependency" => array(
					'#page_template' => array( 'blog.php' ),
					'.editor-page-attributes__template select' => array( 'blog.php' ),
				),
				"refresh" => false,
				"hidden" => true,
				"std" => '0',
				"options" => array(),
				"type" => "select"
				),
			'posts_per_page' => array(
				"title" => esc_html__('Posts per page', 'greenville'),
				"desc" => wp_kses_data( __('How many posts will be displayed on this page', 'greenville') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'greenville')
				),
				"dependency" => array(
					'#page_template' => array( 'blog.php' ),
					'.editor-page-attributes__template select' => array( 'blog.php' ),
				),
				"hidden" => true,
				"std" => '10',
				"type" => "text"
				),
			"blog_pagination" => array( 
				"title" => esc_html__('Pagination style', 'greenville'),
				"desc" => wp_kses_data( __('Show Older/Newest posts or Page numbers below the posts list', 'greenville') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'greenville')
				),
				"std" => "pages",
				"options" => array(
					'pages'	=> esc_html__("Page numbers", 'greenville'),
					'links'	=> esc_html__("Older/Newest", 'greenville'),
					'more'	=> esc_html__("Load more", 'greenville'),
					'infinite' => esc_html__("Infinite scroll", 'greenville')
				),
				"type" => "select"
				),
			'show_filters' => array(
				"title" => esc_html__('Show filters', 'greenville'),
				"desc" => wp_kses_data( __('Show categories as tabs to filter posts', 'greenville') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'greenville')
				),
				"dependency" => array(
					'#page_template' => array( 'blog.php' ),
					'.editor-page-attributes__template select' => array( 'blog.php' ),
					'blog_style' => array('portfolio', 'gallery')
				),
				"hidden" => true,
				"std" => 0,
				"type" => "checkbox"
				),
			'first_post_large' => array(
				"title" => esc_html__('First post large', 'greenville'),
				"desc" => wp_kses_data( __('Make first post large (with Excerpt layout) on the Classic layout of blog archive', 'greenville') ),
				"dependency" => array(
					'blog_style' => array('classic')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			"blog_content" => array( 
				"title" => esc_html__('Posts content', 'greenville'),
				"desc" => wp_kses_data( __("Show full post's content in the blog or only post's excerpt", 'greenville') ),
				"std" => "excerpt",
				"options" => array(
					'excerpt'	=> esc_html__('Excerpt',	'greenville'),
					'fullpost'	=> esc_html__('Full post',	'greenville')
				),
				"type" => "select"
				),
			'time_diff_before' => array(
				"title" => esc_html__('Time difference', 'greenville'),
				"desc" => wp_kses_data( __("How many days show time difference instead post's date", 'greenville') ),
				"std" => 0,
				"type" => "text"
				),
			'related_posts' => array(
				"title" => esc_html__('Related posts', 'greenville'),
				"desc" => wp_kses_data( __('How many related posts should be displayed in the single post?', 'greenville') ),
				"std" => 2,
				"options" => greenville_get_list_range(2,4),
				"type" => "select"
				),
			'related_style' => array(
				"title" => esc_html__('Related posts style', 'greenville'),
				"desc" => wp_kses_data( __('Select style of the related posts output', 'greenville') ),
				"std" => 2,
				"options" => greenville_get_list_styles(1,2),
				"type" => "select"
				),
			"blog_animation" => array( 
				"title" => esc_html__('Animation for the posts', 'greenville'),
				"desc" => wp_kses_data( __('Select animation to show posts in the blog. Attention! Do not use any animation on pages with the "wheel to the anchor" behaviour (like a "Chess 2 columns")!', 'greenville') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'greenville')
				),
				"dependency" => array(
					'#page_template' => array( 'blog.php' ),
					'.editor-page-attributes__template select' => array( 'blog.php' ),
				),
				"std" => "none",
				"options" => array(),
				"type" => "select"
				),
			'header_style_blog' => array(
				"title" => esc_html__('Header style', 'greenville'),
				"desc" => wp_kses_data( __('Select style to display the site header on the blog archive', 'greenville') ),
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			'header_position_blog' => array(
				"title" => esc_html__('Header position', 'greenville'),
				"desc" => wp_kses_data( __('Select position to display the site header on the blog archive', 'greenville') ),
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			'header_widgets_blog' => array(
				"title" => esc_html__('Header widgets', 'greenville'),
				"desc" => wp_kses_data( __('Select set of widgets to show in the header on the blog archive', 'greenville') ),
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			'sidebar_widgets_blog' => array(
				"title" => esc_html__('Sidebar widgets', 'greenville'),
				"desc" => wp_kses_data( __('Select sidebar to show on the blog archive', 'greenville') ),
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			'sidebar_position_blog' => array(
				"title" => esc_html__('Sidebar position', 'greenville'),
				"desc" => wp_kses_data( __('Select position to show sidebar on the blog archive', 'greenville') ),
				"refresh" => false,
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			'hide_sidebar_on_single_blog' => array(
				"title" => esc_html__('Hide sidebar on the single post', 'greenville'),
				"desc" => wp_kses_data( __("Hide sidebar on the single post", 'greenville') ),
				"std" => 0,
				"type" => "checkbox"
				),
			'widgets_above_page_blog' => array(
				"title" => esc_html__('Widgets above the page', 'greenville'),
				"desc" => wp_kses_data( __('Select widgets to show above page (content and sidebar)', 'greenville') ),
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			'widgets_above_content_blog' => array(
				"title" => esc_html__('Widgets above the content', 'greenville'),
				"desc" => wp_kses_data( __('Select widgets to show at the beginning of the content area', 'greenville') ),
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			'widgets_below_content_blog' => array(
				"title" => esc_html__('Widgets below the content', 'greenville'),
				"desc" => wp_kses_data( __('Select widgets to show at the ending of the content area', 'greenville') ),
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			'widgets_below_page_blog' => array(
				"title" => esc_html__('Widgets below the page', 'greenville'),
				"desc" => wp_kses_data( __('Select widgets to show below the page (content and sidebar)', 'greenville') ),
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			
		
		
		
			// Section 'Colors' - choose color scheme and customize separate colors from it
			'scheme' => array(
				"title" => esc_html__('* Color scheme editor', 'greenville'),
				"desc" => wp_kses_data( __("<b>Simple settings</b> - you can change only accented color, used for links, buttons and some accented areas.", 'greenville') )
						. '<br>'
						. wp_kses_data( __("<b>Advanced settings</b> - change all scheme's colors and get full control over the appearance of your site!", 'greenville') ),
				"priority" => 1000,
				"type" => "section"
				),
		
			'color_settings' => array(
				"title" => esc_html__('Color settings', 'greenville'),
				"desc" => '',
				"std" => 'simple',
				"options" => array(
					"simple"  => esc_html__("Simple", 'greenville'),
					"advanced" => esc_html__("Advanced", 'greenville')
				),
				"refresh" => false,
				"type" => "switch"
				),
		
			'color_scheme_editor' => array(
				"title" => esc_html__('Color Scheme', 'greenville'),
				"desc" => wp_kses_data( __('Select color scheme to edit colors', 'greenville') ),
				"std" => 'default',
				"options" => array(),
				"refresh" => false,
				"type" => "select"
				),
		
			'scheme_storage' => array(
				"title" => esc_html__('Colors storage', 'greenville'),
				"desc" => esc_html__('Hidden storage of the all color from the all color shemes (only for internal usage)', 'greenville'),
				"std" => '',
				"refresh" => false,
				"type" => "hidden"
				),
		
			'scheme_info_single' => array(
				"title" => esc_html__('Colors for single post/page', 'greenville'),
				"desc" => wp_kses_data( __('Specify colors for single post/page (not for alter blocks)', 'greenville') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"type" => "info"
				),
				
			'bg_color' => array(
				"title" => esc_html__('Background color', 'greenville'),
				"desc" => wp_kses_data( __('Background color of the whole page', 'greenville') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$greenville_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'bd_color' => array(
				"title" => esc_html__('Border color', 'greenville'),
				"desc" => wp_kses_data( __('Color of the bordered elements, separators, etc.', 'greenville') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$greenville_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
		
			'text' => array(
				"title" => esc_html__('Text', 'greenville'),
				"desc" => wp_kses_data( __('Plain text color on single page/post', 'greenville') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$greenville_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'text_light' => array(
				"title" => esc_html__('Light text', 'greenville'),
				"desc" => wp_kses_data( __('Color of the post meta: post date and author, comments number, etc.', 'greenville') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$greenville_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'text_dark' => array(
				"title" => esc_html__('Dark text', 'greenville'),
				"desc" => wp_kses_data( __('Color of the headers, strong text, etc.', 'greenville') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$greenville_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'text_link' => array(
				"title" => esc_html__('Links', 'greenville'),
				"desc" => wp_kses_data( __('Color of links and accented areas', 'greenville') ),
				"std" => '$greenville_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'text_hover' => array(
				"title" => esc_html__('Links hover', 'greenville'),
				"desc" => wp_kses_data( __('Hover color for links and accented areas', 'greenville') ),
				"std" => '$greenville_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
		
			'scheme_info_alter' => array(
				"title" => esc_html__('Colors for alternative blocks', 'greenville'),
				"desc" => wp_kses_data( __('Specify colors for alternative blocks - rectangular blocks with its own background color (posts in homepage, blog archive, search results, widgets on sidebar, footer, etc.)', 'greenville') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"type" => "info"
				),
		
			'alter_bg_color' => array(
				"title" => esc_html__('Alter background color', 'greenville'),
				"desc" => wp_kses_data( __('Background color of the alternative blocks', 'greenville') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$greenville_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'alter_bg_hover' => array(
				"title" => esc_html__('Alter hovered background color', 'greenville'),
				"desc" => wp_kses_data( __('Background color for the hovered state of the alternative blocks', 'greenville') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$greenville_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'alter_bd_color' => array(
				"title" => esc_html__('Alternative border color', 'greenville'),
				"desc" => wp_kses_data( __('Border color of the alternative blocks', 'greenville') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$greenville_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'alter_bd_hover' => array(
				"title" => esc_html__('Alternative hovered border color', 'greenville'),
				"desc" => wp_kses_data( __('Border color for the hovered state of the alter blocks', 'greenville') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$greenville_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'alter_text' => array(
				"title" => esc_html__('Alter text', 'greenville'),
				"desc" => wp_kses_data( __('Text color of the alternative blocks', 'greenville') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$greenville_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'alter_light' => array(
				"title" => esc_html__('Alter light', 'greenville'),
				"desc" => wp_kses_data( __('Color of the info blocks inside block with alternative background', 'greenville') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$greenville_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'alter_dark' => array(
				"title" => esc_html__('Alter dark', 'greenville'),
				"desc" => wp_kses_data( __('Color of the headers inside block with alternative background', 'greenville') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$greenville_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'alter_link' => array(
				"title" => esc_html__('Alter link', 'greenville'),
				"desc" => wp_kses_data( __('Color of the links inside block with alternative background', 'greenville') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$greenville_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'alter_hover' => array(
				"title" => esc_html__('Alter hover', 'greenville'),
				"desc" => wp_kses_data( __('Color of the hovered links inside block with alternative background', 'greenville') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$greenville_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
		
			'scheme_info_input' => array(
				"title" => esc_html__('Colors for the form fields', 'greenville'),
				"desc" => wp_kses_data( __('Specify colors for the form fields and textareas', 'greenville') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"type" => "info"
				),
		
			'input_bg_color' => array(
				"title" => esc_html__('Inactive background', 'greenville'),
				"desc" => wp_kses_data( __('Background color of the inactive form fields', 'greenville') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$greenville_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'input_bg_hover' => array(
				"title" => esc_html__('Active background', 'greenville'),
				"desc" => wp_kses_data( __('Background color of the focused form fields', 'greenville') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$greenville_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'input_bd_color' => array(
				"title" => esc_html__('Inactive border', 'greenville'),
				"desc" => wp_kses_data( __('Color of the border in the inactive form fields', 'greenville') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$greenville_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'input_bd_hover' => array(
				"title" => esc_html__('Active border', 'greenville'),
				"desc" => wp_kses_data( __('Color of the border in the focused form fields', 'greenville') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$greenville_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'input_text' => array(
				"title" => esc_html__('Inactive field', 'greenville'),
				"desc" => wp_kses_data( __('Color of the text in the inactive fields', 'greenville') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$greenville_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'input_light' => array(
				"title" => esc_html__('Disabled field', 'greenville'),
				"desc" => wp_kses_data( __('Color of the disabled field', 'greenville') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$greenville_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'input_dark' => array(
				"title" => esc_html__('Active field', 'greenville'),
				"desc" => wp_kses_data( __('Color of the active field', 'greenville') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$greenville_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
		
			'scheme_info_inverse' => array(
				"title" => esc_html__('Colors for inverse blocks', 'greenville'),
				"desc" => wp_kses_data( __('Specify colors for inverse blocks, rectangular blocks with background color equal to the links color or one of accented colors (if used in the current theme)', 'greenville') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"type" => "info"
				),
		
			'inverse_text' => array(
				"title" => esc_html__('Inverse text', 'greenville'),
				"desc" => wp_kses_data( __('Color of the text inside block with accented background', 'greenville') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$greenville_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'inverse_light' => array(
				"title" => esc_html__('Inverse light', 'greenville'),
				"desc" => wp_kses_data( __('Color of the info blocks inside block with accented background', 'greenville') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$greenville_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'inverse_dark' => array(
				"title" => esc_html__('Inverse dark', 'greenville'),
				"desc" => wp_kses_data( __('Color of the headers inside block with accented background', 'greenville') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$greenville_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'inverse_link' => array(
				"title" => esc_html__('Inverse link', 'greenville'),
				"desc" => wp_kses_data( __('Color of the links inside block with accented background', 'greenville') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$greenville_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'inverse_hover' => array(
				"title" => esc_html__('Inverse hover', 'greenville'),
				"desc" => wp_kses_data( __('Color of the hovered links inside block with accented background', 'greenville') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$greenville_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),


			// Section 'Hidden'
			'media_title' => array(
				"title" => esc_html__('Media title', 'greenville'),
				"desc" => wp_kses_data( __('Used as title for the audio and video item in this post', 'greenville') ),
				"override" => array(
					'mode' => 'post',
					'section' => esc_html__('Title', 'greenville')
				),
				"hidden" => true,
				"std" => '',
				"type" => "text"
				),
			'media_author' => array(
				"title" => esc_html__('Media author', 'greenville'),
				"desc" => wp_kses_data( __('Used as author name for the audio and video item in this post', 'greenville') ),
				"override" => array(
					'mode' => 'post',
					'section' => esc_html__('Title', 'greenville')
				),
				"hidden" => true,
				"std" => '',
				"type" => "text"
				),


			// Internal options.
			// Attention! Don't change any options in the section below!
			'reset_options' => array(
				"title" => '',
				"desc" => '',
				"std" => '0',
				"type" => "hidden",
				),

		));


		// Prepare panel 'Fonts'
		$fonts = array(
		
			// Panel 'Fonts' - manage fonts loading and set parameters of the base theme elements
			'fonts' => array(
				"title" => esc_html__('* Fonts settings', 'greenville'),
				"desc" => '',
				"priority" => 1500,
				"type" => "panel"
				),

			// Section 'Load_fonts'
			'load_fonts' => array(
				"title" => esc_html__('Load fonts', 'greenville'),
				"desc" => wp_kses_data( __('Specify fonts to load when theme start. You can use them in the base theme elements: headers, text, menu, links, input fields, etc.', 'greenville') )
						. '<br>'
						. wp_kses_data( __('<b>Attention!</b> Press "Refresh" button to reload preview area after the all fonts are changed', 'greenville') ),
				"type" => "section"
				),
			'load_fonts_subset' => array(
				"title" => esc_html__('Google fonts subsets', 'greenville'),
				"desc" => wp_kses_data( __('Specify comma separated list of the subsets which will be load from Google fonts', 'greenville') )
						. '<br>'
						. wp_kses_data( __('Available subsets are: latin,latin-ext,cyrillic,cyrillic-ext,greek,greek-ext,vietnamese', 'greenville') ),
				"refresh" => false,
				"std" => '$greenville_get_load_fonts_subset',
				"type" => "text"
				)
		);

		for ($i=1; $i<=greenville_get_theme_setting('max_load_fonts'); $i++) {
			$fonts["load_fonts-{$i}-info"] = array(
				"title" => esc_html(sprintf(__('Font %s', 'greenville'), $i)),
				"desc" => '',
				"type" => "info",
				);
			$fonts["load_fonts-{$i}-name"] = array(
				"title" => esc_html__('Font name', 'greenville'),
				"desc" => '',
				"refresh" => false,
				"std" => '$greenville_get_load_fonts_option',
				"type" => "text"
				);
			$fonts["load_fonts-{$i}-family"] = array(
				"title" => esc_html__('Font family', 'greenville'),
				"desc" => $i==1 
							? wp_kses_data( __('Select font family to use it if font above is not available', 'greenville') )
							: '',
				"refresh" => false,
				"std" => '$greenville_get_load_fonts_option',
				"options" => array(
					'inherit' => esc_html__("Inherit", 'greenville'),
					'serif' => esc_html__('serif', 'greenville'),
					'sans-serif' => esc_html__('sans-serif', 'greenville'),
					'monospace' => esc_html__('monospace', 'greenville'),
					'cursive' => esc_html__('cursive', 'greenville'),
					'fantasy' => esc_html__('fantasy', 'greenville')
				),
				"type" => "select"
				);
			$fonts["load_fonts-{$i}-styles"] = array(
				"title" => esc_html__('Font styles', 'greenville'),
				"desc" => $i==1 
							? wp_kses_data( __('Font styles used only for the Google fonts. This is a comma separated list of the font weight and styles. For example: 400,400italic,700', 'greenville') )
											. '<br>'
								. wp_kses_data( __('<b>Attention!</b> Each weight and style increase download size! Specify only used weights and styles.', 'greenville') )
							: '',
				"refresh" => false,
				"std" => '$greenville_get_load_fonts_option',
				"type" => "text"
				);
		}
		$fonts['load_fonts_end'] = array(
			"type" => "section_end"
			);

		// Sections with font's attributes for each theme element
		$theme_fonts = greenville_get_theme_fonts();
		foreach ($theme_fonts as $tag=>$v) {
			$fonts["{$tag}_section"] = array(
				"title" => !empty($v['title']) 
								? $v['title'] 
								: esc_html(sprintf(__('%s settings', 'greenville'), $tag)),
				"desc" => !empty($v['description']) 
								? $v['description'] 
								: wp_kses_post( sprintf(__('Font settings of the "%s" tag.', 'greenville'), $tag) ),
				"type" => "section",
				);
	
			foreach ($v as $css_prop=>$css_value) {
				if (in_array($css_prop, array('title', 'description'))) continue;
				$options = '';
				$type = 'text';
				$title = ucfirst(str_replace('-', ' ', $css_prop));
				if ($css_prop == 'font-family') {
					$type = 'select';
					$options = array();
				} else if ($css_prop == 'font-weight') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'greenville'),
						'100' => esc_html__('100 (Light)', 'greenville'), 
						'200' => esc_html__('200 (Light)', 'greenville'), 
						'300' => esc_html__('300 (Thin)',  'greenville'),
						'400' => esc_html__('400 (Normal)', 'greenville'),
						'500' => esc_html__('500 (Semibold)', 'greenville'),
						'600' => esc_html__('600 (Semibold)', 'greenville'),
						'700' => esc_html__('700 (Bold)', 'greenville'),
						'800' => esc_html__('800 (Black)', 'greenville'),
						'900' => esc_html__('900 (Black)', 'greenville')
					);
				} else if ($css_prop == 'font-style') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'greenville'),
						'normal' => esc_html__('Normal', 'greenville'), 
						'italic' => esc_html__('Italic', 'greenville')
					);
				} else if ($css_prop == 'text-decoration') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'greenville'),
						'none' => esc_html__('None', 'greenville'), 
						'underline' => esc_html__('Underline', 'greenville'),
						'overline' => esc_html__('Overline', 'greenville'),
						'line-through' => esc_html__('Line-through', 'greenville')
					);
				} else if ($css_prop == 'text-transform') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'greenville'),
						'none' => esc_html__('None', 'greenville'), 
						'uppercase' => esc_html__('Uppercase', 'greenville'),
						'lowercase' => esc_html__('Lowercase', 'greenville'),
						'capitalize' => esc_html__('Capitalize', 'greenville')
					);
				}
				$fonts["{$tag}_{$css_prop}"] = array(
					"title" => $title,
					"desc" => '',
					"refresh" => false,
					"std" => '$greenville_get_theme_fonts_option',
					"options" => $options,
					"type" => $type
				);
			}
			
			$fonts["{$tag}_section_end"] = array(
				"type" => "section_end"
				);
		}

		$fonts['fonts_end'] = array(
			"type" => "panel_end"
			);

		// Add fonts parameters into Theme Options
		greenville_storage_merge_array('options', '', $fonts);

		// Add Header Video if WP version < 4.7
		if (!function_exists('get_header_video_url')) {
			greenville_storage_set_array_after('options', 'header_image_override', 'header_video', array(
				"title" => esc_html__('Header video', 'greenville'),
				"desc" => wp_kses_data( __("Select video to use it as background for the header", 'greenville') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'greenville')
				),
				"std" => '',
				"type" => "video"
				)
			);
		}
	}
}


// Return lists with choises when its need in the admin mode
if (!function_exists('greenville_options_get_list_choises')) {
	add_filter('greenville_filter_options_get_list_choises', 'greenville_options_get_list_choises', 10, 2);
	function greenville_options_get_list_choises($list, $id) {
		if (is_array($list) && count($list)==0) {
			if (strpos($id, 'header_style')===0)
				$list = greenville_get_list_header_styles(strpos($id, 'header_style_')===0);
			else if (strpos($id, 'header_position')===0)
				$list = greenville_get_list_header_positions(strpos($id, 'header_position_')===0);
			else if (strpos($id, 'header_widgets')===0)
				$list = greenville_get_list_sidebars(strpos($id, 'header_widgets_')===0, true);
			else if (strpos($id, 'header_scheme')===0 
					|| strpos($id, 'menu_scheme')===0
					|| strpos($id, 'color_scheme')===0
					|| strpos($id, 'sidebar_scheme')===0
					|| strpos($id, 'footer_scheme')===0)
				$list = greenville_get_list_schemes(true);
			else if (strpos($id, 'sidebar_widgets')===0)
				$list = greenville_get_list_sidebars(strpos($id, 'sidebar_widgets_')===0, true);
			else if (strpos($id, 'sidebar_position')===0)
				$list = greenville_get_list_sidebars_positions(strpos($id, 'sidebar_position_')===0);
			else if (strpos($id, 'widgets_above_page')===0)
				$list = greenville_get_list_sidebars(strpos($id, 'widgets_above_page_')===0, true);
			else if (strpos($id, 'widgets_above_content')===0)
				$list = greenville_get_list_sidebars(strpos($id, 'widgets_above_content_')===0, true);
			else if (strpos($id, 'widgets_below_page')===0)
				$list = greenville_get_list_sidebars(strpos($id, 'widgets_below_page_')===0, true);
			else if (strpos($id, 'widgets_below_content')===0)
				$list = greenville_get_list_sidebars(strpos($id, 'widgets_below_content_')===0, true);
			else if (strpos($id, 'footer_style')===0)
				$list = greenville_get_list_footer_styles(strpos($id, 'footer_style_')===0);
			else if (strpos($id, 'footer_widgets')===0)
				$list = greenville_get_list_sidebars(strpos($id, 'footer_widgets_')===0, true);
			else if (strpos($id, 'blog_style')===0)
				$list = greenville_get_list_blog_styles(strpos($id, 'blog_style_')===0);
			else if (strpos($id, 'post_type')===0)
				$list = greenville_get_list_posts_types();
			else if (strpos($id, 'parent_cat')===0)
				$list = greenville_array_merge(array(0 => esc_html__('- Select category -', 'greenville')), greenville_get_list_categories());
			else if (strpos($id, 'blog_animation')===0)
				$list = greenville_get_list_animations_in();
			else if ($id == 'color_scheme_editor')
				$list = greenville_get_list_schemes();
			else if (strpos($id, '_font-family') > 0)
				$list = greenville_get_list_load_fonts(true);
		}
		return $list;
	}
}




// -----------------------------------------------------------------
// -- Create and manage Theme Options
// -----------------------------------------------------------------

// Theme init priorities:
// 2 - create Theme Options
if (!function_exists('greenville_options_theme_setup2')) {
	add_action( 'after_setup_theme', 'greenville_options_theme_setup2', 2 );
	function greenville_options_theme_setup2() {
		greenville_options_create();
	}
}

// Step 1: Load default settings and previously saved mods
if (!function_exists('greenville_options_theme_setup5')) {
	add_action( 'after_setup_theme', 'greenville_options_theme_setup5', 5 );
	function greenville_options_theme_setup5() {
		greenville_storage_set('options_reloaded', false);
		greenville_load_theme_options();
	}
}

// Step 2: Load current theme customization mods
if (is_customize_preview()) {
	if (!function_exists('greenville_load_custom_options')) {
		add_action( 'wp_loaded', 'greenville_load_custom_options' );
		function greenville_load_custom_options() {
			if (!greenville_storage_get('options_reloaded')) {
				greenville_storage_set('options_reloaded', true);
				greenville_load_theme_options();
			}
		}
	}
}

// Load current values for each customizable option
if ( !function_exists('greenville_load_theme_options') ) {
	function greenville_load_theme_options() {
		$options = greenville_storage_get('options');
		$reset = (int) get_theme_mod('reset_options', 0);
		foreach ($options as $k=>$v) {
			if (isset($v['std'])) {
				if (strpos($v['std'], '$greenville_')!==false) {
					$func = substr($v['std'], 1);
					if (function_exists($func)) {
						$v['std'] = $func($k);
					}
				}
				$value = $v['std'];
				if (!$reset) {
					if (isset($_GET[$k]))
						$value = $_GET[$k];
					else {
						$tmp = get_theme_mod($k, -987654321);
						if ($tmp != -987654321) $value = $tmp;
					}
				}
				greenville_storage_set_array2('options', $k, 'val', $value);
				if ($reset) remove_theme_mod($k);
			}
		}
		if ($reset) {
			// Unset reset flag
			set_theme_mod('reset_options', 0);
			// Regenerate CSS with default colors and fonts
			greenville_customizer_save_css();
		} else {
			do_action('greenville_action_load_options');
		}
	}
}

// Override options with stored page/post meta
if ( !function_exists('greenville_override_theme_options') ) {
	add_action( 'wp', 'greenville_override_theme_options', 1 );
	function greenville_override_theme_options($query=null) {
		if (is_page_template('blog.php')) {
			greenville_storage_set('blog_archive', true);
			greenville_storage_set('blog_template', get_the_ID());
		}
		greenville_storage_set('blog_mode', greenville_detect_blog_mode());
		if (is_singular()) {
			greenville_storage_set('options_meta', get_post_meta(get_the_ID(), 'greenville_options', true));
		}
	}
}


// Return customizable option value
if (!function_exists('greenville_get_theme_option')) {
	function greenville_get_theme_option($name, $defa='', $strict_mode=false, $post_id=0) {
		$rez = $defa;
		$from_post_meta = false;
		if ($post_id > 0) {
			if (!greenville_storage_isset('post_options_meta', $post_id))
				greenville_storage_set_array('post_options_meta', $post_id, get_post_meta($post_id, 'greenville_options', true));
			if (greenville_storage_isset('post_options_meta', $post_id, $name)) {
				$tmp = greenville_storage_get_array('post_options_meta', $post_id, $name);
				if (!greenville_is_inherit($tmp)) {
					$rez = $tmp;
					$from_post_meta = true;
				}
			}
		}
		if (!$from_post_meta && greenville_storage_isset('options')) {
			if ( !greenville_storage_isset('options', $name) ) {
				$rez = $tmp = '_not_exists_';
				if (function_exists('trx_addons_get_option'))
					$rez = trx_addons_get_option($name, $tmp, false);
				if ($rez === $tmp) {
					if ($strict_mode) {
						$s = debug_backtrace();
						//array_shift($s);
						$s = array_shift($s);
						echo '<pre>' . sprintf(esc_html__('Undefined option "%s" called from:', 'greenville'), $name);
						if (function_exists('dco')) dco($s);
						else print_r($s);
						echo '</pre>';
						die();
					} else
						$rez = $defa;
				}
			} else {
				$blog_mode = greenville_storage_get('blog_mode');
				// Override option from GET or POST for current blog mode
				if (!empty($blog_mode) && isset($_REQUEST[$name . '_' . $blog_mode])) {
					$rez = $_REQUEST[$name . '_' . $blog_mode];
				// Override option from GET
				} else if (isset($_REQUEST[$name])) {
					$rez = $_REQUEST[$name];
				// Override option from current page settings (if exists)
				} else if (greenville_storage_isset('options_meta', $name) && !greenville_is_inherit(greenville_storage_get_array('options_meta', $name))) {
					$rez = greenville_storage_get_array('options_meta', $name);
				// Override option from current blog mode settings: 'home', 'search', 'page', 'post', 'blog', etc. (if exists)
				} else if (!empty($blog_mode) && greenville_storage_isset('options', $name . '_' . $blog_mode, 'val') && !greenville_is_inherit(greenville_storage_get_array('options', $name . '_' . $blog_mode, 'val'))) {
					$rez = greenville_storage_get_array('options', $name . '_' . $blog_mode, 'val');
				// Get saved option value
				} else if (greenville_storage_isset('options', $name, 'val')) {
					$rez = greenville_storage_get_array('options', $name, 'val');
				// Get ThemeREX Addons option value
				} else if (function_exists('trx_addons_get_option')) {
					$rez = trx_addons_get_option($name, $defa, false);
				}
			}
		}
		return $rez;
	}
}


// Check if customizable option exists
if (!function_exists('greenville_check_theme_option')) {
	function greenville_check_theme_option($name) {
		return greenville_storage_isset('options', $name);
	}
}


// Get dependencies list from the Theme Options
if ( !function_exists('greenville_get_theme_dependencies') ) {
	function greenville_get_theme_dependencies() {
		$options = greenville_storage_get('options');
		$depends = array();
		foreach ($options as $k=>$v) {
			if (isset($v['dependency'])) 
				$depends[$k] = $v['dependency'];
		}
		return $depends;
	}
}

// Return internal theme setting value
if (!function_exists('greenville_get_theme_setting')) {
	function greenville_get_theme_setting($name) {
		return greenville_storage_isset('settings', $name) ? greenville_storage_get_array('settings', $name) : false;
	}
}

// Set theme setting
if ( !function_exists( 'greenville_set_theme_setting' ) ) {
	function greenville_set_theme_setting($option_name, $value) {
		if (greenville_storage_isset('settings', $option_name))
			greenville_storage_set_array('settings', $option_name, $value);
	}
}
?>