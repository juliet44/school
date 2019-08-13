<?php
/* WP GDPR Compliance support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'greenville_wp_gdpr_compliance_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'greenville_wp_gdpr_compliance_theme_setup9', 9 );
	function greenville_wp_gdpr_compliance_theme_setup9() {
		if ( is_admin() ) {
			add_filter( 'greenville_filter_tgmpa_required_plugins', 'greenville_wp_gdpr_compliance_tgmpa_required_plugins' );
		}
	}
}


// Filter to add in the required plugins list
if ( !function_exists( 'greenville_wp_gdpr_compliance_tgmpa_required_plugins' ) ) {
	function greenville_wp_gdpr_compliance_tgmpa_required_plugins($list=array()) {
		if (in_array('wp-gdpr-compliance', greenville_storage_get('required_plugins')))
			$list[] = array(
				'name' 		=> esc_html__('WP GDPR Compliance', 'greenville'),
				'slug' 		=> 'wp-gdpr-compliance',
				'required' 	=> false
			);
		return $list;
	}
}


// Check if this plugin installed and activated
if ( ! function_exists( 'greenville_exists_wp_gdpr_compliance' ) ) {
	function greenville_exists_wp_gdpr_compliance() {
		return class_exists( 'WPGDPRC\WPGDPRC' );
	}
}
