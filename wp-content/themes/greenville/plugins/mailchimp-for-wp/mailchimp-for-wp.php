<?php
/* Mail Chimp support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('greenville_mailchimp_theme_setup9')) {
	add_action( 'after_setup_theme', 'greenville_mailchimp_theme_setup9', 9 );
	function greenville_mailchimp_theme_setup9() {
		if (greenville_exists_mailchimp()) {
			add_action( 'wp_enqueue_scripts',							'greenville_mailchimp_frontend_scripts', 1100 );
			add_filter( 'greenville_filter_merge_styles',					'greenville_mailchimp_merge_styles');
		}
		if (is_admin()) {
			add_filter( 'greenville_filter_tgmpa_required_plugins',		'greenville_mailchimp_tgmpa_required_plugins' );
		}
	}
}

// Check if plugin installed and activated
if ( !function_exists( 'greenville_exists_mailchimp' ) ) {
	function greenville_exists_mailchimp() {
		return function_exists('__mc4wp_load_plugin') || defined('MC4WP_VERSION');
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'greenville_mailchimp_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('greenville_filter_tgmpa_required_plugins',	'greenville_mailchimp_tgmpa_required_plugins');
	function greenville_mailchimp_tgmpa_required_plugins($list=array()) {
		if (in_array('mailchimp-for-wp', greenville_storage_get('required_plugins')))
			$list[] = array(
				'name' 		=> esc_html__('MailChimp for WP', 'greenville'),
				'slug' 		=> 'mailchimp-for-wp',
				'required' 	=> false
			);
		return $list;
	}
}



// Custom styles and scripts
//------------------------------------------------------------------------

// Enqueue custom styles
if ( !function_exists( 'greenville_mailchimp_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'greenville_mailchimp_frontend_scripts', 1100 );
	function greenville_mailchimp_frontend_scripts() {
		if (greenville_exists_mailchimp()) {
			if (greenville_is_on(greenville_get_theme_option('debug_mode')) && greenville_get_file_dir('plugins/mailchimp-for-wp/mailchimp-for-wp.css')!='')
				wp_enqueue_style( 'mailchimp-for-wp',  greenville_get_file_url('plugins/mailchimp-for-wp/mailchimp-for-wp.css'), array(), null );
		}
	}
}
	
// Merge custom styles
if ( !function_exists( 'greenville_mailchimp_merge_styles' ) ) {
	//Handler of the add_filter( 'greenville_filter_merge_styles', 'greenville_mailchimp_merge_styles');
	function greenville_mailchimp_merge_styles($list) {
		$list[] = 'plugins/mailchimp-for-wp/mailchimp-for-wp.css';
		return $list;
	}
}


// Add plugin-specific colors and fonts to the custom CSS
if (greenville_exists_mailchimp()) { require_once GREENVILLE_THEME_DIR . 'plugins/mailchimp-for-wp/mailchimp-for-wp.styles.php'; }
?>