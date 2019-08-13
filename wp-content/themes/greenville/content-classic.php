<?php
/**
 * The Classic template to display the content
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage GREENVILLE
 * @since GREENVILLE 1.0
 */

$greenville_blog_style = explode('_', greenville_get_theme_option('blog_style'));
$greenville_columns = empty($greenville_blog_style[1]) ? 2 : max(2, $greenville_blog_style[1]);
$greenville_expanded = !greenville_sidebar_present() && greenville_is_on(greenville_get_theme_option('expand_content'));
$greenville_post_format = get_post_format();
$greenville_post_format = empty($greenville_post_format) ? 'standard' : str_replace('post-format-', '', $greenville_post_format);
$greenville_animation = greenville_get_theme_option('blog_animation');

?><div class="<?php echo esc_attr($greenville_blog_style[0]) == 'classic' ? 'column' : 'masonry_item masonry_item'; ?>-1_<?php echo esc_attr($greenville_columns); ?>"><article id="post-<?php the_ID(); ?>"
	<?php post_class( 'post_item post_format_'.esc_attr($greenville_post_format)
					. ' post_layout_classic post_layout_classic_'.esc_attr($greenville_columns)
					. ' post_layout_'.esc_attr($greenville_blog_style[0]) 
					. ' post_layout_'.esc_attr($greenville_blog_style[0]).'_'.esc_attr($greenville_columns)
					); ?>
	<?php echo (!greenville_is_off($greenville_animation) ? ' data-animation="'.esc_attr(greenville_get_animation_classes($greenville_animation)).'"' : ''); ?>
	>

	<?php

	// Featured image
	greenville_show_post_featured( array( 'thumb_size' => greenville_get_thumb_size($greenville_blog_style[0] == 'classic'
													? (strpos(greenville_get_theme_option('body_style'), 'full')!==false 
															? ( $greenville_columns > 2 ? 'big' : 'huge' )
															: (	$greenville_columns > 2
																? ($greenville_expanded ? 'med' : 'small')
																: ($greenville_expanded ? 'big' : 'med')
																)
														)
													: (strpos(greenville_get_theme_option('body_style'), 'full')!==false 
															? ( $greenville_columns > 2 ? 'masonry-big' : 'full' )
															: (	$greenville_columns <= 2 && $greenville_expanded ? 'masonry-big' : 'masonry')
														)
								) ) );

	if ( !in_array($greenville_post_format, array('link', 'aside', 'status', 'quote')) ) {
		?>
		<div class="post_header entry-header">
			<?php 


			do_action('greenville_action_before_post_meta');

            // Post meta
            greenville_show_post_meta(array(
                    'categories' => false,
                    'date' => true,
                    'edit' => false,
                    'seo' => false,
                    'share' => false,
                    'author' => true,
                    'counters' => ''	//comments,likes,views - comma separated in any combination
                )
            );

			do_action('greenville_action_before_post_title');

			// Post title
			the_title( sprintf( '<h4 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' );
			?>
		</div><!-- .entry-header -->
		<?php
	}		
	?>

	<div class="post_content entry-content">
		<div class="post_content_inner">
			<?php
			$greenville_show_learn_more = false;
			if (has_excerpt()) {
				the_excerpt();
			} else if (strpos(get_the_content('!--more'), '!--more')!==false) {
				the_content( '' );
			} else if (in_array($greenville_post_format, array('link', 'aside', 'status', 'quote'))) {
				the_content();
			} else if (substr(get_the_content(), 0, 1)!='[') {
				the_excerpt();
			}
			?>
		</div>
		<?php
		// Post meta
		if (in_array($greenville_post_format, array('link', 'aside', 'status', 'quote'))) {
			greenville_show_post_meta(array(
				'share' => false,
				'counters' => 'comments'
				)
			);
		}
		// More button
		if ( $greenville_show_learn_more ) {
			?><p><a class="more-link" href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e('Read more', 'greenville'); ?></a></p><?php
		}
		?>
	</div><!-- .entry-content -->

</article></div>