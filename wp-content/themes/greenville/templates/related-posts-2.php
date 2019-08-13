<?php
/**
 * The template 'Style 2' to displaying related posts
 *
 * @package WordPress
 * @subpackage GREENVILLE
 * @since GREENVILLE 1.0
 */

$greenville_link = get_permalink();
$greenville_post_format = get_post_format();
$greenville_post_format = empty($greenville_post_format) ? 'standard' : str_replace('post-format-', '', $greenville_post_format);
?><div id="post-<?php the_ID(); ?>" 
	<?php post_class( 'related_item related_item_style_2 post_format_'.esc_attr($greenville_post_format) ); ?>><?php
	greenville_show_post_featured(array(
		'thumb_size' => greenville_get_thumb_size( 'big' ),
		'show_no_image' => false,
		'singular' => false
		)
	);
	?><div class="post_header entry-header"><?php
		if ( in_array(get_post_type(), array( 'post', 'attachment' ) ) ) {
			?><span class="post_date"><a href="<?php echo esc_url($greenville_link); ?>"><?php echo greenville_get_date(); ?></a></span><?php
		}
		?>
		<h6 class="post_title entry-title"><a href="<?php echo esc_url($greenville_link); ?>"><?php echo the_title(); ?></a></h6>
	</div>
</div>