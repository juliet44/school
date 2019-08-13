<?php
/* Essential Grid support functions
------------------------------------------------------------------------------- */


// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('greenville_essential_grid_theme_setup9')) {
	add_action( 'after_setup_theme', 'greenville_essential_grid_theme_setup9', 9 );
	function greenville_essential_grid_theme_setup9() {
		if (greenville_exists_essential_grid()) {
			add_action( 'wp_enqueue_scripts', 							'greenville_essential_grid_frontend_scripts', 1100 );
			add_filter( 'greenville_filter_merge_styles',					'greenville_essential_grid_merge_styles' );
		}
		if (is_admin()) {
			add_filter( 'greenville_filter_tgmpa_required_plugins',		'greenville_essential_grid_tgmpa_required_plugins' );
		}
	}
}

// Check if plugin installed and activated
if ( !function_exists( 'greenville_exists_essential_grid' ) ) {
	function greenville_exists_essential_grid() {
		return defined('EG_PLUGIN_PATH');
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'greenville_essential_grid_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('greenville_filter_tgmpa_required_plugins',	'greenville_essential_grid_tgmpa_required_plugins');
	function greenville_essential_grid_tgmpa_required_plugins($list=array()) {
		if (in_array('essential-grid', greenville_storage_get('required_plugins'))) {
			$path = greenville_get_file_dir('plugins/essential-grid/essential-grid.zip');
			$list[] = array(
						'name' 		=> esc_html__('Essential Grid', 'greenville'),
						'slug' 		=> 'essential-grid',
						'source'	=> !empty($path) ? $path : 'upload://essential-grid.zip',
						'required' 	=> false
			);
		}
		return $list;
	}
}
	
// Enqueue plugin's custom styles
if ( !function_exists( 'greenville_essential_grid_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'greenville_essential_grid_frontend_scripts', 1100 );
	function greenville_essential_grid_frontend_scripts() {
		if (greenville_is_on(greenville_get_theme_option('debug_mode')) && greenville_get_file_dir('plugins/essential-grid/essential-grid.css')!='')
			wp_enqueue_style( 'essential-grid',  greenville_get_file_url('plugins/essential-grid/essential-grid.css'), array(), null );
	}
}
	
// Merge custom styles
if ( !function_exists( 'greenville_essential_grid_merge_styles' ) ) {
	//Handler of the add_filter('greenville_filter_merge_styles', 'greenville_essential_grid_merge_styles');
	function greenville_essential_grid_merge_styles($list) {
		$list[] = 'plugins/essential-grid/essential-grid.css';
		return $list;
	}
}
?>