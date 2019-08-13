<?php
/**
 * The template to display posts in widgets and/or in the search results
 *
 * @package WordPress
 * @subpackage GREENVILLE
 * @since GREENVILLE 1.0
 */

$greenville_post_id    = get_the_ID();
$greenville_post_date  = greenville_get_date();
$greenville_post_title = get_the_title();
$greenville_post_link  = get_permalink();
$greenville_post_author_id   = get_the_author_meta('ID');
$greenville_post_author_name = get_the_author_meta('display_name');
$greenville_post_author_url  = get_author_posts_url($greenville_post_author_id, '');

$greenville_args = get_query_var('greenville_args_widgets_posts');
$greenville_show_date = isset($greenville_args['show_date']) ? (int) $greenville_args['show_date'] : 1;
$greenville_show_image = isset($greenville_args['show_image']) ? (int) $greenville_args['show_image'] : 1;
$greenville_show_author = isset($greenville_args['show_author']) ? (int) $greenville_args['show_author'] : 1;
$greenville_show_counters = isset($greenville_args['show_counters']) ? (int) $greenville_args['show_counters'] : 1;
$greenville_show_categories = isset($greenville_args['show_categories']) ? (int) $greenville_args['show_categories'] : 1;

$greenville_output = greenville_storage_get('greenville_output_widgets_posts');

$greenville_post_counters_output = '';
if ( $greenville_show_counters ) {
	$greenville_post_counters_output = '<span class="post_info_item post_info_counters">'
								. greenville_get_post_counters('comments')
							. '</span>';
}


$greenville_output .= '<article class="post_item with_thumb">';

if ($greenville_show_image) {
	$greenville_post_thumb = get_the_post_thumbnail($greenville_post_id, greenville_get_thumb_size('tiny'), array(
		'alt' => get_the_title()
	));
	if ($greenville_post_thumb) $greenville_output .= '<div class="post_thumb">' . ($greenville_post_link ? '<a href="' . esc_url($greenville_post_link) . '">' : '') . ($greenville_post_thumb) . ($greenville_post_link ? '</a>' : '') . '</div>';
}

$greenville_output .= '<div class="post_content">'
			. ($greenville_show_categories 
					? '<div class="post_categories">'
						. greenville_get_post_categories()
						. $greenville_post_counters_output
						. '</div>' 
					: '')
			. '<h6 class="post_title">' . ($greenville_post_link ? '<a href="' . esc_url($greenville_post_link) . '">' : '') . ($greenville_post_title) . ($greenville_post_link ? '</a>' : '') . '</h6>'
			. apply_filters('greenville_filter_get_post_info', 
								'<div class="post_info">'
									. ($greenville_show_date 
										? '<span class="post_info_item post_info_posted">'
											. ($greenville_post_link ? '<a href="' . esc_url($greenville_post_link) . '" class="post_info_date">' : '') 
											. esc_html($greenville_post_date) 
											. ($greenville_post_link ? '</a>' : '')
											. '</span>'
										: '')
									. ($greenville_show_author 
										? '<span class="post_info_item post_info_posted_by">' 
											. esc_html__('by', 'greenville') . ' ' 
											. ($greenville_post_link ? '<a href="' . esc_url($greenville_post_author_url) . '" class="post_info_author">' : '') 
											. esc_html($greenville_post_author_name) 
											. ($greenville_post_link ? '</a>' : '') 
											. '</span>'
										: '')
									. (!$greenville_show_categories && $greenville_post_counters_output
										? $greenville_post_counters_output
										: '')
								. '</div>')
		. '</div>'
	. '</article>';
greenville_storage_set('greenville_output_widgets_posts', $greenville_output);
?>