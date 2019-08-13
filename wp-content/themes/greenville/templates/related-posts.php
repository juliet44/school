<?php
/**
 * The template 'Style 1' to displaying related posts
 *
 * @package WordPress
 * @subpackage GREENVILLE
 * @since GREENVILLE 1.0
 */

$greenville_link = get_permalink();
$greenville_post_format = get_post_format();
$greenville_post_format = empty($greenville_post_format) ? 'standard' : str_replace('post-format-', '', $greenville_post_format);
?><div id="post-<?php the_ID(); ?>" 
	<?php post_class( 'related_item related_item_style_1 post_format_'.esc_attr($greenville_post_format) ); ?>><?php
	greenville_show_post_featured(array(
		'thumb_size' => greenville_get_thumb_size( 'big' ),
		'show_no_image' => false,
		'singular' => false,
		'post_info' => '<div class="post_header entry-header">'
							. '<div class="post_categories">' . greenville_get_post_categories('') . '</div>'
							. '<h6 class="post_title entry-title"><a href="' . esc_url($greenville_link) . '">' . get_the_title() . '</a></h6>'
							. (in_array(get_post_type(), array('post', 'attachment'))
									? '<span class="post_date"><a href="' . esc_url($greenville_link) . '">' . greenville_get_date() . '</a></span>'
									: '')
						. '</div>'
		)
	);
?></div>