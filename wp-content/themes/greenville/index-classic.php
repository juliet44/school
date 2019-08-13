<?php
/**
 * The template for homepage posts with "Classic" style
 *
 * @package WordPress
 * @subpackage GREENVILLE
 * @since GREENVILLE 1.0
 */

greenville_storage_set('blog_archive', true);

// Load scripts for 'Masonry' layout
if (substr(greenville_get_theme_option('blog_style'), 0, 7) == 'masonry') {
	wp_enqueue_script( 'classie', greenville_get_file_url('js/theme.gallery/classie.min.js'), array(), null, true );
	wp_enqueue_script( 'imagesloaded', greenville_get_file_url('js/theme.gallery/imagesloaded.min.js'), array(), null, true );
	wp_enqueue_script( 'masonry', greenville_get_file_url('js/theme.gallery/masonry.min.js'), array(), null, true );
	wp_enqueue_script( 'greenville-gallery-script', greenville_get_file_url('js/theme.gallery/theme.gallery.js'), array(), null, true );
}

get_header(); 

if (have_posts()) {

	echo get_query_var('blog_archive_start');

	$greenville_classes = 'posts_container '
						. (substr(greenville_get_theme_option('blog_style'), 0, 7) == 'classic' ? 'columns_wrap' : 'masonry_wrap');
	$greenville_stickies = is_home() ? get_option( 'sticky_posts' ) : false;
	$greenville_sticky_out = is_array($greenville_stickies) && count($greenville_stickies) > 0 && get_query_var( 'paged' ) < 1;
	if ($greenville_sticky_out) {
		?><div class="sticky_wrap columns_wrap"><?php	
	}
	if (!$greenville_sticky_out) {
		if (greenville_get_theme_option('first_post_large') && !is_paged() && !in_array(greenville_get_theme_option('body_style'), array('fullwide', 'fullscreen'))) {
			the_post();
			get_template_part( 'content', 'excerpt' );
		}
		
		?><div class="<?php echo esc_attr($greenville_classes); ?>"><?php
	}
	while ( have_posts() ) { the_post(); 
		if ($greenville_sticky_out && !is_sticky()) {
			$greenville_sticky_out = false;
			?></div><div class="<?php echo esc_attr($greenville_classes); ?>"><?php
		}
		get_template_part( 'content', $greenville_sticky_out && is_sticky() ? 'sticky' : 'classic' );
	}
	
	?></div><?php

	greenville_show_pagination();

	echo get_query_var('blog_archive_end');

} else {

	if ( is_search() )
		get_template_part( 'content', 'none-search' );
	else
		get_template_part( 'content', 'none-archive' );

}

get_footer();
?>