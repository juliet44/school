<?php
/**
 * The template to display custom header from the ThemeREX Addons Layouts
 *
 * @package WordPress
 * @subpackage GREENVILLE
 * @since GREENVILLE 1.0.06
 */

$greenville_header_id = str_replace('header-custom-', '', greenville_get_theme_option("header_style"));
if ((int) $greenville_header_id == 0) {
    $greenville_header_id = greenville_get_post_id(array(
            'name' => $greenville_header_id,
            'post_type' => defined('TRX_ADDONS_CPT_LAYOUTS_PT') ? TRX_ADDONS_CPT_LAYOUTS_PT : 'cpt_layouts'
        )
    );
} else {
    $greenville_header_id = apply_filters('trx_addons_filter_get_translated_layout', $greenville_header_id);
}



$greenville_header_css = $greenville_header_image = '';
$greenville_header_video = greenville_get_header_video();
if (true || empty($greenville_header_video)) {
	$greenville_header_image = get_header_image();
	if (greenville_is_on(greenville_get_theme_option('header_image_override')) && apply_filters('greenville_filter_allow_override_header_image', true)) {
		if (is_category()) {
			if (($greenville_cat_img = greenville_get_category_image()) != '')
				$greenville_header_image = $greenville_cat_img;
		} else if (is_singular() || greenville_storage_isset('blog_archive')) {
			if (has_post_thumbnail()) {
				$greenville_header_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
				if (is_array($greenville_header_image)) $greenville_header_image = $greenville_header_image[0];
			} else
				$greenville_header_image = '';
		}
	}
}

$greenville_header_id = str_replace('header-custom-', '', greenville_get_theme_option("header_style"));
$greenville_header_meta = get_post_meta($greenville_header_id, 'trx_addons_options', true);

?><header class="top_panel top_panel_custom top_panel_custom_<?php echo esc_attr($greenville_header_id); 
						?> top_panel_custom_<?php echo esc_attr(sanitize_title(get_the_title($greenville_header_id)));
						echo !empty($greenville_header_image) || !empty($greenville_header_video) 
							? ' with_bg_image' 
							: ' without_bg_image';
						if ($greenville_header_video!='') 
							echo ' with_bg_video';
						if ($greenville_header_image!='') 
							echo ' '.esc_attr(greenville_add_inline_css_class('background-image: url('.esc_url($greenville_header_image).');'));
						if (!empty($greenville_header_meta['margin']) != '') 
							echo ' '.esc_attr(greenville_add_inline_css_class('margin-bottom: '.esc_attr(greenville_prepare_css_value($greenville_header_meta['margin'])).';'));
						if (is_single() && has_post_thumbnail()) 
							echo ' with_featured_image';
						if (greenville_is_on(greenville_get_theme_option('header_fullheight'))) 
							echo ' header_fullheight trx-stretch-height';
						?> scheme_<?php echo esc_attr(greenville_is_inherit(greenville_get_theme_option('header_scheme')) 
														? greenville_get_theme_option('color_scheme') 
														: greenville_get_theme_option('header_scheme'));
						?>"><?php

	// Background video
	if (!empty($greenville_header_video)) {
		get_template_part( 'templates/header-video' );
	}
		
	// Custom header's layout
	do_action('greenville_action_show_layout', $greenville_header_id);

	// Header widgets area
	get_template_part( 'templates/header-widgets' );
		
?></header>