<?php
/**
 * The Gallery template to display posts
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage GREENVILLE
 * @since GREENVILLE 1.0
 */

$greenville_blog_style = explode('_', greenville_get_theme_option('blog_style'));
$greenville_columns = empty($greenville_blog_style[1]) ? 2 : max(2, $greenville_blog_style[1]);
$greenville_post_format = get_post_format();
$greenville_post_format = empty($greenville_post_format) ? 'standard' : str_replace('post-format-', '', $greenville_post_format);
$greenville_animation = greenville_get_theme_option('blog_animation');
$greenville_image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_portfolio post_layout_gallery post_layout_gallery_'.esc_attr($greenville_columns).' post_format_'.esc_attr($greenville_post_format) ); ?>
	<?php echo (!greenville_is_off($greenville_animation) ? ' data-animation="'.esc_attr(greenville_get_animation_classes($greenville_animation)).'"' : ''); ?>
	data-size="<?php if (!empty($greenville_image[1]) && !empty($greenville_image[2])) echo intval($greenville_image[1]) .'x' . intval($greenville_image[2]); ?>"
	data-src="<?php if (!empty($greenville_image[0])) echo esc_url($greenville_image[0]); ?>"
	>

	<?php
	$greenville_image_hover = 'icon';
	if (in_array($greenville_image_hover, array('icons', 'zoom'))) $greenville_image_hover = 'dots';
	// Featured image
	greenville_show_post_featured(array(
		'hover' => $greenville_image_hover,
		'thumb_size' => greenville_get_thumb_size( strpos(greenville_get_theme_option('body_style'), 'full')!==false || $greenville_columns < 3 ? 'masonry-big' : 'masonry' ),
		'thumb_only' => true,
		'show_no_image' => true,
		'post_info' => '<div class="post_details">'
							. '<h2 class="post_title"><a href="'.esc_url(get_permalink()).'">'. esc_html(get_the_title()) . '</a></h2>'
							. '<div class="post_description">'
								. greenville_show_post_meta(array(
									'categories' => true,
									'date' => true,
									'edit' => false,
									'seo' => false,
									'share' => true,
									'counters' => 'comments',
									'echo' => false
									))
								. '<div class="post_description_content">'
									. apply_filters('the_excerpt', get_the_excerpt())
								. '</div>'
								. '<a href="'.esc_url(get_permalink()).'" class="theme_button post_readmore"><span class="post_readmore_label">' . esc_html__('Learn more', 'greenville') . '</span></a>'
							. '</div>'
						. '</div>'
	));
	?>
</article>