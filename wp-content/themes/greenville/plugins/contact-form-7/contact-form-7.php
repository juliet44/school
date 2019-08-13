<?php
/* Contact Form 7 support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('greenville_cf7_theme_setup9')) {
	add_action( 'after_setup_theme', 'greenville_cf7_theme_setup9', 9 );
	function greenville_cf7_theme_setup9() {
		
		if (greenville_exists_cf7()) {
			add_action( 'wp_enqueue_scripts', 								'greenville_cf7_frontend_scripts', 1100 );
			add_filter( 'greenville_filter_merge_styles',						'greenville_cf7_merge_styles' );
		}
		if (is_admin()) {
			add_filter( 'greenville_filter_tgmpa_required_plugins',			'greenville_cf7_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'greenville_cf7_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('greenville_filter_tgmpa_required_plugins',	'greenville_cf7_tgmpa_required_plugins');
	function greenville_cf7_tgmpa_required_plugins($list=array()) {
		if (in_array('contact-form-7', greenville_storage_get('required_plugins'))) {
			// CF7 plugin
			$list[] = array(
					'name' 		=> esc_html__('Contact Form 7', 'greenville'),
					'slug' 		=> 'contact-form-7',
					'required' 	=> false
			);
			$path = greenville_get_file_dir('plugins/contact-form-7/contact-form-7-datepicker.zip');
			if ($path != '')
				$params['source'] = $path;
			$list[] = $params;
		}
		return $list;
	}
}



// Check if cf7 installed and activated
if ( !function_exists( 'greenville_exists_cf7' ) ) {
	function greenville_exists_cf7() {
		return class_exists('WPCF7');
	}
}
	
// Enqueue custom styles
if ( !function_exists( 'greenville_cf7_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'greenville_cf7_frontend_scripts', 1100 );
	function greenville_cf7_frontend_scripts() {
		if (greenville_is_on(greenville_get_theme_option('debug_mode')) && greenville_get_file_dir('plugins/contact-form-7/contact-form-7.css')!='')
			wp_enqueue_style( 'contact-form-7',  greenville_get_file_url('plugins/contact-form-7/contact-form-7.css'), array(), null );
	}
}
	
// Merge custom styles
if ( !function_exists( 'greenville_cf7_merge_styles' ) ) {
	//Handler of the add_filter('greenville_filter_merge_styles', 'greenville_cf7_merge_styles');
	function greenville_cf7_merge_styles($list) {
		$list[] = 'plugins/contact-form-7/contact-form-7.css';
		return $list;
	}
}
?>