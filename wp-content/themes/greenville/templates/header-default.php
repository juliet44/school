<?php
/**
 * The template to display default site header
 *
 * @package WordPress
 * @subpackage GREENVILLE
 * @since GREENVILLE 1.0
 */

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

?><header class="top_panel top_panel_default<?php
					echo !empty($greenville_header_image) || !empty($greenville_header_video) ? ' with_bg_image' : ' without_bg_image';
					if ($greenville_header_video!='') echo ' with_bg_video';
					if ($greenville_header_image!='') echo ' '.esc_attr(greenville_add_inline_css_class('background-image: url('.esc_url($greenville_header_image).');'));
					if (is_single() && has_post_thumbnail()) echo ' with_featured_image';
					if (greenville_is_on(greenville_get_theme_option('header_fullheight'))) echo ' header_fullheight trx-stretch-height';
					?> scheme_<?php echo esc_attr(greenville_is_inherit(greenville_get_theme_option('header_scheme')) 
													? greenville_get_theme_option('color_scheme') 
													: greenville_get_theme_option('header_scheme'));
					?>"><?php

	// Background video
	if (!empty($greenville_header_video)) {
		get_template_part( 'templates/header-video' );
	}
	
	// Main menu
	if (greenville_get_theme_option("menu_style") == 'top') {
		get_template_part( 'templates/header-navi' );
	}

	// Page title and breadcrumbs area
	get_template_part( 'templates/header-title');

	// Header widgets area
	get_template_part( 'templates/header-widgets' );

	// Header for single posts
	get_template_part( 'templates/header-single' );

?></header>