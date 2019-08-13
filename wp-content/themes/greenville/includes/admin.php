<?php
/**
 * Admin utilities
 *
 * @package WordPress
 * @subpackage GREENVILLE
 * @since GREENVILLE 1.0.1
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }


//-------------------------------------------------------
//-- Theme init
//-------------------------------------------------------

// Theme init priorities:
// 1 - register filters to add/remove lists items in the Theme Options
// 2 - create Theme Options
// 3 - add/remove Theme Options elements
// 5 - load Theme Options
// 9 - register other filters (for installer, etc.)
//10 - standard Theme init procedures (not ordered)

if ( !function_exists('greenville_admin_theme_setup') ) {
	add_action( 'after_setup_theme', 'greenville_admin_theme_setup' );
	function greenville_admin_theme_setup() {
		// Add theme icons
		add_action('admin_footer',	 						'greenville_admin_footer');

		// Enqueue scripts and styles for admin
		add_action("admin_enqueue_scripts",					'greenville_admin_scripts');
		add_action("admin_footer",							'greenville_admin_localize_scripts');
		
		// Show admin notice
		add_action('admin_notices',							'greenville_admin_notice', 2);
		add_action('wp_ajax_greenville_hide_admin_notice',		'greenville_callback_hide_admin_notice');

		// TGM Activation plugin
		add_action('tgmpa_register',						'greenville_register_plugins');
	}
}

// Show admin notice
if ( !function_exists( 'greenville_admin_notice' ) ) {
	//Handler of the add_action('admin_notices', 'greenville_admin_notice', 2);
	function greenville_admin_notice() {
		if (in_array(greenville_get_value_gp('action'), array('vc_load_template_preview'))) return;
		$opt_name = 'greenville_admin_notice';
		$show = get_option('greenville_admin_notice');
		if ($show !== false && (int) $show == 0) return;
		require_once greenville_get_file_dir( 'templates/admin-notice.php' );
	}
}

// Hide admin notice
if ( !function_exists( 'greenville_callback_hide_admin_notice' ) ) {
	//Handler of the add_action('wp_ajax_greenville_hide_admin_notice', 'greenville_callback_hide_admin_notice');
	function greenville_callback_hide_admin_notice() {
		update_option('greenville_admin_notice', '0');
		exit;
	}
}


//-------------------------------------------------------
//-- Styles and scripts
//-------------------------------------------------------
	
// Load inline styles
if ( !function_exists( 'greenville_admin_footer' ) ) {
	//Handler of the add_action('admin_footer', 'greenville_admin_footer');
	function greenville_admin_footer() {
		// Get current screen
		$screen = function_exists('get_current_screen') ? get_current_screen() : false;
		if (is_object($screen) && $screen->id=='nav-menus') {
			greenville_show_layout(greenville_show_custom_field('greenville_icons_popup',
													array(
														'type'				=> 'icons',
														'button'			=> false,
														'icons'				=> true
													),
													null)
								);
		}
	}
}
	
// Load required styles and scripts for admin mode
if ( !function_exists( 'greenville_admin_scripts' ) ) {
	//Handler of the add_action("admin_enqueue_scripts", 'greenville_admin_scripts');
	function greenville_admin_scripts() {

		// Add theme styles
		wp_enqueue_style(  'greenville-admin',  greenville_get_file_url('css/admin.css') );

		// Links to selected fonts
		$screen = function_exists('get_current_screen') ? get_current_screen() : false;
		if (is_object($screen)) {
			if (greenville_allow_override_options(!empty($screen->post_type) ? $screen->post_type : $screen->id)) {
				// Load fontello icons
				// This style NEED theme prefix, because style 'fontello' some plugin contain different set of characters
				// and can't be used instead this style!
				wp_enqueue_style(  'fontello', greenville_get_file_url('css/fontello/css/fontello-embedded.css') );
				wp_enqueue_style(  'fontello-animation', greenville_get_file_url('css/fontello/css/animation.css') );
				// Load theme fonts
				$links = greenville_theme_fonts_links();
				if (count($links) > 0) {
					foreach ($links as $slug => $link) {
						wp_enqueue_style( sprintf('greenville-font-%s', $slug), $link );
					}
				}
			} else if (apply_filters('greenville_filter_allow_theme_icons', is_customize_preview() || $screen->id=='nav-menus', !empty($screen->post_type) ? $screen->post_type : $screen->id)) {
				// Load fontello icons
				// This style NEED theme prefix, because style 'fontello' some plugin contain different set of characters
				// and can't be used instead this style!
				wp_enqueue_style(  'fontello', greenville_get_file_url('css/fontello/css/fontello-embedded.css') );
			}
		}

		// Add theme scripts
		wp_enqueue_script( 'greenville-utils', greenville_get_file_url('js/_utils.js'), array('jquery'), null, true );
		wp_enqueue_script( 'greenville-admin', greenville_get_file_url('js/_admin.js'), array('jquery'), null, true );
	}
}
	
// Add variables in the admin mode
if ( !function_exists( 'greenville_admin_localize_scripts' ) ) {
	//Handler of the add_action("admin_footer", 'greenville_admin_localize_scripts');
	function greenville_admin_localize_scripts() {
		$screen = function_exists('get_current_screen') ? get_current_screen() : false;
		wp_localize_script( 'greenville-admin', 'GREENVILLE_STORAGE', apply_filters( 'greenville_filter_localize_script_admin', array(
			'admin_mode' => true,
			'screen_id' => is_object($screen) ? esc_attr($screen->id) : '',
			'ajax_url' => esc_url(admin_url('admin-ajax.php')),
			'ajax_nonce' => esc_attr(wp_create_nonce(admin_url('admin-ajax.php'))),
			'ajax_error_msg' => esc_html__('Server response error', 'greenville'),
			'icon_selector_msg' => esc_html__('Select the icon for this menu item', 'greenville'),
			'user_logged_in' => true
			))
		);
	}
}



//-------------------------------------------------------
//-- Third party plugins
//-------------------------------------------------------

// Register optional plugins
if ( !function_exists( 'greenville_register_plugins' ) ) {
	function greenville_register_plugins() {
		tgmpa(	apply_filters('greenville_filter_tgmpa_required_plugins', array(
				// Plugins to include in the autoinstall queue.
				)),
				array(
					'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
					'default_path' => '',                      // Default absolute path to bundled plugins.
					'menu'         => 'tgmpa-install-plugins', // Menu slug.
					'parent_slug'  => 'themes.php',            // Parent menu slug.
					'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
					'has_notices'  => true,                    // Show admin notices or not.
					'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
					'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
					'is_automatic' => true,                    // Automatically activate plugins after installation or not.
					'message'      => ''                       // Message to output right before the plugins table.
				)
			);
	}
}
?>