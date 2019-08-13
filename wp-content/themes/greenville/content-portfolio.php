<?php
/**
 * The Portfolio template to display the content
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

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_portfolio post_layout_portfolio_'.esc_attr($greenville_columns).' post_format_'.esc_attr($greenville_post_format) ); ?>
	<?php echo (!greenville_is_off($greenville_animation) ? ' data-animation="'.esc_attr(greenville_get_animation_classes($greenville_animation)).'"' : ''); ?>
	>

	<?php
	$greenville_image_hover = greenville_get_theme_option('image_hover');
	// Featured image
	greenville_show_post_featured(array(
		'thumb_size' => greenville_get_thumb_size(strpos(greenville_get_theme_option('body_style'), 'full')!==false || $greenville_columns < 3 ? 'masonry-big' : 'masonry'),
		'show_no_image' => true,
		'class' => $greenville_image_hover == 'dots' ? 'hover_with_info' : '',
		'post_info' => $greenville_image_hover == 'dots' ? '<div class="post_info">'.esc_html(get_the_title()).'</div>' : ''
	));
	?>
</article>