<?php
/* Calculate Fields Form support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('greenville_calculated_fields_form_theme_setup9')) {
	add_action( 'after_setup_theme', 'greenville_calculated_fields_form_theme_setup9', 9 );
	function greenville_calculated_fields_form_theme_setup9() {
		if (greenville_exists_calculated_fields_form()) {
			add_action( 'wp_enqueue_scripts', 							'greenville_calculated_fields_form_frontend_scripts', 1100 );
			add_filter( 'greenville_filter_merge_styles',					'greenville_calculated_fields_form_merge_styles' );
		}
		if (is_admin()) {
			add_filter( 'greenville_filter_tgmpa_required_plugins',		'greenville_calculated_fields_form_tgmpa_required_plugins' );
		}
	}
}

// Check if plugin installed and activated
if ( !function_exists( 'greenville_exists_calculated_fields_form' ) ) {
	function greenville_exists_calculated_fields_form() {
		return class_exists('CP_SESSION');
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'greenville_calculated_fields_form_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('greenville_filter_tgmpa_required_plugins',	'greenville_calculated_fields_form_tgmpa_required_plugins');
	function greenville_calculated_fields_form_tgmpa_required_plugins($list=array()) {
		if (in_array('calculated-fields-form', greenville_storage_get('required_plugins'))) {
			$list[] = array(
					'name' 		=> esc_html__('Calculated Fields Form', 'greenville'),
					'slug' 		=> 'calculated-fields-form',
					'required' 	=> false
			);
		}
		return $list;
	}
}
	
// Enqueue plugin's custom styles
if ( !function_exists( 'greenville_calculated_fields_form_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'greenville_calculated_fields_form_frontend_scripts', 1100 );
	function greenville_calculated_fields_form_frontend_scripts() {
		// Remove jquery_ui from frontend
		if (greenville_get_theme_setting('disable_jquery_ui')) {
			global $wp_styles;
			$wp_styles->done[] = 'cpcff_jquery_ui';
		}
		if (greenville_is_on(greenville_get_theme_option('debug_mode')) && greenville_get_file_dir('plugins/calculated-fields-form/calculated-fields-form.css')!='')
			wp_enqueue_style( 'calculated-fields-form',  greenville_get_file_url('plugins/calculated-fields-form/calculated-fields-form.css'), array(), null );
	}
}
	
// Merge custom styles
if ( !function_exists( 'greenville_calculated_fields_form_merge_styles' ) ) {
	//Handler of the add_filter('greenville_filter_merge_styles', 'greenville_calculated_fields_form_merge_styles');
	function greenville_calculated_fields_form_merge_styles($list) {
		$list[] = 'plugins/calculated-fields-form/calculated-fields-form.css';
		return $list;
	}
}
?>